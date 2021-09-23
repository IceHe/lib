# Keycloak

Keycloak is an open source Identity and Access Management solution aimed at modern applications and services.

It makes it easy to secure applications and services with little to no code.

---

References

- [Keycloak](https://www.keycloak.org)
    - [About](https://www.keycloak.org/about)
    - [Documentation](https://www.keycloak.org/documentation)
    - [Get Started Guide](https://www.keycloak.org/docs/latest/getting_started/index.html)

## Intro

-   Add authentication to applications and secure services with minimum fuss.

    **No need to deal with storing users or authenticating users**. _It's all available out of the box._

-   You'll even get advanced features such as User Federation, **Identity Brokering and Social Login**.

## Features

-   **Single-Sign On**

    **Login once to multiple applications**

-   Standard Protocols

    **OpenID Connect**, **OAuth 2.0** and **SAML 2.0**

-   _Centralized Management_

    _For admins and users_

-   Adapters

    **Secure** applications and services easily

    _We have adapters available for a number of platforms and programming languages, but if there's not one available for your chosen platform don't worry._
    _Keycloak is built on standard protocols so you can use any OpenID Connect Resource Library or SAML 2.0 Service Provider library out there._

-   **LDAP** and **Active Directory**

    **Connect to existing user directories**

    -   Kerberos <!-- 三头犬 --> bridge

        If your users authenticate to workstations with Kerberos
        ( LDAP or active directory )
        they can also be automatically authenticated to Keycloak
        without having to provide their username and password again
        after they log on to the workstation.

    -   User Federation

        Keycloak has built-in support to connect to existing LDAP or Active Directory servers.
        You can also implement your own provider if you have users in other stores, such as a relational database.

-   **Social Login**

    Easily enable **social login**

-   Identity Brokering

    **OpenID Connect** or **SAML 2.0 IdPs**

-   _High Performance_

    _Lightweight, fast and scalable_

-   _Clustering_

    _For scalability and availability_

-   _Themes_

    _Customize look and feel_

-   _Extensible_

    _Customize through code_

-   Password Policies ( ? )

    Customize password policies
