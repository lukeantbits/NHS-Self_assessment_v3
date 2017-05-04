function resultsPage(root){
	
	var self = this
	var ref = root;
	var types = Array('image','text','accumulated results','points triggered result','quiz triggered result','variable triggered result','quiz results','progress bar')
	this.result_data = null;
	$('#edit_links').on('click',function(){
		$.fancybox("<iframe id=\"info_frame\" class=\"dialog\" frameborder=\"0\" src=\"edit_dialog.php?type=link\"></iframe>");
	})
	$('#edit_results').on('click',function(){
		$.fancybox("<iframe id=\"info_frame\" class=\"dialog\" frameborder=\"0\" src=\"edit_dialog.php?type=result\"></iframe>");
	})
	$('#edit_info').on('click',function(){
		$.fancybox("<iframe id=\"info_frame\" class=\"dialog\" frameborder=\"0\" src=\"edit_info.php?type=result\"></iframe>");
	})
	$('#edit_vars').on('click',function(){
		$.fancybox("<iframe id=\"info_frame\" class=\"dialog\" frameborder=\"0\" src=\"edit_dialog.php?type=set variable\"></iframe>");
	})
	this.saveAll = function(data,callback){
		app.saveAll(data,callback);
	}
	this.getResults = function(){
		$.getJSON("ajax/results_manager.php?cmd=list&as_id="+(ref.as_id), function(data) { 
			self.result_data = self.decodeJSON(data.results)
			self.params = data.params[0];
			if(self.params.vars == ""){
				self.params.vars = Array();
			}else{
				self.params.vars = self.params.vars.split(',')
			}
			self.params.vars.push('Points')
			if(root.quiz){
				self.params.vars.push('Quiz')
			}
			self.drawResults();
		}); 
	}
	this.getResults();
	this.saveAll = function(data,callback){
		app.saveAll(data,callback);
	}
	this.drawResults = function(){
		$("#page").html("");
		var output = ""
		for (var i=0; i < self.result_data.length; i++) {
			$("#page").append("<div class=\"answer_content\" id = \"r_"+self.result_data[i].id+"\"></div>");
			self.drawResultItem(self.result_data[i],i,self.result_data.length)
		}
		self.setEvents()
		
	}
	this.decodeJSON = function(data){
		for(var i = 0;i<data.length;i++){
			//alert(decodeURIComponent((data[i].body+'').replace(/\+/g, '%20')))
			data[i].body = decodeURIComponent((data[i].body+'').replace(/\+/g, '%20'))
			
		}
		return data;
		
	}
	this.setEvents = function(){
		$(".mini_btn_green").click(function(event){
			self.saveAll([ref.pg,ref.pg],"self.pageObj.addResult('"+event.target.id+"')");
		});
		$(".mini_btn_red").click(function(event){
			self.saveAll([ref.pg,ref.pg],"self.pageObj.deleteResult('"+event.target.id+"')");
		});
		$(".mini_btn_blue").click(function(event){
			self.saveAll([ref.pg,ref.pg],"self.pageObj.shiftResult('"+event.target.id+"')");
		});
	}
	this.setResultType = function(id,value){
		tmp = id.split("_")
		for (var i=0; i < self.result_data.length; i++) {
			if(self.result_data[i].id == tmp[1]){
				self.result_data[i].type = value
				switch(value){
					case 'points triggered result':
						self.result_data[i].p1 = '';
						self.result_data[i].p2 = '';
					break;
					case 'quiz triggered result':
						self.result_data[i].p1 = '';
						self.result_data[i].p2 = '';
					break;
					case 'variable triggered result':
						self.result_data[i].p1 = '';
						self.result_data[i].p2 = '';
					break;
					case 'accumulated results':
						self.result_data[i].p1 = '';
					break;
					case 'quiz results':
						self.result_data[i].p1 = '';
					break;
					case 'progress bar':
						self.result_data[i].p1 = 0;
						self.result_data[i].p2 = self.params['maxpoints'];
					break;
				}
				self.drawResultItem(self.result_data[i],i,self.result_data.length)
			}
		}
		self.saveAll([ref.pg,ref.pg],null);
		self.setEvents()
		//
	}
	this.drawResultItem = function(data,id,l){
		var output = "";
		output+= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:96%;\"><tr>";
		output+= "<tr><td><b>Item type:</b>&nbsp;&nbsp;&nbsp;<select class=\"result_select\" id = \"rt_"+data.id+"\"  name = \"rt_"+data.id+"\">"
		for(var i = 0;i<types.length;i++){
			if(types[i] == data.type){
				output+= "<option selected = \"selected\" value = \""+types[i]+"\">"+types[i]+"</option>";
			}else{
				output+= "<option value = \""+types[i]+"\">"+types[i]+"</option>";
			}
		}
		output+= "</select></td><td align=\"right\">"+self.getControlInterface(data.id,id,l)+"</td></tr>";
		var container = $("#r_"+data.id)
		switch(data.type){
			case 'image':
				if(data.body == ''){
					output += "<td  colspan = \"2\"><img id=\"img_"+data.id+"\" src=\"\" style=\"display:none;\" />"
				}else{
					output += "<td  colspan = \"2\"><img id=\"img_"+data.id+"\" src=\"archive/as_"+as_id+"/"+data.body+"\" />"
				}
			    output += "<div id = \"uploader_"+data.id+"\"></div><textarea style=\"visibility:hidden;height:1px;\" id = \"t_"+data.id+"\" name = \"t_"+data.id+"\">"+data.body+"</textarea><b>alt description:</b><br><textarea id = \"p1_"+data.id+"\" name = \"p1_"+data.id+"\" style=\"height:30px;width:290px;margin-top:10px;\"></textarea>"+data.p1+"</td>";
				output+="</tr></table>"
				container.html(output)
				
				uploader = new qq.FileUploader({
					element: document.getElementById("uploader_"+data.id),
					action: 'uploads.php',
					filename: 'results_'+data.id,
					onComplete: function(id, fileName, responseJSON){
						$("#t_"+data.id).val(fileName);
						$("#img_"+data.id).css("visibility", "visible");
						$("#img_"+data.id).attr("src", "archive/as_"+as_id+"/"+fileName).show();
						self.saveAll([self.pg,self.pg],null);	
					}
				});
			break;
			case 'text':
			    output += "<td  colspan = \"2\" ><div  class=\"nic_bg\"><textarea style=\"width:100%;\" id = \"t_"+data.id+"\" name = \"t_"+data.id+"\">"+data.body+"</textarea></div></td>";
				output+="</tr></table>"
				container.html(output)
				new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','fontFormat','removeformat','xhtml']}).panelInstance("t_"+data.id);
			break;
			case 'accumulated results':
			    output += "<td style=\"width:100%;\" colspan = \"2\" ><b>Accumulated results displayed as a bulleted list.<br>You may optionally limit the maximum number of results to: <input id = \"p1_"+data.id+"\" name = \"p1_"+data.id+"\" type=\"text\" style=\"width:20px;\" value = \""+data.p1+"\"></b></td>";
				output+="</tr></table>"
				container.html(output)
				
			break;
			case 'quiz results':
			    output += "<td style=\"width:100%;\" colspan = \"2\" ><b>Quiz answers displayed as a list with each answer marked as correct or incorrect.</td>";
				output+="</tr></table>"
				container.html(output)
				
			break;
			case 'points triggered result':
			    output += "<tr><td colspan=\"2\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;\"><tr><td style=\"width:65px;\" valign = \"top\"><b>body&nbsp;text:</b></td>";
				output += "<td><div class=\"nic_bg\"><textarea id = \"t_"+data.id+"\" name = \"t_"+data.id+"\">"+data.body+"</textarea></td>";
				output += "<tr/><tr>";
				output += "<td colspan=\"2\"><b>display when score is greater than or equal to:&nbsp;</b>";
				output += "<input id = \"p1_"+data.id+"\" name = \"p1_"+data.id+"\" type=\"text\" style=\"width:50px;\" value = \""+data.p1+"\">";
				
				output += "&nbsp;<b>and less than:</b>&nbsp";
				output += "<input id = \"p2_"+data.id+"\" name = \"p2_"+data.id+"\" type=\"text\" style=\"width:50px;\" value = \""+data.p2+"\"></td>";
				output+="</tr></table></td></tr></table>"
				container.html(output)
				new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','fontFormat','removeformat','xhtml']}).panelInstance("t_"+data.id);
			break;
			case 'quiz triggered result':
			    output += "<tr><td colspan=\"2\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;\"><tr><td style=\"width:65px;\" valign = \"top\"><b>body&nbsp;text:</b></td>";
				output += "<td><div class=\"nic_bg\"><textarea id = \"t_"+data.id+"\" name = \"t_"+data.id+"\">"+data.body+"</textarea></td>";
				output += "<tr/><tr>";
				output += "<td colspan=\"2\"><b>display when score is greater than or equal to:&nbsp;</b>";
				output += "<input id = \"p1_"+data.id+"\" name = \"p1_"+data.id+"\" type=\"text\" style=\"width:50px;\" value = \""+data.p1+"\">";
				
				output += "&nbsp;<b>and less than:</b>&nbsp";
				output += "<input id = \"p2_"+data.id+"\" name = \"p2_"+data.id+"\" type=\"text\" style=\"width:50px;\" value = \""+data.p2+"\"></td>";
				output+="</tr></table></td></tr></table>"
				container.html(output)
				new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','fontFormat','removeformat','xhtml']}).panelInstance("t_"+data.id);
			break;
			case 'variable triggered result':
			    output += "<tr><td colspan=\"2\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;\"><tr><td style=\"width:65px;\" valign = \"top\"><b>body&nbsp;text:</b></td>";
				output += "<td><div class=\"nic_bg\"><textarea id = \"t_"+data.id+"\" name = \"t_"+data.id+"\">"+data.body+"</textarea></td>";
				output += "<tr/><tr>";
				output += "<td colspan=\"2\"><b>display when ";
				output += this.getNumericVars(data.id,data.p3,false)
				output += " is greater than or equal to:&nbsp;</b>";
				output += "<input id = \"p1_"+data.id+"\" name = \"p1_"+data.id+"\" type=\"text\" style=\"width:50px;\" value = \""+data.p1+"\">";
				
				output += "&nbsp;<b>and less than:</b>&nbsp";
				output += "<input id = \"p2_"+data.id+"\" name = \"p2_"+data.id+"\" type=\"text\" style=\"width:50px;\" value = \""+data.p2+"\"></td>";
				output+="</tr></table></td></tr></table>"
				container.html(output)
				new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','fontFormat','removeformat','xhtml']}).panelInstance("t_"+data.id);
			break;
			case 'progress bar':
			    output += "<tr><td colspan=\"2\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;\"><tr><td style=\"width:65px;\"><b>caption:</b></td>";
				output += "<td><input id = \"t_"+data.id+"\" name = \"t_"+data.id+"\" type=\"text\" style=\"width:100%;\" value = \""+data.body+"\"></td>";
				output += "<tr/><tr>";
				output += "<td><b>lower limit:</b></td>";
				output += "<td><input id = \"p1_"+data.id+"\" name = \"p1_"+data.id+"\" type=\"text\" style=\"width:50px;\" value = \""+data.p1+"\">";
				output += "&nbsp;<b>upper limit:</b>&nbsp;";
				output += "<input id = \"p2_"+data.id+"\" name = \"p2_"+data.id+"\" type=\"text\" style=\"width:50px;\" value = \""+data.p2+"\">";
				output += "&nbsp;<b>data source:</b>&nbsp;";
				output += this.getNumericVars(data.id,data.p3,false)
				output+="</tr></table></td></tr></table>"
				container.html(output)
				$('#p3_'+data.id).on('change',function(){self.saveAll([4,4],null)})
			break;
			default:
				container.html(output)
			break;
		}
		$(".result_select").change(function(event){
			self.setResultType(this.id,this.value)
		})
	}
	this.getNumericVars = function(id,val,points){
		var output = "<select id=\"p3_"+id+"\" name=\"p3_"+id+"\">";
		console.log(self)
		var tmp = self.params['vars']
		if(points){
			tmp.reverse();
			tmp.push("Points");
			tmp.reverse();
		}
		for(var i = 0;i<tmp.length;i++){
			//if(tmp[i] != 'Quiz'){
				if(val == tmp[i]){
					output += "<option selected = \"selected\" val=\""+tmp[i]+"\">"+tmp[i]+"</option>";
				}else{
					output += "<option val=\""+tmp[i]+"\">"+tmp[i]+"</option>";
				}
			//}
		}
		output += "</select>";
		return output;
	}
	this.addResult = function(id){
		var ind = id.split('_').pop()
		$.getJSON("ajax/results_manager.php?cmd=add&ind="+ind+"&as_id="+(ref.as_id), function(data) { 
			self.result_data = data.results
			self.drawResults();
		});
	}
	this.deleteResult = function(id){
		var tmp = id.split("_");
		this.result_data.splice(tmp[2],1);
		this.drawResults();
		$.getJSON("ajax/results_manager.php?cmd=delete&as_id="+(ref.as_id)+"&id="+tmp[0], function(data) { 
			self.result_data = self.decodeJSON(data.results)
			self.drawResults();
		});
	}
	this.shiftResult = function(id){
		var tmp = id.split("_");
		var d = 1
		if(tmp[1] == "up"){
			d = -1
		}
		$.getJSON("ajax/results_manager.php?cmd=shift&as_id="+(ref.as_id)+"&d="+d+"&r_ind="+tmp[2], function(data) { 
			self.result_data = self.decodeJSON(data.results)
			self.drawResults();
		});
	}
	this.getControlInterface = function(n,i,l){
		var output = "";
		output+="<input type=\"button\" name=\""+n+"_add_"+i+"\" id=\""+n+"_add_"+i+"\" value=\"+\" class=\"mini_btn_green\" />";
		if(l>1){
			output+="<input type=\"button\" name=\""+n+"_delete_"+i+"\" id=\""+n+"_delete_"+i+"\" value=\"-\" class=\"mini_btn_red\" />";
		}
		//output+="<br>";
		if(i<(l-1)){
			output+="<input type=\"button\" name=\""+n+"_dn_"+i+"\" id=\""+n+"_dn_"+i+"\" value=\"▼\" class=\"mini_btn_blue\" />";
		}
		if(i>0){
			output+="<input type=\"button\" name=\""+n+"_up_"+i+"\" id=\""+n+"_up_"+i+"\" value=\"▲\" class=\"mini_btn_blue\" />";
		}
		return output;
	
	}
}