<script type="text/javascript">
function MM_CheckFlashVersion(reqVerStr,msg){
  with(navigator){
    var isIE  = (appVersion.indexOf("MSIE") != -1 && userAgent.indexOf("Opera") == -1);
    var isWin = (appVersion.toLowerCase().indexOf("win") != -1);
    if (!isIE || !isWin){  
      var flashVer = -1;
      if (plugins && plugins.length > 0){
        var desc = plugins["Shockwave Flash"] ? plugins["Shockwave Flash"].description : "";
        desc = plugins["Shockwave Flash 2.0"] ? plugins["Shockwave Flash 2.0"].description : desc;
        if (desc == "") flashVer = -1;
        else{
          var descArr = desc.split(" ");
          var tempArrMajor = descArr[2].split(".");
          var verMajor = tempArrMajor[0];
          var tempArrMinor = (descArr[3] != "") ? descArr[3].split("r") : descArr[4].split("r");
          var verMinor = (tempArrMinor[1] > 0) ? tempArrMinor[1] : 0;
          flashVer =  parseFloat(verMajor + "." + verMinor);
        }
      }
      // WebTV has Flash Player 4 or lower -- too low for video
      else if (userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 4.0;

      var verArr = reqVerStr.split(",");
      var reqVer = parseFloat(verArr[0] + "." + verArr[2]);
  
      if (flashVer < reqVer){
        if (confirm(msg))
          window.location = "http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash";
      }
    }
  } 
}
</script>
<body onLoad="MM_CheckFlashVersion('7,0,0,0','Content on this page requires a newer version of Macromedia Flash Player. Do you want to download it now?');"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="100" height="100" id="FLVPlayer">
  <param name="movie" value="FLVPlayer_Progressive.swf" />
  <param name="salign" value="lt" />
  <param name="quality" value="high" />
  <param name="scale" value="noscale" />
  <param name="FlashVars" value="&MM_ComponentVersion=1&skinName=Corona_Skin_3&streamName=videouploads/5f031af21868e4ea6727f3831aa8b621niceday&autoPlay=false&autoRewind=false" />
  <embed src="FLVPlayer_Progressive.swf" flashvars="&MM_ComponentVersion=1&skinName=Corona_Skin_3&streamName=videouploads/5f031af21868e4ea6727f3831aa8b621niceday&autoPlay=false&autoRewind=false" quality="high" scale="noscale" width="100" height="100" name="FLVPlayer" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
