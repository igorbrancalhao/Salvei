<?php require 'include/connect.php';
$itemid=$_REQUEST['item_id'];

 ?>
<link href="style/newstyle.css" rel="stylesheet" type="text/css"/>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
<tr>
<?php 
     $i=0;
	 $sql_featurelist="select * from placing_item_bid where item_id=".$itemid;
	 $res_featurelist=mysql_query($sql_featurelist);
	/*  $numrow_featurelist=mysql_num_rows($res_featurelist);
	if($numrow_featurelist>0)
	 {*/
	 $fetch_featureslist=mysql_fetch_array($res_featurelist);
	 $crossitems=$fetch_featureslist['crosspromote'];
	 $items=explode(",",$crossitems);
	 foreach($items as $item)
	 {	
	  
	 $sql_featurelist="select * from placing_item_bid where item_id=".$item;
	 $res_featurelist=mysql_query($sql_featurelist);
	 $row_featurelist=mysql_num_rows($res_featurelist);
	 if($row_featurelist>0)
	 {
	 $i++;		
	 $fetch_featureslist=mysql_fetch_array($res_featurelist);
	 if(empty($fetch_featureslist['picture1']))
	 $image_pic="images/no-image.gif";
	 else
	 $image_pic="thumbnail/".$fetch_featureslist['picture1'];
	 ?>
    <td width="300" valign="top" class="centrepad2" align="center">
	<table width="167" border="0" cellpadding="0" cellspacing="0" class="hotborder" align="center">
    <tr>
    <td align="center" valign="top" align="center">
	<div style="display:block;">
    <table width="154" height="200" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc">
    <tr>
    <td><div align="center">
    <table width="100%" height="120" border="0" cellpadding="0" cellspacing="0" >
    <tr>
    <td><div align="center">
	<a href="detail.php?item_id=<?php=$fetch_featureslist['item_id']?>" target="_top">
	<img src="<?php=$image_pic?>" alt="" width="75" height="75" border="0"/>
	</a></div></td>
    </tr>
    </table>
    </div></td>
    </tr>
	<?php
	if(!empty($fetch_featureslist['sub_title']))
	$subtitle_fea=$fetch_featureslist['sub_title'];
	else
	$subtitle_fea=$fetch_featureslist['item_title'];
	if(strlen($subtitle_fea)>20)
	$subtitle_fea=substr($subtitle_fea,0,20);
	$itemtitle_fea=$fetch_featureslist['item_title'];
	if(strlen($fetch_featureslist['item_title'])>35)
	$itemtitle_fea=substr($fetch_featureslist['item_title'],0,35);
	?>
    <tr>
    <td class="featxt"><div align="center">
	<a href="detail.php?item_id=<?php=$fetch_featureslist['item_id']?>" class="fea1txt" target="_top"><?php=$subtitle_fea;?></a></div></td>
    </tr>
    <tr>
    <td class="fea1txt"><center>
	<a href="detail.php?item_id=<?php=$fetch_featureslist['item_id']?>" class="fea1txt" target="_top"><?php=$itemtitle_fea?></a></center></td>
    </tr>
    <tr>
    <td class="products2txt">
	<div align="center"><?php=$fetch_featureslist['currency']?><?php=$fetch_featureslist['cur_price']?></div></td>
    </tr>
    </table>
    </div></td>
    <td></td>
    </tr>
    </table></td>
    <?php	
	}
	ob_flush();
	}
	if($i==0)
	{
	?>
	<td width="100%" valign="top">
	<table align="center" height=400>
	<tr><td height="20px">&nbsp;</td></tr>
	<tr><td height="20px">&nbsp;</td></tr>
	<tr><td height="20px">&nbsp;</td></tr>
	<tr><td valign="top" class="fea1txt">
	<?php
	echo "No Items Found";
	?>
	</td></tr>
	<tr><td height="20px">&nbsp;</td></tr>
	</table>
	</td>
	<?php
	}
	?>
     
     
    