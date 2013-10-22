
<?php
$connection =mysql_connect('localhost','','');
$conn=mysql_select_db('auction_platinum_updated_new_templates',$connection);
?>
<!--<form name="form1" method="post" >
<select name="nopage" onChange="paging()">
<option value="0">0</option>
<option value="2">20</option>
<option value="4">40</option>
</select>
</form>
-->

<?php
// how many rows to show per page


  
$rowsPerPage = 10;
$pageNum = 1;
 
if(isset($_GET['pageview']))
{
	$pageNum = $_GET['pageview'];
}
 
$offset = ($pageNum - 1) * $rowsPerPage;

$query11  = "SELECT * FROM category_master LIMIT $offset, $rowsPerPage";
$result11 = mysql_query($query11) or die(mysql_error());

 
while(list($val) = mysql_fetch_array($result11))
{
	echo "$val <br>";
}

echo '<br>';
 
$query11   = "SELECT COUNT(category_id) AS numrows FROM category_master";
$result11  = mysql_query($query11) or die(mysql_error());
$row11     = mysql_fetch_array($result11, MYSQL_ASSOC);
$numrows11 = $row11['numrows'];
 
$maxPage = ceil($numrows11/$rowsPerPage);

$self = $_SERVER['PHP_SELF'];


if ($pageNum > 1)
{
	$page = $pageNum - 1;
	$prev = " <a href=\"$self?pageview=$page\"><img src=\"leftarrow.gif\" /></a> ";
	
	$first = " <a href=\"$self?pageview=1\">1</a> ";
} 
/*else
{
	
	//$first = ' [First Page] '; 
}*/


if ($pageNum < $maxPage)
{
	$page = $pageNum + 1;
	$next = " <a href=\"$self?pageview=$page\" ><img src=\"right.gif\" /></a> ";
	
	$last = " <a href=\"$self?pageview=$maxPage\">$maxPage</a> ";

	
} 
else
{
$last = " <a href=\"$self?pageview=$maxPage\">$maxPage</a> ";	
}

echo $prev;
echo $first;
$i=1;


$i=$_GET[pageview];
$j=$_GET[pageview];


/*for($k=10;$k<$maxPage;$k--)
{
$i=$_GET['pageview']-$k;
}*/


if($_GET[pageview]==$maxPage)
{
$i=$_GET[pageview]-3;
}
if($_GET[pageview]==$maxPage-1)
{
$i=$_GET[pageview]-2;
}
if($_GET[pageview]==$maxPage-2)
{
$i=$_GET[pageview]-1;
}
if($i>2)
$var="...";
else
$var="";
echo $var;
while($i <$maxPage&&$i<$j+10)
{

	$pageNum1= " <a href=\"$self?pageview=$i\">$i</a> ";
	echo $pageNum1;
	   
 $i=$i+1;
}
/*for($i=1;$i<=$maxPage;$i++)
{



}*/

 $maxPage1="<a href=\"$self?pageview=$maxPage\">$maxPage</a>";
 echo "...".$maxPage1;
 echo $next;



?>
