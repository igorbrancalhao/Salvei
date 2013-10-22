<?php
require 'include/connect.php';
$sql_select = "select * from placing_item_bid";
$sqlqry_select = mysql_query($sql_select);
?>
<table border=1>
    <tr><td>Item Id</td><td>Selling Method</td><td>Status</td><td>Bidstarting Date</td><td>Expiry Date</td><td>Start Delay</td></tr>
    <?php
    while ($fetch = mysql_fetch_array($sqlqry_select)) {
//mysql_field_name(
        ?>
        <tr><td><?php = $fetch['item_id']; ?></td><td><?php = $fetch['selling_method']; ?></td><td><?php = $fetch['status'] ?></td><td><?php = $fetch['bid_starting_date'] ?></td><td><?php = $fetch['expire_date']; ?></td><td><?php = $fetch['start_delay']; ?></td></tr>
        <?php
    }
    ?>
</tr></table>