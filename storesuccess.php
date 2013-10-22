<?php
/***************************************************************************
 *File Name				:storesuccess.php
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
 
****************************************************************************/
session_start();
require 'include/connect.php';
require 'include/detail_top.php';

        $mode=$_REQUEST['mode'];  
		$amount=$_SESSION['amount'];
		$payment_gateway=$_REQUEST['payid'];
		$userid=$_SESSION['userid'];
		$storeid=$_SESSION['store_id'];
		$feetype=$_SESSION['fee_type'];
				
		//echo "<br>amount $amount,$paid_amount";
		if($payment_gateway=="3")
   	   {
			$paid_amount=$_POST['PAYMENT_AMOUNT'];
			$batch_number=$_POST['PAYMENT_BATCH_NUM'];	
			$payer_account=$_POST['PAYER_ACCOUNT'];
		}
		if($payment_gateway=="2")
		{
			$paid_amount=$_POST['AMOUNT'];
			$batch_number=$_POST['TRANSACTION_ID'];	
			$buyer_accountid=$_POST['BUYERACCOUNTID'];
		}
		if($payment_gateway=="1") 
		{
			$paid_amount=$_POST['mc_gross'];
			$batch_number=$_POST['txn_id'];	
		}
		if($payment_gateway=="6")
		{
			$paid_amount=$_POST['AMOUNT'];
			$batch_number=$_POST['TRANSACTION_ID'];	
			$buyer_accountid=$_POST['PAYER_NAME'];
		}
		if($payment_gateway=="5") 
		{
			$paid_amount=$_POST['AMOUNT'];
			$batch_number=$_POST['TRANSACTION_ID'];	
			$buyer_accountid=$_POST['ATIP_ACCOUNT'];
		}
		if($payment_gateway=="4") 
		{
			$paid_amount=$_POST['AMOUNT'];
			$batch_number=$_POST['TRANSACTION_ID'];	
		}
		
     
		$trans_date=date('Y-m-d');	
	
		 if($amount==$paid_amount)
		{ 
		$start_date=date("Y-m-d G:i:s");
		$start_date1=date("Y-m-d");
		$plan_sql="select * from plan where plan_id=".$_SESSION['planid'];
		$plan_qry=mysql_query($plan_sql);
		$plan_row=mysql_fetch_array($plan_qry);
		$dur=$plan_row[period];
		$interval=$dur;
		if($plan_row['period_type']==1)
		{
		$day_sql="select date_add('$start_date1', interval '$dur' day) as day";
		$day_qry=mysql_query($day_sql);
		$day_row=mysql_fetch_array($day_qry);
		$expire_date=$day_row['day'];
		}
		if($plan_row['period_type']==2)
		{
		$month_sql="select date_add('$start_date1', interval '$dur' month) as month";
		$month_qry=mysql_query($month_sql);
		$month_row=mysql_fetch_array($month_qry);
		$expire_date=$month_row['month'];
		}
		if($plan_row['period_type']==3)
		{
		$year_sql="select date_add('$start_date1',interval '$dur' year) as year";
		$year_qry=mysql_query($year_sql);
		$year_row=mysql_fetch_array($year_qry);
		
		$expire_date=$year_row['year'];
		}
		
		if($mode=='rn')
		{
		$up_store="update storefronts set status='enable',statususer='active' where id=".$storeid;
		$up_store_query=mysql_query($up_store);
		
		$insert_query="insert into pay_transaction(trans_amount,user_id,trans_batchnumber,trans_date,trans_type) values('$amount','$userid','$batch_number','$trans_date','Store renew')";	
		$insert_result=mysql_query($insert_query);
		
		$up_store="update storefronts set store_start_date='$start_date',store_end_date='$expire_date' where id=".$storeid;
		$up_store_query=mysql_query($up_store);
		}
		else
		{
		$query="insert into storefronts (user_id,logo,description,store_name,status,planid,store_start_date,store_end_date)values('".$_SESSION[userid]."','".$_SESSION[logo1]."','".$_SESSION[itemdes]."','".$_SESSION[storename]."','enable','".$_SESSION[planid]."','$start_date','$expire_date')";
      mysql_query($query);
		  
	    $insert_query="insert into pay_transaction(trans_amount,user_id,trans_batchnumber,trans_date,trans_type) values('$amount','$userid','$batch_number','$trans_date','$feetype')";	
			$insert_result=mysql_query($insert_query);
	   }
			$sucess_flag=1;
		}
		else
		{
		   $failureflag=1;
		} 
		$_SESSION['amount']='';
		$_SESSION['item_id']='';
		$_SESSION['payment_gateway']='';
		$_SESSION['store_id']=" ";
		$_SESSION['logo1']='';
		$_SESSION['itemdes']='';
		$_SESSION['storename']='';
		$_SESSION['planid']='';
		
	//c }
	//c else $failureflag=1;
	require 'templates/success_payment.tpl';
		require 'include/footer.php';
?>
