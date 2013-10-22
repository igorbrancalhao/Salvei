<?php
/* * *************************************************************************
 * File Name				:currency_manager.php
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
?>
<link href="include/style.css" rel="stylesheet" type="text/css">
<?php
require 'include/top.php';
require 'include/connect.php';
if (isset($_POST['add'])) {
    ?>
    <table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
        <tr><td>
                <table border="0" align="center" cellpadding="5" cellspacing="2" width="760" bgcolor="#E8E8E8" height="100%">
                    <form name="frm1" method="post">
                        <tr><td>
                                <table border="0" align="center" cellpadding="5" cellspacing="2" width="700" bgcolor="#E8E8E8" height="100%" class="border2">
                                    <tr bgcolor="eeeee1"><td colspan="2" width="100%"  height="30" class="txt_users" style="text-align:center">&nbsp;&nbsp;&nbsp;Add Currency </td></tr>
                                    <tr bgcolor="eeeee1"><td width="50%" height="40">&nbsp;&nbsp;&nbsp;Currency</td><td><input type="text" name="txtCurr"></td></tr>
                                    <tr bgcolor="eeeee1"><td width="50%" height="40">&nbsp;&nbsp;&nbsp;Please Enter Equivalent Currency Code </td><td><input type="text" name="txtValue"></td></tr>
                                    <tr   bgcolor="eeeee1">
                                        <td  colspan="2" align="center" height="40"><input type="submit" name="addnew" value=" Add " class="button" onclick="return chk();">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="cancel" value="Cancel" class="button"></td></tr>
                                </table>
                            </td></tr></form></table>
                <?php
//}
            } else {
                if (isset($_POST['addnew'])) {
                    $currrency = $_POST[txtCurr];
                    $eq_val = $_POST[txtValue];



                    $res = mysql_query("select * from currency_master where currency_code='$eq_val'");
                    $res1 = mysql_fetch_array($res);

                    if (empty($currrency)) {
                        $err_cur = "Please enter the currency";
                        $ef = 1;
                    } else if (empty($eq_val)) {
                        $err_cur = "Please enter the equivalent code";
                        $ef = 1;
                    }

                    if (is_numeric($currrency)) {
                        $err_cur = "Please enter a valid currency value";
                        $ef = 1;
                    }

                    if ($res1['currency_code'] == $eq_val && !empty($eq_val)) {
                        $currrency = '';
                        $ef = 1;
                        $err_cur = "Already this currency exists";
                    }
                    if (!empty($currrency) and ($ef != 1)) {

                        $in_sql = "insert into currency_master(currency,currency_code)values('$currrency','$eq_val')";
                        $in_res = mysql_query($in_sql);
                        $currrency = "";
                        $eq_val = "";
                        if ($in_res)
                            echo '<tr><td><div align=center> <font color=red size=+1>Currency added Successfully</font></div></td></tr>';
                        else
                            echo '<tr><td><div align=center><font color=red>Currency not added</font></div></td></tr>';


                        echo '<meta http-equiv="refresh" content="0;url=currency_manager.php">';
                        echo "You have been Re-Directed, if not Please <a href=currency_manager.php>Click here</a>";
                        exit();
                    }
                }
                ?>
                <table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
                    <tr><td>
                            <table border="0" align="center" cellpadding="5" cellspacing="2" width="760" bgcolor="#E8E8E8" height="100%">
                                <tr> 
                                    <td height="24" colspan="3" class="txt_users"><center>Currency Manager</center></td>
                    </tr>
                    <tr>
                        <td class="txt_users" colspan="3" align="center"><noscript>Javascript should be enabled for script validations</noscript></td>
                    </tr>
                    <tr><td>

                            <form name="frm" method="post">
                                <tr><td align="center" width=100%>
                                        <table border="0" align="center" cellpadding="5" cellspacing="2" width="98%" class=border2>

                                            <tr bgcolor="#eeeee1">
                                                <td colspan="4"><b>You can Enable or Disable the Currency</b></td>
                                                <?php if ($ef == 1) {
                                                    ?> <font color="#FF0000"><?php
                                                    echo $err_cur;
                                                    $ef = 0;
                                                    ?></font>
                                            <?php } ?> 
                                </tr>
                                <tr bgcolor="#eeeee1">
                                    <td width="40%"><strong>Currency</strong></td>
                                    <td width="30%" align="center"><strong>Select</strong><br>Show&nbsp;&nbsp;&nbsp;&nbsp;Hide</td>
                                    <td  width="30%" align="center"><strong>Equavalent Currency Code</strong></td>
                                    <td align="center"><input type="checkbox" name="chkMain" value="1" onclick="chkall();" /></td>
                                </tr>
                                <?php
                                /* $type=$_GET['type'];
                                  $s=$_GET['s'];
                                  if($type==c) {
                                  $id=$_GET['id'];
                                  if($s=='on') {
                                  $sql="update payment_process set status='off' where payment_id=$id";
                                  $result=mysql_query($sql);
                                  }
                                  if($s=='off') {
                                  $sql="update payment_process set status='on' where payment_id=$id";
                                  $result=mysql_query($sql);
                                  }
                                  }
                                  if(!$status) $status='on'; */

                                if (isset($_POST['submit'])) {
                                    $co_res = mysql_query("select * from currency_master");
                                    $count = mysql_num_rows($co_res);
                                    $selsql = "update currency_master set statuss='show' where currency_id=1";
                                    $selres = mysql_query($selsql);
                                    $i = 0;


                                    while ($fetch = mysql_fetch_array($co_res)) {
                                        $j = $i + 1;
                                        $rdval = 'rdVal' . $j;
                                        $txtval = 'txtVal' . $j;
                                        $txtsym = 'txtSym' . $j;

                                        $arr = $_POST[$rdval];
                                        $arr1 = $_POST[$txtval];
                                        $arr2 = $_POST[$txtsym];


                                        if (empty($arr2)) {
                                            $err_curr = "Please enter the currency";
                                            $ef = 1;
                                        } else if (empty($arr1)) {
                                            $err_curr = "Please enter the equivalent code";
                                            $ef = 1;
                                        }

                                        if (is_numeric($arr2)) {
                                            $err_curr = "Please enter a valid currency value";
                                            $ef = 1;
                                        }

                                        if ($ef != 1) {
                                            $selsql1 = "update currency_master set statuss='$arr',currency_code='$arr1',currency='$arr2' where currency_id=" . $fetch['currency_id'];
                                            $selres1 = mysql_query($selsql1);
                                            $i = $i + 1;
                                        } else {
                                            $selres1 = 0;
                                            $err_flag = 1;
                                            break;
                                        }
                                    }
                                }
                                if ($err_flag == 1) {
                                    ?>
                                    <tr bgcolor="eeeee1"><td align="center" colspan="4"><font size="+1" color="#FF0000"><?php = $err_curr; ?></font></td></tr>
                                    <?php
                                }
                                if ($selres1) {
                                    ?>
                                    <tr bgcolor="eeeee1"><td align="center" colspan="4"><font size=+1 color="red">Updated Successfully!</font></td></tr>
                                    <?php
                                }

                                if (isset($_POST['delete'])) {
                                    $co_res = mysql_query("select * from currency_master");
                                    $count = mysql_num_rows($co_res);
                                    $del = $_POST['chkdelete'];

                                    if (count($del) > 0) {

                                        $res = implode(",", $del);

                                        $sql = "delete from currency_master where currency_id in($res)";

                                        $result = mysql_query($sql);
                                        if ($result)
                                            $err_flag = 1;
                                    }
                                    if ($err_flag) {
                                        ?>
                                        <tr bgcolor="eeeee1"><td align="center" colspan="5"><font size=+1 color="red">Deleted Successfully!</font></td></tr>
                                        <?php
                                    }
                                }
                                $sql = "select * from currency_master";
                                $result = mysql_query($sql);
                                $i = 1;
                                while ($row = mysql_fetch_array($result)) {
                                    ?>

                                    <tr bgcolor="eeeee1">
                                        <td><input type="text" name="txtSym<?php = $i; ?>" value="<?php = $row['currency']; ?>" class="text" /></td>

                                        <td align="center"><?php if ($row['statuss'] == 'show') { ?>
                                                <input type="radio" name="rdVal<?php = $i; ?>" value="show" checked><?php
                                            } else {
                                                ?><input type="radio" name="rdVal<?php = $i; ?>" value="show"><?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php if ($row['statuss'] == 'hide') { ?>
                                                <input type="radio" name="rdVal<?php = $i; ?>" value="hide" checked><?php
                                            } else {
                                                ?><input type="radio" name="rdVal<?php = $i; ?>" value="hide"><?php } ?></td>
                                        <td align="center"><input type="text" name="txtVal<?php = $i; ?>" value=<?php = $row['currency_code']; ?>  class="text"></td>
                                        <td align="center"><input type="checkbox" name="chkdelete[]" id=chkdelete value="<?php = $row['currency_id']; ?>">Delete</td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                <tr bgcolor="eeeee1"><td colspan="4" style="text-align:center">
                                        <input type="hidden" name="ival" value="<?php = $i ?>" class="button" />
                                        <input type="submit" value=" Add " name="add" class="button">&nbsp;
                                        <input type="submit" name="submit" value="Update" class="button">
                                        <input type="submit" name="delete" value="Delete" class="button" onclick="return val();"></td></tr>
                </table></td>
        </tr>
    </form>
    </table>

    <?php
}
if (isset($_POST[cancel])) {
    exit('<meta http-equiv="refresh" content="0;url=currency_manager.php">');
}
require 'include/footer1.php'
?>

<script language="JavaScript">
    function chk() {
        if (document.frm1.txtCurr.value == "") {
            alert("Please Enter the Currency");
            document.frm1.txtCurr.focus();
            return false;
        }

        else if (document.frm1.txtValue.value == "") {
            alert("Please Enter the Currency Code ");
            document.frm1.txtValue.focus();
            return false;
        }
        else if (document.frm1.txtCurr.value != '')
        {

            if (!isNaN(document.frm1.txtCurr.value))
            {
                alert("Please enter the currency value correctly(numeric fields are not allowed)");
                document.frm1.txtCurr.focus();
                return false;
            }
        }
        else
            return true;


    }
    function chkall() {
        len = document.frm.chkdelete.length;
        if (len > 1) {
            for (i = 0; i < len; i++) {
                if (document.frm.chkMain.checked == true) {
                    document.frm.chkdelete[i].checked = true;
                }
                else {
                    document.frm.chkdelete[i].checked = false;
                }
            }
        }
        else {
            if (document.frm.chkMain.checked == true) {
                document.frm.chkdelete.checked = true;
            }
            else {
                document.frm.chkdelete.checked = false;
            }

        }
    }
    function conDelete()
    {
        var conf;
        conf = window.confirm("are you sure you want to delete");
        return conf;
    }

    function val()
    {
        len = document.frm.chkdelete.length;

        flag = 0;
        if (len > 0)
        {
            for (i = 0; i < len; i++)
            {
                if (document.frm.chkdelete[i].checked == true)
                {
                    var conf;
                    conf = window.confirm("Are you sure you want to delete the currency?");
                    flag = 1;
                    return conf;
                    break;
                }

            }
        }
        if (flag == 0)
        {
            alert("Please select the currency");
            return false;
        }

    }
</script>
