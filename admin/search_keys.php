<?php
/* * *************************************************************************
 * File Name				:search_keys.php
 * File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
 * ************************************************************************* */


/* * **************************************************************************

 *      Licence Agreement: 

 *     This program is a Commercial licensed software; 
 *     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
 *     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
 *     either user and developer versions of the License, or (at your option) 
 *     any later version is applicable for the same.

 * *************************************************************************** */
?>
<?php
session_start();
require 'include/connect.php';
require 'include/top.php';
$txtkey = $_POST[txtkey];
$cansave = $_POST[cansave];
if ($cansave == 1) {
    $sql_up = "update meta_tag set key_s='$txtkey' where key_id=1";
    $res_up = mysql_query($sql_up);
    $msg = 1;
}
$sql = 'select * from meta_tag';
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
?>
<table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
    <tr><td>
            <table border="0" align="center" cellpadding="0" cellspacing="2" width="760" bgcolor="#E8E8E8" height="100">
                <tr><td class="txt_users" height=24><center><br />Add keywords to Meta Tag<br><br></center></td></tr>
    <?php
    if ($msg) {
        ?>
        <tr><td align="center"><font color="red"><center>Updated Successfully!</center></font></td></tr>
    <?php
}
?>
<tr valign="top"><td valign="top">
        <table align="center" width="98%" cellpadding="0" cellspacing="2"  border="0" class=border2>
            <tr bgcolor="eeeee1"><td align="left"><b> Enter the keywords with "," between them</b></td></tr>
            <form method="post"  name="frmkey" action="search_keys.php">
                <tr bgcolor="eeeee1"><td>	<textarea name="txtkey" rows="10" cols="50"><?php = $row[key_s]; ?></textarea></td></tr>
                <input type="hidden" name="cansave" value="1">
                <tr bgcolor="eeeee1"><td style="text-align:center">	<input type="submit" name="submit" value=" Add " class="button" onclick="return val();"></td></tr>
        </table>
        </form>
    </td></tr></table>
<?php
require 'include/footer1.php';
?>
<script language="javascript">
    function val()
    {
        if (frmkey.txtkey.value == "")
        {
            alert("Please Enter the Meta Tag");
            frmkey.txtkey.focus();
            return false;
        }
        return true;
    }
</script>