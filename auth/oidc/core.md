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

-   _Sector Identifier_

    _Host component of a URL used by the Relying Party's organization that is an input to the computation of pairwise Subject Identifiers for that Relying Party.<!-- icehe : 这句没看懂 -->_

-   _Self-Issued OpenID Provider_

    _Personal, self-hosted OpenID Provider that issues self-signed ID Tokens._

-   _Subject Identifier_

    _Locally unique and never reassigned identifier within the Issuer for the End-User, which is intended to be consumed by the Client._

-   **UserInfo Endpoint**

    Protected Resource that, when presented with an Access Token by the Client, returns authorized information about the End-User represented by the corresponding Authorization Grant.

    The **UserInfo Endpoint URL MUST use the https scheme and MAY contain port, path, and query parameter components.**

-   Validation

    Process intended to establish the soundness<!-- 坚固; 公正 --> or correctness of a construct.

-   Verification

    Process intended to test or prove the truth or accuracy of a fact or value.

-   **Voluntary Claim**

    **Claim specified by the Client as being useful but not Essential for the specific task requested by the End-User.**

### 1.3. Overview

TODO

## 2. ID Token

**The primary extension that OpenID Connect makes to OAuth 2.0 to enable End-Users to be Authenticated is the ID Token data structure.**

The ID Token is

- **a security token that contains Claims about the Authentication of an End-User by an Authorization Server** when using a Client, and potentially other requested Claims.
- **represented as a JSON Web Token (JWT).**

The following **Claims are used within the ID Token for all OAuth 2.0 flows used by OpenID Connect:**

-   `iss` REQUIRED

    Issuer Identifier for the Issuer of the response.
    The iss value is a case sensitive URL using the https scheme that contains scheme, host, and optionally, port number and path components and no query or fragment components.

-   `sub` REQUIRED

    Subject Identifier.
    A locally unique and never reassigned identifier within the Issuer for the End-User, which is intended to be consumed by the Client, e.g., 24400320 or AItOawmwtWwcT0k51BayewNvutrJUqsvl6qs7A4.

    It MUST NOT exceed 255 ASCII characters in length.
    The sub value is a case sensitive string.

-   `aud` REQUIRED

    Audience(s) that this ID Token is intended for.

    It MUST contain the OAuth 2.0 client_id of the Relying Party as an audience value.
    It MAY also contain identifiers for other audiences.
    In the general case, the aud value is an array of case sensitive strings.
    In the common special case when there is one audience, the aud value MAY be a single case sensitive string.

-   `exp` REQUIRED

    Expiration time on or after which the ID Token MUST NOT be accepted for processing.

    The processing of this parameter requires that the current date/time MUST be before the expiration date/time listed in the value.
    Implementers MAY provide for some small leeway, usually no more than a few minutes, to account for clock skew.
    Its value is a JSON number representing the number of seconds from 1970-01-01T0:0:0Z as measured in UTC until the date/time.

    _See RFC 3339 for details regarding date/times in general and UTC in particular._

-   `iat` REQUIRED

    Time at which the JWT was issued.

    Its value is a JSON number representing the number of seconds from 1970-01-01T0:0:0Z as measured in UTC until the date/time.

-   `auth_time`

    Time when the End-User authentication occurred.

    Its value is a JSON number representing the number of seconds from 1970-01-01T0:0:0Z as measured in UTC until the date/time.
    When a max_age request is made or when auth_time is requested as an Essential Claim, then this Claim is REQUIRED; otherwise, its inclusion is OPTIONAL.
    (The auth_time Claim semantically corresponds to the OpenID 2.0 PAPE auth_time response parameter.)

-   `nonce`

    String value used to associate a Client session with an ID Token, and to mitigate replay attacks.

    The value is passed through unmodified from the Authentication Request to the ID Token.
    If present in the ID Token, Clients MUST verify that the nonce Claim Value is equal to the value of the nonce parameter sent in the Authentication Request.
    If present in the Authentication Request, Authorization Servers MUST include a nonce Claim in the ID Token with the Claim Value being the nonce value sent in the Authentication Request.
    Authorization Servers SHOULD perform no other processing on nonce values used.
    The nonce value is a case sensitive string.

-   `acr` _OPTIONAL_

    Authentication Context Class Reference.

    String specifying an Authentication Context Class Reference value that identifies the Authentication Context Class that the authentication performed satisfied.
    The value "0" indicates the End-User authentication did not meet the requirements of ISO/IEC 29115 level 1.
    Authentication using a long-lived browser cookie, for instance, is one example where the use of "level 0" is appropriate.
    Authentications with level 0 SHOULD NOT be used to authorize access to any resource of any monetary value.
    (This corresponds to the OpenID 2.0 PAPE nist_auth_level 0.)
    An absolute URI or an RFC 6711 registered name SHOULD be used as the acr value; registered names MUST NOT be used with a different meaning than that which is registered.
    Parties using this claim will need to agree upon the meanings of the values used, which may be context-specific.
    The acr value is a case sensitive string.

-   `amr` _OPTIONAL_

    Authentication Methods References.

    JSON array of strings that are identifiers for authentication methods used in the authentication.
    For instance, values might indicate that both password and OTP authentication methods were used.
    The definition of particular values to be used in the amr Claim is beyond the scope of this specification.
    Parties using this claim will need to agree upon the meanings of the values used, which may be context-specific.
    The amr value is an array of case sensitive strings.

-   `azp` _OPTIONAL_

    Authorized party - the party to which the ID Token was issued.

    If present, it MUST contain the OAuth 2.0 Client ID of this party.
    This Claim is only needed when the ID Token has a single audience value and that audience is different than the authorized party.
    It MAY be included even when the authorized party is the same as the sole audience.
    The azp value is a case sensitive string containing a StringOrURI value.

ID Tokens MAY contain other Claims.
Any Claims used that are not understood MUST be ignored.
_See Sections 3.1.3.6, 3.3.2.11, 5.1, and 7.4 for additional Claims defined by this specification._

ID Tokens MUST be signed using JWS and optionally both signed and then encrypted using JWS and JWE respectively, thereby providing authentication, integrity, non-repudiation, and optionally, confidentiality, _per Section 16.14._
If the ID Token is encrypted, it MUST be signed then encrypted, with the result being a Nested JWT, as defined in [JWT].
ID Tokens MUST NOT use none as the alg value unless the Response Type used returns no ID Token from the Authorization Endpoint (such as when using the Authorization Code Flow) and the Client explicitly requested the use of none at Registration time.

ID Tokens SHOULD NOT use the JWS or JWE x5u, x5c, jku, or jwk Header Parameter fields.
Instead, references to keys used are communicated in advance using Discovery and Registration parameters, per Section 10.

The following is a non-normative example of the set of Claims (the JWT Claims Set) in an ID Token:

```json
{
    "iss": "https://server.example.com",
    "sub": "24400320",
    "aud": "s6BhdRkqt3",
    "nonce": "n-0S6_WzA2Mj",
    "exp": 1311281970,
    "iat": 1311280970,
    "auth_time": 1311280969,
    "acr": "urn:mace:incommon:iap:silver"
}
```

## 3. Authentication

TODO

### 3.1. Authentication using the Authorization Code Flow

#### 3.1.1. Authorization Code Flow Steps

#### 3.1.2. Authorization Endpoint

##### 3.1.2.1. Authentication Request

An Authentication Request is an OAuth 2.0 Authorization Request that requests that the End-User be authenticated by the Authorization Server.

Authorization Servers MUST support the use of the HTTP GET and POST methods defined in RFC 2616 [RFC2616] at the Authorization Endpoint.
**Clients MAY use the HTTP GET or POST methods to send the Authorization Request** to the Authorization Server.

- If using the HTTP **GET** method, the request parameters are serialized using **URI Query String Serialization**, _per Section 13.1._
- If using the HTTP **POST** method, the request parameters are serialized using **Form Serialization**, _per Section 13.2._

OpenID Connect uses the following OAuth 2.0 **request parameters with the Authorization Code Flow:**

-   **`scope`** REQUIRED

    **OpenID Connect requests MUST contain the `openid` scope value.**

    If the `openid` scope value is not present, the behavior is entirely unspecified.
    Other scope values MAY be present.
    Scope values used that are not understood by an implementation SHOULD be ignored.
    _See Sections 5.4 and 11 for additional scope values defined by this specification._

-   **`response_type`** REQUIRED

    OAuth 2.0 Response Type value that **determines the authorization processing flow to be used**, including what parameters are returned from the endpoints used.

    **When using the Authorization Code Flow, this value is `code`.**

-   **`client_id`** REQUIRED

    Auth 2.0 Client Identifier valid at the Authorization Server.

-   **`redirect_uri`** REQUIRED

    **Redirection URI to which the response will be sent.**

    **This URI MUST exactly match one of the Redirection URI values for the Client pre-registered at the OpenID Provider**, with the matching performed _as described in Section 6.2.1 of [RFC3986] (Simple String Comparison)._

    When using this flow, the **Redirection URI SHOULD use the https scheme**; however, it MAY use the http scheme, provided that the Client Type is confidential, _as defined in Section 2._
    1 of OAuth 2.0, and provided the OP allows the use of http Redirection URIs in this case.
    The Redirection URI MAY use an alternate scheme, such as one that is intended to identify a callback into a native application.

-   **`state`** RECOMMENDED

    Opaque value used to **maintain state between the request and the callback.**

    Typically, Cross-Site Request Forgery (CSRF, XSRF) mitigation is done by cryptographically binding the value of this parameter with a browser cookie.

##### 3.1.2.2. Authentication Request Validation

##### 3.1.2.3. Authorization Server Authenticates End-User

##### 3.1.2.4. Authorization Server Obtains End-User Consent/Authorization

##### 3.1.2.5. Successful Authentication Response

##### 3.1.2.6. Authentication Error Response

##### 3.1.2.7. Authentication Response Validation

#### 3.1.3. Token Endpoint

- 3.1.3.1. Token Request
- 3.1.3.2. Token Request Validation
- 3.1.3.3. Successful Token Response
- 3.1.3.4. Token Error Response
- 3.1.3.5. Token Response Validation
- 3.1.3.6. ID Token
- 3.1.3.7. ID Token Validation
- 3.1.3.8. Access Token Validation

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

This section specifies **how the Client can obtain Claims about the End-User and the Authentication event.**

It also **defines a standard set of basic profile Claims.**
**Pre-defined sets of Claims can be requested using specific scope values or individual Claims can be requested using the `claims` request parameter.**
The Claims can come directly from the OpenID Provider or from distributed sources as well.

### 5.1.  Standard Claims

-   `Member` Type

    Description

-   **`sub`** string

    **Subject - Identifier for the End-User at the Issuer.**

-   **`name`** string

    **End-User's full name** in displayable form including all name parts,
    possibly including titles and suffixes, ordered according to the End-User's locale and preferences.

-   **`given_name`** string

    Given name(s) or **first name(s)** of the End-User.

    _Note that in some cultures, people can have multiple given names;_
    _all can be present, with the names being separated by space characters._

-   **`family_name`** string

    Surname(s) or **last name(s)** of the End-User.

    _Note that in some cultures, people can have multiple family names or no family name;_
    _all can be present, with the names being separated by space characters._

-   `middle_name` string

    Middle name(s) of the End-User.

    _Note that in some cultures, people can have multiple middle names; all can be present, with the names being separated by space characters._
    _Also note that in some cultures, middle names are not used._

-   `nickname` string

    Casual name of the End-User that may or may not be the same as the given_name. For instance, a nickname value of Mike might be returned alongside a given_name value of Michael.

-   **`address`** JSON object

    **End-User's preferred postal address.**

    The value of the address member is a JSON [RFC4627] structure containing some or all of the members _defined in Section 5.1.1._

-   `updated_at` number

    Time the End-User's information was last updated.

    **Its value is a JSON number representing the number of seconds from `1970-01-01T0:0:0Z` as measured in UTC until the date/time.**

#### 5.1.1.  Address Claim

#### 5.1.2.  Additional Claims

### 5.2.  Claims Languages and Scripts

### 5.3.  UserInfo Endpoint

<!-- - 5.3.1.  UserInfo Request -->
<!-- - 5.3.2.  Successful UserInfo Response -->
<!-- - 5.3.3.  UserInfo Error Response -->
<!-- - 5.3.4.  UserInfo Response Validation -->

### 5.4.  Requesting Claims using Scope Values

OpenID Connect Clients use `scope` values, _as defined in Section 3.3 of OAuth 2.0 [RFC6749],_ to **specify what access privileges are being requested for Access Tokens.**

The scopes associated with Access Tokens determine what resources will be available when they are used to access OAuth 2.0 protected endpoints.
**Protected Resource endpoints MAY perform different actions and return different information based on the `scope` values** and other parameters used when requesting the presented Access Token.

For OpenID Connect, scopes can be used to request that specific sets of information be made available as Claim Values.

Claims requested by the following scopes are treated by Authorization Servers as Voluntary Claims.

_OpenID Connect defines the following `scope` values that are used to request Claims:_

-   **`profile`** _OPTIONAL_

    This scope value requests access to the End-User's default profile Claims, which are:

    - `name`
    - `family_name`
    - `given_name`
    - `middle_name`
    - `nickname`
    - `preferred_username`
    - `profile`
    - `picture`
    - `website`
    - `gender`
    - `birthdate`
    - `zoneinfo`
    - `locale`
    - `updated_at`

-   **`email`** _OPTIONAL_

    This scope value requests access to the

    - `email` and
    - `email_verified` Claims.

-   **`address`** _OPTIONAL_

    This scope value requests access to the `address` Claim.

-   **`phone`** _OPTIONAL_

    This scope value requests access to the

    - `phone_number` and
    - `phone_number_verified` Claims.

Multiple scope values MAY be used by creating a space delimited, case sensitive list of ASCII scope values.

**The Claims requested by the `profile`, `email`, `address`, and `phone` scope values are returned from the UserInfo Endpoint**, _as described in Section 5.3.2,_ **when a `response_type` value is used that results in an Access Token being issued.**
**However, when no Access Token is issued (which is the case for the `response_type` value `id_token`), the resulting Claims are returned in the ID Token.**

In some cases, the End-User will be given the option to have the OpenID Provider decline to provide some or all information requested by RPs.
To minimize the amount of information that the End-User is being asked to disclose<!-- 揭露, 公开 -->, an RP can elect<!-- 选择, 决定 --> to only request a subset of the information available from the UserInfo Endpoint.

The following is a non-normative example of an unencoded scope request:

```http
scope=openid profile email phone
```

### 5.5.  Requesting Claims using the "claims" Request Parameter

<!-- - 5.5.1.  Individual Claims Requests -->
<!--    - 5.5.1.1.  Requesting the "acr" Claim -->
<!-- - 5.5.2.  Languages and Scripts for Individual Claims -->

### 5.6.  Claim Types

- 5.6.1.  Normal Claims
- 5.6.2.  Aggregated and Distributed Claims
    - 5.6.2.1.  Example of Aggregated Claims
    - 5.6.2.2.  Example of Distributed Claims

### 5.7.  Claim Stability and Uniqueness

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
