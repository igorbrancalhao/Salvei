<?php

/* * *************************************************************************
 * File Name				:signin.php
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

/* Fetching Sitename */
$sitename_sql = "select * from admin_settings where set_id=47";
$sitename_sqlqry = mysql_query($sitename_sql);
$sitename_fetch = mysql_fetch_array($sitename_sqlqry);
/* End of Fetching Sitename */

$mode = $_POST['mode'];
$user = $_POST['txtUsername'];
$pass = $_POST['txtPassword'];

$ip_address = $_SERVER['REMOTE_ADDR'];
$url = $_REQUEST['url'];
$seccode = $_POST['seccode'];
$item_id = $_POST['item_id'];

//if(!$url) $url=stripslashes(urldecode($_GET['url']));
if ($mode == "check") {
    $adm_sql = 'select * from admin_settings where set_id=41 and set_value="yes"';
    $adm_res = mysql_query($adm_sql);
    $adm_rows = mysql_num_rows($adm_res);
    $adm_rows = 0;
    if ($adm_rows > 0) {
        $url = $_GET['url'];
        $item_id = $_GET['item_id'];
        $mode = $_GET['mode'];
        $usr_sql = "select * from user_registration where user_name='$user'";

        $usr_result = mysql_query($usr_sql);
        $usr_rows = mysql_num_rows($usr_result);
        $usr_row = mysql_fetch_array($usr_result);
        $ip_block = $usr_row['ip_address'];
        $ip_sql = "select * from blocked_ip where blocked_ip='$ip_block'";
        $ip_res = mysql_query($ip_sql);
        $ip_rows = mysql_num_rows($ip_res);
        if ($ip_rows == 0) {
            $sql1 = "select user_name,password,user_id,last_login_date from user_registration where user_name='$user' and password='$pass' ";
            $result1 = mysql_query($sql1);
            if (mysql_num_rows($result1) == 0) {
                $sql_user = "select * from user_registration where user_name='$user'";
                $sqlqry_user = mysql_query($sql_user);
                $sqlrow_user = mysql_num_rows($sqlqry_user);
                if ($sqlrow_user == 0)
                    $err_username = 1;

                $sql_pass = "select * from user_registration where user_name='$user'";
                $sqlqry_pass = mysql_query($sql_pass);
                $sqlrow_pass = mysql_num_rows($sqlqry_pass);
                if ($sqlrow_pass == 0)
                    $err_password = 1;
                if ($sqlrow_pass > 0) {
                    $sqlfetch_pass = mysql_fetch_array($sqlqry_pass);
                    $passworddb = $sqlfetch_pass['password'];
                    $pwdcon = crypt($pass, $passworddb);
                    $user_sql = "select * from user_registration where user_name='$user' and password='$pwdcon'";
                    $user_res = mysql_query($user_sql);
                    $user_num = mysql_num_rows($user_res);
                    if ($user_num <= 0)
                        $err_password = 1;
                }
                if ($err_username == 1) {
                    $select_sql = "select * from error_message where err_id =53";
                    $select_tab = mysql_query($select_sql);
                    $select_row = mysql_fetch_array($select_tab);
                    $msg = $select_row['err_msg'];
                }
                if ($err_password == 1) {
                    $select_sql = "select * from error_message where err_id =52";
                    $select_tab = mysql_query($select_sql);
                    $select_row = mysql_fetch_array($select_tab);
                    $msg = $select_row[err_msg];
                }
                if (($err_username == 1) && ($err_password == 1)) {
                    $select_sql = "select * from error_message where err_id =89";
                    $select_tab = mysql_query($select_sql);
                    $select_row = mysql_fetch_array($select_tab);
                    $msg = $select_row['err_msg'];
                }
//    $msg="Invalid Password"; 
            } else if (mysql_num_rows($result1) != 0) {
                $sql_fetch = mysql_fetch_array($result1);
                $passwordbd = $sql_fetch['password'];
                $passcon = crypt($pass, $passwordbd);
                $user_sql1 = "select * from user_registration where user_name='$user' and password='$passcon'";
                $user_qry1 = mysql_query($user_sql1);
                $user_row1 = mysql_num_rows($user_qry1);
                if ($user_row1 <= 0) {
                    $err_password = 1;
                }

                if ($err_password == 1) {
                    $select_sql = "select * from error_message where err_id =52";
                    $select_tab = mysql_query($select_sql);
                    $select_row = mysql_fetch_array($select_tab);
                    $msg = $select_row['err_msg'];
                }
            }

            /* End of new check for casesensitiveness */

            if ($err_password != 1 && $err_username != 1) {

                $sql_pass = "select * from user_registration where user_name='$user'";
                $sqlqry_pass = mysql_query($sql_pass);
                $sqlrow_pass = mysql_num_rows($sqlqry_pass);
                if ($sqlrow_pass > 0) {
                    $sqlfetch_pass = mysql_fetch_array($sqlqry_pass);
                    $passworddb = $sqlfetch_pass['password'];
                    $pwdcon = crypt($pass, $passworddb);
                }
                $sql2 = "select user_name,password,user_id,last_login_date from user_registration where user_name='$user' and verified='yes' and status='Active' and password='$pwdcon'";
                $result2 = mysql_query($sql2);
                $chk = mysql_fetch_array($result2);
                if (mysql_num_rows($result2) == 0) {
                    $user_sql = "select * from user_registration where user_name='$user' and password='$pwdcon'";
                    $user_qry = mysql_query($user_sql);
                    if ($user_row = mysql_fetch_array($user_qry))
                        $user_status = $user_row['status'];
                    $select_sql = "select * from error_message where err_id =79";
                    $select_tab = mysql_query($select_sql);
                    $select_row = mysql_fetch_array($select_tab);
                    if ($user_status == "Active" or $user_status == "new" or $user_status == "Inactive")
                        $msg = $select_row['err_msg'];
                    else if ($user_status == "suspended")
                        $msg = "Your Account has been suspended";
                }
                else {
                    //header('location:confirmation.php?user_id='.$chk[user_id]);
                    $sql3 = "select * from user_registration where user_name='$user' and password='$pass' ";
                    $result3 = mysql_query($sql3);
                    $chk1 = mysql_fetch_array($result3);
                    $ip_address1 = $chk1[ip_address];
                    $ip_address2 = $_SERVER['REMOTE_ADDR'];
                    if (mysql_num_rows($result3) == 0) {
                        $select_sql = "select * from error_message where err_id =53";
                        $select_tab = mysql_query($select_sql);
                        $select_row = mysql_fetch_array($select_tab);
                        $msg = $select_row['err_msg'];
                    }



                    $date = date("Y-m-d");
                    $login = $chk['last_login_date'];
                    $log_up = "update user_registration set onlinestatus='Online',last_login_date='$date' where user_id=" . $chk[user_id];
                    $upsql = mysql_query($log_up);
                    if (isset($url)) {
                        $_SESSION['userid'] = $chk['user_id'];
                        $_SESSION['username'] = $chk['user_name'];
                        echo '<meta http-equiv="refresh" content="0;url=' . $url . '?item_id=' . $item_id . '&mode=' . $mode . '">';
                        echo "<font size=+1 color=#003366>Loading....</font>";
                        exit();
                    } else {
                        $_SESSION['userid'] = $chk['user_id'];
                        $_SESSION['username'] = $chk['user_name'];
                        echo '<meta http-equiv="refresh" content="0;url=myauction.php?user_login=' . $login . '">';
                        echo "<font size=+1 color=#003366>Loading....</font>";
                        exit();
                    }
                } //else of if (mysql_num_rows($result2) == 0) 
            }
        } else {
            $msg = "Sorry " . $user . " your id was blocked";
        }
    } else {
        $url = $_GET['url'];
        $item_id = $_GET['item_id'];
        $mode = $_GET['mode'];
        $sql = "select user_name,password,last_login_date from user_registration where user_name='$user' ";
        $result = mysql_query($sql);
        $tot = mysql_num_rows($result);
        if ($tot == 0) {
            $select_sql = "select * from error_message where err_id =53";
            $select_tab = mysql_query($select_sql);
            $select_row = mysql_fetch_array($select_tab);
            $msg = $select_row['err_msg'];
        } else {
            $sql_pass = "select * from user_registration where user_name='$user'";
            $sqlqry_pass = mysql_query($sql_pass);
            $sqlrow_pass = mysql_fetch_array($sqlqry_pass);
            $passwordactual = $sqlrow_pass['password'];
            $passchk = crypt($pass, $passwordactual);
            $sql1 = "select user_name,password,user_id,last_login_date,ip_address from user_registration where user_name='$user' and password='$passchk'";
            $result1 = mysql_query($sql1);
            if (mysql_num_rows($result1) == 0) {
                $select_sql = "select * from error_message where err_id =52";
                $select_tab = mysql_query($select_sql);
                $select_row = mysql_fetch_array($select_tab);
                $msg = $select_row['err_msg'];
                $msg = "Invalid Password";
            } else {
                $ip_block = $result1['ip_address'];
                $ip_sql = "select * from blocked_ip where blocked_ip ='$ip_block'";
                $ip_res = mysql_query($ip_sql);
                $ip_rows = mysql_num_rows($ip_res);
                if ($ip_rows == 0) {
                    $sql2 = "select user_name,password,user_id,last_login_date from user_registration where user_name='$user' and password='$passchk' and verified='yes'";
                    $result2 = mysql_query($sql2);
                    $chk = mysql_fetch_array($result2);
                    if (mysql_num_rows($result2) == 0) {
                        $select_sql = "select * from error_message where err_id =79";
                        $select_tab = mysql_query($select_sql);
                        $select_row = mysql_fetch_array($select_tab);
                        $msg = $select_row['err_msg'];
//	$msg="Your Account Not Verified"; 
                    } else {


                        $sql3 = "select * from user_registration where user_name='$user' and password='$passchk'";
                        $result3 = mysql_query($sql3);
                        $chk1 = mysql_fetch_array($result3);
                        $ip_address1 = $chk1['ip_address'];
                        $ip_address2 = $_SERVER['REMOTE_ADDR'];
                        if (mysql_num_rows($result3) == 0) {
                            $msg = "Invalid Username";
                        }
                        /* else if (mysql_num_rows($result3)!=0)
                          {
                          if ($ip_address2!=$ip_address1)
                          {
                          echo '<meta http-equiv="refresh" content="0;url=confirmation.php?user_id='.$chk[user_id].'&ip_address2='.$ip_address2.'&ip_address1='.$ip_address1.'">';
                          echo "<font size=+1 color=#003366>Loading....</font>";
                          exit();
                          }
                          } */

                        $date = date("Y-m-d");
                        $login = $chk['last_login_date'];
                        $log_up = "update user_registration set onlinestatus='Online',last_login_date='$date' where user_id=" . $chk[user_id];
                        $upsql = mysql_query($log_up);
                        if (isset($url)) {
                            $_SESSION['userid'] = $chk['user_id'];
                            $_SESSION['username'] = $chk['user_name'];
                            echo '<meta http-equiv="refresh" content="0;url=' . $url . '?item_id=' . $item_id . '&mode=' . $mode . '">';
                            echo "<font size=+1 color=#003366>Loading....</font>";
                            exit();
                        } else {
                            $_SESSION['userid'] = $chk['user_id'];
                            $_SESSION['username'] = $chk['user_name'];
                            echo '<meta http-equiv="refresh" content="0;url=myauction.php?user_login=' . $login . '">';
                            echo "<font size=+1 color=#003366>Loading....</font>";
                            exit();
                        }
                    } //else of if (mysql_num_rows($result2) == 0) 
                } else {
                    $msg = "Sorry " . $user . " your id was blocked";
                }
            }
        }
    }
}
?>
<?php

$title = "Sign In";
$click = "myauction";
require'include/top.php';
require'templates/signin.tpl';
require'include/footer.php';
?>


