<?php
/* * *************************************************************************
 * File Name				:terms_usingrtf.php
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
require 'include/top.php';
?>
<?php
if (isset($_REQUEST['update1'])) {

    $query = "update terms set term_body='$_REQUEST[htmlcontent]' where term_id='1' ";
    if (mysql_query($query))
        echo "<br><font color='#ff0000'><strong>Registration Detail Updated On Successfully ! </strong></font><br><br>";
}

if (isset($_REQUEST['update2'])) {
    echo $query = "update terms set term_body='$_REQUEST[selling]' where term_id='2' ";
    if (mysql_query($query))
        echo "<br><font color='#ff0000'><strong>Selling Detail Updated On Successfully ! </strong></font><br><br>";
}

if (isset($_REQUEST['update3'])) {
    echo $query = "update terms set term_body='$_REQUEST[buying]' where term_id='3' ";
    if (mysql_query($query))
        echo "<br><font color='#ff0000'><strong>  Buying Detail Updated On Successfully ! </strong></font><br><br>";
}
?>
<html>
    <head>
        <title>Untitled Document</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
    <body>
        <br>
        <table align="center" width="100%" height="35" bgcolor="#FFCF00">
            <tr><td align="center">
                    <a href="terms.php?page=1" id="link3"><strong>Registration Terms</strong></a></td>
                <td align="center">
                    <a href="terms.php?page=2" id="link3"><strong>Selling Terms</strong></a></td>
                <td align="center">
                    <a href="terms.php?page=3" id="link3"><strong>Buying Terms</strong></a></td></tr>
        </table>
        <br><br>
        <?php
        /* if($_REQUEST['page']==1)
          { */
        ?>   
        <?php
        $query = "select * from terms where term_id=1";
        $tab = mysql_query($query);
        if ($row = mysql_fetch_array($tab)) {
            $registration = $row['term_body'];
        }
        ?>

        <form method="post" action="<?php = $_SERVER['PHP_SELF']; ?>" name=form1>
            <table width="80%"  border="0" cellpadding="5" cellspacing="1" class="tablebox" align="center">
                <tr bgcolor="#CCCCCC" class="style1">
                    <td colspan="4">Registration Terms</td>
                <tr >
                    <td><Strong>Registration Terms </strong></td>
                    <td>
                        <?php
                        if ($brow_name == 'netscape' || $brow_name == 'opera' || $brow_name == 'firefox')
                            echo '<textarea name="registration" cols="60" rows="15">' . $registration . '</textarea>';
                        else
                            require 'include/content.php';
                        ?>

<!-- <textarea name="registration" cols=50 rows=10><?php = $registration; ?></textarea> --> </td></tr>
                <input type="hidden" name="term_id" value="1">
                <tr ><td></td><td> 
                        <input type="submit" name="update1" value="Update" class="button" > </td></tr>
            </table>
        </form>

        <?php
        /* }
          if($_REQUEST['page']==2)
          {
          ?>
          <?php
          $query="select * from terms where term_id=2";
          $tab=mysql_query($query);
          if($row=mysql_fetch_array($tab))
          {
          $selling=$row['term_body'];
          }
          ?>
          <form method=post action="<?php=$_SERVER['PHP_SELF'];?>" name=form1>
          <table width="80%"  border="0" cellpadding="5" cellspacing="1" class="tablebox" align="center">
          <tr bgcolor="#CCCCCC" class="style1">
          <td colspan="4">Selling Terms</td>
          <tr ><td><Strong>Selling Terms </strong></td><td>
          <?php
          if($brow_name=='netscape' || $brow_name=='opera' || $brow_name=='firefox') echo '<textarea name="selling" cols="60" rows="15"> $selling;  </textarea>';
          else require 'include/content.php';
          ?>
          <!-- <textarea name="selling" cols=50 rows=10>
          <?php= $selling; ?></textarea> --> </td></tr>
          <input type="hidden" name="term_id" value="2">
          <tr><td>&nbsp;</td><td>
          <input type="submit" name="update2" value="Update" class="button" > </td></tr>
          </table>
          </form>
          <?php
          }
          if($_REQUEST['page']==3)
          {
          ?>
          <?php
          $query="select * from terms where term_id=3";
          $tab=mysql_query($query);
          if($row=mysql_fetch_array($tab))
          {
          $buying=$row['term_body'];
          }
          ?>
          <form method=post action="<?php=$_SERVER['PHP_SELF'];?>" name=form1>
          <table width="80%"  border="0" cellpadding="5" cellspacing="1" class="tablebox" align="center">
          <tr bgcolor="#CCCCCC" class="style1">
          <td colspan="4">Buying Terms</td>
          <tr ><td><Strong>Buying Terms </strong></td>
          <td>
          <!-- <textarea name="buying" cols=50 rows=10><?php= $buying; ?></textarea> -->
          <?php
          if($brow_name=='netscape' || $brow_name=='opera' || $brow_name=='firefox') echo '<textarea name="buying" cols="60" rows="15"> $buying;  </textarea>';
          else require 'include/content.php';
          ?>
          </td></tr>
          <input type="hidden" name="term_id" value="3">
          </form>
          <tr ><td></td><td>
          <input type="submit" name="update3" value="Update" class="button" value="<?php= $submit; ?>"> </td></tr>
          </table>
          <?php
          } */
        ?>

        <br><br>
        <?php require 'include/footer.php'; ?>
    </body>
</html>
