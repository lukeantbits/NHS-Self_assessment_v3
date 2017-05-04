function splashPage(){
	var self = this;
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
	this.createUploader('file-uploader_alt','splash_alt','intro_graphic_alt');
	this.createUploader('hr_file-uploader_alt','hr_splash_alt','hr_intro_graphic_alt');
	new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','fontFormat','removeformat','xhtml']}).panelInstance('intro_copy');
	new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','fontFormat','removeformat','xhtml']}).panelInstance('intro_copy_alt');
	new nicEditor({buttonList : ['bold','italic','underline','ol','ul','subscript','superscript','link','fontFormat','removeformat','xhtml']}).panelInstance('intro_foot');
	if(swf_path != null){
		self.setFlash(swf_path,"splash_flash")
	}
}