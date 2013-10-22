<?php
/***************************************************************************
 *File Name				:store_directory.tpl
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
$recordset=mysql_query($store_sql);
$total_records=mysql_num_rows($recordset);
$rec_sql="select  * from admin_settings where set_id=54";
$rec_res=mysql_query($rec_sql);
$rec_row=mysql_fetch_array($rec_res); 
$limitsize=$rec_row[set_value]; 
//$limitsize=1;
 if($total_records>0)
{ 
//get the total records
if(strlen($currec)==0) //check firstpage 
$currec = 1;  
$start = ($currec - 1) * $limitsize;
$end = $limitsize;
$store_sql .=" limit $start,$end";
$recordset=mysql_query($store_sql);
$total_records=mysql_num_rows($recordset);
}
if($total_records==0)
{
?>
<table width="962" cellpadding="5" cellspacing="2" align="center">
<tr height=40>
<td background="images/item_bg.gif"><font size="3"><b><div align="left">&nbsp;&nbsp;Stores Directory >> </div> </b></font>
 </td></tr>
 <tr>
 <td class="table_topless_border">
 <table cellpadding="3" cellspacing="2" width=100% border="0" >
 <tr><td align="center" class="warning_color" colspan="5">
<br>
<br>
<br>
<font size="2" color="red"><b>Sorry! No Stores Found.</b></font>
<br>
<br>
<br></td></tr></table>
<?php require 'include/footer.php'?>
</table>
<?php 
exit();
} 
?>
<table width="962" cellpadding="5" cellspacing="0" align="center">
<tr>
<td background="images/item_bg.gif"><font size="3"><b><div align="left">&nbsp;&nbsp;Stores Directory >> </div> </b></font>
</td></tr>

<tr><td>
<table cellpadding="3" cellspacing="2" width=100% border="0" >
<tr bgcolor="#DDDDDD">
<td><font size=2 class="detail9txt"><b>Store Logo</b></font></td>
<td><font size=2 class="detail9txt"><b>Store Name</b></font></td>
<td><font size=2 class="detail9txt"><b>Owner</b></font></td>
<td><font size=2 class="detail9txt"><b>Store Description</b></font></td>
<td><font size=2 class="detail9txt"><b># Items Listed</b></font></td></tr>

<?php
//if($view=="list")
//{
if($total_records > 0)
{
?>
<tr align="left">
<?php 
$net=($currec-1*$limitsize+$end)-$total_records;
$dis=$limitsize+$start;
if($net <= 0) $net=$end;
if($dis<=$total_records)
{
?>
<td colspan=4 align="right">
<font size="2">Showing  <?php echo $start+1; ?>
 <?php echo " - ". $dis; ?> of <?php echo $total_records; ?> Items </font></td>
<?php 
}
 else 
{
?>
<td colspan=4 align="right">
<font size="2">Showing  <?php echo $start+1;?>  of <?php echo $total_records; ?> Item </font></td>
<?php
}
if($currec!=1)
{
?>
<td>
<a href="store_directory.php?currec=<?php=($currec - 1);?>&view=<?php=$view;?>&cate_id=<?php=$cate_id;?>" >
 <font size="2" color="red" face="Arial, Helvetica, sans-serif">Previous </font></a></td>
<?php
} 
$net=$total_records-($currec*$limitsize+$end) + $end;
if($net >$limitsize) $net=$limitsize;
if($net <= 0) $net=$end;
if($total_records > ($start + $end)) 
{
?>  
<td><a href="store_directory.php?currec=<?php=($currec + 1);?>&view=<?php=$view;?>&cate_id=<?php=$cate_id;?>" >
<font size=2 color="red" face="Arial, Helvetica, sans-serif"> Next </font> </a></td>
<?php
 }
 ?>
 </tr>
 <?php
} 
//} //if($view=="list");
?>
<?php
 $c=1;

 while($record=mysql_fetch_array($recordset))
 {
$auction_sql="select * from placing_item_bid where user_id=$record[user_id] and status='active' and selling_method!='want_it_now'";
$auction_res=mysql_query($auction_sql);
$auction_row=mysql_fetch_array($auction_res);
$tot_auction=mysql_num_rows($auction_res);
  
  if($c==1)
  {
  $c=0;
  ?>
<tr class="tr_color_1" height="75">  
  <?php
  }
  else
  {
  ?>
  <tr class="tr_color_2" height="75">
  <?php 
  $c=1;
  }
  //} ?>
  <td align=center width="100" class="detail9txt">
  <?php 
  if(($record[logo]) && (file_exists("storefronts/".$record[logo])))
  {
  $img=$record['logo'];
				   list($width, $height, $type, $attr) = getimagesize("storefronts/".$img);
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>160)
				  {
				  $nw=160;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
  ?>
  <a href="store.php?id=<?php  echo $record['user_id']; ?>">
  <img src="storefronts/<?php= $record[logo] ?>" border="0" title= "Click here to View Stores Details" height="<?php=$h?>" width="<?php=$w?>"></a>
  <?php
  }
  else 
  {
  ?>
  <a href="store.php?id=<?php  echo $record['user_id']; ?>">
  <img src="images/no-image.gif" border="0" alt= "Click here to View Stores Details"></a><?php 
   }
 ?>
 </td>
  <td align="center" width="100" class="detail9txt">
 <?php
  echo "$record[store_name]";
 ?>		 
  </td>
  <td width="140" class="detail9txt">
  <?php
 $member_acc="select * from user_registration where user_id=$record[user_id]";
 $memebr_rec=mysql_query($member_acc);
 $member_res=mysql_fetch_array($memebr_rec);
 
 $feed_pos_sql="select count(*) as feedbacktotal from feedback where feedback_type='Positive' and feedback_to=".$record[user_id];
 $feed_pos_rec=mysql_query($feed_pos_sql);
 $feed_pos_tot=mysql_fetch_array($feed_pos_rec);
 
 $feedbackicon_sql="select * from membership_level where feedback_score_from <= "." $feed_pos_tot[feedbacktotal] "." and  feedback_score_to >= "." $feed_pos_tot[feedbacktotal] ";  
 $feedbackicon_res=mysql_query($feedbackicon_sql);
 $feedbackicon_row=mysql_fetch_array($feedbackicon_res); 
 $feedback_img=$feedbackicon_row[icon];
 
  
  ?>
  <a href="feedback.php?user_id=<?php  echo $record['user_id']; ?>" class="header_text2"><?php  echo $member_res['user_name']; ?> </a>&nbsp;(<img src="images/<?php= $feedback_img ?>" style="position:relative;top:5px" /> )
 </td>
 <td width=300 class="detail9txt"><?php= $record[description]; ?></td>
<td class="detail9txt"><?php= $tot_auction; ?></td>
</tr>
<?php
} //while($record=mysql_fetch_array($recordset))
//}
//if($view=="list")
//}
?>
</td></tr>
</table></td></tr></table>
<?php require 'include/footer.php'?>

