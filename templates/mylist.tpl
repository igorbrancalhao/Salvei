<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%" height="5"></td>
    </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="13%">&nbsp;</td>
        <td width="87%"><span class="dealtxt">Hello <?php=$_SESSION['username'];?> ! </span></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td height="9"></td>
    </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
            <td width="22%"><div align="center"><img src="images/buyingicon.jpg" alt="" width="26" height="26" /></div></td>
            <td width="78%"><table width="173" height="29" border="0" cellpadding="0" cellspacing="0" background="images/bluegrad.gif">
              <tr>
                <td width="18">&nbsp;</td>
                <td width="116" class="myauction1txt">All Buying</td>
                <td width="39"><img src="images/arrowdown.gif" alt="" width="17" height="17" onclick="chk()" /></td>
              </tr>
            </table></td>
          </tr>
		  </table></td>
        </tr>
		
		<tr>
		<td><table width="100%" height="110" border="0" cellpadding="0" cellspacing="0">
		<tr>
            <td width="10%">&nbsp;</td>
            <td width="90%" class="myauction2txt"><a href="myauction.php?mode=watch" class="myauction2txt">Watching (<?php= $watch_total_records?>)</a></td>
          </tr>
		   
          <tr>
            <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="myauction2txt"><a href="myauction.php?mode=bid" class="myauction2txt">Bidding(<?php= $bid_total_records?>)</a></td>
          </tr>
          <tr>
       <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="myauction2txt"><a href="myauction.php?mode=won" class="myauction2txt">Won(<?php= $won_total_records?>)</a></td>
          </tr>
          <tr>
                  <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="myauction2txt"><a href="myauction.php?mode=didntwin" class="myauction2txt">Didn&rsquo;t Win (<?php= $didntwin_total_records?>)</a></td>
          </tr>
        </table></td>
	      </tr>
	
	  
	  
    </table></td>
  </tr>
  <tr>
    <td height="9"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="22%"><div align="center"><img src="images/sellingicon.jpg" alt="" width="37" height="35" /></div></td>
              <td width="78%"><table width="173" height="29" border="0" cellpadding="0" cellspacing="0" background="images/bluegrad.gif">
                  <tr>
                    <td width="18">&nbsp;</td>
                    <td width="115" class="myauction1txt">All Selling </td>
                    <td width="40"><img src="images/arrowdown.gif" alt="" width="17" height="17" /></td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" height="85" border="0" cellpadding="0" cellspacing="0">
	 <?php if($sold_total_records!=0 || $close_total_records!=0 || $sell_total_records!=0)
	 {
	 ?>
     <tr>
     <td width="10%">&nbsp;</td>
     <td width="90%" class="myauction2txt"><a href="myauction.php?mode=sell&status=Active" class="myauction2txt">Opened Auctions (<?php= $sell_total_records?>)</a></td>
            </tr>
            <tr>
                    <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="myauction.php?mode=sell&status=Closed" class="myauction2txt">Closed Auctions (<?php= $close_total_records?>)</a></td>
            </tr>
            <tr>
                   <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="myauction.php?mode=sell&status=sold" class="myauction2txt">Sold Items (<?php= $sold_total_records?>)</a></td>
            </tr>
            
            <?php
			}
			else
			{
			?>
			 <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="sell.php" class="myauction2txt">Start Selling</a></td>
            </tr>
			<?php
			}
			?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
     <td height="9"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="22%"><div align="center"><img src="images/messagesicon.jpg" alt="" width="28" height="28" /></div></td>
              <td width="78%"><table width="173" height="29" border="0" cellpadding="0" cellspacing="0" background="images/bluegrad.gif">
                  <tr>
                    <td width="18">&nbsp;</td>
                    <td width="114" class="myauction1txt">My Messages </td>
                    <td width="41"><img src="images/arrowdown.gif" alt="" width="17" height="17" /></td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="10%">&nbsp;</td>
              <td width="90%" class="myauction2txt"><a href="mail.php?mode=in" class="myauction2txt">Inbox (<?php= $inbox_mail_total_records ?>)</a></td>
            </tr>
            <tr>
                   <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="mail.php?mode=out" class="myauction2txt">Outbox (<?php= $outbox_mail_total_records ?>)</a></td>
            </tr>
            
            
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
       <td height="9"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="22%"><div align="center"><img src="images/wantedicon.jpg" alt="" width="32" height="30" /></div></td>
              <td width="78%"><table width="173" height="29" border="0" cellpadding="0" cellspacing="0" background="images/bluegrad.gif">
                  <tr>
                    <td width="18">&nbsp;</td>
                    <td width="115" class="myauction1txt">Wanted It Now</td>
                    <td width="40"><img src="images/arrowdown.gif" alt="" width="17" height="17" /></td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" height="85" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="10%">&nbsp;</td>
              <td width="90%" class="myauction2txt"><a href="wantitnow_homepage.php?pagelink=wantithome" class="myauction2txt">Want It Now home</a></td>
            </tr>
            <tr>
                     <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="wantitnow.php" class="myauction2txt">Post to want it now</a></td>
            </tr>
            <tr>
                    <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="myauction.php?mode=want&status=Active" class="myauction2txt">Want it now status</a></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
       <td height="9"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="22%"><div align="center"><img src="images/disputeicon.jpg" alt="" width="31" height="29" /></div></td>
              <td width="78%"><table width="173" height="29" border="0" cellpadding="0" cellspacing="0" background="images/bluegrad.gif">
                  <tr>
                    <td width="18">&nbsp;</td>
                    <td width="115" class="myauction1txt">Dispute Console </td>
                    <td width="40"><img src="images/arrowdown.gif" alt="" width="17" height="17" /></td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="10%">&nbsp;</td>
              <td width="90%" class="myauction2txt"><a href="viewdispute.php?type=unpaid" class="myauction2txt">Unpaid Items</a></td>
            </tr>
            <tr>
                    <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="viewdispute.php?type=notreceived" class="myauction2txt">Items not received</a></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>   <td height="9"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="22%"><div align="center"><img src="images/usericon.jpg" alt="" width="29" height="35" /></div></td>
              <td width="78%"><table width="173" height="29" border="0" cellpadding="0" cellspacing="0" background="images/bluegrad.gif">
                  <tr>
                    <td width="18">&nbsp;</td>
                    <td width="115" class="myauction1txt">User Options</td>
                    <td width="40"><img src="images/arrowdown.gif" alt="" width="17" height="17" /></td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" height="160" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="10%">&nbsp;</td>
              <td width="90%" class="myauction2txt"><a href="transactions.php" class="myauction2txt">Transactions</a></td>
            </tr>
            <tr>
                    <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="myprofile.php" class="myauction2txt">My Profile</a></td>
            </tr>
            <tr>
                     <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
            </tr>
           
            <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="feedback.php?user_id=<?php= $_SESSION[userid] ?>" class="myauction2txt">Feedback</a></td>
            </tr>
            <tr>
                   <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="create_store.php" class="myauction2txt">Stores</a></td>
            </tr>
            <tr>
                
                   <td colspan="2"><div align="center"><img src="images/myaucline.gif" alt="" width="198" height="1" /></div></td>
              </tr>
			  <?php
			  $alert_tot_sql="select * from user_alert where alert_type='P' or alert_type='R' and seller_id=$_SESSION[userid]"; 
	          $alert_recordset_tot=mysql_query($alert_tot_sql);
	          $alert_tot=mysql_num_rows($alert_recordset_tot);

			  ?>
            <tr>
              <td>&nbsp;</td>
              <td class="myauction2txt"><a href="alert.php" class="myauction2txt">Alerts(<?php=$alert_tot?>)</a></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
     <td height="9"></td>
  </tr>
</table>
