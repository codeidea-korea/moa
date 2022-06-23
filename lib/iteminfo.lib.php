<?php
if (!defined('_GNUBOARD_')) exit;

// 품목별 재화등에 관한 상품요약 정보
$item_info = array(
    
    "digital_contents"=>array(
        "title"=>"디지털콘텐츠(음원,게임,인터넷강의 등)",
        "article"=>array(
            "producer"=>array("제작자 또는 공급자", ""),
            "terms_of_use"=>array("이용조건", ""),
            "use_period"=>array("이용기간", ""),
            "product_offers"=>array("상품 제공 방식", "CD, 다운로드, 실시간 스트리밍 등"),
            "minimum_system"=>array("최소 시스템 사양, 필수 소프트웨어", ""),
            "transfer_of_ownership"=>array("소유권 이전 조건", "소유권이 이전되는 경우에 한함"),
            "maintenance"=>array("청약철회 또는 계약의 해제&middot;해지에 따른 효과", ""),
            "as"=>array("소비자상담 관련 전화번호", ""),
        )
    ),
    "gift_card"=>array(
        "title"=>"상품권/쿠폰",
        "article"=>array(
            "isseur"=>array("발행자", ""),
            "expiration_date"=>array("유효기간", ""),
            "terms_of_use"=>array("이용조건", "유효기간 경과 시 보상 기준, 사용제한품목 및 기간 등"),
            "use_store"=>array("이용 가능 매장", ""),
            "refund_policy"=>array("잔액 환급 조건", ""),
            "as"=>array("소비자상담 관련 전화번호", ""),
        )
    ),
    "etc"=>array(
        "title"=>"기타",
        "article"=>array(
            "product_name"=>array("품명", ""),
            "model_name"=>array("모델명", ""),
            "certified_by_law"=>array("법에 의한 인증&middot허가 등을 받았음을 확인할 수 있는 경우 그에 대한 사항", ""),
            "origin"=>array("제조국 또는 원산지", ""),
            "maker"=>array("제조자", "수입품의 경우 수입자를 함께 표기 (병행수입의 경우 병행수입 여부로 대체 가능)"),
            "as"=>array("A/S 책임자와 전화번호 또는 소비자상담 관련 전화번호", ""),
        )
    ),
);
?>