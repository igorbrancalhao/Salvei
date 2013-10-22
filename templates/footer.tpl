<form name="form3" action="rssfeed.php" method="post">
    <input type="hidden" name="mode" value="<?php echo $_SESSION['sqlfeed']?>"/>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ebf0f2" style="border-top:2px solid #83a9ff">
        <tr>
            <td height="4"></td>
        </tr>
        <tr class="banner1">
            <td width="2%">&nbsp;</td>
            <td width="100%" align="center"><div align="center"><a href="index.php" class="topfooter">IN&Iacute;CIO</a> | <a href="about_us.php" class="topfooter">SOBRE N&Oacute;S </a> | <a href="community.php" class="topfooter">COMUNIDADE</a> | <a href="sitemap.php" class="topfooter">MAPA DO SITE </a> | <a href="contact.php" class="topfooter">CONTATO</a> | <a href="help.php" class="topfooter">AJUDA</a> | <a href="rssfeed.php" class="topfooter">RSS</a>
                    <input type="image" src="images/rss.jpg" value="RSS FEED" name="submit"/>
                </div></td>
         </tr>       
        <tr>
            <td>&nbsp;</td>
            <td><div align="center"><span class="footer1txt">Copyright &copy; 2010. <a href="http://designmp.net">Premium Themes</a>
                        <?php echo $sitename_fetch['set_value']?>
                        .   <br />
                        Designada a vendas e compras f&iacute;sicas e jur&iacute;dicas. O uso deste site implica na aceita&ccedil;&atilde;o dos  <br />
                    </span>
                    <span class="footer2txt"><a href="useragreement.php" class="footer2txt">Termos de Uso </a> </span><span class="footer1txt">e na </span><span class="footer2txt"><a href="privacypolicy.php" class="footer2txt">Pol&iacute;tica de Privacidade </a> </span><span class="footer1txt">do</span><span class="footer1txt">
                        <?php echo $sitename_fetch['set_value']?>
                    </span></div></td>

        </tr>
        <tr>
            <td height="8"></td>
        </tr>
        <!--<div align="center">
          <?php
        $lastup_sql="select * from admin_settings where set_id=17";
        $lastup_sqlqry=mysql_query($lastup_sql);
        $lastup_fetch=mysql_fetch_array($lastup_sqlqry);
        $lastupdate_date=$lastup_fetch['set_value'];
        ?>
          </div>
        <tr>
    <td>&nbsp;</td>
        <td class="footer3txt">-->  
            <!--<span class="footer3txt">AJ Auction official time -</span> <span class="footer1txt">
            Last updated:  
            <?php echo $lastupdate_date?>
            </span></div>--> 
    </table>

</form>