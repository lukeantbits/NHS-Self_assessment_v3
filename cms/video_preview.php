<link href="css/layout.css" rel="stylesheet" type="text/css" />
<div id="place_holder"></div>
<!-- Brightcove Player Script --> 
<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script> <!-- Flash-only Player API script --> <script type="text/javascript" src="http://admin.brightcove.com/js/APIModules_all.js"> </script> <script type="text/javascript">
var BCL = {};
BCL.playerData = { "playerID" : "775256332001",
                    "playerKey" : "AQ~~,AAAAEnJXNGk~,eUsJGAd8lWobfgtFKcyKbHFr8ujAb7tR",
                    "width" : "479",
                    "height" : "289",
                    "videoID" : "681613285001" };
BCL.isPlayerAdded = false;
BCL.playerTemplate = "<div style=\"display:none\"></div><object id=\"myExperience\" class=\"BrightcoveExperience\"><param name=\"bgcolor\" value=\"#64AAB2\" /><param name=\"width\" value=\"{{width}}\" /><param name=\"height\" value=\"{{height}}\" /><param name=\"playerID\" value=\"{{playerID}}\" /><param name=\"playerKey\" value=\"{{playerKey}}\" /><param name=\"isVid\" value=\"true\" /><param name=\"isUI\" value=\"true\" /><param name=\"dynamicStreaming\" value=\"true\" /><param name=\"@videoPlayer\" value=\"{{videoID}}\"; /><param name=\"templateLoadHandler\" value=\"BCL.onTemplateLoaded\"</object>";
window.onload = function () {
  BCL.addPlayer(<?php echo $_REQUEST['id'];?>)
}
BCL.addPlayer = function (id) {
  if (BCL.isPlayerAdded == false) {
    BCL.isPlayerAdded = true;
    var playerHTML = "";
    BCL.playerData.videoID = id;
    playerHTML = BCL.markup(BCL.playerTemplate, BCL.playerData);
    document.getElementById("place_holder").innerHTML = playerHTML;
    brightcove.createExperiences();
  }
  else {
    console.log(BCL.videoSelect.selectedIndex);
    BCL.videoPlayer.loadVideo(BCL.videoData[BCL.videoSelect.selectedIndex].videoID);
  }
};
BCL.removePlayer = function () {
  if(BCL.isPlayerAdded == true) {
    BCL.isPlayerAdded = false;
    BCL.experienceModule.unload();
    document.getElementById("place_holder").innerHTML = "";
  }
};
BCL.onTemplateLoaded = function (id) {
  BCL.player = brightcove.getExperience(id);
  BCL.experienceModule = BCL.player.getModule(APIModules.EXPERIENCE);
  BCL.videoPlayer = BCL.player.getModule(APIModules.VIDEO_PLAYER);
};
BCL.markup = function (html, data) {
    var m;
    var i = 0;
    var match = html.match(data instanceof Array ? /{{\d+}}/g : /{{\w+}}/g) || [];

    while (m = match[i++]) {
        html = html.replace(m, data[m.substr(2, m.length-4)]);
    }

    return html;
};

</script>