# Sentry Notes

References:

-   [Sentry Docs](https://docs.sentry.io/)
    -   [Product - Basics](https://docs.sentry.io/product/sentry-basics/)
    -   [Platform - Nodes.js](https://docs.sentry.io/platforms/node/)

## Ideas & Notes

-   log → event (messages & errors)
    -   capturing errors
-   deploy logto core instance → release & release health
-   only log necessary properties
    -   Sentry SDK save too much context data by default.
    -   needed by Logto admin users & end users
-   deep dive
    -   Breadcrumbs
    -   Scopes
-   search user logs & management logs
    -   in Sentry instead of Logto Admin Console Audit Logs?
-   analyze DNU, DAU, MAU, etc.
    -   in Sentry Dashboard instead of Logto Admin Console Dashboard?
    -   need customization
-   tracing
    -   enabled in development/integration-tests environments?
    -   trace database queries for postgresql?

## Product

### Key Terms

-   **sentry.io** - Sentry's user interface for SaaS customers, where event data captured by our SDK is visualized.
    -   For self-hosted users, the user interface is on an internal domain for your company.
    -   _better self-hosted?_
-   **environment**
    -   development
    -   production
    -   integration-tests? _unnecessary?_
-   **event** - An error or a transaction.
    -   _focus on errors for now_
-   **issues** - An issue is a grouping of similar error events
-   **transaction** - A transaction represents a single instance of a service being called to support an operation you want to measure or **track**, _like a page load, page navigation, or asynchronous task._
    -   Transaction events are grouped by the transaction name.
-   transaction
-   data
-   project - A project represents your service or application in Sentry.
    -   _一个 project 对应一个/一组 Logto core 实例_
-   DSN
-   **release**
-   **release health**
-   performance monitoring
-   **alerts** - Alerts let you know about problems with your code in real-time by sending you notifications when certain alert rule conditions are met.
    -   There are several types of alerts available with customizable thresholds and integrations.

### Key Features

-   **Alerts**: for administrators and managers
-   Discover
-   **Dashboards**

## Node.js SDK

### Configuration

-   environment
-   ……

#### Hooks

These options can be used to hook the SDK in various ways to **customize the reporting of events**.

##### beforeSend

This function is called with an SDK-specific event object, and can return a modified event object or nothing to skip reporting the event.

##### beforeBreadcrumb

This function is called with an SDK-specific breadcrumb object before the breadcrumb is added to the scope.
……
To pass the breadcrumb through, return the first argument, which contains the breadcrumb object.
The callback typically gets a second argument (called a "hint") which contains the original object from which the breadcrumb was created to further customize what the breadcrumb should look like.

## Usage

### Basics

Main Types

-   Success log → Messages
-   Error log → Errors

```javascript
Sentry.captureMessage("Something happened.");

// ……

try {
    // ...
} catch (e) {
    Sentry.captureException(e);
}
```

Level

-   Success log → info / debug
-   Error log → warning / critical / fatal

### Add more details in events

#### Context

-   user profile
-   _tags? unnecessary_

#### Identify users

-   logto user id

#### Breadcrumbs

Sentry uses breadcrumbs to create **a trail of events that happened prior to an issue**.
_These events are very similar to traditional logs, but can record more rich structured data._

#### Scopes and Hubs

You can think of the hub as the central point that our SDKs use to route an event to Sentry.
When you call `init()` a hub is created and a client and a blank scope are created on it.
That hub is then associated with the current thread and will internally hold a stack of scopes.

**The scope will hold useful information that should be sent along with the event.**
For instance contexts or breadcrumbs are stored on the scope.
**When a scope is pushed, it inherits all data from the parent scope** and when it pops all modifications are reverted.
