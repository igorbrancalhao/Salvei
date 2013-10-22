<?php
/***************************************************************************
 *File Name				:promotelisting.tpl
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
 ?>
<?php require 'include/top.php'; ?>
<table width="780" border="0" cellpadding="0" cellspacing="0"  class="border2" >
    <link href="<?php= $ret1; ?>" rel="stylesheet" type="text/css">
<tr bgcolor="#eeeee1"><td valign="top" style="padding-left:10px">
<table border="0"  cellpadding="5" cellspacing="0" width="100%"  bgcolor="#eeeee1">
<tr height=40>
<td class="tr_border" colspan=2  ><font size="3"><b>Sell Your Item:Pictures & Details </b>
</font> </td></tr>
<tr class="sub_tr_border">
<td height="30" colspan="2">
  1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;Tittle & Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>3.Pictures & Details </b>4.&nbsp;Shipping Details & Sales Tax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;Preview & Submit </td>
</tr>
<tr><td >
<?php if($err_flag==1)
{ 
?>
<table width="100%" ><tr><td>
<img src="../images/warning_39x35.gif"></td>
<td><font size=2 color="red">The following must be corrected before continuing:</font></td></tr>
 <?php if(!empty($err_min_amt))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#txt_min_amt">Minimum Bid Amount</a> - <?php= $err_min_amt; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_fix_price))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#txt_quick">Quick Buy Price</a> - <?php= $err_fix_price; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_rev_price))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#txt_rev_price">Reserve Price</a> - <?php= $err_rev_price; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_revprice))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#txt_rev_price">Reserve Price</a> - <?php= $err_revprice; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_quickprice))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#txt_quick">Quick buy Price</a> - <?php= $err_quickprice; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_qty))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#txt_qty">Quantity</a> - <?php= $err_qty; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_dur))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#cbodur">Duration</a> - <?php= $err_dur; ?></td></tr>
<?php 
}
?>

<?php 
if(!empty($err_size_qty))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#size_of_qty">Size of Quantity</a> - <?php= $err_size_qty; ?></td></tr>
<?php 
} 
?>

<?php
if($bid_permission=='yes')
{
 if(!empty($err_bid_inc))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#txt_bid_inc">Bid Increment</a> - <?php= $err_bid_inc; ?></td></tr>
 <?php 
 } 
 }
?>

<?php if(!empty($err_img1))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#img1">Image1</a> - <?php= $err_img1; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_img2))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#img2">Image2</a> - <?php= $err_img2; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_img3))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#img3">Image3</a> - <?php= $err_img3; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_img4))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#img4">Image4</a> - <?php= $err_img4; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_img5))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#img5">Image5</a> - <?php= $err_img5; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_img6))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#img6">Image5</a> - <?php= $err_img6; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_img7))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="promotelistings.php#img7">Image5</a> - <?php= $err_img7; ?></td></tr>
<?php 
}
?>
</table></td></tr>
<tr><td>
<hr size="1" noshade class="hr_color"></td></tr>
<?php
}
?>
<tr><td><font size=2><b>Title:</b></font>&nbsp;&nbsp;<?php= $_SESSION[item_name]; ?></td></tr>
<tr><td><font size=2><b>Subtitle:</b></font>&nbsp;&nbsp;<?php= $_SESSION[subtitle]; ?></td></tr>
<tr  ><td colspan="2" class="tr_bottomless_border"><font size="2"><b> Pricing & Duration </b></font></td></tr>
<?php /* if(!empty($err_cur))
 {
 ?>
<tr><td>
<img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_cur; ?></font>
 <br><font size=2 color=red><b>Currency</b></font></td></tr>
<?php
}
else
{
?>
<tr><td><font size=2 ><b>Currency</b></font></td></tr>
<?php
} */
?>

<form name="promote_frm" action="promotelistings.php" method="post" enctype="multipart/form-data">

 <!-- <tr><td><select name=cbocurrency>
 <option value=0>Select</option>
<?php 
$cur_sql="select * from currency_master where statuss='show'";
$cur_res=mysql_query($cur_sql);
  while($currency_row=mysql_fetch_array($cur_res))
  {
  if(trim($currency_row['currency'])==trim($currency))
  {
  ?>
  <option value="<?php= $currency_row['currency'] ?>" selected><?php= $currency_row['currency']?></option>
  <?php 
  }
  else
  {
  ?>
  <option value="<?php= $currency_row['currency'] ?>"><?php= $currency_row['currency']?></option>
  <?php
  }
  }
  ?>
  </select>
</td></tr>  -->
 <?php
  if($admin_start_row['set_value']=='yes')
 {
 ?>
 <?php if($mode!="edit")
 {
 ?>
 <tr><td width=250><b><font size=2>Start Delay</font></b></td></tr>
 <tr><td width=250>
 <select name="cbo_start_delay" >
 <option value=0 name=cbo_start_delay selected>Start Immediately</option>
 <?php if($start_delay==1)
 {
 ?>
 <option value=1 name=cbo_start_delay selected>1 Days</option>
 <?php
 }
 else
 {
 ?>
 <option value=1 name=cbo_start_delay>1 Days</option>
 <?php 
 } 
 ?>
 <?php if($start_delay==2)
 {
 ?>
 <option value=2 name=cbo_start_delay selected>2 Days</option>
 <?php
 }
 else
 {
 ?>
 <option value=2 name=cbo_start_delay>2 Days</option>
 <?php 
 } 
 ?>
<?php if($start_delay==3)
{
?>
<option value=3 name=cbo_start_delay selected>3 Days</option>
<?php
}
else
{
?>
<option value=3 name=cbo_start_delay>3 Days</option>
<?php 
} 
?>
<?php if($start_delay==4)
{
?>
<option value=4 name=cbo_start_delay selected>4 Days</option>
<?php
}
else
{
?>
<option value=4 name=cbo_start_delay>4 Days</option>
<?php 
} 
?>
<?php if($start_delay==5)
{
?>
<option value=5 name=cbo_start_delay selected>5 Days</option>
<?php
}
else
{
?>
<option value=5 name=cbo_start_delay>5 Days</option>
<?php 
} 
?>
<?php if($start_delay==6)
{
?>
<option value=6 name=cbo_start_delay selected>6 Days</option>
<?php
}
else
{
?>
<option value=6 name=cbo_start_delay>6 Days</option>
<?php 
} 
?>
<?php if($start_delay==7)
{
?>
<option value=7 name=cbo_start_delay selected>7 Days</option>
<?php
}
else
{
?>
<option value=7 name=cbo_start_delay>7 Days</option>
<?php 
} 
?>
</select></td></tr>
<?php
}// if($mode=="edit")
 } // if($admin_start_row=='yes')
?>
<?php if($_SESSION[sell_format]=="2")
{
?>
 <tr><td>
 <?php if(!empty($err_qty))
 {
 ?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_qty?></font>
 <br>
 <b><font size=2 color=red>Quantity</font></b>
 <?php
 }
 else
 {
 ?>
 <b><font size=2>Quantity</font></b>
 <?php 
 }
// } //if($sell_format==2) online  667
 ?>
 </td> 
 <?php
 } //   if($_SESSION[sell_method]=="dutch_auction")
 ?>
 <?php 
 if($admin_end_row['set_value']=="yes")
 {
 ?>
 <td>
<?php if(!empty($err_dur))
 { 
 ?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_dur; ?></font>
 <br>
 <b><font size=2 color=red>Duration</font><font color="red">*</font></b>
 <?php
   }
  else
  {
 ?>
   <b><font size=2 >Duration</font><font color="red">*</font></b>
   <?php 
   }
    } //  if($admin_end_row=='yes')
   ?>
 </td>
</tr>
<?php if($_SESSION[sell_format]=="2")
{
?>
 <tr>
 <td width=250>
 <input type="text" name="txt_qty" class="txtsmall" value=<?php= $qty; ?>>
 </td>
  <?php
 }
 ?>
<td width=250>
<?php  if($admin_end_row['set_value']=='yes')
{
$auction_query="select * from auction_duration order by duration_id";
$table=mysql_query($auction_query);
?>
<select name="cbodur">
<option value="0">Select</option>
<?php
while($row=mysql_fetch_array($table))
{
?>
<?php if($dur==$row['duration'])
{
?>
<option value="<?php= $row['duration'] ?>" selected><?php= $row['duration'] ?> Days</option>
<?php
}
else
{
?>
<option value="<?php= $row['duration'] ?>" ><?php= $row['duration'] ?> Days</option>
<?php
}
} // while($row=mysql_fetch_array($table))
?>
</select>
</td>
<?php
}  // if($admin_end_row=='yes')
?>
</tr>
<!-- <tr><td><font size=2 ><b>Number of Auto Relists</b></font></td></tr>
 <tr>
 <td>
 <select name="repost">
 <option>Don't Use Auto Relist</option>
 <?php
 for($i=1;$i<=$repost;$i++)
 {
  if($repost ==$i)
    echo "<option selected>$i </option>";
 else
   echo "<option>$i </option>";
 }
 ?> 
 </select>
 </td>
 </tr> -->
<?php if($_SESSION[sell_format]!="3")
{
?>
<tr ><td colspan="2" class="tr_bottomless_border"><font size="2"><b>Auction</b></font></td></tr>
<tr><td width="250">
 <?php if(!empty($err_min_amt))
 {
 ?>
 <img src="../images/warning_9x10.gif">
 &nbsp;<font size=2 color=red><?php= $err_min_amt?></font>
 <br>
 <b><font size=2 color=red>Minimum Bid Amount</font><font color="red">*</font></b>
 <?php
 }
 else
 {
 ?>
 <b><font size=2 >Minimum Bid Amount</font><font color="red">*</font></b>
 <?php
 }
 ?>
 </td>
 <td>
<?php if(!empty($err_rev_price))
 {
 ?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_rev_price?></font>
 <br>
 <b><font size=2 color=red>Reserve Price</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Reserve Price</font></b>
   <?php 
   }
   ?>
    </td></tr>
<tr><td width=250><input type="text" name="txt_min_amt" class="txtsmall" value=<?php= $min_amt; ?>></td>
<td width=250><input type="text" name="txt_rev_price" class="txtsmall" value=<?php= $rev_price; ?>></td></tr>
<tr>
<td><b><font size=2>Private Listings</font></b></td>
<?php
if($bid_permission=='yes')
{ 
?>
<td>
 <?php if(!empty($err_bid_inc))
 {
 ?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_bid_inc?></font>
 <br>
 <b><font size=2 color=red>Bid Increment</font></b>
 <?php
 }
 else
 {
 ?>
 <b><font size=2>Bid Increment</font></b>
 <?php
  }
 ?>
 </td>
<?php
}
?> 
</tr>
<tr>
<td><input type="checkbox"  name=chkprivatelisting  value="yes" <?php if($_SESSION[privatelistings]) { ?> checked="checked" <?php  } ?> >Private Listings</td>
<?php if($bid_permission=='yes'){ ?>
<td width=250>
<input type="text" name="txt_bid_inc" class="txtsmall" value=<?php= $bid_inc; ?>></td>
<?php
}
?> 

</tr>

<tr  width=758><td colspan="2" class="tr_bottomless_border"><font size="2"><b>Fixed Price Sale</b></font></td></tr>
<tr>
                <td><b>Note:</b>This "Quick Buy " price is like a fixed auction. 
                  The "Quick Buy now" price will stay there until the reserve 
                  has been meet. Once the reserve is meet, the Quick Buy now goes 
                  away.</td>
              </tr>
<?php
} // if($_SESSION[sell_method]!="fix")

?>
<tr><td>
<?php if(!empty($err_fix_price) )
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_fix_price; ?></font>
 <br>
 <b><font size=2 color=red>Quick Buy Price</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2>Quick Buy Price</font></b>
   <?php 
   }
   ?>
 </td></tr>
 
 <tr>
<td width=250>
<input type="text" name="txt_quick" class="txtsmall" value=<?php= $quick; ?>></td></tr>
<tr width=758>
<td colspan="2" class="tr_bottomless_border"><font size="2"><b>Add Images</b></font></td></tr>
<tr><td>
<table class="mylist" width=150 cellpadding="5" cellspacing="2">
<tr><td>
<?php if(!empty($err_img1))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_img1; ?></font>
 <br>
 <b><font size=2 color=red>Image1</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Image1</font></b>
   <?php 
   }
   ?>
   <br />
    <input type="file" name="img1" value="<?php= $img1; ?>">
	<?php if(!empty($_SESSION[image1]))
	{
	?>
	<img src="../images/<?php= $_SESSION[image1] ?>" width=30 height=30>
	<?php
	}
	?>
	</td></tr>
	</table></td></tr>
	<?php 
	if($sell_format !="4")
	{
	if($member_account !="1")
	{
		?>
	<tr><td colspan="2">
  <?php if(!empty($err_img2))
  {
  ?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_img2; ?></font>
 <br>
 <b><font size=2 color=red>Image2</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Image2</font></b>
   <?php }
   ?>
   <br />
    <input type="file" name="img2" value=<?php= $img2; ?>>
	<?php if(!empty($_SESSION[image2]))
	{
	?>
	<img src="../images/<?php= $_SESSION[image2] ?>" width=30 height=30>
	<?php
	}
	?></td></tr>
<tr><td colspan="2">
<?php if(!empty($err_img3))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_img3; ?></font>
 <br>
 <b><font size=2 color=red>Image3</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Image3 </font></b>
   <?php 
   }
   ?>
    <br />
    <input type="file" name="img3" value=<?php= $img3; ?>>
	<?php if(!empty($_SESSION[image3]))
	{
	?>
		<img src="../images/<?php= $_SESSION[image3] ?>" width=30 height=30>
	<?php
	}
	?></td></tr>
	<tr><td colspan="2" >
<?php if(!empty($err_img1))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_img1; ?></font>
 <br>
 <b><font size=2 color=red>Image4</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Image4</font></b>
   <?php 
   }
   ?>
   <br />
    <input type="file" name="img4" value="<?php= $img4; ?>">
	<?php if(!empty($_SESSION[image4]))
	{
	?>
		<img src="../images/<?php= $_SESSION[image4] ?>" width=30 height=30>
	<?php
	}
	?></td></tr>
	<tr><td colspan="2" >
<?php if(!empty($err_img5))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_img5; ?></font>
 <br>
 <b><font size=2 color=red>Image5</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Image5</font></b>
   <?php 
   }
   ?>
   <br />
    <input type="file" name="img5" value="<?php= $img5; ?>">
	<?php if(!empty($_SESSION[image5]))
	{
	?>
		<img src="../images/<?php= $_SESSION[image5] ?>" width=30 height=30>
	<?php
	}
	?></td></tr>
	<tr><td colspan="2" >
<?php if(!empty($err_img6))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_img6; ?></font>
 <br>
 <b><font size=2 color=red>Image6</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Image6</font></b>
   <?php 
   }
   ?>
   <br />
    <input type="file" name="img6" value="<?php= $img6; ?>">
	<?php if(!empty($_SESSION[image6]))
	{
	?>
		<img src="../images/<?php= $_SESSION[image6] ?>" width=30 height=30>
	<?php
	}
	?></td></tr>
	<tr><td colspan="2">
<?php if(!empty($err_img7))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_img7; ?></font>
 <br>
 <b><font size=2 color=red>Image7</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Image7</font></b>
   <?php 
   }
   ?>
   <br />
    <input type="file" name="img7" value="<?php= $img7; ?>">
	<?php if(!empty($_SESSION[image7]))
	{
	?>
	<img src="../images/<?php= $_SESSION[image7] ?>" width=30 height=30>
	<?php
	}
	?></td></tr>
	<?php
	} // if($member_account !=1 )
	} // if($sell_format=!=4) on line 810
	?>
	
	<tr ><td colspan="2" class="tr_bottomless_border" >
	    <font size="2"><b>Listing Designer</b></font></td></tr>
	  	<tr><td colspan="2">
		<table cellpadding="5" cellspacing="2" width="600">
		<tr><td>
		<input type="checkbox" <?php if($listingdesinger) { ?> checked="checked" <?php  } ?> name=chklisting value="yes"  />Listing designer&nbsp;<br>
		<font color="#999999"> Get both a theme and layout to complement your listing. </font> </td></tr>
		<tr><td><b>Select a theme</b></td><td><b>Select a layout</b></td> </tr>
		<tr><td valign="top">
		<select name=cbotheme multiple="multiple" onchange="show(this.value)" style="width:150px;height:150">
		<option value="none.gif">None</option>
		<?php
		$theme_sql="select * from themes_master";
		$theme_res=mysql_query($theme_sql);
		while($theme_row=mysql_fetch_array($theme_res))
		{
		if($theme_row[theme_name]==$theme)
		{
		$theme_img=$theme_row[themes];
		?>
			<option value="<?php= $theme_row[themes] ?>" selected="selected"> <?php= $theme_row[theme_name] ?> </option>
		<?php
		}
		else
		{
		?>
			<option value="<?php= $theme_row[themes] ?>" > <?php= $theme_row[theme_name] ?> </option>
		<?php
		}
		}
		?>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<?php if($theme)
		{
		?>
		<img name="themeimg" src="../images/<?php=$theme_img; ?>"  id="themeimg" width="100" > 
		<?php
		}
		else
		{
		?>
		<img name="themeimg" src="../images/none.gif"  id="themeimg" width="100" > 
		<?php
		}
		?>
		</td><td>
		<select name=cbolayout multiple="multiple" onchange="showlayout(this.value)" style="width:150px;height:150">
		<?php
		if($layout=="layout_standard.gif")
		{
		?>
		<option value="layout_standard.gif" selected="selected" >Standard</option>
		<?php
		}
		else
		{		
		?>
		<option value="layout_standard.gif">Standard</option>
		<?php
		}
		?>
		<?php
		if($layout=="layout_top.gif")
		{
		?>
		<option value="layout_top.gif" selected="selected" >photo on the top</option>
		<?php
		}
		else
		{		
		?>
		<option value="layout_top.gif">photo on the top</option>
		<?php
		}
		?>
		<?php
		if($layout=="layout_left.gif")
		{
		?>
		<option value="layout_left.gif" selected="selected">photo on the left</option>
		<?php
		}
		else
		{		
		?>
		<option value="layout_left.gif">photo on the left</option>
		<?php
		}
		?>
		<?php
		if($layout=="layout_right.gif")
		{
		?>
		<option value="layout_right.gif" selected="selected" >photo on the right</option>
		<?php
		}
		else
		{		
		?>
		<option value="layout_right.gif">photo on the right</option>
		<?php
		}
		if($layout=="layout_bottom.gif")
		{
		?>
		<option value="layout_bottom.gif" selected="selected"  >photo on the bottom</option>
		<?php
		}
		else
		{		
		?>
		<option value="layout_bottom.gif">photo on the bottom</option>
		<?php
		}
		?>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<img name="layoutimg" src="../images/layout_standard.gif"  id="layoutimg" width="100" height="100"> 
		</td>
		</tr></table>
		</td></tr>
		<tr><td><a href="#" onClick="preview()" >Preview Listing</a></td></tr>
	<tr class="tr_border" width=758><td colspan="2"><font size="2"><b> Increase your item's visibility </b></font></td></tr>
	<tr><td>
	<br>
	<b><font size=2>Preview your listing in search results.</font></b>
    <br>
	<br>
	<table cellpadding="5" cellspacing="0"  class="table_border1" width="100%">
	<tr bgcolor="#eeeeee"><td>&nbsp;</td><td><b>Item</b></td>
	<td><b># of Bids</b></td><td><b>Price</b></td>
	<td><b>Ends</b></td></tr>
	<tr><td><img src="../images/gallery.png"></td>
	<td><u><font color="blue">This is an example with Gallery</font></u></td>
	<td>-</td>
	<td>$x.xx</td>
	<td>12h 50m</td></tr>
	<tr bgcolor="eeeeee"><td>&nbsp;</td>
	<td><u><font color="blue">Item Title</font></u>
	<br><br>
	Sub Title</td>
	<td>-</td>
	<td>$x.xx</td>
	<td>12h 50m</td></tr>
	<tr><td>&nbsp;</td>
	<td><b><u><font color="blue">This is an example with Bold</font></u></b></td>
	<td>-</td>
	<td>$x.xx</td>
	<td>12h 50m</td></tr>
	</table>
		</td></tr>	
		<?php
		 $user_query="select * from user_registration where	user_id='$_SESSION[userid]'";
		$table=mysql_query($user_query);
		if($row=mysql_fetch_array($table))
		{
		 $member_type=$row['member_account'];
		}
		?>
	<tr><td>
	<?php if(!empty($Gallery))
	{
	?>
	<input type="checkbox" name=chkGallery value="yes" checked>
	<?php
	}
	else
	{
	?>
	<input type="checkbox" name=chkGallery value="yes">
	<?php
	}
	?>
    <font size=2 >
	Gallery 	 [Requires a picture<!--,<a href="promotelistings.php#img1"> add a picture now </a>-->] <br>
    Add a small version of your first picture to Search and Listings.
    </font>
	<input type=hidden name="gallery" value="<?php echo $gret; ?>">
 	</td></tr>
   <tr><td>
	<?php if(!empty($Home))
	{
	?>
	<input type="checkbox" name=chkHome value="yes" checked>
	<?php
	}
	else
	{
	?>
	<input type="checkbox" name=chkHome value="yes">
	<?php
	}
	?>
    <font size=2>
	Home Page Featured  
		<input type=hidden name="home_page" value="<?php echo $hret; ?>">
    </font>
 	</td></tr>
<!--
    <tr><td>
	<?php 
	if(!empty($Subtitle))
	{
	?>
		<input type="checkbox" name=chkSubtitle value="yes" checked>
	<?php
	}
	else
	{
	?>
    	<input type="checkbox" name=chkSubtitle value="yes">	
	<?php
	}
	?>
    <font size=2 >SubTitle <br>
	Add a Subtitle to give buyers more information.  
    </font>
 	</td></tr>
	<tr><td width=250 >
	<input type="text" name="txtSubtitle" class="txtbig" value=<?php= $Subtitle_name; ?>></td></tr> -->
	<tr><td>
	<?php if(!empty($Bold))
	{
	?>
	<input type="checkbox" name=chkBold value="yes" checked>
	<?php
	}
	else
	{
	?>
	<input type="checkbox" name=chkBold value="yes">
	<?php
	}
	?>
     <font size=2 >Bold <br> 
    Attract buyers' attention and set your listing apart - use <b>Bold</b>. 
    </font>&nbsp;
	<input type=hidden name="bold" value="<?php  echo $bret; ?>">
 	</td></tr>
  
	<tr><td>
	<?php if(!empty($Highlight))
	{
	?>
	<input type="checkbox" name=chkHighlight value="yes" checked>
	<?php
	}
	else
	{
	?>
	<input type="checkbox" name=chkHighlight value="yes">
	<?php
	}
	?>
    <font size=2>Highlight  <br> 
	
    Make your listing stand out with a colored band in Search results.  
    </font>
 	</td></tr>
	<input type=hidden name="highlight" value="<?php  echo $highret; ?>">
		<?php
	// }
	?>
	<tr>
                <td><font size=2 ><b>Page Counter 
</b></font></td>
              </tr>
<tr><td>
<?php 
if($item_counter_style==2)
{
 ?>
<input type="radio" name="item_counter_style" value=1 > 
 <b><font size=+1 color="#009900">
		    12345
			</font>
			</b> 
<input type="radio" name="item_counter_style" value=2 checked> 
<I><font size=+1 color="#003399">
		    12345
			</font>
			</I>  
<?php
}
else
{
?>		 
<input type="radio" name="item_counter_style" value=1 checked> 
 <b><font size=+1 color="#009900">
		    12345
			</font>
			</b> 
<input type="radio" name="item_counter_style" value=2 > 
<I><font size=+1 color="#003399">
		    12345
			</font>
			</I>  
<?php
}
?></td></tr>

<input type="hidden" name=mode value="<?php=$mode;?>">
  <input type="hidden" name=flag value="1">
  <input type="hidden" name=item_id value="<?php=$sellitemid?>"/>
<tr><td colspan="2" align="center">
	<?php if($mode=="" or $mode=="sellsimilar")
	{
	?>
	<input type="submit" name=detsub value=Continue>
	<?php
	}
	else if($mode=="change")
	{ 
	?>
	<input type="submit" name=detsub value="Save" class="buttonbig">
    <?php
	}
	?></td></tr>
	</form>
	</table>
   </table>
<?php require 'include/footer.php'; ?>