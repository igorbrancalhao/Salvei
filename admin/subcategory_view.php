<?php
/* * *************************************************************************
 * File Name				:subcategory_view.php
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
require 'include/connect.php';

function ret($ssid) {
$ss_sql = "select * from category_master where category_head_id=$ssid";
$sub_res = mysql_query($ss_sql);
while ($cat_row = mysql_fetch_array($sub_res)) {

/*  if($ssid==$cat_row['category_head_id'])
  {
  ?>
  <option value="<?php echo $cat_row['category_id'];?>" selected ><?php echo $cat_row['category_name'];?></option>
  <?php
  }
  else
  { */
?>

<option value="<?php = $cat_row['category_id']; ?>">&nbsp;&nbsp;&nbsp;<?php = $cat_row['category_name']; ?></option>
<?php
//}
$ssid = $cat_row['category_id'];
ret($ssid);
}
}

$btn = $_POST['btn'];
$delete = $_POST['delete_btn'];

$val = $_POST['subcat'];
$v = $_POST['hd_val'];
$tsub = $_POST['txt_sub'];
$hd_val = $_POST['hd'];
if (isset($_POST['edit'])) {
$u = "update category_master set category_name='$tsub' where category_id=$hd_val";
mysql_query($u) or die("Can't update");
}
if ($v == 1) {
$del = "delete from category_master where category_id=$val";
mysql_query($del) or die("Can't delete the record");
}



$get_id = $_REQUEST['id'];
$qry = "select * from category_master where category_id=$get_id";
$rs = mysql_query($qry);
$fetch = mysql_fetch_array($rs);
$qry_sub = "select * from category_master where category_head_id=$get_id";
$rs_sub = mysql_query($qry_sub);
?>

<link href="include/style.css" rel="stylesheet" type="text/css">

<table width="100%" border="0" align="center">
    <tr>
        <td height="142" bgcolor="eeeee1"><table width="100%" border="0" align="center">

                <form name="frm" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   >
                    <tr>
                        <td height="46" colspan="3" bgcolor="#cccccc" class="style5"><strong>Edit Sub Category </strong></td>
                    </tr>
                    <tr>
                        <td width="27%" bgcolor="eeeee1"><span class="smalltxt">Sub Category</span> </td>
                        <td colspan="2" bgcolor="eeeee1"><input name="txtcat" type="text" disabled="disabled" class="smalltxt"  value="<?php = $fetch['category_name'] ?>"/></td>
                    </tr>
                    <tr>
                        <td height="49" bgcolor="eeeee1"><span class="smalltxt">Sub Category Name</span> </td>
                        <td colspan="2" bgcolor="eeeee1"><select name="subcat" class="smalltxt">
                                <option value="0">Select</option>
                                <?php
                                while ($ft = mysql_fetch_array($rs_sub)) {
                                $cid = $ft['category_id'];
                                ?>
                                <option value="<?php = $cid ?> ">
                                    <?php = $ft['category_name'] ?>
                                </option>
                                <?php
                                ret($cid);
                                }
                                ?>
                            </select>               </td>
                    </tr>
                    <tr>
                        <td bgcolor="eeeee1">&nbsp;</td>
                        <td width="10%" bgcolor="eeeee1"><input type="submit" name="btn" value="Modify" /></td>
                        <td width="63%" bgcolor="eeeee1"><input type="button" name="delete_btn" value="Delete" onClick="confirm1();" /></td>
                    </tr>
                    <input type="hidden" name="hd_val" value="0"/>
                </form>
            </table></td>
    </tr>

    <?php
    if ($btn == "Modify") {
    $m = "select * from category_master where category_id=$val";
    $mq = mysql_query($m);
    $f = mysql_fetch_array($mq);
    ?>
    <tr>
        <td bgcolor="eeeee1"><table width="100%" border="0" align="center">
                <form name="frm1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

                    <tr>
                        <td width="35%" height="42" bgcolor="eeeee1" class="smalltxt">Sub Category Name </td>
                        <td width="65%" bgcolor="eeeee1"><input name="txt_sub" type="text" class="smalltxt"  value="<?php = $f['category_name'] ?>"></td>
                    </tr>
                    <tr>
                        <td bgcolor="eeeee1"><input type="hidden" name="hd" value="<?php = $f['category_id'] ?>" ></td>
                        <td bgcolor="eeeee1"><input type="submit" name="edit" value="Edit" ></td>
                    </tr>
                </form>
            </table></td> </tr>
    <?php
    }
    ?>

</table>
<p>&nbsp;</p>


<p>
    <script language="javascript">
        function confirm1()
        {
            var cf;
            cf = confirm("Confirm to delete the record");
            if (cf)
            {
                document.frm.hd_val.value = 1;
            }
            document.frm.submit();
        }
    </script>
</p>
</p>
