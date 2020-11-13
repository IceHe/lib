# ZeroMQ

> An open-source universal messaging library

References

- Home Page : https://zeromq.org
    - Get Started : https://zeromq.org/get-started

## Intro

Why ZeroMQ?
ZeroMQ (also known as ØMQ, 0MQ, or zmq) looks like an embeddable networking library but acts like a concurrency framework. It gives you sockets that carry atomic messages across various transports like in-process, inter-process, TCP, and multicast. You can connect sockets N-to-N with patterns like fan-out, pub-sub, task distribution, and request-reply. It's fast enough to be the fabric for clustered products. Its asynchronous I/O model gives you scalable multicore applications, built as asynchronous message-processing tasks. It has a score of language APIs and runs on most operating systems.

Features

- Universal
    - Connect your code in any language, on any platform.
- Smart
    - Smart patterns like pub-sub, push-pull, and client-server.
- High-speed
    - Asynchronous I/O engines, in a tiny library.
- Multi-Transport
    - Carries messages across inproc, IPC, TCP, UDP, TIPC, multicast and WebSocket
- Community
    - Backed by a large and active open source community.
- The Guide
    - Explains how to use ØMQ with 60+ diagrams and 750 examples in 28 languages
