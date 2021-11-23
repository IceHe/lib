# Intents and Intent Filters

An Intent is a messaging object you can use to request an action from another app component.

---

References

- [Intents and Intent Filters](https://developer.android.com/guide/components/intents-filters)

## Intro

**An [`Intent`](https://developer.android.com/reference/android/content/Intent) is a messaging object you can use to request an action from another [app component](https://developer.android.com/guide/components/fundamentals#Components).**

Although intents facilitate communication between components in several ways, there are three **fundamental use cases** :

-   **Starting an activity**

    **An `Activity` represents a single screen in an app**.
    You can **start a new instance of an `Activity` by passing an `Intent` to `startActivity()`**.
    **The `Intent` describes the activity to start and carries any necessary data**.

    If you want to receive a result from the activity when it finishes, call `startActivityForResult()`.
    Your activity receives the result as a separate `Intent` object in your activity's `onActivityResult()` callback.
    _For more information, see the Activities guide._

-   **Starting a service**

-   **Delivering a broadcast**

_The rest of this page explains **how intents work** and **how to use** them._
_For related information, see [Interacting with Other Apps](https://developer.android.com/training/basics/intents) and [Sharing Content](https://developer.android.com/training/sharing)._

## Intent types
