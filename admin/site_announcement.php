<?php
/* * *************************************************************************
 * File Name				:site_announcement.php
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

if (isset($_REQUEST['update1'])) {
    $query = "update site_announcement set site_announcement='$_REQUEST[registration]' where id='1' ";
    if (mysql_query($query))
        echo "<table border=0 align=center cellpadding=5 cellspacing=2 width=100%  bgcolor=#cecfc8><tr><td><font color='#ff0000'><center><b>Site Announcement Detail Updated On Successfully ! </b></center></font></td></tr></table>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Untitled Document</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
    <body>
        <?php
        $query = "select * from site_announcement where id=1";
        $tab = mysql_query($query);
        if ($row = mysql_fetch_array($tab)) {
            $registration = $row['site_announcement'];
        }
        ?>
        <table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
            <tr><td>
                    <table border="0" align="center" cellpadding="5" cellspacing="2" width="760" bgcolor="#E8E8E8" height="100%">
                        <tr class="txt_users">
                            <td colspan="4" height="24"><center>Site Announcement</center></td></tr><tr><td>
                                <table width="98%"  border="0" cellpadding="5" cellspacing="1" class="border2" align="center" bgcolor="#f7f7f7">
                                    <form name="frmsearch" action="<?php = $_SERVER['PHP_SELF']; ?>" method="post">

                                        <tr bgcolor="#eeeee1"><td><Strong>Site Announcement</strong></td><td><textarea name="registration" cols=50 rows=10><?php = $registration; ?></textarea></td></tr>
                                        <tr bgcolor="#eeeee1"><td colspan="2">Note: Site annoucement can be given to a maximum of 255 characters</td></tr>
                                        <input type="hidden" name="term_id" value="1">
                                        <tr bgcolor="#eeeee1"><td colspan="2" style="text-align:center"> <input type="submit" name="update1" value="Update" class="button" onClick="return val();" > </td></tr>
                                    </form>
                                </table>
                            </td></tr></table>
                    <?php require 'include/footer1.php'; ?>
                    </body>
                    </html>
                    <script language="javascript">
                        function val()
                        {
                            if (frmsearch.registration.value == "")
                            {
                                alert("Please Enter the What's New");
                                frmsearch.registration.focus();
                                return false;
                            }
                            return true;
                        }
                    </script>