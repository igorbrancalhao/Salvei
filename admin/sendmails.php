<?php
/* * *************************************************************************
 * File Name				:sendmails.php
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
error_reporting(0);
?>
<style type="text/css">
</style>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table>
                <tr><td width=93><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/links3_01.jpg" width="93" height="25" alt="" ></td>
                            </tr>
                            <tr>
                                <td><a href=mail.php?page=subjects><img src="images/links3_02.jpg" width="93" height="71" alt="" border="0" title="MailSubjects"></a></td>
                            </tr>
                            <tr>
                                <td><a href=mail.php><img src="images/links3_03.jpg" width="93" height="71" alt="" border=0 title="Sendmail"></a></td>
                            </tr>
                            <tr>
                                <td><a href=mail.php?page=news><img src="images/links3_04.jpg" width="93" height="74" alt="" border=0 title="SendNewsletter"></a></td>
                            </tr>
                            <tr>

                        </table></td><td width=793>
                        <table width="98%" class="border2" align="center">
                            <tr bgcolor="#CCCCCC" class=txt_users> 
                                <td height="27" colspan="2">Send an email to an user or all users</td>
                            </tr>
                            <?php
                            $cansend = $_POST["cansend"];
                            $users = $_POST["cboUsers"];

                            $sqlsite = "select * from admin_settings where set_id=1";
                            $sqlsiteqry = mysql_query($sqlsite);
                            $sqlsitefetch = mysql_fetch_array($sqlsiteqry);
                            $site = $sqlsitefetch['set_value'];

                            //Fetching mail header image
                            $queryheader = "select * from admin_settings where set_id = 61";
                            $tableheader = mysql_query($queryheader);
                            $rowheader = mysql_fetch_array($tableheader);
                            $mailheader = $site . "/" . $rowheader['set_value'];

//Fetching mail footer image
                            $queryfooter = "select * from admin_settings where set_id = 62";
                            $tablefooter = mysql_query($queryfooter);
                            $rowfooter = mysql_fetch_array($tablefooter);
                            $mailfooter = $site . "/" . $rowfooter['set_value'];

                            if (($cansend == 1) && ($users[0] != "All Users")) {
                                $qst_date = date("Y-m-d");
                                $status = "notification";
                                $adminidres = mysql_query("select * from user_registration where user_name='admin'");
                                $adminid = mysql_fetch_array($adminidres);
                                $from_id = $adminid['user_id'];
                                $to = $_POST['cboUsers'];
                                $users = $_POST['cboUsers'];
                                $mailfrom = $_POST["txtFrom"];
                                $mailsubject = $_POST['txtSubject'];
                                $mailbody = $_POST["txtMessage"];

                                $mailtop = "<table width=700 style=\"border-left:1px solid #CCCCCC;border-top:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc\"><tr><td><img src='<imgh>'></td></tr><tr><td>";
                                $mailbottom = "</td></tr><tr><td><img src='<imgf>'></td></tr></table>";
                                $mailtop = str_replace("<imgh>", $mailheader, $mailtop);
                                $mailbottom = str_replace("<imgf>", $mailfooter, $mailbottom);
                                $mailbody1 = $mailtop . "<tr><td>" . $mailbody . "</td></tr>" . $mailbottom;



                                foreach ($users as $mailTo) {
                                    $userres = mysql_query("select * from user_registration where email='$mailTo'");
                                    $userqry = mysql_fetch_array($userres);
                                    $to_id = $userqry[user_id];
                                    $ins_sql = "insert into ask_question(from_id,date,question,answer,to_id,status)             values('$from_id','$qst_date','$mailbody','$mailsubject','$to_id','$status')";
                                    $ins_qry = mysql_query($ins_sql);

                                    $headers = "MIME-Version: 1.0\n";
                                    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                                    $headers .= "From: " . $mailfrom . "\n";
                                    $mail = mail($mailTo, $mailsubject, $mailbody1, $headers);
                                }
                                if ($mail) {
                                    $mailstatus = "Mail Send Successfully to the Selected users";
                                } else
                                    $mailstatus = "Problem in sending your Email...";
                            }
                            else if (($cansend == 1) && ($users[0] == "All Users")) {
                                $qst_date = date("Y-m-d");
                                $status = "notification";
                                $adminidres = mysql_query("select * from user_registration where user_name='admin'");
                                $adminid = mysql_fetch_array($adminidres);
                                $from_id = $adminid[user_id];
                                $alres = mysql_query("select * from user_registration where verified='yes'");
                                while ($alrow = mysql_fetch_array($alres)) {
                                    $to_id = $alrow['user_id'];
                                    $ins_row = mysql_query($ins_sql);
                                    $mailTo = $alrow['email'];
                                    $mailfrom = $_POST["txtFrom"];
                                    $mailsubject = $_POST['txtSubject'];
                                    $mailbody = $_POST["txtMessage"];

                                    $mailtop = "<table width=700 style=\"border-left:1px solid #CCCCCC;border-top:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc\"><tr><td><img src='<imgh>'></td></tr><tr><td>";
                                    $mailbottom = "</td></tr><tr><td><img src='<imgf>'></td></tr></table>";
                                    $mailtop = str_replace("<imgh>", $mailheader, $mailtop);
                                    $mailbottom = str_replace("<imgf>", $mailfooter, $mailbottom);
                                    $mailbody1 = $mailtop . "<tr><td>" . $mailbody . "</td></tr>" . $mailbottom;

                                    $ins_sql = "insert into ask_question(from_id,date,question,answer,to_id,status) values('$from_id','$qst_date','$mailbody','$mailsubject','$to_id','$status')";
                                    $ins_qry = mysql_query($ins_sql);

                                    $headers = "MIME-Version: 1.0\n";
                                    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                                    $headers .= "From: " . $mailfrom . "\n";

                                    $mail = mail($mailTo, $mailsubject, $mailbody1, $headers);
                                }
                                if ($mail) {
                                    $mailstatus = "Mail Send Successfully to all users";
                                } else {
                                    $mailstatus = "Problem in sending your Email...";
                                }
                            }
                            ?>
                            <?php
                            if ($mailstatus != "") {
                                echo "<tr bgcolor=#eeeee1><td colspan=2 align=center><font color=#FF0000>" . $mailstatus . "</font></tr>";
                            }
                            ?>
                            <tr>
                                <td valign="top" colspan=2><b></tr>
                            <form name=form1 action="<?php $_SERVER['PHP_SELF']; ?>" method=post>
                                <tr bgcolor="#eeeee1">
                                    <td width="50%">From 
                                    <td width="50%">
                                        <?php
                                        $frm_res = mysql_query("select * from mail_subjects");
                                        $frm_row = mysql_fetch_array($frm_res);
                                        ?>
                                        <input type="text" name="txtFrom" value="<?php = $frm_row['mailfrom']; ?>" class="txt">
                                    </td></tr>

                                <tr bgcolor="#eeeee1">
                                    <td>Subject
                                    <td>
                                        <input type="text" class="txt" name="txtSubject">
                                    </td>
                                </tr>
                                <tr bgcolor="#eeeee1">
                                    <td valign=top>Message
                                    <td><textarea name=txtMessage rows=5 cols=25></textarea>
                                <tr bgcolor="#eeeee1">
                                    <td>Send this Email to 
                                    <td><select name="cboUsers[]" multiple><option value="All Users" selected="selected">All Users</option>
                                            <?php
                                            $sql = "select email from user_registration order by email";
                                            $result = mysql_query($sql);

                                            if (mysql_num_rows($result) <= 0) {
                                                $error = "No users";
                                            } else if (mysql_num_rows($result) > 0) {
                                                while ($row = mysql_fetch_array($result)) {
                                                    echo "<option value=" . $row[0] . ">" . $row[0] . "</option>";
                                                }
                                            }
                                            ?>

                                        </select></td>
                                </tr>
                                <tr bgcolor="#eeeee1">
                                    <td height="28" colspan=2 align=center>
                                        <input type=submit Value=" Send " class="button" onclick="return val();"></td></tr>
                                <input type=hidden name=cansend value=0>
                            </form>
                        </table></td></tr></table></td></tr></table>
<script language="javascript">
    function val()
    {
        if (form1.txtFrom.value == "")
        {
            alert("Please Enter the From Mail ID");
            form1.txtFrom.focus();
            return false;
        }
        if (form1.txtFrom.value != "")
        {
            mailstr = form1.txtFrom.value;
            a = mailstr.indexOf(".");
            b = mailstr.indexOf("@");
            c = mailstr.indexOf(" ");
            d = mailstr.lastIndexOf(".");
            e = mailstr.length
            if ((a == -1) || (b == -1) || (c != -1) || (d < b) || (d == e - 1) || (b + 1 == a))
            {
                alert("Enter the Valid E-Mail");
                form1.txtFrom.focus();
                return false;
            }
        }
        if (form1.txtSubject.value == "")
        {
            alert("Please Enter the Mail Subject");
            form1.txtSubject.focus();
            return false;
        }
        if (form1.txtMessage.value == "")
        {
            alert("Please Enter the Message");
            form1.txtMessage.focus();
            return false;
        }
        form1.cansend.value = 1;
        return true;
    }
</script>
