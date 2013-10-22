<?php
/***************************************************************************
 *File Name				:search.tpl
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
<script type="text/javascript" src="js/preview_templates.js">
</script>
<script type="text/javascript" src="js/loader.js">
</script>
<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<body onload="MM_preloadImages('images/pagelefto.gif','images/pagerighto.gif')">
<div id="content">
<?php
require 'templates/searchlist.tpl';
?>
<div id="searchresult_right">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="12"></td>
      </tr>
    <tr>
      <td width="3%">&nbsp;</td>
      <td width="47%"><span class="searchresultitemtxt">
	  <?php
	  if($mode!="linkmode")
	  {
	  ?>
	  <?php=$total_records?> produto(s) encontrado
	  <?php
	  }
	  else
	  {
	  $cattid=$_REQUEST['category_id'];
	  $cat_sql="select * from category_master where category_id=$cattid";
	  $cat_sqlqry=mysql_query($cat_sql);
	  $cat_sqlfetch=mysql_fetch_array($cat_sqlqry);
	  ?>
	  <?php=$total_records?> items found in: </span><span class="searchresult6txt"><?php=$cat_sqlfetch['category_name'];?> </span>
	  <?php
	  }
	  ?>
	  </td>
      <td width="30%" class="searchresult7txt"><a href="save" class="searchresult7txt"><!--(Save this search)--></a></td>
      <td width="20%" class="searchresult2txt"><a href="sell" class="searchresult2txt"><!--Sell in this category--></a></td>
    </tr>
    <tr>
     <td height="12"></td>
      </tr>
    <tr>
      <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="727" height="27" border="0" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5">
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="472"><a href="search.php?min_cur=<?php= $min_cur ?>&mode=<?php= $mode ?>&max_cur=<?php= $max_cur ?>&seller=<?php=$seller ?>&seller_name=<?php= $seller_name ?>&k_word=<?php= $k_word ?>&category_id=<?php= $category_id ?>&ava_loc=<?php= $ava_loc ?>&chklocation=<?php=$chklocation?>&cbolocation=<?php= $ship ?>&chkbuyitnow=<?php=$chkbuyitnow?>&chkitemslistedsingle=<?php=$chkitemslistedsingle?>&chkitemslisteddouble=<?php=$chkitemslisteddouble?>&chkitemscondition=<?php=$chkitemscondition?>&cboitemcondition=<?php=$itmcnd?>&chkitemspriced=<?php=$chkitemspriced?>&txtpricedfrom=<?php=$max_cur?>&txtpricedto=<?php=$min_cur?>&typechk=<?php=$typechk?>&cboprice=<?php= $cboprice ?>&key_word=<?php= $key_word ?>&cat_id=<?php= $cat_id ?>&product=<?php= $prd ?>&item_status=<?php= $item_status ?>&show_all=<?php=$show ?>&currec=<?php=$page ?>&cid=<?php=$cat_id?>&view=list&chk=yes&seller_id=<?php=$sellers_userid?>" class="searchresult8txt">Ver como Lista </a> <span class="banner1">|</span> <a href="search.php?min_cur=<?php= $min_cur ?>&mode=<?php= $mode ?>&max_cur=<?php= $max_cur ?>&seller=<?php=$seller ?>&seller_name=<?php= $seller_name ?>&k_word=<?php= $k_word ?>&category_id=<?php= $category_id ?>&ava_loc=<?php= $ava_loc ?>&chklocation=<?php=$chklocation?>&cbolocation=<?php= $ship ?>&chkbuyitnow=<?php=$chkbuyitnow?>&chkitemslistedsingle=<?php=$chkitemslistedsingle?>&chkitemslisteddouble=<?php=$chkitemslisteddouble?>&chkitemscondition=<?php=$chkitemscondition?>&cboitemcondition=<?php=$itmcnd?>&chkitemspriced=<?php=$chkitemspriced?>&txtpricedfrom=<?php=$max_cur?>&txtpricedto=<?php=$min_cur?>&typechk=<?php=$typechk?>&cboprice=<?php= $cboprice ?>&key_word=<?php= $key_word ?>&cat_id=<?php= $cat_id ?>&product=<?php= $prd ?>&item_status=<?php= $item_status ?>&show_all=<?php=$show ?>&currec=<?php=$page ?>&cid=<?php=$cat_id?>&view=gallery&chk=yes&seller_id=<?php=$sellers_userid?>" class="searchresult8txt">Ver como Galeria  </a></td>
                  <td width="50" class="searchresult9txt"><!--Sort By:--></td>
                  <td width="185"><!--<label>
                    <select name="select4">
                      <option>Time:Ending Soonest</option>
                    </select>
                  </label>--></td>
                </tr>
              </table></td>
            </tr>
            
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table style="border-bottom:1px solid #cccccc" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="8"></td>
                </tr>
<?php

if($total_records>0)
{
$view=$_REQUEST[view];
if(empty($view))
$view="list";
if($view=="list")
{
require 'templates/search_list_view.tpl';
} 
else
{
require 'templates/search_gallery_view.tpl';
}

for ($i=1; $i <=$total_records ; $i=$i+$limitsize)
{
 $countpage=$countpage+1;
}





$maxlen=15;

$chk=ceil($countpage/$maxlen);

$totalpages=ceil($total_records/$limitsize);

$m=$_GET[m];


$page_count=$_GET['page_count'];
if(empty($page_count))
$page_count=1;
else if(!empty($page_count) && ($m==nt))
$page_count=$page_count+1;
else if(!empty($page_count) && ($m==pr))
$page_count=$page_count-1;
/*else if(!empty($page_count))
{
$page_count=$page_count;
}
*/


if($countpage<=$maxlen)
{
$nextcount=0;
$maxlen=$countpage;
}
else
$nextcount=1;

$page=$_GET[page];
if(empty($page))
$page=0;
else if((!empty($page)) && ($m==nt))
{
$page=$page;
}
else if((!empty($page)) && ($m==pr))
{
$page=$page-$maxlen;
}

/*else if((!empty($page)) && (empty($m)))
$page=$page;
*/



?>

<tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10" height="10" background="images/top-esquerda.jpg"><img src="images/top-esquerda.jpg" width="10" height="10" /></td>
      <td background="images/center-top.jpg"><img src="images/center-top.jpg" width="10" height="10" /></td>
      <td width="10" height="10" background="images/top-direito.jpg"><img src="images/top-direito.jpg" width="10" height="10" /></td>
    </tr>
    <tr>
      <td width="10" background="images/center-esquerda.jpg">&nbsp;</td>
      <td><a href="detail.php?item_id=<?php=$bestsellers_fetch['item_id'];?>" class="bestsellerstxt"></a>
          <table width="727" height="34" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="17">&nbsp;</td>
              <!--<td width="98" class="detailblacktxt">Page <span class="detail9txt"><?php=$currec?></span> of <?php=$countpage?> </td>-->
              <td width="700"><table width="700" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="33"><?phpif(($countpage>1) && ($page>=$maxlen)){?>
                        <a href="search.php?min_cur=<?php= $min_cur ?>&amp;mode=<?php= $mode ?>&amp;max_cur=<?php= $max_cur ?>&amp;seller=<?php=$seller ?>&amp;seller_name=<?php= $seller_name ?>&amp;k_word=<?php= $k_word ?>&amp;category_id=<?php= $category_id ?>&amp;ava_loc=<?php= $ava_loc ?>&amp;chklocation=<?php=$chklocation?>&amp;cbolocation=<?php= $ship ?>&amp;chkbuyitnow=<?php=$chkbuyitnow?>&amp;chkitemslistedsingle=<?php=$chkitemslistedsingle?>&amp;chkitemslisteddouble=<?php=$chkitemslisteddouble?>&amp;chkitemscondition=<?php=$chkitemscondition?>&amp;cboitemcondition=<?php=$itmcnd?>&amp;chkitemspriced=<?php=$chkitemspriced?>&amp;txtpricedfrom=<?php=$max_cur?>&amp;txtpricedto=<?php=$min_cur?>&amp;typechk=<?php=$typechk?>&amp;cboprice=<?php= $cboprice ?>&amp;key_word=<?php= $key_word ?>&amp;cat_id=<?php= $cat_id ?>&amp;product=<?php= $prd ?>&amp;item_status=<?php= $item_status ?>&amp;show_all=<?php=$show ?>&amp;currec=<?php=$page ?>&amp;cid=<?php=$cat_id?>&amp;view=<?php= $view ?>&amp;page=<?php=$page?>&amp;page_count=<?php=$page_count?>&amp;m=pr" class="searchresult10txt" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image32','','images/pagelefto.gif',1)"><img src="images/pageleft.gif" name="Image32" width="20" height="20" border="0" id="Image32" /></a>
                        <?php}?></td>
                    <td width="58" class="searchresult10txt"><a href="search.php?min_cur=<?php= $min_cur ?>&amp;mode=<?php= $mode ?>&amp;max_cur=<?php= $max_cur ?>&amp;seller=<?php=$seller ?>&amp;seller_name=<?php= $seller_name ?>&amp;k_word=<?php= $k_word ?>&amp;category_id=<?php= $category_id ?>&amp;ava_loc=<?php= $ava_loc ?>&amp;chklocation=<?php=$chklocation?>&amp;cbolocation=<?php= $ship ?>&amp;chkbuyitnow=<?php=$chkbuyitnow?>&amp;chkitemslistedsingle=<?php=$chkitemslistedsingle?>&amp;chkitemslisteddouble=<?php=$chkitemslisteddouble?>&amp;chkitemscondition=<?php=$chkitemscondition?>&amp;cboitemcondition=<?php=$itmcnd?>&amp;chkitemspriced=<?php=$chkitemspriced?>&amp;txtpricedfrom=<?php=$max_cur?>&amp;txtpricedto=<?php=$min_cur?>&amp;typechk=<?php=$typechk?>&amp;cboprice=<?php= $cboprice ?>&amp;key_word=<?php= $key_word ?>&amp;cat_id=<?php= $cat_id ?>&amp;product=<?php= $prd ?>&amp;item_status=<?php= $item_status ?>&amp;show_all=<?php=$show ?>&amp;currec=<?php=$page ?>&amp;cid=<?php=$cat_id?>&amp;view=<?php= $view ?>&amp;page=<?php=$page?>&amp;page_count=<?php=$page_count?>&amp;m=pr" class="searchresult10txt">
                      <?phpif(($countpage>1) && ($page>=$maxlen)){?>
                      Anterior</a>
                        <?php}?></td>
                    <td width="560" class="searchresult10txt"><?php
					/*  for ($i=1; $i <=$total_records ; $i=$i+$limitsize)*/
					for ($i=1; $i <=$maxlen ; $i=$i+1)
{
$page=$page+1;
if($page>$totalpages)
break;
if($total_records > $limitsize) 
{
?>
                        <a href="search.php?min_cur=<?php= $min_cur ?>&amp;mode=<?php= $mode ?>&amp;max_cur=<?php= $max_cur ?>&amp;seller=<?php=$seller ?>&amp;seller_name=<?php= $seller_name ?>&amp;k_word=<?php= $k_word ?>&amp;category_id=<?php= $category_id ?>&amp;ava_loc=<?php= $ava_loc ?>&amp;chklocation=<?php=$chklocation?>&amp;cbolocation=<?php= $ship ?>&amp;chkbuyitnow=<?php=$chkbuyitnow?>&amp;chkitemslistedsingle=<?php=$chkitemslistedsingle?>&amp;chkitemslisteddouble=<?php=$chkitemslisteddouble?>&amp;chkitemscondition=<?php=$chkitemscondition?>&amp;cboitemcondition=<?php=$itmcnd?>&amp;chkitemspriced=<?php=$chkitemspriced?>&amp;txtpricedfrom=<?php=$max_cur?>&amp;txtpricedto=<?php=$min_cur?>&amp;typechk=<?php=$typechk?>&amp;cboprice=<?php= $cboprice ?>&amp;key_word=<?php= $key_word ?>&amp;cat_id=<?php= $cat_id ?>&amp;product=<?php= $prd ?>&amp;item_status=<?php= $item_status ?>&amp;show_all=<?php=$show ?>&amp;currec=<?php=$page ?>&amp;cid=<?php=$cat_id?>&amp;view=<?php= $view ?>" class="searchresult10txt">
                        <?php= $page ?>
                        </a>
                        <?php
if($i+$limitsize <= $total_records)
echo " | ";
}
}
$i=0;
?>
                    </td>
                    <td width="37" class="searchresult10txt"><?phpif(($nextcount==1) && ($page_count!=$chk)){?>
                        <a href="search.php?min_cur=<?php= $min_cur ?>&amp;mode=<?php= $mode ?>&amp;max_cur=<?php= $max_cur ?>&amp;seller=<?php=$seller ?>&amp;seller_name=<?php= $seller_name ?>&amp;k_word=<?php= $k_word ?>&amp;category_id=<?php= $category_id ?>&amp;ava_loc=<?php= $ava_loc ?>&amp;chklocation=<?php=$chklocation?>&amp;cbolocation=<?php= $ship ?>&amp;chkbuyitnow=<?php=$chkbuyitnow?>&amp;chkitemslistedsingle=<?php=$chkitemslistedsingle?>&amp;chkitemslisteddouble=<?php=$chkitemslisteddouble?>&amp;chkitemscondition=<?php=$chkitemscondition?>&amp;cboitemcondition=<?php=$itmcnd?>&amp;chkitemspriced=<?php=$chkitemspriced?>&amp;txtpricedfrom=<?php=$max_cur?>&amp;txtpricedto=<?php=$min_cur?>&amp;typechk=<?php=$typechk?>&amp;cboprice=<?php= $cboprice ?>&amp;key_word=<?php= $key_word ?>&amp;cat_id=<?php= $cat_id ?>&amp;product=<?php= $prd ?>&amp;item_status=<?php= $item_status ?>&amp;show_all=<?php=$show ?>&amp;currec=<?php=$page ?>&amp;cid=<?php=$cat_id?>&amp;view=<?php= $view ?>&amp;page=<?php=$page?>&amp;page_count=<?php=$page_count?>&amp;m=nt" class="searchresult10txt">Pr&oacute;xima</a>
                        <?php}?></td>
                    <td width="54"><?phpif(($nextcount==1) && ($page_count!=$chk)){?>
                        <a href="search.php?min_cur=<?php= $min_cur ?>&amp;mode=<?php= $mode ?>&amp;max_cur=<?php= $max_cur ?>&amp;seller=<?php=$seller ?>&amp;seller_name=<?php= $seller_name ?>&amp;k_word=<?php= $k_word ?>&amp;category_id=<?php= $category_id ?>&amp;ava_loc=<?php= $ava_loc ?>&amp;chklocation=<?php=$chklocation?>&amp;cbolocation=<?php= $ship ?>&amp;chkbuyitnow=<?php=$chkbuyitnow?>&amp;chkitemslistedsingle=<?php=$chkitemslistedsingle?>&amp;chkitemslisteddouble=<?php=$chkitemslisteddouble?>&amp;chkitemscondition=<?php=$chkitemscondition?>&amp;cboitemcondition=<?php=$itmcnd?>&amp;chkitemspriced=<?php=$chkitemspriced?>&amp;txtpricedfrom=<?php=$max_cur?>&amp;txtpricedto=<?php=$min_cur?>&amp;typechk=<?php=$typechk?>&amp;cboprice=<?php= $cboprice ?>&amp;key_word=<?php= $key_word ?>&amp;cat_id=<?php= $cat_id ?>&amp;product=<?php= $prd ?>&amp;item_status=<?php= $item_status ?>&amp;show_all=<?php=$show ?>&amp;currec=<?php=$page ?>&amp;cid=<?php=$cat_id?>&amp;view=<?php= $view ?>&amp;page=<?php=$page?>&amp;page_count=<?php=$page_count?>&amp;m=nt" class="searchresult10txt" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image33','','images/pagerighto.gif',1)"><img src="images/pageright.gif" name="Image33" width="20" height="20" border="0" id="Image33" />
                        <?php}?>
                      </a></td>
                  </tr>
                </table>
                  <!--</td>
                  <td width="131"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="detailblacktxt">-->
                  <!--Go to page-->
                  <!--</td>
                      <td>-->
                  <!--<label>
                        <input name="textfield3" type="text" size="4" />
                      </label>--></td>
            </tr>
          </table>
        <a href="detail.php?item_id=<?php=$endsoonitems_fetch['item_id']?>"></a></td>
      <td width="10" background="images/center-direito.jpg">&nbsp;</td>
    </tr>
    <tr>
      <td width="10" height="10" background="images/base-esquerda.jpg"><img src="images/base-esquerda.jpg" width="10" height="10" /></td>
      <td background="images/center-base.jpg"><img src="images/center-base.jpg" width="10" height="10" /></td>
      <td width="10" height="10" background="images/base-direitra.jpg"><img src="images/base-direitra.jpg" width="10" height="10" /></td>
    </tr>
  </table></td>
</tr>
              </table></td>
            </tr>
			<?php
			}
			else
			{
			?>
			<tr>
			  <td class="searchresultitemtxt">Nada encontrado para este produto </td>
			</tr>
			<?php
			}
			?>
            <tr>
              <td height="3"></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
  </td>
    </tr>
  </table>
</div>
</div>