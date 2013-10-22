<?php
/***************************************************************************
 *File Name				:bgimage.php
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
session_start(); 
// generate the verication code 
$rand = rand(10000,99999);
$len=strlen($rand);
for($i=0;$i<=$len;$i++)
{
$a = substr($rand,$i,1);
$rand1 .= $a;
$_SESSION[rand_no]=$rand1;
}
// choose one of four background images 
//$bgNum = rand(1, 2); 
$bgNum=1;
$font = imageloadfont('images/chowfun.gdf');
//$randnum=$_GET[randnum];

// create an image object using the chosen background 
$num=$_GET['num'];
$s="background$bgNum.jpg";
$image = imagecreatefromjpeg($s); 
//$image = imagecreatefromjpeg($s);
$textColor = imagecolorallocate ($image, 0, 0, 0); 

// write the code on the background image 

imagestring ($image, 5 , 25, 10, $num, $textColor); 

     
//imagerotate ( $image, 90, 200);
//imagesetpixel ( $image, 1000, 2000, 1500);

// create the hash for the verification code 
// and put it in the session 
//$_SESSION['image_random_value'] = md5($rand1); 
     
// send several headers to make sure the image is not cached     
// taken directly from the PHP Manual 
     
// Date in the past 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

// always modified 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 

// HTTP/1.1 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 

// HTTP/1.0 
header("Pragma: no-cache");      


// send the content type header so the image is displayed properly 
header('Content-type: image/jpeg'); 

// send the image to the browser 
imagejpeg($image); 

// destroy the image to free up the memory 
imagedestroy($image); 
?> 