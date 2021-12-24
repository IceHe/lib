# OAuth 2 in Action

---

References

- 《OAuth 2 in Action》Justin Richer

TODOs

- [ ] 快速过一遍, 形成大概的认识, 记录问题
- [ ] 仔细阅读做笔记
    _( 可能没必要再看一遍 : 已经理解了, 或者质量太差不值得再看 )_

## Preface

……

_The story starts in 2006, when several web service companies,_ including Twitter and Ma.Gnolia, had **complementary<!-- 互补的 --> applications and wanted their users to be able to connect them together**.<!-- 让用户将这些应用统一地连接起来 -->
At the time, this type of connection was typically accomplished by asking the user for their credentials on the remote system and sending those credentials to the API.
However, the websites in question used a distributed identity technology, OpenID, to facilitate login.
As a consequence, there were no usernames or passwords that could be used for the API.

To overcome this, the developers sought<!-- seek --> to create a protocol that would allow their users to **delegate access to the API**.<!-- 允许用户将API访问授权出去 -->

……

_Soon after the publication of RFC 5849,_ the Web Resource Access Protocol (WRAP) was published.
This proposed protocol took the **core aspects** of the OAuth 1.0a protocol — a **client**, **delegation**<!-- 委托 -->, and **tokens**<!-- 令牌 --> — and expanded them to be used in different ways.

……

- **RFC 6749** details how to **get a token**, while
- **RFC 6750** details how to **use a particular type of token** (the **Bearer token**) at a **protected resource**.
- Furthermore, the core of RFC6749 details multiple ways to get a token and provides an extension mechanism.

Instead of defining one complex method to fit different deployment models, OAuth 2.0 defines **four different grant types**, each suited to a different application type.

……

### About this book

对 OAuth 2.0 以及包括 OpenID Connect 和 JOSE/JWT 在内的众多相关技术进行全面 且透彻的探讨。

本书分为 4 个部分，总共 16 章。

-   第一部分由第 1~2 章构成，概述了 OAuth 2.0 协议，可以说 是核心阅读材料。

    - 第 1 章概述了 OAuth 2.0，讲述了开发它的动机，还介绍了 OAuth 出现之前与 API 安全相关的方法。
    - 第 2 章深入讲解授权码许可类型，这是 OAuth 2.0 核心中最常用、最典型的一种许可类型。

-   第二部分由第 3~6 章构成，展示了如何构建一个完整的 OAuth 2.0 生态系统。

    - 第 3~5 章分别展示如何构建简易但功能完整的 OAuth 2.0 客户端、受保护的资源服务器，以及授权服务器。
    - 第 6 章讨论 OAuth 2.0 协议内部的多样性，介绍了授权码之外的其他许可类型，还讨论了原生应用中的许可类型。

-   第三部分由第 7~10 章构成，讨论了 OAuth 2.0 生态系统中各个部分可能出现的漏洞，以及如何规避。

    - 第 7~9 章分别讨论 OAuth 2.0 客户端、受保护资源及授权服务器中常见的漏洞，以及如何避免这些漏洞。
    - 第 10 章讨论 OAuth 2.0 中 bearer 令牌和授权码的弱点，针对它们的攻击，以及如何规避。

-   最后一部分由第 11~16 章构成，这一部分跳出 OAuth 2.0 协议的核心部分，探讨更外围生态系统中的标准和规范，最后还对全书进行了总结。

    - 第 11 章介绍 JSON Web Token(JWT)及其所用的编码机制 JOSE，还包括令牌内省和撤 回，这些主题完整覆盖了令牌的生命周期。
    - 第 12 章介绍动态客户端注册，并讨论它对 OAuth 2.0 生态系统的影响。
    - 第 13 章先解释为什么 OAuth 2.0 不是身份认证协议，继而介绍如何基于它使用 OpenID Connect 构建一个身份认证协议。
    - 第 14 章介绍构建于 OAuth 2.0 之上的 User Managed Access(UMA)协议，该协议允许用 户对用户(user-to-user)的分享。这一章还介绍了 HEART 和 iGov 这两个 OAuth 2.0 配置 规范以及 OpenID Connect，以及这些协议在特定行业领域中是如何应用的。
    - 第 15 章指出 OAuth 2.0 核心规范中的常规 bearer 令牌并不能满足所有需求，并描述了 Proof of Possession(PoP)令牌及 TLS 令牌绑定如何与 OAuth 2.0 协同工作。
    - 第 16 章对全书进行总结，并指导读者如何进一步应用这些知识，还介绍了相关代码库以 及范围更广的社区。

## Table of Contents

### Brief

Part 1 : First steps

- 1. What is OAuth 2.0 and why should you care?
- 2. The OAuth dance

Part 2 : Building an OAuth 2 environment

- 3. Building a simple OAuth client
- 4. Building a simple OAuth protected resource
- 5. Building a simple OAuth authorization server
- 6. OAuth 2.0 in the real world

Part 3 : OAuth 2 implementation and vulnerabilities

- 7. Common client vulnerabilities
- 8. Common protected resources vulnerabilities
- 9. Common authorization server vulnerabilities
- 10. Common OAuth token vulnerabilities 168

Part 4 : Taking OAuth further

- 11. OAuth tokens
- 12. Dynamic client registration
- 13. User authentication with OAuth 2.0
- 14. Protocols and profiles using OAuth 2.0
- 15. Beyond bearer tokens
- 16. Summary and conclusions

### Detailed

**Part 1 : First steps**

1\. What is OAuth 2.0 and why should you care?

- 1.1 What is OAuth 2.0?
- 1.2 The bad old days: credential sharing (and credential theft)
- 1.3 Delegating access
    - Beyond HTTP Basic and the password-sharing antipattern
    - Authorization delegation: why it matters and how it’s used
    - User-driven security and user choice
- 1.4 OAuth 2.0: the good, the bad, and the ugly
- 1.5 What OAuth 2.0 isn't

2\. The OAuth dance

- 2.1 Overview of the OAuth 2.0 protocol: getting and using tokens
- 2.2 Following an OAuth 2.0 authorization grant in detail
- 2.3 OAuth’s actors:
    - **clients**,
    - **authorization servers**,
    - **resource owners**, and
    - **protected resources**
- 2.4 OAuth's components:
    - **Access tokens**
    - **Scopes**
    - **Refresh tokens**
    - **Authorization grants**
- 2.5 Interactions between OAuth’s actors and components: back channel, front channel, and endpoints
    - Back-channel communication
    - Front-channel communication

**Part 2 : Building an OAuth 2 environment**

3\. Building a simple OAuth client

- 3.1 Register an OAuth client with an authorization server
- 3.2 Get a token using the authorization code grant type
    - Sending the authorization request
    - Processing the authorization response
    - Adding cross-site protection with the **state** parameter
- 3.3 Use the token with a protected resource
- 3.4 Refresh the access token

4\. Building a simple OAuth protected resource

- 4.1 Parsing the OAuth token from the HTTP request
- 4.2 Validating the token against our data store
- 4.3 Serving content based on the token
    - Different scopes for different actions
    - Different scopes for different data results
    - Different users for different data results
    - Additional access controls

5\. Building a simple OAuth authorization server

- 5.1 Managing OAuth client registrations
- 5.2 Authorizing a client
    - The authorization endpoint
    - Authorizing the client
- 5.3 Issuing a token
    - Authenticating the client
    - Processing the authorization grant request
- 5.4 Adding refresh token support
- 5.5 Adding scope support

6\. OAuth 2.0 in the real world

- 6.1 Authorization **grant types**
    - Implicit grant type
    - Client credentials grant type
    - Resource owner credentials grant type
    - Assertion grant types
    - Choosing the appropriate grant type
- 6.2 Client deployments
    - Web applications
    - Browser applications
    - Native applications
    - Handling secrets

**Part 3 : OAuth 2 implementation and vulnerabilities**

7\. Common client vulnerabilities

- 7.1 General client security
- 7.2 **CSRF** attack against the client
- 7.3 Theft of client credentials
- 7.4 Registration of the redirect URI
    - Stealing the authorization code through the referrer
    - Stealing the token through an open redirector
- 7.5 Theft of authorization codes
- 7.6 Theft of tokens
- 7.7 Native applications best practices

8\. Common protected resources vulnerabilities

- 8.1 How are protected resources vulnerable?
- 8.2 Design of a protected resource endpoint
    - How to protect a resource endpoint
    - Adding implicit grant support
- 8.3 Token replays

9\. Common authorization server vulnerabilities

- 9.1 General security
- 9.2 **Session hijacking**
- 9.3 Redirect URI manipulation
- 9.4 Client impersonation
- 9.5 Open redirector

10\. Common OAuth token vulnerabilities

- 10.1 What is a **bearer token**?
- 10.2 Risks and considerations of using bearer tokens
- 10.3 How to protect bearer tokens
    - At the client
    - At the authorization server
    - At the protected resource
- 10.4 Authorization code
    - **Proof Key for Code Exchange (PKCE)**

**Part 4 : Taking OAuth further**

11\. OAuth tokens

- 11.1 What are OAuth tokens?
- 11.2 Structured tokens: **JSON Web Token (JWT)**
    - The structure of a JWT
    - JWT **claims**
    - Implementing JWT in our servers
    - User authentication with OAuth 2.0
- 11.3 Cryptographic protection of tokens: **JSON Object Signing and Encryption (JOSE)**
    - **Symmetric** signatures using HS256
    - **Asymmetric** signatures using RS256
    - Other token protection options
- 11.4 Looking up a token’s information online: token introspection
    - The introspection protocol
    - Building the introspection endpoint
    - **Introspecting**<!-- 内省? --> a token
    - Combining introspection and JWT
- 11.5 Managing the token **lifecycle** with token **revocation**
    - The token revocation protocol
    - Implementing the revocation endpoint
    - Revoking a token
- 11.6 The OAuth token lifecycle

12\. Dynamic client registration

- 12.1 How the server knows about the client
- 12.2 **Registering clients** at runtime
    - How the protocol works
    - Why use dynamic registration?
    - Implementing the registration endpoint
    - Having a client register itself
- 12.3 **Client metadata**
    - Table of core client metadata field names
    - Internationalization of human-readable client metadata
    - Software statements
- 12.4 Managing dynamically registered clients
    - How the management protocol works
    - Implementing the dynamic client registration management API

13\. User authentication with OAuth 2.0

- 13.1 Why OAuth 2.0 is not an authentication protocol
    - Authentication vs. authorization : a delicious metaphor<!-- 隐喻 -->
- 13.2 Mapping OAuth to an authentication protocol
- 13.3 How OAuth 2.0 uses authentication
- 13.4 Common pitfalls of using OAuth 2.0 for authentication
    - Access tokens as proof of authentication
    - Access of protected API as proof of authentication
    - Injection of access tokens
    - Lack of **audience** restriction
    - Injection of invalid user information
    - Different protocols for every potential identity provider
- 13.5 **OpenID Connect**: a standard for authentication and identity on top of OAuth 2.0
    - **ID tokens**
    - The **UserInfo** endpoint
    - **Dynamic server discovery** and client registration
    - Compatibility with OAuth 2.0
    - Advanced capabilities
- 13.6 Building a simple OpenID Connect system
    - Generating the ID token
    - Creating the UserInfo endpoint
    - Parsing the ID token
    - Fetching the UserInfo

14\. Protocols and profiles using OAuth 2.0

- 14.1 User Managed Access (UMA)
    - Why UMA matters
    - How the UMA protocol works
- 14.2 Health Relationship Trust (HEART)
    - Why HEART matters to you
    - The HEART specifications
    - HEART mechanical profiles
    - HEART semantic profiles
- 14.3 International Government Assurance (iGov)
    - Why iGov matters to you
    - The future of iGov

15\. Beyond bearer tokens

- 15.1 Why do we need more than bearer tokens?
- 15.2 **Proof of Possession (PoP)** tokens
    - Requesting and issuing a PoP token
    - Using a PoP token at a protected resource
    - Validating a PoP token request
- 15.3 Implementing PoP token support
    - Issuing the token and keys
    - Creating the signed header and sending it to the resource
    - Parsing the header, introspecting the token, and validating the signature
- 15.4 TLS token binding

16\. Summary and conclusions

- 16.1 The right tool
- 16.2 Making key decisions
- 16.3 The wider ecosystem
- 16.4 The community
- 16.5 The future

### Terminology

- credential : 凭据
    - credential sharing : 凭据共享
    - credential theft : 凭据盗用
- authorization delegation : 授权委托
- OAuth's actors : 角色
    - clients : 客户端
    - authorization servers : 授权服务器
    - resource owners : 资源拥有者
    - protected resources : 受保护资源
- OAuth's components : 组件
    - token : 令牌
        - access token : 访问令牌
        - refresh token : 刷新令牌
    - scopes : 权限范围
    - authorization grants : 授权许可
- issue a token : 颁发令牌
- token replays : 令牌重放?
- session hijacking : 会话劫持
- client impresonation : 客户端冒充

# Part 1 : First Steps

## 1. What is OAuth 2.0 and why should you care

### 1.1 What is OAuth 2.0?

OAuth 2.0 is a **delegation protocol**, a means of letting someone who controls a resource allow a software application to access that resource on their behalf without impersonating<!-- 冒充 --> them.

The application requests authorization from the owner of the resource and receives **tokens** that it can use to access the resource.

This all happens without the application needing to impersonate the person who controls the resource, since the token explicitly represents a delegated right of access.

……

We know that OAuth is a **security protocol**, but what exactly does it do?
… According to the specification that defines it:

> The OAuth 2.0 authorization framework enables a third-party application to obtain limited access to an HTTP service, either on behalf of<!-- 代表… --> a resource owner by orchestrating an approval interaction between the resource owner and the HTTP service, or by allowing the third-party application to obtain access on its own behalf.

…… as an **authorization framework**, OAuth is all about getting the right of access from one component of a system to another.
In particular, in the OAuth world, a client application wants to gain access to a protected resource on behalf of a resource owner (usually an **end user**).
These are the components that we have so far:

-   ……

-   The protected resource is the component that the resource owner has access to.
    This can take many different forms, but for the most part it's a web API of some kind.
    Even though the name "resource" makes it sound as though this is something to be downloaded, these APIs can allow read, write, and other operations just as well.
    ……

-   The client is the piece of software that accesses the protected resource on behalf of the resource owner.

    - If you're a web developer, the name "client" might make you think this is the web browser, but that's not how the term is used here.
    - If you're a business application developer, you might think of the "client" as the person who's paying for your services, but that's not what we're talking about, either.

    **In OAuth, the client is whatever software consumes the API that makes up the protected resource.**
    ……
    This is partially in deference to the fact that there are many different forms of client applications, ……, so no one icon will universally suffice.

### 1.2 The bad old days: credential sharing (and credential theft)

……

> **Lightweight Directory Access Protocol (LDAP)** authentication
>
> Interestingly, this pattern is exactly how password-vault authentication technologies such as LDAP function.
> **When using LDAP for authentication, a client application collects credentials directly from the user and then replays these credentials to the LDAP server to see whether they're valid.**
> The client system must have access to the plaintext password of the user during the transaction; otherwise, it has no way of verifying it with the LDAP server.
> In a very real sense, this method is a form of **man-in-the-middle attack** on the user, although one that’s generally benevolent in nature.

For those situations in which it does work, it exposes the user's primary credentials to a potentially untrustworthy application, the client.

**To continue to act as the user, the client has to store the user's password in a replayable fashion** ( often in plaintext or a reversible encryption mechanism ) **for later use at the protected resource.**
If the client application is ever compromised<!-- 被攻破 -->, the attacker gains access not only to the client but also to the protected resource, as well as any other service where the end user may have used the same password.

Furthermore, in both of these approaches, the client application is impersonating<!-- 扮演 --> the resource owner, and the protected resource has no way of distinguishing a call directly from the resource owner from a call being directed through a client.

……

Another common approach is to use a **developer key** issued to the client, which uses this to call the protected resource directly. ……

This has the benefit of not exposing the user's credentials to the client, but at the cost of the client requiring a highly powerful credential.

……

Another possible approach is to **give users a special password** that's only for sharing with third-party services.
Users don't use this password to log in themselves, but paste it into applications that they want to work for them. ……

However, the usability of such a system is, on its own, not very good.
This requires the user to generate, distribute, and manage these special credentials in addition to the primary passwords they already must curate.
Since it's the user who must manage these credentials, there is also, generally speaking, no correlation between the client program and the credential itself.
This makes it difficult to revoke access to a specific application.

……

### 1.3 Delegating access

OAuth is a protocol designed to do exactly that :
in OAuth, the end user **delegate**s some part of their authority to access the protected resource to the client application to act on their behalf.

To make that happen, OAuth introduces another component into the system :
the **authorization server**.

The authorization server (AS) is trusted by the protected resource to issue special-purpose security credentials — called **OAuth access tokens** — to clients.
To acquire a token, the client first sends the resource owner to the authorization server in order to request that the resource owner authorize this client.
The resource owner authenticates to the authorization server and is generally presented with a choice of whether to authorize the client making the request.
The client is able to ask for a subset of functionality, or **scopes**, which the resource owner may be able to further diminish.
Once the authorization grant has been made, the client can then request an access token from the authorization server.
This access token can be used at the protected resource to access the API, as granted by the resource owner.

At no time<!-- 从不 --> in this process are the resource owner's credentials exposed to the client :
the resource owner authenticates to the authorization server separately from anything used to communicate with the client.
Neither does the client have a high-powered developer key :
the client is unable to access anything on its own and instead must be authorized by a valid resource owner before it can access any protected resources.
_This is true even though most OAuth clients have a means of authenticating themselves to the authorization server._

<!-- 妙处 -->
_The user generally never has to see or deal with the access token directly._
_Instead of requiring the user to generate tokens and paste them into clients, the OAuth protocol facilitates this process and makes it relatively simple for the client to request a token and the user to authorize the client._
_Clients can then manage the tokens, and users can manage the client applications._

……

<!-- TODO : 考虑自己用 plantuml 画一个完整的 OAuth 工作过程 -->
<!-- The OAuth process, at a high level -->

#### 1.3.1. Beyond HTTP Basic and the password-sharing antipattern

……

How did HTTP APIs become password-protected in the first place?

The history of the HTTP protocol and its security methods is enlightening<!-- 有启迪的 -->.
The HTTP protocol defines a mechanism whereby a user in a browser is **able to authenticate to a web page using a username and password over a protocol known as HTTP Basic Auth**.
There is also a slightly more secure version of this, known as **HTTP Digest Auth**, but for our purposes they are interchangeable<!-- 可互换的, 即没什么区别的 --> as both assume the presence of a user and effectively require the presentation of a username and password to the HTTP server.
_Additionally, because HTTP is a stateless protocol, it's assumed that these credentials will be presented again on every single transaction._

This all makes sense in light of **HTTP's origins as a document access protocol**, but the web has grown significantly in both scope and breadth of use since those early days. ……
_But as a consequence, when HTTP started to be used for direct-access APIs in addition to user-facing services, its existing security mechanisms were quickly adopted for this new use case._ ……

**OAuth** was designed from the outset<!-- 开端 --> **as a protocol for use with APIs**, wherein<!-- 在其中 --> the main interaction is outside of the browser.
_It usually has an end user in a browser to start the process, and indeed this is where the flexibility and power in the delegation model comes from, but the final steps of receiving the token and using it at a protected resource lie outside the view of the user._

#### 1.3.2. Authorization delegation: why it matters and how it’s used

Fundamental to the power of OAuth is the notion of **delegation**.
Although OAuth is often called an **authorization protocol**
(and this is the name given to it in the RFC which defines it), it is a **delegation protocol**.
_Generally, a subset of a user's authorization is delegated, but OAuth itself doesn't carry or convey the authorizations._
_Instead, it provides a means by which a client can request that a user delegate some of their authority to it._
_The user can then approve this request, and the client can then act on it with the results of that approval._

……

#### 1.3.3. User-driven security and user choice

### 1.4 OAuth 2.0: the good, the bad, and the ugly

### 1.5 What OAuth 2.0 isn't

## 2. The OAuth dance

- 2.1 Overview of the OAuth 2.0 protocol: getting and using tokens
- 2.2 Following an OAuth 2.0 authorization grant in detail
- 2.3 OAuth’s actors:
    - **clients**,
    - **authorization servers**,
    - **resource owners**, and
    - **protected resources**
- 2.4 OAuth's components:
    - **Access tokens**
    - **Scopes**
    - **Refresh tokens**
    - **Authorization grants**
- 2.5 Interactions between OAuth’s actors and components: back channel, front channel, and endpoints
    - Back-channel communication
    - Front-channel communication

# Part 2 : Building an OAuth 2 environment

## 3. Building a simple OAuth client

This chapter covers

- _Registering an OAuth client with an authorization server and configuring the client to talk to the authorization server_
- _Requesting authorization from a resource owner using the authorization code grant type_
- _Trading the authorization code for a token_
- _Using the access token as a bearer token with a protected resource_
- _Refreshing an access token_

### 3.1 Register an OAuth client with an authorization server

_First things first : the OAuth client and the authorization server need to know a few things about each other before they can talk. ……_
_An OAuth client is identified by a special string known as the client identifier, referred to in our exercises and in several parts of the OAuth protocol with the name `client_id`._
**The client identifier needs to be unique for each client at a given authorization server**, and is therefore almost always assigned by the authorization server to the client.
**This assignment could happen through a developer portal<!-- 开发者门户 -->, dynamic client registration**, or through some other process.  ……

……

Our client is also what's known as a **confidential client**<!-- 保密客户端 --> in the OAuth world, which means that **it has a shared secret that it stores in order to authenticate itself when talking with the authorization server**, known as the `client_secret`.
The `client_secret` can be passed to the authorization server's token endpoint in several different ways, …… .
**The `client_secret` is also nearly always assigned by the authorization server**, …… .

……

_In this exercise,_ our client needs to know the locations of both the **authorization endpoint** and the **token endpoint**, but it doesn't really need to know anything about the server beyond that. ……

```js
var authServer = {
   authorizationEndpoint: 'http://localhost:9001/authorize',
   tokenEndpoint: 'http://localhost:9001/token'
};
```

……

### 3.2 Get a token using the authorization code grant type

……

#### 3.2.1 Sending the authorization request

……

#### 3.2.2 Processing the authorization response

……

Now we need to take this authorization code and send it directly to the token endpoint using an HTTP POST _( to get the access token )_ .

_We'll include the code as a form parameter in the request body._

```js
var form_data = qs.stringify({ grant_type: 'authorization_code',
    code: code,
    redirect_uri: client.redirect_uris[0]
});
```

As an aside, why do we include the `redirect_uri` in this call?
We're not redirecting anything, after all.
According to the OAuth specification, **if the redirect URI is specified in the authorization request, that same URI must also be included in the token request**.
This practice **prevents an attacker from using a compromised redirect URI with an otherwise well-meaning client by injecting an authorization code from one session into another.** ……

_We also need to send a few headers to tell the server that this is an HTTP form-encoded request, as well as authenticate our client using HTTP Basic._
The **`Authorization` header in HTTP Basic is a base64 encoded string made by concatenating the username and password together, separated by a single colon (`:`) character.**
**OAuth 2.0 tells us to use the client ID as the username and the client secret as the password**, but with each of these being URL encoded first. ……

```js
var headers = {
    'Content-Type': 'application/x-www-form-urlencoded',
    'Authorization': 'Basic ' + encodeClientCredentials(
        client.client_id,
        client.client_secret
    )
};
```

……

#### 3.2.3 Adding cross-site protection with the **state** parameter

### 3.3 Use the token with a protected resource

### 3.4 Refresh the access token

## 4. Building a simple OAuth protected resource

- 4.1 Parsing the OAuth token from the HTTP request
- 4.2 Validating the token against our data store
- 4.3 Serving content based on the token
    - Different scopes for different actions
    - Different scopes for different data results
    - Different users for different data results
    - Additional access controls

## 5. Building a simple OAuth authorization server

- 5.1 Managing OAuth client registrations
- 5.2 Authorizing a client
    - The authorization endpoint
    - Authorizing the client
- 5.3 Issuing a token
    - Authenticating the client
    - Processing the authorization grant request
- 5.4 Adding refresh token support
- 5.5 Adding scope support

## 6. OAuth 2.0 in the real world

- 6.1 Authorization **grant types**
    - Implicit grant type
    - Client credentials grant type
    - Resource owner credentials grant type
    - Assertion grant types
    - Choosing the appropriate grant type
- 6.2 Client deployments
    - Web applications
    - Browser applications
    - Native applications
    - Handling secrets

# Part 3 : OAuth 2 implementation and vulnerabilities

## 7. Common client vulnerabilities

- 7.1 General client security
- 7.2 **CSRF** attack against the client
- 7.3 Theft of client credentials
- 7.4 Registration of the redirect URI
    - Stealing the authorization code through the referrer
    - Stealing the token through an open redirector
- 7.5 Theft of authorization codes
- 7.6 Theft of tokens
- 7.7 Native applications best practices

## 8. Common protected resources vulnerabilities

- 8.1 How are protected resources vulnerable?
- 8.2 Design of a protected resource endpoint
    - How to protect a resource endpoint
    - Adding implicit grant support
- 8.3 Token replays

## 9. Common authorization server vulnerabilities

- 9.1 General security
- 9.2 **Session hijacking**
- 9.3 Redirect URI manipulation
- 9.4 Client impersonation
- 9.5 Open redirector

## 10. Common OAuth token vulnerabilities

- 10.1 What is a **bearer token**?
- 10.2 Risks and considerations of using bearer tokens
- 10.3 How to protect bearer tokens
    - At the client
    - At the authorization server
    - At the protected resource
- 10.4 Authorization code
    - **Proof Key for Code Exchange (PKCE)**

# Part 4 : Taking OAuth further

## 11. OAuth tokens

- 11.1 What are OAuth tokens?
- 11.2 Structured tokens: **JSON Web Token (JWT)**
    - The structure of a JWT
    - JWT **claims**
    - Implementing JWT in our servers
    - User authentication with OAuth 2.0
- 11.3 Cryptographic protection of tokens: **JSON Object Signing and Encryption (JOSE)**
    - **Symmetric** signatures using HS256
    - **Asymmetric** signatures using RS256
    - Other token protection options
- 11.4 Looking up a token’s information online: token introspection
    - The introspection protocol
    - Building the introspection endpoint
    - **Introspecting**<!-- 内省? --> a token
    - Combining introspection and JWT
- 11.5 Managing the token **lifecycle** with token **revocation**
    - The token revocation protocol
    - Implementing the revocation endpoint
    - Revoking a token
- 11.6 The OAuth token lifecycle

## 12. Dynamic client registration

- 12.1 How the server knows about the client
- 12.2 **Registering clients** at runtime
    - How the protocol works
    - Why use dynamic registration?
    - Implementing the registration endpoint
    - Having a client register itself
- 12.3 **Client metadata**
    - Table of core client metadata field names
    - Internationalization of human-readable client metadata
    - Software statements
- 12.4 Managing dynamically registered clients
    - How the management protocol works
    - Implementing the dynamic client registration management API

## 13. User authentication with OAuth 2.0

- 13.1 Why OAuth 2.0 is not an authentication protocol
    - Authentication vs. authorization : a delicious metaphor<!-- 隐喻 -->
- 13.2 Mapping OAuth to an authentication protocol
- 13.3 How OAuth 2.0 uses authentication
- 13.4 Common pitfalls of using OAuth 2.0 for authentication
    - Access tokens as proof of authentication
    - Access of protected API as proof of authentication
    - Injection of access tokens
    - Lack of **audience** restriction
    - Injection of invalid user information
    - Different protocols for every potential identity provider
- 13.5 **OpenID Connect**: a standard for authentication and identity on top of OAuth 2.0
    - **ID tokens**
    - The **UserInfo** endpoint
    - **Dynamic server discovery** and client registration
    - Compatibility with OAuth 2.0
    - Advanced capabilities
- 13.6 Building a simple OpenID Connect system
    - Generating the ID token
    - Creating the UserInfo endpoint
    - Parsing the ID token
    - Fetching the UserInfo

## 14. Protocols and profiles using OAuth 2.0

- 14.1 User Managed Access (UMA)
    - Why UMA matters
    - How the UMA protocol works
- 14.2 Health Relationship Trust (HEART)
    - Why HEART matters to you
    - The HEART specifications
    - HEART mechanical profiles
    - HEART semantic profiles
- 14.3 International Government Assurance (iGov)
    - Why iGov matters to you
    - The future of iGov

## 15. Beyond bearer tokens

- 15.1 Why do we need more than bearer tokens?
- 15.2 **Proof of Possession (PoP)** tokens
    - Requesting and issuing a PoP token
    - Using a PoP token at a protected resource
    - Validating a PoP token request
- 15.3 Implementing PoP token support
    - Issuing the token and keys
    - Creating the signed header and sending it to the resource
    - Parsing the header, introspecting the token, and validating the signature
- 15.4 TLS token binding

## 16. Summary and conclusions

- 16.1 The right tool
- 16.2 Making key decisions
- 16.3 The wider ecosystem
- 16.4 The community
- 16.5 The future
