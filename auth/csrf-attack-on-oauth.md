# CSRF Attack on OAuth 2.0

## Fraud to Bind WeChat Account

## Problem

```plantuml
@startuml
actor attacker as "Attacker"
actor user as "User"

participant geekbang_client as "Geekbang Client"

participant auth_serv as "WeChat Auth Server"
participant protected_res as "Resource Provider"

attacker -> geekbang_client: Request to bind **Attacker's WeChat account**
attacker <-- geekbang_client: 1. Redirect User to Auth Server

attacker -> auth_serv: Load Auth Server for authentication with redirect uri = **geekbang_client/callback**
attacker <-- auth_serv: 2. auth code = **authCodeA** for **Attacker's WeChat account**

note over attacker
    Attacker DO NOT
        exchange for access_token
        with given auth code DELIBERATELY.
endrnote

attacker -x geekbang_client: Redirect to geekbang_client redirect uri \n    with auth code = **authCodeA**

==Soon==

user -> geekbang_client: Login via username & password

user -> geekbang_client: Request to bind **User's WeChat account**

note over user
    The user DO NOT
        exchange for access_token
        with given auth code IN TIME.
endrnote

user -> geekbang_client: Request to bind **User's WeChat account**
user <-- geekbang_client: 1. Redirect User to Auth Server

user -> auth_serv: Load Auth Server for authentication \n    with redirect uri = **geekbang_client/callback**
user <-- auth_serv: 2. auth code = **authCodeB**

note over user
    The user DO NOT
        exchange for access_token
        with given auth code IN TIME.
endrnote

user -x geekbang_client: Redirect to geekbang_client redirect uri \n    with auth code = **authCodeB**

rnote over user
    Be induced to click the link to
        **geekbang_client/callback?code=authCodeA**.
endrnote

user -> geekbang_client: Redirect to geekbang_client redirect uri \n    with auth code = **authCodeA**

geekbang_client -> auth_serv: 3. Exchange for access_token \n    with given auth code = **authCodeA**
geekbang_client <-- auth_serv: 4. Return **access_token** for **User's Geekbang account & Attacker's WeChat account**

rnote over geekbang_client
    User's Geekbang Account is bound to Attacker's WeChat account.
endrnote

==Later==

attacker -> geekbang_client: Login via attacker's WeChat account
attacker <-- geekbang_client: 1. Redirect User to Auth Server

attacker -> auth_serv: Load Auth Server for authentication with redirect uri = **geekbang_client/callback**
attacker <-- auth_serv: 2. auth code = **authCodeC** for **Attacker's WeChat account**

attacker -> geekbang_client: Redirect to geekbang_client redirect uri \n    with auth code = **authCodeC**

geekbang_client -> auth_serv: 3. Exchange for access_token \n    with given auth code = **authCodeC**
geekbang_client <-- auth_serv: 4. Return **access_token** for **User's Geekbang account & Attacker's WeChat account**

rnote over geekbang_client
    Attacker can access User's Geekbang account!
endrnote

@enduml
```

### Solution

<!--

---

```plantuml
@startuml
actor attacker as "Attacker"
actor user as "Normal User"

participant attack_client as "Attack Client"
participant normal_client as "Normal Client"

participant auth_serv as "Auth Server"
participant protected_res as "Resource Provider"

attacker -> attack_client
attacker <-- attack_client: 1. Redirect User to Auth Server

attacker -> auth_serv: Load Auth Server for authentication with redirect uri = **attack_client/callback**
attacker <-- auth_serv: 2. auth code = **authCodeA**

note over attacker
    The attacker DO NOT
        exchange for access_token
        with given auth code DELIBERATELY
endrnote

attacker -x attack_client: Redirect to client redirect uri \n    with auth code = **authCodeA**

==soon==

user -> normal_client: Request to bind his WeChat account
user <-- normal_client: 1. Redirect User to Auth Server

user -> auth_serv: Load Auth Server for authentication \n    with redirect uri = **normal_client/callback**
user <-- auth_serv: 2. auth code = **authCodeB**

note over user
    The user DO NOT
        exchange for access_token
        with given auth code IN TIME
endrnote

user -x normal_client: Redirect to client redirect uri \n    with auth code = **authCodeB**

rnote over user
    Be induced to click the link to
        **normal_client/callback?code=authCodeA**
endrnote

user -> normal_client: Redirect to client redirect uri \n    with auth code = **authCodeA**

normal_client -> auth_serv: 3. Exchange for access_token \n    with given auth code = **authCodeA**
normal_client <-- auth_serv: 4. Return access_token & refresh_token

@enduml
```

-->
