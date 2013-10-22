<?php require 'include/connect.php';
 $term="select * from terms where term_id=1";
 $term_res=mysql_query($term);
 $term_row=mysql_fetch_array($term_res);
 echo $term_row['term_body'];
  ?>