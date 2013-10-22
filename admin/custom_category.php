<?php
/***************************************************************************
 *File Name				:custom_category.php
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
/***************************************************************************
 *                               
 *                            -------------------
 *   begin                : Saturday, September 19, 2005
 *   copyright            : (C) 2005 AJ Square Inc
 *   email                : support@ajsquare.com
 *
 *  
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   You cannot redistribute this software and/or modify
 *   it.All rights are reserved for AJ Square Inc.
 *
 ***************************************************************************/
	require 'include/connect.php';
    require 'include/top.php';


	$canAdd=$_POST['canAdd'];
	if($canAdd==1)
	{
		$category=$_POST['txtCategory'];
		$category1="../".$category.".php";
		
		if(file_exists($category1))
		{
		$err_mess="You cannot create a category $category";
		
		}
		
		else
		{
		
		$cat_sel_sql="select * from category_master where category_name='$category'";
		$cat_sel_res=mysql_query($cat_sel_sql);
		if(mysql_num_rows($cat_sel_res)>0) $err_mess="Category $category Already Exists";
		else {
			$_SESSION['catname']=$category;
			$_SESSION['region']=$region_id;
		              echo '<meta http-equiv="refresh" content="0;url=definetable.php">';
					  exit();	
		//	  }
		}
		}
	}


if(isset($_REQUEST['btn_Del']))
{
$chk=$_REQUEST['chkSub'];
for($i=0;$i<count($chk);$i++)
{
$select_query="select * from category_master where category_id='$chk[$i]'";
$tab=mysql_query($select_query);

if($row=mysql_fetch_array($tab))
{
$table_name=$row['category_name'];
}

$drop_query="drop table $table_name";
mysql_query($drop_query);

$sq=mysql_query("select * from category_master where category_id='$chk[$i]'");
$sq1=mysql_fetch_array($sq);
$cat=$sq1['category_name'];
	
$query="delete from category_master where category_id='$chk[$i]'";
mysql_query($query);

unlink("../templates/".$table_name.".tpl");

$query="delete from cat_slave where tablename='$table_name'";
mysql_query($query);



}
}
	
?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
<tr><td>
<table>
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
                </table>
				</td><td width=793>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="98%" class=border2>
<tr><td bgcolor="#CCCCCC" class="txt_users">Custom Category Management</td></tr>
<tr bgcolor="#eeeee1">
    <td>Here you can Add, Delete Category .Please Don't Give Space between the Category Name.</td>
</tr>
<form name="frmAdd" method="post" action="<?php $_SERVER['PHP_SELF']?>" onSubmit="return validate();">
<tr align="center" bgcolor="#eeeee1"><td>
<?php
	if($err_mess) echo "<font color=red><b>$err_mess</b></font>";
	// require 'include/footer.php';
	
?>
</td></tr>

<tr bgcolor="#eeeee1">
<td class="txt_bold">Add New Category :&nbsp;&nbsp;<input type="text" name="txtCategory" onKeyPress="namevalchk(this);" onBlur="namevalchk(this);" onKeyDown="namevalchk(this);" onKeyUp="namevalchk(this);">&nbsp;&nbsp;
<input type="hidden" name="canAdd" value="0">
<input type="hidden" name="cboReligion" value="<?php=$region_id?>">
<input type="submit" name="btn_Add" value=" Add " class="button">
</td>
</tr>
</form>
<?php
	$cat_sql="select * from category_master where category_head_id=0 and custom_cat='1'";
	$cat_res=mysql_query($cat_sql);
	if(mysql_num_rows($cat_res)>0) {
?>
<tr bgcolor="#eeeee1"><td>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%">
<form name="frmCat" action="<?php $_SERVER['PHP_SELF']?>" method="post">
<tr bgcolor="#eeeee1">
<?php
	$i=1;
	while($cat_row=mysql_fetch_array($cat_res)) {
	if($i%5==0) echo "<tr>";
?>
<td><input type="checkbox" name="chkSub[]" id="chkSub" value="<?php=$cat_row['category_id']?>"></td><td  class="txt_sitedetails"><a href="viewcust.php?id=<?php=$cat_row['category_id']; ?>" style="text-decoration:none" id="link1" class="txt_sitedetails"><?php=$cat_row['category_name']?></a></td>
<?php
	if($i%4==0) echo "</tr>";
	$i+=1;
	}
?>
</tr>
<tr bgcolor="#eeeee1">
<td colspan="8">
<input type="hidden" name="act" value="0">
<input type="button" name="btn_All" value="Check All" onClick="selectall(1)" class="button">
&nbsp;&nbsp;&nbsp;<input type="button" name="btn_None" value="UnCheck All" onClick="selectall(0)" class="button">  
<!-- &nbsp;&nbsp;&nbsp;<input type="button" name="btn_Del" value="Delete" onClick="editclick(1)"> -->
 &nbsp;&nbsp;&nbsp;<input type="submit" name="btn_Del" value="Delete" class="button" onclick="return del();"> 
<!-- &nbsp;&nbsp;&nbsp;<input type="button" name="btn_Edit" value="Edit" onClick="editclick(2)"> -->
</td>
</tr>
</form>
</table>
</td></tr>
<?php
	}
	else {
?>
<tr><td>No Categories Found</td></tr>
<?php
	}
?>
</table></td></tr></table></td></tr></table>
<?php
 require 'include/footer.php'; 
?>

</body>
</html>
<script language="javascript">
function validate()
 {
	if(document.frmAdd.txtCategory.value=="")
	{
		alert("Please Enter a New Category");
		document.frmAdd.txtCategory.focus();
		return false;
	}
	document.frmAdd.canAdd.value=1;
	return true;
}
function selectall(action) {
	len=document.frmCat.chkSub.length;
	if(len>1) {
		for(i=0;i<len;i++) {
			 document.frmCat.chkSub[i].checked=action;
		}
	}
	else {
			 document.frmCat.chkSub.checked=action;
	}
}

function editclick(type) {
	document.frmCat.action='editcat.php';
	document.frmCat.target='_blank';
	document.frmCat.act.value=type;
	document.frmCat.submit();

}

function namevalchk(tag)
{       
	var1=tag.value; // tval is textbox(element) checking for characters only
    s=var1.substr(var1.length-1,1); 	 
	m=s.charCodeAt(0);            
	if(!((m>=97 && m<=122 )||(m>=65 && m<=90)|| isNaN(m)))
	{		
		ch=var1.substr(0,var1.length-1);		
		tag.value=ch;						
	}
}

function del()
{

var coun=document.frmCat.elements.length;
var f=0;
	for(i=0;i<coun;i++)
	{
		if(document.frmCat.elements[i].type=="checkbox")
		{
			if(document.frmCat.elements[i].checked==true) 
			{
				f=1;
			}
		}
	}
	if(f!=1)
	{
		alert("Please Select Any Custom Category you want to delete");
		return false;
	}

var item_deliever= confirm("Are you sure you want to delete the selected Custom Category?");
//alert(item_deliever);
if(item_deliever==true)
{
document.frmCat.submit();
return true;
}
else
{
return false;
}
}

</script>
