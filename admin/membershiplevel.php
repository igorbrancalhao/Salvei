<?php
/***************************************************************************
 *File Name				:membershiplevel.php
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
<?php error_reporting(0);
    require 'include/connect.php'; 
?>


<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
<tr><td>
<table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
<tr>
<td colspan="4" class="txt_users"><center><br />Membership Levels<br /><br /></center></td></tr>
<tr>
<td align="center" colspan="4">
<font color="#FF0000">
<?php
if($mem_mes!='')
echo $mem_mes;
?>
</font>
</td></tr>
<tr><td>&nbsp;</td></tr>
<form  action="<?php $_SERVER['PHP_SELF']?>" method="post" name="frm1" enctype="multipart/form-data">
<tr><td>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="96%" class="border2">

<?php
$auction_query="select * from membership_level";
$table=mysql_query($auction_query);
$total=mysql_num_rows($table);
$i=1;
?>
<tr bgcolor="#eeeee1">
  <td><b>Feedback Score From</b></td>
    <td><b>Feedback Score To</b></td>
  <td><b>Icon</b></td>
  
  <td align="center"><b> Delete</b></td>
  
</tr>

<?php
while($row=mysql_fetch_array($table))
{
?>
	 <tr bgcolor="#eeeee1">
     <td width="25%">
	 <input type="hidden" name="records_id<?php= $i ?>" value="<?php= $row['mid'] ?>" />
	 <input class="smalltxt" type="text" name="score<?php= $i ?>" onKeyPress="return numbersonly(event);" maxlength="10" value="<?php= $row['feedback_score_from'] ?>" ></td>
	  <td width="25%">
	 <input class="smalltxt" type="text" name="scoreto<?php= $i ?>" onKeyPress="return numbersonly(event);" maxlength="10" value="<?php= $row['feedback_score_to'] ?>" ></td>
	 <td><img src="../images/<?php= $row['icon'] ?>" /></td>
	   <td width="25%" align="center"> 
	 <input type="checkbox" name="memberlevel_del<?php= $i++ ?>" value="0">
	 </td>
	 </tr>
<?php
 }
?>
<input type="hidden" name="v" value="<?php=$i; ?>" />
<tr bgcolor="#eeeee1" >
<td align="center" colspan="2">
<input type="hidden" name="total_records" value="<?php= $total?>" />
<input type="submit" value=" Modify " name="memberlevel_modify" class="button" onclick="return modify_val();"></td>

<td align="center" colspan="2"><input type="submit" value=" Delete " name="memberlevel_delete" class="button" onclick="return del();"></td>
</tr>
     <tr  bgcolor="#eeeee1" >
     <td width="25%"><input  class="smalltxt" type="text" name="score" onKeyPress="return numbersonly(event);" maxlength="10" ></td>
	  <td width="25%"><input  class="smalltxt" type="text" name="scoreto" onKeyPress="return numbersonly(event);" maxlength="10" ></td>
	 <td width="25%"><input type="file" name=imgicon  /> </td>

	 <td width="25%" align="center">
	 <input type="submit" value=" Add " name="memberlevel_add" class="button" onclick="return validate();"></td>
	 </tr> 
  </form>
</table></td></tr>
</table>
</td></tr></table>


<script language="javascript">
function checkpermission(val,tot)
{
//alert('hai');
//alert(tot);
//alert(document.forms[0].elements.length);
var coun=document.forms[0].elements.length;
	for(i=0;i<coun;i++)
	{
		if(val=="yes")
		{
			if(document.forms[0].elements[i].type=="text")
			{
				document.forms[0].elements[i].disabled=true;
			}
		}
		if(val=="no")
		{
			if(document.forms[0].elements[i].type=="text")
			{
				document.forms[0].elements[i].disabled=false;
			}
		}
	}

}

function validate()
{
	if(frm1.score.value=="")
	{
		alert("Please Enter the Feedback Score From value");
		frm1.score.focus();
		return false;
	}
	if(frm1.scoreto.value=="")
	{
		alert("Please Enter the Feedback Score To value");
		frm1.scoreto.focus();
		return false;
	}
	if(frm1.score.value >= frm1.scoreto.value)
	{
		alert("Please Enter the Score To value greater than the Score From value");
		frm1.scoreto.value="";
		frm1.scoreto.focus();
		return false;
	}
	
	if(frm1.imgicon.value=="")
	{
		alert("Please Enter the Icon");
		frm1.imgicon.focus();
		return false;
	}		
return true;
}

function modify_val()
{
	/*var coun=document.frm1.v.value;
	var i;
		var f="frm1.score";
		var t="frm1.scoreto";
		var n="frm1.score";
		var fr,tr,nr,k;
	for(i=1;i<=coun;i++)
	{
		fr=f+i+".value";
		tr=t+i+".value";
		k=i+1;
		nr=n+k+".value";
		
	if(eval(fr)=="")
	{
		alert("Please Enter the Feedback Score From Value");
		return false; 
	}
	if(eval(tr)=="")
	{
		alert("Please Enter the Feedback Score To Value");
		return false; 
	}	
	if( (eval(fr)!="" || eval(fr)!=0) && (eval(tr)!="" || eval(tr)!=0) )
	{       	
					
		if(parseInt(eval(fr))>=parseInt(eval(tr)))
		{
				
			alert("The Feedback Score To value should be greater than the Feedback Score From value");
			return false;
		}
	}
	if((eval(nr)!="") || (eval(nr)!=0))
	{
	
		if(parseInt(eval(nr))<=parseInt(eval(tr)))
		{
			alert("The Feedback Score To should be lesser than the Feedback Score From of the next record");
			return false;
		}
	}

	}*/
return true;
}

function del()
{
var coun=document.forms[0].elements.length;
var f=0;
	for(i=0;i<coun;i++)
	{
		if(document.forms[0].elements[i].type=="checkbox")
		{
			if(document.forms[0].elements[i].checked==true) 
			{
				f=1;
			}
		}
	}
	if(f!=1)
	{
		alert("Please Select Any Item you want to delete");
		return false;
	}


var item_deliever= confirm("Are you sure you want to delete the selected item(s)?");

if(item_deliever==true)
{
document.frm1.submit();
return true;
}
else
{
return false;
}
}


function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}

</script>