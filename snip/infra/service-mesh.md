# Service Mesh

References

- https://www.google.com/search?q=service+mesh&oq=service+mesh
    - https://www.infoq.com/articles/service-mesh-ultimate-guide
    - https://www.redhat.com/en/topics/microservices/what-is-a-service-mesh
    - https://www.nginx.com/blog/what-is-a-service-mesh
    - https://www.thoughtworks.com/radar/techniques/service-mesh

## "Ultimate Guide"

- Reference : https://www.infoq.com/articles/service-mesh-ultimate-guide

> Service Mesh Ultimate Guide: Managing Service-to-Service Communications in the Era of Microservices

Service Mesh 通常通过 Sidecar 边车来实现

> - A service mesh **manages all service-to-service communication** within a distributed ( potentially microservice-based ) software system.
>     - It accomplishes this typically **via the use of "<u>sidecar</u>" proxies that are deployed alongside each service through which all traffic is transparently routed.**

边车代理

- 处于应用层
- 控制路由
- 监控打标

> - Proxies used within a service mesh are typically **"application layer" aware** ( operating at Layer 7 in the OSI networking stack ).
>     - This means that **traffic routing decisions** _( 流量路由决定? )_ and the **labeling of metrics** _( 监控打标 )_ **can draw upon data in HTTP headers or other application layer protocol metadata**.

Service Mesh 提供的功能

- Service Discovery 服务注册/服务发现
- Traffic Management 流量管理
- 流量复制
- 灰度 (或金丝雀) 发布
- 增量 (滚动?) 发布

> - A service mesh provides **dynamic service discovery** _( 动态的服务注册/服务发现 )_ and **traffic management**, including **traffic shadowing (duplicating)** _( 流量复制 )_ for testing, and **traffic splitting** _( 分流 )_ for canary _( /kə'neərɪ/ 金丝雀 )_ releasing, **incremental rollout** _( 增量发布 )_ , and A/B type experimentation.

服务网格? _( 不太像 )_

- 安全性
    - TLS _( e.g. HTTPS )_
- 可靠性
    - 流量限制 _( e.g. 限制单个终端的接口调用频率 )_
    - 切断环状的请求链路

> - A service mesh also supports the implementation and enforcement of **cross cutting** _( 横切? )_ requirements, such as security (providing service identity and TLS) and reliability (rate limiting, circuit-breaking) _( 流量限制, 环状网络链路切断? )_.

Observability 服务可见性

- Tracing : 分布式系统跟踪一个请求
- 监控
    - 请求跟踪
    - HTTP 各请求状态码的频率 (统计)
    - 服务间传输延迟

> - As a service mesh is on the critical path for every request being handled within the system, it can also provide additional "**observability**", such as **distributed tracing of a request**, **frequency of HTTP error codes**, **global and service-to-service latency**.
