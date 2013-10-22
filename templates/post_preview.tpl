<?php
/***************************************************************************
*File Name				:post_preview.tpl
* File Created			:Wednesday, June 21, 2006
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
if($sucess==1)
{
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr><td valign="top"><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td>
                        <font class="categories_fonttype">&nbsp;&nbsp;Post Your Ad: Congratulations</font></td></tr>
            </table></td></tr>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
                <tr><td colspan="2"> 
                        <table cellpadding="5" cellspacing="2"  width=100%> 
                            <tr><td><font size="2" color=green><b>You have successfully listed your item.</b></font></td></tr>
                            <tr><td class="banner1"><b>View your listing:</b>&nbsp;<a href="classifide_ad.php?item_id=<?php= $item_id ?>" class="header_text"><?php= $_SESSION['item_name']; ?></a></td></tr>
                            <tr>
                                <td><a href="choose_sell_format.php" class="header_text">Sell a Different Item </a>
                                    </form></td></tr>
                        </table></td></tr>
            </table>
        </td></tr>
</table>
<?php
$_SESSION['item_name']="";
require 'include/footer.php';
exit();
}
else
{
?>
<table width="958" cellpadding="0" cellspacing="5" border=0 align="center">
    <tr>
        <td><table width="948" height="27" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5">
                <tr>
                    <td height="30" colspan="2" class="banner1">
                        &nbsp;&nbsp;1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;Title & Description  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.<b>&nbsp;Preview & Submit</b></td></tr>
            </table></td></tr>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td class="detail9txt"><font size=2><b>Edit Your Listing</b></font>
                    </td></tr>
                <tr><td class="banner1">Click on 'Edit' link to make changes. When you do, you'll be directed to a page where you can make your desired changes. </td></tr>
                <tr><td>
                        <table border="0" align="center" cellpadding="5" cellspacing="0" width=100%>
                            <tr  valign="top">
                                <td bgcolor="#B8DEEE" height="30" valign="top" class="detail9txt">
                                    <div align="left">
                                        <b>Title & Description </b></div></td>
                                <td bgcolor="#B8DEEE"><div align="right"><a href="post_ad.php?mode=change" class="header_text">Edit 
                                            Title &amp; Description</a></div>
                                </td></tr>
                            <tr><td class="detail9txt"><b>Item Title</b></td><td class="banner1"> <?php= $_SESSION['item_name']; ?> </td></tr>
                            <tr><td class="detail9txt"><b>Item Description</b></td><td>&nbsp;</td></tr>
                            <tr><td colspan="2" class="banner1"><?php= stripslashes($_SESSION['des']); ?></td></tr>
                            <?php if($_SESSION[start_delay])
                            {
                            ?>
                            <tr><td class="detail9txt"><b>Start Delay</b></td><td class="banner1"><?php= $_SESSION['start_delay']." Days" ?></td></tr>
                            <?php
                            }
                            ?>
                            <tr><td class="detail9txt"><b>Duration</b></td><td class="banner1"><?php= $_SESSION['dur']." Days" ?></td></tr>
                            <tr><td class="detail9txt"><b>Quantity </b></td><td class="banner1"> <?php= $_SESSION['qty']; ?> </td></tr>
                            <tr><td></td><td></td></tr>
                        </table>
                    </td></tr>
                <tr><td>
                        <table border="0" align="center" cellpadding="5" cellspacing="0" width=100%>
                            <tr  valign="top">
                                <td bgcolor="#B8DEEE" height="30" valign="top" class="detail9txt">
                                    <div align="left">
                                        <b>Images</b></div></td><td bgcolor="#B8DEEE" colspan="2">
                                    <div align="right"><a href="post_ad.php?mode=change" class="header_text">Edit Images</a></div>
                                </td></tr>
                            <?php 	if($_SESSION['image1'])
                            {
                            $img=$_SESSION['image1'];
                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                            $h=$height;
                            $w=$width;
                            if($h>400)	
                            {
                            $nh=400;
                            $nw=($w/$h)*$nh;
                            $h=$nh;
                            $w=$nw;
                            }
                            if($w>400)
                            {
                            $nw=400;
                            $nh=($h/$w)*$nw;
                            $h=$nh;
                            $w=$nw;
                            }
                            ?>
                            <tr align="center"><td><img src="thumbnail/<?php= $_SESSION['image1'] ?>" height="<?php=$h?>" width="<?php=$w?>"></td>
                                <?php
                                }
                                ?>
                                <?php 	if($_SESSION['image2'])
                                {
                                $img=$_SESSION['image2'];
                                list($width, $height, $type, $attr) = getimagesize("images/$img");
                                $h=$height;
                                $w=$width;
                                if($h>400)	
                                {
                                $nh=400;
                                $nw=($w/$h)*$nh;
                                $h=$nh;
                                $w=$nw;
                                }
                                if($w>400)
                                {
                                $nw=400;
                                $nh=($h/$w)*$nw;
                                $h=$nh;
                                $w=$nw;
                                }
                                ?>
                                <td><img src="images/<?php= $_SESSION['image2'] ?>" height="<?php=$h?>" width="<?php=$w?>"></td>
                                <?php
                                }
                                ?>
                                <?php 	if($_SESSION[image3])
                                {
                                ?>
                                <td><img src="images/<?php= $_SESSION['image3'] ?>" height="<?php=$h?>" width="<?php=$w?>"></td>
                                <?php
                                }
                                ?>
                            </tr>
                        </table>
                    </td></tr>

                <?php 
                $subtitle=$_SESSION[subtitle];
                if(!empty($Highlight) || !empty($Border) || !empty($Bold) || !empty($Gallery) || !empty($subtitle) || !empty($Home) || !empty($Insertionfee))
                {
                $fee_sql="select * from admin_rates";
                $fee_res=mysql_query($fee_sql);
                $fee_row=mysql_fetch_array($fee_res);
                if(!empty($Gallery))
                $gallery_price=$fee_row[gallery_price];
                if(!empty($Home))
                $homepage_price=$fee_row[homepage_price];
                if(!empty($subtitle))
                $subtitle_price=$fee_row[subtitle_price];
                if(!empty($Bold))
                $bold_price=$fee_row[bold_price];
                if(!empty($Highlight))
                $highlight_price=$fee_row[highlight_price];
                $insertionfee=$fee_row[Classified_fee];
                $_SESSION[Insertionfee]=$insertionfee;
                $total_setup_fee=0;
                }
                $currency_sell="select * from admin_settings where set_id=59";
                $currency_res=mysql_query($currency_sell);
                $currency_row=mysql_fetch_array($currency_res);
                $cur_sell=$currency_row['set_value'];
                $currency_sellcode="select * from admin_settings where set_id=60";
                $currency_rescode=mysql_query($currency_sellcode);
                $currency_rowcode=mysql_fetch_array($currency_rescode);
                $cur_sellcode=$currency_rowcode['set_value'];
                ?>
                <tr><td>
                        <table border="0" align="center" cellpadding="5" cellspacing="0" width=100%>
                            <tr  valign="top">
                                <td bgcolor="#B8DEEE" height="30" valign="top" class="detail9txt">
                                    <div align="left">
                                        <b>Review the fees and submit your listing</b></div></td><td bgcolor="#B8DEEE">
                                    <div align="right"></div>
                                </td></tr>
                            <?php 
                            if(($insertionfee) && ($insertionfee!='0.00'))
                            {
                            $total_setup_fee=$total_setup_fee+$insertionfee;
                            ?>
                            <tr bgclor=#eeeeee><td width="41%" align="left" class="detail9txt"><b>Insertion Fee:</b></td>
                                <td width="59%" align="left" class="banner1"><?php= $insertionfee ?><?php=$cur_sellcode?></td>
                            </tr>
                            <?php
                            }
                            if(($gallery_price) && ($gallery_price!='0.00'))
                            {
                            $total_setup_fee=$total_setup_fee+$gallery_price;
                            ?>
                            <tr bgclor=#eeeeee><td align="left" class="detail9txt"><b>Gallery Items Fees:</b></td><td align="left" class="banner1"><?php= $gallery_price ?>&nbsp;<?php=$cur_sellcode?></td></tr>
                            <?php
                            }
                            if(($bold_price) && ($bold_price!='0.00'))
                            {
                            $total_setup_fee=$total_setup_fee+$bold_price;
                            ?>
                            <tr bgclor=white><td align="left" class="detail9txt"><b>Bold Items Fees:</b></td><td align="left" class="banner1"><?php= $bold_price ?><?php=$cur_sellcode?></td></tr>
                            <?php
                            }
                            if(($highlight_price) && ($highlight_price!='0.00'))
                            {
                            $total_setup_fee=$total_setup_fee+$highlight_price;
                            ?>
                            <tr bgclor=#eeeeee><td align="left" class="detail9txt"><b>Highlight Items Fees:</b></td><td align="left" class="banner1"><?php= $highlight_price ?><?php=$cur_sellcode?></td></tr>
                            <?php
                            }
                            if(($subtitle_price) && ($subtitle_price!='0.00'))
                            {

                            $total_setup_fee=$total_setup_fee+$subtitle_price;
                            ?>
                            <tr bgclor=white><td align="left" class="detail9txt"><b>Subtitle Items Fees:</b></td>
                                <td align="left" class="banner1"><?php= $subtitle_price ?><?php=$cur_sellcode?></td></tr>
                            <?php
                            }
                            if(($homepage_price) && ($homepage_price!='0.00'))
                            {
                            $total_setup_fee=$total_setup_fee+$homepage_price;
                            ?>
                            <tr bgclor=#eeeeee><td align="left" class="detail9txt"><b>Homepage Featured Items Fees:</b></td>
                                <td align="left" class="banner1"><?php= $homepage_price ?><?php=$cur_sellcode?></td></tr>
                            <?php
                            }
                            $_SESSION[total_setup_fee]=$total_setup_fee;
                            $total_setup_fee=number_format($total_setup_fee,2);
                            $_SESSION[total_fees]=$total_setup_fee;
                            ?>

                            <?php
                            if($total_setup_fee!='0.00' || $total_setup_fee='0')
                            {
                            ?>
                            <tr bgclor=white><td align="left" class="detail9txt"><b>Total Setup Fees:</b></td>
                                <td align="left" class="banner1"><?phpif($total_setup_fee=='0' or $total_setup_fee=='0.00'){?>No Fee<?php}else {?><?php= $total_setup_fee ?><?php=$cur_sellcode?><?php}?></td></tr>
                            <!--<tr><td colspan="2"><hr /></td></tr>-->
                            <?php
                            }
                            else
                            {
                            ?>
                            <tr><td>No Fees </td></tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td></tr>
                <tr><td>
                        <form name=preview action="post_preview.php" method=post>
                            <table align="center">
                                <tr><td>
                                        <input type="hidden" name="flag" value=1>

                                        <!--<input type="image" src="images/cancel.gif" name="Image83" width="62" height="22" border="0" id="Image83" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image83','','images/cancelo.gif',1)" onClick="cancel()"/>-->
                                        <!--<input type="button" value="Cancel" >
                                        -->
                                    </td><td>
                                        <input type="image" src="images/submit.gif" name="Image85" width="62" height="22" border="0" id="Image85" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image85', '', 'images/submito.gif', 1)"/>
                                        <!--<input type="submit" value="Submit">-->
                                    </td>
                                </tr></table>
                        </form>
                    </td></tr>
            </table></td></tr>
</table></td></tr>
<?php
}
?>