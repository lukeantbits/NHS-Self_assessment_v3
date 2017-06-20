function tf_select_obj(vc,qdata,index,parent){
	this.__vc = vc;
	this.__parent = parent;
	this.__qdata = qdata;
	this.__id = parent.__id
	this.__index = index
	this.__selected = Array();
	this.__answers = Array();
	var self = this
	var $tf_true,$tf_false
	this.init = function(){
		var output ='<div id="q_answers_'+self.__id+'">';
		output+= '<div class = "tf_outer">';
		output+= '<div class = "tf_layer" id="q_answers_tf_layer'+self.__id+'">';
		output+= '<div class="tf_wrap"><a href = "javascript:;" id="q_tf_true_'+self.__id+'_anchor"><div id="q_tf_true_'+self.__id+'_on" class = "tf_on">'+this.__qdata.answers.a[0].body+'</div><div id="q_tf_true_'+self.__id+'_off" class = "tf_off">'+this.__qdata.answers.a[0].body+'</div></a>';
		output +='</div>';
		output+= '<div class="tf_wrap"><a href = "javascript:;" id="q_tf_false_'+self.__id+'_anchor"><div id="q_tf_false_'+self.__id+'_on" class = "tf_on">'+this.__qdata.answers.a[1].body+'</div><div id="q_tf_false_'+self.__id+'_off" class = "tf_off">'+this.__qdata.answers.a[1].body+'</div></a>';
		
		output +='</div>';
		output +='</div>';
		output +='</div>';
		output +='</div>';
		return output;
	}
	this.initAnswers = function(){
		
		
		$tf_true = $('#q_tf_true_'+self.__id+'_off')
		$tf_false = $('#q_tf_false_'+self.__id+'_off')
		$tf_true.css('border','solid 2px #'+__data.config.colour_1[0]).css('color','#'+__data.config.colour_1[0])
		$tf_false.css('border','solid 2px #'+__data.config.colour_1[0]).css('color','#'+__data.config.colour_1[0])
		$('#q_tf_true_'+self.__id+'_on').css('background-color','#'+__data.config.colour_1[0]).css('border','solid 2px #'+__data.config.colour_1[0])
		$('#q_tf_false_'+self.__id+'_on').css('background-color','#'+__data.config.colour_1[0]).css('border','solid 2px #'+__data.config.colour_1[0])
		self.__answers.push([$('#q_tf_true_'+self.__id+'_on'),$('#q_tf_true_'+self.__id+'_off')])
		self.__answers.push([$('#q_tf_false_'+self.__id+'_on'),$('#q_tf_false_'+self.__id+'_off')])
		//__data.config.colour_2[1]
		
		$('#q_tf_true_'+self.__id+'_anchor').click(function(e){
			self.toggle(0)
		})
		/*$('#q_tf_true_'+self.__id+'_anchor').keydown(function(e){
			console.log(e)
			code= (e.keyCode ? e.keyCode : e.which);
            if (code == 13){
				self.toggle(0)
			}
		})*/
		$('#q_tf_false_'+self.__id+'_anchor').click(function(e){
			self.toggle(1)
		})
		/*$('#q_tf_false_'+self.__id+'_anchor').keydown(function(e){
			console.log(e)
			code= (e.keyCode ? e.keyCode : e.which);
            if (code == 13){
				self.toggle(1)
			}
		})*/
		self.resizeLayout()
		
	}
	this.lockAnswers = function(){
		$('#q_tf_true_'+self.__id+'_anchor').attr('tabindex',-1)
		$('#q_tf_false_'+self.__id+'_anchor').attr('tabindex',-1)
	}
	this.toggle = function(id){
		//console.log(id)
		if(self.__selected[0] == id){
			self.__selected[0] = (id+1)%2
		}else{
			self.__selected[0] = id
		}
		for(var a = 0;a<self.__answers.length;a++){
			if(a == self.__selected[0]){
				self.__answers[a][0].fadeTo(200,1)
				self.__answers[a][1].fadeTo(200,0)
			}else{
				self.__answers[a][0].fadeTo(200,0)
				self.__answers[a][1].fadeTo(200,1)
			}
		}
		self.__vc.__quiz_obj.answer(self.__id,self.__selected)
		self.resizeLayout()
		if(self.__vc.__tabbing){
			$('#nav_check>a').focus()
		}
	}
	this.resizeLayout = function(){
		//$("#q_answers_"+self.__id).css("width",Math.min(this.__vc.__height*0.5,this.__vc.__width*0.8)*1.1)
		var h = Math.min(this.__vc.__height*0.5,this.__vc.__width*0.6);
		var $icons = $("#q_answers_"+self.__id+" .tf_wrap")
		if(this.__vc.__width > this.__vc.__height){
			var hpad = '2em'
		}else{
			var hpad = '0.5em'
		}
		
		$icons.css("width",h*0.6).css('margin-left',hpad).css('margin-right',hpad)
		$("#q_answers_"+self.__id).css("margin-top",((this.__vc.__height*0.6)-h)/2)
		$('#q_answers_tf_layer'+self.__id).width($('#q_answers_'+self.__id).width())
		
		
	}
	this.focusQ1  = function(){
		$('#q_tf_true_'+self.__id+'_anchor').focus();
	}
	this.restoreState = function(a_data){
		//console.log("restoring "+this.__id+" / "+a_data)
		self.toggle(Number(a_data))
	}
}