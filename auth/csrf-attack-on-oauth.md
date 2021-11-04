# CSRF Attack on OAuth 2.0

## Fraud to Bind WeChat Account

## Problem

```plantuml
@startuml
actor attacker as "Attacker"
actor user as "User"

participant geekbang_client as "Geekbang Client"
participant auth_server as "WeChat AuthServer"

collections protected_resource as "ProtectedResource"

attacker -> geekbang_client: Request to bind **Attacker's WeChat account**
activate attacker
activate geekbang_client
attacker <-- geekbang_client: 1. Redirect User to AuthServer
deactivate geekbang_client

attacker -> auth_server: Load AuthServer for authentication with redirect_uri = **https://geekbang.com/client/callback**
activate auth_server
attacker <-- auth_server: 2. authorization code = **codeA** for **Attacker's WeChat account**
deactivate auth_server

note over attacker
    Attacker DO NOT
        exchange for access_token
        with given authorization code DELIBERATELY.
endrnote

attacker -x geekbang_client: Redirect to Geekbang Client redirect_uri \n    with authorization code = **codeA**
deactivate attacker

==Soon==

user <-> geekbang_client: Login via username & password
activate user
user -> geekbang_client: Request to bind **User's WeChat account**
activate geekbang_client
user <-- geekbang_client: 1. Redirect User to AuthServer
deactivate geekbang_client

user -> auth_server: Load AuthServer for authentication \n    with redirect_uri = **https://geekbang.com/client/callback**
activate auth_server
user <-- auth_server: 2. authorization code = **codeB**
deactivate auth_server

note over user
    User DO NOT
        exchange for access_token
        with given authorization code IN TIME.
endrnote

user -x geekbang_client: Redirect to Geekbang Client redirect_uri \n    with authorization code = **codeB**

rnote over user
    Attacker induces User to click the link to
        **https://geekbang.com/client/callback?code=codeA**
endrnote

user -> geekbang_client: Redirect to Geekbang Client redirect_uri \n    with authorization code = **codeA**
activate geekbang_client
deactivate user

geekbang_client -> auth_server: 3. Exchange for access_token \n    with given authorization code = **codeA**
activate auth_server
geekbang_client <-- auth_server: 4. Return **access_token** \n    for **User's Geekbang account** \n        bound to **Attacker's WeChat account**
deactivate auth_server
deactivate geekbang_client

rnote over geekbang_client
    User's Geekbang Account is bound to Attacker's WeChat account.
endrnote

==Later==

rnote over geekbang_client
    Attacker can social-login User's Geekbang account via Attacker's WeChat account NOW!
endrnote

attacker -> geekbang_client: Login via Attacker's WeChat account
activate attacker
activate geekbang_client
attacker <-- geekbang_client: 1. Redirect User to AuthServer
deactivate geekbang_client

attacker -> auth_server: Load AuthServer for authentication with redirect_uri = **https://geekbang.com/client/callback**
activate auth_server
attacker <-- auth_server: 2. authorization code = **codeC** for **Attacker's WeChat account**
deactivate auth_server

attacker -> geekbang_client: Redirect to Geekbang Client redirect_uri \n    with authorization code = **codeC**
activate geekbang_client

geekbang_client -> auth_server: 3. Exchange for access_token \n    with given authorization code = **codeC**
activate auth_server
geekbang_client <-- auth_server: 4. Return **access_token** \n    for **User's Geekbang account** \n        bound to **Attacker's WeChat account**
deactivate auth_server

attacker -> geekbang_client: Do something bad: \n    e.g. access User's private data
geekbang_client -> protected_resource: Load ProtectedResource for User's private data \n    witch **access_token**
activate protected_resource
geekbang_client <-- protected_resource: User's private data
deactivate protected_resource
deactivate geekbang_client
deactivate attacker

@enduml
```

### Solution: Random STATE

```plantuml
@startuml
actor attacker as "Attacker"
actor user as "User"

participant geekbang_client as "Geekbang Client"
participant auth_server as "WeChat AuthServer"

attacker -> geekbang_client: Request to bind **Attacker's WeChat account**
activate attacker
activate geekbang_client
attacker <-- geekbang_client: 1. Redirect User to AuthServer
deactivate geekbang_client

attacker -> auth_server: Load AuthServer for authentication with redirect_uri = **https://geekbang.com/client/callback**
activate auth_server
attacker <-- auth_server: 2. authorization code = **codeA** for **Attacker's WeChat account**
deactivate auth_server

note over attacker
    Attacker DO NOT
        exchange for access_token
        with given authorization code DELIBERATELY.
endrnote

attacker -x geekbang_client: Redirect to Geekbang Client redirect_uri \n    with authorization code = **codeA**
deactivate attacker

==Soon==

user <-> geekbang_client: Login via username & password
activate user
user -> geekbang_client: Request to bind **User's WeChat account**
activate geekbang_client

geekbang_client -> geekbang_client: Generate random state = **stateB** \n    and save in storage
user <-- geekbang_client: 1. Redirect User to Auth Server with state = **stateB**
deactivate geekbang_client


user -> auth_server: Load AuthServer for authentication \n    with redirect_uri = **https://geekbang.com/client/callback** \n        and state = **stateB**
activate auth_server
user <-- auth_server: 2. authorization code = **codeB** \n        and state = **stateB**
deactivate auth_server

note over user
    User DO NOT
        exchange for access_token
        with given authorization code IN TIME.
endrnote

user -x geekbang_client: Redirect to Geekbang Client redirect_uri \n    with authorization code = **codeB** \n        and state = **stateB**

rnote over user
    Attacker induces User to click the link to
        **https://geekbang.com/client/callback?code=codeA&state=stateA**
endrnote

user -> geekbang_client: Redirect to Geekbang Client redirect_uri \n    with authorization code = **codeA** \n        and state = **stateA**
deactivate user
activate geekbang_client

geekbang_client -x geekbang_client: Load original state = **stateB** from storage \n    and compare with current state = **stateA**

rnote over geekbang_client
    Abort becuase state DOES NOT match!
endrnote

geekbang_client -x auth_server: 3. Exchange for access_token \n    with given authorization code = **codeA**
deactivate geekbang_client

rnote over geekbang_client
    State protects User!
endrnote

@enduml
```
