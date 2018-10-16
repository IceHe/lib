# date

> display or set date and time

https://blog.csdn.net/xs1326962515/article/details/80351568

## Options

- `-d, --date=<STRING>` Display time described by STRING, not 'now'
- `-f, --file=<DATE_FILE>` Like `--date` once for each line of DATEFILE
- `-R, --rfc-2822` Output date and time in RFC 2822 format.
    - e.g.: Tue, 16 Oct 2018 16:35:45 +0800
- `-s, --set=<DATE_STRING>` Set time described by STRING
- `-u, --utc, --universal` Print or set Coordinated Universal Time (UTC)

## Format

FORMAT controls the output.  Interpreted sequences are:

### Common

|Format|Explanation|
|:-|:-|
|%a|abbreviated weekday name (e.g., Sun)|
|%A|full weekday name (e.g., Sunday)|
|%b|abbreviated month name (e.g., Jan)|
|%B|full month name (e.g., January)|
|%d|day of month (e.g., 01)|
|%D|date; same as %m/%d/%y|
|%F|full date; same as %Y-%m-%d|
|%g|last two digits of year of ISO (see %G)|
|%H|hour (00..23)|
|%m|month (01..12)|
|%M|minute (00..59)|
|%R|24-hour hour and minute; same as %H:%M|
|%S|second (00..60)|
|%T|time; same as %H:%M:%S|
|%V|ISO week number, with Monday as first day of week (01..53)|
|%W|week number of year, with Monday as first day of week (00..53)|
|%x|locale's date representation (e.g., 12/31/99)|
|%X|locale's time representation (e.g., 23:13:48)|
|%y|last two digits of year (00..99)|
|%Y|year|

### Almost All

|Format|Explanation|
|:-|:-|
|%%|a literal %|
|%a|abbreviated weekday name (e.g., Sun)|
|%A|full weekday name (e.g., Sunday)|
|%b|abbreviated month name (e.g., Jan)|
|%B|full month name (e.g., January)|
|%c|date and time (e.g., Thu Mar  3 23:05:25 2005)|
|%C|century; like %Y, except omit last two digits (e.g., 20)|
|%d|day of month (e.g., 01)|
|%D|date; same as %m/%d/%y|
|%e|day of month, space padded; same as %_d|
|%F|full date; same as %Y-%m-%d|
|%g|last two digits of year of ISO (see %G)|
|%H|hour (00..23)|
|%I|hour (01..12)|
|%j|day of year (001..366)|
|%k|hour, space padded ( 0..23); same as %_H|
|%l|hour, space padded ( 1..12); same as %_I|
|%m|month (01..12)|
|%M|minute (00..59)|
|%n|a newline|
|%N|nanoseconds (000000000..999999999)|
|%p|locale's equivalent of either AM or PM; blank if not known|
|%P|like %p, but lower case|
|%r|locale's 12-hour clock time (e.g., 11:11:04 PM)|
|%R|24-hour hour and minute; same as %H:%M|
|%s|seconds since 1970-01-01 00:00:00 UTC|
|%S|second (00..60)|
|%t|a tab|
|%T|time; same as %H:%M:%S|
|%u|day of week (1..7); 1 is Monday|
|%U|week number of year, with Sunday as first day of week (00..53)|
|%V|ISO week number, with Monday as first day of week (01..53)|
|%w|day of week (0..6); 0 is Sunday|
|%W|week number of year, with Monday as first day of week (00..53)|
|%x|locale's date representation (e.g., 12/31/99)|
|%X|locale's time representation (e.g., 23:13:48)|
|%y|last two digits of year (00..99)|
|%Y|year|
|%z|+hhmm numeric time zone (e.g., -0400)|
|%:z|+hh:mm numeric time zone (e.g., -04:00)|
|%::z|+hh:mm:ss numeric time zone (e.g., -04:00:00)|
|%:::z|numeric time zone with : to necessary precision (e.g., -04, +05:30)|
|%Z|alphabetic time zone abbreviation (e.g., EDT)|

## Usage

Common

```bash
$ date
# ouput e.g.
Sat Oct 13 15:36:49 CST 2018
# CST : China Standard Time
```

```bash
$ date -R
Sat, 13 Oct 2018 15:37:03 +0800
```

Full Date Time

```bash
$ date +"%Y-%m-%d %H:%M:%S"
# or
$ date +%Y-%m-%d\ %H:%M:%S
# or
$ date +%F\ %T

# output e.g.
2018-10-16 17:02:56
```

Option `-d`

```bash
$ date -d 2018-12-31\ 12:34:56
# output e.g.
Mon Dec 31 12:34:56 CST 2018
```

Option `-f`

```bash
$ cat date_str
# output e.g.
2018-01-02 01:02:03
2017-03-16 13:14:15
2016-10-25 12:34:56

$ date -f date_str
# output e.g.
Tue Jan  2 01:02:03 CST 2018
Thu Mar 16 13:14:15 CST 2017
Tue Oct 25 12:34:56 CST 2016
```

## Timezone

Environment **TZ** : Specifies the timezone, unless overridden by command line parameters.

- If neither is specified, the setting from /etc/localtime is used.

```bash
$ TZ='Asia/Shanghai'; export TZ
$ echo $TZ
Asia/Shanghai
```

### List

```bash
$ ls /usr/share/zoneinfo/
# output e.g.
Africa      EET      Greenwich    Mexico      right
America     Egypt    Hongkong     MST         ROC
Antarctica  Eire     HST          MST7MDT     ROK
Arctic      EST      Iceland      Navajo      Singapore
Asia        EST5EDT  Indian       NZ          Turkey
Atlantic    Etc      Iran         NZ-CHAT     UCT
Australia   Europe   iso3166.tab  Pacific     Universal
Brazil      GB       Israel       Poland      US
Canada      GB-Eire  Jamaica      Portugal    UTC
CET         GMT      Japan        posix       WET
Chile       GMT0     Kwajalein    posixrules  W-SU
CST6CDT     GMT-0    Libya        PRC         zone.tab
Cuba        GMT+0    MET          PST8PDT     Zulu

$ ls /usr/share/zoneinfo/Asia
# output e.g.
Aden        Dili          Kuching       Shanghai
Almaty      Dubai         Kuwait        Singapore
Amman       Dushanbe      Macao         Srednekolymsk
Anadyr      Gaza          Macau         Taipei
Aqtau       Harbin        Magadan       Tashkent
Aqtobe      Hebron        Makassar      Tbilisi
Ashgabat    Ho_Chi_Minh   Manila        Tehran
Ashkhabad   Hong_Kong     Muscat        Tel_Aviv
Baghdad     Hovd          Nicosia       Thimbu
Bahrain     Irkutsk       Novokuznetsk  Thimphu
Baku        Istanbul      Novosibirsk   Tokyo
Bangkok     Jakarta       Omsk          Ujung_Pandang
Beirut      Jayapura      Oral          Ulaanbaatar
Bishkek     Jerusalem     Phnom_Penh    Ulan_Bator
Brunei      Kabul         Pontianak     Urumqi
Calcutta    Kamchatka     Pyongyang     Ust-Nera
Chita       Karachi       Qatar         Vientiane
Choibalsan  Kashgar       Qyzylorda     Vladivostok
Chongqing   Kathmandu     Rangoon       Yakutsk
Chungking   Katmandu      Riyadh        Yekaterinburg
Colombo     Khandyga      Saigon        Yerevan
Dacca       Kolkata       Sakhalin
Damascus    Krasnoyarsk   Samarkand
Dhaka       Kuala_Lumpur  Seoul
```

### Check

```bash
$ timedatectl
# output e.g.
      Local time: Tue 2018-10-16 17:09:17 CST
  Universal time: Tue 2018-10-16 09:09:17 UTC
        RTC time: Tue 2018-10-16 09:09:17
        Timezone: Asia/Shanghai (CST, +0800)
     NTP enabled: yes
NTP synchronized: yes
 RTC in local TZ: no
      DST active: n/a
```

### Select

```bash
$ tzselect

# interactions e.g.
Please identify a location so that time zone rules can be set correctly.
Please select a continent or ocean.
 1) Africa
 2) Americas
 3) Antarctica
 4) Arctic Ocean
 5) Asia
 6) Atlantic Ocean
 7) Australia
 8) Europe
 9) Indian Ocean
10) Pacific Ocean
11) none - I want to specify the time zone using the Posix TZ format.
#? 5
Please select a country.
 1) Afghanistan           18) Israel                35) Palestine
 2) Armenia               19) Japan                 36) Philippines
 3) Azerbaijan            20) Jordan                37) Qatar
 4) Bahrain               21) Kazakhstan            38) Russia
 5) Bangladesh            22) Korea (North)         39) Saudi Arabia
 6) Bhutan                23) Korea (South)         40) Singapore
 7) Brunei                24) Kuwait                41) Sri Lanka
 8) Cambodia              25) Kyrgyzstan            42) Syria
 9) China                 26) Laos                  43) Taiwan
10) Cyprus                27) Lebanon               44) Tajikistan
11) East Timor            28) Macau                 45) Thailand
12) Georgia               29) Malaysia              46) Turkmenistan
13) Hong Kong             30) Mongolia              47) United Arab Emirates
14) India                 31) Myanmar (Burma)       48) Uzbekistan
15) Indonesia             32) Nepal                 49) Vietnam
16) Iran                  33) Oman                  50) Yemen
17) Iraq                  34) Pakistan
#? 9
Please select one of the following time zone regions.
1) Beijing Time
2) Xinjiang Time
#? 1

The following information has been given:

        China
        Beijing Time

Therefore TZ='Asia/Shanghai' will be used.
Local time is now:      Tue Oct 16 17:23:26 CST 2018.
Universal Time is now:  Tue Oct 16 09:23:26 UTC 2018.
Is the above information OK?
1) Yes
2) No
#? yes
Please enter 1 for Yes, or 2 for No.
#? 1

You can make this change permanent for yourself by appending the line
        TZ='Asia/Shanghai'; export TZ
to the file '.profile' in your home directory; then log out and log in again.

Here is that TZ value again, this time on standard output so that you
can use the /bin/tzselect command in shell scripts:
Asia/Shanghai
```
