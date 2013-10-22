<?php
/***************************************************************************
 *File Name				:duration_setting.php
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
<?php session_start();
error_reporting(0);
?>
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
-->
</style>
<?php
require 'include/connect.php';
require 'include/top.php';
if(isset($_REQUEST['memberlevel_modify']))
{
$total=$_REQUEST[total_records];
for($i=1;$i<=$total;$i++)
{
 $records_id="records_id".$i;
 $score=$_REQUEST["score".$i];
 $records_id=$_REQUEST[$records_id];
 
 $sq=mysql_query("select * from auction_duration where duration_id=$records_id");
 $sq1=mysql_fetch_array($sq);
 $n=$sq1['duration'];
  
 $query="update auction_duration set duration='$score' where duration_id= $records_id";
 $upquery=mysql_query($query);
 
 $cat=$cat.",".$n." as ".$score;
}
 $mes="Duration Settings Updated Successfully";
}
elseif(isset($_REQUEST['memberlevel_delete']))
{
$total=$_REQUEST[total_records];
for($i=1;$i<=$total;$i++)
{
 $records_id="records_id".$i;
 $records_id=$_REQUEST[$records_id];
 $memberlevel_del=$_REQUEST["memberlevel_del".$i];
if($memberlevel_del=="0")
{
 $sq=mysql_query("select * from auction_duration where duration_id=$records_id");
 $sq1=mysql_fetch_array($sq);
 $cat=$cat.$sq1['duration'].",";
 
 $del="delete from auction_duration where duration_id='$records_id'";
 $delsql=mysql_query($del);
 $mes="Selected Duration Settings Deleted Successfully";
 

}
}

}

elseif(isset($_REQUEST['memberlevel_add']))
{
$score=$_REQUEST['score'];
$in="insert into auction_duration(duration)values($score)";
$insql=mysql_query($in);

 $mes="Duration Setting Inserted Successfully";
}

	
	
	
?>

<table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
<tr><td>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="760" bgcolor="#E8E8E8" height="100%">
<tr>
<td colspan="4" class="txt_users"><center>Auction Duration Settings</center></td>
</tr>
<tr><td align="center">
<font color="#FF0000">
<?php
if($mes!='')
echo $mes;
?>
</font>
</td></tr>
<tr><td>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="98%" class="border2">
<form  action="<?php $_SERVER['PHP_SELF']?>" method="post" name="frm11">

<tr bgcolor="#eeeee1">
<td colspan="4"><b> Edit, delete or add auction durations using the form below</b>
</td>
</tr>
<?php
$auction_query="select * from auction_duration order by duration asc";
$table=mysql_query($auction_query);
$total=mysql_num_rows($table);
$i=1;
?>
<tr bgcolor="#eeeee1">
  <td colspan="2"><strong>Duration(Days) </strong></td>
  <td align="center"><b>Delete</b></td>
</tr>
<?php
while($row=mysql_fetch_array($table))
{
?>
<input type="hidden" name="records_id<?php= $i ?>" value="<?php= $row['duration_id'] ?>" />
	 <tr bgcolor="#eeeee1">
	 
     <td width="25%" colspan="2">
	 
	 <input class="smalltxt" type="text" maxlength="5" onKeyPress="return numbersonly(event);" name="score<?php= $i ?>" value="<?php= $row['duration'] ?>" >  &nbsp;(Days) </td>
	 
     <td width="25%" align="center"> 
	 <input type="checkbox" name="memberlevel_del<?php= $i++ ?>" value="0">
	 </td>
     </tr>
<?php
 }
?>
<tr bgcolor="#eeeee1" >

<td align="center" colspan="2">
<input type="hidden" name="v" value="<?php=$i; ?>" />
<input type="hidden" name="total_records" value="<?php= $total?>" />
<input type="submit" value=" Modify " name="memberlevel_modify" class="button" onclick="return modify_val();"></td>
<td align="center"><input type="submit" value=" Delete " name="memberlevel_delete" class="button" onclick="return del();"></td>
</tr>
     <tr  bgcolor="#eeeee1" >
     <td width="25%" colspan="2"><input  class="smalltxt" onKeyPress="return numbersonly(event);" type="text" name="score" maxlength="5" >&nbsp;(Days)</td>
	
	 <td width="25%" align="center">
	 <input type="submit" value=" Add " name="memberlevel_add" class="button" onclick="return validate();"></td>
	 </tr>
	 </form> 
</table>
</td></tr></table>

<script language="javascript">
function checkpermission(val,tot)
{
//alert('hai');
//alert(tot);
//alert(document.forms[0].elements.length);
var coun=document.forms[0].elements.length;
	for(i=0;i<coun;i++)
	{
		if(val=="yes")
		{
			if(document.forms[0].elements[i].type=="text")
			{
				document.forms[0].elements[i].disabled=true;
			}
		}
		if(val=="no")
		{
			if(document.forms[0].elements[i].type=="text")
			{
				document.forms[0].elements[i].disabled=false;
			}
		}
	}

}

function del()
{

var coun=document.forms[0].elements.length;
var f=0;
	for(i=0;i<coun;i++)
	{
		if(document.forms[0].elements[i].type=="checkbox")
		{
			if(document.forms[0].elements[i].checked==true) 
			{
				f=1;
			}
		}
	}
	if(f!=1)
	{
		alert("Please Select Any Item you want to delete");
		return false;
	}
/*var p=0;
var s=frm12.v.value;
var v="frm12.bid_del";
for(i=1;i<=s;i++)
{
	var q=v+i+".checked";
	if(eval(q)!=false)
	{	
		p=1;
	}
}
alert("in"+p);
if(p==1)
{
	alert("Please Select Anyone for Delete");
	return false;
}*/

var item_deliever= confirm("Are you sure you want to delete the selected item(s)?");
//alert(item_deliever);
if(item_deliever==true)
{
document.frm11.submit();
return true;
}
else
{
return false;
}
}

function validate()
{
	if(frm11.score.value=="")
	{
		alert("Please Enter the Duration Days");
		frm11.score.focus();
		return false;
	}
	var coun=document.frm11.v.value;
	var f="frm11.score";
	var fr;
	for(i=1;i<=coun;i++)
	{
		fr=f+i+".value";
		if( parseInt(eval(fr))==parseInt(eval(frm11.score.value)) )
		{
			alert("Duration Already Exist");
			frm11.score.value="";
			frm11.score.focus();
			return false;
		}
	}
	
	return true;
}
function modify_val()
{
	var coun=document.frm11.v.value;
	var i;
		var f="frm11.score";
		var n="frm11.score";
		var fr,tr,nr,k;
	for(i=1;i<=coun;i++)
	{
		fr=f+i+".value";
		k=i+1;
		nr=n+k+".value";
		
	if((eval(nr)!="") || (eval(nr)!=0) && (eval(fr)!="") || (eval(fr)!=0))
	{
		if(parseInt(eval(nr))==parseInt(eval(fr)))
		{
			alert("Duration Already Exist");
			return false;
		}
		if(parseInt(eval(nr))<=parseInt(eval(fr)))
		{
			alert("Please Enter the Duration in Ascending Order");
			return false;
		}
	}
	}
return true;
}

function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8  && unicode!=9){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}
</script>
<?php
require 'include/footer1.php';
?>