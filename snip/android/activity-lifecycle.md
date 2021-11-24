# Activity Lifecycle

---

References

- [The Activity Lifecycle](https://developer.android.com/guide/components/activities/activity-lifecycle#saras)

## Intro

As a user navigates through, out of, and back to your app, the `Activity` instances in your app transition through different states in their lifecycle.
**The `Activity` class provides a number of callbacks that allow the activity to know that a state has changed: that the system is creating, stopping, or resuming an activity, or destroying the process in which the activity resides.**

Within the lifecycle callback methods, you can declare how your activity behaves when the user leaves and re-enters the activity.
_For example, if you're building a streaming video player, you might pause the video and terminate the network connection when the user switches to another app._
_When the user returns, you can reconnect to the network and allow the user to resume the video from the same spot._

In other words, each callback allows you to perform specific work that's appropriate to a given change of state.
Doing the right work at the right time and handling transitions properly make your app more robust and performant.
_For example, good implementation of the lifecycle callbacks can help ensure that your app avoids:_

- _Crashing if the user receives a phone call or switches to another app while using your app._
- _Consuming valuable system resources when the user is not actively using it._
- _Losing the user's progress if they leave your app and return to it at a later time._
- _Crashing or losing the user's progress when the screen rotates between landscape and portrait orientation._

_This document explains the activity lifecycle in detail._
_The document begins by describing the lifecycle paradigm._
_Next, it explains each of the callbacks: what happens internally while they execute, and what you should implement during them._
_It then briefly introduces the relationship between activity state and a process’s vulnerability to being killed by the system._
_Last, it discusses several topics related to transitions between activity states._

For information about handling lifecycles, including guidance about best practices, see [Handling Lifecycles with Lifecycle-Aware Components](https://developer.android.com/topic/libraries/architecture/lifecycle) and [Saving UI States](https://developer.android.com/topic/libraries/architecture/saving-states).
To learn how to architect a robust, production-quality app using activities in combination with architecture components, see Guide to [App Architecture](https://developer.android.com/topic/libraries/architecture/guide).

## Activity-lifecycle concepts

To navigate **transitions between stages of the activity lifecycle**, the **Activity class provides a core set of six callbacks**:

- `onCreate()`
- `onStart()`
- `onResume()`
- `onPause()`
- `onStop()`
- `onDestroy()`

**The system invokes each of these callbacks as an activity enters a new state.**

_The figure below presents a visual representation of this paradigm._

![activity-lifecycle.png](_image/activity-lifecycle.png)

## Lifecycle callbacks

- onCreate()
- onStart()
- onResume()
- onPause()
- onStop()
- onDestroy()

_Omitted_

## Activity state and ejection from memory

## Saving and restoring transient UI state

- Instance state
- Save simple, lightweight UI state using onSaveInstanceState()
- Restore activity UI state using saved instance state

_Omitted_

## Navigating between activities

### Starting one activity from another

#### startActivity()

#### startActivityForResult()

#### Coordinating activities
