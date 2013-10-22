<?php
/***************************************************************************
*File Name				:promotelistings.tpl
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
<script language="javascript" type="text/javascript">
    function numbersonly(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if (unicode != 8 && unicode != 46 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
            if (unicode < 48 || unicode > 57) //if not a number
                return false; //disable key press
        }
    }
    function numchk(tval)
    {
        var1 = tval.value; // tval is textbox(element)  checking for number only
        s = var1.substr(var1.length - 1, 1); 	 	/*alert(s+"---"+m);*/
        m = s.charCodeAt(0);               // ke.keyCode;	
        if (!((m >= 48 && m <= 57) || isNaN(m)))
        {
            ch = var1.substr(0, var1.length - 1);
            tval.value = ch;
        }
    }
</script>
<table width="958" cellpadding="0" cellspacing="5" border=0 align="center">
    <tr>
        <td><table width="948" height="27" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5">
                <tr>
                    <td height="30" colspan="2" class="banner1">
                        1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;Title & Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>3.&nbsp;Pictures & Details </b>&nbsp;4.&nbsp;Shipping Details & Sales Tax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;Preview & Submit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="moretxt">Fields marked with an asterisk (*) are required</font></td>
                </tr></table></td></tr>


    <?php if($err_flag==1)
    { 
    ?>
    <tr><td colspan="2"> 
            <table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom"> 
                <tr><td colspan=2>
                        <table width="100%" align="center"><tr><td>
                                    <img src="images/warning_39x35.gif"></td>
                                <td><font class="moretxt">The following must be corrected before continuing:</font></td></tr>
                            <?php if(!empty($err_cur))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#cbocurrency" onclick="sel('cbocurrency')" class="header_text2">Currency</a> - <?php echo  $err_cur; ?></td></tr>
                            <?php 
                            }
                            ?>

                            <?php if(!empty($err_dur))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#cbodur" onclick="sel('cbodur')" class="header_text2">Duration</a> - <?php echo  $err_dur; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_min_amt))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#txt_min_amt" onclick="sel('txt_min_amt')" class="header_text2">Minimum Bid Amount</a> - <?php echo  $err_min_amt; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_rev_price))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#txt_rev_price" onclick="sel('txt_rev_price')" class="header_text2">Reserve Price</a> - <?php echo  $err_rev_price; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_revprice))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#txt_rev_price" onclick="sel('txt_rev_price')" class="header_text2">Reserve Price</a> - <?php echo  $err_revprice; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php
                            if($bid_permission=='yes')
                            {
                            if(!empty($err_bid_inc))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#txt_bid_inc" onclick="sel('txt_bid_inc')" class="header_text2">Bid Increment</a> - <?php echo  $err_bid_inc; ?></td></tr>
                            <?php 
                            } 
                            }
                            ?>

                            <?php if(!empty($err_quickprice))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#txt_quick" onclick="sel('txt_quick')" class="header_text2">Quick Buy Price</a> - <?php echo  $err_quickprice; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_fix_price))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#txt_quick" onclick="sel('txt_quick')" class="header_text2">Quick Buy Price</a> - <?php echo  $err_fix_price; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_qty))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#txt_qty" onclick="sel('txt_qty')" class="header_text2">Quantity</a> - <?php echo  $err_qty; ?></td></tr>
                            <?php 
                            }
                            ?>


                            <?php 
                            if(!empty($err_size_qty))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#size_of_qty" onclick="sel('size_of_qty')" class="header_text2">Size of Quantity</a> - <?php echo  $err_size_qty; ?></td></tr>
                            <?php 
                            } 
                            ?>



                            <?php if(!empty($err_img1))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#img1" onclick="sel('img1')" class="header_text2">Image1</a> - <?php echo  $err_img1; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img2))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#img2" onclick="sel('img2')" class="header_text2">Image2</a> - <?php echo  $err_img2; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img3))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#img3" onclick="sel('img3')" class="header_text2">Image3</a> - <?php echo  $err_img3; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img4))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#img4" onclick="sel('img4')" class="header_text2">Image4</a> - <?php echo  $err_img4; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img5))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#img5" onclick="sel('img5')" class="header_text2">Image5</a> - <?php echo  $err_img5; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img6))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#img6" onclick="sel('img6')" class="header_text2">Image5</a> - <?php echo  $err_img6; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img7))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#img7" onclick="sel('img7')" class="header_text2">Image5</a> - <?php echo  $err_img7; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_video))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="promotelistings.php#videofile" onclick="sel('videofile')" class="header_text2">Video</a> - <?php echo  $err_video; ?></td></tr>
                            <?php 
                            }
                            ?>

                        </table></td></tr></table></td></tr>
    <!--<hr size="1" noshade class="hr_color"></td></tr>-->
    <?php
    }
    ?>
    <!--<tr><td><font class="categories_fonttype"><b>Title:</b></font>&nbsp;&nbsp;<font class="banner1"><?php echo  $_SESSION[item_name]; ?></font></td></tr>
    <tr><td><font class="categories_fonttype"><b>Subtitle:</b></font>
    &nbsp;&nbsp;<font class="banner1"><?php echo  $_SESSION[subtitle]; ?></font></td></tr>-->
    <tr>
        <td colspan="2" height="32" border="0" align="left" cellpadding="0" cellspacing="0">
            <table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr><td class="categories_fonttype">
                        &nbsp;&nbsp;Currency & Duration</td></tr></table></td>
    </tr>
    <tr>
        <td height="80" border="0" align="left"  colspan="2">
            <table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="0" cellspacing="10">
                <form name="promote_frm" action="promotelistings.php" method="post" enctype="multipart/form-data" onsubmit="return chk();">
                    <?php if(!empty($err_cur))
                    {
                    ?>
                    <tr><td class="categories_fonttype">
                            <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_cur; ?></font>
                            <br>
                            <font class="moretxt"><b>Currency <font color="#FF0000">*</font></b></font></td>
                    </tr>
                    <?php
                    }
                    else
                    {
                    ?>
                    <tr>
                        <td class="categories_fonttype"><font size=2><b>Currency <font color="#FF0000">*</font></b></font></td>
                    </tr>
                    <?php
                    } 
                    ?>


                    <tr><td><select name=cbocurrency>
                                <option value="">Select</option>
                                <?php 
                                $cur_sql="select * from currency_master where statuss='show'";
                                $cur_res=mysql_query($cur_sql);
                                while($currency_row=mysql_fetch_array($cur_res))
                                {
                                if(trim($currency_row['currency'])==trim($currency))
                                {
                                ?>
                                <option value="<?php echo  $currency_row['currency'] ?>" selected><?php echo  $currency_row['currency']?></option>
                                <?php 
                                }
                                else
                                {
                                ?>
                                <option value="<?php echo  $currency_row['currency'] ?>"><?php echo  $currency_row['currency']?></option>
                                <?php
                                }
                                }
                                ?>
                            </select>
                        </td></tr>
                    <?php
                    if($admin_start_row['set_value']=='yes')
                    {
                    ?>
                    <?php if($mode!="edit")
                    {
                    ?>
                    <tr>
                        <td width=621 class="categories_fonttype"><b><font size=2>Start Delay </font></b></td>
                    </tr>
                    <tr><td width=621>
                            <select name="cbo_start_delay">
                                <option value=0 name=cbo_start_delay selected>Start Immediately</option>
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
                            </select></td></tr>
                    <?php
                    }// if($mode=="edit")
                    } // if($admin_start_row=='yes')
                    ?>
                    <?php if($_SESSION[sell_format]=="2")
                    {
                    ?>
                    <tr><td class="categories_fonttype">
                            <?php if(!empty($err_qty))
                            {
                            ?>
                            <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_qty?></font>
                            <br>
                            <b><font class="moretxt">Quantity</font></b>
                            <b><font color="#FF0000">*</font></b> 
                            <?php
                            }
                            else
                            {
                            ?>
                            <b><font size=2>Quantity</font></b>
                            <b><font color="#FF0000">*</font></b>
                            <?php 
                            }
                            // } //if($sell_format==2) online  667
                            ?>
                        </td> 
                        <?php
                        } //   if($_SESSION[sell_method]=="dutch_auction")
                        ?>
                        <?php 
                        if($admin_end_row['set_value']=="yes")
                        {
                        ?>
                        <td class="categories_fonttype">
                            <?php if(!empty($err_dur))
                            { 
                            ?>
                            <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_dur; ?></font>
                            <br>
                            <b><font class="moretxt">Duration</font></b>
                            <b><font color="#FF0000">*</font></b>
                            <?php
                            }
                            else
                            {
                            ?>
                            <b><font size=2 >Duration</font></b>
                            <b><font color="#FF0000">*</font></b>
                            <?php 
                            }
                            } //  if($admin_end_row=='yes')
                            ?> </td>
                    </tr><tr>
                        <?php if($_SESSION[sell_format]=="2")
                        {
                        ?>
                        <td width=621>
                            <input type="text" name="txt_qty" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);"  class="txtsmall" maxlength="5" value=<?php echo  $qty; ?>>
                        </td>
                        <?php
                        }
                        ?>
                        <td width=329>
                            <?php  if($admin_end_row['set_value']=='yes')
                            {
                            $auction_query="select * from auction_duration order by duration";
                            $table=mysql_query($auction_query);
                            ?>
                            <select name="cbodur">
                                <option value="0">Select</option>
                                <?php
                                while($row=mysql_fetch_array($table))
                                {
                                ?>
                                <?php if($dur==$row['duration'])
                                {
                                ?>
                                <option value="<?php echo  $row['duration'] ?>" selected><?php echo  $row['duration'] ?> Days</option>
                                <?php
                                }
                                else
                                {
                                ?>
                                <option value="<?php echo  $row['duration'] ?>" ><?php echo  $row['duration'] ?> Days</option>
                                <?php
                                }
                                } // while($row=mysql_fetch_array($table))
                                ?>
                            </select>
                            <font color="#999999">(No. of days the Item in Active State)</font></td>
                        <?php
                        }  // if($admin_end_row=='yes')
                        ?>
                    </tr>
            </table></td></tr>



    <?php if($_SESSION[sell_format]!="3")
    {
    ?>
    <tr>
        <td colspan="2" height="32" border="0" align="left" >
            <table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center">
                <tr><td colspan="2"><font class="categories_fonttype">&nbsp;&nbsp;<b>Auction</b></font></td></tr>
            </table></td></tr>

    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="0" cellspacing="10">
                <tr>
                    <td colspan="2"><strong>Note:</strong><font color="#999999">Quick Buy price and Reserve price must be greater than minimum bid amount.</font></td>
                </tr>
                <?php
                $currency_sell="select * from admin_settings where set_id=59";
                $currency_res=mysql_query($currency_sell);
                $currency_row=mysql_fetch_array($currency_res);
                $cur_sell=$currency_row[set_value];
                ?>
                <tr><td width="494" class="categories_fonttype">
                        <?php if(!empty($err_min_amt))
                        {
                        ?>
                        <img src="images/warning_9x10.gif">
                        &nbsp;<font class="moretxt"><?php echo  $err_min_amt?></font>
                        <br>
                        <b><font class="moretxt">Minimum Bid Amount</font></b>
                        <b><font color="#FF0000">*</font></b>
                        <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2 >Minimum Bid Amount</font></b>
                        <b><font color="#FF0000">*</font></b>
                        <?php
                        }
                        ?>
                    </td>
                    <td class="categories_fonttype">
                        <?php if(!empty($err_rev_price) || !empty($err_revprice))
                        {
                        ?>
                        <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt">
                        <?phpif($err_rev_price){echo $err_rev_price;}else{echo $err_revprice;}?></font>
                        <br>
                        <b><font class="moretxt">Reserve Price</font></b>
                        <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2>Reserve Price</font></b>
                        <?php 
                        }
                        if($reserve_fee)
                        {
                        ?>
                        <font  color="#669966" size="2"><b>  ( <?php echo $cur_sell?> <?php echo  $reserve_fee ?> )</b></font>
                        <?php
                        }
                        else
                        {
                        ?>
                        <font color="#669966" size="2"><b>(Free)</b></font>
                        <?php
                        }
                        ?>
                    </td></tr>
                <tr><td width=494><input type="text" name="txt_min_amt" onKeyPress="return numbersonly(event);" maxlength="8" class="txtsmall" value=<?php echo  $min_amt; ?>></td>
                    <td width=442><input type="text" name="txt_rev_price" onKeyPress="return numbersonly(event);" class="txtsmall" maxlength="8" value=<?php echo  $rev_price; ?>></td></tr>
                <tr>
                    <td><b><font size="2" color="green">Private Listings</font></b></td>
                    <?php
                    if($bid_permission=='yes')
                    { 
                    ?>
                    <td class="categories_fonttype">
                        <?php if(!empty($err_bid_inc))
                        {
                        ?>
                        <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_bid_inc?></font>
                        <br>
                        <b><font class="moretxt">Bid Increment</font></b>
                        <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2>Bid Increment</font></b>
                        <?php
                        }
                        ?>
                    </td>
                    <?php
                    }
                    ?> 
                </tr>
                <tr>
                    <td class="categories_fonttype">
                        <input type="checkbox"  name=chkprivatelisting  value="yes" <?php if($_SESSION[privatelistings]) { ?> checked="checked" <?php  } ?> >Private Listings</td>
                    <?php if($bid_permission=='yes'){ ?>
                    <td width=442>
                        <input type="text" name="txt_bid_inc" onKeyPress="return numbersonly(event);" class="txtsmall" maxlength="5" value=<?php echo  $bid_inc; ?>></td>
                    <?php
                    }
                    ?> 
                </tr>
            </table></td></tr>
    <?php
    } // if($_SESSION[sell_method]!="fix")
    ?>
    <tr><td><table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
                <tr width=758><td colspan="2"><font class="categories_fonttype"><b>&nbsp;&nbsp;Fixed Price Sale</b></font></td></tr>
            </table></td></tr>

    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom;padding-left:20px" cellpadding="0" cellspacing="10">
                <tr><td><font color="#999999"><b>Note:</b>This "Quick Buy " price is like a fixed auction. 
                        The "Quick Buy now" price will stay there until the reserve 
                        has been meet. Once the reserve is met, the Quick Buy  goes 
                        away.Quick Buy price must be greater than minimum bid amount.</font>
                    </td></tr>

                <tr><td class="categories_fonttype">
                        <?php if(!empty($err_fix_price) || !empty($err_quickprice))
                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?phpif($err_fix_price){ echo $err_fix_price; }else {echo $err_quickprice;}?></font>
                        <br>
                        <b><font class="moretxt">Quick Buy Price</font></b>
                        <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2>Quick Buy Price</font></b>
                        <?php 
                        }
                        ?></td>
                </tr>

                <tr>
                    <td width=790><input type="text" name="txt_quick" onKeyPress="return numbersonly(event);" class="txtsmall" value="<?php echo  $quick; ?>" maxlength="8" /></td>
                </tr>
            </table></td></tr>

    <tr><td><table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg"> 
                <tr width=758>
                    <td colspan="2"><font class="categories_fonttype"><b>&nbsp;&nbsp;Add Images(Can upload jpg,gif,jpeg files only)</b></font></td></tr>
            </table></td></tr>
    <tr><td>
            <table width="943" height="300" border="0" align="center" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom;padding-left:20px" cellpadding="0" cellspacing="10">

                <tr><td class="categories_fonttype">
                        <?php if(!empty($err_img1))
                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_img1; ?></font>
 <br>
 <b><font class="moretxt">Image1(Free)</font></b>
 <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2 >Image1(Free)</font></b>
                        <?php 
                        }
                        ?>
                        <br />
                        <input type="file" name="img1" value="<?php echo  $img1; ?>">
                        <?php if(!empty($_SESSION[image1]))
                        {
                        ?>
                        <img src="thumbnail/<?php echo  $_SESSION[image1] ?>" width=30 height=30>
                        <?php
                        }
                        ?>
                    </td></tr>

                <tr><td colspan="2" class="categories_fonttype">
                        <?php if(!empty($err_img2))
                        {
                        ?>
                        <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_img2; ?></font>
                        <br>
                        <b><font class="moretxt">Image2  <?php if($img_listing_fee) { ?> (<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>) <?php } ?></font></b>
                        <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2 >Image2 <?php if($img_listing_fee) { ?>  <font color="#669966" size="2"><b>( <?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>)</b></font> <?php } ?> </font></b>
                        <?php }
                        ?>
                        <br />
                        <input type="file" name="img2" value=<?php echo  $img2; ?>>
                               <?php if(!empty($_SESSION[image2]))
                               {
                               ?>
                               <img src="thumbnail/<?php echo  $_SESSION[image2] ?>" width=30 height=30>
                        <?php
                        }
                        ?></td></tr>
                <tr><td colspan="2" class="categories_fonttype">
                        <?php if(!empty($err_img3))
                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_img3; ?></font>
 <br>
 <b><font class="moretxt">Image3  <?php if($img_listing_fee) { ?> (<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>) <?php } ?> </font></b>
                        <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2 >Image3  <?php if($img_listing_fee) { ?>  <font color="#669966" size="2"><b>(<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>)</b></font> <?php } ?> </font></b>
                        <?php 
                        }
                        ?>
                        <br />
                        <input type="file" name="img3" value=<?php echo  $img3; ?>>
                               <?php if(!empty($_SESSION[image3]))
                               {
                               ?>
                               <img src="thumbnail/<?php echo  $_SESSION[image3] ?>" width=30 height=30>
                        <?php
                        }
                        ?></td></tr>
                <tr><td colspan="2" class="categories_fonttype">
                        <?php if(!empty($err_img4))
                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_img1; ?></font>
 <br>
 <b><font class="moretxt">Image4  <?php if($img_listing_fee) { ?> (<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>) <?php } ?></font></b>
                        <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2 >Image4  <?php if($img_listing_fee) { ?>  <font color="#669966" size="2"><b>(<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>)</b></font> <?php } ?> </font></b>
                        <?php 
                        }
                        ?>
                        <br />
                        <input type="file" name="img4" value="<?php echo  $img4; ?>">
                        <?php if(!empty($_SESSION[image4]))
                        {
                        ?>
                        <img src="thumbnail/<?php echo  $_SESSION[image4] ?>" width=30 height=30>
                        <?php
                        }
                        ?></td></tr>
                <tr><td colspan="2" class="categories_fonttype">
                        <?php if(!empty($err_img5))
                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_img5; ?></font>
 <br>
 <b><font class="moretxt">Image5  <?php if($img_listing_fee) { ?> (<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>) <?php} ?> </font></b>
                        <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2 >Image5  <?php if($img_listing_fee) { ?>  <font color="#669966" size="2"><b>(<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>)</b></font> <?php } ?> </font></b>
                        <?php 
                        }
                        ?>
                        <br />
                        <input type="file" name="img5" value="<?php echo  $img5; ?>">
                        <?php if(!empty($_SESSION[image5]))
                        {
                        ?>
                        <img src="thumbnail/<?php echo  $_SESSION[image5] ?>" width=30 height=30>
                        <?php
                        }
                        ?></td></tr>
                <tr><td colspan="2" class="categories_fonttype">
                        <?php if(!empty($err_img6))
                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_img6; ?></font>
 <br>
 <b><font class="moretxt">Image6 <?php if($img_listing_fee) { ?>(<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>) <?php } ?></font></b>
                        <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2 >Image6 <?php if($img_listing_fee) { ?> <font color="#669966" size="2"><b>(<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>)</b></font><?php}?></font></b>
                        <?php 
                        }
                        ?>
                        <br />
                        <input type="file" name="img6" value="<?php echo  $img6; ?>">
                        <?php if(!empty($_SESSION[image6]))
                        {
                        ?>
                        <img src="thumbnail/<?php echo  $_SESSION[image6] ?>" width=30 height=30>
                        <?php
                        }
                        ?></td></tr>
                <tr><td colspan="2" class="categories_fonttype">
                        <?php if(!empty($err_img7))
                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_img7; ?></font>
 <br>
 <b><font class="moretxt">Image7 <?php if($img_listing_fee) { ?> (<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>) <?php } ?> </font></b>
                        <?php
                        }
                        else
                        {
                        ?>
                        <b><font size=2 >Image7 <?php if($img_listing_fee) { ?> <font color="#669966" size="2"><b>(<?php echo  $default_cur ?> <?php echo  $img_listing_fee ?>)</b></font><?php} ?></font></b>
                        <?php 
                        }
                        ?>
                        <br />
                        <input type="file" name="img7" value="<?php echo  $img7; ?>">
                        <?php if(!empty($_SESSION[image7]))
                        {
                        ?>
                        <img src="thumbnail/<?php echo  $_SESSION[image7] ?>" width=30 height=30>
                        <?php
                        }
                        ?></td></tr>
                <tr>
                    <td width="200"><span class="spotlight1txt"><strong class="spotlight1txt">Enter your Video Code</strong></span><strong class="categories_fonttype">
                            <img src="images/upload.gif" alt="" width="13" height="8" /></strong></td>
                    <td width="700" align="left"><span class="spotlight1txt"><strong class="spotlight1txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(or)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter your Video Path</strong></span><strong class="categories_fonttype"> <img src="images/upload.gif" alt="" width="13" height="8" /></strong></td>
                </tr>
                <tr>
                    <td width="200" align="left">
                        <textarea name="videofile" style="width:220px; height:70px"><?php echo stripslashes($videofileup);?></textarea>
                    </td>
                    <td width="700" align="left" valign="bottom">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="videolink" rows="1" style="width:300px; height:20px"/><?php echo $videolinkup?></textarea>
                    </td>
                </tr>

            </table></td></tr>	




    <?php  
    $mem_sql="select * from user_registration where user_id=".$_SESSION['userid'];
    $mem_res=mysql_query($mem_sql);  
    $mem_row=mysql_fetch_array($mem_res);
    $member_account=$mem_row[member_account];
    ?>

    <tr><td><table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">	
                <tr><td colspan="2">
                        <font class="categories_fonttype"><b>&nbsp;&nbsp;Listing Designer</b></font></td></tr>
            </table></td></tr>
    <tr><td>
            <table width="943" height="300" border="0" align="center" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom;padding-left:20px"  cellpadding="0" cellspacing="10">
                <tr><td colspan="2">
                        <table cellpadding="5" cellspacing="2" width="801">
                            <tr><td width="339" class="categories_fonttype">
                                    <input type="checkbox" onclick="return val();" name="chklisting" value="yes" <?php if($listingdesinger) { echo "checked"; }?>>
                                           Listing designer&nbsp;
                                           <?php if($listing_designer_fee) { ?> <font color="#669966" size="2"><b> (<?php echo  $default_cur ?> <?php echo  $listing_designer_fee ?>) <?php } ?>
                                    </b></font> <br>
                                    <font color="#999999"> Get both a theme and layout to complement your listing. </font> </td></tr>
                            <tr class="categories_fonttype"><td><b>Select a theme</b></td><td width="321"><b>Select a layout</b></td> 
                            </tr>
                            <tr><td valign="top">
                                    <select name=cbotheme multiple="multiple" onchange="show(this.value)" style="width:150px; height:100px" onclick="chkchecked">
                                        <option value="none.gif">None</option>
                                        <?php
                                        $theme_sql="select * from themes_master";
                                        $theme_res=mysql_query($theme_sql);
                                        while($theme_row=mysql_fetch_array($theme_res))
                                        {
                                        if($theme_row[themes]=="$theme")
                                        {
                                        ?>
                                        <option value="<?php echo  $theme_row[themes] ?>" selected="selected"> <?php echo  $theme_row[theme_name] ?> </option>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <option value="<?php echo  $theme_row[themes] ?>" > <?php echo  $theme_row[theme_name] ?> </option>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </select>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php if($theme)
                                    {
                                    ?>
                                    <img name="themeimg" src="images/<?php echo  $theme ?>"  id="themeimg" width="100" > 
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <img name="themeimg" src="images/none.gif"  id="themeimg" width="100" > 
                                    <?php
                                    }
                                    ?>
                                </td><td valign="top">
                                    <select name=cbolayout multiple="multiple" onchange="showlayout(this.value)" style="width:150px; height:100px">
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
                                    <?php
                                    if(!empty($layout))
                                    {
                                    ?>
                                    <img name="layoutimg" src="images/<?php echo $layout?>"  id="layoutimg" width="100" height="100"> 
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <img name="layoutimg" src="images/layout_standard.gif"  id="layoutimg" width="100" height="100"> 
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr></table>
                    </td></tr>
                <tr><td><a href="#" onClick="preview()" class="banner1">Preview Listing</a></td></tr>
            </table></td></tr>
    <tr><td>
            <table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
                <tr width=758><td colspan="2"><font class="categories_fonttype"><b>&nbsp;&nbsp; Increase your item's visibility </b></font></td></tr>
            </table></td></tr>
    <tr><td><table width="943" border="0" align="center" cellpadding="0" cellspacing="5" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px">

                <!--<tr><td>
                <br>
                <b><font class="categories_fonttype">Preview your listing in search results.</font></b>
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
                        </td></tr>	-->
                <?php
                $user_query="select * from user_registration where	user_id='$_SESSION[userid]'";
                $table=mysql_query($user_query);
                if($row=mysql_fetch_array($table))
                {
                $member_type=$row['member_account'];
                }
                ?>
                <tr><td class="banner1">
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
                        <font size=2 >
                        Gallery <?php if($gret) { ?> <font color="#669966" size="2"><b> <?php echo $cur_sell."(" .  $gret .")"; ?></b></font> <?php } ?>
                        [Requires a picture] <br>
                        Make your listing stand out with a coloured band in Search results.&nbsp; </font><a href=# onClick="window.open('galaryexamples.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=400, height=400')" class="banner1"><b>Help</b></a>

                        <input type=hidden name="gallery" value="<?php echo $gret; ?>">
                    </td></tr>
                <tr><td class="banner1">
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
                        <font size=2>
                        Home Page Featured <?php if($hret) { ?> 
                        <font color="#669966" size="2"><b><?php  echo $cur_sell." (" . $hret. ")"; ?></b></font> <?php } ?><br>
                        Find a place for your posting in index page under Featured Auction and Hot Auctions.
                        <input type=hidden name="home_page" value="<?php echo $hret; ?>">
                        </font>&nbsp;<a href=# onClick="window.open('homepage.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=500, height=400')" class="banner1"><b>Help</b></a>
                    </td></tr>
                <tr><td class="banner1">
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
                        <font size=2 >Bold <?php if($bret) { ?> <font color="#669966" size="2"><b> <?php  echo $cur_sell."(" . $bret .")"; ?></b></font> <?php } ?> <br>
                        Attract buyers' attention and set your listing apart by listing item title in bold- use <b>Bold</b>. 
                        </font>&nbsp;<a href=# onClick="window.open('boldexample.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=400, height=400')" class="banner1"><b>Help</b></a>
                        <input type=hidden name="bold" value="<?php  echo $bret; ?>">
                    </td></tr>

                <tr><td class="banner1">
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
                        <font size=2>Highlight   <?php if($highret) { ?>
                        <font color="#669966" size="2"><b><?php  echo $cur_sell." (" . $highret .")"; ?></b></font> <?php} ?> <br>
                        Make your listing stand out with a coloured outline in Search results.  
                        </font>&nbsp;<a href=# onClick="window.open('highlightexamples.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=400, height=400')" class="banner1"><b>Help</b></a>
                    </td></tr>
                <input type=hidden name="highlight" value="<?php  echo $highret; ?>">
                <?php
                // }
                ?>
                <tr><td class="banner1"><font size=2><b>Page Counter </b></font></td></tr>
                <tr><td>
                        <?php 
                        if($item_counter_style==2)
                        {
                        ?>
                        <input type="radio" name="item_counter_style" value=1 > 
                        <b><font size=+1 color="#009900">
                            12345
                            </font>
                        </b> 
                        <input type="radio" name="item_counter_style" value=2 checked> 
                        <I><font size=+1 color="#003399">
                            12345
                            </font>
                        </I>  
                        <?php
                        }
                        else
                        {
                        ?>		 
                        <input type="radio" name="item_counter_style" value=1 checked> 
                        <b><font size=+1 color="#009900">
                            12345
                            </font>
                        </b> 
                        <input type="radio" name="item_counter_style" value=2 > 
                        <I><font size=+1 color="#003399">
                            12345
                            </font>
                        </I>  
                        <?php
                        }
                        ?></td></tr>
                <input type="hidden" name=mode value="<?php echo $mode;?>">
                <input type="hidden" name=flag value="1">
                <input type="hidden" name=item_id value="<?php echo $sellitemid?>"/>
                <tr><td colspan="2" align="center">
                        <?php if($mode=="" or $mode=="sellsimilar")
                        {
                        ?>
                        <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)" onclick="return chk()"/>
                        <?php
                        }
                        else if($mode=="change")
                        { 
                        ?>
                        <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)" onclick="return chk()"/>
                        <?php
                        }
                        ?>
                        </form>
                    </td></tr>
            </table></td></tr>

</table>
</td></tr>
</table> 
