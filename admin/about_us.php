<?php
/* * *************************************************************************
 * File Name				:about_us.php
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
require 'include/top.php';
?>
<?php
if (isset($_REQUEST['update'])) {
$name = $_REQUEST['name'];
$about_company = $_REQUEST['about_company'];
$address = $_REQUEST['address'];
$phone = $_REQUEST['phone'];
$fax = $_REQUEST['fax'];

$query = "update about_us set company_name='$name' , company_detail='$about_company' , company_address='$address' , ";
$query .= " company_phone = '$phone' , company_fax = '$fax' where company_id=1";

if (mysql_query($query))
echo "<tr bgcolor=#f7f7f7><td><font color='#ff0000'><center>   Updated Successfully ! </center></font></td></tr>";
}
?>

<?php
$query = "select * from about_us where company_id=1";
$tab = mysql_query($query);
$row = mysql_fetch_array($tab);
$name = $row['company_name'];
$about_company = $row['company_detail'];
$address = $row['company_address'];
$phone = $row['company_phone'];
$fax = $row['company_fax'];
?>

<table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
    <tr><td>
            <table border="0" align="center" cellpadding="5" cellspacing="2" width="760" bgcolor="#E8E8E8" height="100%">
                <tr>
                    <td colspan="4" class=txt_users><center>About Us Setting</center></td></tr>
    <tr><td>
            <table width="98%"  border="0" cellpadding="5" cellspacing="2" class="border2" align="center">
                <form name="frmsearch" method="post">

                    <tr bgcolor="#eeeee1"><td><b>Company Name</b></td><td><input type="text" name="name" class="text" value="<?php = $name; ?>" size="50"></td></tr>
                    <tr bgcolor="#eeeee1"><td><b>About Company</b></td><td><textarea name="about_company" cols="40" rows="10"><?php = $about_company; ?></textarea></td></tr>
                    <tr bgcolor="#eeeee1"><td><b>Contact Address</b></td><td><textarea name="address" class="text" rows="5" cols="30"><?php = $address; ?></textarea></td></tr>
                    <tr bgcolor="#eeeee1"><td><b>Contact Number</b></td><td><input type="text" name="phone" class="text" maxlength="15" onkeypress="return numbersonly(event);" value="<?php = $phone; ?>" size=""></td></tr>
                    <tr bgcolor="#eeeee1"><td><b>Fax Number</b></td><td><input type="text" name="fax" class="text" onkeypress="return numbersonly(event);" value="<?php = $fax; ?>" size="50" maxlength=""></td></tr>
                    <tr bgcolor="#eeeee1"><td colspan="2" style="text-align:center">
                            <input type="submit" name="update" value="Update" class="button" value="<?php = $submit; ?>" onclick="return val();"> 
                        </td></tr>

            </table></td></tr>
</table></td></tr>
<?php require 'include/footer1.php'; ?>
</body>
</html>
<script language="javascript">
    function val()
    {
        if (frmsearch.name.value == "")
        {
            alert("Please Enter the Company Name");
            frmsearch.name.focus();
            return false;
        }
        if (frmsearch.about_company.value == "")
        {
            alert("Please Enter the About Company");
            frmsearch.about_company.focus();
            return false;
        }
        if (frmsearch.address.value == "")
        {
            alert("Please Enter the Company Address");
            frmsearch.address.focus();
            return false;
        }
        if (frmsearch.phone.value == "")
        {
            alert("Please Enter the Company Phone Number");
            frmsearch.phone.focus();
            return false;
        }
        if (frmsearch.fax.value == "")
        {
            alert("Please Enter the Company Fax Number");
            frmsearch.fax.focus();
            return false;
        }
        return true;
    }
    function numbersonly(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if (unicode != 8 && unicode != 45 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
            if (unicode < 48 || unicode > 57) //if not a number
                return false //disable key press
        }
    }
</script>
