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
<!--<script type="text/javascript" src="js/loader.js">
</script>
--><div id="content">
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
                        <?php=$total_records?> items found 
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
                                                    <td width="472"><a href="search.php?min_cur=<?php= $min_cur ?>&mode=<?php= $mode ?>&max_cur=<?php= $max_cur ?>&seller=<?php=$seller ?>&seller_name=<?php= $seller_name ?>&k_word=<?php= $k_word ?>&category_id=<?php= $category_id ?>&ava_loc=<?php= $ava_loc ?>&chklocation=<?php=$chklocation?>&cbolocation=<?php= $ship ?>&chkbuyitnow=<?php=$chkbuyitnow?>&chkitemslistedsingle=<?php=$chkitemslistedsingle?>&chkitemslisteddouble=<?php=$chkitemslisteddouble?>&chkitemscondition=<?php=$chkitemscondition?>&cboitemcondition=<?php=$itmcnd?>&chkitemspriced=<?php=$chkitemspriced?>&txtpricedfrom=<?php=$max_cur?>&txtpricedto=<?php=$min_cur?>&typechk=<?php=$typechk?>&cboprice=<?php= $cboprice ?>&key_word=<?php= $key_word ?>&cat_id=<?php= $cat_id ?>&product=<?php= $prd ?>&item_status=<?php= $item_status ?>&show_all=<?php=$show ?>&currec=<?php=$page ?>&cid=<?php=$cat_id?>&view=list&chk=yes&seller_id=<?php=$sellers_userid?>" class="searchresult8txt">List View</a> <span class="banner1">|</span> <a href="search.php?min_cur=<?php= $min_cur ?>&mode=<?php= $mode ?>&max_cur=<?php= $max_cur ?>&seller=<?php=$seller ?>&seller_name=<?php= $seller_name ?>&k_word=<?php= $k_word ?>&category_id=<?php= $category_id ?>&ava_loc=<?php= $ava_loc ?>&chklocation=<?php=$chklocation?>&cbolocation=<?php= $ship ?>&chkbuyitnow=<?php=$chkbuyitnow?>&chkitemslistedsingle=<?php=$chkitemslistedsingle?>&chkitemslisteddouble=<?php=$chkitemslisteddouble?>&chkitemscondition=<?php=$chkitemscondition?>&cboitemcondition=<?php=$itmcnd?>&chkitemspriced=<?php=$chkitemspriced?>&txtpricedfrom=<?php=$max_cur?>&txtpricedto=<?php=$min_cur?>&typechk=<?php=$typechk?>&cboprice=<?php= $cboprice ?>&key_word=<?php= $key_word ?>&cat_id=<?php= $cat_id ?>&product=<?php= $prd ?>&item_status=<?php= $item_status ?>&show_all=<?php=$show ?>&currec=<?php=$page ?>&cid=<?php=$cat_id?>&view=gallery&chk=yes&seller_id=<?php=$sellers_userid?>" class="searchresult8txt">Picture Gallery </a></td>
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
                                                ?>

                                                <tr>
                                                    <td><table style="border:3px solid #d8eef7"width="727" height="34" border="0" align="center" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td width="17">&nbsp;</td>
                                                                <td width="98" class="detailblacktxt">Page <span class="detail9txt"><?php=$currec?></span> of <?php=$countpage?> </td>
                                                                <td width="475"><table width="560" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr>
                                                                            <!-- <td width="33">
                                                                                                  <?phpif($countpage>1){?><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image32','','images/pagelefto.gif',1)"><img src="images/pageleft.gif" name="Image32" width="20" height="20" border="0" id="Image32" /></a><?php}?></td>
                                                                              <td width="58" class="searchresult10txt"><a href="pre" class="searchresult10txt"> <?phpif($countpage>1){?>Previous</a><?php}?></td>-->
                                                                            <td width="560" class="searchresult10txt"> 					
                                                                                <?php
                                                                                for ($i=1; $i <=$total_records ; $i=$i+$limitsize)
                                                                                {
                                                                                $page=$page+1;
                                                                                if($total_records > $limitsize) 
                                                                                {
                                                                                ?>					  
                                                                                <a href="search.php?min_cur=<?php= $min_cur ?>&mode=<?php= $mode ?>&max_cur=<?php= $max_cur ?>&seller=<?php=$seller ?>&seller_name=<?php= $seller_name ?>&k_word=<?php= $k_word ?>&category_id=<?php= $category_id ?>&ava_loc=<?php= $ava_loc ?>&chklocation=<?php=$chklocation?>&cbolocation=<?php= $ship ?>&chkbuyitnow=<?php=$chkbuyitnow?>&chkitemslistedsingle=<?php=$chkitemslistedsingle?>&chkitemslisteddouble=<?php=$chkitemslisteddouble?>&chkitemscondition=<?php=$chkitemscondition?>&cboitemcondition=<?php=$itmcnd?>&chkitemspriced=<?php=$chkitemspriced?>&txtpricedfrom=<?php=$max_cur?>&txtpricedto=<?php=$min_cur?>&typechk=<?php=$typechk?>&cboprice=<?php= $cboprice ?>&key_word=<?php= $key_word ?>&cat_id=<?php= $cat_id ?>&product=<?php= $prd ?>&item_status=<?php= $item_status ?>&show_all=<?php=$show ?>&currec=<?php=$page ?>&cid=<?php=$cat_id?>&view=<?php= $view ?>" class="searchresult10txt"><?php= $page ?></a> 
                                                                                <?php
                                                                                if($i+$limitsize <= $total_records)
                                                                                echo " | ";
                                                                                }
                                                                                }
                                                                                ?> </td>
                                                                                 <!--<td width="37" class="searchresult10txt"> <?phpif($countpage>1){?><a href="next" class="searchresult10txt">Next</a><?php}?></td>
                                                                                  <td width="54"> <?phpif($countpage>1){?><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image33','','images/pagerighto.gif',1)"><img src="images/pageright.gif" name="Image33" width="20" height="20" border="0" id="Image33" /><?php}?></a></td>-->
                                                                        </tr>
                                                                    </table><!--</td>
                                                                    <td width="131"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                      <tr>
                                                                        <td class="detailblacktxt">--><!--Go to page--> <!--</td>
                                                                        <td>--><!--<label>
                                                                          <input name="textfield3" type="text" size="4" />
                                                                        </label>--></td>
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
                                    <tr><td class="searchresultitemtxt">No Results Found</td></tr>
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