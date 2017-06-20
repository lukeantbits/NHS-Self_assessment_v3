function single_select_obj(vc,qdata,index,parent,multi){
	this.__vc = vc;
	this.__parent = parent;
	this.__qdata = qdata;
	this.__id = parent.__id
	this.__index = index
	this.__selected = null
	this.__answers = Array();
	var multi = multi;
	var self = this
	var $q_answers,$radio_fills,$radio_overs,$head,$q
	this.init = function(){
		//var output ='<div id="q_wrapper_'+self.__id+'"><div class = "q_answers" id="q_answers_'+self.__id+'">';
		var output ='<div  id="q_answers_'+self.__id+'"><br>';
		for(var a = 0;a<qdata.answers.a.length;a++){
			output+='<a href="javascript:void(0)" id = "a'+self.__id+"_"+a+'" style="outline:0;"><div class="multi_answer" id="'+self.__id+"_"+a+'"><div  class = "radio_fill" id="rf'+self.__id+"_"+a+'"></div><div  class = "radio_over" id="ro'+self.__id+"_"+a+'"></div><img id="b'+self.__id+"_"+a+'" src="images/radio_bg_30.png" class = "radio_bg"><img id="f'+self.__id+"_"+a+'" src="images/radio_fg_30.png" class = "radio_fg">'+qdata.answers.a[a].body+'</div></a>';
		}
		output +='</div>';
		return output;
	}
	this.answerOver = function(e){
		var id = e.target.id.replace("f","").replace("b","").replace('a','')
		if(id != "" && self.__id == self.__vc.__active ){
			var tmp =  id.split("_")
			var ind = Number(tmp[1])
			if(jQuery.inArray(ind, self.__answers) > -1){
				$("#"+id+" div.radio_over").stop().hide()
				$("#"+id+" div.radio_fill").stop().show()
			}else{
				$("#"+id+" div.radio_over").stop().show()
				$("#"+id+" div.radio_fill").stop().hide()
			}
			$("#"+id+" img.radio_bg").hide()
		}
	}
	this.answerOut = function(e){
		var id = e.target.id.replace('a','').replace("f","").replace("b","")
		if(id != "" && self.__id == self.__vc.__active){		
			var tmp =  id.split("_")
			if(jQuery.inArray(Number(tmp[1]), self.__answers) == -1){	
				$("#"+id+" >.radio_bg").stop().show()
			}
		}
	}
	this.initAnswers = function(){
		$head = $("#q_"+self.__id+"_head")
		$radio_fills = $('#q_answers_'+self.__id+'  div.radio_fill')
		$q_answers = $('#q_answers_'+self.__id)
		new ScrollFix(document.getElementById('q_wrapper_'+self.__id));
		self.__vc.setGradient($radio_fills,__data.config.colour_1[1],__data.config.colour_1[0]);
		$('#q_answers_'+self.__id+' a').click(function(e) {
			var tmp =  e.target.id.split("_")
			self.toggle(Number(tmp[1]))
		})
		if(!vc.__device){	
			jQuery('#q_answers_'+self.__id+' a').hover(
				function(e) {
					self.answerOver(e)
					return false;
				},
				function(e) {
					self.answerOut(e)
					return false;
				}
			);
			
			$('#q_answers_'+self.__id+' a').focusin(function(e) {self.answerOver(e)}).focusout(function(e) {self.answerOut(e)})
		}
	}
	this.lockAnswers = function(){
		$('#q_answers_'+self.__id+' a').attr('tabindex',-1)
	}
	this.focusQ1  = function(){
		$('#a'+self.__id+'_0').focus()
		
	}
	this.toggle = function(id){
		if(!isNaN(id) && self.__id == self.__vc.__active){
			if(multi){
				if(jQuery.inArray(id, self.__answers) == -1){
					self.__answers.push(id)
				}else{
					var index = self.__answers.indexOf(id);
					self.__answers.splice(index, 1);
				}
				for(var a = 0;a<qdata.answers.a.length;a++){
					var c = false
					for(var b = 0;b<self.__answers.length;b++){
						if(self.__answers[b] == a){
							c = true
						}
					}
					if(!c){
						$("#"+self.__id+"_"+a+" div.radio_over").fadeOut(0)
						$("#"+self.__id+"_"+a+" div.radio_fill").fadeOut(0)
						$("#"+self.__id+"_"+a+" img.radio_bg").fadeIn(0)
					}else{
						$("#"+self.__id+"_"+a+" div.radio_over").fadeOut(0)
						$("#"+self.__id+"_"+a+" div.radio_fill").fadeIn(0)
						$("#"+self.__id+"_"+a+" img.radio_bg").fadeOut(0)
					}
				}
			}else{
				for(var a = 0;a<qdata.answers.a.length;a++){
					if(a!=id){
						$("#"+self.__id+"_"+a+" div.radio_over").fadeOut(0)
						$("#"+self.__id+"_"+a+" div.radio_fill").fadeOut(0)
						$("#"+self.__id+"_"+a+" img.radio_bg").fadeIn(0)
					}else{
						$("#"+self.__id+"_"+a+" div.radio_over").fadeOut(0)
						$("#"+self.__id+"_"+a+" div.radio_fill").fadeIn(0)
						$("#"+self.__id+"_"+a+" img.radio_bg").fadeOut(0)
					}
				}
				self.__answers[0]=id
			}
			self.__vc.__quiz_obj.answer(self.__id,self.__answers)
		}
		
	}
	this.resizeLayout = function(){
			$q = $('#q_'+this.__id)
			$q.css('overflow-y','auto').css('overflow-x','hidden')
			var i = 0
			if(self.__qdata.info_box != "" ){
				i = $("#info_link_"+self.__id+">a").height()*2
			}
			var v_height = self.__vc.__inner_height-($("#nav").height()+$head.height()+(self.__vc.__padding*20)+i)
			var c_height = 0
			
			var n = self.__qdata.answers.a.length
			
			if(self.__vc.__mobile){
				var min_pad = $("#f"+self.__id+"_0").height()*0.8
			}else{
				var min_pad = 13
			}
			for(var a = 0;a<qdata.answers.a.length;a++){
				var c = Math.max(13,$("#"+self.__id+"_"+a).height())
				c_height+=c
				if(__IE > 8){
					$("#f"+self.__id+"_"+a).css("padding-bottom",(c*0.8)+"px")
				}else{
					$("#f"+self.__id+"_"+a).css("padding-bottom","20px")
				}
			}
			
			line_pad = 0
			$("#q_answers_"+self.__id+" div.multi_answer").css("padding-top",line_pad+"px").css("padding-bottom",line_pad+"px")
			var spare = (self.__vc.__inner_height-(($q_answers.height()+$head.height())*1.5))
			if(spare >0){
				if(__IE <=8){
					line_pad = (spare/((n*2)+1))*0.5
				}else{
					line_pad = spare/((n*2)+1)
				}
				$("#q_answers_"+self.__id+" div.multi_answer").css("padding-top",line_pad+"px").css("padding-bottom",line_pad+"px")
			}
			
	}
	this.restoreState = function(a_data){
		//console.log(a_data+"("+self.__id+")")
		self.__answers = a_data	
		var c = false
		for(var b = 0;b<self.__answers.length;b++){
			$("#"+self.__id+"_"+self.__answers[b]+" div.radio_over").css("display","none")
			$("#"+self.__id+"_"+self.__answers[b]+" img.radio_bg").css("display","none")
		}
		
	}
}