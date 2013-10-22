<?php
/* * *************************************************************************
 * File Name				:payment_manager.php
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
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table>
                <tr><td width=93><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/links5_01.jpg" width="93" height="25" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href=site.php?page=pay><img src="images/links5_02.jpg" width="93" height="71" alt="" border=0 title="PaymentSettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href=earnings.php><img src="images/links5_03.jpg" width="93" height="71" alt="" border=0 title="AdminEarnings"></a></td>
                            </tr>
                            <tr>
                                <td><a href=fee_setting.php><img src="images/links5_04.jpg" width="93" height="74" alt="" border=0 title="FeeSettings"></a></td>
                            </tr>

                        </table></td><td width=793>
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
                            $co_res = mysql_query("select * from payment_gateway order by gateway_id");
                            $count = mysql_num_rows($co_res);
                            $rdarr = array($_POST['rdVal1'], $_POST['rdVal2'], $_POST['rdVal3'], $_POST['rdVal4'], $_POST['rdVal5'], $_POST['rdVal6'], $_POST['rdVal7'], $_POST['rdVal8'], $_POST['rdVal9'], $_POST['rdVal10'], $_POST['rdVal11'], $_POST['rdVal12']);
                            for ($i = 0; $i < $count; $i++) {
                                $j = $i + 1;
                                $selsql = "update payment_gateway set status='$rdarr[$i]' where gateway_id=$j";
                                $selres = mysql_query($selsql);
                            }
                            $mes = "Payment Settings Modified Successfully";
                        }
                        ?>

                        <table border="0" align="center" cellpadding="0" cellspacing="0" width="98%" class="border2">
                            <form name="frm" method="post">
                                <tr><td>
                                        <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%">
                                            <tr bgcolor="#FFFFFF">
                                                <td colspan="2" align="center">
                                                    <font color="#FF0000">
                                                    <?php
                                                    if ($mes != '')
                                                        echo $mes;
                                                    ?>
                                                    </font>
                                                </td>
                                            </tr>
                                            <tr bgcolor="#CCCCCC"> 
                                                <td height="24" colspan="2" class="txt_users">Payment Manager</td>
                                            </tr>
                                            <tr bgcolor="#CCCCCC">
                                                <td colspan="2" ><b>You can Enable or Disable the Payment Process for your site</b></td>
                                            </tr>
                                            <tr bgcolor="#CCCCCC">
                                                <td><strong>Payment Method</strong></td>
                                                <td><strong>Select</strong><br>Show&nbsp;&nbsp;&nbsp;&nbsp;Hide</td>
                                            </tr>

                                            <?php
                                            $sql = "select * from payment_gateway order by gateway_id";
                                            $result = mysql_query($sql);
                                            $i = 1;
                                            while ($row = mysql_fetch_array($result)) {
                                                ?>

                                                <tr bgcolor="eeeee1">
                                                    <td><?php = $row['payment_gateway']; ?></td>
                                                    <td><?php
                                                        if ($row['status'] == 'Yes') {
                                                            ?>
                                                            <input type="radio" name="rdVal<?php = $i; ?>" value="Yes" checked>
                                                            <?php
                                                        } else {
                                                            ?><input type="radio" name="rdVal<?php = $i; ?>" value="Yes"><?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <?php if ($row['status'] == 'No') { ?>
                                                            <input type="radio" name="rdVal<?php = $i; ?>" value="No" checked><?php } else {
                                                            ?><input type="radio" name="rdVal<?php = $i; ?>" value="No"><?php } ?></td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            <tr bgcolor="#eeeee1"><td colspan="3" align="center"><input type="submit" name="submit" value="Modify" class="button"></td></tr>
                                        </table></td>
                                </tr>
                            </form>
                        </table></td></tr></table></td></tr></table>
