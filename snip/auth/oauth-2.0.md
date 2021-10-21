# OAuth 2.0

Open Auth 2.0

---

References

- [OAuth 2.0 的一个简单解释](https://www.ruanyifeng.com/blog/2019/04/oauth_design.html)
- [OAuth 2.0 实战课 - 极客时间](https://time.geekbang.org/column/intro/100053901?utm_term=pc_interstitial_1267&tab=catalog)

---

Role

1. 资源拥有者
2. 第三方软件
3. 授权服务
4. 受保护资源

授权码许可类型的通信过程

- 间接通信: 第三方软件客户端 ←→ 浏览器代理 ←→ 授权服务
- 直接通信: 第三方软件服务端 ←→ 授权服务

Q&A

- 1
    - Q: 授权码被盗取后, 人家不能也模拟服务器请求获取 access_token 吗?
    - A: 作者回复: 一方面授权码也都有有效期, 另外一方面除非再盗取了第三方应用软件的 app_id、secret 才能成功请求资源.
- 2
    - Q: 如果使用 HTTPS 是不是可以不使用授权码, 也能保证安全了?
    - A: HTTPS 和 OAuth 是两个维度的安全
        - HTTPS解决的信息加密传输
        - OAuth 解决的是用 token 来代替用户名和密码传输
- 3
    - Q: refresh_token 存在的意义是什么?
        access_token 过期了, 为什么要用 refresh_token 去获取 access_token, 好像重新获取 access_token 也行?
    - A: **refresh_token 存在于授权码许可和资源拥有者凭据许可下, 为了不烦最终用户频繁的点击 "授权" 按钮动作，才有了这样的机制**;
        - 在隐式许可和客户端凭据许可, 这两种许可类型下, 不需要 refresh_token, 他们可以直接根据 app_id 和 secret 来换取访问令牌, 因为,
        - 1\. 隐式许可对任何内容都是 "透明的" ，也没有必要存在 refresh_token ,
        - 2\. 客户端凭据许可，既然是叫做 "客户端凭据" 了，在获取那些没有跟用户强关联的信息的时候, 比如国家省市信息类似的信息, 其实没有用户参与的必要性, 当然可以随时获取令牌.

Keyword

- rscope?
