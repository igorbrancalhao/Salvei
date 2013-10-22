<?php
/***************************************************************************
*File Name				:find_member.tpl
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
?>

<?php
$member=$_REQUEST[txtFindid];
if(!empty($member))
{	
$user_sql="select * from user_registration where (user_name like \"%$member%\" or email='$member') and status='active'";
$user_res=mysql_query($user_sql);
}
?>

<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;Find Member</div></b></font></td></tr>
    <tr>
        <td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 

                <tr>
                    <td align="left" height=30 valign="top">
                        <form name="sell" action="find_member.php" method="post">
                            <table cellspacing="0" cellpadding="5" width="100%" align="left">
                                <tr align="left">&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="text" name=txtFindid >&nbsp;&nbsp;

                                <input type="image" src="images/findmember.jpg" name="Image89" width="119" height="23" border="0" id="Image89" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image89', '', 'images/findmembero.jpg', 1)" value="Find Member"/>
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;<font class="detail9txt">Enter the Username or email address of the member you would like to find. </font>
                                <td> </td>
                                </tr>
                            </table></form></td></tr>
                <tr><td>&nbsp; </td></tr>

                <tr><td>
                        <table cellpadding="5" cellspacing="2" width=100%>
                            <?php
                            if($user_res)
                            {
                            ?>
                            <tr bgcolor=#DEDEDE><td class="detail9txt"><b>Username</b></td>
                                <td class="detail9txt"><b>Location</b></td><td class="detail9txt"><b>Stores</b></td>
                                <td class="detail9txt"><b>Seller's Items</b></td></tr>
                            <?php
                            $c=0;  

                            while($user=mysql_fetch_array($user_res))
                            {
                            $feed_sql="select count(*) as feedbacktotal from feedback where feedback_to=".$user['user_id']." and feedback_type='Positive'";
                            $feed_recordset=mysql_query($feed_sql);
                            $feed_tot=mysql_fetch_array($feed_recordset);
                            $feedbackicon_sql="select * from membership_level where feedback_score_from <= "." $feed_tot[feedbacktotal] "." and  feedback_score_to >= "." $feed_tot[feedbacktotal] " ;
                            $feedbackicon_res=mysql_query($feedbackicon_sql);
                            $feedbackicon_row=mysql_fetch_array($feedbackicon_res); 
                            $feedback_img=$feedbackicon_row[icon];


                            $country_sql="select * from country_master where country_id=".$user['country'];
                            $country_res=mysql_query($country_sql);
                            $country=mysql_fetch_array($country_res);


                            // check sellers others item

                            $sql="select count(*) from placing_item_bid where status='Active' and selling_method!='want_it_now' and bid_starting_date <= now() and expire_date>=now() and user_id=".$user['user_id'];
                            $res=mysql_query($sql);
                            $rowcount=mysql_fetch_array($res);
                            // $rowcount[0];

                            $store_sql="select * from storefronts where user_id=".$user['user_id'];
                            $store_res=mysql_query($store_sql);
                            $store_row=mysql_fetch_array($store_res);
                            $store_tot=mysql_num_rows($store_res);
                            if($c==0)
                            {
                            $c=1;
                            ?>
                            <tr class="tr_color_1">  
                                <?php
                                }
                                else
                                {
                                ?>
                            <tr class="tr_color_2">
                                <?php 
                                $c=0;
                                }
                                ?>
                                <td>
                                    <a href="feedback.php?user_id=<?php echo $user['user_id'];?>" class="header_text">
                                        <?php echo $user['user_name'];?></a>
                                    <?php 
                                    if($feed_tot[feedbacktotal]!=0)
                                    {
                                    ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;( <a href="feedback.php?user_id=<?php echo $user['user_id'];?>" class="header_text"><?php echo $feed_tot[feedbacktotal]; ?></a><img src="images/<?php echo  $feedback_img ?>"/>)
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="detail9txt"><?php echo  $country[country]; ?></td>

                                <td>
                                    <?php
                                    if(!empty($store_tot))
                                    {
                                    ?>
                                    <a href="store.php?id=<?php echo $user['user_id']; ?>" class="header_text"><?php echo  $store_row[store_name] ?> </a>
                                    <?php
                                    }
                                    else
                                    {
                                    echo "-";
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    if(!empty($rowcount[0]))
                                    {
                                    ?>
                                    <a href="search.php?seller_id=<?php echo $user['user_id']; ?>&mode=sellers_item" class="header_text">seller's items</a>
                                    <?php
                                    }
                                    else
                                    echo "-";
                                    ?>
                                </td>

                            </tr>
                            <?php
                            }
                            }
                            else
                            {
                            ?>
                            <tr><td align="center">
                                    <font class="errormsg">Please enter a user name.</font>
                                </td></tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td></tr>

        </td></tr></table>
</td></tr></table>

