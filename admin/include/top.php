<?php
/***************************************************************************
 *File Name				:top.php
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
<?php 
	require 'include/connect.php';
	require 'include/getdatedifference.php';
	$username= $_SESSION["adminuser"] ;
	if(empty($username))
	{
	$url="index.php";
	echo '<meta http-equiv="refresh" content="0;url='.$url.'">';
	echo "<font size=+1 color=#003366>Loading....</font>";
	exit();
	}
	
		$sitename_sql="select * from admin_settings where set_id='47'";
		$sitename_sqlqry=mysql_query($sitename_sql);
		$sitename_fetch=mysql_fetch_array($sitename_sqlqry);
		$sitename=$sitename_fetch['set_value'];
		
	$ares=mysql_query("select * from admin where user_name='$username'");
	$arow=mysql_fetch_array($ares);
	$admin=$arow['admin_id'];
	function getval($admin,$tab)
	{
	$gsql="select * from subadmin where userid='$admin' and table_name='$tab'";
	$gresult=mysql_query($gsql);
	$grow=mysql_fetch_array($gresult);
	$gval1=$grow['ad'];
	$gval2=$grow['ed'];
	$gval3=$grow['del'];
	$gval4=$grow['vw'];
	$gval5=$grow['vfy'];
	$gval6=$grow['sus'];
	$array=array($gval1,$gval2,$gval3,$gval4,$gval5,$gval6,);
	return $array;
	}
?>

<html>
<head>
<title>Auction Admin Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
@import url("stylesheet.css");
.style1 {color: #FFFFFF}
body {
	background-color: #999999;
}
-->
</style>
</head>
<body >
<div align="center">
  <!-- ImageReady Slices (auction_inner.psd) -->
  <table width="780" border="0" cellpadding="0" cellspacing="0" height="100">
    <tr>
      <td><table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td rowspan="2"><img src="images/index_01_01.jpg" width="109" height="125" alt=""></td>
          <td rowspan="2"><img src="images/index_01_02.jpg" width="486" height="125" alt=""></td>
          <td width="185" height="53" background="images/blackbg01.jpg" class="txt_header" style="padding-top:10px"><div align="center">Admin Control Panel V- 3.0</div></td>
        </tr>
        <tr>
          <td width="185" background="images/blackbg02.jpg" style="padding-top:40px; padding-right:20px"><div align="right"><a href="logout.php"><img src="images/logout.gif" width="67" height="20" border="0"></a></div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0" height="10">
        <tr>
          <td ><table width="780" border="0" cellpadding="0" cellspacing="0" background="images/bg01.jpg">
              <tr>
                <td class="txt_welcomeadmin" style="padding-left:15px">Welcome Admin </td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td><table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="10" height="77" border="0" cellpadding="0" cellspacing="0" bgcolor="#cecfc8">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
<td><a href=home.php><img src="images/index_02_02_02.jpg" width="109" height="77" alt="" border=0 title="Home"></a></td>
<td><a href=user.php><img src="images/index_02_02_03.jpg" width="105" height="77" alt="" border=0 title="Admin"></a></td>
<td><a href=auction.php><img src="images/index_02_02_04.jpg" width="114" height="77" alt="" border=0 title="Auction"></a></td>
<td><a href=mail.php?page=subjects>
<img src="images/index_02_02_05.jpg" width="94" height="77" alt="" border=0 title="Mail"></a></td>
<td><a href=site.php?page=pay>
<img src="images/index_02_02_06.jpg" width="111" height="77" alt="" border=0 title="Finance"></a></td>
<td><a href=ipblock.php><img src="images/index_02_02_07.jpg" width="107" height="77" alt="" border=0 title="Security"></a></td>
<td><a href=frontpagebanner.php><img src="images/index_02_02_08.jpg" width="120" height="77" alt="" border=0 title="ControlManagement"></a></td>
                <td><table width="10" height="77" border="0" cellpadding="0" cellspacing="0" bgcolor="#cecfc8">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
          </table></td>
