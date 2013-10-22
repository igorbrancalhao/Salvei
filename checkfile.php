<?php
require 'include/connect.php';
//require 'include/connect.inc';
$result = mysql_list_tables("$dbname");
echo "<br>total tables ".mysql_num_rows($result);
//$tres1=mysql_query("update gamedetails set flash_widhyt='550 X 400' where gameid=122");

    for ($j = 1; $j <= mysql_num_rows($result); $j++)
{
//$ttres=mysql_query("delete from pay_transaction");
//$tsql="select * from pay_transaction";
$ttres=mysql_query("select * from ".mysql_tablename($result, $j-1));


//if(mysql_num_rows($ttres)>0)
//{


 echo "<br>".mysql_tablename($result, $j-1);
$tres=mysql_query("select * from ".mysql_tablename($result, $j-1));
//$tres=mysql_query($tsql);
//$tres=$ttres;
echo "<br>tc ".mysql_num_rows($tres);
echo "<table border=1><tr>";
for($i=0;$i<mysql_num_fields($tres);$i++)
echo "<tD>".mysql_field_name($tres,$i)."</td>";
while($trow=mysql_fetch_array($tres))
{
echo "<tr>";
for($i=0;$i<mysql_num_fields($tres);$i++)
echo "<td>".$trow[$i]."</td>";
}
echo "</table>";

//}
}
 
?>

