<?php
/***************************************************************************
*File Name				:edit_ad.tpl
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
$editad_sql=mysql_query("select * from placing_item_bid where item_id=$item_id");
$editad_fetch=mysql_fetch_array($editad_sql);
if($editad_fetch['user_id']!=$_SESSION['userid'])
{
echo '<meta http-equiv="refresh" content="0;url=signout.php">';
exit();
}
?>
<table width="980" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td>
    <tr><td valign="top"><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr><td colspan="2"><font class="categories_fonttype">&nbsp;&nbsp;
                        Edit Your Ad</font></td>
                </tr></table></td></tr>


    <?php if($err_flag==1)
    { 
    ?>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="5" cellspacing="5" align="center">
                <tr><td>
                        <img src="images/warning_39x35.gif"></td>
                    <td ><font class="banner1" color="red">The following must be corrected before continuing:</font></td></tr>
                <?php if(!empty($err_title))
                {
                ?>
                <tr><td>&nbsp;</td>
                    <td><a href="edit_ad.php#txttitle" class="header_text2">Item Title</a> - <?php echo  $err_title; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_des))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_ad.php#areades" class="header_text2">Item Description</a> - <?php echo  $err_des; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_qty))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_ad.php#txt_qty" class="header_text2">Quantity</a> - <?php echo  $err_qty; ?></td></tr>
                <?php 
                }
                ?>

                <?php
                if(!empty($err1))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_ad.php#img1" class="header_text2">Image1</a> - <?php echo  $err1; ?></td></tr>
                <?php
                }
                ?>
                <?php
                if(!empty($err2))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_ad.php#img2" class="header_text2">Image2</a> - <?php echo  $err2; ?></td></tr>
                <?php
                }
                ?>
                <?php
                if(!empty($err3))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_ad.php#img3" class="header_text2">Image3</a> - <?php echo  $err3; ?></td></tr>
                <?php
                }
                ?>
                <?php if(!empty($err_img1))
                {
                ?>
                <tr><td>&nbsp;</td><td class="banner1"><a href="edit_ad.php#img1" class="header_text2">Image1</a> - <?php echo  $err_img1; ?></td></tr>
                <?php 
                }
                ?>



            </table>
    <tr><td>&nbsp;</td></tr>
</td></tr>
<?php
}
?>
<tr><td>
        <table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="5" cellspacing="5" align="center">
            <form name="form1" action="edit_ad.php"  method=post enctype="multipart/form-data">
                <tr><td colspan="2" >
                        <?php if(!empty($err_title))
                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_title ?></font>
 <br>
 <b><font class="moretxt" >Property title </font></b><font color="red" size="-2">*</font>
 <?php
                        }
                        else
                        {
                        ?>
                        <b><font class="banner1">Property title </font></b><font color="red" size="-2">*</font>
                        <?php 
                        }
                        ?>
                    </td></tr>

                <tr><td colspan="2"><input type="text" name="txttitle" class="txtbig" value="<?php echo  $item_title; ?>">
                    </td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td colspan="2" >
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
                        <b><font class="banner1">Item Description </font></b><font color="red" size="-2">*</font>
                        <?php
                        }
                        ?>
                    </td></tr>
                <?php
                $browser_name=$_SERVER['HTTP_USER_AGENT'];
                if(substr_count($browser_name,'Opera')==1) $brow_name='opera';
                else if(substr_count($browser_name,'Netscape')==1) $brow_name='netscape';
                else if(substr_count($browser_name,'Firefox')==1) $brow_name='firefox';
                else $brow_name='ie';
                if($brow_name=='ie')
                {
                ?>
                <TR><TD colspan="2"><a href="#" onclick="ownhtml12()" class="header_text">Enter Your Own HTML</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="ownhtml13()" class="header_text">HTML Editor</a></TD></TR>
                <?php
                }
                ?>
                <?php
                if($ownhtml!="yes")
                {
                ?>
                <tr><td colspan="2">
                        <?php
                        if($brow_name=='netscape'||$brow_name=='opera'||$brow_name=='firefox') 
                        echo '<textarea name="htmlcontent" cols="60" rows="15">'.$itemdescrip.'</textarea>';
                        else require 'include/content.php'; 
                        ?>
                        <br>
                        <font class="banner1">Describe your items features, benefits, 
                        and condition. Be sure to include in your description: Condition (new, used, etc.)</font></td>
                </tr>
                <?php
                }
                else
                {
                echo '<tr><td><textarea name="htmlcontent" cols="60" rows="15">'.$itemdescrip.'</textarea></td></tr>';
                }
                ?>
                <tr>
                    <td colspan="2" ><font class="banner1" ><b>Hit Counter Style
                        </b></font></td></tr>
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
                        ?>
                    </td></tr>
                <tr><td >
                        <?php if(!empty($err_qty))
                        {
                        ?>
                        <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_qty?></font>
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
                        // } //if($sell_format==2) online  667
                        ?>
                    </td>

                    <td >

                    </td>
                </tr>
                <tr>
                    <td width=443>
                        <input type="text" name="txt_qty" class="txtsmall" value=<?php echo  $qty; ?>>
                    </td>
                    <td width=487>
                    </td></tr>

        </table></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr width=758><td colspan="2"><font class="categories_fonttype">&nbsp;&nbsp;Add Images</font></td></tr>
        </table></td></tr>
<tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="5" cellspacing="5" align="center">
            <tr><td>
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
                    <div class="banner1">   <b>Image1(Free)</b></div>
                    <?php 
                    }
                    ?>
                    <br />
                    <input type="file" name="img1" value="<?php echo  $img1; ?>">
                    <?php if(!empty($_SESSION[image1]))
                    {
                    ?>
                    <img src="images/<?php echo  $_SESSION[image1]?>" width=30 height=30>
                    <?php
                    }
                    ?>
                </td></tr>


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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="videolink" rows="1" style="width:320px"/><?php echo $videolinkup?></textarea>
                </td>
            </tr>
        </table></td></tr>
<tr><td>&nbsp;</td></tr>


<tr><td>
        <table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr width=758><td colspan="2"><font class="categories_fonttype">&nbsp;&nbsp;Increase your property's visibility</font></td></tr>
        </table></td></tr>
<tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="5" cellspacing="5" align="center">
            <tr><td colspan="2">
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
            <tr><td colspan="2" >
                    <?php if(!empty($Gallery))
                    {
                    ?>
                    <input type="checkbox" name=chkGallery value="Yes" checked>
                    <?php
                    }
                    else
                    {
                    ?>
                    <input type="checkbox" name=chkGallery value="Yes">
                    <?php
                    }
                    ?>
                    <font class="banner1">
                    Gallery <?php echo $cur_sell."(" .  $gret .")"; ?>
                    [Requires a picture] <br>
                    Add a small version of your first picture to Search and Listings. 
                    </font>
                    <input type=hidden name="gallery" value="<?php echo $gret; ?>">
                </td></tr>
            <tr><td colspan="2">
                    <?php if(!empty($Home))
                    {
                    ?>
                    <input type="checkbox" name=chkHome value="Yes" checked>
                    <?php
                    }
                    else
                    {
                    ?>
                    <input type="checkbox" name=chkHome value="Yes">
                    <?php
                    }
                    ?>
                    <font class="banner1">
                    Home Page Featured  
                    <?php  echo $cur_sell."(" . $hret. ")"; ?>
                    <input type=hidden name="home_page" value="<?php echo $hret; ?>">
                    </font>
                </td></tr>
            <tr><td colspan="2" >
                    <?php if(!empty($Bold))
                    {
                    ?>
                    <input type="checkbox" name=chkBold value="Yes" checked>
                    <?php
                    }
                    else
                    {
                    ?>
                    <input type="checkbox" name=chkBold value="Yes">
                    <?php
                    }
                    ?>
                    <font class="banner1">Bold  <?php  echo $cur_sell. "(" . $bret .")"; ?><br>
                    Attract buyers' attention and set your listing apart - use <b>Bold</b>. 
                    </font>
                    <input type=hidden name="bold" value="<?php  echo $bret; ?>">
                </td></tr>
            <tr><td colspan="2">
                    <?php if(!empty($Highlight))
                    {
                    ?>
                    <input type="checkbox" name=chkHighlight value="Yes" checked>
                    <?php
                    }
                    else
                    {
                    ?>
                    <input type="checkbox" name=chkHighlight value="Yes">
                    <?php
                    }
                    ?>
                    <font class="banner1">Highlight  
                    <?php  echo $cur_sell."(" . $highret .")"; ?><br> 
                    Make your listing stand out with a colored band in Search results.  
                    </font>
                </td></tr>
            <input type=hidden name="highlight" value="<?php  echo $highret; ?>">
            <input type="hidden" name=flag value="1">
            <input type="hidden" name="cat_id" value=<?php echo  $cat_id; ?>>
                   <input type="hidden" name=mode value="<?php echo  $mode; ?>">
            <input type="hidden" name=sell_format value="<?php echo  $sell_format; ?>">
            <input type="hidden" name=itemid value=<?php echo  $item_id; ?>>
                   <input type="hidden" name=own_html_flag value=<?php echo  $ownhtml; ?>>
                   <tr><td colspan="2" align="center">
                    <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)" onclick="return chk();"/>
                </td></tr>
            </form>
        </table>

    </td></tr>
</table>
<script language="javascript">
    function chk()
    {
        videofile = document.form1.videofile.value;
        videolink = document.form1.videolink.value;
        if ((videolink != '') && (videofile != ''))
        {
            alert("Enter any one value for video(Video Code/Video Path)");
            return false;
        }
        else
            return true;
    }
</script>