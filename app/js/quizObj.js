function quizObj(root){
	var self = this
	self.root = root
	self.points= 0;
	self.quiz_points= 0;
	self.vid_arr = [];
	self.link_arr = [];
	self.result_arr = [];
	self.quiz_arr = [];
	self.answer_arr = [];
	self.quiz_vars = {};
	self.debug
	self.q_obj_arr = [];
	self.active_total = self.root.data.questions.length
	self.current_index = 0
	self.current_question = 0
	this.getCurrent = function(){
		return self.root.data.questions[self.current_question];
	}
	this.getNext = function(){
		for (var a = 0; a < self.root.data.questions.length; a++){
			if(self.root.data.questions[a].id > self.current_question && self.root.data.questions[a].obj.active == true){
				self.current_question = self.root.data.questions[a].id
				break;
			}
		}
		return self.root.data.questions[self.current_question];
	}
	this.getPrevious = function(){
		for (var a = self.root.data.questions.length-1; a >=0; a--){
			if(self.root.data.questions[a].id < self.current_question && self.root.data.questions[a].obj.active == true){
				self.current_question = self.root.data.questions[a].id
				break;
			}
		}
		return self.root.data.questions[self.current_question];
	}
	this.getIndex = function(){
		return self.current_index;
	}
	this.isComplete = function(){
		if(self.active_total==self.current_index){
			return true;
		}else{
			return false;
		}
	}
	this.reset = function(){
		for (var a = 0; a < self.root.data.questions.length; a++){
			self.root.data.questions[a].obj.resetObj();
		}
		self.current_index = 0
		self.current_question = 0
	}
	this.getTotal = function(){
		return self.active_total;
	}
	this.cancelAnswers = function(){
		console.log('cancelActions')
		//console.log(self.root.data.questions[self.current_question]);
		for (var a = 0; a < self.root.data.questions.length; a++){
			var q_obj = self.root.data.questions[a];
			if(self.current_question<q_obj.id){
				q_obj.obj.resetObj();
			}
		}
	}
	this.setPreview = function(){
		self.current_question = self.root.data.questions.length
		for (var a = 0; a < self.root.data.questions.length; a++){
			self.root.data.questions[a].obj.active = true
			self.root.data.questions[a].selected = [1];
		}
		self.build();
	}
	this.build = function(){
		console.log('build')
		// reset quiz vars
		for (var i in self.root.data.qvars)
		{
			if(i != 'undefined'){
				if(i.indexOf(":number")>0){
					self.quiz_vars[i] = 0;
				}else{
					self.quiz_vars[i] = null;
				}
			}
		}
		// clean up in case of backtracking
		self.cancelAnswers();
		//
		self.quiz_arr = [];
		self.points = 0;
		self.quiz_points = 0;
		self.vid_arr = [];
		self.link_arr = [];
		self.result_arr = [];
		self.current_index = 0;
		i = 0;
		self.active_total = 0;
		for (var a = 0; a < self.root.data.questions.length; a++){
			// check if answer exists
			//var answer_rec = self.answer_arr[self.root.data.questions[a].id];
			var answer_rec = self.root.data.questions[a].selected
			//console.log(answer_rec)
			if(typeof answer_rec != undefined && answer_rec != null){
				//console.log('Q'+self.root.data.questions[a].id+' answer  == '+answer_rec)
				//if exists loop through sub answers
				for (var b = 0; b < answer_rec.length; b++)
				{
					// make sure stored answer is valid
					if (answer_rec[b] < self.root.data.questions[a].answers.length && self.root.data.questions[a].answers[answer_rec[b]] != undefined)
					{	
						// hack to convert single actions to array
						if(self.root.data.questions[a].answers[answer_rec[b]].actions.length == undefined){
							self.root.data.questions[a].answers[answer_rec[b]].actions = Array(self.root.data.questions[a].answers[answer_rec[b]].actions)
						}
						
						//if exists loop through actions
						for (var c = 0; c < self.root.data.questions[a].answers[answer_rec[b]].actions.length; c++)
						{
							var ac =  self.root.data.questions[a].answers[answer_rec[b]].actions[c]
							switch(ac.type){
								case "points":
									if(Number(ac.value)>0){
										eval('self.points '+ac.operator+'='+ac.value)
									}
								break;
								case "quiz":
									//if(Number(ac.value)>0){
										//console.log('self.quiz_points +='+ac.value)
										//eval('self.quiz_points +='+ac.value)
									//}
								break;
								case "result" :	
									self.result_arr.push(Number(ac.value))
								break;
								case "video" :
									self.vid_arr.push(ac.value)
								break;
								case "link" :
									self.link_arr.push(Number(ac.value))
								break;
								case "set variable" :
									if(ac.sub_type.indexOf(":number")>0){
										if(isNaN(self.quiz_vars[ac.sub_type])){
											self.quiz_vars[ac.sub_type]=0;
										}
										switch(ac.operator){
											case '+':
												self.quiz_vars[ac.sub_type] += Number(ac.value);
											break;
											case '-':
												self.quiz_vars[ac.sub_type] -= Number(ac.value);
											break;
											case '=':
												self.quiz_vars[ac.sub_type] = Number(ac.value);
											break;
										}
										
									}else{
										self.quiz_vars[ac.sub_type] = ac.value;
									}
								break;
							}
						}
					}
				}
			}
			self.root.data.questions[a].obj.active = self.checkQ(self.root.data.questions[a])
			if(self.root.data.questions[a].obj.active){
				self.active_total++
				if(self.root.data.questions[a].id <= self.current_question){
					self.current_index++
				}else{
					self.root.data.questions[a].obj.data.selected = [];
					//console.log(self.root.data.questions[a])
					self.root.data.questions[a].obj.restore()
				}
			}
			self.root.nav.updateProgress(self)
			//console.log(a+' active = '+self.root.data.questions[a].obj.active)
			if (self.checkQ(self.root.data.questions[a]))
			{
				i++;
				//self.root.data.questions[a].index = i;
				self.quiz_arr.push(self.root.data.questions[a]);
			}
			self.result_arr = self.root.sortUnique(self.result_arr)	
		}
		//
		var i = 0
		for (var a = 0; a < self.root.data.questions.length; a++){
			if(self.root.data.questions[a].obj.active){
				i++;
				self.root.data.questions[a].obj.updateHeader(i,self.active_total);
			}
		}
		console.log('build complete')
		console.log(self)
		//console.log(self.quiz_vars)
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
			for (var a in self.quiz_vars){
				switch (q.action.property)
				{
					case "points":
						if(eval(self.points+" "+q.action.operator+" "+q.action.value) && condition){
							output = false
						}
						if(!eval(self.points+" "+q.action.operator+" "+q.action.value) && !condition){
							output = false
						}
					break;
					case "gender":
						if (q.action.operator == "=" && q.action.value == self.quiz_vars["gender"] && q.action.condition == "hide if")
						{
							output = false;
						}
						if (q.action.operator == "=" && q.action.value != self.quiz_vars["gender"] && q.action.condition == "show if")
						{
							output = false;
						}
						if (q.action.operator != "=" && q.action.value != self.quiz_vars["gender"] && q.action.condition == "hide if")
						{
							output = false;
						}
						if (q.action.operator != "=" && q.action.value == self.quiz_vars["gender"] && q.action.condition == "show if")
						{
							output = false;
						}
					break;
					default:
						var answer_index = 0;
						var action_index = 0;
						var c = 0
						if ((self.quiz_vars[a] == null || self.quiz_vars[a] == undefined) && q.action.condition == "show if" && q.action.property == a){
							output = false;
						}else{
							var allowed = false
							for (var b in self.root.data.qvars[q.action.property])
							{
								if (self.root.data.qvars[q.action.property]!= undefined){
									allowed = true
								}
								if (self.root.data.qvars[q.action.property][b] == q.action.value)
								{
									action_index = c;
								}
								if (self.root.data.qvars[q.action.property][b] == self.quiz_vars[q.action.property])
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
							if(net == 0 && q.action.condition == "hide if" && q.action.operator == "=" && self.quiz_vars[a] != null){
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
	this.checkCorrect = function(id){
		var output = 1;
		for(var a in self.root.data.questions[id].answers){
			var anode = self.root.data.questions[id].answers[a]
			for(var b in anode.actions){
				if(anode.actions[b].type == 'quiz'){
					if(self.root.data.questions[id].selected.indexOf(parseInt(a))==-1 && anode.actions[b].value == 1){
						output = 0
					}
					if(self.root.data.questions[id].selected.indexOf(parseInt(a))>-1 && anode.actions[b].value == 0){
						output = 0
					}
				}
			}
		}
		return output;
	}
	this.quizScore = function(){
		self.quiz_points = 0
		self.quiz_summary = []
		var q = 0;
		for (var a = 0; a < self.root.data.questions.length; a++){
			var correct = self.checkCorrect(self.root.data.questions[a].id)
			if(correct==1){
				q++
				self.quiz_points+=1
				self.quiz_summary.push({"title":"Q "+q,"sub_title":"Correct","body":self.root.data.questions[a].quiz_summary})
			}else{
				q++
				self.quiz_summary.push({"title":"Q "+q,"sub_title":"Incorrect","body":self.root.data.questions[a].quiz_summary})
			}
		}
	}
	this.generateResults = function(){
		var output = {};
		if(self.root.quiz){
			self.quizScore();
			output['quiz_data'] = {"points":self.quiz_points,"summary":self.quiz_summary}
		}
		
		output['vid_arr'] = self.root.sortUnique(self.vid_arr);
		output['link_arr'] =  self.root.sortUnique(self.link_arr);
		output['result_arr'] =  self.root.sortUnique(self.result_arr);
		output['points'] = self.points
		output['quiz_points'] = self.quiz_points
		output['quiz_summary'] = self.quiz_summary
		output['quiz_arr'] = self.quiz_arr
		output['quiz_vars'] = self.quiz_vars
		console.log(output)
		return output;
	}
}
	
	
	
	
	//########################################################
	/*this.root = root;
	var self = this
	self.points= 0;
	self.quiz_points= 0;
	self.vid_arr = [];
	self.link_arr = [];
	self.result_arr = [];
	self.quiz_arr = [];
	self.answer_arr = [];
	self.quiz_vars = {};
	self.debug
	self.q_obj_arr = [];
	var page = root.page
	this.renderQ = function(){	
		//console.log('renderQ')
		for (var a = 0; a < self.quiz_arr.length; a++)
		{
			var exists = false;
			for (var b = 0; b < self.q_obj_arr.length; b++)
			{
				if (self.q_obj_arr[b].id == self.quiz_arr[a].id)
				{
					exists = true;
				}
			}
			if (exists == false && a < self.root.page)
			{
				var q = new question_obj(self.root,self.quiz_arr[a],(self.q_obj_arr.length+1))
				self.q_obj_arr.push(q);
			}
		}
		$(".info_link a").click(function(e){
			var tmp = e.target.id.split("_")
			self.root.launchInfo(tmp[1])
		})
		var $p = $(".page");
	}
	this.isQuiz = function(id){
		var output = false;
		for(var key in self.quiz_arr){
			if(self.quiz_arr[key].id == id){
				var q_data = self.quiz_arr[key]
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
		for(var key in self.quiz_arr){
			if(self.quiz_arr[key].id == id){
				output = 2
				var q_data = self.quiz_arr[key]
				var a_data = self.answer_arr[id]
				var q = false
				for(var a in q_data.answers){
					if(q_data.answers[a].actions.length == undefined){
						q_data.answers[a].actions = [q_data.answers[a].actions]
					}
					var b_node = q_data.answers[a].actions
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
		self.root.data.questions = new Array(self.root.data.questions[id])
		self.root.data.questions[0].action = null
	}
	this.previewResults = function(offset){
		for (var a = 0; a < self.root.data.questions.length; a++){
			self.answer_arr[a]=[];
			for(var b = 0; b < self.root.data.questions[a].answers.length; b++){
				self.answer_arr[a].push(b);
			}
		}
		self.build()
		self.root.page = self.quiz_arr.length+offset
		self.root.preloadResults()
	}
	this.quizScore = function(){
		self.quiz_points = 0
		self.quiz_summary = ''
		var q = 0;
		for (var a = 0; a < self.root.data.questions.length; a++){
			var correct = self.checkCorrect(self.root.data.questions[a].id)
			if(correct==2){
				q++
				self.quiz_points+=1
				self.quiz_summary+= '<div class="q_res"><span class= "q_res_head">Q '+q+' </span><span class= "q_res_correct">Correct</span><br>'+self.root.data.questions[a].quiz_summary+'</div>'
			}else if(correct==1){
				q++
				self.quiz_summary+= '<div class="q_res"><span class= "q_res_head">Q '+q+' </span><span class= "q_res_incorrect">Incorrect</span><br>'+self.root.data.questions[a].quiz_summary+'</div>'
			}
		}
	}
	this.build = function(){
		// reset quiz vars
		for (var i in data.qvars)
		{
			if(i != 'undefined'){
				if(i.indexOf(":number")>0){
					self.quiz_vars[i] = 0;
				}else{
					self.quiz_vars[i] = null;
				}
			}
		}
		//
		self.quiz_arr = [];
		self.points = 0;
		self.quiz_points = 0;
		self.vid_arr = [];
		self.link_arr = [];
		self.result_arr = [];
		
		i = 0
		// loop through questions
		for (var a = 0; a < self.root.data.questions.length; a++){
			// check if answer exists
			var answer_rec = self.answer_arr[self.root.data.questions[a].id];
			if(typeof answer_rec != undefined && answer_rec != null){
				//console.log('Q'+self.root.data.questions[a].id+' answer  == '+answer_rec)
				//if exists loop through sub answers
				for (var b = 0; b < answer_rec.length; b++)
				{
					// make sure stored answer is valid
					if (answer_rec[b] < self.root.data.questions[a].answers.length && self.root.data.questions[a].answers[answer_rec[b]] != undefined)
					{	
						// hack to convert single actions to array
						if(self.root.data.questions[a].answers[answer_rec[b]].actions.length == undefined){
							self.root.data.questions[a].answers[answer_rec[b]].actions = Array(self.root.data.questions[a].answers[answer_rec[b]].actions)
						}
						
						//if exists loop through actions
						for (var c = 0; c < self.root.data.questions[a].answers[answer_rec[b]].actions.length; c++)
						{
							var ac =  self.root.data.questions[a].answers[answer_rec[b]].actions[c]
							switch(ac.type){
								case "points":
									if(Number(ac.value)>0){
										eval('self.points '+ac.operator+'='+ac.value)
									}
								break;
								case "quiz":
									//if(Number(ac.value)>0){
										//console.log('self.quiz_points +='+ac.value)
										//eval('self.quiz_points +='+ac.value)
									//}
								break;
								case "result" :	
									self.result_arr.push(Number(ac.value))
								break;
								case "video" :
									self.vid_arr.push(ac.value)
								break;
								case "link" :
									self.link_arr.push(Number(ac.value))
								break;
								case "set variable" :
									if(ac.sub_type.indexOf(":number")>0){
										if(isNaN(self.quiz_vars[ac.sub_type])){
											self.quiz_vars[ac.sub_type]=0;
										}
										switch(ac.operator){
											case '+':
												self.quiz_vars[ac.sub_type] += Number(ac.value);
											break;
											case '-':
												self.quiz_vars[ac.sub_type] -= Number(ac.value);
											break;
											case '=':
												self.quiz_vars[ac.sub_type] = Number(ac.value);
											break;
										}
										
									}else{
										self.quiz_vars[ac.sub_type] = ac.value;
									}
								break;
							}
						}
					}
				}
			}
			
			if (self.checkQ(self.root.data.questions[a]))
			{
				i++;
				self.root.data.questions[a].index = i;
				self.quiz_arr.push(self.root.data.questions[a]);
			}
			self.result_arr = self.root.sortUnique(self.result_arr)	
		}
		//console.log(this)
		//console.log(self.quiz_vars)
	}
	this.resizeLayout = function(){
		for (var a = 0; a < self.q_obj_arr.length; a++){
			self.q_obj_arr[a].resizeLayout();
		}
	}
	this.setQuestions = function(){
		//console.log('setQuestions')
		for (var a = 0; a < self.q_obj_arr.length; a++){
			var id = self.q_obj_arr[a].id
			if(self.answer_arr[id]!= undefined && self.answer_arr[id]!= null){
				self.q_obj_arr[a].q.restoreState(self.answer_arr[id]);
			}
		}
	}
	
	this.answered = function(){
		//console.log('answered')
		var output = false;
		page = self.root.page
		if (self.q_obj_arr.length > 0)
		{
			if (self.answer_arr[self.q_obj_arr[page - 1].q.id] != undefined)
			{	
				if(typeof self.answer_arr[self.q_obj_arr[page - 1].q.id][0]=="object"){
					if(self.answer_arr[self.q_obj_arr[page - 1].q.id][0].length > 0){
						output = true;
					}
				}else{
					output = true;
				}

			}
		}
		if(page > self.quiz_arr.length){
			output = true;
		}
		return output;
	}
	this.answer = function(id,val){
		
		for (a = 0; a < self.q_obj_arr.length; a++)
		{
			if (a >= self.root.page){	
				$("#q_"+self.q_obj_arr[a].id).remove()
				self.answer_arr[self.q_obj_arr[a].id]= []
				self.cancelAction(self.q_obj_arr[a].qdata)
				delete(self.answer_arr[self.q_obj_arr[a].id])
			}
			if(a == self.root.page-1){
				self.cancelAction(self.q_obj_arr[a].qdata)
			}
		}
		self.q_obj_arr.splice(self.root.page,999);
		// set answer;
		self.answer_arr[id] = val;
		self.build();
		//reset title progress;
		self.root.nav_obj.checkNav()
		self.root.state_obj.storeState()
		
	}
	this.generateResults = function(){
		//console.log('generateResults')
		if(self.root.quiz){
			self.quizScore()
		}
		self.vid_arr = self.root.sortUnique(self.vid_arr)
		self.link_arr =  self.root.sortUnique(self.link_arr)
		self.result_arr =  self.root.sortUnique(self.result_arr)
	}
	this.getActive = function(page){	
		//console.log('getActive')
		if(page<=self.quiz_arr.length){
			return self.quiz_arr[page-1].id
		}else{
			return null;
		}
	}
	this.cancelAction = function(q_obj){
		//console.log('cancelAction')
		for (var a = 0; a < q_obj.answers.length; a++){
			for (var b = 0; b < q_obj.answers[a].actions.length; b++){
				if(q_obj.answers[a].actions[b].type == "set variable"){
					if(q_obj.answers[a].actions[b].sub_type != 'undefined'){
						if(q_obj.answers[a].actions[b].sub_type.indexOf(":number")>0){
							self.quiz_vars[q_obj.answers[a].actions[b].sub_type] = 0
						}else{
							self.quiz_vars[q_obj.answers[a].actions[b].sub_type] = null
						}
					}
				}
			}
		}
	}
}*/