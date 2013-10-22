<?php
/***************************************************************************
 *File Name				:ends.php
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
 //$dExpiryDate = mktime(0, 0, 0, date("m")  , date("d")+5, date("Y"));
        $date1 = strtotime(now);
	    $date2=strtotime($expire_date);
    if ($date2 > $date1)
    { 
      $date1 = date("d-m-Y H:i:s",$date1);
      $date2 = date("d-m-Y H:i:s",$date2); 

      $dateFrom=$date1;
      $dateTo = $date2;

      $diffd = getDateDifference($dateFrom, $dateTo, 'd'); //user defined  function 
      $diffh = getDateDifference($dateFrom, $dateTo, 'h');
      $diffm = getDateDifference($dateFrom, $dateTo, 'm');
      $diffa = getDateDifference($dateFrom, $dateTo, 'a');

      if ($diffa['days'] == 0)
      {
        if ($diffa['hours'] == 0)
        {
          $string_difference = $diffa['minutes'] . 'm.<br>';
        }
        else
        {
          $string_difference = $diffa['hours'] . 'h ' . $diffa['minutes'] . 'm.<br>';
        }
      }
      else
      {
         $string_difference = $diffa['days'] . 'd ' . $diffa['hours'] . 'h ' . $diffa['minutes'] . 'm.<br>'; 
      }
    // print $string_difference;
   }
   else
   {
   //  print "Duration Expired";
    $string_difference = "Duration Expired";
   }
   
?>

