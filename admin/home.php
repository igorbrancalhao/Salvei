<?php
/***************************************************************************
 *File Name				:home.php
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
session_start();
error_reporting(0);
require 'include/connect.php';
if(strlen($_SESSION['adminuser'])==0)
{
	echo '<meta http-equiv="refresh" content="0;url=index.php">';
	exit();
}

$sitename_sql="select * from admin_settings where set_id='47'";
$sitename_sqlqry=mysql_query($sitename_sql);
$sitename_fetch=mysql_fetch_array($sitename_sqlqry);
$sitename=$sitename_fetch['set_value'];

$username=$_SESSION['adminuser'];
$date=date('Y-m-d');
$sql_admin="select * from tbl_ip order by id desc";
$sqlqry_admin=mysql_query($sql_admin);
$fetch_admin=mysql_fetch_array($sqlqry_admin);
$ip_address=$fetch_admin['user_ip'];
$res=mysql_query("select * from user_registration");
$tot=mysql_num_rows($res);
$ares=mysql_query("select * from user_registration where status='Active' and verified='yes'");
$actv=mysql_num_rows($ares);
$sres=mysql_query("select * from user_registration where status='suspended'");
$sus=mysql_num_rows($sres);
$ures=mysql_query("select * from user_registration where verified='no'");
$unver=mysql_num_rows($ures);
$new_sql=mysql_query("select * from user_registration where status='new'");
$new=mysql_num_rows($new_sql);
$paid_sql=mysql_query("select * from user_registration where paid='Yes' and ( original_account=2 or original_account=3 )");
$paid=mysql_num_rows($paid_sql);

$unpaid_sql=mysql_query("select * from user_registration where paid='No' and ( original_account=2 or original_account=3 )");
$unpaid=mysql_num_rows($unpaid_sql);

$trusted_sql=mysql_query("select * from user_registration where trusted='trusted'");
$trusted=mysql_num_rows($trusted_sql);

$jointoday="select * from user_registration where TO_DAYS((date_of_registration))-TO_DAYS(NOW())=0";
$jres=mysql_query($jointoday);
$join=mysql_num_rows($jres);


/*$jres=mysql_query("select * from placing_item_bid  where TO_DAYS((bid_starting_date))=TO_DAYS( NOW( ))");
$join=mysql_num_rows($jres);*/

$tot_items=mysql_query("select * from placing_item_bid");
$tot_rec=mysql_num_rows($tot_items);
$live_items=mysql_query("select * from placing_item_bid where status='Active'");
$live_rec=mysql_num_rows($live_items);
$exp_items=mysql_query("select * from placing_item_bid where status='Closed'");
$exp_rec=mysql_num_rows($exp_items);
$sup_items=mysql_query("select * from placing_item_bid where status='suspended'");
$sup_rec=mysql_num_rows($sup_items);
$sql="select * from placing_item_bid where quantity_sold > 0";
$sold_items=mysql_query($sql);
$sold_rec=mysql_num_rows($sold_items);
$newitem_sql="select * from placing_item_bid where status='new'";
$newitem_res=mysql_query($newitem_sql);
$newitem_rec=mysql_num_rows($newitem_res);
$noval="No Users Found";
$norec="No Items Found";
/*function getDeposit($payid) 
{
	$egold_query="select sum(amount) as amount from deposit where payment_thro=$payid";
	$egold_result=mysql_query($egold_query);
	$egold_row=mysql_fetch_array($egold_result);
	if($egold_row['amount']!='')echo '$ '.$egold_row['amount'];
	else echo '$ 0';
}
*/

?>
<html>
<head>
<title>Bem vindo a Administra&ccedil;&atilde;o do seu site - Bom uso</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
@import url("stylesheet.css");
.style1 {color: #FFFFFF}
body {
	background-color: #999999;
}
-->
</style>
</head>
<body>
<div align="center">
  <!-- ImageReady Slices (auction.psd) -->
  <table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0" class="tplcolor">
    <tr>
      <td width="786"><table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td rowspan="2"><img src="images/index_01_01.jpg" width="109" height="125" alt=""></td>
          <td rowspan="2"><img src="images/index_01_02.jpg" width="486" height="125" alt=""></td>
          <td width="185" height="53" background="images/blackbg01.jpg" class="txt_header" style="padding-top:10px"><div align="center">Painel de Controle </div></td>
        </tr>
        <tr>
          <td width="185" height="72" background="images/blackbg02.jpg" style="padding-top:40px; padding-right:20px"><div align="right"><a href="logout.php"><img src="images/logout.gif" width="67" height="20" border="0"></a></div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2"><table width="780" border="0" cellpadding="0" cellspacing="0" background="images/bg02.jpg">
              <tr>
                <td width="780" background="images/bg02.jpg" class="txt_welcomeadmin" style="padding-left:20px; padding-top:5px">Bem vindo Administrador<!-- (Last Successful Login from Ip: <?php=$ip_address?>)--></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td width="224" height="996"><table width="224"  border="0" align="center" cellpadding="0" cellspacing="5" id="Table_01">
              <tr>
                <td class="txt_heading1" style="padding-left:15px">Informa&ccedil;&atilde;o do site  </td>
              </tr>
              <tr>
      <td width="214"><table width="100%" border="0" cellpadding="0" cellspacing="8" background="images/bg081.jpg" class="border1">
                    <tr>
                      <td class="txt_sitedetails"><a href="user.php" class="txt_sitedetails">Total de Usu&aacute;rios </a> </td>
                      <td class="txt_details"><?php if($tot!=0) echo $tot; else echo $noval; ?></td>
                    </tr>
                    <tr>
                      <td class="txt_sitedetails"><a href="user.php?mode=actv" class="txt_sitedetails">Usu&aacute;rios Ativos </a></td>
                      <td class="txt_details"><?php if($actv!=0) echo $actv; else echo $noval; ?></td>
                    </tr>
                    <tr>
                      <td class="txt_sitedetails"><a href="user.php?mode=suspend" class="txt_sitedetails">Usu&aacute;rios Suspensos </a></td>
                      <td class="txt_details"><?php if($sus!=0) echo $sus; else echo $noval; ?></td>
                    </tr>
                    <tr>
                      <td class="txt_sitedetails"><a href="user.php?mode=unver" class="txt_sitedetails">Usu&aacute;rios a Verificar </a></td>
                      <td class="txt_details"> <?php if($unver!=0) echo $unver; else echo $noval; ?></td>
                    </tr>
                    <tr>
                      <td class="txt_sitedetails"><a href="user.php?mode=jointoday" class="txt_sitedetails">Registros hoje </a></td>
                      <td class="txt_details"><?php if($join!=0) echo $join; else echo $noval; ?></td>
                    </tr>
                    <!--<tr>
                      <td class="txt_sitedetails"><a href="user.php?mode=paid" class="txt_sitedetails">Paid Users</a></td>
                      <td class="txt_details"><?php if($paid!=0) echo $paid; else echo $noval; ?></td>
                    </tr>
					<tr>
                      <td class="txt_sitedetails"><a href="user.php?mode=unpaid" class="txt_sitedetails">Unpaid Users</a></td>
                      <td class="txt_details"><?php if($unpaid!=0) echo $unpaid; else echo $noval; ?></td>
                    </tr>-->
                </table></td>
              </tr>
              <tr>
                <td class="txt_heading1" style="padding-left:15px">Informa&ccedil;&otilde;es do Leil&atilde;o </td>
              </tr>
              <tr>
                <td width="214"><table width="100%" border="0" cellpadding="0" cellspacing="10" background="images/bg081.jpg" class="border1">
                    <tr>
                      <td width="74%" class="txt_sitedetails">Total de Produtos </td>
                      <td width="26%" class="txt_details"><?php if($tot_rec!=0) echo $tot_rec; else echo $norec; ?></td>
                    </tr>
                    <tr>
                      <td class="txt_sitedetails">Novos Produtos </td>
                      <td class="txt_details"><?php if($newitem_rec!=0) echo $newitem_rec; else echo $norec; ?></td>
                    </tr>
                    <tr>
                      <td class="txt_sitedetails">Vendidos</td>
                      <td class="txt_details"> <?php if($sup_rec!=0) echo $sup_rec; else echo $norec; ?></td>
                    </tr>
                    <tr>
                      <td class="txt_sitedetails">Dentro do Prazo </td>
                      <td class="txt_details"><?php if($live_rec!=0) echo $live_rec; else echo $norec; ?></td>
                    </tr>
                   <!-- <tr>
                      <td class="txt_sitedetails">Unpaid Items</td>
                      <td class="txt_details">1</td>
                    </tr>
                    <tr>-->
                        <td class="txt_sitedetails">Expirados</td>
                          <td class="txt_details"><?php if($exp_rec!=0) echo $exp_rec; else echo $norec; ?></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="images/index_02_02_051.jpg" width="199" height="1" alt=""></td>
              </tr>
              <tr>
                <td class="txt_heading1" style="padding-left:15px">Links R&aacute;pidos </td>
              </tr>
              <tr>
                <td width="214">
				<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td>
				<table width="100%" border="0" cellpadding="0" cellspacing="8" background="images/bg031.jpg"  style="background-repeat:repeat">
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=changepassword.php class="txt_quicklinks">Alterar Senha </a></td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=statistics.php class="txt_quicklinks">Ver status do site </a> </td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=search_keys.php class="txt_quicklinks">Adicionar Meta Tag </a></td>
                    </tr>
					<!-- <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=item_user.php class="txt_quicklinks">Add Item</a></td>
                    </tr>-->
					<tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=specialitysites.php class="txt_quicklinks">Especialidades do Site </a></td>
                    </tr>
					<tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=finalfeeview.php class="txt_quicklinks">Finalsalevalue Fee</a></td>
                    </tr>
					
					</table></td></tr>
					<tr>
                    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="8" background="images/bg031.jpg"><tr><td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=site_announcement.php class="txt_quicklinks">An&uacute;ncios do Site </a> </td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=terms.php?page=1 class="txt_quicklinks">Termos e Condi&ccedil;&otilde;es </a> </td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=about_us.php class="txt_quicklinks">Quem somos </a> </td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=currency_manager.php class="txt_quicklinks">Configurar Moedas </a> </td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=duration_setting.php class="txt_quicklinks">Configurar Dura&ccedil;&atilde;o</a></td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=viewdispute.php?type=unpaid class="txt_quicklinks">Gerenciar Disputas </a> </td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=site.php?page=bid class="txt_quicklinks">Configurar Incrementos </a></td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=error_msg.php class="txt_quicklinks">Erros do site </a> </td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=help.php class="txt_quicklinks">Ajuda</a> </td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=country.php class="txt_quicklinks">Pa&iacute;sese</a></td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=whatsnew.php class="txt_quicklinks">O que h&aacute; de novo </a></td>
                    </tr>
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=site.php?page=memberlevel class="txt_quicklinks">Nivel de Associa&ccedil;&atilde;o </a> </td>
                    </tr>
                   <!-- <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=css.php class="txt_quicklinks">Graphic Interface</a> </td>
                    </tr>-->
                    <tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=site.php?page=ask class="txt_quicklinks">Contato Loja </a></td>
                    </tr>
					<tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=feedback.php class="txt_quicklinks">Livro de Visitas </a></td>
                    </tr>
					<tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=cleanup.php class="txt_quicklinks">Antigo Ponto de Limpeza </a></td>
                    </tr>
					<tr>
                      <td><img src="images/star.gif" width="13" height="12"></td>
                      <td class="txt_quicklinks"><a href=dep_detail.php?page=bid class="txt_quicklinks">Transa&ccedil;&atilde;o</a></td>
                    </tr>
                </table></td>
              </tr></table></td></tr>
              <tr>
                <td><img src="images/index_02_02_081.jpg" width="199" height="1" alt=""></td>
              </tr>
              <tr>
                <td class="txt_heading1" style="padding-left:15px; padding-bottom:5px">Ajuda</td>
              </tr>
              <tr>
                <td width="214" height="90"><table width="100%" border="0" cellpadding="0" cellspacing="0" background="images/bg041.jpg" class="border1">
                    <tr>
                      <td><div align="center"><a href="manual.zip"><img src="images/admincontrol.gif" width="70" height="70" border=0></a></div></td>
                      <td><div align="center"><a href="help.php"><img src="images/faq.gif" width="70" height="70" border=0></a></div></td>
                    </tr>
                    <tr>
                      <td height="32" class="txt_knowbase"><a href="manual.zip" class="txt_knowbase"><div align="center">Admin <br> Manual </div></a></td>
                      <td class="txt_knowbase"><a href="help.php" class="txt_knowbase"><div align="center">FAQ</div></a></td>
                    </tr>
                </table></td>
              </tr>
              
          </table></td>
          <td width="556"><div align="left">
            <table id="Table_01" width="556"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="3" style="padding-top:10px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="51%" height="19" class="txt_heading1" style="padding-left:15px;">Configurando a Administra&ccedil;&atilde;o </td>
                    <td width="49%" class="txt_heading1" style="padding-left:15px">Ferramentas de Leil&atilde;o </td>
                  </tr>
                </table></td>
                  </tr>
              <tr>
                <td width="263" height="308">
                  <div align="center">
                    <table width="99%" border="0" align="left" cellpadding="0" cellspacing="0" background="images/bg051.jpg" class="border1" id="Table_01">
                          <tr>
                            <td  height="90"><table width="88%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
		  <a href="user.php" class="txt_heading"><img src="images/usermanagement.gif" width="70" height="70" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading" style="padding-top:12px">
								  <a href="user.php" class="txt_heading">Usu&aacute;rios</a> </td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails" style="padding-top:5px">Gerencia a conta dos usu&aacute;rios aqui </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><img src="images/index_02_03_02_02.jpg" alt="" width="245" height="7" align="left" /></td>
                          </tr>
                          <tr>
                            <td  height="70"><table width="88%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=site.php class="txt_heading">
								  <img src="images/generalsettings.gif" width="70" height="70" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading"style="padding-top:12px">
								  <a href=site.php class="txt_heading">Defini&ccedil;&otilde;es Gerais </a> </td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Configure o seu site </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><img src="images/index_02_03_02_05.jpg" width="245" height="5" alt="" /></td>
                          </tr>
                          <tr>
                            <td  height="70"><table width="88%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=site.php?page=style class="txt_heading">
								  <img src="images/stylesettings.gif" width="70" height="70" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading"style="padding-top:12px">
								  <a href=site.php?page=bid class="txt_heading">Configurar Leil&otilde;es </a></td>
                                </tr>
                                <tr>
                                  <td height="38" class="txt_sitedetails">Defina o valor do incremento de um lance </td>
                                </tr>
                              </table></td>
                          </tr>
                          
                          <tr>
                            <td><img src="images/index_02_03_02_08.jpg" width="245" height="5" alt="" /></td>
                          </tr>
                          <tr>
                            <td height="74"><table width="87%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=report.php?page=reven class="txt_heading">
								  <img src="images/detailreport.gif" width="70" height="70" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading"style="padding-top:12px">
								  <a href=report.php?page=reven class="txt_heading">Relat&oacute;rio Detalhado </a></td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails"><span title="">Obter o relat&oacute;rio <br>
                                  </span><span title="">do leil&atilde;o e membros</span> </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><img src="images/index_02_03_02_11.jpg" width="245" height="5" alt="" /></td>
                          </tr>
                          <tr>
                            <td height="80"><table width="87%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=store_manager.php class="txt_heading">
								  <img src="images/storemanager.gif" width="70" height="70" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading" style="padding-top:12px">
								  <a href=store_manager.php class="txt_heading">Gerenciar Loja </a></td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails"><span title="">Gerenciar a loja e<br>
                                  </span><span title="">tarefas relacionadas</span> </td>
                                </tr>
                              </table></td>
                          </tr>
                          
                          <tr>
                            <td><img src="images/index_02_03_02_14.jpg" width="245" height="4" alt="" /></td>
                          </tr>
                          <tr>
                            <td height="95"><table width="88%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=bulk_load.php class="txt_heading">
								  <img src="images/bulkloader.gif" width="70" height="70" border=0/></a></div></td>
                                  <td width="66%" class="txt_heading" style="padding-top:12px">
								  <a href=bulk_load.php class="txt_heading">Carregar Arquivos </a> </td>
                                </tr>
                                <tr>
                                  <td height="41" class="txt_sitedetails"> Para carregar dados em massa. (Em formato csv) <br />
                                 </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
                    </div></td>
                    <td width="17">&nbsp;</td>
                    <td width="276" height="308"><div align="left">
                      <table width="95%" border="0" cellpadding="0" cellspacing="0" background="images/bg051.jpg" class="border1" id="Table_01">
                          <tr>
                            <td height="90"><table width="82%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=auction.php class="txt_heading">
								  <img src="images/auctionmaster.gif" width="70" height="70" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading" style="padding-top:12px"><a href=auction.php  class="txt_heading">Leil&atilde;o Master </a> </td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Pesquise e navegue por todos os produtos </td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><img src="images/index_02_03_02_02.jpg" width="260" height="7" alt="" /></td>
                          </tr>
                          <tr>
                            <td height="70"><table width="82%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=site.php?page=auction class="txt_heading">
								  <img src="images/auctionsetting.gif" width="70" height="70" border="0"/></a></div></td>
<td width="66%" class="txt_heading"style="padding-top:12px"><a href=site.php?page=auction class="txt_heading">Configurar Leil&atilde;o </a> </td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Definir a Dura&ccedil;&atilde;o de um leil&atilde;o <br />
                                   </td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><img src="images/index_02_03_02_05.jpg" width="260" height="5" alt="" /></td>
                          </tr>
                          <tr>
                            <td height="70"><table width="83%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=category.php class="txt_heading">
								  <img src="images/categorysetting.gif" width="70" height="70" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading" style="padding-top:12px"><a href=category.php class="txt_heading">Configurar Categorias </a></td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Add/Editar - categorias </td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><img src="images/index_02_03_02_08.jpg" width="260" height="5" alt="" /></td>
                          </tr>
                          <tr>
                            <td height="74"><table width="83%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=subcategory.php class="txt_heading">
								  <img src="images/subcategorysetting.gif" width="70" height="70" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading" style="padding-top:12px"><a href=subcategory.php class="txt_heading">C. Sub Categorias </a> </td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Add/Editar - Sub Categorias </td>
                                </tr>
                            </table></td>
                          </tr>
                          
                          <tr>
                            <td><img src="images/index_02_03_02_11.jpg" width="260" height="5" alt="" /></td>
                          </tr>
                          <tr>
                            <td height="80"><table width="83%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=custom_category.php class="txt_heading">
								  <img src="images/customcategory.gif" width="70" height="70" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading"style="padding-top:12px">
								  <a href=custom_category.php class="txt_heading">Personalizar Categoria </a> </td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Crie uma categoria personalizada </td>
                                </tr>
                            </table></td>
                          </tr>
                          
                          <tr>
                            <td><img src="images/index_02_03_02_14.jpg" width="260" height="4" alt="" /></td>
                          </tr>
                          <tr>
                            <td height="95"><table width="83%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
              <td width="34%" rowspan="2"><div align="center">
			  <a href=insertion_fee_settings.php class="txt_heading">
			  <img src="images/manageauctionsetting.gif" width="70" height="70" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading" style="padding-top:12px">
								  <a href=insertion_fee_settings.php class="txt_heading">Gerenciar Taxas </a></td>
                                </tr>
                                <tr>
                                  <td height="38" class="txt_sitedetails">Gerencie taxas para o valor final de vendas </td>
                                </tr>
                            </table></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
              <tr>
                <td colspan="3"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="51%" class="txt_heading1" style="padding-left:15px">&nbsp;</td>
                    <td width="49%" class="txt_heading1" style="padding-left:15px">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="txt_heading1" style="padding-left:15px"><span class="txt_heading1">Definir Emails </span></td>
                    <td width="49%" class="txt_heading1" style="padding-left:15px"><span class="txt_heading1">Gerenciar Dinheiro </span></td>
                  </tr>
                </table></td>
                  </tr>
              <tr>
                <td colspan="3"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="49%">
                          <div align="center">
                            <table width="262" height="83%"  border="0" align="left" cellpadding="0" cellspacing="0" background="images/bg061.jpg" class="border1" id="Table_01">
                                <tr>
                                  <td width="260" height="60"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="34%" rowspan="2"><div align="center">
										<a href=mail.php?page=subjects class="txt_heading">
										<img src="images/mailsubjects.gif" width="50" height="50" border="0"/></a></div></td>
                                        <td width="66%" class="txt_heading"style="padding-top:8px">
										<a href=mail.php?page=subjects class="txt_heading">Meus Emails </a> </td>
                                      </tr>
                                      <tr>
                                        <td height="36" class="txt_sitedetails"><span title="">Gerenciar os assuntos mail<br>
                                        </span><span title="">e tarefas relacionadas</span> </td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td><img src="images/line01.jpg" width="260" height="5" alt="" /></td>
                                </tr>
                                <tr>
                                  <td width="260" height="60"><table width="96%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="34%" rowspan="2"><div align="center">
										<a href=mail.php class="txt_heading">
										<img src="images/sendmails.gif" width="60" height="60" border="0"/></a></div></td>
                                        <td width="66%" class="txt_heading"style="padding-top:8px">
										<a href=mail.php class="txt_heading">Eviar Email </a> </td>
                                      </tr>
                                      <tr>
                                        <td class="txt_sitedetails"><span title="">Enviar e-mail para o<br>
                                        </span><span title="">Usu&aacute;rios registrados</span> </td>
                                      </tr>
                                  </table></td>
                                </tr>
                                
                                <tr>
                                  <td><img src="images/line02.jpg" width="260" height="5" alt="" /></td>
                                </tr>
                                <tr>
                                  <td width="260" height="70"><table width="96%" height="59" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="34%" rowspan="2"><div align="center">
										<a href=mail.php?page=news class="txt_heading">
										<img src="images/sendnewsletter.gif" width="55" height="55" border="0"/></a></div></td>
                                        <td width="66%" height="21" class="txt_heading"style="padding-top:5px">
										<a href=mail.php?page=news class="txt_heading">Enviar Newsletter</a> </td>
                                      </tr>
                                      <tr>
                                        <td class="txt_sitedetails">Enviar Newsletter em massa </td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                          </div></td>
                        <td width="3%">&nbsp;</td>
                        <td width="48%"><table width="262"  border="0" cellpadding="0" cellspacing="0" background="images/bg061.jpg" class="border1" id="Table_01">
                          <tr>
                            <td width="260" height="60"><table width="91%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=site.php?page=pay class="txt_heading">
								  <img src="images/paymentsetting.gif" width="55" height="55" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading"style="padding-top:12px">
								  <a href=site.php?page=pay class="txt_heading">Configurar pagamento </a></td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Ativar e desativar tipos de pagamentos </td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><img src="images/index_02_03_05_02.jpg" width="260" height="5" alt="" /></td>
                          </tr>
                          <tr>
                            <td width="260" height="60"><table width="91%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=earnings.php class="txt_heading">
								  <img src="images/adminearnings.gif" width="55" height="55" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading"style="padding-top:12px">
								  <a href=earnings.php class="txt_heading">Meu Lucro </a></td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Ver o meu lucro <br />
                                   </td>
                                </tr>
                            </table></td>
                          </tr>
                          
                          <tr>
                            <td><img src="images/line03.jpg" width="260" height="5" alt="" /></td>
                          </tr>
                          <tr>
                            <td width="260" height="70"><table width="91%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center">
								  <a href=fee_setting.php class="txt_heading">
								  <img src="images/feesetting.gif" width="55" height="55" border="0"/></a></div></td>
                                  <td width="66%" class="txt_heading"style="padding-top:5px">
								  <a href=fee_setting.php class="txt_heading">Configurar Taxas </a></td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Defina suas taxas e planos aqui </td>
                                </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
              <tr>
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="49%" height="42" class="txt_heading1" style="padding-left:15px; padding-top:23px"><div align="left">Seguran&ccedil;a</div></td>
                        <td width="51%" class="txt_heading1" style="padding-left:25px; padding-top:23px"><div align="left"> O site </div></td>
                      </tr>
                    </table></td>
                  </tr>
              <tr>
                <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="49%" height="178"><div align="center">
                        <table width="262" border="0" align="left" cellpadding="0" cellspacing="0" background="images/bg101.jpg" class="border1" id="Table_01">
                          <tr>
                            <td width="260" height="70"><table width="96%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center"><a href=ipblock.php><img src="images/blockip.gif" width="55" height="55" border=0/></a></div></td>
                                  <td width="66%" class="txt_heading"style="padding-top:12px"><a href=ipblock.php class="txt_heading">Bloquear IP </a> </td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Bloquear alguem em particular  </td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td><img src="images/index_02_03_05_02.jpg" width="260" height="5" alt="" /></td>
                          </tr>
                          <tr>
                            <td width="260" height="70"><table width="96%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="34%" rowspan="2"><div align="center"><a href=domainblock.php><img src="images/blockdomain.gif" width="70" height="70" border=0/></a></div></td>
                                  <td width="66%" class="txt_heading" style="padding-top:12px"><a href=domainblock.php class="txt_heading">Bloquear Dom&iacute;nio </a></td>
                                </tr>
                                <tr>
                                  <td class="txt_sitedetails">Bloquear dom&iacute;nios indesejados </td>
                                </tr>
                            </table></td>
                          </tr>
                        </table>
                    </div></td>
                    <td width="2%">&nbsp;</td>
                    <td width="49%"><table width="262"  border="0" cellpadding="0" cellspacing="0" background="images/bg101.jpg" class="border1" id="Table_01">
                        <tr>
                          <td width="260" height="70"><table width="96%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="34%" rowspan="2"><div align="center"><a href="#" style="text-decoration:none" id="link" onClick="window.open('../index.php')"><img src="images/homepage.gif" width="55" height="55" border=0/></a></div></td>
                       <td width="66%" class="txt_heading" style="padding-top:12px"><a href="#" style="text-decoration:none" id="link" onClick="window.open('../index.php')" class="txt_heading">P&aacute;gina Inicial </a> </td>
                              </tr>
                              <tr>
                                <td class="txt_sitedetails">Ir a p&aacute;gina Inicial do meu site </td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td><img src="images/index_02_03_05_02.jpg" width="260" height="5" alt="" /></td>
                        </tr>
                        <tr>
                          <td width="260" height="70"><table width="96%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="34%" rowspan="2"><div align="center"><a href=frontpagebanner.php><img src="images/bannersetting.gif" width="65" height="65" border="0"/></a></div></td>
                                <td width="66%" class="txt_heading" style="padding-top:12px"><a href=frontpagebanner.php class="txt_heading">Configirar Banners </a></td>
                              </tr>
                              <tr>
                                <td class="txt_sitedetails">Configurar todos os banners. </td>
                              </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
                </table></td>
                  </tr>
            </table>
          </div></td>
        </tr>
      </table></td>
    </tr>
   <table width="780"  border="0" cellpadding="0" cellspacing="0" bgcolor="#30302d">
        <tr>
          <td><div align="center"><span class="txt_footer">copyright <?php=date("Y")?>. All Rights Reserved. <?php=$sitename?></span></div></td>
        </tr>
      </table>

  </table>
  <!-- End ImageReady Slices -->
</div>
</body>
</html>