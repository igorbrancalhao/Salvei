<?php
/***************************************************************************
 *File Name				:account_reg.tpl
 *File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
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
<script src="js/PopBox.js" type="text/javascript"></script>
<div id="content">
<div id="list"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="7"></td>
    </tr>
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="4%"><img src="images/back_bullet.jpg" alt="" width="20" height="20" /></td>
    <td width="51%" class="header_text2"><a href="classifide_list.php" class="header_text2">Back to list of items</a></td>
    <td width="40%"><span class="detail1txt">Listed in Category:</span><?
if($cat_sql_row[category_head_id])
{
	cat_display($cat_sql_row[category_head_id],$cat_string);
}
?>
<span class="header_text5"><a href="category.php?cate_id=<?= $cat_sql_row[category_id] ?>" class="header_text5"><?= $cat_sql_row[category_name] ?></a></span></td>
  </tr>
  <tr>
 <td height="7"></td>
    </tr>
</table>
</div>
<div id="detail"><table width="959" height="69" border="0" cellpadding="0" cellspacing="0" background="images/detailbgtop.jpg">
  <tr>
    <td width="31">&nbsp;</td>
    <td width="672" class="detail3txt"><?=$row['item_title'];?> * </td>
    <td width="256" class="detail4txt">Item Number: <?=$row['item_id'];?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="detail7txt"><a href="forward_to_friend.php?item_id=<?= $row['item_id']; ?>" class="detail7txt">Forward to friend</a></span></td>
  </tr>
</table><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="4"></td>
  </tr>
</table>
<?
if(!empty($row['videofile']) || !empty($row['videolink']))
{
?>
<div class="detailtablebg1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top"><table width="178" height="278" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
				  <?
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
				  <div align="center"><?=stripslashes($row['videofile']);?></div>
				  <?
				  }
				  else if($row['videolink'])
				  {
				  ?>
				  <div align="center">
				  <iframe src="<?=$row['videolink'];?>"  scrolling="yes" height="355" width="425">
				  </iframe>
				  </div>
				  <?
				  }
				  ?>
				  </td>
                </tr>
              </table></td>
          <td valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="0">
            <tr>
              <td width="39%" class="banner1">Title </td>
              <td width="8%" class="banner1">:</td>
              <td width="53%" class="detail8txt"><? echo $row['item_title']; 
 ?></td>
            </tr>
            <tr>
              <td class="banner1">Ending</td>
			  <?
		  $expire_date=$row['expire_date'];
          require 'ends.php';
		  ?>
              <td class="banner1">:</td>
              <td class="detail8txt"><? echo "$string_difference" ;?></td>
            </tr>
                       <tr>
              <td class="banner1">Started</td>
              <td class="banner1">:</td>
              <td class="detail8txt"><? 
		  $bid_startdate= explode(" ",$row['bid_starting_date']);
		  echo $bid_startdate[0];
		  ?></td>
            </tr>
            <tr>
              <td colspan="3"><div align="left"><img src="images/detailline.gif" alt="" width="269" height="1" /></div></td>
            </tr>
						<?
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
  <td class="banner1"><?=  $tab_col->name; ?></td><td class="banner1">:</td><td class="detail8txt"><?= $tablerow[$tab_col->name] ?>		</td>
</tr>
<?	  
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
              <td width="200" class="detail9txt">Seller Information </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table style="border-left:1px solid #b7daec; border-right:1px solid #b7daec; border-bottom:1px solid #b7daec" width="200" height="236" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="14">&nbsp;</td>
              <td width="75" class="banner1">Seller </td>
              <td width="16">:</td>
              <td width="210" class="detail8txt"><span class="detail8txt"><a href="feedback.php?user_id=<?=$row['user_id'];?>" class="detail8txt"><? echo $user['user_name'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>( <a href="feedback.php?user_id=<?=$row['user_id'];?>" detail8txt><? echo $feed_tot[feedbacktotal]; ?></a><? if($feedback_img!='') { ?><img src="images/<?= $feedback_img ?>" /><? } ?> )</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="banner1">Feedback</td>
              <td class="banner1">:</td>
              <td class="detail8txt"><? echo $feed_tot[feedbacktotal]; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="banner1">Member</td>
              <td class="banner1">:</td>
              <td class="detail8txt">Member Since <?
  $custom_date=explode(" ",$user['date_of_registration']);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo $custom_date[0]; ?> in <?= $country['country']; ?></td>
            </tr>
            <tr>
              <td colspan="4"><table width="200" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="6%">&nbsp;</td>
                  <td width="9%"><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td width="85%" class="header_text2"><a href="feedback.php?user_id=<?=$row['user_id'];?>" class="header_text2">See detailed feedback </a></td>
                </tr>
                <tr>
                  <td height="4"></td>
                  </tr>
				<?
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
                  <td class="header_text2"><a href="ask_seller_qus.php?item_id=<?= $row[item_id]; ?>" class="header_text2">Ask seller a question</a></td>
                </tr>
				<?
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
                  <td class="header_text2"><a href="search.php?seller_id=<?=$row['user_id']; ?>&mode=sellers_item" class="header_text2">View seller's other items</a></td>
                </tr>
                <tr>
                    <td height="4"></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="classifide_ad.php?item_id=<?= $item_id ?>#view" class="header_text2">View Questions and Comments</a></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
<?
}
else
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
              <td valign="top"><table style="border:1px solid #999999" width="178" height="278" border="0" align="center" cellpadding="0" cellspacing="0">
			      <tr>
                  <td><div align="center">
				  <?
			  if(empty($row['picture1']))
			  {
			  $enlarge_flag=0;
				  ?>
				  <img src="images/no-image.gif" alt=""/>
				  <?
			  }
			 else
				  {
				  
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
				  <?
				  if($enlarge_flag==1)
				  {
				  ?>
				 <img  id="imgBamburgh" alt=""
src="images/<?=$row['picture1']?>" width="<?=$w?>" height="<?=$h?>"
pbshowcaption="true" class="PopBoxImageSmall" title="Click to magnify/shrink"
onclick="Pop(this,50,'PopBoxImageLarge');" />
				  <?
				  }
				  else
				  {
				   ?>
				   <img src="images/<?=$row['picture1']?>" height="<?=$h?>" width="<?=$w?>" />
				   <?
				   }
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
			   <?
			   if($enlarge_flag==1)
			   {
			   ?>
			   Click the image to view a larger picture
			   <?
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
              <td width="53%" class="detail8txt"><? echo $row['item_title']; 
 ?></td>
            </tr>
            <tr>
              <td class="banner1">Ending</td>
			  <?
		  $expire_date=$row['expire_date'];
          require 'ends.php';
		  ?>
              <td class="banner1">:</td>
              <td class="detail8txt"><? echo "$string_difference" ;?></td>
            </tr>
                       <tr>
              <td class="banner1">Started</td>
              <td class="banner1">:</td>
              <td class="detail8txt"><? 
		  $bid_startdate= explode(" ",$row['bid_starting_date']);
		  echo $bid_startdate[0];
		  ?></td>
            </tr>
            <tr>
              <td colspan="3"><div align="left"><img src="images/detailline.gif" alt="" width="269" height="1" /></div></td>
            </tr>
						<?
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
  <td class="banner1"><?=  $tab_col->name; ?></td><td class="banner1">:</td><td class="detail8txt"><?= $tablerow[$tab_col->name] ?>		</td>
</tr>
<?	  
$i++;
} // while
}
}
?>
          </table></td>
        </tr>
      </table></td>
      <td valign="top"><table width="314" height="264" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="314" height="28" valign="top"><table width="316" height="28" border="0" cellpadding="0" cellspacing="0" background="images/sellerbg.gif">
            <tr>
              <td width="17">&nbsp;</td>
              <td width="299" class="detail9txt">Seller Information </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table style="border-left:1px solid #b7daec; border-right:1px solid #b7daec; border-bottom:1px solid #b7daec" width="314" height="236" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="14">&nbsp;</td>
              <td width="73" class="banner1">Seller </td>
              <td width="16">:</td>
              <td width="209" class="detail8txt"><span class="detail8txt"><a href="feedback.php?user_id=<?=$row['user_id'];?>" class="detail8txt"><? echo $user['user_name'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>( <a href="feedback.php?user_id=<?=$row['user_id'];?>" detail8txt><? echo $feed_tot[feedbacktotal]; ?></a><? if($feedback_img!='') { ?><img src="images/<?= $feedback_img ?>" /><? } ?> )</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="banner1">Feedback</td>
              <td class="banner1">:</td>
              <td class="detail8txt"><? echo $feed_tot[feedbacktotal]; ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td class="banner1">Member</td>
              <td class="banner1">:</td>
              <td class="detail8txt">Member Since <?
  $custom_date=explode(" ",$user['date_of_registration']);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo $custom_date[0]; ?> in <?= $country['country']; ?></td>
            </tr>
            <tr>
              <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="6%">&nbsp;</td>
                  <td width="9%"><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td width="85%" class="header_text2"><a href="feedback.php?user_id=<?=$row['user_id'];?>" class="header_text2">See detailed feedback </a></td>
                </tr>
                <tr>
                  <td height="4"></td>
                  </tr>
				<?
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
                  <td class="header_text2"><a href="ask_seller_qus.php?item_id=<?= $row[item_id]; ?>" class="header_text2">Ask seller a question</a></td>
                </tr>
				<?
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
                  <td class="header_text2"><a href="search.php?seller_id=<?=$row['user_id']; ?>&mode=sellers_item" class="header_text2">View seller's other items</a></td>
                </tr>
                <tr>
                    <td height="4"></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><img src="images/categbullet.gif" alt="" width="8" height="7" /></td>
                  <td class="header_text2"><a href="classifide_ad.php?item_id=<?= $item_id ?>#view" class="header_text2">View Questions and Comments</a></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
<?
}
?>
</div>


<div id="detail">
  <div class="detail_bg">Description </div>
  <div class="detailtablebg">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?
    if($row[picture1])
    {  
	?>
	<tr><td align="center" style="padding-bottom:20px; padding-top:10px">
	<?
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
   <img src="thumbnail/<?= $row[picture1] ?>" width=<?= $w ?> height=<?= $h ?> > </td></tr>
   <? 
   } 
   ?>
    <tr>
        <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr align="center" >
          <td class="detail9txt"><center><? echo stripslashes($row['detailed_descrip']); ?></center></td>
        </tr>
		<tr><td align="center" class="detail9txt"> <center>
        <br />
        <?
		if($row[clicks] > 0)
		{
		?>
		<font class="detail9txt"> This item has been viewed </font>
		    <? if($row[item_counter_style]==1)
			{ 
			?>
			<b><font class="detail9txt">
		    <?= $row[clicks]; ?>
			</font>
			</b>
			<?
			}
		    else
			{ ?>
               <b><I><font class="detail9txt">
		    <?= $row[clicks]; ?>
			</font>
			</I></b>			
             <?
		     }
		     ?>
			times. </font>
		<?
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
	<? $ask_sql="select * from ask_question where item_id=".$row[item_id];
		   $ask_res=mysql_query($ask_sql);
		   if(mysql_num_rows($ask_res)>0)
		   {
		   while($ask_row=mysql_fetch_array($ask_res))
		   {
		   if($ask_row[answer])
		   {
		?>
		<tr><td class="detail9txt"><img src="images/question.gif">&nbsp;&nbsp;
		<?= $ask_row[question];?>
		</td></tr>
		<tr><td style="border-bottom:1px solid gray"; class="detail9txt">
		<img src="images/answer.gif">&nbsp;&nbsp;
		<?= $ask_row[answer];?>
		</td></tr>
		<?
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
	  <?
	  }
	  ?>
    </table>
  </div>
</div>
</div>