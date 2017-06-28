function qSelectObj(qobj,padding){
	var self = this;
	var parent_obj = qobj;
	self.padding = padding
	var $fade_top,$fade_bottom;
	parent_obj.data.selected = [];
	//console.log(parent_obj)
	for(var a in parent_obj.data.answers){
		parent_obj.$pane.append('<a href = "#'+a+'" class = "antbits-SA-answer"><div class = "antbits-SA-bullet"></div><div class = "antbits-SA-bullet_inner"></div><div class = "antbits-SA-bullet_selected" style = "background-color:#'+parent_obj.root.data.config.colour_1[0]+'"></div><div>'+parent_obj.data.answers[a]['body']+'</div></a><br>')
	}
	$(parent_obj.$pane.find('.antbits-SA-bullet_selected')).hide();
	parent_obj.$pane.find('a').on('click',function(e){
		self.toggle(parseInt(this.href.split('#').pop()))
		parent_obj.root.nav.unlock();
		parent_obj.root.quiz.build();
		parent_obj.root.stateObj.storeState();
		e.preventDefault();
	}).on('mouseout',function(e){
		$(e.target).blur();
	});
	$fade_top = $('<div class ="antbits-SA-fade antbits-SA-fade_top" ></div>').appendTo(parent_obj.$node)
	$fade_bottom = $('<div class ="antbits-SA-fade antbits-SA-fade_bottom" ></div>').appendTo(parent_obj.$node)
	this.toggle = function(id){
		$(parent_obj.$pane.find('.antbits-SA-bullet_selected')).each(function(index, element) {
			if(parent_obj.data.type == 'single select'){
				parent_obj.data.selected = [id];
                if(index == id){
					$(element).show();
				}else{
					$(element).hide();
				}
			}else{
				if(id == index){
					if(parent_obj.data.selected.indexOf(id)==-1){
						$(element).show();
						parent_obj.data.selected.push(id)
					}else if(parent_obj.data.selected.length>1){
						$(element).hide();
						parent_obj.data.selected.splice(parent_obj.data.selected.indexOf(id), 1);
					}else{
						$(element).hide();
					}
				}
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
		
		var pad = 0;
		d_h-=(padding.top+padding.bottom)
		var h = d_h-(parent_obj.$q_header.height()-16)
		var a = parent_obj.data.answers.length
		var a_h = 0;
		$(parent_obj.$pane.find('.antbits-SA-answer')).each(function(index, element) {
			a_h+=$(element).outerHeight();
        });
		if(a_h+((a+1)*10)>h){
			pad = 10;
			parent_obj.$pane.css('overflow-y','auto');
			var pos =  parent_obj.$pane.position();
			$fade_top.show().css('top',pos.top+parseInt(parent_obj.$pane.css('margin-top')));
			$fade_bottom.show().css('bottom',pos.bottom);
		}else{
			pad = (h - a_h)/(a+1);
			$fade_top.hide();
			$fade_bottom.hide();
		}	
		$(parent_obj.$pane.find('.antbits-SA-answer')).css('margin',pad+'px 0px 0px 0px');	
	}
	this.restore = function(){
		$(parent_obj.$pane.find('.antbits-SA-bullet_selected')).each(function(index, element) {
            if(parent_obj.data.selected.indexOf(index)>-1){
				$(element).show()
			}else{
				$(element).hide()
			}
        });
	}
	this.setState = function(){
	}
	this.getState = function(){
	}
}