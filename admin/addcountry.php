<?php
/* * *************************************************************************
 * File Name				:addcountry.php
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
session_start();
require 'include/connect.php';
$frm = $_POST["cate"];
$country = $_POST["cat"];
$mode = $_REQUEST[mode];
$countryid = $_REQUEST['id'];
require 'include/top.php';
if ($mode == 'edit') {
    $cat_sql = "select * from country_master where country_id=$countryid";
    $cat_res = mysql_query($cat_sql);
    $cat_row = mysql_fetch_array($cat_res);
}
if ($frm == 1) {
    if ($mode == "edit") {
        $sq = mysql_query("select * from country_master where country_id=$countryid");
        $sq1 = mysql_fetch_array($sq);
        $name = $sq1['country'];

        $s = mysql_query("select * from country_master where country='$country' and country_id!=$countryid");
        $coun_row = mysql_num_rows($s);
        if ($coun_row == 1) {
            $mes = "Country Name Already Exist";
        } else {
            $sql1 = "update country_master set country='$country' where country_id=$countryid";
            $res1 = mysql_query($sql1);

            $cat = $name . " as " . $country;

            $mes = "Country Edited Successfully";
        }
    } else {
        $s = mysql_query("select * from country_master where country='$country'");
        $coun_row = mysql_num_rows($s);
        if ($coun_row == 1) {
            $mes = "Country Name Already Exist";
        } else {
            $sql = "insert into country_master(country) values('$country')";
            $res = mysql_query($sql);

            $mes = "Country Added Successfully";
        }
    }

    echo '<meta http-equiv="refresh" content="2;url=country.php">';
}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
    <tr><td>
            <table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
                <tr><td height="24" class="txt_users"><center>Country</center></td></tr>
    <tr><td>
            <table align="center" class="border2" width="70%" height="100" cellpadding="5" cellspacing="1" >
                <form action="addcountry.php" method="post" name="f1">
                    <td height="39" colspan="2" bgcolor="#eeeee1" align="center"><b>
                            <?php
                            if ($mode == 'edit') {
                                echo ("Edit Country");
                            } else {
                                echo ("Add Country");
                            }
                            ?></b>
                    </td>
                    <tr>
                        <td align="center" colspan="2" bgcolor="eeeee1">
                            <font color="#FF0000">
                            <?php
                            if ($mes != '')
                                echo $mes;
                            ?>
                            </font>
                        </td></tr>
                    <tr bgcolor="eeeee1">
                        <td align="center"><B>Country Name</B><td>
                            <input type="text" name="cat" value="<?php = $cat_row[country]; ?>"  >
                            <input type="hidden" name="cate" value=1>
                            <input type="hidden" name="mode" value=<?php = $mode; ?> >
                            <input type="hidden" name="id" value=<?php = $countryid; ?> >
                    <tr bgcolor="#eeeee1"><td colspan="2" style="text-align:center">
                            <input  type="submit" name="add" value="Submit" class="button" onclick="return validate();">
                        </td></tr>
                    </td></tr>
            </table></td></tr>
</table></td></tr>

</form>
<?php
require 'include/footer1.php';
?>
<script language="javascript">
    function validate()
    {
        if (f1.cat.value == "")
        {
            alert("Please Enter the Country Name");
            f1.cat.focus();
            return false;
        }
        return true;
    }
</script>