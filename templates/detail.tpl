<script src="js/PopBox.js" type="text/javascript"></script>
<script type="text/javascript">
function myScrollLeft() {
    var x = getScrollX(window.frames['scrollerFrame']);
//    if (x <= 0)  window.frames['scrollerFrame'].scrollTo(832, 0);
     window.frames['scrollerFrame'].scrollBy(-5, 0);
}

function myScrollRight() {
    var x = getScrollX(window.frames['scrollerFrame']);
  //  if (x >= 832)  window.frames['scrollerFrame'].scrollTo(0, 0);
     window.frames['scrollerFrame'].scrollBy(5, 0);
}

function getScrollX(frame) {
    var x = 0;
    if (typeof(frame.pageXOffset) == 'number') 
        x = frame.pageXOffset;
 
    else if (frame.document.body && frame.document.body.scrollLeft) 
        x = frame.document.body.scrollLeft;
 
    else if (frame.document.documentElement && frame.document.documentElement.scrollLeft) 
        x = frame.document.documentElement.scrollLeft;
 
    return x;
}
</script>
<script type="text/javascript" src="scripts/preview_templates.js">
</script>
<script type="text/javascript" src="scripts/loader.js">
</script>
<div id="content">
<div id="list"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="7"></td>
    </tr>
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="4%"><img src="images/back_bullet.jpg" alt="" width="20" height="20" /></td>
    <td width="35%" class="header_text2"><a href="browse_cate.php" class="header_text2">Voltar para a lista dos produtos </a></td>
    <td width="55%"><span class="detail1txt">Produto listado na categoria:</span>
	<?php
if($cat_sql_row[category_head_id])
{
	cat_display($cat_sql_row[category_head_id],$cat_string);
}
?>
<span class="header_text5"><a href="category.php?cate_id=<?php= $cat_sql_row[category_id] ?>" class="header_text5"><?php= $cat_sql_row[category_name] ?></a></span>
</td>
</tr>
<tr>
<td height="1" colspan="4" align="right">&nbsp;<span><font color="#FF0000"><b><?phpif($row[status]=='Closed')
	echo "Item Closed";?></b></font></span></td>
</tr>
</table>
</div>
<div id="detail"><table width="959" height="69" border="0" cellpadding="0" cellspacing="0" background="images/detailbgtop.jpg">
  <tr>
    <td width="31">&nbsp;</td>
    <td width="672" class="detail3txt"><?php=$row['item_title'];?></td>
    <td width="256" class="detail4txt">N&uacute;mero do Produto:  <?php=$row['item_id'];?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<?php
	if(empty($_SESSION['userid']) && $watch_flag!=1)
	{
	?>
	<span class="detail5txt">Bidder or seller of this item?</span> <span class="detail7txt"><a href="signin.php" class="detail7txt">Sign in</a></span> <span class="detail6txt">for your status</span>
	<?php
	}
   else if(!empty($warning))
   {
    ?>
		<font size="2" color="red">
   		<b> &nbsp;&nbsp;&nbsp;<?php= $warning?></b></font>
	<?php
  }
	else if($watch_flag==1)
	{
	$watch_tot_sql="select count(*) from watch_list where user_id=$user_id";
    $watch_ins_sql=mysql_query($watch_tot_sql);
	$watch_res_sql=mysql_fetch_array($watch_ins_sql);
	$watch_tot=$watch_res_sql[0];
	if($watch_flag_new==2)
	{
	?>
	<span class="detail5txt">This item is being watched in My Auction</span> <span class="detail7txt" style="text-decoration:none; cursor:default">( <?php= $watch_tot?> items in watchlist )</span>
	<?php
	}
	else if($watch_flag_new==1)
	{
	?>
	<span class="detail5txt">This item is Already watched in My Auction</span> <span class="detail7txt" style="text-decoration:none; cursor:default">( <?php= $watch_tot?> items in watchlist )</span>
	<?php
	}
	else if($watch_flag_new==3)
	{
	?>
	<span class="detail5txt">Item cannot be watched</span> <span class="detail7txt" style="text-decoration:none; cursor:default">( Item Closed )</span>
	<?php
	}
	}
	else if(!empty($mode))
	{
	?>
	<span><font color="#FF0000" size="3px"><b>Item Purchased Successfully!</b></font></span> 
	<?php
	}
	?>
	</td>
    <td><span class="detail7txt"><a href="detail.php?item_id=<?php= $row['item_id'] ?>&mode=watch" class="detail7txt">Seguir este produto </a></span>  <span class="detail6txt">|</span>  <span class="detail7txt"><a href="forward_to_friend.php?item_id=<?php= $row['item_id']; ?>" class="detail7txt">Enviar para um amigo </a></span></td>
  </tr>
</table><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="4"></td>
  </tr>
</table>
<?php
if(!empty($row['videofile']) || !empty($row['videolink']))
{
?>
<div class="detailtablebg1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="8"></td>
            </tr>
            <tr>
              <td valign="top"><table width="178" height="278" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
				  <?php
				 if($row['videofile'])
				  {
			 /*	  function unhtmlentities ($string)
                  {
                        $trans_tbl = get_html_translation_table (HTML_ENTITIES);
                        $trans_tbl = array_flip ($trans_tbl);
                        return strtr ($string, $trans_tbl);
                  }

 $videofile = unhtmlentities($row['videofile']);
 */
// $videofile=html_entity_decode($row['videofile']);
				// $videofile=html_entity_decode($row['videofile']);
				  ?>
				  <div align="center"><?php=stripslashes($row['videofile']);?></div>
				  <?php
				  }
				  else if($row['videolink'])
				  {
				  ?>
				  <div align="center">
				  <iframe src="<?php=$row['videolink'];?>" scrolling="yes" height="355" width="425">
				  </iframe>
				  </div>
				  <?php
				  }
				  ?>
				  </td>
                </tr>
              </table></td>
            </tr>
            
            
          </table></td>
          <td valign="top"><table width="100%" height="250" border="0" cellpadding="5" cellspacing="0">
		  <?php
		  if($row['selling_method']=="auction" or $row['selling_method']=="dutch_auction")
		  {
		  ?>
		  
            <tr>
              <td width="38%" class="banner1">Lance Atual </td>
              <td width="3%" class="banner1">:</td>
              <td width="58%" class="detail8txt"><?php echo $row['currency']." ".$current_price; ?><br />
			  <?phpif($row['reserve_price']!="0.00")
{ 
if($row['reserve_price'] <= $current_price )
{ 
?>
( <font class="header_text5">Pre&ccedil;o de reserva atingido </font>)
<?php
}
else
{
?>
( Pre&ccedil;o de reserva n&atilde;o atingido)
<?php
}
}
?>			  </td>
            </tr>
            <tr>
              <td class="banner1">Inicio da Oferta </td>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php echo $row['currency']." ".$row['min_bid_amount'];?></td>
            </tr>
            <tr>
              <td colspan="3"><div align="left"><img src="images/detailline.gif" alt="" width="269" height="1" /></div></td>
            </tr>
            <tr>
              <td class="banner1">Quantidade</td>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php echo $row['Quantity'];?></td>
            </tr>
			<?php 
if(($row[privatelistings]=="No") or empty($row[privatelistings]))
{
?>
            <tr>
              <td class="banner1">Hist&oacute;rico do leil&atilde;o </td>
              <td class="banner1">:</td>
			  <?php 
		   if($tot[0]!=0)
		  {
		  ?>
		  <td><a href="bidhistory.php?item_id=<?php= $row['item_id']?>" class="header_text2"><?php echo $tot[0];?></a></td>
		  <?php
		  }
		  else
		  {
		  ?>
          <td width="1%" class="detail8txt">-</td>
		  <?php
		  }
		  ?>
          </tr>
<?php
}
?>
            <tr>
              <td class="banner1">Maior lance </td>
              <td class="banner1">:</td>
			  <?php 
		   if($highest_bidder)
		  {
		  ?>
		  <td class="detail8txt"><a href="feedback.php?user_id=<?php=$max['user_id'];?>" class="header_text2">
		  <?php echo $highest_bidder;?></a>&nbsp;&nbsp;&nbsp;&nbsp;( <a href="feedback.php?user_id=<?php=$max['user_id'];?>" class="header_text2"><?php echo $high_feed_tot[feedbacktotal]; ?></a><?php if($feedback_highimg!='') { ?><img src="images/<?php= $feedback_highimg ?>" /><?php } ?> )</td>
		  <?php
		  }
		  else
		  {
		  ?>
          <td class="detail8txt">-</td>
		  <?php
		  }
		  ?>
          </tr>
			<?php
			}
			else
			{
			?>
			<tr>
              <td width="38%" class="banner1">Pre&ccedil;o</td>
              <td width="3%" class="banner1">:</td>
              <td width="58%" class="detail8txt"><?php echo $row['currency']." ".$row[quick_buy_price]; 
$current_price=$row[quick_buy_price]; ?></td>
            </tr>
            <!--<tr>
              <td class="banner1">Starting Bid</td>
              <td class="banner1">:</td>
              <td class="detail8txt">$ 66.00</td>
            </tr>
			<tr>
              <td colspan="3"><div align="left"><img src="images/detailline.gif" alt="" width="269" height="1" /></div></td>
            </tr>-->
			<?php
			}
			?>
            <tr>
              <td class="banner1">O produto expira em </td>
              <td class="banner1">:</td>
			  <?php
		      $expire_date=$row['expire_date'];
              require 'ends.php';
		      ?>
              <td class="detail8txt"><?php echo "$string_difference" ;?></td>
            </tr>
            <tr>
              <td colspan="3"><div align="left"><img src="images/detailline.gif" alt="" width="269" height="1" /></div></td>
            </tr>
            <tr>
              <td class="banner1">Custo do envio </td>
              <td class="banner1">:</td>
			  <?php if(!empty($row['shipping_cost']))
				  {
        	  	  ?>
        		  	<td class="detail8txt"><?php echo $row['currency']." ".$row['shipping_cost'];?></td>
		 	 	  <?php 
		  		  }
		 		 else
		  		  {
		  		  ?>
             		<td class="detail8txt">-</td>
			 	  <?php
			  	  }
			  	  ?>
            </tr>
            <tr>
              <td class="banner1">Imposto sobre a venda </td>
              <td class="banner1">:</td>
			  <?php if(!empty($row['tax']))
		  		{
        	   ?>
			   <td class="detail8txt"><?php echo $row['tax'];?> %</td>
		 	   <?php
		       }
		        else
		       {
		       ?>
              	<td class="detail8txt">-</td>
			   <?php
			   }
			   ?>
            </tr>
            <tr>
              <td class="banner1">Envio de </td>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php echo $country['country'];?></td>
            </tr>
            <tr>
              <td class="banner1">para</td>
              <td class="banner1">:</td>
			  <?php if(!empty($row['shipping_route']))
		  		{
          	  ?>
              		<td class="detail8txt"><?php
   					 $shipping_array=$row['shipping_route'];
					 $shipping=explode(",",$shipping_array);
   					 $ship_sql="select * from shipping_location";
    				 $ship_res=mysql_query($ship_sql);
   					 $total=mysql_num_rows($ship_res);
    				 $j=1;
    				while($ship_row=mysql_fetch_array($ship_res))
   					 {
						for($i=0;$i<=$total;$i++)
						{
							if($ship_row['ship_id']==$shipping[$i])
								{
								?>
									<?php=$ship_row[location];?>&nbsp;
								<?php
								}
						}
					}
				?></td>
			  <?php
			  }
			  else
			  {
			  ?>
			  <td class="detail8txt">-</td>		
			  <?php
			  }
			  ?>
            </tr>
			 <tr>
              <td class="banner1">Condi&ccedil;&otilde;es do produto  </td>
              <td class="banner1">:</td><td style="font-size:small;color:#FF0000"><?php=$row['item_specify']?></td></tr>
			<?php
		$cat_sql="select * from cat_slave where category_id=".$row['category_id'];
        if($custom_res=mysql_query($cat_sql))
        {
        $customrow=mysql_fetch_array($custom_res);
        $tablename=$customrow[tablename];
              
  		if($tablename)
		{
		$tab_sql="select * from $tablename";
		$tab_res=mysql_query($tab_sql);
		$i = 2;
		while ($i < mysql_num_fields($tab_res))
		{
       $tab_col = mysql_fetch_field($tab_res, $i);
       $table_sql="select * from $tablename where item_id=$item_id";
	   $table_res=mysql_query($table_sql);
       $tablerow=mysql_fetch_array($table_res);
   	  ?>
  <tr>
  <td class="banner1"><?php=  $tab_col->name; ?></td><td class="banner1">:</td><td class="detail8txt"><?php= $tablerow[$tab_col->name] ?>		</td>
</tr>
<?php	  
$i++;
} // while
}
}
?>
          </table></td>
        </tr>
      </table></td>
      <td valign="top"><table width="200" height="264" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="200" height="28"><table width="200" height="28" border="0" cellpadding="0" cellspacing="0" background="images/sellerbg.gif">
            <tr>
              <td width="17">&nbsp;</td>
              <td width="200" class="detail9txt">Informa&ccedil;&otilde;es sobre o vendedor </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table style="border-left:1px solid #b7daec; border-right:1px solid #b7daec; border-bottom:1px solid #b7daec" width="200" height="252" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="14">&nbsp;</td>
              <td width="73" class="banner1">Vendedor</td>
              <td width="16">:</td>
              <td width="200" class="detail8txt"><span class="detail8txt"><a href="feedback.php?user_id=<?php=$row['user_id'];?>" class="detail8txt"><?php echo $user['user_name'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>( <a href="feedback.php?user_id=<?php=$row['user_id'];?>" class="detail8txt"><?php echo $feed_tot[feedbacktotal]; ?></a><?php if($feedback_img!='') { ?><img src="images/<?php= $feedback_img ?>" /><?php } ?> )</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="banner1">Coment&aacute;rios</td>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php echo $feed_tot[feedbacktotal]; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="banner1">Membro</td>
              <td class="banner1">:</td>
              <td class="detail8txt">Membro desde 
                <?php
  $custom_date=explode(" ",$user['date_of_registration']);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo $custom_date[0]; ?>. Pa&iacute;s: <?php= $country['country']; ?></td>
            </tr>
            <tr>
              <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="6%">&nbsp;</td>
                  <td width="9%"><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td width="85%" class="header_text2"><a href="feedback.php?user_id=<?php=$row['user_id'];?>" class="header_text2">Veja Coment&aacute;rios Detalhados </a></td>
                </tr>
                <tr>
                  <td height="4"></td>
                  </tr>
				<?php
				 $admin_cat_sort="select * from admin_settings where set_id=45";
			     $admin_cat_res=mysql_query($admin_cat_sort);
				 $admin_catrow=mysql_fetch_array($admin_cat_res);
				 if($admin_catrow[2]==2)
				{	
				if($_SESSION[userid]!='')
				{	
					if($row[user_id]!=$_SESSION[userid])
					{
					?>
               	  <tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="ask_seller_qus.php?item_id=<?php= $row[item_id]; ?>" class="header_text2">Fa&ccedil;a uma pergunta ao vendedor </a></td>
                </tr>
				<?php
				}
				}
				}
				?>
                <tr>
                   <td height="4"></td>
                  </tr>
                <!--<tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="add" class="header_text2">Add to Favorite Sellers</a></td>
                </tr>-->
                <tr>
                 <td height="4"></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="search.php?seller_id=<?php=$row['user_id']; ?>&mode=sellers_item" class="header_text2">Veja outros produtos deste vendedor </a></td>
                </tr>
                <tr>
                    <td height="4"></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="detail.php?item_id=<?php= $item_id ?>#view" class="header_text2">Veja perguntas e coment&aacute;rios </a></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
<?php
}
else
{
?>
<div class="detailtablebg1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="65%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="8"></td>
            </tr>
            <tr>
              <td><table style="border:1px solid #999999" width="178" height="278" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
				 <td><div align="center"> <?php
			  if(empty($row['picture1']))
			  {
			  $enlarge_flag=0;
				  ?>
				  <img src="images/no-image.gif" alt=""/>
				  <?php
			  }
			 else
				  {
				 // $enlarge_flag=1;
				  $img=$row['picture1'];
				   list($width, $height, $type, $attr) = getimagesize("images/$img");
				   $h=$height;
				   $w=$width;
				   if($h>250)	
				   {
				   $enlarge_flag=1;
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>160)
				  {
				  $enlarge_flag=1;
				  $nw=160;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
				  ?>
				  <?php
				  if($enlarge_flag==1)
				  {
				  ?>
				<!-- <img src="images/<?php=$row['picture1']?>" alt="" width="<?php=$w?>" height="<?php=$h?>" />-->
				 <img  id="imgBamburgh" alt=""
src="images/<?php=$row['picture1']?>" width="<?php=$w?>" height="<?php=$h?>"
pbshowcaption="true" class="PopBoxImageSmall" title="Click to magnify/shrink"
onclick="Pop(this,50,'PopBoxImageLarge');" />
				  <?php
				  }
				  else
				  {
				  ?>
				  <img src="images/<?php=$row['picture1']?>" width="<?php=$w?>" height="<?php=$h?>">
				  <?php
				  }
				  }
				  ?></div><div id="img" style=""></div></td>
                </tr>
				
              </table></td>
            </tr>
            <tr>
              <td height="5"></td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
               <td width="65%" class="banner1" style="padding-left:30px">
			   <?php
			   if($enlarge_flag==1)
			   {
			   ?>
			   Clique na imagem para ampliar
			   <?php
			   }
			   ?>
			   </td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td valign="top"><table width="100%" height="250" border="0" cellpadding="0" cellspacing="0">
		  <?php
		  if($row['selling_method']=="auction" or $row['selling_method']=="dutch_auction")
		  {
		  ?>
		  
            <tr>
              <td width="38%" class="banner1">Lance Atual </td>
              <td width="3%" class="banner1">:</td>
              <td width="58%" class="detail8txt"><?php echo $row['currency']." ".$current_price; ?><br />
			  <?phpif($row['reserve_price']!="0.00")
{ 
if($row['reserve_price'] <= $current_price )
{ 
?>
( <font class="header_text5">Pre&ccedil;o de reserva atingido </font> )
<?php
}
else
{
?>
(Pre&ccedil;o de reserva n&atilde;o atingido <font class="header_text5">&nbsp;</font> )
<?php
}
}
?>			  </td>
            </tr>
            <tr>
              <td class="banner1">Inicio da Oferta </td>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php echo $row['currency']." ".$row['min_bid_amount'];?></td>
            </tr>
            <tr>
              <td colspan="3"><div align="left"><img src="images/detailline.gif" alt="" width="269" height="1" /></div></td>
            </tr>
            <tr>
              <td class="banner1">Quantitade</td>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php echo $row['Quantity'];?></td>
            </tr>
			<?php 
if(($row[privatelistings]=="No") or empty($row[privatelistings]))
{
?>
            <tr>
              <td class="banner1">Hist&oacute;rico do leil&atilde;o </td>
              <td class="banner1">:</td>
			  <?php 
		   if($tot[0]!=0)
		  {
		  ?>
		  <td><a href="bidhistory.php?item_id=<?php= $row['item_id']?>" class="header_text2"><?php echo $tot[0];?></a></td>
		  <?php
		  }
		  else
		  {
		  ?>
          <td width="1%" class="detail8txt">-</td>
		  <?php
		  }
		  ?>
          </tr>
<?php
}
?>
            <tr>
              <td class="banner1">Maior Lance </td>
              <td class="banner1">:</td>
			  <?php 
		   if($highest_bidder)
		  {
		  ?>
		  <td class="detail8txt"><a href="feedback.php?user_id=<?php=$max['user_id'];?>" class="header_text2">
		  <?php echo $highest_bidder;?></a>&nbsp;&nbsp;&nbsp;&nbsp;( <a href="feedback.php?user_id=<?php=$max['user_id'];?>" class="header_text2"><?php echo $high_feed_tot[feedbacktotal]; ?></a><?php if($feedback_highimg!='') { ?><img src="images/<?php= $feedback_highimg ?>" /><?php } ?> )</td>
		  <?php
		  }
		  else
		  {
		  ?>
          <td class="detail8txt">-</td>
		  <?php
		  }
		  ?>
          </tr>
			<?php
			}
			else
			{
			?>
			<tr>
              <td width="38%" class="banner1">Pre&ccedil;o</td>
              <td width="3%" class="banner1">:</td>
              <td width="58%" class="detail8txt"><?php echo $row['currency']." ".$row[quick_buy_price]; 
$current_price=$row[quick_buy_price]; ?></td>
            </tr>
            <!--<tr>
              <td class="banner1">Starting Bid</td>
              <td class="banner1">:</td>
              <td class="detail8txt">$ 66.00</td>
            </tr>
			<tr>
              <td colspan="3"><div align="left"><img src="images/detailline.gif" alt="" width="269" height="1" /></div></td>
            </tr>-->
			<?php
			}
			?>
            <tr>
              <td class="banner1">O produto expira em </td>
              <td class="banner1">:</td>
			  <?php
		      $expire_date=$row['expire_date'];
              require 'ends.php';
		      ?>
              <td class="detail8txt"><?php echo "$string_difference" ;?></td>
            </tr>
            <tr>
              <td colspan="3"><div align="left"><img src="images/detailline.gif" alt="" width="269" height="1" /></div></td>
            </tr>
            <tr>
              <td class="banner1">Custo do envio </td>
              <td class="banner1">:</td>
			  <?php if(!empty($row['shipping_cost']))
				  {
        	  	  ?>
        		  	<td class="detail8txt"><?php echo $row['currency']." ".$row['shipping_cost'];?></td>
		 	 	  <?php 
		  		  }
		 		 else
		  		  {
		  		  ?>
             		<td class="detail8txt">-</td>
			 	  <?php
			  	  }
			  	  ?>
            </tr>
            <tr>
              <td class="banner1">Imposto sobre a venda </td>
              <td class="banner1">:</td>
			  <?php if(!empty($row['tax']))
		  		{
        	   ?>
			   <td class="detail8txt"><?php echo $row['tax'];?> %</td>
		 	   <?php
		       }
		        else
		       {
		       ?>
              	<td class="detail8txt">-</td>
			   <?php
			   }
			   ?>
            </tr>
            <tr>
              <td class="banner1">Envio de </td>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php echo $country['country'];?></td>
            </tr>
            <tr>
              <td class="banner1">Para</td>
              <td class="banner1">:</td>
			  <?php if(!empty($row['shipping_route']))
		  		{
          	  ?>
              		<td class="detail8txt"><?php
   					 $shipping_array=$row['shipping_route'];
					 $shipping=explode(",",$shipping_array);
   					 $ship_sql="select * from shipping_location";
    				 $ship_res=mysql_query($ship_sql);
   					 $total=mysql_num_rows($ship_res);
    				 $j=1;
    				while($ship_row=mysql_fetch_array($ship_res))
   					 {
						for($i=0;$i<=$total;$i++)
						{
							if($ship_row['ship_id']==$shipping[$i])
								{
								?>
									<?php=$ship_row[location];?>&nbsp;
								<?php
								}
						}
					}
				?></td>
			  <?php
			  }
			  else
			  {
			  ?>
			  <td class="detail8txt">-</td>		
			  <?php
			  }
			  ?>
            </tr>
			<tr>
              <td class="banner1">Condi&ccedil;&atilde;o do Produto </td>
              <td class="banner1">:</td><td style="font-size:small;color:#FF0000"><?php=$row['item_specify']?></td></tr>
			 <?php
		$cat_sql="select * from cat_slave where category_id=".$row['category_id'];
        if($custom_res=mysql_query($cat_sql))
        {
        $customrow=mysql_fetch_array($custom_res);
        $tablename=$customrow[tablename];
              
  		if($tablename)
		{
		$tab_sql="select * from $tablename";
		$tab_res=mysql_query($tab_sql);
		$i = 2;
		while ($i < mysql_num_fields($tab_res))
		{
       $tab_col = mysql_fetch_field($tab_res, $i);
       $table_sql="select * from $tablename where item_id=$item_id";
	   $table_res=mysql_query($table_sql);
       $tablerow=mysql_fetch_array($table_res);
   	  ?>
  <tr>
  <td class="banner1"><?php=  $tab_col->name; ?></td><td class="banner1">:</td><td class="detail8txt"><?php= $tablerow[$tab_col->name] ?>		</td>
</tr>
<?php	  
$i++;
} // while
}
}
?>
          </table></td>
        </tr>
      </table></td>
      <td width="33%" valign="top"><table width="314" height="264" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="314" height="28"><table width="316" height="28" border="0" cellpadding="0" cellspacing="0" background="images/sellerbg.gif">
            <tr>
              <td width="17">&nbsp;</td>
              <td width="299" class="detail9txt">Informa&ccedil;&otilde;es sobre o vendedor </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table style="border-left:1px solid #b7daec; border-right:1px solid #b7daec; border-bottom:1px solid #b7daec" width="314" height="236" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="14">&nbsp;</td>
              <td width="73" class="banner1">Vendedor</td>
              <td width="16">:</td>
              <td width="209" class="detail8txt"><span class="detail8txt"><a href="feedback.php?user_id=<?php=$row['user_id'];?>" class="detail8txt"><?php echo $user['user_name'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>( <a href="feedback.php?user_id=<?php=$row['user_id'];?>" class="detail8txt"><?php echo $feed_tot[feedbacktotal]; ?></a><?php if($feedback_img!='') { ?><img src="images/<?php= $feedback_img ?>" /><?php } ?> )</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="banner1">Coment&aacute;rios</td>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php echo $feed_tot[feedbacktotal]; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="banner1">Membro</td>
              <td class="banner1">:</td>
              <td class="detail8txt">Membro desde <?php
  $custom_date=explode(" ",$user['date_of_registration']);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo $custom_date[0]; ?>.Pa&iacute;s: <?php= $country['country']; ?></td>
            </tr>
            <tr>
              <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="6%">&nbsp;</td>
                  <td width="9%"><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td width="85%" class="header_text2"><a href="feedback.php?user_id=<?php=$row['user_id'];?>" class="header_text2">Veja Coment&aacute;rios Detalhados </a></td>
                </tr>
                <tr>
                  <td height="4"></td>
                  </tr>
				<?php
				 $admin_cat_sort="select * from admin_settings where set_id=45";
			     $admin_cat_res=mysql_query($admin_cat_sort);
				 $admin_catrow=mysql_fetch_array($admin_cat_res);
				if($admin_catrow[2]==2)
				{	
			      	if($_SESSION[userid]!='')
				    {		
					  if($row[user_id]!=$_SESSION[userid])
					  {
					  ?>
               	  <tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="ask_seller_qus.php?item_id=<?php= $row[item_id]; ?>" class="header_text2">Fa&ccedil;a uma pergunta ao vendedor </a></td>
                </tr>
				<?php
				}
				}
				}
				?>
                <tr>
                   <td height="4"></td>
                  </tr>
                <!--<tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="add" class="header_text2">Add to Favorite Sellers</a></td>
                </tr>-->
                <tr>
                 <td height="4"></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="search.php?seller_id=<?php=$row['user_id']; ?>&mode=sellers_item" class="header_text2">Veja outros produtos deste vendedor </a></td>
                </tr>
                <tr>
                    <td height="4"></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="detail.php?item_id=<?php= $item_id ?>#view" class="header_text2">Ver perguntas e coment&aacute;rios </a></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
	
  </table>
</div>
<?php
}
?>
</div>


<div id="detail">
  <div class="detail_bg">Descr&ccedil;&atilde;o do Produto </div>
  <div class="detailtablebg">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td align="center"> 
        <br />
        <?php
		if($row[clicks] >= 0)
		{
		?>
		<font size=2>Este artigo foi visto </font>
		    <?php if($row[item_counter_style]==1)
			{ 
			?>
			<b><font size=+1 color="#009900">
		    <?php= $row[clicks]+1; ?>
			</font>			</b>
			<?php
			}
		    else
			{ ?>
               <b><I><font size=+1 color="#003399">
		    <?php= $row[clicks]+1; ?>
			</font>
			</I></b>			
             <?php
		     }
		     ?> vezes. </font>
		<?php
		}
		?>
</td>
	</tr>
   	<tr><td colspan="2" align="center">
	<?php 
	if($row[themes_id] || ($row[themes_id]==0))
    {
	/*$img=$theme_top;
    list($width, $height, $type, $attr) = getimagesize("images/$img");*/
	?>
   <table width="100%" cellpadding="3" cellspacing="0" align="center" <?phpif(!empty($row[themes_id])){?><?php}?>>
<tr><td background="images/<?php= $theme_top ?>" style="background-repeat:no-repeat"  align="left" valign="top" height="60px">
</td></tr>
   <tr><td background="images/<?php= $theme_content ?>"  style="background-repeat:repeat-y" align="left" valign="top">
   <?php
     if($row[layout]=="layout_top.gif")
   {
   ?>
   <table width=100% cellpadding="5">
   <tr><td align="center">
   <?php if($row[picture1])
   {  
                   $img=$row[picture1];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td style="padding:50px">  <?php= stripslashes($row[detailed_descrip]); ?>  </td></tr>
   
   <tr><td align="center">
   <?php if($row[picture2])
   {  
                   $img=$row[picture2];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   
   <tr><td align="center">
   <?php if($row[picture3])
   {  
                   $img=$row[picture3];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture4])
   {  
                   $img=$row[picture4];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture5])
   {  
                   $img=$row[picture5];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture6])
   {  
                   $img=$row[picture6];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture7])
   {  
                   $img=$row[picture7];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture7] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   </table>
   <?php
    } // end of top layout
   ?> 
      <?php
   if($row[layout]=="layout_bottom.gif")
   {
   ?>
   <table width=100% cellpadding="5" >
    <tr><td style="padding:50px" >  <?php= stripslashes($row[detailed_descrip]); ?>  </td></tr>
   <tr><td align="center">
   <?php if($row[picture1])
   {  
                   $img=$row[picture1];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
  
   
   <tr><td align="center">
   <?php if($row[picture2])
   {  
                   $img=$row[picture2];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   
   <tr><td align="center">
   <?php if($row[picture3])
   {  
                   $img=$row[picture3];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture4])
   {  
                   $img=$row[picture4];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture5])
   {  
                   $img=$row[picture5];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture6])
   {  
                   $img=$row[picture6];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture7])
   {  
                   $img=$row[picture7];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture7] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   </table>
   <?php
   } // end of bottom layout
   ?> 
   <?php
   if($row[layout]=="layout_left.gif")
   {
   ?>
   <table width=100% cellpadding="5" >
   <tr><td align="left"><table>
   <tr><td align="center" style="padding-left:20px">
   <?php if($row[picture1])
   {  
                   $img=$row[picture1];
				   list($width, $height, $type,$attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
  
   
   <tr><td align="center">
   <?php if($row[picture2])
   {  
                   $img=$row[picture2];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   
   <tr><td align="center">
   <?php if($row[picture3])
   {  
                   $img=$row[picture3];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture4])
   {  
                   $img=$row[picture4];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture5])
   {  
                   $img=$row[picture5];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture6])
   {  
                   $img=$row[picture6];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture7])
   {  
                   $img=$row[picture7];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=200;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture7] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   </table></td><td style="padding:50px" valign="top">  <?php= stripslashes($row[detailed_descrip]); ?>  </td></tr>
   </table>
   <?php
    } // end of left layout
   ?> 
   <?php
   if($row[layout]=="layout_right.gif")
   {
   ?>
   <table width=100% cellpadding="5" >
   <tr>
   <td style="padding:30px" valign="top" width=50%>  <?php= stripslashes($row[detailed_descrip]); ?>  </td>
   <td>
   <table width=50%>
   <tr><td align="left">
   <?php if($row[picture1])
   {  
                   $img=$row[picture1];
				   list($width, $height, $type,$attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=300;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=300;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
  
   
   <tr><td align="left">
   <?php if($row[picture2])
   {  
                   $img=$row[picture2];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=100;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=100;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   
   <tr><td align="left">
   <?php if($row[picture3])
   {  
                   $img=$row[picture3];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=100;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=100;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="left">
   <?php if($row[picture4])
   {  
                   $img=$row[picture4];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=100;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=100;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="left">
   <?php if($row[picture5])
   {  
                   $img=$row[picture5];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=100;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=100;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="left">
   <?php if($row[picture6])
   {  
                   $img=$row[picture6];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=100;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=100;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="left">
   <?php if($row[picture7])
   {  
                   $img=$row[picture7];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=100;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>200)
				  {
				  $nw=100;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture7] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   </table></td></tr>
   </table>
   <?php
   } // end of right layout
   else if($row[layout]=="")
   {
   ?>
   <table width=100% cellpadding="5">
   <tr><td align="center"><?php=$row['detailed_descrip']=stripslashes($row['detailed_descrip']);?></td></tr>
   <tr><td align="center">
   <?php if($row[picture1])
   {  
                   $img=$row[picture1];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture2])
   {  
                   $img=$row[picture2];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture3])
   {  
                   $img=$row[picture3];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture4])
   {  
                   $img=$row[picture4];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture5])
   {  
                   $img=$row[picture5];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture6])
   {  
                   $img=$row[picture6];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture7])
   {  
                   $img=$row[picture7];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture7]?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   </table>
   <?php
    }
	else if($row[layout]=="layout_standard.gif")
	{
	?>
   <table width=100% cellpadding="5">
   <tr><td align="center"><?php=$row['detailed_descrip']=stripslashes($row['detailed_descrip']);?></td></tr>
   <tr><td align="center">
   <?php if($row[picture1])
   {  
                   $img=$row[picture1];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture1] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture2])
   {  
                   $img=$row[picture2];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture2] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture3])
   {  
                   $img=$row[picture3];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture3] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture4])
   {  
                   $img=$row[picture4];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture4] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture5])
   {  
                   $img=$row[picture5];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture5] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture6])
   {  
                   $img=$row[picture6];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture6] ?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   <tr><td align="center">
   <?php if($row[picture7])
   {  
                   $img=$row[picture7];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
   
   ?>
   <img src="thumbnail/<?php= $row[picture7]?>" width=<?php= $w ?> height=<?php= $h ?> >  <?php } ?>
   
   </td></tr>
   </table>
  	<?php
	}
   ?> 
    </td></tr>
  <?php
    /*$img=$theme_bottom;
    list($width, $height, $type, $attr) = getimagesize("images/$img");*/
  ?>	
   <tr><td background="images/<?php= $theme_bottom ?>" style="background-repeat:no-repeat" width=100% align="left" height="60px">
   </td></tr>
   </table>
    <?php
	} // end of if($themes_id)
	else
	{
	?>
	 <tr align="center">
     <td><?php echo stripslashes($row['detailed_descrip']); ?></td>
     </tr>
     <?php
     }
     ?>
     </td></tr>
	
    </table>
  </div>
</div>
<!--<div id="detail">
  <div class="detail_bg">Shipping and Handling </div>
  <div class="detailtablebg">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td height="8"></td>
        </tr>
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="98%" class="detail9txt">Ships to </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td class="detailblacktxt"><?php
		if(!empty($row['shipping_route']))
		  		{
   					 $shipping_array=$row['shipping_route'];
					 $shipping=explode(",",$shipping_array);
   					 $ship_sql="select * from shipping_location";
    				 $ship_res=mysql_query($ship_sql);
   					 $total=mysql_num_rows($ship_res);
    				 $j=1;
    				while($ship_row=mysql_fetch_array($ship_res))
   					 {
						for($i=0;$i<=$total;$i++)
						{
							if($ship_row['ship_id']==$shipping[$i])
								{
								?>
									<?php=$ship_row[location];?>&nbsp;
								<?php
								}
						}
					}
				}
				else
				{
				echo "-";
				}
				?> </td>
      </tr>
      <tr>
        <td height="3"></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><table style="border:1px solid #999999" width="834" height="88" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="33" colspan="4"><table style="border-bottom:1px solid #cccccc" width="832" height="33" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="32" bgcolor="#f5f5f5">&nbsp;</td>
                <td width="240" bgcolor="#f5f5f5" class="detailblacktxt">Country</td>
                <td width="13" bgcolor="#f5f5f5" class="detailblacktxt">:</td>
                <td width="547" bgcolor="#f5f5f5"><label>
				<?php
				?>
                </label></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td width="32">&nbsp;</td>
            <td width="261" class="detail9txt">Shipping and Handling </td>
            <td width="230" class="detail9txt">To</td>
            <td width="309" class="detail9txt">Service</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="detailblacktxt"><?php echo $row['currency']." ".$row['shipping_cost'];?> </td>
            <td class="detailblacktxt">
			<?php
			if(!empty($row['shipping_route']))
		  		{
				 $shipping_array=$row['shipping_route'];
					 $shipping=explode(",",$shipping_array);
   					 $ship_sql="select * from shipping_location";
    				 $ship_res=mysql_query($ship_sql);
   					 $total=mysql_num_rows($ship_res);
    				 $j=1;
			while($ship_row=mysql_fetch_array($ship_res))
   					 {
						for($i=0;$i<=$total;$i++)
						{
							if($ship_row['ship_id']==$shipping[$i])
								{
								?>
									<?php=$ship_row[location];?>&nbsp;
								<?php
								}
						}
					}
				 }	
			?>
			</td>
            <td class="detailblacktxt">Standard Flat Rate Shipping Service</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="5"></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td class="detail9txt">Shipping Insurance </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td class="detailblacktxt">Not Offered </td>
      </tr>
      <tr>
        <td height="7"></td>
        </tr>
    </table>
  </div>
</div>-->

<div id="detail">
  <div class="detail_bg">Cross Promoted Items </div>
  <div class="detailtablebg">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td><td class="detail9txt">
		<?php
		if(!empty($row[crosspromote]))
		{
		?>
		<table>
		<div id="frameWrapper" align="center">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="180">
<tr>
    <td width="38" align="right">
	<div id="productScrollerLeft" onmouseover="scroller = setInterval(myScrollLeft, 30);" onmouseout="clearInterval(scroller);">
	<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image66','','images/leftscrollero.gif',1)">
	<img src="images/leftscroller.gif" name="Image66" width="22" height="207" border="0" id="Image66" /></a></div>	</td>
    <td valign="top" align="left"><iframe src="crosspromoteitems.php?item_id=<?php=$row['item_id']?>" name="scrollerFrame" id="scrollerFrame" frameborder="0" scrolling="no" allowtransparency="false" width="850" height="207"></iframe></td>
    <td width="38">
		<div id="productScrollerRight" onmouseover="scroller = setInterval(myScrollRight, 30);" onmouseout="clearInterval(scroller);">
			<a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image67','','images/rightscrollero.gif',1)"><img src="images/rightscroller.gif" name="Image67" width="22" height="207" border="0" id="Image67" /></a></div>
		<script>
myScrollRight();
</script>	</td>
</tr>
</table>
</div>
		</table>
		<?php
		}
		else
		{
		?>
		<table>
		<tr><td class="detail9txt">No Items Found</td></tr>
		</table>
		<?php
		}
		?>
		
        </td></tr></table>
 <!--   <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
        <td class="detail9txt">
		<?php if(empty($row[crosspromote]))
{
echo "<font size=2>No Items are Cross Promoted</font>";
}
else
{
$sqlpromoteitem="select * from placing_item_bid where item_id=$row[crosspromote]";
$sqlqrypromoteitem=mysql_query($sqlpromoteitem);
$sqlrowpromoteitem=mysql_num_rows($sqlqrypromoteitem);
if($sqlrowpromoteitem>0)
{
$sqlfetchpromoteitem=mysql_fetch_array($sqlqrypromoteitem);
if($sqlfetchpromoteitem['status']!='Closed')
{
?>
<table align="center" width="20%" border=0>
<tr height="30"><td  align="center"><strong>More Great Items From This Seller</strong></td></tr>
<?php
if(!empty($sqlfetchpromoteitem[picture1]))
{
$img=$sqlfetchpromoteitem[picture1];
				   list($width, $height, $type, $attr) = getimagesize("images/$img");
				   $h=$height;
				   $w=$width;
				   if($h>400)	
				   {
				   $nh=400;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>400)
				  {
				  $nw=400;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
?>
<tr><td align="center"><img src=images/<?php=$sqlfetchpromoteitem[picture1]?> height=<?php=$h?> width=<?php=$w?>></td></tr>
<?php
}
?>
<tr><td  align="center">
<a href=detail.php?item_id=<?php=$sqlfetchpromoteitem[item_id]?>><?php=$sqlfetchpromoteitem[item_title]?></a></td></tr>
</table>
<?php 
}
else
{
?>
<tr><td align="center"><font color="#FF0000"><b>The Item that was been promoted is closed.</b></font></td></tr>
<?php
}
}
else
{
?>
<tr><td align="center"><font color="#FF0000"><b>The Item that was been promoted is closed or removed from the site</b></font></td></tr>
<?php
}
}
?>

		</td>
      </tr>
    </table>-->
  </div>
</div>
<div id="detail">
  <div class="detail_bg">Formas de pagamento e Pol&iacute;tica de Devolu&ccedil;&atilde;o </div>
  <div class="detailtablebg">
  <?php
  $paymentgatewayid=$row['payment_gateway'];
  ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="9"></td>
        </tr>
      <tr>
        <td width="2%">&nbsp;</td>
        <td width="98%"><table style="border:1px solid #CCCCCC" width="836" height="150" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="834" height="33"><table style="border-bottom:1px solid #cccccc" width="834" height="33" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="22" bgcolor="#f5f5f5">&nbsp;</td>
                <td width="305" bgcolor="#f5f5f5" class="detail9txt">Formas de Pagamento </td>
                <td width="173" bgcolor="#f5f5f5" class="detail9txt">Preferred/Accepted</td>
                <!--<td width="334" bgcolor="#f5f5f5"><label class="detail9txt">Buyer Protection on eBay </label></td>-->
              </tr>
            </table></td>
          </tr>
		   <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<?php
		  if($paymentgatewayid==1)
		  {
		   ?>
              <tr>
                <td width="3%">&nbsp;</td>
                <td width="36%"><img src="images/paypal.gif" alt="" width="225" height="57" /></td>
                <td width="21%" class="detailblacktxt"><?phpif($paymentgatewayid==1){?>Aceito<?php}else{?>N&atilde;oAceito<?php}?></td>
                <!--<td width="40%"><img src="images/paypal1.gif" alt="" width="313" height="42" /></td>-->
              </tr>
			  <?php
			  }
			 if($paymentgatewayid==2)
			 {
			   ?>
              <tr>
                <td height="8"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="detailblacktxt"><img src="images/intgold.gif" alt="" width="225" height="57"/></td>
                <td class="detailblacktxt"><?phpif($paymentgatewayid==2){?>Aceito<?php}else{?>N&atilde;oAceito<?php}?></td>
                <!--<td class="detailblacktxt">Not Available </td>-->
              </tr>
			  <?php
			  }
			  if($paymentgatewayid==3)
			  {
			  ?>
			  <tr>
                <td height="8"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="detailblacktxt"><img src="images/egold.gif" alt="" width="225" height="57" /></td>
                <td class="detailblacktxt"><?phpif($paymentgatewayid==3){?>Aceito<?php}else{?>N&atilde;oAceito<?php}?></td>
                <!--<td class="detailblacktxt">Not Available </td>-->
              </tr>
			  <?php
			  }
			  if($paymentgatewayid==4)
			  {
			  ?>
			  <tr>
                <td height="8"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="detailblacktxt"><img src="images/money.gif" alt="" width="225" height="57" /></td>
                <td class="detailblacktxt"><?phpif($paymentgatewayid==4){?>Aceito<?php}else{?>N&atilde;oAceito<?php}?></td>
                <!--<td class="detailblacktxt">Not Available </td>-->
              </tr>
			  <?php
			  }
			  if($paymentgatewayid==5)
			  {
			  ?>
			  <tr>
                <td height="8"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="detailblacktxt"><img src="images/ebullion.gif" alt="" width="225" height="57" /></td>
                <td class="detailblacktxt"><?phpif($paymentgatewayid==5){?>Aceito<?php}else{?>N&atilde;oAceito<?php}?></td>
                <!--<td class="detailblacktxt">Not Available </td>-->
              </tr>
			  <?php
			  }
			  if($paymentgatewayid==6)
			  {
			  ?>
			  <tr>
                <td height="8"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="detailblacktxt"><img src="images/strompay.gif" alt="" width="225" height="57" /></td>
                <td class="detailblacktxt"><?phpif($paymentgatewayid==6){?>Aceito<?php}else{?>N&atilde;oAceito<?php}?></td>
                <!--<td class="detailblacktxt">Not Available </td>-->
              </tr>
			  <?php
			  }
			  ?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
    <td height="8"></td>
        </tr>
      <!--<tr>
        <td>&nbsp;</td>
        <td class="header_text2"><a href="learn" class="header_text2">Learn about payment methods</a></td>
      </tr>-->
      <tr>
        <td height="8"></td>
        </tr>
    </table>
  </div>
</div>
<div id="detail">
  <div class="detail_bg">Pagamento e Pol&iacute;tica de Devolu&ccedil;&atilde;o </div>
  <div class="detailtablebg">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <?php
if($row[payment_instructions])
{
?>
<tr><td class="detailblacktxt">
<?php= $row[payment_instructions] ?>
</td></tr>
<?php
}
if($row[refund_method])
{
?>
<tr><td class="detailblacktxt">Refund will be given as <?php=$row[refund_method]?>
</td></tr>
<?php
}
if($row[refund_days])
{
?>
<tr><td class="detailblacktxt">
Refund will be given if returned within <?php=$row[refund_days]?> day[s].
</td></tr>
<?php
}
if($row[returnpolicy_instructions])
{
?>
<tr><td class="detailblacktxt">
<?php= $row[returnpolicy_instructions] ?>
</td></tr>
<?php
}
?>
    </table>
  </div>
</div>
<div id="detail">
  <div class="detail_bg">Perguntas ao vendedor </div>
  <div class="detailtablebg" id="view">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <?php $ask_sql="select * from ask_question where item_id=".$row[item_id];
		   $ask_res=mysql_query($ask_sql);
		   if(mysql_num_rows($ask_res)>0)
		   {
		   while($ask_row=mysql_fetch_array($ask_res))
		   {
		   if($ask_row[answer])
		   {
		?>
		<tr><td class="detail9txt"><img src="images/question.gif">&nbsp;&nbsp;
		<?php= $ask_row[question];?>
		</td></tr>
		<tr><td style="border-bottom:1px solid gray"; class="detail9txt">
		<img src="images/answer.gif">&nbsp;&nbsp;
		<?php= $ask_row[answer];?>
		</td></tr>
		<?php
		}
		}
		}
		else
		{
		?>
      <tr>
        <td>&nbsp;</td>
        <td class="detail9txt">Nenhuma pergunta efetuada a este vendedor </td>
      </tr>
	  <?php
	  }
	  ?>
    </table>
  </div>
</div>

<div id="detail">
  <div class="detail_bg">
  <?php 
$chkstartdate_sql="select to_days(now())-to_days(bid_starting_date) as days from placing_item_bid where item_id=".$row['item_id'];
$chkstartdate_sqlqry=mysql_query($chkstartdate_sql);
$chkstartdate_fetch=mysql_fetch_array($chkstartdate_sqlqry);
$today_date=$chkstartdate_fetch['days'];
  if(($row[selling_method]=="auction" or $row[selling_method]=="dutch_auction"))
  echo "Ready to bid or buy?";
  else if($row[selling_method]=="fix")
  echo "Ready to buy?";
  ?>
  </div>
  <div class="detailtablebg">
 <?php

if($row[selling_method]=="auction" or $row['selling_method']=="dutch_auction")
 {
 ?>
  <table width="900" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top" width="50%">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="6"></td>
        </tr>
      <tr>
        <td width="4%">&nbsp;</td>
        <td width="96%" class="detail5txt">Coloque uma Oferta </td>
      </tr>
	  <form name="bid_form" action="bidding.php" method="post" onSubmit="return validate()">
      <tr>
        <td colspan="2"><table width="121%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="9%">&nbsp;</td>
            <td width="29%" class="banner1">Lan&ccedil;e Atual </td>
            <td width="1%">:</td>
            <td width="61%" class="detailblacktxt"><?php echo $row['currency']." ".$current_price;?></td>
          </tr>
          <tr>
            <td height="7"></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="banner1">Taxa</td>
            <td>:</td>
            <td class="detailblacktxt"><?php echo $row['currency']." ".$row['bid_increment']; ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td class="banner1">Seu lan&ccedil;e: </td>
            <td>:</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label>
        <input type="text" name="max_bid" <?php if(($row[Quantity]==0) or ($row[status]=='Closed') or ($today_date<0)){echo "disabled";}?>>
                </label></td>
              </tr>
              <tr>
             <td class="detailblacktxt">( Lan&ccedil;e Min&iacute;mo:<?php echo $row[currency]." ".($current_price+$row['bid_increment']) ?> ) </td>
              </tr>
			  
            </table></td>
          </tr>
          <tr>
            <td height="7"></td>
            </tr>
			<!--<tr><td>&nbsp;</td>-->
  <?php
   
 	if($row['selling_method']=="dutch_auction")
	{ 
	if($row[Quantity] > 0)
	{
	?>
	<!--<td height="27" class="banner1">Quantity</td><td>:</td>
    <td align="left">
	<select name=qty <?phpif($row[Quantity]==0 or $row[status]=='Closed'){echo "disabled";}?>>
	 <option value="Quantity">Quantity</option>
	<?php for($i=1;$i<=$row[Quantity];$i++)
	{
	?>
	 <option value="<?php= $i;?>"><?php= $i;?></option>
	<?php 
	}
	?>
	</select>-->
	<input type="hidden" name="qty" value="<?php=$row['Quantity']?>">
	<!--</td>-->
    <?php
	}
	
	?><!--</tr>-->
     <?php
     }
	 else
	 { 
	 ?>
		 <input type="hidden" name="qty" value="1">
	 <?php
	 }
	 ?>
          <tr>
            <td>&nbsp;</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="12%"><label>
 <input name="chk" type="checkbox" value="chk" <?phpif(($row[Quantity]==0) or ($row[status]=='Closed') or ($today_date<0)){echo "disabled";}?>>
                </label></td>
                <td width="88%" class="banner1">Desejo ser lembrado por email </td>
              </tr>
            </table></td>
            <td colspan="2"><input type="image" src="images/placeabid.gif" name="Image23" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image23','','images/placeabido.gif',1)" width="97" height="25" border="0" id="Image23" <?phpif(($row[Quantity]==0) or ($row[status]=='Closed') or ($today_date<0)){echo "disabled";}?>/></td>
			<input type="hidden" name=flag value=1>
		 <input type="hidden" name=err_flag value=<?php= $err_flag; ?>>
		<input type="hidden" name=item_id value=<?php= $item_id; ?> >
            </tr>
	          <tr>
            <!--<td>&nbsp;</td>-->
            <td>&nbsp;</td>
            <td colspan="3" class="banner1"><br />
            <font color="#336633"><b>Aviso:</b></font> O valor que est&aacute; ofertanto &eacute; para apenas 1 produto. </td>
          </tr>
        </table></td>
      </tr>
	  </form>
    </table></td>
	 <?php
   if($row[quick_buy_price]!=0)
   {
   if(($row['reserve_price'] >= $current_price or $row['reserve_price']==0.00) || ($row[cur_price]<$row[quick_buy_price]))
   {
   ?>
	<td valign="top" width=50%>
	<table width="100%" height="177" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="6"></td>
        </tr>
      <tr>
        <td width="4%" height="19">&nbsp;</td>
        <td width="96%" class="detail5txt">Compre Agora </td>
      </tr>
	  <tr>
        <td height="122" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr><td align="center" class="banner2"><br>
Valor:
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php= $row['currency']; ?> <?php= $row['quick_buy_price']; ?>
<br>
<br></td></tr>
<form name="fix_form" action="detail.php" method="post">
<input type="hidden" name="qty" value="<?php=$row[Quantity];?>">
<input type="hidden" value=1 name=flag>
<input type="hidden" value="<?php= $err_flag; ?>" name="err_flag" >
<input type="hidden" value="fix" name="sell_method">
<input type="hidden" value="<?php= $item_id;?>" name=item_id>
<input type="hidden" value="<?php= $row[quick_buy_price];?>" name="fixed_price">
<tr><td align="center">
<input type="image" src="images/buyit.gif" name="Image70" value="buy" width="81" height="24" border="0" id="Image70" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image70','','images/buyito.gif',1)" onClick="return confirm_buynow(<?php=$row[Quantity]?>)"; <?phpif(($row[Quantity]==0) or ($row[status]=='Closed') or ($today_date<0)){echo "disabled";}?>/>
</td></tr>
</form>
<tr><td class="banner2" align="center"><br />
<font color="#336633"><b>Aviso:</b></font> O valor apresentado &eacute; para a compra imediata de apenas 1 produto </td>
</tr>
<tr><td align="center" class="banner2">
  <br>
	 O <?php= $_SESSION[site_name]  ?>
	 <span title="" closure_uid_a9h9bi="99" xc="will inform the seller of your intent to purchase this item." yc="vai informar o vendedor da sua inten&ccedil;&atilde;o de compra deste item.    ">vai   informar o vendedor sobre a compra deste produto
	 </span><br>
	 <br>
	 <div id="gt-res-content">
       <div dir="ltr"><span id="result_box" lang="pt" xml:lang="pt"><span title="" closure_uid_a9h9bi="100" xc="Your purchase is a contract between you and the item seller." yc="Sua compra &eacute; um contrato entre voc&ecirc; eo vendedor item.  ">Sua compra   &eacute; um contrato entre voc&ecirc; e o vendedor deste produto.<br />
       </span><span title="" closure_uid_a9h9bi="101" xc="If you submit this purchase you will enter into a legally binding contract." yc="Se voc&ecirc; enviar esta compra ir&aacute; celebrar um contrato juridicamente vinculativo.">Se   voc&ecirc; enviar esta compra ir&aacute; prescrever um contrato juridicamente   vinculativo.</span></span></div>
	   </div></td></tr>
		</table></td></tr>
	  </table>
	</td>
	<?php
	}
	?>
	</tr></table>
	<?php
	}
	}
	else if($row['selling_method']=='fix')
	{
	?>
		<table width="100%" align="center" cellpadding="5" cellspacing="2" id=buyitnow>
		<tr height=15>
		  <td class="detail5txt">Compre Agora 
		<tr><td align="center" class="banner2"><br>
		<font size="2">Valor:</font>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php= $row['currency']; ?> <?php= $row['quick_buy_price']; ?>
		<br></td></tr>
		<form name="fix_form" action="detail.php" method="post">
	    <input type="hidden" name="qty" value="<?php=$row[Quantity];?>">
		<input type="hidden" value="1" name="flag">
		<input type="hidden" value="<?php= $err_flag; ?>" name="err_flag">
		<input type="hidden" value="fix" name="sell_method">
		<input type="hidden" value="<?php= $item_id;?>" name="item_id">
		<input type="hidden" value="<?php= $row[quick_buy_price];?>" name="fixed_price">
		<tr><td align="center"><input type="image" src="images/buyit.gif" name="Image70" width="81" height="24" border="0" id="Image70" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image70','','images/buyito.gif',1)" onClick="return confirm_buynow(<?php=$row[Quantity]?>)"; <?phpif(($row[Quantity]==0) or ($row[status]=='Closed') or ($today_date<0)){echo "disabled";}?>/></td></tr>
		</form>
		<tr><td class="banner2" align="center"><br />
		  <font color="#336633"><b>Aviso:</b></font> O valor apresentado &eacute; para a compra imediata de apenas 1 produto.</td>
		</tr>
		<tr><td align="center" class="banner2">
  		<br>
  		O
        <?php= $_SESSION[site_name]  ?>
        <span title="" closure_uid_a9h9bi="99" xc="will inform the seller of your intent to purchase this item." yc="vai informar o vendedor da sua inten&ccedil;&atilde;o de compra deste item.    ">vai   informar o vendedor sobre a compra deste produto</span>.<br>
        <br>
        <span title="" closure_uid_a9h9bi="100" xc="Your purchase is a contract between you and the item seller." yc="Sua compra &eacute; um contrato entre voc&ecirc; eo vendedor item.  ">Sua compra   &eacute; um contrato entre voc&ecirc; e o vendedor deste produto.<br />
        </span><span title="" closure_uid_a9h9bi="101" xc="If you submit this purchase you will enter into a legally binding contract." yc="Se voc&ecirc; enviar esta compra ir&aacute; celebrar um contrato juridicamente vinculativo.">Se   voc&ecirc; enviar esta compra ir&aacute; prescrever um contrato juridicamente   vinculativo</span>.</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
	<?php
	}
	?>
</div>
</div>
</div>
<script language="javascript">
function validate()
{
if(document.bid_form.max_bid.value=="")
{
alert("Please enter the Max bid amount");
document.bid_form.max_bid.focus();

return false;
}
if(document.bid_form.qty.value=="Quantity")
{
alert("Please select the Quantity");
document.bid_form.qty.focus();
return false;
}
document.bid_form.flag.value=1;
return true;
}
function confirm_buynow(qty)
{
if(qty==1)
var where_to= confirm("Por favor, clique aqui para confirmar a compra de apenas "+qty+" produto");
else
var where_to= confirm("Por favor, clique aqui para confirmar a compra de "+qty+" produtos");
if(where_to==true)
 {
  document.fix_form.submit();
 }
 else
 return false;
} 
</script>