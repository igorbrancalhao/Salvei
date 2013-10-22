<?php
/* * *************************************************************************
 * File Name				:demo_data.php
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
<html>
    <head>
        <title>Admin</title>
        <link href="include/style.css" rel="stylesheet" type="text/css">
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
    <body background="images/bg.gif" topmargin="0">
    <center>
        <?php
        require 'include/connect.php';
        if ($_POST[flag]) {
            $demo = $_POST[txtdemo];
            if (!empty($demo)) {
                if ($demo == 'demo') {
                    require 'install_demo.php';
                    $msg = "Demo data Loaded Successfuly";
                } else {
                    $msg = "Please confirm addition of demo data by typing 'demo' in the text field.";
                }
            } else {
                $msg = "Please confirm addition of demo data by typing 'demo' in the text field.";
            }
        }
        ?>
        <?php require 'include/top.php'; ?>
        <form action="demo_data.php" method="post">
            <table width="80%"  border="0" cellspacing="2" cellpadding="5" bgcolor="<?php = $bg ?>" class="tablebox">
                <tr bgcolor="#CCCCCC" class="style1"><td align="left" colspan="2">
                        Load Auction Demo Data
                    </td></tr>
                <?php
                if (!empty($msg)) {
                    ?>
                    <tr><td colspan="2" align="center"><font size="2" color="red"><?php = $msg; ?></font></td></tr>
                    <?php
                }
                ?>

                <tr><td align="right">Please Type "demo" to Confirm</td><td align="left"><input type="text" name="txtdemo"></td></tr>
                <tr><td colspan="2" align="center">(Warning:this will reset all auction data!)</td></tr>
                <tr><td colspan="2" align="center">
                        <input type="hidden" value="1" name=flag>
                        <input type="submit" value="Demo Data">
                    </td></tr>
            </table>
        </form>
        <?php require 'include/footer.php'; ?>
    </center>
</body>
</html>
