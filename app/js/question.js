function questionObj(root,qdata,$c,$r,index){
	var self = this;
	self.$container = $c
	var $results = $r
	var padding = {top:0,bottom:0}
	var $answer_pane,$answer_pane_correct,$answer_pane_incorrect;
	self.root = root
	self.data = qdata;
	self.input_obj = null;
	self.answer_obj = null;
	self.active = true;
	self.h = 0;
	
	var output = '<div class = "antbits-SA-page" id="antbits-SA-Q'+index+'">'
	output += '<div class = "antbits-SA-q_header"><h2>Q 1 of 1</h2><div class = "antbits-SA-qhead">'+self.data.body+'</div><hr></div>'
	output += '<div class = "antbits-SA-qpane">'
	if(self.data.quiz_active){
		output += '<div class = "antbits-SA-quiz_answer">'
		output += '<div class = "antbits-SA-quiz_correct"><h3>Correct</h3><strong>Answer : '+self.data.quiz_answer+'</strong><p>'+self.data.quiz_check+'</p></div>'
		output += '<div class = "antbits-SA-quiz_incorrect"><h3>Incorrect</h3><strong>Answer : '+self.data.quiz_answer+'</strong><p>'+self.data.quiz_check+'</p></div>'
		output += '</div>';
	}
	output += '</div></div>'
	self.$node = $(output).insertBefore($results)
	self.$node.hide();
	self.$pane = self.$node.find('.antbits-SA-qpane');
	if(self.data.quiz_active){
		$answer_pane = self.$node.find('.antbits-SA-quiz_answer');
		$answer_pane_correct = self.$node.find('.antbits-SA-quiz_answer .antbits-SA-quiz_correct');
		$answer_pane_incorrect = self.$node.find('.antbits-SA-quiz_answer .antbits-SA-quiz_incorrect');
		$answer_pane.fadeOut(0)
	}
	self.$q_header = self.$node.find('.antbits-SA-q_header');
	var q_header_h = 0;
		if(self.data.info_box>0){
		self.infoBoxObj = self.root.getInfoBox(self.data.info_box)
		if(self.infoBoxObj != null){
			self.$pane.before('<a href="javascript:;" class = "antbits-SA-info_box" style = "color:#'+self.root.data.config.colour_1[0]+' !important;">'+self.infoBoxObj.title+'</a>');
			var $info_link = self.$node.find('.antbits-SA-info_box');
			if(self.data.info_box_position == 0){
				padding.top = 20;
				self.$pane.css('margin-top',padding.top+'px')
			}else{
				$info_link.css('bottom',0);
				padding.bottom = 12;
			}
			$info_link.on('click',function(){
				self.root.dialog.launch(self.infoBoxObj);
			})
		}
	}
	switch(self.data.type){
		case "single select":
			self.input_obj = new qSelectObj(this,padding);
		break;
		case "multiple select":
			self.input_obj = new qSelectObj(this,padding);
		break;
		case "gender":
			self.input_obj = new genderSelectObj(this,padding);
		break;
		case "yes/no":
			self.input_obj = new boolSelectObj(this,padding);
		break;
		case "true/false":
			this.input_obj = new tfSelectObj(this,padding);
		break;
	}
	self.data.obj = this
	this.updateHeader = function(a,b){
		$(self.$node.find('h2')).html('Q '+a+' of '+b)
	}
	this.focusFirst = function(){
		setTimeout(function(){
			self.$pane.find('a')[0].focus();
			self.input_obj.focusFirst()
		},301)
	}
	
	this.restore = function(){
		if(self.input_obj != null){
			self.input_obj.restore();
		}
	}
	this.resetObj = function(){
		self.active = false;
		self.data.selected = [];
		if(self.input_obj != null){
			self.input_obj.resetState();
		}
	}
	this.slideIn = function(d){
		if(d == 1){
			if(self.data.id == 0){
				self.$pane.stop().fadeOut(0)
				setTimeout(function(){self.root.quiz.build()},300)
			}
			self.$node.css('left',self.$container.outerWidth()).show().animate({'left':0},300,function(){
				self.$pane.stop().fadeIn(300)
			});
		}else{
			self.$node.css('left',0-self.$container.outerWidth()).show().animate({'left':0},300,function(){
				self.$pane.stop().fadeIn(300)
			});
		}
		if(self.data.selected.length==0){
			self.root.nav.setState(0)
		}else{
			self.root.nav.setState(1)
		}
		self.input_obj.resizeLayout(self.h);
	}
	this.slideOut = function(d){
		if(d == 1){
			self.$node.animate({'left':(0-self.$container.outerWidth())},300,function(){
				$(this).hide()
			});
		}else{
			self.$node.animate({'left':(self.$container.outerWidth())},300,function(){
				$(this).hide()
			});
		}
		
	}
	this.showAnswer = function(){
		$answer_pane.stop().fadeIn(300,function(){
			self.$pane.find('a').hide();
		});
		if(self.root.quiz.checkCorrect(self.data.id) == 1){
			$answer_pane_correct.show();
			$answer_pane_incorrect.hide();
		}else{
			$answer_pane_correct.hide();
			$answer_pane_incorrect.show();
		}
	}
	this.resizeLayout = function(w,h){
		self.h = h
		self.$node.width(w).height(h);
		
		if(self.input_obj != null){
			self.input_obj.resizeLayout(self.h);
		}		
		if(!self.$node.is(':visible')){
			self.$node.show();
			q_header_h = self.$q_header.height()
			self.$node.hide();
		}else{
			q_header_h = self.$q_header.height()
		}
		self.$pane.height((h+16)-(q_header_h+padding.top+padding.bottom));
	}
	
}