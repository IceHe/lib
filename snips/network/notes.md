# Network Notes

## OSI Model

Reference

- https://en.wikipedia.org/wiki/OSI_model

> Open System Interconnection Model

|Layer <br/>Type|Layer <br/>Number|Layer <br/>Name|Protocol <br/>Data Unit<br/>(PDU)|Protocols|
|-|-|-|-|-|
|Host <br/>layers|7|Application|Data|**HTTP**, HTTPS, <br/>**FTP**, SMTP, <br/>**DNS, DHCP**, <br/>TELNET|
||6|Presentation|↑|TLS, ~~SSL~~, MIME|
||5|Session|↑|**Sockets** <br/>( session estabilishment<br/> in TCP / RTP / PPTP )|
||4|Transport|Segment, <br/>Datagram|**TCP, UDP**, TLS|
|Media <br/>layers|3|Network|Packet|**IP**, IPsec, <br/>ICMP, IGMP, <br/>OSPF, RIP|
||2|Data Link|Frame|PPP|
||1|Physical|Bit, <br/>Symbol|-|-|

- 7\. **应用层** Application Layer
    - High-level APIs,
    - including resource sharing, remote file access
    - e.g., **HTTP**
- 6\. **表现层** Presentation Layer
    - Translation of data between a networking service and an application;
    - including **character encoding, data compression & encryption/decryption**
- 5\. **会话层** Session Layer
    - Managing communication sessions,
    - i.e., continuous exchange of information in the form of multiple back-and-forth transmissions between two nodes
- 4\. **传输层** Transport Layer :
    - Reliable transmission of data segments between points on a network,
    - including **segmentation, acknowledgement & multiplexing**
    - e.g., **TCP / UDP**
- 3\. **网络层** Network Layer
    - Structuring and managing a multi-node network,
    - including **addressing, routing & traffic control**
    - e.g., IP
- 2\. **数据链路层** Data Link Layer :
    - **Reliable transmission of data frames between two nodes connected by a physical layer**
    - e.g., PPP ( Point-to-Point Protocol )
- 1\. **物理层** Physical Layer
    - **Transmission and reception of raw bit streams over a physical medium**

### _L1 Physical_

The physical layer is responsible for the transmission and reception of unstructured raw data between a device and a physical transmission medium.

- It converts the digital bits into electrical, radio, or optical signals.

### L2 Data Link

The data link layer **provides node-to-node data transfer** — a link between two directly connected nodes.

- It **detects and possibly corrects errors** that may occur in the physical layer.
- It **defines the protocol to establish and terminate a connection between two physically connected devices**.
- It also **defines the protocol for flow control** between them.

Sublayers

- MAC ( Medium Access Control )
- LLC (Logical Link Control )

……

The [Point-to-Point Protocol](https://en.wikipedia.org/wiki/Point-to-Point_Protocol) (PPP) is a data link layer protocol that can operate over several different physical layers, such as synchronous and asynchronous serial lines.

### L3 Network

The network layer provides the functional and procedural means of transferring packets from one node to another connected in "different networks".

- A network is a medium to which many nodes can be connected,
    - on which **every node has an address** and which permits nodes connected to it to **transfer messages to other nodes** connected to it
    - **by merely providing the content of a message and the address of the destination node** and **letting the network find the way to deliver** the message to the destination node,
    - possibly routing it through intermediate nodes.
- If the message is too large to be transmitted from one node to another on the data link layer between those nodes, the network may **implement message delivery by splitting the message into several fragments at one node, sending the fragments independently, and reassembling the fragments at another node**.
- It may, but **does not need to, report delivery errors**.

### L4 Transport

The transport layer provides the functional and procedural means of transferring variable-length data sequences from a source to a destination host, while maintaining the quality of service functions.

- The transport layer **controls the reliability of a given link through flow control, segmentation/desegmentation, & error control**.

……

- [Transmission Control Protocol](https://en.wikipedia.org/wiki/Transmission_Control_Protocol) (TCP) & [User Datagram Protocol](https://en.wikipedia.org/wiki/User_Datagram_Protocol) (UDP)
    - of the Internet Protocol Suite are commonly categorized as layer-4 protocols within OSI.
- [Transport Layer Security](https://en.wikipedia.org/wiki/Transport_Layer_Security) (TLS) provide security at this layer.

### _L5 Session_

The session layer controls the dialogues (connections) between computers.

- It **establishes, manages and terminates the connections between the local and remote application.**
- It provides for **full-duplex, half-duplex, or simplex operation, and establishes procedures for checkpointing, suspending, restarting, and terminating a session**.

### _L6 Presentation_

The presentation layer establishes context between application-layer entities,

- in which the application-layer entities may use different syntax and semantics if the presentation service provides a mapping between them.

### _L7 Application_

The application layer is the OSI layer closest to the end user, which means both the OSI application layer and the user interact directly with the software application.

## HTTP

References

- https://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol
- https://en.wikipedia.org/wiki/List_of_HTTP_status_codes

### Status Codes

All HTTP response status codes are separated into **5 classes or categories**.

- **1xx informational response** _( 继续 )_
    - the request was received, continuing process
- **2xx successful** _( 成功 )_
    - the request was successfully received, understood, and accepted
- **3xx redirection** _( 重定向 )_
    - further action needs to be taken in order to complete the request
- **4xx client error**
    - the request contains bad syntax or cannot be fulfilled
- **5xx server error**
    - the server failed to fulfil an apparently valid request

_The first digit of the status code defines the class of response, while the last two digits do not have any classifying or categorization role._

### 1xx Informational Response

- **100 Continues**
- 101 Switching Protocols
- 102 Processing
- _103 Early Hints_

### 2xx Successful

- **200 OK**
- **201 Created**
- **202 Accepted**
- _203 Non-Authoritative Information_
- **204 No Content**
- _205 Reset Content_
- ……

### 3xx Redirection

- _300 Multiple Choices_
- **301 Move Permanently**
- **302 Found** _( Previously "Move Temporarily" )_
- _303 See Other_
- **304 Not Modified**
- _305 Use Proxy_
- _306 Switch Proxy_
- _307 Temporary Redirect_
- _308 Permanent Redirect_

### 4xx Client Error

- **400 Bad Request**
- **401 Unauthorized**
- 402 Payment Required
- **403 Forbidden**
- **404 Not Found**
- 405 Method Not Allowed
- _406 Not Acceptable_
- _407 Proxy Authentication Required_
- _408 Request Timeout_
- _409 Conflict_
- _410 Gone_
- _411 Length Required_
- _412 Precondition Failed_
- _413 Payload Too Large_
- _414 URI Too Long_
- _415 Unsupported Media Type_
- ……
- ~~_418 I'm a teapot_~~
- ……
- _426 Upgrade Required_
- ……
- _429 Too Many Requests_
- _431 Request Header Fields Too Large_
- _451 Unavailable For Legal Reasons_

### 5xx Server Error

- **500 Internal Server Error**
- _501 Not Implemented_
- **502 Bad Gateway**
- **503 Service Unavailable**
- **504 Gateway Timeout**
- **505 HTTP Version Not Supported**
- ……
- _507 Insufficient Storage_
- _508 Loop Detected_
- _510 Not Extended_
- _511 Network Authentication Required_

## TCP

Reference

- https://en.wikipedia.org/wiki/Transmission_Control_Protocol

## UDP

Reference

- https://en.wikipedia.org/wiki/User_Datagram_Protocol

## IP

Reference

- https://en.wikipedia.org/wiki/Transport_Layer_Security
