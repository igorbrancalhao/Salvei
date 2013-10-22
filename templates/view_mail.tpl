<?php
/***************************************************************************
*File Name				:view_mail.tpl
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
<table width="962" cellpadding="5" cellspacing="0" align="center">
    <tr>
        <td colspan="4" background="images/item_bg.gif">
            <font size="3"><b><div align="left">&nbsp;&nbsp;My Message</div></b></font></td>
    </tr>
    <tr><td valign="top">
            <table cellpadding="0" cellspacing="0" width=100%>
                <tr>
                    <td valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr align="center" height=35>          
                                <td width=2>
                                    <?php require 'include/my_list.php'; ?>
                                </td></tr></table></td>
                    <td valign="top" width=100%>
                        <table valign="top " cellspacing="0" cellpadding="5">

                            <?php
                            if($mode=="in")
                            {
                            $c_sql="select * from ask_question where to_id=$user_id and statusin!='delete' order by qst_id desc";
                            $c_res=mysql_query($c_sql);
                            $i=0;
                            while($c_arr=mysql_fetch_array($c_res))
                            {
                            $i++;
                            if($c_arr["qst_id"]==$qst_id)
                            {
                            if($i==1)
                            {
                            $pre_id=$qst_id;
                            if($mailout_total_records==1)
                            $next_id=$qst_id;
                            else
                            {
                            $c_arr=mysql_fetch_array($c_res);
                            $next_id = $c_arr["qst_id"];
                            }
                            }	
                            else if($i==$mailin_total_records) 
                            {
                            $next_id=$qst_id;
                            $pre_id=$p_id;
                            } 
                            else
                            {
                            $pre_id = $p_id;
                            $c_arr=mysql_fetch_array($c_res);
                            $next_id = $c_arr["qst_id"];
                            } 
                            break;	  
                            }
                            $p_id =  $c_arr["qst_id"];
                            }
                            }
                            else
                            {
                            $c_sql="select * from ask_question where from_id=$user_id and statusout!='delete' order by qst_id desc";
                            $c_res=mysql_query($c_sql);
                            $i=0;
                            while($c_arr=mysql_fetch_array($c_res))
                            {
                            $i++;
                            if($c_arr["qst_id"]==$qst_id)
                            {
                            if($i==1)
                            {
                            $pre_id=$qst_id;
                            if($mailout_total_records==1)
                            $next_id=$qst_id;
                            else
                            {
                            $c_arr=mysql_fetch_array($c_res);
                            $next_id = $c_arr["qst_id"];
                            }
                            }	
                            else if($i==$mailout_total_records) 
                            {
                            $next_id=$qst_id;
                            $pre_id=$p_id;
                            } 
                            else
                            {
                            $pre_id = $p_id;
                            $c_arr=mysql_fetch_array($c_res);
                            $next_id = $c_arr["qst_id"];
                            } 
                            break;
                            }
                            $p_id =  $c_arr["qst_id"];
                            }
                            }
                            ?>
                            <tr background="images/item_bg.gif">
                                <?php
                                if($mailin_total_records > 1 or $mailout_total_records > 1)
                                {
                                ?>
                                <td width=70%>
                                    <?php
                                    if($curpage!=1) 
                                    {
                                    ?>
                                    <a href="view_mail.php?qst_id=<?php echo $pre_id;?>&mode=<?php echo $mode?>&vm=pre&curpage=<?php echo ($curpage-1);?>" class="header_text">Prev</a> 
                                    | 
                                    <?php
                                    }
                                    ?>
                                    <?php 
                                    if( ($mailin_total_records > ($start + $end)) or ($mailout_total_records >($start + $end)))
                                    {
                                    ?>
                                    <a href="view_mail.php?qst_id=<?php echo $next_id?>&mode=<?php echo $mode?>&vm=next&curpage=<?php echo ($curpage+1);?>" class="header_text">Next</a> 
                                    <?php
                                    }
                                    ?>
                                </td>
                                <?php
                                }
                                ?>
                                <td><a href="myauction.php" class="header_text">Back to My Auction</a></td></tr>
                            <tr><td colspan="2">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr><td  height=30 width=780 id=watchingdetails>
                                                <table cellpadding="5" cellspacing="2" width=100% bgcolor="#B8DEEE">
                                                    <tr>
                                                        <td align="left" class="detail9txt"><b>&nbsp;&nbsp;Message :&nbsp;&nbsp;&nbsp;</b></td>
                                                        <td align="right" width=10 colspan="2">&nbsp;
                                                            <!-- <a href="mail.php">
                                                            Refresh
                                                            </a> --> </td></tr></table>
                                            </td></tr>
                                        <tr><td bgcolor="#F0F0F0">
                                                <table width="100%" cellpadding="5" cellspacing="0">
                                                    <tr><td width=10% class="detail9txt">Subject:</td><td class="detail9txt"><?php if($mail_row[status]!="notification")
                                                            {?><b> Question For item Id : <?php echo  $item_row[item_id] ?> - <?php echo  $item_row[item_title] ?> </b><?php}else {echo $mail_row[answer];}?></td></tr>
                                                    <tr><td width=10% class="detail9txt">From:</td><td class="detail9txt"><?phpif ($mail_row['status']!="notification"){ ?><?php echo  $user_row[user_name]; ?><?php}else{?>Admin<?php}?> </td></tr>
                                                    <tr><td width=10% class="detail9txt">To:</td><td class="detail9txt"> <?php echo  $to_user_row[user_name]; ?> </td></tr>
                                                </table>
                                            </td></tr>
                                        <tr><td>&nbsp; </td></tr>
                                        <tr  bgcolor="#B8DEEE" height="35" class="detail9txt">
                                            <td>&nbsp;<b>Mail From <?php echo  $user_row[user_name]; ?></b></td>
                                        </tr>
                                        <?php
                                        if($mail_row[status]!="notification")
                                        {

                                        ?>
                                        <tr><td>
                                                <table width="100%">
                                                    <tr>
                                                        <td class="detail9txt"><?php echo  $fromid; ?> sent this message on behalf of an <?php echo  $fromid; ?> member via My Messages. Responses sent using email will go to the <?php echo  $fromid; ?> member directly and will include your email address. Click the Reply button below to send your response via My Messages (your email address will not be included). </td>
                                                    </tr>
                                                    <tr><td ><hr></td></tr>
                                                    <tr><td class="detail9txt"><?php echo  $message; ?> </td></tr>

                                                    <?php
                                                    if($mode=="in")
                                                    {
                                                    if((empty($mail_row[question])) or (empty($mail_row[answer])))
                                                    {
                                                    ?>
                                                    <form name="reply_form" action="response.php" >
                                                        <tr><td class=tr_botborder valign="bottom" height=30 align="center">
                                                                <input type="hidden" name="item_id" value=<?php echo  $item_row[item_id] ?> />
                                                                       <input type="hidden" name="qst_id" value=<?php echo  $mail_row[qst_id] ?> />
                                                                       <input type="hidden" name="mailmode"/>
                                                                <input type="hidden" name="checkmode" value="<?php echo $mode?>"/>
                                                                <input type="image" src="images/reply.gif" name="Image80" width="62" height="22" border="0" id="Image80" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image80', '', 'images/replyo.gif', 1)"/>
                                                                &nbsp;<input type="image" src="images/delete.gif" name="Image76" width="62" height="22" border="0" id="Image76" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image76', '', 'images/deleteo.gif', 1)" onClick="return mail_del1()"/>
                                                            </td></tr>
                                                    </form>
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                </table>
                                            </td></tr>

                                        <tr><td>&nbsp;</td></tr>
                                        <tr><td height=30 width=560 id=watchingdetails>
                                                <table cellpadding="5" cellspacing="2" width=560 bgcolor="#B8DEEE" height="35">
                                                    <tr>
                                                        <td align="left" class="detail9txt"><b>&nbsp;&nbsp;Item Details :&nbsp;&nbsp;&nbsp;</b></td>
                                                        <td align="right" width=10 colspan="2">&nbsp;
                                                            <!-- <a href="mail.php">
                                                            Refresh
                                                            </a> -->  </td></tr></table>
                                            </td></tr>
                                        <tr><td bgcolor="#F0F0F0">
                                                <table width="100%" cellpadding="5" cellspacing="0" >
                                                    <tr><td width=20% class="detail9txt">Item Name:</td><td class="header_text"><b>  <?php echo  $item_row[item_title] ?> </b></td></tr>
                                                    <tr bgcolor="white"><td width=20% class="detail9txt">Item Number:</td><td class="header_text"><?php echo  $item_row[item_id] ?> </td></tr>
                                                    <tr><td width=20% class="detail9txt">End Date:</td><td class="header_text"> 
                                                            <?php
                                                            $expire_date=$item_row['expire_date'];
                                                            require 'ends.php';
                                                            echo "$string_difference";
                                                            ?>
                                                        </td></tr>
                                                </table>

                                            </td></tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr><td class="detail9txt">&nbsp;&nbsp;View Item Description:</td></tr>
                                        <?php if ($item_row['selling_method']=='ads')
                                        {
                                        ?>
                                        <tr><td>&nbsp;&nbsp;<a href="classifide_ad.php?item_id=<?php echo  $item_row[item_id]?>" class="header_text"><?php echo  $item_row[item_title] ?></a></td></tr>
                                        <?php
                                        }
                                        else if($item_row['selling_method']=='want_it_now')
                                        {
                                        ?>
                                        <tr><td>&nbsp;&nbsp;<a href="wantitnowdes.php?item_id=<?php echo  $item_row[item_id]?>" class="header_text"><?php echo  $item_row['item_title'] ?></a></td></tr>
                                        <?php
                                        }
                                        else 
                                        {
                                        ?>
                                        <tr><td>&nbsp;&nbsp;<a href="detail.php?item_id=<?php echo  $item_row[item_id]?>" class="header_text"><?php echo  $item_row['item_title'] ?></a></td></tr>
                                        <?php
                                        }
                                        ?>

                                        <tr><td>&nbsp;</td></tr>
                                        <?php
                                        }
                                        if($mail_row[status]=="notification")
                                        {
                                        ?>
                                        <tr><td class="table_border">
                                                <table width="100%">
                                                    <tr><td class="detail9txt">Admin sent this message on behalf of an <?php echo  $fromid; ?> </td></tr>
                                                    <tr><td ><hr></td></tr>
                                                    <tr><td><?php echo  $mail_row['question']; ?> </td></tr>
                                                    <tr><td><br /></td></tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    <tr><td class="detail9txt">&nbsp;&nbsp;Thanking You for using <?php echo  $fromsitename ?> </td></tr>
                                                    <tr><td>&nbsp;&nbsp; <?php echo  $fromname ?>  </td></tr>
                                                </table>
                                            </td></tr>
                                        <tr><td style="padding:10px" align="center">
                                                <form name="del_frm" action="view_mail.php" >
                                                    <input type="hidden" name="item_id" value="<?php echo  $item_row[item_id] ?>"/>
                                                    <input type="hidden" name="qst_id" value="<?php echo  $mail_row[qst_id] ?>"/>
                                                    <input type="hidden" name="mailmode"/>
                                                    <input type="hidden" name="checkmode" value="<?php echo $mode?>" />
                                                    <input type="image" src="images/delete.gif" name="Image76" width="62" height="22" border="0" id="Image76" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image76', '', 'images/deleteo.gif', 1)" onClick="return mail_del()"/>
                                                </form>
                                            </td></tr>
                                    </table></td></tr>
                        </table></td>
                    <td valign="top">
                        <?php
                        require 'templates/right_menu.tpl';
                        ?></td></tr></table>

        </td></tr></table>
<script language="javascript">
    function mail_del()
    {
        var where_to = confirm("Are U Sure U Want to delete the mail?");
        if (where_to == true)
        {
            document.del_frm.mailmode.value = "delete";
            document.del_frm.submit();
        }
        else
            return false;
    }
    function mail_del1()
    {
        var where_to = confirm("Are U Sure U Want to delete the mail?");
        if (where_to == true)
        {
            document.reply_form.mailmode.value = "delete";
            document.reply_form.action = "view_mail.php";
            document.reply_form.submit();
        }
        else
            return false;
    }
</script>