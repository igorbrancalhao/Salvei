<?php
/***************************************************************************
*File Name				:about_us.php
*File Created			:Wednesday, June 21, 2006
* File Last Modified	:Wednesday, June 21, 2006
* Copyright			:(C) 2001 AJ Square Inc
* Email				:licence@ajsquare.net
* Software Language	:PHP
* Version Created		:V 4.3.2
* Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
* Modified By			:B.Reena
* $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
***************************************************************************/
/****************************************************************************

*      Licence Agreement: 

*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.

*****************************************************************************/
?>
<table width="958" border="0" cellpadding="0" cellspacing="0" align="center" >
    <tr>
        <td background="images/contentbg1.jpg" height="25"><font class="detail3txt"><div align="left">&nbsp;&nbsp;Help</div></b></font></td></tr>
    <tr>
        <td>
            <table width="958" border="0" cellpadding="0" cellspacing="0" align="center" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                <tr>
                    <td valign="top">
                        <table border="0" align="center" cellpadding="3" cellspacing="0" width="100%">
                            <tr><td valign="top">

                                    <?php

                                    $query="select * from faq";
                                    $result=mysql_query($query);

                                    ?>

                                    <table border="0" align="center" cellpadding="5" cellspacing="2" width="97%">
                                        <?php
                                        $i=1;
                                        while($row=mysql_fetch_array($result))
                                        {

                                        ?>
                                        <tr><td><a href="#answer<?php=$i?>" class="detail7txt"><b><?php=$row['question'];?></b></a></td></tr>
                                        <?php
                                        $i+=1;
                                        }

                                        ?>
                                        <?php
                                        $i=1;
                                        $query="select * from faq";
                                        $result=mysql_query($query);
                                        while($row=mysql_fetch_array($result))
                                        {
                                        ?>
                                        <tr><td class="detail7txt"><div id="top"><a name="answer<?php=$i?>" id="answer<?php=$i?>" class="detail7txt"><?php=$row['answer'];?></a></td></tr>
                                        <tr><td align="right"><a href="#top"><img src="images/up.gif" border="0" height="20" width="20"></a></td></td></tr>
                                        <?php
                                        $i+=1;
                                        }
                                        ?>
                                    </table>
                                </td></tr>
                        </table>
                    </td></tr>
            </table></td></tr>
</table>


