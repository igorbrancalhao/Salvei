<?php
/***************************************************************************
*File Name				:sell_item_detail.tpl
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
<table width="958" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td valign="top" > 
            <table width="958" cellpadding="5" cellspacing="2">
                <tr>
                    <td><table width="948" height="27" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5">
                            <tr>
                                <td height="30" colspan="2" class="banner1">
                                    1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;<b>Title & Description </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;Pictures & Details 4.&nbsp;Shipping Details & Sales Tax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;Preview & Submit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="moretxt">Fields marked with an asterisk (*) are required</font></td>
                            </tr></table></td></tr>
                <tr>
                    <td><table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
                            <tr>
                                <td colspan=2><font class="banner1"><b>&nbsp;&nbsp;Sell Your Item:Title & Description</b>
                                    </font> </td></tr>
                        </table></td></tr>
                <tr>
                    <td><table width="943" height="80" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
                            <tr><td>
                                    <?php if($err_flag==1)
                                    { 
                                    ?>
                                    <table width="100%" align="center"><tr><td>
                                                <img src="images/warning_39x35.gif"></td>
                                            <td><font class="moretxt">The following must be corrected before continuing:</font></td></tr>


                                        <?php if(!empty($err_title))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td>
                                            <td class="banner1"><a href="sell_item_detail.php#txttitle" onclick="sel('txttitle')" class="header_text2">Item Title</a> - <?php echo  $err_title; ?></td></tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php
                                        if(!empty($err_specify))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td><td class="banner1"><a href="sell_item_detail.php#cboitemcondition" onclick="sel('cboitemcondition')" class="header_text2">Condition</a> - <?php echo  $err_specify; ?></td></tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php
                                        if(!empty($err_des))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td><td class="banner1"><a href="sell_item_detail.php#itemdes" class="header_text2">Item Description</a> - <?php echo  $err_des; ?></td></tr>
                                        <?php 
                                        }
                                        ?>

                                        <?php
                                        if(!empty($err_subtitle))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td><td class="banner1"><a href="sell_item_detail.php#cbosubcat" onclick="sel('cbosubcat')" class="header_text2">Sub Category</a> - <?php echo  $err_subtitle; ?></td></tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php if($tablename)
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
                                        <tr><td>&nbsp;</td><td class="banner1"><a href="sell_item_detail.php#<?php echo  $tab_col->name ?>" class="header_text2"><?php echo  $tab_col->name ?></a>-<?php echo  $select_row[err_msg] ?></td></tr>
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
                                        <tr><td>&nbsp;</td>
                                            <td class="banner1"><a href="sell_item_detail.php#<?php echo  $tab_col->name ?>" class="header_text2"><?php echo  $tab_col->name ?></a>-<?php echo  $select_row[err_msg] ?></td>
                                        </tr>
                                        <?php
                                        }
                                        }
                                        }
                                        $i++;
                                        }
                                        }  ?>
                                    </table></td></tr>

                            <!--<tr><td>
                            <hr size="1" noshade class="hr_color"></td></tr>-->
                            <?php
                            }
                            ?>
                            <tr>
                                <td> 
                                    <form name="RTEDemo" action="sell_item_detail.php"  method=post enctype="multipart/form-data" onSubmit="return submitForm();">
                                        <table width="100%" cellpadding="5" cellspacing="2" >
                                            <?php
                                            /* function display_subcategory($sub_cat_id,$sub_cat,$chk)
                                            {
                                            $sub1_sql="select * from category_master where category_head_id=".$sub_cat_id;
                                            $sub1_res=mysql_query($sub1_sql);
                                            $sub1_tot=mysql_num_rows($sub1_res);
                                            if($sub1_tot!=0)
                                            {
                                            while($sub1_row=mysql_fetch_array($sub1_res))
                                            {
                                            if(trim($sub1_row['category_id'])==trim($sub_cat))
                                            {
                                            ?>
                                            <option value="<?php echo  $sub1_row['category_id'] ?>" selected> &nbsp;&nbsp;&nbsp; <?php echo  $sub1_row['category_name'] ?></option>
                                            <?php 
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="<?php echo  $sub1_row['category_id'] ?>"> &nbsp;&nbsp;&nbsp;<?php echo  $sub1_row['category_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            $sub_cat_id=$sub_row1['category_id'];
                                            if($sub_cat_id)
                                            display_subcategory($sub_cat_id,$sub_cat,$chk);
                                            }
                                            } //while($sub1_row=mysql_fetch_array($sub1_res))
                                            } //function

                                            /////////////////////////////////////





                                            function ret($ssid,$subsub_id)
                                            {
                                            $ss_sql="select * from category_master where category_head_id=$ssid";
                                            $sub_res=mysql_query($ss_sql);
                                            while($cat_row=mysql_fetch_array($sub_res))
                                            {

                                            if($subsub_id==$cat_row['category_id'])
                                            {
                                            ?>
                                            <option value="<?php echo $cat_row['category_id'];?>" selected ><?php echo $cat_row['category_name'];?></option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="<?php echo $cat_row['category_id'];?>">&nbsp;&nbsp;&nbsp;<?php echo $cat_row['category_name'];?></option>
                                            <?php
                                            }
                                            $ssid=$cat_row['category_id'];
                                            ret($ssid,$subsub_id);
                                            }

                                            }*/


                                            //////////////////////////////////////


                                            /* if($_SESSION[categoryid])
                                            {
                                            $sub_sql="select * from category_master where category_head_id=$_SESSION[categoryid] order by category_name";
                                            $sub_res=mysql_query($sub_sql);
                                            $sub_tot=mysql_num_rows($sub_res);
                                            }*/

                                            if($sub_tot!=0)
                                            {/* 
?>
<!--<tr><td class="banner1">
  <?php 
  if(!empty($err_subtitle))
  {
  ?>
  <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt">Please Select this Information</font>
  <br>
  <b><font class="moretxt">Sub Category<font class="moretxt"> *</font></font></b>
  <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <b><font size=2>Sub Category<font class="moretxt"> *</font></font></b>
                                            </td></tr>
                                            <?php 
                                            }
                                            ?>
                                            <!--<tr><td>
                                            <select name=cbosubcat><option value="0">Select</option>
                                            <?php while($sub_row=mysql_fetch_array($sub_res))
                                              {
                                              if(trim($sub_row['category_id'])==trim($sub_cat))
                                              {
                                              ?>
                                              <option value="<?php echo  $sub_row['category_id'] ?>" selected><?php echo  $sub_row['category_name']?></option>
                                              <?php 
                                              }
                                              else
                                                {
                                                    ?>
                                              <option value="<?php echo  $sub_row['category_id'] ?>"><?php echo  $sub_row['category_name'] ?></option>
                                              <?php
                                              }
                                              $sub_cat_id=$sub_row['category_id'];
                                              $ssid=$sub_row['category_id'];
                                              ret($ssid,$sub_cat);
                                              }
                                              ?>
                                              </select>
                                             </td></tr>-->
                                            <?php 
                                            */}
                                            ?>
                                            <tr><td class="banner1">
                                                    <?php if(!empty($err_title))
                                                    {
                                                    ?>
                                                    <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_title ?></font>
                                                    <br>
                                                    <b><font class="moretxt">Item title</font></b><b><font class="moretxt"> *</font></b>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <b><font size=2 >Item title </font><font class="moretxt">*</font></b>
                                                    <?php 
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr><td width=270 class="banner1">
                                                    <input type="text" name="txttitle" class="txtbig" value="<?php echo  $item_title; ?>" maxlength="55">
                                                    <font color="#666666">Ensure your title has specific details about your item. </font>
                                                </td></tr>
                                            <?php
                                            $currency_sell="select * from admin_settings where set_id=59";
                                            $currency_res=mysql_query($currency_sell);
                                            $currency_row=mysql_fetch_array($currency_res);
                                            $cur_sell=$currency_row[set_value];
                                            ?>
                                            <tr><td class="banner1">
                                                    <b><font size=2 >Subtitle</font></b>
                                                    <?php if($subtitlefee) 
                                                    {
                                                    ?>
                                                    <font class="moretxt"><b> (<?php echo $cur_sell?> <?php echo  $subtitlefee ?>)</b></font>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <font color="#669966" size="2"><b> (Free)</b></font>
                                                    <?php
                                                    }
                                                    ?>
                                                </td></tr>

                                            <tr><td width=260 class="banner1"><input type="text" name="txtsubtitle" class="txtbig" value="<?php echo  $subtitle; ?>" maxlength="55" >
                                                    <font color="#666666">Add a Subtitle (searchable by item description only) to give buyers more information.  </font>
                                                </td></tr>


                                            <tr width=758><td colspan="2"><font size="2" color="green"><b>Item Condition</b></font></td></tr>
                                            <tr><td class="banner1">
                                                    <?php if(!empty($err_specify))
                                                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_specify ?></font>
 <br>
 <b><font class="moretxt">Condition</font></b><b><font class="moretxt"> *</font></b>
 <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <b><font size=2>Condition </font><font class="moretxt">*</font></b>
                                                    <?php 
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr><td><select name="cboitemcondition" ><option value="0">Select</option>
                                                        <?php if($itemcondition=="New")
                                                        {
                                                        ?>
                                                        <option value="New" selected>New</option>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <option value="New">New</option>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php if($itemcondition=="Used")
                                                        {
                                                        ?>
                                                        <option value="Used" selected>Used</option>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <option value="Used">Used</option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select></td></tr>
                                            <tr>
                                                <?php
                                                if($sub_tot==0)
                                                { 
                                                if($file_path)
                                                require "$file_path";
                                                }
                                                ?>
                                            <tr><td class="banner1">
                                                    <?php if(!empty($err_des))
                                                    {
                                                    ?>
                                                    <img src="images/warning_9x10.gif">&nbsp;
                                                    <font class="moretxt"><?php echo  $err_des; ?></font>
                                                    <br>
                                                    <b><font class="moretxt">Item Description</font></b>
                                                    <b><font class="moretxt">*</font></b> 
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <b><font size=2>Item Description </font><font color="#FF0000">*</font></b>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <script language="JavaScript" type="text/javascript" src="html2xhtml.js"></script>
                                            <script language="JavaScript" type="text/javascript" src="richtext_compressed.js"></script>
                                            <tr><td id="itemdes">
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

                                            <input type="hidden" name="flag" value="1">
                                            <input type="hidden" name="cat_id" value="<?php echo  $cat_id; ?>">
                                            <input type="hidden" name="mode" value="<?php echo  $mode; ?>">
                                            <input type="hidden" name="sell_format" value="<?php echo  $sell_format; ?>">
                                            <input type="hidden" name="item_id" value="<?php echo  $item_id; ?>">
                                            <input type="hidden" name="own_html_flag" value="<?php echo  $ownhtml; ?>">
                                            <input type="hidden" name="sellitemid" value="<?php echo $sellitemid?>">
                                            <input type="hidden" name="content" value="">
                                            <tr><td colspan="2" align="center">

                                                    <?php if($mode=="" or $mode=="relist" or $mode=="repost" or $mode=="sellsimilar")
                                                    {
                                                    ?>
                                                    <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)" />
                                                    <?php
                                                    }
                                                    else if($mode=="change")
                                                    { 
                                                    ?>
                                                    <input type="image" src="images/save.gif" name="Image84" width="62" height="22" border="0" id="Image84" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image84', '', 'images/saveo.gif', 1)" value="Save" />
                                                    <?php
                                                    }

                                                    ?></td></tr>
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
                                            <?php //echo $content; ?>
                                        </table>
                                    </form>
                                </td></tr>
                        </table></td></tr></table>
        </td></tr></table>

<script language="javascript">
    function sel(elementname)
    {
        var element_name = elementname;
        if (element_name == "txttitle")
            document.RTEDemo.txttitle.focus();
        if (element_name == "cboitemcondition")
            document.RTEDemo.cboitemcondition.focus();
//if(element_name=="areades")
//document.RTEDemo.rte1.focus();
        if (element_name == "cbosubcat")
            document.RTEDemo.cbosubcat.focus();
    }
    function deffun()
    {
        document.RTEDemo.txttitle.focus();
    }
    deffun();
</script>