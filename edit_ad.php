<?php
/* * *************************************************************************
 * File Name				:edit_ad.php
 * File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
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

if (!isset($_SESSION['userid'])) {
    $link = "signin.php";
    $url = "myauction.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
    exit();
}

$title = "Edit Ad";
require 'include/top.php';
$item_id = $_REQUEST['itemid'];


$auction_query = "select * from admin_settings where set_id=42";
$table = mysql_query($auction_query);
$row = mysql_fetch_array($table);
$bid_permission = $row['set_value'];

$admin_start_sql = "select * from admin_settings where set_id=23";
$admin_start_res = mysql_query($admin_start_sql);
$admin_start_row = mysql_fetch_array($admin_start_res);

$admin_end_sql = "select * from admin_settings where set_id=24";
$admin_end_res = mysql_query($admin_end_sql);
$admin_end_row = mysql_fetch_array($admin_end_res);

//getting the default currency
$currency_sell = "select * from admin_settings where set_id=59";
$currency_res = mysql_query($currency_sell);
$currency_row = mysql_fetch_array($currency_res);
$cur_sell = $currency_row['set_value'];
//admin rates for listing

$sql = "select * from admin_rates";
$exe = mysql_query($sql);
$ret = mysql_fetch_array($exe);
$gret = $ret['gallery_price'];
$hret = $ret['homepage_price'];
$sret = $ret['subtitle_price'];
$bret = $ret['bold_price'];
$highret = $ret['highlight_price'];
$img_listing_fee = $ret['Image_listing_fee'];
$editad_sql = mysql_query("select * from placing_item_bid where item_id=$item_id");
$editad_fetch = mysql_fetch_array($editad_sql);
$item_title = $editad_fetch['item_title'];
$itemdescrip = $editad_fetch['detailed_descrip'];
$item_counter_style = $editad_fetch['item_counter_style'];
$start_delay = $editad_fetch['start_delay'];
$dur = $editad_fetch['duration'];
$img1 = $editad_fetch['picture1'];
$_SESSION[image1] = $img1;
$img2 = $editad_fetch['picture2'];
/* $_SESSION[image2]=$img2;
  $img3=$editad_fetch['picture3'];
  $_SESSION[image3]=$img3;
  $img4=$editad_fetch['picture4'];
  $_SESSION[image4]=$img4;
  $img5=$editad_fetch['picture5'];
  $_SESSION[image5]=$img5;
  $img6=$editad_fetch['picture6'];
  $_SESSION[image6]=$img6;
  $img7=$editad_fetch['picture7'];
  $_SESSION[image7]=$img7; */
$qty = $editad_fetch['Quantity'];
$videofileup = $editad_fetch['videofile'];
$videolinkup = $editad_fetch['videolink'];


$payment_gateway = $editad_fetch['payment_gateway'];





$fea_sql = mysql_query("select * from featured_items where item_id=$item_id");
$fea_fetch = mysql_fetch_array($fea_sql);
$Gallery = $fea_fetch['gallery_feature'];
$Home = $fea_fetch['home_feature'];
$Bold = $fea_fetch['bold'];
$Highlight = $fea_fetch['highlight'];

$flag = $_POST['flag'];
$ownhtml = $_POST['own_html_flag'];
if ($ownhtml) {
    $item_id = $_POST['itemid'];
    $sub_cat = $_POST['cbosubcat'];
    $item_title = $_POST['txttitle'];
}

if ($flag == 1) {
    $item_id = $_POST['itemid'];
    $sel_sql = "select * from error_message where err_id =23";
    $sel_tab = mysql_query($sel_sql);
    $sel_row = mysql_fetch_array($sel_tab);
    $itemdescrip = $_POST['htmlcontent'];


    $item_counter_style = $_POST['item_counter_style'];
    $start_delay = $_POST['cbo_start_delay'];
    $Gallery = $_POST['chkGallery'];
    $Border = $_POST['chkBorder'];
    $Highlight = $_POST['chkHighlight'];

    $sell_format = $_SESSION['sell_format'];
    $Bold = $_POST['chkBold'];
    $Subtitle = $_POST['chkSubtitle'];
    $Subtitle_name = $_POST['txtSubtitle'];
    $Home = $_POST['chkHome'];

    if ($_POST['chkGallery'] == 'Yes') {
        $gallery = $_POST['gallery'];
    }
    if ($_POST['chkHome'] == 'Yes') {
        $home_page = $_POST['home_page'];
    }
    if ($_POST[chkBold] == 'Yes') {
        $bold = $_POST['bold'];
    }
    if ($_POST['chkHighlight'] == 'Yes') {
        $highlight = $_POST['highlight'];
    }
    $item_title = $_POST['txttitle'];
    if (empty($item_title)) {
        $sel_sql = "select * from error_message where err_id =23";
        $sel_tab = mysql_query($sel_sql);
        $sel_row = mysql_fetch_array($sel_tab);
        $err_title = $sel_row['err_msg'];
        $err_flag = 1;
    }
//echo strlen($itemdes);
    $strdeslen = strlen($itemdescrip);
    if ($strdeslen == 0) {
        $sel_sql = "select * from error_message where err_id =23";
        $sel_tab = mysql_query($sel_sql);
        $sel_row = mysql_fetch_array($sel_tab);
        $err_des = $sel_row['err_msg'];
        $err_flag = 1;
    }



    $img1 = $_FILES['img1']['name'];
    /* $img2=$_FILES['img2']['name'];
      $img3=$_FILES['img3']['name']; */


    if (!empty($img1)) {
        $type1 = $_FILES['img1']['type'];
        if ($type1 == "image/pjpeg" || $type1 == "image/gif" || $type1 == "image/jpeg" || $type1 == "image/bmp") {
            srand();
            $rad1 = substr(md5(rand(0, 1000)), 0, 5);
            $img1 = urlencode($img1);
            $imgname1 = "$username" . "$rad1" . "$img1";
            $uploaddir = "images/$imgname1";
            move_uploaded_file($_FILES['img1']['tmp_name'], $uploaddir);
            chmod("$uploaddir", 0755);
            $_SESSION['img1'] = $_FILES['img1']['name'];
            $_SESSION['image1'] = $imgname1;
        } else {
            $select_sql = "select * from error_message where err_id =8";
            $select_tab = mysql_query($select_sql);
            $select_row = mysql_fetch_array($select_tab);
            $err_img1 = $select_row['err_msg'];
            $err_flag = 1;
        }
    } else {
        $img1 = $_SESSION[image1];
    }

    /* if(!empty($img2))
      {
      $type1=$_FILES['img2']['type'];

      if($type1=="image/pjpeg" || $type1=="image/gif" || $type1=="image/jpeg" || $type1=="image/bmp")
      {
      srand();
      $rad2=substr(md5(rand(0,1000)),0,5);
      $img2=urlencode($img2);
      $imgname2="$username"."$rad2"."$img2";
      $uploaddir="images/$imgname2";
      move_uploaded_file($_FILES['img2']['tmp_name'],$uploaddir);
      chmod ("$uploaddir",0755);
      $_SESSION[img2]=$_FILES['img2']['name'];
      $_SESSION[image2]=$imgname2;

      }
      else
      {
      $select_sql="select * from error_message where err_id =8";
      $select_tab=mysql_query($select_sql);
      $select_row=mysql_fetch_array($select_tab);
      $err_img2=$select_row['err_msg'];
      $err_flag=1;
      }
      }

      if(!empty($img3))
      {
      $type1=$_FILES['img3']['type'];

      if($type1=="image/pjpeg" || $type1=="image/gif" || $type1=="image/jpeg" || $type1=="image/bmp")
      {
      srand();
      $rad3=substr(md5(rand(0,1000)),0,5);
      $img3=urlencode($img3);
      $imgname3="$username"."$rad3"."$img3";
      $uploaddir="images/$imgname3";
      move_uploaded_file($_FILES['img3']['tmp_name'],$uploaddir);
      chmod ("$uploaddir",0755);
      $_SESSION[img3]=$_FILES['img3']['name'];
      $_SESSION[image3]=$imgname3;

      }
      else
      {
      $select_sql="select * from error_message where err_id =8";
      $select_tab=mysql_query($select_sql);
      $select_row=mysql_fetch_array($select_tab);
      $err_img3=$select_row['err_msg'];
      $err_flag=1;
      }
      } */

    $videolinkup = $_POST['videolink'];
    $videofileup = $_POST['videofile'];
    //$videofileup=htmlentities($videofileup);
    /* if(!empty($videofileup))
      $_SESSION['uploadflv']=$videofileup;
      if(!empty($videolinkup))
      $_SESSION['uploadvideolink']=$videolinkup; */

    $qty = $_POST['txt_qty'];

    if (empty($qty)) {
        $err_qty = "Enter a valid Information";
        $err_flag = 1;
    }
//echo $qty;
    if (!is_numeric($qty)) {
        $err_qty = "Enter a valid Information";
        $err_flag = 1;
    }





    if ($err_flag != 1) {
        $bid_starting_date = date("Y-m-d");
        if ($sell_format == 1) {
            $sell_method = "auction";
        } else if ($sell_format == 2) {
            $sell_method = "dutch_auction";
        } else if ($sell_format == 3) {
            $sell_method = "fix";
        } else if ($sell_format == 4) {
            $sell_method = "ads";
        }
        $img1 = $_SESSION[image1];
        /* $img2=$_SESSION[image2];
          $img3=$_SESSION[image3]; */

        if ($admin_start_row['set_value'] == 'no') {
            $start_date = "select * from admin_settings where set_id=25";
            $start_res = mysql_query($start_date);
            $start_row = mysql_fetch_array($start_res);
            $start_delay = $start_row[set_value];
        }
        if ($admin_end_row['set_value'] == 'no') {
            $end_date = "select * from admin_settings where set_id=26";
            $end_res = mysql_query($end_date);
            $end_row = mysql_fetch_array($end_res);
            $dur = $end_row[set_value];
        }

        if ($gallery)
            $gallery_price = $ret[gallery_price];
        if ($highlight)
            $highlight_price = $ret[highlight_price];
        if ($bold)
            $bold_price = $ret[bold_price];
        if ($home_page)
            $homepage_price = $ret[homepage_price];
        /* if($img2 or $img3 or $img4 or $img5 or $img6 or $img7)
          {

          $totalimgfee="";
          if($img2)
          {
          $totalimgfee=$totalimgfee+$img_listing_fee;
          }
          if($img3)
          {
          $totalimgfee=$totalimgfee+$img_listing_fee;
          }
          if($img4)
          {
          $totalimgfee=$totalimgfee+$img_listing_fee;
          }
          if($img5)
          {
          $totalimgfee=$totalimgfee+$img_listing_fee;
          }
          if($img6)
          {
          $totalimgfee=$totalimgfee+$img_listing_fee;
          }
          if($img7)
          {
          $totalimgfee=$totalimgfee+$img_listing_fee;
          }
          } */
        $fea_item_sql = mysql_query("select * from featured_items where item_id=$item_id");
        $fea_item_rows = mysql_num_rows($fea_item_sql);
        if ($fea_item_rows > 0) {
            $edit_fea_sql = "update featured_items set gallery_feature='$Gallery',home_feature='$Home',bold='$Bold',highlight='$Highlight' where item_id=$item_id";

            $edit_fea_qry = mysql_query($edit_fea_sql);
        } else {
            $insert_fea_item = "insert into featured_items (gallery_feature,home_feature,bold,highlight,item_id) values ('$Gallery','$Home','$Bold','$Highlight','$item_id')";

            mysql_query($insert_fea_item);
        }
        $auc_fee_sql = mysql_query("select * from auction_fees where item_id=$item_id");
        $auc_fee_rows = mysql_num_rows($auc_fee_sql);
        if ($auc_fee_rows > 0) {
            $paycheck_sql = mysql_query("select * from placing_item_bid where payment_status='paid' and item_id='$item_id'");
            $paycheck_qry = mysql_num_rows($paycheck_sql);
            if ($paycheck_qry > 0) {
                $del_fee = mysql_query("delete from auction_fees where item_id=$item_id");
                $fee_sql = "insert into auction_fees (gallery_fee,homepage_featureditem_fee,boldlisting_fee,highlighted_fee,Image_listing_fee,item_id) values('$gallery_price','$homepage_price','$bold_price','$highlight_price','$totalimgfee','$item_id')";
                $fee_qry = mysql_query($fee_sql);
            } else {
                $feature_sql = "update auction_fees set gallery_fee='$gallery_price',homepage_featureditem_fee='$homepage_price', boldlisting_fee='$bold_price',highlighted_fee='$highlight_price',addtional_pic_fee= '$totalimgfee' where item_id=$item_id";

                $feature_res = mysql_query($feature_sql);
            }
        } else {
            $fee_sql = "insert into auction_fees (gallery_fee,homepage_featureditem_fee,boldlisting_fee,highlighted_fee,listing_desinger_fee,addtional_pic_fee,reserve_price_fee,subtitlefee,item_id) values('$gallery_price','$homepage_price','$bold_price','$highlight_price','$listing_desinger_fee','$totalimgfee','$reserve_price','$subtitle_price','$item_id')";

            $fee_qry = mysql_query($fee_sql);
        }

        $edit_ad_sql = "update placing_item_bid set item_title='$item_title',Quantity='$qty',detailed_descrip='$itemdescrip',payment_gateway='$payment_gateway',picture1='$img1',picture2='$img2',picture3='$img3',picture4='$img4',picture5='$img5',picture6='$img6',picture7='$img7',videofile='$videofileup',videolink='$videolinkup' where item_id='$item_id'";
        $edit_ad_qry = mysql_query($edit_ad_sql);



        $_SESSION[payment_gateway] = "";
        $_SESSION[image1] = "";
        $_SESSION[image2] = "";
        $_SESSION[image3] = "";
        $_SESSION[image4] = "";
        $_SESSION[image5] = "";
        $_SESSION[image6] = "";
        $_SESSION[image7] = "";
        $_SESSION[description] = "";
        $_SESSION[img7] = "";
        $_SESSION[img6] = "";
        $_SESSION[img5] = "";
        $_SESSION[img4] = "";
        $_SESSION[img3] = "";
        $_SESSION[img2] = "";
        $_SESSION[img1] = "";

        echo '<meta http-equiv="refresh" content="0;url=myauction.php">';
        echo "You have been redirected.Please <a href=myauction.php>Click here.</a>";
        exit();
    }
}
require 'templates/edit_ad.tpl';
require 'include/footer.php';
?>
<script language="javascript">
    function ownhtml12()
    {
        document.form1.own_html_flag.value = "yes";
        document.form1.flag.value = 0;
        document.form1.submit();
    }
    function ownhtml13()
    {
        document.form1.own_html_flag.value = "editor";
        document.form1.flag.value = 0;
        document.form1.submit();
    }
</script>