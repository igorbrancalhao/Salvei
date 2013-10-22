<?php

/* * *************************************************************************
 * File Name				:promotelistings.tpl
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
require 'include/connect.php';
if (!isset($_SESSION['userid'])) {
    $link = "signin.php";
    $url = "myauction.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    exit();
}

require 'include/top.php';
require 'upload_thumb.php';
$special_char = array('*', '#', '@', '!', '%', '&', '|', '+', '-', '$', '^');
if ($_GET['mode']) {
    $mode = $_GET['mode'];
} else {
    $mode = $_POST['mode'];
}
$item_id = $_REQUEST['item_id'];
$edit = "select * from placing_item_bid where item_id=$item_id";
$edit_res = mysql_query($edit);
$edit_row = mysql_fetch_array($edit_res);
$item_title = $edit_row['item_title'];
$content = $edit_row['detailed_descrip'];
$image1 = $edit_row['picture1'];
$image2 = $edit_row['picture2'];
$image3 = $edit_row['picture3'];
$image4 = $edit_row['picture4'];
$image5 = $edit_row['picture5'];
$image6 = $edit_row['picture6'];
$image7 = $edit_row['picture7'];
$payment = $edit_row['payment_name'];
$payment_id = $edit_row['payment_id'];
$shipping_amt = $edit_row['shipping_cost'];
$tax = $edit_row['tax'];
$refund_days = $edit_row['refund_days'];
$refund_method = $edit_row['refund_method'];
$returnpolicy_instructions = $edit_row['returnpolicy_instructions'];
$payment_instructions = $edit_row['payment_instructions'];
$flag = $_POST['flag'];
if ($flag == 1) {
    $item_id = $_POST['item_id'];
    $item_title = $_POST['txttitle'];
    $content = $_REQUEST['content'];

    $image1 = $_FILES['image1']['name'];
    $image1 = str_replace($special_char, '', $image1);
    if (!empty($image1)) {
        $imgtype = $_FILES['image1']['type'];
        if ($imgtype == 'image/jpeg' || $imgtype == 'image/gif' || $imgtype == 'image/pjpeg') {
            $tmpfile = $_FILES['image1']['tmp_name'];
            $rad1 = substr(md5(rand(0, 1000)), 0, 5);
            $img1 = urlencode($image1);
            $date_con = date("Y-m-d");
            $image1 = "$date_con" . "_" . "$rad1" . "_" . "$image1";
            unlink("images/" . $edit_row['picture1']);
            unlink("thumbnail/" . $edit_row['picture1']);
            move_uploaded_file($tmpfile, 'images/' . $image1);

            /* Uploading thumbnail images */

            list($filewidth, $fileheight) = getimagesize('images/' . $image1);
            $thumbpath = "thumbnail/" . $image1;
            $uploadres = reduce_image('images/' . $image1, 200, 200, $thumbpath);

            /* End of uploading thumbnail images */
        } else {
            $image1 = $edit_row['picture1'];
            $select_sql = "select * from error_message where err_id =8";
            $select_tab = mysql_query($select_sql);
            $select_row = mysql_fetch_array($select_tab);
            $err_img1 = $select_row['err_msg'];
            $err_flag = 1;
        }
    } else
        $image1 = $edit_row['picture1'];

    $image2 = $_FILES['image2']['name'];
    $image2 = str_replace($special_char, '', $image2);
    if (!empty($image2)) {
        $imgtype = $_FILES['image2']['type'];
        if ($imgtype == 'image/jpeg' || $imgtype == 'image/gif' || $imgtype == 'image/pjpeg') {
            $tmpfile = $_FILES['image2']['tmp_name'];
            $rad1 = substr(md5(rand(0, 1000)), 0, 5);
            $img1 = urlencode($image2);
            $date_con = date("Y-m-d");
            $image2 = "$date_con" . "_" . "$rad1" . "_" . "$image2";
            unlink("images/" . $edit_row['picture2']);
            unlink("thumbnail/" . $edit_row['picture2']);
            move_uploaded_file($tmpfile, 'images/' . $image2);

            /* Uploading thumbnail images */

            list($filewidth, $fileheight) = getimagesize('images/' . $image2);
            $thumbpath = "thumbnail/" . $image2;
            $uploadres = reduce_image('images/' . $image2, 200, 200, $thumbpath);

            /* End of uploading thumbnail images */
        } else {
            $image2 = $edit_row['picture2'];
            $select_sql = "select * from error_message where err_id =8";
            $select_tab = mysql_query($select_sql);
            $select_row = mysql_fetch_array($select_tab);
            $err_img2 = $select_row['err_msg'];
            $err_flag = 1;
        }
    } else
        $image2 = $edit_row['picture2'];

    $image3 = $_FILES['image3']['name'];
    $image3 = str_replace($special_char, '', $image3);
    if (!empty($image3)) {
        $imgtype = $_FILES['image3']['type'];
        if ($imgtype == 'image/jpeg' || $imgtype == 'image/gif' || $imgtype == 'image/pjpeg') {
            $tmpfile = $_FILES['image3']['tmp_name'];
            $rad1 = substr(md5(rand(0, 1000)), 0, 5);
            $img1 = urlencode($image3);
            $date_con = date("Y-m-d");
            $image3 = "$date_con" . "_" . "$rad1" . "_" . "$image3";
            unlink("images/" . $edit_row['picture3']);
            unlink("thumbnail/" . $edit_row['picture3']);
            move_uploaded_file($tmpfile, 'images/' . $image3);

            /* Uploading thumbnail images */

            list($filewidth, $fileheight) = getimagesize('images/' . $image3);
            $thumbpath = "thumbnail/" . $image3;
            $uploadres = reduce_image('images/' . $image3, 200, 200, $thumbpath);

            /* End of uploading thumbnail images */
        } else {
            $image3 = $edit_row['picture3'];
            $select_sql = "select * from error_message where err_id =8";
            $select_tab = mysql_query($select_sql);
            $select_row = mysql_fetch_array($select_tab);
            $err_img3 = $select_row['err_msg'];
            $err_flag = 1;
        }
    } else
        $image3 = $edit_row['picture3'];

    $image4 = $_FILES['image4']['name'];
    $image4 = str_replace($special_char, '', $image4);
    if (!empty($image4)) {
        $imgtype = $_FILES['image4']['type'];
        if ($imgtype == 'image/jpeg' || $imgtype == 'image/gif' || $imgtype == 'image/pjpeg') {
            $tmpfile = $_FILES['image4']['tmp_name'];
            $rad1 = substr(md5(rand(0, 1000)), 0, 5);
            $img1 = urlencode($image4);
            $date_con = date("Y-m-d");
            $image4 = "$date_con" . "_" . "$rad1" . "_" . "$image4";
            unlink("images/" . $edit_row['picture4']);
            unlink("thumbnail/" . $edit_row['picture4']);
            move_uploaded_file($tmpfile, 'images/' . $image4);

            /* Uploading thumbnail images */

            list($filewidth, $fileheight) = getimagesize('images/' . $image4);
            $thumbpath = "thumbnail/" . $image4;
            $uploadres = reduce_image('images/' . $image4, 200, 200, $thumbpath);

            /* End of uploading thumbnail images */
        } else {
            $image4 = $edit_row['picture4'];
            $select_sql = "select * from error_message where err_id =8";
            $select_tab = mysql_query($select_sql);
            $select_row = mysql_fetch_array($select_tab);
            $err_img4 = $select_row['err_msg'];
            $err_flag = 1;
        }
    } else
        $image4 = $edit_row['picture4'];

    $image5 = $_FILES['image5']['name'];
    $image5 = str_replace($special_char, '', $image5);
    if (!empty($image5)) {
        $imgtype = $_FILES['image5']['type'];
        if ($imgtype == 'image/jpeg' || $imgtype == 'image/gif' || $imgtype == 'image/pjpeg') {
            $tmpfile = $_FILES['image5']['tmp_name'];
            $rad1 = substr(md5(rand(0, 1000)), 0, 5);
            $img1 = urlencode($image5);
            $date_con = date("Y-m-d");
            $image5 = "$date_con" . "_" . "$rad1" . "_" . "$image5";
            unlink("images/" . $edit_row['picture5']);
            unlink("thumbnail/" . $edit_row['picture5']);
            move_uploaded_file($tmpfile, 'images/' . $image5);

            /* Uploading thumbnail images */

            list($filewidth, $fileheight) = getimagesize('images/' . $image5);
            $thumbpath = "thumbnail/" . $image5;
            $uploadres = reduce_image('images/' . $image5, 200, 200, $thumbpath);

            /* End of uploading thumbnail images */
        } else {
            $image5 = $edit_row['picture5'];
            $select_sql = "select * from error_message where err_id =8";
            $select_tab = mysql_query($select_sql);
            $select_row = mysql_fetch_array($select_tab);
            $err_img5 = $select_row['err_msg'];
            $err_flag = 1;
        }
    } else
        $image5 = $edit_row['picture5'];

    $image6 = $_FILES['image6']['name'];
    $image6 = str_replace($special_char, '', $image6);
    if (!empty($image6)) {
        $imgtype = $_FILES['image6']['type'];
        if ($imgtype == 'image/jpeg' || $imgtype == 'image/gif' || $imgtype == 'image/pjpeg') {
            $tmpfile = $_FILES['image6']['tmp_name'];
            $rad1 = substr(md5(rand(0, 1000)), 0, 5);
            $img1 = urlencode($image6);
            $date_con = date("Y-m-d");
            $image6 = "$date_con" . "_" . "$rad1" . "_" . "$image6";
            unlink("images/" . $edit_row['picture6']);
            unlink("thumbnail/" . $edit_row['picture6']);
            move_uploaded_file($tmpfile, 'images/' . $image6);

            /* Uploading thumbnail images */

            list($filewidth, $fileheight) = getimagesize('images/' . $image6);
            $thumbpath = "thumbnail/" . $image6;
            $uploadres = reduce_image('images/' . $image6, 200, 200, $thumbpath);

            /* End of uploading thumbnail images */
        } else {
            $image6 = $edit_row['picture6'];
            $select_sql = "select * from error_message where err_id =8";
            $select_tab = mysql_query($select_sql);
            $select_row = mysql_fetch_array($select_tab);
            $err_img6 = $select_row['err_msg'];
            $err_flag = 1;
        }
    } else
        $image6 = $edit_row['picture6'];


    $image7 = $_FILES['image7']['name'];
    $image7 = str_replace($special_char, '', $image7);
    if (!empty($image7)) {
        $imgtype = $_FILES['image7']['type'];
        if ($imgtype == 'image/jpeg' || $imgtype == 'image/gif' || $imgtype == 'image/pjpeg') {
            $tmpfile = $_FILES['image7']['tmp_name'];
            $rad1 = substr(md5(rand(0, 1000)), 0, 5);
            $img1 = urlencode($image7);
            $date_con = date("Y-m-d");
            $image7 = "$date_con" . "_" . "$rad1" . "_" . "$image7";
            unlink("images/" . $edit_row['picture7']);
            unlink("thumbnail/" . $edit_row['picture7']);
            move_uploaded_file($tmpfile, 'images/' . $image7);

            /* Uploading thumbnail images */

            list($filewidth, $fileheight) = getimagesize('images/' . $image7);
            $thumbpath = "thumbnail/" . $image7;
            $uploadres = reduce_image('images/' . $image7, 200, 200, $thumbpath);

            /* End of uploading thumbnail images */
        } else {
            $image7 = $edit_row['picture7'];
            $select_sql = "select * from error_message where err_id =8";
            $select_tab = mysql_query($select_sql);
            $select_row = mysql_fetch_array($select_tab);
            $err_img7 = $select_row['err_msg'];
            $err_flag = 1;
        }
    } else
        $image7 = $edit_row['picture7'];


    $payment = $_POST['payment'];
    $payment_id = $_POST['payid'];
    $shipping_amt = $_POST['txtship_amt'];
    $tax = $_POST['tax'];
    $returns_accepted = $_POST['chkreturns'];
    $refund_days = $_POST['cboreturndays'];
    $refund_method = $_POST['cborefund'];
    $returnpolicy_instructions = $_POST['txtploicy'];
    $payment_instructions = $_POST['txtpaymentins'];

    $sel_sql = "select err_msg from error_message where err_id =23";
    $sel_tab = mysql_query($sel_sql);
    $sel_row = mysql_fetch_array($sel_tab);
    if (empty($item_title)) {
        $err_title = $sel_row['err_msg'];
        $err_flag = 1;
    }
    if (empty($content)) {
        $err_des = $sel_row['err_msg'];
        $err_flag = 1;
    }
    if (empty($payment)) {
        $err_pay = $sel_row['err_msg'];
        $err_flag = 1;
    }
    if (empty($payment_id)) {
        $err_pay = $sel_row['err_msg'];
        $err_flag = 1;
    }
    if (!empty($returns_accepted)) {
        if (empty($refund_days)) {
            $err_ref = "Please enter the refund days";
            $err_flag = 1;
        }
        if (empty($refund_method)) {
            $err_method = "Please enter the refund method";
            $err_flag = 1;
        }
    }
    //shipping amount checking for special characters and to accept only numbers
    $validZipExpr = "^[0-9.]*$";
    if (!empty($shipping_amt)) {
        if (!eregi($validZipExpr, $shipping_amt)) {
            $err_ship = "Invalid shipping amount";
            $err_flag = 1;
        } else if ($shipping_amt == '0.00') {
            $err_ship = "Invalid shipping amount";
            $err_flag = 1;
        }
    }

//tax checking to accept only numbers and not special characters
    if (!empty($tax)) {
        if (!eregi($validZipExpr, $tax)) {
            $err_tax = "Invalid tax amount";
            $err_flag = 1;
        } else if ($tax == '0.00') {
            $err_tax = "Invalid tax amount";
            $err_flag = 1;
        }
    }


    if ($err_flag != 1) {
        $up_sql = "update placing_item_bid set item_title='$item_title',detailed_descrip='$content',payment_name='$payment',payment_id='$payment_id',shipping_cost='$shipping_amt',returns_accepted='$returns_accepted',refund_days='$refund_days',refund_method='$refund_method',returnpolicy_instructions='$returnpolicy_instructions',payment_instructions='$payment_instructions',picture1='$image1',picture2='$image2',picture3='$image3',picture4='$image4',picture5='$image5',picture6='$image6',picture7='$image7' where item_id=$item_id";

        $up_res = mysql_query($up_sql);
        if ($up_res)
            exit('<meta http-equiv="refresh" content="0;url=myauction.php">');
    }
}

require 'templates/edit_auction.tpl';
require 'include/footer.php';
?>