<?php
session_start();
error_reporting(0);
require 'include/index_top.php';

/* Fetching Sitename */
$sitename_sql = "select * from admin_settings where set_id=47";
$sitename_sqlqry = mysql_query($sitename_sql);
$sitename_fetch = mysql_fetch_array($sitename_sqlqry);
/* End of Fetching Sitename */
/* Site announcement */
$sitenameanouncement_sql = "select * from site_announcement where id=1";
$sitenameanouncement_sqlqry = mysql_query($sitenameanouncement_sql);
$sitenameannouncement_fetch = mysql_fetch_array($sitenameanouncement_sqlqry);
$site_announcement = $sitenameannouncement_fetch['site_announcement'];
?>
<script type="text/javascript" src="js/crossfade.js"></script>
<script type="text/javascript">
    function myScrollLeft() {
        var x = getScrollX(window.frames['scrollerFrame']);
//    if (x <= 0)  window.frames['scrollerFrame'].scrollTo(832, 0);
        window.frames['scrollerFrame'].scrollBy(-5, 0);
    }

    function myScrollRight() {
        var x = getScrollX(window.frames['scrollerFrame']);
        //  if (x >= 832)  window.frames['scrollerFrame'].scrollTo(0, 0);
        window.frames['scrollerFrame'].scrollBy(5, 0);
    }

    function getScrollX(frame) {
        var x = 0;
        if (typeof (frame.pageXOffset) == 'number')
            x = frame.pageXOffset;

        else if (frame.document.body && frame.document.body.scrollLeft)
            x = frame.document.body.scrollLeft;

        else if (frame.document.documentElement && frame.document.documentElement.scrollLeft)
            x = frame.document.documentElement.scrollLeft;

        return x;
    }
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
<body onLoad="MM_preloadImages('images/detailso.gif', 'images/bidnow1o.gif')">
    <div id="content">
        <div id="banners">
            <table width="958" height="217" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td width="48%">
                        <?php
                        require 'templates/welcome.tpl';
                        ?>
                    </td>
                    <td width="52%"><table width="503" height="217" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
                            <tr>
                                <td valign="top"><table width="503" height="31" border="0" cellpadding="0" cellspacing="0" background="images/index6_01.gif">
                                        <tr>
                                            <td width="376">&nbsp;</td>
                                            <td width="127"><table width="107" height="18" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td> <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Img1', '', 'images/1o.gif', 1)"><img src="images/1.gif" name="Image14" width="19" height="18" border="0" id="Img1" style="display:none;" /></a></td>
                                                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Img2', '', 'images/2o.gif', 1)"><img src="images/2.gif" name="Image15" width="19" height="18" border="0" id="Img2"  style="display:none;" /></a></td>
                                                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Img3', '', 'images/3o.gif', 1)"><img src="images/3.gif" name="Image16" width="19" height="18" border="0" id="Img3"   style="display:none;"/></a></td>
                                                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Img4', '', 'images/4o.gif', 1)"><img src="images/4.gif" name="Image17" width="19" height="18" border="0" id="Img4"   style="display:none;"/></a></td>
                                                        <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Img5', '', 'images/5o.gif', 1)"><img src="images/5.gif" name="Image18" width="19" height="18" border="0" id="Img5"   style="display:none;"/></a></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <?php
                            $sql_banner1 = "select * from small_banner order by rand() limit 0,5";
                            $sqlqry_banner1 = mysql_query($sql_banner1);
                            $sqlnum_banner1 = mysql_num_rows($sqlqry_banner1);

                            if ($sqlnum_banner1 > 0) {
                                $site_query = "select * from admin_settings where set_id=1";
                                $site_table = mysql_query($site_query);
                                $site_row = mysql_fetch_array($site_table);
                                $site_name = $site_row['set_value'];
                                $l = 0;
                                while ($sqlfetch_banner1 = mysql_fetch_array($sqlqry_banner1)) {
                                    $ban.='"' . $sqlfetch_banner1['banner'] . '",';
                                    if ($sqlfetch_banner1['url'] == '')
                                        $ban_url = $site_name . "/index.php";
                                    else
                                        $ban_url = $sqlfetch_banner1['url'];
                                    $banlink.='"' . $ban_url . '",';
                                    $l++;
                                }
                                $banlink = trim($banlink, '0');
                                $ban = trim($ban, ',');
                            }
                            ?>
                            <tr>
                                <td height="189" width="503">
                                    <a href="index.php" id="banlink"><img id="test1" src="images/index6_02.gif" width="503" height="186" alt="" border="0"/></a>
                                </td>
                            </tr>
                        </table></td>
                </tr>
            </table>
            <?php
            if ($sqlnum_banner1 > 0) {
                ?>
                <script type="text/javascript" language="javascript">
                    var imgAry = [];
                    var iw = 1;
                    var i = 0;
                    var j = 0;
                    imgAry = [<?php echo $ban ?>];
                    banlinkAry = [<?php echo $banlink ?>];
                    var element2 = document.getElementById('test1');
                    var intrval = '0';
                    if (imgAry.length !== 1)
                        var hh = setInterval('trns()', 2000);
                    for (var ii = 0; ii < imgAry.length; ii++)
                    {
                        document.getElementById('Img' + (ii + 1)).style.display = 'block';
                    }
                    function trns()
                    {

                        crossfade(element2, imgAry[iw - 1], intrval, banlinkAry[iw - 1]);

                        iw++;
                        if (iw > imgAry.length)
                            iw = 1;
                    }

                </script>
                <?php
            }
            ?>
        </div>
        <div id="categories">
            <div id="categories_left">
                <div id="shop"><div class="shop_bg">Categorias</div><div class="bestbg">
                        <?php
                        $sql_category = "select * from category_master where category_head_id='0' and custom_cat='0' order by category_name";
                        $sqlqry_category = mysql_query($sql_category);
                        $sqlnumrows_category = mysql_num_rows($sqlqry_category);
                        if ($sqlnumrows_category > 0) {
                            while ($fetch_category = mysql_fetch_array($sqlqry_category)) {
                                $setsession[] = array($fetch_category['category_id'] => $fetch_category['category_name']);
                            }
                        }
                        $_SESSION["categories"] = $setsession;


                        /* Display of first Ten categories */
                        $sql_tencategory = "select * from category_master where category_head_id='0' and custom_cat='0' order by category_name";
                        $sqlqry_tencategory = mysql_query($sql_tencategory);
                        $sqlnumrows_tencategory = mysql_num_rows($sqlqry_tencategory);

                        $row = 10;

                        if ($sqlnumrows_tencategory > 0)
                            while ($fetch_firsttencategory = mysql_fetch_array($sqlqry_tencategory)) {
                                $category_name[] = $fetch_firsttencategory['category_name'];
                                $category_id[] = $fetch_firsttencategory['category_id'];
                            }
                        /* End of Display of first Ten Categories */
                        ?>
                        <table width="100%" height="280" border="0" cellpadding="0" cellspacing="0">
                            <?php
                            // for($k=0;$k<$row;$k++)
                            // {
                            ?>
                            <tr>
                                <td width="6%" bgcolor="#F8F8F8">&nbsp;</td>
                                <td width="82%" bgcolor="#F8F8F8" class="linksrollovertxt" id="category0">
                                    <a href="subcat.php?cate_id=<?php echo $category_id[0] ?>&view=list" class="linksrollovertxt"><?php echo $category_name[0] ?></a></td>
                                <td width="12%" bgcolor="#F8F8F8"><img src="images/categbullet.gif" alt="" width="8" height="7" id="image0"/></td>
                            </tr>
                            <tr>
                                <td height="1"></td>
                            </tr>
                            <?php
//}
                            ?>
                            <tr>
                                <td bgcolor="#F8F8F8">&nbsp;</td>
                                <td bgcolor="#F8F8F8" class="bestsellerstxt" id="category1">
                                    <a href="subcat.php?cate_id=<?php echo $category_id[1] ?>&view=list" class="linksrollovertxt"><?php echo $category_name[1] ?></a></td>
                                <td bgcolor="#F8F8F8"><img src="images/categbullet.gif" alt="" width="8" height="7" id="image1"/></td>
                            </tr>
                            <tr>
                                <td height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#F8F8F8">&nbsp;</td>
                                <td bgcolor="#F8F8F8" class="bestsellerstxt" id="category2">
                                    <a href="subcat.php?cate_id=<?php echo $category_id[2] ?>&view=list" class="linksrollovertxt"><?php echo $category_name[2] ?></a></td>
                                <td bgcolor="#F8F8F8"><img src="images/categbullet.gif" alt="" width="8" height="7"  id="image2"/></td>
                            </tr>
                            <tr>
                                <td height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#F8F8F8">&nbsp;</td>
                                <td bgcolor="#F8F8F8" class="bestsellerstxt" id="category3"><a href="subcat.php?cate_id=<?php echo $category_id[3] ?>&view=list" class="linksrollovertxt"><?php echo $category_name[3] ?></a></td>
                                <td bgcolor="#F8F8F8"><img src="images/categbullet.gif" alt="" width="8" height="7" id="image3"/></td>
                            </tr>
                            <tr>
                                <td height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#F8F8F8">&nbsp;</td>
                                <td bgcolor="#F8F8F8" class="bestsellerstxt" id="category4"><a href="subcat.php?cate_id=<?php echo $category_id[4] ?>&view=list" class="linksrollovertxt"><?php echo $category_name[4] ?></a></td>
                                <td bgcolor="#F8F8F8"><img src="images/categbullet.gif" alt="" width="8" height="7" id="image4"/></td>
                            </tr>
                            <tr>
                                <td height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#F8F8F8">&nbsp;</td>
                                <td bgcolor="#F8F8F8" class="bestsellerstxt" id="category5"><a href="subcat.php?cate_id=<?php echo $category_id[5] ?>&view=list" class="linksrollovertxt"><?php echo $category_name[5] ?></a></td>
                                <td bgcolor="#F8F8F8"><img src="images/categbullet.gif" alt="" width="8" height="7" id="image5" /></td>
                            </tr>
                            <tr>
                                <td height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#F8F8F8">&nbsp;</td>
                                <td bgcolor="#F8F8F8" class="bestsellerstxt" id="category6">
                                    <a href="subcat.php?cate_id=<?php echo $category_id[6] ?>&view=list" class="linksrollovertxt"><?php echo $category_name[6] ?></a></td>
                                <td bgcolor="#F8F8F8"><img src="images/categbullet.gif" alt="" width="8" height="7" id="image6"/></td>
                            </tr>
                            <tr>
                                <td height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#F8F8F8">&nbsp;</td>
                                <td bgcolor="#F8F8F8" class="bestsellerstxt" id="category7"><a href="subcat.php?cate_id=<?php echo $category_id[7] ?>&view=list" class="linksrollovertxt"><?php echo $category_name[7] ?></a></td>
                                <td bgcolor="#F8F8F8"><img src="images/categbullet.gif" alt="" width="8" height="7" id="image7"/></td>
                            </tr>
                            <tr>
                                <td height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#F8F8F8">&nbsp;</td>
                                <td bgcolor="#F8F8F8" class="bestsellerstxt" id="category8"><a href="subcat.php?cate_id=<?php echo $category_id[8] ?>&view=list" class="linksrollovertxt"><?php echo $category_name[8] ?></a></td>
                                <td bgcolor="#F8F8F8"><img src="images/categbullet.gif" alt="" width="8" height="7" id="image8" /></td>
                            </tr>
                            <tr>
                                <td height="1"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#F8F8F8">&nbsp;</td>
                                <td bgcolor="#F8F8F8" class="bestsellerstxt" id="category9">
                                    <a href="subcat.php?cate_id=<?php echo $category_id[9] ?>&view=list" class="linksrollovertxt"><?php echo $category_name[9] ?></a></td>
                                <td bgcolor="#F8F8F8"><img src="images/categbullet.gif" alt="" width="8" height="7" id="image9"/></td>
                            </tr>




                            <tr>
                                <td height="1"></td>
                            </tr>
                            <tr>
                                <td colspan="3" bgcolor="#F8F8F8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <?php
                                        if ($sqlnumrows_tencategory > 10) {
                                            ?>
                                            <tr>
                                                <td width="50%" bgcolor="#F8F8F8">&nbsp;</td>
                                                <td width="50%" class="searchresult9txt" id="nextprev" align="right" style="padding-right:5px">
                                                    <a href="browse_cate.php" class="moretxt" id="cat_next">Next</a>
                                                    <script>
                                                        document.getElementById("cat_next").href = "javascript:showCategories(2)";
                                                    </script>
                                                </td></tr>
                                            <?php
                                        }
                                        ?>	  
                                    </table></td>
                            </tr>
                        </table>
                        <?php
                        if ($sqlnumrows_tencategory > 10) {
                            ?>
                            <script>
                                showCategories(2, 0);
                            </script>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                /* Fetching top range item count number */

                $toprange = "select * from admin_settings where set_id = 21";
                $toprange_qry = mysql_query($toprange);
                $toprange_fetch = mysql_fetch_array($toprange_qry);
                $range = $toprange_fetch['set_value'];

                /* End of fetching top range item count number */

//echo $bestseller_sql="SELECT user_id as count_user,count(user_id) as usrcnt FROM placing_item_bid  GROUP BY user_id having count(user_id) >=$range and status='Active' and picture1!='' and selling_method!='want_it_now' and selling_method!='ads' and bid_starting_date <= now() and expire_date>=now() ORDER BY count_user DESC limit 0,1";
                $bestseller_sql = "SELECT user_id as count_user, count( user_id ) as usrcnt FROM placing_item_bid where status = 'Active' and picture1 != '' and selling_method != 'want_it_now' and selling_method != 'ads' and bid_starting_date <= now( ) and expire_date >= now( ) GROUP BY user_id HAVING count( user_id ) >= $range ORDER BY count_user DESC LIMIT 0, 1";
                $bestseller_sqlqry = mysql_query($bestseller_sql);
                $bestseller_fetch = mysql_fetch_array($bestseller_sqlqry);
                $bestseller_id = $bestseller_fetch['count_user'];
                ?>
                <div id="shop">
                    <div class="shop_bg">Melhores Lojas </div>
                    <div class="bestbg">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <?php
                            $bestsellers_sql = "select * from placing_item_bid where status='Active' and user_id='$bestseller_id' and picture1!='' and selling_method!='want_it_now' and selling_method!='ads' and bid_starting_date  and expire_date order by rand() limit 0,2";
//$bestsellers_sql="select * from placing_item_bid where status='active' and selling_method='ads' and picture1!='' and bid_starting_date <= now() order by rand() limit 0,1 ";
                            $bestsellers_sql = mysql_query($bestsellers_sql);
                            $counttop = 0;
                            if (mysql_num_rows($bestsellers_sql) > 0) {
                                while ($bestsellers_fetch = mysql_fetch_array($bestsellers_sql)) {
                                    $counttop = $counttop + 1;
                                    if (!empty($bestsellers_fetch['sub_title']))
                                        $item_subtitle1 = $bestsellers_fetch['sub_title'];
                                    else
                                        $item_subtitle1 = substr($bestsellers_fetch['item_title'], 0, 20);
                                    $item_title1 = substr($bestsellers_fetch['item_title'], 0, 40)
                                    ?>
                                    <tr>
                                        <td width="46%"><div align="center">
                                                <table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="10" height="10" background="images/top-esquerda.jpg"><img src="images/top-esquerda.jpg" width="10" height="10" /></td>
                                                        <td background="images/center-top.jpg"><img src="images/center-top.jpg" width="10" height="10" /></td>
                                                        <td width="10" height="10" background="images/top-direito.jpg"><img src="images/top-direito.jpg" width="10" height="10" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="10" background="images/center-esquerda.jpg">&nbsp;</td>
                                                        <td><a href="detail.php?item_id=<?php echo $bestsellers_fetch['item_id']; ?>" class="bestsellerstxt"><img src="thumbnail/<?php echo $bestsellers_fetch['picture1']; ?>" alt="" width="79" height="70" border="0" /></a><a href="detail.php?item_id=<?php echo $endsoonitems_fetch['item_id'] ?>"></a></td>
                                                        <td width="10" background="images/center-direito.jpg">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="10" height="10" background="images/base-esquerda.jpg"><img src="images/base-esquerda.jpg" width="10" height="10" /></td>
                                                        <td background="images/center-base.jpg"><img src="images/center-base.jpg" width="10" height="10" /></td>
                                                        <td width="10" height="10" background="images/base-direitra.jpg"><img src="images/base-direitra.jpg" width="10" height="10" /></td>
                                                    </tr>
                                                </table>
                                                <a href="detail.php?item_id=<?php echo $bestsellers_fetch['item_id']; ?>" class="bestsellerstxt"></a></div></td>
                                        <td width="54%"><div align="left"><span class="bestsellerstxt"><a href="detail.php?item_id=<?php echo $bestsellers_fetch['item_id']; ?>" class="bestsellerstxt"><?php echo $item_subtitle1; ?></a></span><br />
                                                <span class="bestsellers1txt"><a href="detail.php?item_id=<?php echo $bestsellers_fetch['item_id']; ?>" class="bestsellers1txt"><?php echo $item_title1; ?></a></span> </div></td>
                                    </tr>
                                    <tr>
                                        <td height="4"></td>
                                    </tr>
                                    <?php
                                    if ($counttop != 2) {
                                        ?>
                                        <tr>
                                            <td colspan="2" class="linetxt"><div align="center"><img src="images/categline.gif" alt="" width="169" height="1" /></div></td>
                                        </tr>
                                        <tr>
                                            <td height="4"></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr><td height="148" align="center" class="featxt">Nada encontrado</td></tr>
                                </table>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>

                <div id="shop">
                    <?php
                    $ad_sql = "select * from placing_item_bid where status='active' and selling_method='ads' and picture1!='' and bid_starting_date <= now() order by rand() limit 0,1 ";
// $ad_sql="select * from placing_item_bid a,featured_items b where a.status='Active' and a.selling_method='ads' and a.picture1!='' and a.bid_starting_date <= now() and a.expire_date>=now() and a.item_id=b.item_id and b.home_feature='Yes' order by rand() limit 0,1 ";
                    $ad_res = mysql_query($ad_sql);
                    $ad_rows = mysql_num_rows($ad_res);
                    if ($ad_rows > 0) {
                        $ad_fetch = mysql_fetch_array($ad_res);
                        ?>
                        <div class="shop_bg">An&uacute;ncios de Classificados </div>
                        <div class="bestbg">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" height=170>
                                <tr>
                                 <!-- <td width="6%">&nbsp;</td>-->
                                    <td width="34%" class="spotlight1txt" valign="top" align="center">
                                <center>

                                </center>
                                </td></tr><tr>
                                    <td width="60%" align="center"><table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="10" height="10" background="images/top-esquerda.jpg"><img src="images/top-esquerda.jpg" width="10" height="10" /></td>
                                                <td background="images/center-top.jpg"><img src="images/center-top.jpg" width="10" height="10" /></td>
                                                <td width="10" height="10" background="images/top-direito.jpg"><img src="images/top-direito.jpg" width="10" height="10" /></td>
                                            </tr>
                                            <tr>
                                                <td width="10" background="images/center-esquerda.jpg">&nbsp;</td>
                                                <td><a href="detail.php?item_id=<?php echo $bestsellers_fetch['item_id']; ?>" class="bestsellerstxt"></a>
                                                    <table width="0" border="0">
                                                        <tr>
                                                            <td align="center"><a href="classifide_ad.php?item_id=<?php echo $ad_fetch['item_id'] ?>" class="spotlight1txt">
                                                                    <?php echo $ad_fetch['item_title'] ?>
                                                                </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><a href="classifide_ad.php?item_id=<?php echo $ad_fetch['item_id'] ?>"><img src="thumbnail/<?php echo $ad_fetch['picture1'] ?>" alt="" width="106" height="71" border="0"/></a></td>
                                                        </tr>
                                                    </table>
                                                    <a href="detail.php?item_id=<?php echo $endsoonitems_fetch['item_id'] ?>"></a></td>
                                                <td width="10" background="images/center-direito.jpg">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="10" height="10" background="images/base-esquerda.jpg"><img src="images/base-esquerda.jpg" width="10" height="10" /></td>
                                                <td background="images/center-base.jpg"><img src="images/center-base.jpg" width="10" height="10" /></td>
                                                <td width="10" height="10" background="images/base-direitra.jpg"><img src="images/base-direitra.jpg" width="10" height="10" /></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td colspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <!--<tr>
                                          <td width="7%" valign="top">&nbsp;</td>
                                          <td width="86%" class="spotlighttxt" valign="top">
                                                      <a href="classifide_ad.php?item_id=<?php echo $ad_fetch['item_id'] ?>" class="spotlighttxt">
                                            <?php echo $ad_fetch['sub_title'] ?></a> </td>
                                          <td width="7%">&nbsp;</td>
                                        </tr>-->
                                            <tr>
                                                <td align="right"><a href="classifide_list.php" class="spotlight1txt">Ver lista </a></td>
                                            </tr>
                                        </table></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="shop_bg">An&uacute;ncios de Classificados </div>
                    <div class="bestbg">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" height=170>
                            <tr>
                                <td class="bestsellerstxt"><center>
                                Nada encontrado 
                            </center></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php
            }
            ?>
            <div id="shop">
                <div class="shop_bg">Links &Uacute;teis  </div>
                <div class="bestbg">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="3"></td>
                        </tr>
                        <?php
                        /* Fetching speciality sites link */
                        $specialty_sql = "select * from speciliaty order by rand() limit 0,4 ";
                        $specialty_sqlqry = mysql_query($specialty_sql);
                        if (mysql_num_rows($specialty_sqlqry) > 0) {
                            while ($specialty_fetch = mysql_fetch_array($specialty_sqlqry)) {
                                ?>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td width="11%"><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                                    <td width="84%" class="bestsellerstxt"><a href="http://<?php echo $specialty_fetch['link']; ?>" class="linksrollovertxt"><?php echo $specialty_fetch['link_name']; ?></a></td>
                                </tr>
                                <tr>
                                    <td height="3"></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td height="3" class="featxt">Nada encontrado </td>
                            </tr>
                            <?php
                        }
                        ?>

<!--<tr>
<td>&nbsp;</td>
<td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
<td class="bestsellerstxt"><a href="learning" class="linksrollovertxt">Learning Center</a></td>
</tr>
<tr>
<td height="3"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
<td class="bestsellerstxt"><a href="community" class="linksrollovertxt">Community Center</a></td>
</tr>
<tr>
<td height="3"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
<td class="bestsellerstxt"><a href="paypalbuyer" class="linksrollovertxt">Paypal Buyer Protection</a></td>
</tr>
<tr>
<td height="3"></td>
</tr>-->
                    </table>
                </div>
            </div>

            <div id="shop">
                <div class="shop_bg">Estat&iacute;sticas do site </div>
                <?php
                /* Fetching Sitestatistics */

                $totalusers_sql = "select count(*) as totalusercount from user_registration where status='Active' and verified='Yes'"; //Total users
                $totalusers_sqlqry = mysql_query($totalusers_sql);
                $totaluser_fetch = mysql_fetch_array($totalusers_sqlqry);
                $totaluser_count = $totaluser_fetch['totalusercount'];

                $totalsolditems_sql = " SELECT count(distinct (p.item_id) )as solditemscount FROM placing_item_bid p, placing_bid_item b where p.status = 'Closed' and p.Quantity = '0' and b.user_pos = 'Yes' and p.item_id = b.item_id"; // Total Sold Items
                $totalsolditems_sqlqry = mysql_query($totalsolditems_sql);
                $totalsolditems_fetch = mysql_fetch_array($totalsolditems_sqlqry);
                $totalsold_items = $totalsolditems_fetch['solditemscount'];

                $totalitems_sql = "select count(*) as itemscount from placing_item_bid where status='Active' and bid_starting_date<=now() and expire_date>=now()";  // Total Sold Items
                $totalitems_sqlqry = mysql_query($totalitems_sql);
                $totalitems_fetch = mysql_fetch_array($totalitems_sqlqry);
                $total_items = $totalitems_fetch['itemscount'];

// Total Online Users
                $onlineusers_sql = "select count(*) as onlineuserscount from user_registration where status='Active' and Onlinestatus='Online'";
                $onlineusers_sqlqry = mysql_query($onlineusers_sql);
                $onlineusers_fetch = mysql_fetch_array($onlineusers_sqlqry);
                $onlineusers_count = $onlineusers_fetch['onlineuserscount'];

                $sitestarted_sql = "select * from admin_settings where set_id='16'"; // Site started date
                $sitestarted_sqlqry = mysql_query($sitestarted_sql);
                $sitestarted_fetch = mysql_fetch_array($sitestarted_sqlqry);
                $sitestarted = $sitestarted_fetch['set_value'];

                $runningdays_sql = "select to_days(now())- to_days(set_value) as runningdays from admin_settings where set_id='16'"; // Running Days
                $runningdays_sqlqry = mysql_query($runningdays_sql);
                $runningdays_fetch = mysql_fetch_array($runningdays_sqlqry);
                $runningdays = $runningdays_fetch['runningdays'];

                /* End of Fetching Sitestatistics */
                ?>
                <div class="bestbg">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="3"></td>
                        </tr>
                        <tr>
                            <td width="5%">&nbsp;</td>
                            <td width="11%"><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                            <td width="84%"><span class="bestsellerstxt">Total de Usu&aacute;rios:</span> <span class="banner1"><?php echo $totaluser_count; ?></span></td>
                        </tr>
                        <tr>
                            <td height="3"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                            <td><span class="bestsellerstxt">Produtos vendidos:</span> <span class="banner1"><?php echo $totalsold_items ?></span></td>
                        </tr>
                        <tr>
                            <td height="3"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                            <td><span class="bestsellerstxt">Produtos cadastrados:</span> <span class="banner1"><?php echo $total_items ?></span></td>
                        </tr>
                        <tr>
                            <td height="3"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                            <td><span class="bestsellerstxt">Usu&aacute;rios Online: </span><span class="banner1"><?php echo $onlineusers_count ?></span></td>
                        </tr>
                        <tr>
                            <td height="3"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><img src="images/categbullet.gif" alt="" width="8" height="7"/></td>
                            <td><span class="bestsellerstxt">Data do site : </span><span class="banner1"><?php echo $sitestarted ?></span></td>
                        </tr>
                        <tr>
                            <td height="3"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                            <td><span class="bestsellerstxt">Dias no ar: </span><span class="banner1"><?php echo $runningdays ?> Dias</span></td>
                        </tr>
                        <tr>
                            <td height="3"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div id="categories_right"><div id="products">
                <div class="products_bg">Melhores produtos do  <?php echo $sitename_fetch['set_value'] ?></div>
                <div class="bestbg" id="prolist">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <?php
                                        $hotmode = $_REQUEST['hotmode'];
                                        $hotitems_sql = "select * from placing_item_bid where status='Active' and picture1!='' and selling_method!='want_it_now' and selling_method!='ads'";

//$hotitems_sql="select * from placing_item_bid p, featured_items f where p.status='Active' and p.picture1!='' and p.bid_starting_date<=now() and p.expire_date>=now() and p.selling_method!='ads' and p.selling_method!='want_it_now' and f.home_feature='Yes' and p.item_id=f.item_id";


                                        $hotcount = 0;
                                        $hotitems_sqlqry = mysql_query($hotitems_sql);
                                        $hotitems_count = mysql_num_rows($hotitems_sqlqry);
                                        if ($hotitems_count > 0) {
                                            $hotitems_sql.=" order by rand() limit 0,6";
                                            $i = 1;
                                            $hotitems_sqlqry = mysql_query($hotitems_sql);
                                            while ($hotitems_fetch = mysql_fetch_array($hotitems_sqlqry)) {
                                                $checkcount = $checkcount + 1;
                                                $j = 1;
                                                $hotcount = $hotcount + 1;
                                                if (!empty($hotitems_fetch['sub_title']))
                                                    $item_subtitle = $hotitems_fetch['sub_title'];
                                                else
                                                    $item_subtitle = substr($hotitems_fetch['item_title'], 0, 20);
                                                $item_title = substr($hotitems_fetch['item_title'], 0, 40)
                                                ?>
                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td width="10" height="10" background="images/top-esquerda.jpg"><img src="images/top-esquerda.jpg" width="10" height="10" /></td>
                                                            <td background="images/center-top.jpg"><img src="images/center-top.jpg" width="10" height="10" /></td>
                                                            <td width="10" height="10" background="images/top-direito.jpg"><img src="images/top-direito.jpg" width="10" height="10" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="10" background="images/center-esquerda.jpg">&nbsp;</td>
                                                            <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td height="6"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="6%">&nbsp;</td>
                                                                        <td width="94%" class="prodtxt" id="prod<?php echo $i ?><?php echo $j++ ?>"><a href="detail.php?item_id=<?php echo $hotitems_fetch['item_id']; ?>" class="prodtxt">
                                                                                <?php echo $item_subtitle; ?>
                                                                            </a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="6"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                                                                                <tr>
                                                                                    <td width="52%"><table width="0%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                                            <tr>
                                                                                                <td width="10" height="10" background="images/top-esquerda.jpg"><img src="images/top-esquerda.jpg" width="10" height="10" /></td>
                                                                                                <td background="images/center-top.jpg"><img src="images/center-top.jpg" width="10" height="10" /></td>
                                                                                                <td width="10" height="10" background="images/top-direito.jpg"><img src="images/top-direito.jpg" width="10" height="10" /></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td width="10" background="images/center-esquerda.jpg">&nbsp;</td>
                                                                                                <td><div align="center"> <a href="detail.php?item_id=<?php echo $hotitems_fetch['item_id']; ?>" class="prodtxt"><a href="detail.php?item_id=<?php echo $hotitems_fetch['item_id']; ?>" class="prodtxt"> <img src="thumbnail/<?php echo $hotitems_fetch['picture1']; ?>" alt="" width="75" height="75" id="prod<?php echo $i ?><?php echo $j++ ?>" border="0"/> </a> </div></td>
                                                                                                <td width="10" background="images/center-direito.jpg">&nbsp;</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td width="10" height="10" background="images/base-esquerda.jpg"><img src="images/base-esquerda.jpg" width="10" height="10" /></td>
                                                                                                <td background="images/center-base.jpg"><img src="images/center-base.jpg" width="10" height="10" /></td>
                                                                                                <td width="10" height="10" background="images/base-direitra.jpg"><img src="images/base-direitra.jpg" width="10" height="10" /></td>
                                                                                            </tr>
                                                                                        </table></td>
                                                                                    <td width="48%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                            <tr>
                                                                                                <td height="4"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="products1txt" id="prod<?php echo $i ?><?php echo $j++ ?>"><?php echo $item_title; ?>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td height="8"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="products2txt" id="prod<?php echo $i ?><?php echo $j++ ?>"><?php echo $hotitems_fetch['currency']; ?>
                                                                                                    <?php echo $hotitems_fetch['cur_price']; ?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td height="8"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td height="4"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><a href="detail.php?item_id=<?php echo $hotitems_fetch['item_id']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image631', '', 'images/detailso.gif', 1)" id="prod<?php echo $i ?><?php echo $j++ ?>"><img src="images/details.gif" name="Image631" width="70" height="16" border="0" id="Image631" /></a><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image64', '', 'images/bidnow1o.gif', 1)"></a></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td height="4"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image63', '', 'images/detailso.gif', 1)"></a><a href="detail.php?item_id=<?php echo $hotitems_fetch['item_id']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image64', '', 'images/bidnow1o.gif', 1)" id="prod<?php echo $i ?><?php echo $j++ ?>"><img src="images/bidnow1.gif" name="Image64" width="70" height="16" border="0" id="Image64" /></a></td>
                                                                                            </tr>
                                                                                        </table></td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                </table></td>
                                                            <td width="10" background="images/center-direito.jpg">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="10" height="10" background="images/base-esquerda.jpg"><img src="images/base-esquerda.jpg" width="10" height="10" /></td>
                                                            <td background="images/center-base.jpg"><img src="images/center-base.jpg" width="10" height="10" /></td>
                                                            <td width="10" height="10" background="images/base-direitra.jpg"><img src="images/base-direitra.jpg" width="10" height="10" /></td>
                                                        </tr>
                                                    </table></td>
                                                <?php
                                                if ($hotcount == 3) {
                                                    $hotcount = 0;
                                                    echo "</tr><tr>";
                                                }
                                                $i = $i + 1;
                                            }
                                            //echo $checkcount1=$checkcount;
                                            if ($checkcount < 6) {
                                                for ($l = $checkcount + 1; $l <= 6; $l++) {
                                                    $l1 = $l - 1;
                                                    ;
                                                    if (($l1 % 3) == 0) {
                                                        echo "</tr><tr>";
                                                    }
                                                    ?>
                                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td height="6"></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="6%">&nbsp;</td>
                                                                <td width="94%" class="prodtxt" id=""><img src="images/empty.gif" name="Image63" width="70" height="16" border="0" id="Image63" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="6"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr>
                                                                            <td width="52%"><div align="center">
                                                                                    <img src="images/empty.gif" name="Image63" width="70" height="16" border="0" id="Image63" />
                                                                                </div></td>


                                                                            <td width="48%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                    <tr>
                                                                                        <td height="4"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="products1txt" id=""><img src="images/empty.gif" name="Image63" width="70" height="16" border="0" id="Image63" /> </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="8"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="products2txt" id=""><img src="images/empty.gif" name="Image63" width="70" height="16" border="0" id="Image63" /></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="8"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="4"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><img src="images/empty.gif" name="Image63" width="70" height="16" border="0" id="Image63" /></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td height="4"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><img src="images/empty.gif" name="Image63" width="70" height="16" border="0" id="Image63" /></td>
                                                                                    </tr>
                                                                                </table></td>
                                                                        </tr>
                                                                    </table></td>
                                                            </tr>
                                                        </table></td>       
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </tr>

                                    </table></td>
                            </tr>
                            <tr>
                                <td height="24" align="right" style="padding-right:10px" id="hot_next">
                                    <?php
                                    if ($hotitems_count > 6) {
                                        ?>
                                        <a href="hotitems_list.php" class="moretxt"><b>Mais</b></a>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($hotitems_count > 6) {
                                        ?>
                                        <script>
                                            document.getElementById("hot_next").innerHTML = "<a href=javascript:makeRequest('hotitems.php','1') class=moretxt><b>Next</b></a>";
                                        </script>
                                        <?php
                                    }
                                } else {
                                    ?>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" height="300px">
                                        <tr>
                                            <td height="6" class="fea1txt">Nada encontrado </td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table>
                        <?php
                    }
                    ?>
                    </td>
                    </tr>
                    </table>
                </div>
            </div>
            <div id="products">
                <div class="products_bg">Produtos em destaque </div>
                <div class="bestbg">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><div id="frameWrapper" align="center" >
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="180">
                                        <tr>
                                            <td width="38" align="right">	  
                                                <div id="productScrollerLeft" onMouseOver="scroller = setInterval(myScrollLeft, 30);" onMouseOut="clearInterval(scroller);">
                                                    <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image66', '', 'images/leftscrollero.gif', 1)">
                                                        <img src="images/leftscroller.gif" name="Image66" width="22" height="207" border="0" id="Image66" /></a></div>	</td>
                                            <td valign="top" align="center"><iframe src="featureslist.php" name="scrollerFrame" id="scrollerFrame" frameborder="0" scrolling="no" allowtransparency="false" width="98%" height="207"></iframe></td>
                                            <td width="38">
                                                <div id="productScrollerRight" onMouseOver="scroller = setInterval(myScrollRight, 30);" onMouseOut="clearInterval(scroller);">
                                                    <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image67', '', 'images/rightscrollero.gif', 1)"><img src="images/rightscroller.gif" name="Image67" width="22" height="207" border="0" id="Image67" /></a>	 	</div>
                                                <script>
                                                    myScrollRight();
                                                </script>	</td>
                                        </tr>
                                    </table>
                                </div></td>
                        </tr>
                        <tr>
                            <td height="6"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="deal"><div id="deal_left">

                    <?php
                    $endsoonitems_sql = "select * from placing_item_bid where status='Active' and picture1!='' and selling_method!='want_it_now' and selling_method!='ads' order by rand() limit 0,1";

//$endsoonitems_sql="select * from placing_item_bid where status='Active' and bid_starting_date<=now() and expire_date>=now() and selling_method!='ads' and selling_method!='want_it_now' and selling_method!='fix' and picture1!='' and (to_days(expire_date)-to_days(now()))<=2 order by rand() limit 0,1";

                    $endsoonitems_sqlqry = mysql_query($endsoonitems_sql);
                    $endsoonitems_rows = mysql_num_rows($endsoonitems_sqlqry);
                    if ($endsoonitems_rows > 0) {
                        $endsoonitems_fetch = mysql_fetch_array($endsoonitems_sqlqry);
                        ?>

                        <div id="bid">

                            <div class="bid_bg">Produto a ser terminado </div>
                            <div class="bestbg">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                        <td width="52%" rowspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td height="4"></td>
                                                </tr>
                                                <tr>
                                                    <td height="4"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="spotlight1txt"><a href="detail.php?item_id=<?php echo $endsoonitems_fetch['item_id'] ?>" class="spotlight1txt"><?php echo $endsoonitems_fetch['item_title']; ?></a></td>
                                                </tr>
                                                <tr>
                                                    <td height="6"></td>
                                                </tr>
                                                <tr>
                                                    <td height="4"></td>
                                                </tr>
                                                <tr>
                                                    <td class="bestsellerstxt">Pre&ccedil;o Inicial </td>
                                                    <td class="bestsellerstxt">:</td>
                                                    <?php
                                                    if ($endsoonitems_fetch['selling_method'] == 'fix') {
                                                        ?>
                                                        <td class="bestsellerstxt"><?php echo $endsoonitems_fetch['currency'] ?><?php echo $endsoonitems_fetch['quick_buy_price'] ?></td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td class="bestsellerstxt"><?php echo $endsoonitems_fetch['currency'] ?><?php echo $endsoonitems_fetch['min_bid_amount'] ?></td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <td height="3"></td>
                                                </tr>
                                                <tr>
                                                    <td height="4"></td>
                                                </tr>
                                                <tr>
                                                    <td class="bestsellerstxt">Pre&ccedil;o Atual </td>
                                                    <td class="bestsellerstxt">:</td>
                                                    <td class="bestsellerstxt"><?php echo $endsoonitems_fetch['currency'] ?><?php echo $endsoonitems_fetch['cur_price'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td height="3"></td>
                                                </tr>
                                                <tr>
                                                    <td height="4"></td>
                                                </tr>
                                                <tr>
                                                    <td class="bestsellerstxt">Valor do Frete </td>
                                                    <td class="bestsellerstxt">:</td>
                                                    <td class="bestsellerstxt"><?php
                                                        if ($endsoonitems_fetch['shipping_cost'] == '0.00') {
                                                            echo "-";
                                                        } else {
                                                            ?><?php echo $endsoonitems_fetch['currency'] ?><?php echo $endsoonitems_fetch['shipping_cost'] ?><?php } ?></td>
                                                </tr>
                                                <tr>
                                                    <td height="4"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><div align="center"><img src="images/deal_line.gif" alt="" width="225" height="1" /></div></td>
                                                </tr>
                                                <tr>
                                                    <td height="5"></td>
                                                </tr>
                                                <tr>
                                                    <td class="dealtxt">&nbsp; </td>
                                                    <td class="dealtxt">&nbsp;</td>
                                                    <td class="dealtxt">&nbsp; </td>
                                                </tr>
                                                <tr>
                                                    <td height="4"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="center" class="detail8txt">
                                                        <?php
                                                        $username_sql = "select * from user_registration where user_id=" . $endsoonitems_fetch['user_id'];
                                                        $username_res = mysql_query($username_sql);
                                                        $username_fetch = mysql_fetch_array($username_res);
                                                        $username_endsoonuser = $username_fetch['user_name'];

                                                        $feed_sql = "select count(*) as feedbacktotal from feedback where  feedback_to=" . $endsoonitems_fetch['user_id'];
                                                        $feed_recordset = mysql_query($feed_sql);
                                                        $feed_tot = mysql_fetch_array($feed_recordset);

                                                        $feedbackicon_sql = "select * from membership_level where feedback_score_from <= " . $feed_tot['feedbacktotal'] . " and  feedback_score_to >= " . $feed_tot['feedbacktotal'];
                                                        $feedbackicon_res = mysql_query($feedbackicon_sql);
                                                        $feedbackicon_row = mysql_fetch_array($feedbackicon_res);
                                                        $feedback_img = $feedbackicon_row['icon'];
                                                        ?>
                                                        <a href="feedback.php?user_id=<?php echo $endsoonitems_fetch['user_id']; ?>" class="detail8txt"><?php echo $username_endsoonuser; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>( <a href="feedback.php?user_id=<?php echo $row['user_id']; ?>" class="detail8txt">
                                                            <?php echo $feed_tot['feedbacktotal']; ?></a><?php if ($feedback_img != '') { ?><img src="images/<?php echo $feedback_img ?>" /><?php } ?> )			  </td>
                                                </tr>
                                                <tr>
                                                    <td height="4"></td>
                                                </tr>
                                                <tr>
                                                    <td height="4"></td>
                                                </tr>
                                                <tr>
                                                    <td height="5"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="center"><a href="detail.php?item_id=<?php echo $endsoonitems_fetch['item_id']; ?>">
                                                            <img src="images/bidnow.gif" name="Image65" width="62" height="22" border="0" id="Image65" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image65', '', 'images/bidnowo.gif', 1)"/></a></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">&nbsp;</td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><div align="center"><a href="detail.php?item_id=<?php echo $endsoonitems_fetch['item_id'] ?>"></a>
                                                <table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="10" height="10" background="images/top-esquerda.jpg"><img src="images/top-esquerda.jpg" width="10" height="10" /></td>
                                                        <td background="images/center-top.jpg"><img src="images/center-top.jpg" width="10" height="10" /></td>
                                                        <td width="10" height="10" background="images/top-direito.jpg"><img src="images/top-direito.jpg" width="10" height="10" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="10" background="images/center-esquerda.jpg">&nbsp;</td>
                                                        <td><a href="detail.php?item_id=<?php echo $endsoonitems_fetch['item_id'] ?>"><img src="thumbnail/<?php echo $endsoonitems_fetch['picture1'] ?>" alt="" width="150" height="150" border="0"/></a></td>
                                                        <td width="10" background="images/center-direito.jpg">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="10" height="10" background="images/base-esquerda.jpg"><img src="images/base-esquerda.jpg" width="10" height="10" /></td>
                                                        <td background="images/center-base.jpg"><img src="images/center-base.jpg" width="10" height="10" /></td>
                                                        <td width="10" height="10" background="images/base-direitra.jpg"><img src="images/base-direitra.jpg" width="10" height="10" /></td>
                                                    </tr>
                                                </table>
                                            </div></td>
                                    </tr>
                                    <?php
                                    $expire_date = $endsoonitems_fetch['expire_date'];
                                    require 'ends.php';
                                    ?>
                                    <tr>
                                        <td width="3%">&nbsp;</td>
                                        <td width="45%" align="center"><span class="header_text3">Este produto termina exatamente em  </span><span class="bestsellerstxt"><?php echo $string_difference; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align="center" class="header_text3">Confira r&aacute;pido antes de se esgotar! </td>
                                    </tr>
                                    <tr>
                                        <td height="6"></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <?php
                    } else {
                        ?>
                        <div id="bid">
                            <div class="bid_bg">Produto Terminado </div>
                            <div class="bestbg">

                                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                    <tr>
                                        <td height="250px" width="500px" class="fea1txt">Nada encontrado </td>
                                    </tr>
                                </table>

                            </div></div>

                        <?php
                    }
                    ?>
                </div>

                <div id="deal_right">
                    <table width="278" height="261" border="0" align="right" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><table width="278" height="261" border="0" align="right" cellpadding="0" cellspacing="0">
                                    <?php
                                    $sql_banner2 = "select * from frontpage_banner order by rand() limit 0,1";
                                    $sqlqry_banner2 = mysql_query($sql_banner2);
                                    $sqlnum_banner2 = mysql_num_rows($sqlqry_banner2);
                                    if ($sqlnum_banner2 > 0) {
                                        $sqlfetch_banner2 = mysql_fetch_array($sqlqry_banner2);
                                        ?>
                                        <tr>
                                            <td><a href="<?php echo $sqlfetch_banner2['url']; ?>"><img src="<?php echo $sqlfetch_banner2['banner']; ?>" height="259" width="278" border="0"/></a></td>
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <td><a href="<?php echo $sqlfetch_banner2['url']; ?>"><img src="images/b2eebgreenban.gif" height="259" width="278" border="0"/></a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table></td>
                        </tr>
                    </table>
                </div>

            </div>


            <div id="googlebanner"><table width="728" height="90" border="0" cellpadding="0" cellspacing="0">
                    <?php
                    $sql_footerbanner = "select * from banners order by rand() limit 0,1";
                    $sqlqry_footerbanner = mysql_query($sql_footerbanner);
                    $sqlnum_footerbanner = mysql_num_rows($sqlqry_footerbanner);
                    if ($sqlnum_footerbanner > 0) {
                        $sqlfetch_footerbanner = mysql_fetch_array($sqlqry_footerbanner);
                        $banner_path = $sqlfetch_footerbanner['banner_path'];
                        $site_url = $sqlfetch_footerbanner['site_url'];
                        ?>
                        <tr>
                            <td>
                                <a href="<?php echo $site_url ?>">
                                    <img src="<?php echo $banner_path ?>" alt="" width="728" height="90" border="0"/>
                                </a>
                            </td>
                        </tr>
                        <?php
                    } else {
                        ?> 
                        <tr>
                            <td><img src="images/ban.gif" alt="" width="728" height="90" border="0"/></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" language="javascript">
    var firstFade = new Spry.Effect.Fade('prolist', {duration: 1000, from: 0, to: 100});
    var firstFade1 = new Spry.Effect.Fade('prolist', {duration: 500, from: 50, to: 0});
</script>



<?php
require 'include/footer.php';
?>
