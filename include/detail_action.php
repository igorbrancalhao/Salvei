<?php $item_id=$_POST['item_id'];
$max_bid=$_POST['max_bid'];
$chk=$_GET['chk'];
$qty=$_POST['qty'];
$user_id=$_SESSION['userid'];

if(empty($_SESSION['userid']))
{
 echo '<meta http-equiv="refresh" content="0;url=signin.php?url=buyconfirm.php&item_id='.$item_id.'&mode=buy">';
 echo "<font size=+1 color=#003366>Loading....</font>"; 
 exit();
}
else if($_SESSION['userid']) 
{
 //fetch site name 
$query="select * from admin_settings where set_id = 1";
$table=mysql_query($query);
$row=mysql_fetch_array($table);
$site_name = $row['set_value'];

//fetching admin mail id;
$query="select * from admin_settings where set_id = 3";
$table=mysql_query($query);
$row=mysql_fetch_array($table);
$admin_mail_id = $row['set_value'];

//Fetching mail header image
$queryheader="select * from admin_settings where set_id = 61";
$tableheader=mysql_query($queryheader);
$rowheader=mysql_fetch_array($tableheader);
$mailheader =$site_name."/".$rowheader['set_value'];

//Fetching mail footer image
$queryfooter="select * from admin_settings where set_id = 62";
$tablefooter=mysql_query($queryfooter);
$rowfooter=mysql_fetch_array($tablefooter);
$mailfooter =$site_name."/".$rowfooter['set_value'];

 $member_acc="select * from user_registration where user_id=".$_SESSION['userid'];
 $memebr_rec=mysql_query($member_acc);
 $member_res=mysql_fetch_array($memebr_rec);
 $sql_user1="select * from placing_item_bid where item_id=$item_id";
 $res_user1=mysql_query($sql_user1);
 $row=mysql_fetch_array($res_user1);

if(isset($user_id))
{
if($row['user_id']==$user_id)
{
$err_flag=1;
$warning="You are the Seller for this item.You can't bid for this item.";
}

else if($row['user_id']!=$user_id)
{
$sell_method=$_POST['sell_method'];
if($sell_method=="fix")
{
$date1=date('Y-m-d');
$ex="select * from placing_bid_item where user_id=$user_id and item_id=$item_id and deleted='No'";
$ex_res=mysql_query($ex);
$ex_row=mysql_num_rows($ex_res);
$fix=$row[quick_buy_price];
$bid_ins="insert into placing_bid_item(item_id,user_id,bidding_amount,bidding_date,quantity) values('$item_id','$user_id','$fix','$date1','$qty')";
$ins=mysql_query($bid_ins);
$alert_ins="insert into user_alert(item_id,seller_id,buyer_id,date,alert_type) values($item_id,$row_user[user_id],$_SESSION[userid],'$date1','R')";
$alert_exe=mysql_query($alert_ins);
$solddate=date("Y-m-d G:i:s");
 
// update placing_item_bid; 
$query="select * from placing_item_bid where item_id='$item_id'";
$table=mysql_query($query);
if($row=mysql_fetch_array($table))
{
$quantity=$row['Quantity'];
}
if($quantity==1)
{
 $query="update placing_item_bid set status='Closed',Quantity='0',quantity_sold='$qty',sale_price=$fix where item_id='$item_id'";
 mysql_query($query);
}
else if($quantity >  1)
{
 $query="update placing_item_bid set status='Closed',Quantity='0',quantity_sold='$qty',sale_price=$fix where item_id='$item_id'";
 mysql_query($query);
}

$update_bid="update placing_bid_item set user_pos='Yes',sale_date='$solddate' where item_id='$item_id' and user_id=$user_id";
mysql_query($update_bid);

$up_del="delete from want_it_now where responseed_itemid=".$item_id;
$upsql_del=mysql_query($up_del);




 /// -------------------------------  final sale value fee calculation ----------------------------------



        $finalvalue_admin_sql="select * from admin_settings where set_id=56"; //sitename -> id=1
	    $finalvalue_admin_res=mysql_query($finalvalue_admin_sql);
	    $finalvalue_admin_rec=mysql_fetch_array($finalvalue_admin_res);
	    $finalvaluefeecalculation=$finalvalue_admin_rec['set_value'];

        if($finalvaluefeecalculation=="Yes" || $finalvaluefeecalculation=="yes")
        {
	    $closing_price=$fix*$qty;
		$endfee_qry="select * from finalsalevalue_feemaster where $closing_price between closingprice_from and closingprice_to";
		$endfee_exeqry=mysql_query($endfee_qry);
		$endfee_row=mysql_num_rows($endfee_exeqry);
		if($endfee_row>0)
		{
		$endfee_fetch=mysql_fetch_array($endfee_exeqry);
		$endfee_per=$endfee_fetch['percentage'];
		}
		else
		{
		$endfee_qry="select * from finalsalevalue_feemaster order by fid desc";
		$endfee_exeqry=mysql_query($endfee_qry);
		$endfee_fetch=mysql_fetch_array($endfee_exeqry);
		$endfee_per=$endfee_fetch['percentage'];
		}
		
		$final_fee=($closing_price*$endfee_per)/100;
		
			
		$auctionfees_sql="select * from auction_fees where item_id='$item_id'";
		$auctionfees_sqlqry=mysql_query($auctionfees_sql);
		$auctionfees_row=mysql_num_rows($auctionfees_sqlqry);
		if($auctionfees_row>0)
		{
		$ins_final_sql="update auction_fees set finalsalevalue_fee='$final_fee' where item_id='$item_id'";
        mysql_query($ins_final_sql);
		}
		else
		{
        $ins_final_sql="insert into auction_fees(finalsalevalue_fee,item_id) values('$final_fee','$item_id')";
		mysql_query($ins_final_sql); 
		}
        } 

  /// ------------------------------- end of final sale value fee calculation ----------------------------------


// Winning mail to buyer  //


$query="select * from mail_subjects where mail_id=5";
$table=mysql_query($query);
$row_mail1=mysql_fetch_array($table);
$subject = $row_mail1['mail_subject'];
$message = $row_mail1['mail_message'];
$mail_from= $row_mail1['mail_from'];


//fetching user mail id;
$query="select * from user_registration where user_id = ".$_SESSION['userid'];
$table=mysql_query($query);
$row_buyer=mysql_fetch_array($table);
$mail_to = $row_buyer['email'];
$country_sql="select * from country_master where country_id=".$row_buyer['country'];
$country_sqlqry=mysql_query($country_sql);
$country_fetch=mysql_fetch_array($country_sqlqry);
$country=$country_fetch['country'];
// End of fetching user_mail id //

$item_detail_query="select * from placing_item_bid where item_id =".$item_id;
$item_detail_table=mysql_query($item_detail_query);
$item_detail_row=mysql_fetch_array($item_detail_table);

$message=str_replace("NAME" , $_SESSION['username']	,$message);
$message=str_replace("<ITEM_TITLE>" , $item_detail_row['item_title'] , $message);
$message=str_replace("<cur>" , $item_detail_row['currency'], $message);
$message=str_replace("<SALE_PRICE>" , $item_detail_row['quick_buy_price'], $message);
$message=str_replace("<QUANTITY>" , $qty , $message);
$message=str_replace("<SHIPPING_COST>" , $item_detail_row['currency']." ".$item_detail_row['shipping_cost'] , $message);
$message=str_replace("<SALE_TAX>" , $item_detail_row['tax']."%" , $message);
$message=str_replace("<GET_VIEW_ITEM>" , "$site_name/detail.php?item_id=".$item_id , $message);
$message=str_replace("<sitename>" , $site_name , $message);
$message=str_replace("<imgh>" , $mailheader , $message);
$message=str_replace("<imgf>" , $mailfooter , $message);

$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ".$mail_from."\n";
$mail=mail($mail_to,$subject,$message,$headers);
//End of winning bid mail to buyer // 


// mail_to seller;

$query="select * from mail_subjects where mail_id=8";
$table=mysql_query($query);
if($row_mail=mysql_fetch_array($table))
{
$message = $row_mail['mail_message'];		
$subject=$row_mail['mail_subject'];  
$mail_from=$row_mail['mail_from'];  
}
		  		  
$query="select * from user_registration where user_id =".$row['user_id'];
$table=mysql_query($query);
$row=mysql_fetch_array($table);
$seller_name=$row['user_name'];
$seller_email=$row['email']; 
$mail_to=$seller_email;
$buyer_detail="<tr><td>Buyer Name</td><td> $_SESSION[username] </td></tr>";
$buyer_detail.="<tr><td>Quantity</td><td>$qty</td></tr>";
$buyer_detail.="<tr><td>Price</td><td>".$item_detail_row['currency']." ".$item_detail_row['quick_buy_price']."</td></tr>";
$buyer_detail.="<tr><td>Buyer Address</td><td>".$row_buyer['address']."<br>".$row_buyer['city']."<br>".$row_buyer['state']."<br>$country";
$buyer_detail.="<br>".$row_buyer['pin_code']."</td></tr>";
$buyer_detail.="<tr><td>Buyer mailid</td><td>".$row_buyer['email']."</td></tr>";
$message=str_replace("<sellername>" , $seller_name , $message);
$message=str_replace("<itemname>" , $item_detail_row['item_title'] , $message);
$message=str_replace("<itemid>" , $item_id , $message);
$message=str_replace("<Buyer Details>" , $buyer_detail , $message);
$message=str_replace("<sitename>" , $site_name , $message);
$message=str_replace("<imgh>" , $mailheader , $message);
$message=str_replace("<imgf>" , $mailfooter , $message);

$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ".$mail_from."\n";

$mail=mail($mail_to,$subject,$message,$headers);


 /// -------------------   mail send to seller    --------------------------------------------------------------------------------
 
   $date=date("Y-m-d");
   $inbox_sql="insert into ask_question(from_id,item_id,date,question,to_id,status) values('1','$item_id','$date','$message','$seller_id','notification')";
   mysql_query($inbox_sql);

 
 
  /// -------------------   mail send to seller    --------------------------------------------------------------------------------




if($ins or $exe)
{
echo '<meta http-equiv="refresh" content="0;url=detail.php?item_id='.$item_id.'&mode=ss">';
exit();
}
} 
} //else if($_SESSION[userid]) 
} //else 
}
?>