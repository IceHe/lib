title: 搭建个人博客
date: 2015-11-14
updated: 2017-05-01
categories: [Web]
tags: [Web]
description: Bulid Blog&#58; Why 初衷、How 过程，Hexo 建站，Theme 主题，Domain Name 域名，Bed Room 图床，Google CSE 站内搜索，404 页面，Sitemap & RSS 站点地图与订阅，Site Analysis，Page View 统计…
---

{% cq %}
竹径通幽处，禅房花木深。

《题破山寺后禅院》__常建__
{% endcq %}

- __进阶文章__《 [__折腾个人博客__](/web/blog_changelog) 》

# 后记

- 写了不少，舍不得删掉。但是这类教程，网上已经够多了，再写价值不大。特别是知道了 Next 这个 Hexo 主题之后。
- 这个 Hexo 主题基本包办了我想要的几乎所有博客功能，而且配置方法也很简单。
- 但是这些便利性造成了一个问题：
    - 做个人博客是为了彰显个人的独特个性和审美。
    - 用别人做好的博客主题，可以选择一个不热门的，但是配置起来麻烦，很可能缺少一些特别的功能支持，要自己 DIY。而我自己现在就特别讨厌没有意义的折腾。
    - 要是选择一个比较流行的博客主题，虽然功能齐全，但是会觉得不够独特，容易跟别人撞主题，感觉就跟「撞衫」一个道理。
- 但是要是再仔细想想，如果你是一个会思考有思想的人，总能提出独特的观点，无论你是用微博、CSDN、博客园还是随便哪个平台发，都是无所谓的，总会赢得别人的认同。
    - 外观与众不同，当然可以算作是是独特的。但是真正的与众不同、特立独行，不光在表面上，更应该是思想上的，不然我觉的就没啥意思。
- 算了吧，保留本文，不过不再更新了。
- 记于 2017-01-02

# 初衷

与其到各大博客平台去写博客，
不如自己搭建个独一无二的。
不但过程有意思，还能学到许多新知识。

可以用来记录 [__自己的人生__](/lifelogs)，
放一些值得分享的技术、读书笔记和感想。

# 过程

教程的各步骤描述得越详细，时效性往往越差。
网上的类似的教程多如牛毛，不差这篇。

所以，我并不打算详细写，
只简略说明过程与所用的「轮子」（工具、模块），
并列出本人参阅的教程文章的链接，
其它更具体的细节自行百度 / Google，
查阅其它教程与相关工具模块的官方文档。

还有，折腾才能学到真东西，
下文做法、用法从略处，还请自行摸索。

## 引子

非软件、计算机专业的人，自行搭建个人博客其实不难。
前人早已造好了各种「轮子」，只要根据网上的教程摸索一下，
动动手指头就可以组装出自己的博客。

可以用 isnowfy 的 [__静态页面生成静态博客__](http://isnowfy.github.io/about-simple-cn.html) 的方法，
对一个新手来说，那感觉真是妙极了！

当时就想：不如自己写个博客生成器吧！
那当真是一件蛮有 geek 的事啊。

但吾生有崖，而知也无涯，
没必要自己重新「造轮子」，
阅源码解其精妙未尝不可。
君子善假于物，省出时间，
去做真正想做的事情岂不是更好。

搭建博客的方法，除了用不同的静态博客生成器来生成外，
还可以租用或搭建一个服务器，来运行一个动态博客，
其中最出名的非 [__Wordpress__](https://wordpress.com/) 莫属，
现在有更多性能优越、更便于搭建维护的博客框架，
可另行查阅。

为了让个人博客有足够定制空间的同时，尽可能降低维护成本，
__我选择了静态博客生成器：[Hexo](http://hexo.io/) !__

（有空会找机会再折腾一个动态博客）

## Hexo 建站教程

广泛检索后，参阅他人的建站教程

- 参考教程：
    - [使用 GitHub 和 Hexo 搭建免费静态 Blog](https://wsgzao.github.io/post/hexo-guide/)
    - [Hexo 系列教程：（二）搭建 Hexo 博客](http://www.zipperary.com/2013/05/28/hexo-guide-2/)
    - [Hexo 系列教程：（三）Hexo 博客的配置、使用](http://www.zipperary.com/2013/05/29/hexo-guide-3/)
    - [Hexo 系列教程：（四）Hexo 博客的优化技巧](http://www.zipperary.com/2013/05/30/hexo-guide-4/)
    - [Hexo 系列教程：（五）Hexo 博客的优化技巧续](http://www.zipperary.com/2013/06/02/hexo-guide-5/)
    - …



其中会提到，下文涉及的「[__定制点__](#Custom_Points_定制点)」的内容，包含功能模块的具体配置方法。

可能其中涉及各工具和模块已经有新版本，
具体操作细节最好参考它们最新的官方文档。

有探索精神的直接可直接参照 [__Hexo官网__](https://hexo.io/zh-cn/)，
它提供中/英文的各种帮助信息，
包括文档、API、插件、主题等，
告诉你建站方法、基本操作、自定义部分……

前人之述备矣，在此不再赘述基础部分。

## 定制点

建站很容易，如果你的需求只是写写文字博客而已，可以到此结束了。
但如果要完善博客到合乎自己的心意，那将是万里长征的第一步。

要获得更大的定制余地，让自己的博客更独一无二，
最好懂些网页技术，就可以修改别人工具模块的源代码，
让博客支持更多需要的模块、插件、外观效果等。

### __主题__

Theme不单只提供不同的博客外观、视觉效果，
__通常还会提供许多功能模块的配套支持！
一般包括但不限于：评论、分享、RSS订阅、联系方式、百度/谷歌的统计分析、标签云。__

- 官网上有提供很多第三方主题：
    - 官方列表：[__Hexo Themes__](https://hexo.io/themes/)
    - 现在选用的是：[IIssNan](http://iissnan.com/) 的 [__NexT__（官方文档）](http://theme-next.iissnan.com/)
    - ~~曾经选用的是：[WuChong](http://wuchong.me/) 的 [__Jacman__](https://github.com/wuchong/jacman)~~
    - ~~该主题作者的官方教程：[如何使用 Jacman 主题](http://wuchong.me/blog/2014/11/20/how-to-use-jacman/)~~

__它包含了以下绝大多数的定制点，不需要自己折腾太多，也可以很快做好。__
如果你更喜欢 DIY，想要亲手试一试第一次搭建静态微博，
从中多了解学习些细节问题，当然更好。

Hexo 官网的文档和 API 中有 theme 写法的说明，
可以自己重新写一个 theme。

### __评论__

利用第三方社会化评论系统，可以便捷地为博客添加评论模块。
这些评论系统可以让你和你的访客在你的博客下添加评论，
还能审核、删除、迁移（博客变更后保留评论）、自定义评论框的外观效果等，
它们一般都提供足够的定制空间。

- 推荐：
    - 国内：[__畅言__](http://changyan.kuaizhan.com/) （可惜需要网站备案…）
    - 国外：[__Disqus__](https://disqus.com/)
    - 原来国内能用 ~~[__多说__](http://duoshuo.com/)~~ 可惜在 2017 年 5 月 1 日关停了服务。

具体评论系统搭建比较麻烦，有能用的，就不推荐自己折腾。

### __分享__

添加分享模块可以方便自己或他人在第三方的社交平台分享你的博客内容。

这还是借助第三方的帮助：
它们也会提供许多方便定制选项，
懂些 HTML、CSS、JavaScript 就能深度定制了。

- 推荐：
    - [__百度分享__](http://share.baidu.com/)
    - [__jiathis__](http://www.jiathis.com/)
    - 自己编写（并不会太难）

### __关于页面__

一般用于介绍博主或博客的页面。
- 例如：[__我的「Me 我」页面__](/about)。

### __404 找不到页面__

当访问一个不存在于博客中的页面时，展示的提示页面。
- 例如：[__我的 404 页面__](/not_found)。
- 推荐：[__腾讯公益 404__](http://www.qq.com/404/)

### __域名__

有只属于自己的个性化域名，简直自豪感满满，
因为终于有自己的个人网站了 T_T

- 分两步：买域名，域名解析。
    域名购买推荐：
    - 国内老牌：[__万网__](http://wanwang.aliyun.com/)（已被阿里收购）
    - 国外老牌：[__GoDaddy__](https://www.godaddy.com/)
    - 我的选择：[__NameCheap__](https://www.namecheap.com)

想要最低的价格，可以参考域名比价网站 [__Domain Price Comparison__](https://www.domcomp.com)。
推荐阅读知乎问答：[__现在去哪里买 .com 域名最便宜？__](http://www.zhihu.com/question/19551906)
因为买域名不能只考虑价格，还得考虑服务。



- 域名解析推荐：
    - 老牌：[__万网__](http://wanwang.aliyun.com/)（在万网买的域名，可以直接用它）
    - 我的选择：[__DNSPod__](https://www.dnspod.cn/)（国内、免费、稳定、快速、用户友好）



- 域名解析选择国内运营商，有利于提高国内访客的访问速度。
    具体配置过程可参考：
    - [__域名和 DNS__](https://wsgzao.github.io/post/hexo-guide/#%E5%9F%9F%E5%90%8D%E5%92%8CDNS)
    - [__购买域名、设置dns__](http://www.zipperary.com/2013/05/27/domain-name-and-dns/)

### __Sitemap & RSS__

__站点地图 & RSS 订阅__。

站点地图给搜索引擎的爬虫以及网站的订阅者，
说明了博客里有哪些链接、文章、页面内容，
提高博客在搜索引擎的抓取、收录效果，
给关注你博客的朋友，提供了订阅功能。

__TODO: 待日后补全细节，暂参考 [RSS 和 sitemap](http://www.jianshu.com/p/bb35e703f9bf)__

- 具体配置过程可参考：
    - [__Hexo 博客的优化技巧续__](http://www.zipperary.com/2013/06/02/hexo-guide-5/)（推荐结合以下内容阅读）



- 注意可能出现的 Bug：
    本博客 [__RSS Feed__](http://icehe.me/atom.xml) 和 [__search.xml__](http://icehe.me/search.xml) 曾无法正常地以 UTF-8 的编码格式被解析。
    （后者用于 Hexo 的 NexT 主题文档推荐的 [__站内搜索__](#站内搜索) 之一的 [__Local Search__](http://theme-next.iissnan.com/third-party-services.html#local-search)）
    - 后来我遍寻网上的相关搜索结果，在仔细研究之下，才发现这原来是因为：
        自己的某些博文中（不知为何）混入了一些「[__控制字符__](http://baike.baidu.com/item/%E6%8E%A7%E5%88%B6%E5%AD%97%E7%AC%A6)」，
        只要将博客中不在 UTF-8 编码范围内的控制字符去掉，即可恢复正常。
    - 搜索、替换的具体操作提示：
        - 浏览器打开这些 xml 文件时，就会告诉你哪里解析出错了，
            看一看第一个解析出错的编码是什么。
            我的是 `0x15` 即 `^U`，详见 [__ASCII 表__](http://www.asciitable.com/)。
        - 再看一看这个控制字符来自于博客的哪一篇博文或组件，
            使用 Vim 编辑器打开混入了控制字符的文件，查找并删除它。
            （不是所有编辑器都能便捷地支持控制字符的输入和查找）
            Vim 替换指令请自行 Google，Vim 中输入控制字符的方式如下：
            例如输入 `^U`，要先按 `^V` 然后 再按 `^U` 即可。
        - 重复以上步骤直至完全解析成功为止。

### __闲杂模块__

除了博客的基本功能模块，还有一半需要额外添加的模块。
Hexo自带的功能：archive 归档、category 分类、tag 标签。

其它的模块，如：[微博秀](http://jssdk.sinaapp.com/widget/weiboshow.php)

### __图床__

顾名思义，存放博客图片的地方。

当然，可以直接存放到托管你静态博客代码的平台，
但是，它们的代码仓库的空间有限，以后就可能不够用了。
所以，你可以申请多个 Github、[Coding.net](https://coding.net) 等平台的账户，
用新的代码仓库来放额外的图片。

但是，代码托管平台的访问速度也不够快，
会影响博客的加载速度，日后要迁移图片也麻烦。

如果放在你的（云）服务器上，
动态的服务器也会出现流量和带宽有限的问题。

所以，
博客里的图片，最好挂载到第三方CDN提供商那里，
提高博客网页的读取速度，提升访客体验，
也方便图片资源的迁移。

推荐：
(1) 老牌：[又拍云](https://www.upyun.com/index.html)（服务好、价格高）
(2) 我的选择：[七牛云存储](http://www.qiniu.com/)（国内、免费、方便）

### __站内搜索__

让访客可以自行搜索博客中感兴趣的内容。

百度和 Google 都有提供站内搜索功能，
但是只能是搜索到你博客中被搜索引擎收录到的那部分内容。

对于一个新建的小网站来说，很可能被其收录的内容很少，
没有对博客足够齐全的索引，搜索结果差。

国内的一般访客也访问不了 Google，
百度站内搜索的体验也不佳。

推荐：
(1) 我的选择：Hexo 主题 NexT 内置的 [__Local Search__](http://theme-next.iissnan.com/third-party-services.html#local-search)
(2) 国外免费：[__Google CSE__](https://cse.google.com/cse/) 需要访客能访问 Google 才行
(2) 国外收费：[__Algolia__](https://www.algolia.com/) 和 [__Swiftype__](https://swiftype.com/) 在免费试用后，需缴费才能继续使用完整功能
(3) 国内：暂无足够好的选项

[__Local Search__](http://theme-next.iissnan.com/third-party-services.html#local-search) 和 [__Google CSE__](https://cse.google.com/cse/) 根据官方的流程一步步来即可。

而 Swiftype 具体配置过程可参考：[利用 Swiftype 为 Hexo 添加站内搜索 v2.0](http://www.jerryfu.net/post/search-engine-for-hexo-with-swiftype-v2.html)

### __PV/UV__

__访问数/访客数的统计与显示__。

统计、显示博客每篇、每个页面的访问数。

手段繁多，我参考了这个方法：
[使用 LeanCloud 平台为 Hexo 博客添加文章浏览量统计组件](http://crescentmoon.info/2014/12/11/popular-widget/)
它提供了统计、榜单显示的具体方法。

但是，你可能还需要：
在首页文章列表、文章页面上显示该文章的访问次数。

具体方法，可以通过查看我博客页面的源代码了解，
或者到我的 [Github](https://github.com/IceHe) 查看我的博客 theme 的源代码：
自定义过的 [Jacman](https://github.com/IceHe/blog_theme_jacman) 和 [NexT](https://github.com/IceHe/hexo-theme-next)。

如果需要整个网站的页面访问量（PV）、独立访客数（UV）的统计与显示，
则可以参看这个第三方工具：[不蒜子 - 搞定你的网站计数](http://ibruce.info/2015/04/04/busuanzi/)

### __Site Analysis__

__网站分析服务__。

帮助你去统计分析网站的各类数据，
包括且不限于查看 UV、PV、IP 数、来源网站、入口页面、受访页面、
访客地区、设备、系统、忠诚度，抓取网站收录到搜索引擎，提供 SEO 优化建议等的服务。

推荐：
(1) [Google Analytics](http://www.google.com/analytics/)
(2) [百度统计](http://tongji.baidu.com/web/welcome/login)

最好两个同时使用，还有它们的站长工具，体会其中的差异，
而且它们会派爬虫去抓取你的博客，其结果将会收录到搜索引擎~

### __访问速度优化__

手段繁多，
除了上文提到的将图片放到 CDN 服务商那里的方法外，
CSS 文件、JavaScript 脚本等也可以放到 CDN 那里，
把静态网站托管到更访问速度更好的平台（也包括 CDN）上，
压缩图片到适当大小，优化 theme、JavaScript 脚本的代码……
在此不赘述。

~~[托管博客到 Gitcafe](http://www.zipperary.com/2013/11/23/hexo-to-gitcafe/)~~ 比较便捷。

__可参考 [Hexo 系列教程之五：Hexo 博客同时托管在 Github 和 Coding](http://www.jianshu.com/p/3141cffc1b1b)__

### __卖广告__

当你的网站做得一级棒，流量很大（访客很多）的时候，
就就可以靠卖广告挣点外快了，挣回网站的维护成本，
甚至养活自己，发大财￥

推荐：
(1) [Google AdSense](http://www.google.cn/intl/zh-CN/ads/ads_1.html)
(2) [百度广告](http://adm.baidu.com/index.html)

还有很多其它广告平台，可自行查阅。

围绕上述各点，折腾了不少时间，
当然也学到许多新的知识。

# 其它

## 源代码

- [博客实体的代码](https://github.com/IceHe/icehe.github.io)
- [生成博客用的代码](https://github.com/IceHe/icehe.me)
- [~~博客 Theme: Jacman 的代码~~](https://github.com/IceHe/Jacman)（旧）
- [博客 Theme: NexT 的代码](https://github.com/IceHe/hexo-theme-next)（新）

## 鸣谢
- Hexo 作者：[Tommy Chen](http://zespia.tw/)
- 主题作者：[WuChong](http://wuchong.me/)

## 关于我
- 这是我的[ __简介__ ](/about)。
- __感谢您的阅读。__
