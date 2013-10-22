<?php require 'include/connect.php'; ?>
<link href="style/newstyle.css" rel="stylesheet" type="text/css"/>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
        <?php
        /* Select Featured Product From the Item tahle */

        //$sql_featurelist="select * from placing_item_bid p, featured_items f where p.status='Active' and p.picture1!='' and p.bid_starting_date<=now() and p.expire_date>=now() and p.selling_method!='ads' and p.selling_method!='want_it_now' and p.item_id=f.item_id and f.home_feature='yes'";
        $sql_featurelist = "select * from placing_item_bid where status='Active' and selling_method!='ads' and selling_method!='want_it_now'";
        $res_featurelist = mysql_query($sql_featurelist);
        $numrow_featurelist = mysql_num_rows($res_featurelist);
        if ($numrow_featurelist > 0) {
            while ($fetch_featureslist = mysql_fetch_array($res_featurelist)) {
                ?>
                <td width="100%" valign="top" class="centrepad2"><table width="167"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="hotborder">
                        <tr>
                            <td align="center" valign="top">
                                <div style="display:block;">
                                    <table width="154" height="200" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc">
                                        <tr>
                                            <td><div align="center">
                                                    <table width="100%" height="120" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td><table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td width="10" height="10" background="images/top-esquerda.jpg"><img src="images/top-esquerda.jpg" width="10" height="10" /></td>
                                                                        <td background="images/center-top.jpg"><img src="images/center-top.jpg" width="10" height="10" /></td>
                                                                        <td width="10" height="10" background="images/top-direito.jpg"><img src="images/top-direito.jpg" width="10" height="10" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="10" background="images/center-esquerda.jpg">&nbsp;</td>
                                                                        <td><div align="center"> <a href="detail.php?item_id=<?php echo $fetch_featureslist['item_id'] ?>" target="_top"> <img src="thumbnail/<?php echo $fetch_featureslist['picture1'] ?>" alt="" width="75" height="75" border="0"/> </a></div></td>
                                                                        <td width="10" background="images/center-direito.jpg">&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="10" height="10" background="images/base-esquerda.jpg"><img src="images/base-esquerda.jpg" width="10" height="10" /></td>
                                                                        <td background="images/center-base.jpg"><img src="images/center-base.jpg" width="10" height="10" /></td>
                                                                        <td width="10" height="10" background="images/base-direitra.jpg"><img src="images/base-direitra.jpg" width="10" height="10" /></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                    </table>
                                                </div></td>
                                        </tr>
                                        <?php
                                        if (!empty($fetch_featureslist['sub_title']))
                                            $subtitle_fea = $fetch_featureslist['sub_title'];
                                        else
                                            $subtitle_fea = $fetch_featureslist['item_title'];
                                        if (strlen($subtitle_fea) > 20)
                                            $subtitle_fea = substr($subtitle_fea, 0, 20);
                                        $itemtitle_fea = $fetch_featureslist['item_title'];
                                        if (strlen($fetch_featureslist['item_title']) > 35)
                                            $itemtitle_fea = substr($fetch_featureslist['item_title'], 0, 35);
                                        ?>
                                        <tr>
                                            <td class="featxt"><div align="center">
                                                    <a href="detail.php?item_id=<?php echo $fetch_featureslist['item_id'] ?>" class="fea1txt" target="_top"><?php echo $subtitle_fea; ?></a></div></td>
                                        </tr>
                                        <tr>
                                            <td class="fea1txt"><center>
                                            <a href="detail.php?item_id=<?php echo $fetch_featureslist['item_id'] ?>" class="fea1txt" target="_top"><?php echo $itemtitle_fea ?></a></center></td>
                                        </tr>
                                        <tr>
                                            <td class="products2txt">
                                                <div align="center"><?php echo $fetch_featureslist['currency'] ?><?php echo $fetch_featureslist['cur_price'] ?></div></td>
                                        </tr>
                                    </table>
                                </div></td>
                            <td></td>
                        </tr>
                    </table></td>
                <?php
                ob_flush();
            }
        }
        else {
            ?>
            <td width="100%" valign="top">
                <table align="center" height=400>
                    <tr><td height="20px">&nbsp;</td></tr>
                    <tr><td height="20px">&nbsp;</td></tr>
                    <tr><td height="20px">&nbsp;</td></tr>
                    <tr><td valign="top" class="fea1txt">
                            <?php
                            echo "No Feature Items Found";
                            ?>
                        </td></tr>
                    <tr><td height="20px">&nbsp;</td></tr>
                </table>
            </td>
            <?php
        }
        ?>
     

