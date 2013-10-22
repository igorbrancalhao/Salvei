<?php
/* * *************************************************************************
 * File Name				:adminhome.php
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
<?php
if (strlen($_SESSION["adminuser"]) == 0) {
    echo '<meta http-equiv="refresh" content="0; url=index.php">';
    exit();
}
require 'include/connect.php';
?>
<link rel=stylesheet type=text/css href=style.css>
<?php
require 'include/top.php';
?>
<td width="75%" valign="top"><br>
    <table border="0" width="80%" align="center" cellpadding="5" cellspacing="2">
        <tr>
            <td valign="top"> <strong>Members </strong></td>
        </tr>
        <tr> 
            <td>Total : 
                <?php
                $sql = "select * from members";
                $result = mysql_query($sql);
                echo mysql_num_rows($result);
                ?>
            </td>
        </tr>
        <tr>
            <td> Active : 
                <?php
                $sql = "select * from members where status=0";
                $result = mysql_query($sql);
                echo mysql_num_rows($result);
                ?>
            </td>
        </tr>
        <tr>
            <td> Inactive : 
                <?php
                $sql = "select * from members where status=1";
                $result = mysql_query($sql);
                echo mysql_num_rows($result);
                ?>
            </td>
        </tr>
        <tr>
            <td>Unverified :  <?php
                $sql = "select * from members where verified=0";
                $result = mysql_query($sql);
                echo mysql_num_rows($result);
                ?></td>
        </tr>
        <tr>
            <td> <strong>Total Investment :</strong> 
                <?php
                $sql = "select * from spendmoney";
                $result = mysql_query($sql);
                echo mysql_num_rows($result);
                ?>
            </td>
        </tr>
        <tr>
            <td> <strong>Total Balance : </strong> 
                <?php
                $sql = "select * from balance";
                $result = mysql_query($sql);
                echo mysql_num_rows($result);
                ?>
            </td>
        </tr>
        <tr>
            <td> <strong>Total Commission : </strong> 
                <?php
                $sql = "select * from commission";
                $result = mysql_query($sql);
                echo mysql_num_rows($result);
                ?>
            </td>
        </tr>
        <tr>
            <td> <strong>Withdrawls </strong> </td>
        </tr>
        <tr>
            <td>Total Withdrawl : 
                <?php
                $sql = "select * from withdraw";
                $result = mysql_query($sql);
                echo mysql_num_rows($result);
                ?>
            </td>
        </tr>
        <tr>
            <td> Pending Withdrawl : 
                <?php
                $sql = "select * from withdraw where status=0";
                $result = mysql_query($sql);
                echo mysql_num_rows($result);
                ?>
            </td>
        </tr>
    </table>
</td>
</tr>
</table>
</td></tr></table>

<?php require 'include/dbsettings.php'; ?>
</body>
</html>
