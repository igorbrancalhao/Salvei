<?php
/***************************************************************************
*File Name				:myprofile.tpl
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
if($status==1)
{
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center" >
    <tr><td background="images/contentbg1.jpg" height=25><font class="detail3txt"><div align="left">&nbsp;&nbsp;Profile: Edit Profile</div></b></font> </td>
    </tr> 
    <tr><td valign="top">
            <table border="0" align="center" cellpadding="3" cellspacing="0" width="958" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                <tr> 
                    <td valign="top">
                        <br>
                        <br><div align="center">
                            <font size="2" color="green"> <?php 
                            require 'include/connect.php';
                            $select_sql="select * from error_message where err_id =40";
                            $select_tab=mysql_query($select_sql);
                            $select_row=mysql_fetch_array($select_tab);
                            echo '<b>'.$select_row[err_msg].'</b>';
                            ?> </font>

                            <br>
                            <br>
                            </td></tr>
                            <tr><td class="detail9txt" align="center"><center><a href="myauction.php" class="detail9txt" style="text-decoration:none">Back to myauction</a></center>
            </table>
        </td></tr>
</table>
<?php require'include/footer.php';
exit();
}
?>
<script language="javascript" type="text/javascript">
    function namevalchk(tag)
    {
        var1 = tag.value; // tval is textbox(element) checking for characters only
        s = var1.substr(var1.length - 1, 1);
        m = s.charCodeAt(0);
        if (!((m >= 97 && m <= 122) || (m >= 65 && m <= 90) || (m == 32) || isNaN(m)))
        {
            ch = var1.substr(0, var1.length - 1);
            tag.value = ch;
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
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr><td background="images/contentbg1.jpg" height=25><font class="detail3txt"><div align="left">&nbsp;&nbsp;Profile: Edit Profile</div></b></font> </td>
    </tr> 
    <tr><td  background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"> 
            <table width="956" cellpadding="5" cellspacing="0" border=0 align="center">
                <tr><td>
                        <?php if($err_flag==1)
                        { 
                        ?>
                        <table align="center"><tr><td>
                                    <img src="images/warning_39x35.gif"></td>
                                <td><font class="errormsg">The following must be corrected before continuing:</font></td>
                                <?php if(!empty($err_first))
                                {
                                ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#txtfirst" class="header_text2">First Name</a> - <?php echo  $err_first; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_last))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#txtlast" class="header_text2">Last Name</a> - <?php echo  $err_last; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_add))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#txtaddress" class="header_text2">Street Address</a> - <?php echo  $err_add; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_city))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#txtcity" class="header_text2">City</a> - <?php echo  $err_city; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_state))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#cbostate" class="header_text2">State</a> - <?php echo  $err_state; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_code))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#txtzipcode" class="header_text2">Zip Code</a> - <?php echo  $err_code; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_country))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#cbocountry" class="header_text2">country</a> - <?php echo  $err_country; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_primary))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#txtprimary" class="header_text2">Primary</a> - <?php echo  $err_primary; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_secondary))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#txtsecondary" class="header_text2">Secondary</a> - <?php echo  $err_secondary; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_email))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#txtemail" class="header_text2">Email Address</a> - <?php echo  $err_email; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_reemail))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="myprofile.php#txtreemail" class="header_text2">Re-enter Email</a> - <?php echo  $err_reemail; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <tr><td colspan="2"><hr noshade class="hr_color" size="1"></td></tr>
                        </table>
                        <?php
                        } 
                        ?>
                    </td></tr>

                <br>
                <form name=reg action="myprofile.php" method=post enctype="multipart/form-data">
                    <tr><td>
                            <table width="100%" cellpadding="2" cellspacing="2">
                                <tr><td width=285 class="detail9txt">
                                        <?php if(!empty($err_first))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo  $err_first ?></font>
                                        <br>
                                        <b><font size=2 color=red>First name</font></b>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2 >First name</font></b>
                                        <?php 
                                        }
                                        ?>
                                    </td>
                                    <td width="645" class="detail9txt">
                                        <?php if(!empty($err_last))
                                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo  $err_last ?></font>
 <br>
 <b><font size=2 color=red>Last name</font></b>
 <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2>Last name</font></b>
                                        <?php }
                                        ?>
                                    </td></tr>
                                <tr><td width=285><input type="text" name="txtfirst" class="txtmed" value=<?php echo  "$first"; ?>></td>
                                    <td><input type="text" name="txtlast" class="txtmed" value=<?php echo  "$last"; ?>></td></tr>
                                <tr><td colspan="2" class="detail9txt"> 
                                        <?php if(!empty($err_add))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;<font size=2><?php echo  $err_add ?></font>
                                        <br>
                                        <b><font size=2 color=red>Street Address</font></b>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2>Street Address</font></b>
                                        <?php 
                                        }
                                        ?></td></tr>
                                <tr><td colspan="2"><textarea name="txtaddress" rows=5 cols="25"><?php echo  "$address"; ?></textarea></td></tr>
                                <tr><td class="detail9txt">
                                        <?php
                                        if(!empty($err_zip))
                                        echo '<img src="images/warning_9x10.gif">&nbsp;<font size=2>'.$err_zip.'</font><br><font size=2 color=red>Zipcode</font></b>';
                                        else
                                        echo '<b><font size=2>Zipcode</font></b>';
                                        ?>

                                    </td>
                                    <td class="detail9txt">
                                        <?php if(!empty($err_country))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo  $err_country ?></font>
                                        <br>
                                        <b><font size=2 color=red>Country</font></b>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2>Country </font></b>
                                        <?php
                                        }
                                        ?> </td>
                                </tr>
                                <tr><td>
                                        <input type="text" name="txtzip" class="txtbig" value="<?php echo $zipcode?>">
                                    </td>
                                    <td><select name=cbocountry>
                                            <option value=0>Select</option>
                                            <?php 
                                            $country_sql="select * from country_master";
                                            $country_res=mysql_query($country_sql);
                                            while($country_row=mysql_fetch_array($country_res))
                                            {
                                            if(trim($country_row['country_id'])==trim($country))
                                            {
                                            ?>
                                            <option value="<?php echo  $country_row['country_id'] ?>" selected><?php echo  $country_row['country']?></option>
                                            <?php 
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="<?php echo  $country_row['country_id'] ?>"><?php echo  $country_row['country']?></option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr><td class="detail9txt">
                                        <?php if(!empty($err_state))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo  $err_state ?></font>
                                        <br>
                                        <b><font size=2 color=red>State</font></b>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2>State </font></b>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="detail9txt">
                                        <?php if(!empty($err_city))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;<font size=2><?php echo  $err_city ?></font>
                                        <br>
                                        <b><font size=2 color=red>City</font></b>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2>City</font></b></td></tr>
                                <?php } ?>
                                <tr><td><input type="text" name="txtstate" class="txtmed" onKeyPress="namevalchk(this);" onBlur="namevalchk(this);" onKeyDown="namevalchk(this);" onKeyUp="namevalchk(this);" maxlength="20"  value="<?php echo $state; ?>" >
                                    </td><td><input type="text" name="txtcity" onKeyPress="namevalchk(this);" onBlur="namevalchk(this);" onKeyDown="namevalchk(this);" onKeyUp="namevalchk(this);" class="txtbig" value=<?php echo  "$city"; ?>></td></tr>
                                <tr><td class="detail9txt">
                                        <?php if(!empty($err_primary))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo  $err_primary ?></font>
                                        <br>
                                        <b><font color="red" size="2">Land Line</font></b> 
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size="2">Land Line</font></b> 
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="detail9txt">
                                        <?php if(!empty($err_secondary))
                                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo  $err_secondary ; ?></font>
 <br>
              <b><font size=2 color=red>Mobile phone</font></b> 
              <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2>Mobile phone</font></b> 
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr> 
                                <tr><td>
                                        <input type="text" name="txtprimary1" style="font-size:12px;font-family:arial;width:40;height:20" value="<?php echo  $primary1; ?>" maxlength="4" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);" size="3">&nbsp;-&nbsp;<input type="text" name="txtprimary2" class="txtsmall" value="<?php echo  $primary2; ?>" maxlength="5" size="7" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);">&nbsp;-&nbsp;<input type="text" name="txtprimary" class="txtsmall" value="<?php echo $primary?>" maxlength="10" size="10" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);" /></td>
                                    <td>
                                        <input type="text" name="txtsecondary1" style="font-size:12px;font-family:arial;width:40;height:20" value="<?php echo  $secondary1; ?>" maxlength="5" size="3" >&nbsp;-&nbsp;<input type="text" name="txtsecondary" class="txtsmall" value="<?php echo  $secondary; ?>" maxlength="10" size="7">
                                    </td></tr>
                                <tr><td colspan="6"><hr noshade class="hr_color" size="1"></td></tr>  
                                <tr><td colspan="6"><b><font size="2" color="green">Important:</font></b>&nbsp;&nbsp;<font size="2">
                                        A valid email address is required to complete registration</font><br><br></td></tr>

                                <tr><td colspan="6" class="detail9txt">
                                        <?php if(!empty($err_email))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo  $err_email ; ?></font>
                                        <br>
                                        <b><font size=2 color=red>Email Address</font></b>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2>Email Address</font></b>
                                        <?php
                                        }
                                        ?>
                                    </td></tr>
                                <tr><td colspan="6" class="detail9txt">
                                        <input type="text" name="txtemail" class="txtbig" value=<?php echo  "$email"; ?>><br>
                                        Examples: myname@yahoo.com, myname@example.com, etc. <br><br>
                                    </td></tr>
                                <tr><td colspan="6" class="detail9txt">
                                        <?php if(!empty($err_reemail))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo  $err_reemail ; ?></font>
                                        <br>
                                        <b><font size=2 color=red>Re-enter Email</font></b>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2>Re-enter Email</font></b>
                                        <?php
                                        }
                                        ?>
                                    </td></tr>
                                <tr><td colspan="6"><input type="text" name="txtreemail" class="txtbig" value=<?php echo  "$reemail"; ?>></td></tr>
                                <input type="hidden" name=step value=1>
                                <input type="hidden" name="member" value=<?php echo  $member; ?>>
                                       <tr><td colspan="6" align="center">
                                        <input type="submit" value="Update" name=submit class="buttonbig"></td></tr>

                            </table></td></tr></form></table></td></tr></table>

