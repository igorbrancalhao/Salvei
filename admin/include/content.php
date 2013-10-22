<?php
/***************************************************************************
 *File Name				:content.php
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
<script>
function button_over(tdbutton)
{
	tdbutton.style.borderLeft = "#f7f7f7 solid 1px";
	tdbutton.style.borderRight = "#808080 solid 1px";
	tdbutton.style.borderTop = "#f7f7f7 solid 1px";
	tdbutton.style.borderBottom = "#808080 solid 1px";
}

function button_out(tdbutton)
{
	tdbutton.style.borderLeft ="0";
	tdbutton.style.borderRight ="0";
	tdbutton.style.borderTop ="0";
	tdbutton.style.borderBottom ="0";
}

function button_down(tdbutton)
{
	tdbutton.style.borderRight = "#f7f7f7 solid 1px";
	tdbutton.style.borderLeft = "#808080 solid 1px";
	tdbutton.style.borderBottom = "#f7f7f7 solid 1px";
	tdbutton.style.borderTop = "#808080 solid 1px";

}

function showcolorpop(showtype,ctype)
   {    
	colorpop = document.getElementById("fontcolor");
	cmenu = document.getElementById("colorMenu");
	if(showtype == 1)
	{
		colorpop.innerHTML = cmenu.innerHTML;
		if(ctype == 1)	
		{
			// set colortype as forecolor
			document.form1.colortype.value = 1;
		}
		else if(ctype == 2)
		{
			// set colortype as backcolor
			document.form1.colortype.value = 2;
		}
	}
	else
	{
		colorpop.innerHTML = '';
		button_out(button_forecolor);
	}
}
function showcolor(oColor)
{
	colorcell = document.getElementById("selectedcolor");
	colorcell.style.backgroundColor = oColor.id;
	colorcell.innerHTML = oColor.id;
}

function setforecolor(oColor)
{
	document.execCommand("ForeColor",false,oColor.id);
}

function setcolor(oColor)
{
	if(document.form1.colortype.value == 1)
	{
		document.execCommand("ForeColor",false,oColor.id);		
	}
}

function storehtml()
{
	document.form1.htmlcontent.value = areades.innerHTML;
}

document.onmousedown = showcolorpop;
</script>
<body>
<DIV ID="colorMenu" STYLE="display:none; position:absolute;" style="z-index:1999" onMouseOver="showcolorpop(1);" OnMouseOut="showcolorpop(0);">
<table id="colorMenuTable" cellpadding="5" cellspacing="5" border="1" bordercolor="#666666" style="cursor: hand;font-family: Verdana;font-size:2px; BORDER-LEFT: buttonhighlight 1px solid; BORDER-RIGHT: buttonshadow 2px solid; BORDER-TOP: buttonhighlight 1px solid; BORDER-BOTTOM: buttonshadow 1px solid; background-color: threedface;">
<tr><td colspan=12 id="selectedcolor" style="background-color:white;font-size:11px;color:white;font-weight:bold;">&nbsp;</td></tr>

			<tr>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#000000" id="#000000">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#333333" id="#333333">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#666666" id="#666666">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#999999" id="#999999">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cccccc" id="#cccccc">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff0000" id="#ff0000">&nbsp;</td>

				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#00ff00" id="#00ff00">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#0000ff" id="#0000ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ffff00" id="#ffff00">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#00ffff" id="#00ffff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff00ff" id="#ff00ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ffccff" id="#ffccff">&nbsp;</td>
			</tr>

			<tr>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ffcccc" id="#ffcccc">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ffcc99" id="#ffcc99">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ffcc96" id="#ffcc96">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#66ccff" id="#66ccff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#66cc99" id="#66cc99">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#669999" id="#669999">&nbsp;</td>

				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#6699cc" id="#6699cc">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#6699ff" id="#6699ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff9900" id="#ff9900">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff9933" id="#ff9933">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ffff33" id="#ffff33">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#666600" id="#666600">&nbsp;</td>
			</tr>

			<tr>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#666699" id="#666699">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#6666ff" id="#6666ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff6600" id="#ff6600">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff6633" id="#ff6633">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff6699" id="#ff6699">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff66cc" id="#ff66cc">&nbsp;</td>

				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff66ff" id="#ff66ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#660000" id="#660000">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#660033" id="#660033">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#660066" id="#660066">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#660099" id="#660099">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#6600cc" id="#6600cc">&nbsp;</td>
			</tr>


			<tr>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#6600ff" id="#6600ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#00ff00" id="#00ff00">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff0033" id="#ff0033">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff0066" id="#ff0066">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff0099" id="#ff0099">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff00cc" id="#ff00cc">&nbsp;</td>

				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ff00ff" id="#ff00ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33ff00" id="#33ff00">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33ff33" id="#33ff33">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33ff66" id="#33ff66">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33ff99" id="#33ff99">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33ffcc" id="#33ffcc">&nbsp;</td>
			</tr>

			<tr>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33ffff" id="#33ffff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ccff00" id="#ccff00">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ccff33" id="#ccff33">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ccff66" id="#ccff66">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ccff99" id="#ccff99">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ccffcc" id="#ccffcc">&nbsp;</td>

				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ccffff" id="#ccffff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33cc00" id="#33cc00">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33cc33" id="#33cc33">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33cc66" id="#33cc66">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33cc99" id="#33cc99">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33cccc" id="#33cccc">&nbsp;</td>
			</tr>

			<tr>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#33ccff" id="#33ccff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cccc00" id="#cccc00">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cccc33" id="#cccc33">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cccc66" id="#cccc66">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cccc99" id="#cccc99">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cccccc" id="#cccccc">&nbsp;</td>

				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#ccccff" id="#ccccff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#339900" id="#339900">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#339933" id="#339933">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#339966" id="#339966">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#339999" id="#339999">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#3399cc" id="#3399cc">&nbsp;</td>
			</tr>

			<tr>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#3399ff" id="#3399ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc9900" id="#cc9900">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc9933" id="#cc9933">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc9966" id="#cc9966">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc9999" id="#cc9999">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc99cc" id="#cc99cc">&nbsp;</td>

				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc99ff" id="#cc99ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#336600" id="#336600">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#336633" id="#336633">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#336666" id="#336666">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#336699" id="#336699">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#3366cc" id="#3366cc">&nbsp;</td>
			</tr>


			<tr>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#3366ff" id="#3366ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc6600" id="#cc6600">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc6633" id="#cc6633">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc6666" id="#cc6666">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc6699" id="#cc6699">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc66cc" id="#cc66cc">&nbsp;</td>

				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc66ff" id="#cc66ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#333300" id="#333300">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#333333" id="#333333">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#333366" id="#333366">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#333399" id="#333399">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#3333cc" id="#3333cc">&nbsp;</td>
			</tr>

			<tr>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#3333ff" id="#3333ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc3300" id="#cc3300">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc3333" id="#cc3333">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc3366" id="#cc3366">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc3399" id="#cc3399">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc33cc" id="#cc33cc">&nbsp;</td>

				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#cc33ff" id="#cc33ff">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#330000" id="#330000">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#333333" id="#333333">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#333366" id="#333366">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#333399" id="#333399">&nbsp;</td>
				<td onmousedown="setcolor(this)" onmouseover="showcolor(this)" style="background-color:#3333cc" id="#3333cc">&nbsp;</td>
			</tr>

			</tr>
		</table>
	</div>


<input type=hidden name="colortype" value=0>
<input type=hidden name="htmlcontent" value="">
<input type=hidden name="contentid" value="<?php echo $contentid;?>">
<input type=hidden name="canSave" value=1>

<table border=0 bgcolor=#cccccc cellpadding="5" cellspacing="0" width=100%>
<tr>
<!-- <td><input type=button value="B" onclick='document.execCommand("bold");'></td>-->
<td id="button_bold" style="cursor:hand" onclick='document.execCommand("bold")' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/bold.gif" alt="Bold"></td>
<td id="b1" style="cursor:hand" onclick='document.execCommand("italic")' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/italic.gif" alt="Italic"></td>
<td id="b1" style="cursor:hand" onclick='document.execCommand("underline")' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/underline.gif" alt="Underline"></td>
<td id="b1" style="cursor:hand" onclick='document.execCommand("cut");areades.focus();' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/cut.gif" alt="Cut"></td>
<td id="b1" style="cursor:hand" onclick='document.execCommand("copy");areades.focus();' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/copy.gif" alt="Copy"></td>
<td id="b1" style="cursor:hand" onclick='document.execCommand("paste");areades.focus();' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/paste.gif" alt="Paste"></td>
<td id="b1" style="cursor:hand" onclick='document.execCommand("JustifyLeft");areades.focus();' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/leftA.gif" alt="Align Left"></td>
<td id="b1" style="cursor:hand" onclick='document.execCommand("JustifyCenter");areades.focus();' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/center.gif" alt="Align Center"></td>
<td id="b1" style="cursor:hand" onclick='document.execCommand("JustifyRight");areades.focus();' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/rightA.gif" alt="Align Right"></td>
<td id="b1" style="cursor:hand" onclick='areades.focus();document.execCommand("InsertOrderedList");' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/bulletsO.gif" alt="Ordered List"></td>
<td id="b1" style="cursor:hand" onclick='areades.focus();document.execCommand("InsertUnOrderedList");' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/bulletsU.gif" alt="UnOrdered List"></td>
<td>
<select id="cboFontName" onChange='areades.focus();document.execCommand("FontName", false,this[this.selectedIndex].value);' unselectable="on">
<option selected>Font</option>
<option value="Times New Roman">Default</option>
<option value="Arial">Arial</option>
<option value="Verdana">Verdana</option>
<option value="Tahoma">Tahoma</option>
<option value="Geneva">Geneva</option>
<option value="Helvetica">Helvetica</option>
<option value="Courier New">Courier New</option>
<option value="Georgia">Georgia</option>
</select>
</td>
<td>
<select id="cboFontSize" onChange='areades.focus();document.execCommand("FontSize",false,this[this.selectedIndex].value);' unselectable="on">
<option selected>Font Size</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
</select>
</td>

<td id="button_forecolor" style="cursor:hand" onclick="showcolorpop(1,1);" onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this);"><img src="images/textcolor.gif" alt="Font Color"><br><div id="fontcolor" style="position:absolute;z-index:2000"></div></td>

<td id="b1" style="cursor:hand" onclick='areades.focus();document.execCommand("createLink",false);' onmouseover="button_over(this)" onmousedown="button_down(this)" onmouseout="button_out(this)"><img src="images/hyperlink.gif" alt="UnOrdered List"></td>
</tr>
</table>
<input type="hidden" name=hi value=6>
<div id=areades   contenteditable align=left  style="height:250; width:100%;overflow=auto;border:solid 1 c0c0c0" onblur="storehtml();">
<?php echo $itemdes;?>
</div>





