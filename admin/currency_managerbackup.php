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
?>
<?php session_start(); ?>
<link href="include/style.css" rel="stylesheet" type="text/css">
<?php
require 'include/top.php';
if (isset($_POST['add'])) {
    /*
      $currrency=$_POST[txtCurr];
      $eq_val=$_POST[txtValue];
      if(!empty($currrency))
      {
      $in_sql="insert into currency_master(currency,eq_value)values('$currrency',$eq_val)";
      $in_res=mysql_query($in_sql);
      if($in_res) echo 'Currency added Successfully';
      else echo 'Currency not added';
      }
      else
      { */
    ?>
    <table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
        <tr><td>
                <table border="0" align="center" cellpadding="5" cellspacing="2" width="760" bgcolor="#E8E8E8" height="100%">
                    <form name="frm1" method="post">
                        <tr><td>
                                <table border="0" align="center" cellpadding="5" cellspacing="2" width="700" bgcolor="#E8E8E8" height="100%" class="border2">
                                    <tr bgcolor="eeeee1"><td colspan="2" width="100%"  height="30" class="txt_users" style="text-align:center">&nbsp;&nbsp;&nbsp;Add Currency </td></tr>
                                    <tr bgcolor="eeeee1"><td width="50%" height="40">&nbsp;&nbsp;&nbsp;Currency</td><td><input type="text" name="txtCurr"></td></tr>
                                    <tr bgcolor="eeeee1"><td width="50%" height="40">&nbsp;&nbsp;&nbsp;Please Enter Equavalent Currency Code </td><td><input type="text" name="txtValue"></td></tr>
                                    <tr   bgcolor="eeeee1">
                                        <td  colspan="2" align="center" height="40"><input type="submit" name="addnew" value=" Add " class="button" onclick="return val();"></td></tr>
                                </table>
                            </td></tr></form></table>
                <?php
//}
            } else {
                ?>

                <?php
                if (isset($_POST['addnew'])) {
                    $currrency = $_POST[txtCurr];
                    $eq_val = $_POST[txtValue];
                    if (!empty($currrency)) {
                        $in_sql = "insert into currency_master(currency,currency_code)values('$currrency','$eq_val')";
                        $in_res = mysql_query($in_sql);
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
                    </tr><tr><td>
                            <form name="frm" method="post">
                                <tr><td align="center" width=100%>
                                        <table border="0" align="center" cellpadding="5" cellspacing="2" width="98%" class=border2>

                                            <tr bgcolor="#eeeee1">
                                                <td colspan="3"><b>You can Enable or Disable the Currency</b></td>
                                            </tr>
                                            <tr bgcolor="#eeeee1">
                                                <td width="40%"><strong>Currency</strong></td>
                                                <td width="30%" align="center"><strong>Select</strong><br>Show&nbsp;&nbsp;&nbsp;&nbsp;Hide</td>
                                                <td  width="30%" align="center"><strong>Equavalent Currency Code</strong></td>
                                            </tr>
                                            <?php
                                            //$status=$_GET['status'];
                                            require 'include/connect.php';

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
                                                $selsql = "update currency_master set statuss='show',currency_code='1' where currency_id=1";
                                                $selres = mysql_query($selsql);

                                                for ($i = 0; $i < $count; $i++) {

                                                    $j = $i + 1;
                                                    $rdval = 'rdVal' . $j;
                                                    $txtval = 'txtVal' . $j;

                                                    $arr = $_POST[$rdval];
                                                    $arr1 = $_POST[$txtval];

                                                    $selsql = "update currency_master set statuss='$arr',currency_code='$arr1' where currency_id=$j";
                                                    $selres = mysql_query($selsql);
                                                }
                                            }
                                            if ($selres) {
                                                ?>
                                                <tr bgcolor="eeeee1"><td align="center" colspan="3"><font size=+1 color="red">Updated Successfully!</font></td></tr>
                                                <?php
                                            }
                                            $sql = "select * from currency_master";
                                            $result = mysql_query($sql);
                                            $i = 1;
                                            while ($row = mysql_fetch_array($result)) {
                                                ?>

                                                <tr bgcolor="eeeee1">
                                                    <td><?php = $row['currency']; ?></td>

                                                    <td align="center"><?php if ($row['statuss'] == 'show') { ?>
                                                            <input type="radio" name="rdVal<?php = $i; ?>" value="show" checked><?php } else {
                                                    ?><input type="radio" name="rdVal<?php = $i; ?>" value="show"><?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <?php if ($row['statuss'] == 'hide') { ?>
                                                            <input type="radio" name="rdVal<?php = $i; ?>" value="hide" checked><?php } else {
                                                            ?><input type="radio" name="rdVal<?php = $i; ?>" value="hide"><?php } ?></td>
                                                    <td align="center"><input type="text" name="txtVal<?php = $i; ?>" value=<?php = $row['currency_code']; ?>  class="text"></td>

                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            <tr bgcolor="eeeee1"><td colspan="3" style="text-align:center">
                                                    <input type="hidden" name="ival" value="<?php = $i ?>" class="button" />
                                                    <input type="submit" value=" Add " name="add" class="button">&nbsp;
                                                    <input type="submit" name="submit" value="Update" class="button"></td></tr>
                                        </table></td>
                                </tr>
                            </form>
                </table>

            <?php }require 'include/footer1.php' ?>
            <script language="javascript">
                function val()
                {
                    if (frm1.txtCurr.value == "")
                    {
                        alert("Please Enter the Currency");
                        frm1.txtCurr.focus();
                        return false;
                    }
                    if (frm1.txtValue.value == "")
                    {
                        alert("Please Enter the Equivalent Currency Code");
                        frm1.txtValue.focus();
                        return false;
                    }
                    return true;
                }
            </script>
