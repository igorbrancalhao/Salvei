<?php
/***************************************************************************
*File Name				:verify.tpl
*File Created				:Wednesday, June 21, 2006
* File Last Modified			:Wednesday, June 21, 2006
* Copyright				:(C) 2001 AJ Square Inc
* Email				:licence@ajsquare.net
* Software Language			:PHP
* Version Created			:V 4.3.2
* Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
* $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
*
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
<table width="962" border="0" cellpadding="5" cellspacing="0" align="center">
    <?php
    if($canValidate==1) 
    { 
    $userid=$_POST['userid'];
    $vcode=trim($_POST['txtVcode']);
    $sql="select * from user_registration where user_id=$userid";
    $result=mysql_query($sql);
    if(mysql_num_rows($result) > 0) 
    {
    $row=mysql_fetch_array($result);
    if($row['veri_code']==$vcode) 
    {
    $up_query="update user_registration set verified='yes' where user_id=$userid";
    $up_result=mysql_query($up_query);
    $status="<table align=center width='75%'><tr><td align=center class=errormsg>Thank you, Your Account has been verified.<br><br>";
    $status.="<font class=errormsg size=+1 >You can login and access the resources...</font></td></tr></table>";
    }
    else
    {
    $status="<table align=center width='75%'><tr><td align=center class=errormsg>Sorry, Invalid Verification Code</td></tr></table>";
    }
    }

    }
    ?>
    <tr><td>
            <table width="958" border="0" cellpadding="0" cellspacing="0" align="center">
                <tr>
                    <td background="images/contentbg1.jpg" height="25"><font class="detail3txt"><div align="left">&nbsp;&nbsp;Registration :: Verify your account </div></font></td></tr>
                <tr><td colspan="2" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"> 
                        <table cellpadding="5" cellspacing="2"  width=100%> 
                            <tr><td>
                                    <br />
                                    <br />
                                    <table border=0 cellpadding=5 cellspacing=2 width=75% align="center">
                                        <form name="frmValidate" action="verify.php" method="post" onSubmit="this.canValidate.value = 1;
                                                return true;">
                                            <tr>
                                                <td align="center" colspan="2" class="detail9txt">Verify Your Account</td></tr>
                                            <?php If(!empty($status))
                                            {
                                            ?>
                                            <tr><td colspan="2">
                                                    <?php= $status; ?>
                                                </td></tr>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <tr> 
                                                <td width="49%" class="header_text">Please enter the code sent you below to verify your account</td>
                                                <td width="51%"  align="left"><input type="text" name="txtVcode"  class="txtmid"></td>
                                            </tr>
                                            <tr> 
                                                <td colspan="2" align="center"><input type="hidden" name="userid" value="<?php=$userid?>"> 
                                                    <input type="hidden" name="canValidate" value="0"> 
                                                    <input type="submit" name="btn_Vaildate" value="Validate" class="searchbutton">
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </form>
                                    </table>
                                </td></tr></table>
                    </td></tr></table>
        </td></tr></table>