<?php
/* * *************************************************************************
 * File Name				:stores.php
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
<?php session_start(); ?>
<style type="text/css">
    <!--
    .style1 {
        color: #666666;
        font-weight: bold;
    }
    .style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
    -->
</style>
<link href="include/style.css" rel="stylesheet" type="text/css">
<?php
require 'include/connect.php';
require 'include/top.php';
$userid = $_SESSION['userid'];
$mode = $_GET[mode];
$user_id = $_SESSION[userid];
$cansave = $_POST[cansave];
$myquery = "select * from storefronts where user_id='$user_id'";
$mytab = mysql_query($myquery);
$count = mysql_num_rows($mytab);
if ($cansave != 1) {
    $row = mysql_fetch_array($mytab);
    $store_name = $row[store_name];
    $itemdes = $row[description];
    $aboutpage_type = $row[status];
    $aboutpage_type = $row[status];
    $logo = $row[logo];
}
if ($cansave == 1) {
    $store_name = $_POST[store_name];
    $itemdes = $_POST[htmlcontent];
    $aboutpage_type = $_POST[aboutpage_type];
    $logo1 = $_FILES['logo']['name'];
    if ($logo1)
        $logo = $logo1;
    $uploaddir = getcwd();
    $updir = explode('/', $uploaddir);
    $count = count($updir) - 1;
    for ($i = 0; $i < $count; $i++) {
        $up_dir.=$updir[$i] . "/";
    }
    $uploaddir = rtrim($up_dir, "/");
    if (!empty($logo)) {
        $type1 = $_FILES['logo']['type'];
        if ($type1 == "image/pjpeg" || $type1 == "image/gif" || $type1 == "image/jpeg" || $type1 == "image/bmp") {

            $logo = urlencode($logo);
            $logo = "$user_id" . "$logo";
            $uploaddir = "storefronts/$logo";
            move_uploaded_file($_FILES['logo']['tmp_name'], $uploaddir);
            //$_logo_name=$_FILES['logo']['name'];
            //s $logo=$_FILES['logo']['name'];
        }
    }

    if ($count == 0) {
        $query = "insert into storefronts         (user_id,logo,description,store_name,status)values('$user_id','$logo','$itemdes','$store_name','$aboutpage_type')";
        mysql_query($query);
    } else {
        if ($logo == "")
            $query = "update storefronts set description ='$itemdes',store_name='$store_name' where user_id='$user_id'";
        else
            $query = "update storefronts set logo='$logo', description ='$itemdes',store_name='$store_name' where user_id='$user_id'";

        mysql_query($query);
    }
} //  if($cansave==1)
?>			 
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" >
    <tr><td valign="top" class="table_border">
            <table border="0" align="center" cellpadding="3" cellspacing="0" width="100%">
                <tr> 
                    <td colspan="2">
                        <TABLE cellSpacing=5 cellPadding=0 width=100%
                               border=0 align="left" bgcolor="white">
                            <TBODY>
                                <TR class=c2>
                                    <TD width="150" align="right">
                                        <STRONG>STORE STATUS</STRONG>:</TD><td><IMG 
                                            hspace=4 src="../images/<?php
                                            if ($aboutpage_type == 'enable')
                                                echo 'active.gif';
                                            else
                                                echo 'inactive.gif';
                                            ?>" ><SPAN 
                                            class=redfont><?php
                                                if ($aboutpage_type == 'enable')
                                                    echo "<font color=green>inactive </font>";
                                                else
                                                    echo "<font color=red>active </font>";
                                                ?> </SPAN></TD>
                                    <!-- <TD width="33%"><STRONG>LAST PAYMENT</STRONG>: n/a</TD>
                                    <TD width="33%"><STRONG>NEXT PAYMENT</STRONG>: 
                                  n/a</TD> --> </TR></TBODY></TABLE></TD></TR>
                <TR>
                    <TD class=c4>
                        <FORM action=stores.php method=post 
                              encType=multipart/form-data name=form1>
                            <INPUT type=hidden name=oldlogo> 
                            <TABLE class=border cellSpacing=4 cellPadding=4 width="100%" 
                                   border=0>
                                <TBODY>
                                    <TR class=c3>
                                        <TD class=contentfont align=right width=150><B>Enable Store</B></TD>
                                        <TD class=contentfont>
                                            <?php
                                            if ($aboutpage_type == "enable") {
                                                ?>
                                                <INPUT type=radio value="enable"
                                                       name=aboutpage_type checked="checked" /> Yes 
                                                       <?php
                                                   } else {
                                                       ?> 
                                                <INPUT type=radio value="enable"
                                                       name=aboutpage_type> Yes 
                                                       <?php
                                                   }
                                                   ?>
                                                   <?php
                                                   if ($aboutpage_type == "disable") {
                                                       ?>
                                                <INPUT type=radio value="disable"
                                                       name=aboutpage_type checked="checked"> No
                                                       <?php
                                                   } else {
                                                       ?> 
                                                <INPUT type=radio value="disable"
                                                       name=aboutpage_type> No
                                                       <?php
                                                   }
                                                   ?>
                                        </TD></TR>
                                    <TR class=c2>
                                        <TD width=150></TD>
                                        <TD class=contentfont>By enabling the STORE page, you will 
                                            have the option to list a number of auctions on the newly 
                                            created store section.</TD></TR>
                                    <TR class=c2>
                                        <TD class=contentfont align=right><B>Store Name</B></TD>
                                        <TD class=contentfont><INPUT  id=store_name 
                                                                      maxLength=50 size=50 name=store_name value="<?php = $store_name ?>"></TD></TR>
                                <TD class=contentfont align=right><B>Store Name</B></TD>
                                <TD class=contentfont><INPUT  id=store_name 
                                                              maxLength=50 size=50 name=store_name value="<?php = $store_name ?>"></TD></TR>
                                <TR class=c2>
                                    <TD class=contentfont vAlign=top align=right><B>Store 
                                            Description</B></TD>
                                    <TD class=contentfont>
                                        <!-- <TEXTAREA id=content name=content rows=10 cols=45></TEXTAREA> -->
                                        <?php
                                        $browser_name = $_SERVER['HTTP_USER_AGENT'];
                                        if (substr_count($browser_name, 'Opera') == 1)
                                            $brow_name = 'opera';
                                        else if (substr_count($browser_name, 'Netscape') == 1)
                                            $brow_name = 'netscape';
                                        else if (substr_count($browser_name, 'Firefox') == 1)
                                            $brow_name = 'firefox';
                                        else
                                            $brow_name = 'ie';
                                        if ($brow_name == 'netscape' || $brow_name == 'opera' || $brow_name == 'firefox')
                                            echo '<textarea name="htmlcontent" cols="60" rows="15">' . $itemdes . '</textarea>';
                                        else
                                            require 'include/content.php';
                                        ?>
                                    </TD></TR>
                                <?php
                                if ($logo) {
                                    ?>   
                                    <TR class=c3>
                                        <TD class=contentfont align=right><B>Current Logo</B></TD>
                                        <TD class=contentfont><img src="storefronts/<?php = $logo ?>" /></TD></TR>
                                    <?php
                                }
                                ?>  
                                <TR class=c3>
                                    <TD class=contentfont align=right><B>Upload Store Logo</B></TD>
                                    <TD class=contentfont><INPUT id=logo type=file size=40 
                                                                 name=logo></TD></TR>
                                <!--  <TR class=c2>
               <TD class=contentfont vAlign=top align=right><B>Store 
                 Categories</B></TD>
               <TD class=contentfont><SELECT id=categories[] multiple size=10 
                 name=categories[]> <OPTION value=215>Antiques &amp; 
                   Art</OPTION><OPTION value=263>Automobiles &amp; 
                   Bikes</OPTION><OPTION value=355>Books</OPTION><OPTION 
                   value=887>Businesses For Sale</OPTION><OPTION 
                   value=474>Clothing &amp; Accessories</OPTION><OPTION 
                   value=634>Coins</OPTION><OPTION 
                   value=669>Collectables</OPTION><OPTION 
                   value=877>Computing</OPTION><OPTION value=1117>Dolls &amp; 
                   Dolls Houses</OPTION><OPTION 
                   value=1040>Electronics</OPTION><OPTION value=1777>Everything 
                   Else</OPTION><OPTION value=57>Gaming</OPTION><OPTION 
                   value=1211>Jewelry &amp; Watches</OPTION><OPTION 
                   value=1243>Music</OPTION><OPTION 
                   value=1311>Photography</OPTION><OPTION value=1351>Pottery 
                   &amp; Glass</OPTION><OPTION 
                   value=890>Properties</OPTION><OPTION 
                   value=878>Services</OPTION><OPTION 
                   value=1404>Sports</OPTION><OPTION 
                   value=1554>Stamps</OPTION><OPTION value=1588>Tickets &amp; 
                   Travel</OPTION><OPTION value=1628>Toys &amp; 
                   Games</OPTION><OPTION value=1139>TV &amp; 
                   Movies</OPTION><OPTION value=1723>Wholesale 
                   Items</OPTION><OPTION value=1836>Vaction 
                   Rentals</OPTION><OPTION 
                   value=1837>Timeshares</OPTION><OPTION value=1838>Real 
                   estate</OPTION></SELECT><BR><SPAN class=smallfont>NOTE: If you 
                 dont select any categories for your store, all the site's 
                 categories will be available in your store by default. 
                 Otherwise you will only be able to list items in the 
                 categories you have selected for your store.<BR><BR>In order 
                 to select multiple categories, please hold the Ctrl button 
                 pressed.</SPAN> </TD></TR> -->
                                <TR class=c4>
                                    <TD class=contentfont align=middle colSpan=2>
                                        <input type="hidden" name="cansave" value=1>
                                        <INPUT type=submit value="Save Settings" name=storesaveok></TD></TR></TBODY></TABLE>
                        </FORM></TD></TR></TBODY></TABLE><BR>	

        </td></tr>
</table>
<?php require 'include/footer.php'; ?>
</body>
</html>
