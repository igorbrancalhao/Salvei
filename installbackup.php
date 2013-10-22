<?php
$page=$_POST['page'];

if(!$page)
$page=1;
?>
<style type="text/css">
.subtable{border:1px solid #778DA2;}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>AJ Install Wizard</title>
</head>
<body bgcolor="#d5d5d5" style="margin-top:25px">
<center>
<table width="700px" border="0" background="images/bg_instal.jpg" style="background-repeat:no-repeat" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1" rowspan="3"><img src="images/spacer.gif" / width="1px" height="500px"></td>
    <td width="1"><img src="images/spacer.gif" / width="1px" height="65px"></td>
    <td ><div align="left" style="font-family:Arial; font-size:16px; font-weight:600; padding-top:20px; padding-left:20px">Welcome to AJAuction Installation Wizard </div></td>
  </tr>
  <tr>
    <td width="1"><img src="images/spacer.gif" / width="1px" height="380px"></td>
    <td valign="top"><table width="100%" border="0">
      <tr>
        <td  style="padding-left:12px;" valign="top"><div align="center"><img src="images/img_easy.jpg" width="177" height="259" / style="padding-top:14px; padding-left:12px"></div></td>
        		&nbsp;
			<?php
if($page==1)
{
if(is_readable("key.txt"))
{
$fp=fopen("key.txt","r");
$kval=fread($fp,80);
//echo "<br>keyval ".$kval;
//echo "<br>keyval ".strlen($kval);
fclose($fp);
?>

<td width="74%" rowspan="2" valign="top" align="center" height="259">
<table width="90%" border="0" cellpadding="0" cellspacing="0" height="259">
          <tr>
            <td colspan="2" valign="top"><div align="left" style="font-family:Arial; font-size:14px; font-weight:500; padding-top:15px; padding-bottom:5px; padding-left:10px;">Product Key Validation</div></td>
          </tr>
          <tr>
            <td width="1"><img src="images/spacer.gif" / width="1px" height="280px"></td>
            <td width="447" valign="middle">
<table width="400" align="center">
<form name="frmCheck"  id="frmCheck" action="install.php" method="post" onSubmit="validateKey();">
<Tr><td style="padding-left:10px;">Product Serial Key</td><td align="center"><input type="text" name="txtKey"  id="txtKey" value=""  style="width:35px;" maxlength="4"  onKeyup="checkMe();">-
<input type="text" name="txtKey0"  id="txtKey0" value="" style="width:35px;" maxlength="4"  onKeyup="checkMe();">-
<input type="text" name="txtKey1"  id="txtKey1" value="" style="width:35px;" maxlength="4" onKeyup="checkMe();">-
<input type="text" name="txtKey2"  id="txtKey2" value="" style="width:35px;" maxlength="4" onKeyup="checkMe();"></td></Tr>
<Tr height="100"><td colspan="2" align="right" style="padding-right:15px;" valign="middle">
<input type="hidden" name="page" value="0" id="page"><input type="hidden" name="status"  id="status" value="0" />
<input type="hidden" name="key" value="<?php=$kval;?>" id="key">
<div align="right" style="padding-right:10px">
<input type="image" src="images/btn_next.gif" disabled="disabled" id="btnSubmit" name="btnSubmit" style=" cursor: default;"/>
<img src="images/btn_cancel.gif" width="83" height="33" hspace="3" vspace="3" onClick="window.close();"  style="cursor:pointer"/>
</div>
</td></Tr>
</form>
</table></td></tr></table></td>
<!--</Td></tr>
</form>
</table>-->
<?php
	}	
	else
	{
	?>
	<td width="74%" rowspan="2" valign="top" align="center" height="259">
<table width="90%" border="0" cellpadding="0" cellspacing="0" height="259">
          <tr>
            <td colspan="2" valign="top"><div align="left" style="font-family:Arial; font-size:14px; font-weight:500; padding-top:15px; padding-bottom:5px; padding-left:10px;">Error in File Permission!</div></td>
          </tr>
          <tr>
            <td width="1"><img src="images/spacer.gif" / width="1px" height="280px"></td>
            <td width="447" valign="middle">
	<table align="center" width="400"  cellpadding="0" cellspacing="0" style="padding:1px;">
	<tr><td style="color:red;padding:20px;" >Check File(key.txt) permission. Assign 777 permission to key.txt to avoid error. </td></tr>
	</table></td></tr></table></td>
<?php
	}	
}
else if($page==2)
{
$status=$_POST['status'];
		if($status==1)
		{
?>
<td width="74%" rowspan="2" valign="top" align="center" height="259">
<table width="90%" border="0" cellpadding="0" cellspacing="0" height="259">
          <tr>
            <td colspan="2" valign="top"><div align="left" style="font-family:Arial; font-size:14px; font-weight:500; padding-top:15px; padding-bottom:5px; padding-left:10px;"><b>Database Configuration</b></div></td>
          </tr>
          <tr>
            <td width="1"><img src="images/spacer.gif" / width="1px" height="280px"></td>
            <td width="447" valign="middle">
<table border=0 style="border-collapse: collapse"  cellpadding=5 cellspacing=0 width=400 class=box>
<form name=form1 method=post action="install.php" onSubmit="return validate();">
<!-- <tr><td  colspan=2 class="tdmain"><b>Database Configuration</b></td></tr> -->
	<tr>
		<td>Database Server Hostname / DSN</td>
		<td><input name=txtHostName id="txtHostName"></td>
	</tr>
	<tr>
		<td>Your Database Name</td>
		<td><input name=txtDatabaseName id="txtDatabaseName"></td>
	</tr>

	<tr>
		<td>Database Username</td>
		<td ><input name=txtDatabaseUserName id="txtDatabaseUserName"></td>
	</tr>
	<tr>
		<td>Database Password</td>
		<td><input type=password name=txtDatabasePassword id="txtDatabasePassword"></td><input type="hidden" name="page" value="0" id="page">
	</tr>
<Tr><td colspan="2" align="right"> 	<input type="image" src="images/btn_next.gif"  id="btnSubmit" name="btnSubmit" style=" cursor: pointer;"/>
<img src="images/btn_cancel.gif" width="83" height="33" hspace="3" vspace="3" onClick="window.close();"  style="cursor:pointer"/>
</td></Tr>
	</form></table></td></tr></table></td>


<?php		
	
		}
		else if($status==0)
		{
		?>
		<td width="74%" rowspan="2" valign="top" align="center" height="259">
<table width="90%" border="0" cellpadding="0" cellspacing="0" height="259">
          <tr>
            <td colspan="2" valign="top"><div align="left" style="font-family:Arial; font-size:14px; font-weight:500; padding-top:15px; padding-bottom:5px; padding-left:10px;">License Key Error</div></td>
          </tr>
          <tr>
            <td width="1"><img src="images/spacer.gif" / width="1px" height="280px"></td>
            <td width="447" valign="middle">
		<table align="center" width="400">
	<tr><td style="color:red; padding:20px;">Invalid Product License Key. Please contact Vendor for further detail.</td></tr>
	</table></td></tr></table></td>
		
		
		
		<?php
		}
}
else if($page==3)
{

?>
<td width="74%" rowspan="2" valign="top" align="center" height="259">
<?php
if(is_readable("key.txt"))
{
$fp=fopen("key.txt","r");
$dval=fread($fp,filesize("key.txt"));
//echo "<br>".$dval;
$l=strlen(substr($dval,80))-2;
//$dval=substr($dval,82,$l-1);
$dval=substr($dval,81,$l);
//echo "<br>=".$dval."=".strlen($dval);
fclose($fp);
}
?>
<input type="hidden" name="hdomain" value="<?php=$dval;?>"  id="hdomain" />
<table width="90%" border="0" cellpadding="0" cellspacing="0" height="259">
          <tr>
            <td colspan="2" valign="top"><div align="left" style="font-family:Arial; font-size:14px; font-weight:500; padding-top:15px; padding-bottom:5px; padding-left:10px;"><b>Admin Configuration</b></div></td>
          </tr>
          <tr>
            <td width="1"><img src="images/spacer.gif" / width="1px" height="280px"></td>
            <td width="447" valign="middle">
<table border=0 style="border-collapse: collapse"  cellpadding=5 cellspacing=0 width=400 class=box>
<form name=form2 method=post action="install.php" onSubmit="return validate1();">
<tr>
		<td>Domain Name</td>
		<td><input name=txtDomainName id="txtDomainName"></td>
	</tr>
	<tr>
		<td>Admin Email Address</td>
		<td><input name=txtAdminEmail id="txtAdminEmail"></td>
	</tr>
	<tr>
		<td>Admin Username</td>
		<td><input name=txtUserName id="txtUserName"></td>
	</tr>
	<tr>
		<td>Admin Password</td>
		<td><input type=password name=txtPassword id="txtPassword"></td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td><input type=password name=txtConfirmPassword id="txtConfirmPassword"><input type="hidden" name="page" value="0" id="page">
		<input type="hidden" name="txtHostName" value="<?php=$_POST['txtHostName'];?>" id="txtHostName" />
		<input type="hidden" name="txtDatabaseName" value="<?php=$_POST['txtDatabaseName'];?>" id="txtDatabaseName" />
		<input type="hidden" name="txtDatabaseUserName" value="<?php=$_POST['txtDatabaseUserName'];?>"  id="txtDatabaseUserName"/>
		<input type="hidden" name="txtDatabasePassword" value="<?php=$_POST['txtDatabasePassword'];?>" id="txtDatabasePassword" />
		
		</td>
	</tr>
<Tr><td colspan="2" align="right"> 	<input type="image" src="images/btn_next.gif"  id="btnSubmit" name="btnSubmit" style=" cursor: pointer;" onClick="validateDomain();"/>
<img src="images/btn_cancel.gif" width="83" height="33" hspace="3" vspace="3" onClick="window.close();"  style="cursor:pointer"/>
</td></Tr>
	</form></table></td></tr></table></td>


<?php
}
else if($page==4)
{



    $dhost = $_POST["txtHostName"];
	$dname = $_POST["txtDatabaseName"];
	$duser = $_POST["txtDatabaseUserName"];
	$dpass = $_POST["txtDatabasePassword"];
	
	$domainname = $_POST["txtDomainName"];
	$adminemail = $_POST["txtAdminEmail"];
	$adminuser = $_POST["txtUserName"];
	$password = $_POST["txtPassword"];
	
	
	$site_domain=explode("www.",$domainname);
	$site_domain=$site_domain[2];
	
	
	$con = mysql_connect($dhost,"$duser","$dpass");
	if(mysql_select_db($dname,$con))
	{
$sql="DROP TABLE IF EXISTS error_message";
$result=mysql_query($sql);
$sql="CREATE TABLE error_message (
  err_id int(11) NOT NULL auto_increment,
  program varchar(50) NOT NULL default '',
  err_msg varchar(100) NOT NULL default '',
  PRIMARY KEY  (err_id)
) TYPE=MyISAM";
$result=mysql_query($sql);

$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (1, 'user_reg.php', 'Please check the box to continue.You must agree to our terms of use before you can use our service.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (2, 'user_reg.php', 'Please enter this information.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (3, 'user_reg.php', 'Please enter this information.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (4, 'user_reg.php', 'Please enter this information.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (5, 'user_reg.php', 'Please enter this information')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (6, 'user_reg.php', 'Please enter this information.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (7, 'user_reg.php', 'Your Primary Phoneno is invalid')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (8, 'user_reg.php', 'Please enter this information')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (9, 'user_reg.php', 'Your Secondary Phoneno is invalid')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (10, 'user_reg.php', 'Please enter this information.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (11, 'user_reg.php', 'Your Email address id invalid')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (12, 'user_reg.php', 'Please enter this information')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (13, 'user_reg.php', 'Your Email address id invalid')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (14, 'user_reg.php', 'Your email entries must match. Please check both.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (15, 'user_reg.php', 'EmailId already exists')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (16, 'user_reg.php', 'Please enter this information.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (17, 'account_reg.php', 'Already Exist!')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (18, 'account_reg.php', 'Please enter this information.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (19, 'account_reg.php', 'Please Choose 6 characters')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message (err_id, program, err_msg) VALUES (20, 'account_reg.php', 'Please Choose 6 characters')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (21, 'user_reg.php', 'Please select this information')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (22, 'user_reg.php', 'Please select this information')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (23, 'user_reg.php', 'Please enter this information')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (24, 'user_reg.php', 'you are too young to sign up!')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (25, 'contact', 'Thank You for your details')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (26, 'comments', 'You Can\'t post a Feedback.Because You didn\'t buy or sell a item! .')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (27, 'classified_ad', 'Your Bid Amount is Invalid')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (28, 'edit_auction', 'No information available')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (29, 'feedback', 'No feedback has been submitted about this Member.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (30, 'endaucation', 'Sorry! You have not efficient amount in your account')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (32, 'watchlist', 'Items Successfully Deleted')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (33, 'watchlist', 'No Items were Selected')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (34, 'bidding', 'You are the Seller for this item.You can\'t bid for this item.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (35, 'bidding', 'You are the Highest Bidder for this item.You can\'t bid for this item.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (36, 'enquiry', 'There is no Queries display in this view')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (37, 'money_trans', 'Sorry! This Username Does not exist')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (38, 'money_trans', 'Sorry! You have not efficient amount in your Account.Please addfunds in your account then transfer the amount!')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (40, 'myporfile', 'Your profile has been modified successfully!')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (39, 'money_trans', 'Thank You! Your $<?php= $amt ?>  successfully transferred to  <?php= $trans_username ?>.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (41, 'ad_success_myaccount', 'You have successfully listed your item.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (42, 'bidconfirm', 'Your bid has been placed.You  are Current High Bidder!')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (43, 'ad_cancel', 'Sorry! Your ad has not Posted.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (44, 'answer', 'Your Answer has been sent!')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (45, 'ask_seller_question', 'Mail Sent failed .')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (46, 'bidding', 'Sorry !You Have Already Bidded $bidded_row Items.Please Select Basic or Superior Account to Bid More Items!.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (47, 'bidding', 'Please!Choose Maximum Bid Amount')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (48, 'category', 'Sorry! No Items Found.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (49, 'changepassword', 'Please! Enter your Old Password')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (50, 'changepassword', 'Please Enter New Password')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (51, 'changepassword', 'Confirm Password does not match with New Password.Please Re-enter')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (52, 'changepassword', 'Invalid Password')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (53, 'changepassword', 'Invalid Username')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (54, 'choose_sell_format', 'You Have Already Posted $no_of_post items.To Post More Items You Have To Upgrade Yourself to SUPERIOR ACCOUNT.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (55, 'classified_ad', 'Item Purchased Successfully!')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (56, 'cus_support', 'Mail Sent Successfully to <?php= $_SESSION[site_name]  ?> Customar Support.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (57, 'cus_support', 'Mail Sent Failure')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (58, 'comments', 'Your Feedback Sent Successfully!')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (59, 'comments', 'Sorry, Your Feedback is not Sent.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (60, 'detailstat', 'Not Won:')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (61, 'detailstat', 'There are no items to display in this view for the selected time period.Items may display in this view for 60 days, or until you remove them.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (62, 'detailstat', 'Items Not Won:')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (63, 'detailstat', 'U\'r Sold')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (64, 'detailstat', 'There are no items to display in this view .')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (65, 'detailstat', 'Sold Items:')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (66, 'detailstat', 'U\'r Live Items')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (67, 'easysearch', 'This name already Exist.please choose another name!')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (68, 'detailstat', 'Live Items:')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (69, 'detailstat', 'U\'r Won')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (70, 'easysearch', 'Searches has been saved')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (71, 'detailstat', 'Won Items:')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (72, 'edit_auction_step2', 'Your Shipping amount is invalid')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (73, 'edit_auction_step2', 'Your Tax is invalid')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (74, 'edit_item', 'Your Bid increment is invalid')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (75, 'edit_item_cate', 'Please Select Category')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (76, 'edit_item_detail', 'Updated Successfully')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (77, 'login', 'User Name Not Found')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (78, 'login', 'Password Not Found')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (79, 'login', 'Your Account Not Verified')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (80, 'post_ad', 'No information available')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (81, 'quick', 'You are the Seller for this Item.So you Can\'t buy these item.')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (82, 'rating', ' You Have Rated On Successfully !')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (83, 'repost', 'Reposted Successfully')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (84, 'requireItemNo', 'Sorry! You Can not Edit or Repost this Item .Because Your Item Id was not Match Your Posted Items.!')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (85, 'signin', 'please Enter Correct Turing Code')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (86, 'user_reg.php', 'The domain <font color=red>')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (87, 'user_reg.php', '</font> is blocked.<br>Please Enter other domain Email id which is not like emailid@')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES(88, 'user_reg.php', 'Your Primary Phoneno is invalid')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES (89, 'signin', 'Invalid Username and Password')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES ('90', 'promotelistings.php', 'Quick buy price must be greater than minumum bid amount')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES ('91', 'promotelistings.php', 'Reserve price must be greater than minimum bid amount')";
$result=mysql_query($sql);
$sql="INSERT INTO error_message VALUES ('92', 'promotelising.php', 'Please enter a numeric value')";
$result=mysql_query($sql);





$sql="DROP TABLE IF EXISTS `auction_fees`";
$result=mysql_query($sql);
$sql="CREATE TABLE auction_fees (
  fee_id bigint(20) NOT NULL auto_increment,
  item_id bigint(20) NOT NULL default '0',
  gallery_fee varchar(20) NOT NULL default '0',
  homepage_featureditem_fee varchar(20) NOT NULL default '0',
  boldlisting_fee varchar(20) NOT NULL default '0',
  highlighted_fee varchar(20) NOT NULL default '0',
  endauction_fee varchar(20) NOT NULL default '0',
  classifedad_fee varchar(20) NOT NULL default '0',
  Insertion_fee varchar(10) NOT NULL default '',
  subtitlefee varchar(20) NOT NULL default '',
  listing_desinger_fee varchar(20) NOT NULL default '',
  addtional_pic_fee varchar(20) NOT NULL default '',
  finalsalevalue_fee varchar(50) NOT NULL default '',
  paid enum('No','Yes','Disallow') NOT NULL default 'No',
  reserve_price_fee varchar(50) NOT NULL default '',
  PRIMARY KEY  (fee_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS `about_us`";
$result=mysql_query($sql);
$sql="CREATE TABLE `about_us` (
  `company_id` int(11) NOT NULL default '0',
  `company_name` varchar(30) NOT NULL default '',
  `company_detail` text NOT NULL,
  `company_address` text NOT NULL,
  `company_phone` varchar(30) NOT NULL default '',
  `company_fax` varchar(30) NOT NULL default ''
) TYPE=MyISAM";
$result=mysql_query($sql);

 

$sql="INSERT INTO `about_us` (`company_id`, `company_name`, `company_detail`, `company_address`, `company_phone`, `company_fax`) VALUES (1, 'Your Company Name', 'Your Company Detail', 'Your Company Address', 'Your Company Phone', 'Your Company Fax')";
$result=mysql_query($sql);

 

$sql="DROP TABLE IF EXISTS `addfunds`";
$result=mysql_query($sql);
$sql="CREATE TABLE `addfunds` (
  `auto_id` bigint(20) NOT NULL auto_increment,
  `member_id` bigint(20) default NULL,
  `fund_date` datetime default NULL,
  `fund_thru` tinyint(4) default NULL,
  `fund_amount` decimal(10,2) default NULL,
  PRIMARY KEY  (`auto_id`)
) TYPE=MyISAM AUTO_INCREMENT=24 ";
$result=mysql_query($sql);


$sql="INSERT INTO `addfunds` (`auto_id`, `member_id`, `fund_date`, `fund_thru`, `fund_amount`) VALUES (22, 20, '2005-10-15 19:07:10', NULL, 12.00)";
$result=mysql_query($sql);
$sql="INSERT INTO `addfunds` (`auto_id`, `member_id`, `fund_date`, `fund_thru`, `fund_amount`) VALUES (23, 20, '2005-10-15 19:07:27', NULL, 56.00)";
$result=mysql_query($sql);

$admin_pass=crypt($password);

$sql="DROP TABLE IF EXISTS `admin`";
$result=mysql_query($sql);
$sql="CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL auto_increment,
  `user_name` varchar(60) NOT NULL default '',
  `password` varchar(60) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `status` enum('sub','main') NOT NULL default 'sub',
  PRIMARY KEY  (`admin_id`)
) TYPE=MyISAM AUTO_INCREMENT=10 ";
$result=mysql_query($sql);


$sql="ALTER TABLE `admin` ADD `verifycode` VARCHAR( 50 ) NOT NULL" ;
$result=mysql_query($sql);



$sql="INSERT INTO `admin` (`admin_id`, `user_name`, `password`, `email`, `status`) VALUES (1, '$adminuser', '$admin_pass', '$adminemail', 'main')";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS admin_earnings";
$result=mysql_query($sql);
$sql="CREATE TABLE admin_earnings (
  payment_id int(11) NOT NULL auto_increment,
  user_id tinyint(4) NOT NULL default '0',
  payment_date date NOT NULL default '2005-09-29',
  amount int(11) NOT NULL default '0',
  type enum('endauctionearly','feature_fee') NOT NULL default 'endauctionearly',
  UNIQUE KEY payment_id (payment_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS `admin_rates`";
$result=mysql_query($sql);

$sql="CREATE TABLE admin_rates (
  admin_id int(5) NOT NULL default '1',
  gallery_price varchar(10) NOT NULL default '0',
  homepage_price varchar(10) NOT NULL default '0',
  subtitle_price varchar(10) NOT NULL default '0',
  bold_price varchar(10) NOT NULL default '0',
  highlight_price varchar(10) NOT NULL default '0',
  Insertion_fee varchar(10) NOT NULL default '0',
  Classified_fee varchar(10) NOT NULL default '0',
  listing_designer_fee varchar(10) NOT NULL default '0',
  Image_listing_fee varchar(10) NOT NULL default '0',
  reserve_price_fee varchar(10) NOT NULL default '0'
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO `admin_rates` VALUES (1,'0','0','0','0','0','0','0','0','0','0')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS `admin_settings`";
$result=mysql_query($sql);
$sql="CREATE TABLE `admin_settings` (
  `set_id` int(11) NOT NULL auto_increment,
  `set_name` varchar(50) NOT NULL default '',
  `set_value` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`set_id`)
) TYPE=MyISAM AUTO_INCREMENT=40 ";
$result=mysql_query($sql);


$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (1, 'Domain Name', '$domainname')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (2, 'Site Moto', 'Auction ::bid now buy now')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (3, 'Admin Email', '$adminemail')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (11, 'Paypal Number', '111111')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (16, 'Launch date', '2005-08-22')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (17, 'Last update Date', '2005-08-25')";
$result=mysql_query($sql);
/* $sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (19, 'Sniper protection increse date', '1')";
$result=mysql_query($sql); */
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (20, 'Olditem cleanup duration in days', '60')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (21, 'Top Seller Range', '6')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (22, 'Record Limit Per Page', '50')";
$result=mysql_query($sql); 
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (23, 'Auction setting start date', 'no')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (24, 'Auction setting end date', 'yes')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (25, 'Auction setting start_delay', '0')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (26, 'Auction setting duration', '0')";
$result=mysql_query($sql);
/* $sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (27, 'Trusted user fees', '20.95')";
$result=mysql_query($sql); */
/* $sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (32, 'Trusted user  discount', '40')";
$result=mysql_query($sql); */
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (37, 'No of repost allowed', '5')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (39, 'Classifide ad Cost', '2.50')";
$result=mysql_query($sql);
/*$sql="INSERT INTO admin_settings VALUES (40, 'Authorize.net', '12')";
$result=mysql_query($sql);*/
$sql="INSERT INTO admin_settings VALUES (41, 'Private Auction', 'yes')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (42, 'Allow Seller to Specify Bid Increment', 'no')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (43, 'Bid Increment Value', '12')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (45, 'Contact Seller', '2')";
$result=mysql_query($sql);
$sql="INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (46, 'Logo', 'auctionlogo.gif')";
$result=mysql_query($sql);

$sql="INSERT INTO admin_settings VALUES (47, 'Site Name', '$domainname')";
$result=mysql_query($sql);

$sql="INSERT INTO admin_settings VALUES (48, 'E-Gold Number', '123456')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (49, 'E-Gold Pass Pharse', 'aaaaaaaaaaaaa')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (50, 'Int-Gold Number', '111111')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (51, 'Stormpay', '23221')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (52, 'E-Bullion Number', '234234')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (53, 'Money Bookers', '234234')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (54, 'Results Per Page', '10')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (55, 'Front Page Text', 'Welcome to Auction')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (56, 'Allow Final Sale Value Fee', 'Yes')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (57, 'Set Insertion Fee', 'yes')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings VALUES (58, 'Unpaid Item Waiting Peroid', '5')";
$result=mysql_query($sql);
/*$sql="INSERT INTO admin_settings (set_id, set_name, set_value) VALUES (55, 'Default Currency', '$')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_settings (set_id, set_name, set_value) VALUES (56, 'Default  Currency Code', 'USD')";
$result=mysql_query($sql);*/

$sql="INSERT INTO admin_settings VALUES (59, 'Default Currency', '$')";
$result=mysql_query($sql);

$sql="INSERT INTO admin_settings VALUES (60, 'Default Currency Code', 'USD')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS ask_question";
$result=mysql_query($sql);

$sql="CREATE TABLE ask_question (
  qst_id int(11) NOT NULL auto_increment,
  from_id varchar(200) NOT NULL default '',
  item_id int(11) NOT NULL default '0',
  date date NOT NULL default '0000-00-00',
  question longtext NOT NULL,
  to_id varchar(200) NOT NULL default '',
  answer varchar(220) NOT NULL default '',
  status enum('read','unread','delete','reply','notification') NOT NULL default 'unread',
  statusout enum('sent','delete') NOT NULL default 'sent',
  notifystatus enum('unread','read') NOT NULL default 'unread',
  statusin enum('alive','delete') NOT NULL default 'alive',
  PRIMARY KEY  (qst_id)
) TYPE=MyISAM";
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS `pay_transaction`";
$result=mysql_query($sql);

$sql="CREATE TABLE pay_transaction (
  pay_id bigint(20) NOT NULL auto_increment,
  trans_amount int(11) NOT NULL default '0',
  itemid int(11) NOT NULL default '0',
  user_id bigint(20) NOT NULL default '0',
  trans_batchnumber int(11) NOT NULL default '0',
  trans_date date NOT NULL default '0000-00-00',
  trans_type enum('Store Fee','Final Sale Value Fee','Featured Listing Fee') NOT NULL default 'Store Fee',
  PRIMARY KEY  (pay_id)
) TYPE=MyISAM";
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS `banners`";
$result=mysql_query($sql);
$sql="CREATE TABLE `banners` (
  `banner_id` int(11) NOT NULL auto_increment,
  `banner_name` varchar(50) NOT NULL default '',
  `banner_path` varchar(100) NOT NULL default '',
  `site_url` varchar(100) NOT NULL default '',
  `status` enum('On','Off','default','ad') NOT NULL default 'On',
  PRIMARY KEY  (`banner_id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ";
$result=mysql_query($sql);


$sql="INSERT INTO `banners` (`banner_id`, `banner_name`, `banner_path`, `site_url`, `status`) VALUES (2, 'Default', 'images/banner1.gif', 'http://www.yahoo.com', 'ad')";
$result=mysql_query($sql);
$sql="INSERT INTO `banners` (`banner_id`, `banner_name`, `banner_path`, `site_url`, `status`) VALUES (4, 'Default1', 'images/banner1.gif', 'http://www.alphazoneads.com', 'default')";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS bid_increment";
$result=mysql_query($sql);
$sql="CREATE TABLE bid_increment (
  bid_id int(10) NOT NULL auto_increment,
  bid_from float(11) NOT NULL default '0',
  bid_to float(11) NOT NULL default '0',
  bid_inc float(11) NOT NULL default '0',
  PRIMARY KEY  (bid_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO bid_increment VALUES (1, '0', '50', '17')";
$result=mysql_query($sql);
$sql="INSERT INTO bid_increment VALUES (2, '51', '100', '2')";
$result=mysql_query($sql);
$sql="INSERT INTO bid_increment VALUES (3, '101', '500', '5')";
$result=mysql_query($sql);
$sql="INSERT INTO bid_increment VALUES (5, '1000', '5000', '555')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS blocked_domain";
$result=mysql_query($sql);

$sql="CREATE TABLE blocked_domain (
  block_id int(11) NOT NULL auto_increment,
  blocked_domain varchar(50) NOT NULL default '',
  PRIMARY KEY  (block_id)
) TYPE=MyISAM";
$result=mysql_query($sql);

 $sql="DROP TABLE IF EXISTS blocked_ip";
 $result=mysql_query($sql);
$sql="CREATE TABLE blocked_ip (
  block_id int(11) NOT NULL auto_increment,
  blocked_ip varchar(50) NOT NULL default '',
  PRIMARY KEY  (block_id)
) TYPE=MyISAM";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS buyerblockpreferences";
$result=mysql_query($sql);
$sql="CREATE TABLE buyerblockpreferences (
  buyer_id int(11) NOT NULL auto_increment,
  blockbuyercountries varchar(50) NOT NULL default '',
  blockbuyerfeedbakscore varchar(50) NOT NULL default '',
  blockunpaidistrick varchar(50) NOT NULL default '',
  ItemLimit varchar(50) NOT NULL default '',
  feedbackscore varchar(50) NOT NULL default '',
  feedbackLimit varchar(50) NOT NULL default '',
  ItemLimitMinFeedback varchar(50) NOT NULL default '',
  blockmerkatobid varchar(50) NOT NULL default '',
  ItemLimitoption varchar(50) NOT NULL default '',
  item_id varchar(50) NOT NULL default '',
  PRIMARY KEY  (buyer_id)
) TYPE=MyISAM";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS `cat_slave`";
$result=mysql_query($sql);
$sql="CREATE TABLE `cat_slave` (
  `category_id` int(11) NOT NULL default '0',
  `tablename` varchar(75) NOT NULL default '',
  `file_path` varchar(75) NOT NULL default ''
) TYPE=MyISAM";
$result=mysql_query($sql);



$sql="INSERT INTO `cat_slave` (`category_id`, `tablename`, `file_path`) VALUES (152, 'xx', 'templates/xx.tpl')";
$result=mysql_query($sql);
$sql="INSERT INTO `cat_slave` (`category_id`, `tablename`, `file_path`) VALUES (166, 'Automotive', 'templates/Automotive.tpl')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS membership_level";
$result=mysql_query($sql);


$sql="CREATE TABLE membership_level (
  mid int(11) NOT NULL auto_increment,
  feedback_score_from bigint(20) NOT NULL default '0',
  icon varchar(100) NOT NULL default '',
  feedback_score_to bigint(20) NOT NULL default '0',
  PRIMARY KEY  (mid)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO membership_level VALUES (7, 0, 'green_star.gif', 0)";
$result=mysql_query($sql);
$sql="INSERT INTO membership_level VALUES (6, 1, 'yellowstar.gif', 10)";
$result=mysql_query($sql);
$sql="INSERT INTO membership_level VALUES (8, 11, 'red_star.gif', 12)";
$result=mysql_query($sql);
$sql="INSERT INTO membership_level VALUES (9, 13, 'arrow-4.GIF', 23)";
$result=mysql_query($sql);





$sql="DROP TABLE IF EXISTS want_it_now";
$result=mysql_query($sql);

$sql="CREATE TABLE want_it_now (
  want_id bigint(20) NOT NULL auto_increment,
  wanted_itemid bigint(20) NOT NULL default '0',
  responseed_itemid bigint(20) NOT NULL default '0',
  response_date date NOT NULL default '0000-00-00',
  PRIMARY KEY  (want_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS whatsnew";
$result=mysql_query($sql);
$sql="CREATE TABLE whatsnew (
  id tinyint(4) NOT NULL auto_increment,
  link_name varchar(100) NOT NULL default '',
  link varchar(100) NOT NULL default '',
  icon varchar(100) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM";
$result=mysql_query($sql);



$sql="INSERT INTO whatsnew VALUES (3, 'Link1', 'http://www.ajhyip.com', '06-06-29_pmoNewblog_50X50.gif')";
$result=mysql_query($sql);
$sql="INSERT INTO whatsnew VALUES (2, 'Link2', 'http://www.ajauctionpro.com', '06-06-29SkypeFCalls_50x50.gif')";
$result=mysql_query($sql);
$sql="INSERT INTO whatsnew VALUES (4, 'Site Announcement', 'http://www.ajsquare.com', '06-06-29_pmoNewblog_50X50.gif')";
$result=mysql_query($sql);



$sql="INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_order`) VALUES (1, 'Test category 1', 10)";
$result=mysql_query($sql);
$sql="INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_order`) VALUES (2, 'Test category 2', 11)";
$result=mysql_query($sql);




$sql="DROP TABLE IF EXISTS `category_master`";
$result=mysql_query($sql);
$sql="CREATE TABLE IF NOT EXISTS `category_master` (
  `category_id` int(11) NOT NULL auto_increment,
  `category_name` varchar(100) NOT NULL default '',
  `category_head_id` int(6) NOT NULL default '0',
  `custom_cat` int(10) NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) TYPE=MyISAM";
$result=mysql_query($sql);



$sql="INSERT INTO `category_master` VALUES (1, 'Antiques', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (2, 'Automotive', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (3, 'Books', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (4, 'Business', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (5, 'Cameras', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (6, 'Clothing', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (7, 'Computers', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (8, 'DVD''s', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (9, 'Electronics', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (10, 'Garden', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (11, 'Jewelry', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (12, 'Music', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (13, 'Sports', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (14, 'Tickets', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (15, 'Toys', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (16, 'Travel', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (17, 'VideoGames', 0, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (18, 'Art', 1, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (19, 'Furniture', 1, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (20, 'Rugs', 1, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (21, 'Silver', 1, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (22, 'Other Vechicles', 2, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (23, 'Cars', 2, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (24, 'Trucks', 2, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (25, 'Motor Cycles', 2, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (26, 'Parts', 2, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (27, 'Fictions', 3, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (28, 'Magazines', 3, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (29, 'Notification', 3, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (30, 'Textbooks', 3, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (31, 'Childrens', 3, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (32, 'Reference', 3, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (33, 'Equipment', 4, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (34, 'Furniture', 4, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (35, 'Suppliers', 4, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (36, 'Telephones', 4, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (37, 'Digital Cameras', 5, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (38, 'Film Cameras', 5, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (39, 'Accessories', 5, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (40, 'Women', 6, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (41, 'Men', 6, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (42, 'Girls', 6, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (43, 'Boy', 6, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (44, 'Infant', 6, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (45, 'Computer System', 7, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (46, 'Components', 7, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (47, 'Pheripherals', 7, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (48, 'Software', 7, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (49, 'Action', 8, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (50, 'Animation', 8, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (51, 'Comedy', 8, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (52, 'Drama', 8, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (53, 'Horror', 8, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (54, 'Sci-Fi', 8, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (55, 'Cell Phone', 9, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (56, 'Audio & Video', 9, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (57, 'Car Audio', 9, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (58, 'PDA''s', 9, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (59, 'Digital Cameras', 9, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (60, 'CamCorders', 9, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (61, 'Portable', 9, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (62, 'Gadgets', 9, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (63, 'Fine', 11, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (64, 'Watches', 11, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (65, 'Costume', 11, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (66, 'Men', 11, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (67, 'Beads', 11, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (68, 'Boxes', 11, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (69, 'Guitars', 12, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (70, 'Pro Audio', 12, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (71, 'Autograph', 13, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (72, 'Memorabilia', 13, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (73, 'Trading Cards', 13, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (74, 'Concerts', 14, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (75, 'Movies', 14, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (76, 'Sports', 14, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (77, 'Theater', 14, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (78, 'Auction Figure', 15, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (79, 'Classic', 15, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (80, 'Puzzle', 15, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (81, 'Games', 15, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (82, 'Luggage', 16, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES(83, 'Cruises', 16, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (84, 'Vacation', 16, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (85, 'Timeshares', 16, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (86, 'Sony', 17, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (87, 'Microsoft', 17, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (88, 'Nitendo', 17, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (89, 'Sega', 17, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (90, 'Old Systems', 17, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (91, 'Black', 3, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (92, 'Television', 9, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (93, 'Campers', 22, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (94, 'Scooters', 22, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (95, 'Show Mobiles', 22, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (96, 'Accessories', 26, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (97, 'Carparts', 26, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (98, 'Trunck Parts', 26, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (99, 'Tools', 26, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (100, 'Apparel', 26, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (101, 'Manuals', 26, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (102, 'Adventure', 27, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (103, 'Fantasy', 27, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (104, 'Horror', 27, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (105, 'Humor', 27, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (106, 'Military', 27, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (107, 'Mystery', 27, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (108, 'Plays', 27, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (109, 'Romance', 27, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (110, 'Sci-Fi', 27, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (111, 'Western', 27, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (112, 'Biography', 29, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (113, 'History', 29, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (114, 'Humor', 29, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (115, 'Pets', 29, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (116, 'Sports', 29, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (117, 'Travel', 29, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (118, 'Apple', 45, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (119, 'Laptops', 45, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (120, 'PC''s', 45, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (121, 'CPU''s', 46, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (122, 'Drives', 46, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (123, 'Memory', 46, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (124, 'MotherBoard', 46, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (125, 'Video Card', 46, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (126, 'Home Video', 56, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (127, 'Home Audio', 56, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (128, 'Accessories', 56, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (129, 'Sony Systems', 86, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (130, 'Sony Games', 86, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (131, 'Microsoft Systems', 87, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (132, 'Microsoft Games', 87, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (133, 'Nitendo Systems', 88, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (134, 'Nitendo Games', 88, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (135, 'Sega Systems', 89, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (136, 'Sega Games', 89, 0)";
$result=mysql_query($sql);
$sql="INSERT INTO `category_master` VALUES (137, 'Bycycle', 22, 0)";
$result=mysql_query($sql);

$sql="update category_master set priority=1";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS country_master";
		$result=mysql_query($sql);
		$sql="CREATE TABLE country_master (
		  country_id bigint(20) NOT NULL auto_increment,
		  country varchar(50) default NULL,
		  PRIMARY KEY  (country_id)
		) TYPE=MyISAM";
		$result=mysql_query($sql);


$sql="INSERT INTO country_master VALUES (1, 'Afghanistan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (2, 'Albania')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (3, 'Algeria')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (4, 'American Samoa')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (5, 'Andorra')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (6, 'Angola')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (7, 'Anguilla')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (8, 'Antarctica')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (9, 'Antigua And Barbuda')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (10, 'Argentina')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (11, 'Armenia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (12, 'Aruba')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (13, 'Australia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (14, 'Austria')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (15, 'Azerbaijan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (16, 'Bahamas')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (17, 'Bahrain')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (18, 'Bangladesh')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (19, 'Barbados')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (20, 'Belarus')";

$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (21, 'Belgium')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (22, 'Belize')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (23, 'Benin')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (24, 'Bermuda')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (25, 'Bhutan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (26, 'Bolivia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (27, 'Bosnia and Herzegovina')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (28, 'Botswana')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (29, 'Bouvet Island')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (30, 'Brazil')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (31, 'British Indian Ocean Territory')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (32, 'Brunei')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (33, 'Bulgaria')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (34, 'Burkina Faso')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (35, 'Burundi')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (36, 'Cambodia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (37, 'Cameroon')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (38, 'Canada')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (39, 'Cape verde')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (40, 'Cayman Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (41, 'Central African Republic')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (42, 'Chad')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (43, 'Chile')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (44, 'China')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (45, 'Christmas Island')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (46, 'Cocos (keeling) Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (47, 'Colombia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (48, 'Comoros')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (49, 'Congo')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (50, 'Cook Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (51, 'Costa Rica')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (52, 'Croatia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (53, 'Cuba')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (54, 'Cyprus')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (55, 'Czech Republic')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (56, 'Dem Rep of Congo (Zaire)')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (57, 'Denmark')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (58, 'Djibouti')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (59, 'Dominica')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (60, 'Dominican Republic')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (61, 'East Timor')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (62, 'Ecuador')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (63, 'Egypt')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (64, 'El Salvador')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (65, 'England')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (66, 'Equatorial Guinea')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (67, 'Eritrea')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (68, 'Estonia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (69, 'Ethiopia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (70, 'Falkland Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (71, 'Faroe Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (72, 'Fiji')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (73, 'Finland')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (74, 'France')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (75, 'French Guiana')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (76, 'French Polynesia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (77, 'French Southern Territories')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (78, 'Gabon')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (79, 'Gambia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (80, 'Georgia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (81, 'Germany')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (82, 'Ghana')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (83, 'Gibraltar')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (84, 'Greece')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (85, 'Greenland')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (86, 'Grenada')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (87, 'Guadeloupe')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (88, 'Guam')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (89, 'Guatemala')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (90, 'Guinea')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (91, 'Guinea-Bissau')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (92, 'Guyana')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (93, 'Haiti')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (94, 'Heard and McDonald Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (95, 'Honduras')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (96, 'Hungary')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (97, 'Iceland')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (98, 'India')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (99, 'Indonesia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (100, 'Iran')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (101, 'Iraq')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (102, 'Ireland')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (103, 'Israel')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (104, 'Italy')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (105, 'Ivory Coast')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (106, 'Jamaica')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (107, 'Japan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (108, 'Jordan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (109, 'Kazakhstan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (110, 'Kenya')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (111, 'Kiribati')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (112, 'Korea')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (113, 'Korea (D.P.R.)')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (114, 'Kuwait')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (115, 'Kyrgyzstan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (116, 'Lao')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (117, 'Latvia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (118, 'Lebanon')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (119, 'Lesotho')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (120, 'Liberia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (121, 'Libya')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (122, 'Liechtenstein')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (123, 'Lithuania')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (124, 'Luxembourg')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (125, 'Macedonia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (126, 'Madagascar')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (127, 'Malawi')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (128, 'Malaysia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (129, 'Maldives')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (130, 'Mali')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (131, 'Malta')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (132, 'Marshall Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (133, 'Martinique')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (134, 'Mauritania')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (135, 'Mauritius')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (136, 'Mayotte')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (137, 'Mexico')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (138, 'Micronesia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (139, 'Moldova')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (140, 'Monaco')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (141, 'Mongolia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (142, 'Montserrat')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (143, 'Morocco')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (144, 'Mozambique')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (145, 'Myanmar')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (146, 'Namibia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (147, 'Nauru')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (148, 'Nepal')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (149, 'Netherlands')";
$result=mysql_query($sql);
/*$sql="INSERT INTO country_master VALUES (150, 'Netherlands Antilles')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (151, 'New Caledonia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (152, 'New Zealand')";
$result=mysql_query($sql);*/
$sql="INSERT INTO country_master VALUES (153, 'Nicaragua')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (154, 'Niger')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (155, 'Nigeria')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (156, 'Niue')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (157, 'Norfolk Island')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (158, 'Northern Mariana Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (159, 'Norway')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (160, 'Oman')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (161, 'Other')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (162, 'Pakistan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (163, 'Palau')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (164, 'Palestinian Territory, Occupie')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (165, 'Panama')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (166, 'Papua new Guinea')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (167, 'Paraguay')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (168, 'Peru')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (169, 'Philippines')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (170, 'Pitcairn Island')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (171, 'Poland')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (172, 'Portugal')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (173, 'Puerto Rico')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (174, 'Qatar')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (175, 'Reunion')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (176, 'Romania')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (177, 'Russia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (178, 'Rwanda')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (179, 'Saint Kitts And Nevis')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (180, 'Saint Lucia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (181, 'Saint Vincent And The Grenadin')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (182, 'Samoa')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (183, 'San Marino')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (184, 'Sao Tome and Principe')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (185, 'Saudi Arabia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (186, 'Scotland')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (187, 'Senegal')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (188, 'Seychelles')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (189, 'Sierra Leone')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (190, 'Singapore')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (191, 'Slovak Republic')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (192, 'Slovenia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (193, 'Solomon Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (194, 'Somalia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (195, 'South Africa')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (196, 'South Georgia, Sth Sandwich Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (197, 'Spain')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (198, 'Sri Lanka')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (199, 'St Helena')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (200, 'St Pierre and Miquelon')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (201, 'Sudan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (202, 'Suriname')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (203, 'Svalbard And Jan Mayen Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (204, 'Swaziland')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (205, 'Sweden')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (206, 'Switzerland')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (207, 'Syria')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (208, 'Taiwan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (209, 'Tajikistan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (210, 'Tanzania')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (211, 'Thailand')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (212, 'Togo')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (213, 'Tokelau')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (214, 'Tonga')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (215, 'Trinidad And Tobago')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (216, 'Tunisia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (217, 'Turkey')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (218, 'Turkmenistan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (219, 'Turks And Caicos Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (220, 'Tuvalu')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (221, 'Uganda')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (222, 'Ukraine')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (223, 'United Arab Emirates')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (224, 'United States')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (225, 'Uruguay')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (226, 'Uzbekistan')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (227, 'Vanuatu')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (228, 'Vatican City State (Holy See)')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (229, 'Venezuela')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (230, 'Vietnam')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (231, 'Virgin Islands (British)')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (232, 'Virgin Islands (US)')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (233, 'Wales')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (234, 'Wallis And Futuna Islands')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (235, 'Western Sahara')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (236, 'Yemen')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (237, 'Zambia')";
$result=mysql_query($sql);
$sql="INSERT INTO country_master VALUES (238, 'Zimbabwe')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS dispute_process";
$result=mysql_query($sql);

$sql="CREATE TABLE dispute_process (
  process_id bigint(20) NOT NULL auto_increment,
  dispute_id int(4) NOT NULL default '0',
  dispute_by varchar(10) NOT NULL default '',
  dispute_explanations longtext NOT NULL,
  dispute_date datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (process_id)
) TYPE=MyISAM";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS `disputeconsole`";
$result=mysql_query($sql);

$sql="CREATE TABLE `disputeconsole` (
  `dispute_id` int(11) NOT NULL auto_increment,
  `dispute_by` int(11) NOT NULL default '0',
  `dispute_to` int(11) NOT NULL default '0',
  `distute_bid_id` bigint(20) NOT NULL default '0',
  `dispute_date` date NOT NULL default '0000-00-00',
  `dispute_type` enum('unpaid','notreceived') NOT NULL default 'unpaid',
  `dispute_status` enum('open','processing','closed','granted','eligible') NOT NULL default 'open',
  `dispute_reason` varchar(200) NOT NULL default '',
  `dispute_explanation` varchar(250) NOT NULL default '',
  `payment_gateway` varchar(100) NOT NULL default '',
  `payment_date` date NOT NULL default '0000-00-00',
  `itemid` int(10) NOT NULL default '0',
  PRIMARY KEY  (`dispute_id`)
) TYPE=MyISAM";
$result=mysql_query($sql);

$sql="CREATE TABLE `css` (
  `css_id` tinyint(4) NOT NULL auto_increment,
  `css_name` varchar(200) NOT NULL default '',
  `css_path` varchar(240) NOT NULL default '',
  `status` enum('active','inactive') NOT NULL default 'inactive',
  PRIMARY KEY  (`css_id`)
) TYPE=MyISAM AUTO_INCREMENT=6" ;
$result=mysql_query($sql);


$sql="INSERT INTO `css` VALUES (1, 'Style1', 'style/style1.css', 'inactive')";
$result=mysql_query($sql);
$sql="INSERT INTO `css` VALUES (2, 'Style2', 'style/style2.css', 'inactive')";
$result=mysql_query($sql);
$sql="INSERT INTO `css` VALUES (3, 'Style3', 'style/style3.css', 'inactive')";
$result=mysql_query($sql);
$sql="INSERT INTO `css` VALUES (4, 'Style4', 'style/style4.css', 'inactive')";
$result=mysql_query($sql);
$sql="INSERT INTO css VALUES (5, 'Style', 'style/style.css', 'active')";
$result=mysql_query($sql);
$sql="INSERT INTO css VALUES (6, 'Graphic Interface', 'style/admin_css.css', 'active')";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS admin_css";
$result=mysql_query($sql);
$sql="CREATE TABLE admin_css (
  css_id int(11) NOT NULL auto_increment,
  css_name varchar(100) NOT NULL default '',
  css_value varchar(100) NOT NULL default '',
  PRIMARY KEY  (css_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO admin_css VALUES (1, 'Table Head Color', '#EFEFEF')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (2, 'Topic title font size', '13px')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (3, 'Topic title Background Color', '#ccccff')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (4, 'Main table header text colour', 'blue')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (5, 'Hint Font Color', '#666666')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (6, 'Subtitle Font Color', '#CC0000')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (7, 'Warning Font Color', '#006600')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (8, 'Auction Highlighting Feature Background Color', '#D6DEFF')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (9, 'The lighest row color', '#F8F8FA')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (10, 'The medium row color', '#E6E8F6')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (11, 'Another Medium row color', '#E6E6E6')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (12, 'Light background color', '#F2F2FF')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (13, 'Border round the whole page (light border color)', '#D6D6D6')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (14, 'Alink font color', 'blue')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (15, 'Alink font size', '8.5pt')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (16, 'Alink hover font color', 'blue')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (17, 'Alink hover font size', '8.5pt')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (18, 'Main whole page border darest color', '#D1CFFF')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (19, 'Main whole page border lighest color', '#D6D6D6')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (20, 'Myauction Menu Head Color', '#D6DCFE')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (21, 'Table row border color', '#979BB3')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (22, 'Subtilte Background Color', '#ECEEFC')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (23, 'Form font size', '12px')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (24, 'Topic title font  weight', 'bold')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (25, 'Common Font Face', 'arial')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (26, 'Topic  font small size', '11px')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (27, 'Common alink font color', '#0000CC')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (28, 'Common alink font weight', '400')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (29, 'Small alink font color', '#990066')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (30, 'Small alink font size', '10px')";
$result=mysql_query($sql);
$sql="INSERT INTO admin_css VALUES (31, 'Header Image', 'line1.gif')";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS `currency_master`";
$result=mysql_query($sql);
$sql="CREATE TABLE `currency_master` (
  `currency_id` int(11) NOT NULL auto_increment,
  `currency` varchar(15) NOT NULL default '',
  `statuss` enum('show','hide') NOT NULL default 'show',
  `eq_value` float NOT NULL default '0',
  `currency_code` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`currency_id`)
) TYPE=MyISAM";
$result=mysql_query($sql);    


$sql="INSERT INTO `currency_master` (`currency_id`, `currency`, `statuss`, `eq_value`, `currency_code`)
 VALUES (1, '$', 'show', '1', 'USD'),
(2, 'Rs', 'show', '46', 'INR'),
(3, '&euro;', 'show', '0', 'EUR')";
$result=mysql_query($sql);

$sql="CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL auto_increment,
  `question` varchar(50) NOT NULL default '',
  `answer` text NOT NULL,
  PRIMARY KEY  (`faq_id`)
) TYPE=MyISAM AUTO_INCREMENT=17 ";
$result=mysql_query($sql);


$sql="INSERT INTO `faq` VALUES (5, 'What is $site_domain?', '<table class=help_tr  border=0 cellpadding=7 width=730 cellspacing=0>\r\n <tr><td><font color=blue><b>What is $site_domain?</b></font></td></tr></table>\r\n<table class=help_content border=0 cellpadding=10 cellspacing=0>\r\n<tr>\r\n <td>\r\n<p>$site_domain is the worlds online marketplace - a place for buyers and sellers to come together and trade almost anything!</p>\r\n\r\n  <h3>Heres how it works:</h3>     \r\n\r\n<ul>\r\n  <li> A seller lists an item on $site_domain - from antiques to cars, books to sporting goods.The seller chooses to accept only bids for the item (an online auction) or to offer the Buy It Now option, which allows buyers to purchase the item right away.</li>\r\n</ul> \r\n<ul><li>In an online auction, the bidding opens at a price the seller specifies and remains on $site_domain for a certain number of days.Buyers then place bids on the item.When the listing ends, the buyer with the highest bid wins!</li></ul> \r\n<ul><li>In fixed price listings that offer Buy It Now, the first buyer willing to pay the sellers price gets the item. </li></ul>\r\n</td></tr>\r\n</table>\r\n')";
$result=mysql_query($sql);
$sql="INSERT INTO `faq` VALUES (8, 'What is paypal?','<table class=help_tr  border=0 cellpadding=7 width=730 cellspacing=0>\r\n <tr><td><font color=blue><b>What is PayPal?</b></font></td></tr></table>\r\n<table class=help_content border=0 cellpadding=10 cellspacing=0>\r\n<tr>\r\n<td>\r\nPayPal is $site_domain preferred way to pay. It is a system that lets anyone with an email address securely send and receive online payments using their credit card or bank account. $site_domain members can use PayPal to quickly and easily pay for items on $site_domain.\r\n</td></tr></table>\r\n')";
$result=mysql_query($sql);
$sql="INSERT INTO `faq` VALUES (14, 'Registration', '<table class=help_tr border=0  cellpadding=7 width=730 cellspacing=0>\r\n <tr> <td><font color=blue><b>Registering to Buy </b></font>
 </td></tr></table>\r\n<table class=help_content  border=0 cellpadding=10 cellspacing=0>\r\n<tr>\r\n <td>\r\nYou only have to register once. Just follow these three steps: \r\n\r\n<ol><li>When you register at $site_domain, you''ll be asked to provide your basic contact information. <b>Your information will be kept private </b>on $site_domain secure servers.</li>\r\n\r\n<br><br><li>Check your email-$site_domain will send you a message with a link and instructions for confirming your registration.</li>\r\n\r\n<br><br><li>For security purposes, you''ll choose your own User ID and password for signing in to $site_domain. </li></ol></td></tr></table>')";
$result=mysql_query($sql);
$sql="INSERT INTO `faq` VALUES (15, 'How to buy an item', '<table class=help_tr  border=0 cellpadding=7 width=730 cellspacing=0>\r\n <tr><td><font color=blue><b>How to Buy an item?<b></font></td></tr></table>\r\n<table class=help_content  border=0 cellpadding=10 cellspacing=0>\r\n<tr>\r\n<td>\r\nBuying on $site_domain is easy - and fun! You can 
find almost anything for sale - from new computers to  antiques and collectibles. <br><br>\r\n\r\n<b>Here are a few basic steps to get you started:</b><br/>\r\n<ol><li><b>Find an item.</b><br/>\r\nSearch by typing in a keyword for an item you''re interested in, or browse through our categories.</li><br><br>\r\n\r\n<li><b>Learn about the item you found.</b><br/>\r\nRead the item description carefully, and look at the pictures the seller has included. If you have any questions about the item that aren''t answered in the item''s description, you can ask the seller about the item by clicking on the ''Ask Seller a Question'' link. Carefully reading all the information and asking informed questions will help you determine if this is the item you want!</li><br><br>\r\n\r\n<li><b>Review the seller''s feedback.</b><br/>\r\nYou can see the seller''s feedback score and percentage of positive feedback right on the item page. Also, be sure and read the comments left by the seller''s previous buyers to be sure that this is a seller you feel you can trust.</li><br><br>\r\n\r\n<li><b>Bid or Buy It Now.</b><br/>\r\nOnce you''ve found the item you want, you can place a bid or purchase the item instantly using Buy It Now. Some items are sold only in auction-style listings that require you to place a bid, while others include the Buy It Now option. This allows you to buy the item instantly. Check the item page to see what purchase options are available to you.</li><br><br>\r\n\r\n<li><b>Pay for the item.</b><br/>\r\nAfter you''ve won or purchased the item, send your payment to the seller. If the seller offers PayPal, clicking on the Pay Now button will allow you to pay quickly and easily with PayPal, $site_domain preferred way to pay. Just check the seller''s listing or email invoice to find out what the preferred payment method is and where you should send your payment.</li><br><br>\r\n\r\n<li><b>Leave feedback.</b><br/>\r\nHere''s your chance to tell the $site_domain community about your experience with this seller. You can leave feedback for any $site_domain member you''ve bought from or sold to.</li><br/></td></tr></table>\r\n \r\n')";
$result=mysql_query($sql);
$sql="INSERT INTO `faq` VALUES (16, 'How to sell an item?', '<table class=help_tr  border=0 cellpadding=7 width=730 cellspacing=0>\r\n <tr><td><font color=blue><b>How to Sell an item?</b></font></td></tr></table>\r\n<table class=help_content  border=0 cellpadding=10 cellspacing=0>\r\n<tr>\r\n<td>\r\n\r\n<p>Selling items on $site_domain is a great way to make some extra money - and have fun doing it! You can sell a few items that you no longer need, or build your own business.</p>\r\n\r\n<b>Here are the basics of listing items for sale:</b><br>\r\n<ol><li><b>Find an item you want to sell.</b><br>\r\nDo some research on $site_domain to get an idea of your item''s potential value and best category placement. Search for items similar to yours to find out what other seller''s starting prices and categories were.</li><br><br>\r\n\r\n<li><b>List your item.</b><br>\r\nClick Sell in the navigation bar at the top of any $site_domain page. $site_domain Sell Your Item form will take you through the process of listing your item step-by-step, including helping you find the correct category for your item.</li><br><br>\r\n\r\n<li><b>Set your price.</b><br>\r\nYou can set a starting price and allow buyers to place bids, offer a fixed price you''ll accept using Buy It Now, or both.</li><br><br>\r\n\r\n<li><b>Get paid!</b><br>\r\nWhen your listing ends, contact your winning buyer through email or by generating an $site_domain invoice within three business days. Let your buyer know the total price of the item, including your stated shipping costs, and how they can pay you. Offering PayPal allows your buyer to pay you quickly and easily.</li><br><br>\r\n\r\n<li><b>Ship the item.</b><br>\r\nAfter payment is received, send the item to the buyer''s shipping address, specified with their payment or by email.</li><br><br>\r\n\r\n<li><b>Leave feedback.</b><br>\r\nAfter your successful sale, leave feedback for your buyer, and ask that they do the same.</li><br><br></td></tr></table>\r\n \r\n')";
$result=mysql_query($sql);

 

$sql="DROP TABLE IF EXISTS `featured_items`";
$result=mysql_query($sql);
$sql="CREATE TABLE `featured_items` (
  `feature_id` int(11) NOT NULL auto_increment,
  `item_id` bigint(20) NOT NULL default '0',
  `gallery_feature` enum('No','Yes') NOT NULL default 'No',
  `home_feature` enum('No','Yes') NOT NULL default 'No',
  `bold` enum('No','Yes') NOT NULL default 'No',
  `border` enum('No','Yes') NOT NULL default 'No',
  `highlight` enum('No','Yes') NOT NULL default 'No',
  `subtitle_feature` enum('No','Yes') NOT NULL default 'No',
  `subtitle` varchar(70) NOT NULL default '',
  PRIMARY KEY  (`feature_id`)
) TYPE=MyISAM AUTO_INCREMENT=74 ";
$result=mysql_query($sql);


$sql="INSERT INTO featured_items VALUES (9, 572, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (10, 573, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (11, 574, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (12, 575, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (13, 576, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (14, 577, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (15, 637, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (16, 633, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (17, 634, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (18, 635, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
	

$sql="DROP TABLE IF EXISTS feedback";
$result=mysql_query($sql);
$sql="CREATE TABLE feedback (
  f_id int(11) NOT NULL auto_increment,
  item_id double NOT NULL default '0',
  seller_id bigint(20) NOT NULL default '0',
  feedback varchar(200) NOT NULL default '',
  date date NOT NULL default '0000-00-00',
  feedback_type enum('Positive','Negative','Neutral') NOT NULL default 'Positive',
  feedback_to bigint(20) NOT NULL default '0',
  buyer_id bigint(20) NOT NULL default '0',
  PRIMARY KEY  (f_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS finalsalevalue_feemaster";
$result=mysql_query($sql);
$sql="CREATE TABLE finalsalevalue_feemaster (
  fid int(4) NOT NULL auto_increment,
  closingprice_from float(50) NOT NULL default '0',
  closingprice_to float(50) NOT NULL default '0',
  percentage float(50) NOT NULL default '0',
  PRIMARY KEY  (fid)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO finalsalevalue_feemaster VALUES (1, '15', '2545', '5.25')";
$result=mysql_query($sql);
$sql="INSERT INTO finalsalevalue_feemaster VALUES (2, '2546', '10046', '3.00')";
$result=mysql_query($sql);
$sql="INSERT INTO finalsalevalue_feemaster VALUES (3, '10047', '110000', '4')";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS frontpage_banner";
$result=mysql_query($sql);
$sql="CREATE TABLE frontpage_banner (
  id int(11) NOT NULL auto_increment,
  banner varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  status enum('enable','disable') NOT NULL default 'enable',
  PRIMARY KEY  (id)
) TYPE=MyISAM";
$result=mysql_query($sql);



$sql="NSERT INTO frontpage_banner VALUES (4, 'images/big_ban1.gif', 'http://www.$site_domainpro.com', 'enable')";
$result=mysql_query($sql);
$sql="INSERT INTO frontpage_banner VALUES (2, 'images/big_ban2.gif', '', 'enable')";
$result=mysql_query($sql);
$sql="INSERT INTO frontpage_banner VALUES (3, 'images/big_ban3.gif', 'sdfsdf', 'enable')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS insertion_fee_master";
$result=mysql_query($sql);
$sql="CREATE TABLE insertion_fee_master (
  ins_id int(10) NOT NULL auto_increment,
  amt_from float(11) NOT NULL default '0',
  amt_to float(11) NOT NULL default '0',
  insertionfee float(11) NOT NULL default '0',
  PRIMARY KEY  (ins_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO insertion_fee_master VALUES (2, '1', '45', '203')";
$result=mysql_query($sql);
$sql="INSERT INTO insertion_fee_master VALUES (3, '46', '100', '77')";
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS `mail_subjects`";
$result=mysql_query($sql);
$sql="CREATE TABLE `mail_subjects` (
  `mail_id` int(11) NOT NULL default '0',
  `mail_title` varchar(50) NOT NULL default '',
  `mail_from` varchar(50) NOT NULL default '',
  `mail_subject` varchar(255) NOT NULL default '',
  `mail_message` longtext NOT NULL,
  UNIQUE KEY `mail_id` (`mail_id`)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO `mail_subjects` (`mail_id`, `mail_title`, `mail_from`, `mail_subject`, `mail_message`) VALUES (1, 'welcome mail', '$adminemail', 'Welcome to auction', 'Dear <username>,<br>\r\n\r\nThank you for choosing us.<br>\r\nPlease Note :<br>\r\nYour Registration Process is not completed yet<a href=<url>/verify.php?userid=<userid>> :\r\nClick here to Confirm your Registration.</a> <br>\r\nYour Username is :<username> <br>\r\nYour Password is :<password> <br>\r\nYour Verfication Code is : <vcode> <br>\r\nRegards \r\n$adminemail')";
$result=mysql_query($sql);
$sql="INSERT INTO `mail_subjects` VALUES (5, 'A Bidder Win an Item', '$adminemail', 'You have won an Auction', 'Dear NAME, <br><br>\r\nCongratulations! You have won the following item:<br>\r\n<br>\r\n\r\nItem Title: <a href=<GET_VIEW_ITEM>><ITEM_TITLE></a><br><br>\r\n\r\nTo view the auction please visit <a href= <GET_VIEW_ITEM> >click here</a>.<br> <br>\r\n\r\nTo pay for the item:<br>\r\n\r\n1. Log into your $site_domain account <br>\r\n\r\n2. Got to My Auction<br>\r\n\r\n3. Under the header All Buying click on Won<br>\r\n\r\n4. You will see all items that you won, click on Pay Now to see the sellers preferred payment methods.<p>\r\n\r\n\r\n\r\nThank you,<br><br>\r\n<sitename>')";
$result=mysql_query($sql);
$sql="INSERT INTO `mail_subjects` (`mail_id`, `mail_title`, `mail_from`, `mail_subject`, `mail_message`) VALUES (3, 'ask question to a seller', '<buyer_email_id>', '<?php= $_SESSION[site_name]  ?>\r\n  Member Ask a  Question', 'Dear <seller_name>,<br>\r\n\r\n <buyer_name> has ask this question regarding your product (<product_name> ).<br> \r\n\r\n                           <question> \r\n<br>\r\n\r\n                                                               Best Regards,<br>\r\n                                                                   <?php= $_SESSION[site_name]  ?>\r\n\r\n                                                  \r\n\r\n\r\n             \r\n\r\n                    \r\n      \r\n\r\n             ')";
$result=mysql_query($sql);

$sql="INSERT INTO `mail_subjects` (`mail_id`, `mail_title`, `mail_from`, `mail_subject`, `mail_message`) VALUES (4, 'A Seller Closed His Item', '<seller email id >', 'A Seller Closed His Item', '<table bgcolor=#F8F8FA style=border-top:2px solid #979BB3;border-bottom:2px solid #979BB3; cellpadding=5 cellspacing=2 width=50% >\r\n<tr bgcolor=#EEEEF8><td><strong>A Seller Closed His Item </strong></td></tr>\r\n\r\n<tr ><td>\r\n<br>\r\n<h5>\r\n<b>Hi Admin, <br>\r\nA Seller ( Name: NAME ) Closed His Item.\r\n<br><br>\r\nItem Id :ITEM_ID\r\n</b>\r\n</h5>\r\n</td></tr>\r\n</table>\r\n')";
$result=mysql_query($sql);

$sql="INSERT INTO `mail_subjects` (`mail_id`, `mail_title`, `mail_from`, `mail_subject`, `mail_message`) VALUES (2, 'email to  friend mail', '$adminemail', '<?php= $_SESSION[site_name]  ?>\r\n Member:', '<table bgcolor=#F8F8FA style=border-top:2px solid #979BB3;border-bottom:2px solid #979BB3; cellpadding=5 cellspacing=2 width=50%>\r\n<tr bgcolor=#EEEEF8><td>\r\n<b><font size=2><username> Sent You This <?php= $_SESSION[site_name]  ?>\r\n Item.</font></b>\r\n</td></tr>\r\n<tr><td><b>Personal Message:</b><msg></td></tr>\r\n<tr><td>\r\n<a href=<page>>Click Here to View this Item.</a></td></tr></table>')";
$result=mysql_query($sql);

$sql="INSERT INTO `mail_subjects` (`mail_id`, `mail_title`, `mail_from`, `mail_subject`, `mail_message`) VALUES (6, 'Winner mail to seller', '$adminemail', 'Winner''s Announcement', '<table>\r\n<tr>\r\n<td> Dear <sellername>,\r\n</td></tr>\r\n<tr><td>\r\n<winner_name> has bidded for the following <item_name>(<item_no>) Item. </td></tr>\r\n<tr><td>\r\nNow the User has won the Item for the <amount> price.\r\n</td></tr>\r\n<tr><td>Winner Email Id:<winneremail></td></tr>\r\n<tr><td>Regards,<br>\r\n<sitename></td></tr></table>')";
$result=mysql_query($sql);


$sql="INSERT INTO mail_subjects VALUES (7, 'Winner mail to seller', '$adminemail', 'Your Auction Sold', 'Dear SELLER, <br><br>\r\nCongratulations! You have sold the following item:<br>\r\n<br>\r\n\r\nItem Title: <a href='GET_VIEW_ITEM'>ITEM_TITLE</a><br><br>\r\n\r\nTo view the buyers detail and the details on this auction please <a href='http://www.2tradeit.co.nz/detailstatistics.php?mode=sold'>click here</a>.<br><br>\r\n\r\nRegards<br><br>\r\n$site_domain')";
$result=mysql_query($sql);

$sql="INSERT INTO mail_subjects VALUES (8, 'mail to seller', '', 'A Buyer brougt Your Item', '<table  bgcolor=#F8F8FA style=border-top:2px solid #979BB3;border-bottom:2px solid #979BB3; cellpadding=5 cellspacing=2 width=50%>\r\n<tr bgcolor=#EEEEF8><td colspan=2 align=center >Fixed Sale Announcement</td></tr>\r\n\r\n<tr><td colspan=2> Dear <sellername>,</td></tr>\r\n\r\n<tr><td colspan=2>Your Selling Item <b><itemname></b> (Id:<itemid>) is brought in Fixed Sale Method  </td></tr>\r\n\r\n\r\n<Buyer Details>\r\n\r\n<tr><td>Regards,<br>\r\n<sitename></td></tr></table>\r\n')";
$result=mysql_query($sql);

$sql="INSERT INTO mail_subjects VALUES (9, 'mail to seller(reserve price met)', '$adminemail', 'Reserve Price Met', '<table  bgcolor=#F8F8FA style=border-top:2px solid #979BB3;border-bottom:2px solid #979BB3; cellpadding=5 cellspacing=2 width=50% >\r\n<tr bgcolor=#EEEEF8><td colspan=2 align=center >Reserve Price Has Been Met</td></tr>\r\n\r\n<tr><td colspan=2> Dear <sellername>,</td></tr>\r\n\r\n<tr><td colspan=2>Your Selling Item <b><itemname></b> (Id:<itemid>) has met the reserve price.  </td></tr>\r\n\r\n\r\n<tr><td>\r\n<table width=80%>\r\n<tr> <td>Item Id  </td><td>ITEM_ID</td></tr>\r\n<tr> <td>Item Title </td><td>ITEM_TITLE </td></tr>\r\n<tr> <td>Sale Price </td><td>SALE_PRICE </td></tr>\r\n<tr> <td>Reserve Price </td><td>RESERVE_PRICE </td></tr>\r\n</table>\r\n\r\n\r\n</td></tr>\r\n\r\n\r\n\r\n<tr><td>Regards,<br>\r\n<sitename></td></tr>\r\n</table>')";
$result=mysql_query($sql);

$sql="INSERT INTO mail_subjects VALUES (11, 'mail to buyer(Reserve Price Has not been Met )', '$adminemail', 'Reserve Price Has not been Met', 'Dear <username>,<br><br>\r\nReserve Price Has not been Met for this <itemname>(# <itemid>).<br><br>\r\n\r\nThank You\r\n$site_domain')";
$result=mysql_query($sql);

$sql="INSERT INTO mail_subjects VALUES (12, 'No Bid Placed for Your Auction', '$adminemail', 'Your Auction Closed', 'Dear <username>,<br><br>\r\nAuction <item_name>(# <itemid>) did not sell.  Feel free to relist your auction.<br><br>\r\nThank You<br>\r\n$site_domain')";
$result=mysql_query($sql);

$sql="INSERT INTO `mail_subjects` VALUES (13, 'mail to seller(Reserve Price Has not been Met )', '$adminemail', 'Reserve Price Has not been Met', 'Dear <username><br><br>\r\nReserve Price Has not been Met for this <itemname>(# <itemid>). Feel free to relist your auction.<br><br>Thank You<br>\r\nAj auction')";
$result=mysql_query($sql);

$sql="INSERT INTO mail_subjects VALUES (14, 'Out Bids Remainder', '$adminemail', 'Another user placed a bid', '<table><tr><td>Dear <user>,</td></tr><tr><td>Your opponant user has bidded more than yours.so proceed your bid further.</td></tr><tr><td>Regards,<br> Aj Auction </td></tr></table>')";
$result=mysql_query($sql);

$sql="INSERT INTO mail_subjects VALUES (16, 'Unpaid Item Remainder (mail to buyer)', '$adminemail', 'Your Auction Account Has Been Placed On-hold : Action Required', 'Dear <buyer>,<br>\r\n<msg> as send unpaid item remiander for item #  (<item_no>) .<br>Your account has been restricted and you will not be able to bid, buy or list on auction site. To avoid further retrictions please pay your fees today by following these steps....<br>\r\n step1.<br>\r\n step2.\r\n<br>\r\nIf you have already paid your eBay fees, please disregard this message. \r\n<br>\r\n<br>\r\n\r\nThank you, <br>\r\nAj auction\r\n')";
$result=mysql_query($sql);

$sql="INSERT INTO mail_subjects VALUES (17, 'Warning mail to seller to deliever item', '$adminemail', 'Your Auction Account Has Been Placed On-hold : Action Required', 'Dear <Seller>,<br>\r\nYou are late in delievering an item#(<item_no>) that was sold on <site>. <br>Your account has been restricted and you will not be able to bid, buy or list on auction site.To avoid further restrictions please deliever the item today.\r\n<br>\r\n<br>\r\nIf you have already delivered the item, please disregard this message. \r\n<br>\r\n<br>\r\n\r\nThank you, <br>\r\n<admin>\r\n')";
$result=mysql_query($sql);

$sql="INSERT INTO `mail_subjects` VALUES (18, 'Mail to seller', '$adminemail', 'Your Auction Closed', 'Dear NAME, <br><br>\r\nCongratulations! You Auction Closed Successfully:<br>\r\n<br>\r\n\r\nItem Title: <a href=<GET_VIEW_ITEM>><ITEM_TITLE></a><br><br>\r\n\r\nTo view the sellers detail and get information about this auction please <a href= <GET_VIEW_ITEM> >click here</a>.<br><br>\r\n\r\nRegards<br><br>\r\n<sitename>')";




$result=mysql_query($sql);

$sql="INSERT INTO mail_subjects VALUES (15, 'Listing Confirmation mail', '$adminemail', 'Your Listing in <site>', 'Dear <seller>,<br>\r\n<b>The following auction has been posted on <site>: </b><br><br>\r\nAuction Name: <b><auction_name></b><br>\r\nAuction Type: <b><auction_type></b><br>\r\nQuantity Offered: <b><quantity></b><br>\r\nCategory: <b><category></b><br> \r\nStarting Bid: <b><bid></b><br>\r\nBuy Now Option: <b>Available</b><br> \r\nReserve Price: <b><reserve></b><br>\r\nClosing Date: <b><closingdate></b><br>\r\n<a href=<site>/detail.php?item_id=<item_id>>Click to view the auction </a><br><br>\r\n\r\nThank you for your submission. <br>\r\n<b>The <site> staff </b>')";
$result=mysql_query($sql);


$sql="INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` ) 
VALUES (19, 'Admin verification', '$adminemail', 'Admin Verification', 'Dear Admin,<br>Below is the verification code which is the access key to you admin account in <site>.<br>Verification Code:<verify>\r\n<br>\r\nBest Regards.')";
$result=mysql_query($sql);


$sql="INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` ) 
VALUES (20, 'Last Login Ip', '$adminemail', 'Last Login Ip', 'Dear Admin,<br>\r\n<site> Admin panel\'s last login IP address is below.<br>Ip Address:<b><ip></b><br>\r\nBest Regards.\r\n')";
$result=mysql_query($sql);








$sql="DROP TABLE IF EXISTS `my_credit`";
$result=mysql_query($sql);
$sql="CREATE TABLE `my_credit` (
  `credit_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `type` varchar(20) NOT NULL default '',
  `amount` float NOT NULL default '0',
  UNIQUE KEY `credit_id` (`credit_id`)
) TYPE=MyISAM AUTO_INCREMENT=26" ;
$result=mysql_query($sql);
 

$sql="INSERT INTO `my_credit` (`credit_id`, `user_id`, `type`, `amount`) VALUES (1, 20, '', 12)";
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS `payment_details`";
$result=mysql_query($sql);
$sql="CREATE TABLE `payment_details` (
  `payment_id` int(11) NOT NULL auto_increment,
  `payment_gateway` varchar(100) NOT NULL default '',
  `item_id` int(11) NOT NULL default '0',
  `quantity` int(11) NOT NULL default '0',
  `payment_date` date NOT NULL default '0000-00-00',
  `seller_id` int(11) NOT NULL default '0',
  `buyer_id` int(11) NOT NULL default '0',
  `amount` int(11) NOT NULL default '0',
  UNIQUE KEY `payment_id` (`payment_id`)
) TYPE=MyISAM AUTO_INCREMENT=1";
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS `payment_gateway`";
$result=mysql_query($sql);
$sql="CREATE TABLE `payment_gateway` (
  `gateway_id` int(11) NOT NULL auto_increment,
  `payment_gateway` varchar(250) NOT NULL default '',
  `status` enum('Yes','No') NOT NULL default 'Yes',
  PRIMARY KEY  (`gateway_id`)
) TYPE=MyISAM AUTO_INCREMENT=14 ";
$result=mysql_query($sql);
 

$sql="INSERT INTO `payment_gateway` (`gateway_id`, `payment_gateway`, `status`) VALUES (1, 'Paypal', 'Yes')";
$result=mysql_query($sql);
$sql="INSERT INTO `payment_gateway` (`gateway_id`, `payment_gateway`, `status`) VALUES (2, 'INT-Gold', 'No')";
$result=mysql_query($sql);
$sql="INSERT INTO `payment_gateway` (`gateway_id`, `payment_gateway`, `status`) VALUES (3, 'E-Gold', 'No')";
$result=mysql_query($sql);
$sql="INSERT INTO `payment_gateway` (`gateway_id`, `payment_gateway`, `status`) VALUES (4, 'Money Bookers', 'No')";
$result=mysql_query($sql);
$sql="INSERT INTO `payment_gateway` (`gateway_id`, `payment_gateway`, `status`) VALUES (5, 'E-Bullion', 'No')";
$result=mysql_query($sql);
$sql="INSERT INTO `payment_gateway` (`gateway_id`, `payment_gateway`, `status`) VALUES (6, 'Stormpay', 'No')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS `placing_bid_item`";
$result=mysql_query($sql);

$sql="CREATE TABLE placing_bid_item (
  bid_id int(11) NOT NULL auto_increment,
  user_id int(11) NOT NULL default '0',
  item_id int(11) NOT NULL default '0',
  quantity int(11) NOT NULL default '0',
  bidding_date date NOT NULL default '0000-00-00',
  bidding_amount decimal(10,2) NOT NULL default '0.00',
  sale_date datetime NOT NULL default '0000-00-00 00:00:00',
  user_pos enum('No','Yes','Delete') NOT NULL default 'No',
  checkbid enum('yes','no') NOT NULL default 'no',
  duplicate_bidding_amt double NOT NULL default '0',
  deleted enum('No','Yes') NOT NULL default 'No',
  UNIQUE KEY bid_id (bid_id)
) TYPE=MyISAM";
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS `placing_item_bid`";
$result=mysql_query($sql);

$sql="CREATE TABLE placing_item_bid (
  item_id int(10) NOT NULL auto_increment,
  user_id int(10) NOT NULL default '0',
  category_id int(10) NOT NULL default '0',
  themes_id int(11) NOT NULL default '0',
  item_title varchar(55) NOT NULL default '',
  sub_title varchar(55) NOT NULL default '',
  item_counter_style enum('1','2') NOT NULL default '1',
  Quantity int(5) NOT NULL default '0',
  payment_gateway varchar(20) NOT NULL default '0.00',
  detailed_descrip longtext NOT NULL,
  item_specify enum('New','Used') NOT NULL default 'New',
  selling_method varchar(20) NOT NULL default '',
  min_bid_amount decimal(30,2) NOT NULL default '0.00',
  bid_increment double NOT NULL default '0',
  shipping_cost int(10) NOT NULL default '0',
  who_pay_shipping enum('Inclusive','Exclusive') NOT NULL default 'Inclusive',
  shipping_route varchar(50) NOT NULL default '',
  duration int(3) NOT NULL default '0',
  currency varchar(8) NOT NULL default '',
  reserve_price decimal(30,2) NOT NULL default '0.00',
  quick_buy_price decimal(30,2) NOT NULL default '0.00',
  bid_starting_date datetime NOT NULL default '0000-00-00 00:00:00',
  start_delay int(3) default '0',
  status enum('Active','Inactive','Closed','Sold','suspended','new') NOT NULL default 'new',
  picture1 varchar(200) NOT NULL default '',
  picture2 varchar(200) NOT NULL default '',
  picture3 varchar(200) NOT NULL default '',
  picture4 varchar(200) NOT NULL default '',
  picture5 varchar(200) NOT NULL default '',
  picture6 varchar(100) NOT NULL default '',
  picture7 varchar(100) NOT NULL default '',
  payment_name varchar(20) NOT NULL default '',
  quantity_sold int(11) NOT NULL default '0',
  clicks bigint(20) NOT NULL default '0',
  expire_date datetime NOT NULL default '0000-00-00 00:00:00',
  payment_id varchar(30) NOT NULL default '0',
  size_of_quantity varchar(15) NOT NULL default '',
  tax tinyint(4) NOT NULL default '0',
  no_of_repost tinyint(4) NOT NULL default '0',
  sale_price bigint(20) NOT NULL default '0',
  shipping_from_location varchar(50) NOT NULL default '',
  returns_accepted enum('No','Yes') NOT NULL default 'No',
  refund_days int(11) NOT NULL default '0',
  refund_method varchar(50) NOT NULL default '',
  payment_instructions varchar(255) NOT NULL default '',
  returnpolicy_instructions varchar(250) NOT NULL default '',
  listingdesinger enum('No','Yes') NOT NULL default 'No',
  privatelistings enum('No','Yes') NOT NULL default 'No',
  layout varchar(50) NOT NULL default '',
  crosspromote varchar(150) NOT NULL default '',
  payment_status ENUM( 'paid', 'unpaid' ) NOT NULL DEFAULT 'unpaid',
  PRIMARY KEY  (item_id),
  UNIQUE KEY item_id (item_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO placing_item_bid VALUES (560, 20, 2, 0, 'car', '', '1', 2, '', 'good looking', 'New', 'ads', '4567.00', '100', 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', '9865.00', '15000.00', '2005-10-19 07:18:59', 1, 'Closed', 'images.jpg', '', '', '', '', '', '', '', 0, 50, '2006-07-07 00:00:00', '', 'Pieces', 32, 0, 0, '', 'No', 0, '', '', '', 'No', 'No', '', '','unpaid')";
$result=mysql_query($sql);

$sql="INSERT INTO placing_item_bid VALUES (572, 20, 93, 0, 'car', '', '1', 2, '', 'good looking', 'New', 'ads', '20.00', '100', 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', '9865.00', '15000.00', '2005-10-19 07:18:59', 1, 'Active', 'images1.jpg', '', '', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 1, 0, '', 'No', 0, '', '', '', 'No', 'No', '', '','unpaid')";
$result=mysql_query($sql);

$sql="INSERT INTO placing_item_bid VALUES (635, 20, 10, 0, 'test', 'suntest', '1', 6, '', 'testing', 'New', 'dutch_auction', '1.00', '17', 0, 'Inclusive', '', 1, '£', '0.00', '0.00', '2006-06-30 12:57:25', 0, 'Active', 'images.jpg', '', '', '', '', '', '', '', 0, 63, '2006-07-20 12:57:25', '', '', 0, 0, 0, '', 'No', 0, 'Exchange', '', '', 'Yes', 'No', 'layout_standard.gif', '','unpaid')";
$result=mysql_query($sql);

$sql="INSERT INTO placing_item_bid VALUES (634, 20, 0, 0, 'testing', 'subtitle', '1', 4, '', 'description', 'New', 'dutch_auction','1.00', '17', 0, 'Inclusive', '', 1, '£', '3.00', '0.00', '2006-06-30 12:40:17', 0, 'new', 'images.jpg', '', '', '', '', '', '', '', 0, 1, '2006-07-01 12:40:17', '', '', 0, 0, 0, '', '', 0, 'Exchange', '', '', '', '', '', '','unpaid')";

$result=mysql_query($sql);
$sql="INSERT INTO placing_item_bid VALUES (637, 20, 19, 0, 'testing', 'subtesting2', '1', 1, '', 'fhsjhfjsdgjfhsjgfsh', 'New', 'auction', '3454.00', '555', 0, 'Inclusive', '', 1, '£', '34534.00', '0.00', '2006-07-04 12:56:55', 0, 'new', '2B035.jpg', 'images3.jpg', '', '', '', '', '', '', 0, 2, '2006-07-05 12:56:55', '', '', 0, 0, 0, '', '', 0, 'Exchange', '', '', '', '', '', '','unpaid')";
$result=mysql_query($sql);
$sql="INSERT INTO placing_item_bid VALUES (633, 20, 0, 1, 'testing item', 'subtitle testing', '1', 5, '', 'description', 'New', 'dutch_auction', '123.00', '5', 0, 'Inclusive', '', 1, '£', '300.00', '0.00', '2006-06-30 12:09:26', 0, 'new', 'images4.jpg', '', '', '', '', '', '', '', 0, 1, '2006-07-01 12:09:26', '', '', 0, 0, 0, '', '', 0, 'Exchange', '', '', 'Yes', 'Yes', 'layout_top.gif', '','unpaid')";
$result=mysql_query($sql);
$sql="INSERT INTO placing_item_bid VALUES (632, 20, 19, 0, 'testing', 'subtitle34', '1', 1, '1', 'description description&nbsp; description description description description description', 'New', 'auction', '12.00', '17', 33, 'Inclusive', ' 1,2,5', 1, '£', '1200.00', '4000.00', '2006-06-23 12:01:18', 0, 'new', '2B035.jpg', '', '', '', '', '', '', '', 0, 1, '2006-06-24 12:01:18', 'skpriya@yahoo.com', '', 4, 0, 0, '', '', 1, 'Merchandise Credit', ' payment', 'return', '', 'Yes', '', '','unpaid')";
$result=mysql_query($sql);
$sql="INSERT INTO placing_item_bid VALUES (588, 1, 12, 1, 'Music', '', '1', 1, '14', '<P align=center><FONT color=#33cc00 size=7>I will</FONT></P>\r\n<P align=center><FONT color=#ffff00 size=7>sing</FONT></P>\r\n<P align=center><FONT color=#ff0000 size=7>for you</FONT></P>', 'New', 'auction', '20.00', '1', 14, 'Inclusive', ' 1,2,3,4,5,6', 55, '£', '12.00', '34.00', '2006-06-07 13:44:58', 0, 'Active', 'images.jpg', '', '', '', '', '', '', '', 0, 6, '2006-08-01 13:44:58', '', '', 12, 0, 0, '', '', 9, 'Money Back', ' fggertert\r\nPayment Instructions', 'werrsdfg', 'Yes', '', '', '','unpaid')";
$result=mysql_query($sql);
$sql="INSERT INTO placing_item_bid VALUES (587, 1, 0, 1, 'Testing', '', '1', 1, '14', '', 'New', '', '20.00', '0', 0, 'Inclusive', '', 0, '£', '0.00', '0.00', '2006-06-07 13:44:21', 0, 'new', '2B035.jpg', '', '', '', '', '', '', '', 0, 0, '2006-06-07 13:44:21', '', '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '','unpaid')";
$result=mysql_query($sql);

$sql="INSERT INTO placing_item_bid VALUES (586, 1, 18, 1, 'test', '', '1', 1, '14', 'test', 'New', 'auction', '20.00', '1', 0, 'Inclusive', ' 1,6', 5, '£', '12.00', '12.00', '2006-06-07 13:42:15', 0, 'Active', 'images.jpg', '', '', '', '', '', '', '', 0, 3, '2006-06-12 13:42:15', '', '', 0, 0, 0, '', '', 0, 'Exchange', '', '', '', '', '', '','unpaid')";
$result=mysql_query($sql);
$sql="INSERT INTO placing_item_bid VALUES (585, 1, 19, 0, 'Testing', '', '1', 1, '14', '', 'Used', 'auction', '20.00', '100', 0, 'Inclusive', '', 5, '0', '0.00', '0.00', '2006-06-07 13:19:25', 0, 'Active', 'images.jpg', '', '', '', '', '', '', '', 0, 2, '2006-06-12 13:19:25', '', '', 0, 0, 0, '', '', 5, 'Money Back', ' description', 'testing', '', '', '', '','unpaid')";
$result=mysql_query($sql);





$sql="DROP TABLE IF EXISTS `referral_commission`";
$result=mysql_query($sql);
$sql="CREATE TABLE `referral_commission` (
  `ref_id` tinyint(11) NOT NULL auto_increment,
  `intro_id` tinyint(11) NOT NULL default '0',
  `user_id` tinyint(11) NOT NULL default '0',
  `referral_commission` tinyint(11) NOT NULL default '0',
  `ref_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`ref_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS `save_searchresult`";
$result=mysql_query($sql);
$sql="CREATE TABLE `save_searchresult` (
  `sid` int(11) NOT NULL auto_increment,
  `user_id` varchar(100) NOT NULL default '',
  `save_name` varchar(100) NOT NULL default '',
  `save_query` text NOT NULL,
  PRIMARY KEY  (`sid`)
) TYPE=MyISAM AUTO_INCREMENT=50 ";
$result=mysql_query($sql);




$sql="DROP TABLE IF EXISTS `settings`";
$result=mysql_query($sql);
$sql="CREATE TABLE `settings` (
  `egold_no` varchar(10) NOT NULL default '',
  `evocash_no` varchar(10) NOT NULL default '',
  `intgold_no` varchar(10) NOT NULL default '',
  `stormpay_no` varchar(50) NOT NULL default '',
  `admin_email` varchar(100) default NULL
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO `settings` (`egold_no`, `evocash_no`, `intgold_no`, `stormpay_no`, `admin_email`) VALUES ('11111', '222', '333', '555', 'ss@ss.com')";
$result=mysql_query($sql);
$sql="INSERT INTO `settings` (`egold_no`, `evocash_no`, `intgold_no`, `stormpay_no`, `admin_email`) VALUES ('11111', '222', '333', '555', 'ss@ss.com')";
$result=mysql_query($sql);
$sql="INSERT INTO `settings` (`egold_no`, `evocash_no`, `intgold_no`, `stormpay_no`, `admin_email`) VALUES ('11111', '222', '333', '555', 'ss@ss.com')";
$result=mysql_query($sql);
$sql="INSERT INTO `settings` (`egold_no`, `evocash_no`, `intgold_no`, `stormpay_no`, `admin_email`) VALUES ('11111', '222', '333', '555', 'ss@ss.com')";
$result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS `site_announcement`";
$result=mysql_query($sql);
$sql="CREATE TABLE `site_announcement` (
  `id` int(11) NOT NULL default '0',
  `title` varchar(50) NOT NULL default '',
  `site_announcement` text NOT NULL,
  UNIQUE KEY `index` (`id`)
) TYPE=MyISAM";
$result=mysql_query($sql);



$sql="INSERT INTO `site_announcement` (`id`, `title`, `site_announcement`) VALUES (1, '', 'Welcome to Our site. This Non Stop Auction. You can Effectively Post your Auctions , Fixed Sales , and other Items')";
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `pref_id` int(11) NOT NULL default '0',
  `pref_name` varchar(50) NOT NULL default '',
  `pref_value` varchar(100) NOT NULL default '',
  UNIQUE KEY `pref_id` (`pref_id`)
) TYPE=MyISAM";
$result=mysql_query($sql);




$sql="CREATE TABLE `state_master` (
  `state_id` bigint(20) NOT NULL auto_increment,
  `state` varchar(50) default NULL,
  `country_id` bigint(20) default NULL,
  PRIMARY KEY  (`state_id`)
) TYPE=MyISAM AUTO_INCREMENT=3405 " ;
$result=mysql_query($sql);



$sql="INSERT INTO `state_master` VALUES (461, 'Alberta', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (462, 'British Columbia', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (463, 'Manitoba', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (464, 'New Brunswick', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (465, 'Newfoundland', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (466, 'North West Territories', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (467, 'Nova Scotia', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (468, 'Nunavut', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (469, 'Ontario', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (470, 'Prince Edward Island', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (471, 'Quebec', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (472, 'Saskatchewan', 38)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (473, 'Yukon Territory', 38)";
$result=mysql_query($sql);

$sql="INSERT INTO `state_master` VALUES (3215, 'Alabama', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3216, 'Alaska', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3217, 'Arizona', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3218, 'Arkansas', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3219, 'California', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3220, 'Colorado', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3221, 'Connecticut', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3222, 'Delaware', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3223, 'District of Columbia', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3224, 'Florida', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3225, 'Georgia', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3226, 'Hawaii', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3227, 'Idaho', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3228, 'Illinois', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3229, 'Indiana', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3230, 'Iowa', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3231, 'Kansas', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3232, 'Kentucky', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3233, 'Louisiana', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3234, 'Maine', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3235, 'Maryland', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3236, 'Massachusetts', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3237, 'Michigan', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3238, 'Minnesota', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3239, 'Mississippi', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3240, 'Missouri', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3241, 'Montana', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3242, 'Nebraska', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3243, 'Nevada', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3244, 'New Hampshire', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3245, 'New  Jersey', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3246, 'New Mexico', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3247, 'New York', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3248, 'North Carolina', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3249, 'North Dakota', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3250, 'Ohio', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3251, 'Oklahoma', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3252, 'Oregon', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3253, 'Pennsylvania', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3254, 'Rhode Island', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3255, 'South Carolina', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3256, 'South Dakota', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3257, 'Tennessee', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3258, 'Texas', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3259, 'Utah', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3260, 'Vermont', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3261, 'Virginia', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3262, 'Washington', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3263, 'West Virginia', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3264, 'Wisconsin', 224)";
$result=mysql_query($sql);
$sql="INSERT INTO `state_master` VALUES (3265, 'Wyoming', 224)";
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS storefronts";
$result=mysql_query($sql);

$sql="CREATE TABLE storefronts (
  id int(11) NOT NULL auto_increment,
  user_id int(11) NOT NULL default '0',
  planid tinyint(4) NOT NULL default '0',
  logo varchar(150) NOT NULL default '',
  description text NOT NULL,
  store_name varchar(150) NOT NULL default '',
  status enum('New','disable','enable','suspend') NOT NULL default 'New',
  statususer enum('active','inactive') NOT NULL default 'active',
  UNIQUE KEY id (id)
) TYPE=MyISAM";
$result=mysql_query($sql);

$sql="INSERT INTO storefronts VALUES (1, 20, 5, '', 'Stores Description', 'testing Stores', 'enable')";
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS `terms`";
$result=mysql_query($sql);
$sql="CREATE TABLE `terms` (
  `term_id` int(11) NOT NULL auto_increment,
  `term_title` varchar(30) NOT NULL default '',
  `term_body` text NOT NULL,
  UNIQUE KEY `term_id` (`term_id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ";
$result=mysql_query($sql);


$sql="INSERT INTO `terms` (`term_id`, `term_title`, `term_body`) VALUES (1, 'Your Terms', 'Terms ')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS `themes_master`";
$qry=mysql_query($sql);
$sql="CREATE TABLE `themes_master` (
  `themes_id` bigint(20) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL default '0',
  `theme_name` varchar(50) NOT NULL default '',
  `themes` varchar(100) NOT NULL default '',
  `theme_top_img` varchar(100) NOT NULL default '',
  `theme_content_img` varchar(100) NOT NULL default '',
  `theme_bottom_img` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`themes_id`)
) TYPE=MyISAM";
$qry=mysql_query($sql);
$sql="INSERT INTO `themes_master` (`themes_id`, `category_id`, `theme_name`, `themes`, `theme_top_img`, `theme_content_img`, `theme_bottom_img`) VALUES (1, 23, 'Anitiques: Art', 'themes1.gif', 'theme_top.gif', 'theme_content.gif', 'theme_bot.gif'),
(3, 21, 'Anitiques: Art', 'fram1_thump.jpg', 'fram3_01.jpg', 'fram3_03.jpg', 'fram3_04.jpg');";
$qry=mysql_query($sql);

$sql="DROP TABLE IF EXISTS `user_alert`";
$result=mysql_query($sql);

$sql="CREATE TABLE `user_alert` (
  `alert_id` int(11) NOT NULL auto_increment,
  `seller_id` int(11) NOT NULL default '0',
  `buyer_id` int(11) NOT NULL default '0',
  `item_id` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  `alert_type` enum('R','P','D') NOT NULL default 'R',
  `delmode` int(5) NOT NULL default '1',
  PRIMARY KEY  (`alert_id`)
) TYPE=MyISAM AUTO_INCREMENT=38" ;
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS `user_registration`";
$result=mysql_query($sql);
$sql="CREATE TABLE user_registration (
  user_id int(10) NOT NULL auto_increment,
  intro_id bigint(20) NOT NULL default '0',
  plan_id int(10) NOT NULL default '0',
  member_account enum('1','2','3') NOT NULL default '1',
  user_name varchar(25) NOT NULL default '',
  date_of_birth date NOT NULL default '0000-00-00',
  email varchar(35) NOT NULL default '',
  first_name varchar(25) NOT NULL default '',
  last_name varchar(25) NOT NULL default '',
  html_profile varchar(100) NOT NULL default '',
  address varchar(100) NOT NULL default '',
  city varchar(20) NOT NULL default '',
  state varchar(20) NOT NULL default '',
  pin_code varchar(15) NOT NULL default '',
  country varchar(50) NOT NULL default '0',
  home_phone bigint(20) NOT NULL default '0',
  work_phone bigint(20) NOT NULL default '0',
  password varchar(50) NOT NULL default '',
  verified enum('yes','no') NOT NULL default 'no',
  veri_code varchar(30) NOT NULL default '',
  status enum('Active','Inactive','suspended','new') NOT NULL default 'Inactive',
  date_of_registration datetime NOT NULL default '0000-00-00 00:00:00',
  expire_date date NOT NULL default '0000-00-00',
  last_login_date date NOT NULL default '0000-00-00',
  Onlinestatus enum('Online','Offline') NOT NULL default 'Offline',
  ip_address varchar(15) NOT NULL default '',
  email_enable_status enum('Yes','No') NOT NULL default 'Yes',
  paid enum('No','Yes') NOT NULL default 'Yes',
  original_account enum('1','2','3') NOT NULL default '1',
  trusted enum('inactive','active','trusted') NOT NULL default 'inactive',
  sell_permission enum('yes','no') NOT NULL default 'yes',
  PRIMARY KEY  (user_id),
  UNIQUE KEY user_id (user_id),
  UNIQUE KEY user_name (user_name,email,status)
) TYPE=MyISAM";
$result=mysql_query($sql);

$sql="INSERT INTO `user_registration` (`user_id`, `intro_id`, `plan_id`, `member_account`, `user_name`, `email`, `first_name`, `last_name`, `html_profile`, `address`, `city`, `state`, `pin_code`, `country`, `home_phone`, `work_phone`, `password`, `verified`, `veri_code`, `status`, `date_of_registration`, `expire_date`, `last_login_date`, `Onlinestatus`, `ip_address`, `email_enable_status`, `paid`, `original_account`, `trusted`) VALUES (20, 0, 4, '2', 'demo', 'skpriyamari@gmail.com', 'demo2341', 'demo2341', 'gdfgdfg', 'fghgjkd2341', 'tyughgd41', '3223', '123456', 41, 48362147, 2147483647, 'demo', 'yes',
 'fe01ce2a7fbac8f', 'Active', '2005-06-28', '0000-00-00', '2005-10-19', 'Online', '61.247.255.242', 'Yes', 'Yes', '1', 'inactive')";
 $result=mysql_query($sql);
 $sql="INSERT INTO `user_registration` (`user_id`, `intro_id`, `plan_id`, `member_account`, `user_name`, `email`, `first_name`, `last_name`, `html_profile`, `address`, `city`, `state`, `pin_code`, `country`, `home_phone`, `work_phone`, `password`, `verified`, `veri_code`, `status`, `date_of_registration`, `expire_date`, `last_login_date`, `Onlinestatus`, `ip_address`, `email_enable_status`, `paid`, `original_account`, `trusted`) VALUES (1, 0, 4, '2', 'admin', 'skpriyamari@gmail.com', 'demo2341', 'demo2341', 'gdfgdfg', 'fghgjkd2341', 'tyughgd41', '3223', '123456', 41, 48362147, 2147483647, 'admin', 'yes',
 'fe01ce2a7fbac8f', 'Active', '2005-06-28', '0000-00-00', '2005-10-19', 'Online', '61.247.255.242', 'Yes', 'Yes', '1', 'trusted')";
 $result=mysql_query($sql);


$sql="DROP TABLE IF EXISTS `blocked_ip`";
$result=mysql_query($sql);

$sql="CREATE TABLE blocked_ip (
  block_id int(11) NOT NULL auto_increment,
  blocked_ip varchar(50) NOT NULL default '',
  PRIMARY KEY  (block_id)
) TYPE=MyISAM";
$result=mysql_query($sql);
$sql="INSERT INTO blocked_ip VALUES (3, '192.168.1.1')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS `auction_duration`";
$result=mysql_query($sql);


$sql="CREATE TABLE auction_duration (
  duration_id smallint(6) NOT NULL auto_increment,
  duration smallint(6) NOT NULL default '0',
  PRIMARY KEY  (duration_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO auction_duration VALUES (6, 6)";
$result=mysql_query($sql);
$sql="INSERT INTO auction_duration VALUES (5, 53)";
$result=mysql_query($sql);
$sql="INSERT INTO auction_duration VALUES (3, 1)";
$result=mysql_query($sql);
$sql="INSERT INTO auction_duration VALUES (4, 3)";
$result=mysql_query($sql);

      
$sql="DROP TABLE IF EXISTS plan";
 $result=mysql_query($sql);
$sql="CREATE TABLE plan (
  plan_id tinyint(4) NOT NULL auto_increment,
  scheme varchar(25) default NULL,
  plan_description varchar(200) NOT NULL default '',
  amount decimal(10,2) default NULL,
  period smallint(4) default NULL,
  period_type varchar(10) default NULL,
  status enum('active','inactive') NOT NULL default 'active',
  KEY plan_id (plan_id)
) TYPE=MyISAM";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS shipping_location";
$result=mysql_query($sql);
$sql="CREATE TABLE shipping_location (
  ship_id bigint(20) NOT NULL auto_increment,
  location varchar(255) NOT NULL default '',
  PRIMARY KEY  (ship_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO shipping_location VALUES (1, 'World Wide')";
$result=mysql_query($sql);
$sql="INSERT INTO shipping_location VALUES (2, 'USA')";
$result=mysql_query($sql);
$sql="INSERT INTO shipping_location VALUES (3, 'United Kindom')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS small_banner";
$result=mysql_query($sql);
$sql="CREATE TABLE small_banner (
  banid int(11) NOT NULL auto_increment,
  banner varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  status enum('enable','disable') NOT NULL default 'enable',
  PRIMARY KEY  (banid)
) TYPE=MyISAM";
$result=mysql_query($sql);

$sql="INSERT INTO small_banner VALUES (1, 'images/button---1.gif', '', '')";
$result=mysql_query($sql);
$sql="INSERT INTO small_banner VALUES (8, 'images/ban2.gif', 'http://', 'enable')";
$result=mysql_query($sql);
$sql="INSERT INTO small_banner VALUES (3, 'images/ban3.gif', 'fdgdfgdfg.com', 'enable')";
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS retraction";
$result=mysql_query($sql);
$sql="CREATE TABLE retraction (
  retrack_id int(11) NOT NULL auto_increment,
  item_id bigint(20) NOT NULL default '0',
  user_id bigint(20) NOT NULL default '0',
  retrack_date datetime NOT NULL default '0000-00-00 00:00:00',
  reason varchar(50) NOT NULL default '',
  retrack_amt bigint(20) NOT NULL default '0',
  PRIMARY KEY  (retrack_id)
) TYPE=MyISAM";
$result=mysql_query($sql);


$sql="INSERT INTO plan VALUES (4, 'gdfgdf', 'An ideal solution for lower-volume sellers who already sell on eBay but want to take the next step with an easy-to-use, customizable Web store.', '123.00', 1, '1', 'active')";
$result=mysql_query($sql);
$sql="INSERT INTO plan VALUES (5, 'Diamand', '', '1000.00', 12, NULL, 'active')"; 
$result=mysql_query($sql);
  

$sql="DROP TABLE IF EXISTS `watch_list`";
$result=mysql_query($sql);
$sql="CREATE TABLE `watch_list` (
  `watchlist_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `item_id` int(11) NOT NULL default '0',
  UNIQUE KEY `watchlist_id` (`watchlist_id`)
) TYPE=MyISAM AUTO_INCREMENT=492" ;
$result=mysql_query($sql);

$sql="DROP TABLE IF EXISTS `meta_tag`";
$result=mysql_query($sql);
$sql="CREATE TABLE meta_tag (
  key_id int(5) NOT NULL auto_increment,
  key_s varchar(100) NOT NULL default '',
  PRIMARY KEY  (key_id)
) TYPE=MyISAM COMMENT='key words of meta tag' ";
$result=mysql_query($sql);

$sql="INSERT INTO meta_tag VALUES (1, 'auction,advance,')";
$result=mysql_query($sql);



$sql="DROP TABLE IF EXISTS `tbl_ip`";
$result=mysql_query($sql);
$sql="CREATE TABLE `tbl_ip` (
  `id` bigint(20) NOT NULL auto_increment,
  `admin_id` bigint(20) NOT NULL default '0',
  `user_ip` varchar(50) NOT NULL default '',
  `ip_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM";
$result=mysql_query($sql);



#
# Table structure for table `speciliaty`
#

$sql="DROP TABLE IF EXISTS `speciliaty`";
$result=mysql_query($sql);
$sql="CREATE TABLE `speciliaty` (
  `id` tinyint(4) NOT NULL auto_increment,
  `link_name` varchar(100) NOT NULL default '',
  `link` varchar(100) NOT NULL default '',
  `icon` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM";
$result=mysql_query($sql);

#
# Dumping data for table `speciliaty`
#

$sql="INSERT INTO `speciliaty` (`id`, `link_name`, `link`, `icon`) VALUES (1, 'link1', 'www.ajsquare.com', '')";
$result=mysql_query($sql);
$sql="INSERT INTO `speciliaty` (`id`, `link_name`, `link`, `icon`) VALUES (2, 'link2', 'www.ajauctionpro.com', '')";
$result=mysql_query($sql);


$sql="ALTER TABLE `admin_earnings` ADD `item_id` INT NOT NULL" ;
$sqlqry=mysql_query($sql);

$sql="ALTER TABLE `storefronts` ADD `store_start_date` DATETIME NOT NULL ,
ADD `store_end_date` DATETIME NOT NULL" ;
$sqlqry=mysql_query($sql);


$sql="ALTER TABLE `auction_fees` ADD `feestatus` ENUM( '0', '1' ) DEFAULT '0' NOT NULL" ;
$sqlqry=mysql_query($sql);


//Added On 22/11/07//
$sql="ALTER TABLE `admin_earnings` CHANGE `amount` `amount` FLOAT( 7, 2 ) DEFAULT '0' NOT NULL ";
$sqlqry=mysql_query($sql);

$sql="ALTER TABLE `pay_transaction` CHANGE `trans_amount` `trans_amount` FLOAT( 7, 2 ) DEFAULT '0' NOT NULL ";
$sqlqry=mysql_query($sql);


$sql="ALTER TABLE `placing_item_bid` ADD `cur_price` FLOAT( 7, 2 ) DEFAULT '0' NOT NULL";
$sqlqry=mysql_query($sql);

$sql=" ALTER TABLE `want_it_now` CHANGE `response_date` `response_date` DATETIME DEFAULT '0000-00-00' NOT NULL";
$sqlqry=mysql_query($sql);


$sql="ALTER TABLE `placing_item_bid` CHANGE `shipping_cost` `shipping_cost` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL";
$sqlqry=mysql_query($sql);

$sql="ALTER TABLE `placing_item_bid` CHANGE `tax` `tax` FLOAT( 3, 2 ) DEFAULT '0' NOT NULL";
$sqlqry=mysql_query($sql);

$sql="ALTER TABLE `placing_item_bid` CHANGE `sale_price` `sale_price` DOUBLE( 7, 2 ) DEFAULT '0' NOT NULL"; 
$sqlqry=mysql_query($sql);
 
 
$sql="ALTER TABLE `placing_item_bid` ADD `videofile` TEXT NOT NULL";
$sqlqry=mysql_query($sql);

$sql="ALTER TABLE `placing_item_bid` ADD `videolink` VARCHAR( 150 ) NOT NULL";
$sqlqry=mysql_query($sql);
 
 

//Added On 22/11/07//

  

  
/*Installation notification mail code begining*/
		$idate=date("Y-m-d");
		$mailfrom=$adminemail;
		$mailsubject="$site_domain Installation";
		$message="<table><tr><td>AJAUCTION Installation Detials	</td></tr>";
		$message.="<tr><td>Script Purchased for domain : $dname</td></tr>";
		$message.="<tr><td>Script Installed domain name : $domainname</td></tr>";
		$message.="<td><tD>Installation Date : $idate</tD></tr></table>";
		$email="install@ajsquare.net";			
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: ". $mailfrom."\r\n";		
//	    $mail=mail($email,$mailsubject,$message,$headers);
/*Installation notification mail code ending*/

  


//echo "<br>Database tables created... A new file vars.php has been created, plz don't delete that file and you can delete the installation files";
	

		$msg="";  
		//echo "<br>Database tables created... A new file vars.php has been created, plz don't delete that file and you can delete the installation files";
		if(is_writable("include/vars.php"))
		{
		$f=fopen("include/vars.php","w");
	fwrite($f,"<?php \n");
	fwrite($f,"//***************** Do not Edit / Change anything in this file ********************// \n");
	fwrite($f,"$"."sitename='".$domainname."';\n");
	fwrite($f,"$"."dbhost='".$dhost."';\n");
	fwrite($f,"$"."dbname='".$dname."';\n");
	fwrite($f,"$"."dbuser='".$duser."';\n");
	fwrite($f,"$"."dbpass='".$dpass."';\n");
	fwrite($f,"$"."adminmail='".$adminemail."';\n");
	fwrite($f,"?> \n");
	fclose($f);
		}
		else
		$first=1;
		
		
		$msg="<br>Database tables created... ";
		if($first==1)
		{
		$msg.="<br><br><font color=red>There is some error in creating the following files. <br> Assign write permission to the following files and try install again.</font><ol type=1> ";
		if($first==1)
		$msg.="<li>include/vars.php</li>";
		$msg.="</ol>";
		}
		else
		$msg.=" A new file vars.php has been created, please don't delete that file and you can delete the installation files";
		echo '<td width="74%" rowspan="2" valign="top" align="center" height="259">
<table width="90%" border="0" cellpadding="0" cellspacing="0" height="259">
          <tr>
            <td colspan="2" valign="top"><div align="left" style="font-family:Arial; font-size:14px; font-weight:500; padding-top:15px; padding-bottom:5px; padding-left:10px;">';
			
			if($first==1)
						echo 'Error In Insallation';
			else
					echo 'Installation Completed';
			echo '</div></td>
          </tr>
          <tr>
            <td width="1"><img src="images/spacer1.gif" / width="1px" height="280px"></td>
            <td width="447" valign="middle"><table width="400" align="center"><tr>
            <td colspan="2" valign="top"><div align="left" style="font-family:Arial; font-size:14px; font-weight:500; padding-top:15px; padding-bottom:5px; ">';
			echo $msg;
			
			echo '</div></td></tr></table></td></tr></table></td>';
}
	else {
	echo '<td width="74%" rowspan="2" valign="top" align="center" height="259">
<table width="90%" border="0" cellpadding="0" cellspacing="0" height="259">
          <tr>
            <td colspan="2" valign="top"><div align="left" style="font-family:Arial; font-size:14px; font-weight:500; padding-top:15px; padding-bottom:5px; padding-left:10px;">';
		echo '<font color=red>Erron in DB Connection!</font>';
		echo '</div></td>
          </tr>
          <tr>
            <td width="1"><img src="images/spacer.gif" / width="1px" height="280px"></td>
            <td width="447" valign="middle"><table width="400" align="center"><tr>
            <td colspan="2" valign="top"><div align="left" style="font-family:Arial; font-size:14px; font-weight:500; padding-top:15px; padding-bottom:5px; ">';
		echo "<br>Unable to Connect to the Database, Please Check the Servername and Database Name and Username and Password<br>";
		echo "<br><center><a href='#' onclick=history.go(-1)>Back</a></center>";
		echo '</div></td></tr></table></td></tr></table></td>';
	}
	

}
?>

			
			<!--</td>
          </tr>
          <tr>
            <td colspan="2"><div align="right" style="padding-right:10px"><img src="images/btn_next.gif" width="83" height="33" hspace="3" vspace="3" /><img src="images/btn_cancel.gif" width="83" height="33" hspace="3" vspace="3" /></div></td>
          </tr>
        </table>-->
      </tr>
      <tr>
        <td style="padding-left:12px;"><img src="images/img_creative.jpg" width="180" height="89" / style="padding-left:8px; padding-top:12px"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="1"><img src="images/spacer.gif" / width="1px" height="55px"></td>
    <td><div align="center">&copy;&nbsp;Copy Right <?php=date("Y")?> AJ Square INC</div></td>
  </tr>
</table>
</center>
</body>
</html>



<script language="javascript">
function checkMe()
{
		if(document.getElementById)
		{
				if((document.getElementById("txtKey").value).length!=4 || (document.getElementById("txtKey0").value).length!=4 || (document.getElementById("txtKey1").value).length!=4 || (document.getElementById("txtKey2").value).length!=4)		
				{
					document.getElementById("btnSubmit").disabled=true;
					document.getElementById("btnSubmit").style.cursor="default";
				}
				else
				{
				document.getElementById("btnSubmit").disabled=false;
				document.getElementById("btnSubmit").style.cursor="pointer";
				//document.getElementById("btnSubmit").focus();
				}
		
		}
		else if(document.all)
		{
				if(document.all.txtKey.value.length!=4 || document.all.txtKey0.value.length!=4 || document.all.txtKey1.value.length!=4 || document.all.txtKey2.value.length!=4 ) 
				{
				document.all.btnSubmit.disabled=true;
				document.getElementById("btnSubmit").style.cursor="default";
				}
				else
				{
				document.all.btnSubmit.disabled=false;
				document.getElementById("btnSubmit").style.cursor="pointer";					
				//document.all.btnSubmit.focus();				
				}
		
		}
		}
function validateKey()
{
var FSO,Fl,Fld,pdb="",s=0,d,fdb="",sdb="",tdb="",ldb="",fds=0,sds=0,tds=0,lds=0;
key=document.getElementById("key").value;
keybup=key;
pdr=key.substr(0,16);
for(i=15;i>=0;i--)
{
	if(pdr.substr(i,1)=="1")
		d=1;
	else
		d=0;
	
	if(d!=0)
	s=s+Math.pow(2,i);
pdb=pdb+pdr.substr(i-1,1);
}
ss=""+s;
arr=new Array();

for(i=0;i<=3;i++)
{
//alert(key.substr((i+1)*16,16));
//alert(key.substr((i+1)*16,16)+"==>"+parseInt(ss.substr(i,1))-1);
arr[parseInt(ss.substr(i,1))-1]=key.substr((i+1)*16,16);

}
fdr=arr[0];
sdr=arr[1];
tdr=arr[2];
ldr=arr[3];
for(i=15;i>=0;i--)
{
	if(fdr.substr(i,1)=="1")
		d=1;
	else
		d=0;
	
	if(d!=0)
	fds=fds+Math.pow(2,i);
fdb=fdb+fdr.substr(i-1,1);

	if(sdr.substr(i,1)=="1")
		d=1;
	else
		d=0;
	
	if(d!=0)
	sds=sds+Math.pow(2,i);
sdb=sdb+sdr.substr(i-1,1);



	if(tdr.substr(i,1)=="1")
		d=1;
	else
		d=0;
	
	if(d!=0)
	tds=tds+Math.pow(2,i);
tdb=tdb+tdr.substr(i-1,1);


	if(ldr.substr(i,1)=="1")
		d=1;
	else
		d=0;
	
	if(d!=0)
	lds=lds+Math.pow(2,i);
ldb=ldb+ldr.substr(i-1,1);

}
/*document.write(fds);
document.write(sds);
document.write(tds);
document.write(lds);*/
if(parseInt(document.getElementById("txtKey").value)==fds &&  parseInt(document.getElementById("txtKey0").value)==sds &&  parseInt(document.getElementById("txtKey1").value)==tds &&  parseInt(document.getElementById("txtKey2").value)==lds )
{
document.getElementById("status").value=1;
}
else
{
document.getElementById("status").value=0;
}
document.getElementById("page").value=2;
return true;
//alert(document.getElementById("key").value);
//return false;
}
function validate()
{


if(document.getElementById("txtHostName").value=="")
{
alert("Host Name should not be empty");
document.getElementById("txtHostName").focus();
return false;
}

if(document.getElementById("txtDatabaseName").value=="")
{
alert("Database Name should not be empty");
document.getElementById("txtDatabaseName").focus();
return false;
}

//if(document.getElementById("txtDatabaseUserName")
//txtDatabasePassword

document.getElementById("page").value=3;

return true;
}
function validate1()
{
var dn="",dn1="",i=0;
dn1=document.getElementById("hdomain").value;
var xxx="";
for(i=1;i<=(dn1.length)/3;i++)
{
xxx+=String.fromCharCode(dn1.substr((i-1)*3,3));
}
alert(xxx);
if(document.getElementById("txtDomainName").value=="")
{
alert("Domain Name should not be empty");
document.getElementById("txtDomainName").focus();
return false;
}
var wl="";
wl=""+window.location;
if(wl.indexOf("localhost")==-1)
if(document.getElementById("txtDomainName").value!=xxx || wl.indexOf(xxx)==-1)
{

alert("Script wasn't purchased for domain '"+document.getElementById("txtDomainName").value+"'. Please contact vendor for further details");
document.getElementById("txtDomainName").focus();
return false;
}
if(document.getElementById("txtAdminEmail").value=="")
{
alert("Admin Mail should not be empty");
document.getElementById("txtAdminEmail").focus();
return false;
}

if(document.getElementById("txtUserName").value=="")
{
alert("Admin Username should not be empty");
document.getElementById("txtUserName").focus();
return false;
}

if(document.getElementById("txtPassword").value=="")
{
alert("Admin Password should not be empty");
document.getElementById("txtPassword").focus();
return false;
}
if(document.getElementById("txtConfirmPassword").value=="")
{
alert("Confirm password should not be empty");
document.getElementById("txtConfirmPassword").focus();
return false;
}

if(document.getElementById("txtPassword").value!=document.getElementById("txtConfirmPassword").value)
{
alert("Invalid Confirm Password");
return false;
}
document.getElementById("page").value=4;
return true;
}
</script>