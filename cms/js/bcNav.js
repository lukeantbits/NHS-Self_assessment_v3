function bcNav(target,callback,bc_id){
	this.callback = callback
	var self = this
	this.target = target
	this.pg = 1
	this.pg_size = 15
	this.total_count = 0
	this.data = null
	this.debug = null
	var policy_key = 'BCpkADawqM1OT2ano_knYrgXDGshdXSIXJT1Ub8BNAkFbAJLfdq8AjXZZGk1NfX5zNghRqGT3tjvzF4AVg6hwGkTdpwDh8jbgha1u3WT0HeJoUPaD8wKhoBT-Es'
	var account_id = '79227729001'
	this.bc_token = 'kW3Z5VuyO6u1bG7j5Yy0PjaOyjHF6ALA80MONlg8ydJGTZ3b0K2COA..'
	
	
	this.fetchPage = function(){
		self.pg_size = 15
		$(".bc_wrap").fadeOut("fast");
		//https://edge.api.brightcove.com/playback/v1/accounts/79227729001/videos/2163764869001
		self.getBrightcoveData('https://edge.api.brightcove.com/playback/v1/accounts/79227729001/videos?q=name:Moodzone',function(){
			
		})
		//self.getBrightcoveData('https://edge.api.brightcove.com/playback/v1/accounts/'+account_id+'/videos?name:nhs',function(){
			//console.log(this)
		//})
		/*var url = 'http://api.brightcove.com/services/library?command=find_all_videos&sort_by=publish_date&sort_order_type=DESC&get_item_count=true&page_number='+self.pg+'&page_size='+this.pg_size+'&video_fields=name,id,thumbnailURL&token='+self.bc_token;
		//alert(url)
            $.getJSON(url + "&callback=?", function (data) {
                self.data = data['items'];
				self.total_count = data['total_count'];
				self.debug = data
				self.renderPage();
          });*/
	}
	this.searchPage = function(search_str){
		if(search_str != 'undefined'){
			self.pg = 0
			self.pg_size = 100
			$(".bc_wrap").fadeOut("fast");
			self.getBrightcoveData('https://edge.api.brightcove.com/playback/v1/accounts/'+account_id+'/videos?q=name:'+search_str,function(){
				console.log(this)
			})
			
			
			/*var url = 'http://api.brightcove.com/services/library?command=search_videos&any='+search_str+'&sort_by=publish_date&sort_order_type=DESC&get_item_count=true&page_number='+self.pg+'&page_size='+this.pg_size+'&video_fields=name,id,thumbnailURL&token='+self.bc_token;
			self.debug = url
				$.getJSON(url + "&callback=?", function (data) {
					//self.debug = data
					if(data['items'].length > 0){
						self.data = data['items'];
						self.total_count = data['total_count'];
						self.renderPage();
					}else{
						//self.target.html("No results try something else!")
					}
			  });
		}else{
			self.fetchPage();
		}*/
		}
	}


	this.getBrightcoveData = function(url,callback) {
		var response_data,parsed_data
    	var http_request = new XMLHttpRequest(),response_data,parsed_data,
		  getResponse = function() {
			try {
			  if (http_request.readyState === 4) {
				if (http_request.status === 200) {
				  response_data = http_request.responseText;
				  parsed_data = JSON.parse(response_data);
				  console.log(parsed_data)
				  callback()
				}
			  }
			} catch (e) {
			  console.log('Caught Exception: ' + e);
			}
		  };
		http_request.onreadystatechange = getResponse;
		http_request.open('GET', url);
		http_request.setRequestHeader('Accept', 'application/json;pk=' + policy_key);
		http_request.send();
	}
	this.renderPage = function(){
		var output = "<div id=\"bc_nav\">"+self.renderNav()+"</div><div id = \"bc_content\">";
		for(var i = 0;i<self.data.length;i++){
			output+="<div class= \"bc_wrap\"><div class=\"vid_thumb_nav\"><table height=\"100%;\"><tr><td  valign = \"bottom\" align=\"center\"><a href=\"#\" class=\"vid_preview\" id = \""+self.data[i]['id']+"\">[preview]</a> <a href=\"#\" id = \""+self.data[i]['id']+"\" class=\"vid_add\">[add]</a></td></tr></table></div><img src=\""+self.data[i]['thumbnailURL']+"\"><br>"+self.data[i]['name']+"<br></div>"
			
		}
		output += "</div>";
		output += "<div id=\"bc_preview\" style=\"text-align:center;\"><div id=\"place_holder\"></div><input type=\"button\" name=\"back\" id=\"back\" value=\"◀ Back\"  style =\"margin-left:33px;width:70px;\" class=\"black_button\" /></div>"
		self.target.html(output);
		$("#bc_preview").fadeOut(0);
		$(".bc_wrap").fadeIn("fast");
		$(".vid_add").click(function(event){self.addBC(event.target.id)})
		$(".vid_preview").click(function(event){self.previewBC(event.target.id)})
		$("#back").click(function(event){self.cancelPreview()})
		$(".mini_btn_blue").click(function(event){
			self.pg = eval(self.pg+event.target.id)
			self.fetchPage()
		})
		$(".pgnum").click(function(event){
			self.pg = event.target.id
			self.fetchPage()
		})
		$("#search").click(function(event){
			self.searchPage($("#search_str").val())
		})
	
	}
	this.previewBC = function(id){
		$("#bc_content").fadeOut("fast");
		$("#bc_preview").fadeIn("fast");
		BCL.addPlayer(id)
	}
	this.cancelPreview = function(){
		$("#bc_content").fadeIn("fast");
		$("#bc_preview").fadeOut("fast");
		BCL.removePlayer()
	}
	this.renderNav = function(){
		//alert(self.total_count)
		
		var output = "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"5\"><tr><td valign=\"top\" width=\"3%\">";
		if(self.pg > 1){
			output += "<input type=\"button\" name=\"-1\" id=\"-1\" value=\"◀\" class=\"mini_btn_blue\" />"
		}
		output+= "</td><td  valign=\"top\"  width=\"20%\" style=\"border:1px solid #CCC;padding:3px;height:50px;\" ><input type=\"text\" name=\"search_str\" id=\"search_str\" /><br><input type=\"button\" name=\"search\" id=\"search\" value=\"Search\" class=\"black_button\" /></td>"
		output+= "<td valign=\"top\" width=\"74%\" style=\"border:1px solid #CCC;padding:3px;\" >"
		if(self.total_count > self.pg_size){
			var l = Math.ceil(self.total_count/self.pg_size)
			for(var i = 1;i<l;i++){
				if(i == self.pg){
					output += " <a href=\"#\" id=\""+i+"\" class=\"selected\">"+i+"</a> "
				}else{
					output += " <a href=\"#\" id=\""+i+"\" class=\"pgnum\">"+i+"</a> "
				}
				
			}
		
		}
		
		output += "</td><td align=\"right\" width=\"3%\" valign=\"top\">"
		if(self.pg < l-1){
			output += "<input type=\"button\" name=\"+1\" id=\"+1\" value=\"▶\" class=\"mini_btn_blue\" />";
		}
		output += "</td></tr></table>"
		return output;
	}
	this.addBC = function(id){
		parent.app.pageObj.addBC(id,callback)
		/*var arrFrames = parent.document.getElementsByTagName("IFRAME");
		alert(arrFrames)
		for (var i = 0; i < arrFrames.length; i++) {
		  if (arrFrames[i].contentWindow === window) alert("yay!");
		}*/
	}
	// player stuff here 
	var BCL = {};
	BCL.playerData = { "playerID" : "775256332001",
						"playerKey" : "AQ~~,AAAAEnJXNGk~,eUsJGAd8lWobfgtFKcyKbHFr8ujAb7tR",
						"width" : "479",
						"height" : "289",
						"videoID" : "681613285001" };
	BCL.isPlayerAdded = false;
	BCL.playerTemplate = "<div style=\"display:none\"></div><object id=\"myExperience\" class=\"BrightcoveExperience\"><param name=\"bgcolor\" value=\"#64AAB2\" /><param name=\"width\" value=\"{{width}}\" /><param name=\"height\" value=\"{{height}}\" /><param name=\"playerID\" value=\"{{playerID}}\" /><param name=\"playerKey\" value=\"{{playerKey}}\" /><param name=\"isVid\" value=\"true\" /><param name=\"isUI\" value=\"true\" /><param name=\"dynamicStreaming\" value=\"true\" /><param name=\"@videoPlayer\" value=\"{{videoID}}\"; /><param name=\"templateLoadHandler\" value=\"BCL.onTemplateLoaded\"</object>";
	
	  //BCL.addPlayer()
	
	
	
	BCL.addPlayer = function (bcid) {
	  if (BCL.isPlayerAdded == false) {
		BCL.isPlayerAdded = true;
		var playerHTML = "";
		BCL.playerData.videoID = bcid;
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

	this.fetchPage();
	
}