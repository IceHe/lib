# QPS to CPU Cores

> - 根据 API 的 QPS 估算所需的 CPU 核数 (服务器数)
> - According to API QPS, estimate the count of server/CPU needed.

Assume

- A server has a CPU.
- A CPU has 8 core.
- A core (tread) need 200ms (blocked) to process a API request.
- A API QPS is 20,000 (2w|20k).

So

- A core is able to process 5 API requests in 1 second, aka 5 QPS.
    - 1 sec = 1,000 ms
    - (1,000 ms) / (200 ms/req) = 5 req/sec
- A CPU/server is able to process 10 QPS.
    - 5 QPS * 8 = 40 QPS
- We need 20k / 40 = 500 CPUs (servers).
