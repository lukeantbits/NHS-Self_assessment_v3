function quiz_obj(vc){
	this.__vc = vc;
	var self = this
	self.__points= 0;
	self.__quiz_points= 0;
	self.__vid_arr = new Array();
	self.__link_arr = new Array();
	self.__result_arr = new Array();
	self.__quiz_arr = new Array();
	self.__answer_arr = new Array();
	self.__quiz_vars = {};
	self.__debug
	self.__q_obj_arr = new Array();
	var page = vc.__page
	this.renderQ = function(){	
		//console.log('renderQ')
		for (var a = 0; a < self.__quiz_arr.length; a++)
		{
			var exists = false;
			for (var b = 0; b < self.__q_obj_arr.length; b++)
			{
				if (self.__q_obj_arr[b].__id == self.__quiz_arr[a].id)
				{
					exists = true;
				}
			}
			if (exists == false && a < self.__vc.__page)
			{
				var q = new question_obj(self.__vc,self.__quiz_arr[a],(self.__q_obj_arr.length+1))
				self.__q_obj_arr.push(q);
			}
		}
		$(".info_link a").click(function(e){
			var tmp = e.target.id.split("_")
			self.__vc.launchInfo(tmp[1])
		})
		var $p = $(".page");
	}
	this.isQuiz = function(id){
		var output = false;
		for(var key in self.__quiz_arr){
			if(self.__quiz_arr[key].id == id){
				var q_data = self.__quiz_arr[key]
				if(q_data.quiz_active == "1"){
					output = true;
				}
			}
		}
		//console.log('isQuiz = '+output)
		return output;
	}
	this.checkCorrect = function(id){
		var output = 0;
		var a_val = null
		for(var key in self.__quiz_arr){
			if(self.__quiz_arr[key].id == id){
				output = 2
				var q_data = self.__quiz_arr[key]
				var a_data = self.__answer_arr[id]
				var q = false
				for(var a in q_data.answers.a){
					if(q_data.answers.a[a].actions.ac.length == undefined){
						q_data.answers.a[a].actions.ac = [q_data.answers.a[a].actions.ac]
					}
					var b_node = q_data.answers.a[a].actions.ac
					//console.log(b_node)
					for(var b in b_node){
						if(b_node[b].type == 'quiz'){
							q = true
						}
						var m = false
						for(var c in a_data){
							
							if(a_data[c] == parseInt(a)){
								m = true
							}
							
						}
						if(b_node[b].type == 'quiz' && parseInt(b_node[b].value) == 1 && !m){
							output = 1
						}
					}
				}
				break;
			}
		}
		if(q == false){
			output = 0
		}
		return output;
	}
	this.preview = function(id){
		__data.questions.q = new Array(__data.questions.q[id])
		__data.questions.q[0].action = null
	}
	this.previewResults = function(offset){
		for (var a = 0; a < __data.questions.q.length; a++){
			self.__answer_arr[a]=new Array();
			for(var b = 0; b < __data.questions.q[a].answers.a.length; b++){
				self.__answer_arr[a].push(b);
			}
		}
		self.build()
		self.__vc.__page = self.__quiz_arr.length+offset
		self.__vc.preloadResults()
	}
	this.quizScore = function(){
		self.__quiz_points = 0
		self.__quiz_summary = ''
		var q = 0;
		for (var a = 0; a < __data.questions.q.length; a++){
			var correct = self.checkCorrect(__data.questions.q[a].id)
			if(correct==2){
				q++
				self.__quiz_points+=1
				self.__quiz_summary+= '<div class="q_res"><span class= "q_res_head">Q '+q+' </span><span class= "q_res_correct">Correct</span><br>'+__data.questions.q[a].quiz_summary+'</div>'
			}else if(correct==1){
				q++
				self.__quiz_summary+= '<div class="q_res"><span class= "q_res_head">Q '+q+' </span><span class= "q_res_incorrect">Incorrect</span><br>'+__data.questions.q[a].quiz_summary+'</div>'
			}
		}
	}
	this.build = function(){
		// reset quiz vars
		for (var i in __data.qvars)
		{
			if(i != 'undefined'){
				if(i.indexOf(":number")>0){
					self.__quiz_vars[i] = 0;
				}else{
					self.__quiz_vars[i] = null;
				}
			}
		}
		//
		self.__quiz_arr = new Array();
		self.__points = 0;
		self.__quiz_points = 0;
		self.__vid_arr = new Array();
		self.__link_arr = new Array();
		self.__result_arr = new Array();
		
		i = 0
		// loop through questions
		for (var a = 0; a < __data.questions.q.length; a++){
			// check if answer exists
			var answer_rec = self.__answer_arr[__data.questions.q[a].id];
			if(typeof answer_rec != undefined && answer_rec != null){
				//console.log('Q'+__data.questions.q[a].id+' answer  == '+answer_rec)
				//if exists loop through sub answers
				for (var b = 0; b < answer_rec.length; b++)
				{
					// make sure stored answer is valid
					if (answer_rec[b] < __data.questions.q[a].answers.a.length && __data.questions.q[a].answers.a[answer_rec[b]] != undefined)
					{	
						// hack to convert single actions to array
						if(__data.questions.q[a].answers.a[answer_rec[b]].actions.ac.length == undefined){
							__data.questions.q[a].answers.a[answer_rec[b]].actions.ac = Array(__data.questions.q[a].answers.a[answer_rec[b]].actions.ac)
						}
						
						//if exists loop through actions
						for (var c = 0; c < __data.questions.q[a].answers.a[answer_rec[b]].actions.ac.length; c++)
						{
							var ac =  __data.questions.q[a].answers.a[answer_rec[b]].actions.ac[c]
							switch(ac.type){
								case "points":
									if(Number(ac.value)>0){
										eval('self.__points '+ac.operator+'='+ac.value)
									}
								break;
								case "quiz":
									//if(Number(ac.value)>0){
										//console.log('self.__quiz_points +='+ac.value)
										//eval('self.__quiz_points +='+ac.value)
									//}
								break;
								case "result" :	
									self.__result_arr.push(Number(ac.value))
								break;
								case "video" :
									self.__vid_arr.push(ac.value)
								break;
								case "link" :
									self.__link_arr.push(Number(ac.value))
								break;
								case "set variable" :
									if(ac.sub_type.indexOf(":number")>0){
										if(isNaN(self.__quiz_vars[ac.sub_type])){
											self.__quiz_vars[ac.sub_type]=0;
										}
										switch(ac.operator){
											case '+':
												self.__quiz_vars[ac.sub_type] += Number(ac.value);
											break;
											case '-':
												self.__quiz_vars[ac.sub_type] -= Number(ac.value);
											break;
											case '=':
												self.__quiz_vars[ac.sub_type] = Number(ac.value);
											break;
										}
										
									}else{
										self.__quiz_vars[ac.sub_type] = ac.value;
									}
								break;
							}
						}
					}
				}
			}
			
			if (self.checkQ(__data.questions.q[a]))
			{
				i++;
				__data.questions.q[a].index = i;
				self.__quiz_arr.push(__data.questions.q[a]);
			}
			self.__result_arr = self.__vc.sortUnique(self.__result_arr)	
		}
		//console.log(this)
		//console.log(self.__quiz_vars)
	}
	this.resizeLayout = function(){
		for (var a = 0; a < self.__q_obj_arr.length; a++){
			self.__q_obj_arr[a].resizeLayout();
		}
	}
	this.setQuestions = function(){
		//console.log('setQuestions')
		for (var a = 0; a < self.__q_obj_arr.length; a++){
			var id = self.__q_obj_arr[a].__id
			if(self.__answer_arr[id]!= undefined && self.__answer_arr[id]!= null){
				self.__q_obj_arr[a].__q.restoreState(self.__answer_arr[id]);
			}
		}
	}
	this.checkQ = function(q){	
		//console.log('checkQ')
		var output = true
		var net = 0
		if(q.action != undefined){
			var condition = true
			if(q.action.condition == "show if"){
				condition = false
			}
			for (var a in self.__quiz_vars){
				switch (q.action.property)
				{
					case "points":
						if(eval(self.__points+" "+q.action.operator+" "+q.action.value) && condition){
							output = false
						}
						if(!eval(self.__points+" "+q.action.operator+" "+q.action.value) && !condition){
							output = false
						}
					break;
					case "gender":
						if (q.action.operator == "=" && q.action.value == self.__quiz_vars["gender"] && q.action.condition == "hide if")
						{
							output = false;
						}
						if (q.action.operator == "=" && q.action.value != self.__quiz_vars["gender"] && q.action.condition == "show if")
						{
							output = false;
						}
						if (q.action.operator != "=" && q.action.value != self.__quiz_vars["gender"] && q.action.condition == "hide if")
						{
							output = false;
						}
						if (q.action.operator != "=" && q.action.value == self.__quiz_vars["gender"] && q.action.condition == "show if")
						{
							output = false;
						}
					break;
					default:
						var answer_index = 0;
						var action_index = 0;
						var c = 0
						if ((self.__quiz_vars[a] == null || self.__quiz_vars[a] == undefined) && q.action.condition == "show if" && q.action.property == a){
							output = false;
						}else{
							var allowed = false
							for (var b in __data.qvars[q.action.property])
							{
								if (__data.qvars[q.action.property]!= undefined){
									allowed = true
								}
								if (__data.qvars[q.action.property][b] == q.action.value)
								{
									action_index = c;
								}
								if (__data.qvars[q.action.property][b] == self.__quiz_vars[q.action.property])
								{
									answer_index = c;
								}
								c++;
							}
							if(allowed == false && q.action.condition == "show if"){
								output = false;
							}
							net = answer_index - action_index;
							if (q.action.condition == "show if")
							{
								net = 0 - net;
							}
							if(net != 0 && q.action.condition == "show if" && q.action.operator == "="){
								output = false;
							}
							if(net == 0 && q.action.condition == "hide if" && q.action.operator == "=" && self.__quiz_vars[a] != null){
								output = false;
							}
							if(net > -1 && q.action.operator == ">"){
								output = false;
							}
							if(net < 1 && q.action.operator == "<"){
								output = false;
							}
						}
					}
			}
		}
		return output;
	}
	this.answered = function(){
		//console.log('answered')
		var output = false;
		page = self.__vc.__page
		if (self.__q_obj_arr.length > 0)
		{
			if (self.__answer_arr[self.__q_obj_arr[page - 1].__q.__id] != undefined)
			{	
				if(typeof self.__answer_arr[self.__q_obj_arr[page - 1].__q.__id][0]=="object"){
					if(self.__answer_arr[self.__q_obj_arr[page - 1].__q.__id][0].length > 0){
						output = true;
					}
				}else{
					output = true;
				}

			}
		}
		if(page > self.__quiz_arr.length){
			output = true;
		}
		return output;
	}
	this.answer = function(id,val){
		
		for (a = 0; a < self.__q_obj_arr.length; a++)
		{
			if (a >= self.__vc.__page){	
				$("#q_"+self.__q_obj_arr[a].__id).remove()
				self.__answer_arr[self.__q_obj_arr[a].__id]= new Array()
				self.cancelAction(self.__q_obj_arr[a].__qdata)
				delete(self.__answer_arr[self.__q_obj_arr[a].__id])
			}
			if(a == self.__vc.__page-1){
				self.cancelAction(self.__q_obj_arr[a].__qdata)
			}
		}
		self.__q_obj_arr.splice(self.__vc.__page,999);
		// set answer;
		self.__answer_arr[id] = val;
		self.build();
		//reset title progress;
		self.__vc.__nav_obj.checkNav()
		self.__vc.__state_obj.storeState()
		
	}
	this.generateResults = function(){
		//console.log('generateResults')
		if(self.__vc.__quiz){
			self.quizScore()
		}
		self.__vid_arr = self.__vc.sortUnique(self.__vid_arr)
		self.__link_arr =  self.__vc.sortUnique(self.__link_arr)
		self.__result_arr =  self.__vc.sortUnique(self.__result_arr)
	}
	this.getActive = function(page){	
		//console.log('getActive')
		if(page<=self.__quiz_arr.length){
			return self.__quiz_arr[page-1].id
		}else{
			return null;
		}
	}
	this.cancelAction = function(q_obj){
		//console.log('cancelAction')
		for (var a = 0; a < q_obj.answers.a.length; a++){
			for (var b = 0; b < q_obj.answers.a[a].actions.ac.length; b++){
				if(q_obj.answers.a[a].actions.ac[b].type == "set variable"){
					if(q_obj.answers.a[a].actions.ac[b].sub_type != 'undefined'){
						if(q_obj.answers.a[a].actions.ac[b].sub_type.indexOf(":number")>0){
							self.__quiz_vars[q_obj.answers.a[a].actions.ac[b].sub_type] = 0
						}else{
							self.__quiz_vars[q_obj.answers.a[a].actions.ac[b].sub_type] = null
						}
					}
				}
			}
		}
	}
}