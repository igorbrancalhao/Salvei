<?php

/* * *************************************************************************
 * File Name				:feedback.php
 * File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By          :B.Reena       
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $

 * ************************************************************************* */
/* * **************************************************************************

 *      Licence Agreement: 

 *     This program is a Commercial licensed software; 
 *     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
 *     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
 *     either user and developer versions of the License, or (at your option) 
 *     any later version is applicable for the same.

 * *************************************************************************** */
session_start();
require 'include/connect.php';
$title = "Member Feedback Profile";
require 'include/top.php';
$user_id = $_GET['user_id'];
$user_sql = "select * from user_registration where user_id=" . $user_id;
$user_res = mysql_query($user_sql);
$user = mysql_fetch_array($user_res);

$feed_sql = "select count(*) as feedbacktotal from feedback where feedback_to=$user_id";
$feed_recordset = mysql_query($feed_sql);
$feed_tot = mysql_fetch_array($feed_recordset);




$feed_pos_sql = "select count(*) as feedbacktotal from feedback where feedback_type='Positive' and feedback_to=" . $user_id;
$feed_pos_rec = mysql_query($feed_pos_sql);
$feed_pos_tot = mysql_fetch_array($feed_pos_rec);

$feedbackicon_sql = "select * from membership_level where feedback_score_from <= " . " $feed_pos_tot[feedbacktotal] " . " and  feedback_score_to >= " . " $feed_pos_tot[feedbacktotal] ";
$feedbackicon_res = mysql_query($feedbackicon_sql);
$feedbackicon_row = mysql_fetch_array($feedbackicon_res);
$feedback_img = $feedbackicon_row[icon];



if ($feed_tot[feedbacktotal] > 0) {
    $positive_sql = "select count(*) as positive_total from feedback where feedback_type='Positive' and feedback_to=$user_id";
    $positive_recordset = mysql_query($positive_sql);
    $positive_tot = mysql_fetch_array($positive_recordset);
    if ($positive_tot[positive_total] != 0 and $feed_tot[feedbacktotal] != 0) {
        $positive_percentage = $positive_tot[positive_total] / $feed_tot[feedbacktotal] * 100;
    }

    $pos_last6_sql = "select count(*) as pos_6mon from feedback where  (TO_DAYS( NOW( ) ) - TO_DAYS(date)) <=180 and  feedback_to=$user_id and feedback_type='Positive'";

    $pos_last6_recordset = mysql_query($pos_last6_sql);
    $pos_last6_record = mysql_fetch_array($pos_last6_recordset);


    $neg_last6_sql = "select count(*) as neg_6mon from feedback where  (TO_DAYS( NOW( ) ) - TO_DAYS(date)) <=180 and  feedback_to=$user_id and feedback_type='Negative'";

    $neg_last6_recordset = mysql_query($neg_last6_sql);
    $neg_last6_record = mysql_fetch_array($neg_last6_recordset);

    $neu_last6_sql = "select count(*) as neu_6mon from feedback where  (TO_DAYS( NOW( ) ) - TO_DAYS(date)) <=180 and  feedback_to=$user_id and feedback_type='Neutral'";

    $neu_last6_recordset = mysql_query($neu_last6_sql);
    $neu_last6_record = mysql_fetch_array($neu_last6_recordset);


    $pos_lastmon_sql = "select count(*) as pos_mon from feedback where  (TO_DAYS( NOW( ) ) - TO_DAYS(date)) <=30 and  feedback_to=$user_id and feedback_type='Positive'";
    $pos_lastmon_recordset = mysql_query($pos_lastmon_sql);
    $pos_lastmon_record = mysql_fetch_array($pos_lastmon_recordset);


    $neu_lastmon_sql = "select count(*) as neu_mon from feedback where  (TO_DAYS( NOW( ) ) - TO_DAYS(date)) <=30 and  feedback_to=$user_id and feedback_type='Neutral'";
    $neu_lastmon_recordset = mysql_query($neu_lastmon_sql);
    $neu_lastmon_record = mysql_fetch_array($neu_lastmon_recordset);


    $neg_lastmon_sql = "select count(*) as neg_mon from feedback where  (TO_DAYS( NOW( ) ) - TO_DAYS(date)) <=30 and  feedback_to=$user_id  and feedback_type='Negative'";
    $neg_lastmon_recordset = mysql_query($neg_lastmon_sql);
    $neg_lastmon_record = mysql_fetch_array($neg_lastmon_recordset);

    $pos_last12mon_sql = "select count(*) as pos_last12mon from feedback where  (TO_DAYS( NOW( ) ) - TO_DAYS(date)) <=365 and  feedback_to=$user_id and feedback_type='Positive'";
    $pos_last12mon_recordset = mysql_query($pos_last12mon_sql);
    $pos_last12mon_record = mysql_fetch_array($pos_last12mon_recordset);

    $neu_last12mon_sql = "select count(*) as neu_last12mon from feedback where  (TO_DAYS( NOW( ) ) - TO_DAYS(date)) <=365 and  feedback_to=$user_id and feedback_type='Neutral'";
    $neu_last12mon_recordset = mysql_query($neu_last12mon_sql);
    $neu_last12mon_record = mysql_fetch_array($neu_last12mon_recordset);


    $neg_last12mon_sql = "select count(*) as neg_last12mon from feedback where  (TO_DAYS( NOW( ) ) - TO_DAYS(date)) <=365 and  feedback_to=$user_id  and feedback_type='Negative'";
    $neg_last12mon_recordset = mysql_query($neg_last12mon_sql);
    $neg_last12mon_record = mysql_fetch_array($neg_last12mon_recordset);
} else {
    $sel_sql = "select * from error_message where err_id =29";
    $sel_tab = mysql_query($sel_sql);
    $sel_row = mysql_fetch_array($sel_tab);
    $msg = '<b>' . $sel_row[err_msg] . '</b>';
}
require 'templates/feedback.tpl';
?>

