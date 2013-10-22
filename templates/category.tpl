<?php  
/***************************************************************************
*File Name				:category.tpl
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
<script type="text/javascript" src="js/preview_templates.js">
</script>
<!--<script type="text/javascript" src="js/loader.js">
</script>-->
<table width="958" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="12"></td>
                            </tr>
                            <tr>
                                <td width="3%">&nbsp;</td>
                                <td width="47%" class="searchresultitemtxt">Categories within&nbsp;<?php echo $cat_tit[category_name]; ?></td>
                                <td class="searchresult7txt"><a href="save" class="searchresult7txt"></a></td>
                            </tr>
                            <tr>
                                <td height="12"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                    <?php 
                                                    if(empty($mode))
                                                    {
                                                    ?>
                                                    <tr>
                                                        <td><table width="100%" height="27" border="0" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5">
                                                                <tr>
                                                                    <td width="20">&nbsp;</td>
                                                                    <td width="472"><a href="category.php?view=list&cate_id=<?php echo$cate_id;?>&mode=<?php echo$mode?>" class="searchresult8txt">List View</a> <span class="banner1">|</span> <a href="category.php?view=gallery&cate_id=<?php echo$cate_id;?>&mode=<?php echo$mode?>" class="searchresult8txt">Picture Gallery </a></td>
                                                                    <td width="50" class="searchresult9txt">&nbsp;</td>
                                                                    <td width="185"><label></label></td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                    <?php 
                                                    }
                                                    require 'include/cat_inc.php';
                                                    if($total_records==0)
                                                    {
                                                    ?>
                                                    <tr><td align="center" class="warning_color" colspan="5">
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <font class="errormsg">
                                                            <?php 
                                                            $select_sql="select * from error_message where err_id =48";
                                                            $select_tab=mysql_query($select_sql);
                                                            $select_row=mysql_fetch_array($select_tab);
                                                            echo $select_row[err_msg];
                                                            ?> </font>
                                                            <br>
                                                            <br>
                                                            <br></td></tr>
                                                </table>
                                                <?php  require 'include/footer.php'?>
                                                <?php  
                                                exit();
                                                }
                                                ?>

                                                <?php 
                                                if($total_records > 0)
                                                {
                                                ?>
                                                <table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                                                    <tr align="right" class="detail4txt">
                                                        <?php  
                                                        $net=($currec-1*$limitsize+$end)-$total_records;
                                                        $dis=$limitsize+$start;
                                                        if($net <= 0) $net=$end;
                                                        if($dis<=$total_records)
                                                        {
                                                        ?>
                                                        <td align="right">
                                                            <font size="2">Showing  <?php  echo $start+1; ?>
                                                            <?php  echo " - ". $dis; ?> of <?php  echo $total_records; ?> Items </font></td>
                                                        <?php  
                                                        }
                                                        else 
                                                        {
                                                        ?>
                                                        <td align="right">
                                                            <font size="2">Showing  <?php  echo $start+1;?>  of <?php  echo $total_records; ?> Item </font></td>
                                                        <?php 
                                                        }
                                                        if($currec!=1)
                                                        {
                                                        ?>
                                                        <td align="left" style="padding-left:3px">
                                                            <a href="category.php?currec=<?php echo($currec - 1);?>&view=<?php echo$view;?>&cate_id=<?php echo$cate_id;?>" class="dealtxt">
                                                                <font class="dealtxt">Previous </font></a></td>
                                                        <?php 
                                                        } 
                                                        $net=$total_records-($currec*$limitsize+$end) + $end;
                                                        if($net >$limitsize) $net=$limitsize;
                                                        if($net <= 0) $net=$end;
                                                        if($total_records > ($start + $end)) 
                                                        {
                                                        ?>  
                                                        <td align="left" style="padding-left:3px"><a href="category.php?currec=<?php echo($currec + 1);?>&view=<?php echo$view;?>&cate_id=<?php echo$cate_id;?>"class="dealtxt">
                                                                <font class="dealtxt"> Next </font> </a></td>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </tr></table>
                                                <?php 
                                                } 
                                                if($view=="list")
                                                {
                                                ?>				  
                                        <tr>
                                            <td><table width="100%" height="28" border="0" cellpadding="0" cellspacing="0" background="images/item_bg.gif">
                                                    <tr>

                                                        <td width="26">&nbsp;</td>
                                                        <td width="146" class="detail4txt">Image</td>
                                                        <td width="282" class="detail4txt"><div align="left">Item Title </div></td>
                                                        <td width="175" class="detail4txt"><div align="center"><?php  if($mode=="want") echo "No Of Responses"; else echo "Current Price"; ?> </div></td>
                                                        <td width="160" class="detail4txt"><div align="center"><?php if(empty($mode)){?><font size=2 ><b>Bids</b></font><?php }?></div></td>
                                                        <td width="169" class="detail4txt"><div align="center">Ends</div></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">

                                                    <?php 

                                                    while($record=mysql_fetch_array($recordset))
                                                    {
                                                    $bid_sql="select * from placing_bid_item where item_id=$record[item_id] and deleted='No'";
                                                    $bid_res=mysql_query($bid_sql);
                                                    $bid=mysql_fetch_array($bid_res);
                                                    $tot_bid=mysql_num_rows($bid_res);
                                                    $fea_sql="select * from featured_items where item_id=".$record['item_id'];
                                                    $fea_res=mysql_query($fea_sql);
                                                    $fea=mysql_fetch_array($fea_res);
                                                    $both="";
                                                    if($fea[highlight]=="Yes")
                                                    $both="highlight";

                                                    if($tot_bid!=0)
                                                    {
                                                    $chk_sql="select max(bidding_amount) from placing_bid_item where item_id=".$record['item_id']." and deleted='No'";
                                                    $chk_res=mysql_query($chk_sql);
                                                    $chk_row=mysql_fetch_array($chk_res);
                                                    $curprice=$chk_row[0];
                                                    $current_price=$curprice;
                                                    $no_bids=$tot_bid;
                                                    }
                                                    else
                                                    {
                                                    $current_price=$record['min_bid_amount'];
                                                    $no_bids="No Bid";
                                                    }
                                                    if($record[selling_method]=="fix")
                                                    {
                                                    $current_price=$record[quick_buy_price];
                                                    }


                                                    $expire_date =$record[expire_date]; 
                                                    require 'ends.php';
                                                    ?>						

                                                    <tr>
                                                        <td align="center" colspan="2">
                                                            <table style="border-bottom:1px solid #cccccc" width="920" border="0" cellspacing="0" cellpadding="0" align="center">
                                                                <tr>
                                                                    <td height="8"></td>
                                                                </tr>
                                                                <tr <?php if($both=="highlight"){ echo "class=highlight";}?>>
                                                                    <td align="center">
                                                                        <table width="950" border="0" cellspacing="0" cellpadding="0" align="center">
                                                                            <tr>
                                                                                <!-- <td width="3%" rowspan="2">&nbsp;</td>
                                                                                 <td width="2%"><input type="checkbox" name="checkbox7" value="checkbox" />
                                                                                     <label></label></td>-->
                                                                                <td width="13%" rowspan="2"><table width="80" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tr>
                                                                                            <td>
                                                                                                <?php 
                                                                                                if($record['selling_method']=='ads')
                                                                                                echo '<img src="images/hands(11).gif" border="0">';
                                                                                                if($record['selling_method']=='fix')
                                                                                                echo '<img src="images/buynow_icon.gif" border="0">';
                                                                                                if(($record['selling_method']=='auction') || ($record['selling_method']=='auction'))
                                                                                                echo '<img src="images/Auction(12).gif" border="0">';
                                                                                                ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div align="center">
                                                                                                    <?php 
                                                                                                    if($record['selling_method']=="ads")
                                                                                                    {
                                                                                                    ?>
                                                                                                    <a href="classifide_ad.php?item_id=<?php echo$record['item_id']?>">
                                                                                                        <?php 
                                                                                                        }
                                                                                                        else if($record['selling_method']=="want_it_now")
                                                                                                        {
                                                                                                        ?>
                                                                                                        <a href="wantitnowdes.php?item_id=<?php echo$record['item_id']?>">
                                                                                                            <?php 
                                                                                                            }
                                                                                                            else
                                                                                                            {
                                                                                                            ?>
                                                                                                            <a href="detail.php?item_id=<?php echo$record['item_id']?>">
                                                                                                                <?php 
                                                                                                                }
                                                                                                                if(!empty($record['picture1']) and file_exists("images/".$record['picture1']))
                                                                                                                {
                                                                                                                $fimg="images/".$record['picture1'];
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
                                                                                                                <img src="<?php echo$fimg?>" width="80" height="80"  onMouseOver="showtrail('<?php echo$imglarge?>', 'Featured', < ?php echo$widthp? > , < ?php echo$heightp? > )" onMouseOut="hidetrail()" align="top" border="0" />
                                                                                                                <?php 
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                ?>
                                                                                                                <img src="images/no-image.gif" alt="" width="80" height="80" border="0"/>
                                                                                                                <?php 
                                                                                                                }
                                                                                                                ?>
                                                                                                            </a>
                                                                                                        </div><div style="display: none; position: absolute;z-index:110;" id="preview_div"></div>
                                                                                                    </td>
                                                                                                    </tr>
                                                                                                    <!--<tr>
                                                                                                    <td><img src="images/zoom.gif" alt="" width="16" height="20" /></td>
                                                                                                    <td class="footer2txt"><a  href="#" class="searchresult11txt"  onMouseOver="showtrail('<?php echo$imglarge?>','Featured',<?php echo$widthp?>,<?php echo$heightp?>)" onMouseOut="hidetrail()" align="top" border="1">Enlarge</a></td>
                                                                                                    </tr>-->
                                                                                                    </table></td>
                                                                                                    <td valign="top" width="40%" rowspan="2"><table width="280" border="0" align="left" cellpadding="0" cellspacing="0">
                                                                                                            <tr>
                                                                                                                <td height="5"></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td><div align="justify" <?php if($fea[bold]=='Yes'){?> class="searchresult3txt_bold" <?php }else {?>class="searchresult3txt"
  <?php }?>>
                                                                                                                         <div align="justify">
                                                                                                                            <?php 
                                                                                                                            if($record[selling_method]=="ads")
                                                                                                                            {
                                                                                                                            ?>
                                                                                                                            <a href="classifide_ad.php?item_id=<?php echo$record['item_id']?>" <?php if($fea[bold]=='Yes'){?> class="searchresult3txt_bold" <?php }else {?>class="searchresult3txt"
  <?php }?>>
                                                                                                                               <?php 
                                                                                                                               }
                                                                                                                               else if($record['selling_method']=="want_it_now")
                                                                                                                               {
                                                                                                                               ?>
                                                                                                                               <a href="wantitnowdes.php?item_id=<?php echo$record['item_id']?>" <?php if($fea[bold]=='Yes'){?> class="searchresult3txt_bold" <?php }else {?>class="searchresult3txt"
  <?php }?>>
                                                                                                                               <?php 
                                                                                                                               }
                                                                                                                               else
                                                                                                                               {
                                                                                                                               ?>
                                                                                                                               <a href="detail.php?item_id=<?php echo$record['item_id']?>" <?php if($fea[bold]=='Yes'){?> class="searchresult3txt_bold" <?php }else {?>class="searchresult3txt"
  <?php }?>>
                                                                                                                                   <?php 
                                                                                                                                   }
                                                                                                                                   ?>
                                                                                                                                   <?php echo$record['item_title']?></a> </div>
                                                                                                                                    </div></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <td class="searchresult4txt"><?php echo$record['sub_title']?></td>
                                                                                                                                    </tr>
                                                                                                                                    </table></td>
                                                                                                                                    <td width="14%" rowspan="2" class="detail8txt"><div align="center">
                                                                                                                                            <?php 
                                                                                                                                            if($current_price!=0.00)
                                                                                                                                            {
                                                                                                                                            ?>
                                                                                                                                            <?php echo$record['currency']?><?php echo $current_price; ?> 
                                                                                                                                            <?php 
                                                                                                                                            }
                                                                                                                                            else
                                                                                                                                            echo "-";
                                                                                                                                            ?>
                                                                                                                                        </div></td>
                                                                                                                                    <td width="15%" rowspan="2" class="detail8txt"><div align="center"><?php if(empty($mode)){echo $no_bids; }?></div></td>
                                                                                                                                    <td width="13%" rowspan="2" class="detail8txt"><div align="center"><?php echo $string_difference; ?> </div></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <td>&nbsp;</td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <td height="5"></td>
                                                                                                                                    </tr>
                                                                                                                                    </table></td>
                                                                                                                                    </tr>
                                                                                                                                    </table></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <td><table style="border-bottom:1px solid #cccccc" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                                                                <tr>
                                                                                                                                                    <td height="8"></td>
                                                                                                                                                </tr>
                                                                                                                                            </table></td></tr>

                                                                                                                                    <?php 
                                                                                                                                    }
                                                                                                                                    }
                                                                                                                                    else if($view=="gallery")
                                                                                                                                    {

                                                                                                                                    ?>
                                                                                                                                    <tr><td><table width="100%" cellpadding="10" cellspacing="2">
                                                                                                                                                <tr>
                                                                                                                                                    <?php 
                                                                                                                                                    //$display=1;
                                                                                                                                                    $count=0;	
                                                                                                                                                    //$recordset=mysql_query($item_sql);
                                                                                                                                                    while($record=mysql_fetch_array($recordset))
                                                                                                                                                    {
                                                                                                                                                    $count=$count+1;
                                                                                                                                                    $bid_sql="select * from placing_bid_item where item_id=$record[item_id] and deleted='No' order by bid_id desc";
                                                                                                                                                    $bid_res=mysql_query($bid_sql);
                                                                                                                                                    $bid=mysql_fetch_array($bid_res);
                                                                                                                                                    $tot_bid=mysql_num_rows($bid_res);
                                                                                                                                                    $fea_sql="select * from featured_items where item_id=".$record['item_id'];
                                                                                                                                                    $fea_res=mysql_query($fea_sql);
                                                                                                                                                    $fea=mysql_fetch_array($fea_res);
                                                                                                                                                    $both="";
                                                                                                                                                    if($fea[highlight]=="Yes")
                                                                                                                                                    $both="highlight";

                                                                                                                                                    if($tot_bid!=0)
                                                                                                                                                    {
                                                                                                                                                    $chk_sql="select max(bidding_amount) from placing_bid_item where item_id=".$record['item_id']." and deleted='No'";
                                                                                                                                                    $chk_res=mysql_query($chk_sql);
                                                                                                                                                    $chk_row=mysql_fetch_array($chk_res);
                                                                                                                                                    $curprice=$chk_row[0];
                                                                                                                                                    $current_price=$curprice;
                                                                                                                                                    $no_bids=$tot_bid;
                                                                                                                                                    }
                                                                                                                                                    else
                                                                                                                                                    {
                                                                                                                                                    $current_price=$record['min_bid_amount'];
                                                                                                                                                    $no_bids="No Bid";
                                                                                                                                                    }
                                                                                                                                                    if($record[selling_method]=="fix")
                                                                                                                                                    {
                                                                                                                                                    $current_price=$record[quick_buy_price];
                                                                                                                                                    }
                                                                                                                                                    if($record['selling_method']=='ads')
                                                                                                                                                    $current_price="-";
                                                                                                                                                    $expire_date =$record[expire_date]; 
                                                                                                                                                    require 'ends.php';
                                                                                                                                                    ?>
                                                                                                                                                    <td>
                                                                                                                                                        <table width="400" cellpadding="10" cellspacing="2" class="tr_color_1" <?php if($both=="highlight"){?>style="border:1px solid #0099FF; background-repeat:repeat-x; background-position:bottom; padding-left:20px"<?php }?>>
                                                                                                                                                               <tr>
                                                                                                                                                                <td height="200" width="200">
                                                                                                                                                                    <?php 

                                                                                                                                                                    if(!empty($record[picture1]) and file_exists("images/".$record['picture1']))
                                                                                                                                                                    {

                                                                                                                                                                    $img=$record['picture1'];
                                                                                                                                                                    list($width, $height, $type, $attr) = getimagesize("images/$img");
                                                                                                                                                                    $h=$height;
                                                                                                                                                                    $w=$width;
                                                                                                                                                                    if($h>120)	
                                                                                                                                                                    {
                                                                                                                                                                    $nh=120;
                                                                                                                                                                    $nw=($w/$h)*$nh;
                                                                                                                                                                    $h=$nh;
                                                                                                                                                                    $w=$nw;
                                                                                                                                                                    }
                                                                                                                                                                    if($w>120)
                                                                                                                                                                    {
                                                                                                                                                                    $nw=120;
                                                                                                                                                                    $nh=($h/$w)*$nw;
                                                                                                                                                                    $h=$nh;
                                                                                                                                                                    $w=$nw;
                                                                                                                                                                    }




                                                                                                                                                                    ?>
                                                                                                                                                                    <?php 
                                                                                                                                                                    if($record['selling_method']=="auction" or $record['selling_method']=="fix" or $record['selling_method']=="dutch_auction")
                                                                                                                                                                    {
                                                                                                                                                                    ?>
                                                                                                                                                                    <a href="detail.php?item_id=<?php  echo $record['item_id']; ?>"><?php  } else if($record['selling_method']=="ads"){?><a href="classifide_ad.php?item_id=<?php  echo $record['item_id']; ?>"> <?php  } else {?><a href="wantitnowdes.php?item_id=<?php  echo $record['item_id']; ?>"> <?php  }?>
                                                                                                                                                                        <img  src="images/<?php  echo $record['picture1']; ?>" border=0  width=<?php echo $w; ?> height=<?php echo$h?> ></a> 
                                                                                                                                                                    <?php 

                                                                                                                                                                    }
                                                                                                                                                                    else
                                                                                                                                                                    {
                                                                                                                                                                    if($record['selling_method']=="auction" or $record['selling_method']=="fix" or $record['selling_method']=="dutch_auction")
                                                                                                                                                                    {
                                                                                                                                                                    ?>

                                                                                                                                                                    <a href="detail.php?item_id=<?php  echo $record['item_id']; ?>"> <?php  } else if($record['selling_method']=="ads"){?><a href="classifide_ad.php?item_id=<?php  echo $record['item_id']; ?>"> <?php  } else {?><a href="wantitnowdes.php?item_id=<?php  echo $record['item_id']; ?>"> <?php  }?>
                                                                                                                                                                        <img  src="images/no-image.gif" border=0 width=120 height=120 ></a> 
                                                                                                                                                                    <?php  
                                                                                                                                                                    }
                                                                                                                                                                    ?>		 
                                                                                                                                                                </td><td <?php if($both=="highlight"){ echo "class=highlight";}?> height="200" width="200">
                                                                                                                                                                    <?php 
                                                                                                                                                                    if($record['selling_method']=="auction" or $record['selling_method']=="fix" or $record['selling_method']=="dutch_auction")
                                                                                                                                                                    {
                                                                                                                                                                    ?>
                                                                                                                                                                    <a href="detail.php?item_id=<?php  echo $record['item_id']; ?>" class="searchresult3txt"> <?php  } else if($record['selling_method']=="ads"){?><a href="classifide_ad.php?item_id=<?php  echo $record['item_id']; ?>" class="searchresult3txt"> <?php  } else {?><a href="wantitnowdes.php?item_id=<?php  echo $record['item_id']; ?>" class="searchresult3txt"> <?php  }?> 
                                                                                                                                                                        <?php   if($fea[bold]=="Yes") {?><b><?php echo $record['item_title']; ?></b> <?php  }
                                                                                                                                                                        else { ?><?php echo$record['item_title']; ?> <?php  } ?></a><br />
                                                                                                                                                                    <?php  if($fea[subtitle_feature]=="Yes")
                                                                                                                                                                    {
                                                                                                                                                                    echo $item['sub_title'];
                                                                                                                                                                    }
                                                                                                                                                                    ?>
                                                                                                                                                                    <br><font class="detail8txt">Price:<?php echo $record[currency] ?>&nbsp;<?php echo $current_price; ?></font>
                                                                                                                                                                    <br><font class="detail8txt">Time left:<?php echo $string_difference; ?></font></td></tr></table>
                                                                                                                                                    </td>
                                                                                                                                                    <?php 
                                                                                                                                                    if($count==2)
                                                                                                                                                    {
                                                                                                                                                    echo "</tr><tr>";
                                                                                                                                                    $count=0;
                                                                                                                                                    }
                                                                                                                                                    ?>

                                                                                                                                                    <?php 
                                                                                                                                                    } //while
                                                                                                                                                    ?>
                                                                                                                                            </table></td></tr>
                                                                                                                                    <?php 
                                                                                                                                    }
                                                                                                                                    ?>

                                                                                                                                    <!--For Now        <tr>
                                                                                                                                              <td><table style="border:3px solid #d8eef7"width="727" height="34" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                                                                                                  <tr>
                                                                                                                                                    <td width="17">&nbsp;</td>
                                                                                                                                                    <td width="161" class="detailblacktxt">Page <span class="detail9txt">1</span> of 385 </td>
                                                                                                                                                    <td width="412"><table width="300" border="0" cellspacing="0" cellpadding="0">
                                                                                                                                                        <tr>
                                                                                                                                                          <td width="33"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image32','','images/pagelefto.gif',1)"><img src="images/pageleft.gif" name="Image32" width="20" height="20" border="0" id="Image32" /></a></td>
                                                                                                                                                          <td width="58" class="searchresult10txt"><a href="pre" class="searchresult10txt">Previous</a></td>
                                                                                                                                                          <td width="118" class="searchresult10txt"><a href="1" class="searchresult10txt">1</a> | <a href="2" class="searchresult10txt">2</a> | <a href="3" class="searchresult10txt">3</a> | <a href="4" class="searchresult10txt">4</a> | <a href="5" class="searchresult10txt">5</a> | <a href="6" class="searchresult10txt">6</a> | <a href="7" class="searchresult10txt">7</a> </td>
                                                                                                                                                          <td width="37" class="searchresult10txt"><a href="next" class="searchresult10txt">Next</a></td>
                                                                                                                                                          <td width="54"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image33','','images/pagerighto.gif',1)"><img src="images/pageright.gif" name="Image33" width="20" height="20" border="0" id="Image33" /></a></td>
                                                                                                                                                        </tr>
                                                                                                                                                    </table></td>
                                                                                                                                                    <td width="131"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                                                                                        <tr>
                                                                                                                                                          <td class="detailblacktxt">Go to page </td>
                                                                                                                                                          <td><label>
                                                                                                                                                            <input name="textfield3" type="text" size="4" />
                                                                                                                                                          </label></td>
                                                                                                                                                        </tr>
                                                                                                                                                    </table></td>
                                                                                                                                                  </tr>
                                                                                                                                              </table></td>
                                                                                                                                            </tr>   End of For Now-->
                                                                                                                                    <tr>
                                                                                                                                        <td height="3"></td>
                                                                                                                                    </tr>
                                                                                                                                    </table></td>
                                                                                                                                    </tr>
                                                                                                                                    </table></td>
                                                                                                                                    </tr>
                                                                                                                                    </table></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <td height="5"></td>
                                                                                                                                    </tr>
                                                                                                                                    </table></td>
                                                                                                                                    </tr>
                                                                                                                                    </table>
                                                                                                                                    </td>
                                                                                                                                    </tr>
                                                                                                                                    </table>
