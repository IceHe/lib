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

_A simplified illustration of the activity lifecycle :_

![activity-lifecycle.png](_image/activity-lifecycle.png)

As the user begins to leave the activity, the system calls methods to dismantle<!-- 拆除, 拆开 --> the activity.
In some cases, this dismantlement is only partial; the activity still resides in memory (such as when the user switches to another app), and can still come back to the foreground.
If the user returns to that activity, the activity resumes from where the user left off.
With a few exceptions, apps are [restricted from starting activities when running in the background](https://developer.android.com/guide/components/activities/background-starts).

The system's likelihood<!-- 可能性 --> of killing a given process —— along with the activities in it —— depends on the state of the activity at the time.
Activity state and ejection from memory provides more information on the relationship between state and vulnerability to ejection.

Depending on the complexity of your activity, you probably don't need to implement all the lifecycle methods.
_However, it's important that you understand each one and implement those that ensure your app behaves the way users expect._

_The next section of this document provides detail on the callbacks that you use to handle transitions between states._

## Lifecycle callbacks

_This section provides conceptual and implementation information about the callback methods used during the activity lifecycle._

Some actions, such as calling `setContentView()`, belong in the activity lifecycle methods themselves.
However, the code implementing the actions of a dependent component should be placed in the component itself.
To achieve this, you must make the dependent component lifecycle-aware.
_See [Handling Lifecycles with Lifecycle-Aware Components](https://developer.android.com/topic/libraries/architecture/lifecycle) to learn how to make your dependent components lifecycle-aware._

### onCreate()

You must implement `onCreate()` callback, which fires when the system first creates the activity.
On activity creation, the activity enters the _Created_ state.
In the `onCreate()` method, you perform basic application startup logic that should happen only once for the entire life of the activity.

_For example, your implementation of `onCreate()` might bind data to lists, associate the activity with a [`ViewModel`](https://developer.android.com/reference/androidx/lifecycle/ViewModel), and instantiate some class-scope variables._
_This method receives the parameter `savedInstanceState`, which is a [Bundle](https://developer.android.com/reference/android/os/Bundle) object containing the activity's previously saved state._
_If the activity has never existed before, the value of the `Bundle` object is null._

_Omitted_

### onStart()

_Omitted_

### onResume()

_Omitted_

### onPause()

_Omitted_

### onStop()

_Omitted_

### onDestroy()

_Omitted_

## Activity state and ejection from memory

## Saving and restoring transient UI state

- Instance state
- Save simple, lightweight UI state using onSaveInstanceState()
- Restore activity UI state using saved instance state

_Omitted_

## Navigating between activities

The system kills processes when it needs to free up RAM; **the likelihood of the system killing a given process depends on the state of the process at the time**.
**Process state, in turn, depends on the state of the activity running in the process.**

_The table below shows the correlation among process state, activity state, and likelihood of the system’s killing the process._

Relationship between process lifecycle and activity state :

|Likelihood of being killed|Process state|Activity state|
|-|-|-|
|Least|Foreground (having or about to get focus)|Created<br/>Started<br/>Resumed|
|More|Background (lost focus)|Paused|
|Most|Background (not visible)|Stopped|
|Most|Empty|Destroyed|

**The system never kills an activity directly to free up memory.**
**Instead, it kills the process in which the activity runs, destroying not only the activity but everything else running in the process, as well.**
_To learn how to preserve and restore your activity's UI state when system-initiated process death occurs, see [Saving and restoring activity state](https://developer.android.com/guide/components/activities/activity-lifecycle#saras)._

A user can also kill a process by using the Application Manager under Settings to kill the corresponding app.

For more information about processes in general, see [Processes and Threads](https://developer.android.com/guide/components/processes-and-threads#Lifecycle). …

### Starting one activity from another

#### startActivity()

#### startActivityForResult()

#### Coordinating activities
