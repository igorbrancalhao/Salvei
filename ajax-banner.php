<?php header('Content-type: text/xml');

require 'include/connect.php';
$i=$_GET['i'];
//$i=1;

// an array of banners
/*$banners = array (
    '<img src="images/banner1.jpg" />',
    '<img src="images/banner2.jpg" />',
    '<img src="images/banner3.jpg" />',
    '<img src="images/banner4.jpg" />',
    '<img src="images/banner5.jpg" />'
);*/

$sql_banner1="select * from small_banner order by rand() limit 0,5";
$sqlqry_banner1=mysql_query($sql_banner1);
$sqlnum_banner1=mysql_num_rows($sqlqry_banner1);
if($sqlnum_banner1>0)
{
$ind=0;
while($sqlfetch_banner1=mysql_fetch_array($sqlqry_banner1))
{
$banners[$ind]='<img src="'.$sqlfetch_banner1[banner].'"/>';
$ind++;
}
}

$countban=count($banners);
if($countban<5)
{
for($j=$countban;$j<5;$j++)
{
$k=$j+1;
$banners[$j]='<img src="images/banner'.$k.'.jpg" />';
}
}

$html = $banners[$i];

echo '<?phpxml version="1.0" encoding="utf-8"?>';
?>

<banner>
<content><?php echo htmlentities($html); ?></content>
<reload>3500</reload>
</banner>