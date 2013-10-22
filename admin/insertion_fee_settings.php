<?php
/* * *************************************************************************
 * File Name				:insertion_fee_settings.php
 * File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
 * ************************************************************************* */


/* * **************************************************************************

 *      Licence Agreement: 

 *     This program is a Commercial licensed software; 
 *     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
 *     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
 *     either user and developer versions of the License, or (at your option) 
 *     any later version is applicable for the same.

 * *************************************************************************** */
session_start();
error_reporting(0);
require 'include/connect.php';
require 'include/top.php';
?>
<link href="style.css" rel="stylesheet" type="text/css">

<?php
if (isset($_REQUEST['bid_delete'])) {
    $total = $_REQUEST[total_records];

    for ($i = 1; $i <= $total; $i++) {
        $records_id = "records_id" . $i;
        $records_id = $_REQUEST[$records_id];
        $bid_d = "bid_del" . $i;
        $bid_del = $_REQUEST[$bid_d];

        $sq = mysql_query("select * from insertion_fee_master where ins_id='$records_id'");
        $sq1 = mysql_fetch_array($sq);
        $f = $sq1['amt_from'];
        $t = $sq1['amt_to'];
        $fee = $sq1['insertionfee'];

        if ($bid_del == "0") {
            $del = "delete from insertion_fee_master where ins_id = '$records_id'";
            $delsql = mysql_query($del);
//	if($delsql) echo $records_id." ".$bid_del;
            $cat = $cat . "Amount From :" . $f . " ,Amount To :" . $t . " , Insertion Fee :" . $fee . "<br>";
            $message = "Insertion Fee Deleted Successfully";
        }
    }
    if ($bid_del != "0") {
        $err_flag = 3;
    }
} elseif (isset($_REQUEST['bid_add'])) {
    $amt_from = $_REQUEST['bids_from'];
    $amt_to = $_REQUEST['bids_to'];
    $insertionfee = $_REQUEST['bids_inc'];
    $f = 0;
    //Checking
    $s = mysql_query("select max(amt_to) as amt_to from insertion_fee_master");
    $sq = mysql_fetch_array($s);
    if ($sq['amt_to'] >= $amt_from) {
        $f = 1;
    }

    if ($f != 1) {
        //ends here

        if (!empty($amt_from) && !empty($amt_to) && !empty($insertionfee)) {
            $amt_from;
            $amt_to;

            if ($amt_from > $amt_to) {
                echo $err_flag = 2;
            } else {
                $in = "insert into insertion_fee_master(amt_from,amt_to,insertionfee)values($amt_from,$amt_to,$insertionfee)";
                $insql = mysql_query($in);

                $cat = "Amount From :" . $amt_from . " ,Amount To :" . $amt_to . " , Insetion Fee :" . $insertionfee;
            }
            $message = "Insertion Fee Added Successfully";
        }
    } else {
        $err_flag = 1;
    }
} elseif (isset($_REQUEST['bid_modify'])) {
    $bidpermission = $_REQUEST['bidpermission'];
    $query = "update admin_settings set set_value= '$bidpermission'  where set_id=57 ";
    mysql_query($query);

    $total = $_REQUEST[total_records];
    for ($i = 1; $i <= $total; $i++) {
        $records_id = "records_id" . $i;
        $amt_from = $_REQUEST["amt_from" . $i];
        $amt_to = $_REQUEST["amt_to" . $i];
        $insertionfee = $_REQUEST["insertionfee" . $i];
        $records_id = $_REQUEST[$records_id];
        if ($amt_from and $amt_to and $insertionfee) {
            $query = "update insertion_fee_master set amt_from='$amt_from',amt_to='$amt_to',insertionfee='$insertionfee' where ins_id= $records_id";
            $upquery = mysql_query($query);

            $cat = $cat . "Amount From :" . $amt_from . " , Amount To " . $amt_to . " ,Insertion Fee :" . $insertionfee . "<br>";
        }
    }

    $message = "Insertion Fee Updated Successfully";
}

$auction_query = "select * from admin_settings where set_id=57";
$table = mysql_query($auction_query);
$row = mysql_fetch_array($table);
$bid_permission = $row['set_value'];

if ($bid_permission == "yes") {
    $auction_query = "select * from insertion_fee_master";
    $tablebid = mysql_query($auction_query);
    $total = mysql_num_rows($tablebid);
}
$i = 1;
?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table width="100%" border="0" cellpadding="5" cellspacing="1" align="center" >
                <tr><td width=93>
                        <table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/links1_01.jpg" width="93" height="26" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href=auction.php><img src="images/links1_02.jpg" width="93" height="70" alt="" border="0" title="AuctionMaster"></a></td>
                            </tr>
                            <tr>
                                <td><a href=site.php?page=auction><img src="images/links1_03.jpg" width="93" height="71" alt="" border="0" title="AuctionSettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href=category.php><img src="images/links1_04.jpg" width="93" height="73" alt="" border="0" title="CategorySettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href=subcategory.php><img src="images/links1_05.jpg" width="93" height="71" alt="" border="0" title="SubcategorySettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href=custom_category.php><img src="images/links1_06.jpg" width="93" height="70" alt="" border="0" title="CustomCategory"></a></td>
                            </tr>
                            <tr>
                                <td><a href=insertion_fee_settings.php><img src="images/links1_07.jpg" width="93" height="66" alt="" border="0" title="AuctionFeeManagement"></a></td>
                            </tr>
                        </table></td>
                    <td align="left">
                        <table width="98%"><tr><td width="50%"><center><a href=insertion_fee_settings.php class="txt_users">Insertion Fee Settings</a></center></td><td width="50%"><center><a href=finalsalevaluesettings.php class="txt_users">Final Sale Value Fee Settings</a></center></td></tr></table>
<form  action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="frm12">
    <table border="0" align="center" cellpadding="5" cellspacing="2" width="98%" class="border2">
        <tr bgcolor="#CCCCCC" class="txt_users">
            <td colspan="4"> Insertion Fee Settings</td>
        </tr>
        <?php
        if ($err_flag == 1) {
            ?>
            <tr bgcolor="#eeeee1"><td colspan="4" align="center"><b><font color="#FF0000">Insertion Fee Setting Already Exist</font></b></td></tr>
            <?php
        }
        ?>
        <?php
        if ($err_flag == 2) {
            ?>
            <tr bgcolor="#eeeee1"><td colspan="4" align="center"><b><font color="#FF0000">Amount From should be less than Amount to</font></b></td></tr>
            <?php
        }
        ?>
        <?php
        /* if($err_flag==3)
          { */
        ?>
<!--<tr bgcolor="#eeeee1"><td colspan="4" align="center"><b><font color="#FF0000">Please select any item you want to delete</font></b></td></tr>-->
        <?php
//}
        ?>
        <?php
        if ($message != '') {
            ?>
            <tr bgcolor="#eeeee1"><td colspan="4" align="center"><b><font color="#FF0000"><?php = $message; ?></font></b></td></tr>
            <?php
        }
        ?>
        <tr bgcolor="#eeeee1">
            <td  colspan="2">Set Insertion Fee </td> 
            <td colspan="2"> <input type="radio" onClick="checkpermission('no', '<?php = $total
        ?>');" name="bidpermission" value="no" <?php if ($bid_permission == "no") echo"checked"; ?>>No 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" onClick="checkpermission('yes', '<?php = $total
        ?>');" name="bidpermission" value="yes" <?php if ($bid_permission == "yes") echo"checked"; ?>>Yes 
            </td>
        </tr>
        <tr bgcolor="#CCCCCC">
            <?php
            $cur = mysql_query("select * from admin_settings where set_id=59");
            $cur_row = mysql_fetch_array($cur);
            $cur_sym = $cur_row['set_value'];
            ?>
            <td><b>Amount From (<?php = $cur_sym; ?>)</b></td>
            <td><b>Amount To (<?php = $cur_sym; ?>)</b></td>
            <td><b>Insertion Fee (<?php = $cur_sym; ?>)</b></td>
            <td align="center"><b>Add / Delete</b></td>
        </tr>
        <?php
        while ($rowbid = mysql_fetch_array($tablebid)) {
            ?>
            <tr bgcolor="#eeeee1">
                <td width="25%"> <input type="hidden" name="records_id<?php = $i ?>" value="<?php = $rowbid['ins_id'] ?>" />
                    <input  class="smalltxt" type="text"  onKeyPress="return numbersonly(event);" name="amt_from<?php = $i ?>" value="<?php = $rowbid['amt_from'] ?>" <?php if ($bid_permission == "no") { ?> disabled <?php } ?> maxlength="10" ></td>
                <td width="25%"> <input  class="smalltxt" type="text"  onKeyPress="return numbersonly(event);" name="amt_to<?php = $i ?>" value="<?php = $rowbid['amt_to'] ?>" <?php if ($bid_permission == "no") { ?> disabled <?php } ?> maxlength="10" ></td>
                <td width="25%"> <input  class="smalltxt" type="text"  onKeyPress="return numbersonly(event);" name="insertionfee<?php = $i ?>" value="<?php = $rowbid['insertionfee'] ?>" <?php if ($bid_permission == "no") { ?> disabled <?php } ?> maxlength="10" ></td>
                <td width="25%" align="center"> <input type="checkbox" name="bid_del<?php = $i++ ?>"  value="0"  >


                </td>
            </tr>
        <?php }
        ?>
        <input type="hidden" name="v" value="<?php = $i; ?>" />

        <tr bgcolor="#eeeee1">

            <td align="center" colspan="3">
                <input type="submit" value=" Modify " name="bid_modify" class="button"></td>
            <td align="center"><input type="submit" value=" Delete " name="bid_delete" class="button" onclick="return del();">
            </td>

        </tr>
        <tr  bgcolor="#eeeee1">
            <td width="25%"><input  class="smalltxt" type="text"  onKeyPress="return numbersonly(event);" name="bids_from" <?php if ($bid_permission == "no") { ?> disabled <?php } ?> maxlength="10" ></td>
            <td width="25%"><input  class="smalltxt"  onKeyPress="return numbersonly(event);" type="text" name="bids_to" <?php if ($bid_permission == "no") { ?> disabled <?php } ?> maxlength="10" ></td>
            <td width="25%"><input  class="smalltxt"  onKeyPress="return numbersonly(event);" type="text" name="bids_inc" <?php if ($bid_permission == "no") { ?> disabled <?php } ?> maxlength="10" ></td>
            <td width="25%" align="center"><input type="hidden" name="total_records" value="<?php = $total ?>" />
                <input type="submit" value=" Add " name="bid_add" class="button"></td>
        </tr>
    </table>
</form>
<br></td></tr></table></td></tr></table>
<script language="javascript">

    function checkpermission(val, tot)
    {

        var coun = document.forms[0].elements.length;
        for (i = 0; i < coun; i++)
        {
            if (val == "no")
            {
                if (document.forms[0].elements[i].type == "text")
                {
                    document.forms[0].elements[i].disabled = true;
                }
            }
            if (val == "yes")
            {
                if (document.forms[0].elements[i].type == "text")
                {
                    document.forms[0].elements[i].disabled = false;
                }
            }
        }

    }
    function del()
    {

        var coun = document.forms[0].elements.length;
        var f = 0;
        for (i = 0; i < coun; i++)
        {
            if (document.forms[0].elements[i].type == "checkbox")
            {
                if (document.forms[0].elements[i].checked == true)
                {
                    f = 1;
                }
            }
        }
        if (f != 1)
        {
            alert("Please Select Any Item you want to delete");
            return false;
        }
        /*var p=0;
         var s=frm12.v.value;
         var v="frm12.bid_del";
         for(i=1;i<=s;i++)
         {
         var q=v+i+".checked";
         if(eval(q)!=false)
         {	
         p=1;
         }
         }
         alert("in"+p);
         if(p==1)
         {
         alert("Please Select Anyone for Delete");
         return false;
         }*/

        var item_deliever = confirm("Are you sure you want to delete the selected item(s)?");
//alert(item_deliever);
        if (item_deliever == true)
        {
            document.frm13.submit();
            return true;
        }
        else
        {
            return false;
        }
    }


    function modify_val()
    {
        var coun = document.frm12.v.value;
        var i;
        var f = "frm12.amt_from";
        var t = "frm12.amt_to";
        var n = "frm12.amt_from";
        var fr, tr, nr, k;
        for (i = 1; i <= coun; i++)
        {
            fr = f + i + ".value";
            tr = t + i + ".value";
            k = i + 1;
//		alert(k);
//		k=k+1;
            nr = n + k + ".value";

            /*		alert(eval(fr));
             alert(eval(tr));
             */
            if ((eval(fr) != "" || eval(fr) != 0) && (eval(tr) != "" || eval(tr) != 0))
            {

                if (parseInt(eval(fr)) >= parseInt(eval(tr)))
                {

                    alert("Please Enter the Amount To value should be greater than the Amount From value");
                    return false;
                }
            }
            if ((eval(nr) != "") || (eval(nr) != 0))
            {

                if (parseInt(eval(nr)) <= parseInt(eval(tr)))
                {
                    alert("Please Enter the Amount To should be lesser than the Amount From of the next record");
                    return false;
                }
            }
//		alert(eval(nr));
        }
        return true;
    }

    function validate()
    {
        if (frm12.bids_from.value == "")
        {
            alert("Please Enter the Amount From Value");
            frm12.bids_from.focus();
            return false;
        }
        if (frm12.bids_to.value == "")
        {
            alert("Please Enter the Amount To Value");
            frm12.bids_to.focus();
            return false;
        }
        if ((document.frm12.bids_from.value != "") && (document.frm12.bids_to.value != ""))
        {
            var s = document.frm12.bids_from.value;
            var e = document.frm12.bids_to.value;
            if (eval(s) >= eval(e))
            {
                alert("Please Enter the Set Insertion Fee To should be greater than the Set Insertion Fee From");
                document.frm12.bids_from.value = "";
                document.frm12.bids_to.value = "";
                document.frm12.bids_from.focus();
                return false;
            }
        }
        if (frm12.bids_inc.value == "")
        {
            alert("Please Enter the Insertion Fee Value");
            frm12.bids_inc.focus();
            return false;
        }
        return true;
    }

    function numbersonly(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if (unicode != 8 && unicode != 46 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
            if (unicode < 48 || unicode > 57) //if not a number
                return false //disable key press
        }
    }
</script>
<?php
require 'include/footer.php';
?>