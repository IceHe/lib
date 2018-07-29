title: JS Note
---

[js页面跳转常用的几种方式](http://www.jb51.net/article/25403.htm)
[js 获取真实的 外网IP、内网IP](https://www.giuem.com/js-get-ip/)
[js 常见 字符串操作函数](http://web.jobbole.com/82334/)
[js 在html页面加载完毕后，运行 js 脚本](http://www.jb51.net/article/51140.htm)

# [js 判断访问页面的设备类型 （PC/移动端）](http://www.cnblogs.com/lostyu/p/3164360.html)

方法一、
``` javascript
function IsPC(){
     var userAgentInfo = navigator.userAgent;
     var Agents = new Array(
        "Android",
        "iPhone",
        "SymbianOS",
        "Windows Phone",
        "iPad",
        "iPod"
     );
     var flag = true;
     for (var v = 0; v < Agents.length; v++){
        if (userAgentInfo.indexOf(Agents[v]) > 0){
               flag = false;
               break;
        }
     }
     return flag;
}
```

方法二、
``` javascript
var browser={
     versions: function(){
          var u = navigator.userAgent, app = navigator.appVersion;
          return {//移动终端浏览器版本信息
               trident: u.indexOf('Trident') > -1, //IE内核

               presto: u.indexOf('Presto') > -1, //opera内核

               webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核

               gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核

               mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端

               ios: !!u.match(/(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端

               android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器

               iPhone: u.indexOf('iPhone') > -1 , //是否为iPhone或者QQHD浏览器

               iPad: u.indexOf('iPad') > -1, //是否iPad

               webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
          };
     }(),
          language:(navigator.browserLanguage
          || navigator.language).toLowerCase()
}

if(browser.versions.mobile
     || browser.versions.ios
     || browser.versions.android
     || browser.versions.iPhone
     || browser.versions.iPad){
     window.location ="http://m.baidu.com";
}
```


# js 如何处理反斜杠 “\” （js 调用 php 调用 sql 来检索db）

中文字符——
          （1）sSearch 输入：表白
URL编码(中文的)——
          （2）http GET 得到的 sSearch 参数为：%E8%A1%A8%E7%99%BD

中文字符——
          （3）urldecode后得到：表白
unicode编码(中文的)——
          （4）json_encode后得到："\u8868\u767d"
          （5）explore(' " ', ...)[1] 后得到：\u8868\u767d

string类型——
          （6）str_replace('\\', '\\\\\\\\', ...)后得到：\\\\\\\\u8868\\\\\\\\u767d

string类型——
          （7）sql .= xxx 后，合成sql查询语句，
                  在sql_query_log日志中被记录为：or  skinnames like '%\\\\u591c\\\\u95f4%'

可能（一）
？继续猜测——
          （8）在sql查询接口中：%\\\\\\\\u8868\\\\\\\\u767d% 被识别为
？string类型——
                    字符串：%\\\\u8868\\\\u767d%
？string如正则表达式的解析——
          （9）在sql查询引擎中，最终被识别为：%\\u8868\\u767d%

可能（二）比较靠谱~
？string类型——
          （8）在sql查询引擎中：%\\\\\\\\u8868\\\\\\\\u767d%
                    被识别为字符串：%\\\\u8868\\\\u767d%
？再如 “ 表示正则表达式的字符串 ” 般被解析——
          （9）最终被识别为：%\\u8868\\u767d%

总之，结论：
          在组成的sql查询语句中，若用like语句查询字符的unicode编码，
          "\\"要替换成"\\\\\\\\"，即8个\，而非4个

最后才得到正确查询结果！

最终从php.net上得证：
如果要在正则表达式中中使用反斜线，必须使用4个"\\\\"。
因为这首先是php的字符串，经过转义后，是两个，
再经过 正则表达式引擎后才被认为是一个原文反斜线。
