<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section>
    <!-- 메뉴 슬라이드 -->
    <div class="swiper-container s_nav_sw">
        <div class="swiper2">
            <div class="swiper-wrapper">
                <?php while($row = sql_fetch_array($category)) { ?>
                <div class="swiper-slide">
                <a href="/bbs/board.php?bo_table=class&sca=<?php echo $row['ca_name'] ?>"><?php echo $row['ca_name'] ?></a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- 메인 검색 -->
    <div class="s_content">
        <div class="m_search02">
            <input onclick="location.href='/c_main/main_search.php'"  type="text" placeholder="클래스를 검색하세요">
        </div>
    </div>

     <!-- 해시테그 슬라이드 (상세일때 dp_none)-->
    <div class="swiper-container sw_button">
        <div class="swiper3">
            <div class="swiper-wrapper">
                <?php $tags = getHashTagList();?>
                <?php foreach($tags as $tag) { ?>
                    <div class="swiper-slide">
                        <a href="/bbs/board.php?bo_table=class&sca=&stx=<?= $tag['tag']; ?>" class="on">#<?= $tag['tag'] ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
