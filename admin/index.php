<?php
/* * *************************************************************************
 * File Name				:index.php
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
session_start();
error_reporting(0);
?>
<html>
    <head>
        <title>Administra&ccedil;&atilde;o - Setor de uso restrito</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <?php
        require 'include/connect.php';
        $sitename_sql = "select * from admin_settings where set_id='47'";
        $sitename_sqlqry = mysql_query($sitename_sql);
        $sitename_fetch = mysql_fetch_array($sitename_sqlqry);
        $sitename = $sitename_fetch['set_value'];


//Fetching mail header image
        $queryheader = "select * from admin_settings where set_id = 61";
        $tableheader = mysql_query($queryheader);
        $rowheader = mysql_fetch_array($tableheader);
        $mailheader = $rowheader['set_value'];

//Fetching mail footer image
        $queryfooter = "select * from admin_settings where set_id = 62";
        $tablefooter = mysql_query($queryfooter);
        $rowfooter = mysql_fetch_array($tablefooter);
        $mailfooter = $rowfooter['set_value'];

        $cansave = $_POST['cansave'];
        if ($cansave == 1) {
        $name = $_POST['txtName'];
        $pswd = $_POST['txtPswd'];
        $scode = $_POST['txtSeccode'];
        $scod = $_POST['seccode'];

        $sql = "select * from admin where user_name='$name'";
        $res = mysql_query($sql);
        $rows = mysql_num_rows($res);
        if ($rows > 0) {
        $fetch = mysql_fetch_array($res);
        $pass = $fetch['password'];
        $pswd = crypt($pswd, $pass);
        $sql = "select * from admin where user_name='$name' and password='$pswd'";
        $res = mysql_query($sql);
        $num = mysql_num_rows($res);
        if ($num > 0 && $scode == $scod) {
        $_SESSION['adminuser'] = $name;
        /* $_SESSION['username_admin']=$name; */
        $test = rand(0, 10);
        $today = date('Y' . ":" . 'm' . ":" . 'd');
        $username = $test . "admin" . $today;
        $secret = md5($username);
        $vericode = substr($secret, 0, 6);
        $update_code = "update admin set verifycode='$vericode' where admin_id='1'";
        $update_codeqry = mysql_query($update_code);

        $admin_query = "select * from mail_subjects where mail_id=19";
        $admin_table = mysql_query($admin_query);
        if ($admin_row = mysql_fetch_array($admin_table)) {
        $message = $admin_row['mail_message'];
        $subject = $admin_row['mail_subject'];
        $mail_fro = $admin_row['mail_from'];
        }

        $site_query = "select * from admin_settings  where set_id='1'";
        $site_table = mysql_query($site_query);
        $site_row = mysql_fetch_array($site_table);
        $sitename = $site_row['set_value'];

        $ipaddress = $_SERVER['REMOTE_ADDR'];

        $message = str_replace("<site>", $sitename, $message);
        $message = str_replace("<verify>", $vericode, $message);
        $message = str_replace("<imgh>", $mailheader, $message);
        $message = str_replace("<imgf>", $mailfooter, $message);

        $sql_admin = "select * from admin_settings where set_id='3'";
        $sqlqry_admin = mysql_query($sql_admin);
        $sqlfetch_admin = mysql_fetch_array($sqlqry_admin);
        $mail_from = $sqlfetch_admin['set_value'];

        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        $headers .= "From: " . $mail_fro . "\n";
//$mail_from="pashok_80@yahoo.com";
//$mail=mail($mail_from,$subject,$message,$headers); 
        $mail = 1;
        if ($mail) {
        echo '<meta http-equiv="refresh" content="0;url=home.php">';
        exit();
        } else {
        $message = "Problem in sending your mail.Try Login Again.";
        }
        } else {
        if ($num <= 0)
        $message = "Invalid User Name and /or Password";
        else
        $message = "Invaild TuringCode";
        }
        }
        else {
        $message = "Invalid Username";
        }
        }
        ?>
        <style type="text/css">
            @import url(include/admin_login.css);
        </style>
        <script language="javascript" type="text/javascript">
            function setFocus() {
                document.frm.txtName.select();
                document.frm.txtName.focus();
            }
        </script>
    </head>
    <body onLoad="setFocus();">
        <table width="758"  border="0" cellspacing="0" cellpadding="0" align="center" class=border2>
            <tr>
                <td colspan="8"><table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td rowspan="2" bgcolor="#000000">&nbsp;</td>
                            <td rowspan="2" bgcolor="#000000">&nbsp;</td>
                            <td width="185" height="53" background="images/blackbg01.jpg" class="txt_header" style="padding-top:10px"><div align="center">Painel de Controle </div></td>
                        </tr>
                        <tr>
                            <td width="185" height="72" background="images/blackbg02.jpg" style="padding-top:40px; padding-right:20px"></td>
                        </tr>
                    </table></td>
            </tr>
            <tr bgcolor="#F7F7F7"><td colspan="8" align="center">
                    <font face="Arial, Helvetica, sans-serif" style="font-weight:bold"><?php = $message; ?></font>
                </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr bgcolor="#F7F7F7">
                <td align="center">
                    <noscript>
                    <font color="#FF0000"><b><span title="">Seu navegador n&atilde;o est&aacute;  habilitadopara Java.&nbsp;Por favor habilite o Java!</span></b></font>
                    </noscript>	</td>
            </tr>
            <tr bgcolor="#F7F7F7"><td>
                    <div id="ctr" align="center">
                        <div class="login">
                            <div class="login-form"> <strong>Acesso a Administra&ccedil;&atilde;o </strong> 
                                <form action="index.php" method="post" name="frm" onSubmit="return validate();">
                                    <div class="form-block">
                                        <div class="inputlabel">Usu&aacute;rio</div>
                                        <div><input name="txtName" type="text" class="inputbox" />
                                        </div>
                                        <div class="inputlabel">Senha</div>
                                        <div><input name="txtPswd" type="password" class="inputbox" />
                                        </div>
                                        <div class="inputlabel">
                                            <?php
                                            srand();
                                            $tuno = substr(md5(rand(0, 100000)), 0, 5);
                                            ?>	
                                            <img src="<?php = "turing.php?num=$tuno" ?> " ></div>
                                        <input type="hidden" name="seccode" value="<?php = $tuno; ?>">
                                        <div><input name="txtSeccode" type="text" class="inputbox" /></div>
                                        <div align="left"><input type="hidden" name="cansave" value="0"><input type="submit" name="submit" class="button" value="Acessar" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="login-text">
                                <div class="ctr"><img src="images/lock.gif" width="64" height="64" alt="security" /></div>
                                <b><p> <span title="">Bem-vindo!<br>
                                            <br>
                                        </span><span title="">Use um nome de usu&aacute;rio e senha v&aacute;lidos para acessar o console administrativo.</span> </p>
                                </b>    	</div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div id="break"></div>

                    <div class="footer" align="center">
                        <div align="center"></div>
                    </div>
            <tr>
                <td bgcolor="#30302d"><div align="center"><span class="txt_footer">Copyright <?php = date("Y") ?>. Todos os direitos reservados a <?php = $sitename ?></span></div></td>
            </tr>
        </td></tr></table>
</body>
</html>
<script language="JavaScript">
    function validate()
    {
        if (document.frm.txtName.value == "")
        {
            alert("Please enter the username");
            document.frm.txtName.focus();
            return false;
        }
        if (document.frm.txtPswd.value == "")
        {
            alert("Please enter the password");
            document.frm.txtPswd.focus();
            return false;
        }
        document.frm.cansave.value = 1;
        return true;
    }
</script>