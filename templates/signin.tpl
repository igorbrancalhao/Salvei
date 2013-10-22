<div id="content">

    <div id="login_left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="10"></td>
            </tr>
            <tr>
                <td style="font-family:Tahoma; color:#475F96; font-size:18px; font-weight:bold">Bem vindo ao <?php echo $sitename_fetch['set_value']?><!--<img src="images/wel_img.gif" alt="" width="227" height="10" />--></td>
            </tr>
            <tr>
                <td height="10"></td>
            </tr>
            <tr>
                <td><table width="474" height="264" border="0" cellpadding="0" cellspacing="0" background="images/loginleftbg.gif">
                        <tr>
                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="4"></td>
                                    </tr>
                                    <tr>
                                        <td width="3%">&nbsp;</td>
                                        <td width="97%"><a href="user_reg.php"><img src="images/ready.gif" alt="" width="256" height="16" border="0"/></a></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div align="center"><img src="images/loginline.gif" alt="" width="450" height="3" /></div></td>
                        </tr>
                        <tr>
                            <td width="15">&nbsp;</td>
                            <td width="438" class="banner1">J<span title="">unte-se a milh&otilde;es de pessoas que j&aacute; fazem parte da fam&iacute;lia </span><span title=""><?=$sitename_fetch['set_value']?>.
                                    N&atilde;o se preocupe, temos espa&ccedil;o para mais um.</span></td>
                            <td width="21" class="banner1">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td class="banner1"> Registe-se como um membro do  
                                <?php echo $sitename_fetch['set_value']?> 
                                e aproveite os privil&eacute;gios, incluindo:</td>
                            <td class="banner1">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="6%">&nbsp;</td>
                                        <td width="6%"><img src="images/loginbullet.gif" alt="" width="19" height="19" /></td>
                                        <td width="88%"> <span class="login1txt">Oferta, compra e  pechinchas de todo o brasil</span> </td>
                                    </tr>
                                    <tr>
                                        <td height="8"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><img src="images/loginbullet.gif" alt="" width="19" height="19" /></td>
                                        <td> <span class="login1txt">Lojas de confian&ccedil;a e de Prote&ccedil;&atilde;o ao Comprador </span></td>
                                    </tr>
                                    <tr>
                                        <td height="8"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><img src="images/loginbullet.gif" alt="" width="19" height="19" /></td>
                                        <td><span class="login1txt"> Conecte-se com a comunidade
                                                <?php echo $sitename_fetch['set_value']?> e muito mais! </span><span class="banner1"></span></td>
                                    </tr>
                                </table></td>
                        </tr>

                        <tr>
                            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="65%">&nbsp;</td>
                                        <td width="35%"><a href="user_reg.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image16', '', 'images/registero.gif', 1)"><img src="images/register.gif" name="Image16" width="115" height="25" border="0" id="Image16" /></a></td>
                                    </tr>
                                    <tr>
                                        <td height="4"></td>
                                    </tr>
                                </table></td>
                        </tr>
                    </table></td>
            </tr>
        </table>
    </div>
    <div id="login_right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="7"></td>
            </tr>
            <form method="post" name="form" action="<?php $_SERVER['PHP_SELF']?>">
                <tr>
                    <td><table width="474" height="289" border="0" cellpadding="0" cellspacing="0" background="images/loginbg1.gif">
                            <tr>
                                <td height="15"></td>
                            </tr>
                            <tr>
                                <td><table width="440" height="229" border="0" align="center" cellpadding="0" cellspacing="0" background="images/loginbg2.gif">
                                        <tr>
                                            <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="4%">&nbsp;</td>
                                                        <td width="93%" class="banner1"><span title="">J&aacute; &eacute; cadastrado?&nbsp;Acesse </span><span title=""> agora para comprar,  vender ou para an&aacute;lisar seu hist&oacute;rico! </span></td>
                                                        <td width="3%">&nbsp;</td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                        <?php if(!empty($msg))
                                        {
                                        ?>
                                        <tr>&nbsp;</tr>
                                        <tr><td colspan="4"><font class="errormsg"><b><center><?php echo $msg; ?></center></b></font></td></tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <td width="30">&nbsp;</td>
                                            <td width="80" class="spotlight1txt">Usu&aacute;rio </td>
                                            <td width="160"><label>
                                                    <input type="text" name="txtUsername" maxlength="25" tabindex="1" value="<?php echo $user;?>"/>
                                                </label></td>
                                            <!--<td width="170" class="login3txt"><a href="user" class="login3txt" tabindex="4">Forgot your user ID?</a></td>-->
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td class="spotlight1txt">Senha</td>
                                            <td><label>
                                                    <input type="password" name="txtPassword" maxlength="25" value="" tabindex="2" />
                                                </label></td>
                                            <td class="login3txt"><a href="forgot.php" class="login3txt" tabindex="5">Esquece a sua senha? </a></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <!--<tr>
                                                      <td width="25%">&nbsp;</td>
                                                      <td width="6%"><label>
                                                        <input type="checkbox" name="checkbox" value="checkbox" tabindex="3"/>
                                                      </label></td>
                                                      <td width="69%" class="banner1">Keep me signed in on this computer </td>
                                                    </tr>-->
                                                </table></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <input type="hidden" name="mode" value="check">
                                                    <input type="hidden" value="<?php echo urlencode($url);?>" name="url">
                                                    <input type="hidden" value="<?php echo $item_id; ?>" name="item_id">
                                                    <tr>
                                                        <td width="70%">&nbsp;</td>
                                                        <td width="30%">
                                                            <input type="image" src="images/signin.gif" name="Image17" width="83" height="27" border="0" id="Image17" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image17', '', 'images/signino.gif', 1)" tabindex="6"/></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                </tr>
            </form>
        </table>
    </div>
</div>
<script language="JavaScript">

    function focus1()
    {
        document.SignInForm.txtCode.focus();
    }
</script>