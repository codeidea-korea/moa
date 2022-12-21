  <button class="btn btn-link text-secondary">로그인상태 미리보기</button>
			<div class="btn-group btn-group-block">
				<button type="button" class="btn">로그인</button>
				<button type="button" class="btn">회원가입</button>
			<?php if($member['admin']) {?>
				<a class="btn" h ref="<?php echo G5_ADMIN_URL;?>">관리</a>
			<?php } ?>
			</div>
			<!-- CSS만으로 팝업 위치 찾아가려면 레이어 코드가 여기 있어야 함 -->
			
			<!-- 로그인 레이어 -->
		    <div id="pop-login" class="layer-set layer-sticky">
		        <div class="layer layer-sm">
		            <button type="button" class="btn-layer-close"><i class="icon icon-cross">닫기</i></button>
		            <div class="layer-header">
		                <h4>시작하기</h4>
		            </div>
		            <div class="layer-body">
		                <form>
							<fieldset>
								<div class="form-group">
									<label class="form-label" for="input-login-id">이메일 아이디</label>
									<input class="form-input" type="text" id="input-login-id" placeholder="ex) user@drawit.com" autocomplete="email" />
								</div>
								<div class="form-group">
									<label class="form-label" for="input-login-pass">비밀번호</label>
									<input class="form-input" type="password" id="input-login-pass" placeholder="●●●●●●" />
								</div>
								<div class="form-group">
									<label class="form-switch">
										<input type="checkbox">
										<i class="form-icon"></i> 내 로그인 정보 기억하기
									</label>
								</div>
								<button class="btn btn-block btn-primary btn-lg">로그인 <i class="icon icon-forward"></i></button>
							</fieldset>
		                </form>
		            </div>
		            <div class="layer-tint">
			            <a href="#" class="text-dark">아이디/비밀번호를 찾아주세요</a>
		            </div>
		        </div>
		    </div>
		    
			<!-- 계정찾기 레이어 -->
		    <div id="pop-find-account" class="layer-set layer-sticky">
		        <div class="layer layer-sm">
		            <button type="button" class="btn-layer-close"><i class="icon icon-cross">닫기</i></button>
		            <div class="layer-header">
		                <h4>내 정보 찾기</h4>
		            </div>
		            <div class="layer-body">
			            <p class="box-desc">가입된 이메일 정보를 입력해주시면, 비밀번호를 리셋할 수 있는 URL을 메일로 보내드려요.</p>
		                <form>
							<fieldset>
								<div class="form-group has-error">
									<label class="form-label" for="input-find-id">이메일</label>
									<input class="form-input" type="text" id="input-find-id" placeholder="ex) user@drawit.com" autocomplete="email" />
									<p class="form-input-hint">존재하지 않는 가입 정보입니다.</p>
								</div>
								<button class="btn btn-block btn-primary btn-lg">메일보내기 <i class="icon icon-forward"></i></button>
							</fieldset>
		                </form>
		            </div>
		        </div>
		    </div>
		    
			<!-- 회원가입 레이어 -->
		    <div id="pop-register" class="layer-set layer-sticky">
		        <div class="layer layer-sm">
		            <button type="button" class="btn-layer-close"><i class="icon icon-cross">닫기</i></button>
		            <div class="layer-header">
		                <h4>회원가입하기</h4>
		            </div>
		            <div class="layer-body">
		                <form>
							<fieldset>
								<div class="form-group">
									<label class="form-label" for="input-register-id">이메일 아이디</label>
									<input class="form-input" type="text" id="input-register-id" placeholder="ex) user@drawit.com" autocomplete="email" />
								</div>
								<div class="form-group">
									<label class="form-label" for="input-register-pass">비밀번호</label>
									<input class="form-input" type="password" id="input-register-pass" placeholder="6글자 이상 특수문자를 혼용해주세요." />
								</div>
								<div class="form-group has-success">
									<label class="form-label" for="input-register-name">이름</label>
									<input class="form-input" type="text" id="input-register-name" autocomplete="username" value="크라시코팀" />
									<p class="form-input-hint">사용할 수 있는 이름입니다.</p>
								</div>
								<div class="form-group">
									<label class="form-switch">
										<input type="checkbox">
										<i class="form-icon"></i> <a href="#" class="text-dark">이용약관</a>에 동의합니다.
									</label>
								</div>
								<button class="btn btn-block btn-primary btn-lg">회원가입 완료 <i class="icon icon-forward"></i></button>
							</fieldset>
		                </form>
		            </div>
		            <div class="layer-tint">
			            <a href="#" class="text-dark">이미 가입한 정보를 찾아주세요</a>
		            </div>
		        </div>
		    </div>