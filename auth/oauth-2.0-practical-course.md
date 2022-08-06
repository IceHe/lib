# OAuth 2.0 Practical Course

Open Auth 2.0

---

References

-   [OAuth 2.0 的一个简单解释 - 阮一峰](https://www.ruanyifeng.com/blog/2019/04/oauth_design.html)
-   [OAuth 2.0 实战课 - 极客时间](https://time.geekbang.org/column/intro/100053901?utm_term=pc_interstitial_1267&tab=catalog)

---

Role

1. 资源拥有者
2. 第三方软件
3. 授权服务
4. 受保护资源

授权码许可类型的通信过程

-   间接通信: 第三方软件客户端 ←→ 浏览器代理 ←→ 授权服务
-   直接通信: 第三方软件服务端 ←→ 授权服务

Q&A

-   1
    -   Q: 授权码被盗取后, 人家不能也模拟服务器请求获取 access_token 吗?
    -   A: 作者回复: 一方面授权码也都有有效期, 另外一方面除非再盗取了第三方应用软件的 app_id、secret 才能成功请求资源.
-   2
    -   Q: 如果使用 HTTPS 是不是可以不使用授权码, 也能保证安全了?
    -   A: HTTPS 和 OAuth 是两个维度的安全
        -   HTTPS 解决的信息加密传输
        -   OAuth 解决的是用 token 来代替用户名和密码传输
-   3
    -   Q: refresh_token 存在的意义是什么?
        access_token 过期了, 为什么要用 refresh_token 去获取 access_token, 好像重新获取 access_token 也行?
    -   A: **refresh_token 存在于授权码许可和资源拥有者凭据许可下, 为了不烦最终用户频繁的点击 "授权" 按钮动作，才有了这样的机制**;
        -   在隐式许可和客户端凭据许可, 这两种许可类型下, 不需要 refresh_token, 他们可以直接根据 app_id 和 secret 来换取访问令牌, 因为,
        -   1\. 隐式许可对任何内容都是 "透明的" ，也没有必要存在 refresh_token ,
        -   2\. 客户端凭据许可，既然是叫做 "客户端凭据" 了，在获取那些没有跟用户强关联的信息的时候, 比如国家省市信息类似的信息, 其实没有用户参与的必要性, 当然可以随时获取令牌.

JWT: JSON Web Token

-   可以分为 3 部分:
    -   HEADER 头部
        -   typ : JWT 类型
        -   alg : 表示对称签名的算法
    -   PAYLOAD 数据体
        -   sub : 令牌的主体, 一般设为资源拥有者的唯一标识
        -   exp : 令牌的过期时间戳
        -   iat : 令牌办法的时间戳 <!-- icehe: 全称是什么? 以便记忆 -->
        -   … 也允许声明其它自定义的数据 …
    -   SIGNATURE 签名
-   经过签名之后的 JWT 的整体结构, 是被句点符号分割的三段内容, 结构为 `header.payload.signature`, 把它拷贝到 [jwt.io](https://jwt.io/) 网站的在线校验工具中, 就可以看到解码之后的数据.

许可类型?

-   授权码许可 : … 前文之述备矣 …
-   资源拥有者凭据许可 : 使用 password 直接获取 access_token
-   客户端凭据许可 : 可以形象地理解为 "资源拥有者被塞进了第三方软件中" 或者 "第三方软件就是资源拥有者"
-   隐式许可 : see docs

许可类型对比

-   授权码许可 : 通过授权码 code 获取 access_token
-   资源拥有者凭据许可 : 通过资源拥有者的用户名和密码获取 access_token
-   客户端凭据许可 : 通过第三方软件的 app_id 和 app_secret 获取 access_token
-   隐式许可 : 通过嵌入浏览器中的第三方软件的 app_id 来获取 access_token

Keyword

-   rscope : replay scope - 受保护资源服务再次确认的权限
-   JWT: 将包含了一些信息的令牌 (Token), 称为结构化令牌, 简称 JWT
-   令牌内检 : see docs
-   PKCE 协议 : Proof Key for Code Exchange by OAuth Public Clients
    -   在授权码许可类型的流程中，如果没有了 app_secret 这一层的保护，那么通过授权码 code 换取访问令牌的时候，就只有授权码 code 在“冲锋陷阵”了。这时，授权码 code 一旦失窃，就会带来严重的安全问题。那么，我既不使用 app_secret，还要防止授权码 code 失窃，有什么好的方法吗？

Client without Server :

-   by PKCE Protocol
    -   code_verifier : first generated
    -   code_challenge_method :
        -   Option A : `plain` do nothing
        -   Option B : `S256` i.e. SHA256()
        -   Option …
    -   code_challenge :
        ```js
        code_challenge = BASE64_URL_ENCODE(SHA256(ASCII(code_verifier)));
        ```

Security Risks 安全风险

-   CSRF ( Cross-Site Request Forgery ) 跨站请求伪造
    -   Solution : using `state` parameter with random value
        -   todo oneday: 需要自己理解, 绘制一个被攻击的情况的时序图, 以保证充分理解
-   XSS ( Cross Site Scripting ) 跨站脚本攻击
-   水平越权
-   授权码失窃
-   重定向 URI 伪造

OIDC : Open ID Connect

-   用户身份认证的开放标准
-   OIDC = 授权协议 + 身份认证
    -   是 OAuth 2.0 的超集
-   Role Name
    -   Resource Owner ( 资源拥有者 ) → EU ( End User )
    -   Client ( 第三方软件 ) → RP ( Relying Party, 认证服务的依赖方 )
    -   Authorization Server ( 授权服务 ) → OP ( OpenID Provider, 身份认证服务方 )
    -   Resource Provider

ID 令牌的内容

-   iss : issuer = OP URL ( 令牌的颁发者 )
-   sub : subject = EU global unique identifier ( 令牌的主题 )
-   aud : audience = RP app-id ( 令牌的目标受众 )
-   exp : expiration = token expiration ( 令牌的到期时间 )
-   iat : issue added timestamp ( 颁发令牌的时间戳 )

SPA 场景

-   简单做法 : 采用 "隐式许可"
-   业界推荐 : "第一方移动应用" 场景下的授权码许可 + PKCE 拓展流程

SSO 单点登录场景

-   Problem : 为了支持 SSO, IDP 的 Session Cookie 需要种在应用的根域上; 也就是说不同 Web 应用的根域名必须相同, 否则会有跨域问题.

API Gateway Layer

-   Usage :
    -   1\. Validate access_token
    -   2\. Validate app_id & app_secret
    -   3\. Request target API & return result

Others

[登录工程：传统 Web 应用中的身份验证技术｜洞见](https://blog.51cto.com/u_15127595/2743613)
