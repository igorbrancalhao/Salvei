<?php
require 'include/connect.php';
$sub_id=$_GET['id'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<select id="CatMenu_4" size="8" name="CatMenu_4" style="width:184px" onClick="changeMenu(this.value,5);">
<!--<option>---------------------------------------</option>-->
<?php
$sub="select * from category_master where category_head_id=".$sub_id." order by category_name";
				        	$sub_res=mysql_query($sub);
							$tot_sub=mysql_num_rows($sub_res);
							while($sub_rec=mysql_fetch_array($sub_res))
							{
							
?>
<option value="<?php=$sub_rec[category_id];?>"><?php=$sub_rec[category_name];?></option>
					<?php
					}
					
					foreach($id as $category_id)
	   {
	   $main_sql="select * from category_master where category_id=$category_id";
	   $main_qry=mysql_query($main_sql);
	   $main_row=mysql_fetch_array($main_qry);
	   ?>
	   
	   <option value="<?php=$main_row[category_id];?>"><?php=$main_row[category_name];?></option>
				
				<?php
				}
				foreach($id1 as $category_id)
				{
				$sub_sql1="select * from category_master where category_id=$category_id";
				$sub_qry1=mysql_query($sub_sql1);
				$sub_row1=mysql_fetch_array($sub_qry1);
				?>
				<option value="<?php=$sub_row1[category_id];?>"><?php=$sub_row1[category_name];?></option>
				<?php
				}
				foreach($id2 as $category_id)
				{
				$sub_sql2="select * from category_master where category_id=$category_id";
				$sub_qry2=mysql_query($sub_sql2);
				$sub_row2=mysql_fetch_array($sub_qry2);
				?>
				<option value="<?php=$sub_row2[category_id];?>"><?php=$sub_row2[category_name];?></option>
				<?php
				}
				foreach($id3 as $category_id)
				{
				$sub_sql3="select * from category_master where category_id=$category_id";
				$sub_qry3=mysql_query($sub_sql3);
				$sub_row3=mysql_fetch_array($sub_qry3);
				?>
				<option value="<?php=$sub_row3[category_id];?>"><?php=$sub_row3[category_name];?></option>
				<?php
				}
				foreach($id4 as $category_id)
				{
				$sub_sql4="select * from category_master where category_id=$category_id";
				$sub_qry4=mysql_query($sub_sql4);
				$sub_row4=mysql_fetch_array($sub_qry4);
				?>
				<option value="<?php=$sub_row4[category_id];?>"><?php=$sub_row4[category_name];?></option>
				<?php
				}
				foreach($id5 as $category_id)
				{
				$sub_sql5="select * from category_master where category_id=$category_id";
				$sub_qry5=mysql_query($sub_sql5);
				$sub_row5=mysql_fetch_array($sub_qry5);
				?>
				<option value="<?php=$sub_row5[category_id];?>"><?php=$sub_row5[category_name];?></option>
				<?php
				}
				?>
					
				</select>