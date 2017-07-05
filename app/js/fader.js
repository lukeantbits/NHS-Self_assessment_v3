function fadeObj($pane){
	var self = this
	self.$pane = $pane
	var $fade_top = $('<div class ="antbits-SA-fade antbits-SA-fade_top" ></div>').appendTo(self.$pane.parent())
	var $fade_bottom = $('<div class ="antbits-SA-fade antbits-SA-fade_bottom" ></div>').appendTo(self.$pane.parent())
	this.setFades = function(){
		var pos =  self.$pane.offset();
		if (self.$pane.height() < (self.$pane[0].scrollHeight-32)) {
			$fade_top.width(self.$pane.innerWidth()-50).css('top',0).show();
			$fade_bottom.width(self.$pane.innerWidth()-50).css('top',self.$pane.height()).show();
		} else {
			$fade_top.hide();
			$fade_bottom.hide();
		}
	}
	
}