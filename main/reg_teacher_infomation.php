<?php // Header load
	include_once ("./_common.php");
	include_once (G5_PATH."/head.php");

?>


<div class="contents grid-lg container">

	<div class="teacher-set">
		
		<h3>열린 수업 일정 선택 <i class="icon icon-caret"></i></h3>
		<ul class="class-schedule columns">
			<li class="column col-4 col-md-6">
				<div class="card">
					<div class="card-header">
						<label class="form-checkbox form-inline">
							<input type="checkbox"><i class="form-icon"></i> 수강신청 가능
						</label>
					</div>
					<dl class="class-schedule">
						<dt>수업 일정</dt>
						<dd>19년 3월 27일 수요일 (16:00 ~ 19:00)</dd>
					</dl>
				</div>
			</li>
			<li class="column col-4 col-md-6">
				<div class="card">
					<div class="card-header">
						<label class="form-checkbox form-inline">
							<input type="checkbox"><i class="form-icon"></i> 수강신청 가능
						</label>
					</div>
					<dl class="class-schedule">
						<dt>수업 일정</dt>
						<dd>19년 3월 27일 수요일 (16:00 ~ 19:00)</dd>
					</dl>
				</div>
			</li>
			<li class="column col-4 col-md-6">
				<div class="card is-close">
					<div class="card-header">
						<label class="form-checkbox form-inline">
							<input type="checkbox" disabled><i class="form-icon"></i> 수강신청 불가
						</label>
					</div>
					<dl class="class-schedule">
						<dt>수업 일정</dt>
						<dd>19년 3월 27일 수요일 (16:00 ~ 19:00)</dd>
					</dl>
				</div>
			</li>
		</ul>
		
		<div class="class-info columns col-gapless">
			
			<div class="column col-8 col-md-12">

				<ul class="tab">
					<li class="tab-item active" data-tabname="tab-info">
						<a href="#class-info">수업 설명</a>
					</li>
					<li class="tab-item" data-tabname="tab-career">
						<a href="#teacher-career">선생님 경력</a>
					</li>
					<li class="tab-item" data-tabname="tab-attention">
						<a href="#class-attention">주의사항</a>
					</li>
					<li class="tab-item">
						<a href="/drawit/board_list.php">수업 후기</a>
					</li>
				</ul>
				
				<div class="tab-content" data-tabname-content="tab-info">
					<h4>선생님 소개</h4>
					<p><img src="https://cdn.class101.net/images/73190ea2-f583-4404-b1af-91dcc2129a24/1200xauto@2x" class="img-responsive" /></p>
					<p>안녕하세요, 여행 이야기를 그리고 있는 김모밀입니다.<br/>제 여행 이야기를 만화로 풀어 전하고 있어요. 개인적인 경험이지만 누군가에게는 공감이 되고, 누군가에게는 다음 여행지에 대한 힌트가 되기도 하지요 :)<br/>어느새 많은 분들과 함께 여행하는 기분으로 만화를 그리고 있답니다.</p>
					<h4>수업 소개</h4>
					<p>SNS를 통해서 여행의 에피소드를 만화로 그려내면, 많은 분들이 저와 함께 여행하는 마음으로 이야기를 나눠주시곤 해요. 제 만화를 보시던 분들이 이번 클래스를 통해서 조금 더 적극적인 방법으로 자신만의 여행을 그려내실 수 있기를 바랍니다.</p>
					<p><img src="https://cdn.class101.net/images/fab1c922-5761-4d58-a74c-4c40cc0d18cc/1200xauto@2x" class="img-responsive" /></p>
					<p>클래스에서는 아이패드와 애플펜슬을 이용해서 여행기를 그려볼 거예요. 여행에 대한 인상은 여행 전체의 사건들 뿐 아니라 특정한 음식이나 장소, 물건을 통해 마음에 오래 남는 것 같아요.</p>
					<p>여행 중에 우리의 마음을 울렸던 작은 아이템들을 나열해 그리는 것만으로도 각자의 훌륭한 여행기가 될 거예요. 위의 그림 처럼요!</p>
					<p>제가 사용하는 브러쉬, 채색법, 질감 표현을 공유하고, 저처럼 단순하게 그리고도 감성적으로 보이는 꿀팁을 공유하고싶어요. 포스터나 엽서, 스티커 처럼 손에 직접 잡히는 특별한 기념품을 만들어 보는 것도 즐거울 거예요.</p>
				</div>
				
				<div class="tab-content" data-tabname-content="tab-career" style="display:none;">
					<h4>주요 경력</h4>
					<ul>
						<li class="text-ellipsis">
							<span class="text-gray">2012 - 2013</span>
							이스트소프트 - 카발 1,2 원화 및 일러스트
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2014 - 2016</span>
							(Japan) 사이버에이전트 어플리봇스튜디오 소속</li>
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2017 - 2018</span>
							(China) 유주게임즈 리드 컨셉 아티스트
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2014 - 2016</span>
							(Japan) 사이버에이전트 어플리봇스튜디오 소속</li>
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2017 - 2018</span>
							(China) 유주게임즈 리드 컨셉 아티스트
						</li>
					</ul>
					<h5>그 밖의 경력</h5>
					<ul>
						<li class="text-ellipsis">
							<span class="text-gray">2012 - 2013</span>
							이스트소프트 - 카발 1,2 원화 및 일러스트
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2014 - 2016</span>
							(Japan) 사이버에이전트 어플리봇스튜디오 소속</li>
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2017 - 2018</span>
							(China) 유주게임즈 리드 컨셉 아티스트
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2017 - 2018</span>
							(China) 유주게임즈 리드 컨셉 아티스트
						</li>
	
						<li class="text-ellipsis">
							<span class="text-gray">2012 - 2013</span>
							이스트소프트 - 카발 1,2 원화 및 일러스트
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2014 - 2016</span>
							(Japan) 사이버에이전트 어플리봇스튜디오 소속</li>
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2017 - 2018</span>
							(China) 유주게임즈 리드 컨셉 아티스트
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2017 - 2018</span>
							(China) 유주게임즈 리드 컨셉 아티스트
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2017 - 2018</span>
							(China) 유주게임즈 리드 컨셉 아티스트
						</li>
						<li class="text-ellipsis">
							<span class="text-gray">2017 - 2018</span>
							(China) 유주게임즈 리드 컨셉 아티스트
						</li>
					</ul>
					<div class="keyword-cloud">
						<span class="label">게임원화</span>
						<span class="label">프로작가</span>
						<span class="label">이스트소프트</span>
						<span class="label">드로잉</span>
						<span class="label">해외진출</span>
						<span class="label">포트폴리오</span>
						<span class="label">입시전문</span>
						<span class="label">취업</span>
					</div>
				</div>
			
				<div class="tab-content" data-tabname-content="tab-attention" style="display:none;">
					<h4>수업 결제 전 주의사항</h4>
					<ul>
						<li>안드로이드 OS 4.4 이상부터 신규 설치 및 업데이트가 가능하며, 카카오톡 버전 5.4.0부터 이용이 가능합니다.</li>
						<li>카카오톡 암호를 분실한 경우, 사용 중이던 카카오톡을 삭제한 후 다시 설치 하시면 정상적으로 이용하실 수 있습니다. 단, 기존 데이터는 삭제 됩니다.</li>
						<li>위치정보이용동의 메뉴는 카카오톡의 위치기반 서비스를 시작하실 때 보여집니다. 채팅방 키보드 메뉴 중 '지도' 기능을 사용하거나, 검색결과 중 현재위치 중심의 결과를 보고자 하실 때 (예.우리동네 날씨) 위치정보이용동의를 하실 수 있습니다.</li>
					</ul>
					<h4>환불 안내</h4>
					<ul>
						<li>드로잇에서는 선생님들의 정당한 수업 스케쥴과 수업료 프로세스를 위해 특별한 경우 외에는 환불을 해드리지 않습니다.</li>
						<li>환불을 받으려면 수업 시간 최소 3일 이전에 환불 신청을 해야합니다.</li>
						<li>기본적으로 환불은 포인트로 되돌려 드립니다.</li>
					</ul>
				</div>

			</div>
			
			<div class="column col-4 col-md-12">
				<div class="panel">
					<div class="panel-header text-center">
						<figure class="avatar avatar-xl"><img src="./data/avatar03.jpg" alt="Avatar"></figure>
						<div class="panel-title">
							<strong>레니안</strong>
							<em>Renian</em>
						</div>
					</div>
					<div class="panel-body">
						<dl>
							<dt>주제</dt>
							<dd><strong>취업 포트폴리오</strong></dd>
							<dt>수강료</dt>
							<dd><strike>248,000원</strike></dd>
							<dt>할인가</dt>
							<dd>
								<div class="panel-price">
									<strong>157,000</strong>
									<em>원</em>
								</div>
							</dd>
						</dl>
						<div class="panel-desc">취업을 위한 실무진에게 어필하기 좋은 포트폴리오 전략 및 드로잉 노하우 집중 공략. 실제 국내외 기업에서 실무진 책임으로써 미팅한 경험을 바탕으로 현재 준비중인 포트폴리오의 문제점과 보완할 점을 콕콕 찝어드려요!</div>
					</div>
					<div class="panel-footer">
						<button class="btn btn-primary btn-lg btn-block">바로 수강신청</button>
						<div class="btn-group btn-group-block">
							<button class="btn">
								<i class="typcn typcn-flag"></i>
								<span>찜</span>
								<em>38</em>
							</button>
							<button class="btn">
								<i class="typcn typcn-shopping-cart"></i>
								<span>장바구니</span>
							</button>
						</div> 
					</div>
				</div>
			</div>

		</div>
		
		<?php include_once G5_PATH."/drawit/teacher_portfolio.php";?>
	
	</div>
	
</div>

<?php // footer load
	include_once (G5_PATH."/tail.php");
?>
    
</body>
</html>