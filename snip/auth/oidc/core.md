# OpenID Connect Core 1.0

Core functionality: authentication built on top of OAuth 2.0 and the use of Claims to communicate information about the End-User.

---

References

- [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)

The **core** OpenID Connect **functionality**:
authentication built on top of OAuth 2.0 and the use of Claims to communicate information about the End-User.
_It also describes the security and privacy considerations for using OpenID Connect._

## Table of Contents

- 1.  Introduction
    - 1.1.  Requirements Notation and Conventions
    - 1.2.  Terminology
    - 1.3.  Overview
- 2.  ID Token
- 3.  Authentication
    - 3.1.  Authentication using the Authorization Code Flow
        - 3.1.1.  Authorization Code Flow Steps
        - 3.1.2.  Authorization Endpoint
            - 3.1.2.1.  Authentication Request
            - 3.1.2.2.  Authentication Request Validation
            - 3.1.2.3.  Authorization Server Authenticates End-User
            - 3.1.2.4.  Authorization Server Obtains End-User Consent/Authorization
            - 3.1.2.5.  Successful Authentication Response
            - 3.1.2.6.  Authentication Error Response
            - 3.1.2.7.  Authentication Response Validation
        - 3.1.3.  Token Endpoint
            - 3.1.3.1.  Token Request
            - 3.1.3.2.  Token Request Validation
            - 3.1.3.3.  Successful Token Response
            - 3.1.3.4.  Token Error Response
            - 3.1.3.5.  Token Response Validation
            - 3.1.3.6.  ID Token
            - 3.1.3.7.  ID Token Validation
            - 3.1.3.8.  Access Token Validation
    - 3.2.  Authentication using the Implicit Flow
        - 3.2.1.  Implicit Flow Steps
        - 3.2.2.  Authorization Endpoint
            - 3.2.2.1.  Authentication Request
            - 3.2.2.2.  Authentication Request Validation
            - 3.2.2.3.  Authorization Server Authenticates End-User
            - 3.2.2.4.  Authorization Server Obtains End-User Consent/Authorization
            - 3.2.2.5.  Successful Authentication Response
            - 3.2.2.6.  Authentication Error Response
            - 3.2.2.7.  Redirect URI Fragment Handling
            - 3.2.2.8.  Authentication Response Validation
            - 3.2.2.9.  Access Token Validation
            - 3.2.2.10.  ID Token
            - 3.2.2.11.  ID Token Validation
    - 3.3.  Authentication using the Hybrid Flow
        - 3.3.1.  Hybrid Flow Steps
        - 3.3.2.  Authorization Endpoint
            - 3.3.2.1.  Authentication Request
            - 3.3.2.2.  Authentication Request Validation
            - 3.3.2.3.  Authorization Server Authenticates End-User
            - 3.3.2.4.  Authorization Server Obtains End-User Consent/Authorization
            - 3.3.2.5.  Successful Authentication Response
            - 3.3.2.6.  Authentication Error Response
            - 3.3.2.7.  Redirect URI Fragment Handling
            - 3.3.2.8.  Authentication Response Validation
            - 3.3.2.9.  Access Token Validation
            - 3.3.2.10.  Authorization Code Validation
            - 3.3.2.11.  ID Token
            - 3.3.2.12.  ID Token Validation
        - 3.3.3.  Token Endpoint
            - 3.3.3.1.  Token Request
            - 3.3.3.2.  Token Request Validation
            - 3.3.3.3.  Successful Token Response
            - 3.3.3.4.  Token Error Response
            - 3.3.3.5.  Token Response Validation
            - 3.3.3.6.  ID Token
            - 3.3.3.7.  ID Token Validation
            - 3.3.3.8.  Access Token
            - 3.3.3.9.  Access Token Validation
- 4.  Initiating Login from a Third Party
- 5.  Claims
    - 5.1.  Standard Claims
        - 5.1.1.  Address Claim
        - 5.1.2.  Additional Claims
    - 5.2.  Claims Languages and Scripts
    - 5.3.  UserInfo Endpoint
        - 5.3.1.  UserInfo Request
        - 5.3.2.  Successful UserInfo Response
        - 5.3.3.  UserInfo Error Response
        - 5.3.4.  UserInfo Response Validation
    - 5.4.  Requesting Claims using Scope Values
    - 5.5.  Requesting Claims using the "claims" Request Parameter
        - 5.5.1.  Individual Claims Requests
            - 5.5.1.1.  Requesting the "acr" Claim
        - 5.5.2.  Languages and Scripts for Individual Claims
    - 5.6.  Claim Types
        - 5.6.1.  Normal Claims
        - 5.6.2.  Aggregated and Distributed Claims
            - 5.6.2.1.  Example of Aggregated Claims
            - 5.6.2.2.  Example of Distributed Claims
    - 5.7.  Claim Stability and Uniqueness
- 6.  Passing Request Parameters as JWTs
    - 6.1.  Passing a Request Object by Value
        - 6.1.1.  Request using the "request" Request Parameter
    - 6.2.  Passing a Request Object by Reference
        - 6.2.1.  URL Referencing the Request Object
        - 6.2.2.  Request using the "request_uri" Request Parameter
        - 6.2.3.  Authorization Server Fetches Request Object
        - 6.2.4.  "request_uri" Rationale
    - 6.3.  Validating JWT-Based Requests
        - 6.3.1.  Encrypted Request Object
        - 6.3.2.  Signed Request Object
        - 6.3.3.  Request Parameter Assembly and Validation
- 7.  Self-Issued OpenID Provider
    - 7.1.  Self-Issued OpenID Provider Discovery
    - 7.2.  Self-Issued OpenID Provider Registration
        - 7.2.1.  Providing Information with the "registration" Request Parameter
    - 7.3.  Self-Issued OpenID Provider Request
    - 7.4.  Self-Issued OpenID Provider Response
    - 7.5.  Self-Issued ID Token Validation
- 8.  Subject Identifier Types
    - 8.1.  Pairwise Identifier Algorithm
- 9.  Client Authentication
- 10.  Signatures and Encryption
    - 10.1.  Signing
        - 10.1.1.  Rotation of Asymmetric Signing Keys
    - 10.2.  Encryption
        - 10.2.1.  Rotation of Asymmetric Encryption Keys
- 11.  Offline Access
- 12.  Using Refresh Tokens
    - 12.1.  Refresh Request
    - 12.2.  Successful Refresh Response
    - 12.3.  Refresh Error Response
- 13.  Serializations
    - 13.1.  Query String Serialization
    - 13.2.  Form Serialization
    - 13.3.  JSON Serialization
- 14.  String Operations
- 15.  Implementation Considerations
    - 15.1.  Mandatory to Implement Features for All OpenID Providers
    - 15.2.  Mandatory to Implement Features for Dynamic OpenID Providers
    - 15.3.  Discovery and Registration
    - 15.4.  Mandatory to Implement Features for Relying Parties
    - 15.5.  Implementation Notes
        - 15.5.1.  Authorization Code Implementation Notes
        - 15.5.2.  Nonce Implementation Notes
        - 15.5.3.  Redirect URI Fragment Handling Implementation Notes
    - 15.6.  Compatibility Notes
        - 15.6.1.  Pre-Final IETF Specifications
        - 15.6.2.  Google "iss" Value
    - 15.7.  Related Specifications and Implementer's Guides
- 16.  Security Considerations
    - 16.1.  Request Disclosure
    - 16.2.  Server Masquerading
    - 16.3.  Token Manufacture/Modification
    - 16.4.  Access Token Disclosure
    - 16.5.  Server Response Disclosure
    - 16.6.  Server Response Repudiation
    - 16.7.  Request Repudiation
    - 16.8.  Access Token Redirect
    - 16.9.  Token Reuse
    - 16.10.  Eavesdropping or Leaking Authorization Codes (Secondary Authenticator Capture)
    - 16.11.  Token Substitution
    - 16.12.  Timing Attack
    - 16.13.  Other Crypto Related Attacks
    - 16.14.  Signing and Encryption Order
    - 16.15.  Issuer Identifier
    - 16.16.  Implicit Flow Threats
    - 16.17.  TLS Requirements
    - 16.18.  Lifetimes of Access Tokens and Refresh Tokens
    - 16.19.  Symmetric Key Entropy
    - 16.20.  Need for Signed Requests
    - 16.21.  Need for Encrypted Requests
- 17.  Privacy Considerations
    - 17.1.  Personally Identifiable Information
    - 17.2.  Data Access Monitoring
    - 17.3.  Correlation
    - 17.4.  Offline Access
- 18.  IANA Considerations
    - 18.1.  JSON Web Token Claims Registration
        - 18.1.1.  Registry Contents
    - 18.2.  OAuth Parameters Registration
        - 18.2.1.  Registry Contents
    - 18.3.  OAuth Extensions Error Registration
        - 18.3.1.  Registry Contents
- 19.  References
    - 19.1.  Normative References
    - 19.2.  Informative References
- Appendix A. Authorization Examples
    <!-- - 1\. Example using response_type=code -->
    <!-- - 2\. Example using response_type=id_token -->
    <!-- - 3\. Example using response_type=id_token token -->
    <!-- - 4\. Example using response_type=code id_token -->
    <!-- - 5\. Example using response_type=code token -->
    <!-- - 6\. Example using response_type=code id_token token -->
    <!-- - 7\. RSA Key Used in Examples -->
- Appendix B. Acknowledgements
- Appendix C. Notices
- ……

## 1. Introduction

OpenID Connect 1.0 is a simple identity layer on top of the OAuth 2.0 RFC6749 protocol.
It enables Clients to verify the identity of the End-User based on the authentication performed by an Authorization Server, as well as to obtain basic profile information about the End-User in an interoperable and REST-like manner.

The OpenID Connect Core 1.0 specification defines the core OpenID Connect functionality: authentication built on top of OAuth 2.0 and the use of Claims to communicate information about the End-User.
It also describes the security and privacy considerations for using OpenID Connect.

As background, the OAuth 2.0 Authorization Framework [RFC6749] and OAuth 2.0 Bearer Token Usage [RFC6750] specifications provide a general framework for third-party applications to obtain and use limited access to HTTP resources.
They define mechanisms to obtain and use Access Tokens to access resources but do not define standard methods to provide identity information.
Notably, without profiling OAuth 2.0, it is incapable of providing information about the authentication of an End-User.
_Readers are expected to be familiar with these specifications._

**OpenID Connect implements authentication as an extension to the OAuth 2.0 authorization process.**
Use of this extension is requested by Clients by including the openid scope value in the Authorization Request.
**Information about the authentication performed is returned in a JSON Web Token (JWT) JWT called an ID Token (see Section 2).**
_OAuth 2.0 Authentication Servers implementing OpenID Connect are also referred to as **OpenID Providers (OPs)**._
_OAuth 2.0 Clients using OpenID Connect are also referred to as **Relying Parties (RPs)**._

This specification **assumes that the Relying Party has already obtained configuration information about the OpenID Provider, including its Authorization Endpoint and Token Endpoint locations.**
**This information is normally obtained via Discovery**, as described in OpenID Connect Discovery 1.0 [OpenID.Discovery], **or may be obtained via other mechanisms.**

Likewise, this specification assumes that **the Relying Party has already obtained sufficient credentials and provided information needed to use the OpenID Provider.**
**This is normally done via Dynamic Registration**, as described in OpenID Connect Dynamic Client Registration 1.0 [OpenID.Registration], or may be obtained via other mechanisms.

### 1.1. Requirements Notation and Conventions

……

[Key words for use in RFCs to Indicate Requirement Levels - RFC2119](https://datatracker.ietf.org/doc/html/rfc2119)

……

### 1.2. Terminology

……

-   ……

-   **Claim**

    **Piece of information asserted about Entity.**

-   _Claim Type_

    _Syntax used for representing a Claim Value._

    _This specification defines **Normal**, **Aggregated**, and **Distributed** Claim Types._

-   _Claims Provider_

    _Server that can return Claims about an Entity._

-   **Credential**

    **Data presented as evidence of the right to use an identity or other resources.**

-   End-User

    Human participant.

-   Entity

    Something that has a separate and distinct existence and that can be identified in a context.

    _An End-User is one example of an Entity._

-   Essential Claim

    Claim specified by the Client as being necessary to ensure a smooth authorization experience for the specific task requested by the End-User.

-   _Hybrid Flow_

    _OAuth 2.0 flow in which an Authorization Code is returned from the Authorization Endpoint, some tokens are returned from the Authorization Endpoint, and others are returned from the Token Endpoint._

-   **ID Token**

    **JSON Web Token (JWT) that contains Claims about the Authentication event.**

    It MAY contain other Claims.

-   **Identifier**

    **Value that uniquely characterizes an Entity in a specific context.**

-   Identity

    Set of attributes related to an Entity.

-   _Implicit Flow_

    _OAuth 2.0 flow in which all tokens are returned from the Authorization Endpoint and neither the Token Endpoint nor an Authorization Code are used._

-   **Issuer**

    **Entity that issues a set of Claims.**

-   _Issuer Identifier_

    _Verifiable Identifier for an Issuer._

    _An Issuer Identifier is a case sensitive URL using the https scheme that contains scheme, host, and optionally, port number and path components and no query or fragment components._

-   _Message_

    _Request or a response between an OpenID Relying Party and an OpenID Provider._

-   **OpenID Provider (OP)**

    OAuth 2.0 Authorization Server that is capable of **Authenticating the End-User and providing Claims to a Relying Party about the Authentication event and the End-User.**

-   **Request Object**

    **JWT that contains a set of request parameters as its Claims.**

-   Request URI

    URL that references a resource containing a Request Object.

    The Request URI contents MUST be retrievable by the Authorization Server.

-   _Pairwise<!-- 成对的 --> Pseudonymous Identifier (PPID)_

    _Identifier that identifies the Entity to a Relying Party that cannot be correlated with the Entity's PPID at another Relying Party._

    <!-- icehe : 理解不了这个术语… 2021/11/01 -->

-   _Personally Identifiable Information (PII)_

    _Information that:_
    _(a) can be used to identify the natural person to whom such information relates, or_
    _(b) is or might be directly or indirectly linked to a natural person to whom such information relates._

-   **Relying Party (RP)**

    **OAuth 2.0 Client application requiring End-User Authentication and Claims from an OpenID Provider.**

-   Sector Identifier

    Host component of a URL used by the Relying Party's organization that is an input to the computation of pairwise Subject Identifiers for that Relying Party.

-   TODO

-   ……

### 1.3. Overview

TODO

## 2. ID Token

TODO

## 3. Authentication

TODO

### 3.1. Authentication using the Authorization Code Flow

TODO ignore?

- 3.1.1. Authorization Code Flow Steps
- 3.1.2. Authorization Endpoint
    <!-- - 3.1.2.1. Authentication Request -->
    <!-- - 3.1.2.2. Authentication Request Validation -->
    <!-- - 3.1.2.3. Authorization Server Authenticates End-User -->
    <!-- - 3.1.2.4. Authorization Server Obtains End-User Consent/Authorization -->
    <!-- - 3.1.2.5. Successful Authentication Response -->
    <!-- - 3.1.2.6. Authentication Error Response -->
    <!-- - 3.1.2.7. Authentication Response Validation -->
- 3.1.3. Token Endpoint
    <!-- - 3.1.3.1. Token Request -->
    <!-- - 3.1.3.2. Token Request Validation -->
    <!-- - 3.1.3.3. Successful Token Response -->
    <!-- - 3.1.3.4. Token Error Response -->
    <!-- - 3.1.3.5. Token Response Validation -->
    <!-- - 3.1.3.6. ID Token -->
    <!-- - 3.1.3.7. ID Token Validation -->
    <!-- - 3.1.3.8. Access Token Validation -->

### 3.2. Authentication using the Implicit Flow

TODO ignore?

- 3.2.1.  Implicit Flow Steps
- 3.2.2.  Authorization Endpoint
    <!-- - 3.2.2.1.  Authentication Request -->
    <!-- - 3.2.2.2.  Authentication Request Validation -->
    <!-- - 3.2.2.3.  Authorization Server Authenticates End-User -->
    <!-- - 3.2.2.4.  Authorization Server Obtains End-User Consent/Authorization -->
    <!-- - 3.2.2.5.  Successful Authentication Response -->
    <!-- - 3.2.2.6.  Authentication Error Response -->
    <!-- - 3.2.2.7.  Redirect URI Fragment Handling -->
    <!-- - 3.2.2.8.  Authentication Response Validation -->
    <!-- - 3.2.2.9.  Access Token Validation -->
    <!-- - 3.2.2.10.  ID Token -->
    <!-- - 3.2.2.11.  ID Token Validation -->

### 3.3. Authentication using the Hybrid Flow

TODO ignore?

- 3.3.1.  Hybrid Flow Steps
- 3.3.2.  Authorization Endpoint
    <!-- - 3.3.2.1.  Authentication Request -->
    <!-- - 3.3.2.2.  Authentication Request Validation -->
    <!-- - 3.3.2.3.  Authorization Server Authenticates End-User -->
    <!-- - 3.3.2.4.  Authorization Server Obtains End-User Consent/Authorization -->
    <!-- - 3.3.2.5.  Successful Authentication Response -->
    <!-- - 3.3.2.6.  Authentication Error Response -->
    <!-- - 3.3.2.7.  Redirect URI Fragment Handling -->
    <!-- - 3.3.2.8.  Authentication Response Validation -->
    <!-- - 3.3.2.9.  Access Token Validation -->
    <!-- - 3.3.2.10.  Authorization Code Validation -->
    <!-- - 3.3.2.11.  ID Token -->
    <!-- - 3.3.2.12.  ID Token Validation -->
- 3.3.3.  Token Endpoint
    <!-- - 3.3.3.1.  Token Request -->
    <!-- - 3.3.3.2.  Token Request Validation -->
    <!-- - 3.3.3.3.  Successful Token Response -->
    <!-- - 3.3.3.4.  Token Error Response -->
    <!-- - 3.3.3.5.  Token Response Validation -->
    <!-- - 3.3.3.6.  ID Token -->
    <!-- - 3.3.3.7.  ID Token Validation -->
    <!-- - 3.3.3.8.  Access Token -->
    <!-- - 3.3.3.9.  Access Token Validation -->

## 4. Initiating Login from a Third Party

TODO

## 5. Claims

- 5.1.  Standard Claims
    <!-- - 5.1.1.  Address Claim -->
    <!-- - 5.1.2.  Additional Claims -->
- 5.2.  Claims Languages and Scripts
- 5.3.  UserInfo Endpoint
    <!-- - 5.3.1.  UserInfo Request -->
    <!-- - 5.3.2.  Successful UserInfo Response -->
    <!-- - 5.3.3.  UserInfo Error Response -->
    <!-- - 5.3.4.  UserInfo Response Validation -->
- 5.4.  Requesting Claims using Scope Values
- 5.5.  Requesting Claims using the "claims" Request Parameter
    <!-- - 5.5.1.  Individual Claims Requests -->
    <!--    - 5.5.1.1.  Requesting the "acr" Claim -->
    <!-- - 5.5.2.  Languages and Scripts for Individual Claims -->
- 5.6.  Claim Types
    <!-- - 5.6.1.  Normal Claims -->
    <!-- - 5.6.2.  Aggregated and Distributed Claims -->
    <!--     - 5.6.2.1.  Example of Aggregated Claims -->
    <!--     - 5.6.2.2.  Example of Distributed Claims -->
- 5.7.  Claim Stability and Uniqueness

## 6. Passing Request Parameters as JWTs

TODO

- 6.1.  Passing a Request Object by Value
    <!-- - 6.1.1.  Request using the "request" Request Parameter -->
- 6.2.  Passing a Request Object by Reference
    <!-- - 6.2.1.  URL Referencing the Request Object -->
    <!-- - 6.2.2.  Request using the "request_uri" Request Parameter -->
    <!-- - 6.2.3.  Authorization Server Fetches Request Object -->
    <!-- - 6.2.4.  "request_uri" Rationale -->
- 6.3.  Validating JWT-Based Requests
    <!-- - 6.3.1.  Encrypted Request Object -->
    <!-- - 6.3.2.  Signed Request Object -->
    <!-- - 6.3.3.  Request Parameter Assembly and Validation -->

## 7. Self-Issued OpenID Provider

TODO

- 7.1.  Self-Issued OpenID Provider Discovery
- 7.2.  Self-Issued OpenID Provider Registration
    <!-- - 7.2.1.  Providing Information with the "registration" Request Parameter -->
- 7.3.  Self-Issued OpenID Provider Request
- 7.4.  Self-Issued OpenID Provider Response
- 7.5.  Self-Issued ID Token Validation

## 8. Subject Identifier Types

TODO

- 8.1.  Pairwise Identifier Algorithm

## 9. Client Authentication

TODO

## 10.  Signatures and Encryption

TODO

- 10.1.  Signing
    <!-- - 10.1.1.  Rotation of Asymmetric Signing Keys -->
- 10.2.  Encryption
    <!-- - 10.2.1.  Rotation of Asymmetric Encryption Keys -->

## 11. Offline Access

TODO

## 12. Using Refresh Tokens

TODO

- 12.1.  Refresh Request
- 12.2.  Successful Refresh Response
- 12.3.  Refresh Error Response

## 13.  Serializations

TODO

- 13.1.  Query String Serialization
- 13.2.  Form Serialization
- 13.3.  JSON Serialization

## 14.  String Operations

TODO

## 15.  Implementation Considerations

TODO

- 15.1.  Mandatory to Implement Features for All OpenID Providers
- 15.2.  Mandatory to Implement Features for Dynamic OpenID Providers
- 15.3.  Discovery and Registration
- 15.4.  Mandatory to Implement Features for Relying Parties
- 15.5.  Implementation Notes
    <!-- - 15.5.1.  Authorization Code Implementation Notes -->
    <!-- - 15.5.2.  Nonce Implementation Notes -->
    <!-- - 15.5.3.  Redirect URI Fragment Handling Implementation Notes -->
- 15.6.  Compatibility Notes
    <!-- - 15.6.1.  Pre-Final IETF Specifications -->
    <!-- - 15.6.2.  Google "iss" Value -->
- 15.7.  Related Specifications and Implementer's Guides

## 16. Security Considerations

TODO

- 16.1. Request Disclosure
- 16.2. Server Masquerading
- 16.3. Token Manufacture/Modification
- 16.4. Access Token Disclosure
- 16.5. Server Response Disclosure
- 16.6. Server Response Repudiation
- 16.7. Request Repudiation
- 16.8. Access Token Redirect
- 16.9. Token Reuse
- 16.10. Eavesdropping or Leaking Authorization Codes (Secondary Authenticator Capture)
- 16.11. Token Substitution
- 16.12. Timing Attack
- 16.13. Other Crypto Related Attacks
- 16.14. Signing and Encryption Order
- 16.15. Issuer Identifier
- 16.16. Implicit Flow Threats
- 16.17. TLS Requirements
- 16.18. Lifetimes of Access Tokens and Refresh Tokens
- 16.19. Symmetric Key Entropy
- 16.20. Need for Signed Requests
- 16.21. Need for Encrypted Requests

## 17. Privacy Considerations

TODO

- 17.1.  Personally Identifiable Information
- 17.2.  Data Access Monitoring
- 17.3.  Correlation
- 17.4.  Offline Access

## 18. IANA Considerations

TODO

- 18.1. JSON Web Token Claims Registration
    <!-- - 18.1.1. Registry Contents -->
- 18.2. OAuth Parameters Registration
    <!-- - 18.2.1. Registry Contents -->
- 18.3. OAuth Extensions Error Registration
    <!-- - 18.3.1. Registry Contents -->

## 19. References

TODO

- 19.1. Normative References
- 19.2. Informative References

## Appendix A. Authorization Examples

TODO

- A.1. Example using response_type=code
- A.2. Example using response_type=id_token
- A.3. Example using response_type=id_token token
- A.4. Example using response_type=code id_token
- A.5. Example using response_type=code token
- A.6. Example using response_type=code id_token token
- A.7. RSA Key Used in Examples

## Appendix B.  Acknowledgements

TODO

## Appendix C.  Notices

TODO
