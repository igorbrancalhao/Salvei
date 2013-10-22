<?php
/***************************************************************************
*File Name				:preview.tpl
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
if($sucess==1)
{
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr><td valign="top"><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td>
                        <font class="categories_fonttype">&nbsp;&nbsp;Sell Your Ad: Congratulations</font></td></tr>
            </table></td></tr>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom"> 
                <tr><td valign="top">
                        <table cellpadding="5" cellspacing="2" align="center" width="100%">
                            <tr><td><font class="banner1"><b>You have successfully listed your item.</b></font></td></tr>
                            <tr><td class="banner1"><b>View your listing:</b>&nbsp;<a href="detail.php?item_id=<?php echo  $item_id ?>" class="header_text"><?php echo  $_SESSION[item_name]; ?></a></td></tr>
                            <tr>
                                <td class="banner1">
                                    <form name="relist" action="sellsimilaritem.php" method="get">
                                        <input type="hidden" name="sellitemid" value="<?php echo  $item_id ?>">
                                        <input type="hidden" name="mode" value="sellsimilar">
                                        <input type="image" src="images/sellsimilar.gif" name="Image84"  border="0" id="Image84" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image84', '', 'images/sellsimilaro.gif', 1)" value="Sell Similar Item"/>

                                        &nbsp;&nbsp;&nbsp; or <a href="choose_sell_format.php" class="header_text">Sell a Different Item </a>
                                    </form></td></tr>
                        </table></td></tr>

        </td></tr>
</table>
</td></tr></table>
<?php
require 'include/footer.php';
$_SESSION['item_name']="";
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
                        1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;Title & Description  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;Pictures & Details&nbsp;&nbsp;4.&nbsp;Shipping Details & Sales Tax
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.<b>&nbsp;Preview & Submit</b></td>
                </tr>
            </table></td></tr>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
                <tr>
                    <td class="banner1"><font size=2><b>Edit Your Listing</b></font>
                    </td></tr>
                <tr><td class="banner1">Click on 'Edit' link to make changes. When you do, you'll be directed to a page where you can make your desired changes. </td></tr>
                <tr><td>
                        <table border="0" align="center" cellpadding="5" cellspacing="0" width=100%>
                            <tr  valign="top">
                                <td bgcolor="#B8DEEE" height="30" valign="top" class="detail9txt">
                                    <div align="left">
                                        <b>Item Title </b></div></td>
                                <td bgcolor="#B8DEEE"><div align="right"><a href="sell_item_detail.php?mode=change" class="header_text">Edit Item Title</a></div>
                                </td></tr>
                            <tr><td class="banner1"><?php echo  $_SESSION[item_name]=stripslashes($_SESSION[item_name]); ?> </td></tr>
                        </table></td></tr>
                <?php 
                if($_SESSION['subtitle'])
                { 
                ?>
                <tr><td>
                        <table border="0" align="center" cellpadding="5" cellspacing="0" width=100%>
                            <tr  valign="top">
                                <td bgcolor="#B8DEEE" height="30" valign="top" class="detail9txt">
                                    <div align="left">
                                        <b>Subtitle </b></div></td>
                                <td bgcolor="#B8DEEE"><div align="right"><a href="sell_item_detail.php?mode=change" class="header_text">Edit 
                                            Subtitle</a></div>
                                </td></tr>
                            <tr><td class="banner1"> <?php echo  $_SESSION[subtitle]=stripslashes($_SESSION[subtitle]); ?> </td></tr>
                        </table></td></tr>
                <?php
                }
                ?>
                <tr><td>
                        <table border="0" align="center" cellpadding="5" cellspacing="0" width=100%>
                            <tr  valign="top">
                                <td bgcolor="#B8DEEE" height="30" valign="top" class="detail9txt">
                                    <div align="left">
                                        <b>Item Description </b></div></td>
                                <td bgcolor="#B8DEEE"><div align="right"><a href="sell_item_detail.php?mode=change" class="header_text">Edit 
                                            Item Description</a></div>
                                </td></tr>
                            <tr><td colspan="2" align="left">
                                    <?php 
                                    if($_SESSION[theme_id] || ($_SESSION[theme_id]==0) )
                                    {
                                    $img=$theme_top;
                                    list($width, $height, $type, $attr) = getimagesize("images/$img");
                                    ?>
                                    <table width="100%" cellpadding="5" cellspacing="0" align="left">
                                        <tr><td background="images/<?php echo  $theme_top ?>" style="background-repeat:no-repeat"  height=<?php echo  $height ?> align="left"></td></tr>
                                        <tr><td background="images/<?php echo  $theme_content ?>"  style="background-repeat:repeat-y" align="left" >
                                                <?php

                                                if($_SESSION[layout]=="layout_top.gif")
                                                {
                                                ?>
                                                <table width=100% cellpadding="5" style="padding:50px">
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image1])
                                                            {  
                                                            $img=$_SESSION[image1];
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
                                                            <img src="thumbnail/<?php echo  $_SESSION[image1] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td style="padding:50px" class="banner1"><?php echo  $_SESSION[des]=stripslashes($_SESSION[des]); ?>  </td></tr>

                                                    <tr><td align="center" >
                                                            <?php if($_SESSION[image2])
                                                            {  
                                                            $img=$_SESSION[image2];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image2] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>

                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image3])
                                                            {  
                                                            $img=$_SESSION[image3];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image3] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image4])
                                                            {  
                                                            $img=$_SESSION[image4];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image4] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image5])
                                                            {  
                                                            $img=$_SESSION[image5];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image5] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image6])
                                                            {  
                                                            $img=$_SESSION[image6];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image6] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image7])
                                                            {  
                                                            $img=$_SESSION[image7];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image7] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                </table>
                                                <?php
                                                } // end of top layout
                                                else if($_SESSION[layout]=="layout_bottom.gif")
                                                {
                                                ?>
                                                <table width=100% cellpadding="5" >
                                                    <tr><td style="padding:50px" class="banner1"><?php echo  $_SESSION[des]=stripslashes($_SESSION[des]);?></td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image1])
                                                            {  
                                                            $img=$_SESSION[image1];
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
                                                            <img src="thumbnail/<?php echo  $_SESSION[image1] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>


                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image2])
                                                            {  
                                                            $img=$_SESSION[image2];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image2] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>

                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image3])
                                                            {  
                                                            $img=$_SESSION[image3];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image3] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image4])
                                                            {  
                                                            $img=$_SESSION[image4];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image4] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image5])
                                                            {  
                                                            $img=$_SESSION[image5];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image5] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image6])
                                                            {  
                                                            $img=$_SESSION[image6];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image6] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image7])
                                                            {  
                                                            $img=$_SESSION[image7];
                                                            list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                            $h=$height;
                                                            $w=$width;
                                                            if($h>200)	
                                                            {
                                                            $nh=200;
                                                            $nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }
                                                            if($w>200)
                                                            {
                                                            $nw=200;
                                                            $nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;
                                                            }

                                                            ?>
                                                            <img src="thumbnail/<?php echo  $_SESSION[image7] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                </table>
                                                <?php
                                                } // end of bottom layout
                                                else if($_SESSION[layout]=="layout_left.gif")
                                                {
                                                ?>
                                                <table width=100% cellpadding="5" >
                                                    <tr><td align="left" style="padding:50px"><table>
                                                                <tr><td align="center">
                                                                        <?php if($_SESSION[image1])
                                                                        {  
                                                                        $img=$_SESSION[image1];
                                                                        list($width, $height, $type,$attr) = getimagesize("thumbnail/$img");
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
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image1] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>


                                                                <tr><td align="center">
                                                                        <?php if($_SESSION[image2])
                                                                        {  
                                                                        $img=$_SESSION[image2];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image2] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>

                                                                <tr><td align="center">
                                                                        <?php if($_SESSION[image3])
                                                                        {  
                                                                        $img=$_SESSION[image3];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image3] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>
                                                                <tr><td align="center">
                                                                        <?php if($_SESSION[image4])
                                                                        {  
                                                                        $img=$_SESSION[image4];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image4] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>
                                                                <tr><td align="center">
                                                                        <?php if($_SESSION[image5])
                                                                        {  
                                                                        $img=$_SESSION[image5];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image5] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>
                                                                <tr><td align="center">
                                                                        <?php if($_SESSION[image6])
                                                                        {  
                                                                        $img=$_SESSION[image6];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image6] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>
                                                                <tr><td align="center">
                                                                        <?php if($_SESSION[image7])
                                                                        {  
                                                                        $img=$_SESSION[image7];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image7] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>
                                                            </table></td><td style="padding:50px" valign="top" class="banner1">
                                                            <?php echo  $_SESSION[des]=stripslashes($_SESSION[des]); ?>
                                                        </td></tr>
                                                </table>
                                                <?php
                                                } // end of left layout
                                                elseif($_SESSION[layout]=="layout_right.gif")
                                                {
                                                ?>
                                                <table width=100% cellpadding="5" >
                                                    <tr>
                                                        <td style="padding:50px" valign="top" class="banner1">
                                                            <?php echo  $_SESSION[des]=stripslashes($_SESSION[des]); ?>  </td>
                                                        <td style="padding-right:50px">
                                                            <table>
                                                                <tr><td align="left">
                                                                        <?php if($_SESSION[image1])
                                                                        {  
                                                                        $img=$_SESSION[image1];
                                                                        list($width, $height, $type,$attr) = getimagesize("thumbnail/$img");
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
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image1] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>


                                                                <tr><td align="left">
                                                                        <?php if($_SESSION[image2])
                                                                        {  
                                                                        $img=$_SESSION[image2];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image2] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>

                                                                <tr><td align="left">
                                                                        <?php if($_SESSION[image3])
                                                                        {  
                                                                        $img=$_SESSION[image3];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image3] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>
                                                                <tr><td align="left">
                                                                        <?php if($_SESSION[image4])
                                                                        {  
                                                                        $img=$_SESSION[image4];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image4] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>
                                                                <tr><td align="left">
                                                                        <?php if($_SESSION[image5])
                                                                        {  
                                                                        $img=$_SESSION[image5];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image5] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>
                                                                <tr><td align="left">
                                                                        <?php if($_SESSION[image6])
                                                                        {  
                                                                        $img=$_SESSION[image6];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image6] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>
                                                                <tr><td align="left">
                                                                        <?php if($_SESSION[image7])
                                                                        {  
                                                                        $img=$_SESSION[image7];
                                                                        list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                                                        $h=$height;
                                                                        $w=$width;
                                                                        if($h>200)	
                                                                        {
                                                                        $nh=200;
                                                                        $nw=($w/$h)*$nh;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }
                                                                        if($w>200)
                                                                        {
                                                                        $nw=200;
                                                                        $nh=($h/$w)*$nw;
                                                                        $h=$nh;
                                                                        $w=$nw;
                                                                        }

                                                                        ?>
                                                                        <img src="thumbnail/<?php echo  $_SESSION[image7] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                                    </td></tr>
                                                            </table></td></tr>
                                                </table>
                                                <?php
                                                } // end of right layout
                                                elseif($_SESSION[layout]=="layout_standard.gif")
                                                {
                                                ?>
                                                <table width=100% cellpadding="5">
                                                    <tr><td align="center" class="banner1"><?php echo $_SESSION[des]=stripslashes($_SESSION[des]);?></td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image1])
                                                            {  
                                                            $img=$_SESSION[image1];
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
                                                            <img src="thumbnail/<?php echo  $_SESSION[image1] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image2])
                                                            {  
                                                            $img=$_SESSION[image2];
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
                                                            <img src="thumbnail/<?php echo  $_SESSION[image2] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image3])
                                                            {  
                                                            $img=$_SESSION[image3];
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
                                                            <img src="thumbnail/<?php echo  $_SESSION[image3] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image4])
                                                            {  
                                                            $img=$_SESSION[image4];
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
                                                            <img src="thumbnail/<?php echo  $_SESSION[image4] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?>>  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image5])
                                                            {  
                                                            $img=$_SESSION[image5];
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
                                                            <img src="thumbnail/<?php echo  $_SESSION[image5] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?>>  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image6])
                                                            {  
                                                            $img=$_SESSION[image6];
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
                                                            <img src="thumbnail/<?php echo  $_SESSION[image6] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                    <tr><td align="center">
                                                            <?php if($_SESSION[image7])
                                                            {  
                                                            $img=$_SESSION[image7];
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
                                                            <img src="thumbnail/<?php echo  $_SESSION[image7] ?>" width=<?php echo  $w ?> height=<?php echo  $h ?> >  <?php } ?>

                                                        </td></tr>
                                                </table>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <table width=100% cellpadding="5" style="padding:50px">
                                                    <tr><td colspan="2" align="left" class="banner1">
                                                            <?php echo  $_SESSION[des]=stripslashes($_SESSION[des]); ?>
                                                        </td></tr>
                                                </table>
                                                <?php
                                                }
                                                ?>



                                            </td></tr>


                                        <?php
                                        $img=$theme_bottom;
                                        list($width, $height, $type, $attr) = getimagesize("images/$img");

                                        ?>	

                                        <tr>
                                            <td background="images/<?php echo $theme_bottom?>" style="background-repeat:no-repeat" width=100% height="<?php echo  $height ?>" align="left">
                                            </td></tr></table>
                                    <?php
                                    } // end of  
                                    else
                                    {
                                    ?>
                            <tr><td colspan="2" align="left" class="banner1">
                                    <?php echo  $_SESSION['des']=stripslashes($_SESSION['des']); ?>
                                </td></tr>
                            <?php
                            }
                            ?>
                    </td></tr>
            </table></td></tr>

    <tr><td>
            <table border="0" align="center" cellpadding="5" cellspacing="0" width=100% >
                <tr  valign="top">
                    <td bgcolor="#B8DEEE" height="30" valign="top" class="detail9txt">
                        <div align="left">
                            <b>Item Details</b></div></td>
                    <td bgcolor="#B8DEEE"><div align="right">
                            <a href="promotelistings.php?mode=change" class="header_text">Edit 
                                Item Details</a></div>
                    </td></tr>
                <?php if($_SESSION[min_amt])
                { 
                ?>
                <tr><td class="detail9txt"><b>Minimum Bid Amount</b></td><td align="left" class="banner1"><?php echo $_SESSION[currency]?>&nbsp;<?php echo  $_SESSION[min_amt]?></td></tr>
                <?php
                }
                ?>
                <?php if($bid_permission=='yes')
                { 
                ?>
                <tr><td class="detail9txt"><b>Bid Increment</b></td>
                    <td class="banner1">
                        <?php
                        if($_SESSION[bid_inc]=="")
                        {
                        $val=mysql_query("select * from bid_increment");
                        while($val_row=mysql_fetch_array($val))
                        {
                        if( ($val_row['bid_from'] <= $_SESSION[min_amt]) && ($_SESSION[min_amt] <= $val_row['bid_to']) )
                        {
                        $_SESSION['bid_inc']=$val_row['bid_inc'];
                        echo $val_row['bid_inc'];
                        }
                        }
                        }
                        else
                        { 
                        echo $_SESSION[bid_inc]; 
                        }?></td></tr>
                <?php
                }
                ?>
                <?php if($_SESSION[rev_price])
                {
                ?>
                <tr><td class="detail9txt"><b>Reserve Price</b></td><td class="banner1"><?php echo $_SESSION[currency]?>&nbsp;<?php echo  $_SESSION[rev_price] ?></td></tr>
                <?php
                }
                ?>
                <?php if($_SESSION[start_delay])
                {
                ?>
                <tr><td class="detail9txt"><b>Start Delay</b></td><td class="banner1"><?php echo  $_SESSION[start_delay]." Days" ?></td></tr>
                <?php
                }
                ?>
                <?php if($_SESSION[quick_price])
                {
                ?>
                <tr><td class="detail9txt"><b>Quick Buy Price</b></td><td class="banner1"><?php echo $_SESSION[currency]?>&nbsp;<?php echo  $_SESSION[quick_price] ?></td></tr>
                <?php
                }
                ?>
                <tr><td class="detail9txt"><b>Duration</b></td><td class="banner1"><?php echo  $_SESSION[dur] ?> <?php if($_SESSION[dur]==1) { echo "day"; } else if($_SESSION[dur] > 1) { echo "days"; } ?></td></tr>

                <tr><td class="detail9txt"><b>Quantity </b></td><td class="banner1"> <?php echo  $_SESSION[qty]; ?> </td></tr>

                <?php 
                if($_SESSION[theme_id])
                {
                ?>
                <tr><td class="detail9txt"><b>Listing Designer </b></td><td class="banner1">Theme:  <?php echo  $_SESSION[theme]; ?> 
                        <br />
                        <?php if($_SESSION[layout])
                        {
                        if($_SESSION[layout]=="layout_top.gif")
                        $layout_dis="Photo on the top";
                        if($_SESSION[layout]=="layout_left.gif")
                        $layout_dis="Photo on the left";
                        if($_SESSION[layout]=="layout_right.gif")
                        $layout_dis="Photo on the right";
                        if($_SESSION[layout]=="layout_bottom.gif")
                        $layout_dis="Photo on the bottom";
                        if($_SESSION[layout]=="layout_standard.gif")
                        $layout_dis="Standard";
                        ?>
                        Layout:
                        <?php echo  $layout_dis; ?> 
                        <?php
                        }
                        ?>
                    </td></tr>
                <?php
                }
                ?>
                <tr><td></td><td></td></tr>
            </table>
        </td></tr>
    <?php 	if(($_SESSION[image1] || $_SESSION[image2] || $_SESSION[image3] || $_SESSION[image4] || $_SESSION[image5] || $_SESSION[image6] || $_SESSION[image7] ) and empty($_SESSION[theme]))
    {
    ?>
    <tr><td>
            <table border="0" align="center" cellpadding="5" cellspacing="0" width=100%>
                <tr  valign="top">
                    <td bgcolor="#B8DEEE" height="30" valign="top" class="detail9txt">
                        <div align="left">
                            <b>Images</b></div></td>
                    <td bgcolor="#B8DEEE" colspan="2">
                        <div align="right"><a href="promotelistings.php?mode=change" class="header_text">Edit Images</a></div>
                    </td></tr>
                <?php 	if($_SESSION[image1])
                {
                $img=$_SESSION[image1];
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
                <tr align="center"><td><img src="thumbnail/<?php echo  $_SESSION[image1] ?>" width="<?php echo $w?>" height="<?php echo $h?>"></td>
                    <?php
                    }
                    ?>
                    <?php 	if($_SESSION[image2])
                    {
                    $img=$_SESSION[image2];
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
                    <td><img src="thumbnail/<?php echo  $_SESSION[image2] ?>" width="<?php echo $w?>" height="<?php echo $h?>"></td>
                    <?php
                    }
                    ?>
                    <?php 	if($_SESSION[image3])
                    {
                    $img=$_SESSION[image3];
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
                    <td><img src="thumbnail/<?php echo  $_SESSION[image3] ?>" width="<?php echo $w?>" height="<?php echo $h?>"></td>
                    <?php
                    }
                    ?>
                </tr>
                <?php 	if($_SESSION[image4])
                {
                $img=$_SESSION[image4];
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
                <tr align="center"><td><img src="thumbnail/<?php echo  $_SESSION[image4] ?>" width="<?php echo $w?>" height="<?php echo $h?>"></td>
                    <?php
                    }
                    ?>
                    <?php 	if($_SESSION[image5])
                    {
                    $img=$_SESSION[image5];
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
                    <td><img src="thumbnail/<?php echo  $_SESSION[image5] ?>" width="<?php echo $w?>" height="<?php echo $h?>"></td>
                    <?php
                    }
                    ?>
                    <?php 	if($_SESSION[image6])
                    {
                    $img=$_SESSION[image6];
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
                    <td><img src="thumbnail/<?php echo  $_SESSION[image6] ?>" width="<?php echo $w?>" height="<?php echo $h?>"></td>
                    <?php
                    }
                    ?>
                </tr>
                <?php 	if($_SESSION[image7])
                {
                $img=$_SESSION[image7];
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
                <tr align="center"><td><img src="thumbnail/<?php echo  $_SESSION[image7] ?>" width="<?php echo $w?>" height="<?php echo $h?>"></td></tr>
                <?php
                }
                ?>

            </table>
        </td></tr>
    <?php
    } //
    ?>
    <tr><td>
            <table border="0" align="center" cellpadding="5" cellspacing="0" width=100%>
                <tr  valign="top">
                    <td bgcolor="#B8DEEE" height="30" valign="top" class="detail9txt">
                        <div align="left">
                            <b>Shipping Details & Sales Tax </b></div></td>
                    <td bgcolor="#B8DEEE"><div align="right"><a href="ship_detail.php?mode=change" class="header_text">Edit 
                                Shipping Details & Sales Tax</a></div>
                    </td></tr>
                <tr><td valign="top" class="detail9txt"><b>Payment Address</b></td><td class="banner1">
                        <?php

                        $add_sql="select * from user_registration where user_id=$_SESSION[userid]";
                        $add_res=mysql_query($add_sql);
                        $add_row=mysql_fetch_array($add_res);
                        echo "<b>$add_row[user_name]</b>";
                        echo "<br>";
                        echo "$add_row[address]";
                        echo "<br>";
                        echo "$add_row[city]";
                        echo "<br>";
                        echo "$add_row[state]";
                        echo "<br>";
                        $country_sql="select * from country_master where country_id=".$add_row['country'];
                        $country_res=mysql_query($country_sql);
                        $country=mysql_fetch_array($country_res);
                        echo "$country[country]";
                        echo "<br>";
                        echo "$add_row[pin_code]";
                        ?>
                    </td></tr>
                <tr><td class="detail9txt"><b>Shipping Locations</b></td><td class="banner1">
                        <?php 
                        if(trim($_SESSION[shipping_route])!='')
                        {
                        $_SESSION[shipping_route1]=$_SESSION[shipping_route];
                        $shipping_array=$_SESSION[shipping_route1];
                        $shipping=explode(",",$shipping_array);



                        $ship_sql="select * from shipping_location";
                        $ship_res=mysql_query($ship_sql);
                        $total=mysql_num_rows($ship_res);
                        $j=1;

                        while($ship_row=mysql_fetch_array($ship_res))
                        {
                        for($i=0;$i<=$total;$i++)
                        {
                        if($ship_row['ship_id']==$shipping[$i])
                        {
                        ?>
                        <?php echo $ship_row[location];?>&nbsp;
                        <?php
                        }
                        }
                        }
                        } 
                        else
                        {
                        echo "Not Applicable";
                        }
                        ?>
                    </td></tr>
                <tr><td class="detail9txt"><b>Shipping Amount</b></td><td class="banner1">
                        <?php
                        if(empty($_SESSION['shipping_amt']) || $_SESSION['shipping_amt']=='0.00')
                        {
                        echo "-";
                        }
                        else
                        {
                        ?>
                        <?php echo $_SESSION[currency]?><?php echo  number_format(($_SESSION['shipping_amt']),2,'.',''); ?>
                        <?php
                        }
                        ?>
                    </td></tr>


                <?php
                if($_SESSION[refund_days])
                {
                ?>
                <tr><td class="detail9txt"><b>Item must be returned within:</b></td><td class="banner1"> <?php echo  $_SESSION[refund_days]; ?> <?php if($_SESSION[refund_days]==1) echo "day"; else echo "days";?> </td></tr>
                <?php
                }
                ?>
                <tr><td class="detail9txt"><b>Refund will be given as: </b></td><td class="banner1"><?php if($_SESSION[refund_method]!=''){ echo $_SESSION[refund_method]; } else { echo "Not Applicable"; }?> </td></tr>
                <tr><td class="detail9txt"><strong>Return Policy Details:</strong></td><td class="banner1"> <?php if(!empty($_SESSION[returnpolicy_instructions])) { echo stripslashes($_SESSION[returnpolicy_instructions]); } else { echo "Not Applicable"; } ?> </td></tr>
                <tr><td class="detail9txt"><strong>Payment instructions:</strong></td> <td class="banner1"> <?php if(trim($_SESSION[payment_instructions])!='') { echo stripslashes($_SESSION[payment_instructions]); } else { echo "Not Applicable"; }?> </td></tr>
                <?php
                if($_SESSION[tax])
                {
                ?>
                <tr><td class="detail9txt"><b>Sales Tax</b></td><td align="left" class="banner1"><?php echo $_SESSION[tax]?> %</td></tr>
                <?php
                }
                $total_shipping=$_SESSION['shipping_amt'];
                ?>
            </table>
        </td></tr>

    <?php

    $fee_sql="select * from admin_rates";
    $fee_res=mysql_query($fee_sql);
    $fee_row=mysql_fetch_array($fee_res);
    if($_SESSION[Gallery])
    $gallery_price=$fee_row[gallery_price];
    if($_SESSION[Highlight])
    $highlight_price=$fee_row[highlight_price];
    if($_SESSION[Bold])
    $bold_price=$fee_row[bold_price];
    if($_SESSION[Home])
    $homepage_price=$fee_row[homepage_price];
    $insertion_fee=$_SESSION[Insertionfee];
    if($_SESSION[listingdesinger])
    $listing_desinger_fee=$fee_row[listing_designer_fee];
    if($_SESSION[subtitle])
    $subtitle_price=$fee_row[subtitle_price];
    if($_SESSION[rev_price])
    $reserve_fee=$fee_row[reserve_price_fee];
    $Image_listing_fee=$fee_row['Image_listing_fee'];


    $total_setup_fee=0;

    $inser_sql="select * from admin_settings where set_id=57";
    $inser_res=mysql_query($inser_sql);
    $inser_row=mysql_fetch_array($inser_res);
    $insertionfeeper=$inser_row[set_value];


    ?>
    <tr bgcolor="#B8DEEE">
        <td><font size="2" class="detail9txt"><b>Review the Fees and Submit the Listings</b></font></td>
    </tr>
    <tr><td align="left">
            <table cellpadding="5" cellspacing="2" width=40% >
                <?php 
                if($insertionfeeper=="yes")
                {
                if(($_SESSION[sell_method]=="dutch_auction") or ($_SESSION[sell_method]=="auction"))
                {
                $amt=$_SESSION[min_amt];
                }
                if($_SESSION[sell_method]=="fix")
                {
                $amt=$_SESSION[quick_price];
                }
                $sqlinsfee="select * from insertion_fee_master where $amt between amt_from and amt_to";
                $sqlqryinsfee=mysql_query($sqlinsfee);
                $sqlfetchinsfee=mysql_fetch_array($sqlqryinsfee);
                $insertionfee=$sqlfetchinsfee['insertionfee'];
                if(empty($insertionfee))
                {
                $insertionfee=0;
                }
                $_SESSION[Insertionfee]=$insertionfee;
                $insertionfee=number_format($insertionfee,2);
                $total_setup_fee=$total_setup_fee+$insertionfee;
                ?>
                <tr><td align="right" class="detail9txt"><b>Insertion Fee:</b></td><td align="left" class="banner1">
                        <?php if($insertionfee)
                        {
                        ?>
                        <?php echo  $insertionfee ?>&nbsp;<?php echo  $default_cur_code ?>
                        <?php
                        }
                        else
                        {
                        ?>
                        Free
                        <?php
                        }
                        ?>
                    </td></tr>
                <?php
                }
                if(!empty($_SESSION[rev_price]))
                {
                $total_setup_fee=$total_setup_fee+$reserve_fee;
                ?>
                <tr bgclor=#eeeeee><td align="right" class="detail9txt"><b>Reserve Price Fee:</b></td><td align="left" class="banner1">
                        <?php if(!empty($reserve_fee))
                        {
                        ?> <?php echo  $reserve_fee ?>&nbsp;<?php echo  $default_cur_code ?>
                        <?php
                        }
                        else
                        {
                        ?>
                        Free
                        <?php
                        }
                        ?></td></tr>
                <?php
                }
                if($Gallery)
                {
                $total_setup_fee=$total_setup_fee+$gallery_price;
                ?>
                <tr bgclor=#eeeeee><td align="right" class="detail9txt"><b>Gallery Items Fees:</b></td><td align="left" class="banner1">
                        <?php if($gallery_price)
                        {
                        ?>
                        <?php echo  $gallery_price ?>&nbsp;<?php echo  $default_cur_code ?>
                        <?php
                        }
                        else
                        {
                        ?>
                        Free
                        <?php
                        }
                        ?></td></tr>
                <?php
                }
                if($Bold)
                {
                $total_setup_fee=$total_setup_fee+$bold_price;
                ?>
                <tr bgclor=white><td align="right" class="detail9txt"><b>Bold Items Fees:</b></td><td align="left" class="banner1">
                        <?php if($bold_price)
                        {
                        ?>
                        <?php echo  $bold_price ?>&nbsp;<?php echo  $default_cur_code ?><?php
                        }
                        else
                        {
                        ?>
                        Free
                        <?php
                        }
                        ?> </td></tr>
                <?php
                }
                if($Highlight)
                {
                $total_setup_fee=$total_setup_fee+$highlight_price;
                ?>
                <tr bgclor=#eeeeee><td align="right" class="detail9txt"><b>Highlight Items Fees:</b></td><td align="left" class="banner1">
                        <?php if($highlight_price)
                        {
                        ?>
                        <?php echo  $highlight_price ?>&nbsp;<?php echo  $default_cur_code ?><?php
                        }
                        else
                        {
                        ?>
                        Free
                        <?php
                        }
                        ?> </td></tr>
                <?php
                }
                if($_SESSION[listingdesinger])
                {
                $total_setup_fee=$total_setup_fee+$listing_desinger_fee;
                ?>
                <tr bgclor=white><td align="right" class="detail9txt"><b>Listing Designer Fee:</b></td>
                    <td align="left" class="banner1">
                        <?php if(!empty($listing_desinger_fee))
                        {
                        ?>
                        <?php echo $listing_desinger_fee ?>&nbsp;<?php echo  $default_cur_code ?>
                        <?php
                        }
                        else
                        {
                        ?>
                        Free
                        <?php
                        }
                        ?>

                    </td></tr>
                <?php
                }
                if($_SESSION[subtitle])
                {
                $total_setup_fee=$total_setup_fee+$subtitle_price;
                ?>
                <tr bgclor=white><td align="right" class="detail9txt"><b>Subtitle Items Fees:</b></td>
                    <td align="left" class="banner1"><?php if($subtitle_price)
                        {
                        ?><?php echo  $subtitle_price ?>&nbsp;<?php echo  $default_cur_code ?><?php
                        }
                        else
                        {
                        ?>
                        Free
                        <?php
                        }
                        ?> </td></tr>
                <?php
                }
                $addtional_pic_fee="";
                if($_SESSION[img2] || $_SESSION[img3] || $_SESSION[img4] || $_SESSION[img5] || $_SESSION[img6] || $_SESSION[img7])
                {
                if($_SESSION[img2])
                {
                $addtional_pic_fee=$addtional_pic_fee+$Image_listing_fee;
                }
                if($_SESSION[img3])
                {
                $addtional_pic_fee=$addtional_pic_fee+$Image_listing_fee;
                }

                if($_SESSION[img4])
                {
                $addtional_pic_fee=$addtional_pic_fee+$Image_listing_fee;
                }
                if($_SESSION[img5])
                {
                $addtional_pic_fee=$addtional_pic_fee+$Image_listing_fee;
                }

                if($_SESSION[img6])
                {
                $addtional_pic_fee=$addtional_pic_fee+$Image_listing_fee;
                }

                if($_SESSION[img7])
                {
                $addtional_pic_fee=$addtional_pic_fee+$Image_listing_fee;
                }

                $_SESSION[addtional_pic_fee]=$addtional_pic_fee;
                $addtional_pic_fee=number_format($addtional_pic_fee,2);
                $total_setup_fee=$total_setup_fee+$addtional_pic_fee;
                $total_setup_fee=number_format($total_setup_fee,2);
                ?>
                <tr bgclor=white><td align="right" class="detail9txt"><b>Additional Pictures Fees:</b></td>
                    <td align="left" class="banner1">
                        <?php if($addtional_pic_fee)
                        {
                        ?>
                        <?php echo  $addtional_pic_fee ?>&nbsp;<?php echo  $default_cur_code ?>
                        <?php
                        }
                        else
                        {
                        ?>
                        Free
                        <?php
                        }
                        ?> 
                    </td></tr>
                <?php
                }
                if($Home)
                {
                $total_setup_fee=$total_setup_fee+$homepage_price;
                ?>
                <tr bgclor=#eeeeee><td align="right" class="detail9txt"><b>Homepage Featured Items Fees:</b></td><td align="left" class="banner1">
                        <?php if($homepage_price)
                        {
                        ?>
                        <?php echo  $homepage_price ?>&nbsp;<?php echo  $default_cur_code ?> 
                        <?php
                        }
                        else
                        {
                        ?>
                        Free
                        <?php
                        }
                        ?>
                    </td></tr>
                <?php
                }
                $_SESSION[total_setup_fee]=$total_setup_fee;
                ?>
                <tr><td colspan="2"><hr /></td></tr>
                <tr bgclor=white><td align="right" class="detail9txt"><b>Total Setup Fees:</b></td><td align="left" class="banner1">
                        <?php if($total_setup_fee)
                        {
                        ?>
                        <?php echo  $total_setup_fee ?>&nbsp;<?php echo  $default_cur_code ?><?php
                        }
                        else
                        {
                        ?>
                        Free
                        <?php
                        }
                        ?></td></tr>
                <tr><td colspan="2"><hr /></td></tr>
            </table>
        </td></tr>		
    <tr><td>
            <form name=preview action="preview.php" method=post>
                <table align="center">
                    <tr><td>
                            <input type="hidden" name="flag" value=1>
                            <!--<input type="button" value="Cancel" onClick="cancel()">-->
                        </td>
                        <td><input type="image" src="images/submit.gif" name="Image85" width="62" height="22" border="0" id="Image85" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image85', '', 'images/submito.gif', 1)"/></td>
                    </tr></table>
            </form>
        </td></tr></td></tr>
</table></td></tr></table></td></tr></table>
<?php
}
?>