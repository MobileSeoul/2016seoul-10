<? 
$title = $write['wr_subject']?$write['wr_subject']:'지하철 시집';

$my_zim = $_COOKIE['my_zim'];
$my_zim = json_decode("[".stripslashes($my_zim)."]",true);

//print_r();
$list_href =  get_cookie('list_href');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta property="og:type"               content="article" />
<meta property="og:title"              content="<?=$title?>" />
<meta property="og:image"              content="<?=$view['file'][0]['path'].'/'.$view['file'][0]['file']?>" />
<!-- TemplateBeginEditable name="doctitle" -->
<title><?=$title?></title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<script src="/js/jquery-1.8.3.min.js"></script>
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
<?php if(defined('G5_IS_ADMIN')) { ?>
var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";
<?php } ?>
</script>
<link type="text/css" rel="stylesheet" href="<?php G5_URL?>/subway/css/layout.css" />
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="http://webox.kr/js/common.js"></script>

<meta charset="utf-8">
	<meta http-equiv="Content-Script-Type" content="text/javascript">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,user-scalable=yes">
	<!--
	 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
	-->
</head>

<body>
<div id="wrap">
	<div class="header1">
<?
if($wr_id){
?>
		<div class="text"><a href="/"><?=conv_subject($title,12,'...')?></a></div>
		<div class="menu_ar"><a href="<?=$list_href?>"><img src="/subway/img/menu_ar.png" alt=""></a></div>
		<div class="menu_zim"><a href="javascript:;" onclick="my_zim(<?=$wr_id?> )"> <img src="/subway/img/icon_zim<?php echo ($my_zim[0][$wr_id])?'_a':'';?>.png"></a></div>
<script>
var zim_toggle = <?=($my_zim[0][$wr_id])?1:0?>;
function my_zim(wr_id){
	is_del = zim_toggle;
	var zim = get_cookie('my_zim');
if(!zim) zim = "{}";

	var data = JSON.parse(zim);
	if(is_del){
		delete data[wr_id];
		zim_toggle = 0;
		
	}else{
		data[wr_id] = true;
		zim_toggle = 1;
	}
	if(zim_toggle){
		//alert('찜하기 하였습니다.');
		$('.menu_zim img').attr('src','/subway/img/icon_zim_a.png');
	}else{
		//alert('찜하기 취소 하였습니다.');
		$('.menu_zim img').attr('src','/subway/img/icon_zim.png');
	}
	set_cookie('my_zim', JSON.stringify(data), 24*365);

}
</script>
<?  }else{ ?>
		<div class="text"><a href="/"><?=$title?></a></div>
		<div class="menu_btn"><a href="/subway/info.html"><img src="/subway/img/menu_btn.png" alt="" /></a></div>
<?}?>
	</div>
