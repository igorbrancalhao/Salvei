<table width="958" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="958" height="25" border="0" cellpadding="0" cellspacing="0" background="images/contentbg.jpg">
      <tr>
        <td width="25">&nbsp;</td>
        <td width="933" class="detail3txt">Bid Confirmation </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table  width="958" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
      <tr>
        <td height="5"></td>
        </tr>
      <tr>
        <td width="30"> </td>
        <td width="195" class="banner1">Hello  <?= $_SESSION[username] ?> !</td>
        <td width="32">&nbsp;</td>
        <td width="704">&nbsp;</td>
      </tr>
      <tr>
        <td height="4"></td>
      </tr>
      <tr>
       <td height="5"></td>
        </tr>
      <tr>
        <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%">&nbsp;</td>
            <td width="97%" class="dealtxt">
			<?
			if(($higher_userid==$userid) && ($highest_bid_amt > $max_bid))
			{
			  echo '<b>'."You are the highest bidder for this item.so please bid more than $row[currency] $highest_bid_amt".'</b>';
			}
			else if($highest_bid_amt <= $max_bid)
			{
				$select_sql="select * from error_message where err_id =42";
				$select_tab=mysql_query($select_sql);
				$select_row=mysql_fetch_array($select_tab);
				echo '<b>'.$select_row[err_msg].'</b>';
			}
			else
			{
				echo '<b>'."You have been out bid!".'</b>';
			}
			?></td>
        </tr>
        <tr>
        <td height="5"></td>
        </tr>
        </table></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td class="detail6txt">Item Title</td>
        <td class="detail6txt">:</td>
        <td class="banner1"><?= $row[item_title]; ?></td>
        </tr>
        <tr>
        <td height="10"></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td class="detail6txt">Your Maximum Bid </td>
        <td class="detail6txt">:</td>
        <td class="banner1"><?= $row[currency]." ".$max_bid; ?></td>
        </tr>
        <tr>
        <td height="10"></td>
        </tr>
		<? if($pay_rec[payment_gateway])
		  {
			?>
			<tr>
            <td>&nbsp;</td>
			<td class="detail6txt">Payment Gateway:</td>
			<td class="detail6txt">:</td>
			<td class="banner1"><?= $pay_rec[payment_gateway]; ?>.</td></tr>
			<tr>
            <td height="10"></td>
            </tr>
			<?
		  }
		?>
        <tr>
        <td>&nbsp;</td>
        <td class="detail6txt">Shipping and Handling</td>
        <td class="detail6txt">:</td>
        <td class="banner1">See item page or contact seller for details.</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td class="detail6txt">&nbsp;</td>
        <td class="detail6txt">&nbsp;</td>
        <td class="banner1">&nbsp;</td>
        </tr>
		<form action="detail.php" method="post" >
        <input type="hidden" name="item_id" value="<?= $row[item_id] ?>">
        <tr>
        <td>&nbsp;</td>
        <td class="detail6txt">&nbsp;</td>
        <td class="detail6txt">&nbsp;</td>
        <td class="banner1">
		<input type="image" src="images/backitem.jpg" name="Image10" width="126" height="22" border="0" id="Image10" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10','','images/backitemo.jpg',1)"/></td>
        </tr>
		</form>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        </table></td>
        </tr>
        </table>
