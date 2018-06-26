function linksPage(root){
	
	var self = this
	var ref = root;
	var types = Array('text','accumulated links','accumulated videos','obligatory link','obligatory video')
	this.link_data = null;
	this.link_list = null;
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
	this.dialogClose = function(tmp){
		//alert('dialogClose')
		$.getJSON("ajax/links_manager.php?cmd=list&as_id="+ref.as_id, function(data) {	
			self.link_data = data.links
			self.link_list = data.link_list
			self.params = data.params[0];
			self.drawlinks();
			if(tmp != null){
				alert(tmp)
				//$("#info_box").val(tmp);
			}
		})
	}
	this.getlinks = function(){
		$.getJSON("ajax/links_manager.php?cmd=list&as_id="+(ref.as_id), function(data) { 
			self.link_data = data.links
			self.link_list = data.link_list
			self.params = data.params[0];
			self.drawlinks();
		}); 
	}
	this.getlinks();
	this.saveAll = function(data,callback){
		app.saveAll(data,callback);
	}
	this.addBC = function(id,callback){
		//alert(callback)
		for(var i = 0;i < self.link_data.length ;i++){
			if(self.link_data[i].id == callback){
				self.link_data[i]['body']=id
				self.drawlinks();
				//$.fancybox.close();
				self.saveAll([ref.pg,ref.pg],"$.fancybox.close();");
			}
		}
	}
	this.setOl = function(id,callback){
		self.link_data[callback]['body']=id
		self.drawlinks();
		$.fancybox.close();
		self.saveAll([ref.pg,ref.pg],"$.fancybox.close();");
					
	}
	this.drawlinks = function(){
		$("#page").html("");
		var output = ""
		for (var i=0; i < self.link_data.length; i++) {
			$("#page").append("<div class=\"answer_content\" id = \"r_"+self.link_data[i].id+"\"></div>");
			self.drawlinkItem(self.link_data[i],i,self.link_data.length)
		}
		self.setEvents();
		
		
	}
	this.setEvents = function(){
		$(".mini_btn_green").click(function(event){
			self.saveAll([ref.pg,ref.pg],"self.pageObj.addlink('"+event.target.id+"')");
		});
		$(".mini_btn_red").click(function(event){
			self.saveAll([ref.pg,ref.pg],"self.pageObj.deletelink('"+event.target.id+"')");
		});
		$(".mini_btn_blue").click(function(event){
			self.saveAll([ref.pg,ref.pg],"self.pageObj.shiftlink('"+event.target.id+"')");
		});
	}
	this.setlinkType = function(id,value){
		tmp = id.split("_")
		for (var i=0; i < self.link_data.length; i++) {
			if(self.link_data[i].id == tmp[1]){
				self.link_data[i].type = value
				switch(value){
					case 'points triggered link':
						self.link_data[i].p1 = '';
						self.link_data[i].p2 = '';
					break;
					case 'accumulated links':
						self.link_data[i].p1 = '';
					break;
					case 'accumulated videos':
						self.link_data[i].p1 = '';
					break;
					case 'obligatory link':
						self.link_data[i].p1 = '';
					break;
					
				}
				self.drawlinkItem(self.link_data[i],i,self.link_data.length)
			}
		}
		self.setEvents();
		//
	}
	this.drawlinkItem = function(data,id,l){
		var output = "";
		output+= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;\"><tr>";
		output+= "<tr><td><b>Item type:</b>&nbsp;&nbsp;&nbsp;<select class=\"link_select\" id = \"rt_"+data.id+"\"  name = \"rt_"+data.id+"\">"
		for(var i = 0;i<types.length;i++){
			if(types[i] == data.type){
				output+= "<option selected = \"selected\" value = \""+types[i]+"\">"+types[i]+"</option>";
			}else{
				output+= "<option value = \""+types[i]+"\">"+types[i]+"</option>";
			}
		}
		output+= "</select></td><td align=\"right\" >"+self.getControlInterface(data.id,id,l)+"</td></tr>";
		var container = $("#r_"+data.id)
		switch(data.type){
			case 'text':
			    output += "<td  colspan = \"2\" ><div  class=\"nic_bg\"><textarea style=\"width:100%;\" id = \"t_"+data.id+"\" name = \"t_"+data.id+"\">"+data.body+"</textarea></div></td>";
				output+="</tr></table>"
				container.html(output)
				new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','fontFormat','removeformat','xhtml']}).panelInstance("t_"+data.id);
			break;
			case 'accumulated links':
			    output += "<td style=\"width:100%;\" colspan = \"2\" ><b>Accumulated links displayed as a button list.<br>You may optionally limit the maximum number of links to: <input id = \"p1_"+data.id+"\" name = \"p1_"+data.id+"\" type=\"text\" style=\"width:20px;\" value = \""+data.p1+"\"></b></td>";
				output+="</tr></table>"
				container.html(output)
				
			break;
			case 'accumulated videos':
			    output += "<td style=\"width:100%;\" colspan = \"2\" ><b>Accumulated videos displayed as a button list.<br>You may optionally limit the maximum number of videos to: <input id = \"p1_"+data.id+"\" name = \"p1_"+data.id+"\" type=\"text\" style=\"width:20px;\" value = \""+data.p1+"\"></b></td>";
				output+="</tr></table>"
				container.html(output)
				
			break;
			case 'obligatory link':
			     output += "<td style=\"width:100%;\" colspan = \"2\" >"+this.drawLinkSelect(data)+"</td>";
				output+="</tr></table>"
				container.html(output)
				
			break;
			case 'obligatory video':
			    output += "<td style=\"width:100%;\" colspan = \"2\" ><div style=\"margin-top:-33px;margin-left:220px;\">Brightcove ID: <input type=\"text\" id = \"t_"+data.id+"\" name = \"t_"+data.id+"\" value=\""+data.body+"\" /><input class=\"preview_button\" value=\"Preview\" type=\"button\" name = \""+data.id+"_preview_1\" id = \""+data.id+"_0_"+data.id+"_preview_1\"><br></div></td>";
				output+="</tr></table>"
				container.html(output)
			break;
			default:
				container.html(output)
			break;
		}
		$(".link_select").change(function(event){
			self.setlinkType(this.id,this.value)
		})
		$(".black_button").click(function(event){
			var tmp = event.target.id.split("_")
			if(tmp[0] == "bc"){
				self.saveAll([ref.pg,ref.pg],null);
				$.fancybox("<iframe id=\"info_frame\" class=\"dialog\" frameborder=\"0\" src=\"edit_dialog.php?pg=5&callback=0_0_"+tmp[1]+"_t_"+tmp[1]+"&type=video\"></iframe>",{"beforeClose" : function() { self.dialogClose($("#info_frame").contents().find("#info_id").val()); }});
			}
			if(tmp[0] == "l"){
				self.saveAll([ref.pg,ref.pg],null);
				$.fancybox("<iframe id=\"info_frame\" class=\"dialog\" frameborder=\"0\" src=\"edit_dialog.php?pg=5&callback=0_0_"+tmp[1]+"_t_"+tmp[1]+"&type=link\"></iframe>",{"beforeClose" : function() { self.dialogClose($("#info_frame").contents().find("#info_id").val()); }});
			}
		});
		$(".preview_button").click(function(event){
				var tmp = event.target.id.split("_")
				//alert($("#t_"+tmp[0]).val())
				self.saveAll([ref.pg,ref.pg],null);
				$.fancybox("<iframe class=\"bc_preview\" frameborder=\"0\" src=\"video_preview.php?id="+$("#t_"+tmp[0]).val()+"\"></iframe>",{"beforeClose" : function() { self.dialogClose(null); }});
		});
	}
	this.drawLinkSelect = function(data){
		output = "<div style=\"margin-top:-33px;margin-left:220px;\"><b>Link: </b><select id = \"t_"+data.id+"\" style = \"width:310px;\" name = \"t_"+data.id+"\">"
		for (var i=0; i < self.link_list.length; i++) {
			if(self.link_list[i].id == data.body){
				output+= "<option selected=\"selected\" value = \""+self.link_list[i].id+"\">"+self.link_list[i].link_copy+"</option>"
			}else{
				output+= "<option value = \""+self.link_list[i].id+"\">"+self.link_list[i].link_copy+"</option>"
			}
		}
		output += "</select>"
		output += "<input   type=\"button\" name=\"l_"+data.id+"\" id=\"l_"+data.id+"\" value=\"▶\" class=\"black_button\" style=\"left:590px;position:absolute;\"/></div>"
		return output;
	}
	this.drawBCSelect = function(data){
		return "";
	}
	this.addlink = function(id){
		$.getJSON("ajax/links_manager.php?cmd=add&as_id="+(ref.as_id), function(data) { 
			self.link_data = data.links
			self.drawlinks();
		});
	}
	this.deletelink = function(id){
		var tmp = id.split("_");
		this.link_data.splice(tmp[2],1);
		this.drawlinks();
		$.getJSON("ajax/links_manager.php?cmd=delete&as_id="+(ref.as_id)+"&id="+tmp[0], function(data) { 
			self.link_data = data.links
			self.drawlinks();
		});
	}
	this.shiftlink = function(id){
		var tmp = id.split("_");
		var d = 1
		if(tmp[1] == "up"){
			d = -1
		}
		$.getJSON("ajax/links_manager.php?cmd=shift&as_id="+(ref.as_id)+"&d="+d+"&r_ind="+tmp[2], function(data) { 
			self.link_data = data.links
			self.drawlinks();
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