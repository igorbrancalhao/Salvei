<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo $_SESSION['site_name']?></title>
        <meta name="keywords" content="<?php echo $meta_res['key_s']?>" />
        <meta name="description" content="<?php echo $meta_res['key_s']?>" /> 
        <link href="style/newstyle.css" rel="stylesheet" type="text/css" />
        <script language="javascript">
            var ServerTime = new Date("<?php echo $JavascriptTime; ?>");

            function ShowServerTime()
            {
                if (!document.all && !document.getElementById)
                {
                    return;
                }
                var dN = new Array('Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado');
                mN = new Array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
                var hours = ServerTime.getHours();
                var minutes = ServerTime.getMinutes();
                var seconds = ServerTime.getSeconds();
                var day = dN[ServerTime.getDay()];
                var month = mN[ServerTime.getMonth()];
                var dat = ServerTime.getDate();
                ServerTime.setSeconds(seconds + 1);

                if (hours <= 9)
                {
                    hours = "0" + hours;
                }
                if (minutes <= 9)
                {
                    minutes = "0" + minutes;
                }
                if (seconds <= 9)
                {
                    seconds = "0" + seconds;
                }
                ShowTime = dat + "&nbsp;de&nbsp;" + month + "&nbsp;|&nbsp;" + day + "&nbsp;-&nbsp;" + hours + ":" + minutes + ":" + seconds;


                if (document.getElementById)
                {
                    document.getElementById("STime").innerHTML = ShowTime
                }
                else if (document.all)
                {
                    STime.innerHTML = ShowTime;
                }
                setTimeout("ShowServerTime()", 1000);
            }
        </script>
        <script type="text/JavaScript">
            <!--
            function MM_swapImgRestore() { //v3.0
            var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
            }

            function MM_preloadImages() { //v3.0
            var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
            var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
            if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
            }

            function MM_findObj(n, d) { //v4.01
            var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
            d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
            if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
            for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
            if(!x && d.getElementById) x=d.getElementById(n); return x;
            }

            function MM_swapImage() { //v3.0
            var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
            if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
            }
            //-->
        </script>
    </head>

    <body onload="ShowServerTime();">
        <div id="main"><div id="header_part">
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td colspan="3"><table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td><table id="Table_01" width="100%" height="133" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td><table id="Table_01" width="428" height="133" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td><img src="images/index2_01.gif" width="428" height="8" alt="" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td><table width="428" height="125" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                                                    <tr>
                                                                        <td><div align="center">
                                                                                <a href="index.php">
                                                                                    <img src="images/<?php echo $sitelogo_fetch['set_value'];?>" width="252" height="111" border="0"/>
                                                                                </a>
                                                                            </div></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                    </table></td>
                                                <td><table id="Table_01" width="526" height="133" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td><table id="Table_01" width="526" height="36" border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td><table width="93" height="36" border="0" cellpadding="0" cellspacing="0" background="images/index4_01.gif">
                                                                                <tr>
                                                                                    <td width="44">&nbsp;</td>
                                                                                    <!--<td width="49" class="header_text4"><div align="left"><a href="javascript:makeReq('browse_categories.php')" class="header_text4">Buy</a></div></td>-->
                                                                                    <td width="49" class="header_text4"><div align="left"><a href="browse_cate.php" class="header_text4">Comprar</a></div></td>
                                                                                </tr>
                                                                            </table></td>
                                                                        <td><img src="images/index4_02.gif" width="2" height="36" alt="" /></td>
                                                                        <td><table width="77" height="36" border="0" cellpadding="0" cellspacing="0" background="images/index4_03.gif">
                                                                                <tr>
                                                                                    <td width="33">&nbsp;</td>
                                                                                    <td width="44" class="header_text4"><div align="left"><a href="sell.php" class="header_text4">Vender</a></div></td>
                                                                                </tr>
                                                                            </table></td>
                                                                        <td><img src="images/index4_04.gif" width="2" height="36" alt="" /></td>
                                                                        <td><table width="113" height="36" border="0" cellpadding="0" cellspacing="0" background="images/index4_05.gif">
                                                                                <tr>
                                                                                    <td width="35">&nbsp;</td>
                                                                                    <td width="78" class="header_text4"><div align="left"><a href="myauction.php" class="header_text4">Minha Conta </a></div></td>
                                                                                </tr>
                                                                            </table></td>
                                                                        <td><img src="images/index4_06.gif" width="2" height="36" alt="" /></td>
                                                                        <td><table width="121" height="36" border="0" cellpadding="0" cellspacing="0" background="images/index4_07.gif">
                                                                                <tr>
                                                                                    <td width="37">&nbsp;</td>
                                                                                    <td width="84" class="header_text4"><div align="left"><a href="store_directory.php" class="header_text4">Lojas</a></div></td>
                                                                                </tr>
                                                                            </table></td>
                                                                        <td><img src="images/index4_08.gif" width="2" height="36" alt="" /></td>
                                                                        <td><table width="114" height="36" border="0" cellpadding="0" cellspacing="0" background="images/index4_09.gif">
                                                                                <tr>
                                                                                    <td width="36">&nbsp;</td>
                                                                                    <td width="78" class="header_text4"><div align="left"><a href="help.php" class="header_text4">Ajuda</a></div></td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                        <tr>
                                                            <td><table id="Table_01" width="526" height="97" border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td><table width="526" height="42" border="0" cellpadding="0" cellspacing="0" background="images/menu.jpg">
                                                                                <tr>
                                                                                    <td width="69">&nbsp;</td>
                                                                                    <td width="92" class="header_text6"><div align="left"><a href="index.php" class="header_text6">In&iacute;cio</a></div></td>
                                                                                    <td width="80" class="header_text6"><div align="left" class="header_text6"><a href="pay.php" class="header_text6">Pagar</a></div></td>
                                                                                    <td width="99" class="header_text6"><div align="left"><a href="sitemap.php" class="header_text6">Mapa do Site </a></div></td>
                                                                                    <td width="100" class="header_text6"><div align="left"><a href="about_us.php" class="header_text6">Sobre n&oacute;s </a></div></td>
                                                                                    <td width="86" class="header_text6"><div align="left"><a href="contact.php" class="header_text6">Contato </a></div></td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><table width="526" height="55" border="0" cellpadding="0" cellspacing="0" background="images/index5_02.gif">
                                                                                <form action="search.php" method="post" name="form2" id="form2">
                                                                                    <tr>
                                                                                        <td width="24">&nbsp;</td>
                                                                                        <td width="153"><label>
                                                                                                <input type="text" name="product" />
                                                                                            </label></td>
                                                                                        <td width="123"><label>
                                                                                                <select name="cbocat">
                                                                                                    <option value="all">Todas as categorias</option>
                                                                                                    <?php
                                                                                                    $sqlcat="select * from category_master where category_head_id=0 order by category_name"; 
                                                                                                    $recordsetcat=mysql_query($sqlcat);
                                                                                                    while($recordcat=mysql_fetch_array($recordsetcat))
                                                                                                    {
                                                                                                    ?>
                                                                                                    <option value="<?php echo  $recordcat['category_id']?>">
                                                                                                        <?php echo  $recordcat[category_name]?>
                                                                                                    </option>
                                                                                                    <?php
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                                <input type="hidden" name="mode" value="easy" />
                                                                                            </label></td>
                                                                                        <td width="226"><div align="left">
                                                                                                <input type="image" src="images/search.gif" name="btnSearch" width="62" height="22" border="0" id="Image60" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image60', '', 'images/searcho.gif', 1)"/>
                                                                                            </div></td>
                                                                                    </tr>
                                                                                </form>
                                                                                <tr>
                                                                                    <td>&nbsp;</td>
                                                                                    <td class="header_text5"><div align="left"><a href="advanced_search.php" class="header_text5">Pesquisa Avan&ccedil;ada </a></div></td>
                                                                                    <td>&nbsp;</td>
                                                                                    <td>&nbsp;</td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                    </table></td>
                                                <td><table width="51" height="133" border="0" cellpadding="0" cellspacing="0" background="images/index1_03.gif">
                                                        <tr>
                                                            <td width="57">&nbsp;</td>
                                                        </tr>
                                                    </table></td>
                                            </tr>
                                        </table></td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td height="5"></td>
                    </tr>
                    <tr>
                        <td height="27" colspan="3"><table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="21">&nbsp;</td>
                                    <td width="969"><table style="border:1Px solid #9eb1c5" width="990" height="25" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#d8ecff">
                                            <tr>
                                                <td width="22">&nbsp;</td>
                                                <td width="325"><?php if (empty($_SESSION['userid'])){?>
            <div align="left"><span class="header_text1">Bem vindo visitante  ! Deseja</span> <span class="header_text"><a href="signin.php" class="header_text">Logar</a></span> <span class="header_text1">ou se </span><span class="header_text"><a href="user_reg.php" class="header_text">Cadastrar.</a></span></div>
            <?php}else{?>
            <div align="left"><span class="header_text1">Bem vindo!</span> <span class="header_text"><a href="feedback.php?user_id=<?php echo $_SESSION['userid']?>" class="header_text"><?php echo $_SESSION['username'];?></a></span> <span class="header_text1">Deseja </span><span class="header_text"><a href="signout.php" class="header_text">Sair</a></span>.</div>
            <?php}?></td>
                                                <td width="371" class="header_text1"></td>
                                                <td width="1"><!--<img src="images/livehelp.gif" alt="" width="19" height="20" />--></td>
                                                <td width="269" class="header_text" style="padding-right:20px"><!--<a href="help" class="header_text2">Live Help</a>-->
                                                    <div align="right" id="STime"></div></td>
                                            </tr>
                                        </table></td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td height="4"></td>
                    </tr>
                </table>
            </div>