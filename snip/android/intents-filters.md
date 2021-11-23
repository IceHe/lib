# Intents and Intent Filters

An Intent is a messaging object you can use to request an action from another app component.

---

References

- [Intents and Intent Filters](https://developer.android.com/guide/components/intents-filters)

## Intro

**An [`Intent`](https://developer.android.com/reference/android/content/Intent) is a messaging object you can use to request an action from another [app component](https://developer.android.com/guide/components/fundamentals#Components).**

Although intents facilitate communication between components in several ways, there are three **fundamental use cases** :

-   **Starting an activity**

    **An [`Activity`](https://developer.android.com/reference/android/app/Activity) represents a single screen in an app**.
    You can **start a new instance of an `Activity` by passing an `Intent` to [`startActivity()`](https://developer.android.com/reference/android/content/Context#startActivity(android.content.Intent))**.
    **The `Intent` describes the activity to start and carries any necessary data**.

    **If you want to receive a result from the activity when it finishes, call [`startActivityForResult()`](https://developer.android.com/reference/android/app/Activity#startActivityForResult(android.content.Intent,%20int)).**
    Your **activity receives the result as a separate `Intent` object in your activity's [`onActivityResult()`](https://developer.android.com/reference/android/app/Activity#onActivityResult(int,%20int,%20android.content.Intent)) callback**.
    _For more information, see the [Activities](https://developer.android.com/guide/components/activities) guide._

-   **Starting a service**

    **A [`Service`](https://developer.android.com/reference/android/app/Service) is a component that performs operations in the background without a user interface.**
    With Android 5.0 (API level 21) and later, you **can start a service with [`JobScheduler`](https://developer.android.com/reference/android/app/job/JobScheduler)**.
    _For more information about `JobScheduler`, see its [`API-reference documentation`](https://developer.android.com/reference/android/app/job/JobScheduler)._

    _For versions earlier than Android 5.0 (API level 21), you can start a service by using methods of the `Service` class._
    You **can start a service to perform a one-time operation (such as downloading a file) by passing an `Intent` to [`startService()`](https://developer.android.com/reference/android/content/Context#startService(android.content.Intent))**.
    **The `Intent` describes the service to start and carries any necessary data.**

    If the service is designed with a client-server interface, you can bind to the service from another component by passing an `Intent` to [`bindService()`](https://developer.android.com/reference/android/content/Context#bindService(android.content.Intent,%20android.content.ServiceConnection,%20int)).
    _For more information, see the [Services](https://developer.android.com/guide/components/services) guide._

-   **Delivering a broadcast**

    **A broadcast is a message that any app can receive.**
    **The system delivers various broadcasts for system events, such as when the system boots up or the device starts charging.**
    You **can deliver a broadcast to other apps by passing an `Intent` to [`sendBroadcast()`](https://developer.android.com/reference/android/content/Context#sendBroadcast(android.content.Intent)) or [`sendOrderedBroadcast()`](https://developer.android.com/reference/android/content/Context#sendOrderedBroadcast(android.content.Intent,%20java.lang.String))**.

_The rest of this page explains **how intents work** and **how to use** them._
_For related information, see [Interacting with Other Apps](https://developer.android.com/training/basics/intents) and [Sharing Content](https://developer.android.com/training/sharing)._

## Intent types
