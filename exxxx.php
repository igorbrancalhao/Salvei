<?php require 'include/connect.php';
$sql="ALTER TABLE `ask_question` CHANGE `answer` `answer` LONGTEXT NOT NULL";
$sqlqry=mysql_query($sql); 
if($sqlqry)
echo "Altered";
?>