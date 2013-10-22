<?php
/***************************************************************************
 *File Name				:search.php
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
  if(isset($_POST['search']))
   {
     $sell=$_POST['cboSell'];
     $cat=$_POST['cboCat'];
	 
	 $array1=array($_POST['cboAyear'],$_POST['cboAmonth'],$_POST['cboAday']);
	 $array2=array($_POST['cboByear'],$_POST['cboBmonth'],$_POST['cboBday']);
 	 $array3=array($_POST['cboCyear'],$_POST['cboCmonth'],$_POST['cboCday']);
 	 $array4=array($_POST['cboDyear'],$_POST['cboDmonth'],$_POST['cboDday']);

  //	 $iid=$_POST['iid'];
	 
	 $adate=implode('-',$array1);
	 $_SESSION['adate']=$adate;
	 
	 $bdate=implode('-',$array2);
	 $_SESSION['bdate']=$bdate;
	 
	 $cdate=implode('-',$array3);
	 $_SESSION['cdate']=$cdate;
	 
	 $ddate=implode('-',$array4);
	 $_SESSION['ddate']=$ddate;
	 
//	 $_SESSION['iid']=$iid;
	 
   /* echo "<meta http-equiv='refresh' content='0;url=paidmember.php'>";
			exit();*/
	if($sell=="auction" && $cat==0)
	{
	echo "<meta http-equiv='refresh' content='0;url=auction.php'>";
	exit(0);
	}
	if($sell=="auction" && $cat!=0)
	{
	echo "<meta http-equiv='refresh' content='0;url=auction.php?id=$cat'>";
	exit(0);
	}

	if($sell=="dutch_auction" && $cat==0)
	{
 	echo "<meta http-equiv='refresh' content='0;url=dutch_auction.php'>";
	exit(0);
	}
	if($sell=="dutch_auction" && $cat!=0)
	{
 	echo "<meta http-equiv='refresh' content='0;url=dutch_auction.php?id=$cat'>";
	exit(0);
	}
	
	if($sell=="fix" && $cat==0)
	{
	echo "<meta http-equiv='refresh' content='0;url=fixed.php'>";
 	exit(0);
	}
	if($sell=="fix" && $cat!=0)
	{
	echo "<meta http-equiv='refresh' content='0;url=fixed.php?id=$cat'>";
 	exit(0);

	}
	
	if($sell=="Ads" && $cat==0)
	{
	echo "<meta http-equiv='refresh' content='0;url=classified.php'>";
 	exit(0);
	}
	if($sell=="Ads" && $cat!=0)
	{
	echo "<meta http-equiv='refresh' content='0;url=classified.php?id=$cat'>";
 	exit(0);
	}

	if($sell=="want" && $cat==0)
	{
	echo "<meta http-equiv='refresh' content='0;url=want_it_now.php'>";
 	exit(0);
	}
	if($sell=="want" && $cat!=0)
	{
	echo "<meta http-equiv='refresh' content='0;url=want_it_now.php?id=$cat'>";
 	exit(0);
	}
	
    }
   	
 ?>
<tr>
  <td colspan="5">
  <table width="98%"  border="0" cellpadding="5" cellspacing="1" class="border2" align="center">
<form name="frmsearch" method="post">
 <tr bgcolor="#CCCCCC" class="style1"><td colspan="4">Search</td></tr>
 <!-- <tr bgcolor="eeeee1">
 <td colspan="4" align="left">
 <table width="100%">
 <tr>
 <td align="center">
 Item ID</td>
 <td align="center"><input type="text" name="iid" size="20" />
 </td>
 </tr>
 </table>
 </td>
 </tr>-->
 <tr bgcolor="eeeee1">
 	<td>Selling Method</td>
	<td>
	    <select name="cboSell">
	     <option value="auction">Simple Auction</option>
	     <option value="dutch_auction">Dutch Auction</option>
 	     <option value="fix">Fixed Price Sale </option>
 	     <option value="Ads">Classified Ads</option>
<!-- 	     <option value="want">Want It Now</option>	-->	 
		</select>
	</td>
 <td>Categories</td>
 	<td>
	  <select name="cboCat">
  	  <option id=0>All Categories</option>
	   <?php 
	    $cat_sql="select * from category_master where category_head_id=0 order by category_name asc";
		$cat_res=mysql_query($cat_sql);
		while($cat_row=mysql_fetch_array($cat_res))
		{ 
		?>
		<option value="<?php=$cat_row['category_id']?>"><?php=$cat_row['category_name']?></option>
		<?php } ?>
	  </select>
	</td>
 </tr>
 <tr bgcolor="eeeee1"><td colspan="4">
  <table align="center" width="100%" cellpadding="5" cellspacing="2" border="0">
 <tr>
   <td>posted between</td>
   <td>
 <select name="cboAday" class="cbo">
 <option value="">Day</option>
 <?php
 for($i=1;$i<=31;$i++)
 {
 ?>
 <option value="<?php=$i; ?>"><?php=$i; ?></option>
 <?php
 }
 ?>
 </select></td>
 <td>
 <select name="cboAmonth" class="cbo">
				<option value="">Month</option>
				<?php
					$montharr="dumm,Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec";
					$month=explode(',',$montharr);
					for($i=1;$i<=12;$i++) { 
					   echo "<option value=$i>$month[$i]</option>"; 
					}
				?>
			  </select>
 </td>
 <td> <select name="cboAyear" class="cbo">
 <option value="">Year</option>
 <?php
 for($i=2004;$i<=2020;$i++)
 {
 ?>
 <option value="<?php=$i; ?>"><?php=$i; ?></option>
 <?php
 }
 ?>
 </select></td>
 <td>and</td>
<td>
 <select name="cboBday" class="cbo">
 <option value="">Day</option>
 <?php
 for($i=1;$i<=31;$i++)
 {
 ?>
 <option value="<?php=$i; ?>"><?php=$i; ?></option>
 <?php
 }
 ?>
 </select></td>
 <td>
 <select name="cboBmonth" class="cbo">
				<option value="">Month</option>
				<?php
					$montharr="dumm,Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec";
					$month=explode(',',$montharr);
					for($i=1;$i<=12;$i++) { 
					   echo "<option value=$i>$month[$i]</option>"; 
					}
				?>
			  </select>
 </td>
 <td> <select name="cboByear" class="cbo">
 <option value="">Year</option>
 <?php
 for($i=2004;$i<=2020;$i++)
 {
 ?>
 <option value="<?php=$i; ?>"><?php=$i; ?></option>
 <?php
 }
 ?>
 </select></td></table> </td></tr>
 <tr bgcolor="eeeee1"><td colspan="4"><table align="center" width="100%">
 <tr><td>Ending between</td><td>
 <select name="cboCday" class="cbo">
 <option value="">Day</option>
 <?php
 for($i=1;$i<=31;$i++)
 {
 ?>
 <option value="<?php=$i; ?>"><?php=$i; ?></option>
 <?php
 }
 ?>
 </select></td>
 <td>
 <select name="cboCmonth" class="cbo">
				<option value="">Month</option>
				<?php
					$montharr="dumm,Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec";
					$month=explode(',',$montharr);
					for($i=1;$i<=12;$i++) { 
					   echo "<option value=$i>$month[$i]</option>"; 
					}
				?>
			  </select>
 </td>
 <td> <select name="cboCyear" class="cbo">
 <option value="">Year</option>
 <?php
 for($i=2004;$i<=2020;$i++)
 {
 ?>
 <option value="<?php=$i; ?>"><?php=$i; ?></option>
 <?php
 }
 ?>
 </select></td>
 <td>and</td>
<td>
 <select name="cboDday" class="cbo">
 <option value="">Day</option>
 <?php
 for($i=1;$i<=31;$i++)
 {
 ?>
 <option value="<?php=$i; ?>"><?php=$i; ?></option>
 <?php
 }
 ?>
 </select></td>
 <td>
 <select name="cboDmonth" class="cbo">
				<option value="">Month</option>
				<?php
					$montharr="dumm,Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec";
					$month=explode(',',$montharr);
					for($i=1;$i<=12;$i++) { 
					   echo "<option value=$i>$month[$i]</option>"; 
					}
				?>
			  </select>
 </td>
 <td> <select name="cboDyear" class="cbo">
 <option value="">Year</option>
 <?php
 for($i=2004;$i<=2020;$i++)
 {
 ?>
 <option value="<?php=$i; ?>"><?php=$i; ?></option>
 <?php
 }
 ?>
 </select></td></table> </td></tr>


 <tr bgcolor="eeeee1">
 <td colspan="4" align="center">
 
 <input type="submit" name="search" value="Search" class="button" onclick="return validate();"></td></tr>
</form>
</table>
  </td>
</tr> 

<tr><td>&nbsp;</td></tr>

<script language="javascript">
function validate()
{
if(document.frmsearch.cboAday.value!="") 
{
 if(document.frmsearch.cboAmonth.value=="") 
 {
	 	alert("Please Select Starting Month");
		document.frmsearch.cboAmonth.focus();
		return false;
 }
 if (document.frmsearch.cboAyear.value=="")
 {
		alert("Please Select Starting Year");
		document.frmsearch.cboAyear.focus();
		return false;
 }
}
if(document.frmsearch.cboAmonth.value!="") 
{
 if(document.frmsearch.cboAday.value=="") 
 {
		alert("Please Select Starting  Day");
		document.frmsearch.cboAday.focus();
		return false;
 }
 if (document.frmsearch.cboAyear.value=="")
 {
		alert("Please Select Starting Year");
		document.frmsearch.cboAyear.focus();
		return false;
 }
}
if(document.frmsearch.cboAyear.value!="") 
{
 if(document.frmsearch.cboAmonth.value=="") 
 {
		alert("Please Select Starting Month");
		document.frmsearch.cboAmonth.focus();
		return false;
 }
 if (document.frmsearch.cboAday.value=="")
 {
		alert("Please Select Starting Day");
		document.frmsearch.cboAday.focus();
		return false;
 }
}

if(document.frmsearch.cboAday.value!="" && document.frmsearch.cboAmonth.value!=0 && document.frmsearch.cboAyear.value!="")
{
var d=document.frmsearch.cboAday.value;
var m=document.frmsearch.cboAmonth.value;
var y=document.frmsearch.cboAyear.value;
var dayobj = new Date(y,m-1,d)
if ((dayobj.getMonth()+1!=m)||(dayobj.getDate()!=d)||(dayobj.getFullYear()!=y))
{
	alert("Invalid Date Entry Detected in Posted Between");
//	alert("Invalid Starting Day, Month, or Year range detected. Please correct and submit again.")
	document.frmsearch.cboAday.focus();
	return false;
}
}	


if(document.frmsearch.cboBday.value!="") 
{
 if(document.frmsearch.cboBmonth.value=="") 
 {
	 	alert("Please Select Ending Month");
		document.frmsearch.cboBmonth.focus();
		return false;
 }
 if (document.frmsearch.cboByear.value=="")
 {
		alert("Please Select Ending Year");
		document.frmsearch.cboByear.focus();
		return false;
 }
}
if(document.frmsearch.cboBmonth.value!="") 
{
 if(document.frmsearch.cboBday.value=="") 
 {
		alert("Please Select Ending Day");
		document.frmsearch.cboBday.focus();
		return false;
 }
 if (document.frmsearch.cboByear.value=="")
 {
		alert("Please Select Ending Year");
		document.frmsearch.cboByear.focus();
		return false;
 }
}
if(document.frmsearch.cboByear.value!="") 
{
 if(document.frmsearch.cboBmonth.value=="") 
 {
		alert("Please Select Ending Month");
		document.frmsearch.cboBmonth.focus();
		return false;
 }
 if (document.frmsearch.cboBday.value=="")
 {
		alert("Please Select Ending Day");
		document.frmsearch.cboBday.focus();
		return false;
 }
}

if(document.frmsearch.cboBday.value!="" && document.frmsearch.cboBmonth.value!=0 && document.frmsearch.cboByear.value!="")
{
var d1=document.frmsearch.cboBday.value;
var m1=document.frmsearch.cboBmonth.value;
var y1=document.frmsearch.cboByear.value;
var dayobj1 = new Date(y1,m1-1,d1)
var tdate1=new Date();
if ((dayobj1.getMonth()+1!=m1)||(dayobj1.getDate()!=d1)||(dayobj1.getFullYear()!=y1))
{
	alert("Invalid Date Entry Detected in Posted Between and");
//	alert("Invalid Ending Day, Month, or Year range detected. Please correct and submit again.")
	document.frmsearch.cboBday.focus();
	return false;
}
}

//Start
if(document.frmsearch.cboCday.value!="") 
{
 if(document.frmsearch.cboCmonth.value=="") 
 {
	 	alert("Please Select Starting Month");
		document.frmsearch.cbocmonth.focus();
		return false;
 }
 if (document.frmsearch.cboCyear.value=="")
 {
		alert("Please Select Starting Year");
		document.frmsearch.cboCyear.focus();
		return false;
 }
}
if(document.frmsearch.cboCmonth.value!="") 
{
 if(document.frmsearch.cboCday.value=="") 
 {
		alert("Please Select Starting  Day");
		document.frmsearch.cboCday.focus();
		return false;
 }
 if (document.frmsearch.cboCyear.value=="")
 {
		alert("Please Select Starting Year");
		document.frmsearch.cboCyear.focus();
		return false;
 }
}
if(document.frmsearch.cboCyear.value!="") 
{
 if(document.frmsearch.cboCmonth.value=="") 
 {
		alert("Please Select Starting Month");
		document.frmsearch.cboCmonth.focus();
		return false;
 }
 if (document.frmsearch.cboCday.value=="")
 {
		alert("Please Select Starting Day");
		document.frmsearch.cboCday.focus();
		return false;
 }
}

if(document.frmsearch.cboCday.value!="" && document.frmsearch.cboCmonth.value!="" && document.frmsearch.cboCyear.value!="")
{
var d=document.frmsearch.cboCday.value;
var m=document.frmsearch.cboCmonth.value;
var y=document.frmsearch.cboCyear.value;
var dayobj = new Date(y,m-1,d)
if ((dayobj.getMonth()+1!=m)||(dayobj.getDate()!=d)||(dayobj.getFullYear()!=y))
{
	alert("Invalid Date Entry Detected in Ending Between");
//	alert("Invalid Starting Day, Month, or Year range detected. Please correct and submit again.")
	document.frmsearch.cboCday.focus();
	return false;
}
}	


if(document.frmsearch.cboDday.value!="") 
{
 if(document.frmsearch.cboDmonth.value=="") 
 {
	 	alert("Please Select Ending Month");
		document.frmsearch.cboDmonth.focus();
		return false;
 }
 if (document.frmsearch.cboDyear.value=="")
 {
		alert("Please Select Ending Year");
		document.frmsearch.cboDyear.focus();
		return false;
 }
}
if(document.frmsearch.cboDmonth.value!="") 
{
 if(document.frmsearch.cboDday.value=="") 
 {
		alert("Please Select Ending Day");
		document.frmsearch.cboDday.focus();
		return false;
 }
 if (document.frmsearch.cboDyear.value=="")
 {
		alert("Please Select Ending Year");
		document.frmsearch.cboDyear.focus();
		return false;
 }
}
if(document.frmsearch.cboDyear.value!="") 
{
 if(document.frmsearch.cboDmonth.value=="") 
 {
		alert("Please Select Ending Month");
		document.frmsearch.cboDmonth.focus();
		return false;
 }
 if (document.frmsearch.cboDday.value=="")
 {
		alert("Please Select Ending Day");
		document.frmsearch.cboDday.focus();
		return false;
 }
}

if(document.frmsearch.cboDday.value!="" && document.frmsearch.cboDmonth.value!="" && document.frmsearch.cboDyear.value!="")
{
var d1=document.frmsearch.cboDday.value;
var m1=document.frmsearch.cboDmonth.value;
var y1=document.frmsearch.cboDyear.value;
var dayobj1 = new Date(y1,m1-1,d1)
var tdate1=new Date();
if ((dayobj1.getMonth()+1!=m1)||(dayobj1.getDate()!=d1)||(dayobj1.getFullYear()!=y1))
{
	alert("Invalid Date Entry Detected in Ending Between");
//	alert("Invalid Ending Day, Month, or Year range detected. Please correct and submit again.")
	document.frmsearch.cboDday.focus();
	return false;
}
}
//End

//document.frmsearch.sflag.value=1;
return true;
}
</script>
 