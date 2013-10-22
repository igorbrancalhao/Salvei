<?php
/* * *************************************************************************
 * File Name				:help.php
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
require 'include/top.php';
?>
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
$mode = trim($_GET['mode']);
$id = $_GET['id'];
$fsql = "select * from faq";
$fres = mysql_query($fsql);
if ($mode == 'edit') {
    $eres = mysql_query("select * from faq where faq_id=$id");
    $erow = mysql_fetch_array($eres);
}
$question = $_POST['txtQuestion'];
if (empty($question)) {
    $err_msg = "Please enter the values";
    $err_flag = 1;
}
$answer = $_POST['txtAnswer'];
if (empty($answer)) {
    $err_msg = "Please enter the values";
    $err_flag = 1;
}
/* $question=ereg_replace("'","\'",$question);
  $answer=ereg_replace("'","\'",$answer);
  $question=str_replace('"','\"',$question);
  $answer=str_replace('"','\"',$answer); */
$cansave = $_POST['cansave'];
if (empty($question) or empty($answer)) {
    $cansave = 0;
}
if ($cansave == '') {
    $cansave = $_GET['cansave'];
}

if ($cansave == 1) {
    if ($mode == 'add')
        $sql = "insert into faq (question,answer) values('$question','$answer')";
    else if ($mode == 'edit')
        $sql = "update faq set question='$question',answer='$answer' where faq_id=$id";
    else if ($mode == 'delete') {
        $sql = "delete from faq where faq_id='$id'";
    }
    $res = mysql_query($sql);

    if ($res) {
        if ($mode == 'add')
            $message = "FAQ added sucessfully";
        else if ($mode == 'edit')
            $message = "FAQ edited sucessfully";
        else if ($mode == 'delete') {
            $fres = mysql_query($fsql);
            $message = "FAQ Deleted sucessfully";
        } else
            $message = "Please try later";

        echo '<meta http-equiv="refresh" content="4;url=help.php">';
    }
}
if ($mode == '' || $mode == 'delete' || ($mode == 'add' && $cansave == 1)) {
    ?>
    <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" bgcolor="#cecfc8">
        <tr><td valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
                    <tr><td>
                            <table align="center" width="90%" cellpadding="0" border="0">
                                <tr bgcolor="#E8E8E8"> 
                                    <td height="24" colspan="3" class="txt_users"><center>FAQ</center></td>
                    </tr>
                    <tr>
                        <td align="center"><font color="#FF0000">
                            <?php
                            if ($message != "")
                                echo $message;
                            ?></font>
                        </td></tr>
                    <tr><td>
                            <table align="center" width="98%" class="border2" cellpadding="0" cellspacing="0">

                                <?php
                                $total_records = mysql_num_rows($fres);
                                $curpage = $_GET['curpage'];
                                if (strlen($_GET['curpage']) == 0)
                                    $curpage = 1;
                                $start = ($curpage - 1) * 10;
                                $end = 10;
                                if ($curpage == '' || $curpage == 1)
                                    $i = 1;
                                else
                                    $i = $_GET['sno'] + 1;
                                $fsql.=" limit $start,$end";
                                $fres = mysql_query($fsql);
                                ?>
                                <tr> 
                                    <td align="right" colspan="2"> 
                                        <?php
                                        if ($curpage != 1) {
                                            ?>
                                            <a href="help.php?curpage=<?php = ($curpage - 1); ?>&sno=<?php = ($curpage * 10) - 20; ?>" id="link2" style="color:#484848;text-decoration:none">Prev</a> 
                                            | 
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($total_records > ($start + $end)) {
                                            ?>
                                            <a href="help.php?curpage=<?php = ($curpage + 1); ?>&sno=<?php = $curpage * 10; ?>" id="link2" style="color:#484848;text-decoration:none">Next</a> 
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                while ($frow = mysql_fetch_array($fres)) {
                                    ?>
                                    <tr><td bgcolor="#eeeee1"><?php = $i; ?>.&nbsp;<?php = $frow['question']; ?></td>
                                        <td bgcolor="#eeeee1"><a href="help.php?mode=edit&id=<?php = $frow['faq_id']; ?>" id="link1" style="color:#484848;text-decoration:none">Edit</a></td>
                                        <td bgcolor="#eeeee1"><a href="help.php?cansave=1&mode=delete&id=<?php = $frow['faq_id']; ?>" id="link2" onClick="javascript:return condelete();" style="color:#484848;text-decoration:none">Delete</a></td></tr>
                                    <tr><td bgcolor="#eeeee1" colspan="3"><?php = $frow['answer']; ?></td></tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                <tr><td bgcolor="#eeeee1" colspan="3" style="text-align:center">
                                        <input   onclick="location.href = 'help.php?mode=add'" type="button" name="btnadd" value=" add " class="button"/>
                                        <br /><br /></td></tr>		 
                            </table></td></tr></table></td></tr></table>
    </td></tr></table>		
    <?php
} else if ($mode == 'add' || $mode == 'edit') {
    ?>
    <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" background="images/bg08.jpg">
        <tr><td>
                <table align="center" width="760" cellpadding="0" cellspacing="1" bgcolor="#E8E8E8" border="0">
                    <tr> 
                        <td height="24" colspan="3" class="txt_users"><center>FAQ</center></td>
        </tr>
        <tr><td>
                <table align="center" width="98%" class="border2" cellpadding="2">
                    <form name="frm" method="post" onSubmit="return validate();">
                        <?php
                        if (!empty($message)) {
                            ?>
                            <tr><td colspan="2" align="center"><font face="Arial, Helvetica, sans-serif" style="font-weight:bold"><?php = $message; ?></font></td></tr>
                            <?php
                        }
                        if ($_POST) {
                            if ($err_flag == 1) {
                                if (!empty($err_msg)) {
                                    echo '<tr><td colspan="2" align="center" bgcolor="#EEEEE1"><font face="Arial, Helvetica, sans-serif" style="font-weight:bold">' . $err_msg . '</font></td></tr>';
                                }
                            }
                        }
                        ?>
                        <tr >
                            <td width="20%"  bgcolor="#EEEEE1"><div align="center"><b>Question</b></div></td>
                            <td width="80%" bgcolor="#EEEEE1"><input type="text" name="txtQuestion" value="<?php = $erow['question']; ?>"></td>
                        </tr>
                        <tr>
                            <td  bgcolor="#EEEEE1" valign="top"><div align="center"><b>Answer</b></div></td>
                            <td bgcolor="#EEEEE1"><textarea name="txtAnswer" cols="35" rows="10"><?php = $erow['answer']; ?></textarea></td>
                        </tr>
                        <tr bgcolor="#EEEEE1">
                            <td align="center" colspan="2" style="text-align:center"><input type="hidden" name="cansave" value="0"><input type="submit" name="submit" value="Submit" class="button"></td>
                        </tr>
                    </form>
                </table></td></tr></table></td></tr></table>

    <?php
}
?>
<?php
require 'include/footer1.php';
?>
<script language="JavaScript">
    function condelete()
    {
        var confrm;
        confrm = window.confirm("Are You sure you want to delete this faq");
        return confrm;
    }
    function validate()
    {
        form = document.frm;
        if (form.txtQuestion.value == "")
        {
            alert("Please enter the question");
            form.txtQuestion.focus();
            return false;
        }
        if (form.txtAnswer.value == "")
        {
            alert("Please enter the answer");
            form.txtAnswer.focus();
            return false;
        }
        form.cansave.value = 1;
        return true;
    }
</script>