<?php
/***************************************************************************
*File Name				:whatitnow_browse.tpl
*File Created			:Wednesday, June 21, 2006
* File Last Modified	:Wednesday, June 21, 2006
* Copyright			:(C) 2001 AJ Square Inc
* Email				:licence@ajsquare.net
* Software Language	:PHP
* Version Created		:V 4.3.2
* Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
* Modified By			:B.Reena
* $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
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
<table width="958" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">&nbsp;&nbsp;Browse Categories <?php echo  $cat_tit[category_name]; ?></div></b></font>
        </td></tr> 
    <tr><td valign="top" > 
            <table width="958" cellpadding="5" cellspacing="2" align="center" background="images/contentgrad.jpg" border="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                <tr>
                    <td>
                        <table cellpadding="5" cellspacing="0" width=99% border="0">
                            <?php
                            $sql_main="select * from category_master where category_id=$mainid"; 
                            $sqlqry_main=mysql_query($sql_main);
                            $fetch_main=mysql_fetch_array($sqlqry_main);

                            $maincount_sql="select count(*) as maincount from placing_item_bid where category_id=$mainid and status='Active' and selling_method='want_it_now' and bid_starting_date <= now() and expire_date >= now()";
                            $maincount_sqlqry=mysql_query($maincount_sql);
                            $maincount_fetch=mysql_fetch_array($maincount_sqlqry);
                            $maincount=$maincount_fetch['maincount'];

                            ?>
                            <tr><td class="detail9txt">&nbsp;<a href="category.php?cate_id=<?php echo $mainid; ?>&view=list&mode=want" class="detail7txt">
                                        <b><?php echo  $fetch_main[category_name]; ?></b>
                                    </a>&nbsp;( <?php echo  $maincount ?> )</td>
                            </tr>
                            <tr><td width="45%">
                                    <table><tr><td>
                                                <?php
                                                if($tot_rec > 0)
                                                {
                                                while($rec=mysql_fetch_array($res))
                                                { 

                                                $count=$count+1;
                                                $ssid=$rec['category_id'];
                                                $_SESSION[catt]=" ";
                                                if($ssid)
                                                {
                                                $cat="category_id=$ssid or category_id= ";
                                                $_SESSION[catt]=$cat;
                                                cat_display($ssid,$cat);
                                                $cat=$_SESSION[catt];
                                                }
                                                $cat=rtrim($cat," or category_id=");

                                                $count_item_sql="select * from placing_item_bid where category_id=$rec['category_id'] and selling_method='want_it_now' and status='Active' and bid_starting_date <= now() and expire_date >= now()";
                                                $count_item_res=mysql_query($count_item_sql);
                                                $count_item_total=mysql_num_rows($count_item_res);




                                                ?>
                                        <tr><td class="detail9txt"><a href="category.php?cate_id=<?php echo $rec['category_id']; ?>&view=list&mode=want" class="detail7txt"><font size=2 face="Arial"><b>
                                                        <?php echo  $rec[category_name]; ?>
                                                    </b></font></a>&nbsp;( <?php echo  $count_item_total ?> )</td>
                                        </tr>
                                        <tr><td>
                                                <table>
                                                    <?php
                                                    $ssid=$rec['category_id'];
                                                    ret($ssid);
                                                    ?>
                                                </table>
                                            </td></tr>
                                        <?php
                                        if($count == $first_part)
                                        {
                                        ?>
                                    </table>
                                </td>
                                <td width="55%" valign="top">
                                    <table><tr><td>
                                                <?php
                                                }
                                                ?>
                                                <?php 
                                                } // while($rec=mysql_fetch_array($res) and  $count <= $first_part )
                                                } // if($tot_rec > 0)
                                                ?>

                                    </table></td></tr>

                        </table>

                    </td></tr>
            </table>
        </td></tr>
</table>
