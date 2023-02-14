<?php
$page_title = 'Widgets';
include_once('header.php');
?>

<section class="container background">
	<div class="page-title"><?=$page_title?></div>
	
<pre class="html-help">
<span class="help-title">기본 (콘텐츠) 박스</span>
&lt;div class="<span class="color-yellow">boxContainer</span>"&gt;...
	&lt;div class="<span class="color-yellow">box-header</span>"&gt;타이틀&lt;/div&gt;
	내용
&lt;/div&gt;
</pre>

	<div class="boxContainer">
		<div class="box-header">타이틀</div>
		내용
	</div>
	
	<div class="mt60"></div>

<pre class="html-help">
<span class="help-title">가로 사이즈</span>
&lt;div class="<span class="color-yellow">boxContainer span600</span>"&gt;...&lt;/div&gt;

<span class="color-gray">span -> width:100%
span5, span10 ~ span950, span955</span>
</pre>

	<div class="boxContainer span600">
		흰색박스 + 사이즈
	</div>
	
	<div class="mt60"></div>

<pre class="html-help">
<span class="help-title">박스 N등분</span>
&lt;div class="<span class="color-yellow">flex</span>"&gt;
	&lt;div class="<span class="color-yellow">boxContainer flex1</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">boxContainer flex1</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">boxContainer flex1</span>"&gt;...&lt;/div&gt;
&lt;/div&gt;
</pre>

	<div class="flex">
		<div class="boxContainer flex1">
			flex1
		</div>
		<div class="boxContainer flex1">
			flex1
		</div>
		<div class="boxContainer flex1">
			flex1
		</div>
	</div>

	<div class="mt60"></div>

	<pre class="html-help">
<span class="help-title">박스N등분후 간격</span>
&lt;div class="<span class="color-yellow">flex gap30</span>"&gt;
	&lt;div class="<span class="color-yellow">boxContainer flex1</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">boxContainer flex1</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">boxContainer flex1</span>"&gt;...&lt;/div&gt;
&lt;/div&gt;

<span class="color-gray">gap5, gap10 ~ gap50</span>
</pre>

	<div class="flex gap30">
		<div class="boxContainer flex1">
			flex1
		</div>
		<div class="boxContainer flex1">
			flex1
		</div>
		<div class="boxContainer flex1">
			flex1
		</div>
	</div>

	<div class="mt60"></div>


<pre class="html-help">
<span class="help-title">박스 안쪽 N등분 & 라인</span>
&lt;div class="<span class="color-yellow">boxContainer flex line</span>"&gt;
	&lt;div class="<span class="color-yellow">flex1</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">flex1</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">flex1</span>"&gt;...&lt;/div&gt;
&lt;/div&gt;
</pre>

	<div class="boxContainer flex line">
		<div class="flex1">
			<div class="box-header">타이틀</div>
			내용
		</div>
		<div class="flex1">
			<div class="box-header">타이틀</div>
			내용
		</div>
		<div class="flex1">
			<div class="box-header">타이틀</div>
			내용
		</div>
	</div>	
	
	<div class="mt60"></div>

<pre class="html-help">
<span class="help-title">박스 안쪽 여백</span>
&lt;div class="<span class="color-yellow">flex</span>"&gt;
	&lt;div class="<span class="color-yellow">boxContainer flex1 padding10</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">boxContainer flex1 padding30</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">boxContainer flex1 padding35</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">boxContainer flex1 padding50</span>"&gt;...&lt;/div&gt;
&lt;/div&gt;

<span class="color-gray">padding5 ~ padding110</span>
</pre>

	<div class="flex">
		<div class="boxContainer flex1 padding10">
			padding10
		</div>
		<div class="boxContainer flex1 padding30">
			padding30
		</div>
		<div class="boxContainer flex1 padding35">
			padding35
		</div>
		<div class="boxContainer flex1 padding50">
			padding50
		</div>
	</div>

	<div class="mt60"></div>

	<div class="boxContainer">
<pre class="html-help">
<span class="help-title">롤오버시 팁박스</span>
&lt;div class="<span class="color-yellow">tipContainer</span>"&gt;
	&lt;span class="<span class="color-yellow">el icon</span>"&gt;...&lt;/span&gt;
	&lt;div class="<span class="color-yellow">hidden-box</span>"&gt;...&lt;/div&gt;
&lt;/div&gt;
</pre><br>
		<div class="tipContainer">
			<span class="el icon">마우스오버 팁보기</span>
			<div class="hidden-box">
				<p>내용</p>
				<div class="mt10">
					<a href="#" class="btn small green">바로가기</a>
				</div>
			</div>
		</div>
	</div>

	<div class="mt60"></div>

<pre class="html-help">
<span class="help-title">탭메뉴 컨테이너</span>
&lt;div class="<span class="color-yellow">tabs-wraper widget</span>"&gt;
	&lt;div class="<span class="color-yellow">tabs-group</span>"&gt;
		&lt;a class="<span class="color-yellow">tab active</span>"&gt;Tab1&lt;/a&gt;
		&lt;a class="<span class="color-yellow">tab</span>"&gt;Tab2&lt;/a&gt;
		&lt;a class="<span class="color-yellow">tab</span>"&gt;Tab3&lt;/a&gt;
	&lt;/div&gt;
	&lt;div class="<span class="color-yellow">tabsContainer</span>"&gt;
		&lt;div class="<span class="color-yellow">tabCon active</span>"&gt;...&lt;/div&gt;
		&lt;div class="<span class="color-yellow">tabCon</span>"&gt;...&lt;/div&gt;
		&lt;div class="<span class="color-yellow">tabCon</span>"&gt;...&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;
</pre>

	<div class="tabs-wraper widget">
		<div class="tabs-group">
			<span class="tab active">Tab1</span>
			<span class="tab">Tab2</span>
			<span class="tab">Tab3</span>
		</div>
		<div class="tabsContainer">
			<div class="tabCon active">
				<h1>h1 - 윤동주(서시)</h1>
				<h2>h2 - 윤동주(서시)</h2>
				<h3>h3 - 윤동주(서시)</h3>
				<h4>h4 - 윤동주(서시)</h4>
				<h5>h5 - 윤동주(서시)</h5>
				<h6>h6 - 윤동주(서시)</h6>
				우리말에서 ‘별’은 그 ‘큰 대(大)’자 모양의 도형과 관련해서 동식물의 이름에 많이 쓰이는 것을 볼 수 있다.<br/>
				동식물 가운데도 곤충의 이름에 많이 쓰인다. ‘별꼬리하루살이, 별꽃등에, 별나나니, 별무늬-꼬마거미, 별박이-노린재, 별박이-명주잠자리, 별박이-세줄나비,<br/>
				별박이-안주홍불나방, 별박이-왕잠자리, 별박이-자나방, 별벌레(星蟲), 별수시렁이, 별쌍살벌, 별쌕쌔기,<br/>
				별점-반날개베짱이, 별파리, 별풍덩이파리’와 같은 많은 이름은 곤충의 이름이다.
			</div>
			<div class="tabCon">
				별과 관련된 전통문화(傳統文化)로는 ‘별거리놀이’가 있다.<br/>
				이는 경남 사천(泗川)지방의 농악 판굿의 하나다.<br/>
				다드래기 가락을 한참 치다가 상쇠의 신호로 일시에 멈추고,<br/>
				상쇠가 “별 따자, 별 따자 하늘 멀리 별 따자” 하는 구호를 외치면 모두 다시 다드래기 가락을 치는 놀이이다.
			</div>
			<div class="tabCon">
				‘달별, 떠돌이별, 별똥별, 샛별, 어둠별, 살별’과 같은 별들의 이름은 우리 나름의 발상과 문화를 반영하고 있다.<br/>
				그 중 대표적인 것이 ‘샛별’이다. 이는 신성을 의미하는 말이 아니다. 금성(金星), 곧 Venus를 가리키는 말이다.<br/>
				이는 동쪽 하늘에서 유달리 반짝반짝 빛나 사람의 시선을 끄는 별이다. 그래서 어느 별보다 사랑을 받는다.
			</div>
		</div>
	</div>
	
	<div class="mt60"></div>

<pre class="html-help">
<span class="help-title">슬라이드 토글 컨테이너</span>
&lt;div class="<span class="color-yellow">slide-toggle-wraper</span>"&gt;
	&lt;div class="<span class="color-yellow">slide-toggle-list open</span>"&gt;
		&lt;div class="<span class="color-yellow">slide-opener</span>"&gt;...&lt;/div&gt;
		&lt;div class="<span class="color-yellow">slideCon</span>"&gt;...&lt;/div&gt;
	&lt;/div&gt;
	&lt;div class="<span class="color-yellow">slide-toggle-list</span>"&gt;
		&lt;div class="<span class="color-yellow">slide-opener</span>"&gt;...&lt;/div&gt;
		&lt;div class="<span class="color-yellow">slideCon</span>"&gt;...&lt;/div&gt;
	&lt;/div&gt;
	&lt;div class="<span class="color-yellow">slide-toggle-list</span>"&gt;
		&lt;div class="<span class="color-yellow">slide-opener</span>"&gt;...&lt;/div&gt;
		&lt;div class="<span class="color-yellow">slideCon</span>"&gt;...&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;
</pre>

	<div class="slide-toggle-wraper">
		<div class="slide-toggle-list open">
			<div class="slide-opener">윤동주 서시 (1941년 윤동주가 지은 시)</div>
			<div class="slideCon">
				금성은 아침과 저녁에 따라 그 이름을 달리한다. 저녁에 비치는 금성은 ‘개밥바라기’, 또는 태백성(太白星)이라 하고,<br/>
				새벽에 비치는 것은 ‘샛별’, 또는 계명성(啓明星)이라 한다. ‘샛별’은 동방의 별이란 말이다. 이는 ‘새(東)’와 ‘별(星)’이 합성된 것이다.<br/>
				낱말 사이의 시옷은 두 말을 이어 주는 말이다. 금성이 이렇게 동방의 별을 의미하기에 우리 동요에서는 “샛별이 등대란다 길을 찾아라”라 노래 불리고 있다.
			</div>
		</div>
		<div class="slide-toggle-list">
			<div class="slide-opener">첫째 연에서는 하늘의 이미지가 표상하듯이 천상적인 세계를 지향하는 순결 의지가 드러난다.</div>
			<div class="slideCon">
				첫째 연에서는 하늘의 이미지가 표상하듯이 천상적인 세계를 지향하는 순결 의지가 드러난다.<br/>
				바라는 것, 이념적인 것과 실존적인 것, 한계적인 것 사이의 갈등과 부조화 속에서 오는 부끄러움의 정조가 두드러진다.
			</div>
		</div>
		<div class="slide-toggle-list">
			<div class="slide-opener">둘째 연에는 대지적 질서 속에서의 삶의 고뇌와 함께 섬세한 감수성의 울림이 드러난다.</div>
			<div class="slideCon">
				둘째 연에는 대지적 질서 속에서의 삶의 고뇌와 함께 섬세한 감수성의 울림이 드러난다.<br/>
				셋째 연에는 “별을 노래하는 마음”으로서의 ‘진실한 마음, 착한 마음, 아름다운 마음’을 바탕으로 한 운명애의 정신이 핵심을 이룬다.<br/><br/>
				특히, “그리고 나한테 주어진 길을 걸어가야겠다.”라는 구절은 운명애에 대한 확고하면서도 신념에 찬 결의를 다지고 있는 것으로 해석된다.
			</div>
		</div>
	</div>
	
	<div class="mt100"></div>

<pre class="html-help">
<span class="help-title">탭메뉴 컨테이너 (N등분)</span>
&lt;div class="<span class="color-yellow">flex gap30</span>"&gt;
	&lt;div class="<span class="color-yellow">tabs-wraper widget flex1</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">tabs-wraper widget flex1</span>"&gt;...&lt;/div&gt;
&lt;/div&gt;
</pre>

	<div class="flex gap30">
		<div class="tabs-wraper widget flex1">
			<div class="tabs-group">
				<span class="tab active">Tab1</span>
				<span class="tab">Tab2</span>
				<span class="tab">Tab3</span>
			</div>
			<div class="tabsContainer">
				<div class="tabCon active">
					<h1>h1 - 윤동주(서시)</h1>
					<h2>h2 - 윤동주(서시)</h2>
					<h3>h3 - 윤동주(서시)</h3>
					<h4>h4 - 윤동주(서시)</h4>
					<h5>h5 - 윤동주(서시)</h5>
					<h6>h6 - 윤동주(서시)</h6>
					우리말에서 ‘별’은 그 ‘큰 대(大)’자 모양의 도형과 관련해서 동식물의 이름에 많이 쓰이는 것을 볼 수 있다.<br/>
					동식물 가운데도 곤충의 이름에 많이 쓰인다. ‘별꼬리하루살이, 별꽃등에, 별나나니, 별무늬-꼬마거미, 별박이-노린재, 별박이-명주잠자리, 별박이-세줄나비,<br/>
					별박이-안주홍불나방, 별박이-왕잠자리, 별박이-자나방, 별벌레(星蟲), 별수시렁이, 별쌍살벌, 별쌕쌔기,<br/>
					별점-반날개베짱이, 별파리, 별풍덩이파리’와 같은 많은 이름은 곤충의 이름이다.
				</div>
				<div class="tabCon">
					별과 관련된 전통문화(傳統文化)로는 ‘별거리놀이’가 있다.<br/>
					이는 경남 사천(泗川)지방의 농악 판굿의 하나다.<br/>
					다드래기 가락을 한참 치다가 상쇠의 신호로 일시에 멈추고,<br/>
					상쇠가 “별 따자, 별 따자 하늘 멀리 별 따자” 하는 구호를 외치면 모두 다시 다드래기 가락을 치는 놀이이다.
				</div>
				<div class="tabCon">
					‘달별, 떠돌이별, 별똥별, 샛별, 어둠별, 살별’과 같은 별들의 이름은 우리 나름의 발상과 문화를 반영하고 있다.<br/>
					그 중 대표적인 것이 ‘샛별’이다. 이는 신성을 의미하는 말이 아니다. 금성(金星), 곧 Venus를 가리키는 말이다.<br/>
					이는 동쪽 하늘에서 유달리 반짝반짝 빛나 사람의 시선을 끄는 별이다. 그래서 어느 별보다 사랑을 받는다.
				</div>
			</div>
		</div>
		<div class="tabs-wraper widget flex1">
			<div class="tabs-group">
				<span class="tab active">Tab1</span>
				<span class="tab">Tab2</span>
				<span class="tab">Tab3</span>
			</div>
			<div class="tabsContainer">
				<div class="tabCon active">
					<h1>h1 - 윤동주(서시)</h1>
					<h2>h2 - 윤동주(서시)</h2>
					<h3>h3 - 윤동주(서시)</h3>
					<h4>h4 - 윤동주(서시)</h4>
					<h5>h5 - 윤동주(서시)</h5>
					<h6>h6 - 윤동주(서시)</h6>
					우리말에서 ‘별’은 그 ‘큰 대(大)’자 모양의 도형과 관련해서 동식물의 이름에 많이 쓰이는 것을 볼 수 있다.<br/>
					동식물 가운데도 곤충의 이름에 많이 쓰인다. ‘별꼬리하루살이, 별꽃등에, 별나나니, 별무늬-꼬마거미, 별박이-노린재, 별박이-명주잠자리, 별박이-세줄나비,<br/>
					별박이-안주홍불나방, 별박이-왕잠자리, 별박이-자나방, 별벌레(星蟲), 별수시렁이, 별쌍살벌, 별쌕쌔기,<br/>
					별점-반날개베짱이, 별파리, 별풍덩이파리’와 같은 많은 이름은 곤충의 이름이다.
				</div>
				<div class="tabCon">
					별과 관련된 전통문화(傳統文化)로는 ‘별거리놀이’가 있다.<br/>
					이는 경남 사천(泗川)지방의 농악 판굿의 하나다.<br/>
					다드래기 가락을 한참 치다가 상쇠의 신호로 일시에 멈추고,<br/>
					상쇠가 “별 따자, 별 따자 하늘 멀리 별 따자” 하는 구호를 외치면 모두 다시 다드래기 가락을 치는 놀이이다.
				</div>
				<div class="tabCon">
					‘달별, 떠돌이별, 별똥별, 샛별, 어둠별, 살별’과 같은 별들의 이름은 우리 나름의 발상과 문화를 반영하고 있다.<br/>
					그 중 대표적인 것이 ‘샛별’이다. 이는 신성을 의미하는 말이 아니다. 금성(金星), 곧 Venus를 가리키는 말이다.<br/>
					이는 동쪽 하늘에서 유달리 반짝반짝 빛나 사람의 시선을 끄는 별이다. 그래서 어느 별보다 사랑을 받는다.
				</div>
			</div>
		</div>
	</div>

	<div class="mt60"></div>

<pre class="html-help">
<span class="help-title">슬라이드 토글 컨테이너 (N등분)</span>
&lt;div class="<span class="color-yellow">flex gap20</span>"&gt;
	&lt;div class="<span class="color-yellow">slide-toggle-wraper flex1</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">slide-toggle-wraper flex1</span>"&gt;...&lt;/div&gt;
	&lt;div class="<span class="color-yellow">slide-toggle-wraper flex1</span>"&gt;...&lt;/div&gt;
&lt;/div&gt;
</pre>

	<div class="flex gap20">
		<div class="slide-toggle-wraper flex1">
			<div class="slide-toggle-list open">
				<div class="slide-opener">윤동주 서시 (1941년 윤동주가 지은 시)</div>
				<div class="slideCon">
					금성은 아침과 저녁에 따라 그 이름을 달리한다. 저녁에 비치는 금성은 ‘개밥바라기’, 또는 태백성(太白星)이라 하고,<br/>
					새벽에 비치는 것은 ‘샛별’, 또는 계명성(啓明星)이라 한다. ‘샛별’은 동방의 별이란 말이다. 이는 ‘새(東)’와 ‘별(星)’이 합성된 것이다.<br/>
					낱말 사이의 시옷은 두 말을 이어 주는 말이다. 금성이 이렇게 동방의 별을 의미하기에 우리 동요에서는 “샛별이 등대란다 길을 찾아라”라 노래 불리고 있다.
				</div>
			</div>
			<div class="slide-toggle-list">
				<div class="slide-opener">첫째 연에서는 하늘의 이미지가 표상하듯이 천상적인 세계를 지향하는 순결 의지가 드러난다.</div>
				<div class="slideCon">
					첫째 연에서는 하늘의 이미지가 표상하듯이 천상적인 세계를 지향하는 순결 의지가 드러난다.<br/>
					바라는 것, 이념적인 것과 실존적인 것, 한계적인 것 사이의 갈등과 부조화 속에서 오는 부끄러움의 정조가 두드러진다.
				</div>
			</div>
			<div class="slide-toggle-list">
				<div class="slide-opener">둘째 연에는 대지적 질서 속에서의 삶의 고뇌와 함께 섬세한 감수성의 울림이 드러난다.</div>
				<div class="slideCon">
					둘째 연에는 대지적 질서 속에서의 삶의 고뇌와 함께 섬세한 감수성의 울림이 드러난다.<br/>
					셋째 연에는 “별을 노래하는 마음”으로서의 ‘진실한 마음, 착한 마음, 아름다운 마음’을 바탕으로 한 운명애의 정신이 핵심을 이룬다.<br/><br/>
					특히, “그리고 나한테 주어진 길을 걸어가야겠다.”라는 구절은 운명애에 대한 확고하면서도 신념에 찬 결의를 다지고 있는 것으로 해석된다.
				</div>
			</div>
		</div>
		<div class="slide-toggle-wraper flex1">
			<div class="slide-toggle-list ">
				<div class="slide-opener">윤동주 서시 (1941년 윤동주가 지은 시)</div>
				<div class="slideCon">
					금성은 아침과 저녁에 따라 그 이름을 달리한다. 저녁에 비치는 금성은 ‘개밥바라기’, 또는 태백성(太白星)이라 하고,<br/>
					새벽에 비치는 것은 ‘샛별’, 또는 계명성(啓明星)이라 한다. ‘샛별’은 동방의 별이란 말이다. 이는 ‘새(東)’와 ‘별(星)’이 합성된 것이다.<br/>
					낱말 사이의 시옷은 두 말을 이어 주는 말이다. 금성이 이렇게 동방의 별을 의미하기에 우리 동요에서는 “샛별이 등대란다 길을 찾아라”라 노래 불리고 있다.
				</div>
			</div>
			<div class="slide-toggle-list open">
				<div class="slide-opener">첫째 연에서는 하늘의 이미지가 표상하듯이 천상적인 세계를 지향하는 순결 의지가 드러난다.</div>
				<div class="slideCon">
					첫째 연에서는 하늘의 이미지가 표상하듯이 천상적인 세계를 지향하는 순결 의지가 드러난다.<br/>
					바라는 것, 이념적인 것과 실존적인 것, 한계적인 것 사이의 갈등과 부조화 속에서 오는 부끄러움의 정조가 두드러진다.
				</div>
			</div>
			<div class="slide-toggle-list">
				<div class="slide-opener">둘째 연에는 대지적 질서 속에서의 삶의 고뇌와 함께 섬세한 감수성의 울림이 드러난다.</div>
				<div class="slideCon">
					둘째 연에는 대지적 질서 속에서의 삶의 고뇌와 함께 섬세한 감수성의 울림이 드러난다.<br/>
					셋째 연에는 “별을 노래하는 마음”으로서의 ‘진실한 마음, 착한 마음, 아름다운 마음’을 바탕으로 한 운명애의 정신이 핵심을 이룬다.<br/><br/>
					특히, “그리고 나한테 주어진 길을 걸어가야겠다.”라는 구절은 운명애에 대한 확고하면서도 신념에 찬 결의를 다지고 있는 것으로 해석된다.
				</div>
			</div>
		</div>
		<div class="slide-toggle-wraper flex1">
			<div class="slide-toggle-list ">
				<div class="slide-opener">윤동주 서시 (1941년 윤동주가 지은 시)</div>
				<div class="slideCon">
					금성은 아침과 저녁에 따라 그 이름을 달리한다. 저녁에 비치는 금성은 ‘개밥바라기’, 또는 태백성(太白星)이라 하고,<br/>
					새벽에 비치는 것은 ‘샛별’, 또는 계명성(啓明星)이라 한다. ‘샛별’은 동방의 별이란 말이다. 이는 ‘새(東)’와 ‘별(星)’이 합성된 것이다.<br/>
					낱말 사이의 시옷은 두 말을 이어 주는 말이다. 금성이 이렇게 동방의 별을 의미하기에 우리 동요에서는 “샛별이 등대란다 길을 찾아라”라 노래 불리고 있다.
				</div>
			</div>
			<div class="slide-toggle-list">
				<div class="slide-opener">첫째 연에서는 하늘의 이미지가 표상하듯이 천상적인 세계를 지향하는 순결 의지가 드러난다.</div>
				<div class="slideCon">
					첫째 연에서는 하늘의 이미지가 표상하듯이 천상적인 세계를 지향하는 순결 의지가 드러난다.<br/>
					바라는 것, 이념적인 것과 실존적인 것, 한계적인 것 사이의 갈등과 부조화 속에서 오는 부끄러움의 정조가 두드러진다.
				</div>
			</div>
			<div class="slide-toggle-list open">
				<div class="slide-opener">둘째 연에는 대지적 질서 속에서의 삶의 고뇌와 함께 섬세한 감수성의 울림이 드러난다.</div>
				<div class="slideCon">
					둘째 연에는 대지적 질서 속에서의 삶의 고뇌와 함께 섬세한 감수성의 울림이 드러난다.<br/>
					셋째 연에는 “별을 노래하는 마음”으로서의 ‘진실한 마음, 착한 마음, 아름다운 마음’을 바탕으로 한 운명애의 정신이 핵심을 이룬다.<br/><br/>
					특히, “그리고 나한테 주어진 길을 걸어가야겠다.”라는 구절은 운명애에 대한 확고하면서도 신념에 찬 결의를 다지고 있는 것으로 해석된다.
				</div>
			</div>
		</div>
	</div>

</section>


<?php include_once('footer.php'); ?>