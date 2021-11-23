# Intents and Intent Filters

An Intent is a messaging object you can use to request an action from another app component.

---

References

- [Intents and Intent Filters](https://developer.android.com/guide/components/intents-filters)
- [Intent](https://developer.android.com/reference/android/content/Intent)

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

There are two types of intents:

-   **Explicit intents**

    **specify which application will satisfy the intent, by supplying either the target app's package name or a fully-qualified component class name.**

    _You'll typically use an explicit intent to start a component in your own app, because you know the class name of the activity or service you want to start._

    _For example, you might start a new activity within your app in response to a user action, or start a service to download a file in the background._

-   **Implicit intents**

    **do not name a specific component, but instead declare a general action to perform, which allows a component from another app to handle it.**

    _For example, if you want to show the user a location on a map, you can use an implicit_

The figure below shows how an intent is used when starting an activity.
**When the `Intent` object names a specific activity component explicitly, the system immediately starts that component.**

![intent-filters.png](_image/intent-filters.png)

How an implicit intent is delivered through the system to start another activity :

1. `Activity` A creates an `Intent` with an action description and passes it to `startActivity()`.
2. The Android System searches all apps for an intent filter that matches the intent.
3. When a match is found, the system starts the matching activity (Activity B) by invoking its `onCreate()` method and passing it the Intent.

**When you use an implicit intent, the Android system finds the appropriate component to start by comparing the contents of the intent to the intent filters declared in the manifest file of other apps on the device.**
**If the intent matches an intent filter, the system starts that component and delivers it the Intent object.**
**If multiple intent filters are compatible, the system displays a dialog so the user can pick which app to use.**

An intent filter is an expression in an app's manifest file that specifies the type of intents that the component would like to receive.
For instance, by declaring an intent filter for an activity, you make it possible for other apps to directly start your activity with a certain kind of intent.
_Likewise, if you do not declare any intent filters for an activity, then it can be started only with an explicit intent._

> **Caution** :
> To ensure that your app is secure, always use an explicit intent when starting a `Service` and do not declare intent filters for your services.
> Using an implicit intent to start a service is a security hazard because you can't be certain what service will respond to the intent, and the user can't see which service starts.
> Beginning with Android 5.0 (API level 21), the system throws an exception if you call `bindService()` with an implicit intent.

## Building an intent

**An `Intent` object carries information that the Android system uses to determine which component to start** (such as the exact component name or component category that should receive the intent), **plus information that the recipient component uses in order to properly perform the action** (such as the action to take and the data to act upon).

The primary information contained in an `Intent` is the following:

-   **Component name**

-   **Action**

-   **Data**

-   **Category**

-   **Extras**

-   **Flags**

### Example explicit intent

### Example implicit intent

### Forcing an app chooser

_Omitted_

### Detect unsafe intent launches

_Omitted_

## Receiving an implicit intent

**To advertise which implicit intents your app can receive, declare one or more intent filters for each of your app components with an [`<intent-filter>`](https://developer.android.com/guide/topics/manifest/intent-filter-element) element in your [manifest file](https://developer.android.com/guide/topics/manifest/manifest-intro).**
**Each intent filter specifies the type of intents it accepts based on the intent's action, data, and category.**
The system delivers an implicit intent to your app component only if the intent can pass through one of your intent filters.

> **Note**: An explicit intent is always delivered to its target, regardless of any intent filters the component declares.

An app component should declare separate filters for each unique job it can do.

_For example, one activity in an image gallery app may have two filters: one filter to view an image, and another filter to edit an image._
_When the activity starts, it inspects the `Intent` and decides how to behave based on the information in the `Intent` (such as to show the editor controls or not)._

Each intent filter is defined by an `<intent-filter>` element in the app's manifest file, nested in the corresponding app component (such as an `<activity>` element).

In each app component that includes an `<intent-filter>` element, explicitly set a value for `android:exported`.
This attribute indicates whether the app component is accessible to other apps.
In some situations, such as activities whose intent filters include the `LAUNCHER` category, it's useful to set this attribute to true.
Otherwise, it's safer to set this attribute to `false`.

> **Warning**: If an activity, service, or broadcast receiver in your app uses intent filters and doesn't explicitly set the value for android:exported, your app can't be installed on a device that runs Android 12 or higher.

Inside the `<intent-filter>`, you can specify the type of intents to accept using one or more of these three elements :

-   `<action>`

    **Declares the intent action accepted, in the name attribute.**

    _The value must be the literal string value of an action, not the class constant._

-   `<data>`

    **Declares the type of data accepted**,

    using one or more attributes that specify various aspects of the data URI (scheme, host, port, path) and MIME type.

-   `<category>`

    **Declares the intent category accepted, in the name attribute.**

    _The value must be the literal string value of an action, not the class constant._

    > **Note**: To receive implicit intents, you must include the [CATEGORY_DEFAULT](https://developer.android.com/reference/android/content/Intent#CATEGORY_DEFAULT) category in the intent filter.
    > The methods `startActivity()` and `startActivityForResult()` treat all intents as if they declared the CATEGORY_DEFAULT category.
    > If you do not declare this category in your intent filter, no implicit intents will resolve to your activity.

_For example, here's an activity declaration with an intent filter to receive an [ACTION_SEND](https://developer.android.com/reference/android/content/Intent#ACTION_SEND) intent when the data type is text:_

```xml
<activity android:name="ShareActivity" android:exported="false">
    <intent-filter>
        <action android:name="android.intent.action.SEND"/>
        <category android:name="android.intent.category.DEFAULT"/>
        <data android:mimeType="text/plain"/>
    </intent-filter>
</activity>
```

You can create a filter that includes more than one instance of `<action>`, `<data>`, or `<category>`.
If you do, you need to be certain that the component can handle any and all combinations of those filter elements.

When you want to handle multiple kinds of intents, but only in specific combinations of action, data, and category type, then you need to create multiple intent filters.

**An implicit intent is tested against a filter by comparing the intent to each of the three elements.**
**To be delivered to the component, the intent must pass all three tests.**
**If it fails to match even one of them, the Android system won't deliver the intent to the component.**
However, because a component may have multiple intent filters, an intent that does not pass through one of a component's filters might make it through on another filter.
_More information about how the system resolves intents is provided in the section below about [Intent Resolution](https://developer.android.com/guide/components/intents-filters?hl=en#Resolution)._

> **Caution**:
> Using an intent filter isn't a secure way to prevent other apps from starting your components.
> Although intent filters restrict a component to respond to only certain kinds of implicit intents, another app can potentially start your app component by using an explicit intent if the developer determines your component names.
> If it's important that only your own app is able to start one of your components, do not declare intent filters in your manifest.
> Instead, set the `exported` attribute to `"false"` for that component.
>
> Similarly, to avoid inadvertently running a different app's **Service**, always use an explicit intent to start your own service.

---

> **Note**:
> For all activities, you must declare your intent filters in the manifest file.
> However, filters for broadcast receivers can be registered dynamically by calling `registerReceiver()`.
> You can then unregister the receiver with `unregisterReceiver()`.
> Doing so allows your app to listen for specific broadcasts during only a specified period of time while your app is running.

### Example filter

_To demonstrate some of the intent filter behaviors, here is an example from the manifest file of a social-sharing app:_

```xml
<activity android:name="MainActivity" android:exported="true">
    <!-- This activity is the main entry, should appear in app launcher -->
    <intent-filter>
        <action android:name="android.intent.action.MAIN" />
        <category android:name="android.intent.category.LAUNCHER" />
    </intent-filter>
</activity>

<activity android:name="ShareActivity" android:exported="false">
    <!-- This activity handles "SEND" actions with text data -->
    <intent-filter>
        <action android:name="android.intent.action.SEND"/>
        <category android:name="android.intent.category.DEFAULT"/>
        <data android:mimeType="text/plain"/>
    </intent-filter>
    <!-- This activity also handles "SEND" and "SEND_MULTIPLE" with media data -->
    <intent-filter>
        <action android:name="android.intent.action.SEND"/>
        <action android:name="android.intent.action.SEND_MULTIPLE"/>
        <category android:name="android.intent.category.DEFAULT"/>
        <data android:mimeType="application/vnd.google.panorama360+jpg"/>
        <data android:mimeType="image/*"/>
        <data android:mimeType="video/*"/>
    </intent-filter>
</activity>
```

_The first activity, `MainActivity`, is the app's main entry point —— the activity that opens when the user initially launches the app with the launcher icon:_

-   The **ACTION_MAIN** action indicates this is the **main entry point** and **does not expect any intent data**.
-   The **CATEGORY_LAUNCHER** category indicates that this activity's icon should be placed in the system's app launcher.
    If the `<activity>` element does not specify an icon with icon, then the system uses the icon from the `<application>` element.

These two must be paired together in order for the activity to appear in the app launcher.

The second activity, `ShareActivity`, is intended to facilitate sharing text and media content.
Although users might enter this activity by navigating to it from `MainActivity`, they can also enter ShareActivity directly from another app that issues an implicit intent matching one of the two intent filters.

> _**Note**: The MIME type, `application/vnd.google.panorama360+jpg`, is a special data type that specifies panoramic photos, which you can handle with the Google panorama APIs._

## Others

_Omitted_

Using a pending intent

- Specify mutability
- Use explicit intents within pending intents

Intent resolution

- Action test
- Category test
- Data test
- Intent matching
