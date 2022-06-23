<?php 
include_once ("./_common.php");
?>

<!-- 컨텐츠 -->
<div class="contents">
		
	<h2>추천 수업 <small>HOT CLASS</small></h2>
	
	<div class="class-list columns">
		<div class="classes-more">
			<?php include G5_PATH."/main/main_classes.php"; ?>
		</div>
		<?php //<button type="button" class="btn btn-more btn-lg btn-block">수업 더보기</button>
		?>

	</div>
	
	<div class="columns">
		
		<!-- 강사 추천 순위 -->
		<div class="teacher-list has-rank column col-8 col-xl-6 col-md-12">
			<h2>인기 선생님 <small>HOT</small></h2>
			<ol class="cards">
				<?php include_once(G5_PATH."/main/main_teacher_hot.php");
				 ?>
				 <?php /*
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="D">
							<img src="data/avatar00.jpg" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/drawit/class_detail.php" class="float-right">자세히보기</a>
							<strong>도스피</strong>
							<em>DOSPI</em>
						</div>
						<div class="card-subtitle text-ellipsis">기본 드로잉: 인체, 페이스, 동세 드로잉</div>
						<div class="card-info">
							<span class="label">프로웹툰작가</span>
							<span class="label">일본데뷔</span>
							<span>총 수업 82시간</span>
							<span>총 학생 31명</span>
						</div>
					</div>
				</li>
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="S">
							<img src="data/avatar01.jpg" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/drawit/class_detail.php" class="float-right">자세히보기</a>
							<strong>쎄삐</strong>
							<em>SAPPI</em>
						</div>
						<div class="card-subtitle text-ellipsis">1:1 맞춤 수업의 표본</div>
						<div class="card-info">
							<span class="label">미술입시전문</span>
							<span class="label">스타강사</span>
							<span>총 수업 82시간</span>
							<span>총 학생 31명</span>
						</div>
					</div>
				</li>
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="O">
							<img src="data/avatar02.jpg" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/drawit/class_detail.php" class="float-right">자세히보기</a>
							<strong>오리신</strong>
							<em>OLYS</em>
							</div>
						<div class="card-subtitle text-ellipsis">캐릭터 일러스트를 한장씩 완성해보자!</div>
						<div class="card-info">
							<span class="label">게임삽화</span>
							<span class="label">넥슨</span>
							<span>총 수업 82시간</span>
							<span>총 학생 31명</span>
						</div>
					</div>
				</li>
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="P">
							<img src="data/avatar03.jpg" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/drawit/class_detail.php" class="float-right">자세히보기</a>
							<strong>푸링</strong>
							<em>PURIN</em>
						</div>
						<div class="card-subtitle text-ellipsis">학생 개개인의 목표 설정 및 취향을 바탕으로 체계적인 수업!</div>
						<div class="card-info">
							<span class="label">프로웹툰작가</span>
							<span class="label">다음</span>
							<span>총 수업 82시간</span>
							<span>총 학생 31명</span>
						</div>
					</div>
				</li>
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="P">
							<img src="data/avatar04.jpg" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/drawit/class_detail.php" class="float-right">자세히보기</a>
							<strong>피카</strong>
							<em>PIKA</em>
						</div>
						<div class="card-subtitle text-ellipsis">인체의 뼈대를 잡아 동세를 바로잡기</div>
						<div class="card-info">
							<span class="label">프로웹툰작가</span>
							<span class="label">칼과드레스</span>
							<span>총 수업 82시간</span>
							<span>총 학생 31명</span>
						</div>
					</div>
				</li>
				*/ ?>
			</ol>
		</div>

		
		<!-- 신규 강사 랜덤 -->
		<div class="teacher-list column col-4 col-xl-6 col-md-12">
			<h2>신규 선생님 <small>NEW</small></h2>
			<ol class="cards">
				<?php include_once(G5_PATH."/main/main_teacher_new.php");
				 ?>
				 <?php /*
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="D">
							<img src="data/avatar07.jpg" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/drawit/class_detail.php" class="float-right">자세히보기</a>
							<strong>도스피</strong>
						</div>
						<div class="card-subtitle text-ellipsis">기본 드로잉: 인체, 페이스, 동세 드로잉</div>
						<div class="card-info text-ellipsis">
							<span class="label">프로웹툰작가</span>
							<span class="label">일본데뷔</span>
						</div>
					</div>
				</li>
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="S">
							<img src="data/avatar06.jpg" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/drawit/class_detail.php" class="float-right">자세히보기</a>
							<strong>쎄삐</strong>
						</div>
						<div class="card-subtitle text-ellipsis">1:1 맞춤 수업의 표본</div>
						<div class="card-info text-ellipsis">
							<span class="label">프로웹툰작가</span>
							<span class="label">일본데뷔</span>
						</div>
					</div>
				</li>
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="O">
							<img src="data/avatar01.jpg" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/drawit/class_detail.php" class="float-right">자세히보기</a>
							<strong>오리신</strong>
						</div>
						<div class="card-subtitle text-ellipsis">캐릭터 일러스트를 한장씩 완성해보자!</div>
						<div class="card-info text-ellipsis">
							<span class="label">게임삽화</span>
							<span class="label">넥슨</span>
						</div>
					</div>
				</li>
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="P">
							<img src="data/avatar05.jpg" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/drawit/class_detail.php" class="float-right">자세히보기</a>
							<strong>푸링</strong>
						</div>
						<div class="card-subtitle text-ellipsis">학생 개개인의 목표 설정 및 취향을 바탕으로 체계적인 수업!</div>
						<div class="card-info text-ellipsis">
							<span class="label">네오위즈</span>
							<span class="label">모바일게임디자인</span>
						</div>
					</div>
				</li>
				<li class="card">
					<div class="card-header">
						<figure class="avatar avatar-xl float-left" data-initial="M">
							<img src="data/avatar04.jpg" alt="" />
						</figure>
						<div class="card-title text-ellipsis">
							<a href="/drawit/class_detail.php" class="float-right">자세히보기</a>
							<strong>말차시럽</strong>
						</div>
						<div class="card-subtitle text-ellipsis">2D에 탄력을 불어넣는 마법을 배워 말랑말랑한 표현하기</div>
						<div class="card-info text-ellipsis">
							<span class="label">만화가</span>
							<span class="label">출판</span>
						</div>
					</div>
				</li>
				*/?>
			</ol>
		</div>
		<button type="button" class="btn btn-more btn-lg btn-block">선생님 더보기</button>
		
		<!-- 최근 수업 후기 -->
		
		<h2>수업 후기 <small>REVIEW</small></h2>
		<div class="recent-review column col-12">
			<ul class="balloon-list columns">
				<?php include_once(G5_PATH."/main/main_used_talk.php"); ?>
				<!--
				<li class="column col-4 col-md-6">
					<div class="balloon-item">
						<div class="balloon-msg">제가 성격이 내성적이라 일반적으로 학생이 많은 수업에서는 하고싶은 질문을 하거나, 뾰족한 가르침도 주체적으로 받기 어려웠는데 1:1로 온라인으로 편안하게 받을 수 있어서 좋았어요!</div>
						<div class="balloon-author"><strong>얌전한고양이</strong>님</div>
					</div>
					<div class="balloon-teacher">
						<figure class="avatar avatar-sm" data-initial="R">
							<img src="data/avatar05.jpg" alt="" />
						</figure>
						<a href="#"><strong>레니안</strong> 선생님 수업 확인하기</a>
					</div>
				</li>
				<li class="column col-4 col-md-6">
					<div class="balloon-item">
						<div class="balloon-msg">제가 성격이 내성적이라 일반적으로 학생이 많은 수업에서는 하고싶은 질문을 하거나, 뾰족한 가르침도 주체적으로 받기 어려웠는데 1:1로 온라인으로 편안하게 받을 수 있어서 좋았어요!</div>
						<div class="balloon-author"><strong>졸린네코</strong>님</div>
					</div>
					<div class="balloon-teacher">
						<figure class="avatar avatar-sm" data-initial="R">
							<img src="data/avatar06.jpg" alt="" />
						</figure>
						<a href="#"><strong>말차시럽</strong> 선생님 수업 확인하기</a>
					</div>
				</li>
				<li class="column col-4 col-md-6">
					<div class="balloon-item">
						<div class="balloon-msg">제가 성격이 내성적이라 일반적으로 학생이 많은 수업에서는 하고싶은 질문을 하거나, 뾰족한 가르침도 주체적으로 받기 어려웠는데 1:1로 온라인으로 편안하게 받을 수 있어서 좋았어요!</div>
						<div class="balloon-author"><strong>데레데레뎃</strong>님</div>
					</div>
					<div class="balloon-teacher">
						<figure class="avatar avatar-sm" data-initial="R">
							<img src="data/avatar03.jpg" alt="" />
						</figure>
						<a href="#"><strong>푸링</strong> 선생님 수업 확인하기</a>
					</div>
				</li>
				<li class="column col-4 col-md-6">
					<div class="balloon-item">
						<div class="balloon-msg">제가 성격이 내성적이라 일반적으로 학생이 많은 수업에서는 하고싶은 질문을 하거나, 뾰족한 가르침도 주체적으로 받기 어려웠는데 1:1로 온라인으로 편안하게 받을 수 있어서 좋았어요!</div>
						<div class="balloon-author"><strong>드로로</strong>님</div>
					</div>
					<div class="balloon-teacher">
						<figure class="avatar avatar-sm" data-initial="R">
							<img src="data/avatar07.jpg" alt="" />
						</figure>
						<a href="#"><strong>도스피</strong> 선생님 수업 확인하기</a>
					</div>
				</li>
				<li class="column col-4 col-md-6">
					<div class="balloon-item">
						<div class="balloon-msg">제가 성격이 내성적이라 일반적으로 학생이 많은 수업에서는 하고싶은 질문을 하거나, 뾰족한 가르침도 주체적으로 받기 어려웠는데 1:1로 온라인으로 편안하게 받을 수 있어서 좋았어요!</div>
						<div class="balloon-author"><strong>시마다상</strong>님</div>
					</div>
					<div class="balloon-teacher">
						<figure class="avatar avatar-sm" data-initial="R">
							<img src="data/avatar04.jpg" alt="" />
						</figure>
						<a href="#"><strong>피카</strong> 선생님 수업 확인하기</a>
					</div>
				</li>
				<li class="column col-4 col-md-6">
					<div class="balloon-item">
						<div class="balloon-msg">제가 성격이 내성적이라 일반적으로 학생이 많은 수업에서는 하고싶은 질문을 하거나, 뾰족한 가르침도 주체적으로 받기 어려웠는데 1:1로 온라인으로 편안하게 받을 수 있어서 좋았어요!</div>
						<div class="balloon-author"><strong>내적댄서</strong>님</div>
					</div>
					<div class="balloon-teacher">
						<figure class="avatar avatar-sm" data-initial="R">
							<img src="data/avatar02.jpg" alt="" />
						</figure>
						<a href="#"><strong>오리신</strong> 선생님 수업 확인하기</a>
					</div>
				</li>
			-->
			</ul>
		</div>
		
	</div>
</div>
