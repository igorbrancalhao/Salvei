<?php /***************************************************************************
*File Name				:browse_cate.tpl
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
<div>
    <table width="900" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr><td width="116" background="images/contentbg1.jpg" height="25">
                <font class="detail3txt">
                <div align="left">&nbsp;&nbsp;Pesquisar nas Categorias </div>
                </b></font>
            </td></tr>
        <tr><td valign="top"> 
                <table width="958" cellpadding="5" cellspacing="2" background="images/contentgrad.jpg" align="center" border="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                    <tr>
                        <td  valign="top">
                            <table cellpadding="5" cellspacing="0" width=100% border="0" onmouseout="hide()">
                                <tr><td width="53%"  valign="top">
                                        <table><tr><td valign="top">
                                                    <?php    
                                                    while($rec=mysql_fetch_array($res))
                                                    { 
                                                    $count=$count+1;
                                                    $ssid=$rec["category_id"];
                                                    $_SESSION["catt"]=" ";
                                                    if($ssid)
                                                    {
                                                    $cat="category_id=$ssid or category_id=";
                                                    $_SESSION["catt"]=$cat;
                                                    cat_display($ssid,$cat);
                                                    $cat=$_SESSION["catt"];
                                                    }
                                                    $cat=rtrim($cat," or category_id=");

                                                    $count_item_sql="select * from placing_item_bid where ($cat) and selling_method!='want_it_now' and status='Active' and bid_starting_date and expire_date";
                                                    $count_item_res=mysql_query($count_item_sql);
                                                    $count_item_total=mysql_num_rows($count_item_res);


                                                    ?>

                                            <tr><td class="detail9txt"><a href="subcat.php?cate_id=<?php echo $rec['category_id']; ?>&view=list" class="detail7txt"><font size=2 face="Arial"><b><?php echo $rec['category_name']; ?></b></font></a>&nbsp; ( <?php echo $count_item_total ?> ) </td></tr>

                                            <?php  if($count == $first_part )
                                            {
                                            ?>
                                        </table>
                                    </td>
                                    <td width="47%" valign="top">
                                        <table ><tr><td  valign="top">
                                                    <?php 
                                                    }
                                                    } 
                                                    ?>
                                                </td>
                                            </tr>
                                        </table></td></tr>
                            </table></td></tr>
                </table></td></tr>
    </table>

</div>
<?php  require 'include/footer.php'?>
</body>
</html>