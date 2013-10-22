var incban=0;
if(parseInt(incban)=='')
incban=0;

function makeHttpRequest(url, callback_function, return_xml)
{
   var http_request = false;

   if (window.XMLHttpRequest) { // Mozilla, Safari,...
       http_request = new XMLHttpRequest();
       if (http_request.overrideMimeType) {
           http_request.overrideMimeType('text/xml');
       }

   } else if (window.ActiveXObject) { // IE
       try {
           http_request = new ActiveXObject("Msxml2.XMLHTTP");
       } catch (e) {
           try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
           } catch (e) {}
       }
   }

   if (!http_request) {
       alert('Unfortunatelly you browser doesn\'t support this feature.');
       return false;
   }
   http_request.onreadystatechange = function() {
       if (http_request.readyState == 4) { 
	  // alert("Entered");
           if (http_request.status == 200) {
			   
               if (return_xml)
			   {
				  // alert(incban);
				   document.getElementById("ban"+incban).innerHTML='<img src=images/'+incban+'o.gif>';
				   if(incban==1)
				   document.getElementById("ban"+5).innerHTML='<img src=images/'+5+'.gif>';   
				   for(var j=1;j<incban;j++)
				   {
					document.getElementById("ban"+j).innerHTML='<img src=images/'+j+'.gif>';   
				   }
                   eval(callback_function + '(http_request.responseXML)');
               } 
			   
			   else {
                   eval(callback_function + '(http_request.responseText)');
                    }
           } 
		   
		   else {
               alert('There was a problem with the request.(Code: ' + http_request.status + ')');
                }
       }
   }
   http_request.open('GET', url, true);
   http_request.send(null);
}

function loadBanner(xml)
{
    var html_content = xml.getElementsByTagName('content').item(0).firstChild.nodeValue;
    var reload_after = xml.getElementsByTagName('reload').item(0).firstChild.nodeValue;
    document.getElementById('ajax-banner').innerHTML = html_content;

    try {
        clearTimeout(to);
    } catch (e) {}

    to = setTimeout("nextAd()", parseInt(reload_after));


}

function nextAd()
{
	
	if(incban==5)
	incban=0;
	var now = new Date();
    var url = 'ajax-banner.php?ts=' + now.getTime()+'&i='+incban;
    makeHttpRequest(url, 'loadBanner', true);
	incban=incban+1;
}

window.onload = nextAd();