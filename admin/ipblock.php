<?php
/* * *************************************************************************
 * File Name				:ipblock.php
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
?>
<?php
if (strlen($_SESSION["adminuser"]) == 0) {
//echo '<meta http-equiv="refresh" content="0; url=index.php">';
//exit();
}
require 'include/connect.php';

$mode = $_GET['mode'];
$id = $_GET['id'];
if ($mode == 'revoke') {
    $del_sql = "delete from blocked_ip where block_id=$id";
    $del_res = mysql_query($del_sql);
}

if (isset($_POST['btn_Block'])) {
    $ip = $_POST['txtIP'];
    if ($ip == '')
        $ip_flag = 1;
    if ($ip_flag != 1) {
        $chk_sql = "select * from  blocked_ip where  blocked_ip='$ip'";
        $chk_res = mysql_query($chk_sql);
        if (mysql_num_rows($chk_res) <= 0) {
            $up_sql = "insert into blocked_ip(blocked_ip) values('$ip')";
            $up_res = mysql_query($up_sql);
            if ($up_res)
                $suc_flag = 1;
            else
                $err_flag = 1;
        }
        else {
            $dup_ip = 1;
        }
    }
}
?>
<style type="text/css">
    <!--
    .style1 {
        color: #666666;
        font-weight: bold;
    }
    -->
</style>
<?php
require 'include/top.php';
?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table>
                <tr><td width=93>
                        <table id="Table_01" width="91" height="166" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/links7_01.jpg" width="93" height="26" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href=ipblock.php><img src="images/links7_02.jpg" width="93" height="70" alt="" border=0 title="BlockIp"></a></td>
                            </tr>
                            <tr>
                                <td><a href=domainblock.php><img src="images/links7_03.jpg" width="93" height="70" alt="" border=0 title="BlockDomain"></a></td>
                            </tr>
                        </table></td><td width=793>
                        <table border="0" align="center" cellpadding="5" cellspacing="2" width="98%">
                            <tr><td valign="top">
                                    <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" class="border2">
                                        <tr bgcolor="#cccccc">
                                            <td colspan="3" class="txt_users">Block IP Address</td>
                                        </tr>
                                        <tr bgcolor="#eeeee1">
                                            <td colspan="3">You have Already Blocked the Following IP</td>
                                        </tr>
                                        <?php
                                        $sel_query = "select * from blocked_ip";
                                        $sel_result = mysql_query($sel_query);
                                        $sno = 1;
                                        ?>
                                        <tr bgcolor="#eeeee1">
                                            <td><b>Sl.no</b></td>
                                            <td><b>Blocked I/P</b></td>
                                            <td><b>Status</b></td>
                                        </tr>
                                        <?php
                                        if (mysql_num_rows($sel_result) > 0) {
                                            while ($sel_row = mysql_fetch_array($sel_result)) {
                                                ?>
                                                <tr bgcolor="#eeeee1">
                                                    <td><?php = $sno ?></td><td><?php = $sel_row['blocked_ip'] ?></td><td><a href="ipblock.php?mode=revoke&id=<?php = $sel_row['block_id'] ?>" onClick="return condel();" class="txt_users">Allow this I/P</a></td>
                                                </tr>
                                                <?php
                                                $sno+=1;
                                            }
                                        } else {
                                            ?>
                                            <tr bgcolor="#eeeee1"><td colspan="3" align="center">You have not Blocked any I/P yet</td></tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                                <td valign="top">
                                    <table border="0" align="center" width="100%" cellpadding="5" cellspacing="2" class="border2">
                                        <form name="frmBlock" action="ipblock.php" method="post">
                                            <tr bgcolor="#cccccc"><td colspan="2" class=txt_users>Block IP</td>
                                            </tr>
                                            <?php
                                            if ($ip_flag == 1) {
                                                ?>
                                                <tr bgcolor="#eeeee1">
                                                    <td><font color="red">Please Fill the Information denoted in Red</font></td>
                                                </tr>
                                                <?php
                                            }
                                            if ($dup_ip == 1) {
                                                ?>
                                                <tr bgcolor="#eeeee1">
                                                    <td><font color="red">The IP entered is already blocked.</font></td>
                                                </tr>
                                                <?php
                                            }
                                            if ($suc_flag == 1) {
                                                ?>
                                                <tr bgcolor="#eeeee1">
                                                    <td><font color="red">The IP has been Registred and it will be Blocked in near Future</font></td>
                                                </tr>
                                                <?php
                                            }
                                            if ($err_flag == 1) {
                                                ?>
                                                <tr bgcolor="#eeeee1">
                                                    <td><font color="red">There is a Problem in Blocking in the IP this time, Please try again Later</font></td>
                                                </tr>
                                                <?php
                                            }
                                            ?><tr bgcolor="#eeeee1"><td>Please Enter the IP you like to Block</td>
                                            </tr>
                                            <tr bgcolor="#eeeee1"><td align="center"><input type="text" name="txtIP" class="text"  onKeyPress="return numbersonly(event);" ></td>
                                            </tr>
                                            <tr bgcolor="#eeeee1"><td colspan="2" align="center"><input type="submit" name="btn_Block" value=" Block " class="button" onclick="return verifyIP();"></td></tr>
                                        </form>
                                    </table>
                                </td>
                            </tr>
                        </table></td></tr></table></td></tr></table>
<?php
require 'include/footer.php';
?>
<script language="javascript">
    function condel() {
        a = confirm("Are you Sure to Allow this I/P to Access your Site");
        return a;
    }
    /*function val()
     {
     if(frmBlock.txtIP.value=="")
     {
     alert("Please Enter the IP Address");
     frmBlock.txtIP.focus();
     return false;
     }
     return true;
     }*/
    function verifyIP() {
        IPvalue = document.frmBlock.txtIP.value;
        errorString = "";
        theName = "IPaddress";

        var ipPattern = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;
        var ipArray = IPvalue.match(ipPattern);

        if (IPvalue == "0.0.0.0")
            errorString = errorString + theName + ': ' + IPvalue + ' is a special IP address and cannot be used here.';
        else if (IPvalue == "255.255.255.255")
            errorString = errorString + theName + ': ' + IPvalue + ' is a special IP address and cannot be used here.';
        if (ipArray == null)
            errorString = errorString + theName + ': ' + IPvalue + ' is not a valid IP address.';
        else {
            for (i = 0; i < 4; i++) {
                thisSegment = ipArray[i];
                if (thisSegment > 255) {
                    errorString = errorString + theName + ': ' + IPvalue + ' is not a valid IP address.';
                    i = 4;
                }
                if ((i == 0) && (thisSegment > 255)) {
                    errorString = errorString + theName + ': ' + IPvalue + ' is a special IP address and cannot be used here.';
                    i = 4;
                }
            }
        }
        extensionLength = 3;
        if (errorString == "")
        {
//alert ("That is a valid IP address.");
            return true;
        }
        else
        {
            alert(errorString);
            return false;
        }
    }




    function numbersonly(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if (unicode != 8 && unicode != 46 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
            if (unicode < 48 || unicode > 57) //if not a number
                return false //disable key press
        }
    }

</script>