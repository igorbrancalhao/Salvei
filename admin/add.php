<?php
/***************************************************************************
 *File Name				:add.php
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
require 'include/connect.php';
$sub_txt=$_POST['action'];
//$txt_add=$_POST['add'];
$sub_id=$_POST['subcategory'];
$subsub_id=$_POST['subsubcategory'];
$cat_id=$_REQUEST['id'];
$mode=$_REQUEST['mode'];
$categoryname=$_POST['subcat'];

function ret($ssid,$subsub_id)
{
 $ss_sql="select * from category_master where category_head_id=$ssid order by category_name";
 $sub_res=mysql_query($ss_sql);
 while($cat_row=mysql_fetch_array($sub_res))
 {
 
	  if($subsub_id==$cat_row['category_id'])
	  {
	  ?>
	 <option value="<?php=$cat_row['category_id'];?>" selected ><?php=$cat_row['category_name'];?></option>
	 <?php
	 }
	 else
	 {
	 ?>
	 <option value="<?php=$cat_row['category_id'];?>">&nbsp;&nbsp;&nbsp;<?php=$cat_row['category_name'];?></option>
	 <?php
	 }
  $ssid=$cat_row['category_id'];
  ret($ssid,$subsub_id);

 }

}

$sql="select * from category_master where category_head_id=0 and custom_cat='0' order by category_name ";
$res=mysql_query($sql);

$sub_sql="select * from category_master where category_head_id=$sub_id order by category_name ";
$sub_res=mysql_query($sub_sql);

if($mode=="edit")
{
$edit_sql="select * from category_master where category_id=$cat_id order by category_name";
$edit_res=mysql_query($edit_sql);
$sub_row=mysql_fetch_array($edit_res);
}


if(isset($_POST['btnSubmit']))
{

 $categoryname=str_replace('"','\"',"$categoryname");
 $categoryname=str_replace("'","\'","$categoryname");

 if($mode=="edit")
  {
  	$sq=mysql_query("select * from category_master where category_id=$cat_id");
	$sqq=mysql_fetch_array($sq);
	$cat=$sqq['category_name'];
	$q=$sqq['category_head_id'];

	$s=mysql_query("select * from category_master where category_name='$categoryname' and category_head_id=".$q." and category_id!=$cat_id");
 $cat_row=mysql_num_rows($s);
 if($cat_row==1)
 {
 	$message="Subcategory Name Already Exist";
 }
 else
 { 
     $sql1="update category_master set category_name='$categoryname' where category_id=$cat_id";
     $res1=mysql_query($sql1);
 	 $message="Subcategory Edited Successfully";
	}

  }
   
else if($subsub_id==0)
 {
 $sq=mysql_query("select * from category_master where category_id=$sub_id");
	$sq1=mysql_fetch_array($sq);
	$cat=$sq1['category_name'];
 
 $s=mysql_query("select * from category_master where category_name='$categoryname' and category_head_id=$sub_id");
 $cat_row=mysql_num_rows($s);
 if($cat_row==1)
 {
 $message="Subcategory Name Already Exist";
 }
 else
 {
 
  $sql1="insert into category_master(category_name,category_head_id) values('$categoryname','$sub_id')";
  $res1=mysql_query($sql1);
  $message="Subcategory Added Successfully";
 } 
 }
	  
else if($subsub_id!=0)
 {
 	$sq=mysql_query("select * from category_master where category_id=$subsub_id");
	$sq1=mysql_fetch_array($sq);
	$cat=$sq1['category_name'];
 
 $s=mysql_query("select * from category_master where category_name='$categoryname' and category_head_id=$subsub_id");
 $cat_row=mysql_num_rows($s);
 if($cat_row==1)
 {
 	$message="Subcategory Name Already Exist";
 }
 else
 {
 
 /* Checking for no of levels */
function levelout($catid)
{
	$chklevel_sql="select * from category_master where category_id=$catid";
	$chklevel_sqlqry=mysql_query($chklevel_sql);
 	$chklevel_fetch=mysql_fetch_array($chklevel_sqlqry);
 	$catheadid=$chklevel_fetch['category_head_id'];
 	return $catheadid;
}

$cateid=$subsub_id;
$i=0;
$ret_catid=levelout($cateid);
while($ret_catid!=0)
{
$i++;
$ret_catid=levelout($ret_catid);
}
if($i>=7)
$message="You can add upto eight levels of subcategory only.The selected category can have no more sub levels";
 else
{
 /* Checking for no of levels */
	 $sql1="insert into category_master(category_name,category_head_id) values('$categoryname','$subsub_id')";
  	 $res1=mysql_query($sql1);
     $message="Sub Categoria Adicionada com Sucesso";
	  echo '<meta http-equiv="refresh" content="50;url=subcategory.php">';
}
}
}

 
}
?>

<?php
require 'include/top.php';
?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
<tr><td>
<table id="Table_01" width="100%"  border="0" cellpadding="0" cellspacing="0">
<td width=93>
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
                </table></td><td width=793>
<table width="98%"  border="0" align="center" cellpadding="5" cellspacing="2" class="border2">
<form name="sub" method="post" action="add.php">
<tr bgcolor="#eeeee1">
<td colspan="2" align="center">
<font color="#FF0000">
<?php
if($message!='')
echo $message;
?>
</font>
</td>
</tr>
 <td height="40" colspan="2" bgcolor="#CCCCCC"  align="center" class="txt_users">
<?php 
if($mode=='edit')
{
echo ("Editar Categoria");
}
else
{
echo ("Adicionar Categoria");
}
?></td>

<tr bgcolor="#eeeee1">
<td align="right">
<?php
if($mode=='edit')
{
echo ("Categoria");
}
else
{
echo ("Categoria");
}?></td>

<td align="left">
<?php
if($mode!='edit')
{
?>
<select name=subcategory onchange="this.form.submit()">
<option value="0">Select</option>
<?php
while($cat_row=mysql_fetch_array($res))
{

 if($sub_id==$cat_row['category_id'])
 {
?>
<option value="<?php=$cat_row['category_id'];?>" selected><?php=$cat_row['category_name'];?></option>
<?php
 }
 
 else
 {
?>
 <option value="<?php=$cat_row['category_id'];?>"  ><?php=$cat_row['category_name'];?></option>
<?php
 }
 
}
?>
</select>
<?php
}
if($mode=='edit')
{
while($cat_row=mysql_fetch_array($res))
{

	 if($sub_row['category_head_id']==$cat_row['category_id'])
	 {
		 echo $cat_row['category_name'];
	 }
}
}
?>
</td></tr>

<tr  bgcolor="eeeee1">
<td align="right">
<?php
if($mode=='edit')
{
echo ("Sub Categoria");
}
else
{
echo ("Sub Categoria");
}?></td>

<td align="left">
<select name=subsubcategory onchange="this.form.submit()">
  <option value="0">Select</option>
  <?php
while($cat_row=mysql_fetch_array($sub_res))
{

if($subsub_id==$cat_row['category_id'])
{
?>
  <option value="<?php=$cat_row['category_id'];?>" selected >
  <?php=$cat_row['category_name'];?>
  </option>
  <?php
}
else
{
?>
  <option value="<?php=$cat_row['category_id'];?>"  >
  <?php=$cat_row['category_name'];?>
  </option>
  <?php
}
$ssid=$cat_row['category_id'];
ret($ssid,$subsub_id);

}
?>
</select></td>
</tr>

<tr bgcolor="eeeee1">
<td align="right">
<?php
if($mode=='edit')
{
echo ("Nome desejado");
}
else
{
echo ("Nome desejado");
}
?></td>

<td align="left">
	<input type="text" name="subcat" value="<?php=$sub_row['category_name'];?>" style="width:300;"></td>
<tr class="style1" bgcolor="eeeee1">

<input type="hidden" name="action" value="1">
<input type="hidden" name="mode" value="<?php=$mode?>">
<input type="hidden" name="id" value="<?php=$cat_id?>">
<td align="center" colspan="2">
<input name="btnSubmit" type="submit" class="button" onclick="return validate();" value="Enviar"></td>
</tr>
</form>
</table></td></tr></table></td></tr></table>

<?php
require 'include/footer.php'
?>
 <script language="javascript">
 function validate()
 {
 	if(sub.mode.value=="")
	{
 	if(sub.subcategory.value==0)
	{
		alert("Por favor Selecione a Categoria");
		sub.subcategory.focus();
		return false;
	}
	if(sub.subcat.value=="")
	{
		alert("Por favor digite o nome da Sub categoria");
		sub.subcat.focus();
		return false;
	}
	}
	else if(sub.mode.value=="Editar")
	{
	if(sub.subcat.value=="")
	{
		alert("Por favor digite o nome da Sub Categoria");
		sub.subcat.focus();
		return false;
	}
	}
	return true;
	
 }
 </script>
 