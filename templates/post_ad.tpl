<?php
/***************************************************************************
*File Name				:sell_item_detail.tpl
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
?>
<style type="text/css">
    <!--
    .style1 {
        color: #669933;
        font-weight: bold;
    }
    .rteImage {
        background: #D3D3D3;
        border: 1px solid #D3D3D3;
        cursor: pointer;
        cursor: hand;
    }

    .rteImageRaised, .rteImage:hover {
        background: #D3D3D3;
        border: 1px outset;
        cursor: pointer;
        cursor: hand;
    }

    .rteImageLowered, .rteImage:active {
        background: #D3D3D3;
        border: 1px inset;
        cursor: pointer;
        cursor: hand;
    }

    .rteVertSep {
        margin: 0 4px 0 4px;
    }

    .rteBack {
        background: #D3D3D3;
        border: 1px outset;
        letter-spacing: 0;
        padding: 2px;
    }

    .rteBack tbody tr td, .rteBack tr td {
        background: #D3D3D3;
        padding: 0;
    }

    -->
</style>
<script language="javascript" type="text/javascript">
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
<table width="948" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td valign="top" > 
            <table width="948" cellpadding="5" cellspacing="2" bgcolor="#f0f2f5">
                <tr>
                    <td height="30" colspan="2" class="banner1">
                        1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;<b>Title & Description </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;Preview & Submit &nbsp;&nbsp;&nbsp;</td>
                    <td nowrap="nowrap"><font class="moretxt">  Fields marked with an asterisk * are required </font></td> 
                </tr>
            </table></td></tr>

    <?php if($err_flag==1)
    { 
    ?>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
                <tr><td colspan="2">
                        <table width="100%" align="center"><tr><td>
                                    <img src="images/warning_39x35.gif"></td>
                                <td><font size=2 class="moretxt">The following must be corrected before continuing:</font></td>
                                <?php if(!empty($err_cat))
                                {
                                ?>
                            <tr><td>&nbsp;</td>
                                <td class="banner1"><a href="post_ad.php#cbosubcat" onclick="sel('cbosubcat')" class="header_text2">Sub Category</a> - <?php echo  $err_cat; ?>
                                </td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_title))
                            {
                            ?>
                            <tr><td>&nbsp;</td>
                                <td class="banner1"><a href="post_ad.php#txttitle" onclick="sel('txttitle')" class="header_text2">Item Title</a> - <?php echo  $err_title; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_des))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#areades" onclick="sel('areades')" class="header_text2">Item Description</a> - <?php echo  $err_des; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_min_amt))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#txt_min_amt" class="header_text2">Minimum Bid Amount</a> - <?php echo  $err_min_amt; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_fix_price))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#txt_quick" class="header_text2">Quick Buy Price</a> - <?php echo  $err_fix_price; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_rev_price))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#txt_rev_price" class="header_text2">Reserve Price</a> - <?php echo  $err_rev_price; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_qty))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#txt_qty" onclick="sel('txt_qty')" class="header_text2">Quantity</a> - <?php echo  $err_qty; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_dur))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#cbodur" onclick="sel('cbodur')" class="header_text2">Duration</a> - <?php echo  $err_dur; ?></td></tr>
                            <?php 
                            }
                            ?>

                            <?php 
                            if(!empty($err_size_qty))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#size_of_qty" class="header_text2">Size of Quantity</a> - <?php echo  $err_size_qty; ?></td></tr>
                            <?php 
                            } 
                            ?>

                            <?php
                            if($bid_permission=='yes'){
                            if(!empty($err_bid_inc))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#txt_bid_inc" class="header_text2">Bid Increment</a> - <?php echo  $err_bid_inc; ?></td></tr>
                            <?php 
                            } }
                            ?>
                            <?php if(!empty($err_cur))
                            {
                            ?>
                            <tr><td>&nbsp;</td>
                                <td class="banner1"><a href="post_ad.php#cbocurrency" class="header_text2">Currency</a> - <?php echo  $err_cur; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img1))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#img1" class="header_text2">Image1</a> - <?php echo  $err_img1; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img2))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#img2" class="header_text2">Image2</a> - <?php echo  $err_img2; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img3))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#img3" class="header_text2">Image3</a> - <?php echo  $err_img3; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img4))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#img4" class="header_text2">Image4</a> - <?php echo  $err_img4; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_img5))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#img5" class="header_text2">Image5</a> - <?php echo  $err_img5; ?></td></tr>
                            <?php 
                            }
                            ?>


                            <?php


                            if($tablename)
                            {
                            $tab_sql="select * from $tablename";
                            $tab_res=mysql_query($tab_sql);
                            $i =2; 
                            while ($i < mysql_num_fields($tab_res))
                            {
                            $tab_col = mysql_fetch_field($tab_res, $i);
                            $dummy=$tab_col->name;
                            if(empty($_SESSION[$tab_col->name]))
                            {
                            require 'include/connect.php';
                            $select_sql="select * from error_message where err_id =23";
                            $select_tab=mysql_query($select_sql);
                            $select_row=mysql_fetch_array($select_tab);
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#<?php echo  $tab_col->name ?>" class="header_text2"><?php echo  $tab_col->name ?></a>-<?php echo  $select_row[err_msg] ?></td></tr>
                            <?php
                            }
                            else
                            {
                            $var_type=$tab_col->type;
                            if($var_type=="int" or $var_type=="tinyint")
                            {
                            if(!is_numeric($_SESSION[$tab_col->name]))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="post_ad.php#<?php echo  $tab_col->name ?>" class="header_text2"><?php echo  $tab_col->name ?></a>-<?php echo  $select_row[err_msg] ?></td></tr>
                            <?php
                            }
                            }
                            }
                            $i++;
                            }
                            }  ?>

                        </table>
                    </td></tr>
            </table></td></tr>
    <?php
    }
    ?>

    <tr><td>&nbsp;</td></tr>
    <tr><td>
            <table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
                <tr><td class="categories_fonttype">&nbsp;&nbsp;Ad Details</td></tr>
            </table>
        </td></tr>
    <form name="RTEDemo" action="post_ad.php"  method=post enctype="multipart/form-data" onSubmit="return submitForm();">
        <tr>
            <td><table width="943" height="80" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom;padding-left:20px">
                    <tr>
                        <td colspan="2">
                            <table width="100%" cellpadding="5" cellspacing="2">
                                <?php
                                $currency_sell="select * from admin_settings where set_id=59";
                                $currency_res=mysql_query($currency_sell);
                                $currency_row=mysql_fetch_array($currency_res);
                                $cur_sell=$currency_row[set_value]; 

                                if($file_path)
                                require "$file_path";
                                ?>

                                <tr><td colspan="2" class="banner1">
                                        <?php if(!empty($err_title))
                                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_title ?></font>
 <br>
 <b><font class="moretxt">Item title </font></b><font color="red" size="-2">*</font>
 <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font>Item title </font></b><font color="red" size="-2">*</font>
                                        <?php 
                                        }
                                        ?>
                                    </td></tr>
                                <tr><td colspan="2"><input type="text" name="txttitle" class="txtbig" value="<?php echo  $item_title; ?>">
                                    </td></tr>
                                <tr><td colspan="2" class="banner1"><b>Sub title </b><?php if($sret) 
                                        {
                                        ?>
                                        <font color="#669966" ><b> (<?php echo $cur_sell?> <?php echo  $sret ?>)</b></font>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <font color="#669966" size="2"><b> (Free)</b></font>
                                        <?php
                                        }
                                        ?></td></tr>
                                <tr><td colspan="2">
                                        <input type="text" name="txtsubtitle" id="txtsubtitle" class="txtbig" value="<?php echo  $sub_title; ?>" maxlength="55">
                                    </td></tr>
                                <tr><td colspan="2" class="banner1">
                                        <?php if(!empty($err_des))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;
                                        <font class="moretxt"><?php echo  $err_des; ?></font>
                                        <br>
                                        <b><font class="moretxt">Item Description </font></b><font color="red" size="-2">*</font>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font>Item Description </font></b><font color="red" size="-2">*</font>
                                        <?php
                                        }
                                        ?>
                                    </td></tr>
                                <script language="JavaScript" type="text/javascript" src="html2xhtml.js"></script>
                                <script language="JavaScript" type="text/javascript" src="richtext_compressed.js"></script>
                                <tr><td>
                                        <script language="JavaScript" type="text/javascript">
                                            <!--
                                            function submitForm() {
                                                //make sure hidden and iframe values are in sync for all rtes before submitting form
                                                updateRTEs();
                                                //alert(document.RTEDemo.rte1.value);	
                                                document.RTEDemo.content.value = document.RTEDemo.rte1.value;

                                                return true;
                                            }

                                            //Usage: initRTE(imagesPath, includesPath, cssFile, genXHTML, encHTML)
                                            initRTE("./images/", "./", "", true);
                                            //-->
                                        </script>
                                        <noscript><p><b>Javascript must be enabled to use this form.</b></p></noscript>

                                        <script language="JavaScript" type="text/javascript">
                                            <!--
                                        //build new richTextEditor
                                            var rte1 = new richTextEditor('rte1');
                                                    < ?php
                                                    //format content for preloading
                                                    if (!(isset($_POST["rte1"]))) {
                                            $content = chr(13);
                                                    $content = $_SESSION[des];
                                                    $content = rteSafe($content);
                                            } else {
                                            //retrieve posted value
                                            $content = $_POST["rte1"];
                                                    $content = rteSafe($_POST["rte1"]);
                                            }
                                            ? >
                                                    rte1.html = '<?php echo $content;?>';
                                            //rte1.toggleSrc = false;
                                            rte1.build();
                                            //-->
                                        </script>
                                    </td></tr> 
                                <tr>
                                    <td colspan="2" class="banner1"><font><b>Hit Counter Style</b></font></td></tr>
                                <tr><td colspan="2">
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
                                <?php
                                if($admin_start_row['set_value']=='yes')
                                {
                                ?>

                                <?php if($mode!="edit")
                                {
                                ?>
                                <tr><td colspan="2" class="banner1"><b><font>Start Delay</font></b></td>
                                </tr>
                                <tr><td colspan="2">
                                        <select name="cbo_start_delay" >
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
                                <tr><td class="banner1">
                                        <?php if(!empty($err_qty))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_qty?></font>
                                        <br>
                                        <b><font class="moretxt">Quantity *</font></b>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font>Quantity</font><font color="#FF0000">*</font></b>
                                        <?php 
                                        }
                                        // } //if($sell_format==2) online  667
                                        ?>
                                    </td>
                                    <?php 
                                    if($admin_end_row['set_value']=="yes")
                                    {
                                    ?>
                                    <td class="banner1">
                                        <?php if(!empty($err_dur))
                                        { 
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_dur; ?></font>
                                        <br>
                                        <b><font class="moretxt">Duration </font></b><font color="red" size="-2">*</font>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2 >Duration </font></b><font color="red" size="-2">*</font>
                                        <?php 
                                        }
                                        } //  if($admin_end_row=='yes')
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width=443>
                                        <input type="text" name="txt_qty" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);" class="txtsmall" maxlength="5" value=<?php echo  $qty; ?>>
                                    </td>
                                    <td width=487>
                                        <?php  if($admin_end_row['set_value']=='yes')
                                        {
                                        if($mode!="edit")
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
                                        <font color="#666666">(No. of days the Item in Active State)

                                        <?php
                                        } //if($mode=="edit")

                                        }  // if($admin_end_row=='yes')
                                        ?></td></tr>


                                <tr width=758><td colspan="2"><font size="2" color="green"><b>Add Images(Can upload jpg, gif, jpeg files only)</b></font></td></tr>
                                <tr><td colspan="2" class="banner1">
                                        <?php if(!empty($err_img1))
                                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_img1; ?></font>
 <br>
 <b><font class="moretxt">Image1</font></b>
 <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font>Image1</font></b>
                                        <?php 
                                        }
                                        ?>
                                        <input type="file" name="img1" value="<?php echo  $img1; ?>">
                                        <?php if(!empty($_SESSION[img1]))
                                        {
                                        ?>
                                        <img src="thumbnail/<?php echo $_SESSION[image1]?>" width=30 height=30>
                                        <?php
                                        }
                                        ?></td></tr>
                                <tr>
                                    <td><span class="spotlight1txt"><strong class="spotlight1txt">Enter your Video Code</strong></span><strong class="categories_fonttype">
                                            <img src="images/upload.gif" alt="" width="13" height="8" /></strong></td>
                                    <td align="left"><span class="spotlight1txt"><strong class="spotlight1txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(or)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter your Video Path</strong></span><strong class="categories_fonttype"> <img src="images/upload.gif" alt="" width="13" height="8" /></strong></td>
                                </tr>
                                <tr>
                                    <td align="left">
                                        <textarea name="videofile" style="width:220px; height:70px"><?php echo stripslashes($videofileup);?></textarea>
                                    </td>
                                    <td align="left" valign="bottom">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="videolink" rows="1" style="width:300px; height:20px"/><?php echo $videolinkup?></textarea>
                                    </td>
                                </tr>
                            </table>
                        </td></tr>
                </table></td></tr>
        <tr><td>&nbsp;</td></tr>
        <?php  
        $mem_sql="select * from user_registration where user_id=".$_SESSION['userid'];
        $mem_res=mysql_query($mem_sql);  
        $mem_row=mysql_fetch_array($mem_res);
        $member_account=$mem_row['member_account'];
        if($member_account==1 or $member_account==2)
        {
        $sql="select * from admin_rates";
        $exe=mysql_query($sql);
        $ret=mysql_fetch_array($exe);
        $gret=$ret['gallery_price'];
        $hret=$ret['homepage_price'];
        $sret=$ret['subtitle_price'];
        $bret=$ret['bold_price'];
        $highret=$ret['highlight_price'];
        }
        ?>
        <tr>
            <td><table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
                    <tr width=758><td colspan="2"><font class="categories_fonttype">&nbsp;&nbsp;
                            Increase your item's visibility</font>
                        </td></tr>
                </table></td></tr>
        <tr><td><table width="943" border="0" align="center" cellpadding="0" cellspacing="10" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px">
                    <!--<tr><td colspan="2">
                    <br>
                    <b><font size=2 class="banner1">Preview your listing in search results.</font></b>
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

                    <tr><td colspan="2">
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
                            <font class="banner1">
                            Gallery <?php echo $cur_sell."(" .  $gret .")"; ?>
                            [Requires a picture] <br>
                            Make your listing stand out with a coloured band in Search results. 
                            </font><a href=# onClick="window.open('galaryexamples.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=400, height=400')" class="banner1"><b>Help</b></a>
                            <input type=hidden name="gallery" value="<?php echo $gret; ?>">
                        </td></tr>
                    <tr><td colspan="2">
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
                            <font size=2 class="banner1">
                            Home Page Featured  
                            <?php  echo $cur_sell."(" . $hret. ")"; ?>)
                            <input type=hidden name="home_page" value="<?php echo $hret; ?>">

                            <br>
                            Find a place for your posting in index page under Classifide Ads. </font>&nbsp;<a href=# onClick="window.open('homepage.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=500, height=400')" class="banner1"><b>Help</b></a></td></tr>
                    <tr><td colspan="2">
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
                            <font size=2 class="banner1">Bold  <?php  echo $cur_sell. "(" . $bret .")"; ?><br>
                            Attract buyers' attention and set your listing apart by listing item title in bold- use <b>Bold</b>. 
                            </font>&nbsp;<a href=# onClick="window.open('boldexample.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=400, height=400')" class="banner1"><b>Help</b></a>
                            <input type=hidden name="bold" value="<?php  echo $bret; ?>">
                        </td></tr>
                    <tr><td colspan="2">
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
                            <font size=2 class="banner1">Highlight  
                            <?php  echo $cur_sell."(" . $highret .")"; ?><br> 
                            Make your listing stand out with a coloured outline in Search results.
                            </font>&nbsp;<a href=# onClick="window.open('highlightexamples.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=400, height=400')" class="banner1"><b>Help</b></a>
                        </td></tr>
                    <input type=hidden name="highlight" value="<?php  echo $highret; ?>">
                    <?php
                    // }
                    ?>
                    <input type="hidden" name=flag value="1">
                    <input type="hidden" name="cat_id" value=<?php echo  $cat_id; ?>>
                           <input type="hidden" name=mode value="<?php echo  $mode; ?>">
                    <input type="hidden" name=sell_format value="<?php echo  $sell_format; ?>">
                    <input type="hidden" name=item_id value=<?php echo  $item_id; ?>>
                           <input type="hidden" name=own_html_flag value=<?php echo  $ownhtml; ?>>
                           <input type="hidden" name="content" value="">
                    <tr><td colspan="2" align="center">
                            <?php if($mode=="" or $mode=="relist" or $mode=="repost")
                            {
                            ?>
                            <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)" onclick="return chk();"/>
                            <?php
                            }
                            else if($mode=="change")
                            { 
                            ?>
                            <!--<input type="submit" name=detsub value="Save" class="buttonbig">-->
                            <input type="image" src="images/save.gif" name="Image84" width="62" height="22" border="0" id="Image84" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image84', '', 'images/saveo.gif', 1)" onclick="return chk();" value="Save"/>
                            <?php
                            }
                            ?></td></tr>

                </table></td></tr>

        <?php
        function rteSafe($strText) {
        //returns safe code for preloading in the RTE
        $tmpString = $strText;

        //convert all types of single quotes
        $tmpString = str_replace(chr(145), chr(39), $tmpString);
        $tmpString = str_replace(chr(146), chr(39), $tmpString);
        $tmpString = str_replace("'", "&#39;", $tmpString);

        //convert all types of double quotes
        $tmpString = str_replace(chr(147), chr(34), $tmpString);
        $tmpString = str_replace(chr(148), chr(34), $tmpString);
        //	$tmpString = str_replace("\"", "\"", $tmpString);

        //replace carriage returns & line feeds
        $tmpString = str_replace(chr(10), " ", $tmpString);
        $tmpString = str_replace(chr(13), " ", $tmpString);

        return $tmpString;
        }
        ?>
</table>
</form>
</td></tr></table>
</td></tr></table>
<script>
    function sel(elementname)
    {
        var element_name = elementname;
        if (element_name == "txttitle")
            document.RTEDemo.txttitle.focus();
        if (element_name == "cbodur")
            document.RTEDemo.cbodur.focus();
        if (element_name == "cbosubcat")
            document.RTEDemo.cbosubcat.focus();
        if (element_name == "txt_qty")
            document.RTEDemo.txt_qty.focus();
        if (element_name == "cbodur")
            document.RTEDemo.cbodur.focus();
    }
</script>
<script language="javascript">
    function chk()
    {
        videofile = document.RTEDemo.videofile.value;
        videolink = document.RTEDemo.videolink.value;
        if ((videolink != '') && (videofile != ''))
        {
            alert("Enter any one value for video(Video Code/Video Path)");
            return false;
        }
        else
            return true;
    }
</script>