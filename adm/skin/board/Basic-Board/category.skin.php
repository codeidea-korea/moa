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

?>

<aside class="list-category<?php echo (G5_IS_MOBILE) ? ' list-category-mobile' : '';?>">
	
	<div class="dropdown visible-xs">
		<a id="categoryLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-block btn-<?php echo $boset['mctab'];?>" style="float:left">
			<?php echo ($sca) ? $sca : '전체';?>(<?php echo number_format($total_count);?>)
		</a>
		<ul class="dropdown-menu" role="menu" aria-labelledby="categoryLabel">
			<li class=" btn gray <?php if(!$sca) echo ' selected ';?>"  style="float:left;margin-left:2px;">
				<a href="./board.php?bo_table=<?php echo $bo_table;?>">전체</a>
			</li>
			<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
				<li class=" btn gray <?php if($categories[$i] === $sca) echo ' selected ';?>"  style="float:left;margin-left:2px;">
					<a href="./board.php?bo_table=<?php echo $bo_table;?>&amp;sca=<?php echo urlencode($categories[$i]);?>"><?php echo $categories[$i];?></a>
				</li>
			<?php } ?>
		</ul>
	</div>
</aside>
