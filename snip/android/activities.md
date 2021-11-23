# Activities

---

References

- [Introduction to Activities](https://developer.android.com/guide/components/activities/intro-activities)
- [Activity](https://developer.android.com/reference/android/app/Activity)

## Intro

**The [`Activity`](https://developer.android.com/reference/android/app/Activity) class is a crucial component of an Android app, and the way activities are launched and put together is a fundamental part of the platform's application model.**
****Unlike programming paradigms in which apps are launched with a `main()` method, the Android system initiates code in an `Activity` instance by invoking specific callback methods that correspond to specific stages of its lifecycle.**

…… _For additional information about best practices in architecting your app, see [Guide to App Architecture](https://developer.android.com/topic/libraries/architecture/guide)._

## The concept of activities

The mobile-app experience differs from its desktop counterpart in that a user's interaction with the app doesn't always begin in the same place.
Instead, the user journey often begins non-deterministically.
_For instance, if you open an email app from your home screen, you might see a list of emails._
_By contrast, if you are using a social media app that then launches your email app, you might go directly to the email app's screen for composing an email._

The `Activity` class is designed to facilitate this paradigm.
**When one app invokes another, the calling app invokes an activity in the other app, rather than the app as an atomic whole.**
In this way, **the activity serves as the entry point for an app's interaction with the user**.
You implement an activity as a subclass of the Activity class.

**An activity provides the window in which the app draws its UI.**
This window typically fills the screen, but may be smaller than the screen and float on top of other windows.
**Generally, one activity implements one screen in an app.**
_For instance, one of an app's activities may implement a Preferences screen, while another activity implements a Select Photo screen._

Most apps contain multiple screens, which means they comprise multiple activities.
Typically, one activity in an app is specified as the main activity, which is the first screen to appear when the user launches the app.
Each activity can then start another activity in order to perform different actions.
_For example, the main activity in a simple e-mail app may provide the screen that shows an e-mail inbox._
_From there, the main activity might launch other activities that provide screens for tasks like writing e-mails and opening individual e-mails._

Although activities work together to form a cohesive user experience in an app, each activity is only loosely bound to the other activities; there are usually minimal dependencies among the activities in an app.
In fact, activities often start up activities belonging to other apps.
_For example, a browser app might launch the Share activity of a social-media app._

To use activities in your app, you must register information about them in the app's manifest, and you must manage activity lifecycles appropriately.
_The rest of this document introduces these subjects._

## Configuring the manifest

**For your app to be able to use activities, you must declare the activities, and certain of their attributes, in the manifest.**

### Declare activities

To declare your activity, open your manifest file and add an `<activity>` element as a child of the `<application>` element.
_For example:_

```xml
<manifest ... >
  <application ... >
      <activity android:name=".ExampleActivity" />
      ...
  </application ... >
  ...
</manifest >
```

**The only required attribute for this element is [android:name](https://developer.android.com/guide/topics/manifest/activity-element#nm), which specifies the class name of the activity.**
You can also add attributes that define activity characteristics such as label, icon, or UI theme.
_For more information about these and other attributes, see the `<activity>` element reference documentation._

> **Note**:
> After you publish your app, you should not change activity names.
> If you do, you might break some functionality, such as app shortcuts.
> _For more information on changes to avoid after publishing, see [Things That Cannot Change](https://developer.android.com/guide/topics/manifest/activity-element#nm)._

### Declare intent filters

### _Declare permissions_

## Managing the activity lifecycle

### onCreate()

### onStart()

### onResume()

### onPause()

### onStop()

### onRestart()

### onDestroy()

TODO
