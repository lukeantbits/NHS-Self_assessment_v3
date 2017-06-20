
function saIndex(path,id) {
	var mode = 'cms'
	var self = this
	self.area = 'splash'
	self.asset_path = '';
	self.postmessage = null
	self.syn_id = 'nhs'
	self.id = id
	self.dialogObj = null;
	self.qstr = getUrlVars();
	self.keynav = false;
	self.stateObj = new maintain_state(this,id);
	self.questions = [];
	var locked = false;
	this.path = path
	this.pages = null;
	this.redirect_path = ''
	this.url_vars = getUrlVars();
	var $answers,$qpanes,$header,$splash,$results,$links,$bg_fill,$wrap,$preload,$preload_message,$container,$questions,$results,$links,outer_h,inner_h,$start_btn;
	switch(mode){
		case 'cms':
		self.asset_path = path+'../cms/archive/as_'+id
		$.getJSON(path+'../cms/json_output.php?as_id='+id,function(data){
			self.data = data
			//console.log(self.data)
			$('#antbits-SA_'+id).load(path+'templates/sa.html',function(){
				self.init();
			})
		})
		break;
	}
	
	this.linkOut = function(url){
		if(self.postmessage){
			window.parent.postMessage('{"antbits_redirect": {"url":"'+url+'"}}', '*');
		}else{
			window.top.location.href = url; 
		}
	}
	this.restoreState = function (rdata){
		//console.log('restoring data')
		//console.log(rdata)
		if(rdata.area != 'splash'){
			self.area = rdata.area
			
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
			self.resizeLayout()
			
			self.quiz.getCurrent().obj.slideIn(1);
			self.nav.checkState()
			self.nav.updateProgress(self.quiz)
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
		for(var i =0;i<self.pages.length;i++){
			$(self.pages[i]).width($container.outerWidth()-32).css('height',null);
			var tmp_h = $(self.pages[i]).outerHeight();
			
			switch($(self.pages[i]).attr('id')){
				case 'antbits-SA-splash':
					$(self.pages[i]).outerHeight(Math.max(tmp_h,(self.data.config.h_min-56)))
				break;
				case 'antbits-SA-results':
					
				break;
				case 'antbits-SA-links':
					
				break;
				default:
					tmp_h-=32;
					if(self.questions[i-1].data.type == 'single select' || self.questions[i-1].data.type == 'multiple select'){
						p_max = Math.max(p_max,tmp_h);
					}
				break;
			}
		}
		switch(self.area){
			case 'splash':
				outer_h = Math.max(outer_h,$splash.outerHeight())+56
				inner_h = Math.max(inner_h,$splash.outerHeight())
				
			break;
			case 'questions':
				//p_max+=92
				outer_h = Math.min(self.data.config.h_max,Math.max(self.data.config.h_min,p_max+149))
				inner_h =  Math.min((self.data.config.h_max-118),Math.max(self.data.config.h_min-118,p_max+32))
				//console.log('p max '+p_max)
				for(var q in self.questions){
					self.questions[q].resizeLayout($container.outerWidth()-32,inner_h-32)
				}
			break;		
		}
		$wrap.stop().animate({height:outer_h},500);
		$container.stop().animate({height:inner_h},500);
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
	this.slideNext = function(){
		if(!locked){
			locked = true
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
					self.nav.updateProgress(self.quiz)
					if(self.keynav){
						self.focusActiveQ()
					}
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
					self.quiz.getCurrent().obj.slideOut(-1);
					$splash.stop().show().css('left',(0-$container.outerWidth())).animate({'left':0},300,function(){
						self.resizeLayout()
					})
					
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
		$bg_fill = $('#antbits-SA_'+self.id+' #antbits-SA-bg_fill')
		$splash = $('#antbits-SA_'+self.id+' #antbits-SA-splash')
		$results = $('#antbits-SA_'+self.id+' #antbits-SA-results').hide()
		$links = $('#antbits-SA_'+self.id+' #antbits-SA-links').hide()
		$preload = $('#antbits-SA_'+self.id+' .antbits-SA-preloader')
		$preload_message = $('#antbits-SA_'+self.id+' .antbits-SA-preloader>div')
		$container = $('#antbits-SA_'+self.id+' #antbits-SA-container')
		$start_btn = $('#antbits-SA_'+self.id+' #antbits-SA-start_btn')
		$header.css('background-color','#'+self.data.config.colour_1[0]).html(self.data.config.title)
		$bg_fill.css('background-color','#'+self.data.config.colour_1[0])
		// populate splash
		$splash.append('<h2>'+self.data.config.intro_title+'</h2>');
		$splash.append('<div>'+self.data.config.intro_copy+'</div>');
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
			self.slideNext()
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
		self.stateObj.restoreState();
		//self.wtObj = new wt(self,{'title':'NHS Exercises for older people guide','si_n':'Tool_Older people guide','ti':'NHS Exercises for older people guide','DCSext.tool_name':'Exercises for older people guide','category':'Health and safety','vtvs':self.stateObj.vtvs,'co_f':self.stateObj.co_f,'dcsuri':'/tools/documents/olderpeople_v2/index.html'});
		//self.wtObj.evt({'WT.dl':0,'WT.si_p':'Start'})
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
		if(isMobile.any() && !isMobile.Tablet()){
			window.location = 'index.mob.html'
		}else{
			$(window).on('resize', function(e) {
				self.resizeLayout()
			})	
			self.resizeLayout();	
		}
	}
}