function view_controller(ASid,mob,preview,syndicate,nosplash){
	var self = this
	var scalar = 1
	var $bg_fill = $("#bg_fill")
	this.__zoom = 1
	this.__ASid = ASid
	this.__preview = preview
	this.__syndicate = syndicate
	this.__width = $bg_fill.width()
	this.__height = $bg_fill.height()
	this.__inner_width
	this.__responsive = false
	this.__inner_height
	this.__state_obj
	this.__padding
	this.__delay = 0
	this.__page = 0;
	this.__active = 0
	this.__device = isMobile.any()
	this.__mobile = mob
	this.__retina = window.devicePixelRatio > 1;
	this.__radio_scale = 30;
	this.__modal = new modal(this)
	this.__tabbing = false
	this.__visits = 1
	var BCtoken = "kW3Z5VuyO6u1bG7j5Yy0PjaOyjHF6ALA80MONlg8ydJGTZ3b0K2COA.."
	var slide_speed = 300
	var start = null
	// cache those jquery nodes...
	var slidelock = false
	var $assessment = $("#assessment")
	var $container = $("#container")
	var $container_inner = $("#container_inner")
	var $nav = $("#nav")
	var $header = $("#header")
	var $header_inner = $("#header_inner")
	var $nav_fg = $("#nav_fg")
	var $nav_r1 = $("#nav_r1")
	var $nav_r2 = $("#nav_r2")
	var $shadow_top = $("#shadow_top")
	var $shadow_bottom = $("#shadow_bottom")
	var $fade_left = $("#fade_left")
	var $fade_right = $("#fade_right")
	var $controls = $("#controls")
	var $preloader = $("#preloader")
	var $mob_launch = $("#mob_launch")
	var $mob_inner = $("#mob_launch>div")
	var $mob_cancel = $("#mob_launch>div>a")
	var $r_preloader = $("#results_preloader")
	var $rdiv = $("#results")
	var $ldiv = $("#links")
	if(!__data.config.quiz){
		this.__quiz = 0
	}else{
		this.__quiz = parseInt(__data.config.quiz)
	}
	var $pages,$radio_fg,$radio_bg,$radio_fill,$radio_over,header_h,$branding,$branding_img;
	if(!self.__mobile){
		if(!self.__syndicate){
			var $assessment_webpart_wrapper = $("#assessment_webpart_wrapper",window.parent.document)
			$assessment_webpart_wrapper.css('margin-left','auto').css('margin-right','auto').css('width',self.__width)
			$("#preloader img").fadeIn(500)
		}
	}
	//console.log(__data)
	$('title').html(__data.config.title)
	loadjscssfile("js/wt_init.js", "js")
	$header_inner.html(__data.config.title)
	this.setGradient = function(target,c1,c2){
		var opacity = target.css('opacity')
		target.css("background","#"+c2);
		target.css("background","-webkit-gradient(linear, left top, left bottom, from(#"+c1+"), to(#"+c2+"))");
		target.css("background","-moz-linear-gradient(top,  #"+c1+",  #"+c2+")");
		if(__vendor == "IE"){
			target.css("filter","progid:DXImageTransform.Microsoft.gradient(startColorstr='#"+c1+"', endColorstr='#"+c2+"')");
		}
		target.css('opacity',opacity)
	}
	this.launchMob = function(e){
		if(self.__syndicate == true){
			window.parent.postMessage('{"nhs_redirect":"http://media.nhschoices.nhs.uk/tools/documents/self_assessments_js/assessment.html?&ASid='+self.__ASid+'&mobile=true&syndicate=true&nosplash=false"}', "*");  
			//window.top.location.href = "http://media.nhschoices.nhs.uk/tools/documents/self_assessments_js/assessment.html?&ASid="+self.__ASid+"&mobile=true&syndicate=true&nosplash="+self.__responsive
		}else{
			//window.top.location.href = "/tools/documents/self_assessments_js/assessment.html?&ASid="+self.__ASid+"&mobile=true&nosplash="+self.__responsive
			window.top.location.href = "assessment.html?&ASid="+self.__ASid+"&mobile=true&nosplash="+self.__responsive
		}
		
	}
	this.resizeLayout = function(){
		self.__width = $bg_fill.width()
		self.__height = $bg_fill.height()
		header_h = Math.ceil(Math.max((self.__height*0.08),40))
		$assessment.height(self.__height)
		$preloader.height(self.__height);
		scalar = Math.floor((Math.sqrt(self.__width*self.__height)/225)*2)*self.__zoom;
		if(!self.__mobile){
			$("body").css("fontSize",Math.max(Math.min(scalar*3,24),13));
		}else{
			$fade_left.remove()
			$fade_right.remove()
			$("body").css("fontSize",Math.max(Math.min(scalar*4,32),13));
			self.__delay = 100;
			if($branding){
				$branding.css('padding',header_h*0.2)
				$branding_img.height(header_h*0.6)
			}
		}
		var padding = 2
		var s_depth = Math.max(2,Math.ceil(self.__height/100)*2);
		var inner_height = self.__height-header_h;
		var inner_width = self.__width-(padding*2);
		self.__inner_width = inner_width
		self.__inner_height = inner_height
		self.__padding = padding
		self.__ratio = inner_width/inner_height
		var radius = Math.ceil(padding*5)
		$container.css("left",padding);
		$container.css("bottom",padding);
		$container.css("width",inner_width);
		$container.css("height",self.__height-(padding+(header_h)));
		$("#container_inner").css("height",self.__inner_height-(self.__padding*1.1))
		//
		$nav.css("left",padding);
		$nav.css("bottom",padding);
		$nav.css("width",inner_width);
		self.__nh = 0-$nav_fg.height()
		$nav_fg.css("margin-top",self.__nh);
		//$bg_fill.css("border-radius",radius);
		if(self.__mobile == false){
			$($bg_fill).css("border-radius",radius+2);
			$container.css("border-bottom-left-radius",(radius*0.8));
			$container.css("border-bottom-right-radius",(radius*0.8));
			$nav.css("border-bottom-left-radius",(radius*0.8));
			$nav.css("border-bottom-right-radius",(radius*0.8));
		}else{
			$($bg_fill).css("border-radius",0);
		}
		$bg_fill.css("background","#"+__data.config.colour_1[0]);
		$fade_right.css("right",padding);
		$fade_right.css("top",header_h+1);
		$fade_right.css("width",Math.max(10,(s_depth)));
		$fade_right.css("height",inner_height-$nav.height());
		if(__IE ==7){
			$fade_right.css("right",padding+1);
		}
		$fade_left.css("left",padding);
		$fade_left.css("top",header_h+1);
		$fade_left.css("width",Math.max(10,(s_depth)));
		$fade_left.css("height",inner_height-$nav.height());
		//
		if(self.__mobile == false){
			$header.css("border-top-left-radius",2+(radius*0.8));
			$header.css("border-top-right-radius",2+(radius*0.8));
		}else{
			$header.css("border-top-left-radius",0);
			$header.css("border-top-right-radius",0);
			window.scrollTo(0, 1);
		}
		
		$header.css("height",header_h);
		$header.css("width",self.__width);
		$controls.css("padding",padding);
		$("#controls img").css("width",(self.__height/10)-(padding*2));
		var t_pad = ($header.css("height").replace('px','')-$header_inner.css("height").replace('px',''))*0.5
		//
		$header_inner.css("padding-top",t_pad);
		$header_inner.css("padding-left",t_pad);
		//
		self.setPages()
		$container_inner.css("left", 0-(self.__width*self.__page));	
		$("#info_box a").css("color","#"+__data.config.colour_1[0])
		
	}
	this.setPages = function(){
		$pages = $('div.page')
		$pages.css("width",Math.floor(self.__inner_width))
		$pages.css("height",Math.floor(self.__inner_height-($nav.height()+3)))
		self.__quiz_obj.resizeLayout()
		self.__splash.resizeLayout()
		self.__results_obj.resizeLayout()
		self.__nav_obj.resizeLayout()
		self.scaleRadio()
	}
	this.resetSA = function(){
		//self.__analytics.advance('Restarted',false)
		self.__state_obj.clearState();
		if(self.__mobile){
			history.back()
		}else{
			window.location.reload()
		}
	}
	this.Darken = function(hex,inc) {
		var tiny = tinycolor(hex);
		tiny =tinycolor.lighten(tiny, inc)
		return tiny.toHex()
	}
	this.scaleRadio = function(){
		//scale pngs for radio buttons
		self.__radio_size = Math.max(30,Math.min(50,((scalar/2)-1)*20));
		//console.log(self.__radio_size)
		$radio_bg = $(".radio_bg")
		$radio_fg = $(".radio_fg")
		$radio_fill = $(".radio_fill")
		$radio_over = $(".radio_over")
		if(self.__retina){
			$radio_bg.attr("src","images/radio_bg_"+(self.__radio_size*2)+".png");
			$radio_fg.attr("src","images/radio_fg_"+(self.__radio_size*2)+".png");
		}else{
			$radio_bg.attr("src","images/radio_bg_"+self.__radio_size+".png");
			$radio_fg.attr("src","images/radio_fg_"+self.__radio_size+".png");
		}
		
		
		$radio_bg.css("width",self.__radio_size);
		$radio_fg.css("width",self.__radio_size);
		$radio_fill.css("width",self.__radio_size-4);
		$radio_over.css("width",self.__radio_size-4);
		
		$radio_bg.css("height",self.__radio_size);
		$radio_fg.css("height",self.__radio_size);
		$radio_fill.css("height",self.__radio_size-4);
		$radio_over.css("height",self.__radio_size-4);
		
		$radio_bg.css("margin-right",0-self.__radio_size);
		$radio_fill.css("margin-right",0-(self.__radio_size+4));
		$radio_over.css("margin-right",0-(self.__radio_size+4));
		if(self.__retina){
			$radio_bg.css("margin-top",0-(self.__radio_size*0.125));
			$radio_fg.css("margin-top",0-(self.__radio_size*0.125));
			$radio_fill.css("margin-top",2-(self.__radio_size*0.125));
			$radio_over.css("margin-top",2-(self.__radio_size*0.125));
		}else{
			$radio_bg.css("margin-top",0-(self.__radio_size*0.25));
			$radio_fg.css("margin-top",0-(self.__radio_size*0.25));
			$radio_fill.css("margin-top",2-(self.__radio_size*0.25));
			$radio_over.css("margin-top",2-(self.__radio_size*0.25));
		}
	}
	this.preloadResults = function(){
		self.__results_obj.generateResults()
		if(__IE > 7){
			self.hidePages(false)
			self.__nav_obj.checkNav();
			$r_preloader.css("visibility","visible");
			$r_preloader.fadeIn(600,function(){
				$container_inner.css("left", 0-(self.__width*self.__page))
				slidelock = false
				self.hidePages(true)
				self.updateHeader()
				//$('#lscroll_pane').hide()
				$r_preloader.delay(1000).show(1,function(){
					$('#rscroll_pane').show()
					$('#lscroll_pane').show()
				}).fadeOut(600, function() {
					$r_preloader.css("visibility","hidden");
				});
				self.__state_obj.storeState();
				self.manageTabbing()
			})
		}else{
			self.__nav_obj.checkNav();
			$container_inner.css("left", 0-(self.__width*self.__page))
			slidelock = false
			self.hidePages(true)
			self.updateHeader()
			self.__state_obj.storeState();
		}
	}
	this.manageTabbing = function(){
		if(self.__tabbing){
			switch(self.__page){
				case 0:
					$('#splash_start').focus();
				break;
				case (self.__quiz_obj.__quiz_arr.length+1):
					$('#nav_links').focus()
				break;
				case (self.__quiz_obj.__quiz_arr.length+2):
					self.__results_obj.focusL1()
				break;
				default:
					self.__quiz_obj.__q_obj_arr[self.__page-1].__q.focusQ1()
				break;
			}
		}
		if(self.__mobile){
			window.scrollTo(0, 1);
		}
	}
	this.slideNext = function(){
		if(!slidelock){
			slidelock = true
			self.__page++;
			if(self.__page == 1){
				self.__nav_obj.checkNav();
			}
			if(self.__page <= self.__quiz_obj.__quiz_arr.length){
				self.__quiz_obj.build()
				self.__quiz_obj.renderQ()
				self.setPages();
				self.hidePages(false)
				self.animateDelay()
				if(self.__page>=1){
					self.__analytics.advance('Q'+(self.__quiz_obj.__q_obj_arr[self.__page-1].__id+1),false,false)
				}
			}else if(self.__page == self.__quiz_obj.__quiz_arr.length+1){
				self.preloadResults()
				self.__analytics.advance('Results',true,true)
			}else if(self.__page == self.__quiz_obj.__quiz_arr.length+2){		
				self.hidePages(false)
				self.animateDelay()
				self.__analytics.advance('Links',false,true)
			}
		}
	}
	
	this.slidePrev = function(){
		if(!slidelock){
			slidelock = true
			self.__page--;
			self.hidePages(false)
			self.setPages()
			//self.__analytics.advance('UserBackTracked',false)
			if(self.__page == self.__quiz_obj.__quiz_arr.length){
				setTimeout(function(){self.__results_obj.clearResults()},slide_speed)
			}
			if((self.__page+1)<self.__quiz_obj.__q_obj_arr.length){
				self.__quiz_obj.__q_obj_arr[self.__page-1].__q.resizeLayout()
			}
			self.animateDelay()
		}
	}
	this.animateDelay = function(){
		self.__quiz_obj.resizeLayout()
		setTimeout(run,self.__delay)
		function run(){
		$fade_left.show()
		$fade_right.show()
		$container_inner.animate({
			left: 0-(self.__width*(self.__page))
			  }, slide_speed, function() {
				  slidelock = false
				  self.hidePages(true)
				  self.__nav_obj.checkNav();
				  self.updateHeader()
				  self.__state_obj.storeState();
		  		  self.manageTabbing()
			  });
		}
	}
	this.hidePages = function(bool){
		if(!self.__device){
			if(!bool){
				$pages.css("display","block")
			}else{
				$pages.css("display","none")
				$fade_left.hide()
				$fade_right.hide()
			}
		}
	}
	this.updateHeader = function(){
		if(self.__page <= self.__quiz_obj.__quiz_arr.length){
			$header_inner.html(__data['config']['title'])
			var q = $("#q_"+self.__quiz_obj.__quiz_arr[self.__page-1].id)
			q.css("display","block")
		}
		else if(self.__page == self.__quiz_obj.__quiz_arr.length+1){
			$header_inner.html("Your Results")
			$rdiv.css("display","block")
		}
		else if(self.__page == self.__quiz_obj.__quiz_arr.length+2){
			$header_inner.html("Useful Links")
			$ldiv.css("display","block")
		}
		self.__active = self.__quiz_obj.getActive(self.__page)
	}
	this.restoreState = function(answers,page){
		//self.__analytics.start()
		//self.__analytics.advance('UserResumedSession',false)
		self.__page = page
		self.__quiz_obj.__answer_arr = answers
		self.__quiz_obj.build()
		self.__quiz_obj.renderQ()
		self.__quiz_obj.setQuestions()
		$shadow_bottom.fadeIn();
		$nav.fadeIn();
		if(self.__quiz_obj.__quiz_arr.length < self.__page){
			self.__results_obj.generateResults()
			$("#rscroll_pane").css('display','block')
			$("#lscroll_pane").css('display','block')
		}
		
		$container_inner.css("left", 0-(self.__width*self.__page))
		$pages = $('div.page')	
		self.hidePages(true)
		self.__nav_obj.checkNav()
		self.updateHeader()
	}
	this.lockView = function(){
		$assessment.find("a").attr("tabindex", -1);
		$assessment.find("input").attr("tabindex", -1);
	}
	this.unlockView = function(){
		$assessment.find("a").attr("tabindex", null);
		$assessment.find("input").attr("tabindex", null);
		self.__nav_obj.checkNav()
	}
	this.launchInfo = function(id){
		var info_obj = self.infoBoxLookup(id);
		self.__modal.launch({'body':info_obj.body,'title':info_obj.title})
	}
	this.launchVid = function(id){
		var output = '';
		//self.__analytics.advance('VideoLaunched_BCID'+id,false)
		if(isMobile.any()){
			var w = self.__width*0.8
			var h = w *0.68820;
			output = '<div style="padding:0.8em;"></div><div class="html5_bc_wrap" style = "height:'+(h*0.8)+'px;"><script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script><object id="myExperience" class="BrightcoveExperience"><param name="bgcolor" value="#FFFFFF" /><param name="width" value="'+w+'px" /><param name="height" value="'+h+'px" /><param name="playerID" value="2084639265001" /><param name="playerKey" value="AQ~~,AAAAEnJXNGk~,eUsJGAd8lWrJWADDSveCgmFP65UnWW1I" /><param name="isVid" value="true" /><param name="isUI" value="true" /><param name="dynamicStreaming" value="true" /><param name="@videoPlayer" value="'+id+'" /></object></div>';
			self.__modal.launch({'body':output,'title':null,'w':(w-10),'h':h,'fit':'flush'})
		}else{
			if(self.__width<386){
				self.__modal.launch({'body':self.renderBCPlayer(0,id),'title':null,'fit':'flush',w:312,h:198})
				
			}else if(self.__width<531){
				self.__modal.launch({'body':self.renderBCPlayer(1,id),'title':null,'fit':'flush'})
				
			}else if(self.__width<764){
				self.__modal.launch({'body':self.renderBCPlayer(2,id),'title':null,'fit':'flush'})
				
			}else if(self.__width<942){
				self.__modal.launch({'body':self.renderBCPlayer(3,id),'title':null,'fit':'flush'})
				
			}else{
				self.__modal.launch({'body':self.renderBCPlayer(4,id),'title':null,'fit':'flush'})
				
			}
		}
		
		brightcove.createExperiences();
	}
	bcLoaded = function(experienceID) {

	};
	bcReady = function(experienceID) {
	};
	this.renderBCPlayer = function(size,bcid){
		var fhtml = '<param name="forceHTML" value="true" />'
		if(!self.__device){
			fhtml = '';
		}
		output =''
		switch (size){
			case 0:
				output += '<div style="padding:12px;"></div><object id="myExperience1905129099001" class="BrightcoveExperience"><param name="width" value="314" /><param name="height" value="198" /><param name="autoStart" value="true" /><param name="playerID" value="1999335141001" /><param name="playerKey" value="AQ~~,AAAAEnJXNGk~,eUsJGAd8lWoKRss32pGFnFaaMK2KW2Gh" /><param name="includeAPI" value="true" /><param name="isVid" value="true" /><param name="isUI" value="true" /><param name="dynamicStreaming" value="true" />'+fhtml+'<param name="@videoPlayer" value="'+bcid+'" /><param name="templateLoadHandler" value="bcLoaded" /><param name="templateReadyHandler" value="bcReady" /> </object>';
			break;
			case 1:
				output += '<div style="padding:15px;"></div><object id="myExperience1905129099001" class="BrightcoveExperience"><param name="width" value="344" /><param name="height" value="207" /><param name="autoStart" value="true" /><param name="playerID" value="794231187001" /><param name="playerKey" value="AQ~~,AAAAEnJXNGk~,eUsJGAd8lWoQfXCgKDZmhK6PHcUHmhtj" /><param name="includeAPI" value="true" /><param name="isVid" value="true" /><param name="isUI" value="true" /><param name="dynamicStreaming" value="true" />'+fhtml+'<param name="@videoPlayer" value="'+bcid+'" /><param name="templateLoadHandler" value="bcLoaded" /><param name="templateReadyHandler" value="bcReady" /> </object>';
			break;
			case 2:
				output += '<div style="padding:20px;"></div><object id="myExperience1905129099001" class="BrightcoveExperience"><param name="width" value="479" /><param name="height" value="289" /><param name="autoStart" value="true" /><param name="playerID" value="775256332001" /><param name="playerKey" value="AQ~~,AAAAEnJXNGk~,eUsJGAd8lWobfgtFKcyKbHFr8ujAb7tR" /><param name="includeAPI" value="true" /><param name="isVid" value="true" /><param name="isUI" value="true" /><param name="dynamicStreaming" value="true" />'+fhtml+'<param name="@videoPlayer" value="'+bcid+'" /><param name="templateLoadHandler" value="bcLoaded" /><param name="templateReadyHandler" value="bcReady" /> </object>';
			break;
			case 3:
				output += '<div style="padding:20px;"></div><object id="myExperience1905129099001" class="BrightcoveExperience"><param name="width" value="712" /><param name="height" value="400" /><param name="autoStart" value="true" /><param name="playerID" value="2072970284001" /><param name="playerKey" value="AQ~~,AAAAEnJXNGk~,eUsJGAd8lWoiirIrPIK-YXnOhUSwhAoo" /><param name="includeAPI" value="true" /><param name="isVid" value="true" /><param name="isUI" value="true" /><param name="dynamicStreaming" value="true" />'+fhtml+'<param name="@videoPlayer" value="'+bcid+'" /><param name="templateLoadHandler" value="bcLoaded" /><param name="templateReadyHandler" value="bcReady" /> </object>';
			break;
			case 4:
				output += '<div style="padding:20px;"></div><object id="myExperience1905129099001" class="BrightcoveExperience"><param name="width" value="888" /><param name="height" value="500" /><param name="autoStart" value="true" /><param name="playerID" value="2072970283001" /><param name="playerKey" value="AQ~~,AAAAEnJXNGk~,eUsJGAd8lWqJbZC0oTsevnfnZ5IuioNA" /><param name="includeAPI" value="true" /><param name="isVid" value="true" /><param name="isUI" value="true" /><param name="dynamicStreaming" value="true" />'+fhtml+'<param name="@videoPlayer" value="'+bcid+'" /><param name="templateLoadHandler" value="bcLoaded" /><param name="templateReadyHandler" value="bcReady" /> </object>';
			break;
		}
		return output;
	}
	this.infoBoxLookup = function(id){
		var output = {}
		for (var a = 0; a < __data.info_boxes.ib.length; a++){
			if(__data.info_boxes.ib[a].id == id){
				output = __data.info_boxes.ib[a];
			}
		}
		return output
	}
	this.lookUpLink = function(id){
		//console.log(__data.link_items.ri[0])
		if(__data.link_items.ri.id != undefined){
			__data.link_items.ri = [__data.link_items.ri]
		}
		var output = {}
		for (var a = 0; a < __data.link_items.ri.length; a++){
			if(__data.link_items.ri[a].id == id){
				output = __data.link_items.ri[a];
			}
		}
		return output
	
	}
	this.sortUnique = function(arr) {
		arr = arr.sort(function (a, b) { return a*1 - b*1; });
		var ret = [arr[0]];
		for (var i = 1; i < arr.length; i++) {
			if (arr[i-1] !== arr[i]) {
				ret.push(arr[i]);
			}
		}
		return ret;
	}
	// init stuff
	if(!self.__syndicate){
		if($('body',window.parent.document).attr('class') == 'mobile'){
			self.__responsive = true
		}
	}
	if(this.__device && !this.__mobile ){
		if(self.__responsive == true && !self.__syndicate){
			window.parent.asSetResponsive()
			self.__zoom=1.5
			__data.config.intro_graphic_position = false
			__data.config.intro_graphic_position_m = false
			$fade_left.hide()
			$fade_right.hide()
		}else{
			$mob_launch.css("visibility","visible")
			$mob_inner.css("margin-top",(self.__height*0.5)-($mob_inner.height()*0.75))
			$("#mob_launch hr").css("border-top","1px solid #"+__data.config.colour_2[0]).css("border-bottom","1px solid #"+__data.config.colour_2[1])
			$mob_inner.click(function(e){self.launchMob(e);$mob_launch.css("visibility","hidden");return false;})
			$mob_launch.click(function(e){$mob_launch.css("visibility","hidden");return false;})
			$mob_cancel.click(function(e){$mob_launch.css("visibility","hidden");return false;})
			self.setGradient($mob_inner,__data.config.colour_2[1],__data.config.colour_2[0]);
		}
	}
	this.__state_obj = new maintain_state(this,ASid);
	this.__quiz_obj = new quiz_obj(this);
	this.__results_obj = new results_obj(this,this.__quiz_obj);
	this.__nav_obj = new nav_obj(this);
	this.__splash = new splash(this,"#splash");
	this.__quiz_obj.build()
	this.__quiz_obj.renderQ()
	this.__analytics = new analytics(this)
	document.title = 'NHS Choices '+__data.config.title
	//$('meta[name="WT.ti]"').attr('content','NHS Choices '+__data.config.title)
	$('head').append('<meta name="WT.ti" content="NHS Choices '+__data.config.title+'" />')
	//console.log(__data.config)
	if(self.__mobile && self.__syndicate){
		$header.append('<div id = "mob_synd_branding"><a href = "http://nhs.uk/tools/"><img src = "images/nhs.png" border = "0"></a></div')
		$branding = $('#mob_synd_branding')
		$branding_img = $('#mob_synd_branding img')
	}
	if(nosplash=='true'){
		self.__page = 1
		self.__quiz_obj.build()
		self.__quiz_obj.renderQ()
		self.__quiz_obj.setQuestions()
		$shadow_bottom.fadeIn();
		$nav.fadeIn();
		$container_inner.css("left", 0-(self.__width*self.__page))
		$pages = $('div.page')
	}
	this.resizeLayout();
	$(document).mousedown(function(e){
		self.__tabbing = false	
		
	})
	$(document).mouseup(function(e){
		$('a').blur()
		
	})
	$(document).keydown(function(e){
		if(e.keyCode == 9 || e.keyCode == 13){
			self.__tabbing = true	
		}
		
	})
	
	setTimeout(restoreQ,1000)
	function restoreQ(){
		if(self.__preview == null){
			self.__state_obj.restoreState()
		}else{
			switch(self.__preview){
				case "splash":
					self.__page = 0
					self.__preview = null
				break;
				case "results":
					self.__quiz_obj.previewResults(1)
				break;
				case "links":
					self.__quiz_obj.previewResults(2)
				break;
				default:
					self.__preview = parseInt(self.__preview)
					self.__quiz_obj.preview(self.__preview)
					slide_speed = 0
					self.slideNext()
				break;
			}
		
		}
		self.setPages()
		$preloader.fadeOut(1000, function() {
			$preloader.css("visibility","hidden");
		})
	}
	$(window).resize(function () {
		  self.resizeLayout()
	});
	//console.log(this)
	// get BC data
	__data.bc_lookup = {}
	if(__data.videos != ""){
		for(var i = 0; i < __data.videos.v.length; i++) {
			$.ajax({
			  url: "http://api.brightcove.com/services/library?command=find_video_by_id&video_id="+__data.videos.v[i]+"&video_fields=name,id&token="+BCtoken,
			  dataType: 'jsonp'
			}).done(function(data) { 
			  if(data != null){
				  __data.bc_lookup[data.id] = data
			  }
			});
		}
	}
}