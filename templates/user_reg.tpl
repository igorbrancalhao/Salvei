<?php
/***************************************************************************
*File Name				:user_reg.tpl
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
<table width="958" cellpadding="5" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt">
            <div align="left">
                &nbsp;&nbsp;Cadastro de usu&aacute;rio: Preencha as informa&ccedil;&otilde;es a seguir </div>
            </font>
        </td></tr>
    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 
                <tr height=20>
                    <td colspan="2" class="detail9txt" >
                        <b>&nbsp;&nbsp;1.&nbsp;Digite as suas informa&ccedil;&otilde;es pessoais &nbsp;&nbsp;</b>2.&nbsp;Escolha seu nome de usu&aacute;rio e sua senha &nbsp;&nbsp;
                        3.&nbsp; Verifique seu email </td>
                </tr>
                <tr><td>
                        <?php if($err_flag==1)
                        { 
                        ?>
                        <table align="left">
                            <tr><td>&nbsp;</td>
                                <td><font class="errormsg">Os seguintes erros devem ser corrigidos :</font></td>
                            </tr>
                            <?php if(!empty($err_dup_email))
                            {
                            ?>
                            <tr class="detail6txt"><td>&nbsp;</td><td><a href="user_reg.php#txtemail" onclick="sel('txtemail')" class="header_text2">Email Id</a> - <?php echo $err_dup_email; ?></td></tr>
                            <?php 
                            }
                            ?>

                            <?php if(!empty($err_first))
                            {
                            ?>
                            <tr class="detail6txt"><td>&nbsp;</td>
                                <td><a href="user_reg.php#txtfirst" onclick="sel('txtfirst')" class="header_text2">Nome</a> - <?php $err_first; ?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_last))
                            {
                            ?>
                            <tr class="detail6txt"><td>&nbsp;</td>
                                <td><a href="user_reg.php#txtlast" onclick="sel('txtlast')" class="header_text2">Sobre nome </a> - <?php echo $err_last; ?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_add))
                            {
                            ?>
                            <tr class="detail6txt"><td>&nbsp;</td>
                                <td><a href="user_reg.php#txtaddress" onclick="sel('txtaddress')" class="header_text2">Endere&ccedil;o</a> - <?php echo $err_add; ?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_city))
                            {
                            ?>
                            <tr class="detail6txt"><td>&nbsp;</td>
                                <td><a href="user_reg.php#txtcity" onclick="sel('txtcity')" class="header_text2">Cidade</a> - <?php echo $err_city; ?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_state))
                            {
                            ?>
                            <tr class="detail6txt"><td>&nbsp;</td>
                                <td><a href="user_reg.php#txtstate" onclick="sel('txtstate')" class="header_text2">Estado</a> - <?php echo $err_state; ?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_code))
                            {
                            ?>
                            <tr class="detail6txt"><td>&nbsp;</td>
                                <td><a href="user_reg.php#txtzipcode" onclick="sel('txtzipcode')" class="header_text2">CEP </a> - <?php echo $err_code; ?></td>
                            </tr>
                            <?php 
                            }
                            ?>
                            <?php if(!empty($err_country))
                            {
                            ?>
                            <tr class="detail6txt"><td>&nbsp;</td>
                                <td><a href="user_reg.php#cbocountry" onclick="sel('cbocountry')" class="header_text2">Pa&iacute;s</a> - <?php echo $err_country; ?></td>
                            </tr>
                            <?php 
                            }
                            ?>

                            <?php if(!empty($err_primary))
                            {
                            ?>
                            <tr class="detail6txt"><td>&nbsp;</td>
                                <td>
                                    <?php if($err_prime2==1)
                                    {
                                    ?><a href="user_reg.php#txtprimary2" onclick="sel('txtprimary2')" class="header_text2"><?php
                                        }
                                        ?>
                                        <?php if($err_prime1==1)
                                        {
                                        ?>
                                        <a href="user_reg.php#txtprimary1" onclick="sel('txtprimary1')" class="header_text2">
                                            <?php
                                            }
                                            ?>
                                            <?php if($err_prime==1)
                                            {
                                            ?>
                                            <a href="user_reg.php#txtprimary" onclick="sel('txtprimary')" class="header_text2">
                                                <?php
                                                }
                                                ?> Telefone
                                            </a>- <?php echo $err_primary; ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <?php if(!empty($err_secondary))
                                            {
                                            ?>
                                            <tr class="detail6txt"><td>&nbsp;</td>
                                                <td>
                                                    <?php if($err_sec==1)
                                                    {
                                                    ?><a href="user_reg.php#txtsecondary" onclick="sel('txtsecondary')" class="header_text2">
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php if($err_sec1==1)
                                                        {
                                                        ?><a href="user_reg.php#txtsecondary1" onclick="sel('txtsecondary1')" class="header_text2">
                                                            <?php
                                                            }
                                                            ?> Celular
                                                        </a> - <?php echo $err_secondary; ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <?php if(!empty($err_month))
                                            {
                                            ?>
                                            <tr class="detail6txt"><td>&nbsp;</td>
                                                <td><a href="user_reg.php#cbomonth" onclick="sel('cbomonth')" class="header_text2">M&ecirc;s  </a> - <?php echo $err_month; ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <?php if(!empty($err_day))
                                            {
                                            ?>
                                            <tr class="detail6txt"><td>&nbsp;</td>
                                                <td><a href="user_reg.php#cboday" onclick="sel('cboday')" class="header_text2">Dia </a> - <?php echo $err_day; ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <?php if(!empty($err_year))
                                            {
                                            ?>
                                            <tr class="detail6txt"><td>&nbsp;</td>
                                                <td><a href="user_reg.php#txtYear" onclick="sel('txtYear')" class="header_text2">Ano</a> - <?php echo $err_year; ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <?php if(!empty($err_dob))
                                            {
                                            ?>
                                            <tr class="detail6txt"><td>&nbsp;</td>
                                                <td><a href="user_reg.php#txtYear" onclick="sel('txtYear')" class="header_text2">Nascimento</a> - <?php echo $err_dob; ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <?php if(!empty($err_email))
                                            {
                                            ?>
                                            <tr class="detail6txt"><td>&nbsp;</td>
                                                <td><a href="user_reg.php#txtemail" onclick="sel('txtemail')" class="header_text2">Email</a> - <?php echo $err_email; ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <?php if(!empty($err_reemail))
                                            {
                                            ?>
                                            <tr class="detail6txt"><td>&nbsp;</td>
                                                <td><a href="user_reg.php#txtreemail" onclick="sel('txtreemail')" class="header_text2">Repetir o Email </a> - <?php echo $err_reemail; ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <?php if(!empty($err_terms))
                                            {
                                            ?>
                                            <tr class="detail6txt"><td>&nbsp;</td>
                                                <td><a href="user_reg.php#chkterms" onclick="sel('chkterms')" class="header_text2">Aceitar os Termos </a> - <?php echo $err_terms; ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <tr><td colspan="2"><hr noshade class="hr_color" size="1"></td></tr>
                                            </table>
                                            <?php
                                            } 
                                            ?>
                                            </td></tr>
                                            <tr><td width=20% class="dealtxt"> 
                                                    <br>
                                                    Cadastre-se agora para vender ou comprar no site
                                                    <?php echo$_SESSION['site_name']?>. &Eacute; f&aacute;cil e <b> gr&aacute;tis! </b><?phpif($err_flag!=1){?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="errormsg">  Os campos marcados com um asterisco (*) s&atilde;o obrigat&oacute;rios</font><?php}?>
                                                    <br>
                                                </td></tr>
                                            <tr><td>
                                                    <br>
                                                    <form name=reg action="user_reg.php" method=post enctype="multipart/form-data">
                                                        <table width="100%" cellpadding="2" cellspacing="2">
                                                            <tr><td class="detail9txt">
                                                                    <?php if(!empty($err_first))
                                                                    {
                                                                    ?>
                                                                    <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_first ?></font>
                                                                    <br>
                                                                    <b><font size=2 color=red>Nome</font></b>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <b><font size="2">Nome </font><font color="#FF0000">*</font></b>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td width="448" class="detail9txt">
                                                                    <?php if(!empty($err_last))
                                                                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_last ?></font>
 <br>
 <b><font size=2 color=red>Sobre nome </font></b>
 <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?><b><font size="2"> Sobre nome </font></b><font color="#FF0000">*</font>
                                                                    <?php }
                                                                    ?>   </td>
                                                            </tr>
                                                            <tr><td width=396><input type="text" name="txtfirst" class="txtmed" onKeyPress="namevalchk(this);" onBlur="namevalchk(this);" onKeyDown="namevalchk(this);" onKeyUp="namevalchk(this);" maxlength="25"  value=<?php "$first"; ?>></td>
                                                                <td><input type="text" name="txtlast" class="txtmed" onKeyPress="namevalchk(this);" onBlur="namevalchk(this);" onKeyDown="namevalchk(this);" onKeyUp="namevalchk(this);" maxlength="20" value=<?php "$last"; ?>></td></tr>
                                                            <tr><td colspan="2" class="detail9txt"> 
                                                                    <?php if(!empty($err_add))
                                                                    {
                                                                    ?>
                                                                    <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_add ?></font>
                                                                    <br>
                                                                    <b><font color="red" size="2">Endere&ccedil;o</font></b>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?><b><font size="2"> Endere&ccedil;o </font></b><font color="#FF0000">*</font>
                                                                    <?php 
                                                                    }
                                                                    ?></td>
                                                            </tr>
                                                            <tr><td colspan="2">
                                                                    <input name="txtaddress" type="text" value="<?php "$address"; ?>" size="25" />
                                                                </td></tr>

                                                            <tr>
                                                                <td class="detail9txt">
                                                                    <?php if(!empty($err_code))
                                                                    {
                                                                    ?>
                                                                    <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_code ?></font>
                                                                    <br>
                                                                    <b><font size=2 color=red>CEP</font></b>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?><b><font size="2"> CEP </font><font color="#FF0000"> *</font></b>
                                                                    <?php
                                                                    }
                                                                    ?> </td>
                                                                <td class="detail9txt">
                                                                    <?php if(!empty($err_country))
                                                                    {
                                                                    ?>
                                                                    <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_country ?></font>
                                                                    <br>
                                                                    <b><font size=2 color=red>Pa&iacute;s</font></b>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?><b><font size="2"> Pa&iacute;s </font></b><font color="#FF0000">*</font>
                                                                    <?php
                                                                    }
                                                                    ?> </td>
                                                            </tr>


                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="txtzipcode" maxlength="12" class="txtmed" value=<?php "$code"; ?> > </td>
                                                                <td><select name=cbocountry>
                                                                        <option value=0>Selecione</option>
                                                                        <?php 
                                                                        $country_sql="select * from country_master";
                                                                        $country_res=mysql_query($country_sql);
                                                                        while($country_row=mysql_fetch_array($country_res))
                                                                        {
                                                                        if(trim($country_row['country_id'])== trim($country))
                                                                        {
                                                                        ?>
                                                                        <option value="<?php echo $country_row['country_id'] ?>" selected><?php echo $country_row['country']?></option>
                                                                        <?php 
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <option value="<?php echo $country_row['country_id'] ?>"><?php echo $country_row['country']?></option>
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>
                                                                    </select>  </td>
                                                            </tr>
                                                            <tr><td class="detail9txt">
                                                                    <?php if(!empty($err_state))
                                                                    {
                                                                    ?>
                                                                    <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_state ?></font>
                                                                    <br>
                                                                    <b><font color="red" size="2">Estado </font></b>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?><b><font size="2"> Estado</font></b><font color="#FF0000">*</font>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="detail9txt">
                                                                    <?php if(!empty($err_city))
                                                                    {
                                                                    ?>
                                                                    <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_city ?></font>
                                                                    <br>
                                                                    <b><font size=2 color=red>Cidade</font></b>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <b><font size=2>Cidade </font><font color="#FF0000">*</font></b>
                                                                    <?php
                                                                    }
                                                                    ?> </td>
                                                            </tr>

                                                            <tr><td><input type="text" name="txtstate" class="txtmed" onKeyPress="namevalchk(this);" onBlur="namevalchk(this);" onKeyDown="namevalchk(this);" onKeyUp="namevalchk(this);" maxlength="20"  value="<?php echo$state; ?>" >
                                                                </td>
                                                                <td><input type="text" name="txtcity" class="txtmed" onKeyPress="namevalchk(this);" onBlur="namevalchk(this);" onKeyDown="namevalchk(this);" onKeyUp="namevalchk(this);" maxlength="25"  value="<?php echo $city; ?>"></td>
                                                            </tr>
                                                            <tr><td class="detail9txt">
                                                                    <?php if(!empty($err_primary))
                                                                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_primary ?></font>
 <br>
 <b><font color="red" size="2">Telefone Fixo </font></b>
 <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?><b><font size="2"> Telefone Fixo </font><font color="#FF0000">*</font></b> 
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td class="detail9txt">
                                                                    <?php if(!empty($err_secondary))
                                                                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_secondary ; ?></font>
 <br>
              <b><font size=2 color=red>Celular</font></b> 
              <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?><b><font size="2"> Celular </font><font color="#FF0000">*</font></b> 
                                                                    <?php
                                                                    }
                                                                    ?>            </td>
                                                            </tr> 

                                                            <tr><td>(
                                                                    <input type="text" name="txtprimary1" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);"  value="<?php echo $primary1; ?>" maxlength="2" size="2px" style="font-size:12px;font-family:arial;width:40;height:20"> 
                                                                    )&nbsp;-&nbsp;
                                                                    <input type="text" name="txtprimary2" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);"   style="font-size:12px;font-family:arial;width:40;height:20" value="<?php echo $primary2; ?>" maxlength="4" size="4px">&nbsp;-&nbsp;
                                                                    <input type="text" name="txtprimary" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);"  class="txtsmall" value="<?php echo $primary; ?>" maxlength="10" size="10px"></td>
                                                                <td>
                                                                    <input type="text" name="txtsecondary1" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);" style="font-size:12px;font-family:arial;width:40;height:20" value="<?php echo $secondary1; ?>" maxlength="5" size="5px">&nbsp;-&nbsp;<input type="text" name="txtsecondary" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);" class="txtsmall" value="<?php echo $secondary; ?>" maxlength="10" size="10px"></td></tr>
                                                            <!-- change  -->
                                                            <tr><td colspan="6" class="detail9txt">
                                                                    <?php 
                                                                    if(!empty($err_day) or !empty($err_month) or !empty($err_year) or !empty($err_dob))
                                                                    {
                                                                    ?>
                                                                    <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_email ; ?></font>
                                                                    <br>
                                                                    <b><font size=2 color=red>Data de Nascimento</font></b>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <b><font size=2>Data de Nascimento </font><font color="#FF0000">*</font></b>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr><td colspan="6">

                                                                    <select name=cboday>
                                                                        <option value=0> Dia </option>
                                                                        <?php

                                                                        for($i=1;$i<=31;$i++)
                                                                        {
                                                                        if($day==$i)
                                                                        {
                                                                        ?>
                                                                        <option value=<?php echo $i ?> selected>
                                                                                <?php echo $i ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <option value=<?php echo $i ?> >
                                                                            <?php echo $i ?>
                                                                </option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>
                                                            - 
                                                            <select name=cbomonth>
                                                                <option value=0> M�s </option>
                                                                <?php for($i=1;$i<=12;$i++)
                                                                {
                                                                if($month==$i)
                                                                {
                                                                ?>
                                                                <option value=<?php echo $i ?> selected> <?php echo $i ?> </option>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <option value=<?php echo $i ?>> <?php echo $i ?> </option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </select>   
                                                            -
                                                            <input type="text" name="txtYear" onBlur="numchk(this);" onKeyPress="numchk(this);" onKeyDown="numchk(this);" onKeyUp="numchk(this);" style="font-size:12px;font-family:arial;width:40;height:20" maxlength=4 value="<?php echo $year ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="detail9txt">Para se inscerver no  <?php echo$_SESSION['site_name'];?> &eacute; necess&aacute;rio ter mais que 18 anos.</td>
                                                    </tr>

                                                    <!-- change -->
                                                    <tr><td colspan="6"><hr noshade class="hr_color" size="1"></td></tr>  
                                                    <tr>
                                                        <td colspan="6"><b><font size="2" color="green">Importante:</font></b>&nbsp;&nbsp;<font size="2" class="detail9txt">
                                                            Coloque um email v&aacute;lido para continuar o cadastro.</font><br>
                                                            <br></td></tr>

                                                    <tr><td colspan="6" class="detail9txt">
                                                            <?php if(!empty($err_email))
                                                            {
                                                            ?>
                                                            <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_email ; ?></font>
                                                            <br>
                                                            <b><font size=2 color=red>Email</font></b>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <b><font size=2>Email  </font></b><font color="#FF0000">*</font>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr><td colspan="6" class="detail9txt">
                                                            <input type="text" name="txtemail" class="txtbig" value=<?php echo "$email"; ?>><br>
                                                            Exemplos: meu_nome@yahoo.com, meunome@hotmail.com, etc. <br>
                                                            <?php 
                                                            $domain_table=mysql_query("select * from  blocked_domain");
                                                            $domain_name=" ";
                                                            if(mysql_num_rows($domain_table)!=0)
                                                            {
                                                            while($domain_row=mysql_fetch_array($domain_table))
                                                            {
                                                            $domain_name.=$domain_row[blocked_domain];
                                                            $domain_name.="&nbsp;&nbsp;&nbsp;";
                                                            } ?><font color=red> Dominio(s) bloqueado:</font><?php echo $domain_name; } ?><br>
                                                        </td></tr>
                                                    <tr><td colspan="6" class="detail9txt">
                                                            <?php if(!empty($err_reemail))
                                                            {
                                                            ?>
                                                            <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_reemail ; ?></font>
                                                            <br>
                                                            <b><font size=2 color=red>Repetir Email </font></b>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <b><font size=2>Repetir Email </font></b><font color="#FF0000">*</font>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr><td colspan="6"><input type="text" name="txtreemail" class="txtbig" value=<?php echo "$reemail"; ?>></td></tr>
                                                    <tr>
                                                        <td colspan="6" class="detail9txt">
                                                            <b><font>  Assinale o campo abaixo para receber notifica&ccedil;&otilde;es do <b><font>
                                                                    <?php echo $_SESSION[site_name]  ?>
                                                                    </font></b> sobre vendas e compras por email ou deixar em branco. </font></b></td>
                                                    </tr>
                                                    <tr><td colspan="6" class="detail9txt">
                                                            <?php if(!empty($email_enable_status))
                                                            {
                                                            ?>
                                                            <input type="checkbox" name=email_status checked>
                                                            <?php 
                                                            }
                                                            else
                                                            { 
                                                            ?>
                                                            <input type="checkbox" name=email_status>
                                                            <?php 
                                                            }
                                                            ?>

                                                            &nbsp;&nbsp;Notifica&ccedil;&otilde;es por Email </td>
                                                    </tr>
                                                    <tr><td colspan="6"><hr></td></tr>
                                                    <tr>
                                                        <td colspan="6" class="detail9txt"> <b><font> Termos e Condi&ccedil;&otilde;es | Pol&iacute;ticas de Privacidade do </font></b> <b><font>
                                                                <?php echo $_SESSION[site_name]  ?>.</font></b></td>
                                                    </tr>
                                                    <tr><td colspan="3">
                                                            <iframe src="terms_content.php" scrolling="yes" width=400 height="150"></iframe>
                                                        </td></tr>
                                                    <tr>
                                                        <td colspan="3" class="detail9txt">
                                                            <?php if(!empty($err_terms))
                                                            {
                                                            ?>
                                                            <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_reemail ; ?></font>
                                                            <br>
                                                            <b><font size=2 color=red>Por favor para prosseguir marque a caixa abaixo </font></b>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <b><font size=2>Por favor para prosseguir marque a caixa abaixo </font></b><font color="#FF0000">*</font>
                                                            <?php
                                                            }
                                                            ?> </td>
                                                    </tr>
                                                    <tr><td colspan="3">
                                                            <table cellpadding="5" cellspacing="2">
                                                                <tr><td colspan="2" class="detail9txt">
                                                                        <?php if(!empty($terms))
                                                                        {
                                                                        ?>
                                                                        <input type="checkbox" name=chkterms checked>
                                                                        <?php 
                                                                        }
                                                                        else
                                                                        { 
                                                                        ?>
                                                                        <input type="checkbox" name=chkterms>
                                                                        <?php 
                                                                        }
                                                                        ?>&nbsp;&nbsp; Eu concordo com o seguinte:
                                                                    </td>
                                                                </tr>
                                                                <tr><td class="dealtxt">
                                                                        <ul type="disc">
                                                                            <li> Eu aceito os termos e condi&ccedil;&otilde;es e a Pol&iacute;tica de Privacidade acima. </li>
                                                                            <li> Eu posso receber comunica&ccedil;&otilde;es de vendas e eu entendo que eu posso mudar minhas prefer&ecirc;ncias de notifica&ccedil;&atilde;o a qualquer momento, na minha conta. </li>
                                                                            <li>Sou e/ou tenho mais que 18 anos.</li>
                                                                        </ul></td></tr></table></td></tr>
                                                    <tr><td colspan="6">
                                                            <hr noshade class="hr_color" size="1"><br></td></tr>
                                                    <input type="hidden" name=step value=1>
                                                    <input type="hidden" name="member" value=<?php echo $member; ?>>
                                                           <tr><td colspan="6" align="center">
                                                            <?php

                                                            if(strlen($_SESSION['introname'])!=0) 
                                                            {
                                                            $introname=$_SESSION['introname'];
                                                            $check_intro_query="select * from user_registration where user_name='$introname'";
                                                            $check_intro_result=mysql_query($check_intro_query);
                                                            $check_intro_row=mysql_fetch_array($check_intro_result);
                                                            $intro_id=$check_intro_row['user_id']; ?>
                                                            <input type=hidden name=introid value=" <?php echo $intro_id ?>" >
                                                            <?php 
                                                            /* if($intro_id) {
                                                            echo "<tr><td>Referred By</td><td>$introname
                                                            <input type=hidden name=introid value=$intro_id>
                                                            </td></tr>";
                                                            } */
                                                            }
                                                            ?>

                                                            <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)"/>
                                                        </td></tr>
                                                </table>
                                            </form>
                                        </td></tr> 
                                </table></td></tr><table>


                                <script language="javascript">
                                    function namevalchk(tag)
                                    {
                                        var1 = tag.value; // tval is textbox(element) checking for characters only
                                        s = var1.substr(var1.length - 1, 1);
                                        m = s.charCodeAt(0);
                                        if (!((m >= 97 && m <= 122) || (m >= 65 && m <= 90) || (m == 32) || isNaN(m)))
                                        {
                                            ch = var1.substr(0, var1.length - 1);
                                            tag.value = ch;
                                        }
                                    }

                                    function numchk(tval)
                                    {
                                        var1 = tval.value; // tval is textbox(element)  checking for number only
                                        s = var1.substr(var1.length - 1, 1); 	 	/*alert(s+"---"+m);*/
                                        m = s.charCodeAt(0);               // ke.keyCode;	
                                        if (!((m >= 48 && m <= 57) || isNaN(m)))
                                        {
                                            ch = var1.substr(0, var1.length - 1);
                                            tval.value = ch;
                                        }
                                    }

                                    function sel(elementname)
                                    {
                                        var element_name = elementname;
                                        if (element_name == "txtfirst")
                                            document.reg.txtfirst.focus();
                                        if (element_name == "txtlast")
                                            document.reg.txtlast.focus();
                                        if (element_name == "txtaddress")
                                            document.reg.txtaddress.focus();
                                        if (element_name == "txtcity")
                                            document.reg.txtcity.focus();
                                        if (element_name == "txtstate")
                                            document.reg.txtstate.focus();
                                        if (element_name == "txtzipcode")
                                            document.reg.txtzipcode.focus();
                                        if (element_name == "cboday")
                                            document.reg.cboday.focus();
                                        if (element_name == "cbomonth")
                                            document.reg.cbomonth.focus();
                                        if (element_name == "txtYear")
                                            document.reg.txtYear.focus();
                                        if (element_name == "cbocountry")
                                            document.reg.cbocountry.focus();
                                        if (element_name == "txtprimary2")
                                            document.reg.txtprimary2.focus();
                                        if (element_name == "txtprimary1")
                                            document.reg.txtprimary1.focus();
                                        if (element_name == "txtprimary")
                                            document.reg.txtprimary.focus();
                                        if (element_name == "txtsecondary")
                                            document.reg.txtsecondary.focus();
                                        if (element_name == "txtsecondary1")
                                            document.reg.txtsecondary1.focus();
                                        if (element_name == "txtemail")
                                            document.reg.txtemail.focus();
                                        if (element_name == "txtreemail")
                                            document.reg.txtreemail.focus();
                                        if (element_name == "chkterms")
                                            document.reg.chkterms.focus();
                                    }

                                </script>
