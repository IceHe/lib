title: Google CSE 站内搜索
date: 2116-01-17
categories: [Web]
tags: [Web]
description: CSE = Custom Search Engine. 在本博客的搜索框中输入关键词，将展示本站的谷歌搜索结果。
toc: false
---
- ** 首先，需要您能访问 Google ！**
- 在 <a target="_self" href="javascript:;" onclick="$('#search').fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200); focusSearchInput();">**搜索框**</a> 输入关键词后，按回车键，将在本页展示结果 ~ <gcse:searchresults-only></gcse:searchresults-only>
- 参考《 [Google Custom Search Engine](https://cse.google.com/cse/) 》实现，不赘述。

<script id="jQueryLink" src="//libs.baidu.com/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript">
  window.jQuery || document.write('<script src="<%- config.root %>js/jquery-2.0.3.min.js"><\/script>');
</script>

<script text='text/javascript'>
  
  function GetRequest() {
   var url = location.search; //获取url中"?"符后的字串
   var theRequest = new Object();
   if (url.indexOf("?") != -1) {
      var str = url.substr(1);
      strs = str.split("&");
      for(var i = 0; i < strs.length; i ++) {
         theRequest[strs[i].split("=")[0]] = decodeURIComponent(escape(strs[i].split("=")[1]));
      }
   }
   return theRequest;
  }
  
  var keyword = GetRequest()['q'];
  if (keyword != undefined) {
    $('#search').val(decodeURIComponent(keyword.replace('+', ' ')));
	  (function() {
		var cx = '010792257197806788789:dpopjn23wd4';
		var gcse = document.createElement('script');
		gcse.type = 'text/javascript';
		gcse.async = true;
		gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
			'//cse.google.com/cse.js?cx=' + cx;
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(gcse, s);
	  })();
  }
  
  function focusSearchInput() {
    var t = $('#search')[0];
    t.focus();
    t.selectionStart = t.selectionEnd = t.value.length;
  }
</script>

