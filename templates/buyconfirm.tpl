<table width="958" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="958" height="25" border="0" cellpadding="0" cellspacing="0" background="images/contentbg.jpg">
      <tr>
        <td width="25">&nbsp;</td>
        <td width="933" class="detail3txt">Buy Confirmation </td>
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
	  <?
	  $sql_seller="select * from placing_item_bid where item_id=".$item_id;
	  $sqlqry_seller=mysql_query($sql_seller);
	  $sqlfetch=mysql_fetch_array($sqlqry_seller);
	  $sellerid=$sqlfetch['user_id'];
	  if($sellerid==$_SESSION['userid'])
	  {
	  ?>
	  <tr><td class="dealtxt" colspan="4" align="center" style="padding-left:10px">You are seller for this item, You cannot but the item.</td></tr>
	  <tr>
        <td height="5"></td>
        </tr>
		<tr>
        <td height="5"></td>
        </tr>
		<tr><td colspan="4" style="padding-left:10px"><a href="detail.php?item_id=<?=$item_id?>" class="dealtxt">Return to Item page</a></td></tr>
		 <tr>
        <td height="4"></td>
      </tr>
	  <?
	  }
	  else
	  {
	  ?>
       <tr>
       <td height="5"></td>
        </tr>
      <tr>
        <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%">&nbsp;</td>
            <td width="97%" class="dealtxt">
			</td>
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
        <td class="banner1"><?= $sqlfetch[item_title]; ?></td>
        </tr>
        <tr>
        <td height="10"></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td class="detail6txt">Buyitnow Price</td>
        <td class="detail6txt">:</td>
        <td class="banner1"><?= $sqlfetch['currency']." ".$sqlfetch['quick_buy_price']; ?></td>
        </tr>
        <tr>
        <td height="10"></td>
        </tr>
		<? if($sqlfetch[payment_gateway])
		  {
		  $sqlgateway="select * from payment_gateway where status=".$sqlfetch['payment_gateway'];
	      $sqlgatewayqry=mysql_query($sqlgateway);
	      $sqlgatewayfetch=mysql_fetch_array($sqlgatewayqry); 
	      $payid=$sqlgatewayfetch['payment_gateway'];
			?>
			<tr>
            <td>&nbsp;</td>
			<td class="detail6txt">Accepted Mode of Payment:</td>
			<td class="detail6txt">:</td>
			<td class="banner1"><?= $payid; ?>.</td></tr>
			<tr>
            <td height="10"></td>
            </tr>
			<?
		  }
		?>
        <tr>
        <td>&nbsp;</td>
        <td class="detail6txt">Shipping Cost </td>
        <td class="detail6txt">:</td>
        <td class="banner1">
		<?
		if($sqlfetch['shipping_cost']=='0.00')
		{
		echo "-";
		}
		else
		{
		echo $sqlfetch['currency'].$sqlfetch['shipping_cost'];
		}
		?></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td class="detail6txt">&nbsp;</td>
        <td class="detail6txt">&nbsp;</td>
        <td class="banner1">&nbsp;</td>
        </tr>
		<tr>
        <td>&nbsp;</td>
        <td class="detail6txt">Tax </td>
        <td class="detail6txt">:</td>
       <td class="banner1">
	   <?
		if($sqlfetch['tax']=='0.00')
		{
		echo "-";
		}
		else
		{
		echo $sqlfetch['tax']."%";
		}
		?>
	    </td>
        </tr>
		<tr>
        <td>&nbsp;</td>
        <td class="dealtxt">&nbsp;</td>
      <td class="detail6txt">&nbsp;</td>
        <td class="banner1">&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td class="dealtxt" colspan="4" align="center">Click Below to Confirm your Purchase</td>
        </tr>
		<form action="detail.php" method="post">
        <input type="hidden" name="item_id" value="<?= $sqlfetch['item_id'] ?>">
		<input type="hidden" value="fix" name="sell_method">
		<input type="hidden" name="qty" value="<?=$sqlfetch['Quantity'];?>">
		<input type="hidden" value="1" name="flag">
		<tr>
       <td class="banner1" colspan="4" style="padding-left:100px">
		<input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71','','images/continueo.gif',1)" onclick="return chk()"/>
		</td>
        </tr>
		</form>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
		<tr>
        <td>&nbsp;</td>
        <td class="dealtxt" colspan="4" align="center">Click Below to Cancel your Purchase</td>
        </tr>
		<form action="detail.php" method="GET">
        <input type="hidden" name="item_id" value="<?= $sqlfetch['item_id'] ?>">
		<tr>
        <td class="banner1" colspan="4" style="padding-left:100px">
		<input type="image" src="images/backitem.jpg" name="Image10" width="126" height="22" border="0" id="Image10" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10','','images/backitemo.jpg',1)"/>
		</form>
        </td>
        </tr>
		
		<?
		}
		?>
		<tr>
        <td colspan="4">&nbsp;</td>
        </tr>
		<tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        </table></td>
        </tr>
        </table>
