<?php

session_start();
$page = trim($_GET['page']);
$str = $_SESSION["categories"];
$str = array_splice($str, $page, 10);
$st = "";
foreach ($str as $key => $item) {
    foreach ($item as $key1 => $item1) {
        $st .= $key1 . "#" . $item1 . "#";
    }
}
echo $st;
?>