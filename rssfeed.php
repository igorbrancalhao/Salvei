<?php require 'include/connect.php';
$sql="select * from placing_item_bid where status='Active' and selling_method!='ads' and selling_method!='want_it_now' and bid_starting_date <= now() and expire_date>=now() and picture1!='' order by rand() limit 0,30";
$res=mysql_query($sql);
$admin_r=mysql_fetch_array(mysql_query("select * from admin_settings where set_id=1"));
$sitepath=$admin_r[set_value];
$sitename=explode("/",$sitepath);
$sitename=$sitename[2];
$fp=fopen("rssfeed/rss.xml","w") ;
	
$now = date("D, d M Y H:i:s");
	
	
$op ="<?phpxml version='1.0' encoding='ISO-8859-1'?>";
$op.="<rss version='2.0'><channel>";
$op.="<title>Welcome to ".$sitename."</title>";
$op.="<link>$sitepath"."/index.php</link>";
$op.="<description>Search Items</description>";
$op.="<language>en-us</language>";
$op.="<pubDate>$now</pubDate>";
$op.="<lastBuildDate>$now</lastBuildDate>";
while($r=mysql_fetch_array($res))
{	
if(empty($r['picture1']))
$image1="no-image.gif";
else
$image1=$r['picture1'];
	$op.="<item><item_title>".htmlentities($r['item_title'])."</item_title>";
	$op.="<item_link>".$admin_r['set_value']."/detail.php?item_id=".$r['item_id']."</item_link>";
	$op.="<image_link>".$admin_r['set_value']."/images/".$image1."</image_link>";
	$op.="<item_description>".htmlentities(strip_tags($r[detailed_descrip]))."</item_description></item>";
}
	$op.="</channel></rss>";
fwrite($fp,$op);
fclose($fp);
exit('<meta http-equiv="refresh" content="0;url=rssfeed/rss.xml">');
     
?> 




