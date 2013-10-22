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
?>
<?php session_start();
require 'include/top.php';
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
    <tr><td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="border2">
                <link href="<?php= $ret1; ?>" rel="stylesheet" type="text/css">
                <?php
                if($sucess==1)
                {
                ?>
                <tr height=40 bgcolor="#eeeee1">
                    <td class="tr_border"><font size="3"><b>
                            &nbsp;Sell Your Item: Congratulations</b></font></td></tr>
                <tr bgcolor="#eeeee1"><td valign="top">
                        <table cellpadding="5" cellspacing="2" align="center" class="table_topless_border" width="100%">
                            <tr bgcolor="#eeeee1"><td><font size="2" color=green><b>You have successfully listed your item.</b></font></td></tr>
                            <tr bgcolor="#eeeee1"><td><b>View your listing:</b>&nbsp;<a href="item_details.php?id=<?php=$_SESSION['itemidd']; ?> "><?php= $_SESSION[item_name]; ?></a></td></tr>
                            <tr>
                                <td>

                                    &nbsp;&nbsp;&nbsp; or <a href="choose_sell_format.php">Sell a Different Item </a>
                                </td></tr>
                        </table></td></tr>

        </td></tr>
    <tr><td><?php require 'include/footer.php'; ?></td></tr></table>

<?php
$_SESSION[item_name]="";
exit();
}
else
{
?>
<tr><td >
        <table width="100%" cellpadding="5" cellspacing="0" align="center" border="0" bgcolor="#eeeee1">
            <tr height=40 bgcolor="#eeeee1">
                <td class="tr_border"><font size="3"><b>
                        Sell Your Item:Preview &amp; Submit</b></font></td></tr>

            <tr bgcolor="#eeeee1">
                <td height="30" colspan="2" >
                    1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;Title & Description 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;&nbsp;3.Pictures & Details	
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.&nbsp;Shipping Details & Sales Tax
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.<b>&nbsp;Preview & Submit</b></td>
            </tr>
            <?php
            }
            ?>
            <tr bgcolor="#eeeee1"><td>&nbsp;</td></tr>
            <!-- <tr >
            <td class="tr_top_border"><font size=2><b>Step 1: Review Your Listing</b></font>
            </td></tr>
            <tr><td><a href="review.php">review</a><br><hr color="#999999" noshade></td></tr> -->
            <tr bgcolor="#eeeee1">
                <td class="tr_top_border"><font size=2><b>Step 1: Edit Your Listing</b></font>
                </td></tr>
            <tr bgcolor="#eeeee1"><td>Click on 'Edit' link to make changes. When you do, you'll be directed to a page where you can make your desired changes. </td></tr>
            <!-- <tr><td>
            <table border="0" align="center" cellpadding="5" cellspacing="0" width=100% class="table_border_with_bg1">
                    <tr  valign="top">
                    <td bgcolor="#CCCCCC" height="30" valign="top">
                    <div align="left">
                <b>Categories</b></div></td><td bgcolor="#CCCCCC">
                    <div align="right"><a href="sell_item_cate.php?mode=change">Edit Category</a></div>
                    </td></tr>
                    <tr><td colspan="2">
                    <?php
                     $cat="select category_name from category_master where category_id=".$_SESSION[categoryid];
                 $cat_res=mysql_query($cat);
                 $cat_row=mysql_fetch_array($cat_res); 
                     echo $cat_row[category_name];
                    ?></td></tr>
                    </table>
            </td></tr> -->

            <tr bgcolor="#eeeee1"><td>
                    <table border="0" align="center" cellpadding="5" cellspacing="0" width=100% class="table_border_with_bg1">
                        <tr  valign="top">
                            <td bgcolor="#CCCCCC" height="30" valign="top">
                                <div align="left">
                                    <b>Item Title </b></div></td>
                            <td bgcolor="#CCCCCC"><div align="right"><a href="sell_item_detail.php?mode=change">Edit 
                                        Item Title</a></div>
                            </td></tr>
                        <tr bgcolor="#eeeee1"><td ><?php= $_SESSION[item_name]; ?> </td></tr>
                    </table></td></tr>
            <?php 
            if($_SESSION[subtitle])
            { 
            ?>
            <tr bgcolor="#eeeee1"><td>
                    <table border="0" align="center" cellpadding="5" cellspacing="0" width=100% bgcolor="#eeeee1">
                        <tr  valign="top">
                            <td bgcolor="#CCCCCC" height="30" valign="top">
                                <div align="left">
                                    <b>Subtitle </b></div></td>
                            <td bgcolor="#CCCCCC"><div align="right"><a href="sell_item_detail.php?mode=change">Edit 
                                        Subtitle</a></div>
                            </td></tr>
                        <tr><td> <?php= $_SESSION[subtitle]; ?> </td></tr>
                    </table></td></tr>
            <?php
            }
            ?>
            <tr><td>
                    <table border="0" align="center" cellpadding="5" cellspacing="0" width=100% class="table_border_with_bg1">
                        <tr  valign="top" bgcolor="#eeeee1">
                            <td bgcolor="#CCCCCC" height="30" valign="top">
                                <div align="left">
                                    <b>Item Description </b></div></td>
                            <td bgcolor="#CCCCCC"><div align="right"><a href="sell_item_detail.php?mode=change">Edit 
                                        Item Description</a></div>
                            </td></tr>
                        <tr bgcolor="#eeeee1"><td colspan="2" align="left">
                                <?php 
                                if($_SESSION[theme_id])
                                {
                                $img=$theme_top;
                                list($width, $height, $type, $attr) = getimagesize("../images/$img");
                                ?>
                                <table width="100%" cellpadding="5" cellspacing="0" align="left">
                                    <tr><td background="../images/<?php= $theme_top ?>" style="background-repeat:no-repeat"  height=<?php= $height ?> align="left"  ></td></tr>
                                    <tr><td background="../images/<?php= $theme_content ?>"  style="background-repeat:repeat-y" align="left" >
                                            <?php
                                            if($_SESSION[layout]=="layout_top.gif")
                                            {
                                            ?>
                                            <table width=100% cellpadding="5" style="padding:50px">
                                                <tr><td align="center">
                                                        <?php if($_SESSION[image1])
                                                        {  
                                                        $img=$_SESSION[image1];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                                <tr><td style="padding:50px" >  <?php= $_SESSION[des]; ?>  </td></tr>
                                                <tr><td style="padding:50px" >  <?php= $_SESSION[des1]; ?>  </td></tr>

                                                <tr><td align="center" >
                                                        <?php if($_SESSION[image2])
                                                        {  
                                                        $img=$_SESSION[image2];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>

                                                <tr><td align="center">
                                                        <?php if($_SESSION[image3])
                                                        {  
                                                        $img=$_SESSION[image3];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                                <tr><td align="center">
                                                        <?php if($_SESSION[image4])
                                                        {  
                                                        $img=$_SESSION[image4];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                                <tr><td align="center">
                                                        <?php if($_SESSION[image5])
                                                        {  
                                                        $img=$_SESSION[image5];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                                <tr><td align="center">
                                                        <?php if($_SESSION[image6])
                                                        {  
                                                        $img=$_SESSION[image6];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                                <tr><td align="center">
                                                        <?php if($_SESSION[image7])
                                                        {  
                                                        $img=$_SESSION[image7];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image7] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                            </table>
                                            <?php
                                            } // end of top layout
                                            ?> 
                                            <?php
                                            if($_SESSION[layout]=="layout_bottom.gif")
                                            {
                                            ?>
                                            <table width=100% cellpadding="5" >
                                                <tr><td style="padding:50px" >  <?php= $_SESSION[des]; ?>  </td></tr>
                                                <tr><td style="padding:50px" >  <?php= $_SESSION[des1]; ?>  </td></tr>	
                                                <tr><td align="center">
                                                        <?php if($_SESSION[image1])
                                                        {  
                                                        $img=$_SESSION[image1];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>


                                                <tr><td align="center">
                                                        <?php if($_SESSION[image2])
                                                        {  
                                                        $img=$_SESSION[image2];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>

                                                <tr><td align="center">
                                                        <?php if($_SESSION[image3])
                                                        {  
                                                        $img=$_SESSION[image3];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                                <tr><td align="center">
                                                        <?php if($_SESSION[image4])
                                                        {  
                                                        $img=$_SESSION[image4];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                                <tr><td align="center">
                                                        <?php if($_SESSION[image5])
                                                        {  
                                                        $img=$_SESSION[image5];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                                <tr><td align="center">
                                                        <?php if($_SESSION[image6])
                                                        {  
                                                        $img=$_SESSION[image6];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                                <tr><td align="center">
                                                        <?php if($_SESSION[image7])
                                                        {  
                                                        $img=$_SESSION[image7];
                                                        list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                        <img src="../images/<?php= $_SESSION[image7] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                    </td></tr>
                                            </table>
                                            <?php
                                            } // end of bottom layout
                                            ?> 
                                            <?php
                                            if($_SESSION[layout]=="layout_left.gif")
                                            {
                                            ?>
                                            <table width=100% cellpadding="5" >
                                                <tr><td align="left" style="padding:50px"> <table >
                                                            <tr><td align="center">
                                                                    <?php if($_SESSION[image1])
                                                                    {  
                                                                    $img=$_SESSION[image1];
                                                                    list($width, $height, $type,$attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>


                                                            <tr><td align="center">
                                                                    <?php if($_SESSION[image2])
                                                                    {  
                                                                    $img=$_SESSION[image2];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>

                                                            <tr><td align="center">
                                                                    <?php if($_SESSION[image3])
                                                                    {  
                                                                    $img=$_SESSION[image3];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>
                                                            <tr><td align="center">
                                                                    <?php if($_SESSION[image4])
                                                                    {  
                                                                    $img=$_SESSION[image4];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>
                                                            <tr><td align="center">
                                                                    <?php if($_SESSION[image5])
                                                                    {  
                                                                    $img=$_SESSION[image5];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>
                                                            <tr><td align="center">
                                                                    <?php if($_SESSION[image6])
                                                                    {  
                                                                    $img=$_SESSION[image6];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>
                                                            <tr><td align="center">
                                                                    <?php if($_SESSION[image7])
                                                                    {  
                                                                    $img=$_SESSION[image7];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image7] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>
                                                        </table></td><td style="padding:50px" valign="top">  <?php= $_SESSION[des]; ?> <br /><?php= $_SESSION['des1']; ?>  </td></tr>
                                            </table>
                                            <?php
                                            } // end of left layout
                                            ?> 

                                            <?php
                                            if($_SESSION[layout]=="layout_right.gif")
                                            {
                                            ?>
                                            <table width=100% cellpadding="5" >
                                                <tr>
                                                    <td style="padding:50px" valign="top">  <?php= $_SESSION[des]; ?> <br /><?php=$_SESSION['des1']; ?> </td>
                                                    <td style="padding-right:50px">
                                                        <table bgcolor="#eeeee1">
                                                            <tr bgcolor="#eeeee1"><td align="left">
                                                                    <?php if($_SESSION[image1])
                                                                    {  
                                                                    $img=$_SESSION[image1];
                                                                    list($width, $height, $type,$attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>


                                                            <tr bgcolor="#eeeee1"><td align="left">
                                                                    <?php if($_SESSION[image2])
                                                                    {  
                                                                    $img=$_SESSION[image2];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>

                                                            <tr bgcolor="#eeeee1"><td align="left">
                                                                    <?php if($_SESSION[image3])
                                                                    {  
                                                                    $img=$_SESSION[image3];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>
                                                            <tr bgcolor="#eeeee1"><td align="left">
                                                                    <?php if($_SESSION[image4])
                                                                    {  
                                                                    $img=$_SESSION[image4];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>
                                                            <tr bgcolor="#eeeee1"><td align="left">
                                                                    <?php if($_SESSION[image5])
                                                                    {  
                                                                    $img=$_SESSION[image5];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>
                                                            <tr bgcolor="#eeeee1"><td align="left">
                                                                    <?php if($_SESSION[image6])
                                                                    {  
                                                                    $img=$_SESSION[image6];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                </td></tr>
                                                            <tr bgcolor="#eeeee1"><td align="left">
                                                                    <?php if($_SESSION[image7])
                                                                    {  
                                                                    $img=$_SESSION[image7];
                                                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                    <img src="../images/<?php= $_SESSION[image7] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
                                                                </td></tr>
                                                        </table></td></tr>
                                            </table>
                                            <?php
                                            } // end of right layout
                                            if($_SESSION[layout]=="layout_standard.gif")
                                            {
                                            ?> 
                                            <table width=100% cellpadding="5" bgcolor="#eeeee1">
                                                <tr><td style="padding:50px" align="center" >  <?php= $_SESSION[des]; ?>  </td></tr>
                                                <tr><td style="padding:50px" align="center" >  <?php= $_SESSION[des1]; ?>  </td></tr>
                                                <tr><td align="center">
                                                        <table><tr><td><table><tr><td>
                                                                                <?php if($_SESSION[image1])
                                                                                {  
                                                                                $img=$_SESSION[image1];
                                                                                list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                                <img src="../images/<?php= $_SESSION[image1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                            </td></tr></table>
                                                                </td>
                                                                <td>   
                                                                    <table bgcolor="#eeeee1">
                                                                        <tr><td align="center">
                                                                                <?php if($_SESSION[image2])
                                                                                {  
                                                                                $img=$_SESSION[image2];
                                                                                list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                                <img src="../images/<?php= $_SESSION[image2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                            </td></tr>

                                                                        <tr><td align="center">
                                                                                <?php if($_SESSION[image3])
                                                                                {  
                                                                                $img=$_SESSION[image3];
                                                                                list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                                <img src="../images/<?php= $_SESSION[image3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                            </td></tr>
                                                                        <tr bgcolor="#eeeee1"><td align="center">
                                                                                <?php if($_SESSION[image4])
                                                                                {  
                                                                                $img=$_SESSION[image4];
                                                                                list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                                <img src="../images/<?php= $_SESSION[image4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                            </td></tr>
                                                                        <tr bgcolor="#eeeee1"><td align="center">
                                                                                <?php if($_SESSION[image5])
                                                                                {  
                                                                                $img=$_SESSION[image5];
                                                                                list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                                <img src="../images/<?php= $_SESSION[image5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                            </td></tr>
                                                                        <tr bgcolor="#eeeee1"><td align="center">
                                                                                <?php if($_SESSION[image6])
                                                                                {  
                                                                                $img=$_SESSION[image6];
                                                                                list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                                <img src="../images/<?php= $_SESSION[image6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                            </td></tr>
                                                                        <tr bgcolor="#eeeee1"><td align="center">
                                                                                <?php if($_SESSION[image7])
                                                                                {  
                                                                                $img=$_SESSION[image7];
                                                                                list($width, $height, $type, $attr) = getimagesize("../images/$img");
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
                                                                                <img src="../images/<?php= $_SESSION[image7] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>

                                                                            </td></tr></table></td></tr></table></td></tr></table>






                                            <?php
                                            }
                                            ?>
                                        </td></tr>
                                    <?php
                                    $img=$theme_bottom;
                                    list($width, $height, $type, $attr) = getimagesize("../images/$img");

                                    ?>	

                                    <tr bgcolor="#eeeee1"><td background="../images/<?php= $theme_bottom ?>" style="background-repeat:no-repeat" width=100% height=<?php= $height ?> align="left" >
                                    </td></tr></table>




                            <?php
                            } // end of  
                            else
                            {
                            ?>
                    <tr bgcolor="#eeeee1"><td colspan="2" align="left">
                            <?php= $_SESSION[des]; ?>
                        </td></tr>
                    <?php
                    }
                    ?>

            </td></tr>



    </table></td></tr>

<tr><td>
        <table border="0" align="center" cellpadding="5" cellspacing="0" width=100% bgcolor="#eeeee1">
            <tr  valign="top">
                <td bgcolor="#CCCCCC" height="30" valign="top">
                    <div align="left">
                        <b>Item Details</b></div></td>
                <td bgcolor="#CCCCCC"><div align="right">
                        <a href="promotelistings.php?mode=change">Edit 
                            Item Details</a></div>
                </td></tr>
            <?php
            $cur=mysql_query("select * from admin_settings where set_id=59");
            $def_cur=mysql_fetch_array($cur);
            $curr=$def_cur['set_value'];
            ?>
            <!--  <tr><td><b>Currency</b></td><td align="left"><?php=$_SESSION[currency]?></td></tr> -->
            <?php if($_SESSION[min_amt])
            { 
            ?>
            <tr bgcolor="#eeeee1"><td><b>Minimum Bid Amount</b></td><td align="left"><?php=$curr.$_SESSION[min_amt]?></td></tr>
            <?php
            }
            ?>
            <?php if($bid_permission=='yes')
            { 
            ?>
            <tr bgcolor="#eeeee1"><td><b>Bid Increment </b></td>
                <td>
                    <?php
                    if($_SESSION[bid_inc]=="")
                    {
                    $val=mysql_query("select * from bid_increment");
                    while($val_row=mysql_fetch_array($val))
                    {
                    if( ($val_row['bid_from'] <= $_SESSION[min_amt]) && ($_SESSION[min_amt] <= $val_row['bid_to']) )
                    {
                    $_SESSION['bid_inc']=$val_row['bid_inc'];
                    echo $curr.$val_row['bid_inc'];
                    }
                    }
                    }
                    else
                    { 
                    echo $curr.$_SESSION[bid_inc]; 
                    }?></td></tr>
            <?php
            }
            ?>
            <?php if($_SESSION[rev_price])
            {
            ?>
            <tr bgcolor="#eeeee1"><td><b>Reserve Price</b></td><td><?php= $curr.$_SESSION[rev_price] ?></td></tr>
            <?php
            }
            ?>
            <?php if($_SESSION[start_delay])
            {
            ?>
            <tr bgcolor="#eeeee1"><td><b>Start Delay</b></td><td><?php= $_SESSION[start_delay]." Days" ?></td></tr>
            <?php
            }
            ?>
            <?php if($_SESSION[quick_price])
            {
            ?>
            <tr bgcolor="#eeeee1"><td><b>Quick Buy Price</b></td><td><?php=$curr.$_SESSION[quick_price] ?></td></tr>
            <?php
            }
            ?>
            <tr bgcolor="#eeeee1"><td><b>Duration  </b></td><td><?php= $_SESSION[dur]."Days" ?></td></tr>
            <!-- <tr><td><b>Size of Quantity</b></td><td><?php= $_SESSION[size_of_qty] ?></td></tr> -->

            <tr bgcolor="#eeeee1"><td><b>Quantity </b></td><td> <?php= $_SESSION[qty]; ?> </td></tr>

            <?php if($_SESSION[theme_id])
            {
            ?>
            <tr bgcolor="#eeeee1"><td><b>Listing Designer </b></td><td>Theme:  <?php= $_SESSION[theme]; ?> 
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
                    <?php= $layout_dis; ?> 
                    <?php
                    }
                    ?>
                </td></tr>
            <?php
            }
            ?>
            <tr bgcolor="#eeeee1"><td></td><td></td></tr>
        </table>
    </td></tr>
<?php 	if(($_SESSION[image1] || $_SESSION[image2] || $_SESSION[image3] || $_SESSION[image4] || $_SESSION[image5] || $_SESSION[image6] || $_SESSION[image7] )and empty($_SESSION[theme_id]))
{
?>

<tr bgcolor="#eeeee1"><td>
        <table border="0" align="center" cellpadding="5" cellspacing="0" width=100% bgcolor="#eeeee1">
            <tr  valign="top" bgcolor="#eeeee1">
                <td bgcolor="#CCCCCC" height="30" valign="top">
                    <div align="left">
                        <b>Images</b></div></td><td bgcolor="#CCCCCC" colspan="2">
                    <div align="right"><a href="promotelistings.php?mode=change">Edit Images</a></div>
                </td></tr>
            <?php 	if($_SESSION[image1])
            {
            ?>
            <tr align="center" bgcolor="#eeeee1"><td><img src="../images/<?php= $_SESSION[image1] ?>"></td>
                <?php
                }
                ?>
                <?php 	if($_SESSION[image2])
                {
                ?>
                <td><img src="../images/<?php= $_SESSION[image2] ?>"></td>
                <?php
                }
                ?>
                <?php 	if($_SESSION[image3])
                {
                ?>
                <td><img src="../images/<?php= $_SESSION[image3] ?>"></td>
                <?php
                }
                ?>
            </tr>
            <?php 	if($_SESSION[image4])
            {
            ?>
            <tr align="center"><td><img src="../images/<?php= $_SESSION[image4] ?>"></td>
                <?php
                }
                ?>
                <?php 	if($_SESSION[image5])
                {
                ?>
                <td><img src="../images/<?php= $_SESSION[image5] ?>"></td>
                <?php
                }
                ?>
                <?php 	if($_SESSION[image6])
                {
                ?>
                <td><img src="../images/<?php= $_SESSION[image6] ?>"></td>
                <?php
                }
                ?>
            </tr>
            <?php 	if($_SESSION[image7])
            {
            ?>
            <tr align="center"><td><img src="../images/<?php= $_SESSION[image7] ?>"></td></tr>
            <?php
            }
            ?>

        </table>
    </td></tr>
<?php
} //
?>
<tr bgcolor="#eeeee1"><td>
        <table border="0" align="center" cellpadding="5" cellspacing="0" width=100% class="table_border_with_bg1">
            <tr  valign="top" bgcolor="#eeeee1">
                <td bgcolor="#CCCCCC" height="30" valign="top">
                    <div align="left">
                        <b>Shipping Details & Sales Tax </b></div></td>
                <td bgcolor="#CCCCCC"><div align="right"><a href="ship_detail.php?mode=change">Edit 
                            Shipping Details & Sales Tax</a></div>
                </td></tr>
            <tr bgcolor="#eeeee1"><td><b>Payment Address</b></td><td>
                    <?php

                    $add_sql="select * from user_registration where user_id=$_SESSION[users_id]";
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
                    echo "$add_row[country]";
                    echo "<br>";
                    echo "$add_row[phoneno]";
                    ?>
                </td></tr>
            <tr bgcolor="#eeeee1"><td><b>Shipping Locations</b></td><td>
                    <?php 
                    if($_SESSION[shipping_route])
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
                    <?php=$ship_row[location];?>&nbsp;
                    <?php
                    }
                    }
                    }
                    } 
                    ?>
                </td></tr>
            <tr bgcolor="#eeeee1"><td><b>Shipping Amount</b></td><td> <?php= $curr.$_SESSION[shipping_amt]; ?> </td></tr>
            <!--	<tr bgcolor="#eeeee1"><td><b>Buyer Requirements</b></td><td>
                
            <?php
            if($_SESSION[buyerrequirements]=="yes")
            {
            ?>
            <p>Block Buyer Who:<br /> 
            
             <?php IF($_SESSION[blockbuyercountries]) 
             {
             ?>
             <div>Are registered in countries to which I don't ship</div>
             <?php
             }
             ?>
             <?php IF($_SESSION[blockbuyerfeedbakscore]) 
             {
             ?>
             <div>Have a feedback score of <?php= $_SESSION[feedbackscore] ?> or lower</div>
             <?php
             }
             ?>
             <?php IF($_SESSION[blockunpaidistrick]) 
             {
             ?>
            <div>Have received 2 Unpaid Item strikes in the last 30 days</div>
             <?php
             }
             ?>
             <?php IF($_SESSION[ItemLimitoption]) 
             {
             ?>
             Are currently winning or have bought  <?php= $_SESSION[ItemLimitoption] ?> of your items in 10 the last  days  
             <?php
             }
             ?>
            </div>
            <?php
            }
            else
            {
            ?>
            You have no buyer requirements set. 
            <?php
            }
            ?>			
            <!--		<p>Are registered in countries to which I don't ship</p>
                        <p>Have a feedback score of -2 or lower</p>
                        <p>Have received 2 Unpaid Item strikes in the last 30 days</p>
                        <p>Are currently winning or have bought 7 of your items in the last 10 days</p> -->
            <!--	</td>
                    </tr>-->
            <tr bgcolor="#eeeee1"><td><b>Item must be returned within:</b></td><td> <?php= $_SESSION[refund_days]; ?> </td></tr>
            <tr bgcolor="#eeeee1"><td><b>Refund will be given as: </b></td><td> <?php= $_SESSION[refund_method]; ?> </td></tr>
            <tr bgcolor="#eeeee1"><td><strong>Return Policy Details:</strong></td><td> <?php= $_SESSION[returnpolicy_instructions]; ?> </td></tr>
            <tr bgcolor="#eeeee1"><td><strong>Payment instructions:</strong></td> <td> <?php= $_SESSION[payment_instructions]; ?> </td></tr>
            <tr bgcolor="#eeeee1"><td><b>Tax</b></td><td align="left"><?php=$_SESSION[tax]."%"?></td></tr>
        </table>
    </td></tr>




<tr bgcolor="#eeeee1"><td>
        <form name=preview action="preview.php" method=post>
            <table align="center">
                <tr bgcolor="#eeeee1"><td>
                        <input type="hidden" name="flag" value=1>
                        <input type="button" value="Cancel" onClick="cancel()">
                    </td>
                    <td><input type="submit" value="Submit"></td>
                </tr></table>
        </form>
    </td></tr></td></tr>
