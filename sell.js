// JavaScript Document
var xmlHttp;
 function changeMenu(id,chkval)
 {
	if (id.length==0)
	{ 
	document.getElementById("subcat"+chkval).innerHTML="";
	return;
	}
 	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
	} 
	if(id!='')
	{
	document.getElementById("sub_cat"+chkval).value=id;
	url="sell_subcat"+chkval+".php?id="+id;
	}
	
if(chkval==1)
xmlHttp.onreadystatechange=stateChanged1;
if(chkval==2)
xmlHttp.onreadystatechange=stateChanged2;
if(chkval==3)
xmlHttp.onreadystatechange=stateChanged3;
if(chkval==4)
xmlHttp.onreadystatechange=stateChanged4;
if(chkval==5)
xmlHttp.onreadystatechange=stateChanged5;
if(chkval==6)
xmlHttp.onreadystatechange=stateChanged6;
if(chkval==7)
xmlHttp.onreadystatechange=stateChanged7;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
 }
 
 function stateChanged1() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
	 document.getElementById("subcat1").innerHTML=xmlHttp.responseText; 
    } 
}

 function stateChanged2() 
{ 
  	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
     document.getElementById("subcat2").innerHTML=xmlHttp.responseText; 
    } 
}

function stateChanged3() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
     document.getElementById("subcat3").innerHTML=xmlHttp.responseText; 
    } 
}

function stateChanged4() 
{ 

	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
     document.getElementById("subcat4").innerHTML=xmlHttp.responseText; 
    } 
}

function stateChanged5() 
{ 

	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
     document.getElementById("subcat5").innerHTML=xmlHttp.responseText; 
    } 
}

function stateChanged6() 
{ 

	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
     document.getElementById("subcat6").innerHTML=xmlHttp.responseText; 
    } 
}

function stateChanged7() 
{ 

	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
     document.getElementById("subcat7").innerHTML=xmlHttp.responseText; 
    } 
}

  
function GetXmlHttpObject()
{ 
var objXMLHttp=null;
if (window.XMLHttpRequest)
{
objXMLHttp=new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP");
}
return objXMLHttp;
} 

function lastcat(lastval)
{
	//alert(lastval);
	document.getElementById("sub_cat8").value=lastval;
}
