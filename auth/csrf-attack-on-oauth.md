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
geekbang_client -> geekbang_client: generate and store state = **stateB**
user <-- geekbang_client: 1. Redirect User to Auth Server with state = **stateB**

user -> auth_serv: Load Auth Server for authentication \n    with redirect uri = **geekbang_client/callback** \n        and state = **stateB**
user <-- auth_serv: 2. auth code = **authCodeB** \n        and state = **stateB**

note over user
    The user DO NOT
        exchange for access_token
        with given auth code IN TIME.
endrnote

user -x geekbang_client: Redirect to geekbang_client redirect uri \n    with auth code = **authCodeB** \n        and state = **stateB**

rnote over user
    Be induced to click the link to
        **geekbang_client/callback?code=authCodeA&state=stateA**.
endrnote

user -> geekbang_client: Redirect to geekbang_client redirect uri \n    with auth code = **authCodeA** \n        and state = **stateA**

geekbang_client -x geekbang_client: check original state (**stateB**) and current state (**stateA**)

rnote over geekbang_client
    Aborted: becuase state is not equal!
endrnote

geekbang_client -x auth_serv: 3. Exchange for access_token \n    with given auth code = **authCodeA**

rnote over geekbang_client
    State protect User!
endrnote

@enduml
```
