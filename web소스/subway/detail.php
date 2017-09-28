<?php
$_REQUEST['bo_table'] = "poem";
include_once "_common.php";
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$view = get_view($write, $board, $board_skin_path);

//echo $view['file'][0]['path'].'/'.$view['file'][0]['path'];

$sql = "select * from subway where idx='".$view['wr_2']."'";
$subway_row = sql_fetch($sql);


$sql_search = " ";
if($sca){
        $sql_search .= " and ".get_sql_search($sca, $sfl, $stx, $sop);
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
    $sst  = "wr_1, wr_2";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";


$sql = "select wr_id, wr_subject,wr_1,wr_2 from g5_write_poem where 1 {$sql_search} order by wr_1,wr_2";
$result2 = sql_query($sql);
$poem = array();
while($row=sql_fetch_array($result2)){
  $poem[] = $row;
}


$key = array_search($wr_id, array_column($poem, 'wr_id'));

$next = $poem[$key+1];
$prev = $poem[$key-1];

// 이전글 링크
$prev_href = '';
if (isset($prev['wr_id']) && $prev['wr_id']) {
	$prev_wr_subject = get_text(cut_str($prev['wr_subject'], 255));
	$prev_href = './detail.php?wr_id='.$prev['wr_id']."&amp;wr_1=".$wr_1."&amp;wr_2=".$wr_2."&amp;sca=".$sca;
}

// 다음글 링크
$next_href = '';
if (isset($next['wr_id']) && $next['wr_id']) {
	$next_wr_subject = get_text(cut_str($next['wr_subject'], 255));
	$next_href = './detail.php?wr_id='.$next['wr_id']."&amp;wr_1=".$wr_1."&amp;wr_2=".$wr_2."&amp;sca=".$sca;
}

$good_href = '/bbs/good.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;good=good';


// 한번 읽은글은 브라우저를 닫기전까지는 카운트를 증가시키지 않음
$ss_name = 'ss_view_'.$bo_table.'_'.$wr_id;
if (!get_session($ss_name))
{
	sql_query(" update {$write_table} set wr_hit = wr_hit + 1 where wr_id = '{$wr_id}' ");
	set_session($ss_name, TRUE);
}

set_cookie('history_back', $_SERVER['REQUEST_URI'], 86400 * 31);

include_once G5_PATH."/subway/head.php";
?>
<style>
#comments body{
font-size:30px
}
</style>

	<div class="detail">
		<div class="det">
			<!--<div class="title">서시</div>--->
			<div class="small"><?php echo $subway_row['line']?>호선 <?php echo $subway_row['name']?>역</div>
			<div class="hit">조회 <?php echo $view['wr_hit']?></div>
			<div class="date"><?php echo substr($view['wr_datetime'],0,10)?></a></div>
			<div class="img_wr">
			<?php
			// 파일 출력
			$v_img_count = count($view['file']);
			if($v_img_count) {
				echo "<div id=\"bo_v_img\">\n";

				for ($i=0; $i<=count($view['file']); $i++) {
					if ($view['file'][$i]['view']) {

						$img = get_view_thumbnail2($view['file'][$i]['view']);



						echo $img;

					}
				}

				echo "</div>\n";
			}

			if(!$img) {
				$img = "<img src='http://webox.kr/subway/img/sample_list.png'>";
				echo $img;
			}

			$matches = get_editor_image($img,false);
?>

</div>
			<div class="text">
				<div class="tt"><?=$title?></div>
				<div class="dt"><?php echo $view['wr_content']?></div>
				<a name="fb-comments"></a>
				<div class="commnet_btn">
				<!--<a href="./comment.php?comment_url=<?php echo urlencode("http://webox.kr".$_SERVER['REQUEST_URI'])?>&wr_id=<?=$wr_id?>" target="_blank">댓글보기</a>-->
				</div>

				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

		</div>
		<?php if($prev_href){ ?>
		<div class="ar_pre"><a href="<?php echo $prev_href?>"><img src="img/ar_pre.png" alt="" /></a></div>
		<?php }?>
		<?php if($next_href){ ?>
		<div class="ar_next"><a href="<?php echo $next_href?>"><img src="img/ar_next.png" alt="" /></a></div>
		<?php }?>

		<div class="fott">
			<ul>
			<li><a class="btn_m1" href="javascript:;" onclick="my_zim(<?=$wr_id?> )" > 찜하기 </a></li>
			<li><a id="kakao-link-btn" data-id="<?=$wr_id?>" class="btn_m1" href="javascript:;"> 카톡공유 <?=$view['wr_nogood']?></a></li>
			</ul>
		</div>
	</div>

<script type='text/javascript'>
$(function(){
	$("#bo_v_img a").click(function(event){
  		event.preventDefault();
	
	});
});
  //<![CDATA[
    // // 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('99817c5e0b181a4a739b4086603961f3');
    // // 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    Kakao.Link.createTalkLinkButton({
      container: '#kakao-link-btn',
      label: '[지하철시집]\r\n\r\n<?php echo urldecode($view['wr_subject']);?>\r\n<?php echo $subway_row['line']?>호선 <?php echo $subway_row['name']?>역',
	  image: {
        src: '<?php echo $matches[1][0];?>',
        width: '300',
        height: '200'
      },
      webButton: {
        text: '지하철시집 가기',
        url: 'http://webox.kr<?php echo $_SERVER['REQUEST_URI']?>' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
      }
    });

	$("#kakao-link-btn").click(function(){
		$.ajax({
	        type: "POST",
	        url: g5_bbs_url+"/add_share.php",
	        data: {
	            "wr_id": $(this).data('id')
	        },
	        success: function(cnt) {
		$("#kakao-link-btn").text("카톡공유 "+cnt);
	        }
	    });
		

	});
  //]]>
</script>


<?php
include_once G5_PATH."/subway/tail.php";
?>
