<?php
/* * *************************************************************************
 * File Name				:small_banners.php
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
    $edit_sql = "select * from small_banner where banid=$id";
    $edit_res = mysql_query($edit_sql);
    $edit_row = mysql_fetch_array($edit_res);
    if ($remove == 1) {
        unlink($edit_row['banner_path']);
        $up_ban_sql = "update small_banner set banner='null' where banid=$id";
        $up_ban_res = mysql_query($up_ban_sql);
    }
    $edit_sql = "select * from small_banner where banid=$id";
    $edit_res = mysql_query($edit_sql);
    $edit_row = mysql_fetch_array($edit_res);
}
?>
<link rel=stylesheet type=text/css href=include/style.css>
<script language="javascript">
    function disp(val, bpath) {
        if (val == 1) {
            document.frmAdd.rdBtype[0].checked = true;
            opt.innerHTML = "Upload File</td><td><input type=file name=userfile> Please Select a Image for Uploading";
        }
        else if (val == 2) {
            document.frmAdd.rdBtype[1].checked = true;
            opt.innerHTML = "Please Enter the URL of the Banner&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=txtBurl size='60'  value='http://'>";
        }
        else if (val == 'default' || val == 'ad') {
            opt.innerHTML = "Upload File</td><td><input type=file name=userfile> Please Select a Image for Uploading";
        }
        else if (val == 'On' || val == 'Off') {
            document.frmAdd.rdBtype[1].checked = true;
            if (bpath)
                opt.innerHTML = "Please Enter the URL of the Banner&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=txtBurl class=text value='" + bpath + "' size='60'>";
            else
                opt.innerHTML = "Please Enter the URL of the Banner&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name=txtBurl  value='http://' size='60'>";
        }
    }
</script>
<style type="text/css">
    <!--
    .style1 {
        color: #666666;
        font-weight: bold;
    }
    -->
</style>
<body <?php if ($mode == 'add') { ?>onLoad="disp(1, '')"<?php } else if ($mode == 'edit') { ?>onLoad="disp('<?php = $edit_row['status'] ?>', '<?php = $edit_row['banner'] ?>')"<?php } ?>>
    <?php
    require 'include/top.php';
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
                //	$_FILES['userfile']['type']=='application/x-shockwave-flash';

                if ($_FILES['userfile']['type'] == 'image/pjpeg' || $_FILES['userfile']['type'] == 'image/jpg' || $_FILES['userfile']['type'] == 'image/gif' || $_FILES['userfile']['type'] == 'image/jpeg') {

                    $upbanner = $_FILES['userfile']['tmp_name'];
                    if ($upbanner)
                        list($width, $height, $type, $attr) = getimagesize($upbanner);

                    //echo "hh".$height;
                    //echo "ww".$width;
                    if (($height > 189) or ($width > 503)) {
                        $f = 1;
                        $msg = "Please Enter the Correct Banner Image Size(505x189)";
                    }

                    if ($f != 1) {
                        $upbannername = $_FILES['userfile']['name'];
                        $upbannername = str_replace($special_char, '', $upbannername);
                        $uploaddir = "../images/" . $upbannername;
                        move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir);
                        $burl = "images/" . $upbannername;
                        $status = 'default';
                    }

                    $surl = $_POST['txtSurl'];
                    if (($mode == 'add') and ($f != 1)) {
                        $ins_sql = "insert into small_banner(banner,url,status) values('$burl','$surl','enable')";
                        $ins_res = mysql_query($ins_sql);
                    } else if (($mode == 'edit') and ($f != 1)) {
                        $ins_sql = "update small_banner set banner='$burl',url='$surl',status='$status' where banid=$id";
                        $ins_res = mysql_query($ins_sql);
                    }
                    if ($ins_res)
                        echo '<meta http-equiv="refresh" content="0;url=small_banners.php?msg=a">';
                }
                else {
                    $msg = "Please Enter the a valid File Format";
                }
            }
        }
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
    <table border="0" align="center" cellpadding="5" cellspacing="2" width="90%" class="tablebox">
        <form name="frmAdd" action="<?php $_SERVER['PHP_SELF'] ?>" method="post"  enctype="multipart/form-data">
            <tr>
                <td bgcolor="#cccccc"  colspan="2"><b>Add Front Page(503X189) Banner</b></td>
            </tr>

            <?php
            if ((strlen($edit_row['banner']) != 0 && $edit_row['banner'] != 'null') && ($edit_row['status'] == 'default' || $edit_row['status'] == 'ad')) {
                ?>
                <tr bgcolor="#eeeee1">
                    <td colspan="2">
                        <img src="<?php = $edit_row['banner'] ?>"><br>
                        <div align="center"><a href="small_banners.php?mode=edit&id=<?php = $id ?>&remove=1" id="tablink" onClick="return condel()">Remove</a></div>
                        <div>To Change the Banner you need to remove the Banner and Upload a New Banner</div>
                        <?php
                    } else {
                        ?>
                <tr bgcolor="#eeeee1">
                    <td colspan="2"><font color="#FF0000">
                        <?php
                        if ($msg != '')
                            echo $msg;
                        ?></font>
                    </td>
                </tr>

                <tr bgcolor="#eeeee1">
                    <td colspan="2">Banner Image (Please Select Upload image to locate the Banner in your System)</td>
                </tr>

                <tr bgcolor=#eeeee1><td colspan="2">Upload File<input type=file name=userfile> Please Select a Image for Uploading</td></tr>
                <?php
            }
            ?>
            <tr bgcolor="#eeeee1"><td>Site Url</td><td><input type="text" name="txtSurl" value="<?php
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
    $del_sql = "delete from small_banner where banid=$id";
    $del_res = mysql_query($del_sql);
    echo '<meta http-equiv="refresh" content="2;url=small_banners.php?msg=d">';
} else {

    if ($type == 'e') {
        ?>
        <table border="0" align="center" cellpadding="5" cellspacing="2" width="80%" class="tablebox">
            <tr>
                <td align="center"><a href="small_banners.php?type=e&mode=s" id="tablink">Suspend</a></td>
                <td align="center"><a href="small_banners.php?type=e&mode=a" id="tablink">Activate</a></td>
            </tr>
        </table><br>
        <?php
    }
    if (isset($_POST['btn_Act'])) {
        if ($type == 'e') {
            $act = $_POST['chkAct'];
            foreach ($act as $id) {
                $up_sql = "update small_banner set status='on' where banid=$id";
                $up_res = mysql_query($up_sql);
            }
        } else if ($type == 'd') {
            $act = $_POST['rdAct'];
            $up_sql = "update small_banner set status='ad' where banid=$act";
            $up_res = mysql_query($up_sql);
            $up_sql1 = "update small_banner set status='default' where banid <> $act and status='ad'";
            $up_res1 = mysql_query($up_sql1);
        }
    } else if (isset($_POST['btn_Sus'])) {
        if ($type == 'e') {
            $act = $_POST['chkAct'];
            foreach ($act as $id) {
                $up_sql = "update small_banner set status='off' where banid=$id";
                $up_res = mysql_query($up_sql);
            }
        } else if ($type == 'd') {
            $act = $_POST['rdAct'];
            $up_sql = "update small_banner set status='off' where banid=$act";
            $up_res = mysql_query($up_sql);
        }
    }
    if ($type == 'e') {
        if (!$mode)
            $mode = 'a';
        if ($mode == 's')
            $ban_sql = "select * from small_banner where status <> 'enable'";
        else if ($mode == 'a')
            $ban_sql = "select * from small_banner where status <> 'enable' ";
    }
    else if ($type == 'd')
        $ban_sql = "select * from small_banner where status = 'enable' ";
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
            <tr><td colspan="6" bgcolor="#cccccc" class="txt_users">Front Page(503X189) Banner Details</td></tr>
            <tr bgcolor="#eeeee1">
                <td colspan="5" align="center">
                    <font color="#FF0000">
                    <?php
                    if ($_GET['msg'] != '') {
                        if ($_GET['msg'] == 'a')
                            echo "Banner Added Successfully";
                        if ($_GET['msg'] == 'd')
                            echo "Banner Deleted Successfully";
                    }
                    ?>
                    </font>
                </td></tr>
            <?php
            if (mysql_num_rows($ban_result) > 0) {
                ?>

                <tr bgcolor="#eeeee1">
                    <td colspan="2"><b>Path</b></td><td><b>Banner</b></td>
                    <td colspan="2"><b>Action</b></td>
                </tr>
                <?php
                $i = 1;
                while ($row = mysql_fetch_array($ban_result)) {
                    ?>
                    <tr bgcolor="#eeeee1">
                        <td colspan="2"><?php = $row['banner'] ?></td>
                        <td> <img src="../<?php = $row['banner'] ?>" width="300" height="200"> </td> 
                        <td colspan="2"><a href="small_banners.php?mode=del&id=<?php = $row['banid'] ?>" id="tablink" onClick="return condel()">Delete</a></td>
                    </tr>
                    <?php
                    $i+=1;
                }
                ?>
                <?php
            } else {
                ?>
                <tr bgcolor="#eeeee1">
                    <td align="center" colspan="6">No Banners Found</td>
                </tr>
                <?php
            }
            ?>
            <tr bgcolor="#eeeee1">
                <td colspan="6"><a href="small_banners.php?mode=add&type=<?php = $type ?>" id="tablink">Add New</a></td>
            </tr>
        </form>
    </table></td></tr></table></td></tr></table>
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

    function val()
    {
        if (frmAdd.userfile.value == "")
        {
            alert("Please Insert the Image");
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
</script>