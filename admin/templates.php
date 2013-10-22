<?php
/* * *************************************************************************
 * File Name				:templates.php
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
require 'include/connect.php';
if (isset($_POST['btn_Activate'])) {
    $style = $_POST['chkStyle'];
    $sel_res = mysql_query("select * from css");
    while ($sel_row = mysql_fetch_array($sel_res)) {
        if ($style == $sel_row['css_id'])
            $act_res = mysql_query("update css set status='active' where css_id=$style");
        else
            $act_res = mysql_query("update css set status='inactive' where css_id=" . $sel_row['css_id']);
    }
    $message = "Style Sheet Activated Successfully";
}
?>
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
    <!--
    .style1 {
        color: #666666;
        font-weight: bold;
    }
    .style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
    -->
</style>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table>
                <tr><td width="93"><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/index_02_03_03_01.jpg" width="93" height="26" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href="user.php"><img src="images/index_02_03_03_02.jpg" width="93" height="70" alt="" border="0" title="UserManagement"></a></td>
                            </tr>
                            <tr>
                                <td><a href="site.php"><img src="images/index_02_03_03_03.jpg" width="93" height="71" alt="" border="0" title="GeneralSettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href="site.php?page=style"><img src="images/index_02_03_03_04.jpg" width="93" height="73" alt="" border="0" title="StyleSettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href="report.php?page=out"><img src="images/index_02_03_03_05.jpg" width="93" height="71" alt="" border="0" title="DetailReport"></a></td>
                            </tr>
                            <tr>
                                <td><a href="store_manager.php"><img src="images/index_02_03_03_06.jpg" width="93" height="70" alt="" border="0" title="StoreManager"></a></td>
                            </tr>
                            <tr>
                                <td><a href="bulk_load.php"><img src="images/index_02_03_03_07.jpg" width="93" height="66" alt="" border="0" title="BulkLoader"></a></td>
                            </tr>
                        </table></td>
                    <td width="792">
                        <table width="100%" height="311" align="center" cellpadding="2" class="border2" >
                            <form name="frm" method="post">
                                <tr bgcolor="#CCCCCC" class="txt_users">
                                    <td colspan="3" align="center">
                                        <?php
                                        if ($message != '')
                                            echo $message;
                                        ?>
                                    </td>
                                </tr>
                                <tr bgcolor="#CCCCCC" class="txt_users"> 
                                    <td height="24" colspan="3">Templates</td>
                                </tr>
                                <tr bgcolor="#eeeee1" class="style1"> 
                                    <td><strong>S.No</strong></td>
                                    <td></td>
                                    <td><strong>Style sheet name</strong></td>
                                </tr>
                                <?php
                                $sql = "select * from css";
                                $res = mysql_query($sql);
                                $i = 1;
                                while ($row = mysql_fetch_array($res)) {
                                    ?>
                                    <tr bgcolor="eeeee1"> 
                                        <td width="6%"> 
                                            <?php = $i; ?>
                                        </td>
                                        <td width="5%">
                                            <?php if ($row['status'] == 'active') { ?>
                                                <input type="radio" class="noborder" name="chkStyle" value="<?php = $i ?>" checked>  
                                                <?php
                                            } else {
                                                ?>
                                                <input type="radio" class="noborder" name="chkStyle" value="<?php = $i ?>">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td width="89%" class="txt_sitedetails"> 
                                            <?php = $row['css_name']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                <tr bgcolor="eeeee1"> 
                                    <td align="center" colspan="3"><input type="submit" name="btn_Activate" value="Activate" class="button"></td>
                                </tr>
                            </form></table></td></tr></table></td></tr></table>

