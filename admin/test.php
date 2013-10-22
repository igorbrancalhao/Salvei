<?php
/***************************************************************************
 *File Name				:test.php
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
	if(isset($_POST['btnSub'])) {
	$file=$_FILES['userfile']['tmp_name'];
	 $fcontents = file ($file); 
	$userip=$_SERVER['REMOTE_ADDR'];
  for($i=0; $i<sizeof($fcontents); $i++) { 
      $line = trim($fcontents[$i]); 
      $arr = explode(",", $line); 
      #if your data is comma separated
      # instead of tab separated, 
      # change the '\t' above to ',' 
   $val= implode("','", $arr);
	if(strlen($arr[3])!=0) {
		if(copy($arr[3],'http://www.indyamatrimonial.com/auction/uploadimages/'.$arr[3])) {
		 echo 'Success';
		$arr[3]='http://www.indyamatrimonial.com/auction/uploadimages/';
		}
		else echo 'Failure';
	}
      $sql = "insert into test values ('". 
                  implode("','", $arr) ."')"; 
      mysql_query($sql);
      $sql ."<br>\n";
      if(mysql_error()) {
         echo mysql_error() ."<br>\n";
      } 
}
}
?>
<table border="0" align="center" cellpadding="5" cellspacing="2">
<form name="frm1" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<tr><td>
<input type="file" name="userfile">
</td></tr>
<tr>
<td><input type="submit" name="btnSub" value="Submit"></td>
</tr>
</form>
</table>
