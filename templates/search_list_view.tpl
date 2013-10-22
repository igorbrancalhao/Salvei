<?php
/***************************************************************************
*File Name				:search_list_view.tpl
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
                    <table>
                        <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                    <tr>
                                        <!--<td width="20">&nbsp;</td>
                    <td width="20">&nbsp;</td>
                    <td width="20">&nbsp;</td>-->
                                        <td width="384" class="detail4txt"><center>
                                        Nome do Produto
                                    </center></td>
                            <td width="44" class="detail4txt"><div align="center">Ofertas</div></td>
                            <td width="62" class="detail4txt"><div align="center">Pre&ccedil;o</div></td>
                            <td width="118" class="detail4txt"><div align="center">Pre&ccedil;o de Reserva </div></td>
                            <td width="99" class="detail4txt"><div align="center">Final do Produto </div></td>
                        </tr>
                    </table></td>
            </tr>
            <?php            
            while($item=mysql_fetch_array($result))
            {
            $fea_sql="select * from featured_items where item_id=".$item['item_id'];
            $fea_res=mysql_query($fea_sql);
            $fea=mysql_fetch_array($fea_res);
            $both="";
            if($fea[highlight]=="Yes")
            $both="highlight";
            if($mode=="advanced")
            {
            $expire_date=$item[34];
            }
            else
            {
            $expire_date=$item['expire_date'];
            }
            require 'ends.php';
            $bid_sql="select * from placing_bid_item where item_id=".$item['item_id']." and deleted='No'";
            $bid_res=mysql_query($bid_sql);
            $bid=mysql_fetch_array($bid_res);
            $tot_sql="select count(*) from placing_bid_item where item_id=".$item['item_id']." and deleted='No'";
            $tot_res=mysql_query($tot_sql);
            $tot=mysql_fetch_array($tot_res);
            if($tot[0]==0)
            {
            $no_of_bid="No Bid";
            }
            if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction" or $item[selling_method]=="fix")
            {
            $no_of_bid=$tot[0];
            $bid_sql1="select * from placing_bid_item where item_id=".$item['item_id']." and deleted='No'";
            $bid_res1=mysql_query($bid_sql1);
            if(mysql_num_rows($bid_res1) > 0)
            {
            $bid_sql1="select MAX(bidding_amount) as amt from placing_bid_item where item_id=".$item['item_id']." and deleted='No'";
            $bid_res1=mysql_query($bid_sql1);
            $bid_row1=mysql_fetch_array($bid_res1);
            $curprice=$bid_row1['amt'];
            }
            else
            $curprice=$item[min_bid_amount];
            }
            ?>
            <tr>
                <td height="8"></td>
            </tr>
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
                                <table <?phpif($both=="highlight"){?>style="border:1px solid #000066; background-repeat:repeat-x; background-position:bottom; padding-left:5px"<?php}?> width="100%" border="0" cellspacing="0" cellpadding="0" height="80px">
                                    <tr <?phpif($both=="highlight"){ echo "class=highlight";}?>>
                                        <!-- <td width="1%">&nbsp;</td>
                   <td width="4%">&nbsp;</td><strong></strong><input type="checkbox" name="checkbox7" value="checkbox" />
                   <label></label>-->
                                        <td width="12%" rowspan="2"><table width="80" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td colspan="2"><div align="center">
                                                            <?php
                                                            if(!empty($item[picture1]) and file_exists('images/'.$item['picture1']))
                                                            {
                                                            if($item['selling_method']=='auction' || $item['selling_method']=='dutch_auction' || $item['selling_method']=='fix')
                                                            {
                                                            $fimg="images/".$item['picture1'];
                                                            $imglarge=$fimg;
                                                            list($widthp, $heightp, $typei, $attri) = getimagesize($imglarge);
                                                            $h=$heightp;
                                                            $w=$widthp;
                                                            if($h>=76){
                                                            $nh=77;$nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;}
                                                            if($w>=101){
                                                            $nw=101;$nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;}
                                                            ?>
                                                            <a href="detail.php?item_id=<?php=$item['item_id']?>"> <img src="<?php=$fimg?>" width="52" height="32"  onmouseover="showtrail('<?php=$imglarge?>', 'Featured', < ?php = $widthp? > , < ?php = $heightp? > )" onmouseout="hidetrail()" align="top" border="0" /> </a>
                                                            <div style="display: none; position: absolute;z-index:110;" id="preview_div"></div>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            $fimg="images/".$item['picture1'];
                                                            $imglarge=$fimg;
                                                            list($widthp, $heightp, $typei, $attri) = getimagesize($imglarge);
                                                            $h=$heightp;
                                                            $w=$widthp;
                                                            if($h>=76){
                                                            $nh=77;$nw=($w/$h)*$nh;
                                                            $h=$nh;
                                                            $w=$nw;}
                                                            if($w>=101){
                                                            $nw=101;$nh=($h/$w)*$nw;
                                                            $h=$nh;
                                                            $w=$nw;}
                                                            ?>
                                                            <a href="classifide_ad.php?item_id=<?php=$item['item_id']?>"> <img src="<?php=$fimg?>" width="52" height="32"  onmouseover="showtrail('<?php=$imglarge?>', 'Featured', < ?php = $widthp? > , < ?php = $heightp? > )" onmouseout="hidetrail()" align="top" border="0" /> </a>
                                                            <div style="display: none; position: absolute;z-index:110;" id="preview_div"></div>
                                                            <?php
                                                            }
                                                            }
                                                            else
                                                            {
                                                            if($item['selling_method']=='auction' || $item['selling_method']=='dutch_auction' || $item['selling_method']=='fix')
                                                            {
                                                            ?>
                                                            <a href="detail.php?item_id=<?php=$item['item_id']?>"> <img src="images/no-image.gif" alt="" width="52" height="38" border="0"/> </a>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <a href="classifide_ad.php?item_id=<?php=$item['item_id']?>"> <img src="images/no-image.gif" alt="" width="52" height="38" border="0"/> </a>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </div></td>
                                                </tr>
                                                <!-- <tr>
                     <td><img src="images/zoom.gif" alt="" width="16" height="20" /></td>
                       <td class="footer2txt"><a href="#" class="searchresult11txt"  onMouseOver="showtrail('<?php=$imglarge?>','Featured',<?php=$widthp?>,<?php=$heightp?>)" onMouseOut="hidetrail()" align="top">Enlarge</a></td>
                       </tr>-->
                                            </table></td>
                                        <td width="41%" rowspan="2"><table width="280" border="0" align="left" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td><div align="justify" <?phpif($fea[bold]=='Yes'){?> class="searchresult3txt_bold" <?php}else {?>class="searchresult3txt"
  <?php}?>>
                                                             <div align="justify">
                                                                <?php
                                                                if($item['selling_method']=='auction' || $item['selling_method']=='dutch_auction' || $item['selling_method']=='fix')
                                                                {
                                                                ?>
                                                                <a href="detail.php?item_id=<?php=$item['item_id'];?>" <?phpif($fea[bold]=='Yes'){?> class="searchresult3txt_bold" <?php}else {?>class="searchresult3txt"
  <?php}?>>
                                                                   <?php=$item['item_title'];?>
                                                            </a>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <a href="classifide_ad.php?item_id=<?php=$item['item_id'];?>" <?phpif($fea[bold]=='Yes'){?> class="searchresult3txt_bold" <?php}else {?>class="searchresult3txt"
  <?php}?>>
                                                               <?php=$item['item_title'];?>
                                                        </a>
                                                        <?php
                                                        }
                                                        ?>
                                                        <br />
                                                        <font class="detail8txt" style="font-size:x-small">
                                                        <?php
                                                        if(!empty($item['sub_title']))
                                                        {
                                                        echo $item['sub_title'];
                                                        }
                                                        ?>
                                                        </font> </div>
                                                </div></td>
                                        </tr>
                                        <!--<tr>
               <td class="searchresult4txt">Feedback:  (656) 100%</td>
               </tr>-->
                                    </table></td>
                                <td width="6%" rowspan="2" class="detail8txt"><div align="center">
                                        <?php
                                        if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction" )
                                        {
                                        echo $no_of_bid; 
                                        }
                                        else if($item[selling_method]=="fix")
                                        {
                                        $curprice=$item[quick_buy_price];
                                        ?>
                                        <img src="images/buyitnow.gif" />
                                        <?php
                                        }
                                        else if($item[selling_method]=="ads")
                                        {
                                        $curprice="-";
                                        ?>
                                        <img src="images/hands(11).gif" />
                                        <?php
                                        }
                                        ?>
                                    </div></td>
                                <td width="8%" rowspan="2" class="detail8txt"><div align="center">
                                        <?php
                                        if($curprice)
                                        {
                                        ?>
                                        <?php  echo  $item[currency]." ".$curprice; ?>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <?php echo $curprice; ?>
                                        <?php
                                        }
                                        ?>
                                    </div></td>
                                <td width="15%" rowspan="2" class="detail8txt"><div align="center">
                                        <?php
                                        if($item['selling_method']=='ads')
                                        echo "-";
                                        else
                                        {
                                        ?>
                                        <?php=$item['currency']?>
                                        <?php=$item['shipping_cost']?>
                                        <?php
                                        }
                                        ?>
                                    </div></td>
                                <td width="13%" rowspan="2" class="detail8txt"><div align="center" class="searchresult5txt"> <?php echo "$string_difference"; ?> </div></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
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
    <!--<tr>
<td height="20"></td>
</tr>-->
    <?php
    }
    ?>
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