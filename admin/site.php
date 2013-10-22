<?php
session_start();
/* * *************************************************************************
 * File Name				:site.php
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
require 'include/connect.php';
require 'include/top.php';
$special_char = array('*', '#', '@', '!', '%', '&', '|', '+', '-', '$', '^');
if (isset($_REQUEST['memberlevel_modify'])) {
    $total = $_REQUEST[total_records];
    for ($i = 1; $i <= $total; $i++) {
        $records_id = "records_id" . $i;
        $score = $_REQUEST["score" . $i];
        $scoreto = $_REQUEST["scoreto" . $i];
        $records_id = $_REQUEST[$records_id];

        $query = "update membership_level set feedback_score_from='$score' ,feedback_score_to='$scoreto'  where mid= $records_id";
        $upquery = mysql_query($query);
        $cat = $cat . " Score From " . $score . " Score To " . $scoreto . ",";
        $mem_mes = "Membership Level Updated Successfully";
    }
} elseif (isset($_REQUEST['memberlevel_delete'])) {
    $total = $_REQUEST[total_records];
    for ($i = 1; $i <= $total; $i++) {
        $records_id = "records_id" . $i;
        $records_id = $_REQUEST[$records_id];
        $memberlevel_del = $_REQUEST["memberlevel_del" . $i];
        if ($memberlevel_del == "0") {
            $sq = mysql_query("select * from membership_level where mid=$records_id");
            $sq1 = mysql_fetch_array($sq);
            $fr = $sq1['feedback_score_from'];
            $t = $sq1['feedback_score_to'];

            $del = "delete from membership_level where mid='$records_id'";
            $delsql = mysql_query($del);

            $cat = " Score From " . $fr . " Score To " . $t;

            $mem_mes = "Selected Membership Level Deleted Successfully";
        }
    }
} elseif (isset($_REQUEST['memberlevel_add'])) {
    $score = $_REQUEST['score'];
    $scoreto = $_REQUEST['scoreto'];
    $icon = $_FILES['imgicon']['name'];
    $icon = str_replace($special_char, '', $icon);
    $f = 0;
    $f1 = 0;

    $s = mysql_query("select max(feedback_score_to) as feedback_score_to from membership_level");
    $sq = mysql_fetch_array($s);
    if ($sq['feedback_score_to'] >= $scoreto) {
        $f = 1;
    }

    if ($f != 1) {
        if ($icon) {
            $uploaddir = "../images/$icon";
            if ($_FILES['imgicon']['type'] == 'image/pjpeg' || $_FILES['imgicon']['type'] == 'image/jpg' || $_FILES['imgicon']['type'] == 'image/gif' || $_FILES['imgicon']['type'] == 'image/jpeg') {
                $upbanner = $_FILES['imgicon']['tmp_name'];
                if ($upbanner)
                    list($width, $height, $type, $attr) = getimagesize($upbanner);

                if ($height > 25 or $width > 25) {
                    $f1 = 1;
                }
            }
            if ($f1 != 1) {
                move_uploaded_file($_FILES['imgicon']['tmp_name'], $uploaddir);

                $in = "insert into membership_level(feedback_score_from,icon,feedback_score_to) values($score,'$icon','$scoreto')";
                $insql = mysql_query($in);

                $cat = "Score From " . $score . " Score To " . $scoreto;


                $mem_mes = "Membership Level Added Successfully";
            } else {
                $mem_mes = "Please Insert the Image size range 25 X 25 ";
            }
        }
    } else {
        $mem_mes = "Membership Level Already Exist";
    }
} elseif (isset($_REQUEST['bid_delete'])) {
    $total = $_REQUEST[total_records];
    for ($i = 1; $i <= $total; $i++) {
        $records_id = "records_id" . $i;
        $records_id = $_REQUEST[$records_id];
        $bid_d = "bid_del" . $i;
        $bid_del = $_REQUEST[$bid_d];
        if ($bid_del == "0") {
            $sq = mysql_query("select * from bid_increment where bid_id='$records_id'");
            $sq1 = mysql_fetch_array($sq);
            $cat = "From " . $sq1['bid_from'] . " To " . $sq1['bid_to'] . " Increment " . $sq1['bid_inc'];

            $del = "delete from bid_increment where bid_id = '$records_id'";
            $delsql = mysql_query($del);


//	if($delsql) echo $records_id." ".$bid_del;
        }
    }
    $mes = "Bid Increment Settings Deleted Successfully";
} elseif (isset($_REQUEST['bid_add'])) {

    $bid_from = $_REQUEST['bids_from'];
    $bid_to = $_REQUEST['bids_to'];
    $bid_inc = $_REQUEST['bids_inc'];
    $f = 0;
    //Checking
    $s = mysql_query("select max(bid_to) as bid_to from bid_increment");
    $sq = mysql_fetch_array($s);
    if ($sq['bid_to'] >= $bid_from) {
        $f = 1;
    }

    if ($f != 1) {
        //ends here

        $in = "insert into bid_increment(bid_from,bid_to,bid_inc)values($bid_from,$bid_to,$bid_inc)";
        $insql = mysql_query($in);

        $cat = "From " . $bid_from . " To " . $bid_to . " and the Increment " . $bid_inc;
        $mes = "Bid Increment Setting Added Successfully";
    } else
        $mes = "Price Value Already Exist";
}
elseif (isset($_REQUEST['bid_modify'])) {
    $bidpermission = $_REQUEST['bidpermission'];
    $query = "update admin_settings set set_value= '$bidpermission'  where set_id=42 ";
    mysql_query($query);

    $total = $_REQUEST[total_records];
    for ($i = 1; $i <= $total; $i++) {
        $records_id = "records_id" . $i;
        $bid_from = $_REQUEST["bid_from" . $i];
        $bid_to = $_REQUEST["bid_to" . $i];
        $bid_inc = $_REQUEST["bid_inc" . $i];
        $records_id = $_REQUEST[$records_id];
        if ($bid_from and $bid_to and $bid_inc) {
            $query = "update bid_increment set bid_from='$bid_from',bid_to='$bid_to',bid_inc='$bid_inc' where bid_id= $records_id";
            $upquery = mysql_query($query);

            $cat = $cat . "From " . $bid_from . " To " . $bid_to . " and the Increment " . $bid_inc . ",";
        }
    }
    $mes = "Bid Increment Settings Updated Successfully";
} elseif (isset($_REQUEST['auction_modify'])) {
    $start_date = $_REQUEST['start_date'];
    $query = "update admin_settings set set_value= '$start_date'  where set_id=23 ";
    mysql_query($query);
    $end_date = $_REQUEST['end_date'];
    $query = "update admin_settings set set_value= '$end_date'  where set_id=24 ";
    mysql_query($query);
    $start_delay = $_REQUEST['start_delay'];
    $query = "update admin_settings set set_value= '$start_delay'  where set_id=25 ";
    mysql_query($query);
    $duration = $_REQUEST['duration'];
    $query = "update admin_settings set set_value= '$duration'  where set_id=26 ";
    mysql_query($query);
    $suc_mes = "Auction Setting Updated Successfully";
} elseif (isset($_REQUEST['btn_ask'])) {
    $ask = $_REQUEST['chkStyle'];
    $query = "update admin_settings set set_value= '$ask'  where set_id=45 ";
    mysql_query($query);
}
if (isset($_POST['submit'])) {
    $name = $_POST['txtName'];
    $catid = $_POST['txtId'];
    $logo = $_FILES['logo']['name'];
    $logo = str_replace($special_char, '', $logo);
    if ($logo) {
        $sql = "update admin_settings set set_value='$logo' where set_id='46'";
        $result = mysql_query($sql);
        $uploaddir = "../images/$logo";
        move_uploaded_file($_FILES['logo']['tmp_name'], $uploaddir);
    }

    $header = $_FILES['mailheader']['name'];
    $header = str_replace($special_char, '', $header);
    if ($header) {
        $sql = "update admin_settings set set_value='images/$header' where set_id='61'";
        $result = mysql_query($sql);
        $uploaddir = "../images/$header";
        move_uploaded_file($_FILES['mailheader']['tmp_name'], $uploaddir);
    }

    $footer = $_FILES['mailfooter']['name'];
    $footer = str_replace($special_char, '', $footer);
    if ($footer) {
        $sql = "update admin_settings set set_value='images/$footer' where set_id='62'";
        $result = mysql_query($sql);
        $uploaddir = "../images/$footer";
        move_uploaded_file($_FILES['mailfooter']['tmp_name'], $uploaddir);
    }

    for ($i = 0; $i < count($name); $i++) {


        $sql = "update admin_settings set set_value='$name[$i]' where set_id='$catid[$i]'";
        //echo "<br>";
        $result = mysql_query($sql);
        if ($result) {
            $message = "General Settings Edited Successfully";
        }
    }
}
$get_res = mysql_query("select * from admin_settings where set_id != 23 and set_id != 24 and set_id != 25 and set_id != 26 and set_id != 46 and set_id != 45 and set_id != 39 and set_id!=22 and set_id!=42 and set_id!=43 and set_id!=56 and set_id!=57 and set_id!=61 and set_id!=62 and set_id!=17 and set_id!=16 and set_id!=41 and set_id!=55");
$logo_res = mysql_query("select * from admin_settings where set_id = 46");
$logo_row = mysql_fetch_array($logo_res);
$logo_res1 = mysql_query("select * from admin_settings where set_id = 61");
$mailheader_row = mysql_fetch_array($logo_res1);
$logo_res2 = mysql_query("select * from admin_settings where set_id = 62");
$mailfooter_row = mysql_fetch_array($logo_res2);





$page = $_GET['page'];
if ($page == '')
    $page = 'gen';
if ($page == 'pay')
    include 'payment_manager.php';
else if ($page == 'site')
    include 'site_manager.php';
else if ($page == 'level')
    include 'level_manager.php';
else if ($page == 'style')
    include 'templates.php';
else if ($page == 'plan')
    include 'plan.php';
else if ($page == 'auction')
    include 'auction_setting.php';
else if ($page == 'bid')
    include 'bid_setting.php';
else if ($page == 'ask')
    include 'ask.php';
else if ($page == 'memberlevel')
    include 'membershiplevel.php';
else {
    ?>
    <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
        <tr><td>   
                <table>
                    <tr><td width="93"><table id="Table_01" width="93" border="0" cellpadding="0" cellspacing="0">
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
                            </table></td>
                        <td width=793> <form name="frm" method="post" enctype="multipart/form-data">
                                <table width="98%" class="border2" cellpadding="2">
                                    <tr bgcolor="#CCCCCC" class=txt_bold> 
                                        <td height="24" colspan="2">General Site Settings</td>
                                    </tr>
                                    <tr bgcolor="#eeeee1" class="txt_sitedetails"> 
                                        <td colspan="2" align="center"><font color="#FF0000">
                                            <?php
                                            if ($message != '')
                                                echo $message;
                                            ?></font>
                                        </td>
                                    </tr>
                                    <tr bgcolor="#eeeee1" class="txt_heading1"> 
                                        <td height="24" colspan="2">Change your Site Settings Here </td>
                                    </tr>
                                    <tr bgcolor="#eeeee1"> 
                                        <td class="txt_sitedetails">Current Logo </td>
                                        <td ><img src="../images/<?php = $logo_row[set_value]; ?>"  /></td>
                                    </tr>
                                    <tr bgcolor="#eeeee1" class="style1"> 
                                        <td>&nbsp;</td>
                                        <td height="24"  align="left"><input type="file" name="logo"/></td>
                                    </tr>
                                    <tr bgcolor="#eeeee1"> 
                                        <td class="txt_sitedetails">Image Mail Header </td>
                                        <td ><img src="../<?php = $mailheader_row[set_value]; ?>"  width="500px" height="20px"/></td>
                                    </tr>
                                    <tr bgcolor="#eeeee1" class="style1"> 
                                        <td>&nbsp;</td>
                                        <td height="24" align="left"><input type="file" name="mailheader"/></td>
                                    </tr>
                                    <tr bgcolor="#eeeee1"> 
                                        <td class="txt_sitedetails">Image Mail Footer </td>
                                        <td ><img src="../<?php = $mailfooter_row[set_value]; ?>" width="500px" height="20px"/></td>
                                    </tr>
                                    <tr bgcolor="#eeeee1" class="style1"> 
                                        <td>&nbsp;</td>
                                        <td height="24" align="left"><input type="file" name="mailfooter"/></td>
                                    </tr>


                                    <?php
                                    while ($get_row = mysql_fetch_array($get_res)) {
                                        if (($get_row['set_id'] == 16) or ($get_row['set_id'] == 17))
                                            $s = "YYYY-MM-DD";
                                        else if (($get_row['set_id'] == 21) or ($get_row['set_id'] == 37))
                                            $s = "Please enter whole numbers only.";
                                        else
                                            $s = "";
                                        ?>
                                        <tr bgcolor="eeeee1">
                                            <td width="51%" class="txt_sitedetails"><?php = $get_row['set_name']; ?></td>
                                            <td width="49%"><input type="text" name="txtName[]" class="text" value="<?php = $get_row['set_value']; ?>" style="width:180;height:20 ">
                                                <input type="hidden" name="txtId[]" value="<?php echo $get_row['set_id']; ?>"><?php = $s; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr bgcolor="eeeee1"> 
                                        <td align="center" colspan="2"><input type="hidden" name="cansave" value="0">
                                            <input type="submit" name="submit" value="Submit" class="button"></td>
                                    </tr>
                            </form>
                </table></td></tr></table>
    </td></tr></table>

    <?php
}
?>

<?php
require 'include/footer1.php';
?>