<?php
/* * *************************************************************************
 * File Name				:choose_sell_format.php
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
require 'include/top.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
    <body>
        <?php
        $mode = $_GET[mode];
        $item_id = $_GET[itemid];
        $user_id = $_SESSION[user_id];
        /* $mem_sql="select * from user_registration where user_id=$_SESSION[userid]";
          $mem_res=mysql_query($mem_sql);
          $mem_rows=mysql_fetch_array($mem_res);
          if($mem_rows[member_account]==1)
          {
          $no_of_post=3;
          $member="Basic Or Superior";
          }
          else if($mem_rows[member_account]==2)
          {
          $no_of_post=50;
          $member="Superior";
          }
          $no_of_posted="select * from placing_item_bid where user_id=$_SESSION[userid] and status='Active'";
          $no_of_res=mysql_query($no_of_posted);
          $no_of_rows=mysql_num_rows($no_of_res);
         */
        ?>
    <!--  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="table_border">
      <tr>
        <td valign="top">
        <?php
        // $title="Sell";
        // require 'include/top.php';
        ?>
            </td>
      </tr>
     <link rel="stylesheet" type="text/css" href="<?php = $ret1; ?>"> -->


        <?php
        /* if($no_of_rows > $no_of_post)
          {
          ?>
          <tr align="center">
          <td valign="top">
          <br>
          <br>
          <br>
          <table cellpadding="5" width="70%" class="table_border1">
          <th class="mylist">Warning</th>
          <tr><td><font color="red">
          <?php echo "Sorry! You Have Already Posted $no_of_rows items.If You Want to Post More Items Please Choose $member Account Membership.";?>
          </font>
          </td></tr></table>
          <br><br><br>
          </td></tr>
          <tr><td> <?php require 'include/footer.php'; ?></td></tr>
          <?php
          exit();

          } */
        ?> 
        <table width="95%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
            <tr><td>
            <!-- <tr><td valign="top"> -->
                    <table border="0" align="center" cellpadding="3" cellspacing="3" width="95%" class="border2">
                        <tr> 
                            <td colspan=3 align="center" bgcolor="#CCCCCC" class="style1" height="35">
                                <font size=+1 color="#000000" ><b><center><br>Choose Sell Format</center></b></font></td>
                        </tr>
                        <form name="sell" action="sell_item_cate.php" method="post">
                            <tr bgcolor="#eeeee1">
                                <td>

                                    &nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="1" name=sell_format checked></td><td colspan="2"> <b> Sell item at online Auction</b>

                                </td></tr>

                            <tr bgcolor="#eeeee1">
                                <td>
                                    &nbsp;&nbsp;&nbsp; <input type="radio" value="2" name=sell_format></td><td colspan="2"> <b> Sell item at Dutch Auction</b>
                                    <br>Allows bidding on your items.<!-- <a href="#" onclick="window.open('auction_help.php?help=2','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')">Learn more</a>. -->
                                </td>
                            </tr>
                            <tr bgcolor="#eeeee1"><td>
                                    &nbsp;&nbsp;&nbsp;  <input type="radio" value="3" name=sell_format></td><td colspan="2"> <b>Fixed Price Sale</b>
                                    <br>  
                                    Allows buyers to purchase your item at a price you set.
                                    <!--  <a href="#" onclick="window.open('auction_help.php?help=3','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')">Learn 
                        more</a>. --> </td>
                            </tr> 
                            <?php /* if($mem_rows[member_account]!=1)
                              { */ ?>
                            <tr bgcolor="#eeeee1"><td>
                                    &nbsp;&nbsp;&nbsp; <input type="radio" value="4" name=sell_format> </td><td colspan="2"><b>Classified Ads</b>
                                    <br>
                                    Allows advertising on your Item .You can list your asking price. No bidding takes place.
                                    <!--  <a href="#" onclick="window.open('auction_help.php?help=4','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')">Learn more</a>. -->
                                </td>
                            </tr>
                            <?php
// }
                            ?>

                            <tr bgcolor="#eeeee1"><td colspan="3"> <br> </td></tr>
                            <tr align="center" colspan=3 bgcolor="#eeeee1"><td colspan="3">
                                    <input type=hidden value="<?php = $user_id; ?>" name=user_id>
                                    <input type=hidden value="<?php = $item_id; ?>" name=item_id>
                                    <input type=hidden value="<?php = $mode; ?>" name=mode>
                                    <input type="submit" value="Continue">
                                </td></tr>
                        </form>
                    </table>
                    <?php require 'include/footer1.php'; ?>
        </table> 
