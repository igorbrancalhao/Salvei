<?php
/* * *************************************************************************
 * File Name				bulk_loadold.php
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
    .style3 {
        color: #666666; font-size: 11px; font-family:Arial, Helvetica,sans-serif
    }
    -->
</style></head>

<?php
require 'include/connect.php';
if ($_POST[flag]) {
    $chkfile = $_POST['chkfield'];
    $Table_name = $_POST['txtTabname'];
    $file_type = $_FILES['file_name']['type'];
    if (!empty($Table_name)) {
        $csv_file = $_FILES['file_name']['name'];
        if (!empty($csv_file)) {
            if ($file_type == 'application/octet-stream') {
                $row = 1;

                // upload the csv file 
                echo $uploaddir = getcwd();
                $updir = explode('/', $uploaddir);
                echo $count = count($updir) - 1;
                for ($i = 0; $i < $count; $i++) {
                    $up_dir.=$updir[$i] . "/";
                }
                $uploaddir = rtrim($up_dir, "/");
                $uploadfile = "$uploaddir" . "/images/" . "$csv_file";
                if (move_uploaded_file($_FILES['file_name']['tmp_name'], $uploadfile)) {
                    $handle = fopen("$uploadfile", "r");
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $num = count($data);
                        // echo "<br />"."row".$row;
                        // echo "<p> $num fields in line $row: <br /></p>\n";
                        $chkfile = "yes";
                        if ($chkfile == 'yes') {
                            if ($row == 1) {
                                $sql = "insert into $Table_name(";
                                for ($c = 0; $c < $num - 1; $c++) {
                                    $sql = "$sql" . "$data[$c] , ";
                                }
                                $sql = rtrim($sql, " ,");
                                $sql = $sql . ") values (";
                            } else if ($row >= 2) {
                                $sql_value = "";
                                for ($c = 0; $c < $num - 1; $c++) {
                                    if ($c == 14 or $c == 21) {
                                        $splt = $data[$c];
                                        $splt = explode("/", $splt);
                                        $day = $splt[0];
                                        $month = $splt[1];
                                        $year = $splt[2];
                                        $date = "$year" . ":" . "$month" . ":" . "$day";
                                        $sql_value = $sql_value . " '$date' ,";
                                    } else {
                                        $sql_value = $sql_value . " '$data[$c]' ,";
                                    }
                                }
                                $sql_value = rtrim("$sql_value", " ,");
                                $ins_sql = "$sql" . "$sql_value" . ") ";
                                $res = mysql_query($ins_sql);
                                if ($res) {
                                    $id = mysql_insert_id();
                                    if ($data[$c] == "yes") {
                                        $fea_sql = "insert into featured_items(item_id,gallery_feature,home_feature,bold,border,highlight) values('$id','Yes','Yes','Yes','Yes','Yes')";
                                        $fea_res = mysql_query($fea_sql);
                                        if ($fea_res)
                                            $msg = "Data Loaded Successfuly";
                                        else
                                            $msg = "Sorry! mismatch in fieldnames or Tablename in database";
                                    }
                                } else
                                    $msg = "Sorry! mismatch in fieldnames or Tablename in database.";
                            }
                        }
                        /*  else
                          {
                          $sql_value="";
                          $sql="insert into $Table_name(user_id,category_id,quantity) values (";
                          for($c=0; $c < $num-1; $c++)
                          {

                          $sql_value=$sql_value." '$data[$c]' ,";
                          //echo $data[$c]."<br />\n";
                          }
                          $sql_value=rtrim($sql_value," ,");
                          $sql="$sql"."$sql_value".") ";
                          $res=mysql_query($sql);
                          if($res)
                          {
                          $id=mysql_insert_id();
                          if($data[$c]=="yes")
                          {
                          echo $fea_sql="insert into featured_items(item_id,gallery_feature,home_feature,bold,border,highlight) values('$id','Yes','Yes','Yes','Yes','Yes')";
                          $fea_res=mysql_query($fea_sql);
                          if($fea_res)
                          $msg="Data Loaded Successfuly";
                          else
                          $msg="Not In Featured List";
                          }
                          }
                          else
                          $msg="Sorry! mismatch in fieldnames or Tablename in database.";
                          } */
                        $row++;
                    }
                    fclose($handle);
                } else
                    $msg = "Sorry";
            } else {
                $msg = "This is not an CSV file. Script terminated";
            }

            // if(move_uploaded_file($_FILES['file_name']['tmp_name'],$uploadfile))
            /* else
              {
              $msg="Problem in file uploading .Try again Later!";
              } */
        } else {
            $msg = "You Must Specify the Filename First!.";
        }
    } else {
        $msg = "You Must Specify the Tablename First";
    }
}
?>
<?php require 'include/top.php'; ?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table>
                <tr><td width="93"><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/index_02_03_03_01.jpg" width="93" height="26" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href="user.php"><img src="images/index_02_03_03_02.jpg" width="93" height="70" alt="" border="0" title="UserManagement"></a></td>
                            </tr>
                            <tr>
                                <td><a href="site.php"><img src="images/index_02_03_03_03.jpg" width="93" height="71" alt="" border="0" title="GeneralSettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href="site.php?page=style"><img src="images/index_02_03_03_04.jpg" width="93" height="73" alt="" border="0" title="StyleSettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href="report.php?page=out"><img src="images/index_02_03_03_05.jpg" width="93" height="71" alt="" border="0" title="DetailReport"></a></td>
                            </tr>
                            <tr>
                                <td><a href="store_manager.php"><img src="images/index_02_03_03_06.jpg" width="93" height="70" alt="" border="0" title="StoreManager"></a></td>
                            </tr>
                            <tr>
                                <td><a href="bulk_load.php"><img src="images/index_02_03_03_07.jpg" width="93" height="66" alt="" border="0" title="BulkLoader"></a></td>
                            </tr>
                        </table></td><td width=793>
                        <table width="98%" height=250 border="0" cellspacing="2" cellpadding="5" class="border2">
                            <form action="bulk_load.php" method="post" enctype="multipart/form-data">
                                <tr bgcolor="#CCCCCC" class="style1">
                                    <td align="left" colspan="2" class="txt_users">
                                        Bulk Loader
                                    </td>
                                </tr>
                                <?php
                                if (!empty($msg)) {
                                    ?>
                                    <tr><td colspan="2" align="center" bgcolor="#eeeee1"><font size="2" color="red"><?php = $msg; ?></font></td></tr>
                                    <?php
                                }
                                ?>

                                <tr bgcolor="#eeeee1"><td align="left" colspan="2">Select CSV file from your local computer </td>
                                </tr>
                                <!-- <tr><td align="right">Table Name: </td>
                                <td align="left"><input type="text" name="txtTabname" value="<?php = $Table_name ?>"></td></tr> -->
                                <input type="hidden" name="txtTabname" value="placing_item_bid">
                                <tr bgcolor="#eeeee1"><td align="right">CSV File: </td>
                                    <td align="left"><input type="file" name="file_name"></td></tr>
                                <tr bgcolor="#eeeee1"><td>&nbsp;</td><td align="left">
                                        <a href="#" id="dislink" onClick="window.open('../images/example_csv_file_format.csv', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')"><font color=red>View CSV File Format </font></a>
                                    </td></tr>
                                    <!--  <tr><td align="center">Use first row as fields name:  </td>
                                    <td><input type="checkbox" name=chkfield value=yes></tr> -->
                                <tr bgcolor="#eeeee1"><td colspan="2"><font size="2" color="#FF0000">Note that if you have mismatch in fieldnames or Tablename in database the Loading data will be errors!.</font></td></tr>
                                <tr bgcolor="#eeeee1"><td colspan="2" align="center">
                                        <input type="hidden" value="1" name=flag>
                                        <input type="submit" value="Load Data">
                                    </td></tr>
                            </form>
                        </table></td></tr></table></td></tr></table>

<?php require 'include/footer.php'; ?>
</center>
</body>
</html>
