# Keyboard Maestro

* [https://www.keyboardmaestro.com/main/](https://www.keyboardmaestro.com/main/)

## Search in Web

* `⌘ ^ ⇧ A` Amazon
* `⌘ ^ ⇧ B` Baidu
* `⌘ ^ ⇧ D` Douban
* `⌘ ^ ⇧ G` Google
* `⌘ ^ ⇧ J` JD.com
* `⌘ ^ ⇧ M` Tmall
* `⌘ ^ ⇧ T` Taobao
* `⌘ ^ ⇧ W` Weibo
* `⌘ ^ ⇧ Z` Zhihu

## Abbr Expander

* Regular : Type `|[a-zA-Z0-9]+` \| `[a-zA-Z0-9]+|` → Extend \| Rewrite …
* More examples as follow

### Dates

* Type string `|hm`, it will be replaced by the time string `hh:mm`
* Type `|ymd`, replaced by `yy/MM/dd`
* `|d` → `YYYYMMdd`
* `|d-` → `YYYY-MM-dd`
* `|d/` → `YYYY/MM/dd`
* `|d.` → `YYYY.MM.dd` …

### Symbols

* `|up` → `↑`
* `|dn` → `↓`
* `|lf` → `←`
* `|rg` → `→`
* `|tab` → `⇥`
* `|shf` → `⇧`
* `|opt` → `⌥`
* `|cmd` → `⌘`
* `|ret` → `↩` …

### Words

* `|http` → `HTTP`
* `|db` → `database`
* `|rm` → `remove`
* `desc|` → `description`
* `env|` → `environment` …

### Commands

* `|vh` → `sudo vim /etc/hosts`
* `|vp` → `sudo vim /etc/php.ini`
* `|snr` → `sudo service nginx restart`
* `|spr` → `sudo service php-fpm restart` …

### Links

* `|blog` → `https://icehe.me` …

### Mails

* `|qm` → `666@qq.com` …

### Numbers

* `|127` → `127.0.0.1` …

