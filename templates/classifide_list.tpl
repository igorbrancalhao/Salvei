<?php php
/***************************************************************************
*File Name				:classfied_list.tpl
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
<table width="980" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td valign="top">
            <table border="0" align="center" cellpadding="0" cellspacing="0" width="958">
                <tr width=100>
                    <td colspan=2 background="images/contentbg1.jpg" height="25">
                        <font class="detail3txt"><div align="left">
                            &nbsp;&nbsp;Browse Ad</div></font>
                    </td></tr>
                <tr><td valign="top">
                        <table border="0" align="center" cellpadding="5" cellspacing="0"  background="images/contentgrad.jpg" width="958" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                            <?php  
                            $recordset=mysql_query($query);
                            $total_records=mysql_num_rows($recordset);
                            $limitsize=10;
                            if($total_records>0)
                            { 
                            //get the total records
                            if(strlen($currec)==0) //check firstpage 
                            $currec = 1;  
                            $start = ($currec - 1) * $limitsize;
                            $end = $limitsize;
                            $query .=" limit $start,$end";
                            }
                            $limitsize=10;
                            if($total_records==0)
                            {
                            ?>
                            <tr><td align="center" colspan="5">
                                    <br>
                                    <br>
                                    <br>
                                    <font class="moretxt">
                                    <?php 
                                    $select_sql="select * from error_message where err_id =48";
                                    $select_tab=mysql_query($select_sql);
                                    $select_row=mysql_fetch_array($select_tab);
                                    echo $select_row['err_msg'];
                                    ?> </font>
                                    <br>
                                    <br>
                                    <br></td></tr>
                        </table>
                    </td></tr>
            </table>
        </td></tr>
</table>
<?php  require 'include/footer.php'; 
exit();
} 
?>
<tr bgcolor="#DDDDDD" class="detail9txt">
    <td>&nbsp;</td>
    <td><font size=2 ><b>Image</b></font></td>
    <td colspan="2"><font size=2 ><b>Ad Title</b></font></td>
    <td><!--<font size=2 ><b>Current Price</b></font>-->&nbsp;</td>

    <td><font size=2 ><b>Ends</b></font></td></tr>
<?php 
if($total_records > 0)
{
?>
<tr align="left" class="moretxt">
    <?php  
    $net=($currec-1*$limitsize+$end)-$total_records;
    $dis=$limitsize+$start;
    if($net <= 0) $net=$end;
    if($dis<=$total_records)
    {
    ?>
    <td colspan=4 align="right">
        <font size="2">Showing  <?php  echo $start+1; ?>
        <?php  echo " - ". $dis; ?> of <?php  echo $total_records; ?> Items </font></td>
    <?php  
    }
    else 
    {
    ?>
<tr align="left"  class="moretxt"><td colspan=4 align="right">
        <font size="2">Showing  <?php  echo $start+1;?>  of <?php  echo $total_records; ?> Item </font></td>
    <?php 
    }
    if($currec!=1)
    {
    ?>
    <td>
        <a href="classifide_list.php?currec=<?php echo($currec - 1);?>" >
            <font size="2" class="moretxt">Previous </font></a></td>
    <?php 
    } 
    $net=$total_records-($currec*$limitsize+$end) + $end;
    if($net >$limitsize) $net=$limitsize;
    if($net <= 0) $net=$end;
    if($total_records > ($start + $end)) 
    {
    ?>  
    <td><a href="classifide_list.php?currec=<?php echo($currec + 1);?>" >
            <font size=2 class="moretxt"> Next </font> </a></td>
    <?php 
    }
    ?>
</tr>
<?php 
} 
?>
<?php 
$c=1;
$recordset=mysql_query($query);
while($record=mysql_fetch_array($recordset))
{
$bid_sql="select * from placing_bid_item where item_id=$record[item_id]";
$bid_res=mysql_query($bid_sql);
$bid=mysql_fetch_array($bid_res);
$tot_bid=mysql_num_rows($bid_res);
$fea_sql="select * from featured_items where item_id=".$record['item_id'];
$fea_res=mysql_query($fea_sql);
$fea=mysql_fetch_array($fea_res);

if(($fea['border']=="Yes") && ($fea['highlight']=="Yes"))
$both="Yes";
else if ($fea['border']=="Yes")
$both="border";
else if ($fea['highlight']=="Yes")
$both="highlight";

if($tot_bid!=0)
{
$current_price=$bid['bidding_amount'];
$no_bids=$tot_bid;
}
else
{
$current_price=$record['min_bid_amount'];
$no_bids="No Bid";
}
$expire_date =$record['expire_date']; 
require 'ends.php';
if($c==1)
{
$c=0;
if($both=="Yes")
{
?>
<tr class="both">  
    <?php 
    }
    else if($both=="border")
    {
    echo "border";
    $c=0;
    ?>
<tr class="border_tr">  
    <?php 
    }
    else if($both=="highlight")
    {
    $c=0;
    ?>
<tr class="highlight">  
    <?php 
    }
    else
    {
    $c=0;
    ?>
<tr class="tr_color_1">  
    <?php 
    }
    }
    else 
    {
    if($both=="Yes")
    {
    ?>
<tr class="both">  
    <?php 
    }
    else if($both=="border")
    {
    $c=0;
    ?>
<tr class="border_tr">  
    <?php 
    }
    else if($both=="highlight")
    {
    $c=0;
    ?>
<tr class="highlight">  
    <?php 
    }
    else
    {
    ?>
<tr class="tr_color_2">
    <?php  
    $c=1;
    }
    } ?>
    <td width=30 align=center>
        <a href="classifide_ad.php?item_id=<?php echo $record['item_id'];?>&qty=1">
            <img src="images/hands(11).gif" border="0" alt="Click here "></a>
    </td>
    <td>
        <?php  
        if(!empty($record[picture1]))
        {

        $img=$record['picture1'];
        list($width, $height, $type, $attr) = getimagesize("images/$img");
        $h=$height;
        $w=$width;
        if($h>80)	
        {
        $nh=80;
        $nw=($w/$h)*$nh;
        $h=$nh;
        $w=$nw;
        }
        if($w>80)
        {
        $nw=80;
        $nh=($h/$w)*$nw;
        $h=$nh;
        $w=$nw;
        }
        ?>
        <a href="classifide_ad.php?item_id=<?php  echo $record['item_id']; ?>">
            <img src="images/<?php  echo $record['picture1']; ?>" border=0  width=<?php echo $w; ?> height=<?php echo$h?>></a> 
        <?php 
        }
        else
        {
        ?>
        <a href="classifide_ad.php?item_id=<?php  echo $record['item_id']; ?>">
            <img src="images/no-image.gif" border=0  width=<?php echo $w; ?> height=<?php echo$h?> ></a> 
        <?php  
        }
        ?> 		 
    </td>
    <td colspan="2" class="detail9txt">
        <a href="classifide_ad.php?item_id=<?php  echo $record['item_id']; ?>" class="header_text"><?php echo$record['item_title']; ?></a></td>
    <td class="detail9txt"><br />
        <?php  
        if($fea['subtitle_feature']=="Yes") 
        {
        echo $record['sub_title'];
        }
        ?></td>
    <td class="detail9txt"><?php echo $string_difference; ?></td></tr>
<?php 
} //while($record=mysql_fetch_array($recordset))
?>
</table>
</td></tr>
</table>
</td></tr>
</table>

