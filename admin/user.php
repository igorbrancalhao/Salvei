<?php
error_reporting(0);
session_start();
require 'include/connect.php';

$s = mysql_query("delete from user_registration where user_name='' and password=''");


$mode = $_REQUEST['mode'];
$userid = $_GET['id'];
$type = $_GET['type'];
if (!$type)
    $type = 'gen';
if ($mode == 'vrfy') {
    $vres = mysql_query("update user_registration set verified='yes'  where user_id=$userid");
    ?>
    <meta http-equiv="refresh" content="0;url=user.php?mode=actv" />
    <?php
    $message = "Verified successfully";
}
if ($mode == 'suspend') {

    if ($userid) {
        $sresult = mysql_query("update user_registration set status='suspended' where user_id=$userid");



        $susitem = mysql_query("update placing_item_bid set status='suspended' where user_id=$userid and status='Active'");

        $mailTo_qry = mysql_query("select * from user_registration where user_id=$userid");
        $mailTo_res = mysql_fetch_array($mailTo_qry);
        $mailTo = $mailTo_res['email'];


        $sitename_qry = mysql_query("select * from admin_settings where set_id='1'");
        $sitename_res = mysql_fetch_array($sitename_qry);
        $sitename = $sitename_res['set_value'];

        $mailfrom_qry = mysql_query("select * from admin_settings where set_id='3'");
        $mailfrom_res = mysql_fetch_array($mailfrom_qry);
        $mailfrom = $mailfrom_res['set_value'];
        $mailSubject = "Account Suspended";
        $mailbody = "Your account has been suspended from " . $sitename;


        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        $headers .= "From: " . $mailfrom . "\n";

        $mail = mail($mailTo, $mailSubject, $mailbody, $headers);

        $message = "Suspended successfully";
    }
} else if ($mode == 'delete') {

    $item_id = "";
    $sql = mysql_query("select * from placing_item_bid where user_id=$userid");
    while ($row = mysql_fetch_array($sql)) {
        $item_id = $item_id . $row['item_id'] . ",";
    }

    $l = substr($item_id, 0, -1);

    $sql = "delete from featured_items where item_id in (" . $l . ")";
    $sqlqry = mysql_query($sql);

    $sql = "delete from auction_fees where item_id in (" . $l . ")";
    $sqlqry = mysql_query($sql);

    $dresult = mysql_query("delete from user_registration where user_id=$userid");

    $sql = "delete from placing_item_bid where user_id=$userid";
    $sqlqry = mysql_query($sql);

    $sql = "delete from placing_bid_item where user_id=$userid";
    $sqlqry = mysql_query($sql);

    $sql = "delete from disputeconsole where dispute_to=$userid";
    $sqlqry = mysql_query($sql);

    $sql = "delete from disputeconsole where dispute_by=$userid";
    $sqlqry = mysql_query($sql);

    $sql = "delete from dispute_process where dispute_by=$userid";
    $sqlqry = mysql_query($sql);

    $sql = "delete from watch_list where user_id=$userid";
    $sqlqry = mysql_query($sql);

    $msg = "Deleted successfully";
    $mode = '';
} else if ($mode == 'dupi') {
    $sresult = mysql_query("update user_registration set status='Active' where user_id=$userid");
    $message = "Activated successfully";
} else if ($mode == 'unpaid') {
    $sresult = mysql_query("update user_registration set member_account='$user_row[original_account]' , paid='no' where user_id=$userid");
    $message = "Updated Successfully";
    $mode = '';
    $userid = $_GET['id'];
} else if ($mode == 'paid') {
    $sresult = mysql_query("update user_registration set member_account='$user_row[original_account]' , paid='yes' where user_id=$userid");
    $message = "Updated Successfully";
    $mode = '';
} else if ($mode == 'trusted') {
    $userid = $_GET['id'];
    $sresult = mysql_query("update user_registration set trusted='inactive' where user_id=$userid");
    $message = "Updated sucessfully";
} else if ($mode == 'actv') {
    $asql = "update user_registration set status='Active' where user_id=$userid";
    $aresult = mysql_query($asql);
    $susitem = mysql_query("update placing_item_bid set status='Active' where user_id=$userid and status='Suspended'");
    $message = "Activated successfully";
}




if (isset($_POST['delete'])) {
    $coid = $_POST['chkSub'];
    for ($i = 0; $i < count($coid); $i++) {
        $cnid = $coid[$i];

        $dsql = "delete from user_registration where user_id='$cnid'";
        $dresult = mysql_query($dsql);


        $sql = "delete from placing_item_bid where user_id='$cnid'";
        $sqlqry = mysql_query($sql);


        $sql = "delete from placing_bid_item where user_id='$cnid'";
        $sqlqry = mysql_query($sql);


        $sql = "delete from disputeconsole where dispute_to='$cnid'";
        $sqlqry = mysql_query($sql);

        $sql = "delete from disputeconsole where dispute_by='$cnid'";
        $sqlqry = mysql_query($sql);


        $sql = "delete from dispute_process where dispute_by='$cnid'";
        $sqlqry = mysql_query($sql);
        $msg = "Deletes Successfully";
    }
}
$cansave = $_POST['cansave'];
//exit();
if ($cansave == 1) {
    echo '<meta http-equiv="refresh" content="0; url=addnew.php">';
    exit();
}
require 'include/top.php';
?>

<table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="6"><table width="780" border="0" cellpadding="0" cellspacing="0" background="images/bg08.jpg">
                <tr>
                    <th scope="col">&nbsp;</th>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td width="18"><table width="18" height="547" border="0" cellpadding="0" cellspacing="0" background="images/bg10.jpg">
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table></td>
        <td width="93" bgcolor="#FFFFFF"><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
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
                    <td><a href="site.php?page=bid"><img src="images/index_02_03_03_04.jpg" width="93" height="73" alt="" border="0" title="Bid increment Settings"></a></td>
                </tr>
                <tr>
                    <td><a href="report.php?page=reven"><img src="images/index_02_03_03_05.jpg" width="93" height="71" alt="" border="0" title="DetailReport"></a></td>
                </tr>
                <tr>
                    <td><a href="store_manager.php"><img src="images/index_02_03_03_06.jpg" width="93" height="70" alt="" border="0" title="StoreManager"></a></td>
                </tr>
                <tr>
                    <td><a href="bulk_load.php"><img src="images/index_02_03_03_07.jpg" width="93" height="66" alt="" border="0" title="BulkLoader"></a></td>
                </tr>
                <tr bgcolor="#ffffff">
                    <td height="100">&nbsp;</td>
                </tr>
            </table></td>
        <td width="10" height="447" bgcolor="#FFFFFF">&nbsp;</td>
        <td width="634" bgcolor="#F1F1F1" style="border:1 solid #b2b6b6"><table width="632" height="441" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><table width="632" height="442" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
                            <tr>
                                <td width="632"><table id="Table_01" width="632" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="145"><img src="images/index_02_03_05_01_01.jpg" width="145" height="35" alt=""></td>
                                            <td width="487" height="35" background="images/bg11.jpg">&nbsp;</td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td><table width="632"  border="0" cellpadding="0" cellspacing="0" id="Table_01">
                                        <tr>
                                            <td rowspan="3" background="images/bg07.jpg">&nbsp;</td>
                                            <td height="13"><table width="597" border="0" cellpadding="0" cellspacing="0" bgcolor="#FDFDFD">
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table></td>
                                            <td rowspan="3" background="images/bg05.jpg" width="24"></td>
                                        </tr>
                                        <tr>
                                            <td width="597"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="border2" >
                                                    <form name="frmsearch" method="post" action="user.php">
                                                        <tr>
                                                            <td><table id="Table_01" width="595"  border="0" cellpadding="0" cellspacing="0">

                                                                    <tr>
                                                                        <td><img src="images/index_02_03_05_02_04_01.jpg" width="84" height="23" alt=""></td>
                                                                        <td width="513" height="23" background="images/bg12.jpg">&nbsp;</td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                        <tr>
                                                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                                    <tr>
                                                                        <td width="13%" height="27" bgcolor="#eeeee1" class="txt_sitedetails" style="padding-top:10px; padding-left:10px">&nbsp;</td>
                                                                        <td width="13%" bgcolor="#eeeee1" class="txt_sitedetails" style="padding-top:10px; padding-left:10px"><span class="txt_sitedetails" style="padding-top:10px; padding-left:10px">Username : </span></td>
                                                                        <td width="20%" bgcolor="#eeeee1" style="padding-top:5px"><input name="txtSname" type="text" size="10"></td>
                                                                        <td width="13%" bgcolor="#eeeee1" class="txt_sitedetails" style="padding-top:10px; padding-left:10px">&nbsp;</td>
                                                                        <td width="18%" bgcolor="#eeeee1" class="txt_sitedetails" style="padding-top:10px; padding-left:10px"><span class="txt_sitedetails" style="padding-top:10px; padding-left:10px">Member E_Mail<span class="txt_sitedetails" style="padding-top:10px; padding-left:10px">:</span> </span></td>
                                                                        <td width="23%" bgcolor="#eeeee1" style="padding-top:5px"><input name="txtSmail" type="text" size="10"></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                        <tr>
                                                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td width="19%" bgcolor="#eeeee1" class="txt_sitedetails" style="padding-top:20px; padding-left:10px">Date_of_join After : </td>
                                                                        <td width="10%" bgcolor="#eeeee1" style="padding-top:10px">



                                                                            <select name="cboAday" class="cbo">
                                                                                <option value="">Day</option>
                                                                                <?php
                                                                                for ($i = 1; $i <= 31; $i++) {
                                                                                    ?>
                                                                                    <option value="<?php = $i; ?>"><?php = $i; ?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </td>
                                                                        <td width="10%" bgcolor="#eeeee1" style="padding-top:10px">
                                                                            <select name="cboAmonth" class="cbo">
                                                                                <option value="">Month</option>
                                                                                <?php
                                                                                $montharr = "dumm,Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec";
                                                                                $month = explode(',', $montharr);
                                                                                for ($i = 1; $i <= 12; $i++) {
                                                                                    echo "<option value=$i>$month[$i]</option>";
                                                                                }
                                                                                ?>
                                                                            </select></td>
                                                                        <td width="9%" bgcolor="#eeeee1" style="padding-top:10px"><select name="cboAyear" class="cbo">
                                                                                <option value="">Year</option>
                                                                                <?php
                                                                                for ($i = 2004; $i <= 2020; $i++) {
                                                                                    ?>
                                                                                    <option value="<?php = $i; ?>"><?php = $i; ?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select></td>
                                                                        <td width="22%" bgcolor="#eeeee1" class="txt_sitedetails" style="padding-top:20px; padding-left:10px">Date_of_join Before : </td>
                                                                        <td width="9%" bgcolor="#eeeee1" style="padding-top:10px"><select name="cboBday" class="cbo">
                                                                                <option value="">Day</option>
                                                                                <?php
                                                                                for ($i = 1; $i <= 31; $i++) {
                                                                                    ?>
                                                                                    <option value="<?php = $i; ?>"><?php = $i; ?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select></td>
                                                                        <td width="10%" bgcolor="#eeeee1" style="padding-top:10px"><select name="cboBmonth" class="cbo">
                                                                                <option value="">Month</option>
                                                                                <?php
                                                                                $montharr = "dumm,Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec";
                                                                                $month = explode(',', $montharr);
                                                                                for ($i = 1; $i <= 12; $i++) {
                                                                                    echo "<option value=$i>$month[$i]</option>";
                                                                                }
                                                                                ?>
                                                                            </select></td>
                                                                        <td width="11%" bgcolor="#eeeee1" style="padding-top:10px"><select name="cboByear" class="cbo">
                                                                                <option value="">Year</option>
                                                                                <?php
                                                                                for ($i = 2004; $i <= 2020; $i++) {
                                                                                    ?>
                                                                                    <option value="<?php = $i; ?>"><?php = $i; ?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#FFFFFF" style="padding-top:2px; padding-left:15px"><div align="center">
                                                                    <input type="hidden" name="sflag" value="0" />
                                                                    <input type="image" src="images/searchbutton.gif" width="70" height="20" border="0" name="search" value="Search" onclick="return validate();" ></div></td>
                                                        </tr>
                                                    </form>
                                                </table></td>
                                        </tr>
                                        <tr>
                                            <td><img src="images/index_02_03_05_02_06.jpg" width="597" height="3" alt=""></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="629"  border="0" align="center" cellpadding="0" cellspacing="0" background="images/bg03.jpg">
                                        <tr><td>&nbsp;</td></tr>
                                        <tr><td align="center" colspan="4">
                                                <?php
                                                if ($msg != '')
                                                    echo $msg;
                                                ?>
                                            </td></tr>
                                        <tr>
                                            <td class="txt_users"><div align="center"><a id="tablink" href="user.php?mode=actv">Active Users</a> </div></td>
                                            <td class="txt_users"><div align="center"><a id="tablink" href="user.php?mode=suspend">Suspended Users</a> </div></td>
                                            <td class="txt_newuser"><div align="center"><a id="tablink" href="user.php?mode=jointoday">New Users</a> </div></td>
                                            <td class="txt_users"><div align="center"><a id="tablink" href="user.php?mode=unver">Unverified Users</a></div></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td height="221">

                                    <?php
                                    if ($mode != 'view') {
                                        $date = date('Y-m-d');
                                        if ($_POST['sflag'] == 1) {
                                            $name = $_POST['txtSname'];
                                            $member_email = $_POST['txtSmail'];
                                            $array1 = array($_POST['cboAyear'], $_POST['cboAmonth'], $_POST['cboAday']);
                                            $array2 = array($_POST['cboByear'], $_POST['cboBmonth'], $_POST['cboBday']);
                                            $adate = implode('-', $array1);
                                            $bdate = implode('-', $array2);
                                            $sql = "select * from user_registration where";
                                            if ($name != '')
                                                $sql.=" user_name='$name' and ";
                                            if ($member_email != '')
                                                $sql.=" email='$member_email' and ";
                                            if ($adate != '' && $adate != '--')
                                                $sql.="  date_of_registration >='$adate' and ";
                                            if ($bdate != '' && $bdate != '--')
                                                $sql.="  date_of_registration <='$bdate' and ";
                                            $sql = substr($sql, 0, -4);
                                        }
                                        else {
                                            if ($mode == '') {
//      $mode="actv";
                                                $sql = "select * from user_registration";
                                                $title = "All Users";
                                            } elseif ($mode == 'actv') {
                                                $sql = "select * from user_registration where status='Active' and verified='yes'";
                                                $title = "Active Users";
                                            } else if ($mode == 'suspend') {
                                                $sql = "select * from user_registration where status='suspended' and verified='yes'";
                                                $title = "Suspended Users";
                                            } else if ($mode == 'new') {
                                                $date1 = date('Y-m-d');
                                                $sql = "select * from user_registration where date_of_registration='$date1'";
                                                $title = "New Users";
                                            } else if ($mode == 'unver') {
                                                $sql = "select * from user_registration where verified='no'";
                                                $title = "Unverified Users";
                                            } else if ($mode == 'dup')
                                                $sql = "select * from user_registration where status='duplicate' and verified='yes'";
                                            else if ($mode == 'paid')
                                                $sql = "select * from user_registration where paid='Yes' and ( original_account=2 or original_account=3 )";
                                            else if ($mode == 'unpaid')
                                                $sql = "select * from user_registration where paid='No' and ( original_account=2 or original_account=3 )";
                                            else if ($mode == 'trusted')
                                                $sql = "select * from user_registration where trusted='trusted'";

                                            else if ($mode == 'jointoday') {
                                                $date1 = date('Y-m-d');
                                                $sql = "select * from user_registration where to_days(now())-to_days(date_format(date_of_registration,'%Y-%m-%d'))=0";
                                                $title = "Users joined today";
                                            } else {
                                                $sql = "select * from user_registration";
                                                //$mode='actv';
                                            }
                                        }
                                        $res = mysql_query($sql);
                                        if (mysql_num_rows($res) > 0) {
                                            ?> 
                                            <form name="frm1" method="post" action="addnew.php">
                                                <table id="Table_01" width="632" height="234" border="0" cellpadding="0" cellspacing="0" background="images/bg06.jpg" align="center" style="background-repeat:no-repeat" bgcolor="#F0F0F0">
                                                    <tr>
                                                        <td background="images/bg06.jpg" width="10">&nbsp;</td>
                                                        <td width="598" ><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="border2">
                                                                <tr bgcolor="#CCCCCC">
                                                                    <td align="center" colspan="7" valign="middle"><b>
                                                                            <?php
                                                                            echo $title;
                                                                            ?></b>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#CCCCCC" class="txt_sitedetails" style="text-align:center"><b>Username<b></td>
                                                                                <td bgcolor="#CCCCCC" class="txt_sitedetails" style="text-align:center"><b>E_Mail<b></td>
                                                                                            <td bgcolor="#CCCCCC" class="txt_sitedetails" style="text-align:center"><b>Country<b></td>
                                                                                                        <td bgcolor="#CCCCCC" class="txt_sitedetails" style="text-align:center"><b>Date of joining<b></td>

                                                                                                                    <td bgcolor="#CCCCCC" class="txt_sitedetails" style="text-align:center"><b>Edit<b></td>
                                                                                                                                <td bgcolor="#CCCCCC" class="txt_sitedetails" style="text-align:center"><b>Status<b></td>
                                                                                                                                            <td bgcolor="#CCCCCC" class="txt_sitedetails" style="text-align:center"><b>Delete<b></td>

                                                                                                                                                        </tr>

                                                                                                                                                        <?php
                                                                                                                                                        $total_records = mysql_num_rows($res);
                                                                                                                                                        $curpage = $_GET['curpage'];
                                                                                                                                                        if (strlen($_GET['curpage']) == 0)
                                                                                                                                                            $curpage = 1;

//	$page=mysql_query("select * from admin_settings where set_id=75");
//	$perpage=mysql_fetch_array($page);

                                                                                                                                                        $start = ($curpage - 1) * 10;

                                                                                                                                                        $end = 10;

                                                                                                                                                        if ($curpage == '' || $curpage == 1)
                                                                                                                                                            $i = 1;
                                                                                                                                                        else
                                                                                                                                                            $i = $_GET['sno'] + 1;
                                                                                                                                                        $sql.=" limit $start,$end";
                                                                                                                                                        $res = mysql_query($sql);
                                                                                                                                                        ?>
                                                                                                                                                        <tr> 
                                                                                                                                                            <td align="right" colspan="10"> 
                                                                                                                                                                <?php
                                                                                                                                                                if ($curpage != 1) {
                                                                                                                                                                    ?>
                                                                                                                                                                    <a href="user.php?mode=<?php = $mode; ?>&curpage=<?php = ($curpage - 1); ?>" id="link2">Prev</a> 
                                                                                                                                                                    | 
                                                                                                                                                                    <?php
                                                                                                                                                                }
                                                                                                                                                                ?>
                                                                                                                                                                <?php
                                                                                                                                                                if ($total_records > ($start + $end)) {
                                                                                                                                                                    ?>
                                                                                                                                                                    <a href="user.php?mode=<?php = $mode; ?>&curpage=<?php = ($curpage + 1); ?>" id="link2">Next</a> 
                                                                                                                                                                    <?php
                                                                                                                                                                }
                                                                                                                                                                ?>
                                                                                                                                                            </td>
                                                                                                                                                        </tr>

                                                                                                                                                        <?php
                                                                                                                                                        while ($row = mysql_fetch_array($res)) {
                                                                                                                                                            ?>
                                                                                                                                                            <tr><td class="txt_sitedetails" bgcolor="#eeeee1" title="Userid:<?php = $row['user_id']; ?>">
                                                                                                                                                                    <a href="userdetails.php?type=gen&id=<?php = $row['user_id']; ?>" style="text-decoration:none" id="link1" class="txt_details1">
                                                                                                                                                                        <?php = $row['user_name']; ?></a></td>
                                                                                                                                                                <td class="txt_sitedetails" bgcolor="#eeeee1">
                                                                                                                                                                    <?php = $row['email']; ?>
                                                                                                                                                                </td>
                                                                                                                                                                <td class="txt_sitedetails" bgcolor="#eeeee1">
                                                                                                                                                                    <?php
                                                                                                                                                                    $cntry = $row['country'];
                                                                                                                                                                    $cres = mysql_query("select * from country_master where country_id=$cntry");
                                                                                                                                                                    $crow = mysql_fetch_array($cres);
                                                                                                                                                                    echo $crow['country'];
                                                                                                                                                                    ?></td>
                                                                                                                                                                <td class="txt_sitedetails" bgcolor="#eeeee1"><?php = $row['date_of_registration']; ?></td>

                                                                                                                                                                <td class="txt_sitedetails" bgcolor="#eeeee1"><div align="center" class="style3">
                                                                                                                                                                        <a href="adduser.php?id=<?php = $row['user_id']; ?>&mode=edit" style="text-decoration:none" id="link1" class="txt_details1">Edit</a></div></td>
                                                                                                                                                                <?php
                                                                                                                                                                if ($mode == '') {
                                                                                                                                                                    ?>
                                                                                                                                                                    <td class="txt_sitedetails" bgcolor="#eeeee1"><div align="center" class="style3">

                                                                                                                                                                            <?php if (($row['status'] == 'Active') and ($row['verified'] == 'yes')) { ?>
                                                                                                                                                                                <a href="user.php?id=<?php = $row['user_id']; ?>&mode=suspend" style="text-decoration:none"  id="link1" class="txt_details1">Suspend</a>
                                                                                                                                                                            <?php } else if ($row['status'] == 'suspended') { ?><a href="user.php?id=<?php = $row['user_id']; ?>&mode=actv" style="text-decoration:none" id="link1">Activate</a>
                                                                                                                                                                                <?php
                                                                                                                                                                            }
                                                                                                                                                                            //else if($row['status']=='duplicate') {
                                                                                                                                                                            ?>
                                                                                                                                                        <!--	<a href="user.php?id=<?php //=$row['user_id'];     ?>&mode=dup" style="text-decoration:none"  id="link1">Activate</a>-->
                                                                                                                                                                            <?php
//		}
                                                                                                                                                                            if (($row['verified'] == 'no')) {
                                                                                                                                                                                ?>
                                                                                                                                                                                <a href="user.php?id=<?php = $row['user_id']; ?>&mode=vrfy" style="text-decoration:none"  id="link1">Verify</a>
                                                                                                                                                                                <?php
                                                                                                                                                                            } //else if($mode=='new' || $mode=='' || $mode=='jointoday') 
//		{
                                                                                                                                                                            ?>
                                                                                                                                                <!--		<a href="user.php?id=<?php //=$row['user_id'];    ?>&mode=active" style="text-decoration:none" id="link1">Activate</a>-->
                                                                                                                                                                            <?php
                                                                                                                                                                            //	} 
                                                                                                                                                                            ?>
                                                                                                                                                                        </div></td> 
                                                                                                                                                                    <?php
                                                                                                                                                                }
                                                                                                                                                                if ($mode != '') {
                                                                                                                                                                    ?>
                                                                                                                                                                    <td class="txt_sitedetails" bgcolor="#eeeee1"><div align="center" class="style3">

                                                                                                                                                                            <?php if ($mode == 'actv') { ?>
                                                                                                                                                                                <a href="user.php?id=<?php = $row['user_id']; ?>&mode=suspend" style="text-decoration:none"  id="link1" class="txt_details1">Suspend</a>
                                                                                                                                                                            <?php } else if ($mode == 'suspend') { ?><a href="user.php?id=<?php = $row['user_id']; ?>&mode=actv" style="text-decoration:none" id="link1">Activate</a>
                                                                                                                                                                                <?php
                                                                                                                                                                            } else if ($mode == 'dup') {
                                                                                                                                                                                ?>
                                                                                                                                                                                <a href="user.php?id=<?php = $row['user_id']; ?>&mode=dup" style="text-decoration:none"  id="link1">Activate</a>
                                                                                                                                                                                <?php
                                                                                                                                                                            }
                                                                                                                                                                            if ($mode == 'unver') {
                                                                                                                                                                                ?>
                                                                                                                                                                                <a href="user.php?id=<?php = $row['user_id']; ?>&mode=vrfy" style="text-decoration:none"  id="link1">Verify</a>
                                                                                                                                                                                <?php
                                                                                                                                                                            } else if ($mode == 'new' || $mode == '' || $mode == 'jointoday') {
                                                                                                                                                                                ?>

                                                                                                                                                                                <?php if (($row['status'] == 'Active') and ($row['verified'] == 'yes')) { ?>
                                                                                                                                                                                    <a href="user.php?id=<?php = $row['user_id']; ?>&mode=suspend" style="text-decoration:none"  id="link1" class="txt_details1">Suspend</a>
                                                                                                                                                                                <?php } else if ($row['status'] == 'suspended') { ?><a href="user.php?id=<?php = $row['user_id']; ?>&mode=actv" style="text-decoration:none" id="link1">Activate</a>
                                                                                                                                                                                    <?php
                                                                                                                                                                                }
                                                                                                                                                                                //else if($row['status']=='duplicate') {
                                                                                                                                                                                ?>
                                                                                                                                                            <!--	<a href="user.php?id=<?php //=$row['user_id'];    ?>&mode=dup" style="text-decoration:none"  id="link1">Activate</a>-->
                                                                                                                                                                                <?php
//		}
                                                                                                                                                                                if (($row['verified'] == 'no')) {
                                                                                                                                                                                    ?>
                                                                                                                                                                                    <a href="user.php?id=<?php = $row['user_id']; ?>&mode=vrfy" style="text-decoration:none"  id="link1">Verify</a>
                                                                                                                                                                                    <?php
                                                                                                                                                                                } //else if($mode=='new' || $mode=='' || $mode=='jointoday') 
//		{
                                                                                                                                                                                ?>
                                                                                                                                                    <!--		<a href="user.php?id=<?php //=$row['user_id'];    ?>&mode=active" style="text-decoration:none" id="link1">Activate</a>-->
                                                                                                                                                                                <?php
                                                                                                                                                                                //	} 
                                                                                                                                                                                ?>
                                                                                                                                                                                <?php
                                                                                                                                                                            } else if ($mode == 'paid') {
                                                                                                                                                                                ?>
                                                                                                                                                                                <a href="user.php?id=<?php = $row['user_id']; ?>&mode=unpaid" style="text-decoration:none" id="link1">Unpaid</a>
                                                                                                                                                                                <?php
                                                                                                                                                                            } else if ($mode == 'unpaid') {
                                                                                                                                                                                ?>
                                                                                                                                                                                <a href="user.php?id=<?php = $row['user_id']; ?>&mode=paid" style="text-decoration:none" id="link1">Paid</a>
                                                                                                                                                                                <?php
                                                                                                                                                                            } else if ($mode == 'trusted') {
                                                                                                                                                                                ?>
                                                                                                                                                                                <a href="user.php?id=<?php = $row['user_id']; ?>&mode=trusted" style="text-decoration:none" id="link1">Untrusted</a>
                                                                                                                                                                                <?php
                                                                                                                                                                            }
                                                                                                                                                                            ?>
                                                                                                                                                                        </div></td> 
                                                                                                                                                                    <?php
                                                                                                                                                                }
                                                                                                                                                                ?>
                                                                                                                                                                <td class="txt_sitedetails" bgcolor="#eeeee1"><div align="center" class="style3"><a href="user.php?id=<?php = $row['user_id']; ?>&mode=delete"  id="link1" style="text-decoration:none" onClick="javascript:return condelete();" class="txt_details1">Delete</a></div></td>

                                                                                                                                                            </tr>
                                                                                                                                                            <?php
                                                                                                                                                        }
                                                                                                                                                        ?>  					    
                                                                                                                                                        <tr style="height:30">
                                                                                                                                                            <td height="26" colspan="7" bgcolor="#FFFFFF" style="text-align:center">
                                                                                                                                                                <input type="image" src="images/addnewbutton.gif" width="76" height="22" border="0">
                                                                                                                                                                <?php
                                                                                                                                                            } else
                                                                                                                                                                echo "<table border=0 align=center width=100%><tr><td valign=top align=center colspan=7 class=site_users><b>No Users Found</b></td></tr></table>";
                                                                                                                                                            ?>
                                                                                                                                                            <input type="hidden" name="cansave" value="0">
                                                                                                                                                            <input type="hidden" name="canDel" value="0">
                                                                                                                                                        </td>
                                                                                                                                                    </tr></form>
                                                                                                                                                    </table></td>
                                                                                                                                                    <td background="images/bg04.jpg" width="22"></td>
                                                                                                                                                    </tr>
                                                                                                                                                    </table>
                                                                                                                                                    <?php
                                                                                                                                                }
                                                                                                                                                else {
                                                                                                                                                    ?>
                                                                                                                                                    <table id="Table_01" width="632" height="226" border="0" cellpadding="0" cellspacing="0">
                                                                                                                                                        <tr><td colspan="7"  >
                                                                                                                                                                <div align="center" style="font-family: Arial Helvetica; font-weight:bold">No Users Found</div>
                                                                                                                                                            </td></tr>
                                                                                                                                                    </table>
                                                                                                                                                    <?php
//}
                                                                                                                                                }
                                                                                                                                                ?>





                                                                                                                                                </td>
                                                                                                                                                </tr>
                                                                                                                                                </table></td>
                                                                                                                                                </tr>
                                                                                                                                                </table></td>
                                                                                                                                                <td width="13" bgcolor="#FFFFFF" >&nbsp;</td>
                                                                                                                                                <td width="12" bgcolor="#CECFC9" >&nbsp;</td>
                                                                                                                                                </tr>
                                                                                                                                                <tr>
                                                                                                                                                    <td colspan="6" height="9"><table width="780" border="0" cellpadding="0" cellspacing="0" background="images/bg08.jpg">
                                                                                                                                                            <tr>
                                                                                                                                                                <td>&nbsp;</td>
                                                                                                                                                            </tr>
                                                                                                                                                        </table></td>
                                                                                                                                                </tr>
                                                                                                                                                </table></td>
                                                                                                                                                </tr>

                                                                                                                                                </table></td>
                                                                                                                                                </tr>
                                                                                                                                                <tr>
                                                                                                                                                    <td><?php require'include/footer.php'; ?></td>
                                                                                                                                                </tr>
                                                                                                                                                </table>
                                                                                                                                                <!-- End ImageReady Slices -->
                                                                                                                                                </div>
                                                                                                                                                </body>
                                                                                                                                                </html>
                                                                                                                                                <script language="JavaScript">
                                                                                                                                                    function validate()
                                                                                                                                                    {
                                                                                                                                                        if (document.frmsearch.cboAday.value != "")
                                                                                                                                                        {
                                                                                                                                                            if (document.frmsearch.cboAmonth.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Starting Month");
                                                                                                                                                                document.frmsearch.cboAmonth.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                            if (document.frmsearch.cboAyear.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Starting Year");
                                                                                                                                                                document.frmsearch.cboAyear.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                        if (document.frmsearch.cboAmonth.value != "")
                                                                                                                                                        {
                                                                                                                                                            if (document.frmsearch.cboAday.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Starting  Day");
                                                                                                                                                                document.frmsearch.cboAday.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                            if (document.frmsearch.cboAyear.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Starting Year");
                                                                                                                                                                document.frmsearch.cboAyear.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                        if (document.frmsearch.cboAyear.value != "")
                                                                                                                                                        {
                                                                                                                                                            if (document.frmsearch.cboAmonth.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Starting Month");
                                                                                                                                                                document.frmsearch.cboAmonth.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                            if (document.frmsearch.cboAday.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Starting Day");
                                                                                                                                                                document.frmsearch.cboAday.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                        }

                                                                                                                                                        if (document.frmsearch.cboAday.value != "" && document.frmsearch.cboAmonth.value != 0 && document.frmsearch.cboAyear.value != "")
                                                                                                                                                        {
                                                                                                                                                            var d = document.frmsearch.cboAday.value;
                                                                                                                                                            var m = document.frmsearch.cboAmonth.value;
                                                                                                                                                            var y = document.frmsearch.cboAyear.value;
                                                                                                                                                            var dayobj = new Date(y, m - 1, d)
                                                                                                                                                            if ((dayobj.getMonth() + 1 != m) || (dayobj.getDate() != d) || (dayobj.getFullYear() != y))
                                                                                                                                                            {
                                                                                                                                                                alert("Invalid Date Entry Detected in Date Of Joining After");
                                                                                                                                                                //	alert("Invalid Starting Day, Month, or Year range detected. Please correct and submit again.")
                                                                                                                                                                document.frmsearch.cboAday.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                        }


                                                                                                                                                        if (document.frmsearch.cboBday.value != "")
                                                                                                                                                        {
                                                                                                                                                            if (document.frmsearch.cboBmonth.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Ending Month");
                                                                                                                                                                document.frmsearch.cboBmonth.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                            if (document.frmsearch.cboByear.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Ending Year");
                                                                                                                                                                document.frmsearch.cboByear.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                        if (document.frmsearch.cboBmonth.value != "")
                                                                                                                                                        {
                                                                                                                                                            if (document.frmsearch.cboBday.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Ending Day");
                                                                                                                                                                document.frmsearch.cboBday.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                            if (document.frmsearch.cboByear.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Ending Year");
                                                                                                                                                                document.frmsearch.cboByear.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                        if (document.frmsearch.cboByear.value != "")
                                                                                                                                                        {
                                                                                                                                                            if (document.frmsearch.cboBmonth.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Ending Month");
                                                                                                                                                                document.frmsearch.cboBmonth.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                            if (document.frmsearch.cboBday.value == "")
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select Ending Day");
                                                                                                                                                                document.frmsearch.cboBday.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                        }

                                                                                                                                                        if (document.frmsearch.cboBday.value != "" && document.frmsearch.cboBmonth.value != 0 && document.frmsearch.cboByear.value != "")
                                                                                                                                                        {
                                                                                                                                                            var d1 = document.frmsearch.cboBday.value;
                                                                                                                                                            var m1 = document.frmsearch.cboBmonth.value;
                                                                                                                                                            var y1 = document.frmsearch.cboByear.value;
                                                                                                                                                            var dayobj1 = new Date(y1, m1 - 1, d1)
                                                                                                                                                            var tdate1 = new Date();
                                                                                                                                                            if ((dayobj1.getMonth() + 1 != m1) || (dayobj1.getDate() != d1) || (dayobj1.getFullYear() != y1))
                                                                                                                                                            {
                                                                                                                                                                alert("Invalid Date Entry Detected in Date Of Joining Before");
                                                                                                                                                                //	alert("Invalid Ending Day, Month, or Year range detected. Please correct and submit again.")
                                                                                                                                                                document.frmsearch.cboBday.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }
                                                                                                                                                            var d1 = document.frmsearch.cboAday.value;
                                                                                                                                                            var m1 = document.frmsearch.cboAmonth.value;
                                                                                                                                                            var y1 = document.frmsearch.cboAyear.value;
                                                                                                                                                            var day1 = d1 + "-" + m1 + "-" + y1;
                                                                                                                                                            var d2 = document.frmsearch.cboBday.value;
                                                                                                                                                            var m2 = document.frmsearch.cboBmonth.value;
                                                                                                                                                            var y2 = document.frmsearch.cboByear.value;
                                                                                                                                                            var day2 = d2 + "-" + m2 + "-" + y2;

                                                                                                                                                            if (day1 >= day2)
                                                                                                                                                            {
                                                                                                                                                                alert("Please Select the Correct Date");
                                                                                                                                                                document.frmsearch.cboBday.value = "";
                                                                                                                                                                document.frmsearch.cboBmonth.value = "";
                                                                                                                                                                document.frmsearch.cboByear.value = "";
                                                                                                                                                                document.frmsearch.cboBday.focus();
                                                                                                                                                                return false;
                                                                                                                                                            }

                                                                                                                                                        }


                                                                                                                                                        document.frmsearch.sflag.value = 1;
                                                                                                                                                        return true;
                                                                                                                                                    }



                                                                                                                                                    function chkall() {
                                                                                                                                                        len = document.frm1.chkSub.length;
                                                                                                                                                        if (len > 1) {
                                                                                                                                                            for (i = 0; i < len; i++) {
                                                                                                                                                                if (document.frm1.chkMain.checked == true) {
                                                                                                                                                                    document.frm1.chkSub[i].checked = true;
                                                                                                                                                                }
                                                                                                                                                                else {
                                                                                                                                                                    document.frm1.chkSub[i].checked = false;
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                        else {
                                                                                                                                                            if (document.frm1.chkMain.checked == true) {
                                                                                                                                                                document.frm1.chkSub.checked = true;
                                                                                                                                                            }
                                                                                                                                                            else {
                                                                                                                                                                document.frm1.chkSub.checked = false;
                                                                                                                                                            }

                                                                                                                                                        }

                                                                                                                                                    }

                                                                                                                                                    function condelete()
                                                                                                                                                    {
                                                                                                                                                        var confrm;
                                                                                                                                                        confrm = window.confirm("Are You sure you want to delete this User");
                                                                                                                                                        document.frm1.canDel.value = 1;
                                                                                                                                                        return confrm;
                                                                                                                                                    }
                                                                                                                                                    function addnew()
                                                                                                                                                    {
                                                                                                                                                        document.frm1.cansave.value = 1;
                                                                                                                                                        document.frm1.submit();
                                                                                                                                                    }

                                                                                                                                                </script>