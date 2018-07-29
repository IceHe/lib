title: 打赏博主
date: 2015-05-02
updated: 2016-08-18
categories: [whoami]
tags: [whoami]
description: Reward Me&#58; 来打赏博主吧~
toc: false
---

<div id="thx_text" class="hidden"><div class="center"><hr/><br/>搭建此博客期间，想到其它网站的**捐赠**功能，想必其实现不会太困难，于是查阅资料、动手尝试。<br/>《[**实现博客网站的支付宝打赏功能 —— Donate 打赏博主**](/web/donate/)》记叙了本博客**打赏**功能的实现。<br/><br/>博主水平有限，仅为好奇实现了该模块，若本博客对您有帮助，仍期待您的打赏~谢谢您的鼓励和支持。<br/>If you enjoy the blog, please feel free to donate~Thx for your support.<br/><br/></div></div>
<script type="text/javascript">	window.onload=function(){	$('#btn_donate').click();	$('#donate_board').parent().append($('#thx_text').html());	}	</script>

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

<!--Donate Module--><div id="donate_module"><!--form--><form id="donate"action="https://shenghuo.alipay.com/send/payment/fill.htm"method="POST"target="_blank"accept-charset="GBK"><input name="optEmail"type="hidden"value="ice_he@foxmail.com"/><input name="payAmount"type="hidden"value="1.00"/><input id="title"name="title"type="hidden"value="打赏《<%= item.title.substr(0, 16) %>》"/><input name="memo"type="hidden"value="留下您的大名及联系方式(email,blog,etc)，多交流共勉共进："/></form><!--/form--><!--btn_donate&tips--><div id="donate_board"class="donate_bar center"><a id="btn_donate"class="btn_donate"target="_self"href="javascript:;"title="Donate 打赏"></a><span class="donate_txt">&uarr;<br/>If you enjoy the article,please feel free to<span class="bold">donate~</span>Thx.<br/>若本文对您有帮助，<span class="bold">求打赏~</span>谢谢您的鼓励。</span><br/></div><!--/btn_donate&tips--><!--donate guide--><div id="donate_guide"class="donate_bar center hidden"><form action="https://www.paypal.com/cgi-bin/webscr"method="post"target="_blank"><input type="hidden"name="cmd"value="_s-xclick"><input type="hidden"name="hosted_button_id"value="3MPNAMMQA4C8Y">&nbsp;&nbsp;<input type="image"width="auto"height="40em"src="http://7vzp68.com1.z0.glb.clouddn.com/about/palpay_donate_button_00.jpg"border="0"name="submit"alt="PayPal——最安全便捷的在线支付方式！"></form><a href="http://7vzp68.com1.z0.glb.clouddn.com/about/ali_pay_03.png"title="Alipay_Scan_Payment"class="fancybox"rel="article0"style="display:inline-table"><img src="http://7vzp68.com1.z0.glb.clouddn.com/about/ali_pay_03.png"title="Donate 打赏"height="164px"width="164px"/></a>&nbsp;<a href="http://7vzp68.com1.z0.glb.clouddn.com/about/avatar_04.jpg"title="Alipay_Scan_Payment"class="fancybox"rel="article0"style="display:inline-table"><img src="http://7vzp68.com1.z0.glb.clouddn.com/about/avatar_04.jpg"title="Thanks 谢谢~"height="164px"width="164px"/></a>&nbsp;<a href="http://7vzp68.com1.z0.glb.clouddn.com/about/wechat_pay_00.png"title="WeChat_Scan_Payment"class="fancybox"rel="article0"style="display:inline-table"><img src="http://7vzp68.com1.z0.glb.clouddn.com/about/wechat_pay_00.png"title="Donate 打赏"height="164px"width="164px"/></a><br/><br/></span></div><!--/donate guide--></div><!--/Donate Module-->

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
