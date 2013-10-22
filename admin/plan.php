<?php
/***************************************************************************
 *File Name				:plan.php
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
   $mode=$_GET['mode'];
   $id=$_GET['id'];
   require 'include/connect.php';
   require 'include/top.php';
?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
<tr><td>
<table >
<tr><td width="93"><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="images/index_02_03_03_01.jpg" width="93" height="26" alt=""></td>
                    </tr>
                     <tr>
 <td><a href="user.php"><img src="images/index_02_03_03_02.jpg" width="93" height="70" alt="" border="0" title="UserManagement"></a></td>
                    </tr>
                    <tr>
                      <td><a href="site.php"><img src="images/index_02_03_03_03.jpg" width="93" height="71" alt="" border="0" title="GeneralSettings"></a></td>
                    </tr>
                    <tr>
  <td><a href="site.php?page=style"><img src="images/index_02_03_03_04.jpg" width="93" height="73" alt="" border="0" title="StyleSettings"></a></td>
                    </tr>
                <tr>
  <td><a href="report.php?page=out"><img src="images/index_02_03_03_05.jpg" width="93" height="71" alt="" border="0" title="DetailReport"></a></td>
                    </tr>
                    <tr>
  <td><a href="store_manager.php"><img src="images/index_02_03_03_06.jpg" width="93" height="70" alt="" border="0" title="StoreManager"></a></td>
                    </tr>
                    <tr>
                      <td><a href="bulk_load.php"><img src="images/index_02_03_03_07.jpg" width="93" height="66" alt="" border="0" title="BulkLoader"></a></td>
                    </tr>
                </table></td><td width=793>

<table sborder="0" cellpadding="0" cellspacing="0" align="center" height=40>
<tr>
    <td width="10%" align="center" ><center><a href="plan.php"  class="txt_users">Stores Fees</a></center></td>
    <td width="13%" align="center"><center><a href="store_manager.php" class="txt_users">View Stores</a></center></td>
  </tr>
</table>
<br />
<br />


<?php
if(isset($_POST['btn_delete']))
{	
	$id=$_POST['id'];
	$pid=$_POST['chkSub'];
	foreach($pid as $plan_id)
	{
	$sql="delete from plan where plan_id=$plan_id";
	$res=mysql_query($sql);
	$message="Plan(s) were deleted Successfully";
	}
}
	if($mode=="edit" || $mode=="new") {
	
	 $canSave=$_POST['canSave'];
	 if($canSave==1) {
	 	$plan=$_POST['txtPlan'];
		$scheme=$_POST['txtScheme'];
		$minamount=$_POST['txtSpendminamt'];
		$maxamount=$_POST['txtSpendmaxamt'];
		$period=$_POST['txtPeriod'];
		$description=$_POST['description'];
		$type=$_POST['cboPtype'];
		$interest=$_POST['txtInterest'];
		$iperiod=$_POST['txtIperiod'];
		if($iperiod=='') $iperiod=0;
		$status=$_POST[cboStatus];
		$itype=$_POST['cboItype'];
		if($mode=="edit")
		 $sql="update plan set scheme='$scheme',amount=$minamount,period=$period,period_type='$type',status='$status' , plan_description ='$description' where plan_id=$id";
		else 
			$sql="insert into plan(scheme,amount,period,period_type,status,plan_description) values ('$scheme',$minamount,$period,'$type','$status','$description')";
		//	echo $sql;
		$result=mysql_query($sql);
		
		echo '<meta http-equiv="refresh" content="0;url=plan.php">';
		exit();
	 }
		if($mode=="edit") {
			$sql="select * from plan where plan_id=$id";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
		}
?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="98%" class="border2" >
<form name="frmPlan" action="<?php $_SERVER['PHP_SELF']?>" method="post" onSubmit="this.canSave.value=1;">
<tr bgcolor="#CCCCCC"><td colspan="2"><b><?php=ucwords($mode)?>  Plan</b></td></tr>
<tr bgcolor="#eeeee1">
<td>Plan Name</td>
<td><input type="text" name="txtScheme" value="<?php=$row['scheme']?>"></td>
</tr>
<tr bgcolor="#eeeee1">
<td> Amount</td>
<td><input type="text" name="txtSpendminamt" value="<?php=$row['amount']?>" onKeyPress="return numbersonly(event);"></td>
</tr>

<tr bgcolor="#eeeee1">
<td>Period</td>
<td><input type="text" name="txtPeriod" value="<?php=$row['period']?>" onKeyPress="return numbersonly(event);"></td>
</tr>
<tr bgcolor="#eeeee1">
<td>Period Type</td>
<td><select name="cboPtype">
<option value="0">Select</option>

<option value="1" <?php  if($row['period_type']=='1') echo 'Selected'; ?>>Day</option>
<option value="2" <?php  if($row['period_type']=='2') echo 'Selected'; ?>>Month</option>
<option value="3" <?php  if($row['period_type']=='3') echo 'Selected'; ?>>Year</option>
</select></td>
</tr>
<tr bgcolor="#eeeee1">
  <td>Description </td>
  <td><textarea name=description rows="3" cols="40"><?php=$row['plan_description']?></textarea></td>
</tr>
<tr bgcolor="#eeeee1">
<td>Status</td>
<td><select name="cboStatus">
<option value="0">Select</option>
<option value="active" <?php  if($row['status']=='active') echo 'Selected'; ?>>Active</option>
<option value="inactive" <?php  if($row['status']=='Inactive') echo 'Selected'; ?>>Inactive</option>
</select></td>
</tr>
<tr bgcolor="#eeeee1"><td colspan="2" align="center"><input type="hidden" name="canSave" value="0"><input type="submit" name="btn_Add" value="<?php 
if($mode=='new') echo ' Add ';else if($mode=='edit') echo ' Modify '?>" class="button" onclick="return val();"></td></tr>
</form>
</table></td></tr></table>
</td></tr></table>
<?php
	}
	else {
?>

<table border="0" align="center" cellpadding="0" cellspacing="0" width="98%" class=border2>
<form name="frm1" method="post">
<tr bgcolor="#CCCCCC"><td><?php=$message; ?></td></tr>
<tr><td>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%">
<tr>
  <td colspan="7" bgcolor="#CCCCCC"><b>You Can Manage the Stores Fees.</b></td>
  </tr>
<tr bgcolor="#eeeee1">
<td width="1%"><input type="checkbox" name="chkMain" onClick="chkall();" class="check" value=1></td>
   <td width="20%"><strong>Plan name </strong></td>
  <td width="10%"><strong>Amount</strong></td>
  <td width="15%"><strong>Period</strong></td>
  <td width="15%"><strong>Description</strong></td>  
  <td width="15%"><strong>Status</strong></td>
    <td width="11%"><strong>Edit</strong></td>
  </tr>
<?php
	//$status=$_GET['status'];

	/*$type=$_GET['type'];
	$s=$_GET['s'];
	if($type==c) {
		$id=$_GET['id'];
		if($s=='on') {
			$sql="update payment_process set status='off' where payment_id=$id";
			$result=mysql_query($sql);
		}
		if($s=='off') {
			$sql="update payment_process set status='on' where payment_id=$id";
			$result=mysql_query($sql);
		}
	}
	if(!$status) $status='on';*/
	$sql="select * from plan";
	$result=mysql_query($sql);
	$i=1;
	while($row=mysql_fetch_array($result)) {
		if($row['period_type']==1) $p_type='Day';
		if($row['period_type']==2) $p_type='Month';
		if($row['period_type']==3) $p_type='Year';
		?>
<tr bgcolor="eeeee1">
<td><input name="chkSub[]" id="chkSub" type="checkbox" class="check" value="<?php=$row['plan_id']; ?>">
 <input type="hidden" name="id[]" value="<?php echo $row['plan_id']; ?>"> </td>
  <td class="txt_sitedetails"><?php=$row['scheme'];?></td>
  <td class="txt_sitedetails"><?php=$row['amount'];?></td>
  <td class="txt_sitedetails"><?php=$row['period'].' '.$p_type;?></td>
  <td class="txt_sitedetails"><?php=$row['plan_description']?></td>
  <td class="txt_sitedetails"> <?php= $row[status]; ?>   </td>
  <td class="txt_details1">
  <a href="plan.php?mode=edit&id=<?php=$row['plan_id']?>" class="txt_details1">Edit</a> </td>
  </tr>
<?php
$i++;
	}
?>
<tr bgcolor="#eeeee1"><td>
<input type="submit" name="btn_delete" value=" Delete " class="button" onclick="return del();">
</td>
  <td colspan="6" align="left"><a href="plan.php?mode=new" class=txt_users>
   Add New
  </a></td>
</tr>
</table></td>
</tr>
</form>
</table>
</td></tr></table>
</td></tr></table>
<?php
	}

?>
<script language="javascript">
function chkall() {
	len=document.frm1.chkSub.length;
	if(len > 1) {
	for(i=0;i<len;i++) {
		if(document.frm1.chkMain.checked==true) {
			document.frm1.chkSub[i].checked=true;
		}
		else {
			document.frm1.chkSub[i].checked=false;
		}
	}
	}
	else {
		if(document.frm1.chkMain.checked==true) {
			document.frm1.chkSub.checked=true;
		}
		else {
			document.frm1.chkSub.checked=false;
		}
	
	}
	}
function val()
{
	if(frmPlan.txtScheme.value=="")
	{
		alert("Please Enter the Plan Name");
		frmPlan.txtScheme.focus();
		return false;
	}
	if(frmPlan.txtSpendminamt.value=="")
	{
		alert("Please Enter the Plan Amount");
		frmPlan.txtSpendminamt.focus();
		return false;
	}
	if(frmPlan.txtPeriod.value=="")
	{
		alert("Please Enter the Plan Period");
		frmPlan.txtPeriod.focus();
		return false;
	}
	if(frmPlan.cboPtype.value==0)
	{
		alert("Please Enter the Plan Period type");
		frmPlan.cboPtype.focus();
		return false;
	}
	if(frmPlan.description.value=="")
	{
		alert("Please Enter the Plan Description");
		frmPlan.description.focus();
		return false;
	}
	if(frmPlan.cboStatus.value==0)
	{
		alert("Please Enter the Plan Status");
		frmPlan.cboStatus.focus();
		return false;
	}	
}

function condelete()
{
var confrm;
confrm=window.confirm("Are You sure you want to delete this Store Plan");
return confrm;
}

function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8 && unicode!=46 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
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
		alert("Please Select Any Store Plan you want to delete");
		return false;
	}

var item_deliever= confirm("Are you sure you want to delete the selected Store Plan?");
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
<?php require 'include/footer.php'?>