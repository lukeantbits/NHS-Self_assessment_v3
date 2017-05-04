function maintain_state(vc,ASid){
	var self = this
	this.__vc = vc;
	this.__ASid = ASid
	var quizObj
	this.storeState = function(){
		if(__IE>7){
			quizObj = vc.__quiz_obj
			//console.log(self.__vc.__page+' -- '+JSON.stringify(quizObj.__answer_arr))
			$.cookie("NHS-"+self.__ASid+"_answers", JSON.stringify(quizObj.__answer_arr));
			$.cookie("NHS-"+self.__ASid+"_page", self.__vc.__page);
			$.cookie("NHS-"+self.__ASid+"_visits", self.__vc.__visits);
		}
	}
	this.clearState = function (){
		$.removeCookie("NHS-"+self.__ASid+"_answers");
		$.removeCookie("NHS-"+self.__ASid+"_page");
	}
	this.restoreState = function(){
		if(__IE>7){
			quizObj = self.__vc.__quiz_obj
			if($.cookie("NHS-"+self.__ASid+"_page") != null && $.cookie("NHS-"+self.__ASid+"_answers") != null){
				self.__vc.__visits = parseInt($.cookie("NHS-"+self.__ASid+"_visits"))+1
				var answers = JSON.parse($.cookie("NHS-"+self.__ASid+"_answers"))
				self.__vc.restoreState(answers,$.cookie("NHS-"+self.__ASid+"_page"));
			}
			self.clearState()
		}
	}
}