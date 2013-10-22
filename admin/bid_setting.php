<?php
/* * *************************************************************************
 * File Name				:bid_setting.php
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
?>
<?php
error_reporting(0);
require 'include/connect.php';
?>

<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%"  bgcolor="#cecfc8">
    <tr><td>
            <table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
                <tr><td colspan="4" class="txt_users"><center><br />Bid Increment Settings<br /><br /></center></td></tr>
    <tr>
        <td align="center">
            <font color="#FF0000">
            <?php
            if ($mes != '')
                echo $mes;
            ?>
            </font>
        </td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>
            <table border="0" align="center" cellpadding="5" cellspacing="2" width="98%" class="border2">
                <form  action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="frm10">

                    <?php
                    /* fetch default currency */
                    $default_sql = mysql_query("select set_value from admin_settings where set_id=59");
                    $default_row = mysql_fetch_array($default_sql);
                    $default_cur = $default_row['set_value'];
                    /*
                      $auction_query="select * from admin_settings where set_id=23";
                      $table=mysql_query($auction_query);
                      $row=mysql_fetch_array($table);
                      $start_date=$row['set_value'];

                      $auction_query="select * from admin_settings where set_id=24";
                      $table=mysql_query($auction_query);
                      $row=mysql_fetch_array($table);
                      $end_date=$row['set_value'];

                      $auction_query="select * from admin_settings where set_id=25";
                      $table=mysql_query($auction_query);
                      $row=mysql_fetch_array($table);
                      $start_delay=$row['set_value'];

                      $auction_query="select * from admin_settings where set_id=26";
                      $table=mysql_query($auction_query);
                      $row=mysql_fetch_array($table);
                      $duration=$row['set_value'];
                     */

                    $auction_query = "select * from admin_settings where set_id=42";
                    $table = mysql_query($auction_query);
                    $row = mysql_fetch_array($table);
                    $bid_permission = $row['set_value'];

                    if ($bid_permission == "no") {
                        $auction_query = "select * from bid_increment";
                        $tablebid = mysql_query($auction_query);
                        $total = mysql_num_rows($tablebid);
                    }
                    $i = 1;
                    ?>



                    <tr bgcolor="#eeeee1"><td  colspan="2"><b>Allow sellers to specify Bid increment</b></td> 
                        <td colspan="2"> <input type="radio" onClick="checkpermission('no', '<?php = $total
                    ?>');" name="bidpermission" value="no" <?php if ($bid_permission == "no") echo"checked"; ?>>No 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" onClick="checkpermission('yes', '<?php = $total
                    ?>');" name="bidpermission" value="yes" <?php if ($bid_permission == "yes") echo"checked"; ?>>Yes 
                        </td>
                    </tr>
                    <tr bgcolor="#eeeee1" >
                        <td><b>From (<?php = $default_cur ?>)</b></td>
                        <td><b>To (<?php = $default_cur ?>)</b></td><td><b>Increment (<?php = $default_cur ?>)</b></td><td align="center"><b>Add / Delete</b></td>
                    </tr>
                    <?php
                    while ($rowbid = mysql_fetch_array($tablebid)) {
                        ?>
                        <tr bgcolor="#eeeee1">
                            <td width="25%"> <input type="hidden" name="records_id<?php = $i ?>" value="<?php = $rowbid['bid_id'] ?>" />
                                <input  class="smalltxt" type="text" maxlength="10" onKeyPress="return numbersonly(event);" name="bid_from<?php = $i ?>" value="<?php = $rowbid['bid_from'] ?>" <?php if ($bid_permission == "yes") { ?> disabled <?php } ?> ></td>
                            <td width="25%"> <input  class="smalltxt" type="text" maxlength="10" onKeyPress="return numbersonly(event);" name="bid_to<?php = $i ?>" value="<?php = $rowbid['bid_to'] ?>" <?php if ($bid_permission == "yes") { ?> disabled <?php } ?> ></td>
                            <td width="25%"> <input  class="smalltxt" type="text" maxlength="10" onKeyPress="return numbersonly(event);" name="bid_inc<?php = $i ?>" value="<?php = $rowbid['bid_inc'] ?>" <?php if ($bid_permission == "yes") { ?> disabled <?php } ?> ></td>
                            <td width="25%" align="center"> <input type="checkbox" name="bid_del<?php = $i++ ?>"  value="0"></td>
                        </tr>
                    <?php }
                    ?>


                    <tr bgcolor="#eeeee1" >
                    <input type="hidden" name="v" value="<?php = $i; ?>" />

                    <td align="center" colspan="3"><input type="submit" value=" Modify " name="bid_modify" class="button"></td>
                    <td align="center"><input type="submit" value=" Delete " name="bid_delete" class="button" onclick="return del();"></td>

                    </tr>
                    <tr  bgcolor="#eeeee1" > 
                        <td width="25%"><input  class="smalltxt" type="text" maxlength="10" onKeyPress="return numbersonly(event);" name="bids_from" <?php if ($bid_permission == "yes") { ?> disabled <?php } ?> ></td>
                        <td width="25%"><input  class="smalltxt" type="text" maxlength="10" onKeyPress="return numbersonly(event);" name="bids_to" <?php if ($bid_permission == "yes") { ?> disabled <?php } ?> ></td>
                        <td width="25%"><input  class="smalltxt" type="text" maxlength="10" onKeyPress="return numbersonly(event);" name="bids_inc" <?php if ($bid_permission == "yes") { ?> disabled <?php } ?> ></td>

                        <td width="25%" align="center"><input type="hidden" name="total_records" value="<?php = $total ?>" />

                            <input type="submit" value=" Add " name="bid_add" class="button"></td>
                    </tr>
                </form>
            </table>
        </td></tr>
</table>
</td></tr>
<script language="javascript">
    function checkpermission(val, tot)
    {
//alert('hai');
//alert(tot);
//alert(document.forms[0].elements.length);
        var coun = document.forms[0].elements.length;
        for (i = 0; i < coun; i++)
        {
            if (val == "yes")
            {
                if (document.forms[0].elements[i].type == "text")
                {
                    document.forms[0].elements[i].disabled = true;
                }
            }
            if (val == "no")
            {
                if (document.forms[0].elements[i].type == "text")
                {
                    document.forms[0].elements[i].disabled = false;
                }
            }
        }

    }

    function validate()
    {
        if (frm10.bids_from.value == "")
        {
            alert("Please Enter the Bids Starting From Value");
            frm10.bids_from.focus();
            return false;
        }
        if (frm10.bids_to.value == "")
        {
            alert("Please Enter the Bids To Value");
            frm10.bids_to.focus();
            return false;
        }
        if ((document.frm10.bids_from.value != "") && (document.frm10.bids_to.value != ""))
        {
            var s = document.frm10.bids_from.value;
            var e = document.frm10.bids_to.value;
            if (eval(s) >= eval(e))
            {
                alert("Please Enter the Bid Increment To should be greater than the Bid Increment From");
                document.frm10.bids_from.value = "";
                document.frm10.bids_to.value = "";
                document.frm10.bids_inc.value = "";
                document.frm10.bids_from.focus();
                return false;
            }
        }
        if (frm10.bids_inc.value == "")
        {
            alert("Please Enter the Bids Increment Value");
            frm10.bids_inc.focus();
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

    function modify_val()
    {
        var coun = document.frm10.v.value;
        var i;
        var f = "frm10.bid_from";
        var t = "frm10.bid_to";
        var n = "frm10.bid_from";
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

                    alert("Please Enter the Bid Increment To value should be greater than the Bid Increment From value");
                    return false;
                }
            }
            if ((eval(nr) != "") || (eval(nr) != 0))
            {

                if (parseInt(eval(nr)) <= parseInt(eval(tr)))
                {
                    alert("Please Enter the Bid Increment To should be lesser than the Bid Increment From of the next record");
                    return false;
                }
            }
//		alert(eval(nr));
        }
        return true;
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

        var item_deliever = confirm("Are you sure you want to delete the selected Fee Setting(s)?");
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
</script>