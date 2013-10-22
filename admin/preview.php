<?php
/***************************************************************************
 *File Name				:preview.php
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
error_reporting(0);
/*
 file name:preview.php;
 date	  :6.7.05
 Created by:priya
 Rights reserved by AJ Square inc
*/
$auction_query="select * from admin_settings where set_id=42";
$table=mysql_query($auction_query);
$row=mysql_fetch_array($table);
$bid_permission=$row['set_value'];
   if($_SESSION[sell_format]=="2")
   {
   $qty=$_SESSION[qty];
   }
   else
   {
   $qty="1";
   $_SESSION[qty]=1;
   }
   if($_SESSION[theme_id])
   {
   $theme_sql="select * from themes_master where themes_id=$_SESSION[theme_id]";
   $theme_res=mysql_query($theme_sql);
   $theme_row=mysql_fetch_array($theme_res);
   $img=$theme_row['themes'];
   list($width, $height, $type, $attr) = getimagesize("images/$img");
   $theme_top=$theme_row[theme_top_img];
   $theme_bottom=$theme_row[theme_bottom_img];
   $theme_content=$theme_row[theme_content_img];
   
 }
if($_SESSION[mode]=="repost")
{
$item_id=$_SESSION[item_id];
$edit="select * from placing_item_bid where item_id=$item_id";
$edit_res=mysql_query($edit);
$edit_row=mysql_fetch_array($edit_res);
$fea_item="select * from featured_items where item_id=$item_id";
$fea_res=mysql_query($fea_item);
$fea_row=mysql_fetch_array($fea_res);


$_SESSION[item_name]=$edit_row[item_title];
$_SESSION[des]=$edit_row[detailed_descrip];
$_SESSION[sell_method]=$edit_row[selling_method];
$_SESSION[currency]=$edit_row[currency];
$_SESSION[min_amt]=$edit_row[min_bid_amount];
$_SESSION[quick_price] =$edit_row[quick_buy_price]; 
$_SESSION[rev_price]=$edit_row[reserve_price];
$_SESSION[bid_inc]=$edit_row[bid_increment];
$_SESSION[size_of_qty]=$edit_row[size_of_quantity];
$_SESSION[qty]=$edit_row[Quantity];
$_SESSION[start_delay]=$edit_row[start_delay];
$_SESSION[image1]=$edit_row[picture1];
$_SESSION[image2]=$edit_row[picture2];
$_SESSION[image3]=$edit_row[picture3];
$_SESSION[shipping_route]=$edit_row[shipping_route];
$_SESSION[shipping_amt]=$edit_row[shipping_cost];
$_SESSION[tax]=$edit_row[tax];
$_SESSION[subtitle]=$subtitle;
$_SESSION[repost]=$_edit_row[no_of_repost];
   $quick=$_SESSION[quick_price];	  
   $size_of_qty=$_SESSION[size_of_qty];
   $start_delay=$_SESSION[start_delay];
   $img1=$_SESSION[image1];
   $img2=$_SESSION[image2];
   $img3=$_SESSION[image3];
   $img4=$_SESSION[image4];
   $img5=$_SESSION[image5];
   $img6=$_SESSION[image6];
   $img7=$_SESSION[image7];
}
?>
<?php
$flag=$_POST[flag];
if($flag==1)
{  
    $userid=$_SESSION[users_id];   
   $cat_id=$_SESSION[categoryid];
   $item_title=$_SESSION[item_name];
   $qty=$_SESSION[qty];
   $itemdes=$_SESSION[des];
   $currency=$_SESSION[currency];
   $sell_method=$_SESSION[sell_method];
   $min_amt=$_SESSION[min_amt];  
   $bid_inc=$_SESSION[bid_inc];
   $itemcondition=$_SESSION[itemcondition];
   $dur=$_SESSION[dur];
   $rev_price=$_SESSION[rev_price];
   $quick=$_SESSION[quick_price];	  
   $size_of_qty=$_SESSION[size_of_qty];
   $start_delay=$_SESSION[start_delay];
   $img1=$_SESSION[image1];
   $img2=$_SESSION[image2];
   $img3=$_SESSION[image3];
   $img4=$_SESSION[image4];
   $img5=$_SESSION[image5];
   $img6=$_SESSION[image6];
   $img7=$_SESSION[image7];
   $shipping_route=$_SESSION[shipping_route];
   $shipping_amt=$_SESSION[shipping_amt];
   $tax=$_SESSION[tax];
   //payment
  $payment=$_SESSION[payment];
  $payname=$_SESSION[payname];
  $payid=$_SESSION[payid];
  $repost=$_SESSION[repost];
  $subtitle=$_SESSION[subtitle];
  $returns_accepted=$_SESSION[returns_accepted];
  $refund_method=$_SESSION[refund_method];
  $payment_instructions=$_SESSION[payment_instructions];
  $listingdesinger=$_SESSION[listingdesinger];
  $privatelistings=$_SESSION[privatelistings];
  $returnpolicy_instructions=$_SESSION[returnpolicy_instructions];
  $refund_days=$_SESSION[refund_days];
  $Gallery=$_SESSION[Gallery];
   $Border=$_SESSION[Border];
   $Highlight=$_SESSION[Highlight];
   $Bold=$_SESSION[Bold];
   $Home=$_SESSION[Home];
   $repost=$_SESSION[repost];
   $Insertion_fee=$_SESSION[Insertionfee];
   $itemcondition=$_SESSION[itemcondition];
 $item_counter_style=$_SESSION[item_counter_style];
 
  function addDay($date,$interval) 
  { 
  if (!isset($date)) 
  $date = date("Y-m-d"); 
  $elts = explode("-", $date); 
  $inter=$interval*24*3600; 
  $dcour=mktime(1,0,0,$elts[1],$elts[2],$elts[0]); 
  $dres=$dcour+$inter; 
  $date1=date("Y-m-d",$dres);
  $sec=date("G:i:s");
  $ret_date="$date1"." "."$sec";
  return $ret_date; 
}
   if($_SESSION[mode]!="repost" or $_SESSION[mode]="relist")
   {
   $bidding_start_date=date("Y-m-d");
   $bidding_start_date = addDay($bidding_start_date,$start_delay); 
   $interval =$dur +$start_delay;
   $expire_date = addDay($bidding_start_date,$interval); 
   $Gallery=$_SESSION[Gallery];
   $Border=$_SESSION[Border];
   $Highlight=$_SESSION[Highlight];
   $Bold=$_SESSION[Bold];
   $Home=$_SESSION[Home];
   $repost=$_SESSION[repost];
   $Insertion_fee=$_SESSION[Insertionfee];
   $itemcondition=$_SESSION[itemcondition];
   
$fee_sql="select * from admin_rates";
$fee_res=mysql_query($fee_sql);
$fee_row=mysql_fetch_array($fee_res);
if($_SESSION[Gallery])
$gallery_price=$fee_row[gallery_price];
if($_SESSION[Highlight])
$highlight_price=$fee_row[highlight_price];
if($_SESSION[Bold])
$bold_price=$fee_row[bold_price];
if($_SESSION[Home])
$homepage_price=$fee_row[homepage_price];
$insertion_fee=$fee_row[Insertion_fee];
   
  
$auction_query1="select * from admin_settings where set_id=42";
$table1=mysql_query($auction_query1);
$row1=mysql_fetch_array($table1);
$bid_permission1=$row['set_value'];
if($bid_permission1=="no")
{

	$qry="select * from bid_increment";
	$res=mysql_query($qry);
	while($fetch=mysql_fetch_array($res))
	{
		if($min_amt>=$fetch['bid_from'] && $min_amt<=$fetch['bid_to'])
		{
			$bid_inc=$fetch['bid_inc'];
			break;
		}
	}
}
$currency="$";

if($_SESSION[subcat])
$category_id=$_SESSION[subcat];
else
$category_id=$_SESSION[categoryid];
//$userid=1; 
  //echo "fsdasdf".$_SESSION[item_counter_style];
  $sql="insert into placing_item_bid(user_id,category_id,item_title,quantity,detailed_descrip, currency ,selling_method,min_bid_amount,bid_increment,duration,reserve_price,quick_buy_price,bid_starting_date,picture1,picture2,picture3,picture4,picture5,size_of_quantity,start_delay,expire_date,shipping_route,shipping_cost,status,tax,payment_gateway,payment_name,payment_id,no_of_repost,item_specify,returns_accepted,refund_method,payment_instructions,refund_days,sub_title,returnpolicy_instructions,themes_id,listingdesinger,privatelistings,picture6,picture7,
layout,item_counter_style)";
     $sql.="values($userid,'$category_id','$item_title','$qty','$itemdes','$currency','$sell_method','$min_amt','$bid_inc','$dur','$rev_price','$quick','$bidding_start_date','$img1','$img2','$img3','$img4','$img5','$size_of_qty','$start_delay','$expire_date','$shipping_route','$shipping_amt','Active','$tax','$payment','$payname','$payid','$repost','$itemcondition','$returns_accepted','$refund_method','$payment_instructions','$refund_days','$subtitle','$returnpolicy_instructions','$_SESSION[theme_id]','$listingdesinger','$privatelistings','$img6','$img7',
'$_SESSION[layout]','$item_counter_style')"; 

  $res=mysql_query($sql);  
  if($res)
{
$item_id=mysql_insert_id();
// buyer requiremants
$_SESSION['itemidd']=$item_id;
if($_SESSION[buyerrequirements]=="yes")
{
if($_SESSION[blockbuyercountries])
$blockbuyercountries="Yes";
if($_SESSION[blockbuyerfeedbakscore])
$blockbuyerfeedbakscore="Yes";
if($_SESSION[blockunpaidistrick])
$blockunpaidistrick="Yes";
if($_SESSION[ItemLimit])
$ItemLimit="Yes";
if($_SESSION[feedbackLimit])
$feedbackLimit="Yes";
if($_SESSION[blockmerkatobid])
$blockmerkatobid="Yes";


 $buyer_req="INSERT INTO `buyerblockpreferences` (`blockbuyercountries` , `blockbuyerfeedbakscore` , `blockunpaidistrick` , `ItemLimit` , `feedbackscore` , `feedbackLimit` , `ItemLimitMinFeedback` , `blockmerkatobid` , `ItemLimitoption` , `item_id` ) VALUES('$blockbuyercountries','$blockbuyerfeedbakscore','$blockunpaidistrick','$ItemLimit', '$_SESSION[feedbackscore]','$feedbackLimit','$_SESSION[ItemLimitMinFeedback]','$blockmerkatobid', '$_SESSION[ItemLimitoption]', '$item_id')";
$buyer_res=mysql_query($buyer_req);  

}

/// end of buyer requirements 


// featured items 
$user="select * from user_registration where user_id=$_SESSION[adminuser]";
$user_res=mysql_query($user);
$user_row=mysql_fetch_array($user_res);
//if($user_row[member_account]==3)
//{
   
if(!empty($Highlight) || !empty($Border) || !empty($Bold) || !empty($Gallery) || !empty($_SESSION[subtitle]) || !empty($Home))
{ 
   $feature_sql="insert into featured_items(item_id,gallery_feature,home_feature,bold,border,highlight,subtitle_feature)";
   $feature_sql.="values($item_id,'$Gallery','$Home','$Bold','$Border','$Highlight','$Subtitle')";
   $feature_res=mysql_query($feature_sql);
}   
 
 


//}

$cat_sql="select * from cat_slave where category_id=$cat_id";
$res=mysql_query($cat_sql);
$row=mysql_fetch_array($res);
$tablename=$row[tablename];
$file_path=$row[file_path];
  if($tablename)
   { 
     	$tab_sql="select * from $tablename";
        $tab_res=mysql_query($tab_sql);
        $i =2; 
		$j=3;
		$in_sql="insert into $tablename(item_id,";
		$in_sql_value="values(' $item_id ', ";
 while ($i < mysql_num_fields($tab_res))
{
    $tab_col = mysql_fetch_field($tab_res, $i);
	$dummy=$tab_col->name;
	$in_sql.="$dummy ,";
	//if($i<$j)
   	$in_sql_value.="'$_SESSION[$dummy]',";
   // echo "sesssion"."<br>". $_SESSION[third]."<br>";
	$i++;
	// $j++;
}
$in_sql=rtrim($in_sql,", "); 
$in_sql_value=rtrim($in_sql_value,", "); 
$in_sql.=")".$in_sql_value.")";
$in_res=mysql_query($in_sql);
}
//$sucess=1;
} //if($res)
} //
if($res)
 $sucess=1;
 else
 $fail=1;
 } 
if($sucess==1)
{

$_SESSION[des]="";
$_SESSION[sell_method]="";
$_SESSION[currency]="";
$_SESSION[min_amt]="";
 $_SESSION[quick_price] ="";
$_SESSION[rev_price]="";
$_SESSION[bid_inc]="";
$_SESSION[size_of_qty]="";
$_SESSION[qty]="";
$_SESSION[start_delay]="";
$_SESSION[image1]="";
$_SESSION[image2]="";
$_SESSION[image3]="";
$_SESSION[shipping_route]="";
$_SESSION[shipping_amt]="";
$_SESSION[tax]="";
$_SESSION[mode]="";
$_SESSION[Gallery]="";
$_SESSION[Border]="";
$_SESSION[Highlight]="";
$_SESSION[Bold]="";
$_SESSION[Home]="";
$_SESSION[repost]="";
$_SESSION[dur] ="";
$_SESSION[categoryid]="";
$_SESSION[subtitle]="";
$_SESSION[returns_accepted]="";
$_SESSION[refund_method]="";
$_SESSION[payment_instructions]="";
$_SESSION[listingdesinger]="";
$_SESSION[privatelistings]="";
$_SESSION[returnpolicy_instructions]="";
$_SESSION[refund_days]="";
$_SESSION[image4]="";
$_SESSION[image5]="";
$_SESSION[image6]="";
$_SESSION[image7]="";
$_SESSION[buyerrequirements]="";
$_SESSION[layout]="";
$_SESSION[theme_id]="";
$_SESSION[blockbuyercountries]="";
$_SESSION[blockunpaidistrick]="";
$_SESSION[ItemLimit]="";
$_SESSION[feedbackLimit]="";
$_SESSION[blockmerkatobid]="";
$_SESSION[addtional_pic_fee]="";
$_SESSION[subcat]="";
$_SESSION[item_counter_style]="";
if($tablename)
  {
  $tab_sql="select * from $tablename";
  $tab_res=mysql_query($tab_sql);
  $i =2;
while ($i < mysql_num_fields($tab_res))
{
    $tab_col = mysql_fetch_field($tab_res, $i);
    if (!$tab_col) 
	{
        echo "";
    }
	else
	{
	  $dummy="$".$tab_col->name;
      $dummy=$_POST[$tab_col->name];
	  $_SESSION[$tab_col->name]="";		
    }
	$i++;
} // while
} // if($tablename)
} // if($sucess==1)

   $Gallery=$_SESSION[Gallery];
   $Border=$_SESSION[Border];
   $Highlight=$_SESSION[Highlight];
   $Bold=$_SESSION[Bold];
   $Home=$_SESSION[Home];
   $repost=$_SESSION[repost];
   $Insertion_fee=$_SESSION[Insertionfee];
   $itemcondition=$_SESSION[itemcondition];




require'templates/preview.tpl';
?>
</table>
<tr><td> <?php require 'include/footer.php'; ?></td></tr>
<script language="JavaScript">
function cancel()
{
var where_to= confirm("Are U Sure U Want to cancel the items?");
if (where_to== true)
 {
 window.location="index.php";
 //document.preview.submit();
 }
}
</script>