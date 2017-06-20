function bool_select_obj(vc,qdata,index,parent){
	this.__vc = vc;
	this.__parent = parent;
	this.__qdata = qdata;
	this.__id = parent.__id
	this.__index = index
	this.__selected = Array();
	this.__answers = Array();
	var self = this
	var $tick_shadow,$cross_shadow,$tick,$cross
	this.init = function(){
		var output ='<div id="q_answers_'+self.__id+'">';
		output+= '<div class = "bool_outer">';
		output+= '<div class="bool_shadow" id="q_bool_cross_'+self.__id+'_shadow"></div>';
		output+= '<div class="bool_shadow" id="q_bool_tick_'+self.__id+'_shadow"></div>';
		output+= '<div class = "bool_layer" id="q_answers_bool_layer'+self.__id+'">';
		output+= '<div class="bool_wrap"><a href = "javascript:;" id="q_bool_tick_'+self.__id+'_anchor"><div id="q_bool_tick_'+self.__id+'_inner" class = "bool_inner"><img id="q_'+self.__id+'_tick" src = "images/tick.png"></div></a>';
		output +='</div>';
		output+= '<div class="bool_wrap"><a href = "javascript:;" id="q_bool_cross_'+self.__id+'_anchor"><div id="q_bool_cross_'+self.__id+'_inner" class = "bool_inner"><img id="q_'+self.__id+'_cross" src = "images/cross.png"></div></a>';
		
		
		/*output+= '<div class="bool_wrap"><a href = "javascript:;" id="q_bool_tick_'+self.__id+'_anchor"><div class="shadow_wrap"><div id="q_bool_tick_'+self.__id+'_inner" class = "bool_inner"><img id="q_'+self.__id+'_tick" src = "images/tick.png"></div></div></a>'
		output +='</div>'
		output+= '<div class="bool_wrap"><a href = "javascript:;" id="q_bool_cross_'+self.__id+'_anchor"><div class="shadow_wrap"><div id="q_bool_cross_'+self.__id+'_inner" class = "bool_inner"><img id="q_'+self.__id+'_cross" src = "images/cross.png"></div></div></a>'*/
		
		output +='</div>';
		output +='</div>';
		
		output+= '<br><div class="bool_caption" ><div style="height:1em;"><b>'+initCap(this.__qdata.answers.a[0].body)+'</b></div>';
		output +='</div>';
		output+= '<div class="bool_caption" ><div style="height:1em;"><b>'+initCap(this.__qdata.answers.a[1].body)+'</b></div></a>';
		output +='</div>';
		output +='</div>';
		output +='</div>';
		return output;
	}
	this.lockAnswers = function(){
		$('#q_bool_tick_'+self.__id+'_anchor').attr('tabindex',-1)
		$('#q_bool_cross_'+self.__id+'_anchor').attr('tabindex',-1)
	}
	this.initAnswers = function(){
		$("#q_bool_yes_"+self.__id).css("padding-left",0)
		$("#q_bool_yes_"+self.__id).css("margin-left",0)
		$("#q_bool_no_"+self.__id).css("padding-right",0)
		$("#q_bool_no_"+self.__id).css("margin-right",0)
		$tick_shadow = $('#q_bool_tick_'+self.__id+'_shadow')
		$cross_shadow = $('#q_bool_cross_'+self.__id+'_shadow')
		$tick = $('#q_bool_tick_'+self.__id+'_inner img')
		$cross = $('#q_bool_cross_'+self.__id+'_inner img')
		$("#q_"+self.__id+"_tick").fadeTo(0,0.3)
		$("#q_"+self.__id+"_cross").fadeTo(0,0.3)
		self.__answers.push($('#q_'+self.__id+'_tick'))
		self.__answers.push($('#q_'+self.__id+'_cross'))
		
		
		$('#q_'+self.__id+'_tick').click(function(e){
			self.toggle(0)
		})
		$('#q_bool_tick_'+self.__id+'_anchor').keydown(function(e){
			code= (e.keyCode ? e.keyCode : e.which);
            if (code == 13){
				self.toggle(0)
			}
		})
		$('#q_'+self.__id+'_cross').click(function(e){
			self.toggle(1)
		})
		$('#q_bool_cross_'+self.__id+'_anchor').keydown(function(e){
			code= (e.keyCode ? e.keyCode : e.which);
            if (code == 13){
				self.toggle(1)
			}
		})
		self.resizeLayout()
		
	}
	this.toggle = function(id){
		var shadows = Array($tick_shadow,$cross_shadow)
		if(self.__selected[0] == id){
			self.__selected[0] = (id+1)%2
		}else{
			self.__selected[0] = id
		}
		for(var a = 0;a<self.__answers.length;a++){
			if(a == self.__selected[0]){
				self.__answers[a].fadeTo(200,1)
				shadows[a].animate({
					'opacity':0,
					'height':($tick.width()-4)
				},200);
			}else{
				self.__answers[a].fadeTo(200,0.3)
				shadows[a].animate({
					'opacity':1,
					'height':($tick.width()+4)
				},200);
			}
		}
		self.__vc.__quiz_obj.answer(self.__id,self.__selected)
		self.resizeLayout()
	}
	this.resizeLayout = function(){
		//$("#q_answers_"+self.__id).css("width",Math.min(this.__vc.__height*0.5,this.__vc.__width*0.8)*1.1)
		var h = Math.min(this.__vc.__height*0.5,this.__vc.__width*0.6);
		var $icons = $("#q_answers_"+self.__id+" .bool_wrap")
		var $captions = $("#q_answers_"+self.__id+" .bool_caption")
		$icons.css("height",h*0.6)
		$icons.css("width",h*0.6)
		$captions.css("width",h*0.6).css('margin-top',$cross.width()*1.05)
		$("#q_answers_"+self.__id).css("margin-top",((this.__vc.__height*0.6)-h)/2)
		$('#q_answers_bool_layer'+self.__id).width($('#q_answers_'+self.__id).width())
		$tick_shadow.width($tick.width()+2).height($tick.width()+4).css('right','50%')
		$cross_shadow.width($cross.width()+2).height($cross.width()+4).css('left','50%')
	}
	this.focusQ1  = function(){
		$('#q_bool_tick_'+self.__id+'_anchor').focus();
	}
	this.restoreState = function(a_data){
		//console.log("restoring "+this.__id+" / "+a_data)
		self.toggle(Number(a_data))
	}
}