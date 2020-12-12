# terminal-notifier

terminal-notifier (2.0.0) is a command-line tool to send macOS User Notifications.

---

- **Notice : Only on macOS**

References

- https://github.com/julienXX/terminal-notifier

## Install

```bash
brew install terminal-notifier
```

## Synopsis

```bash
terminal-notifier -[message|list|remove] [VALUE|ID|ID] [options]
```

## Options

### Required

Either of these is required (unless message data is piped to the tool):

- `-help` Display this help banner.
- `-version` Display terminal-notifier version.
- **`-message VALUE` The notification message.**
- `-remove ID` Removes a notification with the specified 'group' ID.
- `-list ID` If the specified 'group' ID exists show when it was delivered, or use 'ALL' as ID to see all notifications.
    - The output is a tab-separated list.

### Optional

- **`-title VALUE` The notification title. Defaults to ‘Terminal’.**
- `-subtitle VALUE` The notification subtitle.
- `-sound NAME` The name of a sound to play when the notification appears. The names are listed in Sound Preferences. Use 'default' for the default notification sound.
- `-group ID` A string which identifies the group the notifications belong to.
    - **Old notifications with the same ID will be removed!**
- `-activate ID` The bundle identifier of the application to activate when the user clicks the notification.
- _`-sender ID` The bundle identifier of the application that should be shown as the sender, including its icon._
- _`-appIcon URL` The URL of a image to display instead of the application icon (Mavericks+ only)_
- _`-contentImage URL`  The URL of a image to display attached to the notification (Mavericks+ only)_
- **`-open URL` The URL of a resource to open when the user clicks the notification.**
- **`-execute COMMAND` A shell command to perform when the user clicks the notification.**
- **`-ignoreDnD` Send notification even if Do Not Disturb is enabled.**

## Other Description

- When the user activates a notification, the results are logged to the system logs.
    - Use `Console.app` to view these logs.
- _Note that in some circumstances the first character of a message has to be escaped in order to be recognized._
- _An example of this is when using an open bracket, which has to be escaped like so: `\[`._

## Usage

### Just Notify

- Even "Do Not Disturb" is enabled.

```bash
terminal-notifier \
    -title "提醒框" \
    -message "测试强制浮窗" \
    -ignoreDnD \
    -group 1
```

### Click to Open URL

```bash
terminal-notifier \
    -title "提醒框" \
    -message "测试点击打开链接" \
    -ignoreDnD \
    -group 1 \
    -open https://icehe.xyz/
```

### Click to Execute Command

```bash
terminal-notifier \
    -title "提醒框" \
    -message "测试点击执行命令: 打开目录 ~/Documents" \
    -ignoreDnD \
    -group 1 \
    -execute 'open ~/Documents'
```

_It doesn't work below._

```bash
terminal-notifier \
    -title "提醒框" \
    -message "测试点击执行命令: 弹出一个别的弹框" \
    -ignoreDnD \
    -group 1 \
    -execute 'terminal-notifier -title "提醒框" -message "测试点击打开链接" -ignoreDnD -group 1 -open https://icehe.xyz/'
```
