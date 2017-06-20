function boolSelectObj(qobj,padding){
	var self = this;
	var parent_obj = qobj;
	var $btn_shadows,$btn_images,$btn_captions,$btns;
	parent_obj.data.selected = [];
	//console.log(parent_obj)
	
	parent_obj.$pane.append('<a href = "#0" class = "antbits-SA-answer_bool"><div class = "antbits-SA-answer_bool_image tick"><div></div></div><div class = "antbits-SA-answer_bool_shadow"></div><div class = "antbits-SA-answer_bool_caption">'+initCaps(parent_obj.data.answers[0]['body'])+'</div></a>')
	parent_obj.$pane.append('<a href = "#1" class = "antbits-SA-answer_bool"><div class = "antbits-SA-answer_bool_image cross"><div></div></div><div class = "antbits-SA-answer_bool_shadow"></div><div class = "antbits-SA-answer_bool_caption">'+initCaps(parent_obj.data.answers[1]['body'])+'</div></a>')
		
	$btn_shadows=$(parent_obj.$pane.find('a>.antbits-SA-answer_bool_shadow'))
	$btn_images=$(parent_obj.$pane.find('a>.antbits-SA-answer_bool_image'))
	$btn_captions=$(parent_obj.$pane.find('a>.antbits-SA-answer_bool_caption'))
	$btns = parent_obj.$pane.find('.antbits-SA-answer_bool')
	
	parent_obj.$pane.css('text-align','center')
	$btns.on('click',function(e){
		self.toggle(parseInt(this.href.split('#').pop()))
		parent_obj.root.nav.unlock();
		parent_obj.root.quiz.build();
		parent_obj.root.stateObj.storeState();
		e.preventDefault();
	}).on('mouseout',function(e){
		$(e.target).blur();
	});
	this.toggle = function(id){
		$(parent_obj.$pane.find('.antbits-SA-answer_bool_image>div')).each(function(index, element) {
			parent_obj.data.selected = [id];
            if(index == id){
				$(element).animate({'opacity':1},300);
			}else{
				$(element).animate({'opacity':0.4},300);
			}
		});
		$(parent_obj.$pane.find('.antbits-SA-answer_bool_shadow')).each(function(index, element) {
			parent_obj.data.selected = [id];
            if(index == id){
				$(element).animate({'opacity':0},300);
			}else{
				$(element).animate({'opacity':0.4},300);
			}
		});
	}
	this.resetState = function(){
		self.toggle(null);
		parent_obj.data.selected = [];
	}
	this.resizeLayout = function(d_h){
		d_h-=(padding.top+padding.bottom)
		var btn_size = d_h*0.42;
		$btn_images.width(btn_size).height(btn_size);
		$btn_shadows.width(btn_size+4).height(btn_size+4).css('margin-top',(0-(btn_size+4)));
		$btn_captions.width(btn_size);
		var h = d_h-(parent_obj.$q_header.height()-16)
		var pad = (h-$($btns[0]).height())*0.5;
		$btns.css('margin-top',pad)
		
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