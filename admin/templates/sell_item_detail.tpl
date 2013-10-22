<?php
/***************************************************************************
*File Name				:sell_item_detail.tpl
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
<?php require 'include/top.php'; ?>



<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center" class="border2">
    <link href="<?php= $ret1; ?>" rel="stylesheet" type="text/css">
    <tr><td valign="top">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
                <tr><td>
                        <table border="0" align="center" cellpadding="0" cellspacing="0" width="95%"  class="border2">
                            <tr height=40 bgcolor="#eeeee1">
                                <td class="tr_border" colspan=2><font size="3"><b>Sell Your Item:Tittle & Description</b>
                                    </font> </td></tr>
                            <tr bgcolor="#eeeee1">
                                <td height="30" colspan="2">
                                    1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;<b>Tittle & Description </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.Pictures & Details 4.&nbsp;Shipping Details & Sales Tax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;Preview & Submit </td>
                            </tr>
                            <tr bgcolor="#eeeee1"><td>
                                    <?php if($err_flag==1)
                                    { 
                                    ?>
                                    <table width="100%" align="center"><tr><td>
                                                <img src="images/warning_39x35.gif"></td>
                                            <td><font size=2 color="red">The following must be corrected before continuing:</font></td></tr>
                                        <?php if(!empty($err_subtitle))
                                        {
                                        ?>
                                        <tr bgcolor="#eeeee1"><td>&nbsp;</td>
                                            <td><a href="sell_item_detail.php#cbosubcat">Subcategory</a> - <?php= $err_title; ?></td></tr>
                                        <?php 
                                        }
                                        ?>



                                        <?php if(!empty($err_title))
                                        {
                                        ?>
                                        <tr bgcolor="#eeeee1"><td>&nbsp;</td>
                                            <td><a href="sell_item_detail.php#txttitle">Item Title</a> - <?php= $err_title; ?></td></tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php
                                        if(!empty($err_des))
                                        {
                                        ?>
                                        <tr bgcolor="#eeeee1"><td>&nbsp;</td><td><a href="sell_item_detail.php#areades">Item Description</a> - <?php= $err_des; ?></td></tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php
                                        // if(!empty($err_subtitle))
                                        // {
                                        ?>
                                        <!--<tr bgcolor="#eeeee1"><td>&nbsp;</td><td><a href="sell_item_detail.php#txtsubtitle">Sub Category</a> - <?php= $err_subtitle; ?></td></tr>-->
                                        <?php 
                                        //}
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
                                        <tr bgcolor="#eeeee1"><td>&nbsp;</td><td><a href="sell_item_detail.php#<?php= $tab_col->name ?>"><?php= $tab_col->name ?></a>-<?php= $select_row[err_msg] ?></td></tr>
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
                                        <tr bgcolor="#eeeee1"><td>&nbsp;</td><td><a href="sell_item_detail.php#<?php= $tab_col->name ?>"><?php= $tab_col->name ?></a>-<?php= $select_row[err_msg] ?></td></tr>
                                        <?php
                                        }
                                        }
                                        }
                                        $i++;
                                        }
                                        }  ?>
                                    </table></td></tr>
                            <tr bgcolor="#eeeee1"><td>
                                    <hr size="1" noshade class="hr_color"></td></tr>
                            <?php
                            }
                            ?>
                            <tr bgcolor="#eeeee1">
                                <td> 
                                    <form name="form1" action="sell_item_detail.php"  method=post enctype="multipart/form-data">
                                        <table width="100%" cellpadding="5" cellspacing="2" >
                                            <?php
                                            function display_subcategory($sub_cat_id,$sub_cat,$chk)
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
                                            <option value="<?php= $sub1_row['category_id'] ?>" selected> &nbsp;&nbsp;&nbsp; <?php= $sub1_row['category_name'] ?></option>
                                            <?php 
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="<?php= $sub1_row['category_id'] ?>"> &nbsp;&nbsp;&nbsp;<?php= $sub1_row['category_name'] ?></option>
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
                                            <option value="<?php=$cat_row['category_id'];?>" selected ><?php=$cat_row['category_name'];?></option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="<?php=$cat_row['category_id'];?>">&nbsp;&nbsp;&nbsp;<?php=$cat_row['category_name'];?></option>
                                            <?php
                                            }
                                            $ssid=$cat_row['category_id'];
                                            ret($ssid,$subsub_id);
                                            }

                                            }


                                            //////////////////////////////////////


                                            if($_SESSION[categoryid])
                                            {
                                            $sub_sql="select * from category_master where category_head_id=$_SESSION[categoryid]";
                                            $sub_res=mysql_query($sub_sql);
                                            $sub_tot=mysql_num_rows($sub_res);
                                            }

                                            if($sub_tot!=0)
                                            { 
                                            ?>
                                            <?php 
                                            if(!empty($err_subtitle))
                                            {
                                            ?>
                                            <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>Please Select this Information</font>
                                            <br>
                                            <b><font size=2 color=red>Sub Category</font></b>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <b><font size=2 >Sub Category <font  color="#FF0000">*</font></font></b>
                                            <?php 
                                            }
                                            ?>
                                            <tr><td><select name=cbosubcat><option value="0">Select</option>
                                                        <?php while($sub_row=mysql_fetch_array($sub_res))
                                                        {
                                                        if(trim($sub_row['category_id'])==trim($sub_cat))
                                                        {
                                                        ?>
                                                        <option value="<?php= $sub_row['category_id'] ?>" selected><?php= $sub_row['category_name']?></option>
                                                        <?php 
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <option value="<?php= $sub_row['category_id'] ?>"><?php= $sub_row['category_name'] ?></option>
                                                        <?php
                                                        }
                                                        $sub_cat_id=$sub_row['category_id'];
                                                        $ssid=$sub_row['category_id'];
                                                        ret($ssid,$sub_cat);
                                                        }
                                                        ?>
                                                    </select>
                                                </td></tr>
                                            <?php 
                                            }
                                            ?>
                                            <tr><td>
                                                    <?php if(!empty($err_title))
                                                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_title ?></font>
 <br>
 <b><font size=2 color=red>Item title</font></b>
 <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <b><font size=2 >Item title</font><font color="red">*</font></b>
                                                    <?php 
                                                    }
                                                    ?>
                                                </td></tr>
                                            <tr><td width=270><input type="text" name="txttitle" class="txtbig" value="<?php= $item_title; ?>">
                                                    <font color="#666666">Ensure your title has specific details about your item. </font>
                                                </td></tr>
                                            <tr bgcolor="#eeeee1"><td>

                                                    <b><font size=2 >Subtitle</font></b>
                                                </td></tr>
                                            <tr bgcolor="#eeeee1"><td width=260><input type="text" name="txtsubtitle" class="txtbig" value="<?php= $subtitle; ?>">
                                                    <font color="#666666">Add a Subtitle (searchable by item description only) to give buyers more information.  </font>
                                                </td></tr>
                                            <tr bgcolor="#eeeee1" width=758><td colspan="2"><font size="2"><b>Item Specifies</b></font></td></tr>
                                            <tr bgcolor="#eeeee1"><td><font size=2><b>Condition</b></font></td></tr>
                                            <tr bgcolor="#eeeee1"><td><select name=cboitemcondition ><!--<option value="0">-</option>-->
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
                                            <tr><td>
                                                    <?php if(!empty($err_des))
                                                    {
                                                    ?>
                                                    <img src="images/warning_9x10.gif">&nbsp;
                                                    <font size=2 color=red><?php= $err_des; ?></font>
                                                    <br>
                                                    <b><font size=2 color=red>Item Description</font><font color="red">*</font></b>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <b><font size=2 >Item Description</font><font color="red">*</font></b>
                                                    <?php
                                                    }
                                                    ?>
                                                </td></tr>
                                            <TR><TD><a href="#" onclick="ownhtml12()">Enter Your Own HTML</a> &nbsp;&nbsp;&nbsp; <a href="#" onclick="ownhtml13()">HTML Editor</a> </TD></TR>
                                            <?php
                                            if($ownhtml!="yes")
                                            {
                                            ?>
                                            <tr><td width="700">
                                                    <?php
                                                    $browser_name=$_SERVER['HTTP_USER_AGENT'];
                                                    if(substr_count($browser_name,'Opera')==1) $brow_name='opera';
                                                    else if(substr_count($browser_name,'Netscape')==1) $brow_name='netscape';
                                                    else if(substr_count($browser_name,'Firefox')==1) $brow_name='firefox';
                                                    else $brow_name='ie';
                                                    if($brow_name=='netscape'||$brow_name=='opera'||$brow_name=='firefox') 
                                                    echo '<textarea name="htmlcontent" cols="60" rows="15">'.$itemdes.'</textarea>';
                                                    else require 'include/content.php'; 
                                                    ?>
                                                </td>
                                            </tr>
                                            <br>
                                            <!--<font size=2 class="hint_font">Describe your items features, benefits, 
                                            and condition. Be sure to include in your description: Condition (new, used, etc.)</font></td>
                                            </tr>-->
                                            <?php
                                            }
                                            else 
                                            {
                                            echo '<tr><td><textarea name="htmlcontent" cols="60" rows="15">'.$itemdes.'</textarea></td></tr>';

                                            }
                                            ?>


                                            <input type="hidden" name=flag value="1">
                                            <input type="hidden" name="cat_id" value=<?php= $cat_id; ?>>
                                                   <input type="hidden" name=mode value="<?php= $mode; ?>">
                                            <input type="hidden" name=sell_format value="<?php= $sell_format; ?>">
                                            <input type="hidden" name=item_id value=<?php= $item_id; ?>>
                                                   <input type="hidden" name=own_html_flag value=<?php= $ownhtml; ?>>
                                                   <input type="hidden" name=sellitemid value=<?php=$sellitemid?>>
                                                   <tr><td colspan="2" align="center">

                                                    <?php if($mode=="" or $mode=="relist" or $mode=="repost" or $mode=="sellsimilar")
                                                    {
                                                    ?>
                                                    <input type="submit" name=detsub value=Continue>
                                                    <?php
                                                    }
                                                    else if($mode=="change")
                                                    { 
                                                    ?>
                                                    <input type="submit" name=detsub value="Save" class="buttonbig">
                                                    <?php
                                                    }

                                                    ?></td></tr>
                                        </table>
                                    </form>
