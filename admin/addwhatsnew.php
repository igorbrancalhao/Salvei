<?php
session_start();
/* * *************************************************************************
 * File Name				:addwhatsnew.php
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
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
    <!--
    .style1 {
        color: #666666;
        font-weight: bold;
    }
    .style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
    -->
</style>
<?php
require 'include/connect.php';
$special_char = array('*', '#', '@', '!', '%', '&', '|', '+', '-', '$', '^');
if (isset($_POST['submit'])) {
    $date = date("y-m-d");
    $name = $_POST['txtlinkname'];
    $url = $_POST['txturl'];
    $logo = $_FILES['logo']['name'];
    $logo = str_replace($special_char, '', $logo);
    $logo = "$date" . "_" . "$logo";
    if ($logo) {
        $uploaddir = "../images/$logo";
        move_uploaded_file($_FILES['logo']['tmp_name'], $uploaddir);
        $sql = "INSERT INTO `whatsnew` (`link_name` , `link` , `icon`) VALUES('$name','$url','$logo')";
        $result = mysql_query($sql);
        if ($result) {
            echo "<center><font color=red>Whats New Added Suceessfully...................</font></center>";
            echo "<br><br><input type=button value=Close onclick='javascript:window.close();' class=button4>";
            echo "</center>";
            ?>
            <script>
                window.opener.history.go();
            </script>
            <?php
            exit();
        }
    }
}
?>

<form name="frm" method="post" enctype="multipart/form-data" action="addwhatsnew.php">
    <table align="center" width="80%" class="tablebox" cellpadding="2" bgcolor="#FFFFFF">
        <tr bgcolor="#eeeee1" class="style1"> 
            <td height="24" colspan="2">Add What's New Link</td>
        </tr>
        <tr bgcolor="#eeeee1"> 
            <td align="right" class="style1">Link Name</td>
            <td><input type="text" name=txtlinkname></td></tr>
        <tr bgcolor="#eeeee1"> 
            <td align="right" class="style1">URL</td>
            <td><input type="text" name=txturl> (Eg: http://www.example.com)</td></tr>
        <tr bgcolor="#eeeee1"> 
            <td align="right" class="style1">
                Icon			
            </td>
            <td height="24"  align="left">
                <input type="file" name=logo  /></td></tr>
        <tr bgcolor="#eeeee1"><td align="center" colspan="2" style="text-align:center">
                <input type="hidden" name="cansave" value="0">
                <input type="submit" name="submit" value="Add" class="button" onclick="return validate();"></td>
        </tr> </table> </form>

<script language="javascript">
    function validate()
    {
        if (frm.txtlinkname.value == "")
        {
            alert("Please Enter the Link Name");
            frm.txtlinkname.focus();
            return false;
        }
        if (frm.txturl.value == "")
        {
            alert("Please Enter the URL Name");
            frm.txturl.focus();
            return false;
        }
        if (document.frm.txturl.value != "")
        {
            var tomatch = /^(http:\/\/)[Ww\.-]{3,}\.[A-Za-z0-9-_]{2,}\.([A-Za-z]{2,})/;
            if (!(document.frm.txturl.value.match(tomatch)))
            {
                alert("URL invalid. Try again.");
                frm.txturl.focus();
                return false;
            }
        }
        if (frm.logo.value == "")
        {
            alert("Please Enter the Icon");
            frm.logo.focus();
            return false;
        }
        if (frm.logo.value != "")
        {
            l1 = frm.logo.value;
            l = l1.length - 1;
            lastdot = l1.lastIndexOf('.');
            diff = l - lastdot;
            s = l1.substr(lastdot + 1, l);
//	alert(s);
            if ((s != 'jpg') && (s != 'jpeg') && (s != 'gif') && (s != 'bmp'))
            {
                alert("Please Give a Valid Image File");
//		f1.img1.value = "";
                frm.logo.focus();
                return false;
            }
        }
        frm.cansave.value = 1;
        return true;
    }
</script>