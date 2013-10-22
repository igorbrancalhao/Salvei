<?php
/***************************************************************************
*File Name				:viewdispute.tpl
*File Created				:Wednesday, June 21, 2006
* File Last Modified			:Wednesday, June 21, 2006
* Copyright				:(C) 2001 AJ Square Inc
* Email				:licence@ajsquare.net
* Software Language			:PHP
* Version Created			:V 4.3.2
* Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
* $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
*
***************************************************************************/


/****************************************************************************

*      Licence Agreement: 

*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.

*****************************************************************************/
$title="Details of item";
$site_admin="select * from admin_settings where set_id=47";
$site_admin_res=mysql_query($site_admin);
$site_admin_row=mysql_fetch_array($site_admin_res);
$fromid=$site_admin_row[set_value];
?>
<table cellpadding="0" cellspacing="0" width=100% border="0">
    <tr height=35>
        <td width=2 valign="top" id="myauctionleft">
            <?php require 'include/my_list.php';?>
        </td>
        <td width=500 align="left" valign="top">
            <table cellspacing="0" cellpadding="0" border="0" width=600>


                <!------ Inbox ------------------------------>
                <?php
                $type=$_REQUEST[type];
                if($type=="unpaid")
                { 
                ?>
                <tr>
                    <td width="551" class="myauction_bg" colspan="2">Dispute Console</td>
                </tr>
                <tr><td><table width="545" cellpadding="0" cellspacing="0" class="superbg">
                            <tr><td>
                                    <A class="header_text" href="viewdispute.php?type=unpaid">Unpaid Items</A></FONT> &nbsp;&nbsp;&nbsp;
                                    <A class="header_text" href="viewdispute.php?type=notreceived">Items Not Received</A> 
                                </td></tr>
                            <?php
                            $user_sql="select * from user_registration where user_id=".$_SESSION[userid];
                            $user_qry=mysql_query($user_sql);
                            $user_row=mysql_fetch_array($user_qry);
                            if($user_row[status]=="suspended")
                            {
                            ?>
                            <tr><td>
                                    <table cellpadding="0" cellspacing="0" width="545">
                                        <tr><td class="detail9txt" align="center"><font color="#FF0000">Sorry your account is suspended.</font></td></tr>
                                    </table></td></tr>
                            <?php
                            }
                            else
                            {
                            ?>
                            <tr><td>
                                    <table cellpadding="0" cellspacing="0">
                                        <tr><td height=30 width=545 id=watchingdetails>
                                                <table cellpadding="5" cellspacing="2" width=545>
                                                    <tr >
                                                        <td align="left" class="banner1"><b>&nbsp;&nbsp;Unpaid Items :&nbsp;&nbsp;&nbsp;</b>( 
                                                            <?php if($dispute_total_records == 1 ) { echo "$dispute_total_records"."&nbsp;".Items; } else if($dispute_total_records > 1)
                                                            { echo "$dispute_total_records"."&nbsp;".Dispute; } else echo "No Dispute";?> )</td>
                                                        <td align="right" width=10 colspan="2">
                                                            <a href="viewdispute.php?type=unpaid" class="header_text" style="padding-left:0px;">
                                                                Refresh
                                                            </a></td></tr></table>
                                            </td></tr>
                                        <tr>
                                            <td>
                                                <table width="100%" cellpadding="5" cellspacing="0" >
                                                    <?php
                                                    if($dispute_total_records > 0)
                                                    { 
                                                    ?>
                                                    <form name="dispute_form" action="viewdispute.php" method=post>
                                                        <tr bgcolor="#B8DEEE" class="detail9txt">
                                                        <input type="hidden" name="len" value="<?php echo  $dispute_total_records?>">
                                                        <input type="hidden" name="type" value="<?php echo  $type ?>">
                                                        <td width="27%" ><font class="detail9txt"><b>Dispute opened on</b></font> </td>
                                                        <td colspan="4"><font class="detail9txt"><b>Other's party Ids</b></font> </td>
                                                        <td width="21%"   ><font class="detail9txt"><b>Credit Eligibility</b></font>  </td>
                                                        <td width="34%"  ><font class="detail9txt"><b>Dispute Status </b> </font> </td>
                                                        </tr>
                                                        <?php
                                                        /* echo "<br>";
                                                        echo "test"."$dispute_sql";
                                                        echo "<br>"; */
                                                        $dispute_res=mysql_query($dispute_sql);
                                                        while($dispute_row=mysql_fetch_array($dispute_res))
                                                        {

                                                        if($dispute_row['distute_bid_id'])
                                                        {

                                                        $bid_sql="select * from placing_bid_item where bid_id=".$dispute_row['distute_bid_id'];
                                                        $bid_res=mysql_query($bid_sql);
                                                        $bid=mysql_fetch_array($bid_res);

                                                        if($bid[user_id]!=$userid)
                                                        {
                                                        $user_sql="select * from user_registration where user_id=".$bid['user_id'];
                                                        $user_res=mysql_query($user_sql);
                                                        $user=mysql_fetch_array($user_res);
                                                        $disputed_by="buyer";
                                                        }
                                                        else
                                                        {
                                                        $bid_sql="select * from placing_bid_item where bid_id=".$dispute_row['distute_bid_id'];
                                                        $bid_res=mysql_query($bid_sql);
                                                        $bid=mysql_fetch_array($bid_res);

                                                        $bid_sql="select * from placing_item_bid where item_id=".$bid['item_id'];
                                                        $bid_res=mysql_query($bid_sql);
                                                        $bid=mysql_fetch_array($bid_res);

                                                        if($bid['user_id'])
                                                        {
                                                        $user_sql="select * from user_registration where user_id=".$bid['user_id'];
                                                        $user_res=mysql_query($user_sql);
                                                        $user=mysql_fetch_array($user_res);
                                                        }
                                                        $disputed_by="seller";

                                                        }

                                                        $det_sql="select * from placing_item_bid where item_id=".$bid['item_id'];
                                                        $det_res=mysql_query($det_sql);
                                                        $det_row=mysql_fetch_array($det_res);

                                                        }
                                                        ?>
                                                        <tr class="detail9txt">
                                                            <td class="tr_botborder">
                                                                <?php
                                                                $custom_date=explode(" ",$dispute_row[dispute_date]);
                                                                $custom_date1=$custom_date[0];
                                                                $custom_time=$custom_date[1];
                                                                $custom_date3=substr($custom_date1,"-2");
                                                                $custom_date2=explode("-",$custom_date1);
                                                                $custom_date1=$custom_date2[0];
                                                                $custom_date2=$custom_date2[1];
                                                                $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
                                                                ?>
                                                                <font class="detail9txt">
                                                                <?phpecho  $custom_date[0];
                                                                ?>
                                                                </font>
                                                            </td>
                                                            <td width="14%" class="tr_botborder">

                                                                <a href="feedback.php?user_id=<?php echo $user['user_id'];?>" class="header_text" >
                                                                    <?php  if($user['user_name'])  echo $user['user_name']; ?>
                                                                </a></td>
                                                            <td class="tr_botborder" colspan="4" style="padding-left:50px">
                                                                <?php
                                                                if($disputed_by=="buyer")
                                                                {
                                                                $imag_flag="check(29).gif";
                                                                if($dispute_row[dispute_status]=="open")
                                                                {
                                                                $imag_flag="check(29).gif";
                                                                }
                                                                else if($dispute_row[dispute_close_status]=="granted")
                                                                {
                                                                $imag_flag="checkout_arrow.gif";
                                                                }
                                                                else if($dispute_row[dispute_close_status]=="eligible")
                                                                {
                                                                $imag_flag="check(359).gif";
                                                                }
                                                                if($dispute_row[dispute_close_status]!="notapplicable")
                                                                {
                                                                if(!empty($imag_flag))
                                                                {
                                                                ?>
                                                                <img src="images/<?php echo  $imag_flag ?>" >
                                                                <?php
                                                                }
                                                                }
                                                                else
                                                                {
                                                                echo $img_flag="--";
                                                                }
                                                                }
                                                                else
                                                                echo $img_flag="--";
                                                                ?>

                                                            </td><td class="tr_botborder">&nbsp;
                                                                <?php
                                                                if($dispute_row['dispute_status']!="closed")
                                                                {
                                                                ?>

                                                                <font class="detail9txt">
                                                                Your Action Needed
                                                                </font>

                                                                <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>

                                                        <tr class="detail9txt">
                                                            <td colspan=5 align="left"  class="tr_botborder">
                                                                <a href="<?php if($det_row[selling_method]!=ads) {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php echo  $bid['item_id']?>" class="header_text">
                                                                    <?php  echo $det_row['item_title']; ?></a>&nbsp;(<?php  echo $bid['item_id']; ?> )</td>
                                                            <td class="tr_botborder">&nbsp;</td> <td class="tr_botborder">
                                                                <?php
                                                                if($dispute_row['dispute_status']!="closed")
                                                                {
                                                                if($disputed_by=="buyer")
                                                                {
                                                                ?>
                                                                <a href="enterresponsetobuyer.php?bid_id=<?php echo  $dispute_row[distute_bid_id] ?>&dispute_id=<?php echo  $dispute_row[dispute_id] ?>" class="header_text">View dispute</a>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <a href="enterresponse.php?bid_id=<?php echo  $dispute_row[distute_bid_id] ?>&dispute_id=<?php echo  $dispute_row[dispute_id] ?>" class="header_text">View dispute</a>
                                                                <?php
                                                                }
                                                                }
                                                                else
                                                                echo "Dispute Closed";
                                                                ?></td> </tr>
                                                        <?php
                                                        } // while
                                                        ?>

                                                    </form>

                                                    <tr><td colspan="4" style="padding-left:5px" class="detail9txt"><b>Legend :</b><br />Final Value Fee credit eligibility: </td>
                                                        <td colspan="3" align="center" class="detail9txt">&nbsp;-- Not applicable &nbsp;<img src="images/check(29).gif">&nbsp;&nbsp;Pending&nbsp;<img src="images/check(359).gif">&nbsp;&nbsp;Eligible&nbsp;<img src="images/checkout_arrow.gif">&nbsp;&nbsp;Granted  </td>
                                                    </tr>
                                                    <tr> <td class="tr_botborder" colspan="7">&nbsp;</td> </tr>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <tr>
                                                        <td class="header_text" colspan=5 align="left">There are no dispute in this section</td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>

                                                </table>
                                            </td></tr>
                                    </table>

                                    <?php
                                    }
                                    }  // if($type=="in") 
                                    ?>

                                    <?php
                                    if($type=="notreceived")
                                    {
                                    ?>
                            <tr><td class="myauction_bg">Dispute Console</td></tr>
                            <tr><td><table class="superbg">
                                        <tr><td>
                                                <A class="header_text" href="viewdispute.php?type=unpaid">Unpaid Items</A> &nbsp;&nbsp;&nbsp;
                                                <A class="header_text" href="viewdispute.php?type=notreceived">Items Not Received </A> 
                                            </td></tr>
                                        <?php
                                        $user_sql="select * from user_registration where user_id=".$_SESSION[userid];
                                        $user_qry=mysql_query($user_sql);
                                        $user_row=mysql_fetch_array($user_qry);
                                        if($user_row[status]=="suspended")
                                        {
                                        ?>
                                        <tr><td>
                                                <table cellpadding="0" cellspacing="0" width="541">
                                                    <tr><td class="detail9txt" align="center"><font color="#FF0000">Sorry your account is suspended.</font></td></tr>
                                                </table></td></tr>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <tr><td>
                                                <table width="541" cellpadding="0" cellspacing="0">
                                                    <tr><td class="tr_border" height=30 width=541 id=watchingdetails >
                                                            <table cellpadding="5" cellspacing="2" width=541>
                                                                <tr >
                                                                    <td width="542" align="left" class="detail9txt"  ><b>&nbsp;&nbsp;Items Not Received or Not as Described :&nbsp;&nbsp;&nbsp;</b>( 
                                                                        <?php if($dispute_total_records == 1 ) { echo "$dispute_total_records"."&nbsp;".Items; } else if($dispute_total_records > 1)
                                                                        { echo "$dispute_total_records"."&nbsp;".Dispute; } else echo "No Dispute";?> )</td>
                                                                    <td align="right" width=46 colspan="2">
                                                                        <a href="viewdispute.php?type=notreceived" class="header_text">
                                                                            Refresh</a></td>
                                                                </tr></table>
                                                        </td></tr>
                                                    <tr>
                                                        <td>
                                                            <table width="97%" cellpadding="5" cellspacing="0" >
                                                                <?php
                                                                if($dispute_total_records > 0)
                                                                { 
                                                                ?>
                                                                <form name="dispute_form" action="viewdispute.php" method=post>
                                                                    <tr>
                                                                    <input type="hidden" name="len" value="<?php echo  $dispute_total_records?>">
                                                                    <input type="hidden" name="type" value="<?php echo  $type ?>">
                                                                    <td class="header_text" ><b>Dispute opened on</b> </td>
                                                                    <td class="header_text" colspan="4"><b>Other's party Ids</b> </td>
                                                                    <!-- <td  class="tr_botborder" ><b>Credit Eligibility</b>  </td> -->
                                                                    <td  class="header_text" colspan=2 ><b>Dispute Status </b>  </td>
                                                                    </tr>
                                                                    <?php
                                                                    $dispute_res=mysql_query($dispute_sql);
                                                                    while($dispute_row=mysql_fetch_array($dispute_res))
                                                                    {
                                                                    if($dispute_row['distute_bid_id'])
                                                                    {
                                                                    $bid_sql="select * from placing_bid_item where bid_id=".$dispute_row['distute_bid_id'];
                                                                    $bid_res=mysql_query($bid_sql);
                                                                    $bid=mysql_fetch_array($bid_res);
                                                                    if($bid[user_id]!=$userid)
                                                                    {
                                                                    $user_sql="select * from user_registration where user_id=".$bid['user_id'];
                                                                    $user_res=mysql_query($user_sql);
                                                                    $user=mysql_fetch_array($user_res);
                                                                    $disputed_by="buyer";

                                                                    $bid_sql="select * from placing_item_bid where item_id=".$bid['item_id'];
                                                                    $bid_res=mysql_query($bid_sql);
                                                                    $bid=mysql_fetch_array($bid_res);
                                                                    }
                                                                    else
                                                                    {
                                                                    $bid_sql="select * from placing_bid_item where bid_id=".$dispute_row['distute_bid_id'];
                                                                    $bid_res=mysql_query($bid_sql);
                                                                    $bid=mysql_fetch_array($bid_res);



                                                                    $bid_sql="select * from placing_item_bid where item_id=".$bid['item_id'];
                                                                    $bid_res=mysql_query($bid_sql);
                                                                    $bid=mysql_fetch_array($bid_res);

                                                                    $user_sql="select * from user_registration where user_id=".$bid['user_id'];
                                                                    $user_res=mysql_query($user_sql);
                                                                    $user=mysql_fetch_array($user_res);
                                                                    $disputed_by="seller";

                                                                    }
                                                                    }
                                                                    ?>
                                                                    <tr class="header_text">
                                                                        <td class="tr_botborder">
                                                                            <?php
                                                                            $custom_date=explode(" ",$dispute_row[dispute_date]);
                                                                            $custom_date1=$custom_date[0];
                                                                            $custom_time=$custom_date[1];
                                                                            $custom_date3=substr($custom_date1,"-2");
                                                                            $custom_date2=explode("-",$custom_date1);
                                                                            $custom_date1=$custom_date2[0];
                                                                            $custom_date2=$custom_date2[1];
                                                                            $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
                                                                            echo  $custom_date[0];
                                                                            ?>
                                                                        </td>
                                                                        <td class="tr_botborder" colspan="4">

                                                                            <a href="feedback.php?user_id=<?php echo $user['user_id'];?>" class="header_text" >
                                                                                <?php  if($user['user_name'])  echo $user['user_name']; ?>
                                                                            </a>



                                                                        </td>&nbsp;

                                                                        <?php
                                                                        if($dispute_row['dispute_status']!="closed")
                                                                        {
                                                                        ?>
                                                                        <td class="tr_botborder" colspan=2>
                                                                            Your Action Needed
                                                                        </td>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </tr>

                                                                    <tr class="detail9txt">
                                                                        <td colspan=5 align="left"  class="tr_botborder">&nbsp;
                                                                            <a href="<?php if($bid[selling_method]!=ads) {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php echo  $bid['item_id']?>" class="header_text">
                                                                                <?php  echo $bid['item_title']; ?></a>&nbsp;(<?php  echo $bid['item_id']; ?> )</td>
                                                                        <td class="tr_botborder">&nbsp;</td> <td class="tr_botborder">&nbsp;
                                                                            <?php
                                                                            //echo $disputed_by;
                                                                            if($dispute_row['dispute_status']!="closed")
                                                                            {
                                                                            if($disputed_by=="seller")
                                                                            {
                                                                            ?>
                                                                            <a href="enterresponsetoseller.php?bid_id=<?php echo  $dispute_row[distute_bid_id] ?>&dispute_id=<?php echo  $dispute_row[dispute_id] ?>" class="header_text">View dispute</a>
                                                                            <?php
                                                                            }
                                                                            else
                                                                            {
                                                                            ?>
                                                                            <a href="enterresnotreceived.php?bid_id=<?php echo  $dispute_row[distute_bid_id] ?>&dispute_id=<?php echo  $dispute_row[dispute_id] ?>" class="header_text">View dispute</a>
                                                                            <?php
                                                                            }
                                                                            }
                                                                            else
                                                                            echo "Dispute Closed";
                                                                            ?>
                                                                        </td></tr>
                                                                    <?php
                                                                    } // while
                                                                    ?>

                                                                </form>


                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <tr>
                                                                    <td class="detail9txt" colspan=5 align="left">There are no dispute in this section</td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                ?>

                                                            </table>
                                                        </td></tr>
                                                </table>
                                            </td></tr>

                                        <?php
                                        }
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                        </table></td>
                    <td valign="top" align="left">
                        <div id="myauctionright_right">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td  align="left"><img src="images/auctionadd.gif" alt="" width="160" height="550" /></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>


