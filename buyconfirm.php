<?php session_start();
require 'include/connect.php';
require 'include/top.php';
//$mode=$_GET['mode'];
$item_id=$_GET['item_id'];
require 'templates/buyconfirm.tpl';
require 'include/footer.php';

?>