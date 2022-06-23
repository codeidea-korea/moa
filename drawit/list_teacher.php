<?php // Header load
	include_once ("./_common.php");
	include_once (G5_PATH."/head.php");

?>


<!-- 컨텐츠 -->
<div class="contents container grid-lg">
	<div class="columns col-gapless">
		
		<!-- 강사 목록 -->
		<div class="teacher-list">
			<div class="filter-cloud">
            	<div class="filter-cloud-section">
					<label class="is-selected">
						<span>인기순</span>
						<input type="radio" name="filter-val" hidden="" checked="">
					</label>
					<label>
						<span>신규순</span>
						<input type="radio" name="filter-val" hidden="">
					</label>
					<label>
						<span>후기순</span>
						<input type="radio" name="filter-val" hidden="">
					</label>
					<label>
						<span>열린 수업</span>
						<input type="radio" name="filter-val" hidden="">
					</label>
            	</div>
        	</div>
			<ol class="cards columns">
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="D">
								<img src="data/avatar07.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>도스피</strong>
							</div>
							<div class="card-subtitle text-ellipsis">기본 드로잉: 인체, 페이스, 동세 드로잉</div>
							<div class="card-info text-ellipsis">
								<span class="label">프로웹툰작가</span>
								<span class="label">일본데뷔</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="S">
								<img src="data/avatar06.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>쎄삐</strong>
							</div>
							<div class="card-subtitle text-ellipsis">1:1 맞춤 수업의 표본</div>
							<div class="card-info text-ellipsis">
								<span class="label">프로웹툰작가</span>
								<span class="label">일본데뷔</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="O">
								<img src="data/avatar01.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>오리신</strong>
							</div>
							<div class="card-subtitle text-ellipsis">캐릭터 일러스트를 한장씩 완성해보자!</div>
							<div class="card-info text-ellipsis">
								<span class="label">게임삽화</span>
								<span class="label">넥슨</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="P">
								<img src="data/avatar05.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>푸링</strong>
							</div>
							<div class="card-subtitle text-ellipsis">학생 개개인의 목표 설정 및 취향을 바탕으로 체계적인 수업!</div>
							<div class="card-info text-ellipsis">
								<span class="label">네오위즈</span>
								<span class="label">모바일게임디자인</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="P">
								<img src="data/avatar02.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>피카</strong>
							</div>
							<div class="card-subtitle text-ellipsis">인체의 뼈대를 잡아 동세를 바로잡기</div>
							<div class="card-info text-ellipsis">
								<span class="label">프로웹툰작가</span>
								<span class="label">다음</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="R">
								<img src="data/avatar03.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>레니안</strong>
							</div>
							<div class="card-subtitle text-ellipsis">일본에서도 사랑받는 작가님과 함께 내 작화 살리기 특강</div>
							<div class="card-info text-ellipsis">
								<span class="label">입시전문</span>
								<span class="label">스타강사</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="M">
								<img src="data/avatar04.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>말차시럽</strong>
							</div>
							<div class="card-subtitle text-ellipsis">2D에 탄력을 불어넣는 마법을 배워 말랑말랑한 표현하기</div>
							<div class="card-info text-ellipsis">
								<span class="label">만화가</span>
								<span class="label">출판</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="D">
								<img src="data/avatar07.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>도스피</strong>
							</div>
							<div class="card-subtitle text-ellipsis">기본 드로잉: 인체, 페이스, 동세 드로잉</div>
							<div class="card-info text-ellipsis">
								<span class="label">프로웹툰작가</span>
								<span class="label">일본데뷔</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="S">
								<img src="data/avatar06.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>쎄삐</strong>
							</div>
							<div class="card-subtitle text-ellipsis">1:1 맞춤 수업의 표본</div>
							<div class="card-info text-ellipsis">
								<span class="label">프로웹툰작가</span>
								<span class="label">일본데뷔</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="O">
								<img src="data/avatar01.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>오리신</strong>
							</div>
							<div class="card-subtitle text-ellipsis">캐릭터 일러스트를 한장씩 완성해보자!</div>
							<div class="card-info text-ellipsis">
								<span class="label">게임삽화</span>
								<span class="label">넥슨</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="P">
								<img src="data/avatar05.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>푸링</strong>
							</div>
							<div class="card-subtitle text-ellipsis">학생 개개인의 목표 설정 및 취향을 바탕으로 체계적인 수업!</div>
							<div class="card-info text-ellipsis">
								<span class="label">네오위즈</span>
								<span class="label">모바일게임디자인</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="P">
								<img src="data/avatar02.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>피카</strong>
							</div>
							<div class="card-subtitle text-ellipsis">인체의 뼈대를 잡아 동세를 바로잡기</div>
							<div class="card-info text-ellipsis">
								<span class="label">프로웹툰작가</span>
								<span class="label">다음</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="R">
								<img src="data/avatar03.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>레니안</strong>
							</div>
							<div class="card-subtitle text-ellipsis">일본에서도 사랑받는 작가님과 함께 내 작화 살리기 특강</div>
							<div class="card-info text-ellipsis">
								<span class="label">입시전문</span>
								<span class="label">스타강사</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="M">
								<img src="data/avatar04.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>말차시럽</strong>
							</div>
							<div class="card-subtitle text-ellipsis">2D에 탄력을 불어넣는 마법을 배워 말랑말랑한 표현하기</div>
							<div class="card-info text-ellipsis">
								<span class="label">만화가</span>
								<span class="label">출판</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="D">
								<img src="data/avatar07.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>도스피</strong>
							</div>
							<div class="card-subtitle text-ellipsis">기본 드로잉: 인체, 페이스, 동세 드로잉</div>
							<div class="card-info text-ellipsis">
								<span class="label">프로웹툰작가</span>
								<span class="label">일본데뷔</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="S">
								<img src="data/avatar06.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>쎄삐</strong>
							</div>
							<div class="card-subtitle text-ellipsis">1:1 맞춤 수업의 표본</div>
							<div class="card-info text-ellipsis">
								<span class="label">프로웹툰작가</span>
								<span class="label">일본데뷔</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="O">
								<img src="data/avatar01.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>오리신</strong>
							</div>
							<div class="card-subtitle text-ellipsis">캐릭터 일러스트를 한장씩 완성해보자!</div>
							<div class="card-info text-ellipsis">
								<span class="label">게임삽화</span>
								<span class="label">넥슨</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="P">
								<img src="data/avatar05.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>푸링</strong>
							</div>
							<div class="card-subtitle text-ellipsis">학생 개개인의 목표 설정 및 취향을 바탕으로 체계적인 수업!</div>
							<div class="card-info text-ellipsis">
								<span class="label">네오위즈</span>
								<span class="label">모바일게임디자인</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="P">
								<img src="data/avatar02.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>피카</strong>
							</div>
							<div class="card-subtitle text-ellipsis">인체의 뼈대를 잡아 동세를 바로잡기</div>
							<div class="card-info text-ellipsis">
								<span class="label">프로웹툰작가</span>
								<span class="label">다음</span>
							</div>
						</div>
					</div>
				</li>
				<li class="column col-6">
					<div class="card">
						<div class="card-header">
							<figure class="avatar avatar-xl float-left" data-initial="R">
								<img src="data/avatar03.jpg" alt="" />
							</figure>
							<div class="card-title text-ellipsis">
								<a href="class_detail.php" class="float-right">자세히보기</a>
								<strong>레니안</strong>
							</div>
							<div class="card-subtitle text-ellipsis">일본에서도 사랑받는 작가님과 함께 내 작화 살리기 특강</div>
							<div class="card-info text-ellipsis">
								<span class="label">입시전문</span>
								<span class="label">스타강사</span>
							</div>
						</div>
					</div>
				</li>
			</ol>
			<button type="button" class="btn btn-more btn-lg btn-block">더보기</button>

		</div>		
	</div>
</div>

<?php // footer load
	include_once (G5_PATH."/tail.php");
?>
    
</body>
</html>