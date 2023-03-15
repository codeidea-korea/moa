<?php
// 게시물 입력시 게시자, 관리자에게 드리는 메일을 수정하고 싶으시다면 이 파일을 수정하십시오.
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>[<?php echo $wr_subject ?>] 모임에 예약 확정 되었습니다.</title>
</head>

<body>

<!-- 안녕하세요, MOA 입니다.
[<?php echo $wr_subject ?>] 모임에 예약 확정 되었습니다.
모임 시간은 <? echo $row['aplydate'] . ' ' . $row['aplytime']; ?> 입니다.
감사합니다. -->


<!-- <img src='<//?php echo $row['as_thumb']?>' />
모임: <//?php echo $wr_subject ?>
일시: <//?php $row['aplydate'] . ' ' . $row['aplytime']; ?>
장소: <//?php $row['moa_addr1']; ?> -->

<!-- <a href ="https://www.moa-friends.com/shop/item.php?it_id=<//? echo $row['it_id']; ?>">모임 링크 바로가기</a> -->


<div style="width: 100%; max-width: 760px; margin: 0px auto; font-family: NanumSquareRound, sans-serif; font-size: 14px; color: rgb(43, 53, 63); line-height: 1.5em;background:#fff;margin-top:20px;margin-bottom:20px">
    <div style="padding: 0; word-break: keep-all; margin-top: 30px; background:#fff">
        <div>
            <div style="box-shadow:0px 4px 6px 0px #5757571f;padding:40px 30px 40px 30px;border-radius: 6px; border:1px solid #f2f2f2; margin-top:30px;background:#fff">
                <table style="width:100%;">
                    <tr>
                        <td style="padding-bottom:30px">
                            <img style="width:300px;" src="<?=$row['as_thumb']?>" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="border-top:1px solid #e5e7eb;margin-top:1px;margin-bottom:1px;"></div>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td style="font-size:14px;color:#666;padding-top:30px"><?php echo $wr_subject ?></td>
                    </tr> -->
                    <tr>
                        <td style="font-size:14px;color:#666;padding-top:30px"><b>모임 :</b> <?php echo $wr_subject ?></td>
                    </tr>
                    <tr>
                        <td style="font-size:14px;color:#666;padding-top:0px"><b>일시 :</b> <?php echo $row['aplydate'] . ' ' . $row['aplytime']; ?></td>
                    </tr>
                    <tr>
                        <td style="font-size:14px;color:#666;padding-top:0px"><b>장소 :</b> <?php echo $row['moa_addr1']; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-top:32px;text-align: center;">
                                <a href ="https://www.moa-friends.com/shop/item.php?it_id=<? echo $row['it_id']; ?>" style="background:#D0DB23;color:black;text-decoration: none;padding:12px 16px;display: block;cursor: pointer;border-radius: 4px;font-size:14px;">모임 링크 바로가기</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
    </div>
</div>

</body>
</html>
