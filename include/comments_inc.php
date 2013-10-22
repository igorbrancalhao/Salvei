<?php
/***************************************************************************
 *File Name				:comments_inc.php
  *File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 ***************************************************************************/
 

/****************************************************************************
 
*      Licence Agreement: 
 
*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.
 
*****************************************************************************/
 ?>
<?php
session_start();
require 'include/connect.php';
$user_id=$_SESSION['userid'];
$item_id=$_REQUEST['item_id'];
$id=$_REQUEST['seller_id'];
$type=$_REQUEST['cboradtype'];
if($id)
{
$who="seller";
}
else
{
$who="buyer";
$id=$_REQUEST['buyer_id'];
}
if(!isset($_SESSION['userid']))
{ 
$link="signin.php";
$url="comments.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}
$sql="select * from placing_item_bid where item_id=$item_id";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);

$user="select * from user_registration where user_id=$id";
$user_res=mysql_query($user);
$user_row=mysql_fetch_array($user_res);
$toid=$user_row['user_name'];

function select_tag_string($name,$array,$key)
{
$tag="<select name=cboradtype>";
foreach($array as $field)
{
if($key==$field)
$tag=$tag . "<option value=\"$field\" selected>$field</option>";
else
$tag=$tag . "<option value=\"$field\">$field</option>";
}
$tag=$tag . "</select>";
return $tag;
}

$feedbackto=$_POST['radfeedback'];
if($_POST['mode'])
{
$feedback=$_POST['txtcomment'];
$date=date("Y:m:d");

if($feedbackto=="seller")
{
$item_sql="select * from placing_item_bid where item_id=$item_id";
$item_res=mysql_query($item_sql);
$item_row=mysql_fetch_array($item_res);
$feedback_to=$item_row['user_id'];
$buyer_id="$user_id";
$seller_id="";
$in_sql="insert into feedback(item_id,seller_id,date,buyer_id,feedback_to,feedback,feedback_type) values('$item_id','$seller_id','$date','$buyer_id','$feedback_to','$feedback','$type')";
$in_res=mysql_query($in_sql);
}
else
{
$buyer_id="";
$seller_id=$user_id;
$item_sql="select * from placing_bid_item where item_id=$item_id and user_pos='Yes'";
$item_res=mysql_query($item_sql);
$item_row=mysql_fetch_array($item_res);
$feedback_to=$item_row['user_id'];
$in_sql="insert into feedback(item_id,seller_id,date,buyer_id,feedback_to,feedback,feedback_type) values('$item_id','$seller_id','$date','$buyer_id','$feedback_to','$feedback','$type')";
$in_res=mysql_query($in_sql);
}
}
?>