# HTTP

## URI Checker

```java
package xyz.icehe.utils;

import java.net.URI;
import java.net.URISyntaxException;

import org.apache.commons.lang3.StringUtils;
import lombok.experimental.UtilityClass;

/**
 * HTTP 工具集
 *
 * @author icehe.xyz
 * @since 2020/10/19
 */
@UtilityClass
public class HttpUtils {

    /**
     * 获取有效的 URI
     *
     * @param originalUri
     * @return
     */
    public URI getCheckedURI(String originalUri) {
        if (StringUtil.isBlank(originalUri)) {
            return null;
        }
        try {
            return new URI(originalUri);
        } catch (URISyntaxException e) {
            return null;
        }
    }

    /**
     * 是否为有效的 URI
     *
     * @param originalUri
     * @return
     * @throws ServiceException
     */
    public boolean iaValidUri(String originalUri) throws ServiceException {
        return Objects.nonNull(getCheckedURI(originalUri));
    }
}

```

## IP Getter

```java
package xyz.icehe.utils;

import java.net.Inet4Address;
import java.net.InetAddress;
import java.net.NetworkInterface;
import java.net.SocketException;
import java.net.UnknownHostException;
import java.util.Collections;
import java.util.List;
import java.util.stream.Collectors;

import lombok.experimental.UtilityClass;

/**
 * IP 工具集
 *
 * @author icehe.xyz
 * @since 2020/10/19
 */
@UtilityClass
public class IpUtils {

    public List<String> getLocalIPs() {
        try {
            return Collections.list(NetworkInterface.getNetworkInterfaces())
                .stream()
                .map(tNetworkInterface -> Collections.list(tNetworkInterface.getInetAddresses()))
                .flatMap(List::stream)
                .filter(tInetAddress -> tInetAddress instanceof Inet4Address)
                .map(InetAddress::getHostAddress)
                .collect(Collectors.toList());
        } catch (SocketException e) {
            return Collections.emptyList();
        }
    }

    public String getLocalIP() {
        try {
            return InetAddress.getLocalHost().getHostAddress();
        } catch (UnknownHostException e) {
            return null;
        }
    }
}

```

## PooledHttpClient

```java
package xyz.icehe.http;

import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.security.KeyManagementException;
import java.security.KeyStoreException;
import java.security.NoSuchAlgorithmException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;
import java.util.stream.Collectors;

import javax.net.ssl.SSLContext;

import lombok.extern.slf4j.Slf4j;
import org.apache.http.Consts;
import org.apache.http.HttpEntity;
import org.apache.http.HttpHeaders;
import org.apache.http.HttpHost;
import org.apache.http.HttpRequest;
import org.apache.http.HttpResponse;
import org.apache.http.HttpStatus;
import org.apache.http.HttpVersion;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.ResponseHandler;
import org.apache.http.client.config.RequestConfig;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.CloseableHttpResponse;
import org.apache.http.client.methods.HttpDelete;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.client.methods.HttpPut;
import org.apache.http.client.utils.URIBuilder;
import org.apache.http.config.Registry;
import org.apache.http.config.RegistryBuilder;
import org.apache.http.config.SocketConfig;
import org.apache.http.conn.ClientConnectionManager;
import org.apache.http.conn.socket.ConnectionSocketFactory;
import org.apache.http.conn.socket.PlainConnectionSocketFactory;
import org.apache.http.conn.ssl.SSLConnectionSocketFactory;
import org.apache.http.entity.ContentType;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.DefaultConnectionKeepAliveStrategy;
import org.apache.http.impl.client.HttpClients;
import org.apache.http.impl.conn.PoolingHttpClientConnectionManager;
import org.apache.http.message.BasicHeader;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.params.HttpParams;
import org.apache.http.protocol.HttpContext;
import org.apache.http.ssl.SSLContexts;
import org.apache.http.util.EntityUtils;
import org.springframework.util.CollectionUtils;

/**
 * Pooled HTTP Client
 *
 * <p>Require httpclient version 4.5+
 *
 * @author icehe.xyz
 * @since 2020/11/17
 */
@Slf4j
public class PooledHttpClient extends CloseableHttpClient implements AutoCloseable {

    private static final String KEEP_ALIVE = "keep-alive";

    private static final List<PooledHttpClient> POOLED_HTTP_CLIENTS = new ArrayList<>();

    static {
        Runtime.getRuntime().addShutdownHook(new Thread(() -> {
            if (CollectionUtils.isEmpty(POOLED_HTTP_CLIENTS)) {
                return;
            }
            log.info("Start to close pooled http clients.");
            POOLED_HTTP_CLIENTS.forEach(client -> {
                try {
                    client.close();
                } catch (Exception e) {
                    log.error("Failed to close a pooled http client!", e);
                }
            });
            try {
                Thread.sleep(1000);
            } catch (Exception e) {
                log.error("Failed to sleep when closing pooled http clients!", e);
            }
        }));
    }

    private final CloseableHttpClient httpClient;
    private final RequestConfig defaultRequestConfig;

    /**
     * Constructor
     *
     * @param maxTotal
     * @param timeout
     */
    private PooledHttpClient(int maxTotal, int timeout) {
        defaultRequestConfig = initRequestConfig(timeout, timeout, timeout);
        httpClient = HttpClients.custom()
            .setKeepAliveStrategy(DefaultConnectionKeepAliveStrategy.INSTANCE)
            .setConnectionManager(initConnectionManager(maxTotal, timeout, maxTotal))
            .build();
    }

    private PooledHttpClient(HttpRequestConfig config) {
        defaultRequestConfig = initRequestConfig(
            config.getConnectTimeout(),
            config.getConnectRequestTimeout(),
            config.getSocketTimeout()
        );
        PoolingHttpClientConnectionManager connManager = initConnectionManager(
            config.getMaxTotal(),
            config.getSocketTimeout(),
            config.getDefaultMaxPerRoute()
        );
        httpClient = HttpClients.custom()
            .setKeepAliveStrategy(DefaultConnectionKeepAliveStrategy.INSTANCE)
            .setConnectionManager(connManager)
            .build();
    }

    private PooledHttpClient(HttpRequestConfig config, boolean httpsSupport)
        throws NoSuchAlgorithmException, KeyManagementException, KeyStoreException {
        defaultRequestConfig = initRequestConfig(
            config.getConnectTimeout(),
            config.getConnectRequestTimeout(),
            config.getSocketTimeout()
        );
        if (httpsSupport) {
            try {
                SSLContext sslContext = SSLContexts.custom()
                    .loadTrustMaterial(null, ((chain, authType) -> true))
                    .build();
                SSLConnectionSocketFactory sslSocketFactory =
                    new SSLConnectionSocketFactory(sslContext, (s, sslSession) -> true);
                PoolingHttpClientConnectionManager connManager = initConnectionManager(
                    config.getMaxTotal(),
                    config.getSocketTimeout(),
                    config.getDefaultMaxPerRoute(),
                    sslSocketFactory
                );
                httpClient = HttpClients.custom().setKeepAliveStrategy(DefaultConnectionKeepAliveStrategy.INSTANCE)
                    .setConnectionManager(connManager)
                    .setSSLSocketFactory(sslSocketFactory)
                    .build();
            } catch (NoSuchAlgorithmException e) {
                throw e;
            } catch (KeyManagementException e) {
                throw e;
            } catch (KeyStoreException e) {
                throw e;
            }
        } else {
            PoolingHttpClientConnectionManager connManager = initConnectionManager(
                config.getMaxTotal(),
                config.getSocketTimeout(),
                config.getDefaultMaxPerRoute()
            );
            httpClient = HttpClients.custom()
                .setKeepAliveStrategy(DefaultConnectionKeepAliveStrategy.INSTANCE)
                .setConnectionManager(connManager)
                .build();
        }
    }

    public static PooledHttpClient newPooledHttpClient(int maxTotal, int timeout) {
        PooledHttpClient pooledHttpClient = new PooledHttpClient(maxTotal, timeout);
        POOLED_HTTP_CLIENTS.add(pooledHttpClient);
        return pooledHttpClient;
    }

    public static PooledHttpClient newPooledHttpClient(HttpRequestConfig config) {
        PooledHttpClient pooledHttpClient = new PooledHttpClient(config);
        POOLED_HTTP_CLIENTS.add(pooledHttpClient);
        return pooledHttpClient;
    }

    public static PooledHttpClient newPooledHttpsClient(HttpRequestConfig config)
        throws NoSuchAlgorithmException, KeyStoreException, KeyManagementException {
        PooledHttpClient pooledHttpClient = new PooledHttpClient(config, true);
        POOLED_HTTP_CLIENTS.add(pooledHttpClient);
        return pooledHttpClient;
    }

    @Override
    protected CloseableHttpResponse doExecute(HttpHost httpHost, HttpRequest httpRequest, HttpContext httpContext)
        throws IOException {
        return httpClient.execute(httpHost, httpRequest, httpContext);
    }

    @Override
    public HttpParams getParams() {
        return httpClient.getParams();
    }

    @Override
    public ClientConnectionManager getConnectionManager() {
        return httpClient.getConnectionManager();
    }

    private PoolingHttpClientConnectionManager initConnectionManager(
        int maxTotal,
        int soTimeout,
        int defaultMaxPerRoute
    ) {
        PoolingHttpClientConnectionManager connectionManager = new PoolingHttpClientConnectionManager();
        connectionManager.setMaxTotal(maxTotal);
        SocketConfig socketConfig = SocketConfig.custom()
            .setTcpNoDelay(true)
            .setSoKeepAlive(true)
            .setSoReuseAddress(true)
            .setSoTimeout(soTimeout)
            .build();
        connectionManager.setDefaultSocketConfig(socketConfig);
        connectionManager.setDefaultMaxPerRoute(defaultMaxPerRoute);
        return connectionManager;
    }

    private PoolingHttpClientConnectionManager initConnectionManager(
        int maxTotal,
        int soTimeout,
        int defaultMaxPerRoute,
        SSLConnectionSocketFactory sslConnectionSocketFactory
    ) {
        Registry<ConnectionSocketFactory> socketFactoryRegistry =
            RegistryBuilder.<ConnectionSocketFactory>create()
                .register("http", PlainConnectionSocketFactory.getSocketFactory())
                .register("https", sslConnectionSocketFactory)
                .build();
        PoolingHttpClientConnectionManager connectionManager =
            new PoolingHttpClientConnectionManager(socketFactoryRegistry);
        connectionManager.setMaxTotal(maxTotal);
        SocketConfig socketConfig =
            SocketConfig.custom()
                .setTcpNoDelay(true)
                .setSoKeepAlive(true)
                .setSoReuseAddress(true)
                .setSoTimeout(soTimeout)
                .build();
        connectionManager.setDefaultSocketConfig(socketConfig);
        connectionManager.setDefaultMaxPerRoute(defaultMaxPerRoute);
        return connectionManager;
    }

    private RequestConfig initRequestConfig(int connectTimeout, int connRequestTimeout, int soTimeout) {
        return RequestConfig.custom()
            .setConnectTimeout(connectTimeout)
            .setConnectionRequestTimeout(connRequestTimeout)
            .setSocketTimeout(soTimeout)
            .build();
    }

    public String get(String url) throws IOException, URISyntaxException {
        return get(url, null, null);
    }

    public String get(String url, Map<String, String> queryParameters) throws IOException, URISyntaxException {
        return get(url, queryParameters, null);
    }

    public String get(String url, List<HttpHeader> headers) throws IOException, URISyntaxException {
        return get(url, null, headers);
    }

    public String get(String url, Map<String, String> queryParameters, List<HttpHeader> headers)
        throws IOException, URISyntaxException {

        HttpGet httpGet;
        if (CollectionUtils.isEmpty(queryParameters)) {
            httpGet = new HttpGet(url);
        } else {
            List<NameValuePair> nameValuePairs =
                queryParameters.entrySet().stream()
                    .map(entry -> new BasicNameValuePair(entry.getKey(), entry.getValue()))
                    .collect(Collectors.toList());
            URI uri = new URIBuilder(url).setParameters(nameValuePairs).build();
            httpGet = new HttpGet(uri);
        }
        if (!CollectionUtils.isEmpty(headers)) {
            BasicHeader[] basicHeaders = headers.stream()
                .map(httpHeader -> new BasicHeader(httpHeader.getName(), httpHeader.getValue()))
                .collect(Collectors.toList())
                .toArray(new BasicHeader[headers.size()]);
            httpGet.setHeaders(basicHeaders);
        }
        httpGet.setHeader(HttpHeaders.CONNECTION, KEEP_ALIVE);
        httpGet.setConfig(defaultRequestConfig);
        httpGet.setProtocolVersion(HttpVersion.HTTP_1_1);
        String response = httpClient.execute(httpGet, DefaultResponseHandler.INSTANCE);
        return response;
    }

    public String postWithJSON(String url, String jsonString) throws IOException {
        return postWithJSON(url, jsonString, null);
    }

    public String postWithJSON(String url, String jsonString, List<HttpHeader> headers) throws IOException {
        return postWithJSON(url, jsonString, headers, DefaultResponseHandler.INSTANCE);
    }

    public String postWithJSON(
        String url,
        String jsonString,
        List<HttpHeader> headers,
        ResponseHandler<String> responseHandler
    ) throws IOException {
        HttpPost httpPost = new HttpPost(url);
        httpPost.setConfig(defaultRequestConfig);
        StringEntity entity = new StringEntity(jsonString, ContentType.APPLICATION_JSON);
        httpPost.setEntity(entity);
        if (!CollectionUtils.isEmpty(headers)) {
            BasicHeader[] basicHeaders =
                headers.stream()
                    .map(httpHeader -> new BasicHeader(httpHeader.getName(), httpHeader.getValue()))
                    .collect(Collectors.toList())
                    .toArray(new BasicHeader[headers.size()]);
            httpPost.setHeaders(basicHeaders);
        }
        httpPost.setHeader(entity.getContentType());
        httpPost.setHeader(HttpHeaders.CONNECTION, KEEP_ALIVE);
        httpPost.setProtocolVersion(HttpVersion.HTTP_1_1);
        return httpClient.execute(httpPost, responseHandler);
    }

    public String postWithForm(String url, Map<String, String> parameters) throws IOException {
        return postWithForm(url, parameters, null, DefaultResponseHandler.INSTANCE);
    }

    public String postWithForm(String url, Map<String, String> parameters, List<HttpHeader> headers)
        throws IOException {
        return postWithForm(url, parameters, headers, DefaultResponseHandler.INSTANCE);
    }

    public String postWithForm(
        String url,
        Map<String, String> parameters,
        List<HttpHeader> headers,
        ResponseHandler<String> responseHandler
    ) throws IOException {
        HttpPost httpPost = new HttpPost(url);
        httpPost.setConfig(defaultRequestConfig);
        List<BasicNameValuePair> basicNameValuePairs =
            parameters.entrySet().stream()
                .map(entry -> new BasicNameValuePair(entry.getKey(), entry.getValue()))
                .collect(Collectors.toList());
        UrlEncodedFormEntity encodedFormEntity = new UrlEncodedFormEntity(basicNameValuePairs, Consts.UTF_8);
        httpPost.setEntity(encodedFormEntity);
        if (!CollectionUtils.isEmpty(headers)) {
            BasicHeader[] basicHeaders = headers.stream()
                .map(httpHeader -> new BasicHeader(httpHeader.getName(), httpHeader.getValue()))
                .collect(Collectors.toList())
                .toArray(new BasicHeader[headers.size()]);
            httpPost.setHeaders(basicHeaders);
        }
        httpPost.setHeader(encodedFormEntity.getContentType());
        httpPost.setHeader(HttpHeaders.CONNECTION, KEEP_ALIVE);
        httpPost.setProtocolVersion(HttpVersion.HTTP_1_1);
        return httpClient.execute(httpPost, responseHandler);

    }

    public String putWithJSON(String url, String jsonString) throws IOException {
        return putWithJSON(url, jsonString, null);
    }

    public String putWithJSON(
        String url,
        String jsonString,
        List<HttpHeader> headers
    ) throws IOException {
        HttpPut httpPut = new HttpPut(url);
        httpPut.setConfig(defaultRequestConfig);
        StringEntity entity = new StringEntity(jsonString, ContentType.APPLICATION_JSON);
        httpPut.setEntity(entity);
        if (!CollectionUtils.isEmpty(headers)) {
            BasicHeader[] basicHeaders = headers.stream()
                .map(httpHeader -> new BasicHeader(httpHeader.getName(), httpHeader.getValue()))
                .collect(Collectors.toList())
                .toArray(new BasicHeader[headers.size()]);
            httpPut.setHeaders(basicHeaders);
        }
        httpPut.setHeader(entity.getContentType());
        httpPut.setHeader(HttpHeaders.CONNECTION, KEEP_ALIVE);
        httpPut.setProtocolVersion(HttpVersion.HTTP_1_1);
        return httpClient.execute(httpPut, DefaultResponseHandler.INSTANCE);

    }

    public String putWithForm(String url, Map<String, String> parameters) throws IOException {
        return putWithForm(url, parameters, null);
    }

    public String putWithForm(
        String url,
        Map<String, String> parameters,
        List<HttpHeader> headers
    ) throws IOException {
        HttpPut httpPut = new HttpPut(url);
        httpPut.setConfig(defaultRequestConfig);
        List<BasicNameValuePair> basicNameValuePairs =
            parameters.entrySet().stream()
                .map(entry -> new BasicNameValuePair(entry.getKey(), entry.getValue()))
                .collect(Collectors.toList());
        UrlEncodedFormEntity urlEncodedFormEntity = new UrlEncodedFormEntity(basicNameValuePairs);
        httpPut.setEntity(urlEncodedFormEntity);
        if (!CollectionUtils.isEmpty(headers)) {
            BasicHeader[] basicHeaders = headers.stream()
                .map(httpHeader -> new BasicHeader(httpHeader.getName(), httpHeader.getValue()))
                .collect(Collectors.toList())
                .toArray(new BasicHeader[headers.size()]);
            httpPut.setHeaders(basicHeaders);
        }
        httpPut.setHeader(urlEncodedFormEntity.getContentType());
        httpPut.setHeader(HttpHeaders.CONNECTION, KEEP_ALIVE);
        httpPut.setProtocolVersion(HttpVersion.HTTP_1_1);
        return httpClient.execute(httpPut, DefaultResponseHandler.INSTANCE);

    }

    public String delete(String url) throws IOException, URISyntaxException {
        return delete(url, null, null);
    }

    public String delete(String url, List<HttpHeader> headers) throws IOException, URISyntaxException {
        return delete(url, null, headers);
    }

    public String delete(String url, Map<String, String> queryParameters) throws IOException, URISyntaxException {
        return delete(url, queryParameters, null);
    }

    public String delete(
        String url,
        Map<String, String> queryParameters,
        List<HttpHeader> headers
    ) throws IOException, URISyntaxException {
        HttpDelete httpDelete;
        if (CollectionUtils.isEmpty(queryParameters)) {
            httpDelete = new HttpDelete(url);
        } else {
            List<NameValuePair> nameValuePairs =
                queryParameters.entrySet().stream()
                    .map(entry -> new BasicNameValuePair(entry.getKey(), entry.getValue()))
                    .collect(Collectors.toList());
            URI uri = new URIBuilder(url).setParameters(nameValuePairs).build();
            httpDelete = new HttpDelete(uri);
        }
        httpDelete.setConfig(defaultRequestConfig);
        if (!CollectionUtils.isEmpty(headers)) {
            BasicHeader[] basicHeaders = headers.stream()
                .map(httpHeader -> new BasicHeader(httpHeader.getName(), httpHeader.getValue()))
                .collect(Collectors.toList())
                .toArray(new BasicHeader[headers.size()]);
            httpDelete.setHeaders(basicHeaders);
        }
        httpDelete.setHeader(HttpHeaders.CONNECTION, KEEP_ALIVE);
        httpDelete.setProtocolVersion(HttpVersion.HTTP_1_1);
        return httpClient.execute(httpDelete, DefaultResponseHandler.INSTANCE);

    }

    @Override
    public void close() throws IOException {
        httpClient.close();
    }

    private static class DefaultResponseHandler implements ResponseHandler<String> {

        private static final ResponseHandler<String> INSTANCE = new DefaultResponseHandler();

        @Override
        public String handleResponse(HttpResponse httpResponse) throws IOException {
            int status = httpResponse.getStatusLine().getStatusCode();
            if (status == HttpStatus.SC_OK) {
                HttpEntity entity = httpResponse.getEntity();
                return entity != null ? EntityUtils.toString(entity, Consts.UTF_8) : null;
            }
            throw new ClientProtocolException("Unexpected response status: " + status);
        }
    }
}

```
