# Auth\* Notes

## Authentication

Authentication 认证，解决两个问题：

-   访问者是谁
-   访问者访问资源时是否有对应的权限

## Authorization

OAuth 2.0 协议，主要解决的一个问题：

-   用户授权第三方应用访问另一应用的资源
-   避免将用户的账号和密码泄露给第三方
    -   不需要第三方应用记住用户账号和密码
    -   保证安全性 _（只要用安全性最高的 authorization flow）_

## OIDC

OIDC: Open ID Connect

## Usage

### SPA

Single Page Application

-   第三方应用（此处为 SPA 即 frontend）（做好一系列准备后）跳转到第一方应用，让用户登录
-   用户登录并授权后，第一方应用返回（并非账号和密码的）授权码到第三方应用（frontend）
-   第三方应用（frontend）通过授权码获取刷新令牌、访问令牌，代表用户访问第一方应用的资源

### SSR

Server Side Rendering

-   第三方应用（此处为 SSR 即 backend）（做好一系列准备后）跳转到第一方应用，让用户登录
-   用户登录并授权后，第一方应用返回（并非账号和密码的）授权码到第三方应用得服务器（backend）
-   第三方应用（backend）通过授权码获取刷新令牌、访问令牌，代表用户访问第一方应用的资源

### Pure Backend?

还是基于原来其他语言的 SDK 高发来

# 用户需要一个怎样 Java SDKs?

做完简单的 sample demo 之后，我看了看 Auth0 的 SDK 和 sample，发现粗略上有三种

-   Java Servlet Application
-   Spring Boot using Security
    -   但看起来只使用 OAuth 2.0，
        只解决了用户是谁的问题，没有解决用户有什么权限的问题 (accessTokenMap)
-   Java EE 看不太懂，背后的意义，要仔细看看文档

---

-   Java Servlet API
    -   给予

# Others

## Protect your API using Spring Security 5 and Logto

-   保护你的 API 也需要 SDK 吧？
    -   当前其他语言的 SDK 也没有实现这个场景，也没有对应 sample；
    -   当前各个语言的 SDK 只是提供了 `getAccessToken(resources)`，
        然后需要用户根据文档 [保护你的 API](https://docs.logto.io/zh-cn/docs/recipes/protect-your-api/)
        中的 sample 自行实现。
    -   参考 [Backend/API - Auth0](https://auth0.com/docs/quickstart/backend/java-spring-security5/interactive): how to protected an API or service

Secure your API using Spring Security 5 and Auth0
