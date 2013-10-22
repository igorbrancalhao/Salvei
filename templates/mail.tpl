<?php
/***************************************************************************
*File Name				:mail.tpl
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
<table cellpadding="5" cellspacing="0" width="962px" align="center">
    <tr>
        <td colspan="4" background="images/item_bg.gif">
            <font size="3"><b><div align="left">&nbsp;&nbsp;My Message</div></b></font></td>
    </tr>
    <tr>
        <td valign="top" width="3%">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr align="center" height=35>
                    <td width=2>
                        <?php require'include/my_list.php'; ?>
                    </td></tr></table></td>
        <td valign="top" width="70%" colspan="2">
            <table valign="top" cellspacing="0" cellpadding="0" width=100%>

                <!------ Inbox ------------------------------>
                <?php
                if($mode=="in")
                {
                ?>
                <tr><td align="left">
                        <table cellpadding="0" cellspacing="0" width=100%>
                            <tr><td height=30 width=100% id=didntwindetails>
                                    <table cellpadding="5" cellspacing="0" width=100% background="images/item_bg.gif">
                                        <tr>
                                            <td align="left"><b>&nbsp;&nbsp;Inbox :&nbsp;&nbsp;&nbsp;</b></td>
                                            <td align="right" width=10 colspan="2">
                                                <a href="mail.php?mode=in" class="header_text">
                                                    Refresh
                                                </a></td></tr></table>
                                </td></tr>
                            <tr>
                                <td>
                                    <table width="100%" cellpadding="5" cellspacing="0" >
                                        <?php
                                        if($mail_total_records > 0)
                                        { 
                                        ?>
                                        <form name="mail_form" action="mail.php" method=post>
                                            <tr class="detail9txt">
                                                <td width="36" class="tr_botborder" >
                                                    <input type="hidden" name="len" value="<?php= $mail_total_records?>">
                                                    <input type="checkbox" name="chkMain" onClick="selectall()" id="chkMain">
                                                    <input type="hidden" name="mode" value="<?php= $mode ?>">

                                                </td>
                                                <td width="49" class="tr_botborder"><b>From</b> </td>
                                                <td class="tr_botborder" colspan="2"><b>Subject</b> </td>
                                                <td  class="tr_botborder" colspan="2"><b>Received Date</b>  </td>
                                                <td width="42"  class="tr_botborder"><b>Status</b>  </td>
                                            </tr>
                                            <?php
                                            $i=0;
                                            $mail_res=mysql_query($mail_sql);
                                            while($mail_row=mysql_fetch_array($mail_res))
                                            {
                                            $i=$i+1;
                                            if($mail_row['from_id'])
                                            {
                                            $user_sql="select * from user_registration where user_id=".$mail_row['from_id'];
                                            $user_res=mysql_query($user_sql);
                                            $user=mysql_fetch_array($user_res);
                                            }
                                            /* 
                                            if($mail_row['answer'])
                                            $flag="images/read.gif";
                                            else 
                                            $flag="images/unread.gif"; */

                                            if($mail_row['status']=="read" or $mail_row['notifystatus']=="read")
                                            $flag="images/read.gif";
                                            else if($mail_row['status']=="unread" or $mail_row['notifystatus']=="unread")
                                            $flag="images/unread.gif";

                                            ?>
                                            <tr class="detail9txt">
                                                <td class="tr_botborder" >
                                                    <input type="checkbox" name=chkbox[] id="chkbox" value="<?php  echo $mail_row['qst_id']; ?>">
                                                </td>
                                                <td class="tr_botborder">
                                                    <?php  if($user['user_name'])  echo $user['user_name']; else echo "Guest";?>
                                                </td>
                                                <td class="tr_botborder" colspan="2">
                                                    <a href="view_mail.php?qst_id=<?php= $mail_row['qst_id']?>&mode=in&curpage=<?php=$i?>" class="header_text"> 
                                                        <?phpif($mail_row['status']!="notification"){ ?>Message from <?php= $fromid ?> Regarding Item Id: <?php= $mail_row['item_id']; }else{?>Mail From <?phpif($mail_row['status']!="notification"){ ?><?php=$fromid; }else {?>Admin<?php}}?>
                                                    </a>
                                                </td>
                                                <td class="tr_botborder" colspan="2"  >
                                                    <?php
                                                    $custom_date=explode(" ",$mail_row[date]);
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
                                                <td class="tr_botborder" >
                                                    <img src="<?php= $flag ?>"></td>
                                            </tr>

                                            <?php
                                            } // while
                                            ?>
                                            <tr>
                                                <td colspan="7" class=tr_botborder align="center">
                                                    <input type="image" src="images/delete.gif" name="Image76" width="62" height="22" border="0" id="Image76" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image76', '', 'images/deleteo.gif', 1)" onClick="return mail_del()"/>
                                                    <!--<input type="button" value=Delete name="conf"  class=buttonbig>-->
                                                    <input type="hidden" name="mail_conf" value="">
                                                </td>
                                            </tr>
                                        </form>
                                        <tr class="detail9txt">
                                            <td valign="middle"><img src="images/read.gif">&nbsp;Read</td>
                                            <td valign="middle"><img src="images/unread.gif">&nbsp;Unread</td>
                                            <td width="177" valign="middle">&nbsp;</td>
                                            <td width="176" valign="middle">&nbsp;</td> 
                                            <td width="202" valign="middle">&nbsp;</td> 
                                        </tr>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <tr>
                                            <td class="tr_botborder_1" colspan=5 align="left"><font class="detail9txt">There are no items in this section</font></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td></tr>
                        </table>
                    </td></tr>
                <tr><td>
                        <table cellpadding="5" cellspacing="0" width=100%>
                            <tr><td  height=30 width=100% align="left">
                                    <font class="detail9txtfinal"><b> About My Messages:</b></font>
                                </td>
                            </tr>
                            <tr class="detail9txt"><td class="table_border">
                                    My Messages is a place for you to send and receive <?php= $_SESSION[site_name]  ?> -related communications. In My Messages, you'll find: 
                                    Important alerts from <?php= $_SESSION[site_name]  ?>  about your account. 
                                    Useful messages from <?php= $_SESSION[site_name]  ?>  about buying and selling activities and events. 
                                    Questions and answers about items, as well as other communications from <?php= $_SESSION[site_name]  ?>  members. 
                                </td></tr>
                        </table>
                    </td></tr>
                <?php
                }  // if($mode=="in") 
                ?>

                <!------ Inbox ------------------------------>

                <!------ Outbox ------------------------------>
                <?php
                if($mode=="out")
                {
                ?>
                <tr><td>
                        <table cellpadding="0" cellspacing="0">
                            <tr><td height=30 width=100% id=watchingdetails>
                                    <table cellpadding="5" cellspacing="0" width=100% background="images/item_bg.gif">
                                        <tr>
                                            <td align="left"><b>&nbsp;&nbsp;Outbox :&nbsp;&nbsp;&nbsp;</b></td>
                                            <td align="right" width=10 colspan="2">
                                                <a href="mail.php?mode=out" class="header_text">
                                                    Refresh
                                                </a></td></tr></table>
                                </td></tr>
                            <tr>
                                <td>
                                    <table width="100%" cellpadding="5" cellspacing="0" >
                                        <?php
                                        if($mail_total_records > 0)
                                        { 
                                        ?>
                                        <form name="mail_form" action="mail.php" method=post>
                                            <tr class="detail9txt">
                                                <td width="133" class="tr_botborder" >
                                                    <input type="hidden" name="mode" value="<?php= $mode ?>">

                                                    <input type="hidden" name="len" value="<?php= $mail_total_records?>">
                                                    <input type="checkbox" name="chkMain" onClick="selectall()" id="chkMain"> </td>
                                                <td width="53" class="tr_botborder" ><b>To</b> </td>
                                                <td class="tr_botborder" colspan="4" ><b>Subject</b> </td>
                                                <td width="274"  class="tr_botborder" ><b>Sent Date</b>  </td>
                                            </tr>
                                            <?php
                                            $i=0;
                                            $mail_res=mysql_query($mail_sql);
                                            while($mail_row=mysql_fetch_array($mail_res))
                                            {
                                            $i=$i+1;
                                            if($mode=="in")
                                            {
                                            if($mail_row['from_id'])
                                            {
                                            $user_sql="select * from user_registration where user_id=".$mail_row['from_id'];
                                            $user_res=mysql_query($user_sql);
                                            $user=mysql_fetch_array($user_res);
                                            }
                                            }
                                            else
                                            {
                                            if($mail_row['to_id'])
                                            {
                                            $user_sql="select * from user_registration where user_id=".$mail_row['to_id'];
                                            $user_res=mysql_query($user_sql);
                                            $user=mysql_fetch_array($user_res);
                                            }

                                            }

                                            if($mail_row['status']=="read")
                                            $flag="images/read.gif";
                                            else if($mail_row['status']=="unread")
                                            $flag="images/unread.gif";

                                            ?>
                                            <tr class="detail9txt">
                                                <td class="tr_botborder" >
                                                    <input type="checkbox" name=chkbox[] id="chkbox" value="<?php  echo $mail_row['qst_id']; ?>">
                                                </td>
                                                <td class="tr_botborder">
                                                    <?php  if($user['user_name']) echo $user['user_name']; else echo "Guest";?>
                                                </td>
                                                <td class="tr_botborder" colspan="4">
                                                    <a href="view_mail.php?qst_id=<?php= $mail_row['qst_id']?>&mode=out&curpage=<?php=$i?>" class="header_text"> 
                                                        <?phpif($mail_row['status']!="notification"){ ?>Message from <?php= $fromid ?> Regarding Item Id : <?php= $mail_row['item_id']; }else{?>Mail From <?php=$fromid; }?>
                                                    </a>
                                                </td>
                                                <td class="tr_botborder" >

                                                    <?php
                                                    $custom_date=explode(" ",$mail_row[date]);
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

                                            </tr>

                                            <?php
                                            } // while
                                            ?>
                                            <tr>
                                                <td colspan="7" class=tr_botborder align="center">
                                                    <input type="image" src="images/delete.gif" name="Image76" width="62" height="22" border="0" id="Image76" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image76', '', 'images/deleteo.gif', 1)" onClick="return mail_del1()"/>
                                                    <input type="hidden" name="mail_conf1" value="">
                                                </td>
                                            </tr>
                                        </form>
                                        <tr>
                                            <td valign="middle">&nbsp;</td>
                                            <td valign="middle">&nbsp;</td>
                                            <td width="95" valign="middle">&nbsp;</td>
                                            <td width="129" valign="middle">&nbsp;</td> 
                                            <td width="177" valign="middle">&nbsp;</td> 

                                        </tr>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <tr>
                                            <td class="tr_botborder_1" colspan=5 align="left"><font class="detail9txt">There are no items in this section</font></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td></tr>
                        </table>
                    </td></tr>
                <tr><td>
                        <table cellpadding="5" cellspacing="0" width=100%>
                            <tr><td  height=30 width=100% align="left">
                                    <font class="detail9txtfinal"><b> About My Messages:</b></font>
                                </td>
                            </tr>
                            <tr><td class="detail9txt">
                                    My Messages is a place for you to send and receive <?php= $_SESSION[site_name]  ?> -related communications. In My Messages, you'll find: 
                                    Important alerts from <?php= $_SESSION[site_name]  ?>  about your account. 
                                    Useful messages from <?php= $_SESSION[site_name]  ?>  about buying and selling activities and events. 
                                    Questions and answers about items, as well as other communications from <?php= $_SESSION[site_name]  ?>  members. 
                                </td></tr>
                        </table>
                    </td></tr>
                <?php
                }
                ?>
                <!------ Outbox ------------------------------>
            </table></td>
        <td valign="top">
            <?php
            require 'templates/right_menu.tpl';
            ?>
        </td>
    </tr>
</table>

