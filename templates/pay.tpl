<?php
/***************************************************************************
 *File Name				:pat.tpl
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

<table width="100%" align="center" cellpadding="0" cellspacing="10">
<tr><td>
<table width="958" align="center" cellpadding="0" cellspacing="0">
<tr>
<td colspan="4" background="images/contentbg.jpg" height=25>
<font size="3"><b><div align="left">&nbsp;&nbsp; Payment Details </div> </b></font> </td></tr>
<tr><td colspan="3">
<table cellpadding="0" cellspacing="0">
<tr>
<td valign="top">
<table cellpadding="0" cellspacing="0">
<tr align="center" height=35>
<td width=2>
<?php require'include/my_list.php'; ?>
</td></tr></table></td>
<td valign="top" width=100%>
<table valign="top " cellspacing="0" cellpadding="0">

<!--//////////// pay items //////////// -->
<?php
 $currency_sell="select * from admin_settings where set_id=59";
$currency_res=mysql_query($currency_sell);
$currency_row=mysql_fetch_array($currency_res);
$cur_sell=$currency_row[set_value];
 ?>
<?php
if($mode=="sell" or $mode=="")
{
?>
<tr><td>
<table cellpadding="10" cellspacing="0">
<tr><td  height=30 width=780 id=paydetails>
<table cellpadding="0" cellspacing="3" width=100% background="images/item_bg.gif">
<tr>
<td align="left"><font class="detail9txt">
<b>&nbsp;&nbsp;Pay for Selling Item's:&nbsp;&nbsp;&nbsp;</b>(<?php= $pay_total_records; ?>&nbsp;Items)</b></font></td>
<td align="right" width=10>
<!--<a href="myauction.php?#paydetails">
<img src="images/leasing-arrows-up.gif" border=0></a>--></td>
<td align="right" width=10>
<!--<a href="myauction.php?#didntwindetails">
<img src="images/leasing-arrows-dn.gif" border=0>
</a>--></td>
</tr></table>
</td></tr>
<tr >
<td >
<table cellspacing="0" cellpadding="0" width=100%>
<?php
 if($pay_total_records > 0)
{ 
?>
<form name="pay_frm" action="pay.php" method=post>
<tr class="detail9txt">
<td class="tr_botborder" width=5%>&nbsp;
<!-- <input type="hidden" name="len" value="<?php=mysql_num_rows($pay_res)?>">
<input type="checkbox" name="chkMain" onClick="pay_selectall()" id="chkMain"> --> </td> 
<td class="tr_botborder" width=30%><b>Item Id</b> </td>
<td width="7%" class="tr_botborder"><b>Qty </b> </td>
<td width="11%" class="tr_botborder"><b>Setup Price</b>  </td>
<!--<td width="10%" class="tr_botborder"><b>&nbsp;Total Setup Price</b>  </td>-->
<td width="15%" class="tr_botborder"><b> Posted Date </b> </td>
<td width="22%" class="tr_botborder" colspan="2"><b>Action </b> </td>
</tr>
<?php
$pay_res=mysql_query($pay_sql);
while($pay_row=mysql_fetch_array($pay_res))
{
// seller information
$user_sql="select * from user_registration where user_id=".$pay_row['user_id'];
$user_res=mysql_query($user_sql);
$user=mysql_fetch_array($user_res);
$sellername=$user[user_name];

if($pay_row['selling_method']!='ads')
{
$fee_sql="select * from auction_fees where item_id=".$pay_row['item_id'];
$fee_res=mysql_query($fee_sql);
$fee_row=mysql_fetch_array($fee_res);
$total_setup_fee=$fee_row[homepage_featureditem_fee]+$fee_row[gallery_fee]+$fee_row[boldlisting_fee]+$fee_row[highlighted_fee]+$fee_row[subtitlefee]+$fee_row[listing_desinger_fee]+$fee_row[addtional_pic_fee]+$fee_row[reserve_price_fee]+$fee_row[Insertion_fee];
}
if($pay_row['selling_method']=='ads')
{
$fee_sql="select * from auction_fees where item_id=".$pay_row['item_id'];
$fee_res=mysql_query($fee_sql);
$fee_row=mysql_fetch_array($fee_res);
$total_setup_fee=$fee_row[homepage_featureditem_fee]+$fee_row[gallery_fee]+$fee_row[boldlisting_fee]+$fee_row[highlighted_fee]+$fee_row[subtitlefee]+$fee_row[listing_desinger_fee]+$fee_row[addtional_pic_fee]+$fee_row[reserve_price_fee]+$fee_row[classifedad_fee];
}
?>
<tr class="detail9txt">
<td class="tr_botborder" width=5%>&nbsp; 
</td>
<td class="tr_botborder" width=30%>
<a href="feedback.php?user_id=<?php=$pay_row['user_id'];?>" class="header_text">
<?php echo $pay_row['item_id'];?></a>
</td>
<td class="tr_botborder"><?php  echo $pay_row['Quantity']; ?> </td>
<td class="tr_botborder"><?php=$cur_sell?>&nbsp;<?php  echo $total_setup_fee; ?> </td>
<td class="tr_botborder">
<?php
  $custom_date=explode(" ",$pay_row[bid_starting_date]);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo  $custom_date[0];
?>
</td>
<td class="tr_botborder" colspan="2">
<?php $var=$pay_row[user_id]."-".$pay_row[item_id]; ?>
<select name=cbopayaction style="width:100px;" onchange="go_page_link(this.value,'<?php= $pay_row[item_id]; ?>',<?php= $pay_row[user_id] ?>)">
<option value="0">Action</option>
<option value="4">Pay Now</option>
<option value="5">Delete</option>
</select>
</td></tr>
<tr>
<td class="tr_botborder_1">&nbsp;  </td>
<td class="tr_botborder_1" colspan=5 align="left">
<a href="<?php if($pay_row[selling_method]!="ads") {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php= $pay_row['item_id']?>" class="header_text">
<?php  echo $pay_row['item_title']; ?></a>&nbsp;<font class="header_text">(<?php  echo $pay_row['item_id']; ?> )</font></td>
<td class="tr_botborder_1">&nbsp;  </td></tr>
<?php
// }
} // while
?>
<input type="hidden" name="pay_delete" />
<input type="hidden" name="seller_id"  />
<input type="hidden" name="item_id"  />
<tr>
<td colspan="7" class="tr_botborder"> <!-- 
<input type="button" value=Delete name="conf" onClick="del()" class=buttonbig> -->
</td>
</tr>
</form>
<?php
}
else
{
?>
<tr class="detail9txt">
<td class="tr_botborder" colspan=5 align="left">
You do not have any pay items to display at this time. 
</td>
</tr>
<?php
}
?>
</table>
</td></tr>
</table>
</td></tr>
<?php
} // if($mode=="pay" or $mode=="")
?>
 
<!-- ///////////// end of pay items ///////////// -->
<!--//////////// final value fee payment details //////////// -->

<?php

$item_sql="select * from placing_item_bid a,auction_fees b,placing_bid_item c where status='Closed' and a.item_id=b.item_id and a.item_id=c.item_id and c.item_id=b.item_id and a.user_id=".$_SESSION[userid]." and b.feestatus='0' and (b.finalsalevalue_fee!=0 and b.finalsalevalue_fee!='0.00' and b.finalsalevalue_fee!=' ') group by c.item_id";
$item_res=mysql_query($item_sql);
$item_row=mysql_num_rows($item_res);
?>

<tr><td>
<table cellpadding="10" cellspacing="0">
<tr><td height=30 width="780" id="paydetails" height="30">
<table cellpadding="0" cellspacing="3" width=100% background="images/item_bg.gif">
<tr>
<td align="left"><font class="detail9txt">
<b>&nbsp;&nbsp;Pay  Final Sale Value fees:&nbsp;&nbsp;&nbsp;</b></font></td>
<td align="right" width=10>
<!--<a href="myauction.php?#paydetails">
<img src="images/leasing-arrows-up.gif" border=0></a>--></td>
<td align="right" width=10>
<!--<a href="myauction.php?#didntwindetails">
<img src="images/leasing-arrows-dn.gif" border=0>
</a>--></td>
</tr></table>
</td></tr>
<?php
if( $item_row > 0 )
{ 
?>
<tr >
<td >
<table cellspacing="0" cellpadding="5" width=100%>

<form name="final_frm" action="pay.php" method="post">
<tr class="detail9txt">
<td class="tr_botborder" width=5%>&nbsp;
<!-- <input type="hidden" name="len" value="<?php=mysql_num_rows($pay_res)?>">
<input type="checkbox" name="chkMain" onClick="pay_selectall()" id="chkMain"> --> </td> 
<td class="tr_botborder" width=12%><b>Item Id</b> </td>
<td width="7%" class="tr_botborder"><b>Qty </b> </td>
<td width="29%" class="tr_botborder"><b>Final Sale Value Fee </b>  </td>
<td width="10%" class="tr_botborder"><b>Total Price</b>  </td>
<td width="15%" class="tr_botborder"><b> Sale Date </b> </td>
<td width="22%" class="tr_botborder"><b>Action </b> </td>
</tr>
<?php

$pay_res=mysql_query($item_sql);
while($pay_row=mysql_fetch_array($pay_res))
{

$user_sql="select * from user_registration where user_id=".$pay_row['user_id'];
$user_res=mysql_query($user_sql);
$user=mysql_fetch_array($user_res);
$sellername=$user[user_name];
$total_setup_fee=$pay_row[finalsalevalue_fee];

$bid_sql="select * from placing_bid_item where user_pos='Yes' and  item_id=".$pay_row['item_id'];
$bid_res=mysql_query($bid_sql);
$bid_row=mysql_fetch_array($bid_res);

?>

<tr class="detail9txt">
<td class="tr_botborder" width=5%> &nbsp;
<!-- <input type="checkbox" name=chkbox[] id="chkbox" value="<?php  echo $pay_row['item_id']; ?>"> -->
</td>
<td class="tr_botborder" width=12%>
<a href="feedback.php?user_id=<?php=$pay_row['user_id'];?>" class="header_text">
<?php echo $pay_row['item_id'];?></a></td>
<td class="tr_botborder">1<?php  //echo $bid_row['quantity']; ?> </td>
<td class="tr_botborder"><?php=$cur_sell?>&nbsp;<?php  echo $total_setup_fee; ?> </td>
<td class="tr_botborder"><?php=$cur_sell?><?php  echo ($total_setup_fee ); ?> </td>
<td class="tr_botborder">
<?php
  $custom_date=explode(" ",$bid_row[bidding_date]);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo  $custom_date[0];
?>
</td>
<td class="tr_botborder">
<?php $var=$pay_row[user_id]."-".$pay_row[item_id]; ?>
<select name=cbopayaction style="width:100px;" onchange="go_page_link(this.value,'<?php= $pay_row[item_id]; ?>',<?php= $pay_row[fee_id] ?>)">
<option value="0">Action</option>
<option value="6">Pay Now</option>
</select>
</td></tr>
<tr>
<td class="tr_botborder_1">&nbsp;  </td>
<td class="tr_botborder_1" colspan=5 align="left">
<a href="<?php if($pay_row[selling_method]!="ads") {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php= $pay_row['item_id']?>" class="detail9txt">
<?php  echo $pay_row['item_title']; ?></a>&nbsp;<font class="detail9txt">(<?php  echo $pay_row['item_id']; ?> )</font></td>
<td class="tr_botborder_1">&nbsp;  </td></tr>
<?php
} // while
?>
<input type="hidden" name="pay_delete" />
<input type="hidden" name="fee_id"  />
<input type="hidden" name="item_id"  />
<tr>
<td colspan="7" class=tr_botborder> <!-- 
<input type="button" value=Delete name="conf" onClick="del()" class=buttonbig> -->
</td>
</tr>
</form>
<?php
}
else
{
?>
<tr class="detail9txt">
<td class="tr_botborder" colspan=5 align="left">
You do not have any final sale value fee.
</td>
</tr>
<?php
}
?>
</table>
</td></tr>
</table>
</td></tr>
</table></td>
<td valign="top">
<?php
require 'templates/right_menu.tpl';
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td></tr>
