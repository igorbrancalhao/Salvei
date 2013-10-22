<?php
/***************************************************************************
 *File Name				:finalsalesvaluesettings.php
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
require 'include/connect.php'; ?>

<?php
require 'include/top.php';

if(isset($_REQUEST['bid_delete']))
{
$total=$_REQUEST[total_records];

for($i=1;$i<=$total;$i++)
{
 $records_ids="records_id".$i;
 $records_id=$_REQUEST[$records_ids];
 $bid_d="bid_del".$i;
 $bid_del=$_REQUEST[$bid_d];
 
//echo $records_id."<br>".$bid_del."<br>"; 

$sq=mysql_query("select * from finalsalevalue_feemaster where fid=".$records_id);
$sq1=mysql_fetch_array($sq);
$f=$sq1['closingprice_from'];
$t=$sq1['closingprice_to'];
$fee=$sq1['percentage'];
 
if($bid_del=="0")
{
	$del="delete from finalsalevalue_feemaster where fid =".$records_id;
	$delsql=mysql_query($del);
//	if($delsql) echo $records_id." ".$bid_del;
$cat=$cat."Amount From :".$f." ,Amount To :".$t." , FinalSaleValue Fee :".$fee."<br>";
$mes="Final Salevalue Fee Deleted Successfully";
}


if($bid_del!="0")
{
$mes="Please Select Any Item you want to Delete";
//echo $err_flag=3;
}
}



}

elseif(isset($_REQUEST['add']))
{
	$st=$_REQUEST['st'];
	$en=$_REQUEST['en'];
	$pr=$_REQUEST['pr'];
	$f=0;
	//Checking
	if(empty($st) or empty($en) or empty($pr))
	{	
		$f=1;
		$mes="No empty fields are allowed";
	}
	if(!empty($st))
	{
	$s=mysql_query("select max(closingprice_to) as priceto from finalsalevalue_feemaster");
	$sq=mysql_fetch_array($s);
	if($sq['priceto']>=$st)
	{
		$f=1;
		$mes="Price Value Already Exists";
	}
	}
		
	if($f!=1)
	{
	//ends here
	
	$qu=mysql_query("insert into finalsalevalue_feemaster (closingprice_from,closingprice_to,percentage) values ('$st','$en','$pr')");
	
	$cat="Closing Price From :".$st." ,Closing Price To: ".$en." ,Percentage :".$pr;
	
	$mes="Final Salevalue Fee Settings Added Successfully";
	}
	else
	{	
		
		?>
		<!--<meta http-equiv="refresh" content="3;url=finalsalevaluesettings.php" />-->
		<?php
	}
	
}

elseif(isset($_REQUEST['modify']))
{
$radfinalsale=$_REQUEST['radfinalsale'];
$query="update admin_settings set set_value= '$radfinalsale'  where set_id=56 ";
mysql_query($query);

$total=$_REQUEST[total_records];
for($i=1;$i<=$total;$i++)
{
 $records_id="records_id".$i;
 $from=$_REQUEST["txtcloseprice_from".$i];
 $to=$_REQUEST["txtcloseprice_to".$i];
 $percentage=$_REQUEST["txtpercentage".$i];
 $records_id=$_REQUEST[$records_id];
	if(empty($from) or empty($to) or empty($percentage))
	{
		$f=1;
		$mes="No empty fields are allowed";
	}
	if($f!=1)
	{
 $query="update finalsalevalue_feemaster set closingprice_from='$from',closingprice_to='$to',percentage='$percentage' where fid= $records_id";
 $upquery=mysql_query($query);

	$cat=$cat."Closing Price From :".$from." ,Closing Price To: ".$to." ,Percentage :".$percentage."<br>";
}
}
	if($f!=1)
	{
	$mes="Final Salevalue Fee Settings Updated Successfully";
	}
		?>
		<!--<meta http-equiv="refresh" content="3;url=finalsalevaluesettings.php" />-->
		<?php
}
?>

<link href="style.css" rel="stylesheet" type="text/css">
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
<tr><td>
<table width="100%" border="0" cellpadding="5" cellspacing="1" align="center" >
<tr><td width=93>
<table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="images/links1_01.jpg" width="93" height="26" alt=""></td>
                    </tr>
                     <tr>
                      <td><a href=auction.php><img src="images/links1_02.jpg" width="93" height="70" alt="" border="0" title="AuctionMaster"></a></td>
                    </tr>
                    <tr>
             <td><a href=site.php?page=auction><img src="images/links1_03.jpg" width="93" height="71" alt="" border="0" title="AuctionSettings"></a></td>
                    </tr>
                    <tr>
                   <td><a href=category.php><img src="images/links1_04.jpg" width="93" height="73" alt="" border="0" title="CategorySettings"></a></td>
                    </tr>
                    <tr>
                      <td><a href=subcategory.php><img src="images/links1_05.jpg" width="93" height="71" alt="" border="0" title="SubcategorySettings"></a></td>
                    </tr>
                    <tr>
                      <td><a href=custom_category.php><img src="images/links1_06.jpg" width="93" height="70" alt="" border="0" title="CustomCategory"></a></td>
                    </tr>
                    <tr>
                      <td><a href=insertion_fee_settings.php><img src="images/links1_07.jpg" width="93" height="66" alt="" border="0" title="AuctionFeeManagement"></a></td>
                    </tr>
                </table></td>
<td align="left">
<table width="98%"><tr><td width="50%"><center>
<a href=insertion_fee_settings.php class="txt_users">Insertion Fee Settings</a></center></td><td width="50%"><center>
<a href=finalsalevaluesettings.php class="txt_users">Finalvaluesale Fee Settings</a></center></td></tr>
<tr><td colspan="2" align="center">
<font color="#FF0000">
<?php
if($mes!="")
{
echo $mes;
}
?>
</font>
</td></tr>
</table>

<form  action="<?php $_SERVER['PHP_SELF']?>" method="post" name="frm13">
<table border="0" align="center" cellpadding="5" cellspacing="2" width="96%" class="tablebox">

<tr bgcolor="#CCCCCC" class="txt_users">
<td colspan="4"> Final Sale Value Fee Settings</td>
</tr>
<?php
$auction_query="select * from admin_settings where set_id=56";
$table=mysql_query($auction_query);
$row=mysql_fetch_array($table);
$set_finalsale_fee=$row['set_value'];

if($set_finalsale_fee=="Yes")
{
$auction_query="select * from  finalsalevalue_feemaster order by closingprice_from asc";
$auction_row=mysql_query($auction_query);
$total=mysql_num_rows($auction_row);
}
$i=1;
?>
<tr bgcolor="#eeeee1"><td  colspan="3">Allow Final Sale Value Fee</td> 
                      <td > <input type="radio" onClick="checkpermission('No','<?php= $total
 ?>');" name="radfinalsale" value="No" <?php if($set_finalsale_fee=="No") echo"checked"; ?>>No 
          				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <input type="radio" onClick="checkpermission('Yes','<?php= $total
 ?>');" name="radfinalsale" value="Yes" <?php if($set_finalsale_fee=="Yes") echo"checked"; ?>>Yes 
					  </td>
</tr>
<?php
$cur=mysql_query("select * from admin_settings where set_id=59");
$cur_row=mysql_fetch_array($cur);
$cur_sym=$cur_row['set_value'];
?>
<tr bgcolor="#CCCCCC" >
  <td><b>Closing Price From(<?php=$cur_sym; ?>)</b></td>
  <td><b>Closing Price To(<?php=$cur_sym; ?>)</b></td>
  <td><b>Final Sale Fee In (%)</b></td>
  <td><b>Add/ Delete</b></td>
 </tr>
<?php
	if($total>0) {
	 
	$total_records=mysql_num_rows($auction_row);
	$curpage=$_GET['curpage'];
	if(strlen($_GET['curpage']) == 0) $curpage=1;
	
	$start=($curpage-1) * 10;
	
	$end=10;
	
	if($curpage==''|| $curpage==1)
	$i=1;
	else $i=$_GET['sno']+1;
	$auction_query.=" limit $start,$end";
	$auction_row=mysql_query($auction_query);
 ?>
        <tr> 
          <td align="right" colspan="10"> 
            <?php
	if($curpage!=1) {
?>
            <a href="finalsalevaluesettings.php?curpage=<?php=($curpage-1);?>" id="link2">Prev</a> 
            | 
            <?php
}
?>
            <?php
if($total_records > ($start + $end)) {
?>
            <a href="finalsalevaluesettings.php?curpage=<?php=($curpage+1);?>" id="link2">Next</a> 
            <?php
}
?>
          </td>
        </tr> 
 
<?php
while($row=mysql_fetch_array($auction_row))
{
 ?>
	<tr bgcolor="#eeeee1">
     <td width="25%"> <input type="hidden" name="records_id<?php= $i ?>" value="<?php= $row['fid'] ?>" />
	 <input  class="smalltxt" type="text" name="txtcloseprice_from<?php= $i ?>" value="<?php= $row['closingprice_from'] ?>" <?php if($set_finalsale_fee=="No") { ?> disabled <?php }?> onKeyPress="return numbersonly(event);" maxlength="10"></td>
	 <td width="25%"> <input  class="smalltxt" type="text" name="txtcloseprice_to<?php= $i ?>" value="<?php= $row['closingprice_to'] ?>" <?php if($set_finalsale_fee=="No") { ?> disabled <?php }?> onKeyPress="return numbersonly(event);" maxlength="10"></td>
	 <td width="25%"> <input  class="smalltxt" type="text" name="txtpercentage<?php= $i ?>" value="<?php= $row['percentage'] ?>" <?php if($set_finalsale_fee=="No") { ?> disabled <?php }?> onKeyPress="return numbersonly1(event);" maxlength="10"></td>
	 <td width="25%" align="center"> <input type="checkbox" name="bid_del<?php= $i ?>"  value="0"  >
	 </td>
</tr>
<?php 
$i=$i+1;
}
}
?>
<tr bgcolor="#eeeee1">
<input type="hidden" name="v" value="<?php=$i; ?>" />
<input type="hidden" name="total_records" value="<?php= $total?>" />

<td align="center" colspan="3">
<input type="submit" value=" Modify " name="modify" class="button"></td>

<td align="center" colspan="4"><input type="submit" value=" Delete " name="bid_delete" class="button" onclick="return del();">
</td>

</tr>
 <?php
 if($set_finalsale_fee=="Yes")
 {
 
 ?>

<tr bgcolor="#eeeee1">
<td width="25%"><input type="text" name="st" size="10" onKeyPress="return numbersonly(event);" maxlength="10" /></td>
<td width="25%"><input type="text" name="en" size="10" onKeyPress="return numbersonly(event);" maxlength="10" /></td>
<td width="25%"><input type="text" name="pr" size="10" onKeyPress="return numbersonly1(event);" maxlength="10" /></td>
<td align="center">
<input type="submit" name="add" value=" Add " class="button"/>
</td>

</tr>
<!--<tr bgcolor="#eeeee1">
<td colspan="3" align="center">
<input type="submit" name="add" value=" Add " class="button" onclick="return add_val();" />
</td>
</tr>
--><?php

}
?>
</table>
</form>
<br></td></tr></table></td></tr></table>
<script language="javascript1.3">
function checkpermission(val,tot)
{
var coun=document.forms[0].elements.length;
	for(i=0;i<coun;i++)
	{
		if(val=="Yes")
		{
			if(document.forms[0].elements[i].type=="text")
			{
				document.forms[0].elements[i].disabled=false;
			}
			
		}
		if(val=="No")
		{
			
			if(document.forms[0].elements[i].type=="text")
			{
				document.forms[0].elements[i].disabled=true;
			}
		}
	}

}

/*function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8  && unicode!=9){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}*/

function numbersonly1(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8 && unicode!=46 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}

function validate()
{
/*	var coun=document.frm13.v.value;
	var i;
		var f="frm13.txtcloseprice_from";
		var t="frm13.txtcloseprice_to";
		var n="frm13.txtcloseprice_from";
		var fr,tr,nr,k;
	for(i=1;i<=coun;i++)
	{
		fr=f+i+".value";
		tr=t+i+".value";
		k=i+1;
		nr=n+k+".value";
		
	if( (eval(fr)!="" || eval(fr)!=0) && (eval(tr)!="" || eval(tr)!=0) )
	{       	
					
		if(parseInt(eval(fr))>=parseInt(eval(tr)))
		{
				
			alert("Please Enter the Closing Price To value should be greater than the Closing Price From value");
			return false;
		}
	}
	if((eval(nr)!="") || (eval(nr)!=0))
	{
	
		if(parseInt(eval(nr))<=parseInt(eval(tr)))
		{
			alert("Please Enter the Closing Price To should be lesser than the Closing Price From of the next record");
			return false;
		}
	}
	}*/
return true;
}

function add_val()
{
	if(document.frm13.st.value=="")
	{
		alert("Please Enter the Closing Price From");
		document.frm13.st.focus();
		return false;
	}
	if(document.frm13.en.value=="")
	{
		alert("Please Enter the Closing Price To");
		document.frm13.en.focus();
		return false;
	}
	if((document.frm13.st.value!="") && (document.frm13.en.value!=""))
	{
		var s=document.frm13.st.value;
		var e=document.frm13.en.value;
		if(eval(s) >= eval(e))
		{
			alert("Please Enter the Closing Price To should be greater than the Closing Price From");
			document.frm13.st.value="";
			document.frm13.en.value="";
			document.frm13.st.focus();
			return false;
		}
	}
	
	if(document.frm13.pr.value=="")
	{
		alert("Please Enter the Final Sale Fee in %");
		document.frm13.pr.focus();
		return false;
	}
	return true;
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

var item_deliever= confirm("Are you sure you want to delete the selected Fee(s) Settings?");
//alert(item_deliever);
if(item_deliever==true)
{
document.frm13.submit();
return true;
}
else
{
return false;
}
}


</script>
<?php
require 'include/footer.php';
?>