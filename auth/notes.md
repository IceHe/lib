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

迷茫中
