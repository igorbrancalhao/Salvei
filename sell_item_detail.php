<?php

/* * *************************************************************************
 * File Name			:sell_item_detail.php
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
/*
  file name:sell_item_detail.php;
  date	  :5.6.06
  Created by:priya
  Rights reserved by AJ Square inc
 */
session_start();
error_reporting(0);
require 'include/connect.php';

if (!isset($_SESSION['userid'])) {
    $link = "signin.php";
    $url = "sell.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
//echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
    exit();
}

$sql_user_status = "select status from user_registration where user_id=" . $_SESSION['userid'];
$sqlqry_user_status = mysql_query($sql_user_status);
$sqlfetch_user_status = mysql_fetch_array($sqlqry_user_status);
$userstatus = $sqlfetch_user_status[0];
if ($userstatus == 'suspended') {
    echo '<meta http-equiv="refresh" content="0;url=suspendmode.php">';
    exit();
}

if (empty($_SESSION['categoryid'])) {
    $link = "myauction.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '">';
//echo "You have been Re-Directed, if not please <a href=$link>Click here</a>";
    exit();
}

$default_currency = "select * from admin_settings where set_id=59";
$default_res = mysql_query($default_currency);
$default_row = mysql_fetch_array($default_res);
$default_cur = $default_row['set_value'];

$mode = $_REQUEST['mode'];
$sellitemid = $_REQUEST['sellitemid'];
$userid = $_SESSION['userid'];
if ($_GET[item_id]) {
    $_SESSION['item_id'] = $_GET['item_id'];
}
$item_id = $_SESSION['item_id'];
$category_id = $_SESSION['categoryid'];

/*  check the user choose custom field category or not .
  if the user select the custom field category then the custom fields file
  fetch from the cat_slave table.

 */

$cat_sql = "select * from cat_slave where category_id=$category_id";
if ($res = mysql_query($cat_sql)) {
    $row = mysql_fetch_array($res);
    $tablename = $row['tablename'];
    $file_path = $row['file_path'];
}


////  end of custom field ////////


$flag = $_POST['flag'];
$ownhtml = $_POST['own_html_flag'];
if ($ownhtml) {
    $item_id = $_POST['item_id'];
    /* $sub_cat=$_POST['cbosubcat']; */
    $item_title = $_POST['txttitle'];
    $subtitle = $_POST['txtsubtitle'];
    $itemcondition = $_POST['cboitemcondition'];
}
if ($mode == "change") {
    $item_title = $_SESSION['item_name'];
    $itemdes = $_SESSION['des'];
    $itemcondition = $_SESSION['itemcondition'];
    $sub_cat = $_SESSION['subcat'];
    $subtitle = $_SESSION['subtitle'];
}
if ($mode == "sellsimilar" and empty($flag)) {
    $sql = "select * from placing_item_bid where item_id=$sellitemid";
    $sqlqry = mysql_query($sql);
    $sqlfetch = mysql_fetch_array($sqlqry);
    $sellitem_id = $sqlfetch['item_id'];
    $item_title = $sqlfetch['item_title'];
    $subtitle = $sqlfetch['sub_title'];
    $itemcondition = $sqlfetch['item_specify'];
    $itemdes = $sqlfetch['detailed_descrip'];
    $sub_cat = $sqlfetch['category_id'];
    $_SESSION['categoryid'] = $sub_cat;
    $_SESSION['des'] = $itemdes;
    $sell_method = $sqlfetch['selling_method'];
    $_SESSION['sell_method'] = $sell_method;
    if ($_SESSION['sell_method'] == "auction")
        $_SESSION['sell_format'] = 1;
    if ($_SESSION['sell_method'] == "dutch_auction")
        $_SESSION['sell_format'] = 2;
    if ($_SESSION['sell_method'] == "fix")
        $_SESSION['sell_format'] = 3;
}




if ($flag == 1) {
    $sel_sql = "select * from error_message where err_id =23";
    $sel_tab = mysql_query($sel_sql);
    $sel_row = mysql_fetch_array($sel_tab);

    if ($tablename) { // this is for custom field category .fetch the fileds from the particular tablename
        $tab_sql = "select * from $tablename";
        $tab_res = mysql_query($tab_sql);
        $i = 2;
        while ($i < mysql_num_fields($tab_res)) {
            $tab_col = mysql_fetch_field($tab_res, $i);
            if (!$tab_col) {
                $sell_sql = "select * from error_message where err_id =28";
                $sell_tab = mysql_query($sell_sql);
                $sell_row = mysql_fetch_array($sell_tab);
                echo '<b>' . $sell_row['err_msg'] . '</b>\n';
            } else {
                $dummy = "$" . $tab_col->name;
                $dummy = $_POST[$tab_col->name];
                $_SESSION[$tab_col->name] = $_POST[$tab_col->name];
                if (empty($_SESSION[$tab_col->name])) {
                    $err_dummy = $sel_row['err_msg'];
                    $err_flag = 1;
                } else {
                    $var_type = $tab_col->type;
                    if ($var_type == "int" or $var_type == "tinyint") {
                        if (!is_numeric($_SESSION[$tab_col->name])) {
                            $err_flag = 1;
                        }
                    }
                }
            }
            $i++;
        } // while
    } // if($tablename)

    $mode = $_POST['mode'];
    $item_id = $_POST['item_id'];
    /* $sub_cat=$_POST['cbosubcat']; */
    $item_title = $_POST['txttitle'];
    $subtitle = $_POST['txtsubtitle'];
    $itemcondition = $_POST['cboitemcondition'];
    $itemdes = $_REQUEST['content'];
    $_SESSION['des'] = $itemdes;

    $se_sql = "select * from error_message where err_id =22";
    $se_tab = mysql_query($se_sql);
    $se_row = mysql_fetch_array($se_tab);

    if (empty($item_title)) {
        $err_title = $sel_row['err_msg'];
        $err_flag = 1;
    }
    if (empty($itemcondition)) {
        $err_specify = $sel_row['err_msg'];
        $err_flag = 1;
    }

    /* if($_SESSION['categoryid'])
      {
      $sub_sql="select * from category_master where category_head_id=".$_SESSION['categoryid']." order by category_name";
      $sub_res=mysql_query($sub_sql);
      $sub_tot=mysql_num_rows($sub_res);
      }

      if($sub_tot!=0)
      {


      if(empty($sub_cat))
      {
      $err_subtitle=$sel_row['err_msg'];
      $err_flag=1;
      }
      } */

    if (strlen($itemdes) == 0) {
        $err_des = $sel_row['err_msg'];
        $err_flag = 1;
    }



    if ($err_flag != 1) {
        if ($mode == "") {
            $_SESSION['item_name'] = $item_title;
            $_SESSION['des'] = $itemdes;
            $_SESSION['itemcondition'] = $itemcondition;
            $_SESSION['subtitle'] = $subtitle;
            /* $_SESSION['subcat']=$sub_cat; */
            echo '<meta http-equiv="refresh" content="0;url=promotelistings.php">';
            echo "You have been Re-Directed, if not Please <a href=promotelistings.php>Click here</a>";
            exit();
        }
        if ($mode == "sellsimilar") {
            //$_SESSION['categoryid']=$category_id;
            $_SESSION['item_name'] = $item_title;
            $_SESSION['des'] = $itemdes;
            $_SESSION['itemcondition'] = $itemcondition;
            $_SESSION['subtitle'] = $subtitle;
            /* $_SESSION['subcat']=$sub_cat; */
            echo '<meta http-equiv="refresh" content="0;url=promotelistings.php?item_id=' . $sellitemid . '&mode=' . sellsimilar . '">';
            echo "You have been Re-Directed, if not Please <a href=promotelistings.php?item_id=$sellitemid>Click here</a>";
            exit();
        }
        if ($mode == "change") {
            $_SESSION['item_name'] = $item_title;
            $_SESSION['itemcondition'] = $itemcondition;
            $_SESSION['subtitle'] = $subtitle;
            $_SESSION['des'] = $itemdes;
            /* $_SESSION['subcat']=$sub_cat; */
            echo '<meta http-equiv="refresh" content="0;url=preview.php">';
            echo "You have been Re-Directed, if not Please <a href=preview.php>Click here</a>";
            exit();
        }
    }
}
$fee_sql = "select * from admin_rates";
$fee_res = mysql_query($fee_sql);
$fee_row = mysql_fetch_array($fee_res);
$subtitlefee = $fee_row['subtitle_price'];

$title = "Sell Your Item";
require 'include/top.php';
require 'templates/sell_item_detail.tpl';
require 'include/footer.php';
?>

