<?php
/***************************************************************************
 *File Name				:pay.php
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
session_start();
error_reporting(0);
require 'include/connect.php';
if(!isset($_SESSION['userid']))
{ 
	$link="signin.php";
	$url="pay.php";
	echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
	echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
	exit();
}
$user_id=$_SESSION['userid'];
$pay_delete=$_REQUEST['pay_delete'];



// -------------- Delete Selling items--------------------------

if($pay_delete=="yes")
{
  
    $items=$_POST['chkbox'];
	$count=count($items);
	$item_id=$_REQUEST['item_id'];
    if($count!=0)
    {
		foreach($items as $item)
   		{
	 		$pay_up="delete placing_item_bid  where item_id=$item";
	 	  	mysql_query($pay_up);
     	}   
	}
	else
	{
		$item_id=$_REQUEST['item_id'];
		$pay_up="delete from placing_item_bid  where item_id=$item_id";
		$pay_res=mysql_query($pay_up);
	} 
}

// -------------- end of Delete Selling items--------------------

 $pay_sql="select * from placing_item_bid where user_id=$user_id and status='new'";
 $pay_res=mysql_query($pay_sql);
 $pay_total_records=mysql_num_rows($pay_res);


 
$title="Payment";
require 'include/detail_top.php';
require 'templates/pay.tpl';
require 'include/footer.php';
 ?>

<script language="javascript">
function pay_selectall()
 {
    len=document.pay_frm.len.value;
	if(len==1)
	 {
     
	if(document.pay_frm.chkMain.checked==true) 
				document.pay_frm.chkbox.checked=true;
		if(document.pay_frm.chkMain.checked==false)
			document.pay_frm.chkbox.checked=false;
	}
		else
	 {
	 		for(i=0;i<len;i++)
		 {
	    if(document.pay_frm.chkMain.checked==true)
			document.pay_frm.chkbox[i].checked=true;
		if(document.pay_frm.chkMain.checked==false)
			document.pay_frm.chkbox[i].checked=false;     
		}
	}
	
}

function go_page_link(action_id,id,seller_id)
{
if(action_id==5)
{
var where_to= confirm("Are U Sure U Want to delete the items?");
if (where_to== true)
 {
document.pay_frm.pay_delete.value="yes";
document.pay_frm.item_id.value=id;
document.pay_frm.action="pay.php";
document.pay_frm.submit();
 }
}
if(action_id==4)
{
document.pay_frm.item_id.value=id;
document.pay_frm.action="reviewpaymentdetails.php";
document.pay_frm.submit();
}
if(action_id==6)
{
document.final_frm.item_id.value=id;
document.final_frm.fee_id.value=seller_id;
document.final_frm.action="payfinalsale.php";
document.final_frm.submit();
} 

}


function del()
{
 var where_to= confirm("Are U Sure U Want to delete the items?");
 if (where_to== true)
 {
 document.pay_frm.pay_delete.value="yes";
 document.pay_frm.submit();
 }
}
</script>
</body>
</html>