function splash(vc,target){
	var output = "";
	var self = this
	self.__vc = vc
	if(vc.__mobile && __data.config.hr_intro_graphic_alt != ""){
		var img = __data.config.hr_intro_graphic_alt
	}else{
		var img = __data.config.intro_graphic_alt
	}
	var abs_output = ""
	output+="<div id = \"splash_wrap\"><h1>"+__data.config.intro_title+"</h1>"
	if(self.__vc.__mobile){
		var imgpos = parseInt(__data.config.intro_graphic_position_m)
	}else{
		var imgpos = parseInt(__data.config.intro_graphic_position)
	}
	
	switch(imgpos){
			case 1:
				output+="<img style=\"float:left;\" src = \""+__img_path+img+"\" alt=\""+__data.config.img_alt+"\">";
			break;
			case 2:
				output+="<div style = \"width:100%;text-align:center;\"><img src = \""+__img_path+img+"\" alt=\""+__data.config.img_alt+"\"></div>";
			break;
			case 3:
				output+="<img style=\"float:right;\" src = \""+__img_path+img+"\" alt=\""+__data.config.img_alt+"\">";
			break;
		}
	output+='<div id="splash_copy" style="margin-top:'+__data.config.js_body_top+';margin-left:'+__data.config.js_body_left+';width:'+__data.config.js_body_w+';">'+__data.config.intro_copy_alt+'</div>'
	switch(imgpos){
			case 4:
				abs_output+="<img class=\"abs_left_bottom\" alt=\""+__data.config.img_alt+"\" src = \""+__img_path+img+"\">";
			break;
			case 5:
				output+="<div style = \"width:100%;text-align:center;\"><img src = \""+__img_path+img+"\" alt=\""+__data.config.img_alt+"\"></div>";
			break;
			case 6:
				abs_output+="<img class=\"abs_right_bottom\" src = \""+__img_path+img+"\" alt=\""+__data.config.img_alt+"\">";
			break;
		}
	//}
	output+="</div>"
	output+="<div style=\"float:right;\" class=\"nav_button\" id=\"splash_start\"><a href=\"javascript:;\">Start</a></div>";
	if(__data.config.intro_foot.length>10){
		output+="<div id=\"splash_footer\">"+__data.config.intro_foot+"</div>";
	}
	$(target).html(abs_output+output)
	// cache those jquery nodes...
	var $splash = $("#splash")
	var $splash_start = $("#splash_start")
	var $splash_start_a = $("#splash_start>a")
	var $footer = $("#footer")
	var $splash_footer = $("#splash_footer")
	self.__vc.setGradient($splash_start,__data.config.colour_2[1],__data.config.colour_2[0]);
	
	if(!vc.__mobile){
		$splash_start_a.on({
			"mouseover": function() { vc.setGradient($splash_start,vc.Darken(__data.config.colour_2[1],-5),vc.Darken(__data.config.colour_2[0],-10))},
			"mouseout": function() { vc.setGradient($splash_start,__data.config.colour_2[1],__data.config.colour_2[0])},
			"focusin": function() { vc.setGradient($splash_start,vc.Darken(__data.config.colour_2[1],-5),vc.Darken(__data.config.colour_2[0],-10))},
			"focusout": function() { vc.setGradient($splash_start,__data.config.colour_2[1],__data.config.colour_2[0]) }
		});
	}
	
	this.resizeLayout = function(){
		$splash.css("overflow","hidden")
		$splash.css("height",(self.__vc.__inner_height))
		$splash_footer.css("width",self.__vc.__inner_width-(self.__vc.__padding*20));
		/*if(self.__vc.__retina){
			if(self.__vc.__mobile){
				$("#splash img").css('zoom','100%')
			}else{
				$("#splash img").css('zoom','50%')
			}
		}*/
		$splash_footer.css("padding",self.__vc.__padding*5);
		$splash_footer.css("margin-left",(self.__vc.__padding*5));
		$splash_footer.css("margin-bottom",self.__vc.__padding*5);
		$splash_footer.css("margin-right",0-(self.__vc.__padding*5));
		$splash_footer.css("border-radius",self.__vc.__padding*2.5);
		$splash_start.css("left",(self.__vc.__padding*5)).css('margin',0).css('width',(5*self.__vc.__zoom)+'em')
		$splash_start_a.css('zoom',self.__vc.__zoom)
		
		//
		//$splash_start.css("margin-left",0-(self.__vc.__padding*5));
		//$splash_start.css("position","absolute");
		if(__data.config.intro_foot.length>10){
			$splash_start.css('bottom',$splash_footer.height()+(self.__vc.__padding*20));
		}else{
			$splash_start.css('bottom',self.__vc.__padding*10);
		}
		if(__data.config.intro_foot.length>10 && abs_output != ""){
			$("#splash img").css("bottom",$('#splash_footer').height()+(self.__vc.__padding*15))
		}
	}
	self.resizeLayout();
	$splash_start.click(function(event){
		if(self.__vc.__responsive){
			self.__vc.launchMob(null)
		}else{
			self.__vc.slideNext()
		}
	});
}