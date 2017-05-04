function configPage(root){
	var self = this
	var ref = root
	self.as_id = as_id
	//new nicEditor({buttonList : ['fontSize','bold','italic','underline','ol','ul','subscript','superscript','link']}).panelInstance('test');
	$("#title").keyup(function(event){
		app.updateSelector("assessment_switcher",self.as_id,document.getElementById('title').value)
   	});
	$("#colour_1").change(function(event){
		$("#colour_1").css("background-color","#"+event.target.value);
	});
	$("#colour_2").change(function(event){
		$("#colour_2").css("background-color","#"+event.target.value);
	});
	$("#colour_3").change(function(event){
		$("#colour_3").css("background-color","#"+event.target.value);
	});
	$("#export_flash").click(function(event){
		ref.saveAll([0,0],"self.pageObj.exportFlash()");
	});
	$("#export_js").click(function(event){
		ref.saveAll([0,0],"self.pageObj.exportJs()");
	});
	this.saveAll = function(data,callback){
		app.saveAll(data,callback);
	}
	this.exportFlash = function(){
		$.getJSON("ajax/export_flash.php?as_id="+(self.as_id), function(data) { 
			window.location = data[0].path;
		}); 
	}
	this.exportJs = function(){
		$.getJSON("ajax/export_js.php?as_id="+(self.as_id), function(data) { 
			window.location = data[0].path;
		}); 
	}
}