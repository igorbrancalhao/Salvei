<?php
/* * *************************************************************************
 * File Name				:mailsubjects.php
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
                        </table></td><td width=793>
                        <table width="98%" border="0" align="center" cellpadding="5" cellspacing="2" class="border2">
                            <tr bgcolor="#CCCCCC" > 
                                <td height="27" colspan="3" class=txt_users>Mail Subjects</td>
                            </tr>
                            <?php
                            $site_query = "select * from admin_settings where set_id=1";
                            $site_table = mysql_query($site_query);
                            $site_row = mysql_fetch_array($site_table);
                            $site_name = $site_row['set_value'];

//Fetching mail header image
                            $queryheader = "select * from admin_settings where set_id = 61";
                            $tableheader = mysql_query($queryheader);
                            $rowheader = mysql_fetch_array($tableheader);
                            $header = $site_name . "/" . $rowheader['set_value'];

//Fetching mail footer image
                            $queryfooter = "select * from admin_settings where set_id = 62";
                            $tablefooter = mysql_query($queryfooter);
                            $rowfooter = mysql_fetch_array($tablefooter);
                            $footer = $site_name . "/" . $rowfooter['set_value'];

                            $cansave = $_POST['canSave'];
                            if ($cansave == 1) {
                                $mailid = $_POST['mailid'];
                                $mailtitle = $_POST["txtTitle"];
                                $mailfrom = $_POST["txtFrom"];
                                $mailsubject = $_POST["txtSubject"];
                                $mailbody = $_POST["txtBody"];
                                $sql = "update mail_subjects set mail_from='" . $mailfrom . "',mail_subject='" . $mailsubject . "',mail_message='" . $mailbody . "' where mail_id=" . $mailid;
                                $result = mysql_query($sql);
                                if ($result)
                                    $message = "Mail Subject Edited Successfully";
                                else
                                    $message = "Please Try Again";
                            }
                            ?>
                            <?php
                            $edit = $_GET["edit"];
                            if ($edit == 1) {
                                $mailid = $_GET['mailid'];
                                $sql = "select * from mail_subjects where mail_id = " . $mailid;
                                $result = mysql_query($sql);
                                $row = mysql_fetch_array($result);
                                $mailtitle = $row["mail_title"];
                                $mailfrom = $row["mail_from"];
                                $mailsubject = $row["mail_subject"];
                                $mailbody = $row["mail_message"];
                                ?>
                                <tr bgcolor="#eeeee1"><td colspan="2" align="center"><font color="#FF0000"><?php = $message; ?></font></td></tr>
                                <tr bgcolor="#CCCCCC">
                                    <td colspan=2><b>Edit Mail Subject</b></td></tr>
                                <form name=form1 action="<?php $_SERVER['PHP_SELF']; ?>" method="post" >
                                    <tr bgcolor="#eeeee1">
                                        <td align="left">From
                                        <td><input name=txtFrom  class="text" value="<?php echo $mailfrom; ?>"></td></tr>
                                    <tr bgcolor="#eeeee1">
                                        <td align="left">Subject
                                        <td><input name=txtSubject  class="text" value="<?php echo $mailsubject; ?>"></tr>
                                    <tr bgcolor="#eeeee1">
                                        <td valign=top align="left">Message
                                        <td><textarea name=txtBody rows=5 cols=25><?php echo $mailbody; ?></textarea>
                                        </td></tr>
                                    <tr bgcolor="#eeeee1"><td colspan=2 align=center><p> 
                                                <input name="submit" type=submit    class="button" value=" Save " onclick="return val();">
                                                <input type=button value=" cancel " class="button" onclick=window.location.href = 'mail.php?page=subjects'>
                                            </p></td></tr>
                                    <input type=hidden name=mailid value=<?php echo $mailid; ?>>
                                    <input type=hidden name=canSave value=0>

                                </form>

                                <?php
                            } else {
                                ?>
                                <tr bgcolor="#CCCCCC" >
                                    <td><b>Title</b></td><td><b>From</b></td> <td><b>Subject</b></td></tr>
                                <?php
                                $sql = "select * from mail_subjects";
                                $result = mysql_query($sql);
                                while ($row = mysql_fetch_array($result)) {
                                    ?>
                                    <tr bgcolor="#eeeee1"><td><a  href=mail.php?page=subjects&edit=1&mailid=<?php echo $row["mail_id"]; ?> class=txt_users><?php echo $row["mail_subject"]; ?></a>
                                                <?php
                                                $mailmsg = $row["mail_message"];
                                                $mailmsg = str_replace("width=700", "width=300", $mailmsg);
                                                $mailmsg = str_replace("width=600", "width=300", $mailmsg);
                                                $mailmsg = str_replace("<img src='<imgh>'>", "<img src='$header' width=300>", $mailmsg);
                                                $mailmsg = str_replace("<img src='<imgf>'>", "<img src='$footer' width=300>", $mailmsg);
                                                ?>
                                        <td><?php echo (strlen($row["mail_from"]) == 0) ? "&nbsp;" : $row["mail_from"]; ?>
                                        <td><?php echo (strlen($row["mail_message"]) == 0) ? "&nbsp;" : $mailmsg; ?>

                                        </td></tr>

                                    <?php
                                }
                            }
                            ?>

                        </table></td></tr></table></td></tr></table></td></tr>
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
        if (form1.txtBody.value == "")
        {
            alert("Please Enter the Message");
            form1.txtBody.focus();
            return false;
        }
        form1.canSave.value = 1;
        return true;
    }
</script>