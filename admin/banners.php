<?php
/* * *************************************************************************
 * File Name				:banners.php
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
error_reporting(0);
require 'include/connect.php';
$special_char = array('*', '#', '@', '!', '%', '&', '|', '+', '-', '$', '^');
$type = $_GET['type'];
if (!$type)
    $type = 'd';
$mode = $_GET['mode'];
$id = $_GET['id'];
if ($mode == 'edit') {
    $remove = $_GET['remove'];
    $edit_sql = "select * from banners where banner_id=$id";
    $edit_res = mysql_query($edit_sql);
    $edit_row = mysql_fetch_array($edit_res);
    if ($remove == 1) {
        unlink($edit_row['banner_path']);
        $up_ban_sql = "update banners set banner_path='null' where banner_id=$id";
        $up_ban_res = mysql_query($up_ban_sql);
    }
    $edit_sql = "select * from banners where banner_id=$id";
    $edit_res = mysql_query($edit_sql);
    $edit_row = mysql_fetch_array($edit_res);
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
<body <?php if ($mode == 'add') { ?>onLoad="disp(1, '')"<?php } else if ($mode == 'edit') { ?>onLoad="disp('<?php = $edit_row['status'] ?>', '<?php = $edit_row['banner_path'] ?>')"<?php } ?>>
    <?php
    require 'include/top.php';
    ?>
    <?php
    if ($mode == 'add' || $mode == 'edit') {
        $canadd = $_POST['canAdd'];
        if ($canadd == 1) {
            $f = 0;
            $bname = $_POST['txtBanner'];

            if (strlen($_FILES['userfile']['name']) == 0) {

                $burl = $_POST['txtBurl'];
                if ($mode == 'add')
                    $status = 'off';
                else
                    $status = $edit_row['status'];
            }
            else {



                if ($_FILES['userfile']['type'] == 'image/pjpeg' || $_FILES['userfile']['type'] == 'image/jpg' || $_FILES['userfile']['type'] == 'image/gif' || $_FILES['userfile']['type'] == 'image/jpeg') {
                    $upbanner = $_FILES['userfile']['tmp_name'];
                    if ($upbanner)
                        list($width, $height, $type, $attr) = getimagesize($upbanner);


                    if ($width > 728 or $height > 90) {

                        $f = 1;
                        $msg = 4;
                    }
                    if ($f != 1) {
                        $upbannername = $_FILES['userfile']['name'];
                        $upbannername = str_replace($special_char, '', $upbannername);
                        $uploaddir = "../images/" . $upbannername;
                        move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir);
                        $burl = "images/" . $upbannername;
                        $status = 'default';
                    }
                }
            }
            $surl = $_POST['txtSurl'];
            if (($mode == 'add') and ($f != 1)) {
                $ins_sql = "insert into banners(banner_name,banner_path,site_url,status) values('$bname','$burl','$surl','$status')";
                $msg = 1;
            } else if (($mode == 'edit') and ($f != 1)) {
                if ($burl) {
                    $ins_sql = "update banners set banner_name='$bname',banner_path='$burl',site_url='$surl',status='$status' where banner_id=$id";
                    $msg = 2;
                } else {
                    $ins_sql = "update banners set banner_name='$bname',site_url='$surl',status='$status' where banner_id=$id";
                    $msg = 2;
                }
            }
            $ins_res = mysql_query($ins_sql);
            echo '<meta http-equiv="refresh" content="0;url=banners.php?msg=' . $msg . '>';
        }
        ?>
        <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
            <tr><td>
                    <table>
                        <tr><td width=93>
                                <table id="Table_01" width="91" height="166" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td><a href="#" style="text-decoration:none" id="link" onClick="window.open('../index.php')" ><img src="images/links9_02.jpg" width="93" height="70" alt="" border="0" title="Homepage"></a></td>
                                    </tr>
                                    <tr>
                                        <td><a href=frontpagebanner.php>
                                                <img src="images/links9_03.jpg" width="93" height="70" alt="" border="0" title="BannerSettings"></a></td>
                                    </tr>
                                    <tr>
                                        <td><a href=frontpagebanner.php><img src="images/links9_03.jpg" width="93" height="70" alt="" border=0></a></td>
                                    </tr>
                                </table></td><td width=793>
                                <table width="98%"><tr><td width=25%><center><a href=banners.php?page=news class="txt_users">Footer Banners(728X90)</a></center></td><td width=30%><center><a href=small_banners.php class="txt_users">Front Page(503X189) Banner</a></center> 
                </td><td width=30%><center><a href=frontpagebanner.php class="txt_users">Front Page(278X259) Banner</a></center></td><td class="txt_users" width=20%><a href="static_banners.php" class="txt_users">Default Banner</a></td></tr>
    </table>
    <table border="0" align="center" cellpadding="5" cellspacing="2" width="96%" class="border2">
        <form name="frmAdd" action="<?php $_SERVER['PHP_SELF'] ?>" method="post"  enctype="multipart/form-data">

            <tr><td bgcolor="#cccccc" class="txt_users" colspan="2"><?php
                    echo ucwords($mode);
                    if ($type == 'd')
                        echo ' Default'
                        ?> Footer Banner(728X90)</td></tr>
            <tr bgcolor="#eeeee1"><td>Banner Name</td>
                <td>
                    <input type="text" name="txtBanner" value="<?php = $edit_row['banner_name'] ?>" size="60">&nbsp;&nbsp;&nbsp;

                </td>
            </tr>
            <?php
            if ((strlen($edit_row['banner_path']) != 0 && $edit_row['banner_path'] != 'null') && ($edit_row['status'] == 'default' || $edit_row['status'] == 'ad')) {
                ?>
                <tr bgcolor="#eeeee1">
                    <td colspan="2">
                        <img src="../<?php = $edit_row['banner_path'] ?>" width="600" height="90"><br>
                        <div align="center"><a href="banners.php?mode=edit&id=<?php = $id ?>&remove=1" id="tablink" onClick="return condel()">Remove</a></div>
                        <div>To Change the Banner you need to remove the Banner and Upload a New Banner</div>
                        <?php
                    } else {
                        ?>
                <tr bgcolor="#eeeee1">
                    <td colspan="2">Banner Image (Please Select Upload image to locate the Banner in your System else Choose type URL to type the URL of the Banner)
                    </td>
                </tr>
                <tr bgcolor=#eeeee1><td colspan="2">
                        <input type="file" name=userfile>
                    </td></tr>
                <?php
            }
            ?>
            <tr bgcolor="#eeeee1"><td>Site Url</td><td><input type="text" id="txtSurl"  name="txtSurl" value="<?php
                    if ($mode == 'edit')
                        echo $edit_row['site_url'];
                    else
                        echo 'http://';
                    ?>" size="60"> </td></tr>
            <tr bgcolor="#eeeee1"><td colspan="2" align="center"><input type="hidden" name="type" value="<?php = $type ?>">
                    <input type="hidden" name="canAdd" value="0">
                    <input type="submit" name="btnAdd" value="  Add   " class="button" onClick="return val();">
                </td></tr>
        </form>
    </table>
    <?php
}
else if ($mode == 'del') {
    $del_sql = "delete from banners where banner_id=$id";
    $del_res = mysql_query($del_sql);
    echo '<meta http-equiv="refresh" content="0;url=banners.php?msg=3">';
} else {

    if ($type == 'e') {
        ?>
        <table border="0" align="center" cellpadding="5" cellspacing="2" width="96%" class="border2">
            <tr>
                <td align="center"><a href="banners.php?type=e&mode=s" id="tablink">Suspend</a></td>
                <td align="center"><a href="banners.php?type=e&mode=a" id="tablink">Activate</a></td>
            </tr>
        </table><br>
        <?php
    }
    if (isset($_POST['btn_Act'])) {
        if ($type == 'e') {
            $act = $_POST['chkAct'];
            foreach ($act as $id) {
                $up_sql = "update banners set status='on' where banner_id=$id";
                $up_res = mysql_query($up_sql);
            }
        } else if ($type == 'd') {
            $act = $_POST['rdAct'];
            $up_sql = "update banners set status='ad' where banner_id=$act";
            $up_res = mysql_query($up_sql);
            $up_sql1 = "update banners set status='default' where banner_id <> $act and status='ad'";
            $up_res1 = mysql_query($up_sql1);
        }
    } else if (isset($_POST['btn_Sus'])) {
        if ($type == 'e') {
            $act = $_POST['chkAct'];
            foreach ($act as $id) {
                $up_sql = "update banners set status='off' where banner_id=$id";
                $up_res = mysql_query($up_sql);
            }
        } else if ($type == 'd') {
            $act = $_POST['rdAct'];
            $up_sql = "update banners set status='off' where banner_id=$act";
            $up_res = mysql_query($up_sql);
        }
    }
    if ($type == 'e') {
        if (!$mode)
            $mode = 'a';
        if ($mode == 's')
            $ban_sql = "select * from banners where status <> 'default' and status='off'";
        else if ($mode == 'a')
            $ban_sql = "select * from banners where status <> 'default' and status='on'";
    }
    else if ($type == 'd')
        $ban_sql = "select * from banners where status = 'default' or status='ad'";
    $ban_result = mysql_query($ban_sql);
    ?>
    <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
        <tr><td>
                <table>
                    <tr><td width=93>
                            <table id="Table_01" width="91" height="166" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td><img src="images/links9_01.jpg" width="93" height="26" alt=""></td>
                                </tr>
                                <tr>
                                    <td><a href="#" style="text-decoration:none" id="link" onClick="window.open('../index.php')" ><img src="images/links9_02.jpg" width="93" height="70" alt="" border="0" title="Homepage"></a></td>
                                </tr>
                                <tr>
                                    <td><a href=frontpagebanner.php>
                                            <img src="images/links9_03.jpg" width="93" height="70" alt="" border="0" title="BannerSettings"></a></td>
                                </tr>
                            </table></td><td width=793>
                            <table width="98%"><tr><td width=25%><center><a href=banners.php?page=news class="txt_users">Footer Banners(728X90)</a></center></td><td width=30%><center><a href=small_banners.php class="txt_users">Front Page(503X189) Banner</a></center> 
            </td><td width=30%><center><a href=frontpagebanner.php class="txt_users">Front Page(278X259) Banner</a></center></td><td class="txt_users" width=20%><a href="static_banners.php" class="txt_users">Default Banner</a></td></tr></table>
    <table border="0" align="center" cellpadding="5" cellspacing="2" width="96%" class="border2">
        <form name="frmBan" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" <?php if ($type == 'e') { ?>onSubmit="return validate()"<?php } ?>>
            <tr bgcolor="#eeeee1"><td colspan="6" align="center" class="style1"><font color="#FF0000">
                    <?php
                    if ($_GET['msg'] == 1)
                        echo "Banner Added Successfully";
                    elseif ($_GET['msg'] == 2)
                        echo "Banner Edited Successfully";
                    elseif ($_GET['msg'] == 3)
                        echo "Banner Deleted Successfully";
                    elseif ($_GET['msg'] == 4)
                        echo "Please Enter the Correct Banner Image Size(728X90)";
                    ?>
                    </font></td></tr>
            <tr><td colspan="6" bgcolor="#cccccc" class="txt_users">Footer Banner(728X90)</td></tr>
            <?php
            if (mysql_num_rows($ban_result) > 0) {
                ?>
                <tr bgcolor="#eeeee1">
                <!--<td><?php
                    if ($type == 'e')
                        echo "<input type='checkbox' name='chkMain' value=1 onClick='selectall()'>";
                    else
                        echo '&nbsp;'
                        ?></td>-->
                    <td><b>Banner Name</b></td><td><b>Path</b></td><td><b>Website</b></td>
                    <td colspan="2"><b>Action</b></td>
                </tr>
                <?php
                $i = 1;
                while ($row = mysql_fetch_array($ban_result)) {
                    ?>
                    <tr bgcolor="#eeeee1">
                    <!--<td><input type="<?php if ($type == 'd') echo 'radio';else if ($type == 'e') echo 'checkbox'; ?>" name="<?php if ($type == 'd') echo 'rdAct'; else if ($type == 'e') echo 'chkAct[]' ?>" <?php if ($type == 'e') echo 'id="chkAct"' ?> value="<?php = $row['banner_id'] ?>" <?php if ($type == 'd' && $row['status'] == 'ad') echo 'checked'; ?>></td>
                        --><td><?php = $row['banner_name'] ?></td><td><?php = $row['banner_path'] ?></td>
                        <td><?php = $row['site_url'] ?></td>
                        <td><a href="banners.php?mode=edit&id=<?php = $row['banner_id'] ?>" id="tablink">Edit</a></td>
                        <td><a href="banners.php?mode=del&id=<?php = $row['banner_id'] ?>" id="tablink" onClick="return condel()">Delete</a></td>
                    </tr>
                    <?php
                    $i+=1;
                }
                ?>
                <?php
                /* if(($_SESSION['admin_type']=="main") or ($s1['sus']=="on"))
                  { */
                ?>
        <!--<tr bgcolor="#eeeee1">
        <td colspan="6" align="center"><input type="submit" name="<?php
                if ($mode == 's' || $type == 'd')
                    echo 'btn_Act';
                else
                    echo 'btn_Sus';
                ?>" value="<?php
                if ($mode == 's' || $type == 'd')
                    echo 'Activate';
                else
                    echo 'Suspend';
                ?>" class="button"></td>-->
                </tr>
                <?php
                /* } */
                ?>
                <?php
            }
            else {
                ?>
                <tr bgcolor="#eeeee1">
                    <td align="center" colspan="6">No Banners Found</td>
                </tr>
                <?php
            }
            ?>

            <tr bgcolor="#eeeee1">
                <td colspan="6"><a href="banners.php?mode=add&type=<?php = $type ?>" id="tablink">Add New</a></td>
            </tr>
        </form>
    </table>
    <?php
}
?>
</td></tr></table></td></tr></table>
<?php
require 'include/footer.php';
?>

<script language="Javascript">
    function validate() {
        len1 = document.frmBan.chkAct.length;
        cval = 0;
        if (len1 > 1) {
            for (i = 0; i < len1; i++) {
                if (document.frmBan.chkAct[i].checked == true)
                    cval = cval + 1;
            }
        }
        else {
            if (document.frmBan.chkAct.checked == true)
                cval = cval + 1;
        }
        if (cval >= 1) {
            return true;
        }
        else {
            alert("You Have'nt Selected any Banner to Activate");
            return false;
        }
    }

    function val()
    {
        if (frmAdd.txtBanner.value == "")
        {
            alert("Please Enter the Banner Name");
            frmAdd.txtBanner.focus();
            return false;
        }
        if (frmAdd.userfile.value == "")
        {
            alert("Please Enter the Banner Image");
            frmAdd.userfile.focus();
            return false;
        }
        if (frmAdd.userfile.value != "")
        {
            l1 = frmAdd.userfile.value;
            l = l1.length - 1;
            lastdot = l1.lastIndexOf('.');
            diff = l - lastdot;
            s = l1.substr(lastdot + 1, l);
            //	alert(s);
            if ((s != 'jpg') && (s != 'jpeg') && (s != 'gif') && (s != 'bmp'))
            {
                alert("Please Give a Valid Image File");
//		f1.img1.value = "";
                frmAdd.userfile.focus();
                return false;
            }
        }
        if (frmAdd.txtSurl.value == "http://")
        {
            alert("Please Enter the Site URL");
            frmAdd.txtSurl.focus();
            return false;
        }
        if (document.frmAdd.txtSurl.value != "http://")
        {
            var tomatch = /^(http:\/\/)[Ww\.-]{3,}\.[A-Za-z]{3,}\.([A-Za-z]{2,})/;
            if (!(document.frmAdd.txtSurl.value.match(tomatch)))
            {
                alert("URL invalid. Try again.");
                frmAdd.txtSurl.focus();
                return false;
            }
        }
        frmAdd.canAdd.value = 1;
        return true;
    }

    function selectall() {
        len = document.frmBan.chkAct.length;
        if (len > 1) {
            for (i = 0; i < len; i++) {
                if (document.frmBan.chkMain.checked == true)
                    document.frmBan.chkAct[i].checked = true;
                else
                    document.frmBan.chkAct[i].checked = false;
            }
        }
        else {
            if (document.frmBan.chkMain.checked == true)
                document.frmBan.chkAct.checked = true;
            else
                document.frmBan.chkAct.checked = false;
        }
    }
    function condel() {
        a = confirm("Are you Sure to Delete this Banner");
        return a;
    }

</script>