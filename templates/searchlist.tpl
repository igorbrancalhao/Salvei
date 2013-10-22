<?php
/***************************************************************************
 *File Name				:searchlist.tpl
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
<div id="searchresult_left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="225" height="39" border="0" cellpadding="0" cellspacing="0" background="images/searchoptions.jpg">
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table style="border-right:1px solid #cccccc" width="201" border="0" cellspacing="0" cellpadding="0">
	<form name="searchlist_form" action="search.php" method="post">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="4"></td>
            </tr>
          <tr>
            <td width="6%" class="bestsellerstxt">&nbsp;</td>
            <td width="94%" class="searchresult1txt">Localiza&ccedil;&atilde;o:</td>
          </tr>
          <tr>
               <td height="4"></td>
            </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="15%"><label>
                  <input type="checkbox" name=chklocation />
                </label></td>
                <td width="78%"><label>
                  <select name="cbolocation">
                   <?php
$sql_ship="select * from shipping_location";
$sqlqry_ship=mysql_query($sql_ship);
while($sqlfetch_ship=mysql_fetch_array($sqlqry_ship))
{
?>
<option value="<?php=$sqlfetch_ship[ship_id]?>"><?php=$sqlfetch_ship['location']?></option>
<?php
}
?>
                  </select>
                </label></td>
              </tr>
              <tr>
              <td height="4"></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="searchresult1txt">Mostrar apenas: </td>
          </tr>
          <tr>
             <td height="4"></td>
            </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="15%"><input type="checkbox" name="chkbuyitnow" value="yes" /></td>
                <td width="78%" class="detailblacktxt">Produtos com valores fixos </td>
              </tr>
              <tr>
                  <td height="4"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="chkitemslistedsingle" value="yes" /></td>
                <td class="detailblacktxt">Items listed as Single </td>
              </tr>
              <tr>
              <td height="4"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="chkitemslisteddouble" value="yes" /></td>
                <td class="detailblacktxt">Items listed as Lots </td>
              </tr>
              <tr>
                <td height="4"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="chkitemscondition" value="yes" /></td>
                <td class="detailblacktxt"><select name="cboitemcondition">
                  <option value="New">Produto Novo</option>
                  <option value="Used">Produto Usado</option>
                </select></td>
              </tr>
              <tr>
               <td height="4"></td>
                </tr>
            </table></td>
          </tr>
        <!--  <tr>
            <td>&nbsp;</td>
            <td></td>
          </tr>-->
          <tr>
              <td height="4"></td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="16%"><label>
                  <input type="checkbox" name="chkitemspriced" value="yes" />
                </label></td>
                <td width="77%"><label class="detailblacktxt">Produtos com pre&ccedil;os </label></td>
              </tr>
              <tr>
                 <td height="4"></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="26%"><label>
                  <input name="txtpricedfrom" type="text" size="6" />
                </label></td>
                <td width="14%" class="detailblacktxt"><div align="center">para</div></td>
                <td width="53%"><input name="txtpricedto" type="text" size="6" /></td>
              </tr>
			  <input type="hidden" name="mode" value="searchlist">
<input type="hidden" name="chk" value="" />
              <tr>
                <td height="8"></td>
                </tr>
              <tr>
                   <td height="4"></td>
                </tr>
            </table></td>
          </tr>
          <tr>
       <td></td>
            <td><input type=image src="images/showitems.gif" name="Image11" width="94" height="22" border="0" id="Image11" onclick="return checkselection()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image11','','images/showitemso.gif',1)"/></td>
          </tr>
          
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  </form>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="192" height="41" border="0" cellpadding="0" cellspacing="0" background="images/narrow.jpg">
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>
			<?php
			require 'searchlistcategories.tpl';
			?>
			</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="7"></td>
          </tr>
          <tr>
            <td><div align="center"><img src="images/searchresultadd.gif" alt="" width="188" height="165" /></div></td>
          </tr>
          <tr>
           <td height="7"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</div><script>
function checkselection()
{
chkvalue=0;
checkstatus=document.searchlist_form.chklocation.checked;
if(checkstatus==true)
chkvalue=1;
checkstatus=document.searchlist_form.chkbuyitnow.checked;
if(checkstatus==true)
chkvalue=1;
checkstatus=document.searchlist_form.chkitemslistedsingle.checked;
if(checkstatus==true)
chkvalue=1;
checkstatus=document.searchlist_form.chkitemslisteddouble.checked;
if(checkstatus==true)
chkvalue=1;
checkstatus=document.searchlist_form.chkitemscondition.checked;
if(checkstatus==true)
chkvalue=1;
checkstatus=document.searchlist_form.chkitemspriced.checked;
if(checkstatus==true)
chkvalue=1;
if(chkvalue=="0")
{
alert("Select a search option");
return false;
}
else
{
document.searchlist_form.chk.value="yes";
return true;
}
}
</script>