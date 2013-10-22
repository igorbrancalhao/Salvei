<?php
/***************************************************************************
 *File Name				:feedback_edit.php
 *File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
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
error_reporting(0);
require 'include/connect.php';
require 'include/top.php';
function select_tag_string($name, $array,$key)
{
$tag="<select name=\"$name\">";
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

?>
<?php
$status=0;
if(isset($_REQUEST['alter']))
{
   if($status==0)
  {
  //echo "y hao";
  
   $feedback_id=$_REQUEST['feedback_id'];
   $feedback=$_REQUEST['feedback'];
   $feedback_type=$_REQUEST['type'];
   $query ="update feedback set ";
   $query .=" feedback='$feedback' , feedback_type ='$feedback_type'  where f_id= $feedback_id";
   //echo $query;
   
            if( mysql_query($query))
      {
	    	$mes="Updated Successfully";
		//  echo  "<font color=#ff0000 ><strong> Updated successfully ! </strong></font>";
  	 	  echo "<meta http-equiv='refresh' content='2;url=feedback.php'>";
	      	  }
      else
      {
	   
      }
  }
  else
  {
   echo "<h4><center>Please fill in the fields marked in red</center></h4>";
  }
  
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php
$fid=$_REQUEST['fid'];
$query="select * from feedback where f_id=\"$fid\"";
$table=mysql_query($query);
$row=mysql_fetch_array($table);
if($row[seller_id])
{
$fromid=$row[seller_id];
}
else
{
$fromid=$row[buyer_id];
}

$from="select * from user_registration where user_id=$fromid";
$from_res=mysql_query($from);
$from_row=mysql_fetch_array($from_res);
$fromid=$from_row[user_name];

$to="select * from user_registration where user_id=$row[feedback_to]";
$to_res=mysql_query($to);
$to_row=mysql_fetch_array($to_res);
$toid=$to_row[user_name];


?>
<table  bgcolor="#cecfc8" align="center" cellpadding="0" cellspacing="0" width="100%">
<tr height="24"><td class="txt_users">
<center>Edit Feedbacks</center></td></tr>
<tr><td>
<form action="<?php= $_SERVER['PHP_SELF'] ?>" method="post" name="formfeed" onSubmit="return Validate();">
<table class="border2" width="98%" align="center">
<tr  bgcolor="#CCCCCC"><td colspan="2" align="center"><b>Edit Feedback</b></td></tr>
<tr  bgcolor="#CCCCCC"><td colspan="2" align="center"><font color="#FF0000">
<?php
if($mes!='')
echo $mes;
?></font>
</td></tr>
 <tr bgcolor="#eeeee1"><td><font color="<?php if($e_item_id=="true") echo"#ff0000"; ?>"> Item Id</td>
  <td> <?php echo $row['item_id']; ?> </td></tr>
  
<tr bgcolor="#eeeee1"><td><font color="<?php if($e_user_id=="true") echo"#ff0000"; ?>"> To User </td>
<td><?php echo $toid ?> </td></tr>

<tr bgcolor="#eeeee1"><td><font color="<?php if($e_user_id=="true") echo"#ff0000"; ?>"> From User </td>
<td><?php echo $fromid  ?> </td></tr>
  
<tr bgcolor="#eeeee1"><td><font color="<?php if($e_feedback=="true") echo"#ff0000"; ?>"> Feedback</td> 
<td> <textarea name="feedback" cols=30 rows=15><?php  if(isset($_REQUEST['alter'])) echo $_REQUEST['feedback']; else echo $row['feedback']; ?></textarea></td></tr>
<tr bgcolor="#eeeee1"><td><font color="<?php if($e_type=="true") echo"#ff0000"; ?>">Feedabck Type</td> 
<?php
$array=array("Positive","Negative","Neutral");
 if(isset($_REQUEST['alter'])) 
$name = $_REQUEST['type']; 
else 
$name=$row['feedback_type'];  ?>
 <td><?php= select_tag_string("type", $array ,$name); ?> </td></tr>

  
<input type="hidden" name=feedback_id value="<?php= $row['f_id']; ?>">

<tr bgcolor="#eeeee1"><td align="center" colspan="2"><input type="submit" name="alter" value=" Alter " class="button"> </td></tr>
</table>
</form></td></tr></table>
<?php
require 'include/footer.php';
?>
</body>
</html>
<script language='JavaScript' type='text/javascript'>
function Validate()
 {
if(document.formfeed.feedback.value=="")
{
		alert("Invalid feedback! Please re-enter.");
		document.formfeed.feedback.focus();
		return false;

}

}
</script>