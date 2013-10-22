<?php
/***************************************************************************
 *File Name				:create.php
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
error_reporting(0);
require 'connect.php';
$res=mysql_query("select * from tbl_general where pref_id=11");
$row=mysql_fetch_array($res);
$uploadfile='../';
/*$tmpfname = tempnam ("\tmp", $dnam.'.tpl');

if (is_writable($filename)) {
   if (!$handle = fopen($filename, 'w')) {
         echo "Cannot open file ($filename)";
         //exit;
   }

   // Write $somecontent to our opened file.
   if (fwrite($handle, $content) === FALSE) {
       echo "Cannot write to file ($filename)";
       //exit;
   }
   
   
   fclose($handle);

} 
else
echo 'not writable';

//$content=file_get_contents('content.txt');
$handle = fopen($tmpfname, "w");
fwrite($handle, $content);
fclose($handle);*/
$filename=$uploadfile.$dnam.'.php';
function val($name,$dnam)
{
$content=file($name);
$tcount=count($content);
for($i=0;$i<=$tcount;$i++)
	{
	if($content[$i]=='gigs_posting')
		{
		ereg_replace('gigs_posting',$dnam);
		fwrite($handle, $content[$i]);
		}
	}
}
$content=file("content.txt",$uploadfile);
copy("content.txt", $uploadfile.$dnam.'.php');
$handle = fopen($uploadfile.$dnam.'.php', "w");
for($i=0; $i<=count($content);$i++)
	{    
		if($content[$i]=='gigs_posting')
		{
		ereg_replace('gigs_posting',$dnam);
		fwrite($handle, $content[$i]);
		}
		else
		{
		fwrite($handle,$content[$i]);
		}
	}
//unlink($filename);
?>

