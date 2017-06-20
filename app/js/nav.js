function navObj(root){
	var self = this;
	self.root = root
	self.qObj = null;
	var $header = $('#antbits-SA_'+root.id+' #antbits-SA-header')
	var $nav = $('#antbits-SA_'+root.id+' #antbits-SA-nav')
	var $nav_q = $('#antbits-SA_'+root.id+' #antbits-SA-nav_q')
	var $nav_r = $('#antbits-SA_'+root.id+' #antbits-SA-nav_r')
	var $nav_l = $('#antbits-SA_'+root.id+' #antbits-SA-nav_l')
	var $progress = $('#antbits-SA_'+root.id+' #antbits-SA-progress')
	var $progress_bar = $('#antbits-SA_'+root.id+' #antbits-SA-progress>div')
	var $check = $('#antbits-SA_'+root.id+' #antbits-SA-nav_check')
	var $next = $('#antbits-SA_'+root.id+' #antbits-SA-nav_next')
	var $back = $('#antbits-SA_'+root.id+' #antbits-SA-nav_back')
	//
	$progress_bar.css('background-color','#'+self.root.data.config.colour_1[0])
	$next.css('background-color','#'+self.root.data.config.colour_1[0]).on('click',function(){
		if(!$next.hasClass('antbits-SA_inactive')){
			self.root.slideNext()
		}
	})
	$back.css('background-color','#'+self.root.data.config.colour_1[0]).on('click',function(){
		self.root.slideBack()
	})
	$check.css('background-color','#'+self.root.data.config.colour_1[0]).on('click',function(){
		if(!$check.hasClass('antbits-SA_inactive')){
			$next.removeClass('antbits-SA_inactive')
			$check.addClass('antbits-SA_inactive')
			self.qObj.obj.showAnswer();
		}
	})
	
	$nav.find('.antbits-SA-nav_button').bind("mouseenter focus focusout mouseleave", 
        function(event) {
			if(event.type == 'mouseenter' || event.type == 'focus'){
				$(this).css('background-color','#'+self.root.data.config.colour_1[1])
			}else{
				$(this).css('background-color','#'+self.root.data.config.colour_1[0])
			}
	}); 
	
	
	self.checkState = function(){
		switch(root.area){
			case 'splash':
				$nav.stop().fadeOut(500)
			break;
			case 'questions':
				$nav.stop().fadeIn(500)
			break;
		}
		console.log(self.qObj)
		if(self.qObj.quiz_active && self.qObj.selected.length>0){
			$check.removeClass('antbits-SA_inactive')
		}
	}
	self.unlock = function(){
		if(self.qObj.quiz_active){
			self.showQuizAnswer()
		}else{
			$next.removeClass('antbits-SA_inactive')
		}
	}
	self.showQuizAnswer = function(){
		$check.removeClass('antbits-SA_inactive')
	}
	self.updateProgress = function(quiz){
		self.qObj = root.getCurrentQ();
		$progress_bar.stop().animate({width:(Math.min(1,quiz.getIndex() / quiz.getTotal())*100)+'%'},300)
	}
	self.setState = function(val){
		self.qObj = root.getCurrentQ();
		switch(val){
			case 0:
				$nav_q.show()
				$nav_r.hide()
				$nav_l.hide()
				$progress.show()
				$next.addClass('antbits-SA_inactive')
				$back.removeClass('antbits-SA_inactive')
				$check.hide()
				
			break;
			case 1:
				$nav_q.show()
				$nav_r.hide()
				$nav_l.hide()
				$progress.show()
				$next.removeClass('antbits-SA_inactive')
				$back.removeClass('antbits-SA_inactive')
				$check.hide()
			break;
		}
		if(self.qObj.quiz_active){
			$back.hide();
			$progress.hide();
			$check.show();
			$check.addClass('antbits-SA_inactive')
		}
	}
}