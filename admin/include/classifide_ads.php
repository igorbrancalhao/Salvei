<?php
/***************************************************************************
 *File Name				:classifieds_ads.php
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
<?php
//require 'include/connect.php';
$query="select * from placing_item_bid where status='active' and selling_method='ads' and picture1!='' ";
$tab=mysql_query($query);
$count=mysql_num_rows($tab);

//checking and display ads if any ads are stored.
if($count!=0)
{

$ads[1]=rand(1,$count);

if($count>=2)
{
   while($ads[2]=rand(1,$count))
   {
     if($ads[2]!=$ads[1])
     break;
   }
}

if($count>=3)
{
   while($ads[3]=rand(1,$count))
   {
     if( ($ads[3]!=$ads[1]) && ($ads[3]!=$ads[2]) )
     break;
   }
}

if($count>=4)
{
   while($ads[4]=rand(1,$count))
   {
     if( ($ads[4]!=$ads[1]) && ($ads[4]!=$ads[2]) && ($ads[4]!=$ads[3]))
     break;
   }
}
//if there are less than 4 picture ads are available in database
//then this code will excute.
/*echo count($ads);
if( (count($ads)<4) && (count($ads) >0) )
{
 echo   $k=count($ads);
echo  $w=$k;
  for($i=$k;$i<=4;$i++,$w++)
  {
    $ads[$i] = $ads[$w];
  }
}
echo count($ads);
*/
?>
<table border="0" align="center" cellpadding="5" cellspacing="0" width="100%" clas="table_border1_with_bg" background="images/window.gif" >
<!--	<tr >
	<td clas="tdhead" height="30" valign="middle" colspan="4">&nbsp;&nbsp;
	<img src="images/Bullet4.gif">&nbsp;&nbsp;Classifide Ads</td></tr> -->
	
<?php
$v=0;
$tr=0;
while($row=mysql_fetch_array($tab))
{
$v++;
  if( ($v==$ads[1])|| ($v==$ads[2])|| ($v==$ads[3]) || ($v==$ads[4]) )
  {
  }
  else
  {
  continue;
  }
$tr++;
?>
<?php  	if($tr%2==1) echo "<tr height=150 >"; ?>
<td width="50%" valign="middle" align="center"	 ><br>

<?php if(empty($row['picture1']))
	{ ?>
		<a href="detail.php?item_id=<?php echo $row['item_id']; ?>">
		<img src="images/no-image.gif" width=80 height=80 border=1></a>
	<?php
	}
	else
	{
	?>
	<a href="detail.php?item_id=<?php echo $row['item_id']; ?>">
	 <img src="images/<?php echo $row['picture1']; ?>" height=80 width=80 border=0>
	</a>
	<?php 
	}
	?>
	<br>
<a href="detail.php?item_id=<?php echo $row['item_id']; ?>">
<u><font color="#000066"><b><?php= $row['item_title']; ?></b></font></u>
</a>


</td>

<?php  if($tr%2==2) echo"</tr>"; ?>

<?php
}
?>

</table>
<table><tr><td width="300" align="right"><a href="classifide_list.php"><strong>More</strong> </a></td></tr></table>

<?php
}
?>