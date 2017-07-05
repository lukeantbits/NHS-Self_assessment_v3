function dialogObj(root,$wrap){
	var self = this;
	this.root = root
	this.data = null
	this.$wrap = $wrap;
	var $close
	var $bg = $('<a href = "javascript:;" class = "antbits-SA-dialog_bg"></a>').appendTo($wrap).hide();
	var $inner = $('<div class = "antbits-SA-dialog_inner"><a href = "javascript:;" class = "antbits-SA-dialog_close"></a><h2></h2><div></div></div>').appendTo($wrap).hide();
	var $pane = $inner.find('div');
	$close = $inner.find('.antbits-SA-dialog_close')
	$close.on('click',function(){
		self.die();
	})
	$bg.on('click',function(){
		self.die();
	})
	this.launch = function(data){
		this.data = data;
		$bg.fadeTo(0,0).fadeTo(300,0.7);
		$inner.fadeTo(0,0).fadeTo(300,1);
		$inner.find('h2').html(data.title);
		$inner.find('div').html(data.body+data.body+data.body+data.body);
		if($inner.height() > $wrap.height()-40){
			$inner.height($wrap.height()-40);
			$pane.height($wrap.height()-(80+$inner.find('h2').outerHeight()));
		}
		$inner.css('margin-top',(this.$wrap.outerHeight()-($inner.outerHeight()+10))/2);
		self.$wrap.find('a').attr('tabindex',-1);
		$close.attr('tabindex',null);
		$bg.attr('tabindex',null);
		if(self.root.keynav){
			$close.focus();
		}
		self.resizeLayout();
	
	}
	this.die= function(){
		self.$wrap.find('a').attr('tabindex',null)
		$bg.fadeTo(300,0);
		$inner.fadeTo(300,0,function(){
			$bg.hide();
			$inner.hide();
			$inner.find('h2').html('');
			$inner.find('div').html('');
			if(self.root.keynav){
				self.root.focusActiveQ();
			}
		})
		
	}
	this.resizeLayout = function(){ 
		if($inner.find('video').length>0){
			$($inner.find('.antbits-SA-vid')[0]).height($inner.width()*0.51);
		}
	}
}