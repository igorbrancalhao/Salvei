<?php
/***************************************************************************
 *File Name				:contact.tpl
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
 function validate()
 {
 	if(document.frmContact.txtName.value=='')
	{
		alert("Please enter your name");
		document.frmContact.txtName.focus();
		return false;
	}
	if(document.frmContact.txtCname.value=='')
	{
		alert("Please enter company name");
		document.frmContact.txtCname.focus();
		return false;
	}
	if(document.frmContact.txtEmail.value=='')
	{
		alert("Please enter email id");
		document.frmContact.txtEmail.focus();
		return false;
	}
	if(document.frmContact.txtSubject.value=='')
	{
		alert("Please enter subject");
		document.frmContact.txtSubject.focus();
		return false;
	}
	if(document.frmContact.textfield.value=='')
	{
		alert("Please enter message");
		document.frmContact.textfield.focus();
		return false;
	}
 }
 function fun()
{
   
        if(document.frmContact.txtName.value =="" || document.frmContact.txtName.value !="")
        {
                
                document.frmContact.txtName.focus();
                 return false;    
        }
		return true;
 }
function fun_email()
{
   
        if(document.frmContact.txtCname.value =="" || document.frmContact.txtCname.value !="")
        {
                
                document.frmContact.txtCname.focus();
                 return false;    
        }

         return true;
}
function fun_sub()
{
   
        if(document.frmContact.txtSubject.value =="" || document.frmContact.txtSubject.value !="")
        {
                
                document.frmContact.txtSubject.focus();
                 return false;    
        }

         return true;
}
function fun_msg()
{
   
        if(document.frmContact.textfield.value =="" || document.frmContact.textfield.value !="")
        {
                
                document.frmContact.textfield.focus();
                 return false;    
        }

         return true;
}

 </script>
<div id="bidding1"><table width="958" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
          <tr>
            <td width="37"><div align="center"><img src="images/contactform.jpg" alt="" width="16" height="16" /></div></td>
            <td width="911" class="categories_fonttype">Contact Form </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="943" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
          <tr>
            <td width="23" height="5"></td>
            </tr>
          <tr>
            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="4"></td>
                    </tr>
                    <tr>
                      <td width="4%">&nbsp;</td>
                      <td width="96%" class="moretxt">Fields marked with an asterisk (*) are required</td>
                    </tr>
                    <tr>
                      <td height="6" colspan="2" class="detail9txt" align="center"><center><noscript>Javascript must be enabled to focus the fields.</center></noscript></td>
                      </tr>
<?
if($err_flag==1)
{
?>
<tr><td align="center" colspan="2"><table align="center" width=500>
<tr><td><img src="images/warning_39x35.gif" /></td>
<td><font class="errormsg">The following must be corrected before continuing:</font></td>
</tr>
<?
if(!empty($nameflag))
{
?>
<tr><td>&nbsp;</td><td class="detail9txt"><a href="contact.php#txtName" onclick="return fun();" class="header_text">Your Name</a> - <?php echo $nameflag; ?></td></tr>
<?
}
if(!empty($emailflag))
{
?>
<tr ><td>&nbsp;</td><td class="detail9txt"><a href="contact.php#txtemail" onclick="return fun_email();" class="header_text">Email Id</a> - <?php echo $emailflag; ?></td></tr>
<?
}
if(!empty($err_email))
{
?>
<tr><td>&nbsp;</td><td class="detail9txt"><a href="contact.php#txtemail" onclick="return fun_email();" class="header_text">Email Id</a> - <?php echo $err_email; ?></td></tr>
<?
}
if(!empty($subjectflag))
{
?>
<tr><td>&nbsp;</td><td class="detail9txt"><a href="contact.php#txtSubject" onclick="return fun_sub();" class="header_text">Subject</a> - <?php echo $subjectflag; ?></td></tr>
<?
}
if(!empty($messageflag))
{
?>
<tr><td>&nbsp;</td><td class="detail9txt"><a href="contact.php#textfield" onclick="return fun_msg();" class="header_text">Message</a> - <?php echo $messageflag; ?></td></tr>
<?
}
?>
<tr><td colspan="2"  align="center"><hr noshade class="hr_color" size="1" width=70%></td></tr>
</table></td></tr>
<?
}
?>
                    <tr>
                      <td height="4"></td>
                    </tr>
                </table></td>
              </tr>
			   <form name="frmContact" action="contact.php" method="post">
              <tr>
                <td width="6%">&nbsp;</td>
                <td width="26%" class="helplinkstxt"><span class="banner1">Your Name</span> <span class="moretxt">*</span> </td>
                <td width="68%"><label>
                  <input type="text" name="txtName" class="txtbox" value="<?php echo $name; ?>" />
                </label></td>
              </tr>
              <tr>
                <td height="4"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="helplinkstxt"><span class="banner1">Company Name</span> <span class="moretxt">*</span> </td>
                <td><input type="text" name="txtCname" class="txtbig"  value="<?php echo $company; ?>"/></td>
              </tr>
              <tr>
                <td height="4"></td>
              </tr>
             <!-- <tr>
                <td>&nbsp;</td>
                <td class="helplinkstxt"><span class="banner1">Country </span><span class="moretxt">*</span> </td>
                <td><label>
                  <select name="select2">
                    <option>-Select-</option>
                  </select>
                </label></td>
              </tr>-->
              <tr>
                <td height="4"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="helplinkstxt"><span class="banner1">Your E-mail</span> <span class="moretxt">*</span> </td>
                <td><input type="text" name="txtEmail" class="txtbig" value="<?php echo $email; ?>"/></td>
              </tr>
              <tr>
                <td height="4"></td>
              </tr>
             <!-- <tr>
                <td>&nbsp;</td>
                <td class="helplinkstxt"><span class="banner1">Confirm E-Mail</span> <span class="moretxt">*</span> </td>
                <td><input type="text" name="textfield223" /></td>
              </tr>-->
              <tr>
                <td height="4"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="banner1">Priority</td>
                <td><select name="cboPriority" style="width:75;height:20;font-size=12;font-family:arial">
                <option value="">Select</option>
                <option value="High">High</option>
                <option value="Normal">Normal</option>
                <option value="Low">Low</option>
              </select>
                </td>
              </tr>
              <tr>
                <td height="4"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="banner1">Contact Purpose </td>
                <td> <select name="cboPurpose" style="width:170;height:20;font-size=12;font-family:arial">
               	<option value="">Select</option>
                <option value="Login">Login</option>
                <option value="Registration">Registration</option>
				<option value="Sell">Sell</option>
				<option value="Buy">Buy</option>
                <option value="Bidding Process">Bidding Process</option>
                <option value="Suggestions">Suggestions</option>
				</select>
                </td>
              </tr>
              <tr>
                <td height="4"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="helplinkstxt"><span class="banner1">Subject </span><span class="moretxt">*</span> </td>
                <td><input type="text" name="txtSubject" class="txtbig" value="<?php echo $subject; ?>"/></td>
              </tr>
              <tr>
                <td height="4"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="helplinkstxt"><span class="banner1">Message </span><span class="moretxt">*</span> </td>
                <td><label>
                  <textarea name="textfield"><?php echo $message; ?></textarea>
                </label></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="helplinkstxt">&nbsp;</td>
                <td>
				<input type="image" src="images/send.gif" name="Image15" width="62" height="22" border="0" id="Image15" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image15','','images/sendo.gif',1)" onclick="return validate();"/></td>
              </tr>
              <tr>
                <td height="2"></td>
              </tr>
			  <input type="hidden" name="flagsend" value="1" />
			  </form>
              <tr>
                <td height="4"></td>
              </tr>
            </table></td>
            </tr>
          <tr>
                 <td height="5"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="5"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
                <tr>
                  <td width="36"><div align="center"><img src="images/contactinfo.jpg" alt="" width="9" height="17" /></div></td>
                  <td width="912" class="categories_fonttype">Contact Information </td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="943" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
			<?
$query="select * from about_us where company_id = 1";
$tab=mysql_query($query);
if($row=mysql_fetch_array($tab))
$name=$row['company_name'];
$about_company=$row['company_detail'];
$address=$row['company_address'];
$phone=$row['company_phone'];
$fax=$row['company_fax'];
			?>
                <tr>
                  <td height="5"></td>
                </tr>
                <tr>
                  <td width="23">&nbsp;</td>
                  <td width="894" class="abtustxt"><table cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="2" class="categories_fonttype"><?php echo$name?></td>
                    </tr>
                    <tr>
                      <td width="23" height="6"></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="banner1"><?php echo$address?></td>
                    </tr>
                    <tr>
                      <td height="6"></td>
                    </tr>
                    <tr>
                      <td><img height="8" alt="" src="images/phone1.gif" width="11" /></td>
                      <td width="184" class="sitemaptxt">Phone: <?php echo$phone?></td>
                    </tr>
                    <tr>
                      <td height="6"></td>
                    </tr>
                    <tr>
                      <td><img height="9" alt="" src="images/fax.gif" width="7" /></td>
                      <td class="sitemaptxt">Fax: <?php echo$fax?></td>
                    </tr>
                    <tr>
                      <td height="8"></td>
                    </tr>
                    <!--<tr>
                      <td><img height="8" alt="" src="images/mail.gif" width="11" /></td>
                      <td class="banner1">info@ajauction.com</td>
                    </tr>
                    <tr>
                      <td height="6"></td>
                    </tr>-->
                    <tr>
                      <td colspan="2"><a href="contact.php" class="sitemaptxt">Click here to contact form </a></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                  </table>
                  </td>
                  <td width="24" class="abtustxt">&nbsp;</td>
                </tr>
                <tr>
                  <td height="5"></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  
</table>
</div>