function maintain_state(r,i){
	var self = this;
	var init = false;
	var id = i
	var root = r;
	self.visits = 0;
	//self.vtvs = makeID(32);
	self.co_f = makeID(32);
	self.data = {}
	this.storeState = function(){
		if(init){
			self.data = {};
			self.data['questions'] = [];
			for(var q in root.data.questions){
				self.data['questions'].push(root.data.questions[q].selected)
			}
			self.data.area = root.area
			self.data.current_index = root.quiz.current_index
			self.data.current_question = root.quiz.current_question
			self.data.co_f = self.co_f;
			self.data.visits = self.visits;
			$.cookie("nhs_SA-"+id,JSON.stringify(self.data));
			console.log($.cookie("nhs_SA-"+id))
		}
	}
	this.clearState = function (){
		$.removeCookie("nhs_SA-"+id);
		var obj = {'visits':self.visits,'co_f':self.co_f}
		$.cookie("nhs_backpain",JSON.stringify(obj));
		init = true
	}
	this.restoreState = function(){
		if($.cookie("nhs_SA-"+id) != null){
			self.data = jQuery.parseJSON($.cookie("nhs_SA-"+id));
			if(!isNaN(parseInt(self.data.visits))){
				self.visits = parseInt(self.data.visits)+1;
			}
			if(self.data.hasOwnProperty('co_f')){
				self.co_f = self.data.co_f
			}
			root.restoreState(self.data)
		}
		self.clearState();
	}
}