<?php session_start();
error_reporting(0);
 ?>
<html>
<head>
<title>Admin</title>
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style3 {
color: #666666; font-size: 11px; font-family:Arial, Helvetica,sans-serif
}
-->
</style></head>
<body topmargin="0">
<center>
<?php
 require 'include/connect.php'; 
 if($_POST['flag'])
 {
 $chkfile=$_POST['chkfield'];
 $Table_name=$_POST['txtTabname'];
 $file_type=$_FILES['file_name']['type'];
 $csv_file=$_FILES['file_name']['name'];
 
 
     if(!empty($csv_file))
         {
            if($file_type=='application/octet-stream' || $file_type=='application/vnd.ms-excel')
                {   
	        	     $row = 1;
                     $uploaddir= getcwd(); 
					 $numrand=rand(0,100);
 					 $updir=explode('/',$uploaddir);
					 $count=count($updir)-1;
					 for($i=0;$i<$count;$i++)
					 {
         			 $up_dir.=$updir[$i]."/";
					 }
                     $uploaddir=rtrim($up_dir,"/");
					 $uploadfile="../csv/".$numrand."$csv_file";
					 if(move_uploaded_file($_FILES['file_name']['tmp_name'],$uploadfile))
                     { 
					// echo $uploadfile;
					  $handle = fopen("$uploadfile", "r");
	   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
       {
       $num = count($data);
	    if($row >= 2)
	   {
	   for ($c=0; $c < $num-1; $c++)
       {
	   if($c==1)
	   {
	   $sql_user="select * from user_registration where user_id=".$c;
	   $sqlqry_user=mysql_query($sql_user);
	   $sqlqry_rows=mysql_num_rows($sqlqry_user);
	   if($sqlqry_rows==0)
	   {
	   $err_display="Invalid User Id";
	   $err_flag=1;
	   break;
	   }
	   }
	   if($c==8)
	   {
	   		$selling_method=$data[$c];
	  		$selling_method=strtolower($selling_method);
	        if($selling_method!='auction' && $selling_method!='dutch_auction' && $selling_method!='fix' && $selling_method!='ads')
	        {
	     		$err_display="Invalid Selling Format";
	     		$err_flag=1;
		 		break;
	   		}
      } 
	  
	  if($c==9)
	  {
	  
	  if($selling_method=='auction' || $selling_method=='dutch_auction')
	  if(empty($data[$c]))
	  {
	  $err_flag=1;
	  $err_display="Minimum bid amount value cannot be empty";
	  break;
	  }
	  }
	  
	  if($c==14)
	  {
	  $curprice=$data[$c];
	  if($selling_method=='fix')
	  if(empty($data[$c]))
	  {
	  $err_flag=1;
	  $err_display="Quick Buy Price value cannot be empty";
	  break;
	  }
	  }
	  
	  
	  if($c==28)
	  {
	  $payid=$data[$c];
	  }
	  
	  if($c==30)
	  {
	        if(empty($data[$c]))
		    {
			$err_flag=1;
			echo $err_display="You must enter the corresponding id for payment gateway";
			break;
		    }
	   }	
	   
	   if($c==31)
	   {
	   $payid=$data[$c];  
	   if(($payid==3) || ($payid==5))
	     {
		    if(empty($data[$c]))
		    {
			$err_flag=1;
		    $err_display="You must enter the corresponding id for payment gateway";
			break;
		    }
		 }	
	    }
	    
		 
	  
	  if(($payid==3) || ($payid==5))
	  {
	    if(empty($data[$c]))
		{
			$err_flag=1;
			$err_display="You must enter the corresponding id for payment gateway";
			break;
		}
	  
	  }
      }
	  }
	  $row++;
	  if($err_flag==1)
	  {
	  fclose($handle);
	  break;
	  }
	}
	
	if($err_flag!=1)
	{
	$row=1;
	$handle = fopen("$uploadfile", "r");
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
    {
    $num = count($data);
   	if($row==1)
	{
	$sql="insert into $Table_name(";    
	for ($c=0; $c < $num-1; $c++)
    {
	  $sql= "$sql"."$data[$c] , ";
	 }
	$sql.="cur_price,";
	
	
     $sql=rtrim($sql," ,");
	

	 $sql=$sql. ") values (";
     }
	 else if($row >= 2)
	 {
	 $sql_value="";  
	 for ($c=0; $c < $num-1; $c++)
     {
	 if($c==5)
	 {
 	$data[$c]=strip_tags($data[$c],"<B><I><p><font><u><input><img><a><br><strong><style><center>");
    $data[$c]=ereg_replace('"','\"',"$data[$c]");
    $data[$c]=ereg_replace("'","\'","$data[$c]");
	$data[$c]=ereg_replace("%","\%","$data[$c]");
	 }
	 
	 if($c==8)
	{
	$selling_method=$data[$c];
	$data[$c]=strtolower($data[$c]);
	$selling_method=strtolower($selling_method);
	}
	
	if($c==9)
	{
	if($selling_method=='auction' || $selling_method=='dutch_auction')
	$curprice=$data[$c];
	}
	
	if($c==14)
	{
	if($selling_method=='fix')
	$curpice=$data[$c];
	}
	
	 
	 
	if(($c==15 or $c==29))
	   {
	   $splt=$data[$c];
	   $splt=explode("/",$splt);
	   $day=$splt[0];
   	   $month=$splt[1];
  	   $year=$splt[2];
	   $date="$year"."-"."$month"."-"."$day";
       $data[$c]=$date;
	   }
	  
	   
	   $sql_value=$sql_value." '$data[$c]' ,";
      }
	
	  $sql_value.="'$curprice',";
	  $sql_value=rtrim("$sql_value"," ,");
      $ins_sql="$sql"."$sql_value".") ";
	  $res=mysql_query($ins_sql);
	  if($res)
	  {
	  $id=mysql_insert_id();
	  if($data[$c]=="Yes" || $data[$c]=="yes")
	  {
	   $fea_sql="insert into featured_items(item_id,gallery_feature,home_feature,bold,border,highlight) values('$id','Yes','Yes','Yes','Yes','Yes')";
	  $fea_res=mysql_query($fea_sql);
	  $msg="Data Loaded Successfuly";
	  }
	  }
	 }
	  

   $row++;
  }
   fclose($handle);
   unlink($uploaddir);
  }
  else
  {
  $row_num=$row-1;
  $msg="Sorry! mismatch in fieldvalues in the csc format.<br>$err_display in row ".$row_num.".Refer helplink";
  }
       fclose($handle);
	   unlink($uploaddir);
     }
     else
     { 
      $msg="This is not an CSV file. Script terminated";
     } 
  }
  }  
 else
  {
    $msg="You Must Specify the File First!";
  }
  }

?>

<?php require 'include/top.php'; ?>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" background="images/bg08.jpg">
<tr><td>
<form action="bulk_load.php" method="post" enctype="multipart/form-data">
<table width="96%"  border="0" cellspacing="2" cellpadding="5" bgcolor="<?php=$bg ?>" class="tablebox" align="center">
<tr bgcolor="#CCCCCC" class="style1">
  <td align="left" colspan="2">
Bulk Loader
</td>
</tr>
<?php if(!empty($msg))
{
?>
<tr><td colspan="2" align="center"><font size="2" color="red"><?php= $msg; ?></font></td></tr>
<?php
}
?>

<tr><td align="left" colspan="2">Select CSV file from your local computer </td>
</tr>
<!-- <tr><td align="right">Table Name: </td>
<td align="left"><input type="text" name="txtTabname" value="<?php= $Table_name?>"></td></tr> -->
<input type="hidden" name="txtTabname" value="placing_item_bid">
<tr><td align="right">CSV File: </td>
<td align="left"><input type="file" name="file_name"></td></tr>
<tr><td>&nbsp;</td><td align="left">
<a href="Download_Details.php?mode=cat"><font color=red>Download Category Ids</font></a>
</td></tr>
<tr><td>&nbsp;</td><td align="left">
<a href="Download_Details.php?mode=userid"><font color=red>Download UserIds</font></a>
</td></tr>
<tr><td>&nbsp;</td><td align="left">
<a href="#" id="dislink" onClick="window.open('sellhelp.php','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')"><font color=red>Help for Selling an Item</font></a>
</td></tr>
<tr><td>&nbsp;</td><td align="left">
<a href="#" id="dislink" onClick="window.open('../images/test.zip','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')"><font color=red>View CSV File Format for Simple Auction</font></a>
</td></tr>
<!--<tr><td>&nbsp;</td><td align="left">
<a href="#" id="dislink" onClick="window.open('../images/Duction_Auction.csv','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')"><font color=red>View CSV File Format for Dutch Auction </font></a>
</td></tr>
<tr><td>&nbsp;</td><td align="left">
<a href="#" id="dislink" onClick="window.open('../images/Classified_Ads.csv','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')"><font color=red>View CSV File Format for Classified Ads </font></a>
</td></tr>
<tr><td>&nbsp;</td><td align="left">
<a href="#" id="dislink" onClick="window.open('../images/Fixed_Auction.csv','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=400')"><font color=red>View CSV File Format for Fixed Auction </font></a>
</td></tr>-->

<!--  <tr><td align="center">Use first row as fields name:  </td>
<td><input type="checkbox" name=chkfield value=yes></tr> -->
<tr><td colspan="2"><font size="2" color="#FF0000">Note that if you have mismatch in fieldnames or Tablename in database the Loading data will be errors!.</font></td></tr>
<tr><td colspan="2" align="center">
<input type="hidden" value="1" name=flag>
<input type="submit" value="Load Data">
</td></tr>
</table>
</form>
<?php require 'include/footer.php'; ?>
</center>
</body>
</html>
