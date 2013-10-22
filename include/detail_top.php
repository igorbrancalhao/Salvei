<?php

require 'include/connect.php';
require 'include/getdatedifference.php';
$JavascriptTime = date("Y M d H:i:s");
/* Fetching site logo */
$sitelogo_sql = "select * from admin_settings where set_id='46'";
$sitelogo_sqlqry = mysql_query($sitelogo_sql);
$sitelogo_fetch = mysql_fetch_array($sitelogo_sqlqry);
/* End of fetching site logo */

/* Fetching site name */
$sql_moto = "select * from `admin_settings` WHERE set_id=2";
$moto_row = mysql_query($sql_moto);
$moto_res = mysql_fetch_array($moto_row);
$_SESSION['site_name'] = $moto_res['set_value'];
/* End of fetching site name */

/* Meta tags */
$meta = "SELECT * FROM `meta_tag` WHERE key_id=1";
$meta_row = mysql_query($meta);
$meta_res = mysql_fetch_array($meta_row);
/* End of Meta tags */


/* Fetching Sitename */
$sitename_sql = "select * from admin_settings where set_id=47";
$sitename_sqlqry = mysql_query($sitename_sql);
$sitename_fetch = mysql_fetch_array($sitename_sqlqry);
/* End of Fetching Sitename */


require 'templates/detail_top.tpl';
?>
