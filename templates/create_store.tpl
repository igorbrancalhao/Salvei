<table width="962" border="0" cellpadding="5" cellspacing="0" align="center" >
<tr>
<td colspan="4" background="images/item_bg.gif">
<font size="3"><b><div align="left">&nbsp;&nbsp;My Stores</div></b></font></td>
</tr>
<FORM action=create_store.php method=post>
  <tr><td valign="top" class="table_border">
  <table border="0" align="center" cellpadding="3" cellspacing="0" width="100%">
  
   <tr height=40><td colspan="2"><font size="3" class="detail9txt"><b>
&nbsp;&nbsp;&nbsp;&nbsp;Subscribe to Stores: Choose Your Subscription Level  </b></font> </td></tr>
<?
	function diplay_plans($plan_id)
	{		
		$plan_select_query="select * from plan where status='active'";
		$plan_select_result=mysql_query($plan_select_query);
		$length=1;
		while($plan_select_row=mysql_fetch_array($plan_select_result)) 
		{
		$planid=$plan_select_row['plan_id'];
		$scheme=$plan_select_row['scheme'];
		$amount=$plan_select_row['amount'];
		$period=$plan_select_row['period'];
		$plan_description=$plan_select_row['plan_description'];
		$period_type=$plan_select_row['period_type'];
		if($period_type==1) $periodtype='Days';
		else if($period_type==2) $periodtype='Months';
		else if($period_type==3) $periodtype='Years';
		if($amount==0 || $amount=='0.00')
		$amount="Free";
?>
	<tr class="detail6txt">
	<td width=5%><input type="radio" name="rdPlans" value="<?=$planid?>" <? if($length==1) echo 'Checked';else if($planid==$plan_id) echo 'Checked';?>></td>
	<td width=90%><b>$&nbsp;<?=$amount; ?> for <?= $period ?> &nbsp; <?= $periodtype ?> ( <?=$scheme; ?>  ) .</b></td>
	</tr>
	<tr><td>&nbsp;</td> <td style="padding-left:20px;font-colr:gray" class="moretxt"><?= $plan_description  ?></td></tr>
<?
		$length+=1;
		}
		}
?>
<tr><td align=right colspan="2"><? diplay_plans($plan_id); ?></td></tr>
<input type="hidden" name=flag value="1">
<tr><td colspan="2" style="padding-left:50px">
<input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71','','images/continueo.gif',1)"/>
<!--<input type="submit" value="Continue" align="left">-->
</td></tr>
</table></td></tr>
</FORM>
</table>
<? require 'include/footer.php'; ?>