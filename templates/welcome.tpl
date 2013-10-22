 <?php
  if(empty($_SESSION['userid']))
  {
  ?>
  <table width="446" height="217" border="0" align="center" cellpadding="0" cellspacing="0" background="images/welcomebg.jpg">
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td height="5" colspan="3" style="padding-left:50px; color:#4C639A; font-size:24px">
		  Bem vindo ao <?php=$sitename_fetch['set_value']?>
		  </td>
        </tr>
       <!-- <tr>
          <td height="7"></td>
        </tr>-->
        <tr>
          <td width="26">&nbsp;</td>
          <td width="396" class="banner1"><?php=$site_announcement?></td>
          <td width="24">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%">&nbsp;</td>
                <td colspan="2"><div align="left"><a href="signin.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image61','','images/signino.gif',1)"><img src="images/signin.gif" name="Image61" width="83" height="27" border="0" id="Image61" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:#F96403; font-size:16px"><b>Novo no <?php=$sitename_fetch['set_value']?>?</b></font></div> </td>
                <td width="31%">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="70%" style="padding-left:50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:#999999; font-size:14px"><b>O registro &eacute; r&aacute;pido e gratuito </b></font></td>
                <td width="30%"><div align="left"><a href="user_reg.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image62','','images/registero.gif',1)"><img src="images/register.gif" name="Image62" width="115" height="25" border="0" id="Image62" /></a></div></td>
              </tr>
              <tr>
                <td height="3"></td>
              </tr>
          </table></td>
        </tr>
</table>
	  <?php
	  }
	  else
	  {
	  ?>
	  <table width="446" height="217" border="0" align="center" cellpadding="0" cellspacing="0" background="images/welcomebg1.jpg">
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td height="5" colspan="3" style="padding-left:50px; color:#4C639A; font-size:24px">
		  Bem vindo ao <?php=$sitename_fetch['set_value']?>
		  </td>
        </tr>
        <!--<tr>
          <td height="7"></td>
        </tr>-->
        <tr>
          <td width="26">&nbsp;</td>
          <td width="396" class="banner1"><?php=$site_announcement?></td>
          <td width="24">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%">&nbsp;</td>
                <td width="61%"><div align="left"><a href="signout.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image69','','images/signouto.gif',1)">
				<img src="images/signout.gif" name="Image69" width="83" height="27" border="0" id="Image69" /></a><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image70','','images/signino.gif',1)"></a><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image61','','images/signino.gif',1)"></a></div></td>
                <td width="34%">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="70%">&nbsp;</td>
                <td width="30%"><div align="left"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image62','','images/registero.gif',1)"></a></div></td>
              </tr>
              <tr>
                <td height="3"></td>
              </tr>
          </table></td>
        </tr>
</table>
	  <?php
	  }
	  ?>