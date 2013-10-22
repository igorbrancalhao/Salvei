<?php
/***************************************************************************
*File Name				:editpromotionlistings.tpl
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
<table width="958" cellpadding="0" cellspacing="5" border=0 align="center">
    <tr>
        <td><table width="948" height="27" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5">
                <tr>
                    <td height="30" colspan="2" class="banner1">
                        1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;Title & Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>3.Pictures & Details </b>4.&nbsp;Shipping Details & Sales Tax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;Preview & Submit </td>
                </tr></table></td></tr>

    <?php if($err_flag==1)
    { 
    ?>
    <tr><td>
            <table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom" align="center">
                <tr><td>
                        <img src="images/warning_39x35.gif"></td>
                    <td><font class="moretxt">The following must be corrected before continuing:</font></td></tr>
                <?php if(!empty($err_min_amt))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#txt_min_amt" class="header_text2">Minimum Bid Amount</a> - <?php= $err_min_amt; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_fix_price))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#txt_quick" class="header_text2">Quick Buy Price</a> - <?php= $err_fix_price; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_rev_price))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#txt_rev_price" class="header_text2">Reserve Price</a> - <?php= $err_rev_price; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_qty))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#txt_qty" class="header_text2">Quantity</a> - <?php= $err_qty; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_dur))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#cbodur" class="header_text2">Duration</a> - <?php= $err_dur; ?></td></tr>
                <?php 
                }
                ?>

                <?php 
                if(!empty($err_size_qty))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#size_of_qty" class="header_text2">Size of Quantity</a> - <?php= $err_size_qty; ?></td></tr>
                <?php 
                } 
                ?>

                <?php
                if($bid_permission=='yes')
                {
                if(!empty($err_bid_inc))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#txt_bid_inc" class="header_text2">Bid Increment</a> - <?php= $err_bid_inc; ?></td></tr>
                <?php 
                } 
                }
                ?>

                <?php if(!empty($err_img1))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#img1" class="header_text2">Image1</a> - <?php= $err_img1; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_img2))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#img2" class="header_text2">Image2</a> - <?php= $err_img2; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_img3))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#img3" class="header_text2">Image3</a> - <?php= $err_img3; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_img4))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#img4" class="header_text2">Image4</a> - <?php= $err_img4; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_img5))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#img5" class="header_text2">Image5</a> - <?php= $err_img5; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_img6))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#img6" class="header_text2">Image5</a> - <?php= $err_img6; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_img7))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction_step2.php#img7" class="header_text2">Image5</a> - <?php= $err_img7; ?></td></tr>
                <?php 
                }
                ?>
            </table></td></tr>
    <tr><td>
            <?php
            }
            ?>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px">
                <tr><td class="banner1"><font class="banner1"><b>Title:</b></font>&nbsp;&nbsp;<?php= $_SESSION[item_name]; ?></td></tr>
                <tr><td class="banner1"><font class="banner1"><b>Subtitle:</b></font>&nbsp;&nbsp;<?php= $_SESSION[subtitle]; ?></td></tr>
            </table></td></tr>
    <form name="promote_frm" action="edit_auction_step2.php" method="post" enctype="multipart/form-data">
        <?php
        if($admin_start_row['set_value']=='yes')
        {
        ?>
        <?php if($mode!="edit")
        {
        ?>
        <tr><td width=250><b><font class="banner1">Start Delay</font></b></td></tr>
        <tr><td width=250><select name="cbo_start_delay" >
                    <option value=0 name=cbo_start_delay selected>Select</option>
                    <?php if($start_delay==1)
                    {
                    ?>
                    <option value=1 name=cbo_start_delay selected>1 Days</option>
                    <?php
                    }
                    else
                    {
                    ?>
                    <option value=1 name=cbo_start_delay>1 Days</option>
                    <?php 
                    } 
                    ?>
                    <?php if($start_delay==2)
                    {
                    ?>
                    <option value=2 name=cbo_start_delay selected>2 Days</option>
                    <?php
                    }
                    else
                    {
                    ?>
                    <option value=2 name=cbo_start_delay>2 Days</option>
                    <?php 
                    } 
                    ?>
                    <?php if($start_delay==3)
                    {
                    ?>
                    <option value=3 name=cbo_start_delay selected>3 Days</option>
                    <?php
                    }
                    else
                    {
                    ?>
                    <option value=3 name=cbo_start_delay>3 Days</option>
                    <?php 
                    } 
                    ?>
                    <?php if($start_delay==4)
                    {
                    ?>
                    <option value=4 name=cbo_start_delay selected>4 Days</option>
                    <?php
                    }
                    else
                    {
                    ?>
                    <option value=4 name=cbo_start_delay>4 Days</option>
                    <?php 
                    } 
                    ?>
                    <?php if($start_delay==5)
                    {
                    ?>
                    <option value=5 name=cbo_start_delay selected>5 Days</option>
                    <?php
                    }
                    else
                    {
                    ?>
                    <option value=5 name=cbo_start_delay>5 Days</option>
                    <?php 
                    } 
                    ?>
                    <?php if($start_delay==6)
                    {
                    ?>
                    <option value=6 name=cbo_start_delay selected>6 Days</option>
                    <?php
                    }
                    else
                    {
                    ?>
                    <option value=6 name=cbo_start_delay>6 Days</option>
                    <?php 
                    } 
                    ?>
                    <?php if($start_delay==7)
                    {
                    ?>
                    <option value=7 name=cbo_start_delay selected>7 Days</option>
                    <?php
                    }
                    else
                    {
                    ?>
                    <option value=7 name=cbo_start_delay>7 Days</option>
                    <?php 
                    } 
                    ?>
                </select></td>
        </tr>
        <?php
        }// if($mode=="edit")
        } // if($admin_start_row=='yes')
        ?>
        <?php if($_SESSION[sell_method]=="dutch_auction")
        {
        ?>
        <tr><td>
                <?php if(!empty($err_qty))
                {
                ?>
                <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_qty?></font>
                <br>
                <b><font class="moretxt">Quantity</font></b>
                <?php
                }
                else
                {
                ?>
                <b><font class="banner1">Quantity</font></b>
                <?php 
                }
                } //if($sell_format==2) online  667
                ?>
            </td> </tr>

</table></td></tr>




<?php if($_SESSION[sell_format]!="3")
{
?>
<tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr><td colspan="2"><font class="categories_fonttype">&nbsp;&nbsp;Auction</font></td></tr>
        </table></td></tr>
<tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="5" cellspacing="5" align="center">
            <tr><td>
                    <font color="#999999"><b>Note:</b>Enter Your Bidding details and <?php=$_SESSION[site_name]?> will Bid as needed for You or Otherwise Choose Fixed Price sale.</font> </td></tr>
            <tr><td width="250">
                    <?php if(!empty($err_min_amt))
                    {
                    ?>
                    <img src="images/warning_9x10.gif">
                    &nbsp;<font class="moretxt"><?php= $err_min_amt?></font>
                    <br>
                    <b><font class="moretxt">Minimum Bid Amount</font></b>
                    <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1" >Minimum Bid Amount</font></b>
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <?php if(!empty($err_rev_price))
                    {
                    ?>
                    <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_rev_price?></font>
                    <br>
                    <b><font class="moretxt">Reserve Price</font></b>
                    <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1" >Reserve Price</font></b>
                    <?php 
                    }
                    ?>
                    <!--( <?php=$cur_default?> <?php= $reserve_fee ?> )--> </td></tr>
            <tr><td width=250><input type="text" name="txt_min_amt" class="txtsmall" value=<?php= $min_amt; ?>></td>
                <td width=250><input type="text" name="txt_rev_price" class="txtsmall" value=<?php= $rev_price; ?>></td></tr>
            <tr>
                <td><b><font class="banner1">Private Listings</font></b></td>
                <?php
                if($bid_permission=='yes')
                { 
                ?>
                <td>
                    <?php if(!empty($err_bid_inc))
                    {
                    ?>
                    <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_bid_inc?></font>
                    <br>
                    <b><font class="moretxt">Bid Increment</font></b>
                    <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1">Bid Increment</font></b>
                    <?php
                    }
                    ?> </td>
                <?php
                }
                ?> 
            </tr>
            <tr>
                <td>
                    <input type="checkbox"  name=chkprivatelisting  value="yes" <?php if($_SESSION[privatelistings]) { ?> checked="checked" <?php  } ?> >Private Listings</td>
                <?php if($bid_permission=='yes'){ ?>
                <td width=250>
                    <input type="text" name="txt_bid_inc" class="txtsmall" value=<?php= $bid_inc; ?>></td>
                <?php
                }
                ?> 
            </tr>

        </table></td></tr>

<tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr width=758><td colspan="2"><font class="categories_fonttype">&nbsp;&nbsp;Fixed Price Sale</b></font></td></tr>
        </table></td></tr>
<tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="5" cellspacing="5" align="center">

            <tr>
                <td><font color="#999999"><b>Note:</b>This "Quick Buy " price is like a fixed auction. 
                    The "Quick Buy now" price will stay there until the reserve 
                    has been meet. Once the reserve is meet, the Quick Buy now goes 
                    away.</font></td>
            </tr>
            <?php
            } // if($_SESSION[sell_method]!="fix")

            ?>

            <tr><td>
                    <?php if(!empty($err_fix_price) )
                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_fix_price; ?></font>
 <br>
 <b><font class="moretxt">Quick Buy Price</font></b>
 <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1">Quick Buy Price</font></b>
                    <?php 
                    }
                    ?>
                </td></tr>

            <tr>
                <td width=250>
                    <input type="text" name="txt_quick" class="txtsmall" value="<?php= $quick; ?>"></td></tr>
        </table></td></tr>
<tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr width=758>
                <td colspan="2" class="tr_bottomless_border"><font class="categories_fonttype">&nbsp;&nbsp;Add Images</font></td></tr>
        </table></td></tr>

<tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="5" cellspacing="5" align="center">
            <tr><td>
                    <?php if(!empty($err_img1))
                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_img1; ?></font>
 <br>
 <b><font class="moretxt">Image1(Free)</font></b>
 <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1" >Image1(Free)</font></b>
                    <?php 
                    }
                    ?>
                    <br />
                    <input type="file" name="img1" value="<?php= $img1; ?>">
                    <?php if(!empty($_SESSION[image1]))
                    {
                    ?>
                    <img src="images/<?php= $_SESSION[image1] ?>" width=30 height=30>
                    <?php
                    }
                    ?>
                </td></tr>

            <?php 
            if($sell_format !="4")
            {
            if($member_account !="1")
            {
            ?>
            <tr><td colspan="2">
                    <?php if(!empty($err_img2))
                    {
                    ?>
                    <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_img2; ?></font>
                    <br>
                    <b><font class="moretxt">Image2</font></b>
                    <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1" >Image2</font></b>
                    <?php }
                    ?>
                    <br />
                    <input type="file" name="img2" value=<?php= $img2; ?>>
                           <?php if(!empty($_SESSION[image2]))
                           {
                           ?>
                           <img src="images/<?php= $_SESSION[image2] ?>" width=30 height=30>
                    <?php
                    }
                    ?></td></tr>
            <tr><td colspan="2">
                    <?php if(!empty($err_img3))
                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_img3; ?></font>
 <br>
 <b><font class="moretxt">Image3</font></b>
 <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1" >Image3 </font></b>
                    <?php 
                    }
                    ?>
                    <br />
                    <input type="file" name="img3" value=<?php= $img3; ?>>
                           <?php if(!empty($_SESSION[image3]))
                           {
                           ?>
                           <img src="images/<?php= $_SESSION[image3] ?>" width=30 height=30>
                    <?php
                    }
                    ?></td></tr>
            <tr><td colspan="2" >
                    <?php if(!empty($err_img1))
                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_img1; ?></font>
 <br>
 <b><font class="moretxt">Image4</font></b>
 <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1" >Image4</font></b>
                    <?php 
                    }
                    ?>
                    <br />
                    <input type="file" name="img4" value="<?php= $img4; ?>">
                    <?php if(!empty($_SESSION[image4]))
                    {
                    ?>
                    <img src="images/<?php= $_SESSION[image4] ?>" width=30 height=30>
                    <?php
                    }
                    ?></td></tr>
            <tr><td colspan="2" >
                    <?php if(!empty($err_img5))
                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_img5; ?></font>
 <br>
 <b><font class="moretxt">Image5</font></b>
 <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1" >Image5</font></b>
                    <?php 
                    }
                    ?>
                    <br />
                    <input type="file" name="img5" value="<?php= $img5; ?>">
                    <?php if(!empty($_SESSION[image5]))
                    {
                    ?>
                    <img src="images/<?php= $_SESSION[image5] ?>" width=30 height=30>
                    <?php
                    }
                    ?></td></tr>
            <tr><td colspan="2" >
                    <?php if(!empty($err_img6))
                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_img6; ?></font>
 <br>
 <b><font class="moretxt">Image6</font></b>
 <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1" >Image6</font></b>
                    <?php 
                    }
                    ?>
                    <br />
                    <input type="file" name="img6" value="<?php= $img6; ?>">
                    <?php if(!empty($_SESSION[image6]))
                    {
                    ?>
                    <img src="images/<?php= $_SESSION[image6] ?>" width=30 height=30>
                    <?php
                    }
                    ?></td></tr>
            <tr><td colspan="2">
                    <?php if(!empty($err_img7))
                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php= $err_img7; ?></font>
 <br>
 <b><font class="moretxt">Image7</font></b>
 <?php
                    }
                    else
                    {
                    ?>
                    <b><font class="banner1">Image7</font></b>
                    <?php 
                    }
                    ?>
                    <br />
                    <input type="file" name="img7" value="<?php= $img7; ?>">
                    <?php if(!empty($_SESSION[image7]))
                    {
                    ?>
                    <img src="images/<?php= $_SESSION[image7] ?>" width=30 height=30>
                    <?php
                    }
                    ?></td></tr>
            <?php
            } // if($member_account !=1 )
            } // if($sell_format=!=4) on line 810
            ?>
            <tr>
                <td width="200"><span class="spotlight1txt"><strong class="spotlight1txt">Enter your Video Code</strong></span><strong class="categories_fonttype">
                        <img src="images/upload.gif" alt="" width="13" height="8" /></strong></td>
                <td width="700" align="left"><span class="spotlight1txt"><strong class="spotlight1txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(or)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter your Video Path</strong></span><strong class="categories_fonttype"> <img src="images/upload.gif" alt="" width="13" height="8" /></strong></td>
            </tr>
            <tr>
                <td width="200" align="left">
                    <textarea name="videofile" style="width:220px; height:70px"><?php=$videofileup?></textarea>
                </td>
                <td width="700" align="left" valign="bottom">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="videolink" rows="1" style="width:420px"/><?php=$videolinkup?></textarea>
                </td>
            </tr>

        </table></td></tr>
<?php  
$mem_sql="select * from user_registration where user_id=$_SESSION[userid]";
$mem_res=mysql_query($mem_sql);  
$mem_row=mysql_fetch_array($mem_res);
$member_account=$mem_row[member_account];
?>
<tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr><td colspan="2" class="tr_bottomless_border" >
                    <font class="categories_fonttype">&nbsp;&nbsp;Listing Designer</font></td></tr>
        </table></td></tr>
<tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" align="center">
            <tr><td colspan="2">
                    <table cellpadding="5" cellspacing="2" width="700">
                        <tr><td class="banner1">
                                <input type="checkbox" onclick="return val();" <?php if($listingdesinger) { ?> checked="checked" <?php  } ?> name=chklisting value="yes"  />Listing designer&nbsp;<?php=$cur_default?> <?php= $listing_designer_fee ?> <br>
                                <font color="#999999"> Get both a theme and layout to complement your listing. </font> </td></tr>
                        <tr><td><b>Select a theme</b></td><td><b>Select a layout</b></td> </tr>
                        <tr><td valign="top">
                                <select name=cbotheme multiple="multiple" onChange="show(this.value)" style="width:150px; height:100px">
                                    <option value="none.gif" <?phpif($theme=="none.gif") echo "selected=selected";?>>None</option>
                                    <?php
                                    $theme_sql="select * from themes_master";
                                    $theme_res=mysql_query($theme_sql);
                                    while($theme_row=mysql_fetch_array($theme_res))
                                    {
                                    if($theme_row[themes]=="$theme")
                                    {
                                    ?>
                                    <option value="<?php= $theme_row[themes] ?>" selected="selected"><?php= $theme_row[theme_name] ?> </option>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <option value="<?php= $theme_row[themes] ?>" > <?php= $theme_row[theme_name] ?> </option>
                                    <?php
                                    }
                                    }
                                    ?>
                                </select>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <img name="themeimg" src="images/none.gif"  id="themeimg" width="100" > 
                            </td><td>
                                <select name=cbolayout multiple="multiple" onChange="showlayout(this.value)" style="width:150px;height:150">
                                    <?php
                                    if($layout=="layout_standard.gif")
                                    {
                                    ?>
                                    <option value="layout_standard.gif" selected="selected" >Standard</option>
                                    <?php
                                    }
                                    else
                                    {		
                                    ?>
                                    <option value="layout_standard.gif">Standard</option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if($layout=="layout_top.gif")
                                    {
                                    ?>
                                    <option value="layout_top.gif" selected="selected" >photo on the top</option>
                                    <?php
                                    }
                                    else
                                    {		
                                    ?>
                                    <option value="layout_top.gif">photo on the top</option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if($layout=="layout_left.gif")
                                    {
                                    ?>
                                    <option value="layout_left.gif" selected="selected">photo on the left</option>
                                    <?php
                                    }
                                    else
                                    {		
                                    ?>
                                    <option value="layout_left.gif">photo on the left</option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if($layout=="layout_right.gif")
                                    {
                                    ?>
                                    <option value="layout_right.gif" selected="selected" >photo on the right</option>
                                    <?php
                                    }
                                    else
                                    {		
                                    ?>
                                    <option value="layout_right.gif">photo on the right</option>
                                    <?php
                                    }
                                    if($layout=="layout_bottom.gif")
                                    {
                                    ?>
                                    <option value="layout_bottom.gif" selected="selected"  >photo on the bottom</option>
                                    <?php
                                    }
                                    else
                                    {		
                                    ?>
                                    <option value="layout_bottom.gif">photo on the bottom</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <img name="layoutimg" src="images/layout_standard.gif"  id="layoutimg" width="100" height="100"> 
                            </td>
                        </tr></table>
                </td></tr>
            <tr><td><a href="#" onClick="preview()" class="header_text">Preview Listing</a></td></tr>
        </table></td></tr>
<tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr width=758><td colspan="2"> <font class="categories_fonttype">&nbsp;&nbsp;Increase your item's visibility </b></font></td></tr>
        </table></td></tr>
<tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" align="center">
            <tr><td>
                    <br>
                    <b><font class="banner1">Preview your listing in search results.</font></b>
                    <br>
                    <br>
                    <table style="border:1px solid #cccccc" class="table_border1" cellspacing="0" cellpadding="5" width="700" 
                           align="center">
                        <tbody>
                            <tr bgcolor="#eeeeee">
                                <td>&nbsp;</td>
                                <td><b class="categories_fonttype">Item</b></td>
                                <td><b class="categories_fonttype"># of Bids</b></td>
                                <td><b class="categories_fonttype">Price</b></td>
                                <td><b class="categories_fonttype">Ends</b></td>
                            </tr>
                            <tr>
                                <td><img src="images/gallery.jpg" alt="" width="48" height="45" /></td>
                                <td><font color="blue" class="banner1">This is an example with 
                                    Gallery</font></td>
                                <td class="detail8txt">-</td>
                                <td class="detailblacktxt">$x.xx</td>
                                <td class="detailblacktxt">12h 50m</td>
                            </tr>
                            <tr bgcolor="#eeeeee">
                                <td>&nbsp;</td>
                                <td><font color="blue" class="categories_fonttype">Item Title</font><br />

                                    <span class="banner1">Sub 
                                        Title</span></td>
                                <td class="detail8txt">-</td>
                                <td class="detailblacktxt">$x.xx</td>
                                <td class="detailblacktxt">12h 50m</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><font color="blue" class="banner1">This is an example with 
                                    Bold</font></td>
                                <td>-</td>
                                <td class="detailblacktxt">$x.xx</td>
                                <td class="detailblacktxt">12h 50m</td>
                            </tr>
                        </tbody>
                    </table>
                </td></tr>	
            <?php
            $user_query="select * from user_registration where	user_id='$_SESSION[userid]'";
            $table=mysql_query($user_query);
            if($row=mysql_fetch_array($table))
            {
            $member_type=$row['member_account'];
            }
            ?>
            <tr><td>
                    <?php if(!empty($Gallery))
                    {
                    ?>
                    <input type="checkbox" name=chkGallery value="yes" checked>
                    <?php
                    }
                    else
                    {
                    ?>
                    <input type="checkbox" name=chkGallery value="yes">
                    <?php
                    }
                    ?>
                    <font class="banner1" >
                    Gallery <?php //echo $cur_default."(" .  $gret .")"; ?>
                    [Requires a picture,<a href="edit_auction_step2.php#img1" class="header_text"> add a picture now </a>] <br>
                    Add a small version of your first picture to Search and Listings.&nbsp;<a href=# onClick="window.open('galaryexamples.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')" class="header_text">See Examples</a>    </font>
                    <input type=hidden name="gallery" value="<?php echo $gret; ?>">
                </td></tr>
            <tr><td>
                    <?php if(!empty($Home))
                    {
                    ?>
                    <input type="checkbox" name=chkHome value="yes" checked>
                    <?php
                    }
                    else
                    {
                    ?>
                    <input type="checkbox" name=chkHome value="yes">
                    <?php
                    }
                    ?>
                    <font class="banner1">
                    Home Page Featured  
                    <?php  //echo $cur_default." (" . $hret. ")"; ?>)
                    <input type=hidden name="home_page" value="<?php echo $hret; ?>">
                    </font>&nbsp;<a href=# onClick="window.open('homepage.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')" class="header_text">See Examples</a>
                </td></tr>
            <tr><td>
                    <?php if(!empty($Bold))
                    {
                    ?>
                    <input type="checkbox" name=chkBold value="yes" checked>
                    <?php
                    }
                    else
                    {
                    ?>
                    <input type="checkbox" name=chkBold value="yes">
                    <?php
                    }
                    ?>
                    <font class="banner1" >Bold <br> <?php  //echo $cur_default." (" . $bret .")"; ?>
                    Attract buyers' attention and set your listing apart - use <b>Bold</b>.    </font>&nbsp;<a href=# onClick="window.open('boldexample.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')" class="header_text">See Examples</a>
                    <input type=hidden name="bold" value="<?php  echo $bret; ?>">
                </td></tr>

            <tr><td>
                    <?php if(!empty($Highlight))
                    {
                    ?>
                    <input type="checkbox" name=chkHighlight value="yes" checked>
                    <?php
                    }
                    else
                    {
                    ?>
                    <input type="checkbox" name=chkHighlight value="yes">
                    <?php
                    }
                    ?>
                    <font class="banner1">Highlight  <br> 
                    <?php  //echo $cur_default." (" . $highret .")"; ?>
                    Make your listing stand out with a colored band in Search results.    </font>&nbsp;<a href=# onClick="window.open('highlightexamples.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')" class="header_text">See Examples</a>
                </td></tr>
            <input type=hidden name="highlight" value="<?php  echo $highret; ?>">
            <?php
            // }
            ?>
            <tr>
                <td><font class="banner1" ><b>Page Counter 
                    </b></font></td>
            </tr>
            <tr><td>
                    <?php 
                    if($item_counter_style==2)
                    {
                    ?>
                    <input type="radio" name="item_counter_style" value=1 > 
                    <b><font size=+1 color="#009900">
                        12345
                        </font>			</b> 
                    <input type="radio" name="item_counter_style" value=2 checked> 
                    <I><font size=+1 color="#003399">
                        12345
                        </font>			</I>  
                    <?php
                    }
                    else
                    {
                    ?>		 
                    <input type="radio" name="item_counter_style" value=1 checked> 
                    <b><font size=+1 color="#009900">
                        12345
                        </font>			</b> 
                    <input type="radio" name="item_counter_style" value=2 > 
                    <I><font size=+1 color="#003399">
                        12345
                        </font>			</I>  
                    <?php
                    }
                    ?></td></tr>

            <input type="hidden" name=mode value="<?php=$mode;?>">
            <input type="hidden" name=flag value="1">
            <input type="hidden" name=check value="1" />
            <tr><td colspan="2" align="center">

                    <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)" onclick="return chk();"/>
                </td></tr>
        </form>
    </table>
</td></tr>

<script language="javascript">
    function show(theme)
    {
        document.promote_frm.themeimg.src = "images/" + theme;
        document.promote_frm.themeimg.style.display = "inline";
        document.promote_frm.themeimg.style.visibility = "visible";
    }
    function showlayout(layout)
    {
        document.promote_frm.layoutimg.src = "images/" + layout;
        document.promote_frm.layoutimg.style.display = "inline";
        document.promote_frm.layoutimg.style.visibility = "visible";
    }
    function preview()
    {
        var themeimage = document.promote_frm.cbotheme.options[document.promote_frm.cbotheme.selectedIndex].value;
        window.open("previewlisting.php?themeimage=" + themeimage);
    }
    function val()
    {
        if (promote_frm.chklisting.checked == true)
        {
            promote_frm.cbotheme.disabled = false;
            promote_frm.cbolayout.disabled = false;
        }
        else
        {
            promote_frm.cbotheme.disabled = true;
            promote_frm.cbolayout.disabled = true;
        }
        return true;
    }
</script>