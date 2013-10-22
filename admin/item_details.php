<?php
/* * *************************************************************************
 * File Name				:item_detail.php
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
//if(strlen($_SESSION['adminuser'])==0) {
//echo '<meta http-equiv="refresh" content="0;url=index.php">';
//exit();
//}
require 'include/connect.php';
require 'include/top.php';
$item_name = $_GET['item_name'];
//$pib_row['selling_method']=$_GET['val'];
$id = $_GET['id'];
$photo = array();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
    <body>
        <link href="include/style.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            <!--
            .style1 {
                color: #666666;
                font-weight: bold;
            }
            .style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
            -->
        </style>

        <?php
        $pib_sql = "select * from placing_item_bid where item_id='$id'";
        $pib_res = mysql_query($pib_sql);
        $pib_row = mysql_fetch_array($pib_res);
        ?>
        <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
            <tr><td> 
                    <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="51%">
                                <table width="380" cellpadding="5" cellspacing="2" class=border2 align="center"><br>
                                    <tr bgcolor="#CCCCCC"><td width="15">&nbsp;</td>
                                        <td width="191"  class="tddis">Item Name</td>
                                        <td width="169">
                                            <?php echo $pib_row['item_title']; ?>
                                        </td>
                                    </tr>

                                    <tr bgcolor="#eeeee1"><td width="15">&nbsp;</td>
                                        <td width="191"  class="tddis">Detailed Description</td>
                                        <td width="169">
                                            <textarea rows="5" readonly="readonly"><?php echo $pib_row['detailed_descrip'];
                                            ?>
                                            </textarea>
                                        </td>
                                    </tr>
                                    <?php
                                    if ($pib_row['selling_method'] == 'auction' or $pib_row['selling_method'] == 'dutch_auction') {
                                        ?>

                                        <tr bgcolor="#eeeee1"><td width="15">&nbsp;</td><td bgcolor="#eeeee1"><b>Bid </b></td><td></td></tr>
                                        <tr bgcolor="#eeeee1"><td width="15">&nbsp;</td>
                                            <td width="191"  class="tddis">Minimum Amount</td>
                                            <td width="169">
                                                <?php
                                                echo $pib_row['currency'] . " ";
                                                echo $pib_row['min_bid_amount'];
                                                ?>
                                            </td>
                                        </tr>

                                        <tr bgcolor="#eeeee1"><td width="15">&nbsp;</td>
                                            <td width="191"  class="tddis">Increment</td>
                                            <td width="169">
                                                <?php echo $pib_row['bid_increment']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } else if ($pib_row['selling_method'] == 'fix' or $pib_row['selling_method'] == 'ads') {
                                        ?>
                                        <tr bgcolor="#eeeee1"><td width="15">&nbsp;</td><td><b>Fixed Price Sale</b></td><td></td></tr>
                                        <tr bgcolor="#eeeee1"><td width="15">&nbsp;</td><td >Fixed Amount</td><td><?php
                                                echo $pib_row['currency'];
                                                echo $pib_row['quick_buy_price'];
                                                ?></td></tr>
                                        <?php
                                    }
                                    ?>

                                    <tr bgcolor="#eeeee1"><td width="15">&nbsp;</td>
                                        <td><b>Shipping Details and Other Price</b></td>
                                        <td></td></tr>
                                    <tr bgcolor="#eeeee1"><td width="15">&nbsp;</td>
                                        <td width="191">Shipping Amount</td>
                                        <td width="169">
                                            <?php
                                            echo $pib_row['currency'] . " ";
                                            echo $pib_row['shipping_cost'];
                                            ?>
                                        </td>
                                    </tr>
                                    <tr bgcolor="#eeeee1"><td width="5%">&nbsp;</td>
                                        <td width="231"  class="tddis">Shipping Location</td>
                                        <td width="261">
                                            <?php
                                            if (!empty($pib_row['shipping_route'])) {
                                                $sql = 'select * from shipping_location where ship_id=' . $pib_row['shipping_route'];
                                                $res = mysql_query($sql);
                                                $row = mysql_fetch_array($res);
                                                $location = $row[location];
                                                echo $location;
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php if ($pib_row['selling_method'] == 'auction' or $pib_row['selling_method'] == 'dutch_auction') {
                                        ?>
                                        <tr bgcolor="#eeeee1" ><td width="15">&nbsp;</td>
                                            <td width="191"  class="tddis">Reserve Price</td>
                                            <td width="169">
                                                <?php echo $pib_row['currency'] . " " . $pib_row['reserve_price']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } if ($pib_row['selling_method'] == 'fix' or $pib_row['selling_method'] == 'ads') {
                                        ?>
                                        <tr bgcolor="#eeeee1"><td width="15">&nbsp;</td>
                                            <td width="191"  class="tddis">Quick Buy Price</td>
                                            <td width="169">
                                                <?php echo $pib_row['currency'] . " " . $pib_row['quick_buy_price']; ?>
                                            </td>
                                        </tr><?php } ?>
                                </table>
                            </td>
                            <td width="48%" valign="top"><br>
                                <table width="350" class="border2" cellpadding="5" cellspacing="2" align="center">
                                    <tr valign="top" bgcolor="#CCCCCC"><td width="5%">&nbsp;</td>
                                        <td width="51%" class="tddis"><b>Number of Visitors</b></td><td></td>
                                    </tr>
                                    <tr  bgcolor="#eeeee1"><td width="5%">&nbsp;</td>
                                        <td  class="tddis"  >Number of Visitors</td>
                                        <td width="44%">
                                            <?php echo $pib_row['clicks']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $photo[1] = $pib_row['picture1'];
                                    $photo[2] = $pib_row['picture2'];
                                    $photo[3] = $pib_row['picture3'];
                                    $photo[4] = $pib_row['picture4'];
                                    $photo[5] = $pib_row['picture5'];
                                    ?>
                                    <tr  bgcolor="#eeeee1"><td width="5%">&nbsp;</td>
                                        <td  class="tddis"><b>Images</b></td><td></td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($photo[$i] != '') {
                                            $picture_found = 1;
                                            ?> 
                                            <tr bgcolor="#eeeee1"><td width="5%">&nbsp;</td>
                                                <td>picture <?php echo $i; ?></td><td>

                                                    <a href="#" id="dislink" onClick="window.open('full_size_image.php?img=<?php = $photo[$i]; ?>', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')">
                                                        <img src="../images/<?php echo $photo[$i]; ?>" width="40" height="40" border=0></a></td></tr>
                                            <?php
                                        } else if ($picture_found != 1) {
                                            $no_photo = 1;
                                        }
                                    }
                                    if ($no_photo == 1) {
                                        echo "<tr bgcolor=#eeeee1><td colspan=3 align=center >No Pictures Found</td></tr>";
                                    }
                                    ?>
                                </table></td>
                        </tr>
                        <tr>
                            <td><table width="380" class="border2" align="center">
                                    <tr  bgcolor="#CCCCCC"> <td width="5%">&nbsp;</td> <td><b>Auction Details</b></td><td></td></tr>
                                    <tr  bgcolor="#eeeee1"><td width="5%">&nbsp;</td>
                                        <td width="231"  class="tddis">Started </td>
                                        <td width="261">
                                            <?php echo $pib_row['bid_starting_date']; ?>
                                        </td>
                                    </tr>
                                    <tr bgcolor="#eeeee1"><td width="5%">&nbsp;</td>
                                        <td  class="tddis">Closed </td>
                                        <td>
                                            <?php echo $pib_row['expire_date']; ?>
                                        </td>
                                    </tr>
                                    <tr  bgcolor="#eeeee1"><td width="1%">&nbsp;</td>
                                        <td width="231"  class="tddis">Duration</td>
                                        <td width="261"> <?php echo $pib_row['duration']; ?> Days </td>
                                    </tr>
                                    <tr bgcolor="#eeeee1"><td width="5%">&nbsp;</td>
                                        <td  class="tddis">Status</td>
                                        <td>
                                            <?php echo $pib_row['status']; ?>
                                        </td>
                                    </tr>
                                    <tr  bgcolor="#eeeee1"><td width="5%">&nbsp;</td>
                                        <td ><b>Sold Details</b></td><td></td></tr>
                                    <tr  bgcolor="#eeeee1"><td width="1%">&nbsp;</td>
                                        <td  class="tddis">Total  Quantity</td>
                                        <td>
                                            <?php echo $pib_row['Quantity']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $bid = "select * from placing_bid_item where item_id=$id";
                                    $bid_res = mysql_query($bid);
                                    $bid_row = mysql_fetch_array($bid_res);
                                    ?>
                                    <tr bgcolor="#eeeee1"><td width="1%">&nbsp;</td>
                                        <td  class="tddis">Quantity Sold </td>
                                        <td>
                                            <?php
                                            if (!empty($bid_row['quantity_sold'])) {
                                                echo $bid_row['quantity_sold'];
                                            } else
                                                echo "-"
                                                ?>
                                        </td>
                                    </tr>
                                  <!--   <tr><td width="5%">&nbsp;</td>
                                      <td  class="tddis">Payment Gateway </td>
                                      <td>
                                    <?php /* $pay="select * from payment_gateway where gateway_id=".$pib_row['payment_gateway']; 
                                      $pay_res=mysql_query($pay);
                                      $pay_row=mysql_fetch_array($pay_res);
                                      if(!empty($pay_row['payment_gateway']))
                                      {
                                      echo $pay_row['payment_gateway'];
                                      }
                                      else
                                      {
                                      echo "-"; }
                                      ?>
                                      </td>
                                      </tr>
                                      <?php
                                      if($pay_row['payment_gateway']!='')
                                      {  ?>

                                      <tr><td width="5%">&nbsp;</td><td>Payment Id</td><td><?php  echo $pib_row['payment_id']; ?></td></tr>
                                      <tr><td width="5%">&nbsp;</td><td>Payment Name</td><td><?php  echo $pib_row['payment_name']; ?></td></tr>
                                      <?php } */
                                    ?>  
                                     <tr><td width="5%">&nbsp;</td>
                                     <td width="231"  class="tddis"> Method</td>
                                      <td width="261">
                                    <?php echo $pib_row['selling_method']; ?>
                                      </td>
                                    </tr> -->

                                </table></td>
                            <td valign="top">
                                <table width="360" class="border2" align="center">
                                    <?php
                                    $fea_sql = "select * from featured_items where item_id=" . $id;
                                    $fea_res = mysql_query($fea_sql);
                                    $fea_total = mysql_num_rows($fea_res);
                                    if ($fea_total > 0) {
                                        $fea_row = mysql_fetch_array($fea_res);
                                        $gallery = $fea_row['gallery_feature'];
                                        $bold = $fea_row['bold'];
                                        $home = $fea_row['home_feature'];
                                        $border = $fea_row['border'];
                                        $highlight = $fea_row['highlight'];
                                        $subtitle_fea = $fea_row['subtitle_feature'];
                                        $subtitle = $fea_row['subtitle'];
                                    }
                                    ?>
                                    <tr bgcolor="#CCCCCC"><td width="5%">&nbsp;</td><td width="52%" class="tddis"><b>Item Visibility</b></td><td></td></tr>
                                    <tr  bgcolor="#eeeee1"><td width="5%">&nbsp;</td><td>Gallery Featured</td><td width="43%"> &nbsp;<?php
                                            if ($gallery == 'Yes')
                                                echo "Yes";
                                            else
                                                echo "No";
                                            ?></td></tr>
                                    <tr bgcolor="#eeeee1"><td width="5%">&nbsp;</td><td>Bold</td><td><?php
                                            if ($bold == 'Yes')
                                                echo "Yes";
                                            else
                                                echo "No";
                                            ?>
                                        </td></tr>
                                    <tr bgcolor="#eeeee1"><td width="5%">&nbsp;</td>
                                        <td>Home Featured</td>
                                        <td><?php
                                            if ($home == 'Yes')
                                                echo "Yes";
                                            else
                                                echo "No";
                                            ?>
                                        </td></tr>
                                    <tr bgcolor="#eeeee1"><td width="5%">&nbsp;</td><td>Border</td><td><?php
                                            if ($border == 'Yes')
                                                echo "Yes";
                                            else
                                                echo "No";
                                            ?>
                                        </td></tr>
                                    <tr bgcolor="#eeeee1"><td width="5%">&nbsp;</td><td>High Light</td><td><?php
                                            if ($highlight == 'Yes')
                                                echo "Yes";
                                            else
                                                echo "No";
                                            ?></td></tr>
                                    <tr bgcolor="#eeeee1"><td width="5%">&nbsp;</td><td>Subtitle Featured</td><td><?php
                                            if ($subtitle_fea == 'Yes')
                                                echo "Yes";
                                            else
                                                echo "No";
                                            ?></td></tr>
                                    <?php
                                    if ($subtitle != '') {
                                        ?>
                                        <tr bgcolor="#eeeee1" ><td width="5%">&nbsp;</td><td>Subtitle</td><td><?php echo $subtitle; ?></td></tr>
                                    <?php } ?>
                                    <tr bgcolor="#eeeee1">
                                </table></td>
                        </tr>
                    </table></td></tr></table>
        <?php
        require 'include/footer.php';
        ?>
    </body>
</html>
