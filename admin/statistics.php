<?php
/* * *************************************************************************
 * File Name				:statistics.php
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
session_start();
require 'include/connect.php';
require 'include/top.php';
$ldate = $_POST['ldate'];
$update = $_POST['upd'];
$sid = $_POST['sid'];
$id = $_GET['id'];


$sql_reg = "select * from user_registration";
$res_reg = mysql_query($sql_reg);
$tot_reg = mysql_num_rows($res_reg);
$sql_sold = "select * from placing_item_bid where quantity_sold > 0";
$res_sold = mysql_query($sql_sold);
$tot_sold = mysql_num_rows($res_sold);
$sql_live = "select * from placing_item_bid where status='Active'";
$res_live = mysql_query($sql_live);
$tot_live = mysql_num_rows($res_live);
?>
<table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
    <tr><td>
            <table border="0" align="center" cellpadding="5" cellspacing="2" width="760" height="100%" bgcolor="#E7E7E7">
                <tr>	
                    <td colspan="2" class="txt_users" height="24" valign="middle" align="center"><center>
                    Site Statistics</center></td></tr><tr><td>
            <table border="0" align="center" cellpadding="5" cellspacing="2" width="98%" class="border2">
                <form name="stat" action="statistics.php" method="post">

                    <?php
                    if ($sid == 1) {
                        if ($ldate) {
                            $dateformat = "[0-9]{4}-[0-9]{2}-[0-9]{1,2}";
                            if (!eregi($dateformat, $ldate)) {
                                $err_date = 1;
                            } else {
                                $sql = "update admin_settings set set_value='$ldate' where set_id='16'";
                                $exe = mysql_query($sql);
                            }
                        }
                        if ($update) {
                            $dateformat = "[0-9]{4}-[0-9]{2}-[0-9]{1,2}";
                            if (!eregi($dateformat, $update)) {
                                $err_date = 1;
                            } else {
                                $sql = "update admin_settings set set_value='$update' where set_id='17'";
                                $exe = mysql_query($sql);
                            }
                        }
                        if ($err_date == 1)
                            echo "<tr><td colspan=2 align=center bgcolor=eeeee1><font size=2 color=red>Enter a valid dateformat</font></td><tr>";
                        else
                            echo "<tr><td colspan=2 align=center bgcolor=eeeee1><font size=2 color=red>Site Statistics Updated Successfully!</font></td></tr>";
                    }
                    ?>
                    <tr bgcolor="eeeee1"><td>&nbsp;&nbsp;&nbsp;<b>Total Users:</b></td><td><?php if ($tot_reg != 0)  ?><?php = $tot_reg; ?></td>
                    </tr>
                    <tr bgcolor="eeeee1"><td>&nbsp;&nbsp;&nbsp;<b>Total Items Sold:</b></td><td>
                            <?php = $tot_sold; ?>
                        </td>
                    </tr>
                    <tr bgcolor="eeeee1"><td>&nbsp;&nbsp;&nbsp;<b>Total Live Auctions:</b></td><td><?php = $tot_live; ?></td>
                    </tr>
                    <?php
                    $sql = "select * from user_registration where onlinestatus='Online'";
                    $exe = mysql_query($sql);
                    $numrows = mysql_num_rows($exe);
                    $datsql = "select * from admin_settings where set_id='16'";
                    $datexe = mysql_query($datsql);
                    $dat = mysql_fetch_array($datexe);
                    $sid = $dat['set_id'];

                    $ldate = $dat['set_value'];


                    $days = "select (to_days(now())-to_days('$ldate')) as launch from admin_settings";
                    $dexe = mysql_query($days);
                    $dret = mysql_fetch_array($dexe);
                    //$datsql="select * from admin_settings where set_name='last_update'";
                    $datsql = "select * from admin_settings where set_id='17'";
                    $datexe = mysql_query($datsql);
                    $dat = mysql_fetch_array($datexe);
                    $sid = $dat['set_id'];
                    $last_update = $dat['set_value'];
                    $ret = $dret['launch'];
                    //$dt=date('Y-m-d');
                    ?>
                    <input type="hidden" name="sid" value="1">
                    <tr bgcolor="eeeee1"><td><b>&nbsp;&nbsp;&nbsp;&nbsp;User's OnLine:</b></td><td><?php = $numrows; ?></td></tr>
                    <tr bgcolor="eeeee1"><td><b>&nbsp;&nbsp;&nbsp;&nbsp;Site Started:</td><td><input type="text" name="ldate" value="<?php = $ldate ?>" onkeypress="return numbersonly(event);">    </b>(YYYY-MM-DD)</td></tr>
                    <tr bgcolor="eeeee1"><td><b>&nbsp;&nbsp;&nbsp;&nbsp;Days Running:</td><td></b><?php = $ret; ?></td></tr>
                    <tr bgcolor="eeeee1"><td><b>&nbsp;&nbsp;&nbsp;&nbsp;Last Update:</td><td><input type="text" name="upd" value="<?php = $last_update; ?>" onkeypress="return numbersonly(event);"></b>(YYYY-MM-DD)</td></tr>
                    <tr bgcolor="eeeee1"><td colspan="2" style="text-align:center"><input name="sub" type="submit" value="Update" class="button" onclick="return val();"></td></tr>
                </form>
            </table>
        </td></tr></table>

<?php
//}
require 'include/footer1.php';
?>	
<script language="javascript">
    function val()
    {
        if (stat.ldate.value == "")
        {
            alert("Please Enter the Site Started Date");
            stat.ldate.focus();
            return false;
        }
        if (stat.upd.value == "")
        {
            alert("Please Enter the Last Update Date");
            stat.upd.focus();
            return false;
        }
        return true;
    }
    function numbersonly(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if (unicode != 8 && unicode != 46 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
            if (unicode < 48 || unicode > 57) //if not a number
                return false; //disable key press
        }
    }
</script>