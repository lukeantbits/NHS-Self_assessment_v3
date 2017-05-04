function modal(vc){
	var self = this;
	self.__vc = vc
	var $body = $("body")
	var $bg = null
	var $bs = null
	var $bmi_wrapper = $('#bmi_wrapper')
	var $content = null
	this.launch = function(data){
		self.__data = data
		self.__vc.__analytics.advance('InfoBoxLaunch_'+data.title,false)
		var title = ''
		if(data.title != null){
			title = '<h1>'+data.title+'</h1>'
		}
		if(self.__data.fit == 'flush'){
			var output = '<div id="modal_bg"></div><div id = "modal_container"><div id = "modal_close"><a href="javascript:;">close<img src = "images/close_icon.png" border="0"></a></div><div class="modal_inner_flush">'+title+'<p>'+data.body+'</p></div></div>'
		}else{
			var output = '<div id="modal_bg"></div><div id = "modal_container"><div id = "modal_close"><a href="javascript:;">close<img src = "images/close_icon.png" border="0"></a></div><div class="modal_inner">'+title+'<p>'+data.body+'</p></div></div>'
		}
		$body.append(output)
		$bg = $('#modal_bg')
		$content = $('#modal_container')
		if($content.height()>$body.height()*0.8){
			$content.height($body.height()*0.8)
		}
		if(self.__data.w){
			$content.css('width',self.__data.w+'px')
		}
		if(self.__data.h){
			$content.css('height',self.__data.h+'px')
		}
		if(self.__data.fit == 'flush'){
			$content.css('padding',0)
			$content.css('padding-bottom','50px')
			$content.css('margin-left',0-($content.width())/2)
			$content.css('margin-top',0-($content.height())/2)	
			$content.css('overflow','hidden')	
		}else{
			if($.browser.msie && __IE <9){
				$content.css('margin-left',0-($content.width()+36)/2)
				$content.css('margin-top',0-($content.height()+36)/2)
			}else{
				$content.css('margin-left',0-($content.width()+40)/2)
				$content.css('margin-top',0-($content.height()+40)/2)
			}
			
		}
		$bg.fadeTo(300,0.5)
		$content.fadeIn(300)
		$bg.click(function(){self.quit()})
		
		
		
		if(self.__data.callback){
			eval(self.__data.callback)
		}
		$('#modal_close').click(function(){self.quit()})
		self.__vc.lockView()
	}
	this.quit = function(){
		self.__vc.unlockView()
		$bg.fadeOut(300)
		$content.fadeOut(300,function(){
			$bg.remove()
			$content.remove()
			
		})
	}	
}