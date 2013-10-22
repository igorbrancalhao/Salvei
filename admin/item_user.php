<?php
session_start();
require 'include/connect.php';
require 'include/top.php';
?>
<?php
$cansave = $_POST['cansave'];
if ($cansave == 1) {
    $_SESSION[users_id] = $_POST['user'];
    echo '<meta http-equiv="refresh" content="0; url=choose_sell_format.php">';
}
?>
<table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
    <tr><td>
            <table border="0" align="center" cellpadding="0" cellspacing="2" width="760" bgcolor="#E8E8E8" height="100">
                <tr>
                    <td>
                        <table border="0" align="center" cellpadding="0" cellspacing="2" width="70%" bgcolor="#E8E8E8" height="100">
                            <tr><td colspan="2" class="txt_users" height=24><center><br />Add Item<br><br></center></td></tr>
                <form name="f1" action="item_user.php" method="post">
                    <tr>
                        <td align="center">
                            Select a User for Adding the Item
                        </td>
                        <td align="left">
                            <select name="user">
                                <option value="0">Select </option>
                                <?php
                                /* $block=mysql_query("select * from blocked_ip");
                                  $block_row=mysql_num_rows($block);
                                  if($block_row>=1)
                                  $user=mysql_query("select * from user_registration a,blocked_ip b where a.status='Active' and a.verified='yes' and a.user_id!=b.userid");
                                  else */
                                $user = mysql_query("select * from user_registration where status='Active' and verified='yes'");
//$user=mysql_query("select * from user_registration where status='Active'");
                                while ($user_row = mysql_fetch_array($user)) {
                                    ?>
                                    <option value="<?php = $user_row['user_id']; ?>"><?php = $user_row['user_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="hidden" name="cansave" value="0" />
                            <input type="submit" name="submit" class="button" value="Submit" onclick="return validate();" />
                        </td></tr>
                </form>
            </table></td></tr>
</table></td>
</tr></table>
<?php
require 'include/footer1.php';
?>
<script language="javascript">
    function validate()
    {
        if (f1.user.value == 0)
        {
            alert("Please Select a User");
            f1.user.focus();
            return false;
        }
        f1.cansave.value = 1;
        return true;
    }

</script>