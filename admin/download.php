<?php
/***************************************************************************
 *File Name				:download.php
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
function cleanData(&$str) 
 {
  	$str = preg_replace("/\t/", "\\t", $str);
  	$str = preg_replace("/\n/", "\\n", $str); 
 } 
  	# file name for download 
$filename = "Openedauction" . date('Ymd') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel"); 

 require 'include/connect.php';
 require 'include/getdatedifference.php';  
 $mode=$_REQUEST['mode'];

if($mode=='final')
{
$secsql="select * from pay_transaction where trans_type='Final Sale Value Fee' order by trans_date";
}
else if($mode=='store')
{
$secsql="select * from pay_transaction where (trans_type='Store Fee' || trans_type='Store renew') order by trans_date desc";
}
else
{
$secsql="select * from pay_transaction where trans_type='Featured Listing Fee' order by trans_date";

}
			
		
	 		$res = mysql_query($secsql);
            $num = mysql_num_rows($res);
			
			
			
if($num <= 0) { echo "No Records Found";}
else
{
$i=0;
 while ($row=mysql_fetch_array($res))
{
 


if($mode=='final')
{
 $item_sql="select * from placing_item_bid where item_id=".$row['itemid'];
 $item_sqlqry=mysql_query($item_sql);
 $item_fetch=mysql_fetch_array($item_sqlqry);

 $member_sql="select * from user_registration where user_id=".$item_fetch['user_id'];
 $member_result=mysql_query($member_sql);
 $member_row=mysql_fetch_array($member_result);
 $username=$member_row['user_name'];
 
$val[]= array("Item_name" => $item_fetch['item_title']."(#".$row['itemid'].")", "Amount" => $row['trans_amount'], "Transaction_date" =>  $row['trans_date'], "Sellername" => $username, "Batch No" => $row['trans_batchnumber']);
}
if($mode=='store')
{
 $member_sql="select * from user_registration where user_id=".$row['user_id'];
 $member_result=mysql_query($member_sql);
 $member_row=mysql_fetch_array($member_result);
 $username=$member_row['user_name'];

 $val[]= array("Username" => $username, "Amount" => $row['trans_amount'], "Transaction_date" =>  $row['trans_date'],"Fee Type" => $row['trans_type'],"Batch No" => $row['trans_batchnumber']);
}
else
{
$item_sql="select * from placing_item_bid where item_id=".$row['itemid'];
$item_sqlqry=mysql_query($item_sql);
$item_fetch=mysql_fetch_array($item_sqlqry);

$member_sql="select * from user_registration where user_id=".$item_fetch['user_id'];
$member_result=mysql_query($member_sql);
$member_row=mysql_fetch_array($member_result);
$username=$member_row['user_name'];

$val[]= array("Item_name" => $item_fetch['item_title']."(#".$row['itemid'].")", "Amount" => $row['trans_amount'], "Transaction_date" =>  $row['trans_date'], "Sellername" => $username, "Batch No" => $row['trans_batchnumber']);
}
}


$flag = false;
foreach($val as $row)
	{
	
	  if(!$flag)
	  { 
		# display field/column names as first row 
	  	echo implode("\t", array_keys($row)) . "\n"; $flag = true; 
	  }
		   
	array_walk($row, 'cleanData'); 
	echo implode("\t", array_values($row)) . "\n"; 
		
}
exit;
}
?>