<?php
$page_title = 'Button';
include_once('header.php');
?>

<section class="container background">
	<div class="page-title"><?=$page_title?></div>

	<div class="boxContainer">
		<div class="box-header">버튼 크기</div>
<div>
<pre class="html-help">
<span class="help-title">버튼 크기</span>
&lt;a href="#" class="<span class="color-yellow">btn large</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn small</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn mini</span>"&gt;...&lt;/a&gt;
</pre>
</div>
		<a href="#" class="btn large">버튼 (large)</a>	
		<a href="#" class="btn">버튼 (기본)</a>		
		<a href="#" class="btn small">버튼 (small)</a>
		<a href="#" class="btn mini">버튼 (mini)</a>
	</div>
	
	<div class="mt40"></div>

	<div class="boxContainer">
		<div class="box-header">버튼 사이즈</div>
<div>
<pre class="html-help">
<span class="help-title">버튼 가로 사이즈</span>
&lt;a href="#" class="<span class="color-yellow">btn large span100</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn large span150</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn large span200</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn large span300</span>"&gt;...&lt;/a&gt;
</pre>
</div>
		<a href="#" class="btn large span100">버튼</a>	
		<a href="#" class="btn large span150">버튼</a>	
		<a href="#" class="btn large span200">버튼</a>	
		<a href="#" class="btn large span300">버튼</a>	
	</div>
	
	<div class="mt40"></div>

	<div class="boxContainer">
		<div class="box-header">버튼 컬러</div>
<div>
<pre class="html-help">
<span class="help-title">버튼 컬러</span>
&lt;a href="#" class="<span class="color-yellow">btn</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn black</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn gray</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn dark-gray</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn red</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn blue</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn bluelight</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn green</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn orange</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn yellow</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn reverse</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn reverse gray</span>"&gt;...&lt;/a&gt;
&lt;a href="#" class="<span class="color-yellow">btn reverse mainColor</span>"&gt;...&lt;/a&gt;
</pre>
</div>
		
		<a href="#" class="btn">버튼(기본컬러)</a>
		<a href="#" class="btn black">버튼(black)</a>
		<a href="#" class="btn gray">버튼(gray)</a>
		<a href="#" class="btn dark-gray">버튼(dark-gray)</a>
		<a href="#" class="btn red">버튼(red)</a>
		<a href="#" class="btn blue">버튼(blue)</a>
		<a href="#" class="btn bluelight">버튼(bluelight)</a>
		<a href="#" class="btn green">버튼(green)</a>
		<a href="#" class="btn orange">버튼(orange)</a>
		<a href="#" class="btn yellow">버튼(yellow)</a>
		<a href="#" class="btn reverse">버튼(reverse)</a>
		<a href="#" class="btn reverse gray">버튼(reverse)</a>
		<a href="#" class="btn reverse mainColor">버튼(reverse)</a>
	</div>

<div class="mt40"></div>

<div class="boxContainer">
	<div class="box-header">게시판 버튼세트</div>

<div>
<pre class="html-help">
<span class="help-title">기본 버튼셋 (중앙정렬&간격)</span>
&lt;div href="#" class="<span class="color-yellow">btnSet</span>"&gt;
	&lt;a href="#" class="<span class="color-yellow">btn blue</span>"&gt;미리보기&lt;/a&gt;
	&lt;a href="#" class="<span class="color-yellow">btn submit</span>"&gt;확인&lt;/a&gt;
	&lt;a href="#" class="<span class="color-yellow">btn gray</span>"&gt;취소&lt;/a&gt;
&lt;/div&gt;
</pre>
</div>
	내용
	<div class="btnSet">
		<a href="#" class="btn blue">미리보기</a>
		<a href="#" class="btn submit">확인</a>
		<a href="#" class="btn gray">취소</a>
	</div>
</div>

<div class="mt40"></div>

<div class="boxContainer">
	<div class="box-header">게시판 페이지 버튼</div>

<div>
<pre class="html-help">
<span class="help-title">페이지 넘버셋</span>
&lt;div href="#" class="<span class="color-yellow">pagination</span>"&gt;
	&lt;a href="#" class="<span class="color-yellow">pg-btn first</span>"&gt;&lt;/a&gt;
	&lt;a href="#" class="<span class="color-yellow">pg-btn prev</span>"&gt;&lt;/a&gt;
	&lt;a href="#" class="<span class="color-yellow">pg-btn active</span>"&gt;1&lt;/a&gt;
	&lt;a href="#" class="<span class="color-yellow">pg-btn</span>"&gt;2&lt;/a&gt;
	&lt;a href="#" class="<span class="color-yellow">pg-btn</span>"&gt;3&lt;/a&gt;
	...
	&lt;a href="#" class="<span class="color-yellow">pg-btn</span>"&gt;8&lt;/a&gt;
	&lt;a href="#" class="<span class="color-yellow">pg-btn</span>"&gt;9&lt;/a&gt;
	&lt;a href="#" class="<span class="color-yellow">pg-btn</span>"&gt;10&lt;/a&gt;
	&lt;a href="#" class="<span class="color-yellow">pg-btn next</span>"&gt;&lt;/a&gt;
	&lt;a href="#" class="<span class="color-yellow">pg-btn last</span>"&gt;&lt;/a&gt;
&lt;/div&gt;
</pre>
</div>
	<div class="pagination">
		<a href="#" class="pg-btn first"></a>
		<a href="#" class="pg-btn prev"></a>
		<a href="#" class="pg-btn active">1</a>
		<a href="#" class="pg-btn">2</a>
		<a href="#" class="pg-btn">3</a>
		<a href="#" class="pg-btn">4</a>
		<a href="#" class="pg-btn">5</a>
		<a href="#" class="pg-btn">6</a>
		<a href="#" class="pg-btn">7</a>
		<a href="#" class="pg-btn">8</a>
		<a href="#" class="pg-btn">9</a>
		<a href="#" class="pg-btn">10</a>
		<a href="#" class="pg-btn next"></a>
		<a href="#" class="pg-btn last"></a>
	</div>
</div>



</section>

<?php include_once('footer.php'); ?>