<?php
/***************************************************************************
 *File Name				:fee_setting.php
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
 require 'include/connect.php'; 
 require 'include/top.php'; 
 if($_POST[fee_modify])
 {
    $gret=$_POST[galleryfee];
    $hret=$_POST[homefee];
	$bret=$_POST[boldfee];
	$highret=$_POST[highlightfee];
    $insert=$_POST[insertfee];
    $classified=$_POST[classifiedfee];
	$lisitingfee=$_POST[txtlistingfee];
	$subtitle_price=$_POST[subtitle_price];
	$imagefee=$_POST[txtadditionalfee];
	$reservefee=$_POST[txtreservefee];
	
 $up_sql="update admin_rates set gallery_price='$gret',homepage_price='$hret',bold_price='$bret',highlight_price='$highret',Insertion_fee='$insert',Classified_fee='$classified',listing_designer_fee='$lisitingfee',subtitle_price='$subtitle_price',reserve_price_fee='$reservefee',Image_listing_fee='$imagefee' where admin_id=1";

 $res=mysql_query($up_sql);
 $up_sql="update admin_settings set set_value='$classified' where set_id='39' ";
 $res=mysql_query($up_sql);
 $mes="Fee Settings Updated Successfully";
 
 }
 ?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
<tr><td>
<table>
<tr><td width=93><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="images/links5_01.jpg" width="93" height="25" alt=""></td>
                    </tr>
                    <tr>
                 <td><a href=site.php?page=pay><img src="images/links5_02.jpg" width="93" height="71" alt="" border=0 title="PaymentSettings"></a></td>
                    </tr>
                    <tr>
                      <td><a href=earnings.php><img src="images/links5_03.jpg" width="93" height="71" alt="" border=0 title="AdminEarnings"></a></td>
                    </tr>
                    <tr>
                      <td><a href=fee_setting.php><img src="images/links5_04.jpg" width="93" height="74" alt="" border=0 title="FeeSettings"></a></td>
                    </tr>
                    
                </table></td><td width=793>
				<table border="0" align="center" cellpadding="5" cellspacing="2" width="98%">
<tr>
<td align="center"><font color="#FF0000">
<?php
if($mes!='')
echo $mes;
?>
</font>
</tr>
</table>
<form action="fee_setting.php" method="post" name="f1">
<table border="0" align="center" cellpadding="5" cellspacing="2" width="98%" class="border2">
<tr bgcolor="#CCCCCC" >
<td colspan="2" class=txt_users>Fee Settings</td>
</tr>
<?php
$auction_query="select * from admin_rates where admin_id=1";
$table=mysql_query($auction_query);
$ret=mysql_fetch_array($table);
    $gret=$ret['gallery_price'];
    $hret=$ret['homepage_price'];
	$bret=$ret['bold_price'];
	$highret=$ret['highlight_price'];
    $insert=$ret['Insertion_fee'];
	$lisitingfee=$ret['listing_designer_fee'];
	$subtitle_price=$ret['subtitle_price'];
	$imagefee=$ret['Image_listing_fee'];
   	$reservefee=$ret['reserve_price_fee'];
	
	
$auction_query="select * from admin_settings where set_id=39";
$table=mysql_query($auction_query);
$row=mysql_fetch_array($table);
$classified=$row['set_value'];	
	

?>
<!--<tr bgcolor="#eeeee1">
      <td>Insertion Fee</td> 
                      <td> <input type="text" name="insertfee" value="<?php//= $insert ?>"> </td>
</tr>-->
<tr bgcolor="#eeeee1">
      <td>Gallery Listing Fee</td> 
                      <td> <input type="text" name="galleryfee" value="<?php= $gret ?>" onKeyPress="return numbersonly(event);" ></td>
</tr>
<tr bgcolor="#eeeee1">
      <td>HomePage Listing Fee</td> 
                      <td> <input type="text" name="homefee" value="<?php= $hret ?>" onKeyPress="return numbersonly(event);" > </td>
</tr>
<tr bgcolor="#eeeee1">
      <td>Bold Listing Fee </td> 
                      <td> <input type="text" name="boldfee" value="<?php= $bret ?>" onKeyPress="return numbersonly(event);" > </td>
</tr>
<tr bgcolor="#eeeee1">
      <td>Highlight Listing Fee </td> 
                      <td> <input type="text" name="highlightfee" value="<?php= $highret ?>" onKeyPress="return numbersonly(event);" ></td>
</tr>
<tr bgcolor="#eeeee1">
      <td>Classified Ad Fee</td> 
                      <td> <input type="text" name="classifiedfee" value="<?php= $classified ?>" onKeyPress="return numbersonly(event);" ></td>
</tr>
<tr bgcolor="#eeeee1">
      <td>Listing Designer Fee</td> 
                      <td> <input type="text" name="txtlistingfee" value="<?php= $lisitingfee ?>" onKeyPress="return numbersonly(event);" ></td>
</tr>
<tr bgcolor="#eeeee1">
      <td>Additional Pictures Fee(Per Image)</td> 
                      <td> <input type="text" name="txtadditionalfee" value="<?php= $imagefee ?>" onKeyPress="return numbersonly(event);" ></td>
</tr>

<tr bgcolor="#eeeee1">
      <td>Reserve Price Fee</td> 
                      <td> <input type="text" name="txtreservefee" value="<?php= $reservefee ?>" onKeyPress="return numbersonly(event);" ></td>
</tr>

<tr bgcolor="#eeeee1">
      <td>Subtitle Fee</td> 
                      <td> <input type="text" name="subtitle_price" value="<?php= $subtitle_price ?>" onKeyPress="return numbersonly(event);" ></td>
</tr>
<tr bgcolor="#eeeee1" ><td align="center" colspan="2">
<input type="submit" value=" Modify " name="fee_modify" class="button" onclick="return val();"></td>
</tr>
</table></form></td></tr></table></td></tr></table>

<?php
 require 'include/footer.php'; 
?>
<script language="javascript">
function val()
{
	if(f1.galleryfee.value=="")
	{
		alert("Please Enter the Gallery Listing Fee");
		f1.galleryfee.focus();
		return false;
	}
	if(f1.homefee.value=="")
	{
		alert("Please Enter the Homepage Listing Fee");
		f1.homefee.focus();
		return false;
	}	
	if(f1.boldfee.value=="")
	{
		alert("Please Enter the Bold Listing Fee");
		f1.boldfee.focus();
		return false;
	}	
	if(f1.highlightfee.value=="")
	{
		alert("Please Enter the Highlight Listing Fee");
		f1.highlightfee.focus();
		return false;
	}	
	if(f1.classifiedfee.value=="")
	{
		alert("Please Enter the Classified Ad Fee");
		f1.classifiedfee.focus();
		return false;
	}	
	if(f1.txtlistingfee.value=="")
	{
		alert("Please Enter the Listing Designer Fee");
		f1.txtlistingfee.focus();
		return false;
	}
	if(f1.txtadditionalfee.value=="")
	{
		alert("Please Enter the Additional Picture Fee");
		f1.txtadditionalfee.focus();
		return false;
	}
	if(f1.txtreservefee.value=="")
	{
		alert("Please Enter the Reserve Price Fee");
		f1.txtreservefee.focus();
		return false;
	}
	if(f1.subtitle_price.value=="")
	{
		alert("Please Enter the Subtitle Fee");
		f1.subtitle_price.focus();
		return false;
	}
	return true;								
}

function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8 && unicode!=46 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}
</script>