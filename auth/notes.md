# Auth\* Notes

## Authorization & Authentication

-   Authorization (AuthZ): 访问者是谁
-   Authentication (AuthN): 访问者访问资源时是否有对应的权限

## Authorization flow

OAuth 2.0 协议，主要解决的一个问题：

-   用户授权第三方应用访问另一应用的资源
-   避免将用户的账号和密码泄露给第三方
    -   不需要第三方应用记住用户账号和密码
    -   保证安全性 _（只要用安全性最高的 authorization flow）_

## OIDC

OIDC: Open ID Connect
