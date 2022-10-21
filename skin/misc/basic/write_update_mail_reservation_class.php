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

안녕하세요, MOA 입니다.
[<?php echo $wr_subject ?>] 모임에 예약 확정 되었습니다.
모임 시간은 <? echo $row['aplydate'] . ' ' . $row['aplytime']; ?> 입니다.
감사합니다.

<a href ="https://www.moa-friends.com/shop/item.php?it_id=<? echo $row['it_id']; ?>">모임 링크 바로가기</a>


</body>
</html>
