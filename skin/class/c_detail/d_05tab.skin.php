<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 모임 탭 영역 -->
<section class="detail_con">
    <div class="s_con_bg">
        <div class="tabs">
            <input id="dtl" type="radio" name="tab_item" checked="">
            <label class="tab_item" for="dtl">상세 정보</label>
            <input id="review" type="radio" name="tab_item">
            <label class="tab_item" for="review">후기 <span>11</span></label>
            <input id="qa" type="radio" name="tab_item">
            <label class="tab_item" for="qa">Q&amp;A <span>22</span></label>
            <input id="rfnd" type="radio" name="tab_item">
            <label class="tab_item" for="rfnd">환불정책</label>
            <hr>
            <div class="tab_content" id="dtl_content">
                <div class="d_tit">
                    모임 소개
                </div>
                <p>
                    퇴근 후 스트라이크!!
                    업무에 찌든 오늘 하루의 스트레스를 날려줄 무언가 필요하지 않으신가요? 초보여도 괜찮아요! 오늘의 스트레스를 볼링핀에 실어 날려 보내자구요!<br><br>

                    해당 모임은 매주 금요일, 총 4회 이루어지는 커리쿨럼으로 진행합니다. 볼링에 대한 지식, 장비 그 어떤것도 필요하지 않습니다.<br><br>

                    몸만 오시면 ‘볼링왕'호스트가 간단한 이론부터 스트라이크 치는 방법까지 모든것을 알려드려요!<br><br>
                </p>
                <span class="hash"># ⏰ 마감임박 액티비티 ⏰</span>
            </div>
            <div class="tab_content" id="review_content">
                <div class="more col_green">
                    <button onclick="location.href='<?php echo C_DETAIL_PATH;?>/d_review.php'">후기 작성하기</button>
                </div>
                <div class="re_txt">
                    <p>12개의 후기</p>
                    <span class="on"></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <p>5.0</p>
                </div>
                <div class="review">
                    <div class="pro_img"></div>
                    <div class="t_area">
                        <p>김민석<span>22-01-01</span></p>
                        <div class="scope">
                            <span class="on"></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <p class="txt">
                            오늘 다양한 사람들과 수평적 관계에서 편하게 이야기 나눌 수 있어 좋았어요. 또 마치 뮤지컬 배우가 된 것처럼 연기하니 정말 재밌더라구요! 한시간 반이 어떻게 지나간지도 모르겠어요! 수업 커리큘럼도 탄탄하고 많이 배우고 가는거 같아요. 다음에 또 신청할라구요.
                        </p>
                    </div>
                </div>
                <div class="review">
                    <div class="pro_img"></div>
                    <div class="t_area">
                        <p>김민석<span>22-01-01</span></p>
                        <div class="scope">
                            <span class="on"></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <p class="txt">
                            오늘 다양한 사람들과 수평적 관계에서 편하게 이야기 나눌 수 있어 좋았어요. 또 마치 뮤지컬 배우가 된 것처럼 연기하니 정말 재밌더라구요! 한시간 반이 어떻게 지나간지도 모르겠어요! 수업 커리큘럼도 탄탄하고 많이 배우고 가는거 같아요. 다음에 또 신청할라구요.
                        </p>
                    </div>
                </div>
                <div class="more">
                    <button>후기 더보기</button>
                </div>
            </div>
            <div class="tab_content" id="qa_content">
                <div class="more col_green">
                    <button onclick="location.href='<?php echo C_DETAIL_PATH;?>/d_inquiry01.php'">문의 작성하기</button>
                </div>
                <div class="review">
                    <div class="pro_img"></div>
                    <div class="t_area">
                        <p>김민석<span>22-01-01</span><i>답변 미완료</i></p>
                        <p class="txt">
                            안녕하세요! 연락처 남겼는데 아직도 연락이 없어서요!
                        </p>
                    </div>
                </div>
                <div class="review">
                    <div class="pro_img"></div>
                    <div class="t_area">
                        <p>김민석<span>22-01-01</span><i class="on">답변 완료</i></p>
                        <p class="txt">
                            안녕하세요! 연락처 남겼는데 아직도 연락이 없어서요!
                            </p><div class="re">
                                <p>딥아틀리에<span>22-01-01</span></p>
                                <p class="re_text">
                                    안녕하세요! 연락드렸는데 아 직 못받으셨나봐요!
                                    다시 연락드릴게요 ~
                                </p>
                            </div>
                        <p></p>
                    </div>
                </div>
                <div class="review">
                    <div class="pro_img"></div>
                    <div class="t_area">
                        <p>김민석<span>22-01-01</span><i class="on">답변 완료</i></p>
                        <p class="txt">
                            <span class="secret">비밀글입니다</span>
                            </p><div class="re">
                                <p>딥아틀리에<span>22-01-01</span></p>
                                <p class="re_text">
                                    <span class="secret">비밀글입니다</span>
                                </p>
                            </div>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="tab_content" id="rfnd_content">
                <div class="tab_refund">
                    <div class="refund_tit">환불정책</div>
                    <ul>
                        <li>1. 모임결제 후 1시간 이내 취소 시, 100% 환불(포인트/쿠폰 복원).</li>
                        <li>2. 모임 6일 전 취소 시, 60% 환불</li>
                        <li>3. 모임 5일 전 취소 시, 50% 환불</li>
                        <li>4. 모임 4일 전 취소 시, 40% 환불</li>
                        <li>5. 모임 3일 전 취소 시, 30% 환불</li>
                        <li>6. 모임 2일 전 취소 시, 20% 환불</li>
                        <li>7. 모임 1일 전 취소 시, 10% 환불</li>
                    </ul>
                </div>                    
            </div>
        </div>
    </div>
</section>