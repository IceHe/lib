title: 实现网站的打赏功能
date: 2015-05-01
updated: 2016-08-18
categories: [Web]
tags: [Web]
description: 可用一个简单的表单（form 标签），通过POST一键自动填写「支付宝转账页面」的信息。还有，笔者自定义的“打赏”按钮方案！
---

# 注意

据网友 HaiSheng_Zhai 在本文评论中的反映，并经笔者简单测试后确认：

- 下文中，__以表单提交的方式，__方便地__用网页版 支付宝 支付的方法，已经失效。__
- 以同样方式进行网页版 __PalPay 支付的方法，仍可使用__。

# 扫码打赏

- 现在，路边摊都懂得将自己的 微信或支付宝 的 付款二维码 打印出来，粘贴到某处，方便顾客自行用扫码支付。
- 建议采用__「扫描支付宝、微信的付款二维码进行支付」__的方式来实现打赏，简单易行。

## 获得二维码

- 将自己 微信或支付宝 的付款二维码 保存下来。
- 它们的版本持续更新后，下文中的具体流程和文案可能与实际情况有出入。

### 微信

- 打开 微信（显示应用首屏）；
- 点击 首屏右上角的加号 `+` ；
- 点击 下拉菜单中的 `收付款` 选项；
- 点击 `我要收款` 按钮；
- 长按（iOS的方式）屏幕中央的付款二维码，下方会弹出一个菜单；
    - 可选：点击 屏幕右上角的 `设置金额` ，定死单次打赏的金额；
- 点击 从下方弹出的菜单中的 `保存图片` 选项；
    - 可选：使用 手机系统的截屏功能，然后再处理截屏图片。

### 支付宝

- 打开 支付宝（显示应用首屏）；
- 点击 首屏右上角的加号 `+` ；
- 点击 下拉菜单中的 `收款` 选项；
    - 可选：点击 二维码图片 正下方的 `设置金额`，定死单次打赏的金额；
- 点击 二维码图片 右下方的 `下载` 图标按钮。

## 发布二维码

- 使用 `Photoshop`，或者手机 App `美图秀秀`、`Enlight` 等各种工具、方法，编辑二维码图片，打造出自己喜欢的视觉效果，或简洁，或华丽。
- 将二维码图片存放到网络上，如 `图床` 中。
    - __方法一__、注册 [七牛云存储](http://www.qiniu.com/)，把二维码图片存进去，再获得其引用地址。
        - 以后可以将您需要在博客展示的图片，都存放到专门的`图床`（云存储）服务提供商那里，再引用；而非存放到您自己的博客服务器上，因为图床利于加快图片的加载速度。
        - 还有很多图床，可自行搜索选择。还是推荐 `七牛`，因为免费空间（10GB）大，方便易用，服务稳定。我只是其忠实用户，并没有收广告费。
    - __方法二__、更简便的方法：把 [微博](http://weibo.com) 当图床。
    - 用一条微博将二维码图片发出去；
    - 在浏览器中，用右键点击微博中的该图片；
    - 点击右键菜单中的 `复制图片链接` 选项，就可以获得保存在新浪的二维码图片的网络地址，用于在博客引用图片。

## 展示二维码

- 再在博客中引用，放到合适的位置上，配上合适的文案、排版，引导访客进行打赏。
    - 带文章编辑器的博客系统，通常提供便捷的图片插入功能，可以根据具体情况自行操作。
    - 有些情况需要根据 `标记语言` 的语法自行输入，如：
        - __Markdown 语法__：`![图片替代描述](图片的 URL "图片标题")`
            - 图片替代描述：通常用于图片无法显示的情况，用这段文字内容来描述这张无法显示的图片。可不填。
            - 图片的 URL：上一步 `发布二维码` 时，获得的图片链接地址。
            - 图片标题：鼠标停留在这张图片上时，会悬浮显示的这段文字内容，会显示的文字内容。可不填。
            - Markdown 进阶使用详见 [Markdown 语法说明 (简体中文版)](http://www.appinn.com/markdown/#img)。
            - 简单实例：
                `![](http://7vzp68.com1.z0.glb.clouddn.com/about/wechat_pay_00.png)`
            - 详细实例：
                `![二维码](http://7vzp68.com1.z0.glb.clouddn.com/about/wechat_pay_00.png "打赏")`
                <!--![二维码](http://7vzp68.com1.z0.glb.clouddn.com/about/wechat_pay_00.png height="164px" width="164px" "打赏")-->
                <img src="http://7vzp68.com1.z0.glb.clouddn.com/about/wechat_pay_00.png" height="164px" width="164px" alt="二维码" title="打赏" />
        - __HTML 语法__：`<img src="图片的 URL" alt="图片替代描述" title="图片标题" />`
            - 其中各部分元素的说明，同上一点 `Markdown 语法` 所述。
            - 进阶使用详见 [HTML &lt;img&gt; 标签](http://w3school.com.cn/tags/tag_img.asp)。
            - 简单实例：
                `<img src="http://7vzp68.com1.z0.glb.clouddn.com/about/ali_pay_03.png">`
            - 详细实例：
                `<img src="http://7vzp68.com1.z0.glb.clouddn.com/about/ali_pay_03.png" alt="二维码" title="打赏" />`
                <img src="http://7vzp68.com1.z0.glb.clouddn.com/about/ali_pay_03.png" height="164px" width="164px" alt="二维码" title="打赏" />
- 结尾
    - 可以看看本博客打赏模块现在的 [做法和效果](/reward/)。
    - 可以尝试打赏博主，看看整个完整的流程~
    - 经考虑，保留本文的上一版原文，因为以下部分仍有借鉴价值：
        - 包含 PayPal 打赏 的实现方法。
        - 包含 打赏按钮 的实现方法。
        - [实际效果见原文结尾 : )](/web/donate/#实际效果)

# 上一版原文

- 原来的支付宝钱包有一个实用的功能 「**一键转账**」，使用便捷，且页面看起来专业、正规，令人放心。它对业务站点而言，无疑是个福音。普通博主、站长也常将其用于捐赠和打赏。但支付宝的[**个人收款主页 停止服务**](http://www.ithome.com/html/it/83096.htm)后，支付宝已经无法实现该功能了。

## 曲线救国 —— 新方法

可以使用一个简单的**表单**（form 标签），通过**POST**一键自动填写「[支付宝转账页面](https://shenghuo.alipay.com/send/payment/fill.htm)」的信息。方便您的访客、用户转账捐赠、打赏您。

- **HTML 代码**

*注意：修正其中需要您填写的部分。*

``` html
<form action="https://shenghuo.alipay.com/send/payment/fill.htm"
	method="POST" target="_blank" accept-charset="GBK">
	<input name="optEmail" type="hidden" value="你的支付宝账号" />
	<input name="payAmount" type="hidden" value="默认的捐赠金额" />
	<input id="title" name="title" type="hidden" value="默认显示的付款说明" />
	<input name="memo" type="hidden" value="备注" />
	<input name="pay" type="image" value="转账"
		src="https://img.alipay.com/sys/personalprod/style/mc/btn-index.png" />
</form>
```

- **显示效果**

<form action="https://shenghuo.alipay.com/send/payment/fill.htm" method="POST" target="_blank" accept-charset="GBK" style="margin-left: 25px; display: inline;">	<input name="optEmail" type="hidden" value="你的支付宝账号" />	<input name="payAmount" type="hidden" value="默认的捐赠金额" />	<input id="title" name="title" type="hidden" value="默认显示的付款说明" />	<input name="memo" type="hidden" value="备注" />	<input name="pay" type="image" value="转账" src="https://img.alipay.com/sys/personalprod/style/mc/btn-index.png" />	</form>

- Reference 参考资料
《[博客网站支付宝打赏功能](http://www.zzyyss.com/archives/809)》

## 笔者的自定义的“打赏”按钮

- **HTML 代码**：

``` html
	<!-- 打赏表单 -->
	<form id="donate" action="https://shenghuo.alipay.com/send/payment/fill.htm"
		method="POST" target="_blank" accept-charset="GBK" style="display: none;">
		<input name="optEmail" type="hidden" value="您的支付宝账号" />
		<input name="payAmount" type="hidden" value="默认的打赏金额" />
		<input id="title" name="title" type="hidden" value="默认显示的付款说明" />
		<input name="memo" type="hidden" value="备注" />
	</form>
	<!-- /打赏表单 -->

	<!-- 打赏按钮的样式表 -->
	<style type="text/css">
		.donate_bar a.btn_donate{
			display: inline-block;
			width: 82px;
			height: 82px;
			background: url("http://img.t.sinajs.cn/t5/style/images/apps_PRF/e_media/btn_reward.gif") no-repeat;
			_background: url("http://img.t.sinajs.cn/t5/style/images/apps_PRF/e_media/btn_reward.gif") no-repeat;
		}
		.donate_bar a.btn_donate:hover{ background-position: 0px -82px;}
		.donate_bar .donate_txt {
			display: block;
			color: #9d9d9d;
			font: 14px/2 "Microsoft Yahei";
		}
	</style>
	<!-- /打赏按钮的样式表 -->

	<!-- 打赏按钮 -->
	<div class="donate_bar">
		<a class="btn_donate" href="javascript:;" title="Donate 打赏"
			onclick="document.getElementById('donate').submit()"></a>
		<span class="donate_txt">
			&uarr;<br/>
			If you enjoy the blog,
			please feel free to donate~
			Thx for your support.
		</span>
		<span class="donate_txt">
			若本文对您有帮助，求打赏~ 谢谢您的支持和鼓励。
		</span>
	</div>
	<!-- /打赏按钮 -->
```

## 进阶的 “打赏” 按钮

- 本博客的打赏按钮的实际代码根据需求不断进行调整，最后更新的版本如下：

``` html
<!-- Donate Module -->
<div id="donate_module">
	<!-- css -->
	<style type="text/css">
		.donate_bar a.btn_donate{
			display: inline-block;
			width: 82px;
			height: 82px;
			background: url("http://img.t.sinajs.cn/t5/style/images/apps_PRF/e_media/btn_reward.gif") no-repeat;
			_background: url("http://img.t.sinajs.cn/t5/style/images/apps_PRF/e_media/btn_reward.gif") no-repeat;

			<!-- 因为本 hexo 生成的博客所用的 theme 的 a:hover 带动画效果，
				 为了在让打赏按钮显示效果正常 而 添加了以下几行 css，
				 嵌入其它博客时不一定要它们。 -->
			-webkit-transition: background 0s;
			-moz-transition: background 0s;
			-o-transition: background 0s;
			-ms-transition: background 0s;
			transition: background 0s;
			<!-- /让打赏按钮的效果显示正常 而 添加的几行 css 到此结束 -->
		}
		.donate_bar a.btn_donate:hover{ background-position: 0px -82px;}
		.donate_bar .donate_txt {
			display: block;
			color: #9d9d9d;
			font: 14px/2 "Microsoft Yahei";
		}
		.bold{ font-weight: bold; }
	</style>
	<!-- /css -->

	<!-- form -->
	<form id="donate" action="https://shenghuo.alipay.com/send/payment/fill.htm" method="POST" target="_blank" accept-charset="GBK">
		<input name="optEmail" type="hidden" value="ice_he@foxmail.com" />
		<input name="payAmount" type="hidden" value="1.00" />
		<input id="title" name="title" type="hidden" value="打赏《<%= item.title.substr(0, 16) %>》"/>
		<input name="memo" type="hidden" value="留下您的大名及联系方式(email,blog,etc)，多交流共勉共进：" />
	</form>
	<!-- /form -->

	<!-- btn_donate & tips -->
	<div id="donate_board" class="donate_bar center">
		<a id="btn_donate" class="btn_donate" target="_self" href="javascript:;" title="Donate 打赏"></a>
		<span class="donate_txt">
			&uarr;<br/>
			If you enjoy the article, please feel free to <span class="bold">donate~</span> Thx.<br/>
			若本文对您有帮助，<span class="bold">求打赏~</span> 谢谢您的鼓励。
		</span>
		<br/>
	</div>
	<!-- /btn_donate & tips -->

	<!-- donate guide -->
	<div id="donate_guide" class="donate_bar center hidden">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="3MPNAMMQA4C8Y">	&nbsp; &nbsp;
			<input type="image" width="auto" height="40em"
				src="http://7vzp68.com1.z0.glb.clouddn.com/about/palpay_donate_button_00.jpg"
				border="0" name="submit" alt="PayPal——最安全便捷的在线支付方式！"
				style="margin-bottom: 0.5em;">
		</form>

		<a href="http://7vzp68.com1.z0.glb.clouddn.com/about/ali_pay_02.jpg" title="Alipay_Scan_Payment" class="fancybox" rel="article0">
			<img src="http://7vzp68.com1.z0.glb.clouddn.com/about/ali_pay_02.jpg" title="Donate 打赏" height="164px" width="164px"/>
		</a> &nbsp;

		<a href="http://7vzp68.com1.z0.glb.clouddn.com/about/avatar_04.jpg" title="Alipay_Scan_Payment" class="fancybox" rel="article0">
			<img src="http://7vzp68.com1.z0.glb.clouddn.com/about/avatar_04.jpg" title="Thanks 谢谢~" height="164px" width="164px"/>
		</a> &nbsp;

		<a href="http://7vzp68.com1.z0.glb.clouddn.com/about_original/wechat_pay_01.jpg" title="WeChat_Scan_Payment" class="fancybox" rel="article0">
			<img src="http://7vzp68.com1.z0.glb.clouddn.com/about_original/wechat_pay_01.jpg" title="Donate 打赏" height="164px" width="auto"/>
		</a>

		<span class="donate_txt">
			Use App <span class="bold"><a href="http://global.alipay.com/ospay/home.htm">Alipay</a> / <a href="http://www.wechat.com/en/">WeChat</a></span>
			to scan QRCode~ Thx for your support.<br/>

			用手机 <span class="bold"><a href="https://mobile.alipay.com/index.htm">支付宝钱包</a> / <a href="http://weixin.qq.com/">微信</a></span>，
			扫一扫即可~ 谢谢您的鼓励。<br/>
			<br/>

			Or donate on <a id="donate_on_web2" class="bold" href="javascript:donate_on_web();" title="Donate 打赏">Web Alipay</a>. /

			也可用 <a id="donate_on_web1" class="bold" href="javascript:donate_on_web();" title="Donate 打赏">网页版支付宝</a>
			打赏。<br/>
		</span>
		<br/>
	</div>
	<!-- /donate guide -->

	<!-- donate script -->
	<script type="text/javascript">
		document.getElementById('btn_donate').onclick = function(){
			$('#donate_board').addClass('hidden');
			$('#donate_guide').removeClass('hidden');
		}

		function donate_on_web(){
			$('#donate').submit();
		}
	</script>
	<!-- /donate script -->
</div>
<!-- /Donate Module -->
```

## 实际效果

- 以下是本博客打赏按钮的**显示效果**，*点击可以打赏博主哦~*

<br/>

<style type="text/css">
	/* <donate-css> */
	.donate_bar a.btn_donate{
		display: inline-block;
		width: 82px;
		height: 82px;
		background: url("http://img.t.sinajs.cn/t5/style/images/apps_PRF/e_media/btn_reward.gif") no-repeat;
		_background: url("http://img.t.sinajs.cn/t5/style/images/apps_PRF/e_media/btn_reward.gif") no-repeat;

		-webkit-transition: background 0s;
		-moz-transition: background 0s;
		-o-transition: background 0s;
		-ms-transition: background 0s;
		transition: background 0s;
	}
	.donate_bar a.btn_donate:hover{ background-position: 0px -82px;}
	.donate_bar .donate_txt {
		display: block;
		color: #9d9d9d;
		font: 14px/2 "Microsoft Yahei";
	}
	.bold{ font-weight: bold; }
	/* </donate-css> */
</style>

<!--Donate Module--><div id="donate_module"><!--form--><form id="donate"action="https://shenghuo.alipay.com/send/payment/fill.htm"method="POST"target="_blank"accept-charset="GBK"><input name="optEmail"type="hidden"value="ice_he@foxmail.com"/><input name="payAmount"type="hidden"value="1.00"/><input id="title"name="title"type="hidden"value="打赏《<%= item.title.substr(0, 16) %>》"/><input name="memo"type="hidden"value="留下您的大名及联系方式(email,blog,etc)，多交流共勉共进："/></form><!--/form--><!--btn_donate&tips--><div id="donate_board"class="donate_bar center"><a id="btn_donate"class="btn_donate"target="_self"href="javascript:;"title="Donate 打赏"></a><span class="donate_txt">&uarr;<br/>If you enjoy the article,please feel free to<span class="bold">donate~</span>Thx.<br/>若本文对您有帮助，<span class="bold">求打赏~</span>谢谢您的鼓励。</span><br/></div><!--/btn_donate&tips--><!--donate guide--><div id="donate_guide"class="donate_bar center hidden"><form action="https://www.paypal.com/cgi-bin/webscr"method="post"target="_blank"><input type="hidden"name="cmd"value="_s-xclick"><input type="hidden"name="hosted_button_id"value="3MPNAMMQA4C8Y">&nbsp;&nbsp;<input type="image"width="auto"height="40em"src="http://7vzp68.com1.z0.glb.clouddn.com/about/palpay_donate_button_00.jpg"border="0"name="submit"alt="PayPal——最安全便捷的在线支付方式！"></form><a href="http://7vzp68.com1.z0.glb.clouddn.com/about/ali_pay_02.jpg"title="Alipay_Scan_Payment"class="fancybox"rel="article0"style="display:inline-table"><img src="http://7vzp68.com1.z0.glb.clouddn.com/about/ali_pay_03.png"title="Donate 打赏"height="164px"width="164px"/></a>&nbsp;<a href="http://7vzp68.com1.z0.glb.clouddn.com/about/avatar_04.jpg"title="Alipay_Scan_Payment"class="fancybox"rel="article0"style="display:inline-table"><img src="http://7vzp68.com1.z0.glb.clouddn.com/about/avatar_04.jpg"title="Thanks 谢谢~"height="164px"width="164px"/></a>&nbsp;<a href="http://7vzp68.com1.z0.glb.clouddn.com/about/wechat_pay_00.png"title="WeChat_Scan_Payment"class="fancybox"rel="article0"style="display:inline-table"><img src="http://7vzp68.com1.z0.glb.clouddn.com/about/wechat_pay_00.png"title="Donate 打赏"height="164px"width="164px"/></a><br/><br/><span class="donate_txt">Use App<span class="bold"><a href="http://global.alipay.com/ospay/home.htm">Alipay</a>/<a href="http://www.wechat.com/en/">WeChat</a></span>to scan QRCode~Thx for your support.<br/>用手机<span class="bold"><a href="https://mobile.alipay.com/index.htm">支付宝钱包</a>/<a href="http://weixin.qq.com/">微信</a></span>，扫一扫即可~谢谢您的鼓励。<br/><br/>Or donate on<a id="donate_on_web2"class="bold"href="javascript:donate_on_web();"title="Donate 打赏">Web Alipay</a>./也可用<a id="donate_on_web1"class="bold"href="javascript:donate_on_web();"title="Donate 打赏">网页版支付宝</a>打赏。<br/></span></div><!--/donate guide--></div><!--/Donate Module-->

<script type="text/javascript">
/* <donate-script> */
document.getElementById('btn_donate').onclick = function(){
	$('#donate_board').addClass('hidden');
	$('#donate_guide').removeClass('hidden');
}
function donate_on_web(){
	$('#donate').submit();
}
/* </donate-script> */

var original_window_onload = window.onload;
window.onload = function () {
	if (original_window_onload) {
		original_window_onload();
	}
	document.getElementById('donate_board_wdg').className = 'hidden';
}
</script>
