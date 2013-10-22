<?php
/***************************************************************************
 *File Name				:bidding.tpl
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
  <tr align="center" ><td valign="top">
  <table class="table_border1">
  <tr class="mylist" align="center" height=30><td><b><font size=3>Warning</font></b></td></th>
  <tr><td>
  <br>
  <br>
  <br>
   <font color="red" size=2> <?= $warning; ?></font>
   <br>
  <br>
  <br>
  </td></tr></table>
   <br>
  <br>
  <br>
  
  </td></tr>
    <tr><td> <br>
	<br><? require 'include/footer.php';?></td></tr>
	</table>
<?
exit();
}
}
} //if($_SESSION[userid])
$sql_user="select * from placing_item_bid where item_id=$item_id";
$res_user=mysql_query($sql_user);
$row_user=mysql_fetch_array($res_user);
if($row_user[selling_method]=="auction" or $row_user[selling_method]=="dutch_auction")
{
// echo"inside";
?>
<?
$bid_sql="select * from placing_bid_item where item_id=".$item_id;
$bid_res=mysql_query($bid_sql);
$bid_row=mysql_fetch_array($bid_res);

if(!empty($bid_row[item_id]))
{
$bid_sql1="select MAX(duplicate_bidding_amt) as amt from placing_bid_item where item_id=".$item_id;
$bid_res1=mysql_query($bid_sql1);
$bid_row1=mysql_fetch_array($bid_res1);
$max_bid_amt_dis=$bid_row1['amt'];
 $noofbids=mysql_num_rows($bid_res);
 // $max_bid_amt_dis=(($noofbids+1)*$row_user['bid_increment'])+$row_user[min_bid_amount];
}
else
{
$max_bid_amt_dis=$row_user['min_bid_amount'];
}

if($flag==1)
{
if(isset($user_id))
{
 if($row_user[user_id]==$user_id)
{
$err_flag=1;
$select_sql="select * from error_message where err_id =34";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err_message= '<b>'.$select_row[err_msg].'</b>';

//$err="You are the Seller for this item.You can't bid for this item."; ?>
 <? 
  }
 else if($row_user[user_id]!=$user_id)
{
$bid_sql="select * from placing_bid_item where item_id=".$item_id;
$bid_res=mysql_query($bid_sql);
$bid_row=mysql_fetch_array($bid_res);
    if(!empty($bid_row[item_id]))
{
$bid_sql1="select MAX(bidding_amount) as amt from placing_bid_item where item_id=".$item_id;
$bid_res1=mysql_query($bid_sql1);
$bid_row1=mysql_fetch_array($bid_res1);
$max_bid_amt=$bid_row1['amt']+$row_user['bid_increment'];
}
else
{
$max_bid_amt=$row_user[min_bid_amount]+$row_user['bid_increment'];
}
if(!is_numeric($max_bid))
{
//$err="Your Bid Amount is Invalid";
$err_flag=1;

$select_sql="select * from error_message where err_id =27";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err_message= '<b>'.$select_row[err_msg].'</b>';
} //if(!is_numeric($max_bid))
} //else if($row_user[user_id]!=$user_id)

if($flag==1)
{
$bid_sql_max="select MAX(bidding_amount) as amt from placing_bid_item where item_id=".$item_id;
$bid_res_max=mysql_query($bid_sql_max);
$bid_row_max=mysql_fetch_array($bid_res_max);
$max_item_bid=$bid_row_max['amt'];

if(!empty($max_item_bid))
{
$bid_sql2="select MAX(bidding_amount) as amt from placing_bid_item where user_id=$user_id and item_id=".$item_id;
$bid_res2=mysql_query($bid_sql2);
if(mysql_num_rows($bid_res2)>0)
{
$bid_row2=mysql_fetch_array($bid_res2);
$user_bid_amt=$bid_row2['amt'];
}
// $bid_row=mysql_fetch_array($bid_res);
if($max_item_bid==$user_bid_amt)
 {
 $select_sql="select * from error_message where err_id =35";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err= '<b>'.$select_row[err_msg].'</b>';
 $err_flag=1;
 }
 }// if(!empty($max_item_bid))
 } //  if($flag==1)
 $err_flag;
if($err_flag!=1)
{
if($max_bid>=$max_bid_amt)
{
$date1=date('Y-m-d');
$ex="select * from placing_bid_item where user_id=$user_id and item_id=$item_id";
$ex_res=mysql_query($ex);
$ex_row=mysql_num_rows($ex_res);
 if(empty($ex_row))
{
  $bid_ins="insert into placing_bid_item(item_id,user_id,bidding_amount,bidding_date,quantity) values($item_id,$user_id,$max_bid,'$date1',$qty)";
  $ins=mysql_query($bid_ins);
}
 else
{
 $bid_up="update placing_bid_item set bidding_amount=$max_bid, bidding_date='$date1',quantity=$qty where user_id=$user_id and item_id=$item_id";
 $exe=mysql_query($bid_up);
}
// check the bid
$chk=$_POST['chk'];
if ($chk=='chk') 
{
 $updsql="update placing_bid_item set checkbid='yes' where item_id=$item_id and user_id=$user_id";
 $updexe=mysql_query($updsql);
}

//

if($row_user[reserve_price])
{
 if($row_user[reserve_price] <= $max_bid)
 {
$reserve_query="select * from mail_subjects where mail_id=9";
$reserve_table=mysql_query($reserve_query);
if($reserve_row=mysql_fetch_array($reserve_table))
{
$message = $reserve_row[mail_message];		
$subject=$reserve_row['mail_subject'];  
}
$query="select * from user_registration where user_id =". $row_user[user_id];
$table=mysql_query($query);
if($sell_row=mysql_fetch_array($table))
{
$seller_name=$sell_row['user_name'];
$seller_email=$sell_row['email']; 
} 
$mail_to=$seller_email;
$query="select * from admin_settings where set_id = 3";
$table=mysql_query($query);
if($row=mysql_fetch_array($table))
$admin_mail_id = $row['set_value'];
$buyer_detail="<tr><td>Buyer Name</td><td> $_SESSION[username] </td></tr>";
// $buyer_detail.="<tr><td>Quantity</td><td>$higher_quantity</td></tr>";
$buyer_detail.="<tr><td>Bid Amount</td><td>$$max_bid</td></tr>"; 
$message=str_replace("<sellername>" , $seller_name , $message);
$message=str_replace("<itemname>" , $row[item_title] , $message);
$message=str_replace("<itemid>" , $item_id , $message);
$message=str_replace("<Buyer Details>" , $buyer_detail , $message);
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: ". $admin_mail_id."\r\n";
/* echo "mail to <br>";
echo $mail_to;
echo "<br>";
echo "subject <br>";
echo $subject;
echo "<br>";
echo "message <br>";
echo $message;
echo "<br>";
echo "header <br>";
echo $headers; */
//exit(); 
//$mail=mail($mail_to,$subject,$message,$headers);

}
}
// mail to buyer(outbid)
$sql="select *from placing_bid_item where checkbid='yes' and item_id=$item_id";
$exe=mysql_query($sql);
while($ret=mysql_fetch_array($exe))
{
$sql1="select * from user_registration where user_id=".$ret['user_id'];
$exe1=mysql_query($sql1);

while ($selret=mysql_fetch_array($exe1))
{
$emailid=$selret['email'];
$receiver=$selret['user_name'];
$subject="Another user placed a bid";

$admin="select * from admin_settings where set_id=1";
$admin_res=mysql_query($admin);
$admin_row=mysql_fetch_array($admin_res);
$fromid=$admin_row[set_value];
$message="<table><tr><td>Dear $receiver,</td></tr><tr><td>Your opponant user has bidded more than yours.so proceed your bid further.</td></tr><tr><td>Regards,<br> <?= $_SESSION[site_name]  ?> </td></tr></table>";
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: ". $from."\r\n";
mail($emailid,$subject,$message,$headers);  
}
}
 $alert_ins="insert into user_alert(item_id,seller_id,buyer_id,date,alert_type) values($item_id,$row_user[user_id],'$_SESSION[userid]','$date1','R')";
 $alert_exe=mysql_query($alert_ins);
  echo '<meta http-equiv="refresh" content="0;url=bidconfirm.php?item_id='.$item_id.'&max_bid='.$max_bid.'">';
  echo "<font size=+1 color=#003366>Loading....</font>";
  exit();
}
else //if($max_bid>=$max_bid_amt)
{
if(empty($err))
$err="Please!Choose Maximum Bid Amount";
?>
<!--  <tr><td align="center">
	<font size=2 color=red><? echo $err; ?></font>
	</td></tr> -->
	 <? 
}
} // if($err_flag!=1)
else
{
 $err_flag==0;
}
} // if(isset($user_id))
 /* else
{

 echo '<meta http-equiv="refresh" content="0;url=signin.php?url=bidding.php&item_id='.$item_id.'">';
echo "<font size=+1 color=#003366>Loading....</font>"; 
exit();
} */
}

$sql="select * from placing_item_bid where item_id=$item_id";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$count=$row['Quantity']-$row['quantity_sold'];
?>
<script language="javascript">
function validate()
{
if(document.bid.max_bid.value=="")
{
alert("Please enter the Max bid amount");
document.bid.max_bid.focus();
return false;
}
if(document.bid.qty.value=="Quantity")
{
alert("Please select the Quantity");
document.bid.qty.focus();
return false;
}
document.bid.flag.value=1;
return true;
}

function quick(s1)
{
//window.location.href="quick.php?item_id="+s1;
if(document.bid.qty.value=="Quantity")
{
alert("Please select the Quantity");
document.bid.qty.focus();
return false;
}
document.bid.action="quick.php";
document.bid.submit();
}
</script>
<html>
<head>
<title><?= $_SESSION[site_name]  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<center>
<table width="100%" border="0" cellpadding="5" cellspacing="0" align="center" class="table_border">
  <tr>
    <td valign="top">
	<? 
	$title="Bidding";
	require 'include/top.php';?>
	</td>
  </tr>
  <link rel="stylesheet" href="<?= $ret1; ?>" type="text/css">
  <tr><td valign="top">

<tr><td align="center"> <font size="2" color="red"><?= $err; ?></font></td></tr>
<? if($err_message)
 {
 ?>
 <tr><td align="center">&nbsp;
	<font size=2 color="red">
	<? echo $err_message; ?></font>
	</td></tr>
 <?
 }
 ?>
 <form name="bid" action="<? $_SERVER['PHP_SELF']; ?>" onSubmit="return validate()"  method=post> 
 <tr><td>
 <table width="100%" border="0"  cellspacing="15" align="center" class="">
<th  colspan="6" ><font size="3"><b><div align="left">
Place a Bid </div> </b></font> </th>
   <tr>
    <td >Current Bid:</td>
    <td align="left"><? echo $row_user[currency]." ".$max_bid_amt_dis;?></td>
  </tr>
  
  <tr>
              <td > Bid Increment:</td>
    <td><? echo $row_user[currency]." ".$row['bid_increment']; ?></td>
  </tr>

  <tr>
    <td>Your Maximum Bid</td>
	<td><input type="text" name="max_bid"></td></tr>
		 <tr><td>&nbsp;</td>
		 <td>( Minimum Bid:<? echo $row_user[currency]." ".($max_bid_amt_dis+$row['bid_increment']); ?> )</td>
		 </tr>
	<tr bgcolor="#F5F5F5">
 <?
 	if($row_user['Quantity'] > 1)
	{ 
	?>
	<tr>
              <td height="27" >Quantity:</td>
    <td align="left"><select name=qty>
	 <option value="Quantity">Quantity</option>
	<? for($i=1;$i<=$row_user[Quantity];$i++)
	{
	 ?>
	 <option value="<?= $i;?>"><?= $i;?></option>
	 <? 
	 }
	 // }// if($row==$user_id)
	 ?></select></td>
  </tr>
  
 <?
     }
	 else
	{ 
	 ?>
		 <input type="hidden" name=qty value=1>
	<?
	}
	 ?>
	<tr><td align="left" colspan="2"><input name="chk" type="checkbox" value="chk">
                Email Remainder</td>
            </tr>

	
	<td colspan="2" align=center>
	<input type="submit" value="Place bid" class=buttonbig>
    <? if(!empty($row_user[reserver_price]))
	{
	?>
                <input name="button" type="button" class=buttonbig onClick=quick("<?= $item_id;?>") value="Quick Buy" > 
    <?
	 }
	 ?>
        <input type="hidden" name=flag value=1>
	    <input type="hidden" name=quick_id value=<?= $item_id; ?> >
		<input type="hidden" name=err_flag value=<?= $err_flag; ?>>
		<input type="hidden" name=quick_qty value=<?= $qty; ?>>
		 	</td></tr>
			
   </table>
   </td></tr>
  </form>
  <tr><td>
<? require 'include/footer.php';?>
</td></tr>
</table>
</body>
</center>
</html>

  <?
  }
  else // if($row_user[selling_method]=="auction")
  {
    require 'fixed_price_sale.php';
   
  }
  ?>