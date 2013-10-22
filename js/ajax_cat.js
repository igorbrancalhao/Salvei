// JavaScript Document
var xm
function sendRequest(url)
{
    str = "msg=msg"
    xm.open("POST", url, true);
    if (navigator.userAgent.indexOf("Opera") != -1)
        xm.setRequestHeader = "Content-Type", "application/x-www-form-urlencoded";
    else
        xm.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xm.send(str)
}


function makAx() {

    try {
        xm = new ActiveXObject("Msxml2.XMLHTTP");
        return true;
    } catch (e) {
        try {
            xm = new ActiveXObject("Microsoft.XMLHTTP");
            return true;
        } catch (e2) {
            xm = false;
        }
    }

    if (!xm && typeof XMLHttpRequest != 'undefined') {
        xm = new XMLHttpRequest();
        return true;
    }


}