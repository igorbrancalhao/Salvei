<script src="js/PopBox.js" type="text/javascript"></script>
<div id="content">
<div id="list"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="7"></td>
    </tr>
  <!--<tr>
    <td width="5%">&nbsp;</td>
    <td width="4%"><img src="images/back_bullet.jpg" alt="" width="20" height="20" /></td>
    <td width="51%" class="header_text2"><a href="back" class="header_text2">Back to list of items</a></td>
    <td width="40%"><span class="detail1txt">Listed in Category:</span><span class="header_text5"><a href="CELL" class="header_text5">Cell Phones</a></span> <span class="detail2txt">&gt;</span><span class="header_text5"><a href="PDAS" class="header_text5">PDA&rsquo;S</a></span> <span class="detail2txt">&gt;</span> <span class="header_text5"><a href="SMART" class="header_text5">Smartphones</a> </span></td>
  </tr>-->
  <tr>
 <td height="7"></td>
    </tr>
</table>
</div>
<div id="detail"><table width="959" height="69" border="0" cellpadding="0" cellspacing="0" background="images/detailbgtop.jpg">
  <tr>
    <td width="31">&nbsp;</td>
    <td width="672" class="detail3txt"><?php=$row['item_title']?> </td>
    <td width="256" class="detail4txt">Item Number: <?php=$row['item_id']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="detail7txt"><a href="forward_to_friend.php?item_id=<?php= $row['item_id']; ?>" class="detail7txt">Forward to friend</a></span></td>
  </tr>
</table><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="4"></td>
  </tr>
</table>

<div class="detailtablebg1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="8"></td>
            </tr>
            <tr>
              <td><table style="border:1px solid #999999" width="178" height="278" border="0" align="center" cellpadding="0" cellspacing="0">
			      <tr>
                  <td><div align="center">
				  <?php
			  if(!empty($row['picture1']) and file_exists("images/".$row['picture1']))
			  {
				  $img=$row['picture1'];
				   list($width, $height, $type, $attr) = getimagesize("images/$img");
				   $h=$height;
				   $w=$width;
				   if($h>200)	
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
				   if($enlarge_flag==1)
				  {
				  ?>
				   <img id="imgBamburgh" alt=""
src="images/<?php=$row['picture1']?>" width="<?php=$w?>" height="<?php=$h?>"
pbshowcaption="true" class="PopBoxImageSmall" title="Click to magnify/shrink"
onclick="Pop(this,50,'PopBoxImageLarge');" />
                    <?php
                   }
				   else
				   {
				   ?>
				   <img src="images/<?php=$row['picture1']?>" height="<?php=$h?>" width="<?php=$w?>" />
				   <?php
				   }
				
			  }
			 else
				  {
				  ?>
				  <img src="images/no-image.gif" alt=""/>
				  <?php
				  }
				   ?>
				  </div><div id="img" style=""></div></td>
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
			   Click the image to view a larger picture
			   <?php
			   }
			   ?>
			   </td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tr>
              <td width="39%" class="banner1">Title </td>
              <td width="8%" class="banner1">:</td>
              <td width="53%" class="detail8txt"><?php echo $row['item_title']; 
 ?></td>
            </tr>
            <tr>
              <td class="banner1">Ending</td>
			  <?php
		  $expire_date=$row['expire_date'];
          require 'ends.php';
		  ?>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php echo "$string_difference" ;?></td>
            </tr>
                       <tr>
              <td class="banner1">Started</td>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php 
		  $bid_startdate= explode(" ",$row['bid_starting_date']);
		  echo $bid_startdate[0];
		  ?></td>
            </tr>
            <tr>
              <td colspan="3"><div align="left"><img src="images/detailline.gif" alt="" width="269" height="1" /></div></td>
            </tr>
			<tr><td colspan="2" align="center">
<form method="post" action="wantitres.php">
<input type="hidden" name="item_id" value="<?php= $row[item_id]; ?>" />
<?php
if($_SESSION[userid]!=$row[user_id])
{
?>
<input type="submit" name="wntitnow" value="Respond">
<?php
}
?>
</form>
</td></tr>
          </table></td>
        </tr>
      </table></td>
      <td><table width="314" height="264" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="314" height="28"><table width="314" height="28" border="0" cellpadding="0" cellspacing="0" background="images/sellerbg.gif">
            <tr>
              <td width="17">&nbsp;</td>
              <td width="297" class="detail9txt">Resquester Information</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table style="border-left:1px solid #b7daec; border-right:1px solid #b7daec; border-bottom:1px solid #b7daec" width="314" height="236" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="14">&nbsp;</td>
              <td width="73" class="banner1">&nbsp; </td>
              <td width="16"></td>
              <td width="209" class="detail8txt"><span class="detail8txt"><a href="feedback.php?user_id=<?php=$row['user_id'];?>" class="detail8txt"><?php echo $user['user_name'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>( <a href="feedback.php?user_id=<?php=$row['user_id'];?>" detail8txt><?php echo $feed_tot[feedbacktotal]; ?></a><?php if($feedback_img!='') { ?><img src="images/<?php= $feedback_img ?>" /><?php } ?> )</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="banner1">Feedback</td>
              <td class="banner1">:</td>
              <td class="detail8txt"><?php echo $feed_tot[feedbacktotal]; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="banner1">Member</td>
              <td class="banner1">:</td>
              <td class="detail8txt">Member Since <?php
  $custom_date=explode(" ",$user['date_of_registration']);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo $custom_date[0]; ?> in <?php= $country; ?></td>
            </tr>
            <tr>
              <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="6%">&nbsp;</td>
                  <td width="9%"><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td width="85%" class="header_text2"><a href="feedback.php?user_id=<?php=$row['user_id'];?>" class="header_text2">See detailed feedback </a></td>
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
					if($row[user_id]!=$_SESSION[userid])
					{
					?>
               	  <tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="ask_seller_qus.php?item_id=<?php= $row[item_id]; ?>&type=w" class="header_text2">Ask a question</a></td>
                </tr>
				<?php
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
                  <td class="header_text2"><a href="wantitnowdes.php?item_id=<?php= $item_id ?>#view" class="header_text2">View Questions and Comments</a></td>
                </tr>
				<tr>
                 <td height="4"></td>
                  </tr>
                   <tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="wantitnowdes.php?item_id=<?php= $item_id ?>#response" class="header_text2">View Responses</a></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
</div>


<div id="detail">
  <div class="detail_bg">Description </div>
  <div class="detailtablebg">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr align="center" >
          <td class="detail9txt"><center><?php echo stripslashes($row['detailed_descrip']); ?></center></td>
        </tr>
		<tr><td align="center" class="detail9txt"> <center>
        <br />
        <?php
		if($row[clicks] > 0)
		{
		?>
		<font class="detail9txt"> This item has been viewed </font>
		    <?php if($row[item_counter_style]==1)
			{ 
			?>
			<b><font class="detail9txt">
		    <?php= $row[clicks]; ?>
			</font>
			</b>
			<?php
			}
		    else
			{ ?>
               <b><I><font class="detail9txt">
		    <?php= $row[clicks]; ?>
			</font>
			</I></b>			
             <?php
		     }
		     ?>
			times. </font>
		<?php
		}
		?></center>
</td></tr>
          
        </table></td>
      </tr>
      
    </table>
  </div>
</div>

<div id="detail">
  <div class="detail_bg">Question and Answers</div>
  <div class="detailtablebg" id=view>
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
        <td class="detail9txt">No Queries </td>
      </tr>
	  <?php
	  }
	  ?>
    </table>
  </div>
</div>

<div id="detail">
  <div class="detail_bg">Responses</div>
  <div class="detailtablebg" id=response>
    <table cellpadding="2" cellspacing="0" width="100%">
	
		  <?php 
		   $ask_sql="select * from want_it_now where wanted_itemid =".$row[item_id];
		   $ask_res=mysql_query($ask_sql);
		   if(mysql_num_rows($ask_res)>0)
		   {
		   $display=1;
		   ?>
		   <tr bgcolor="#DDDDDD" height=40 class="detail9txt"><td>&nbsp;</td><td><b>Item Title</b></td><td><b>Price</b></td><td><b># of Bids </b></td><td><b>Time Left</b></td></tr>
		   <?php
		   while($wantrow=mysql_fetch_array($ask_res))
		   {
		   if($display==1)
		   {
		   $display=2;
		   ?>
		   <tr >
		   <?php
		   }
		   else
		   {
		   $display=1;
		   ?>
		   <tr class="tr_color_2">
		   <?php
		   }
		   ?>
		   		 
		   <?php
 $item_sql="select * from placing_item_bid where item_id=$wantrow[responseed_itemid]";
$item_res=mysql_query($item_sql);
$record=mysql_fetch_array($item_res);
 
$bid_sql="select * from placing_bid_item where item_id=$record[item_id] and deleted='No'";
$bid_res=mysql_query($bid_sql);
$bid=mysql_fetch_array($bid_res);
$tot_bid=mysql_num_rows($bid_res);

if($tot_bid!=0)
{
$bid_max_sql="select max(bidding_amount) from placing_bid_item where item_id=$record[item_id] and deleted='No'";
$bid_max_res=mysql_query($bid_max_sql);
$bid_max_row=mysql_fetch_array($bid_max_res);
$current_price=$bid_max_row['0'];
//$current_price=$bid['cur_price'];
$no_bids=$tot_bid;
}
else
{
if($record['selling_method']=="auction" or $record['selling_method']=="dutch_auction")
{
$no_bids="No Bid";
$current_price=$record['min_bid_amount'];
}
else
{
$current_price=$record['quick_buy_price'];
$no_bids="No Bid";
}
}

if($record['selling_method']=="ads")
{
$current_price="-";
$no_bids="-";
}


$expire_date =$record[expire_date]; 
require 'ends.php';
if(!empty($record[picture1]) and file_exists("thumbnail/".$record['picture1']))
	{
	               $img=$record['picture1'];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>50)	
				   {
				   $nh=50;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>50)
				  {
				  $nw=50;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
                  ?>
	<td align="center">
	<?php
	if($record['selling_method']=='ads')
	{
	?>
	<img src="images/hands(11).gif" border="0">
	 <a href="classifide_ad.php?item_id=<?php echo $record['item_id']; ?>">
	 <?php
	 }
	 else
	 {
	 if($record['selling_method']=='fix')
	 {
	 ?>
	 <img src="images/buynow_icon.gif" border="0">
	 <?php
	 }
	 else
	 {
	 ?>
	  <img src="images/Auction(12).gif" border="0">
	 <?php
	 }
	 ?>
	 <a href="detail.php?item_id=<?php echo $record['item_id']; ?>">
	 <?php
	 }
	 ?>
	 <img  src="images/<?php echo $record['picture1']; ?>" border=0  width=<?php= $w; ?> height=<?php=$h?> ></a> </td>
	<?php
	 }
	 else
	 {
  	 ?>
     <td align="center">
	 <?php
	if($record['selling_method']=='ads')
	{
	?>
	 <img src="images/Auction(12).gif" border="0"><a href="classifide_ad.php?item_id=<?php echo $record['item_id']; ?>">
	 <?php
	 }
	 else
	 {
	 if($record['selling_method']=='fix')
	 {
	 ?>
	 <img src="images/buynow_icon.gif" border="0">
	 <?php
	 }
	 else
	 {
	 ?>
	  <img src="images/Auction(12).gif" border="0">
	 <?php
	 }
	 ?>
	 <a href="detail.php?item_id=<?php echo $record['item_id'];?>" class="header_text">
	 <?php
	 }
	 ?>
	 <img  src="images/no-image.gif" border=0 width=50 height=50 ></a> </td>
     <?php 
     }
    ?>		 
<td>
<?php
if($record['selling_method']=='ads')
{
?>
<a href="classifide_ad.php?item_id=<?php echo $record['item_id']; ?>" class="header_text"><?php=$record['item_title']; ?></a>
<?php
}
else
{
?>
<a href="detail.php?item_id=<?php echo $record['item_id']; ?>" class="header_text"><?php=$record['item_title']; ?></a>
<?php
}
?>
</td>
<td class="banner1"><?php= $record['currency']; ?><?php= $current_price; ?></td>
<td class="banner1"><?php= $no_bids ?></td>
<?php
$expire_date=$record[34];
require 'ends.php';
?>
<td class="banner1"><?php= $string_difference; ?></td> </tr>
<?php 
} //while

		}
		else
		{
		?>
		<tr><td align="center" colspan="4"><font class="errormsg">No Responses!</font></td></tr>
		<?php
		}
		?>
		 </table>
  </div>
</div>



</div>