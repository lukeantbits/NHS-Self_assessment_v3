function genderSelectObj(qobj,padding){
	var self = this;
	var parent_obj = qobj;
	var $btns,$masks,$bg_tints;
	parent_obj.data.selected = [];
	//console.log(parent_obj)
	parent_obj.$pane.append('<a href = "#0" class = "antbits-SA-answer_gender"><div style="background-color:#'+parent_obj.root.data.config.colour_1[0]+'"></div><image src="'+parent_obj.root.path+'images/male_mask.png"></a>')
	parent_obj.$pane.append('<a href = "#1" class = "antbits-SA-answer_gender"><div style="background-color:#'+parent_obj.root.data.config.colour_1[0]+'"></div><image src="'+parent_obj.root.path+'images/female_mask.png"></a>')
	$btns = parent_obj.$pane.find('.antbits-SA-answer_gender')
	$masks = parent_obj.$pane.find('.antbits-SA-answer_gender>img')
	$bg_tints = parent_obj.$pane.find('.antbits-SA-answer_gender>div')
	$bg_tints.fadeOut(0);
	parent_obj.$pane.css('text-align','center')
	$btns.on('click',function(e){
		self.toggle(parseInt(this.href.split('#').pop()))
		parent_obj.root.nav.unlock();
		parent_obj.root.quiz.build();
		parent_obj.root.stateObj.storeState();
		e.preventDefault();
	}).on('mouseout',function(e){
		$(e.target).blur();
	})
	this.toggle = function(id){
		parent_obj.data.selected = [id];
		$bg_tints.each(function(index, element) {
			if(index == id){
				$(element).fadeIn(300);
			}else{
				$(element).fadeOut(300);
			}
		})
	}
	this.focusFirst = function(){
		
	}
	this.resetState = function(){
		self.toggle(null);
		parent_obj.data.selected = [];
	}
	this.resizeLayout = function(d_h){
		d_h-=(padding.top+padding.bottom)
		var h = d_h-(parent_obj.$q_header.height()-16)
		var btn_size = Math.min(h*0.9,parent_obj.$pane.width());
		$btns.width(btn_size*0.5).height(btn_size);
		$masks.width(btn_size*0.5).height(btn_size);
		$bg_tints.width(btn_size*0.5).height(btn_size);
		var pad = h*0.05
		$btns.css('margin-top',pad)
		
	}
	this.restore = function(){
		//console.log('restoring gender '+parent_obj.data.selected.length)
		if(parent_obj.data.selected.length>0){
			
			self.toggle(parent_obj.data.selected[0])
		}
	}
	this.setState = function(){
	}
	this.getState = function(){
	}
}