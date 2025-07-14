<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM news_publications where n_id = ".$_GET['n_id'])->fetch_array();
foreach($qry as $k => $v){
  $$k = $v;
}
$stitle = $title;
include 'news_list.php';
?>