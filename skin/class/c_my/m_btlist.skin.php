<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$partner = array();
$partner = apms_partner($member['mb_id']);

?>

<!-- 전체 리스트 -->
<section class="detail_con">
    <div class="s_con_bg">
        <ul class="a_layout last_list">
            <!-- 인증 후 소속 인증 없어야함 -->
            <?php
            $sql = "SELECT 
				IF((SELECT count(*) cnt FROM deb_certi_mail WHERE mb_id = '{$member['mb_id']}') > 0 OR (SELECT count(*) cnt FROM deb_certi_image WHERE mb_id = '{$member['mb_id']}') > 0, '1', '0') as cnt,
					IF((SELECT cert_yn cnt FROM deb_certi_mail WHERE mb_id = '{$member['mb_id']}') > 1 OR (SELECT cert_yn FROM deb_certi_image WHERE mb_id = '{$member['mb_id']}') > 1, '1', '0') as cert_yn";
            $result = sql_fetch($sql);

            if($member['com_cert_yn'] != '1') { ?>
            <li>
                <a href="<?php echo MOA_LOGIN_URL?>/certification.php">
                    <p>소속(직장/프리랜서) 인증하기</p>
                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                </a>
            </li>
            <?php } else { ?>

                    <?php
              echo $partner['pt_register'];
                        if($partner['pt_no'] != "") { // 등록심사중이면
                            ?>
                            <li>
                                <a href="#">
                                    <p>호스트 심사중</p>
                                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                                </a>
                            </li>
                            <?php
                        }else{
                            ?>
                            <li>
                                <a href="<?php echo $hostlink;?>">
                                    <p>호스트 <?php echo $host ? '관리모드' : '지원하기'?></p>
                                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                                </a>
                            </li>
                            <?php
                        }

                  ?>

            <?php } ?>
            <li style="display:n one;">
                <a href="<?php echo MOA_DETAIL_URL;?>/d_p_history01.php">
                    <p>결제 내역 보기</p>
                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                </a>
            </li>
            <li style="display:n one;">
                <a href="<?php echo MOA_MY_URL;?>/my_participated.php">
                    <!-- <p>참여한 모임</p> -->
                    <p>참여모임</p>
                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                </a>
            </li>
            <li>
                <a href="<?php echo MOA_MY_URL;?>/my_setting03.php">
                    <p>설정</p>
                    <span><img src="../images/r_arrow_o.svg" alt=""></span>
                </a>
            </li>
        </ul>
    </div>
</section>