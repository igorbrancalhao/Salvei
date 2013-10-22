<?php
/* * *************************************************************************
 * File Name				:edit_item_detail.php
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
session_start();
require 'include/connect.php';
/*
  file name:sell_item_detail.php;
  date	  :5.7.05
  Created by:priya
  Rights reserved by AJ Square inc
 */

//if($_GET[item_id])
if (isset($_REQUEST[flag])) {

$user_id = $_POST['user_id'];
$item_id = $_POST['item_id'];
$item_title = $_POST[txttitle];
$itemdes = $_POST[htmlcontent];
$item_counter_style = $_POST['item_counter_style'];
$start_delay = $_POST['cbo_start_delay'];
$currency = $_POST['cbocurrency'];
$Gallery = $_POST['chkGallery'];
$Border = $_POST['chkBorder'];
$Highlight = $_POST['chkHighlight'];
$sell_format = $_SESSION[sell_format];
$Bold = $_POST['chkBold'];
$Subtitle = $_POST['chkSubtitle'];
$Subtitle_name = $_POST['txtSubtitle'];
$Home = $_POST['chkHome'];
$size_of_qty = $_POST['size_of_qty'];
$qty = $_POST['txt_qty'];
$quick = $_POST[txt_quick];
$min_amt = $_POST[txt_min_amt];
$rev_price = $_POST[txt_rev_price];
$bid_inc = $_POST[txt_bid_inc];
$repost = $_POST[repost];
$duration = $_POST[cbodur];
$ship_cost = $_POST[txtship_amt];
$tax = $_POST[tax];

$ship = $_POST['asia'];
$ship = $_POST['aus'];
$ship = $_POST['africa'];
$ship = $_POST['america'];
$ship = $_POST['europe'];

$world = $_POST[world];
if ($world == "all")
;
$ship = $_POST['asia'] . " " . $_POST['aus'] . " " . $_POST['africa'] . " " . $_POST['america'] . " " . $_POST['europe'] . " ";

$query = "update placing_item_bid set user_id='$user_id',item_title='$item_title', detailed_descrip='$itemdes' ,";
$query.="item_counter_style='$item_counter_style' , currency='$currency' , size_of_quantity = '$size_of_qty' , ";
$query.="Quantity='$qty' , duration='$duration' , no_of_repost='$repost' , min_bid_amount='min_amt' ,  bid_increment='bid_inc' , ";
$query.="reserve_price='rev_price' , quick_buy_price='$quick' , shipping_cost='$ship_cost' , tax='$tax' , shipping_route='$ship'  where item_id='$item_id' ";
if (mysql_query($query))
$update = "Item Updated Successfully.";
} //$flag==1
?>
<?php require 'include/top.php'; ?>
<html>
    <head>
        <title>Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
    <body>
        <?php
        $query = "select * from placing_item_bid where item_id='$_REQUEST[item_no]'";
        $table = mysql_query($query);
        $item_row = mysql_fetch_array($table);
        ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table_border">
            <tr>
                <td colspan=2 align="center" bgcolor="#FFCF00" class="style1">
                    <font size=+1>
                    <?php
                    echo "Edit Item";
                    ?> 
                    Title & Description </font></td>
            </tr>
            <tr><td><br><center><b><font color="#ff0000"><?php if (strlen($update) != 0) echo $update; ?></td></tr>
                    <tr><td>
                            <?php
                            if ($err_flag == 1) {
                            ?>
                            <table width="100%" align="center"><tr><td>
                                        <img src="../images/warning_39x35.gif"></td>
                                    <td><font size=2 color="red">The following must be corrected before continuing:</font></td>
                                    <?php
                                    if (!empty($err_title)) {
                                    ?>
                                <tr><td>&nbsp;</td>
                                    <td><a href="sell_item_detail.php#txttitle">Item Title</a> - <?php = $err_title; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_des)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#areades">Item Description</a> - <?php = $err_des; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_min_amt)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#txt_min_amt">Minimum Bid Amount</a> - <?php = $err_min_amt; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_fix_price)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#txt_quick">Quick Buy Price</a> - <?php = $err_fix_price; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_rev_price)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#txt_rev_price">Reserve Price</a> - <?php = $err_rev_price; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_qty)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#txt_qty">Quantity</a> - <?php = $err_qty; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_dur)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#cbodur">Duration</a> - <?php = $err_dur; ?></td></tr>
                                <?php
                                }
                                ?>

                                <?php
                                if (!empty($err_size_qty)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#size_of_qty">Size of Quantity</a> - <?php = $err_size_qty; ?></td></tr>
                                <?php
                                }
                                ?>

                                <?php
                                if (!empty($err_bid_inc)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#txt_bid_inc">Bid Increment</a> - <?php = $err_bid_inc; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_cur)) {
                                ?>
                                <tr><td>&nbsp;</td>
                                    <td><a href="sell_item_detail.php#cbocurrency">Currency</a> - <?php = $err_cur; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_img1)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#img1">Image1</a> - <?php = $err_img1; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_img2)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#img2">Image2</a> - <?php = $err_img2; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_img3)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#img3">Image3</a> - <?php = $err_img3; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_img4)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#img4">Image4</a> - <?php = $err_img4; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (!empty($err_img5)) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#img5">Image5</a> - <?php = $err_img5; ?></td></tr>
                                <?php
                                }
                                ?>
                                <?php
                                if ($tablename) {
                                $tab_sql = "select * from $tablename";
                                $tab_res = mysql_query($tab_sql);
                                $i = 2;
                                while ($i < mysql_num_fields($tab_res)) {
                                $tab_col = mysql_fetch_field($tab_res, $i);
                                $dummy = $tab_col->name;
//   echo "sesssion"."<br>". ;
                                if (empty($_SESSION[$tab_col->name])) {
                                ?>

                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#<?php = $tab_col->name ?>"><?php = $tab_col->name ?></a>-Please Enter this Information </td></tr>

                                <?php
                                } else {
                                $var_type = $tab_col->type;
                                if ($var_type == "int" or $var_type == "tinyint") {
                                if (!is_numeric($_SESSION[$tab_col->name])) {
                                ?>
                                <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#<?php = $tab_col->name ?>"><?php = $tab_col->name ?></a>-Please Enter this Information </td></tr>
                                <?php
                                }
                                }
                                }
                                /*   if(empty($_SESSION[$tab_col->name]))
                                  {
                                  ?>
                                  <tr><td>&nbsp;</td><td><a href="sell_item_detail.php#<?php= $dummy ?>"><?php= $dummy ?></a>-Please Enter this Information </td></tr>
                                  <?php
                                  } */
                                $i++;
                                }
                                }
                                ?>




                            </table></td></tr>
                    <tr><td>
                            <hr size="1" noshade class="hr_color"></td></tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td>
                            <form name="form1" action="edit_item_detail.php" method=post enctype="multipart/form-data">
                                <table width="100%" cellpadding="5" cellspacing="2" >
                                    <tr><td><b>User Id</td></tr>
                                    <tr><td><input name='user_id' value='<?php echo $item_row[user_id] ?>'></td></tr>
                                    <?php
                                    if ($cat_id) {
                                    $sub_sql = "select * from category_master where category_head_id=$cat_id";
                                    $sub_res = mysql_query($sub_sql);
                                    $sub_tot = mysql_num_rows($sub_res);
                                    }
                                    if ($sub_tot != 0) {
                                    ?>
                                    <tr><td><font size=2><b>Sub Category</b></font></td></tr>
                                    <tr><td><select name=cbosubcat><option value="0">Select</option>
                                                <?php
                                                while ($sub_row = mysql_fetch_array($sub_res)) {
                                                if (trim($sub_row['category_id']) == trim($sub_cat)) {
                                                ?>
                                                <option value="<?php = $sub_row['category_id'] ?>" selected><?php = $sub_row['category_name'] ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value="<?php = $sub_row['category_id'] ?>"><?php = $sub_row['category_name'] ?></option>
                                                <?php
                                                }
                                                }
                                                ?>
                                            </select>
                                        </td></tr>
                                    <?php
                                    } else {
                                    ?>

                                    <?php
                                    if ($file_path)
                                    require "../$file_path";
                                    ?>

                                    <?php
                                    }
                                    ?>
                                    <tr><td>
                                            <?php if (!empty($err_title)) {
                                            ?>
                                            <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_title ?></font>
                                            <br>
                                            <b><font size=2 color=red>Item title</font></b>
                                            <?php
                                            } else {
                                            ?>
                                            <b><font size=2 >Item title</font></b>
                                            <?php }
                                            ?>
                                        </td></tr>
                                    <?php
                                    if ($item_title == "") {
                                    $item_title = $item_row['item_title'];
                                    }
                                    ?>
                                    <tr><td width=250><input type="text" name="txttitle" class="txtbig" value=<?php = $item_title; ?>>
                                        </td></tr>
                                    <tr><td>
                                            <?php
                                            if (!empty($err_des)) {
                                            ?>
                                            <img src="images/warning_9x10.gif">&nbsp;
                                            <font size=2 color=red><?php = $err_des; ?></font>
                                            <br>
                                            <b><font size=2 color=red>Item Description</font></b>
                                            <?php
                                            } else {
                                            ?>
                                            <b><font size=2 >Item Description</font></b>
                                            <?php }
                                            ?>
                                        </td></tr>
                                    <tr><td width="100%">
                                   <!--  <textarea rows="5" cols="35" name="areades">
                                            <?php = $itemdes; ?>
                                    </textarea> -->
                                            <?php
                                            if ($itemdes == "") {
                                            $itemdes = $item_row['detailed_descrip'];
                                            }
                                            ?>
                                            <?php
                                            /*
                                              $browser_name=$_SERVER['HTTP_USER_AGENT'];
                                              if(substr_count($browser_name,'Opera')==1) $brow_name='opera';
                                              else if(substr_count($browser_name,'Netscape')==1) $brow_name='netscape';
                                              else if(substr_count($browser_name,'Firefox')==1) $brow_name='firefox';
                                              else $brow_name='ie';
                                              if($brow_name=='netscape'||$brow_name=='opera'||$brow_name=='firefox')
                                              echo '<textarea name="htmlcontent" cols="60" rows="15">'.$itemdes.'</textarea>';
                                              else require 'include/content.php';
                                             */
                                            ?>
                                            <textarea name="htmlcontent" cols="60" rows="15"><?php = $itemdes ?></textarea>

                                            <br>
                                            <font size=2 class="hint_font">Describe your items features, benefits, 
                                            and condition. Be sure to include in your description: Condition (new, used, etc.)</font></td>
                                    </tr>
                                    <tr>
                                        <td><font size=2 ><b>Item Hit Counter </b></font></td>
                                    </tr>
                                    <tr><td>
                                            <?php
                                            if ($item_counter_style == "") {
                                            $item_counter_style = $item_row['item_counter_style'];
                                            }
                                            ?>

                                            <?php
                                            if ($item_counter_style == 2) {
                                            ?>
                                            <input type="radio" name="item_counter_style" value=1 > 
                                            <b><font size=+1 color="#009900">
                                                12345
                                                </font>
                                            </b> 
                                            <input type="radio" name="item_counter_style" value=2 checked> 
                                            <I><font size=+1 color="#003399">
                                                12345
                                                </font>
                                            </I>  
                                            <?php
                                            } else {
                                            ?>		 
                                            <input type="radio" name="item_counter_style" value=1 checked> 
                                            <b><font size=+1 color="#009900">
                                                12345
                                                </font>
                                            </b> 
                                            <input type="radio" name="item_counter_style" value=2 > 
                                            <I><font size=+1 color="#003399">
                                                12345
                                                </font>
                                            </I>  
                                            <?php
                                            }
                                            ?></td></tr>
                                    <?php
                                    if (!empty($err_cur)) {
                                    ?>
                                    <tr><td>
                                            <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_cur; ?></font>
                                            <br><font size=2 color=red><b>Currency</b></font></td></tr>
                                    <?php
                                    } else {
                                    ?>
                                    <tr><td><font size=2 ><b>Currency</b></font></td></tr>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($currency == "") {
                                    $currency = $item_row['currency'];
                                    }
                                    ?>

                                    <tr><td><select name=cbocurrency>
                                                <option value=0>Select</option>
                                                <?php
                                                $cur_sql = "select * from currency_master";
                                                $cur_res = mysql_query($cur_sql);
                                                while ($currency_row = mysql_fetch_array($cur_res)) {
                                                if (trim($currency_row['currency']) == trim($currency)) {
                                                ?>
                                                <option value="<?php = $currency_row['currency'] ?>" selected><?php = $currency_row['currency'] ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value="<?php = $currency_row['currency'] ?>"><?php = $currency_row['currency'] ?></option>
                                                <?php
                                                }
                                                }
                                                ?>
                                            </select>
                                        </td></tr> 
                                    <?php
                                    if ($start_delay == "") {
                                    $start_delay = $item_row['start_delay'];
                                    }
                                    ?>
                                    <?php
                                    if ($admin_start_row['set_value'] == 'yes') {
                                    ?>

                                    <?php
                                    if ($mode != "edit") {
                                    ?>
                                    <tr><td width=250><b><font size=2>Start Delay</font></b></td></tr>
                                    <tr><td width=250>
                                            <select name="cbo_start_delay" >
                                                <?php
                                                if ($start_delay == 1) {
                                                ?>
                                                <option value=1 name=cbo_start_delay selected>1 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=1 name=cbo_start_delay>1 Days</option>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($start_delay == 2) {
                                                ?>
                                                <option value=2 name=cbo_start_delay selected>2 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=2 name=cbo_start_delay>2 Days</option>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($start_delay == 3) {
                                                ?>
                                                <option value=3 name=cbo_start_delay selected>3 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=3 name=cbo_start_delay>3 Days</option>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($start_delay == 4) {
                                                ?>
                                                <option value=4 name=cbo_start_delay selected>4 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=4 name=cbo_start_delay>4 Days</option>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($start_delay == 5) {
                                                ?>
                                                <option value=5 name=cbo_start_delay selected>5 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=5 name=cbo_start_delay>5 Days</option>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($start_delay == 6) {
                                                ?>
                                                <option value=6 name=cbo_start_delay selected>6 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=6 name=cbo_start_delay>6 Days</option>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($start_delay == 7) {
                                                ?>
                                                <option value=7 name=cbo_start_delay selected>7 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=7 name=cbo_start_delay>7 Days</option>
                                                <?php
                                                }
                                                ?>
                                            </select></td></tr>
                                    <?php
                                    }// if($mode=="edit")
                                    } // if($admin_start_row=='yes')
                                    ?>

                                    <tr><td>

                                            <?php
                                            if (!empty($err_size_qty)) {
                                            ?>
                                            <img src="images/warning_9x10.gif">
                                            &nbsp;<font size=2 color=red><?php = $err_size_qty ?></font>
                                            <br>
                                            <b><font size=2 color=red>Size of Quantity</font></b>
                                            <?php
                                            } else {
                                            ?>
                                            <b><font size=2 >Size of Quantity</font></b>
                                            <?php
                                            }
                                            ?>


                                        </td></tr>


                                    <tr><td>
                                            <?php
                                            if (trim($size_of_quantity) == "") {
                                            $size_of_quantity = $item_row['size_of_quantity'];
                                            }
                                            ?>
                                            <select name="size_of_qty">
                                                <option value="None">None</option>
                                                <option value="Pieces" <?php if ($size_of_quantity == "Pieces") echo "selected"; ?> >Pieces</option>
                                                <option value="Dozens" <?php if ($size_of_quantity == "Dozens") echo "selected"; ?>>Dozens</option>
                                            </select></td></tr>

                                    <?php
                                    if (trim($duration) == "") {
                                    $duration = $item_row['duration'];
                                    }
                                    ?>
                                    <tr><td><b>Duration</td></tr>
                                    <tr><td width=250>
                                            <select name="cbodur">
                                                <option value="0">Select</option>
                                                <option value=30 <?php if ($duration == 30) echo "selected"; ?> >30 Days</option>
                                                <option value=60 <?php if ($duration == 60) echo "selected"; ?>>60 Days</option>
                                                <option value=90 <?php if ($duration == 90) echo "selected"; ?>>90 Days</option>
                                                <option value=120 <?php if ($duration == 120) echo "selected"; ?>>120 Days</option>
                                            </select>
                                        </td></tr>



























                                    <?php
                                    if ($sell_format == 1) {
                                    ?>
                                    <tr><td>
                                            <?php
                                            if (!empty($err_qty)) {
                                            ?>
                                            <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_qty ?></font>
                                            <br>
                                            <b><font size=2 color=red>Quantity</font></b>
                                            <?php
                                            } else {
                                            ?>
                                            <b><font size=2>Quantity</font></b>
                                            <?php
                                            }
                                            } //if($sell_format==2) online  667
                                            ?>
                                        </td>
                                        <?php
                                        if ($admin_end_row['set_value'] == 'yes') {
                                        ?>
                                        <td>
                                            <?php
                                            if (!empty($err_dur)) {
                                            if ($mode != "edit") {
                                            ?>
                                            <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_dur; ?></font>
                                            <br>
                                            <b><font size=2 color=red>Duration</font></b>
                                            <?php
                                            } else {
                                            ?>
                                            <b><font size=2 >Duration</font></b>
                                            <?php
                                            }
                                            } //  if($mode=='edit')
                                            } //  if($admin_end_row=='yes')
                                            ?>

                                        </td>
                                    </tr>




                                    <?php
                                    if ($qty == "") {
                                    $qty = $item_row['Quantity'];
                                    }
                                    ?>
                                    <tr>
                                        <?php
                                        if ($sell_format == 1) {
                                        ?>
                                        <td width=250>
                                            <input type="text" name="txt_qty" class="txtsmall" value=<?php = $qty; ?>>
                                        </td>
                                        <?php
                                        }
                                        ?>
                                        <td width=250>
                                            <?php
                                            if ($dur == "") {
                                            $dur = $item_row['duration'];
                                            }
                                            ?>
                                            <?php
                                            if ($admin_end_row['set_value'] == 'yes') {
                                            if ($mode != "edit") {
                                            ?>
                                            <select name="cbodur">
                                                <option value="0">Select</option>
                                                <?php
                                                if ($dur == 30) {
                                                ?>
                                                <option value=30 selected>30 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=30>30 Days</option>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($dur == 60) {
                                                ?>
                                                <option value=60 selected>60 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=60>60 Days</option>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($dur == 90) {
                                                ?>
                                                <option value=90 selected>90 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=90>90 Days</option>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($dur == 120) {
                                                ?>
                                                <option value=120 selected>120 Days</option>
                                                <?php
                                                } else {
                                                ?>
                                                <option value=120>120 Days</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <?php
                                        } //if($mode=="edit")
                                        }  // if($admin_end_row=='yes')
                                        ?></tr>


                                    <tr><td><font size=2 ><b>Number of Repost</b></font></td></tr>
                                    <?php
//}
                                    ?>
                                    </td></tr>
                                    <?php
// $repost=4;
                                    $qry = "select * from admin_settings where set_id=37";
                                    $repost_table = mysql_query($qry);
                                    $repost_row = mysql_fetch_array($repost_table);
                                    $repost = $repost_row['set_value'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($repost == "") {
                                            $repost = $item_row['no_of_repost'];
                                            }
                                            ?>

                                            <select name="repost">
                                                <option>Select Repost</option>
                                                <?php
                                                for ($i = 1;
                                                $i <= $repost;
                                                $i++) {
                                                if ($repost == $i)
                                                echo "<option selected>$i </option>";
                                                else
                                                echo "<option>$i </option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>



                                    <tr class="tr_border" width=758><td colspan="2"><font size="2"><b>Auction</b></font></td></tr>
                                    <tr>
                                        <td><b>Note:</b>Enter Your Bidding details and <?php = $_SESSION[site_name] ?> will Bid 
                                            as needed for You .</td>
                                    </tr>
                                    <tr><td width="250">



                                            <?php
                                            if (!empty($err_min_amt)) {
                                            ?>
                                            <img src="images/warning_9x10.gif">
                                            &nbsp;<font size=2 color=red><?php = $err_min_amt ?></font>
                                            <br>
                                            <b><font size=2 color=red>Minimum Bid Amount</font></b>
                                            <?php
                                            } else {
                                            ?>
                                            <b><font size=2 >Minimum Bid Amount</font></b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (!empty($err_rev_price)) {
                                            ?>
                                            <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_rev_price ?></font>
                                            <br>
                                            <b><font size=2 color=red>Reserve Price</font></b>
                                            <?php
                                            } else {
                                            ?>
                                            <b><font size=2 >Reserve Price</font></b>
                                            <?php
                                            }
                                            ?>

                                        </td></tr>
                                    <?php
                                    if ($min_amt == "") {
                                    $min_amt = $item_row['min_bid_amount'];
                                    }
                                    ?>
                                    <?php
                                    if ($rev_price == "") {
                                    $rev_price = $item_row['reserve_price'];
                                    }
                                    ?>
                                    <tr><td width=250><input type="text" name="txt_min_amt" class="txtsmall" value=<?php = $min_amt; ?>></td>
                                        <td width=250><input type="text" name="txt_rev_price" class="txtsmall" value=<?php = $rev_price; ?>></td></tr>
                                    <tr><td>
                                            <?php if (!empty($err_bid_inc)) {
                                            ?>
                                            <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_bid_inc ?></font>
                                            <br>
                                            <b><font size=2 color=red>Bid Increment</font></b>
                                            <?php
                                            } else {
                                            ?>
                                            <b><font size=2>Bid Increment</font></b>
                                            <?php }
                                            ?>
                                            <?php
                                            if ($bid_inc == "") {
                                            $bid_inc = $item_row['bid_increment'];
                                            }
                                            ?>
                                        </td></tr>
                                    <tr><td width=250><input type="text" name="txt_bid_inc" class="txtsmall" value=<?php = $bid_inc; ?>></td></tr>
                                    <tr class="tr_border" width=758><td colspan="2"><font size="2"><b>Fixed Price Sale</b></font></td></tr>
                                    <tr>

                                        <td><b>Note:</b>Buy Now is only available until<br>
                                            the reserve price is met</td>
                                    </tr>
                                    <tr><td>
                                            <?php if (!empty($err_fix_price)) {
                                            ?>
                                            <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_fix_price; ?></font>
                                            <br>
                                            <b><font size=2 color=red>Quick Buy Price</font></b>
                                            <?php
                                            } else {
                                            ?>
                                            <b><font size=2>Quick Buy Price</font></b>
                                            <?php
                                            }
                                            ?>
                                        </td></tr>
                                    <?php
                                    if ($quick == "") {
                                    $quick = $item_row['quick_buy_price'];
                                    }
                                    ?>
                                    <tr>
                                        <td width=250>
                                            <input type="text" name="txt_quick" class="txtsmall" value=<?php = $quick; ?>></td></tr>

                                    <!--
                                     
                                    <tr class="tr_border" width=758><td colspan="2"><font size="2"><b>Add Images</b></font></td></tr>
                                    <tr><td colspan="2">
                                    <?php if (!empty($err_img1)) {
                                    ?>
                                         <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_img1; ?></font>
                                         <br>
                                         <b><font size=2 color=red>Image1</font></b>
                                    <?php
                                    } else {
                                    ?>
                                           <b><font size=2 >Image1</font></b>
                                    <?php
                                    }
                                    ?>
                                        <input type="file" name="img1" value="<?php = $img1; ?>">
                                    <?php
                                    if (!empty($_SESSION[img1])) {
                                    ?>
                                                <img src="images/gallery.png" width=10 height=10>
                                    <?php
                                    }
                                    ?></td></tr>
                                    <?php
                                    if ($sell_format != "4") {
                                    if ($member_account != "1") {
                                    ?>
                                                    <tr><td colspan="2">
                                    <?php
                                    if (!empty($err_img2)) {
                                    ?>
                                                 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_img2; ?></font>
                                                 <br>
                                                 <b><font size=2 color=red>Image2</font></b>
                                    <?php
                                    } else {
                                    ?>
                                                   <b><font size=2 >Image2</font></b>
                                    <?php }
                                    ?>
                                                <input type="file" name="img2" value=<?php = $img2; ?>>
                                    <?php
                                    if (!empty($_SESSION[img2])) {
                                    ?>
                                                        <img src="images/gallery.png" width=10 height=10>
                                    <?php
                                    }
                                    ?></td></tr>
                                            <tr><td colspan="2">
                                    <?php if (!empty($err_img3)) {
                                    ?>
                                                 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_img3; ?></font>
                                                 <br>
                                                 <b><font size=2 color=red>Image3</font></b>
                                    <?php
                                    } else {
                                    ?>
                                                   <b><font size=2 >Image3</font></b>
                                    <?php }
                                    ?>
                                                <input type="file" name="img3" value=<?php = $img3; ?>>
                                    <?php
                                    if (!empty($_SESSION[img3])) {
                                    ?>
                                                        <img src="images/gallery.png" width=10 height=10>
                                    <?php
                                    }
                                    ?></td></tr>
                                            
                                            <!-- <tr><td colspan="2">
                                    <?php if (!empty($err_img4)) {
                                    ?>
                                                 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_img4; ?></font>
                                                 <br>
                                                 <b><font size=2 color=red>Image4</font></b>
                                    <?php
                                    } else {
                                    ?>
                                                   <b><font size=2 >Image4</font></b>
                                    <?php }
                                    ?>
                                                <input type="file" name="img4" value=<?php = $img4; ?>>
                                    <?php
                                    if (!empty($_SESSION[img4])) {
                                    ?>
                                                        <img src="images/gallery.png" width=10 height=10>
                                    <?php
                                    }
                                    ?></td></tr> 
                                            <tr><td colspan="2">
                                    <?php if (!empty($err_img5)) {
                                    ?>
                                                 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_img5; ?></font>
                                                 <br>
                                                 <b><font size=2 color=red>Image5</font></b>
                                    <?php
                                    } else {
                                    ?>
                                                   <b><font size=2 >Image5</font></b>
                                    <?php
                                    }
                                    ?>
                                                <input type="file" name="img5" value=<?php = $img5; ?>>
                                    <?php
                                    if (!empty($_SESSION[img5])) {
                                    ?>
                                                        <img src="images/gallery.png" width=10 height=10>
                                    <?php
                                    }
                                    ?></td></tr> -->
                                    <?php
                                    } // if($member_account !=1 )
                                    } // if($sell_format=!=4) on line 810
                                    ?>
                                    <?php
                                    /* $mem_sql="select * from user_registration where user_id=$_SESSION[userid]";
                                      $mem_res=mysql_query($mem_sql);
                                      $mem_row=mysql_fetch_array($mem_res);
                                      $member_account=$mem_row[member_account]; */
                                    $sql = "select * from admin_rates";
                                    $exe = mysql_query($sql);
                                    $ret = mysql_fetch_array($exe);
                                    $gret = $ret['gallery_price'];
                                    $hret = $ret['homepage_price'];
                                    $sret = $ret['subtitle_price'];
                                    $bret = $ret['bold_price'];
                                    $highret = $ret['highlight_price'];
                                    ?>
                                    <?php
                                    $user_query = "select * from user_registration where	user_id='$_SESSION[userid]'";
                                    $table = mysql_query($user_query);
                                    if ($row = mysql_fetch_array($table)) {
                                    $member_type = $row['member_account'];
                                    }
                                    ?>


                                    <tr><td>
                                            <?php
                                            if ($bid_inc == "") {
                                            $bid_inc = $item_row['bid_increment'];
                                            }
                                            ?>

                                            <?php
                                            if (!empty($Gallery)) {
                                            ?>
                                            <input type="checkbox" name=chkGallery value="yes" checked>
                                            <?php
                                            } else {
                                            ?>
                                            <input type="checkbox" name=chkGallery value="yes">
                                            <?php
                                            }
                                            ?>



                                            <font size=2 >
                                            Gallery <?php if ($member_type == 1) echo "$ (" . $gret . ")"; ?>
                                            [Requires a picture,<a href="edit_item_detail.php#img1"> add a picture now </a>] <br>
                                            Add a small version of your first picture to Search and Listings. 
                                            </font>
                                            <input type=hidden name="gallery" value="<?php if ($member_type == 1) echo $gret; ?>">
                                        </td></tr>

                                    <tr><td>
                                            <?php
                                            if (!empty($Home)) {
                                            ?>
                                            <input type="checkbox" name=chkHome value="yes" checked>
                                            <?php
                                            } else {
                                            ?>
                                            <input type="checkbox" name=chkHome value="yes">
                                            <?php
                                            }
                                            ?>
                                            <font size=2>
                                            Home Page Featured  
                                            <?php if (($member_type == 1) || ($member_type == 2)) echo "$ (" . $hret . ")"; ?>)
                                            <input type=hidden name="home_page" value="<?php if (($member_type == 1) || ($member_type == 2)) echo $hret; ?>">
                                            </font>
                                        </td></tr>
                                    <!--
                                        <tr><td>
                                    <?php
                                    if (!empty($Subtitle)) {
                                    ?>
                                                        <input type="checkbox" name=chkSubtitle value="yes" checked>
                                    <?php
                                    } else {
                                    ?>
                                                <input type="checkbox" name=chkSubtitle value="yes">	
                                    <?php
                                    }
                                    ?>
                                        <font size=2 >SubTitle <br>
                                            Add a Subtitle to give buyers more information.  
                                        </font>
                                            </td></tr>
                                            <tr><td width=250 >
                                            <input type="text" name="txtSubtitle" class="txtbig" value=<?php = $Subtitle_name; ?>></td></tr> -->
                                    <tr><td>
                                            <?php
                                            if (!empty($Bold)) {
                                            ?>
                                            <input type="checkbox" name=chkBold value="yes" checked>
                                            <?php
                                            } else {
                                            ?>
                                            <input type="checkbox" name=chkBold value="yes">
                                            <?php
                                            }
                                            ?>
                                            <font size=2 >Bold <br> <?php if ($member_type == 1) echo "$ (" . $bret . ")"; ?>
                                            Attract buyers' attention and set your listing apart - use <b>Bold</b>. 
                                            </font>
                                            <input type=hidden name="bold" value="<?php if ($member_type == 1) echo $bret; ?>">
                                        </td></tr>
                                  <!--	<tr><td>
                                    <?php
                                    if (!empty($Border)) {
                                    ?>
                                            <input type="checkbox" name=chkBorder value="yes" checked>
                                    <?php
                                    } else {
                                    ?>
                                            <input type="checkbox" name=chkBorder value="yes">
                                    <?php
                                    }
                                    ?>
                                     <font size=2 >	Border ($3.00) <br>
                                    Get noticed - outline your listing with an eye-catching frame. 
                                    </font>
                                        </td></tr> -->
                                    <tr><td>
                                            <?php
                                            if (!empty($Highlight)) {
                                            ?>
                                            <input type="checkbox" name=chkHighlight value="yes" checked>
                                            <?php
                                            } else {
                                            ?>
                                            <input type="checkbox" name=chkHighlight value="yes">
                                            <?php
                                            }
                                            ?>
                                            <font size=2>Highlight  <br> 
                                            <?php if (($member_type == 1) || ($member_type == 2)) echo "$ (" . $highret . ")"; ?>
                                            Make your listing stand out with a colored band in Search results.  
                                            </font> 
                                        </td></tr>





                                    <input type=hidden name="highlight" value="<?php if (($member_type == 1) || ($member_type == 2)) echo $highret; ?>">









                                    <tr class="tr_border"><td>
                                            <?php if (!empty($err_ship_loc)) {
                                            ?>
                                            <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php = $err_ship_loc ?></font>
                                            <br>
                                            <b><font size=2 color=red>Shipping Location</font></b>
                                            <?php
                                            } else {
                                            ?>
                                            <b><font size=2>Shipping Location</font></b>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <?php
                                    if ($shipping_route == "") {
                                    $shipping_route = $item_row['shipping_route'];
                                    }
                                    $ship = explode(' ', $shipping_route);
                                    if ($ship[1] != "")
                                    $shipping_route = "world";
                                    ?>	



                                    <tr><td>
                                            <table align="left" width="250" cellpadding="5" cellspacing="2">
                                                <tr><td><input type="checkbox" name=world value="all" onClick="selectall()" <?php if ($shipping_route == "world") echo"checked"; ?>>Worldwide</td>
                                                    <td><input type="checkbox" name=asia value="Asia" <?php if ($shipping_route == "Asia") echo"checked"; ?>>Asia</td>
                                                    <td><input type="checkbox" name=aus value="Australia" <?php if ($shipping_route == "Australia") echo"checked"; ?> >Australia</td></tr>

                                                <tr><td><input type="checkbox" name=america value="America/Canada" <?php if ($shipping_route == "America/Canada") echo"checked"; ?>>America/Canada</td>

                                                    <td><input type="checkbox" name=africa value="Africa" <?php if ($shipping_route == "world") echo"Africa"; ?>>Africa</td>
                                                    <td><input type="checkbox" name=europe value="Europe" <?php if ($shipping_route == "world") echo"Europe"; ?>>Europe</td></tr>
                                            </table>
                                        </td></tr>

















                                    <?php
                                    if ($shipping_amt == "") {
                                    $shipping_amt = $item_row['shipping_cost'];
                                    }
                                    ?>	
                                    <tr class="tr_border"><td><font size="2"><b>Shipping Cost</b></font></td></tr>
                                    <tr><td ><input type="text" name=txtship_amt class="txtsmall" value=<?php = $shipping_amt; ?>></td></tr>
                                    <?php
                                    if ($tax == "") {
                                    $tax = $item_row['tax'];
                                    }
                                    ?>	

                                    <tr class="tr_border"><td><font size="2"><b>Sales Tax </b></font></td></tr>
                                    <tr><td><input type="text" name=tax class="txtsmall" value=<?php = $tax; ?>> </td></tr>


                                    <input type="hidden" name=flag value="1">
                                    <input type="hidden" name="cat_id" value=<?php = $cat_id; ?>>
                                    <input type="hidden" name=mode value="<?php = $mode; ?>">
                                    <input type="hidden" name=sell_format value="<?php = $sell_format; ?>">
                                    <input type="hidden" name=item_id value="<?php echo $_REQUEST['item_no']; ?>">

                                    <tr><td colspan="2" align="center">


                                            <input type="submit" name=detsub value=Continue>

                                        </td></tr>
                                </table>
                            </form>

                            <?php require 'include/footer.php' ?>
                            </table>

                            <script language="javascript">
                                function sel_method()
                                {
                                    document.form1.radselling.value = "auction";
                                    document.form1.flag.value = 2;
                                    document.form1.submit();
                                }

                                function selectall()
                                {

                                    if (document.form1.world.checked == false)
                                    {
                                        document.form1.aus.checked = false;
                                        document.form1.america.checked = false;
                                        document.form1.europe.checked = false;
                                        document.form1.africa.checked = false;
                                        document.form1.asia.checked = false;
                                    }
                                    else
                                    {
                                        document.form1.aus.checked = true;
                                        document.form1.america.checked = true;
                                        document.form1.europe.checked = true;
                                        document.form1.africa.checked = true;
                                        document.form1.asia.checked = true;
                                    }
                                }

                            </script>
                            </body>
                            </html>
