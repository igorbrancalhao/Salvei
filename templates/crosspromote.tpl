<?php
/***************************************************************************
*File Name				:crosspromote.tpl
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
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;Cross-promoted Items</div></font></td>
    </tr>
    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 
                <tr><td valign="top" >
                        <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
                            <!--<tr height=35>
                            
                            <td  colspan=2><font class="detail9txt"><b>Cross-promoted Items </b></font></td></tr>-->
                            <tr><td width="100%"><table bgcolor="#DDDDDD" width="100%" align="center"  height="50">
                                        <tr><td valign="top"><font size="2"><b>Item to be Crosspromoted	:</b></font></td></tr>
                                        <?
                                        if($flag==1)
                                        {
                                        ?>
                                        <tr><td>
                                                <table bgcolor="#FFFFFF" width="100%" cellpadding="0" cellspacing="0" border="0" align="center"> 
                                                    <tr><td><br /></td></tr>
                                                    <tr><td align="center" class="detail9txt"><strong>Item has been crosspromoted</strong></td></tr>
                                                    <tr><td><br /></td></tr>
                                                </table>
                                            </td></tr>
                                    </table></td></tr>
                        </table></td></tr>
            </table></td></tr>
</table>
<?
require 'include/footer.php';
exit();
}
else
{
?>
<tr><td>
        <table bgcolor="#FFFFFF" width="100%" cellpadding="0" cellspacing="0">
            <tr><td valign="top" width="14%" class="detail9txt">
                    <? if(empty($img)){
                    ?>
                    <img src="images/no-image.gif" height=50 width="50">
                    <?
                    }
                    else
                    {
                    if(file_exists("thumbnail/".$img))
                    {

                    list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                    $h=$height;
                    $w=$width;
                    if($h>100)	
                    {
                    $nh=150;
                    $nw=($w/$h)*$nh;
                    $h=$nh;
                    $w=$nw;
                    }
                    if($w>75)
                    {
                    $nw=100;
                    $nh=($h/$w)*$nw;
                    $h=$nh;
                    $w=$nw;
                    }  
                    $img="thumbnail/".$img;
                    }
                    else
                    {
                    $img="images/no-image.gif";
                    $h=50;
                    $w=50;
                    }
                    ?>
                    <img src="<?=$img?>" height="<?=$h?>" width="<?=$w?>">
                    <? 
                    }
                    ?></td>
                <td width="86%" align="left" class="detail9txt">
                    &nbsp;&nbsp;&nbsp;<strong>itemid:<?=$item_id?></strong><br />
                    &nbsp;&nbsp;&nbsp;<a href=detail.php?item_id=<?=$item_id?> class="header_text"><?=$itemtitle?></a><br />
                    &nbsp;&nbsp;&nbsp;<strong><?=$row['currency']?><?=$price?></strong>

                </td></tr></table></td></tr></table></td></tr>
<tr><td width="100%"><br><font color="#999999" size=2>When someone views the items which are used for promotion, your above item will be in a special display. You can manually select the items to crosspromote.</font></td></tr><tr><td><br></td></tr>
<tr height=40>
    <td  colspan=2><font size="3" class="detail9txt"><b>My Items </b></font></td></tr>
<form name="crosspromote" action="crosspromote.php" >
    <tr><td><table width=100% bgcolor="#DDDDDD" align="center" cellpadding="0" cellspacing="0">
                <tr bgcolor="#B8DEEE" height="30" class="detail9txt"><td width="10%"><input type="checkbox" name="chkMain" onClick="chkall()" class="check" value=1></td><td width="10%"></td><td width="20%" ><strong>Item#</strong></td><td width="20%"><strong>Itemtitle</strong></td><td width="20%"><strong>Price</strong></td><td width="20%"><strong>End date</strong></td></tr></table></td></tr>
    <tr><td><table bgcolor="#CCCCCC" width=100% align="center">
                <? $userid=$_SESSION[userid];
                $sqlitems="select * from placing_item_bid where user_id=$userid and status='Active' and selling_method!='want_it_now' and selling_method!='ads' and item_id!=$item_id";
                $sqlqryitems=mysql_query($sqlitems);
                $sqlnumrows=mysql_num_rows($sqlqryitems);
                if($sqlnumrows>0)
                {
                while($sqlfetchitems=mysql_fetch_array($sqlqryitems))
                {
                $expdate=explode(" ",$sqlfetchitems['expire_date']);
                if(!empty($sqlfetchitems['picture1']))
                {
                if(file_exists("thumbnail/".$sqlfetchitems['picture1']))
                $pic="thumbnail/".$sqlfetchitems['picture1'];
                else
                $pic="images/no-image.gif";
                }
                else
                $pic="images/no-mage.gif";
                ?>
                <tr height="20" bgcolor="#B8DEEE">
                    <td width="10%"><input name="chkSub[]" id="chkSub" type="checkbox" class="check" value="<?= $sqlfetchitems['item_id']?>"></td>
                    <td width="10%"><img src='<?=$pic?>' height=50 width="50"></td>
                    <td width="20%" class="detail9txt"><strong><?=$sqlfetchitems['item_id'];?></strong></td>
                    <td width="20%"><a href=detail.php?item_id=<?=$sqlfetchitems['item_id']?> class="header_text"><?=$sqlfetchitems['item_title']?></a></td>
                    <td width="20%" class="detail9txt"><strong><?=$sqlfetchitems['currency']?><?=$sqlfetchitems['cur_price']?></strong></td>
                    <td width="20%" class="detail9txt"><strong><?=$expdate[0]?></strong></td></tr>
                <?
                }

                ?>
                <br></table></td></tr>
    <tr height="40"><td align="center" colspan="6" width="100%">

            <input type="image" src="images/crosspromote.gif" name="Image91" width="126" height="22" border="0" id="Image91" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image91', '', 'images/crosspromoteo.gif', 1)" value=CrossPromote onclick="return chk();"/>

        </td></tr>
    <input type="hidden" name=flag value="1">
    <input type="hidden" name=item_id value="<?=$item_id?>">
</form>
<?
}
else
{
?>
<tr height="40"><td align="center" colspan="6" width="100%">No Items Found To Promote</td></tr>
<?
}
?>

</table></td></tr>
</table></td></tr>
</table>
</td></tr>
</table></td></tr>

</table>

<?
}
?>
<script>
    function chkall() {
        len = document.crosspromote.chkSub.length;
        if (len > 1) {
            for (i = 0; i < len; i++) {
                if (document.crosspromote.chkMain.checked == true) {
                    document.crosspromote.chkSub[i].checked = true;
                }
                else {
                    document.crosspromote.chkSub[i].checked = false;
                }
            }
        }
        else {
            if (document.crosspromote.chkMain.checked == true) {
                document.crosspromote.chkSub.checked = true;
            }
            else {
                document.crosspromote.chkSub.checked = false;
            }

        }
    }

    function chk()
    {
        var k = 0;
        var len = document.crosspromote.chkSub.length;
        for (i = 0; i < len; i++) {
            //alert(i);
            if (document.crosspromote.chkSub[i].checked == true)
            {
                k = k + 1;
            }
        }
        //alert("k:"+k);
        if (k == 0)
        {
            alert("Select Item to Promote");
            return false;
        }
        else
        {
            return true;
        }

    }

</script>
