<?php
/***************************************************************************
 *File Name				:auction_help.tpl
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
<table cellpadding="5" cellspacing="2">
<tr style="border-bottom:1px solid black;border-top:1px solid black;" bgcolor="#CCCCCC">
<td><p align="justify"><font size="+1"><b>Help</b></font></p></td></tr>
<? if($help==1)
{
?>
<tr align=""><td>
<font size="+1"><b><p align="justify">Online Auction Format</p></b></font>
</td></tr>
<tr><td><font size="3"><b><p align="justify">Auction-Style Listing Format</p></b></font> </td></tr>
<tr align="center"><td>
<p align="justify">Most listings on <?= $_SESSION[site_name]  ?> use the Online Auction format.A typical auction-style listing works this way:</p> </td></tr>
<tr><td><p align="justify">
<ul type="disc"> 
<li>The seller offers one item and sets a starting price. </li>
<li>Buyers visit the listing and bid on the item. </li>
<li>When the listing ends, the high bidder or bidders buy the item(s) from the seller for the high bid. </li>
</ul></p>
</td></tr>
<tr><td><p align="justify"><b>How Buy It Now works with auction-style listings
</b></p></td></tr>
<tr><td><p align="justify">
<ul type="disc"> 
<li>If a buyer is willing to meet the Buy It Now price before the reseve price is met, your item will sold immediately to that buyer, and the listing will end.</li>
<li>If a bid comes in first and the reserve price is met, the Buy It Now price disappears. In that case, the listing will proceed normally as an auction-style listing. (If you have set a "reserve price," the Buy It Now price disappears once a bid meets the reserve price.)</li>
</ul></p>
</td></tr>
 <?
 }
 else if($help==2)
{
?>
<tr align=""><td>
<font size="+1"><b><p align="justify">Dutch Auction Format</p></b></font>
</td></tr>
<tr><td><font size="3"><b><p align="justify">Auction-Style Listing Format</p></b></font> </td></tr>
<tr align="center"><td>
<p align="justify">Most listings on <?= $_SESSION[site_name]  ?> use the Online Auction format. A typical auction-style listing works this way: </p></td></tr>
<tr><td><p align="justify">
<ul type="disc"> 
<li>Sellers start by listing starting bid, and the number of items for sale. </li>
<li>Bidders who are willing to bid for the entire quantity can specify a bid price.</li>
<li>The amount displaying in the item page will the amount for 1 quantity. </li>
<li>When the auction ends the highest bidder will be winning the product and will be paying total amount which will be the total quantity multiplied by the bidding amount. </li>
</ul></p>
</td></tr>
<tr><td><p align="justify"><b>How Buy It Now works with auction-style listings
</b></p></td></tr>
<tr><td><p align="justify">
<ul type="disc"> 
<li>If a buyer is willing to meet the Buy It Now price before the reserve price of the item is met, your item will sell immediately to that buyer, and the listing will end.The Buy it now price the seller enters will be price for 1 item.The buyer will be paying total amount which will be the total quantity multiplied by the Buy It Now price.</li>
<li>If reserve price is met first or the bidding price exceeds the Buy It Now price, the Buy It Now price disappears. In that case, the listing will proceed normally as an auction-style listing. (If you have set a "reserve price," the Buy It Now price disappears once a bid meets the reserve price.)</li>
</ul></p>
</td></tr>
 <?
 }
else if($help==3)
{
?>
<tr align=""><td><p align="justify">
<font size="+1"><b>Fixed Price Sale</b></font></p>
</td></tr>
<tr><td><p align="justify">The Buy It Now feature lets you specify a price you will accept for your item. The first buyer who's willing to pay your price gets the item. </p> </td></tr>
 <?
 
 }
  else if($help==4)
{
?>
<tr align=""><td>
<font size="+1"><b><p align="justify">Classified Ads </p>
</b></font>
</td></tr>
<tr><td><font size="3"><b><p align="justify">The Classified Ads format has the following features:</p></b></font> </td></tr>
<tr><td><p align="justify">
<ul type="disc"> 
<li>You can post your advertisements in this section.</li>
<li> No bidding takes place. </li>
<li>Interested buyers can contact the seller through ask seller a question link and the seller will reply for you. </li>
</ul></p>
</td></tr>
 <?
 }
 ?>
</table>
