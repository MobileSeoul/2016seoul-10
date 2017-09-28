<?php
include_once('./_common.php');


$sql = "update g5_write_poem set wr_nogood = wr_nogood+1  where wr_id='".$wr_id."'";
$result = sql_query($sql);


$sql = "select wr_nogood from g5_write_poem where wr_id='".$wr_id."'";
$row = sql_fetch($sql);
echo $row['wr_nogood'];
