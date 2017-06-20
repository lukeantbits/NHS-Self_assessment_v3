function splashPage(){
	var self = this;
	console.log(as_id)
	var swf_path = null;
	self.pg=2
	this.saveAll = function(data,callback){
		app.saveAll(data,callback);
		
	}
	this.setFlash = function(swf,container){
		var flashvars = {};
		var params = {wmode:"transparent",allowFullScreen:"true"};
		swfobject.embedSWF(
			"swf/swf_container.swf?swf="+swf,
			container,
			"400px",
			"400px",
			"9.0.0",
			"expressInstall.swf",
			flashvars,
			params
		);
	}
	this.createUploader = function (target,fname,imgdiv){
		
		uploader = new qq.FileUploader({
			element: document.getElementById(target),
			action: 'uploads.php',
			filename: fname,
			onComplete: function(id, fileName, responseJSON){
				console.log("archive/as_"+as_id+"/"+fileName)
				$("#"+imgdiv).val(fileName);
				$("#"+fname+"_img").css("visibility", "visible");
				if(fileName.indexOf(".swf")>-1){
					$("#"+fname+"_img").hide()
					$("#"+fname+"_flash").show()
					self.setFlash("archive/as_"+as_id+"/"+fileName)
				}else{
					$("#"+fname+"_img").show()
					$("#"+fname+"_flash").hide()
					$("#"+fname+"_img").attr("src", "archive/as_"+as_id+"/"+fileName);
				}
				self.saveAll([self.pg,self.pg],null);	
			}
		});
	}
	this.createUploader('file-uploader','splash','intro_graphic');
	
	new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','fontFormat','removeformat','xhtml']}).panelInstance('intro_copy');
	new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','fontFormat','removeformat','xhtml']}).panelInstance('intro_foot');
}