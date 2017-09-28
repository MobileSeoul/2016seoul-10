<?php
$_REQUEST['bo_table'] = "poem";
include_once "_common.php";

$view = get_view($write, $board, $board_skin_path);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Multi-page template</title>
	<link rel="stylesheet" href="../css/themes/default/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" href="../_assets/css/jqm-demos.css">
	<link rel="shortcut icon" href="../favicon.ico">

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<style>


.ui-page .ui-header {
	font-family: "맑은 고딕";
    background: #318de7 !important;
    color:#fff;
    text-decoration:none
	
}
@font-face {
  font-family: 'nabol';
  font-style: normal;
  font-weight: 700;
  src: url(../fonts/NanumGothic/NanumGothic-Bold.eot);
  src: url(../fonts/NanumGothic/NanumGothic-Bold.eot?#iefix) format('embedded-opentype'),
       url(../fonts/NanumGothic/NanumGothic-Bold.woff2) format('woff2'),
       url(../fonts/NanumGothic/NanumGothic-Bold.woff) format('woff'),
       url(../fonts/NanumGothic/NanumGothic-Bold.ttf) format('truetype');
}

.header2{top:0;background-color:#318de7;position:fixed;z-index:999; width:100%;}
.header2 .text2 {text-align:center; font:'nabol' 43px ;color:#ffffff;line-height:50px;text-decoration:none;}
.header2 .menu_ar{position:absolute;left:10px;top:20px; }
}
</style>
</head>

<body>

<div data-role="page">
	
	<div class="header2">
		<div class="menu_ar"><a href="javascript:;" onclick="window.close()"><img src="/subway/img/menu_ar.png" alt="" width="10px"></a></div>
		<div class="text2">댓글 - <?php echo $view['wr_subject']?></div>
	</div>
	
	<!--<div class="header2">
		<div class="menu_ar"><a href="javascript:;" onclick="window.close()"><img src="/subway/img/menu_ar.png" alt="" width="10px"></a></div>
		<div class="text2">댓글 - <?php echo $view['wr_subject']?></div>
	</div>---><!-- /header -->

	<div role="main" class="ui-content">
	<br><br>
	<fb:comments  data-href="<?=$comment_url?>" mobile=false data-mobile=false data-width='100%' numposts="15" css="http://webox.kr/css/comments.css"></fb:comments>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>

