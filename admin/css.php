<?php
/* * *************************************************************************
 * File Name				:css.php
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
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
    <!--
    .style1
    {
        color: #666666;
        font-weight: bold;
    }
    .style3
    {
        color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif
    }
    -->
</style>
<?php
require 'include/connect.php';
require 'include/top.php';
if (isset($_POST['submit'])) {
    $name = $_POST['txtName'];
    $catid = $_POST['txtId'];
    $logo = $_FILES['header_image']['name'];
    if ($logo) {
        $sql = "update admin_css set css_value='$logo' where css_id='31'";
        $result = mysql_query($sql);
        $uploaddir = "../images/$logo";
        move_uploaded_file($_FILES['header_image']['tmp_name'], $uploaddir);
    }

    for ($i = 0; $i < count($name); $i++) {
        $sql = "update admin_css set css_value='$name[$i]' where css_id='$catid[$i]'";
        $result = mysql_query($sql);
        $message = "CSS Settings Edited Successfully";
    }
    $f = fopen("../style/admin_css.css", "w");
    fwrite($f, ".body \n {\n" . "margin-top:0" . ";\n" . "}" . "\n");
    $css = "select * from admin_css";
    $css_res = mysql_query($css);
    while ($css_row = mysql_fetch_array($css_res)) {
        $val[$css_row[css_id]] = $css_row[css_value];
    }
    fwrite($f, ".txtsmall \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";width:120;height:20;" . "\n" . "}" . "\n");
    fwrite($f, "td \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";" . "\n" . "}" . "\n");
    fwrite($f, ".txtmid \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";width:150;height:25;" . "\n" . "}" . "\n");
    fwrite($f, ".txtbig \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";width:300;height:23;" . "\n" . "}" . "\n");
    fwrite($f, ".txtmed \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";width:200;height:23;" . "\n" . "}" . "\n");
    fwrite($f, ".cbobig \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";width:200;height:23;" . "\n" . "}" . "\n");
    fwrite($f, ".buttonsearch \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";width:50;height:25;" . "\n" . "}" . "\n");
    fwrite($f, ".buttonbig \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";width:75;height:25;" . "\n" . "}" . "\n");
    fwrite($f, ".tdhead \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";font-weight:" . $val[24] . ";BACKGROUND-COLOR:" . $val[3] . ";\n" . "}" . "\n");
    fwrite($f, ".tdhead_2 \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";font-weight:" . $val[24] . ";BACKGROUND-COLOR:" . white . ";\n" . "}" . "\n");
    fwrite($f, ".tdhead_3 \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";font-weight:" . $val[24] . ";BACKGROUND-COLOR:" . "" . ";\n" . "}" . "\n");
    fwrite($f, ".tdhead_1 \n {\n" . "font-size:" . $val[26] . ";font-family:" . $val[25] . ";font-weight:" . $val[24] . ";" . ";\n" . "}" . "\n");
    fwrite($f, ".a \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";font-weight:" . $val[28] . ";color:" . $val[27] . ";\n" . "}" . "\n");
    fwrite($f, ".smalla \n {\n" . "font-size:" . $val[30] . ";font-family:" . $val[25] . ";font-weight:" . $val[28] . ";color:" . $val[29] . ";\n" . "}" . "\n");
    fwrite($f, ".cata \n {\n" . "font-size:" . $val[2] . ";font-family:" . $val[25] . ";font-weight:" . $val[23] . ";color:" . $val[27] . ";\n" . "}" . "\n");
    fwrite($f, ".biga \n {\n" . "font-size:" . $val[2] . ";font-family:" . $val[25] . ";font-weight:" . $val[23] . ";color:" . $val[27] . ";\n" . "}" . "\n");
    fwrite($f, ".font_tit_color\n {\n" . "color:" . $val[4] . ";\n" . "}" . "\n");
    fwrite($f, ".font_sub_tit\n {\n" . "color:" . $val[6] . ";\n" . "}" . "\n");
    fwrite($f, ".hint_font\n {\n" . "color:" . $val[5] . ";\n" . "}" . "\n");
    fwrite($f, ".warning_font_color\n {\n" . "color:" . $val[7] . ";\n" . "}" . "\n");
    fwrite($f, ".warning_color\n {\n" . "color:" . $val[7] . ";\n" . "}" . "\n");
    fwrite($f, ".highlight\n {\n" . "BACKGROUND-COLOR:" . $val[8] . ";\n" . "}" . "\n");
    fwrite($f, ".tr_title\n {\n" . "BACKGROUND-COLOR:" . $val[8] . ";\n" . "}" . "\n");
    fwrite($f, ".tr_color_1\n {\n" . "BACKGROUND-COLOR:" . $val[9] . ";\n" . "}" . "\n");
    fwrite($f, ".tr_color_2\n {\n" . "BACKGROUND-COLOR:" . $val[10] . ";\n" . "}" . "\n");
    fwrite($f, ".tr_color_3\n {\n" . "BACKGROUND-COLOR:" . $val[11] . ";\n" . "}" . "\n");
    fwrite($f, ".light_bg\n {\n" . "BACKGROUND-COLOR:" . $val[12] . ";\n" . "}" . "\n");
    fwrite($f, ".table_bgcolor_withborder_1\n {\n" . "border-top:1px solid " . $val[12] . ";border-bottom:1px solid " . $val[12] . ";border-left:1px solid " . $val[12] . ";border-right:1px solid " . $val[12] . ";BACKGROUND-COLOR:" . $val[13] . ";\n" . "}" . "\n");
    fwrite($f, ".table_bgcolor_withborder_1\n {\n" . "border-top:1px solid " . $val[12] . ";border-bottom:1px solid " . $val[12] . ";border-left:1px solid " . $val[12] . ";border-right:1px solid " . $val[12] . ";BACKGROUND-COLOR:" . $val[9] . ";\n" . "}" . "\n");
    fwrite($f, ".#link1 \n {\n" . "color:" . $val[14] . ";font-size:" . $val[15] . ";text-decoration:none;font-family:" . $val[25] . ";font-weight:" . $val[28] . ";\n" . "}" . "\n");
    fwrite($f, ".#link1:hover \n {\n" . "color:" . $val[16] . ";font-size:" . $val[17] . ";text-decoration:none;font-family:" . $val[25] . ";font-weight:" . $val[28] . ";\n" . "}" . "\n");
    fwrite($f, ".both\n {\n" . "border-top:1px solid " . $val[18] . ";border-bottom:1px solid " . $val[18] . ";border-left:1px solid " . $val[18] . ";border-right:1px solid " . $val[18] . ";BACKGROUND-COLOR:" . $val[8] . ";\n" . "}" . "\n");
    fwrite($f, ".table_border\n {\n" . "border-top:1px solid " . $val[18] . ";border-bottom:1px solid " . $val[18] . ";border-left:1px solid " . $val[18] . ";border-right:1px solid " . $val[18] . ";\n" . "}" . "\n");
    fwrite($f, ".table_head_color\n {\n" . "BACKGROUND-COLOR:" . $val[18] . ";\n" . "}" . "\n");
    fwrite($f, ".table_border1\n {\n" . "border-top:1px solid " . $val[19] . ";border-bottom:1px solid " . $val[19] . ";border-left:1px solid " . $val[19] . ";border-right:1px solid " . $val[19] . ";\n" . "}" . "\n");
    fwrite($f, ".table_border_thick\n {\n" . "border-top:3px solid " . $val[19] . ";border-bottom:3px solid " . $val[19] . ";border-left:3px solid " . $val[19] . ";border-right:3px solid " . $val[19] . ";\n" . "}" . "\n");
    fwrite($f, ".table_border1_with_bg\n {\n" . "border-top:1px solid " . $val[19] . ";border-bottom:1px solid " . $val[19] . ";border-left:1px solid " . $val[19] . ";border-right:1px solid " . $val[19] . ";BACKGROUND-COLOR:" . $val[9] . ";\n" . "}" . "\n");
    fwrite($f, ".table_topless_border\n {\n" . ";border-bottom:1px solid " . $val[18] . ";border-left:1px solid " . $val[18] . ";border-right:1px solid " . $val[18] . ";BACKGROUND-COLOR:" . $val[9] . ";\n" . "}" . "\n");
    fwrite($f, ".table_border_with_bg1\n {\n" . "border-top:1px solid " . $val[19] . ";border-bottom:1px solid " . $val[19] . ";border-left:1px solid " . $val[19] . ";border-right:1px solid " . $val[19] . ";\n" . "}" . "\n");
    fwrite($f, ".tr_border\n {\n" . "border-top:2px solid " . $val[21] . ";border-bottom:2px solid " . $val[21] . ";" . ";BACKGROUND-COLOR:" . $val[20] . ";\n" . "}" . "\n");
    fwrite($f, ".tr_top_border \n {\n" . "border-top:2px solid " . $val[21] . ";BACKGROUND-COLOR:" . $val[20] . ";\n" . "}" . "\n");
    fwrite($f, ".tr_border_1 \n {\n" . "border-top:1px solid " . $val[21] . ";BACKGROUND-COLOR:" . $val[22] . ";\n" . "}" . "\n");
    fwrite($f, ".sub_tr_border \n {\n" . "border-top:1px solid " . $val[20] . ";BACKGROUND-COLOR:" . $val[22] . ";\n" . "}" . "\n");
    fwrite($f, ".mylist\n {\n" . "BACKGROUND-COLOR:" . $val[20] . ";\n" . "}" . "\n");
    fwrite($f, ".main_table_head\n {\n" . "BACKGROUND-COLOR:" . $val[3] . ";\n" . "}" . "\n");
    fwrite($f, ".header_table\n {\n" . "BACKGROUND-COLOR:" . $val[1] . ";\n" . "}" . "\n");
    fwrite($f, ".td \n {\n" . "font-size:" . $val[23] . ";font-family:" . $val[25] . ";" . "\n" . "}" . "\n");

    fclose($f);
}
$get_res = mysql_query("select * from admin_css where css_id !=31 ");
$logo_res = mysql_query("select * from admin_css where css_id = 31");
$logo_row = mysql_fetch_array($logo_res);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
    <tr><td>
            <table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
                <tr><td height="24" colspan="2" class="txt_users"><center><br />CSS Settings<br /><br /></center></td></tr>
                <!--<tr><td>
                <table align="center" width="100%" height="35" bgcolor="#FFCF00">
                <tr><td align="center"><a href="site.php?page=gen" id="link3">General Settings</a></td>
                <td align="center"><a href="site.php?page=pay" id="link3"> Payment Settings</a></td> 
                <!-- <td align="center"><a href="site.php?page=site" id="link3">Site Settings</a></td> -->
                <!--<td align="center"><a href="site.php?page=level" id="link3">Level Settings</a></td>-->
                <!--<td align="center"><a href="site.php?page=style" id="link3">Style Settings</a></td>
                <td align="center"><a href="site.php?page=auction" id="link3">Auction Settings</a></td>
                </tr>
                </table></td></tr>-->
    <?php
    if ($message) {
        ?>
        <tr><td align="center"><font size="+1" color="#FF0000"><?php = $message ?></font></td></tr>
        <?php
    }
    ?>
    <tr><td>

            <?php
            $page = $_GET['page'];
            /* if($page=='')
              $page='gen';
              else
              { */
            ?>

            <form name="frm" method="post" enctype="multipart/form-data" >
                <table align="center" width="98%" cellpadding="2" class="border2">

                    <tr bgcolor="#eeeee1" > 
                        <td height="24" colspan="2"><b>Change your CSS Settings Here</b> </td>
                    </tr>
                    <?php
                    while ($get_row = mysql_fetch_array($get_res)) {
                        ?>
                        <tr bgcolor="eeeee1">
                            <td width="51%"><?php = $get_row['css_name']; ?></td>
                            <td width="49%"><input type="text" name="txtName[]" class="text" value="<?php = $get_row['css_value']; ?>" style="width:180;height:20 ">
                                <input type="hidden" name="txtId[]" value="<?php echo $get_row['css_id']; ?>"></td>
                        </tr>
                        <!--<tr bgcolor="eeeee1">
                          <td><div align="center">Site Motto</div></td>
                          <td><input type="text" name="txtMotto" class="text"></td>
                        </tr>
                        <tr bgcolor="eeeee1">
                          <td><div align="center">Admin Email</div></td>
                          <td><input type="text" name="txtEmail" class="text"></td>
                        </tr>
                        <tr bgcolor="eeeee1">
                          <td><div align="center">Upload Path</div></td>
                          <td><input type="text" name="txtUpload" class="text"></td>
                        </tr>-->
                        <?php
                    }
                    ?>
                    <tr bgcolor="#eeeee1"> 
                        <td >Current Logo </td>
                        <td ><img src="../images/<?php = $logo_row[css_value]; ?>" width=200 height=50 /></td>
                    </tr>
                    <tr bgcolor="eeeee1">
                        <td width="51%">Header Image</td>
                        <td width="49%">
                            <input type="file" name="header_image" >
                        </td>
                    </tr>
                    <tr bgcolor="eeeee1"> 
                        <td align="center" colspan="2" style="text-align:center"><input type="hidden" name="cansave" value="0">
                            <input type="submit" name="submit" value="Submit" class="button"></td>
                    </tr>

                </table>
            </form>
            <?php
// }
            ?>
        </td></tr>
</table>
</td></tr>
</table>

<?php
require 'include/footer1.php';
?>