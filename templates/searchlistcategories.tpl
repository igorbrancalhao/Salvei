<?php
function easy_cat_display124($ssid1,$cat1)
{
$cat1="category_id=$ssid1 or ";
$ss_sql1="select * from category_master where category_head_id=$ssid1";
$sub_res1=mysql_query($ss_sql1);
while($cat_row1=mysql_fetch_array($sub_res1))
{
if($cat_row1['category_id'])
{
$cat1.="category_id=".$cat_row1['category_id']." or ";
$ssid1=$cat_row1['category_id'];
$_SESSION[catt1]=$_SESSION[catt1]."$cat1";
easy_cat_display124($ssid1,$cat1);
}
}
//echo $cat;
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="8"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="dealtxt">Browse with Categories</td>
                </tr>
            </table></td>
    </tr>
    <?php
    $sqlcatlist="select * from category_master where category_head_id=0 and custom_cat='0' order by rand() limit 0,10"; 
    /*$sqlcatlist="select * from category_master where category_id=15";*/
    $recordsetcatlist=mysql_query($sqlcatlist);
    while($recordcatlist=mysql_fetch_array($recordsetcatlist))
    {
    $sqlcatcount="select * from placing_item_bid where  bid_starting_date <= now() and status='Active' and selling_method!='ads' and selling_method!='want_it_now' and (";
    if($recordcatlist['category_id'])
    {
    $cat_sql1="select * from category_master where category_id=".$recordcatlist['category_id']; 
    $cat_sql1_res=mysql_query($cat_sql1);
    $tot_rec=mysql_num_rows($cat_sql1_res);
    $cat="category_id=".$recordcatlist['category_id']." or ";
    if($tot_rec>0)
    {
    $cat_row=mysql_fetch_array($cat_sql1_res);
    $ssid1=$cat_row['category_id'];
    if($ssid1)
    {
    easy_cat_display124($ssid1,$cat1);
    }
    $cat1=$_SESSION['catt1'];
    $cat1=$cat1.$cat;
    $cat1=trim($cat1," or ");
    }
    $sqlcatcount.=$cat1; 
    }

    $sqlcatcount=rtrim($sqlcatcount," and ");
    $sqlcatcount.=") and expire_date >= now()";
    $sqlqrycatcount=mysql_query($sqlcatcount);
    $sqlnumcatcount=mysql_num_rows($sqlqrycatcount);
    $displaycategoryname=substr($recordcatlist['category_name'],0,20);
    ?>
    <tr>
        <td height="2"></td>
    </tr>
    <tr>
        <td width="7%">&nbsp;</td>
        <td width="10%"><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
        <td width="83%" class="searchresult2txt"><a href="search.php?mode=linkmode&category_id=<?php echo $recordcatlist['category_id'];?>" class="searchresult2txt"><?php echo $displaycategoryname;?>... (<?php echo $sqlnumcatcount;?>)</a></td>
    </tr>
    <?php
    $_SESSION['catt1']="";
    }
    ?>
</table>