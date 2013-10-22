<?php
/***************************************************************************
 *File Name				:forward_to_friend.tpl
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
<div id="bidding1"><table width="958" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
          <tr>
            <td width="37"><div align="center"><img src="images/email.jpg" alt="" width="14" height="10" /></div></td>
            <td width="911" class="categories_fonttype">Email to a Friend </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="943" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
          <tr>
            <td width="17" height="5"></td>
            </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            <td width="911" class="banner1">Your friend will receive an email containing this <?php=$_SESSION['site_name']?> item. Please send   this email only to people you know who would be interested in this information.   You can also Refer a Friend to <?php=$_SESSION['site_name']?> through this forward a friend option. </td>
          </tr>
          <tr>
            <td height="7"></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            <td class="banner1">Sellers: If you use this service to advertise an item you are selling and the   recipient complains to <?php=$_SESSION['site_name']?> admin, your <?php=$_SESSION['site_name']?> registration may be   suspended. </td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
		  <form name=form1 action="forward_to_friend.php" method=post onsubmit="return checkEmail(this)">
          <tr>
            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="16%"><strong class="categories_fonttype">From</strong></td>
                <td width="6%" class="categories_fonttype">:</td>
                <td width="71%"><input type="text" name="mailfrom" size="50" maxlength="50" value="<?php= $user_record[email]; ?>" /></td>
              </tr>
              <tr>
                <td height="6"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td><strong class="categories_fonttype">To</strong></td>
                <td class="categories_fonttype">:</td>
                <td><input name="mailto" size="50" maxlength="50" value=""/></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><strong class="categories_fonttype">Enter an email address.</strong> <span class="banner1"><?php=$_SESSION['site_name']?> won't use this address for promotional   purposes, <br />
                  or disclose it to a third party. </span></td>
              </tr>
              <tr>
                 <td height="6"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td><strong class="categories_fonttype">Subject</strong></td>
                <td class="categories_fonttype">:</td>
                <td class="banner1"><?php= $_SESSION[username];?>sent you this <?php=$_SESSION['site_name']?> item : <?php= $item_record[item_title];?>(#<?php=$item_id;?>)</td>
              </tr>
              <tr>
              <td height="6"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td><strong class="categories_fonttype">Personal Message</strong></td>
                <td class="categories_fonttype">:</td>
                <td><label>
                  <textarea name="message">I saw this page on <?php=$_SESSION['site_name']?></textarea>
                </label></td>
              </tr>
              <tr>
             <td height="6"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>
				<input type="image" src="images/sendmessage.jpg" name="Image11" width="111" height="23" border="0" id="Image11" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image11','','images/sendmessageo.jpg',1)"/></td>
              </tr>
            </table></td>
          </tr>
		  <input type="hidden" name="subject" value="<?php= $subject; ?>">
<input type="hidden" name="item_id" value="<?php= $item_id; ?>">
<input type="hidden" name="canSend" value="1">
          </form>
          <tr>
                 <td height="10"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="5"></td>
      </tr>
    </table></td>
  </tr>
  
  
</table>
</div>

<script>
function checkEmail(frmContact) {
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(frmContact.mailto.value)){
return (true)
}
alert("Invalid E-mail Address! Please re-enter.")
return (false)
}
</script>

