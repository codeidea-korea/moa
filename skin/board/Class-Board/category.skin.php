<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$ca_cnt = count($categories);
$boset['ctype'] = (isset($boset['ctype']) && $boset['ctype']) ? $boset['ctype'] : '';
$boset['mctab'] = (isset($boset['mctab']) && $boset['mctab']) ? $boset['mctab'] : 'color';

//탭
$category_tabs = (isset($boset['tab']) && $boset['tab']) ? $boset['tab'] : '';
switch($category_tabs) {
	case '-top'		: $category_tabs .= ' tabs-'.$boset['mctab'].'-top'; break;
	case '-bottom'	: $category_tabs .= ' tabs-'.$boset['mctab'].'-bottom'; break;
	case '-line'	: $category_tabs .= ' tabs-'.$boset['mctab'].'-top tabs-'.$boset['mctab'].'-bottom'; break;
	case '-btn'		: $category_tabs .= ' tabs-'.$boset['mctab'].'-bg'; break;
	case '-box'		: $category_tabs .= ' tabs-'.$boset['mctab'].'-bg'; break;
	default			: $category_tabs .= ($boset['tabline']) ? ' tabs-'.$boset['mctab'].'-top' : ' trans-top'; break;
}

$cate_w = ($boset['ctype'] == "2") ? apms_bunhal($ca_cnt + 1, $boset['bunhal']) : ''; //전체 포함으로 +1 해줌
// include_once (G5_PATH."/includers.php");
// exit;
?>

<form name="fsearch2" method="get" role="form" class="form" style="margin-top:20px;">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<div class="m_search to_layout b_solid">
	<div class="select-wrapper">
		<?php
		
		$ca_list = getCaListOfClass();
		?>
		<select name="sca">
				<option value="" >전체</option>
			<?php foreach($ca_list as $key => $value) {
				?>
				<option value="<?php echo $value;?>" <?php if ($sca == $value) { echo "selected";}?>>
					<?php echo $value?>
				</option>
				<?php
			}
			?>
			
		</select>
	</div>
				
	<div class="m_search to_layout p0">
		<input type="text" type="text" name="stx"  placeholder="검색어를 입력하세요." value="<?php echo $stx;?>">
		<button type="submit" class="c_search">검색</button>
	</div>
</div>
	<!-- 최근 검색어 -->
	<!-- 가림 -->
	<!--<div class="s_content mt30 mb30 bg_gray">
		<div class="search_area">
			<div class="com_tit sa_tit">
				<p>최근검색어</p>
				<button>모두 지우기</button> 
			</div>
			<ul class="sa_list">
				<li>
					<button>원데이</button>
				</li>
				<li>
					<button>클래스</button>
				</li>
				<li>
					<button>필라테스</button>
				</li>
				<li>
					<button>원데이</button>
				</li>
				<li>
					<button>클래스</button>
				</li>
				<li>
					<button>필라테스</button>
				</li>
				<li>
					<button>원데이</button>
				</li>
				<li>
					<button>클래스</button>
				</li>
			</ul>
		</div>
	</div>-->
</form>
<section class="swiper-container s_nav_sw mb14">
    <div class="swiper2">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
				<a href="./board.php?bo_table=<?php echo $bo_table;?>" class="<?php echo (!$sca) ? 'on' : '';?>"">
					전체<?php if(!$sca) echo '('.number_format($total_count).')';?>
				</a>
            </div>
			<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
				<div  class="swiper-slide">
					<a href="./board.php?bo_table=<?php echo $bo_table;?>&amp;sca=<?php echo urlencode($categories[$i]);?>" class="<?php echo ($categories[$i] === $sca) ? 'on' : '';?>"><?php echo $cate_w;?>
						<?php echo $categories[$i];?><?php if($categories[$i] === $sca) echo '('.number_format($total_count).')';?>
					</a>
				</div>
			<?php } ?>
				<!-- <div  class="swiper-slide">
					<a href="./board.php?bo_table=<?php echo $bo_table;?>&amp;sca=as_tag" class="<?php echo ("as_tag"=== $sca) ? 'on' : '';?>">해시태그
					</a>
				</div> -->
        </div>
    </div>
</section>
