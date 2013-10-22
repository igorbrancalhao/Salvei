<link href="style/style.css" rel="stylesheet" type="text/css" />

<table width="100%" border="0" cellpadding="5" cellspacing="2" align="center">
    <tr>
        <td valign="top">
            <?php 
            $title="Better Things Better Price";
            require 'include/detail_top.php';
            ?>
        </td>
    </tr>
    <link href="<?php= $ret1; ?>" rel="stylesheet" type="text/css">

    <?php
    if($flag==1)
    {
    ?>

    <tr><td valign="top">
            <table border="0" align="center" cellpadding="3" cellspacing="0" width="100%">
                <tr height=30>
                    <td  ><font size="3" color="#000000"><b>Dispute Opened: Notice Sent</b>
                        </font> </td></tr>
                <tr><td><table border="0" align="center" cellpadding="3" cellspacing="0" width="100%" class="table_topless_border">
                            <tr><td><br /></td></tr>

                            <tr height=30><td>
                                    Your dispute has been sent to the appropriate party. They�ve been alerted to the problem and given 10 days to respond. Once they respond, you will be able to communicate further about how best to resolve this dispute
                                </td></tr></table></td></tr>
                <tr><td><br /></td></tr>
                <tr><td> <?php require 'include/footer.php'; ?></td></tr>
                <?php
                exit();
                }
                ?>
                <?php
                if($res_success==1)
                {?>
                <tr><td valign="top" class="table_topless_border">
                        <table border="0" align="center" cellpadding="3" cellspacing="0" width="100%" >
                            <tr height=30>
                                <td  ><font size="3" color="#000000"><b>Dispute Opened: Notice Sent</b>
                                    </font> </td></tr>
                            <tr><td style="padding-left:5px" >
                                    <b>Transaction:</b> <?php= $sell[item_title] ?> (#<?php= $bid[item_id] ?>) sold by <?php= $user[user_name] ?> on
                                    <?php
                                    $custom_date=explode(" ",$bid_date);
                                    $custom_date1=$custom_date[0];
                                    $custom_time=$custom_date[1];
                                    $custom_date3=substr($custom_date1,"-2");
                                    $custom_date2=explode("-",$custom_date1);
                                    $custom_date1=$custom_date2[0];
                                    $custom_date2=$custom_date2[1];
                                    $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
                                    echo  $custom_date4;
                                    ?> .</td></tr> 
                            <tr><td style="padding-left:10px"><b> Dispute Status: </b>
                                    Other's Party action Needed
                                </td></tr> 
                            <tr><td style="padding-left:10px">
                                    Your response has been entered successfully.we will inform the seller that their response is needed.

                                </td></tr>
                            <tr><td><hr></td></tr>
                            <tr><td style="padding-left:10px"> <b> Where would you like to go? </b></td></tr>
                            <tr><td style="padding-left:20px"> <a href="viewdispute.php">View Dispute Console</a></td></tr>
                            <tr><td style="padding-left:20px"> <a href="myauction.php">My Auction</a></td></tr>
                    </td></tr> 
            </table>
    <tr><td> <?php require 'include/footer.php'; ?></td></tr>
    <?php
    exit();
    }
    ?>


    <tr><td valign="top">
            <table border="0" align="center" cellpadding="3" cellspacing="0" width="100%"  class="table_topless_border">
                <tr height=30>
                    <td  ><font size="3" color="#000000"><b>Open Dispute : Review & Submit</b>
                        </font> </td></tr>
                <tr><td style="padding-left:5px" > <b>Transaction:</b> <?php= $sell[item_title] ?> (#<?php= $bid[item_id] ?>) sold by <?php= $user[user_name] ?> on
                        <?php
                        $custom_date=explode(" ",$bid_date);
                        $custom_date1=$custom_date[0];
                        $custom_time=$custom_date[1];
                        $custom_date3=substr($custom_date1,"-2");
                        $custom_date2=explode("-",$custom_date1);
                        $custom_date1=$custom_date2[0];
                        $custom_date2=$custom_date2[1];
                        $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
                        echo  $custom_date4;
                        ?> .</td></tr>

                <tr><td style="padding-left:10px"> 
                        We've included the information you provided in the message below. Please review it for accuracy and if you'd like to make a change, click Edit Message.  
                    </td></tr>

                <tr><td style="padding-left:10px">  
                        Once you click Submit Dispute, <?php=$_SESSION[site_name]?> will share this information with the appropriate party. They will be alerted to the problem and given 10 days to respond. Once they respond, you will be able to communicate further about how best to resolve this dispute.   
                    </td></tr>
                <tr><td style="padding-left:10px">
                        <table cellpadding="0" cellspacing="0" border="0" width=100% class="table_border1">

                            <tr><td valign="top"  style="padding-left:10px" ><font size="2" color="#CC99FF"><b>
                                        <?php= $_SESSION[username]  ?></b></font>
                                </td></tr>


                            <tr><td style="padding-left:10px">
                                    <?php
                                    if($_SESSION[DisputeReason]=="I have not received the item")
                                    {
                                    ?>
                                    Item Not Received
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    Item Significantly Not As Described:
                                    <?php
                                    }
                                    ?>  <?php= $sell[item_title] ?> (#<?php= $bid[item_id] ?>) </td></tr>
                            <tr><td style="padding-left:10px">Payment Method:<?php= $paymentgateway  ?> </td></tr>
                            <tr><td style="padding-left:10px">Payment Date:<?php= $_SESSION[dis_payment_date]  ?> </td></tr>
                            <tr><td style="padding-left:10px">Additional Details:<?php= $_SESSION[Dispute_addttional_inf]  ?> </td></tr>
                        </table>
                    </td></tr>
                <tr><td style="padding-left:10px">
                        <form name="form1" action="reviewdispute.php"  method=post>
                            <input type="hidden" name="flag" value="1">
                            <input type="submit" value="Submit Dispute"> &nbsp;<a href="disputedescription.php?bid_id=<?php= $_SESSION[dispute_bid_id] ?>">Edit Message </a>
                        </form>
                    </td></tr>

            </table>
        </td></tr>
