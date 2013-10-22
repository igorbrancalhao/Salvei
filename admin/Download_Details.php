<?php
error_reporting(0);
/* header("Content-Type: application/vnd.ms-excel");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); */
$filename = "download1.xls";
header("Content-Type: application/vnd.ms-excel");
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="downloaded.pdf"');
//readfile('original.pdf');
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
session_cache_limiter("must-revalidate");
header('Content-Disposition: attachment; filename="' . $filename . '"');

require 'include/connect.php';

function ret($ssid) {
    $ss_sql = "select * from category_master where category_head_id=$ssid order by category_name";
    $sub_res = mysql_query($ss_sql);
    while ($cat_row = mysql_fetch_array($sub_res)) {
        $ssid = $cat_row[category_id];
        ?>
        <tr><td><?php = $cat_row[category_id] ?></td><td><?php = $cat_row[category_name] ?></td></tr>
        <?php
        $ssid = $cat_row['category_id'];
        ret($ssid);
    }
}

$mode = $_REQUEST['mode'];

if ($mode == 'cat') {
    $sql = "select * from category_master where category_head_id='o'";
    $sqlqry = mysql_query($sql);
    $sqlnumrows = mysql_num_rows($sqlqry);
}
if ($mode == 'userid') {
    $sql = "select * from user_registration where verified='yes'";
    $sqlqry = mysql_query($sql);
    $sqlnumrows = mysql_num_rows($sqlqry);
}
if ($sqlnumrows <= 0) {
    echo "No Records Found";
} else {
    if ($mode == "cat") {
        ?>
        <table border="1" cellpadding="5" cellspacing="2">
            <tr > 
                <td align="center" colspan="2" bgcolor="#cccccc"><b>Categories List</b></td>

            </tr>
            <tr > 
                <td align="center" bgcolor="#cccccc"><b>Category Id</b></td>
                <td align="center" bgcolor="#cccccc"><b>Category Name</b></td>
            </tr>
            <?php
            while ($row = mysql_fetch_array($sqlqry)) {
                ?>
                <tr> 
                    <td ><?php echo $row['category_id']; ?></td><td><?php echo $row['category_name']; ?></td></tr>
                <?php
                $ssid = $row['category_id'];
                ret($ssid);
                ?>

                <tr><td bgcolor="#CCCCCC" colspan="2"></td></tr>						  


                <?php
            }
            ?>
        </table>
        <?php
    }

    if ($mode == "userid") {
        ?>
        <table border="1" cellpadding="5" cellspacing="2">
            <tr > 
                <td align="center" colspan="3"  bgcolor="#CCCCCC"><b>User Ids</b></td></tr>
            <tr> 
                <td align="center"  bgcolor="#CCCCCC"><b>User Id</b></td>
                <td align="center"  bgcolor="#CCCCCC"><b>Username</b></td>
                <td align="center"  bgcolor="#CCCCCC"><b>Email Id</b></td>
            </tr>
            <?php
            while ($row = mysql_fetch_array($sqlqry)) {
                ?>
                <tr> 
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>       
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    ?>

    <?php
}
?>