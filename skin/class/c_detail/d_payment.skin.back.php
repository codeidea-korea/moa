<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- 결제하기 -->

<!-- 결제정보 -->
<section class="detail_con">
    <div class="s_con_bg">
        <div class="dt_con1">
            <h3>
                결제정보
            </h3>
        </div>
        <div class="chat_infor mt25">
            <div class="chat_img img_ct">
                <img src="../images/visual_img/당일수강.png" alt="">
            </div>
            <div class="infor_area">
                <p class="ellipsis1">딥 아틀리에 가나다라 마바사 아자차카 타파하</p>
                <p class="ellipsis2">[성수] 물레 도자기 + 컬러 액션 페인팅
                    3작품 가나다라 마바사 아자차카 타파하하하하 </p>
                <p>15,000원</p>
            </div>
        </div>
    </div>
</section>

<!-- 결제수단 -->
<section class="detail_con">
    <div class="s_con_bg">
        <div class="dt_con1">
            <h3>
                결제수단
            </h3>
        </div>
        <div class="lounchecL pay_radio mt25">
            <input type="radio" id="box_1" name="sequence">
            <label for="box_1">신용카드</label>
            <input type="radio" id="box_2" name="sequence">
            <label for="box_2">카카오페이</label>
            <input type="radio" id="box_3" name="sequence">
            <label for="box_3">네이버페이</label>
            <input type="radio" id="box_4" name="sequence">
            <label for="box_4">가상계좌</label>
        </div>
    </div>
</section>

<!-- 쿠폰/포인트 -->
<section class="detail_con">
    <div class="s_con_bg">
        <div class="dt_con1">
            <h3>
                쿠폰/포인트
            </h3>
        </div>
        <ul class="a_layout mt25">
            <li>
                <a href="">
                    <p>할인 쿠폰<span>1개 보유</span></p>
                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                </a>
            </li>
            <li>
                <a href="">
                    <p>포인트<span>포인트 0원</span></p>
                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                </a>
            </li>
        </ul>
    </div>
</section>

<!-- 결제금액 -->
<section class="detail_con">
    <div class="s_con_bg">
        <div class="dt_con1 layout_f">
            <h3>
                결제 금액
            </h3>
            <div class="pay">
                30,000원
            </div>
        </div>
        <ul class="a_layout mt25">
            <li>
                <a href="">
                    <p>할인 쿠폰<span>1개 보유</span></p>
                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                </a>
            </li>
            <li>
                <a href="">
                    <p>포인트<span>포인트 0원</span></p>
                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                </a>
            </li>
        </ul>
    </div>
</section>

<!-- 최종 결제 금액 -->
<section class="detail_con">
    <div class="s_con_bg">
        <div class="dt_con1 layout_f">
            <h3>
                최종 결제 금액
            </h3>
            <div class="pay02">
                30,000원
            </div>
        </div>
        <ul class="a_layout mt25">
            <li>
                <a href="">
                    <p>모임 환불 정책</p>
                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                </a>
            </li>
            <li>
                <a href="">
                    <p>개인정보 제 3자 제공</p>
                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                </a>
            </li>
        </ul>
        <button class="inactive on mt40" onclick="$('#alert07').addClass('on')">결제완료</button>
    </div>
</section>

<!-- 결제하기 팝업 -->
<div class="alert02" id="alert07">
    <div class="layerBody">
        <div class="confirm">
            <div class="mentBox">
                <span class="mt40">결제가 완료 되었습니다</span>
                <div class="btn_area">
                    <button class="gn w100" onclick="location.href='<?php echo C_DETAIL_PATH;?>/detail_page01.php'">확인</button>
                </div>
            </div>
        </div>
    </div>
</div>