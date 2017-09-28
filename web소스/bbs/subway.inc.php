<?php
include_once('./_common.php');


$sql = "select * from subway where line='".$line."' order by sort";
$result = sql_query($sql);

$opt = "";
while ($row = sql_fetch_array($result)){
	$opt .=  "<option  value='".$row['idx']."' ".(($selected == $row['idx'])?"selected":"").">".$row['name']."</option>";
}

echo $opt;
