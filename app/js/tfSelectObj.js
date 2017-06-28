function tfSelectObj(qobj,padding){
	var self = this;
	var parent_obj = qobj;
	var $btns_bg,$btns_fg,$btns;
	parent_obj.data.selected = [];
	//console.log(parent_obj)
	
	parent_obj.$pane.append('<div class = "antbits-SA-answer_tf"><div>'+initCaps(parent_obj.data.answers[0]['body'])+'</div><a href = "#0">'+initCaps(parent_obj.data.answers[0]['body'])+'</a></div>')
	parent_obj.$pane.append('<div class = "antbits-SA-answer_tf"><div>'+initCaps(parent_obj.data.answers[1]['body'])+'</div><a href = "#1">'+initCaps(parent_obj.data.answers[1]['body'])+'</a></div>')
	$btns = parent_obj.$pane.find('.antbits-SA-answer_tf')
	$btns_bg = parent_obj.$pane.find('.antbits-SA-answer_tf>div')
	$btns_fg = parent_obj.$pane.find('.antbits-SA-answer_tf>a')
	$btns_fg.css('border','2px solid #'+parent_obj.root.data.config.colour_1[0]).css('color','#'+parent_obj.root.data.config.colour_1[0])
	$btns_bg.css('border','2px solid #'+parent_obj.root.data.config.colour_1[0]).css('background-color','#'+parent_obj.root.data.config.colour_1[0])
	parent_obj.$pane.css('text-align','center')
	$btns_fg.on('click',function(e){
		//console.log(e.target.href)
		self.toggle(parseInt(e.target.href.split('#').pop()))
		parent_obj.root.nav.unlock();
		parent_obj.root.quiz.build();
		parent_obj.root.stateObj.storeState();
		e.preventDefault();
	}).on('mouseout',function(e){
		$(e.target).blur();
	});
	$btns_fg.bind("mouseenter focus focusout mouseleave", 
		function(event) {
			var index = parseInt(event.target.href.split('#').pop())
			if(event.type == 'mouseenter' || event.type == 'focus'){
				if(index == parent_obj.data.selected[0]){
					$($btns_bg[index]).css('background-color','#'+parent_obj.root.data.config.colour_1[1]);
				}else{
					$(this).css('background-color','#e4e4e4');
				}
				
			}else{
				if(index == parent_obj.data.selected[0]){
					$($btns_bg[index]).css('background-color','#'+parent_obj.root.data.config.colour_1[0]);
				}else{
					$(this).css('background-color','#FFF');
				}
			}
	}); 
	this.toggle = function(id){
		$btns_fg.each(function(index, element) {
			parent_obj.data.selected = [id];
            if(index == id){
				$(element).animate({'opacity':0.01},300);
				$($btns_fg[index]).css('background-color','#FFF');
			}else{
				$(element).animate({'opacity':1},300);
			}
		});
	}
	this.resetState = function(){
		self.toggle(null);
		parent_obj.data.selected = [];
	}
	this.focusFirst = function(){
		
	}
	this.resizeLayout = function(d_h){
		if(parent_obj.$pane.height()>0){
			d_h-=(padding.top+padding.bottom)
			var h = d_h-(parent_obj.$q_header.height()-16)
			var btn_size = Math.min(d_h*0.42,parent_obj.$pane.innerWidth()*0.4);
			$btns.width(btn_size)
			var pad = (h-$($btns[0]).height())*0.5;
			$btns.css('margin-top',pad)
		}
	
		
	}
	this.restore = function(){
		if(parent_obj.data.selected.length>0){
			self.toggle(parent_obj.data.selected[0])
		}
	}
	this.setState = function(){
	}
	this.getState = function(){
	}
}