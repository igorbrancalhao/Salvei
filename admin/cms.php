<?php
/* * *************************************************************************
 * File Name				:cms.php
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
error_reporting(0);
$val = $_POST['cboTable'];
if ($val == '')
    $val = $_GET['val'];
$tsql = "select * from master_list where master_id=$val";
$tres = mysql_query($tsql);
$trow = mysql_fetch_array($tres);
$tname = $trow['master'];
$tid = $trow['one'];
$tfield = $trow['two'];
if (isset($_POST['delete'])) {
    $val = $_POST['val'];
    $tsql = "select * from master_list where master_id=$val";
    $tres = mysql_query($tsql);
    $trow = mysql_fetch_array($tres);
    $tname = $trow['master'];
    $tid = $trow['one'];
    $tfield = $trow['two'];
    $coid = $_POST['chkSub'];
    for ($i = 0; $i < count($coid); $i++) {
        $cnid = $coid[$i];
        $sql = "delete from $tname where $tid=$cnid";
        $result = mysql_query($sql);
    }
}
if (isset($_POST['edit'])) {
    $val = $_POST['val'];
    $tsql = "select * from master_list where master_id=$val";
    $tres = mysql_query($tsql);
    $trow = mysql_fetch_array($tres);
    $tname = $trow['master'];
    $tid = $trow['one'];
    $tfield = $trow['two'];
    $name = $_POST['txtEdit'];
    $catid = $_POST['id'];
    for ($i = 0; $i < count($name); $i++) {
        $sql = "update $tname set $tfield='$name[$i]' where $tid='$catid[$i]'";
        $result = mysql_query($sql);
        $message = "Postings Edited Sucessfully";
    }
}
?>
<style type="text/css">
    <!--
    .style1 {font-weight: bold}
    -->
</style>
<link href="include/style.css" type="text/css" rel="stylesheet">
<?php
require 'include/top.php';
?>
<form name="tableform" method="post" action="cms.php">
    <table width="70%" align="center">
        <tr><td colspan="3" align="center">Select Table&nbsp;&nbsp;<select name="cboTable" onChange="this.form.submit();">
                    <option value="">Select</option>
                    <?php
                    $tres = mysql_query("select * from master_list");
                    while ($trow = mysql_fetch_array($tres)) {
                        ?>
                        <option value="<?php = $trow[0]; ?>"><?php = $trow[1]; ?></option>
                        <?php
                    }
                    ?>
                </select></td></tr>
    </table>
</form>
<?php
$mode = $_GET['mode'];
if ($mode == 'add') {
    $cansave = $_POST['cansave'];
    $value = $_POST['txtValue'];
    $asql = "insert into $tname ($tfield) values ('$value')";
    $ares = mysql_query($asql);
    if ($ares)
        $message = "Item added sucessfully";
    else
        $message = "sorry, Item addition failed";
    ?>
    <form name="frmadd" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="this.cansave.value = 1;">
        <table width="100%" align="center">
            <tr><td colspan="2" align="center"><font face="Arial, Helvetica, sans-serif" style=" font-weight:bold"><?php = $message; ?></font></td></tr>
            <tr><td>Enter Item</td>
                <td><input type="text" name="txtValue" class="text"></td></tr>
            <tr><td colspan="2" align="center"><input type="hidden" name="cansave" value="0">
                    <input type="submit" name="submit" value="Add Item" class="button"></td></tr>
        </table>
    </form>
    <?php
}if ($mode != 'add') {
    ?>
    <form name="frm" method="post" action="cms.php">
        <div align="right" style="width:90%"><a href="cms.php?mode=edit&val=<?php = $val; ?>" id="link1">Edit</a> | <a href="cms.php?mode=add&val=<?php = $val; ?>" id="link1">Add Item</a></div>
        <br>
        <table width="80%"  border="0" cellpadding="5" cellspacing="1" class="tablebox" align="center">
            <tr bgcolor="#CCCCCC" class="style1"><td width="6%"><strong>S.No</strong></td>
                <td width="4%"><input type="checkbox" name="chkMain" onClick="chkall();" class="check" value=1></td> 
                <td><strong>Value</strong></td>
            </tr>
            <?php
            if ($val == '')
                $mresult = mysql_query("select * from master_list where master_id=2");
            else
                $mresult = mysql_query("select * from master_list where master_id=$val");
            $mrow = mysql_fetch_array($mresult);
            $masterid = $mrow['master_id'];
            $master = $mrow['master'];
            $sql = "select * from " . $master;
            $result = mysql_query($sql);
            $total_records = mysql_num_rows($result);
            $curpage = $_GET['curpage'];
            if (strlen($_GET['curpage']) == 0)
                $curpage = 1;
            $start = ($curpage - 1) * 10;
            $end = 10;
            if ($curpage == '' || $curpage == 1)
                $i = 1;
            else
                $i = $_GET['sno'] + 1;
            $sql.=" limit $start,$end";
            $result = mysql_query($sql);
            ?>
            <tr> 
                <td align="right" colspan="3"> 
                    <?php
                    if ($curpage != 1) {
                        ?>
                        <a href="cms.php?val=<?php = $val; ?>&curpage=<?php = ($curpage - 1); ?>&sno=<?php = ($curpage * 10) - 20; ?>">Prev</a> 
                        | 
                        <?php
                    }
                    ?>
                    <?php
                    if ($total_records > ($start + $end)) {
                        ?>
                        <a href="cms.php?val=<?php = $val; ?>&curpage=<?php = ($curpage + 1); ?>&sno=<?php = $curpage * 10; ?>">Next</a> 
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
            while ($row = mysql_fetch_array($result)) {
                ?>
                <tr bgcolor="eeeee1"><td><?php = $i ?></td>
                    <td><input name="chkSub[]" id="chkSub" type="checkbox" class="check" value="<?php = $row[0]; ?>">
                        <input type="hidden" name="id[]" value="<?php = $row[0]; ?>"> </td> 
                    <td><?php
                        if ($mode == 'edit')
                            echo '<input type=text name=txtEdit[] class=text value=' . $row[1] . '>';
                        else
                            echo $row[1];
                        ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            <tr><td colspan="3"><input type="submit" name="delete" value="Delete" class="button">
                    <?php
                    if ($mode == 'edit') {
                        ?>
                        <input type="submit" name="edit" value="Edit" class="button">
                        <input type="hidden" name="txtCatid[]" value="<?php = $row[0]; ?>"><?php
                    }
                    ?>
                    <input type="hidden" name="val" value="<?php = $val; ?>"></td> 
        </table>
    </form>
    <?php
}
?>
<?php
require 'include/footer.php';
?>
<script language="javascript">
    function chkall() {
        len = document.frm.chkSub.length;
        if (len > 1) {
            for (i = 0; i < len; i++) {
                if (document.frm.chkMain.checked == true) {
                    document.frm.chkSub[i].checked = true;
                }
                else {
                    document.frm.chkSub[i].checked = false;
                }
            }
        }
        else {
            if (document.frm.chkMain.checked == true) {
                document.frm.chkSub.checked = true;
            }
            else {
                document.frm.chkSub.checked = false;
            }

        }
    }
    function condelete()
    {
        var a;
        a = confirm("Are you sure, you want to delete this item ?");
        return a;
    }
</script>