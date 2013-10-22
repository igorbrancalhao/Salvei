function makeReq(url) {
    var http_req = false;
    if (window.XMLHttpRequest) { // Mozilla, Safari,...
        http_req = new XMLHttpRequest();
        if (http_req.overrideMimeType) {
            http_req.overrideMimeType('text/xml');
            // See note below about this line
        }
    } else if (window.ActiveXObject) { // IE
        try {
            http_req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
            }
        }
    }

    if (!http_req) {
        alert('Giving up :( Cannot create an XMLHTTP instance');
        return false;
    }
    http_req.onreadystatechange = function() {
        alertConten(http_req)
    };
    http_req.open('GET', url, true);
    http_req.send(null);

}

function alertConten(http_req) {
    if (http_req.readyState == 4)
    {
        respnse = http_req.responseText;
        //		alert(respnse);
        eff(respnse);
    }
}