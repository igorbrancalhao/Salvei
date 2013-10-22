<?php
/* * *************************************************************************
 * File Name				:ask.php
 * File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
 * ************************************************************************* */


/* * **************************************************************************

 *      Licence Agreement: 

 *     This program is a Commercial licensed software; 
 *     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
 *     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
 *     either user and developer versions of the License, or (at your option) 
 *     any later version is applicable for the same.

 * *************************************************************************** */
?>
<?php
require 'include/connect.php';
if (isset($_POST['btn_ask'])) {
    $style = $_POST['chkStyle'];

    $act_res = mysql_query("update admin_settings set set_value='$style' where set_id=45");
    $message = "Contact Seller Activated Successfully";
}
/* if(isset($_POST['btn_Activate'])) {
  $style=$_POST['chkStyle'];
  $sel_res=mysql_query("select * from css");
  while($sel_row=mysql_fetch_array($sel_res)) {
  if($style==$sel_row['css_id'])
  $act_res=mysql_query("update css set status='active' where css_id=$style");
  else
  $act_res=mysql_query("update css set status='inactive' where css_id=".$sel_row['css_id']);
  }
  } */
?>
<style type="text/css">
    <!--
    .style1 {
        color: #666666;
        font-weight: bold;
    }
    .style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
    -->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
    <tr><td>
            <table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
                <tr> 
                    <td height="24" colspan="3" class="txt_users"><center><br />Configurações de contato do vendedor<br><br></center></td>
    </tr>
    <tr><td>
            <table align="center" width="98%" height="200" class="border2" cellpadding="2">

                <form name="frm" method="post"  action="<?php $_SERVER['PHP_SELF'] ?>">
                    <tr bgcolor="#eeeee1"> 
                        <td colspan="2"><b>Dando  à ninguém   opção de contato com vendedores através de seu site não é recomendado. Por esta razão, a seguir opção dá-lhe a capacidade de decidir se usuários registrados podem contatar os vendedores ou não.
                                Por favor, faça sua escolha abaixo:</b></td>
                    </tr>
                    <tr bgcolor="#eeeee1">
                        <td colspan="2" align="center" class="style1"><font color="#FF0000">
                            <?php
                            if ($message != '')
                                echo $message;
                            ?>
                            </font>
                    </tr>
                    <?php
                    $ask_tab = mysql_query("select * from admin_settings where set_id=45");
                    $ask_row = mysql_fetch_array($ask_tab);
                    ?>
                    <!--<tr bgcolor="eeeee1"> 
                      <td width="10%" align="center">
                          <input type="radio" class="noborder" name="chkStyle" <?php if ($ask_row['set_value'] == 1) { ?> checked="checked" <?php } ?> value=1>
                          </td>
                      <td width="89%"> <b>Any visitor can contact the seller </b>
                      </td>
                    </tr>-->
                    <tr bgcolor="eeeee1"> 
                        <td width="5%"  align="center">
                            <input type="radio" class="noborder" name="chkStyle"  <?php if ($ask_row['set_value'] == 2) { ?> checked="checked" <?php } ?> value=2>
                        </td>
                        <td width="89%"><b>Somente usuários registrados podem contactar o vendedor </b>
                        </td>
                    </tr>
                    <tr bgcolor="eeeee1"> 
                        <td width="5%"  align="center">
                            <input type="radio" class="noborder" name="chkStyle"  <?php if ($ask_row['set_value'] == 3) { ?> checked="checked" <?php } ?> value=3>
                        </td>
                        <td width="89%"> <b>Ninguém pode contactar o vendedor </b>
                        </td>
                    </tr>
                    <tr bgcolor="eeeee1"> 
                        <td align="center" colspan="3" style="text-align:center"><input type="submit" name="btn_ask" value="Activate" class="button"></td>
                    </tr>
                </form>

            </table></td></tr></table>
</td></tr></table>


