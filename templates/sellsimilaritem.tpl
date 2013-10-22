<table cellpadding="0" cellspacing="0" width="958" align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;Sell Similar Item:</div></font> </td></tr>
    <tr><td valign="top">
            <table border="0" align="center" cellpadding="5" cellspacing="5"  background="images/contentgrad.jpg" width="958" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                <tr><td class="banner1">
                        If you'd like to change your item listing format, click Selling Format.
                    </td></tr>
                <tr><td height="20"><font class="categories_fonttype"><b>Main Category</b></font></td></tr>
                <?php
                $catid1=$catidsub;
                $sqlsub="select * from category_master where category_id=$catidsub";
                $sqlqrysub=mysql_query($sqlsub);
                $sqlfetchsub=mysql_fetch_array($sqlqrysub); 
                $catid=$sqlfetchsub['category_head_id'];
                while($catid!=0)
                {
                $catid1=$catid;
                $_SESSION[categoryid]=$catid1;
                $sql="select * from category_master where category_id=$catid";
                $sqlqry=mysql_query($sql);
                $sqlfetch=mysql_fetch_array($sqlqry);
                $catid=$sqlfetch['category_head_id'];
                }
                $sql="select * from category_master where category_id=$catid1";
                $sqlqry=mysql_query($sql);
                $sqlfetch=mysql_fetch_array($sqlqry);
                ?>
                <tr><td class="categories_fonttype">
                        <b><?php echo $sqlfetch['category_name'];?>:<?php echo $sqlfetchsub['category_name'];?></b>
                        <form method="post" action="sell_item_detail.php" name="sellsimilar">
                            <!--<input type="button" value="<<Sell Format" name=sellformat onclick="refreshsell()"/>-->

                            <input type="image" src="images/sellformat.gif" name="Image96" width="112" height="19" border="0" id="Image96" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image96', '', 'images/sellformat1.gif', 1)" onclick="refreshsell()"/>

                            <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)" onclick="refreshsellsimilar( < ?php = $sellitemid? > )"/>
                            <!--<input type="button" value="continue>>" name=continue onclick="refreshsellsimilar(<?php echo $sellitemid?>)"/>-->
                            <input type=hidden name=sellitemid />
                            <input type=hidden name=mode />
                            <input type=hidden name=check />
                        </form>
                    </td></tr>
            </table>
        </td></tr>
</table>
<script>
    function refreshsell()
    {
        document.sellsimilar.action = "sell.php";
        document.sellsimilar.submit();
    }
    function refreshsellsimilar(id)
    {
        document.sellsimilar.sellitemid.value = id;
        document.sellsimilar.mode.value = "sellsimilar";
//document.sellsimilar.check.value=1;
        document.sellsimilar.action = "sell_item_detail.php";
        document.sellsimilar.submit();
    }
</script>

