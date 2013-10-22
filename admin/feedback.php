<?php
/***************************************************************************
 *File Name				:feedback.php
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
require 'include/connect.php';?>

<?php
require 'include/top.php';

$val=$_REQUEST['val'];
$del=$_REQUEST['del'];
$del_id=$_REQUEST['chkSub'];
$delete_allx=$_REQUEST['delete_allx'];
$mode=$_REQUEST['mode'];
$type=$_REQUEST['type'];

if(($del==1)&&(count($del_id)!=0))
{
$w=0;
foreach($del_id as $del_id1)
{
$w++;
$del="delete from feedback where f_id=$del_id1";
mysql_query($del);
}
/*$cat=$mode."Feedback";
subadmin_action2("14",$_SESSION['adminid'],$_SESSION['admin_type'],"d",$cat);
*/
$mes = "<font color=#ff0000 ><strong> $w Rows Deleted On successfully ! </strong></font>";
}
if($delete_allx==1)
{
 $del="delete from feedback where feedback_type='$type'";

if($res=mysql_query($del)) 
$mes = "<font color=#ff0000 ><strong> All Rows Deleted On successfully ! </strong></font>";
} 

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
<tr><td>
<table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
<tr><td><br></td></tr>
<?php
 if($mes)
  {
?>
<tr align="center"><td><?php=$mes?></td></tr>
<?php
 }
?>
<tr><td>
<form method="get" action="feedback.php" >
<table align="center" width="96%" class="border2">
<tr bgcolor="#eeeee1"><td colspan="2"><b>Search</b></td></tr>
<tr bgcolor="#eeeee1">
<td><b />User Name:<b><input type=text name="user" ></td>
<td><b>Item Id: <b><input type=text name="item" ></td>
</tr>
<tr bgcolor="#eeeee1"><td align="center" colspan="2" style="text-align:center"><input type="submit" value="Search" class="button"></td></tr>
</table> 
</form>

<table width="90%" bgcolor="#eeeee1" align="center" class="border2" cellpadding="0" cellspacing="0" border="0"><tr>
<tr bgcolor="#eeeee1">
<td align="center"><a href="feedback.php?type=positive" style="text-decoration:none" class="txt_users">Positive</a></td>
<td align="center"><a href="feedback.php?type=negative" style="text-decoration:none" class="txt_users">Negative</a></td>
<td align="center"><a href="feedback.php?type=neutral" style="text-decoration:none"  class="txt_users">Neutral</a></td>
<td align="center"><a href="feedback.php" style="text-decoration:none" class="txt_users">All</a></td>
</tr></table>
<br>
<?php
$type=$_REQUEST['type'];
$item=$_REQUEST['item'];
$user=$_REQUEST['user'];

$query="select * from feedback";
if( ($type!="") || ($item!="") || ($user!="") )
$query.=" where ";
if($type!="")
$query.="feedback_type= \"$type\"";
else if($item!="")
$query .=" item_id=\"$item\"";
else if($user!="")
{

$myquery="select * from user_registration where user_name=\"$user\" ";

$tab=mysql_query($myquery);
$row=mysql_fetch_array($tab);
$id=$row['user_id'];
if($id=="")$id=-1;
$query.="feedback_to= $id";
//echo $query;

} 
//echo $query;
$table=mysql_query($query);
if(mysql_num_rows($table)==0)
{
$msg="No Feedback Found";
}
else
{
?>
<form name="myform" method="get" action="<?php $_SERVER['PHP_SELF'] ?>" name="frm1">

<table width="75%" border="0">
<?php
$total=mysql_num_rows($table);

$curpage=$_GET['curpage'];
	if(strlen($_GET['curpage']) == 0) $curpage=1;
	$start=($curpage-1) * 5;
	$end=5;
	/*$page=mysql_query("select * from admin_settings where set_id=54");
	$perpage=mysql_fetch_array($page);
	
	$start=($curpage-1) * $perpage['set_value'];
	$end=$perpage['set_value'];*/
	
	if($curpage==''|| $curpage==1)
	$i=1;
	else $i=$_GET['sno']+1;
	$query.=" limit $start,$end";
	$table=mysql_query($query);
	
$href ="feedback.php?";
$href .="user=" .$_REQUEST['user'] . "&item=" . $_REQUEST['item'] . "&del=" .$_REQUEST['del'] . "&del_id=". $_REQUEST['del_id'];
$href .="&type=" .$_REQUEST['type'];
//$href .="csz=" . $csz . "&price_start=" . $price_start . "&price_end=" . $price_end;
//$href .="&bed=" . $bed . "&bath=" . $bath . "&set=";

//$href.="&set=";
?>
<tr><td colspan="8" align="center">
<center><b><?php= $total; ?> Row Selected.</b></center>
</td>

          <td align="right" colspan="5" > 
            <?php
	     if($curpage!=1) 
	     {
         ?>
            <a href="<?php=$href; ?>&curpage=<?php=($curpage-1);?>" id="link2">Prev</a> 
            | 
            <?php
            }
           ?>
            <?php
           if($total > ($start + $end)) 
		   {
           ?>
            <a href="<?php=$href; ?>&curpage=<?php=($curpage+1);?>" id="link2">Next</a> 
            <?php
            }
            ?>
          </td>
      
<?php
}
?>

</td>
</tr>
</table>
<table align="center" width="97%" class="border2" border="0">
<tr bgcolor="#CCCCCC">
<td width="5%">	</td>
<!-- <td width="15%" align="center">FeedBack Id</td> -->
<td width="11%" align="center"><b>Date</b></td>
<td width="15%" align="center"><b>Type</b></td>
<td width="13%" align="center"><b>Item Id</b></td>
<td width="13%" align="center"><b>User Id</b></td>
<td width="13%" align="center"><b>Sender Id</b></td>
<td width="33%" align="center"><b>FeedBack</b></td>
<?php
/*$s=mysql_query("select * from subadmin where userid=".$_SESSION['adminid']." and table_name='Feedback'");
$s1=mysql_fetch_array($s);*/
?>
<td width="10%">Edit</td>

</tr><?php 
if(empty($msg))
{

/*$start= $set*$perpage['set_value'] +1;
$end=$set*$perpage['set_value'] + $perpage['set_value'];
$i=0;*/

while($row=mysql_fetch_array($table))
{
$i++;
/*if(($i<$start)||($i>$end))
continue;*/
?>

<tr  bgcolor="#eeeee1">
<td><input name="chkSub[]" id="chkSub" type="checkbox" class="check" value="<?php echo $row['f_id'];  ?>"></td>
<!-- <td><?php= $row['f_id']?></td> -->
<td><?php= $row['date']?></td>
<td><?php= $row['feedback_type']?></td>
<td><?php= $row['item_id']?></td>
<?php
$queryx="select * from user_registration where user_id=$row[feedback_to]";
$tablex=mysql_query($queryx);
$rowx=mysql_fetch_array($tablex);
?>
<td><?php= $rowx['user_name']?></td>
<?php
if($row['buyer_id']!=0)
$sendid=$row['buyer_id'];
elseif($row['seller_id']!=0)
$sendid=$row['seller_id'];

$queryx="select * from user_registration where user_id=$sendid";
$tablex=mysql_query($queryx);
$rowx=mysql_fetch_array($tablex);
?>

<td><?php=$rowx['user_name']; ?></td>
<td><?php= $row['feedback']?></td>

<td><a href="feedback_edit.php?fid=<?php= $row['f_id'] ?>"  style="text-decoration:none" class="txt_details1"> Edit </a></td>

</tr>
<?php
}
}
else
{ ?>
<tr><td colspan="6"><?php=$msg?></td></tr>
<?php }

?>

<tr bgcolor="#eeeee1">
    <td colspan="8" style="text-align:center">
      	<input type="hidden" name="del" value="1">
        <input type="hidden" name="del_id" value="<?php echo $row['f_id']; ?>">
        <input type="hidden" name="user" value="<?php= $_REQUEST['user'] ?>">
        <input type="hidden" name="item" value="<?php= $_REQUEST['item'] ?>">
        <input type="hidden" name="type" value="<?php= $_REQUEST['type'] ?>">				
		<input type="hidden" name="set" value="">
		<input type="hidden" name="delete_allx" value="0">
		<?php
		if(empty($msg))
{
?>
	    <input type="submit" name="delete" value="Delete" class="button" onclick="return condel();">
		
	   <input type="button" name="delete_all" value="Delete All" class="button" onclick="mydelall();">
	   <?php }?>
	   
    </td>
  </tr>
 
</table>
</form>
</td></tr></table>
</td></tr></table>
<?php
//}
?>
<?php
require 'include/footer1.php';
?>
</body>
</html>
<script language="javascript">
function condel()
{

var coun=document.myform.elements.length;
var f=0;
	for(i=0;i<coun-1;i++)
	{
		if(document.myform.elements[i].type=="checkbox")
		{
			if(document.myform.elements[i].checked==true) 
			{
				f=1;
			}
		}
	}
	if(f!=1)
	{
		alert("Please Select Any Feedback you want to delete");
		return false;
	}

  var where_to= confirm("Are you Sure you Want to delete the Feedback?");
  if (where_to== true)
  {
    document.myform.delete1.value=1;
    document.myform.submit();
	return true;
  }
  else
  {
   /* window.location="feedback.php";
    document.myform.submit();*/
	return false;
  } 
}

function mydel()
{
  var where_to= confirm("Are you Sure you Want to delete the Feedback?");
  if (where_to== true)
  {
    document.myform.delete1.value=1;
    document.myform.submit();
  }
  else
  {
    window.location="feedback.php";
    document.myform.submit();
  } 
}

function mydelall()
{
  var where_to= confirm("Are you Sure you Want to delete the All the Feedbacks?");
  if (where_to== true)
  {
    document.myform.delete_allx.value=1;
    document.myform.submit();
  }
  else
  {
    window.location="feedback.php?type=<?php=$type?>";
    document.myform.submit();
  } 
}

</script>