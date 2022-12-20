<?php
$page_title = 'Font';
include_once('header.php');
?>

<section class="container background">
	<div class="page-title"><?=$page_title?></div>
	
	<div class="boxContainer">
		<div class="box-header"><span class="bg-yellow">폰트 컬러</span></div>

<pre class="html-help">
<span class="help-title">폰트 컬러 (특정영역 안에서는 적용되지 않을수 있음)</span>
...
&lt;b class="<span class="color-yellow">color-yellow</span>"&gt;...&lt;/b&gt;&lt;br&gt;
&lt;b class="<span class="color-yellow">color-red</span>"&gt;...&lt;/b&gt;&lt;br&gt;
&lt;b class="<span class="color-yellow">color-blue</span>"&gt;...&lt;/b&gt;&lt;br&gt;
&lt;b class="<span class="color-yellow">color-black</span>"&gt;...&lt;/b&gt;&lt;br&gt;
&lt;b class="<span class="color-yellow">color-gray</span>"&gt;...&lt;/b&gt;&lt;br&gt;
&lt;b class="<span class="color-yellow">color-green</span>"&gt;...&lt;/b&gt;&lt;br&gt;
&lt;b class="<span class="color-yellow">color-orange</span>"&gt;...&lt;/b&gt;
&lt;b class="<span class="color-yellow">bg-gray color-white</span>"&gt;...&lt;/b&gt;
...
</pre><br>

		<p>
			<b class="color-yellow">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</b><br>
			<b class="color-red">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</b><br>
			<b class="color-blue">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</b><br>
			<b class="color-black">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</b><br>
			<b class="color-gray">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</b><br>
			<b class="color-green">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</b><br>
			<b class="color-orange">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</b><br>
			<b class="bg-gray color-white">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</b>
		</p>


		<div class="mt60"></div>
		<div class="box-header"><span class="bg-yellow">폰트 사이즈</span></div>
<pre class="html-help">
<span class="help-title">폰트 사이즈</span>
&lt;span class="<span class="color-yellow">fs11</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">fs12</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">fs13</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">fs14</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">fs15</span>"&gt;...&lt;/span&gt;
~
&lt;span class="<span class="color-yellow">fs60</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">fs70</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">fs80</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">fs90</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">fs100</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">fs110</span>"&gt;...&lt;/span&gt;
</pre><br>
		
		<p>
			<span class="fs11">폰트사이즈(fs11)</span>
			<span class="fs12">폰트사이즈(fs12)</span>
			<span class="fs13">폰트사이즈(fs13)</span>
			<span class="fs14">폰트사이즈(fs14)</span>
			<span class="fs15">폰트사이즈(fs15)</span>
			<span class="fs16">폰트사이즈(fs16)</span>
			<span class="fs17">폰트사이즈(fs17)</span>
			....
			<span class="fs30">폰트사이즈(fs30)</span>
		</p>


		<div class="mt60"></div>
		<div class="box-header"><span class="bg-yellow">텍스트 행간 높이</span></div>

		<div class="flex">
			<div class="flex1">
<pre class="html-help">
<span class="help-title">텍스트 행간 높이 (100 = 100%)</span>
&lt;p class="<span class="color-yellow">line-height80</span>"&gt;
	...
&lt;/p&gt;
<span class="color-gray">line-height80 ~ line-height200</span>
<span class="color-gray">5씩 증가</span>
</pre><br>		
				<p class="line-height80">
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
				</p>
			</div>
			<div class="flex1">
<pre class="html-help">
<span class="help-title">텍스트 행간 높이 (100 = 100%)</span>
&lt;p class="<span class="color-yellow">line-height110</span>"&gt;
	...
&lt;/p&gt;
<span class="color-gray">line-height80 ~ line-height200</span>
<span class="color-gray">5씩 증가</span>
</pre><br>		
				<p class="line-height110">
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
				</p>
			</div>
			<div class="flex1">
<pre class="html-help">
<span class="help-title">텍스트 행간 높이 (100 = 100%)</span>
&lt;p class="<span class="color-yellow">line-height145</span>"&gt;
	...
&lt;/p&gt;
<span class="color-gray">line-height80 ~ line-height200</span>
<span class="color-gray">5씩 증가</span>
</pre><br>		
				<p class="line-height145">
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
				</p>
			</div>
			<div class="flex1">
<pre class="html-help">
<span class="help-title">텍스트 행간 높이 (100 = 100%)</span>
&lt;p class="<span class="color-yellow">line-height170</span>"&gt;
	...
&lt;/p&gt;
<span class="color-gray">line-height80 ~ line-height200</span>
<span class="color-gray">5씩 증가</span>
</pre><br>		
				<p class="line-height170">
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
				</p>
			</div>
			<div class="flex1">
<pre class="html-help">
<span class="help-title">텍스트 행간 높이 (100 = 100%)</span>
&lt;p class="<span class="color-yellow">line-height200</span>"&gt;
	...
&lt;/p&gt;
<span class="color-gray">line-height80 ~ line-height200</span>
<span class="color-gray">5씩 증가</span>
</pre><br>		
				<p class="line-height200">
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
					모든 사람은 의견의 자유와 표현의...<br>
				</p>
			</div>
		</div>


		<div class="mt60"></div>
		<div class="box-header"><span class="bg-yellow">폰트 종류</span></div>
<pre class="html-help">
<span class="help-title">폰트 적용 (Noto Sans KR)</span>
&lt;span class="<span class="color-yellow">noto100</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">noto300</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">noto400</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">noto500</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">noto600</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">noto700</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">noto800</span>"&gt;...&lt;/span&gt;
</pre><br>
		
		<p class="fs18">
			<span class="noto100">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</span><br>
			<span class="noto300">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</span><br>
			<span class="noto400">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</span><br>
			<span class="noto500">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</span><br>
			<span class="noto600">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</span><br>
			<span class="noto700">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</span><br>
			<span class="noto800">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</span><br>
		</p>

		<div class="mt30"></div>
<pre class="html-help">
<span class="help-title">폰트 적용 (Black Han Sans)</span>
&lt;span class="<span class="color-yellow">blackHanSan</span>"&gt;...&lt;/span&gt;
</pre><br>
		
		<p class="fs31">
			<span class="blackHanSan">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</span>
		</p>

		<div class="mt30"></div>
<pre class="html-help">
<span class="help-title">폰트 적용 (나눔스퀘어)</span>
&lt;span class="<span class="color-yellow">nanumSR</span>"&gt;...&lt;/span&gt;
&lt;span class="<span class="color-yellow">nanumSR bold</span>"&gt;...&lt;/span&gt;
</pre><br>
		
		<p class="fs15">
			<span class="nanumSR">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</span><br>
			<span class="nanumSR bold">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다</span>
		</p>

		<div class="mt30"></div>
<pre class="html-help">
<span class="help-title">폰트 적용 (Montserrat)</span>
&lt;span class="<span class="color-yellow">mont</span>"&gt;1234567890 abcdefg ABCDEFG&lt;/span&gt;
&lt;span class="<span class="color-yellow">mont100</span>"&gt;1234567890 abcdefg ABCDEFG&lt;/span&gt;
&lt;span class="<span class="color-yellow">mont200</span>"&gt;1234567890 abcdefg ABCDEFG&lt;/span&gt;
&lt;span class="<span class="color-yellow">mont300</span>"&gt;1234567890 abcdefg ABCDEFG&lt;/span&gt;
&lt;span class="<span class="color-yellow">mont400</span>"&gt;1234567890 abcdefg ABCDEFG&lt;/span&gt;
&lt;span class="<span class="color-yellow">mont500</span>"&gt;1234567890 abcdefg ABCDEFG&lt;/span&gt;
&lt;span class="<span class="color-yellow">mont600</span>"&gt;1234567890 abcdefg ABCDEFG&lt;/span&gt;
&lt;span class="<span class="color-yellow">mont800</span>"&gt;1234567890 abcdefg ABCDEFG&lt;/span&gt;
&lt;span class="<span class="color-yellow">mont900</span>"&gt;1234567890 abcdefg ABCDEFG&lt;/span&gt;
</pre><br>
		
		<p class="fs20">
			<span class="mont">1234567890 abcdefg ABCDEFG</span><br>
			<span class="mont100">1234567890 abcdefg ABCDEFG</span><br>
			<span class="mont200">1234567890 abcdefg ABCDEFG</span><br>
			<span class="mont300">1234567890 abcdefg ABCDEFG</span><br>
			<span class="mont400">1234567890 abcdefg ABCDEFG</span><br>
			<span class="mont500">1234567890 abcdefg ABCDEFG</span><br>
			<span class="mont600">1234567890 abcdefg ABCDEFG</span><br>
			<span class="mont800">1234567890 abcdefg ABCDEFG</span><br>
			<span class="mont900">1234567890 abcdefg ABCDEFG</span><br>
		</p>

		<div class="mt60"></div>
<pre class="html-help">
<span class="help-title">타이틀 폰트 (Noto Sans KR 적용)</span>
&lt;div class="<span class="color-yellow">h1</span>"&gt;...&lt;/div&gt;
&lt;div class="<span class="color-yellow">h2</span>"&gt;...&lt;/div&gt;
&lt;div class="<span class="color-yellow">h3</span>"&gt;...&lt;/div&gt;
&lt;div class="<span class="color-yellow">h4</span>"&gt;...&lt;/div&gt;
&lt;div class="<span class="color-yellow">h5</span>"&gt;...&lt;/div&gt;
&lt;div class="<span class="color-yellow">h6</span>"&gt;...&lt;/div&gt;
</pre><br>
		
		<div class="">
			<div class="h1">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다 1234567890 abcdefg ABCDEFG</div>
			<div class="h2">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다 1234567890 abcdefg ABCDEFG</div>
			<div class="h3">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다 1234567890 abcdefg ABCDEFG</div>
			<div class="h4">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다 1234567890 abcdefg ABCDEFG</div>
			<div class="h5">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다 1234567890 abcdefg ABCDEFG</div>
			<div class="h6">모든 사람은 의견의 자유와 표현의 자유에 대한 권리를 가진다 1234567890 abcdefg ABCDEFG</div>
		</div>

	</div>
	


</section>


<?php include_once('footer.php'); ?>














