<?php
/***************************************************************************
*File Name				:feedback.tpl
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
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;Member Profile ::&nbsp;<?php echo  $user[user_name];  ?> &nbsp; ( &nbsp;<?php echo  $feed_pos_tot[feedbacktotal]; ?>&nbsp;
                <img src="images/<?php echo  $feedback_img ?>"  align="top"> ) </div></b></font></td></tr>
    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 
                <tr height=40 >   
                    <td>
                        <table border=0 width="70%" align="center">
                            <tr><td class="detail9txt">
                                    <b> Total Feedback Received:</b>
                                </td><td align="left" class="detail8txt"><?php echo  $feed_tot[feedbacktotal]; ?></td>
                            </tr>
                            <tr><td class="detail9txt">
                                    <b> FeedBack Score:</b>
                                </td><td align="left" class="detail8txt"><?php echo  $feed_pos_tot[feedbacktotal]; ?></td>
                            </tr>
                            <tr><td class="detail9txt"><b>Positive Feedback %:</b></td><td align="left" class="detail8txt">
                                    <?php echo  round($positive_percentage); ?>%</td></tr>
                            <tr><td class="detail9txt">No. of positive feedback received:</td><td align="left" class="detail8txt"><?phpif(!empty($positive_tot[positive_total])){?><?php echo  $positive_tot[positive_total]; ?><?php}else { echo "-";}?></td></tr></table>
                    </td><td>
                        <table align="center"><tr height="30px"><td bgcolor="#d8ecff" class="detail9txt" align="center"><b>Recent Ratings</b></td></tr>
                            <tr><td>
                                    <table cellpadding="5" cellspacing="0">
                                        <tr class="tr_botborder"><td>&nbsp;</td><td class="detail9txt">Past <br>Month</td><td class="detail9txt"> Past <br> 6 months</td><td class="detail9txt">Past <br> 12 months</td></tr>
                                        <tr class="tr_botborder"><td><img src="images/iconPos_16x16.gif"></td><td class="detail9txt"><?phpif(!empty($pos_lastmon_record[pos_mon])){?><?php echo  $pos_lastmon_record[pos_mon]; ?><?php}else echo "-";?></td><td class="detail9txt"><?phpif(!empty($pos_last6_record[pos_6mon])){?><?php echo  $pos_last6_record[pos_6mon];?><?php}else echo "-";?></td><td class="detail9txt"><?phpif(!empty($pos_last12mon_record[pos_last12mon])){?><?php echo  $pos_last12mon_record[pos_last12mon]; ?><?php}else echo "-";?></td></tr>
                                        <tr class="tr_botborder"><td><img src="images/iconNeu_16x16.gif"></td><td class="detail9txt"><?phpif(!empty($neu_lastmon_record[neu_mon])){?><?php echo  $neu_lastmon_record[neu_mon]; ?><?php}else echo "-";?></td><td class="detail9txt"><?phpif(!empty($neu_last6_record[neu_6mon])){?><?php echo  $neu_last6_record[neu_6mon];?><?php}else echo "-";?></td><td class="detail9txt"><?phpif(!empty($neu_last12mon_record[neu_last12mon])){?><?php echo  $neu_last12mon_record[neu_last12mon]; ?><?php}else echo "-";?></td></tr>
                                        <tr><td><img src="images/iconNeg_16x16.gif"></td><td class="detail9txt"><?phpif(!empty($neg_lastmon_record[neg_mon])){?><?php echo  $neg_lastmon_record[neg_mon]; ?><?php}else echo "-";?></td><td class="detail9txt"><?phpif(!empty($neg_last6_record[neg_6mon])){?><?php echo  $neg_last6_record[neg_6mon];?><?php}else echo "-";?></td class="detail9txt">
                                            <td class="detail9txt"><?phpif(!empty($neg_last12mon_record[neg_last12mon])){?><?php echo  $neg_last12mon_record[neg_last12mon]; ?><?php}else echo "-";?></td></tr>
                                    </table>
                                </td></tr></table> 

                        <br>
                <tr><td align="left" colspan="2" background="images/item_bg.gif"><font class="detail3txt"><b><div align="left">&nbsp;&nbsp;Feedback Received</div></b></font></td></tr> 
                <?php if($msg)
                {
                ?>
                <tr align="center"><td>
                        <br>
                        <br>
                        <font color="red" class="errormsg"><b>
                            <?php 
                            echo $msg;
                            ?>
                        </b></font></td></tr>
            </table>
</table></td></tr>
<?php require'include/footer.php';
exit(); 
}
?>
<tr><td colspan="2">
        <table cellpadding="5" cellspacing="0" width="100%"> 
            <tr class="detail6txt"><td></td><td width=36%><b>Comment</b></td>
                <td><b>From</b></td><td><b>Date</b></td><td><b>Item#</b></td></tr>
            <?php
            $com_sql="select * from feedback where  feedback_to=$user_id order by f_id desc";
            $com_recordset=mysql_query($com_sql);
            $color=1;
            while($com_record=mysql_fetch_array($com_recordset))
            {
            //if()
            $user="select * from user_registration where user_id=$com_record[buyer_id] || user_id=$com_record[seller_id]";
            //else 
            // $user="select * from user_registration where user_id=$com_record[seller_id]";
            $user_recordset=mysql_query($user);
            $user_record=mysql_fetch_array($user_recordset);
            if($color==1)
            {
            $color=2;
            ?>
            <tr bgcolor="#E6E6E6" class="detail9txt">
                <?php
                }
                else
                { 
                $color=1;
                ?>
            <tr bgcolor="#FFFFFF" class="detail9txt">
                <?php
                }
                ?>
                <?php
                if($com_record[feedback_type]=='Positive')
                $imgtype="iconPos_16x16.gif";
                else if($com_record[feedback_type]=='Negative')
                $imgtype="iconNeg_16x16.gif";
                else
                $imgtype="iconNeu_16x16.gif";
                $item_sql="select * from placing_item_bid where item_id=".$com_record['item_id'];
                $item_sqlqry=mysql_query($item_sql);
                $item_rows=mysql_num_rows($item_sqlqry);
                ?>

                <td>  <img src="images/<?php echo  $imgtype ?>"> </td>
                <td width=36%> <?php echo  nl2br($com_record['feedback']);?></td>
                <td width=26%><?php echo  $user_record['user_name'];?></td>
                <td width=15%><?php echo  $com_record['date'];?></td>
                <?php
                if($item_rows!=0)
                {
                ?>
                <td width=23%><a href="detail.php?item_id=<?php echo  $com_record['item_id'];?>" class="header_text2">
                        <?php echo  $com_record['item_id'];?></a></td>
                <?php
                }
                ?>
                <?php
                if($item_rows==0)
                {
                ?>
                <td width=23%>
                    <?php echo  $com_record['item_id'];?></td>
                <?php
                }
                ?>
            </tr>
            <?php
            }
            ?>
        </table></td></tr>
</table></td></tr>
</table></td></tr>
<?php require'include/footer.php'; ?>

