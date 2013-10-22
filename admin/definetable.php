<?php
/* * *************************************************************************
 * File Name				:definetable.php
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
$catname = $_SESSION['catname'];
$cat_id = $_SESSION['cat_id'];

/* * *************************************************************************
 *                               
 *                            -------------------
 *   begin                : Saturday, September 19, 2005
 *   copyright            : (C) 2005 AJ Square Inc
 *   email                : support@ajsquare.com
 *
 *  
 *
 * ************************************************************************* */

/* * *************************************************************************
 *
 *   You cannot redistribute this software and/or modify
 *   it.All rights are reserved for AJ Square Inc.
 *
 * ************************************************************************* */
require 'include/connect.php';
require 'include/top.php';
?>

<?php
if (isset($_POST['btnAdd'])) {
$field = $_POST['txtField'];
$dtype = $_POST['cboDtype'];
$ftype = $_POST['cboFtype'];
$length = $_POST['txtLength'];
$tablename = $catname;
$create_query = "create table $tablename(tableid int(11) auto_increment primary key,item_id int(11) null default '0',";
for ($i = 0;
$i < count($field);
$i++) {
$create_query.="$field[$i] $dtype[$i] ($length[$i]) null,";
}
$create_query = rtrim($create_query, ", ");
$create_query.=" )";
//   echo $create_query;
$create_result = mysql_query($create_query);

/* $ins_query="insert into category_master(category_name,category_id,category_head_id) values('$catname',$region,0)";
  $ins_result=mysql_query($ins_query);
  $cat_head=mysql_insert_id($conn); */
if ($create_result) {
$cat_ins_sql = "insert into category_master(category_name,category_head_id,custom_cat) values('$catname',0,'1')";
$cat_ins_res = mysql_query($cat_ins_sql);
if ($cat_ins_res) {
//			$err_mess="Category $category Sucessfully Added";
$cat_id = mysql_insert_id();
$filepath = "templates/" . "$catname" . ".tpl";
$f = fopen("../" . $filepath, "w");
/* fwrite($f,"<table border=0 align=left width=100% cellpadding=5 cellspacing=2 class=box>\n");
  fwrite($f,"<form name='frm".$catname."' method=post action='<?php ship_detail.php?>'>\n"); */
for ($i = 0;
$i < count($field);
$i++) {
if ($ftype[$i] == "textarea") {
/*  fwrite($f,"tr><td><b><font size=2> $field[$i]</font></b></td></tr><tr><td><input type=$ftype[$i] name=$field[$i]></td></tr>\n"); */
$val = '$_SESSION[' . $field[$i] . ']';
fwrite($f, "<tr><td><b><font size=2 class='banner1'>$field[$i]</font></b></td></tr><tr><td><textarea name=$field[$i] cols=15 rows=5><?php=$val?></textarea></td></tr>\n");
} else {
$val = '$_SESSION[' . $field[$i] . ']';
fwrite($f, "<tr><td><b><font size=2 class='banner1'>$field[$i]</font></b></td></tr><tr><td><input type=$ftype[$i] name=$field[$i] value=<?php= $val ?> ></td></tr>\n");
}
}

/* fwrite($f,"<tr><td><input type=submit value=Continue></td></tr>");   
  fwrite($f,"</form>"); */
//fwrite($f,"</table>");  
$ins_query = "insert into cat_slave(category_id,tablename,file_path) values($cat_id,'$tablename','$filepath')";
$ins_result = mysql_query($ins_query);

$cat = $tablename . " and the category " . $catname . " and the corresponding template file is created";

if ($ins_result)
$msg = "CustomField Created Successfuly!";
else
$msg = "Sorry!Problems in Customfield Creation!";
} // if($cat_ins_res)
else
$msg = "Sorry!Problems in Customfield Creation!";
}
}
?>
<?php
if ($msg) {
?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table>
                <tr><td width=93>
                        <table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/links1_01.jpg" width="93" height="26" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href=auction.php><img src="images/links1_02.jpg" width="93" height="70" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=site.php?page=auction><img src="images/links1_03.jpg" width="93" height="71" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=category.php><img src="images/links1_04.jpg" width="93" height="73" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=subcategory.php><img src="images/links1_05.jpg" width="93" height="71" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=custom_category.php><img src="images/links1_06.jpg" width="93" height="70" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=insertion_fee_settings.php><img src="images/links1_07.jpg" width="93" height="66" alt="" border="0"></a></td>
                            </tr>
                        </table></td><td width=793>
                        <table align="center" width="80%" cellpadding="5" cellspacing="2" >
                            <form name="frm1" method="post" action="custom_category.php">
                                <tr><td colspan="5" align="center"><font size="2" color="#FF0000"><b> <?php = $msg; ?> </b> </font> </td></tr>
                                <tr align="center"><td><input type="submit" value=Back class="button"></td></tr>
                            </form>
                        </table></td></tr></table></td></tr></table>
<?php
$msg = "";
require 'include/footer.php';
exit();
}

if (isset($_POST['btn_Create'])) {
$fieldnumber = $_POST['txtFieldno'];
if ($fieldnumber > 15) {
$err_flag = 1;
} else {
?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table>
                <tr><td width=93>
                        <table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/links1_01.jpg" width="93" height="26" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href=auction.php><img src="images/links1_02.jpg" width="93" height="70" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=site.php?page=auction><img src="images/links1_03.jpg" width="93" height="71" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=category.php><img src="images/links1_04.jpg" width="93" height="73" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=subcategory.php><img src="images/links1_05.jpg" width="93" height="71" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=custom_category.php><img src="images/links1_06.jpg" width="93" height="70" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=insertion_fee_settings.php><img src="images/links1_07.jpg" width="93" height="66" alt="" border="0"></a></td>
                            </tr>
                        </table></td><td width=793>
                        <table align="center" width="98%" cellpadding="5" cellspacing="2" class=border2>
                            <form name="frmCategory" method="post" action="definetable.php"> 
                                <tr bgcolor="#cccccc">
                                    <td class="txt_users">S.No</td>
                                    <td class="txt_users">Fieldname</td>
                                    <td class="txt_users">Data Type</td>
                                    <td class="txt_users">Length(Range)</td>
                                    <td class="txt_users">Field Type</td>
                                </tr>
                                <tr><td colspan="5" align="right"  bgcolor="#eeeee7"> <a href="#" id="dislink" onClick="window.open('custom_help.php', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')"><font color=red>Help </font></a></td></tr>
                                <?php
                                for ($i = 1;
                                $i <= $fieldnumber;
                                $i++) {
                                ?>
                                <tr bgcolor="#eeeee7">
                                    <td><?php = $i ?>.</td>
                                    <td><input type="text" name="txtField[]" class="text" onKeyPress="namevalchk(this);" onBlur="namevalchk(this);" onKeyDown="namevalchk(this);" onKeyUp="namevalchk(this);"></td>
                                    <td><select name="cboDtype[]">
                                            <option value="0">Select</option>
                                            <option value="VARCHAR">VARCHAR</option>
                                            <option value="TINYINT">TINYINT</option>
                                            <!--<option value="TEXT">TEXT</option>
                                            <option value="LONGTEXT">LONGTEXT</option>
                                             <option value="DATE">DATE</option>
                                            <option value="DATETIME">DATETIME</option> -->
                                            <option value="INT">INT</option>
                                            <!-- <option value="DECIMAL">DECIMAL</option> -->
                                        </select></td>
                                    <td><input type="text" name="txtLength[]" class="text" onKeyPress="return numbersonly(event);"></td>
                                    <td>
                                        <select name="cboFtype[]" class="cbo">
                                            <option value="0">Select</option>
                                            <option value="text">Textbox</option>
                                            <option value="textarea">Text Area</option>
                                            <!-- <option value="file">File Field</option> -->
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                                <tr bgcolor="#eeeee7"><td colspan="5" align="center"><font color="red">Note:&nbsp;All Fields are Required.</font></td></tr>
                                <tr bgcolor="#eeeee7"><td colspan="5" align="center">
                                        <input type="hidden" name="v" value="<?php = $i; ?>" />	

                                        <input type="submit" name="btnAdd" value=" Add " class="button" onclick="return validate();"></td></tr>
                            </form>
                            <script language="javascript">
                                function numbersonly(e) {
                                    var unicode = e.charCode ? e.charCode : e.keyCode
                                    if (unicode != 8 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
                                        if (unicode < 48 || unicode > 57) //if not a number
                                            return false //disable key press
                                    }
                                }

                                function namevalchk(tag)
                                {
                                    var1 = tag.value; // tval is textbox(element) checking for characters only
                                    s = var1.substr(var1.length - 1, 1);
                                    m = s.charCodeAt(0);
                                    if (!((m >= 97 && m <= 122) || (m >= 65 && m <= 90) || (m == 32) || isNaN(m)))
                                    {
                                        ch = var1.substr(0, var1.length - 1);
                                        tag.value = ch;
                                    }
                                }

                                function validate()
                                {
                                    var coun;
                                    var i;
                                    coun = document.frmCategory.elements.length;
                                    for (i = 0; i <= coun - 3; i = i + 4)
                                    {
                                        if (document.frmCategory.elements[i].value == "")
                                        {
                                            alert("Please Enter the Field Name");
                                            document.frmCategory.elements[i].focus();
                                            return false;
                                        }
                                        if (document.frmCategory.elements[i + 1].value == 0)
                                        {
                                            alert("Please Select Any Data Type");
                                            document.frmCategory.elements[i + 1].focus();
                                            return false;
                                        }
                                        if (document.frmCategory.elements[i + 2].value == "")
                                        {
                                            alert("Please Enter the Length");
                                            document.frmCategory.elements[i + 2].focus();
                                            return false;
                                        }
                                        if (document.frmCategory.elements[i + 3].value == 0)
                                        {
                                            alert("Please Select Any Field Type");
                                            document.frmCategory.elements[i + 3].focus();
                                            return false;
                                        }
                                    }
                                    return true;
                                }
                            </script>
                        </table></td></tr></table></td></tr></table>

<?php
require 'include/footer.php';
?>
<?php
}
if ($type == "add") {
?>
<table align="center" width="80%" cellpadding="5" cellspacing="2" class="tablebox">
    <?php
    if ($err_flag == 1) {
    ?>
    <tr bgcolor="#EFEFE7">
        <td class="style1"  colspan="2" align="center">You are Allowed to Create a Maximum of only 15 Fields</td>
    </tr>
    <tr bgcolor="#EFEFE7">
        <td class="style1"  colspan="2" align="center"><a href="#" onClick="history.go(-1)" id="tablink">Back</a></td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
}
if ($type == "edit") {
$edit_sql = "select * from ";
?>

<?php
}
exit();
}
?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table>
                <tr><td width=93>
                        <table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/links1_01.jpg" width="93" height="26" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href=auction.php><img src="images/links1_02.jpg" width="93" height="70" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=site.php?page=auction><img src="images/links1_03.jpg" width="93" height="71" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=category.php><img src="images/links1_04.jpg" width="93" height="73" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=subcategory.php><img src="images/links1_05.jpg" width="93" height="71" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=custom_category.php><img src="images/links1_06.jpg" width="93" height="70" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href=insertion_fee_settings.php><img src="images/links1_07.jpg" width="93" height="66" alt="" border="0"></a></td>
                            </tr>
                        </table></td><td width=793>
                        <table align="center" width="98%" cellpadding="5" cellspacing="2" class="border2" height=200>
                            <form name="frm" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                                <tr bgcolor="#cccccc">
                                    <td colspan="2" class="txt_users">	Define Structure for the Category <?php = $catname; ?></td> 
                                </tr>
                                <tr bgcolor="#eeeee1">
                                    <td colspan="2">If you like to add other fields for this 
                                        particular category.You can Define a Maximum of 15 user defined Fields.Please Don't Give Space between the Field Name.
                                    </td>
                                </tr>
                                <tr bgcolor="#eeeee1">
                                    <td >Enter the Number of Fields you like to Create</td>
                                    <td><input type="text" name="txtFieldno" class="text" onKeyPress="return numbersonly(event);"></td>
                                </tr>
                                <tr bgcolor="#eeeee1">
                                    <td colspan="2" align="center"><input type="submit" name="btn_Create" class="button" value=" Create " onclick="return val();"></td>
                                </tr>
                            </form>
                        </table>
                    </td></tr></table></td></tr></table>

<?php
require 'include/footer.php';
?>
</body>
<script language="javascript">
    function val()
    {
        if (frm.txtFieldno.value == "")
        {
            alert("Please Enter the Number of Fields");
            frm.txtFieldno.focus();
            return false;
        }
        if (frm.txtFieldno.value > 15)
        {
            alert("Please Enter the Value Less than 15");
            frm.txtFieldno.value = "";
            frm.txtFieldno.focus();
            return false;
        }
        return true;
    }

    function numbersonly(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if (unicode != 8 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
            if (unicode < 48 || unicode > 57) //if not a number
                return false //disable key press
        }
    }
</script>