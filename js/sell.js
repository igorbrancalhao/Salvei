// JavaScript Document
var xmlHttp;
function changeMenu(id, chkval)
{
    //alert(id);
    //alert(chkval);
    if (id.length == 0)
    {
        document.getElementById("subcat" + chkval).innerHTML = "";
        return;
    }
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (id != '')
    {
        for (i = chkval + 1; i <= 8; i++)
        {
            document.getElementById("sub_cat" + i).value = " ";
        }
        document.getElementById("sub_cat" + chkval).value = id;
        url = "sell_subcat" + chkval + ".php?id=" + id;
    }

    if (chkval == 1)
        xmlHttp.onreadystatechange = stateChanged1;
    if (chkval == 2)
        xmlHttp.onreadystatechange = stateChanged2;
    if (chkval == 3)
        xmlHttp.onreadystatechange = stateChanged3;
    if (chkval == 4)
        xmlHttp.onreadystatechange = stateChanged4;
    if (chkval == 5)
        xmlHttp.onreadystatechange = stateChanged5;
    if (chkval == 6)
        xmlHttp.onreadystatechange = stateChanged6;
    if (chkval == 7)
        xmlHttp.onreadystatechange = stateChanged7;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function stateChanged1()
{

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        response = xmlHttp.responseText.split("<option");
        countres = response.length
        //alert(countres);
        if (countres > 2)
        {
            document.getElementById("subcat1").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_2").disabled = "disabled";
            document.getElementById("CatMenu_3").disabled = "disabled";
            document.getElementById("CatMenu_4").disabled = "disabled";
            document.getElementById("CatMenu_5").disabled = "disabled";
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";
        }
        else
        {
            document.getElementById("subcat1").innerHTML = xmlHttp.responseText;
            document.getElementById("cm1").disabled = "disabled";
            document.getElementById("CatMenu_2").disabled = "disabled";
            document.getElementById("CatMenu_3").disabled = "disabled";
            document.getElementById("CatMenu_4").disabled = "disabled";
            document.getElementById("CatMenu_5").disabled = "disabled";
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";
        }
    }
}

function stateChanged2()
{

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        response = xmlHttp.responseText.split("<option");
        countres = response.length
        if (countres > 2)
        {
            document.getElementById("subcat2").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_3").disabled = "disabled";
            document.getElementById("CatMenu_4").disabled = "disabled";
            document.getElementById("CatMenu_5").disabled = "disabled";
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";
        }
        else
        {
            document.getElementById("subcat2").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_2").disabled = "disabled";
            document.getElementById("CatMenu_3").disabled = "disabled";
            document.getElementById("CatMenu_4").disabled = "disabled";
            document.getElementById("CatMenu_5").disabled = "disabled";
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";
        }
    }
}

function stateChanged3()
{
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        response = xmlHttp.responseText.split("<option");
        countres = response.length
        if (countres > 2)
        {
            document.getElementById("subcat3").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_4").disabled = "disabled";
            document.getElementById("CatMenu_5").disabled = "disabled";
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";
        }
        else
        {
            document.getElementById("subcat3").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_3").disabled = "disabled";
            document.getElementById("CatMenu_4").disabled = "disabled";
            document.getElementById("CatMenu_5").disabled = "disabled";
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";

        }
    }
}

function stateChanged4()
{
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        response = xmlHttp.responseText.split("<option");
        countres = response.length
        if (countres > 2)
        {
            document.getElementById("subcat4").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_5").disabled = "disabled";
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";
        }
        else
        {
            document.getElementById("subcat4").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_4").disabled = "disabled";
            document.getElementById("CatMenu_5").disabled = "disabled";
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";
        }
    }
}

function stateChanged5()
{
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        response = xmlHttp.responseText.split("<option");
        countres = response.length
        if (countres > 2)
        {
            document.getElementById("subcat5").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";
        }
        else
        {
            document.getElementById("subcat5").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_5").disabled = "disabled";
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";

        }
    }
}

function stateChanged6()
{
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        response = xmlHttp.responseText.split("<option");
        countres = response.length
        if (countres > 2)
        {
            document.getElementById("subcat6").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_7").disabled = "disabled";
        }
        else
        {
            document.getElementById("subcat6").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_6").disabled = "disabled";
            document.getElementById("CatMenu_7").disabled = "disabled";

        }
    }
}

function stateChanged7()
{
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        response = xmlHttp.responseText.split("<option");
        countres = response.length
        if (countres > 2)
        {
            document.getElementById("subcat7").innerHTML = xmlHttp.responseText;
        }
        else
        {
            document.getElementById("subcat7").innerHTML = xmlHttp.responseText;
            document.getElementById("CatMenu_7").disabled = "disabled";
        }
        //     document.getElementById("subcat7").innerHTML=xmlHttp.responseText; 
    }
}


function GetXmlHttpObject()
{
    var objXMLHttp = null;
    if (window.XMLHttpRequest)
    {
        objXMLHttp = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        objXMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return objXMLHttp;
}

function lastcat(lastval)
{
    //alert(lastval);
    document.getElementById("sub_cat8").value = lastval;
}
