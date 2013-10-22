<?php
/* * *************************************************************************
 * File Name				:adduser.php
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
?>
<html>
    <head>
        <title>Admin</title>
        <?php
        require 'include/connect.php';
        $mode = $_GET['mode'];
        $userid = $_GET['id'];
        if ($mode == 'edit') {
            $gresult = mysql_query("select * from user_registration where user_id=$userid");
            $grow = mysql_fetch_array($gresult);
        }
        $name = $_POST['cboStyle'];
        /* $style_result=mysql_query("select * from style where name='two'");
          $style_row=mysql_fetch_array($style_result);
          $font=$style_row['font'];
          $text=$style_row['textbox'];
          $error=$style_row['error_color'];
          $button=$style_row['button'];
          $size=$style_row['font_size'];
          $bg=$style_row['bgcolor']; */
        $cansave = $_POST['cansave'];
        $member_type = $_POST['member_type'];
        if ($cansave == 1) {
            $username = $_POST['txtUname'];
            $pass = $_POST['txtPass'];
            $confirm = $_POST['txtConfirm'];
            $email = $_POST['txtEmail'];
            $city = $_POST['txtCity'];
            $country = $_POST['cboCountry'];
            $state = $_POST['cboState'];
            $date = date('Y-m-d');

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $address = $_POST['address'];
            $pincode = $_POST['pincode'];
            $primary = $_POST['primary'];
            $primary1 = $_POST['primary1'];
            $primary2 = $_POST['primary2'];
            $secondary = $_POST['secondary'];
            $secondary1 = $_POST['secondary1'];
            $password = $_POST['password'];
            $pvt_per = $_POST['permission'];

//------------validatating variables--------------------------
            if ($firstname == "")
                $fnflag = 1;
            if ($lastname == "")
                $lnflag = 1;
            if ($address == "")
                $addflag = 1;
            /* if($pincode=="")
              $pinflag=1; */
            if ($primary == "" or $primary1 == "" or $primary2 == "")
                $homephoneflag = 1;
            if ($secondary == "" or $secondary1 == "")
                $workphoneflag == 1;
//if($password=="")
//$passflag=1;



            if ($username == "")
                $uflag = 1;
            /* if($pass=="")
              $pflag=1;
              if($confirm=="")
              $cflag=1; */
            $a = strcmp($pass, $confirm);
            if ($a != 0) {
                $pcflag = 1;
                $pmessage = "Please re-enter your password correctly";
            }
            if ($email == "")
                $eflag = 1;
            if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
                $evflag = 1;
                $emessage = "Email invalid";
            }
            if ($city == "")
                $ctflag = 1;
            /* if($country=="")
              $coflag=1;
              if($state=="")
              $stflag=1; */
            if ($mode == 'edit') {
                if ($uflag != 1 && $eflag != 1 && $evflag != 1 && $ctflag != 1 && $fnflag != 1 && $lnflag != 1 && $addflag != 1 && $homephoneflag != 1 && $workphoneflag != 1 && $passflag != 1) {
                    $homephone = $primary . "-" . $primary1 . "-" . $primary2;
                    $workphone = $secondary . "-" . $secondary1;
                    $up_sql = "update user_registration set user_name='$username', member_account='$member_type' ,email='$email',city='$city',country='$country',";
                    $up_sql.="first_name='$firstname', last_name='$lastname', address='$address', pin_code='$pincode',";
                    $up_sql.=" home_phone='$homephone' , work_phone='$workphone' , sell_permission='$pvt_per' where user_id=$userid ";
                    $up_exe = mysql_query($up_sql);
                    $up_flag = 1;

                    echo '<meta http-equiv="refresh" contents="0;url=user.php">';
                } else
                    $message = "Please fill in the fields marked in red";
            }
            else {
                if ($uflag != 1 && $pflag != 1 && $pcflag != 1 && $eflag != 1 && $evflag != 1 && $ctflag != 1 && $coflag != 1 && $stflag != 1) {
                    $sql = "insert into user_registration (user_name,password,email,city,state,country,joined,verify,status) values('$username','$pass','$email','$city',$state,$country,'$date','yes','active')";
                    $result = mysql_query($sql);
                    if ($result)
                        $message = "user added sucessfully";
                    else
                        $message = "Sorry, user registration failed";
                } else
                    $message = "Please fill in the fields marked in red";
            }
        }
        ?>

  <!--  <tr>
    <td width="15%" rowspan="2"><img src="images/spacer.gif" width="88" height="48"></td>
    <td width="25%" rowspan="2"><img src="images/spacer.gif" width="130" height="48"></td>
    <td width="10%"><div align="center"><a href="home.php"><img src="images/frontpage.png" width="48" height="48" border="0"></a></div></td>
    <td width="10%"><div align="center"><a href="user.php"><img src="images/MailerConfig.png" width="48" height="48" border="0"></a></div></td>
    <td width="10%"><div align="center"><a href="templates.php"><img src="images/template.png" width="48" height="48" border="0"></a></div></td>
    <td width="10%"><div align="center"><a href="site.php"><img src="images/web.png" width="48" height="48" border="0"></a></div></td>
    <td width="10%"><div align="center"><a href="cms.php"><img src="images/module.png" width="48" height="48" border="0"></a></div></td>
    <td width="10%"><div align="center"><a href="help.php"><img src="images/temoignages.png" width="48" height="48" border="0"></a></div></td>
  </tr>
  <tr>
    <td><div align="center"><strong><a href="home.php" style="text-decoration:none"  id="link">Home</a></strong></div></td>
    <td><div align="center"><strong><a href="user.php" style="text-decoration:none" id="link">User</a></strong>
     </div></td>
    <td><div align="center"><strong><a href="templates.php" style="text-decoration:none" id="link">Templates</a></strong></div></td>
    <td><div align="center"><strong><a href="site.php" style="text-decoration:none" id="link">Site </a></strong></div></td>
    <td><div align="center"><strong><a href="cms.php" style="text-decoration:none" id="link">CMS</a></strong><strong></strong></div></td>
    <td><div align="center">
      <p><strong><a href="help.php" style="text-decoration:none" id="link">Help</a></strong></p>
      </div></td>
  </tr> -->
        <?php require 'include/top.php'; ?>
    <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" bgcolor="#cecfc8"><tr><td  colspan="10">
        <center><font size=2 color=red><?php if ($up_flag == 1) echo "Updated Successfully"; ?></font></center></td></tr></table>

        <!--  <tr>
    <td height="4" colspan="8">
        <form name="frm1" method="post">
 Choose Style<select name="cboStyle" onChange="this.form.submit()">
        <option value="one">Select</option>
<?php
$stres = mysql_query("select * from style");
while ($strow = mysql_fetch_array($stres)) {
    echo "<option value=" . $strow['name'] . ">" . $strow['name'] . "</option>";
}
?>
        </select></form></td>
    </tr> -->
<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" bgcolor="#cecfc8"><tr><td>
            <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg"><tr><td>	
                        <form name="frm" method="post" onSubmit="this.cansave.value = 1;
                                return true();">
                            <tr>
                                <td align="left" width="93"><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><img src="images/index_02_03_03_01.jpg" width="93" height="26" alt=""></td>
                                        </tr>
                                        <tr>
                                            <td><a href="user.php"><img src="images/index_02_03_03_02.jpg" width="93" height="70" title="User Management" border="0"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="site.php"><img src="images/index_02_03_03_03.jpg" width="93" height="71" title="General Settings" border="0"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="site.php?page=bid"><img src="images/index_02_03_03_04.jpg" width="93" height="73" title="Bid increment settings" border="0"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="report.php?page=out"><img src="images/index_02_03_03_05.jpg" width="93" height="71" title="DetailReport" border="0"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="store_manager.php"><img src="images/index_02_03_03_06.jpg" width="93" height="70" title="StoreManager" border="0"></a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="bulk_load.php"><img src="images/index_02_03_03_07.jpg" width="93" height="66" title="Bulk Load" border="0"></a></td>
                                        </tr>
                                    </table></td><td align="left">
                                    <table  align="left" cellpadding="5" cellspacing="2" class="border2" width="600">
                                        <tr><td colspan="2" bgcolor="#cccccc" class="txt_users">Edit User Information</td></tr>
                                        <tr bgcolor="eeeee1"><td colspan="2" align="center">
                                                <?php
                                                echo $message;
                                                echo '<br>';
                                                if ($pmessage != '' && $emessage != "") {
                                                    ?>
                                            <li style="list-style-type:disc"><?php = $pmessage ?></li>
                                            <li style="list-style-type:disc"><?php = $emessage ?></li>
                                            <?php
                                        } else {
                                            if ($pmessage)
                                                echo $pmessage . '<br>';
                                            if ($emessage)
                                                echo $emessage;
                                        }
                                        ?>
                                        <?php
                                        if ($mode == 'edit') {
                                            $gresult = mysql_query("select * from user_registration where user_id=$userid");
                                            $grow = mysql_fetch_array($gresult);
                                            $phone_no = explode("-", $grow[home_phone]);
                                            $primary = $phone_no[0];
                                            $primary1 = $phone_no[1];
                                            $primary2 = $phone_no[2];
                                            $mobile_no = explode("-", $grow[work_phone]);
                                            $secondary = $mobile_no[0];
                                            $secondary1 = $mobile_no[1];
                                        }
                                        ?>
                                </td></tr>
                            <tr bgcolor="eeeee1"><td><?php
                                    if ($uflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">Username</font></td>
                                <td><input type="text" name="txtUname" value="<?php
                                    if ($mode == 'edit')
                                        echo $grow['user_name'];
                                    else
                                        echo $username
                                        ?>" style="<?php = $text ?>"></td></tr>
                            <tr bgcolor="eeeee1" ><td><?php
                                    if ($fnflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">First Name</font></td>
                                <td><input type="text" name="firstname" value="<?php
                                    if ($mode == 'edit')
                                        echo $grow['first_name'];
                                    else
                                        echo $firstname
                                        ?>" style="<?php = $text ?>"></td></tr>


                            <tr bgcolor="eeeee1"><td><?php
                                    if ($lnflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">Last Name</font></td>
                                <td><input type="text" name="lastname" value="<?php
                                    if ($mode == 'edit')
                                        echo $grow['last_name'];
                                    else
                                        echo $lasstname
                                        ?>" style="<?php = $text ?>"></td></tr>


                            <tr bgcolor="eeeee1"><td><?php
                                    if ($addflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">Address</font></td>
                                <td><input type="text" name="address" value="<?php
                                    if ($mode == 'edit')
                                        echo $grow['address'];
                                    else
                                        echo $address
                                        ?>" style="<?php = $text ?>"></td></tr>

                            <tr bgcolor="eeeee1"><td><?php
                                    if ($pinflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">Pincode</font></td>
                                <td><input type="text" name="pincode" value="<?php
                                    if ($mode == 'edit')
                                        echo $grow['pin_code'];
                                    else
                                        echo $pincode
                                        ?>" style="<?php = $text ?>"></td></tr>

                            <tr bgcolor="eeeee1"><td><?php
                                    if ($homephoneflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">Phone Number</font></td>
                                <td><input type="text" name="primary" value="<?php = $primary ?>" style="<?php = $text ?>" size="7" maxlength="3">-<input type="text" name="primary1" value="<?php = $primary1 ?>" style="<?php = $text ?>" size="7" maxlength="4">-<input type="text" name="primary2" value="<?php = $primary2 ?>" maxlength="10"></td></tr>

                            <tr bgcolor="eeeee1"><td><?php
                                    if ($workphoneflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">Mobile Phone</font></td>
                                <td><input type="text" name="secondary" value="<?php = $secondary ?>" style="<?php = $text ?>" size="7" maxlength="4">-<input type="text" name="secondary1" value="<?php = $secondary1 ?>" style="<?php = $text ?>" maxlength="10"></td></tr>

<!--	<tr><td><?php
                            if ($passflag == 1)
                                echo '<font color=#ff0000>';
                            else
                                echo '<font color=#000000>';
                            ?>
<font face="<?php = $font; ?>" size="<?php = $size; ?>">Password</font></td>
<td><input type="text" name="password" value="<?php
                            if ($mode == 'edit')
                                echo $grow['password'];
                            else
                                echo $password
                                ?>" style="<?php = $text ?>"></td></tr> -->






                            <tr bgcolor="eeeee1"><td><?php
                                    if ($pflag == 1 || $pcflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <?php
                                    if ($mode != 'edit') {
                                        ?>
                                        <font face="<?php = $font; ?>" size="<?php = $size; ?>">Password</font></td>
                                    <td><input type="password" name="txtPass" style="<?php = $text ?>"></td></tr>
                                <tr bgcolor="eeeee1"><td><?php
                                        if ($cflag == 1 || $pcflag == 1)
                                            echo '<font color=#ff0000>';
                                        else
                                            echo '<font color=#000000>';
                                        ?>
                                        <font face="<?php = $font; ?>" size="<?php = $size; ?>">Confirm password</font></td>
                                    <td><input type="password" name="txtConfirm" style="<?php = $text ?>"></td></tr>
                                <?php
                            }
                            ?>

                            <tr bgcolor="eeeee1"><td><?php
                                    if ($eflag == 1 || $evflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">Email</font></td><td><input type="text" name="txtEmail" value="<?php
                                    if ($mode == 'edit')
                                        echo $grow['email'];
                                    else
                                        echo $email
                                        ?>" style="<?php = $text ?>"></td></tr>
                            <tr bgcolor="eeeee1"><td><?php
                                    if ($ctflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">City</font></td><td><input type="text" name="txtCity" value="<?php
                                    if ($mode == 'edit')
                                        echo $grow['city'];
                                    else
                                        echo $city
                                        ?>" style="<?php = $text ?>"></td></tr>
                            <tr bgcolor="eeeee1"><td><?php
                                    if ($coflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">Country</font></td>
                                <td><select name="cboCountry" onChange="Choosestate()" style="font-family:<?php = $font ?>; font-size:12 ">
                                        <option value="">Country</option>
                                        <?php
                                        $cres = mysql_query("select *from country_master");
                                        while ($crow = mysql_fetch_array($cres)) {
                                            if ($mode == 'edit' && $crow['country_id'] == $grow['country'])
                                                echo '<option value=' . $crow['country_id'] . ' selected>' . $crow['country'] . '</option>';
                                            else
                                            if ($crow['country_id'] == $country)
                                                echo '<option value=' . $crow['country_id'] . ' selected>' . $crow['country'] . '</option>';
                                            else
                                                echo '	<option value=' . $crow['country_id'] . '>' . $crow['country'] . '</option>';
                                        }
                                        ?>
                                    </select></td></tr>
                            <tr bgcolor="eeeee1"><td><?php
                                    if ($stflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?><font face="<?php = $font; ?>" size="<?php = $size; ?>">State</font></td>
                                <td><select name="cboState" style="font-family:<?php = $font ?>;font-size:12">
                                        <option value="">State</option>
                                        <?php
                                        $sres = mysql_query("select *from state_master");
                                        while ($srow = mysql_fetch_array($sres)) {
                                            if ($mode == 'edit' && $srow['state_id'] == $grow['state'])
                                                echo '<option value=' . $srow['state_id'] . ' selected>' . $srow['state'] . '</option>';
                                            if ($srow['state_id'] == $state)
                                                echo '<option value=' . $srow['state_id'] . ' selected>' . $srow['state'] . '</option>';
                                            else
                                                echo '	<option value=' . $srow['state_id'] . '>' . $srow['state'] . '</option>';
                                        }
                                        ?>
                                    </select></td></tr>
                            <tr bgcolor="eeeee1"><td><?php
                                    if ($cflag == 1 || $pcflag == 1)
                                        echo '<font color=#ff0000>';
                                    else
                                        echo '<font color=#000000>';
                                    ?>
                                    <font face="<?php = $font; ?>" size="<?php = $size; ?>">Selling Permission</font></td>
                                <?php $type = $grow['sell_permission']; ?>
                                <td><input type="radio" value="yes" name="permission" <?php if ($type == 'yes') echo "checked" ?>>Yes
                                    <input type="radio" value="no" name="permission" <?php if ($type == 'no') echo "checked" ?>>no
                                </td>
                            </tr>

                            <tr bgcolor="eeeee1"><td align="center" colspan="2">
                                    <input type="hidden" name="cansave" value="0">
                                    <input type="submit" name="submit" class="button" value="<?php
                                           if ($mode == 'edit')
                                               echo 'Update';
                                           else
                                               echo 'Register';
                                           ?>" style="<?php = $button ?>"></td></tr>
            </table></td>
    </tr></form></td></tr></table></td></tr></table>
<tr align="center">
    <td colspan="9"><?php require 'include/footer.php' ?></td></tr>

</table>

</center>
</body>
</html>
<script language="JavaScript">
    function Choosestate() {
//------------------Assigning the selected Country value to a variable-------------------------------------------

        var country;
        country = document.frm.cboCountry.value;
//------------------Emptying the State,City and Suburb Combobox-------------------------------------------
        state = document.frm.cboState;
        len = state.length;
        for (i = 0; i < len; i++) {
            state.remove(state.options[i]);
        }
        if (country != '') {
<?php
//------------------Selecting all State from the Database-------------------------------------------

$sql = "select * from state_master";
$result = mysql_query($sql);

//------------------Declaring array variables and storing the state values into it-------------------------------------------

echo "var countryid = new Array;";
echo "var stateid= new Array;";
echo "var statename= new Array;";
$i = 0;
while ($row = mysql_fetch_array($result)) {
    $sid = $row[0];
    $cid = $row[2];
    $sname = $row[1];
    $sname = addslashes($sname);
    echo "countryid[$i] = '$cid';";
    echo "stateid[$i]= '$sid';";
    echo "statename[$i] = '$sname';";
    $i++;
}
?>
            j = 1;

//------------------Adding State for the selected Country to the Combo box-------------------------------------------


            for (i = 0; i < countryid.length; i++)
            {
                if (countryid[i] == country) {
                    state.options[j] = new Option(statename[i], stateid[i]);
                    j++;
                }
            }
        }
    }

//------------------End of Function -------------------------------------------
</script>