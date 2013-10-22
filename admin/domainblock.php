<?php
/* * *************************************************************************
 * File Name				:domainblock.php
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
    $del_sql = "delete from blocked_domain where block_id=$id";
    $del_res = mysql_query($del_sql);
}

if (isset($_POST['btn_Block'])) {
    $ip = $_POST['txtIP'];
    if ($ip == '')
        $ip_flag = 1;
    if ($ip_flag != 1) {
        $chk_sql = "select * from  blocked_domain where  blocked_domain='$ip'";
        $chk_res = mysql_query($chk_sql);
        if (mysql_num_rows($chk_res) <= 0) {
            $up_sql = "insert into blocked_domain(blocked_domain) values('$ip')";
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
<link rel=stylesheet type=text/css href=include/style.css>
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
                                            <td colspan="3" class="txt_users">Block domain Address</td>
                                        </tr>
                                        <tr bgcolor="#eeeee1">
                                            <td colspan="3">You have Already Blocked the Following domain's</td>
                                        </tr>
                                        <?php
                                        $sel_query = "select * from blocked_domain";
                                        $sel_result = mysql_query($sel_query);
                                        $sno = 1;
                                        ?>
                                        <tr bgcolor="#eeeee1">
                                            <td>S.no</td>
                                            <td>Blocked domain</td>
                                            <td>Status</td>
                                        </tr>
                                        <?php
                                        if (mysql_num_rows($sel_result) > 0) {
                                            while ($sel_row = mysql_fetch_array($sel_result)) {
                                                ?>
                                                <tr bgcolor="#eeeee1">
                                                    <td><?php = $sno ?></td><td><?php = $sel_row['blocked_domain'] ?></td><td><a href="domainblock.php?mode=revoke&id=<?php = $sel_row['block_id'] ?>" onClick="return condel();" class="txt_users">Allow this domain</a></td>
                                                </tr>
                                                <?php
                                                $sno+=1;
                                            }
                                        } else {
                                            ?>
                                            <tr bgcolor="#eeeee1"><td colspan="3" align="center">You have not Blocked any domain yet</td></tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                                <td valign="top">
                                    <table border="0" align="center" width="100%" cellpadding="5" cellspacing="2" class="border2">
                                        <form name="frmBlock" action="domainblock.php" method="post"  onsubmit="return per();">
                                            <tr bgcolor="#cccccc"><td colspan="2" class="txt_users">Block domain</td></tr>
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
                                                    <td><font color="red">The domain you have entered has been already blocked by you</font></td>
                                                </tr>
                                                <?php
                                            }
                                            if ($suc_flag == 1) {

                                                /* $sql="select * from mail_subjects where mail_id =0";
                                                  $result = mysql_query($sql);
                                                  $row = mysql_fetch_array($result);

                                                  $admin_sql="select * from admin_settings where set_id=1";
                                                  $get_res=mysql_query($admin_sql);
                                                  $get_row=mysql_fetch_array($get_res);
                                                  $yoursite=$get_row['set_value'];

                                                  $mailto=$user_row['email'];
                                                  $mailfrom = $row["mail_from"];
                                                  $mailsubject = $row["mail_subject"];
                                                  $mailbody = $row["mail_message"];
                                                  $headers  = "MIME-Version: 1.0\n";
                                                  $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                                                  $headers .= "From: ". $mailfrom."\n";

                                                  $mailbody = ereg_replace("<url>",$yoursite,$mailbody);
                                                  $mailbody = ereg_replace("<domain>",$ip,$mailbody);

                                                  $sqlban="select * from user_registration where email like '%$ip'";
                                                  $tabban = mysql_query($sqlban);
                                                  while($rowban = mysql_fetch_array($tabban))
                                                  {
                                                  $mailbodys = ereg_replace("<username>",$rowban[first_name],$mailbody);
                                                  //		echo "<br>Mail to =".$rowban[email]."<br>Subject = ".$mailsubject."<br>Mailbody = ".$mailbodys;
                                                  mail($mailto,$mailsubject,$mailbody,$headers);
                                                  } */
                                                ?>
                                                <tr bgcolor="#eeeee1">
                                                    <td><font color="red">Domain  Blocked </font></td>
                                                </tr>
                                                <?php
                                            }
                                            if ($err_flag == 1) {
                                                ?>
                                                <tr bgcolor="#eeeee1">
                                                    <td><font color="red">There is a Problem in Blocking in the domain this time, Please try again Later</font></td>
                                                </tr>
                                                <?php
                                            }
                                            ?><tr bgcolor="#eeeee1"><td>Please Enter the domain you like to Block</td></tr>
                                            <tr bgcolor="#eeeee1"><td>Eg : www.example.com</td></tr>
                                            <tr bgcolor="#eeeee1"><td align="center"><input type="text" name="txtIP" class="text"></td>
                                            </tr>
                                            <tr bgcolor="#eeeee1"><td colspan="2" align="center"><input type="submit" name="btn_Block" value=" Block " class="button"></td></tr>
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
        a = confirm("Are you Sure to Allow this domain to Access your Site");
        return a;
    }
    function per() {
        if (frmBlock.txtIP.value == "")
        {
            alert("Please Enter the Domain for Block");
            frmBlock.txtIP.focus();
            return false;
        }
        if (document.frmBlock.txtIP.value != "")
        {
            var tomatch = /^[Ww\.-]{3,}\.[A-Za-z]{3,}\.([A-Za-z]{2,})/;
            if (!(document.frmBlock.txtIP.value.match(tomatch)))
            {
                alert("Invalid Domain. Try again.");
                frmBlock.txtIP.focus();
                return false;
            }
        }
        //a=confirm("you want to send email to Existing User to change their email id, Who are registered with this domain email-id");

        a = confirm("Are you sure you want to block this domain");
        /*	if(a)
         {
         b=prompt("Please Enter how many days before the user need to submit their alter mail id","0")
         return b;
         }
         else
         {*/
//	alert(a);
        return a;
//	}
    }
</script>