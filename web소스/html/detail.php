<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$_REQUEST['bo_table'] = "poem";
include_once "_common.php";
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once G5_PATH."/subway/head.php";

?>

	<div class="detail">
		<div class="det">
			<!--<div class="title">서시</div>--->
			<div class="small">1호선 시청역 상행 2-4</div>
			<div class="hit">조회 12</div>
			<div class="date">2016-11-1</a></div>
			<div class="img_wr"><img src="img/sample_list.jpg"></div>
			<div class="text">
				<div class="tt">별 헤는 밤</div>
				<div class="dt">윤동주 <br><br>
					
				</div>
			</div>

		</div>
		<div class="ar_pre"><a href="detail.html"><img src="img/ar_pre.png" alt="" /></a></div>
		<div class="ar_next"><img src="img/ar_next.png" alt="" /></div>
		<div class="fott">
			<ul>
			<li><a href="#" class="btn_m1">좋아요 10</a></li>
			<li><a href="#" class="btn_m1">댓글달기 5</a></li>
			<li><a href="#" class="btn_m1">공유하기 50</a></li>
			</ul>
		</div>
	</div>

<?php
include_once G5_PATH."/subway/tail.php";
?>
