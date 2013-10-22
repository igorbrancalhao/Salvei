<?php
error_reporting(0);
require 'include/connect.php';
$sub_id = $_GET['id'];
?>

<select id="cm1" name="cm1" size="8" style="width:184px" onClick="changeMenu(this.value, 2);" >
    <!--<option>---------------------------------------</option>-->
    <?php
    $sub_count = 0;
    $sub = "select * from category_master where category_head_id=" . $sub_id . " order by category_name";
    $sub_res = mysql_query($sub);
    $tot_sub = mysql_num_rows($sub_res);
    while ($sub_rec = mysql_fetch_array($sub_res)) {
        ?>
        <option value="<?php echo $sub_rec['category_id']; ?>"><?php echo $sub_rec['category_name']; ?></option>
        <?php
    }
    //$sub_count=$sub_count+1;

    foreach ($id as $category_id) {
        $main_sql = "select * from category_master where category_id=$category_id";
        $main_qry = mysql_query($main_sql);
        $main_row = mysql_fetch_array($main_qry);
        ?>
        <option value="<?php echo $main_row['category_id']; ?>"><?php echo $main_row['category_name']; ?></option>

        <?php
    }     //echo $sub_rec[category_name];
    foreach ($id1 as $category_id) {
        $sub_sql1 = "select * from category_master where category_id=$category_id";
        $sub_qry1 = mysql_query($sub_sql1);
        $sub_row1 = mysql_fetch_array($sub_qry1);
        ?>
        <option value="<?php echo $sub_row1['category_id']; ?>"><?php echo $sub_row1['category_name']; ?></option>
        <?php
    }
    foreach ($id2 as $category_id) {
        $sub_sql2 = "select * from category_master where category_id=$category_id";
        $sub_qry2 = mysql_query($sub_sql2);
        $sub_row2 = mysql_fetch_array($sub_qry2);
        ?>
        <option value="<?php echo $sub_row2['category_id']; ?>"><?php echo $sub_row2['category_name']; ?></option>
        <?php
    }
    foreach ($id3 as $category_id) {
        $sub_sql3 = "select * from category_master where category_id=$category_id";
        $sub_qry3 = mysql_query($sub_sql3);
        $sub_row3 = mysql_fetch_array($sub_qry3);
        ?>
        <option value="<?php echo $sub_row3['category_id']; ?>"><?php echo $sub_row3['category_name']; ?></option>
        <?php
    }
    foreach ($id4 as $category_id) {
        $sub_sql4 = "select * from category_master where category_id=$category_id";
        $sub_qry4 = mysql_query($sub_sql4);
        $sub_row4 = mysql_fetch_array($sub_qry4);
        ?>
        <option value="<?php echo $sub_row4['category_id']; ?>"><?php echo $sub_row4[category_name]; ?></option>				
        <?php
    }
    foreach ($id5 as $category_id) {
        $sub_sql5 = "select * from category_master where category_id=$category_id";
        $sub_qry5 = mysql_query($sub_sql5);
        $sub_row5 = mysql_fetch_array($sub_qry5);
        ?>
        <option value="<?php echo $sub_row5['category_id']; ?>"><?php echo $sub_row5[category_name]; ?></option>
        <?php
    }
    ?>


</select>


