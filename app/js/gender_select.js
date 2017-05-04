function gender_select_obj(vc,qdata,index,parent){
	this.__vc = vc;
	this.__parent = parent;
	this.__qdata = qdata;
	this.__id = parent.__id
	this.__index = index
	this.__selected = Array()
	this.__answers = Array();
	var self = this
	// cache those jquery nodes...
	
	//
	this.init = function(){
		var output ="<div class = \"wrap_center\"><div id=\"q_answers_"+self.__id+"\" class= \"gender_answers\"><div>";
		output+= "<a href = \"javascript:void(0)\" id=\"q_gender_male_"+self.__id+"_anchor\"><div class=\"q_gender_bg\"><div class=\"q_gender_inner\" id=\"q_gender_male_"+self.__id+"_grey\"><img src=\"images/male_mask.png\"></div></div>";
		output+= "<div class=\"q_gender_bg\"><div class=\"q_gender_inner\" id=\"q_gender_male_"+self.__id+"\"><img src=\"images/male_mask.png\"></div></div>";
		output +="</a></div><div><a href = \"javascript:void(0)\" id=\"q_gender_female_"+self.__id+"_anchor\">"
		output+= "<div class=\"q_gender_bg\"><div class=\"q_gender_inner\" id=\"q_gender_female_"+self.__id+"_grey\"><img src=\"images/female_mask.png\"></div></div>";
		output+= "<div class=\"q_gender_bg\"><div class=\"q_gender_inner\" id=\"q_gender_female_"+self.__id+"\"><img src=\"images/female_mask.png\"></div></div>";
		output +="</a></div></div></div>";
		return output;
	}
	this.initAnswers = function(){
		//console.time('initAnswers gs');
		self.__q_answers = $("#q_answers_"+self.__id)
		self.__male_div = $("#q_gender_male_"+self.__id)
		self.__female_div = $("#q_gender_female_"+self.__id)
		self.__male_a = $("#q_gender_male_"+self.__id+"_anchor")
		self.__female_a = $("#q_gender_female_"+self.__id+"_anchor")
		self.__head = $("#q_"+self.__id+"_head")
		self.__images = $("#q_answers_"+self.__id+" img")
		self.__male_div.fadeOut(0)
		self.__female_div.fadeOut(0)
		self.__male_a.click(function(e){self.toggle(0);return false;})
		self.__female_a.click(function(e){self.toggle(1);return false;})
		
		self.__answers.push(self.__male_div)
		self.__answers.push(self.__female_div)
		self.__vc.setGradient(self.__male_div,__data.config.colour_1[1],__data.config.colour_1[0]);
		self.__vc.setGradient(self.__female_div,__data.config.colour_1[1],__data.config.colour_1[0]);
		//console.timeEnd('initAnswers gs');
		
		
	}
	this.toggle = function(id){
		//console.time('toggle gs');
		if(self.__selected[0] == id){
			self.__selected[0] = (id+1)%2
		}else{
			self.__selected[0] = id
		}
		for(var a = 0;a<self.__answers.length;a++){
			if(a == self.__selected[0]){
				self.__answers[a].fadeIn();
			}else{
				self.__answers[a].fadeOut();
			}
		}
		self.__vc.__quiz_obj.answer(self.__id,self.__selected)
		self.resizeLayout()
		//console.timeEnd('toggle gs');
	}
	this.focusQ1  = function(){
		$('#q_gender_male_'+self.__id+'_anchor').focus();
	}
	this.lockAnswers = function(){
		$('#q_gender_male_'+self.__id+'_anchor').attr('tabindex',-1)
		$('#q_gender_female_'+self.__id+'_anchor').attr('tabindex',-1)
	}
	this.resizeLayout = function(){
		//self.__q_answers.css("width",Math.min(this.__vc.__height*0.5,this.__vc.__width*0.8))
		var i = 0
		if(self.__qdata.info_box != "" ){
			i = $("#info_link_"+self.__id+">a").height()*3
		}
		var v_height = self.__vc.__inner_height-($("#nav").height()+self.__head.height()+(self.__vc.__padding*20)+i)
		if((self.__vc.__inner_width*0.8)<v_height){
			v_height = (self.__vc.__inner_width*0.8)
		}
		//self.__q_answers.css("height",vheight);
		//self.__q_answers.css("height",Math.min((vheight-self.__head.height())*0.7),(self.__vc.__inner_width*0.35))
		self.__images.css("width",(v_height/2)+"px")
		self.__images.css("height",(v_height)+"px")
		
		
		self.__male_div.css("margin-top",(0-self.__male_div.height()))
		self.__female_div.css("margin-top",(0-self.__female_div.height()))
		
		
		//console.log('gender resize '+self.__male_div.height())
		
	}
	this.restoreState = function(a_data){
		//console.log("restoring "+this.__id+" / "+a_data)
		self.toggle(Number(a_data))
		setTimeout(setMargin,100)
		function setMargin(){
			self.resizeLayout()
		}
	}
}