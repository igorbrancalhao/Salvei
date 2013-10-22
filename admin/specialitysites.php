<?php
/***************************************************************************
 *File Name				:Speciality.php
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
error_reporting(0);?>
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
-->
</style>
<?php
require 'include/connect.php';
require 'include/top.php';
$mode=$_REQUEST[mode];
if($mode=="del")
{
$id=$_REQUEST[id];
$del_sql="delete from speciliaty where id=$id";
$result=mysql_query($del_sql);
$mes="Deleted Successfully.............";
}
$get_res=mysql_query("select * from speciliaty");

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
<tr><td>
<table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
	  <tr> 
              <td height="24" colspan="2" class="txt_users"><center>Specialty Sites</center></td>
            </tr><tr><td>
	      <table align="center" width="98%" class="border2" cellpadding="2">
		  <form name="frm" method="post" enctype="multipart/form-data" action="whatsnew.php">
            
				<tr bgcolor="#eeeee1" > 
              <td height="24" colspan="3"><b>You Can Manage the Specialty Section of Index Page.</b></td>
            </tr>
			<tr bgcolor="#eeeee1" > 
			<td colspan="2" align="center"><font color="#FF0000">
			<?php
			if($mes!='')
			echo $mes;
			?>
			</font>
			</td></tr>
               <tr bgcolor="#eeeee1"> 
              <!-- <td height="24" width=80 align="center" >Icons</td>--> <td height="24" ><b>Link</b></td>
			   <td height="24"><b>Action</b></td>
               </tr>
			
			<?php 
			while($get_row=mysql_fetch_array($get_res))
			{
			?>
              <tr bgcolor="eeeee1">
              <!--<td width=80 align="center"><img src="../images/<?php= $get_row['icon']; ?>"></td>-->
              <td width="49%"><a href="http://<?php=$get_row['link']; ?>" class="txt_users"><?php=$get_row['link_name']; ?></a>
			  </td>
			  <td><a href="specialitysites.php?mode=del&id=<?php= $get_row[id] ?>" class="txt_details1" onClick="return condel()">Delete</a></td>
              </tr>
             <?php
			 }
    		 ?>
		<tr bgcolor="eeeee1"><td colspan="3" style="text-align:center">
		<!--<form name="frm" method="post" action="whatsnew.php">
		<input type="button" name="submit" value="Add" class="button" onclick="window.open('addspeciality.php',width=200,height=200)">-->
		<a href="#" style="text-decoration:none"  onclick="window.open('addspeciality.php','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=500, height=400')"><span style="background-color:#FFCC00; text-decoration:none" id="link3"><b>Add</b></span></a>
		</td></tr>	
			<!--</form>-->
		</table></td></tr></table>
</td></tr></table>		
<?php
require 'include/footer1.php';
?>
<script language="javascript">
function condel() {
	a=confirm("Are you Sure You want to Delete this Speciality Website");
	return a;
}
</script>