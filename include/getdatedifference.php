<?php
/***************************************************************************
 *File Name				:getdatedifference.php
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
 function getDateDifference($dateFrom, $dateTo, $unit = 'd') // User defined function 
     {
     $difference = null;
     $dateFromElements = split(' ', $dateFrom);
     $dateToElements = split(' ', $dateTo);
     $dateFromDateElements = split('-', $dateFromElements[0]);
     $dateFromTimeElements = split(':', $dateFromElements[1]);
     $dateToDateElements = split('-', $dateToElements[0]);
     $dateToTimeElements = split(':', $dateToElements[1]); 
     // Get unix timestamp for both dates
     $date1 = mktime($dateFromTimeElements[0], $dateFromTimeElements[1], $dateFromTimeElements[2], $dateFromDateElements[1], $dateFromDateElements[0], $dateFromDateElements[2]);
     $date2 = mktime($dateToTimeElements[0], $dateToTimeElements[1], $dateToTimeElements[2], $dateToDateElements[1], $dateToDateElements[0], $dateToDateElements[2]); 
	 
     if( $date1 > $date2 )
     {
         return null;
     }
	 
     $diff = $date2 - $date1;

     $days = 0;
     $hours = 0;
     $minutes = 0;
     $seconds = 0;

     if ($diff % 86400 <= 0)  // there are 86,400 seconds in a day
     {
         $days = $diff / 86400;
     }

     if($diff % 86400 > 0)
     {
         $rest = ($diff % 86400);
         $days = ($diff - $rest) / 86400;

         if( $rest % 3600 > 0 )
         {
             $rest1 = ($rest % 3600);
             $hours = ($rest - $rest1) / 3600;

             if( $rest1 % 60 > 0 )
             {
                 $rest2 = ($rest1 % 60);
                 $minutes = ($rest1 - $rest2) / 60;
                 $seconds = $rest2;
             }
             else 
             {
                 $minutes = $rest1 / 60;
             }
         }
         else
         {
             $hours = $rest / 3600;
         }
     }

     switch($unit)
     {
         case 'd':
         case 'D':

             $partialDays = 0;

             $partialDays += ($seconds / 86400);
             $partialDays += ($minutes / 1440);
             $partialDays += ($hours / 24);

             $difference = $days + $partialDays;

             break;

         case 'h':
         case 'H':

             $partialHours = 0;

             $partialHours += ($seconds / 3600);
             $partialHours += ($minutes / 60);

             $difference = $hours + ($days * 24) + $partialHours;

             break;

         case 'm':
         case 'M':

             $partialMinutes = 0;

             $partialMinutes += ($seconds / 60);

             $difference = $minutes + ($days * 1440) + ($hours * 60) + $partialMinutes;

             break;

         case 's':
         case 'S':

             $difference = $seconds + ($days * 86400) + ($hours * 3600) + ($minutes * 60);

             break; 

         case 'a':
         case 'A':

             $difference = array (
                 "days" => $days,
                 "hours" => $hours,
                 "minutes" => $minutes,
                 "seconds" => $seconds 
             );

             break;
     }
     return $difference;
  }
 
  function AddDays($date,$interval) 
{ 
  if (!isset($date)) 
  $date = date("Y-m-d"); 
  $elts = explode("-", $date); 
  $inter=$interval*24*3600; 
  $dcour=mktime(1,0,0,$elts[1],$elts[2],$elts[0]); 
  $dres=$dcour+$inter; 
  $date1=date("Y-m-d",$dres);
  $sec=date("G:i:s");
  $ret_date="$date1"." "."$sec";
  return $ret_date; 
}



function word_count($string)
 {
													
					$string_array_1 =explode(" ",$string);
					if(!empty($string_array_1[5]))
					$break="$string_array_1[0]"." "."$string_array_1[1]"." "."$string_array_1[2]"." "."$string_array_1[3]"." "."$string_array_1[4]"."...";
					else if(!empty($string_array_1[4]))
					$break="$string_array_1[0]"." "."$string_array_1[1]"." "."$string_array_1[2]"." "."$string_array_1[3].";
					else if(!empty($string_array_1[3]))
                    $break="$string_array_1[0]"." "."$string_array_1[1]"." "."$string_array_1[2]"." "."$string_array_1[3].";
					else if(!empty($string_array_1[2]))
                    $break="$string_array_1[0]"." "."$string_array_1[1]"." "."$string_array_1[2].";
					else if(!empty($string_array_1[1]))
					$break="$string_array_1[0]"." "."$string_array_1[1].";
					else
					$break="$string_array_1[0]."; 
					return $break;
}
	
	
	function getReferral_details($userid,$level) 
	{
	    $select_referral_query="select * from user_registration where intro_id=$userid";
		$select_referral_result=mysql_query($select_referral_query);
		/* $select_level_row=mysql_fetch_array($select_level_result);
		$level_limit=$select_level_row[0]; */
		if(mysql_num_rows($select_referral_result)>0)
	    {
		$level+=1;
		while($select_referral_row=mysql_fetch_array($select_referral_result)) 
		{
				echo "<tr><td>$level</td><td>".$select_referral_row['user_name']."</td><td>".$select_referral_row['date_of_registration']."</td></tr>";
						$intro_id=$select_referral_row['user_id'];
						getReferral_details($intro_id,$level);
		}
		}
		
		}		

?>