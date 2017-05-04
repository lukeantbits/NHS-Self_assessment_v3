function questionsPage(root){
	var self = this
	var ref = root;
	this.qdata = {};
	this.qcurrent = {};
	this.variables = {}
	this.links = {}
	this.results = {}
	this.infoboxes = {}
	this.action_properties = { select_1: 'type', value_1: 'value',select_2: 'sub_type',select_3: 'operator',select_4: 'value'};
	this.select_1_arr = Array("points","link","result","set variable","video");
	this.select_3_arr = Array("=");
	this.select_5_arr = Array("+","-");
	this.question_types = Array("single select","multiple select","gender","yes/no","true/false");
	this.info_box_positions = Array("above answers","below answers");
	//$("#question_list").css("margin-right","500")
	
	for(var i = 0;i<this.info_box_positions.length;i++){
		$("#info_box_position").append("<option value='"+i+"'>"+this.info_box_positions[i]+"</option>");
	}
	for(var i = 0;i<this.question_types.length;i++){
		$("#question_type").append("<option value='"+this.question_types[i]+"'>"+this.question_types[i]+"</option>");
	}
	$("#question_type").change(function(event){
		switch(this.value){
			case "gender":
				$.getJSON("ajax/questions_manager.php?cmd=set_question&ref="+(ref.as_id)+"&q="+self.qcurrent.id+"&q_type=gender", function(data) { 
					self.qdata= data.questions;
					self.drawQuestions(self.qdata);
				}); 
			break;
			case "yes/no":
				$.getJSON("ajax/questions_manager.php?cmd=set_question&ref="+(ref.as_id)+"&q="+self.qcurrent.id+"&q_type=yes/no", function(data) { 
					self.qdata= data.questions;
					self.drawQuestions(self.qdata);
				}); 
			break;
			case "true/false":
				$.getJSON("ajax/questions_manager.php?cmd=set_question&ref="+(ref.as_id)+"&q="+self.qcurrent.id+"&q_type=true/false", function(data) { 
					self.qdata= data.questions;
					self.drawQuestions(self.qdata);
				}); 
			break;
		}
	})
	//
	// question stuff
	//
	this.addBC = function(id,callback){
		//alert(id+" "+callback)
		self.setActionData(callback,'value',id)
		self.renderActions()
		self.syncAnswers(self.qcurrent)
		self.saveAll([ref.pg,ref.pg],"$.fancybox.close();");
					
	}
	this.getQuestions = function(){
		$.getJSON("ajax/questions_manager.php?cmd=list&ref="+(ref.as_id), function(data) { 
			self.qdata= data.questions;
			self.variables = data.variables
			self.links = data.links
			self.results = data.results
			self.infoboxes = data.infoboxes
			self.drawQuestions(self.qdata);
		}); 
	}
	new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','removeformat','xhtml']}).panelInstance('question_body');
	if(root.quiz == 0){
		$('#quiz').hide()
	}else{
		this.select_1_arr.push('quiz')
		new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','removeformat','xhtml']}).panelInstance('quiz_summary');
		new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','removeformat','xhtml']}).panelInstance('quiz_check');
	}
	this.drawQuestions = function(data){
		ref.q=Math.min(ref.q, data.length-1)
		self.qdata = data
		$("#shift_q_left").css("margin-right","0px")
		if(ref.q == 0){
			$("#shift_q_left").css("visibility","hidden")
		}else{
			$("#shift_q_left").css("visibility","visible")
		}
		if(ref.q >= self.qdata.length-1){
			$("#shift_q_right").css("visibility","hidden")
			$("#shift_q_left").css("margin-right","-45px")
			
		}else{
			$("#shift_q_right").css("visibility","visible")
		}
		var output = "";
		for (var i=0; i < data.length; i++) {
			if(i == ref.q){
				self.qcurrent = data[i];
				self.drawAnswers(data[i])
				nicEditors.findEditor('question_body').setContent(self.qcurrent.question_body)
				if(root.quiz == 1){
					nicEditors.findEditor('quiz_summary').setContent(self.qcurrent.quiz_summary)
					$('#quiz_answer').val(self.qcurrent.quiz_answer)
					nicEditors.findEditor('quiz_check').setContent(self.qcurrent.quiz_check)
				}
				output += "<li><a id=\"sub_nav_"+i+"\" class=\"current\" href=\"#\">Q"+(i+1)+"</a></li>"
			}else{
				output += "<li><a id=\"sub_nav_"+i+"\" href=\"#\">Q"+(i+1)+"</a></li>"
			}
		}
		//populate infoboxes
		
		$("#info_box").html("");
		for(var i = 0;i<this.infoboxes.length;i++){
			$("#info_box").append("<option value='"+this.infoboxes[i].id+"'>"+this.infoboxes[i].title_text+"</option>");
		}
		$("#info_box").val(self.qcurrent.info_box).attr("selected", "selected");
		$("#info_box_position").val(self.qcurrent.info_box_position).attr("selected", "selected");
		$("#info_box,#info_box_position").change(function(event){
			self.saveAll([ref.pg,ref.pg],null);
		})
		//
		$("#question_type").val(self.qcurrent.question_type).attr("selected", "selected");
		$('#question_list').html(output)
		
		if(self.qcurrent.info_box == "0"){
			$("#info_inner").fadeOut(0);
		}else{
			$("#info_inner").fadeIn(0);
		}
		$("#info_box").change(function(event){
			if(this.value == "0"){
				$("#info_inner").fadeOut("fast");
			}else{
				$("#info_inner").fadeIn("fast");
			}
		})
		// question actions
		$("#q_select_4,#q_select_5").fadeOut(0)
		if(self.qcurrent.q_select_1 == "null" || self.qcurrent.q_select_1 == null){
			$("#q_actions_inner").fadeOut(0)
		}else{
			$("#q_actions_inner").fadeIn(0)
		}
		$("#q_select_1").change(function(event){
			if(this.value == "null"){
				$("#q_actions_inner").fadeOut('fast');
			}else{
				$("#q_actions_inner").fadeIn('fast');
			}
			self.saveAll([ref.pg,ref.pg],null);
		})
		if(self.qcurrent.q_select_2 == "points"){
			$("#q_select_4").hide(0);
			$("#q_select_5").show(0);
		}else{
			$("#q_select_5").hide(0);
			$("#q_select_4").show(0);
			self.populateQAV($("#q_select_4"),this.value)
		}
		$("#q_select_2").change(function(event){
			if(this.value == "points"){
				$("#q_select_4").hide(0);
				$("#q_select_5").show(0);
			}else{
				$("#q_select_5").hide(0);
				$("#q_select_4").show(0);
				self.populateQAV($("#q_select_4"),this.value)
			}
			self.saveAll([ref.pg,ref.pg],null);
		})
		$("#q_select_3,#q_select_4,#q_select_5").change(function(event){
			self.saveAll([ref.pg,ref.pg],null);
		})
		if(self.qcurrent.q_select_2 != "points"){
			self.populateQAV($("#q_select_4"),self.qcurrent.q_select_2)
			$("#q_select_4").show(0)
		}else{
			$("#q_select_5").show(0)
		}
		$("#q_select_2").html("")
		$("#q_select_2").append("<option value='points'>points</option>");
		for(var i = 0;i<this.variables.length;i++){
			$("#q_select_2").append("<option value='"+this.variables[i].name+"'>"+this.variables[i].name+"</option>");
		}
		for(var i = 1;i<=5;i++){
			$("#q_select_"+i).val(eval("self.qcurrent.q_select_"+i)).attr("selected", "selected");
		}
		//
		for (var i=0; i < data.length; i++) {
			$("#sub_nav_"+i).click([i,ref.q],function(event){
				self.qcurrent = self.syncAnswers(self.qcurrent)
				self.qdata[self.q] = self.qcurrent
				self.saveAll(event.data,"self.pageObj.switchQuestion("+event.data+")");
			});
		}
		
		//console.log(self.qcurrent)
		$("#q_id").val(self.qcurrent.id);
	}
	this.populateQAV = function(obj,val){
		obj.html("")
		for(var i = 0;i<self.variables.length;i++){
			if(self.variables[i].name == val){
				var tmp = self.variables[i].vals.split('|')
				for(var j = 0;j<tmp.length;j++){
					obj.append("<option value='"+tmp[j]+"'>"+tmp[j]+"</option>");
				}
				break;
			}
		}
	}
	this.saveAll = function(data,callback){
		//alert(data)
		//data
		app.saveAll([ref.pg,ref.pg],callback);
	}
	$("#delete_question").click(function(event){
		if(self.qdata.length>1){
			//alert(self.qdata[ref.q].question_body)
			self.qdata.splice(ref.q,1);
			var qid = self.qcurrent.id
			ref.q--
			self.drawQuestions(self.qdata)	
			$.ajax({
			  url: "ajax/questions_manager.php?cmd=delete_question&ref="+qid+"&q="+(ref.q+1),
			  context: document.body,
			  success: function(data){
				if(data == "success"){
					//window.location='questions.php';
				}
			  }
			});
		}
   	});
	$("#shift_q_left").click(function(event){
		self.qcurrent = self.syncAnswers(self.qcurrent)
		var t1 = self.qcurrent
		var t2 = self.qdata[ref.q-1]
		self.qdata[ref.q-1] = t1
		self.qdata[ref.q] = t2
		self.qcurrent = t2
		self.saveAll([ref.pg,ref.pg],"$.getJSON(\"ajax/questions_manager.php?cmd=shift_question&ref="+ref.as_id+"&q="+ref.q+"&d=-1\", function(data) {self.pageObj.switchQuestion("+(ref.q-1)+");})");
		
   	});
	$("#shift_q_right").click(function(event){
		self.qcurrent = self.syncAnswers(self.qcurrent)
		var t1 = self.qcurrent
		var t2 = self.qdata[ref.q+1]
		self.qdata[ref.q+1] = t1
		self.qdata[ref.q] = t2
		self.qcurrent = t2
		self.saveAll([ref.pg,ref.pg],"$.getJSON(\"ajax/questions_manager.php?cmd=shift_question&ref="+ref.as_id+"&q="+ref.q+"&d=1\", function(data) {self.pageObj.switchQuestion("+(ref.q+1)+");})");
		
   	});
	this.switchQuestion = function(pass_data){
		ref.q = pass_data;
		$.getJSON("ajax/questions_manager.php?cmd=switch_question&q="+pass_data, function(data) { 
			//self.drawQuestions(self.qdata);
			window.location='questions.php';
		})
	}
	this.addQuestion = function(){
		$.getJSON("ajax/questions_manager.php?cmd=add_question&ref="+ref.as_id, function(data) {	
			self.qdata=data.questions
			ref.q = self.qdata.length-1
			self.drawQuestions(self.qdata);
		})
	}
	this.getQuestions();
	$("#add_question").click(function(event){
		self.saveAll([ref.pg,ref.pg],"self.pageObj.addQuestion()");
   	});
	//
	// answer stuff
	//
	this.drawAnswers = function(data){
		//data = self.syncAnswers(data)
		var answers = Array();
		var output = "<table class=\"answer_table\">"
		for (var i=0; i < data.answers.length; i++) {
			output+= "<tr><td class=\"l_col\" valign=\"top\"><div class=\"answer_content\"><div class=\"answer_controls\">"+self.getControlInterface("a",i,data.answers.length)+"</div><div class=\"numeral\">"+(i+1)+"</div><div class=\"nic_container\"><textarea name=\"t_"+i+"\" id=\"t_"+i+"\">"+data.answers[i].answer+"</textarea></div></div></td>"
			output+= "<td class=\"r_col\" valign=\"top\">"
			if(data.answers[i].actions.length>0){
				output+= "<div class=\"answer_action\">";
				output+=this.drawActions(data.answers[i].actions,data.answers[i].id);
				output+= "</div>";
			}
			answers.push(data.answers[i].id);
			output+= "</td></tr>"
		}
		output+= "</table>"
		$("#page").html(output)
		$("#answers").val(answers.join(","));
		$(".mini_btn_green").click(function(event){
				self.saveAll([ref.pg,ref.pg],"self.pageObj.addAnswer('"+event.target.id+"')");
		});
		$(".mini_btn_red").click(function(event){
				self.saveAll([ref.pg,ref.pg],"self.pageObj.deleteAnswer('"+event.target.id+"')");
		});
		$(".mini_btn_green_a").click(function(event){
				self.saveAll([ref.pg,ref.pg],"self.pageObj.addAction('"+event.target.id+"')");
		});
		$(".mini_btn_red_a").click(function(event){
				self.saveAll([ref.pg,ref.pg],"self.pageObj.deleteAction('"+event.target.id+"')");
		});
		$(".mini_btn_blue").click(function(event){
				self.saveAll([ref.pg,ref.pg],"self.pageObj.shiftAnswer('"+event.target.id+"')");
		});
		$(".action_select").change(function(event){
			console.log(".action_select")
				var tmp = this.id.split("_");
				self.setActionData(tmp[2],self.action_properties[tmp[3]+"_"+tmp[4]],this.value)
				self.renderActions()
				self.saveAll([ref.pg,ref.pg],null);
		});
		$(".action_vals").blur(function(event){
				console.log(".action_vals")
				var tmp = this.id.split("_");
				self.setActionData(tmp[2],self.action_properties[tmp[3]+"_"+tmp[4]],this.value)
				self.renderActions()
				self.saveAll([ref.pg,ref.pg],null);
			
		});
		$(".black_button").click(function(event){
				self.saveAll([ref.pg,ref.pg],null);
				$.fancybox("<iframe id=\"info_frame\" class=\"dialog\" frameborder=\"0\" src=\"edit_info.php?info_id="+$("#info_box").val()+"&type="+$("#"+this.id.replace("button","select")).val()+"\"></iframe>",{"beforeClose" : function() { self.dialogClose($("#info_frame").contents().find("#info_id").val()); }});
		});
		$(".action_button").click(function(event){
				self.saveAll([ref.pg,ref.pg],null);
				$.fancybox("<iframe class=\"dialog\" frameborder=\"0\" src=\"edit_dialog.php?callback="+event.target.id+"&type="+$("#"+this.id.replace("button","select")).val()+"\"></iframe>",{"beforeClose" : function() { self.dialogClose(null); }});
		});	
		$(".preview_button").click(function(event){
				self.saveAll([ref.pg,ref.pg],null);
				$.fancybox("<iframe class=\"bc_preview\" frameborder=\"0\" src=\"video_preview.php?id="+$("#"+this.id.replace("preview","value")).val()+"\"></iframe>",{"beforeClose" : function() { self.dialogClose(null); }});
		});
		self.renderActions()
	}
	this.dialogClose = function(tmp){
		
		$.getJSON("ajax/questions_manager.php?cmd=list_questions&ref="+ref.as_id, function(data) {	
			self.qdata=data.questions
			self.variables = data.variables
			self.links = data.links
			self.results = data.results
			self.infoboxes = data.infoboxes
			self.drawQuestions(self.qdata);
			if(tmp != null){
				$("#info_box").val(tmp);
			}
		})
	}
	this.syncAnswers = function(data){
		for (var i=0; i < data.answers.length; i++) {
			if($("#t_"+i).val() != null){
				data.answers[i].answer = $("#t_"+i).val()
			}
		}
		for(var i = 1;i<=5;i++){
			self.qcurrent['q_select_'+i] = $("#q_select_"+i).val()
		}
		self.qcurrent.info_box =  $("#info_box").val()
		self.qcurrent.info_box_position =  $("#info_box_position").val()
		self.qcurrent.question_type =  $("#question_type").val()
		self.qcurrent.question_body = nicEditors.findEditor('question_body').getContent()
		return data
	}
	this.getControlInterface = function(n,i,l){
		var output = "";
		output+="<input type=\"button\" name=\""+n+"_add_"+i+"\" id=\""+n+"_add_"+i+"\" value=\"+\" class=\"mini_btn_green\" />";
		if(l>1){
			output+="<input type=\"button\" name=\""+n+"_delete_"+i+"\" id=\""+n+"_delete_"+i+"\" value=\"-\" class=\"mini_btn_red\" />";
		}
		output+="<br>";
		if(i<(l-1)){
			output+="<input type=\"button\" name=\""+n+"_dn_"+i+"\" id=\""+n+"_dn_"+i+"\" value=\"▼\" class=\"mini_btn_blue\" />";
		}
		if(i>0){
			output+="<input type=\"button\" name=\""+n+"_up_"+i+"\" id=\""+n+"_up_"+i+"\" value=\"▲\" class=\"mini_btn_blue\" />";
		}
		return output;
	
	}
	this.deleteAnswer = function(data){	
		var tmp = data.split("_");
		$.getJSON("ajax/answer_manager.php?cmd=delete_answer&ref="+ref.as_id+"&q="+self.qcurrent.id+"&a="+self.qcurrent.answers[tmp[2]].id, function(data) {		
			self.qcurrent.answers = data;
			self.qdata[ref.q].answers = data
			self.drawAnswers(self.qcurrent)
		})
	}
	this.shiftAnswer = function(data){
		var tmp = data.split("_");
		$.getJSON("ajax/answer_manager.php?cmd=shift_answer&ref="+ref.as_id+"&q="+self.qcurrent.id+"&a="+self.qcurrent.answers[tmp[2]].id+"&d="+data, function(data) {		
			self.qcurrent.answers = data;
			self.qdata[ref.q].answers = data
			self.drawAnswers(self.qcurrent)
		})
	}
	this.addAnswer = function(data){
		var tmp = data.split("_");
		$.getJSON("ajax/answer_manager.php?cmd=add_answer&ref="+ref.as_id+"&q="+self.qcurrent.id+"&a="+self.qcurrent.answers[tmp[2]].id, function(data) {	
			self.qcurrent.answers = data;
			self.qdata[ref.q].answers = data
			self.drawAnswers(self.qcurrent)
		})
	}
	//
	// action stuff
	//
	this.drawActions = function(data,answer_id){
		var output = "";
		for (var i=0; i < data.length; i++) {
			output+="<div>";
			output+="<input type=\"button\" name=\""+i+"_"+answer_id+"_"+data[i].id+"_add_action\" id=\""+i+"_"+answer_id+"_"+data[i].id+"_add_action\" value=\"+\" class=\"mini_btn_green_a\" />";
			if(data.length > 1){
				output+="<input type=\"button\" name=\""+i+"_"+answer_id+"_"+data[i].id+"_delete_action\" id=\""+i+"_"+answer_id+"_"+data[i].id+"_delete_action\" value=\"-\" class=\"mini_btn_red_a\" />";
			}
			output+="<select class=\"action_select\" name = \""+data[i].id+"_select_1\" id = \""+i+"_"+answer_id+"_"+data[i].id+"_select_1\"></select>"
			output+="<select class=\"action_select\" name = \""+data[i].id+"_select_2\" id = \""+i+"_"+answer_id+"_"+data[i].id+"_select_2\"></select>"
			output+="<select class=\"action_select\" name = \""+data[i].id+"_select_3\" id = \""+i+"_"+answer_id+"_"+data[i].id+"_select_3\"></select>"
			output+="<select class=\"action_select\" name = \""+data[i].id+"_select_4\" id = \""+i+"_"+answer_id+"_"+data[i].id+"_select_4\"></select>"
			output+="<input class=\"action_vals\" type=\"text\" name = \""+data[i].id+"_value_1\" id = \""+i+"_"+answer_id+"_"+data[i].id+"_value_1\">"
			output+="<input class=\"action_button\" value=\"\" type=\"button\" name = \""+data[i].id+"_button_1\" id = \""+i+"_"+answer_id+"_"+data[i].id+"_button_1\">"
			output+="<input class=\"preview_button\" value=\"\" type=\"button\" name = \""+data[i].id+"_preview_1\" id = \""+i+"_"+answer_id+"_"+data[i].id+"_preview_1\">"
			output+="</div>";
		}
		return output;
	}
	this.renderActions = function(){
		var select_elements = $(".action_select");
		var value_elements = $(".action_vals");
		var button_elements = $(".action_button");
		var preview_elements = $(".preview_button");
		var variable_type = ""
		var last_s3_selector
		
		for (var i=0; i < select_elements.length; i++) {
			var tmp = select_elements[i].id.split("_");
			select_elements[i].options.length = 0
			var data = self.getActionData(tmp);
			select_elements[i].style.visibility = 'hidden'
			select_elements[i].style.position = 'absolute'
			switch(tmp[4]){
				case "1":
				// type
					select_elements[i].style.visibility = 'visible'
					select_elements[i].style.position = 'relative'
					for (var j=0; j < self.select_1_arr.length; j++) {
						if(data.type == self.select_1_arr[j]){	
							select_elements[i].options[j] = new Option(self.select_1_arr[j], self.select_1_arr[j], false, true);
						}else{
							select_elements[i].options[j] = new Option(self.select_1_arr[j], self.select_1_arr[j], false, false);
						}
					}
				break;
				case "2":
					// sub type
					if(data.type == "set variable"){
						if(data.sub_type == null || data.sub_type == ''){
							self.setActionData(data.id,'sub_type',self.variables[0].name)
						}
						select_elements[i].style.visibility = 'visible'
						select_elements[i].style.position = 'relative'
						variable_type = self.variables[0].name
						for (var j=0; j < self.variables.length; j++) {
							if(data.sub_type == self.variables[j].name){	
								select_elements[i].options[j] = new Option(self.variables[j].name, self.variables[j].name, false, true);
								variable_type = self.variables[j].name
							}else{
								select_elements[i].options[j] = new Option(self.variables[j].name, self.variables[j].name, false, false);
							}
						}
					}
				break;
				case "3":
					// operator
					last_s3_selector = select_elements[i]
					
					var opts = self.select_3_arr
					if(data.type == "set variable"){
						
						if(data.operator == null || data.operator == ''){
							self.setActionData(data.id,'operator',self.select_3_arr[0])
						}
						select_elements[i].style.visibility = 'visible'
						select_elements[i].style.position = 'relative'
						if(data.sub_type.indexOf(":number")>-1){
							opts = ['+','-','=']
						}
						console.log(data)
						console.log(opts)
						for (var j=0; j < opts.length; j++) {
							if(data.operator == opts[j]){	
								select_elements[i].options[j] = new Option(opts[j], opts[j], false, true);
							}else{
								select_elements[i].options[j] = new Option(opts[j], opts[j], false, false);
							}
						}
					}
					if(data.type == "points"){
						if(data.operator == null || data.operator == ''){
							self.setActionData(data.id,'operator',self.select_5_arr[0])
						}
						select_elements[i].style.visibility = 'visible'
						select_elements[i].style.position = 'relative'
						for (var j=0; j < self.select_5_arr.length; j++) {
							if(data.operator == self.select_5_arr[j]){	
								select_elements[i].options[j] = new Option(self.select_5_arr[j], self.select_5_arr[j], false, true);
							}else{
								select_elements[i].options[j] = new Option(self.select_5_arr[j], self.select_5_arr[j], false, false);
							}
						}
					}
				break;
				case "4":
					// value
					if(data.type == "result" && self.results.length>0){
						if(data.value == null || data.value == ''){
							self.setActionData(data.id,'value', self.results[0].id)
						}
						select_elements[i].style.visibility = 'visible'
						select_elements[i].style.position = 'relative'
						for (var j=0; j < self.results.length; j++) {
							if(data.value == self.results[j].id){	
								select_elements[i].options[j] = new Option(self.results[j].title, self.results[j].id, false, true);
							}else{
								select_elements[i].options[j] = new Option(self.results[j].title, self.results[j].id, false, false);
							}
						}
					}
					if(data.type == "link" && self.links.length>0){
						if(data.value == null || data.value == ''){
							self.setActionData(data.id,'value', self.links[0].id)
						}
						select_elements[i].style.visibility = 'visible'
						select_elements[i].style.position = 'relative'
						for (var j=0; j < self.links.length; j++) {
							if(data.value == self.links[j].id){	
								select_elements[i].options[j] = new Option(self.links[j].link_copy, self.links[j].id, false, true);
							}else{
								select_elements[i].options[j] = new Option(self.links[j].link_copy, self.links[j].id, false, false);
							}
						}
					}
					if(data.type == "quiz" && root.quiz == 1){
						select_elements[i].style.visibility = 'visible'
						select_elements[i].style.position = 'relative'
						var opts = Array(0,1)
						var opts_vals = Array('incorrect','correct')
						for (var j=0; j < opts.length; j++) {
							if(data.value == opts[j]){	
								select_elements[i].options[j] = new Option(opts_vals[opts[j]], opts[j], false, true);
							}else{
								select_elements[i].options[j] = new Option(opts_vals[opts[j]], opts[j], false, false);
							}
						}
					}
					if(data.type == "set variable" && self.variables.length>0){
						for (var j=0; j < self.variables.length; j++) {
							if(self.variables[j].name == variable_type){
								var vals = self.variables[j].vals.split("|")
								if(data.value == null || data.value == ''){
									self.setActionData(data.id,'value', vals[0])
								}
								select_elements[i].style.visibility = 'visible'
								select_elements[i].style.position = 'relative'
								for (var k=0; k < vals.length; k++) {
									if(data.sub_type.indexOf(":number")>0){
										//last_s3_selector.options[0] = new Option("+", "+", false, true);
										//last_s3_selector.options[1] = new Option("-", "-", false, true);
										//last_s3_selector.options[2] = new Option("=", "=", false, true);
										select_elements[i].style.visibility = 'hidden'
									}else{
										if(data.value == vals[k]){	
											select_elements[i].options[k] = new Option( vals[k],  vals[k], false, true);
										}else{
											select_elements[i].options[k] = new Option( vals[k],  vals[k], false, false);
										}
									}
								}
								break;
							}
						}
					}
				break;
			}
		}
		
		for (var i=0; i < value_elements.length; i++) {
			var tmp = value_elements[i].id.split("_");
			var data = self.getActionData(tmp);
			value_elements[i].value = ""
			value_elements[i].style.visibility = 'hidden'
			value_elements[i].style.position = 'absolute'
			value_elements[i].style.marginLeft = '3px'
			value_elements[i].style.width = '200px'
			switch(tmp[4]){
				case "1":
					if(data.type == "points" || data.type == "video"){
						value_elements[i].style.visibility = 'visible'
						value_elements[i].style.position = 'relative'
						value_elements[i].value = data.value
					}
					
					if(data.type == "set variable"){
						if(data.sub_type.indexOf(":number")>0){
							value_elements[i].style.visibility = 'visible'
							value_elements[i].style.position = 'relative'
							value_elements[i].style.marginLeft = '-25px'
							value_elements[i].style.width = '30px'
							if(isNaN(data.value)){
								value_elements[i].value = 1;
							}else{
								value_elements[i].value = data.value;
							}
							
						}else{
							value_elements[i].style.visibility = 'hidden'
							value_elements[i].style.position = 'absolute'
						}	
					}
				break;
			}
		}
		for (var i=0; i < button_elements.length; i++) {
			var tmp = button_elements[i].id.split("_");
			var data = self.getActionData(tmp);
			button_elements[i].value = ""
			button_elements[i].style.visibility = 'hidden'
			button_elements[i].style.position = 'absolute'
			switch(tmp[4]){
				case "1":
					if(data.type == "link" || data.type == "result" || data.type == "set variable" || data.type == "video"){	
						button_elements[i].style.visibility = 'visible'
						button_elements[i].style.position = 'relative'
						button_elements[i].value = "▶"
					}
				break;
			}
		}
		for (var i=0; i < preview_elements.length; i++) {
			var tmp = preview_elements[i].id.split("_");
			var data = self.getActionData(tmp);
			preview_elements[i].value = ""
			preview_elements[i].style.visibility = 'hidden'
			preview_elements[i].style.position = 'absolute'
			switch(tmp[4]){
				case "1":
					if(data.type == "video"){	
						preview_elements[i].style.visibility = 'visible'
						preview_elements[i].style.position = 'relative'
						preview_elements[i].value = "Preview"
					}
				break;
			}
		}
	}
	this.addAction = function(data){
		$.getJSON("ajax/answer_manager.php?cmd=add_action&ref="+ref.as_id+"&q="+self.qcurrent.id+"&a="+data, function(data) {	
			self.qcurrent.answers = data;
			self.qdata[ref.q].answers = data
			self.drawAnswers(self.qcurrent)
		})
	}
	this.deleteAction = function(data){
		$.getJSON("ajax/answer_manager.php?cmd=delete_action&ref="+ref.as_id+"&q="+self.qcurrent.id+"&a="+data, function(data) {	
			self.qcurrent.answers = data;
			self.qdata[ref.q].answers = data
			self.drawAnswers(self.qcurrent)
		})
	}
	this.getActionData = function(data){
		var output = null
		for (var i=0; i < self.qcurrent.answers.length; i++){
			if(self.qcurrent.answers[i].id == data[1]){
				for (var j=0; j < self.qcurrent.answers[i].actions.length; j++){
					if(self.qcurrent.answers[i].actions[j].id == data[2]){
						output = self.qcurrent.answers[i].actions[j]
						break;
					}
				}
				
			}
		}
		return output;
	}
	this.setActionData = function(id,property,val){
		//console.log(id+" "+property+" "+val)
		for (var i=0; i < self.qcurrent.answers.length; i++){
			for (var j=0; j < self.qcurrent.answers[i].actions.length; j++){
				if(self.qcurrent.answers[i].actions[j].id == id){
					self.qcurrent.answers[i].actions[j][property] = val
					if(property == 'type'){
						self.qcurrent.answers[i].actions[j].operator = '';
						self.qcurrent.answers[i].actions[j].sub_type = '';
						self.qcurrent.answers[i].actions[j].value = '';
					}
					//console.log(JSON.stringify(self.qcurrent.answers[i].actions[j]))
					break;
				}
			}
		}
	}
}