
function saIndex(path,id,layout) {
	var mode = 'cms'
	var self = this
	self.area = 'splash'
	self.display = 'desktop'
	self.layout = layout
	self.asset_path = '';
	self.postmessage = null
	self.syn_id = 'nhs'
	self.id = id
	self.dialogObj = null;
	self.qstr = getUrlVars();
	self.keynav = false;
	self.stateObj = new maintainState(this,id);
	self.questions = [];
	self.nav_h = 66;
	self.header_h = 48;
	var locked = false;
	var BCtoken = "kW3Z5VuyO6u1bG7j5Yy0PjaOyjHF6ALA80MONlg8ydJGTZ3b0K2COA.."
	this.path = path;
	this.pages = null;
	this.redirect_path = ''
	this.url_vars = getUrlVars();
	var $nav,$answers,$qpanes,$header,$splash,$results,$links,$results_inner,$links_inner,$bg_fill,$wrap,$preload,$preload_message,$container,$questions,$results,$links,outer_h,inner_h,$start_btn,$finish_btn;
	switch(mode){
		case 'cms':
		self.asset_path = path+'../cms/archive/as_'+id
		$.getJSON(path+'../cms/json_output.php?as_id='+id,function(data){
			self.data = data
			$('#antbits-SA_'+id).load(path+'templates/sa.html',function(){
				$('#antbits-SA_'+self.id).find('img').each(function(index, element) {
                    $(element).attr('src',path+$(element).attr('src'))
                });
				self.getVidData();
			})
		})
		break;
	}
	if(isMobile.any()){
		if(isMobile.Tablet()){
			self.display = 'tablet'
		}else{
			self.display = 'phone'
		}
	}
	this.linkOut = function(url){
		if(self.postmessage){
			window.parent.postMessage('{"antbits_redirect": {"url":"'+url+'"}}', '*');
		}else{
			window.top.location.href = url; 
		}
	}
	this.getVidData = function(){
		self.data.bc_lookup = {}
		var vids_indexed = 0;
		if(self.data.videos.length>0){
			for(var i = 0; i < self.data.videos.length; i++) {
				$.ajax({
					url: "//api.brightcove.com/services/library?command=find_video_by_id&video_id="+self.data.videos[i]+"&video_fields=name,id&token="+BCtoken,
					dataType: 'jsonp'
				}).done(function(data) { 
					if(data != null){
						self.data.bc_lookup[data.id] = data
						vids_indexed++;
						if(vids_indexed == self.data.videos.length){
							self.init();
						}
					}
				});
			}
		}else{
			self.init();
		}
	}
	this.launchVid = function(id){
		var output = '<video class = "antbits-SA-vid" onmousedown="dcsMultiTrack(\'DCSext.BCVid\',\'Play\',\'WT.dl\',\'121\')" data-video-id="'+id+'" data-account="79227729001" data-player="default" data-embed="default" data-application-id class="video-js" controls></video><script src="//players.brightcove.net/79227729001/default_default/index.min.js"></script>'
		self.dialog.launch({'body':output,'title':self.data.bc_lookup[id].name})
	}
	this.restoreState = function (rdata){
		if(rdata.area != 'splash'){
			self.area = rdata.area
			self.pages.each(function(index,element){
				$(element).hide();
			})
			for (var a = 0; a < self.data.questions.length; a++){
				if(rdata.questions[a].length > 0){
					self.data.questions[a].selected = rdata.questions[a]
					self.data.questions[a].obj.restore()
				}
			}
			self.quiz.current_index = rdata.current_index
			self.quiz.current_question = rdata.current_question
			self.quiz.build();	
			$splash.hide();
			
			switch(self.area){
				case 'questions':
					self.quiz.getCurrent().obj.slideIn(1);
					self.nav.checkState()
					self.nav.updateProgress(self.quiz)
				break;
				case 'results':
					self.results.populate();
					self.results.slideIn(0);
					self.nav.checkState()
					self.nav.setState(2)
				break;
				case 'links':
					self.results.populate();
					$links.show();
					self.nav.checkState()
					self.nav.setState(3)
				break;
			}
			self.resizeLayout()
		}
		setTimeout(function(){
			self.stateObj.clearState();
		},500)
	}
	this.getCurrentQ = function(){
		return self.data.questions[Math.max(0,self.quiz.current_index-1)];
	}
	this.resizeLayout = function(){
		//console.log('Resizing layout for '+self.area)
		
		self.nav_h = $nav.outerHeight();
		self.header_h = $header.outerHeight();
		self.dialog.resizeLayout();
		outer_h = 0;
		inner_h = 0;
		var p_max = 0;
		if(self.data.config.h_max == 0){
			self.data.config.h_max = 10000;
		}
		$answers.each(function(index,element){
			$(element).css('margin','10px 0px 10px 0px')
		})
		$qpanes.each(function(index,element){
			$(element).height('auto').css('overflow-y',null);
		})
		$results_inner.css('height',null)
		$links_inner.css('height',null)
		$results.css('height',null)
		$links.css('height',null)
		for(var i =0;i<self.pages.length;i++){
			$(self.pages[i]).width($container.outerWidth()-32).css('height',null).css('overflow-y',null);
			var tmp_h = $(self.pages[i]).outerHeight();
			
			switch($(self.pages[i]).attr('id')){
				case 'antbits-SA-splash':
					$(self.pages[i]).outerHeight(Math.max(tmp_h,(self.data.config.h_min-(self.header_h+10))))
				break;
				case 'antbits-SA-results':
					$(self.pages[i]).width($container.outerWidth())
				break;
				case 'antbits-SA-links':
					$(self.pages[i]).width($container.outerWidth())
				break;
				default:
					tmp_h-=32;
					if(self.questions[i-1].data.type == 'single select' || self.questions[i-1].data.type == 'multiple select'){
						p_max = Math.max(p_max,tmp_h);
					}
				break;
			}
		}
		
		if(self.display == 'phone' && self.layout == 'phone'){
			switch(self.area){
				case 'splash':
					inner_h =  $(window).height()-$header.height()
				break;
				case 'questions':
					inner_h =  $(window).height()-($header.height()+$nav.height())
					for(var q in self.questions){
						self.questions[q].resizeLayout($container.outerWidth()-32,inner_h-62)
					}
				break;
				case 'results':
					inner_h =  $(window).height()-$header.height()
					$results_inner.css('height',inner_h-(self.nav_h+28)).css('overflow-y','auto')
				break;
				case 'links':
					inner_h =  $(window).height()-$header.height()
					$links_inner.css('height',inner_h-(self.nav_h+28)).css('overflow-y','auto')
				break;
			}
			$container.css('top',self.header_h).height(inner_h);
		}else{
			switch(self.area){
				case 'splash':
					outer_h = Math.max(outer_h,$splash.outerHeight())+56
					inner_h = Math.max(inner_h,$splash.outerHeight())
				break;
				case 'questions':
					outer_h = Math.min(self.data.config.h_max,Math.max(self.data.config.h_min,p_max+42+self.header_h+self.nav_h))
					inner_h =  Math.min((self.data.config.h_max-(self.header_h+self.nav_h)),Math.max(self.data.config.h_min-(self.header_h+self.nav_h),p_max+32))
					for(var q in self.questions){
						self.questions[q].resizeLayout($container.outerWidth()-32,inner_h-32)
					}
				break;	
				case 'results':
					var h = Math.max($results.height()-14,$links.height()-14);
					outer_h = Math.min(self.data.config.h_max,Math.max(outer_h,h+80)+56);
					inner_h = Math.min(self.data.config.h_max-56,Math.max(inner_h,h+80));
					$results_inner.css('height',inner_h-self.nav_h).css('overflow-y','auto');
					self.results.resizeLayout('results');
				break;	
				case 'links':
					var h = Math.max($results.height()-14,$links.height()-14);
					outer_h = Math.min(self.data.config.h_max,Math.max(outer_h,h+80)+56);
					inner_h = Math.min(self.data.config.h_max-56,Math.max(inner_h,h+80));
					$links_inner.css('height',inner_h-self.nav_h).css('overflow-y','auto');
				break;	
			}
			$wrap.stop().animate({height:outer_h},500);
			$container.css('top',self.header_h).stop().animate({height:inner_h},500);
		}
	}
	this.retinafy = function(str){
		output = str;
		if(window.devicePixelRatio > 1){
			var tmp = str.split('.');
			tmp[tmp.length-2]+='@2x'
			output = tmp.join('.')+'" style="zoom:0.5';
		}
		return output;
	}
	this.browserCheck = function(){
		var str = navigator.userAgent
		if(str.search(' Edge/')>= 0 || str.search('MSIE')>= 0){
			$('head').append('<link href="css/styles_ie.css" rel="stylesheet" type="text/css" />')
		}
		
	}
	this.restart = function(){
		self.stateObj.clearState();
		$links.animate({'left':(0-$container.outerWidth())},300)
		$splash.show().css('left',($container.outerWidth())).animate({'left':0},300)
		self.area = 'splash'
		self.quiz.reset()
		self.resizeLayout()
		self.nav.setState(4);
	}
	this.slideNext = function(){
		if(!locked){
			locked = true
			if(self.quiz.isComplete() && self.area == 'results'){
				self.area = 'links'
			}
			if(self.quiz.isComplete() && self.area == 'questions'){
				self.area = 'results'
			}
			switch(self.area){
				case 'splash':
					$splash.animate({'left':0-($container.outerWidth())},300,function(){
						$splash.hide();
					})
					self.questions[0].slideIn(1);
					self.nav.setState(0)
					self.area = 'questions'
					self.resizeLayout()
					self.nav.updateProgress(self.quiz)
					if(self.keynav){
						self.focusActiveQ()
					}
				break;
				case 'questions':
					self.quiz.getCurrent().obj.slideOut(1);
					self.quiz.getNext().obj.slideIn(1);
					self.quiz.current_index++
					self.nav.setState(1)
					self.nav.updateProgress(self.quiz)
					if(self.keynav){
						self.focusActiveQ()
					}
				break;
				case 'results':
					$preload_message.html('Generating results');
					$preload.css('top',$header.outerHeight()).fadeIn(300,function(){
						self.quiz.getCurrent().obj.slideOut(1);
						self.nav.setState(2)
						self.results.populate();
						self.results.slideIn(1);
						self.resizeLayout()
						$preload.delay(1000).fadeOut(300)
					});
				break;
				case 'links':
					self.nav.setState(3)
					self.results.slideOut(1);
					$links.show().css('left',$container.outerWidth()).animate({'left':0},300)
					self.resizeLayout();
				break;
			}
			self.nav.checkState();
			self.stateObj.storeState();
			setTimeout(function(){locked = false},300)
		}
	}
	this.slideBack = function(){
		if(!locked){
			locked = true
			if(self.quiz.getCurrent().id == 0){
				self.area = 'splash'
			}
			switch(self.area){
				case 'splash':
					if(self.display == 'phone'){
						window.history.back();
					}else{
						self.quiz.getCurrent().obj.slideOut(-1);
						$splash.stop().show().css('left',(0-$container.outerWidth())).animate({'left':0},300,function(){
							self.resizeLayout()
						})
					}
					
				break;
				case 'questions':
					self.quiz.getCurrent().obj.slideOut(-1);
					self.quiz.getPrevious().obj.slideIn(-1);
					self.quiz.current_index--
					self.nav.updateProgress(self.quiz);
					if(self.keynav){
						self.focusActiveQ()
					}
				break;
				case 'results':
					self.area = 'questions'
					self.nav.setState(1)
					self.quiz.getCurrent().obj.slideIn(-1);
					self.results.slideOut(-1);
					self.nav.updateProgress(self.quiz);
					if(self.keynav){
						self.focusActiveQ()
					}
					self.resizeLayout();
				break;
				case 'links':
					self.area = 'results'
					self.nav.setState(2)
					self.results.slideIn(-1);
					$links.animate({'left':$container.outerWidth()},300,function(){
						$links.hide();
					})
					self.resizeLayout();
				break;
			}
			self.nav.checkState();
			self.stateObj.storeState();
			setTimeout(function(){locked = false},300)
		}
	}
	this.initQuestions = function(){
		for(var i =0;i<self.data.questions.length;i++){
			self.data.questions[i].id = i;
			self.questions.push(new questionObj(self,self.data.questions[i],$container,$results,i))
		}
	}
	this.setPreview = function(){
		switch(self.qstr.pg){
			case '3':
				self.nav.preview = true;
				$nav.show();
				var q = parseInt(self.qstr.q)+1;
				self.quiz.current_index = q-1;
				self.quiz.current_question = q-1;
				self.area = 'questions';
				self.nav.setState(1);
				$(self.pages[0]).hide();
				$(self.pages[q]).show();
				self.questions[q-1].updateHeader(q,self.questions.length);
			break;
			case '4':
				self.nav.preview = true;
				self.area = 'results';
				$nav.show();
				self.nav.setState(2);
				$(self.pages[0]).hide();
				$results.show();
				self.quiz.setPreview();
				self.results.populate();
				//self.resizeLayout();
			break;
			case '5':
				self.nav.preview = true;
				self.area = 'results';
				$nav.show();
				self.nav.setState(2);
				$(self.pages[0]).hide();
				$links.show();
				self.quiz.setPreview();
				self.results.populate();
				//self.resizeLayout();
			break;
		}
	}
	this.focusActiveQ = function(){
		self.questions[Math.max(0,self.quiz.current_index-1)].focusFirst();
	}
	this.getInfoBox = function(id){
		var output = null
		for(var i =0;i<self.data.info_boxes.length;i++){
			if(self.data.info_boxes[i].id == id){
				output = self.data.info_boxes[i];
				break;
			}
		}
		return output;
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
	this.init = function(){	
		// cache elements
		self.nav = new navObj(this);
		self.quiz = new quizObj(this);
		
		$wrap = $('#antbits-SA_'+self.id)
		$header = $('#antbits-SA_'+self.id+' #antbits-SA-header')
		$nav = $('#antbits-SA_'+self.id+' #antbits-SA-nav')
		$bg_fill = $('#antbits-SA_'+self.id+' #antbits-SA-bg_fill')
		$splash = $('#antbits-SA_'+self.id+' #antbits-SA-splash')
		$results = $('#antbits-SA_'+self.id+' #antbits-SA-results').hide()
		$links = $('#antbits-SA_'+self.id+' #antbits-SA-links').hide()
		$results_inner = $('#antbits-SA_'+self.id+' #antbits-SA-results>div')
		$links_inner = $('#antbits-SA_'+self.id+' #antbits-SA-links>div')
		$preload = $('#antbits-SA_'+self.id+' .antbits-SA-preloader')
		$preload_message = $('#antbits-SA_'+self.id+' .antbits-SA-preloader>div')
		$container = $('#antbits-SA_'+self.id+' #antbits-SA-container')
		$start_btn = $('#antbits-SA_'+self.id+' #antbits-SA-start_btn')
		$links_btn = $('#antbits-SA_'+self.id+' #antbits-SA-nav_links')
		$finish_btn = $('#antbits-SA_'+self.id+' #antbits-SA-nav_finish')
		$header.css('background-color','#'+self.data.config.colour_1[0]).html(self.data.config.title)
		$bg_fill.css('background-color','#'+self.data.config.colour_1[0])
		// populate splash
		$splash.append('<h2>'+self.data.config.intro_title+'</h2>');
		$splash.append('<div>'+self.data.config.intro_copy+'</div>');
		// prep result area
		self.results = new resultsObj($results,$links,this.quiz,this)
		//
		if(self.data.config.intro_graphic != ''){
			$splash.css('background-image','url('+self.asset_path+'/'+self.data.config.intro_graphic+')')
		}
		if(self.data.config.intro_foot != ''){
			var $info_btn = $('<a href = "javascript:;" class = "antbits-SA-info_btn"></a>').appendTo($splash);
			$info_btn.on('click',function(){
				self.dialog.launch({'body':self.data.config.intro_foot,'title':''})
			})
		}
		$start_btn.css('background-color','#'+self.data.config.colour_2[0])
		$start_btn.bind("mouseenter focus focusout mouseleave", 
			function(event) {
				if(event.type == 'mouseenter' || event.type == 'focus'){
					$(this).css('background-color','#'+self.data.config.colour_2[1])
				}else{
					$(this).css('background-color','#'+self.data.config.colour_2[0])
				}
		}); 
		$start_btn.on('click',function(){
			if(self.display == 'phone'){
				window.location = self.path+'index.mob.html?asid='+self.id
			}else{
				self.slideNext()
			}
		})
		$links_btn.css('background-color','#'+self.data.config.colour_3[0])
		$links_btn.bind("mouseenter focus focusout mouseleave", 
			function(event) {
				if(event.type == 'mouseenter' || event.type == 'focus'){
					$(this).css('background-color','#'+self.data.config.colour_3[1])
				}else{
					$(this).css('background-color','#'+self.data.config.colour_3[0])
				}
		}); 
		$links_btn.on('click',function(){
			if(!self.nav.preview){
				self.slideNext()
			}
		})
		$finish_btn.css('background-color','#'+self.data.config.colour_2[0])
		$finish_btn.bind("mouseenter focus focusout mouseleave", 
			function(event) {
				if(event.type == 'mouseenter' || event.type == 'focus'){
					$(this).css('background-color','#'+self.data.config.colour_2[1])
				}else{
					$(this).css('background-color','#'+self.data.config.colour_2[0])
				}
		}); 
		$finish_btn.on('click',function(){
			self.restart();
		})
		self.dialog = new dialogObj(this,$wrap)
		self.initQuestions();
		$qpanes = $('#antbits-SA_'+self.id+' .antbits-SA-qpane')
		$answers = $('#antbits-SA_'+self.id+' .antbits-SA-answer')
		// handle preload
		$preload_message.html('');
		$preload.delay(800).fadeOut(500);
		// cache pages for resizing
		self.pages = $('#antbits-SA_'+self.id+' #antbits-SA-container>.antbits-SA-page')
		switch(self.display){
			case 'phone':
				if(self.layout == 'phone'){
					$splash.hide();
					self.slideNext();
					self.stateObj.restoreState();
				}
			break;
			default:
				if(self.qstr.pg != undefined){
					self.setPreview();
				}else{
					self.stateObj.restoreState();
				}
			break;
		}
		$wrap.on('keydown',function(evt){
			if(evt.keyCode == 9 ||(evt.keyCode == 13 && $(':focus').length >0)){
				self.keynav = true
			}else if(self.keynav == true && (evt.keyCode == 13 || evt.keyCode == 16)){
				self.keynav = true
			}else{
				self.keynav = false
			}
		})
		$wrap.on('click',function(evt){
			self.keynav = false
		})
		$(window).on('resize', function(e) {
			self.resizeLayout()
		})	
		self.resizeLayout();	
	}
}