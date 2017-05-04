function CMSroot(pg,as_id,q,a,quiz){
	var lock = false;
	// create objects
	var self = this
	this.pg = pg
	this.as_id = as_id
	this.q = q
	this.quiz = quiz
	this.a = a
	this.page_labels = Array("config","splash","questions","results","links");
	switch(pg){
		case 1:
			this.pageObj = new configPage(this);
		break;
		case 2:
			this.pageObj = new splashPage(this);
		break;
		case 3:
			this.pageObj = new questionsPage(this);
		break;
		case 4:
			this.pageObj = new resultsPage(this);
		break;
		case 5:
			this.pageObj = new linksPage(this);
		break;
	}
	this.navObj = new navController(pg,this);
	// set event handlers
	for(var i = 1;i<=5;i++){
		$("#nav_"+i).click([i,pg],function(event){
			self.navObj.switchPage(event.data);
   		});
	}
	$("#new_assessment").click([self.pg,null],function(event){
			self.pageObj.saveAll(event.data,'app.createNewAssessment()');
   	});
	$("#preview").click([self.pg,null],function(event){
			self.pageObj.saveAll(event.data,'app.preview()');
   	});
	$("#delete_assessment").click([self.pg,null],function(event){
			var answer = confirm("Do you really want to delete this assessment?")
			if (answer){
				$.ajax({
				  url: "ajax/assessment_manager.php?pg="+self.pg+"&mode=delete&ref="+self.as_id,
				  context: document.body,
				  success: function(data){
					var filename = (window.location.pathname).replace(/^.*[\\\/]/, '')
					window.location = filename;
				  }
				});
			}
   	});
	$("#save_all").click([self.pg,self.pg],function(event){
			self.pageObj.saveAll(event.data,null);
   	});
	$("#assessment_switcher").change([self.pg,null],function(event){
		self.saveAll([self.pg,self.pg],'self.switchAssessment('+$("#assessment_switcher").val()+')');	
   	});
	this.switchAssessment = function(as_id){
		$.ajax({
		  url: "ajax/assessment_manager.php?pg="+self.pg+"&mode=switch&q=0&a=0&as_id="+as_id,
		  context: document.body,
		  success: function(){
			window.location.reload();
		  }
		});
	}
	// methods
	this.preview = function(){
		$.fancybox("<iframe id=\"info_frame\" class=\"dialog\" frameborder=\"0\" src=\"preview.php?pg="+self.pg+"&q="+this.q+"&as_id="+self.as_id+"\"></iframe>");
	}
	this.createNewAssessment = function(){
		var http = new XMLHttpRequest();
		var url = "ajax/assessment_manager.php";
		var params = "mode=new&pg="+self.pg;
		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.onreadystatechange = function() {
			if(http.readyState == 4 && http.status == 200) {
				window.location.reload();
			}
		}
		http.send(params)
	}
	this.updateSelector = function(id,key,val){
		var targ=document.getElementById(id)
		for (i=0; i<targ.options.length; i++){
			if(targ.options[i].value == key){
				targ.options[i] = new Option(val, key, true, true)
			}
		}
	}
	this.saveAll = function(data,callback){
		if(lock == false){
			lock = true
			var callback = callback
			var obj = document.getElementById("main_form");
			$("#save_all").html("Saving...");
			var http = new XMLHttpRequest();
			var url = "ajax/save_form.php";
			var params = "";
			for(i=0; i<obj.elements.length; i++){
				if(obj.elements[i].type == 'button' || obj.elements[i].type == 'application/x-shockwave-flash'){
					
				}else if(obj.elements[i].type == 'checkbox'){
					params+= obj.elements[i].name + "=" + encodeURIComponent(obj.elements[i].checked)+"&";
				}else if(obj.elements[i].type == 'textarea'){
					var nic = nicEditors.findEditor(obj.elements[i].name)
					if(nic != undefined){
						params+= obj.elements[i].name + "=" + encodeURIComponent(nic.getContent())+"&";
					}else{
						params+= obj.elements[i].name + "=" + encodeURIComponent(obj.elements[i].value)+"&";
					}
				}else{
					params+= obj.elements[i].name + "=" + encodeURIComponent(obj.elements[i].value)+"&";
				}
			}
			params +="as_id="+this.as_id+"&page="+data[1]+"&q="+q;
			http.open("POST", url, true);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.onreadystatechange = function() {
				if(http.readyState == 4 && http.status == 200) {
					$("#save_all").html("Save");
					lock = false;
					if(callback != null){
						eval(callback)
					}
					
				}
			}
			http.send(params)
		}
	}
}