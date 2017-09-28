<?php
$_REQUEST['bo_table'] = "poem";
include_once "_common.php";
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once G5_PATH."/subway/head.php";

$sca = ($sca)? $sca : '사랑';
$categorys = explode("|",$board['bo_category_list']);


$sql_common = " from g5_write_".$bo_table." a ";
$sql_search = " where (1) ";


if($sca){
        $sql_search .= " and ".get_sql_search($sca, $sfl, $stx, $sop);
}

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}
if($wr_1){
    $sql_search .= " and ";
    $sql_search .= " (wr_1 = '".$wr_1."') ";
}

if($wr_2){
    $sql_search .= " and ";
    $sql_search .= " (wr_2 = '".$wr_2."') ";
}

if (!$sst) {
    $sst  = "wr_1, wr_2, a.wr_id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$sql = " select * {$sql_common} {$sql_search} {$sql_order} ";
$result = sql_query($sql);


$sql = "select * from subway where line='".$wr_1."' order by sort";
$subway_result = sql_query($sql);

set_cookie('history_back', $_SERVER['REQUEST_URI'], 86400 * 31);
set_cookie('list_href', $_SERVER['REQUEST_URI'], 86400 * 31);

?>
	<div class="list_wr">
		<div class="list">
                        <form id="list_frm">
                        <div class="fl_li">
                        <div class="s2">
						<select id="sca" name="sca">
                                <?php foreach($categorys as $category){ ?>
                                <option value="<?php echo $category?>" <?php echo ($sca== $category)?'selected':'';?>><?php echo $category?></option>
                                <?php }?>
                        </select>
						</div>
                        </div>
                        </form>
		</div>

		<ul>
		<?php
			while($row=sql_fetch_array($result)){

		$row = get_list($row,$board,'',20);
				$thumb = get_list_thumbnail($board['bo_table'], $row['wr_id'], $board['bo_mobile_gallery_width'], $board['bo_mobile_gallery_height']);
				if(!$thumb['src']) {
					$thumb['src'] = "img/sample_list.png";
				}
			 ?>
			<li>
<?  //echo $row['wr_1']."-".$row['wr_2']; ?>
				<div class="det">
					<div class="img_wr"><a href="detail.php?wr_id=<?php echo $row['wr_id']?>&sca=<?php echo $sca?>&wr_1=<?php echo $wr_1?>&wr_2=<?php echo $wr_2?>"><img src="<?php echo $thumb['src']?>"></a></div>
					<!--<div class="small"><a href="" >1호선 시청역 상행 2-3 </a></div>-->
					<!--<div class="view">조회 12</a></div>-->
					<div class="title"><a href="detail.php?wr_id=<?php echo $row['wr_id']?>&sca=<?php echo $sca?>&wr_1=<?php echo $wr_1?>&wr_2=<?php echo $wr_2?>"><?php echo $row['subject']?></a></div>
					<!--<div class="hit">조회 12</div>-->
				</div>
			</li>
		<?php }?>

		</ul>
	</div>
	<div id="footer"></div>

<script>

$(function(){
	$("#sca").change(function(){
			$("#list_frm").submit();

	});

});
</script>
<?php
include_once G5_PATH."/subway/tail.php";
?>
