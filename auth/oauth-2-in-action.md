# OAuth 2 in Action

---

References

- 《OAuth 2 in Action》Justin Richer

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
    - Authorization delegation: why it matters and how it's used
    - User-driven security and user choice
- 1.4 OAuth 2.0: the good, the bad, and the ugly
- 1.5 What OAuth 2.0 isn't

2\. The OAuth dance

- 2.1 Overview of the OAuth 2.0 protocol: getting and using tokens
- 2.2 Following an OAuth 2.0 authorization grant in detail
- 2.3 OAuth's actors:
    - **clients**,
    - **authorization servers**,
    - **resource owners**, and
    - **protected resources**
- 2.4 OAuth's components:
    - **Access tokens**
    - **Scopes**
    - **Refresh tokens**
    - **Authorization grants**
- 2.5 Interactions between OAuth's actors and components: back channel, front channel, and endpoints
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
- 11.4 Looking up a token's information online: token introspection
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
> In a very real sense, this method is a form of **man-in-the-middle attack** on the user, although one that's generally benevolent in nature.

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

#### 1.3.2. Authorization delegation: why it matters and how it's used

Fundamental to the power of OAuth is the notion of **delegation**.
Although OAuth is often called an **authorization protocol**
(and this is the name given to it in the RFC which defines it), it is a **delegation protocol**.
_Generally, a subset of a user's authorization is delegated, but OAuth itself doesn't carry or convey the authorizations._
_Instead, it provides a means by which a client can request that a user delegate some of their authority to it._
_The user can then approve this request, and the client can then act on it with the results of that approval._

……

#### 1.3.3. User-driven security and user choice

……

OAuth systems often follow the principle of **TOFU - Trust On First Use**.

In a TOFU model, the first time a security decision needs to be made at runtime, and there is no existing context or configuration under which the decision can be made, the user is prompted.
This can be as simple as "Connect a new application?" although many implementations allow for greater control during this step.
_Whatever the user experience here, the user with appropriate authority is allowed to make a security decision._
The system offers to remember this decision for later use.
In other words, the first time an authorization context is met, the system can be directed to trust the user's decision for later processing :
Trust On First Use.

> **Do I have to eat my TOFU?**<!-- TOFU 是强制要求吗? -->
>
> The Trust On First Use (TOFU) method of managing security decisions is not required by OAuth implementations, but it's especially common to find these two technologies together.
>
> Why is that?
> **The TOFU method strikes a good balance between the flexibility of asking end users to make security decisions in context and the fatigue<!-- 疲劳, 疲乏 --> of asking them to make these decisions constantly.**
>
> Without the "Trust" portion of TOFU, users would have no say in how these delegations are made.
> **Without the "On First Use" portion of TOFU, users would quickly become numb to an unending bar- rage of access requests.**
> This kind of security system fatigue breeds<!-- 引起 --> workarounds that are usually more insecure than the practices that the security system is attempting to address.
> <!-- 这种由安全系统造成的疲劳感会引起工作懈怠, 遮蔽安全系统原本要解决的问题更危险. -->

……

Whitelist

- Contains
    - Internal parties
    - Known business partners
    - Customer organizations
    - Trust frameworks
- How to deal with
    - Centralized control
    - Traditional policy management

Graylist

- Contains
    - Unknown entities
    - Trust On First Use
- How to deal with
    - End user decisions
    - Extensive auditing and logging
    - Rules on when to move to the white or black lists

Blacklist

- Contains
    - Known bad parties
    - Attack sites
- How to deal with
    - Centralized control
    - Traditional policy management

### 1.4 OAuth 2.0: the good, the bad, and the ugly

Auth 2.0 is very good at capturing a user delegation decision and expressing that across the network. ……

One key assumption in the design of OAuth 2.0 was that there would always be several orders of magnitude more clients in the wild than there would be authorization servers or protected resource servers.
**This makes sense, as a single authorization server can easily protect multiple resource servers, and there are likely to be many different kinds of clients wanting to consume any given API.**
An authorization server can even have several different classes of clients that are trusted at differ- ent levels, …….
As a consequence of this architectural decision, wherever possible, **complexity is shifted away from clients and onto servers.**
This is good for client developers, as the client becomes the simplest piece of software in the system.
Client developers no longer have to deal with signature normalizations or parsing complicated security policy documents, as they would have in previous security protocols, and they no longer have to worry about handling sensitive user credentials.
OAuth tokens provide a mechanism that's only slightly more complex than passwords but significantly more secure when used properly.

……

### 1.5 What OAuth 2.0 isn't

……

**OAuth isn't defined outside of the HTTP protocol.**
Since **OAuth 2.0 with bearer tokens provides no message signatures**, it is not meant to be used outside of HTTPS (HTTP over TLS). ……

**OAuth isn't an authentication protocol**, even though it can be used to build one. ……

**OAuth doesn't define a mechanism for user-to-user delegation**, even though it is fundamentally about delegation of a user to a piece of software.
OAuth assumes that the resource owner is the one that's controlling the client.
In order for the resource owner to authorize a different user, more than OAuth is needed.<!-- 仅使用 OAuth 是不行的 -->
This kind of delegation is not an uncommon use case, and the User Managed Access protocol uses OAuth to create a system capable of user-to-user delegation.

**OAuth doesn't define authorization-processing mechanisms.**
OAuth provides a means to convey the fact that an authorization delegation has taken place, but it doesn't define the contents of that authorization.  ……

**OAuth doesn't define a token format.** ……
Desire for interoperability at this level has led to the development of the **JSON Web Token (JWT)** format and the Token Introspection protocol. ……

**OAuth 2.0 defines no cryptographic methods**, ……

**Auth 2.0 is also not a single protocol.**
As discussed previously, the specification is split into multiple definitions and flows, each of which has its own set of use cases.

---

1.6 Summary

OAuth is a widely used security standard that enables secure access to protected resources in a fashion that's friendly to web APIs.

- OAuth is about **how to get a token** and **how to use a token**.
- OAuth is a **delegation protocol that provides authorization across systems**.
- OAuth **replaces the password-sharing antipattern with a delegation protocol** _that's simultaneously more secure and more usable._
- OAuth is focused on solving a small set of problems and solving them well, which makes it a suitable component within larger security systems.

## 2. The OAuth dance

### 2.1 Overview of the OAuth 2.0 protocol: getting and using tokens

……

### 2.2 Following an OAuth 2.0 authorization grant in detail

……

<!-- TODO : 考虑自己用 plantuml 画一个完整的 授权码许可 的详细过程 -->
<!-- The authoriation code grant in detail -->

……

The web client ( localhost:9000 ) redirects to the authorization server's authorization endpoint ( localhost:9001 ) .

_Client HTTP Request :_

```http
HTTP/1.1 302 Moved Temporarily
x-powered-by: Express
Location: http://localhost:9001/authorize?response_type=code&scope=foo&client_id=oauth-client-1&redirect_uri=http%3A%2F%2Flocalhost%3A9000%2Fcallback& state=Lwt50DDQKUB8U7jtfLQCVGDL9cnmwHH1
Vary: Accept
Content-Type: text/html; charset=utf-8
Content-Length: 444
Date: Fri, 31 Jul 2015 20:50:19 GMT
Connection: keep-alive
```

This redirect to the browser causes the browser to send an HTTP GET to the authorization server.

_Browser HTTP Request :_

```http
GET /authorize?response_type=code&scope=foo&client_id=oauth-client-1&redirect_uri=http%3A%2F%2Flocalhost%3A9000% 2Fcallback&state=Lwt50DDQKUB8U7jtfLQCVGDL9cnmwHH1 HTTP/1.1
Host: localhost:9001
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:39.0) Gecko/20100101 Firefox/39.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Referer: http://localhost:9000/
Connection: keep-alive
```

……

Next, the authorization server redirects the user back to the client application.
This takes the form of an HTTP redirect to the client's `redirect_uri`.

_AuthServer HTTP Response :_

```http
HTTP 302 Found
Location: http://localhost:9000/oauth_callback?code=8V1pr0rJ&state=Lwt50DDQKUB8U7jtfLQCVGDL9cnmwHH1
```

……

This in turn causes the browser to issue the following request back to the client.

_Browser HTTP Request :_

```http
GET /callback?code=8V1pr0rJ&state=Lwt50DDQKUB8U7jtfLQCVGDL9cnmwHH1 HTTP/1.1 Host: localhost:9000
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:39.0) Gecko/20100101 Firefox/39.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Referer: http://localhost:9001/authorize?response_type=code&scope=foo&client_id=oauth-client-1&redirect_uri=http%3A%2F%2Flocalhost%3A9000%2Fcallback&state=Lwt50DDQKUB8U7jtfLQCVGDL9cnmwHH1
Connection: keep-alive
```

……

The client performs an HTTP POST with its parameters as a form-encoded HTTP entity body, **passing its `client_id` and `client_secret` as an HTTP Basic authorization header**.
This HTTP request is made directly between the client and the authorization server, without involving the browser or resource owner at all.

_Client HTTP Request :_

```http
POST /token
Host: localhost:9001
Accept: application/json
Content-type: application/x-www-form-encoded
Authorization: Basic b2F1dGgtY2xpZW50LTE6b2F1dGgtY2xpZW50LXNlY3JldC0x

grant_type=authorization_code&redirect_uri=http%3A%2F%2Flocalhost%3A9000%2Fcallback&code=8V1pr0rJ
```

……

This token is returned in the HTTP response as a JSON object.

_AuthServer HTTP Response :_

```http
HTTP 200 OK
Date: Fri, 31 Jul 2015 21:19:03 GMT
Content-type: application/json
{
    "access_token": "987tghjkiu6trfghjuytrghj",
    "token_type": "Bearer"
}
```

……

The right to bear tokens
The core OAuth specifications deal with bearer tokens, which means that anyone who carries the token has the right to use it. All of our examples throughout the book will use bearer tokens, except where specifically noted. Bearer tokens have particu- lar security properties, which are enumerated in chapter 10, and we'll take a look ahead at nonbearer tokens in chapter 15.

……

> **The right to bear tokens**
>
> The core OAuth specifications deal with **bearer** tokens, which means that anyone who carries the token has the right to use it. ……
> **Bearer tokens have particular security properties**, ……

With the token in hand, the client can **present the token to the protected resource**.

The client has several methods for presenting the access token, and in this example we're going to use the recommended method of **using the `Authorization` header**.

```http
GET /resource HTTP/1.1
Host: localhost:9002
Accept: application/json
Connection: keep-alive
Authorization: Bearer 987tghjkiu6trfghjuytrghj
```

### 2.3 OAuth's actors

- **clients**,
- **authorization servers**,
- **resource owners**, and
- **protected resources**

### 2.4 OAuth's components

#### Access tokens

OAuth tokens are opaque to the client, which means that the **client has no need (and often no ability) to look at the token itself**. <!-- 无法也不需要查看令牌内容 -->
The client's job is to carry the token, requesting it from the authorization server and presenting it to the protected resource. ……
This approach **allows the client to be much simpler than** it would otherwise need to be<!-- 使它简单得多 -->, as well as giving the authorization server and protected resource incredible flexibility in how these tokens are deployed.

#### Scopes

**An OAuth scope is a representation of a set of rights at a protected resource**.
**Scopes are represented by strings in the OAuth protocol, and they can be combined into a set by using a space-separated list.** ……

……

( e.g. ) …… The photo-storage service's API defines several different scopes for accessing the photos :

- read-photo,
- read-metadata,
- update-photo,
- update-metadata,
- create, _and_
- delete.

#### Refresh tokens

…… What's different, though, is that the token is never sent to the protected resource.
Instead, the client uses the refresh token to request new access tokens with- out involving the resource owner.

……

**Refresh tokens also give the client the ability to down-scope its access.**
If a client is granted scopes A, B, and C, but it knows that it needs only scope A to make a particular call, it can use the refresh token to request an access token for only scope A.
This lets a smart client **follow the security principle of least privilege** without burdening less-smart clients with trying to figure out what privileges an API needs.

#### Authorization grants

…… This is likely one of the most confusing terms in OAuth 2.0, because the term is used to define both the specific mechanism by which the user delegates authority as well as the act of delegation itself. ……

### 2.5 Interactions between OAuth's actors and components: back channel, front channel, and endpoints

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

_In the current setup, any time someone comes to http://localhost:9000/ callback,_ the client will naively take in the input code value and attempt to post it to the authorization server.
This would mean that **an attacker could use our client to fish for<!-- 意译? 暴力搜索 --> valid authorization codes at the authorization server, wasting both client and server resources and potentially causing our client to fetch a token it never requested.**

We can **mitigate<!-- 使缓和, 使减轻 --> this by using an optional OAuth parameter called `state`**, which we'll fill with a **random value** and save to a variable on our application.

……

It's important that this value be saved to a place in our application that will still be available when the call to the `redirect_uri` comes back.
_Remember, since we're using the front channel to communicate in this stage, once we send the redirect to the authorization endpoint, our client application cedes control of the OAuth protocol until this return call happens._
We'll also need to **add the state to the list of parameters sent on the authorization URL**.

……

**When the authorization server receives an authorization request with the state parameter, it must always return that state parameter unchanged to the client alongside the authorization code.**
This means that **we can check the state value that's passed in to the `redirect_uri` page and compare it to our saved value from earlier**.
**If it doesn't match, we'll display an error to the end user.**

……

If the `state` value doesn't match what we're expecting, that's a very good indication that something untoward is happening, such as a **session fixation attack**<!-- 会话固化攻击 -->, **fishing for a valid authorization code**<!-- 暴力搜索授权码 -->, or other shenanigans<!-- 诡计 -->. ……

### 3.3 Use the token with a protected resource

All the client has to do is make a call to the protected resource and include the access token in one of the three valid locations.
For our client, we'll **send the access token in the Authorization HTTP header**, **which is the method recommended by the specification wherever possible**.

> **Ways to send a bearer token**
>
> The kind of OAuth access token that we have is known as a **bearer token**, which means that **whoever holds the token can present it to the protected resource**.
> The OAuth Bearer Token Usage specification actually gives three ways to send the token value:
>
> - As an HTTP Authorization header
> - As a form-encoded request body parameter
> - As a URL-encoded query parameter
>
> The Authorization header is recommended whenever possible because of limitations in the other two forms.
>
> - **When using the query parameter, the value of the access token can possibly inadvertently leak into server-side logs, because it's part of the URL request.**
> - Using the form-encoded parameter limits the input type of the protected resource to using form-encoded parameters and the POST method.
>   If the API is already set up to do that, this can be fine as it doesn't experience the same security limitations that the query parameter does.
>
> The Authorization header provides the maximum flexibility and security of all three methods, but it has the downside of being more difficult for some clients to use.
> A robust client or server library will provide all three methods where appropriate, _and in fact our demonstration protected resource will accept an access token in any of the three locations._

……

### 3.4 Refresh the access token

> **Is my token any good?**
>
> How does an OAuth client know whether its access token is any good?
>
> The only real way to be sure is to **use it and see what happens**.
> If the token is expected to expire, the authorization server can give a hint as to the expected expiration by using the optional expires_in field of the token response.
> This is a value in seconds from the time of token issuance that the token is expected to no longer work.
> A well-behaved client will pay attention to this value and throw out any tokens that are past the expiration time.
>
> However, knowledge of the expiration alone isn't sufficient for a client to know the status of the token.
> In many OAuth implementations, the resource owner can revoke the token before its expiration time.
> A well-designed OAuth client must always expect that its access token could suddenly stop working at any time, and be able to react accordingly.

……

_Inside the `refreshAccessToken` function, we create a request to the token end- point, much like we did before._
As you can see, refreshing an access token is a special case of an authorization grant, and we **use the value `refresh_token` for our `grant_type` parameter**.
We also include our refresh token as one of the parameters.

```js
var form_data = qs.stringify({
   grant_type: 'refresh_token',
   refresh_token: refresh_token
});
var headers = {
   'Content-Type': 'application/x-www-form-urlencoded',
   'Authorization': 'Basic ' + encodeClientCredentials(client.client_id,
   client.client_secret)
};
var tokRes = request('POST', authServer.tokenEndpoint, {
       body: form_data,
       headers: headers
});
```

## 4. Building a simple OAuth protected resource

### 4.1 Parsing the OAuth token from the HTTP request

……

### 4.2 Validating the token against our data store

……

> **Do I have to share my database?**
>
> Although working with a shared database is a very common OAuth deployment pattern, it's far from the only one available to you.
> There's a standardized web protocol called **Token Introspection** that the authorization server can offer, **allowing the resource server to check the token's state at runtime**.
> This lets the resource server treat the token itself as opaque, just like the client does, at the expense of more network traffic.
> Alternatively, or even additionally, **the tokens themselves can contain information that the protected resource can parse and understand directly**.
> One such structure is a **JSON Web Token, or JWT, which carries a set of claims in a cryptographically protected JSON object**. ……
>
> _You may also wonder whether you have to store your tokens as raw values in the database, as our example setup does._
> _Although this is a simple and common approach, there are alternatives._
> _For example,_ you can store a hash of the token value instead of the value itself, similar to how user passwords are usually stored.
> When the token needs to be looked up, its value is hashed again and compared against the contents of the database.
> You could instead add a unique identifier inside your token and sign it with the server's key, storing only the unique identifier in the database.
> When the token must be looked up, the resource server can validate the signature, parse the token to find the identifier, and look up the identifier in the database to find the token's information.

……

### 4.3 Serving content based on the token

……

- Different scopes for different actions
- Different scopes for different data results
- Different users for different data results
- Additional access controls

……

## 5. Building a simple OAuth authorization server

……

### 5.1 Managing OAuth client registrations

……

### 5.2 Authorizing a client

……

-   The authorization endpoint
-   Authorizing the client

    …… when we set up the client to pass a `state` parameter to the server for the client's own protection?

    Now that we're on the other end of the transaction, we need to pass through the `state` parameter exactly as it was sent to us.
    **Even though clients aren't required to send the state value, the server is always required to send it back if one was sent in**.

……

### 5.3 Issuing a token

……

#### 5.3.1 Authenticating the client

……

#### 5.3.2 Processing the authorization grant request

……

Notice that **as soon as we know the code is a valid one, we remove it from storage**, regardless of the rest of the processing.
We do this to err on the side of caution<!-- 出于安全考虑 -->, because a stolen authorization code presented by a bad client should be considered lost.
Even if the right client shows up later with the authorization code, the authorization code won't work, as we know it has already been compromised. ……

……

…… You can store your tokens into a full-scale database; for a little added security, you **can store a cryptographic hash of the token value so that if your database is compromised, the tokens themselves aren't lost**.

Alternatively, your resource server could use **<u>token introspection</u><!-- 内省 --> to look up information about the token back at the authorization server without the need for a shared database**.
Or, if you can't store them ( or don't want to ) , you can **use a structured format to bake all the necessary information into the token itself for the protected resource to consume later without needing to look it up**.

……

### 5.4 Adding refresh token support

……

The `token_type` parameter
( along with the `expires_in` and `scope` parameters, when they're sent )
applies only to the access token and not the refresh token, and there are no equivalents for the refresh token.
**The refresh token is still allowed to expire, but since refresh tokens are intended to be fairly long lived, the client isn't given a hint about when that would happen**.
When a refresh token no longer works, a client has to fall back on whatever regular OAuth authorization grant it used to get the access token in the first place, such as the authorization code grant.

……

Now we have to make sure that the token was issued to the client that authenticated at the token endpoint.
If we don't make this check, then a malicious client could steal a good client's refresh token and use it to get new, completely valid ( but fraudulent<!-- 欺骗的 --> ) access tokens for itself that look like they came from the legitimate client.
We also **remove the refresh token from our store, since we can assume that it's been compromised**.

……

When a refresh token is used, the **authorization server is free to issue a new refresh token to replace it**.
The authorization server **can also decide to throw out all active access tokens that were issued to the client up until the time the refresh token was used**. ……

<!-- icehe : 当 refresh token 被使用时, 授权服务器可以自己选择使用之前生成的未过期的 access token, 也可以废弃掉之前所有的有效的 access token 然后生成并返回新的有效的 access token. -->

### 5.5 Adding scope support

……

A client can ask for a subset of its scopes during its call to the authorization using the scope parameter, which is a string containing a space-separated list of scope val- ues.
We'll need to parse that in our authorization endpoint, and we're going to turn it into an array for easier processing and store it in the `rscope` variable.
Similarly, our **client can optionally have a set of scopes associated with it**, as we saw previously, and we'll parse that into an array as the `cscope` variable.
But because `scope` is an optional parameter, we need to be a little bit careful in how we handle it, in case a value wasn't passed in.

```js
var rscope = req.query.scope ? req.query.scope.split(' ') : undefined;
var cscope = client.scope ? client.scope.split(' ') : undefined;
```

……

**Refresh token requests are allowed to specify a subset of the scopes that the refresh token was issued with to tie to the new access token**.
This lets a **client use its refresh token to ask for new access tokens that are strictly less powerful than the full set of rights it has been granted, which honors the security principle of least privilege**. ……

## 6. OAuth 2.0 in the real world

……

### 6.1 Authorization **grant types**

……

#### 6.1.1 Implicit grant type

_隐式许可类型_

**One key aspect of the different steps in the authorization code flow is that it keeps information separate between different components**.
This way, the browser doesn't learn things that only the client should know about, and the client doesn't get to see the state of the browser, and so on.
But what **if we were to put the client inside the browser?**

This is what happens with a JavaScript application running completely inside the browser.
**The client then can't keep any secrets from the browser, which has full insight into the client's execution.**
In this case, **there is no real benefit in passing the authorization code through the browser to the client, only to have the client exchange that for a token because the extra layer of secrets isn't protected against anyone involved**.

The **implicit grant type** does away with this extra secret and its attendant round trip by **returning the token directly from the authorization endpoint**.
The implicit grant type therefore uses only the front channel to communicate with the authorization server.
This flow is very useful for JavaScript applications embedded within websites that need to be able to perform an authorized, and potentially limited, session sharing across security domains.

The implicit grant has severe limitations that need to be considered when approaching it.
First, **there is no realistic way for a client using this flow to keep a client secret, since the secret will be made available to the browser itself**.
Since this flow uses only the authorization endpoint and not the token endpoint, this limitation does not affect its ability to function, as the client is never expected to authenticate at the authorization endpoint.
However, the **lack of any means of authenticating the client** does impact the security profile of the grant type and it should be approached with caution.
Additionally, the implicit flow can't be used to get a refresh token.
Since in-browser applications are by nature short lived, lasting only the session length of the browser context that has loaded them, the usefulness of a refresh token would be very limited.
Furthermore, unlike other grant types, the resource owner can be assumed to be still present in the browser and available to reauthorize the client if necessary. ……

The client sends its **request to the authorization server's authorization endpoint** in the same manner as the authorization code flow, except that this time the **`response_type` parameter is set to `token` instead of `code`**.
This signals the authorization server to generate a token immediately instead of generating an authorization code to be traded in for a token.

```http
HTTP/1.1 302 Moved Temporarily
Location: http://localhost:9001/authorize?response_type=token&scope=foo&client_id=oauth-client-1&redirect_uri=http%3A%2F%2Flocalhost%3A9000%2Fcallback&state=Lwt50DDQKUB8U7jtfLQCVGDL9cnmwHH1
Vary: Accept
Content-Type: text/html; charset=utf-8
Content-Length: 444
Date: Fri, 31 Jul 2015 20:50:19 GMT
```

……

#### 6.1.2 Client credentials grant type

_客户端凭据许可类型_

**What if there is no explicit resource owner, or the resource owner is indistinguishable from the client software itself?**
This is a fairly common situation, in which there are back-end systems that need to communicate directly with each other and not necessarily on behalf of any one particular user. ……

……

The client **requests a token from the token endpoint** as it would with the authorization code grant, except that this time it uses the `client_credentials` value for the `grant_type` parameter and doesn't have an authorization code or other temporary credential to trade for the token. ……

```http
POST /token
Host: localhost:9001
Accept: application/json
Content-type: application/x-www-form-encoded
Authorization: Basic b2F1dGgtY2xpZW50LTE6b2F1dGgtY2xpZW50LXNlY3JldC0x
grant_type=client_credentials&scope=foo%20bar
```

……

_The response from the authorization server is a normal OAuth token endpoint response: a JSON object containing the token information._
The client credentials flow does not issue a refresh token because the client is assumed to be in the position of being able to request a new token for itself at any time without involving a separate resource owner, which renders the refresh token unnecessary in this context.

```http
HTTP 200 OK
Date: Fri, 31 Jul 2015 21:19:03 GMT
Content-type: application/json
{
   "access_token": "987tghjkiu6trfghjuytrghj",
   "scope": "foo bar",
   "token_type": "Bearer"
}
```

……

#### 6.1.3 Resource owner credentials grant type

_资源拥有者凭据许可类型_

If the resource owner has a plain username and password at the authorization server, then it could be possible for **the client to prompt the user for these credentials and trade them for an access token**.
The **resource owner credentials grant type**, also known as the **password flow**, allows a client to do just that.
The resource owner interacts directly with the client and never with the authorization server itself.
The grant type **uses the token endpoint exclusively**, remaining confined to the back channel.

……

> Codifying the antipattern
>
> Let's review: why shouldn't you use this pattern? It's certainly simpler to program than dealing with all of the back-and-forth redirects.
> But with that simplicity comes significantly increased security risk and decreased flexibility and functionality.
> The resource owner's credentials are exposed in plain text to the client, which could cache them or replay them whenever it sees fit.
> The credentials are presented in plain text (though over a TLS encrypted connection) to the authorization server, which then needs to verify them, leaving another potential attack surface.
> Unlike OAuth tokens, which can be revoked and rotated without impact to the user experience, a user's username and password tend to be much more difficult to manage and change.
> The requirement to collect and replay the user's credentials also limits the kinds of credentials that can be used to authenticate the user.
> Although an authorization server accessed through a web browser can employ a wide variety of primary authentication technologies and user experiences, such as certificates or identity federation, many of the most effective and secure ones are designed to prevent the kind of credential replay that this grant type depends on.
> This effectively limits the authentication to a plain username and password or its analogs.
> Finally, this approach trains users to give their password to any application that asks for it.
> Instead of this, we should be training users to give their passwords only to a core set of trusted applications, such as the authorization server.
>
> Why, then, would OAuth codify such bad practice?
> When there are any other options available, this grant type is a pretty bad idea, but there aren't always other viable options.
> This grant type is intended for clients that would normally be prompting for the resource owner's username and password anyway, and then replaying those credentials to every protected resource.
> To do this without bothering the user, such a client would likely want to store the username and password so that they can be replayed in the future.
> The protected resources would need to see and verify the user's password on every request, creating an enormous attack surface for sensi- tive materials.
>
> This grant type, then, can act as a stepping-stone toward a more modern security architecture that uses OAuth's other, more secure grant types.
> For one, **the protected resource no longer needs to know or ever see the user's password, and it can deal only with OAuth tokens**.
> This immediately limits the exposure of the user's credentials across the network and limits the number of components that ever see them.
> Second, in using this grant type a well-meaning **client application no longer needs to store the passwords and transmit them to the resource servers**.
> The client trades them for an access token that it can use at various protected resources.
> **Combined with a refresh token, the user experience is unchanged from before but the security profile is greatly improved over the alternative.**
> Although using something like the authorization code grant type is greatly preferable, using this flow is sometimes better than replaying the user's password to the protected resource on every request.

……

#### 6.1.4 Assertion grant types

In the first official extension grant types to be published by the OAuth working group, the **assertion grant types**, **the client is given a structured and cryptographically protected item** called an **assertion** to give to the authorization server in exchange for a token.
You **can think of an assertion as something like a certified document such as a diploma<!-- 文凭 --> or license**.
You can trust the document's contents to be true as long as you trust the certifying authority's ability to make those statements truthfully.

Two formats are standardized so far: one using **Security Assertion Markup Language (SAML)**, and another using **JSON Web Token (JWT)**.
This grant type **uses the back channel exclusively**, and much like the client credentials flow **there may not be an explicit resource owner involved**.
Unlike the client credentials flow, **the rights associated with the resulting token are determined by the assertion being presented and not solely by the client itself**.
Since the assertion generally comes from a third party external to the client, the client can remain unaware of the nature of the assertion itself.

Like other back-channel flows, the client makes an HTTP POST to the authorization server's token endpoint.
**The client authenticates itself as usual and includes the assertion as a parameter.**
The means by which the client can get this assertion vary wildly, and are considered out of scope by many of the associated protocols.
The client could be handed the assertion by a user, or by a configuration system, or through another non-OAuth protocol.
In the end, as with an access token, it doesn't matter how the client got the assertion as long as it's able to present the assertion to the authorization server.
In this example, the client is presenting a JWT assertion, which is reflected in the value of the `grant_type` parameter.

……

#### 6.1.5 Choosing the appropriate grant type

![choose-the-right-grant-type.png](_image/choose-the-right-grant-type.png)

### 6.2 Client deployments

#### 6.2.1 Web applications

The original use case of the OAuth client is the web application.
These are **applications that execute on a remote server and are accessed through a web browser**.
**The application configuration and its runtime state are held on the web server, and the browser connection is usually connected using a session cookie.**

These applications are able to make full use of both front- and back-channel communication methods.
Since the user is already interacting through a browser, activating a request on the front channel is as simple as sending an HTTP redirect message to the browser.
Listening for the response on the front channel is equally simple as the application is already listening for HTTP requests.
Back channel communication can occur by making an HTTP call directly from the web server running the application.
Because of this flexibility, web applications can easily use the authorization code, client credentials, or assertions flows most effectively.
Since the fragment component of the request URI isn't usually passed to the server by the browser, the implicit flow doesn't work for web applications in most circumstances.
<!-- icehe : 最后这一句确实不太理解 2021/12/29 -->

……

#### 6.2.2 Browser applications

**Browser applications are those that execute entirely inside the web browser, typically using JavaScript.**
Although the code for the application does need to be served from a web server, the code itself doesn't execute on the server, and the web server doesn't keep any of the runtime state of the application.
Instead, everything about the application happens on the end user's computer inside their web browser.

These clients can easily use the front channel, as sending the user to another page through an HTTP redirect is trivial.
Responses from the front channel are also simple, as the client's software does need to be loaded from a web server.
However, back-channel communication is more complicated, **as browser applications are limited by same-origin policies and other security restrictions designed to prevent cross-domain attacks**.
Consequently, these types of applications are **best suited for the implicit flow**, which has been optimized for this case.

……

From here, our application can start using the access token with protected resources.
Note that **access to external sites from a JavaScript application still requires cross-domain security configuration, such as CORS**, on the part of the protected resource.
Using OAuth in this type of application allows for a kind of cross-domain session, mediated<!-- 裁定 --> by the resource owner and embodied<!-- 承载 --> by the access token.
Access tokens in this case are usually short lived and often limited in scope.
To refresh this session, send the resource owner back to the authorization server to get a new access token.

#### 6.2.3 Native applications

Native applications are those that run directly on the end user's device, be it a computer or mobile platform.
The software for the application is generally compiled or packaged externally and then installed on the device.

These applications can easily make use of the back channel by making a direct HTTP call outbound to the remote server.
**Since the user isn't in a web browser, as they are with a web application or a browser client, the front channel is more problematic.**
**To make a front-channel request, the native application needs to be able to reach out to the system web browser or an embedded browser view to get the user to the authorization server directly.**
**To listen for front-channel responses, the native application needs to be able to serve a URI that the browser can be redirected to by the authorization server.**
This usually takes one of the following forms:

- An embedded web server running on localhost
- A remote web server with some type of out-of-band push notification capability to the application
- A **custom URI scheme** such as `com.oauthinaction.mynativeapp:/` that is **registered with the operating system such that the application is called when URIs with that scheme are accessed**

……

#### 6.2.4 Handling secrets

**The purpose of the client secret is to let an instance of client software authenticate itself to the authorization server, apart from any authorizations conferred to it by the resource owner.** ……
Although a web application can be configured with a client secret away from the browser and end user, native applications and browser applications can't.

The problem comes from needing to differentiate between **configuration time secrets**<!-- 配置期秘密 -->, which every copy of a client gets, and **runtime secrets**<!-- 运行时秘密 -->, which are distinct for each instance.
**Client secrets are configuration time secrets** because they represent the client software itself and are configured into the client software.
**Access tokens, refresh tokens, and authorization codes are all runtime secrets** because they're stored by the client software after it is deployed and running.
Runtime secrets do still need to be stored securely and protected appropriately, but they're designed to be easily revocable and rotatable.
Configuration time secrets, in contrast, are generally things that aren't expected to change often.

In OAuth 2.0, this dichotomy<!-- 一分为二 --> is addressed by removing the requirement for all clients to have a client secret and instead defining two classes of clients, **public clients** and **confidential clients**, **based on their ability to keep a configuration time secret**.

Public clients, as the name suggests, are unable to hold configuration time secrets and therefore have no client secret.
This is usually because the code for the client is exposed to the end user in some fashion, either by being downloaded and executed in a browser or by executing natively on the user's device.
Consequently<!-- 因此 -->, **most browser applications and many native applications are public clients**.
In either case, each copy of the client software is identical and there are potentially many instances of it.
The user of any instance could extract the configuration information for that instance, including any configured client ID and client secret.
Although all instances share the same client ID, this doesn't cause a problem because the client ID isn't intended to be a secret value.
Anyone attempting to impersonate this client by copying its client ID will still need to use its redirect URIs and be bound by other measures.
Having an additional client secret, in this case, does no good because it could be extracted and copied along with the client ID.

A potential mitigation<!-- 缓和 --> is available for applications that use the authorization code flow in the form of **Proof Key for Code Exchange (PKCE)**. ……
The PKCE protocol extension **allows a client to more tightly bind its initial request to the authorization code that it receives, but without using a client secret or equivalent**.

**Confidential clients**<!-- 保密客户端 --> are able to hold configuration time secrets.
Each instance of the client software has a distinct configuration, including its client ID and secret, and these values are difficult to extract by end users.
**A web application is the most common type of confidential client**, as it represents a single instance running on a web server that can handle multiple resource owners with a single OAuth client.
The client ID can be gathered as it is exposed through the web browser, but the client secret is passed only in the back channel and is never directly exposed.

An alternative approach to this problem is to **use dynamic client registration**, …… .
By using dynamic client registration, an instance of a piece of client software can register itself at runtime.
This effectively **turns what would otherwise need to be a configuration time secret into a runtime secret, allowing a higher level of security and functionality to clients that would otherwise be unable to use it**.

# Part 3 : OAuth 2 implementation and vulnerabilities

## 7. Common client vulnerabilities

### 7.1 General client security

…… The client also needs to be careful that these secrets aren't accidentally placed into audit logs or other ledgers where a third party could later surreptitiously look for them. ……

…… **One of the most common mistakes is to use OAuth as an authentication protocol without taking any extra precautions**, and this is such a broad issue. ……
There you'll encounter some issues such as the "confused deputy problem" and other authentication-related security issues.
One of the worst results of a security breach to an OAuth client is to leak the resource owner's authorization codes or access tokens through sloppy<!-- 草率的 --> implementation of the OAuth protocol. ……

### 7.2 CSRF attack against the client

……

External Reference : [CSRF Attack on OAuth 2.0](/auth/csrf-attack-on-oauth.md)

### 7.3 Theft of client credentials

……

### 7.4 Registration of the redirect URI

……

The main reason behind this is that sometimes authorization servers use different `redirect_uri` validation policies.
……, **the only reliably safe validation method the authorization server should adopt is <u>exact matching</u>**.
All the other potential solutions, based on regular expressions or allowing subdirectories of the registered `redirect_uri`, are suboptimal and sometimes even dangerous.

……

When the OAuth provider uses the **allowing subdirectory method** for matching the `redirect_uri`, there is certain flexibility on the `redirect_uri` request parameter ( for an additional example, see the **GitHub API security documentation** ) .

Now it isn't necessarily true that having an authorization server that uses the allowing subdirectory validation strategy is bad, on its own.
But when combined with an OAuth client registering a "too loose" `redirect_uri`, this is indeed lethal<!-- 致命的 -->.
In addition, the larger the OAuth client's internet exposure, the easier it is to find a loophole<!-- 枪眼, 射弹孔 --> to exploit this vulnerability.

#### 7.4.1 Stealing the authorization code through the referrer

……

_( icehe : 详见原文, 还挺复杂的, 也挺精彩的. Note it later. )_

#### 7.4.2 Stealing the token through an open redirector

_( icehe : 详见原文, 还不够理解. Note it later. )_

### 7.5 Theft of authorization codes

……

### 7.6 Theft of tokens

……

_( icehe : 详见原文以及引用资料, 还没深入看. Note it later. )_

### 7.7 Native applications best practices

……

Further Reading : OAuth 2.0 for Native Apps

## 8. Common protected resources vulnerabilities

### 8.1 How are protected resources vulnerable?

Protected resources are vulnerable in a number of ways, the first and most obvious being that **access tokens can leak**, giving an attacker data about protected resources.
This can **happen via token hijacking**, or because the token has weak entropy<!-- 信息熵太弱 --> or an overly wide scope.
Another issue related to protected resources is that **the endpoints can be vulnerable to cross-site scripting (XSS) attacks**.
Indeed, if the resource server chooses to support `access_token` as a URI parameter, the attacker can forge<!-- 伪造 --> a URI containing the XSS attack and then use social engineering to trick a victim into following that link.
**This can be as simple as a blog post with a review of the application, inviting people to try it out.**
When someone clicks on that link, the malicious JavaScript is then executed.

> **What is XSS?**
>
> **Cross-site scripting (XSS)** is the Open Web Application Security Project's (OWASP) Top Ten number three and is by far the most prevalent web application security flaw.
> **Malicious scripts are injected into otherwise benign<!-- 良性的 --> and trusted websites to bypass access controls such as the same-origin policy.**
> As a result, an attacker might inject a script and modify the web application to suit their own purposes, such as extracting data that will allow the attacker to impersonate an authenticated user or perhaps to input malicious code for the browser to execute.

### 8.2 Design of a protected resource endpoint

### 8.2.1 How to protect a resource endpoint

……

_( icehe : 注入 `<script>` 的 XSS 漏洞, 详见原文, 此处暂略 )_

……

How to protect: ( keywords )

- CSP - Content Security Policy
- Escape / URI-Encode all untrusted data
- Use correct `Content-Type`
    - MUST contains `Content-Type`
    - Better not `Content-Type: text/html`
    - ……
- `X-XSS-Options: nosniff`
- `X-XSS-Protection: 1; mode=block`
- ……

_( icehe : 详见原文, 主要是 HTTP 安全的问题, 暂略. MAYBE note it later. )_

### 8.2.2 Adding implicit grant support

……

…… we're trying to use JavaScript to call a URL with a different origin, hence violating the **same origin policy**. ……
In essence, the same origin policy states that "**browser windows can work in contexts of each other only if they are from served from the same base URL, consisting of `protocol://domain:port`.**" ……

The same origin policy is set up to keep JavaScript inside one page from loading malicious content from another domain.
But in this case, it's fine to allowing a JavaScript call to our API, especially since we're protecting that API with OAuth to begin with.
To solve this, we get a solution straight from the W3C specification: **cross-origin resource sharing (CORS)**.
Adding CORS support in Node.js is extremely simple, and it's becoming commonly available in many languages and platforms. e.g.

```js
var cors = require('cors');
```

……

### 8.3 Token replays

……

## 9. Common authorization server vulnerabilities

### 9.1 General security

Since the authorization server consists of both a user-facing website (for the front channel) and a machine-facing API (for the back channel), all general advice for deploying secure web servers applies here as well.
This includes having **secured server logs**, using **Transport Layer Security (TLS) with valid certificates**, a **secure OS hosting environment with proper account access controls**, and many other things.
……, "The web is a dangerous place; heed<!-- 留心 --> this advice well, and proceed with caution."

### 9.2 Session hijacking

……

It turns out that the OAuth core specification1 gives us a solution to this problem in section 4.1.3:

> The client **MUST NOT** use the authorization code more than once.
> If an authorization code is used more than once, the authorization server **MUST** deny the request and **SHOULD** revoke ( when possible ) all tokens previously issued based on that authorization code.

……

_( icehe : 添加流程图 : Authorization code grant flow forged )_

### 9.3 Redirect URI manipulation

……

Now let's be perfectly clear: **the only consistently safe validation method for the `redirect_uri` is <u>exact matching</u>**. ……

……

### 9.4 Client impersonation

……

_( icehe : 详见原文, 还不够理解. Note it later. )_

### 9.5 Open redirector

……

In order to understand the issue we need to take a closer look at section 4.1.2.1 of the OAuth specification:

> If the request fails due to a missing, invalid, or mismatching redirection URI, or if the client identifier is missing or invalid, the authorization server **SHOULD** inform the resource owner of the error and **MUST NOT** automatically redirect the user-agent to the invalid redirection URI.
>
> If the resource owner denies the access request or if the request fails for reasons other than a missing or invalid redirection URI, the authorization server informs the client by adding the following parameters to the query component of the redirection URI…

……

_( icehe : 详见原文, 还不够理解. Note it later. )_

## 10. Common OAuth token vulnerab ilities

_( icehe : Note it later. )_

### 10.1 What is a bearer token?

### 10.2 Risks and considerations of using bearer tokens

### 10.3 How to protect bearer tokens

#### 10.3.1 At the client

#### 10.3.2 At the authorization server

#### 10.3.3 At the protected resource

### 10.4 Authorization code

#### 10.4.1 Proof Key for Code Exchange (PKCE)

# Part 4 : Taking OAuth further

## 11. OAuth tokens

### 11.1 What are OAuth tokens?

### 11.2 Structured tokens: JSON Web Token (JWT)

#### 11.2.1 The structure of a JWT

#### 11.2.2 JWT claims

#### 11.2.3 Implementing JWT in our servers

#### 11.2.4 User authentication with OAuth 2.0

### 11.3 Cryptographic protection of tokens: JSON Object Signing and Encryption (JOSE)

#### 11.3.1 **Symmetric** signatures using HS256

#### 11.3.2 **Asymmetric** signatures using RS256

#### 11.3.3 Other token protection options

### 11.4 Looking up a token's information online: token introspection

#### 11.4.1 The introspection protocol

#### 11.4.2 Building the introspection endpoint

#### 11.4.3 **Introspecting**<!-- 内省? --> a token

#### 11.4.4 Combining introspection and JWT

### 11.5 Managing the token **lifecycle** with token **revocation**

#### 11.5.1 The token revocation protocol

#### 11.5.2 Implementing the revocation endpoint

#### 11.5.3 Revoking a token

### 11.6 The OAuth token lifecycle

## 12. Dynamic client registration

### 12.1 How the server knows about the client

……

### 12.2 Registering clients at runtime

The **OAuth Dynamic Client Registration protocol** provides a way for clients to introduce themselves to authorization servers, including all kinds of information about the client.
The authorization server can then **provision a unique client ID** to the client software that the client can use for all subsequent OAuth transactions, and **if appropriate associate a client secret with that ID** as well. ……

#### 12.2.1 How the protocol works

……

Client HTTP Request :

```http
POST /register HTTP/1.1
Host: localhost:9001
Content-Type: application/json
Accept: application/json
{
    "client_name": "OAuth Client",
    "redirect_uris": ["http://localhost:9000/callback"],
    "client_uri": "http://localhost:9000/",
    "grant_types": ["authorization_code"],
    "scope": "foo bar baz"
}
```

Authorization Server HTTP Response :

```http
HTTP/1.1 201 Created
Content-Type: application/json
{
  "client_id": "1234-wejeg-0392",
  "client_secret": "6trfvbnklp0987trew2345tgvcxcvbjkiou87y6t5r",
  "client_id_issued_at": 2893256800,
  "client_secret_expires_at": 0,
  "token_endpoint_auth_method": "client_secret_basic",
  "client_name": "OAuth Client",
  "redirect_uris": ["http://localhost:9000/callback"],
  "client_uri": "http://localhost:9000/",
  "grant_types": ["authorization_code"],
  "response_types": ["code"],
  "scope": "foo bar baz"
}
```

……

#### 12.2.2 Why use dynamic registration?

……

…… **OpenID Connect provides a standardized identity API**, and the **System for Cross-domain Identity Management (SCIM)** protocol provides a standardized provisioning API.
Both of these are protected by OAuth, and both can be stood up by different providers.

……

#### 12.2.3 Implementing the registration endpoint

……

#### 12.2.4 Having a client register itself

……

### 12.3 Client metadata

**The attributes associated with a registered client are collectively known as its <u>client metadata</u>.**
These attributes include those that affect the functionality of the underlying protocol, such as `redirect_uris` and `token_endpoint_auth_method`, as well as those that affect the user experience, such as `client_name` and `logo_uri`. ……

<!-- icehe : 怎么清理掉存储中没用的 client 注册数据? 没过一段时间, 清理掉这段时间内没被使用过的 client 注册数据. -->

#### 12.3.1 Table of core client metadata field names

The core dynamic client registration protocol defines a set of common client metadata names, and this set can be extended.
For example, the **OpenID Connect Dynamic Client Registration specification**, which is based on and compatible with OAuth Dynamic Client Registration, _extends this list with a few more of its own, specific to the OpenID Connect protocol._
_We've included **a few OpenID Connect specific extensions** in  the following table that have general applicability to OAuth clients._

-   `redirect_uris`

-   `token_endpoint_auth_method`

-   `grant_types`

-   `response_types`

-   `client_name`

-   `client_uri`

-   `logo_uri`

-   `scope`

-   `contacts`

-   `tos_uri`

-   `policy_uri`

-   `jwks_uri`

-   `jwks`

-   `software_id`

-   `software_version`

……

#### 12.3.2 Internationalization of human-readable client metadata

……

In order to represent a different language or script, the client also sends a version of the field with the language tag appended to the field name with the # (pound or hash) character.
For example, let's say that this client is known as "Mon Client" in French.
The language code for French is `fr`, and so the field would be represented as `client_name#fr` in the JSON object.
These two fields would be sent together.

```json
{
    ……
    "client_name": "My Client",
    "client_name#fr": "Mon Client",
    ……
}
```

The authorization server should use the most specific entry possible in interacting with users. ……

#### 12.3.3 Software statements

……

### 12.4 Managing dynamically registered clients

- 12.4.1 How the management protocol works
- 12.4.2 Implementing the dynamic client registration management API

## 13. User authentication with OAuth 2.0

### 13.1 Why OAuth 2.0 is not an authentication protocol

#### Authentication vs. authorization : a delicious metaphor<!-- 隐喻 -->

### 13.2 Mapping OAuth to an authentication protocol

### 13.3 How OAuth 2.0 uses authentication

### 13.4 Common pitfalls of using OAuth 2.0 for authentication

#### 13.4.1 Access tokens as proof of authentication

#### 13.4.2 Access of protected API as proof of authentication

#### 13.4.3 Injection of access tokens

#### 13.4.4 Lack of audience restriction

#### 13.4.5 Injection of invalid user information

#### 13.4.6 Different protocols for every potential identity provider

### 13.5 OpenID Connect: a standard for authentication and identity on top of OAuth 2.0

#### 13.5.1 ID tokens

#### 13.5.2 The UserInfo endpoint

#### 13.5.3 Dynamic server discovery and client registration

#### 13.5.4 Compatibility with OAuth 2.0

#### 13.5.5 Advanced capabilities

### 13.6 Building a simple OpenID Connect system

#### 13.6.1 Generating the ID token

#### 13.6.2 Creating the UserInfo endpoint

#### 13.6.3 Parsing the ID token

#### 13.6.4 Fetching the UserInfo

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
