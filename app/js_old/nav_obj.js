function nav_obj(vc){
	var self = this;
	this.__vc = vc;
	var next = false;
	var checked = false
	// cache those jquery nodes...
	var $nav = $("#nav");
	var $nav_row_1 = $("#nav_row_1");
	var $rdiv = $("#results");
	var $shadow_bottom = $("#shadow_bottom");
	var $nav_buttons = $(".nav_button");
	var $nav_progress_fg = $("#nav_progress_fg");
	var $nav_progress_bg = $("#nav_progress_bg");
	var $nav_fg = $("#nav_fg");
	var $nav_links = $("#nav_links");
	var $nav_finish = $("#nav_finish");
	var $nav_links_a = $("#nav_links>a");
	var $nav_finish_a = $("#nav_finish>a");
	var $nav_next = $("#nav_next");
	var $check_wrap = $("#check_wrap");
	var $nav_check = $("#nav_check");
	var $nav_check_a = $("#nav_check>a");
	var $nav_check_inactive = $("#nav_check_inactive");
	var $nav_next_a = $("#nav_next>a");
	var $nav_next_inactive = $("#nav_next_inactive");
	var $nav_back = $("#nav_back");
	var $nav_back_a = $("#nav_back>a");
	var $nav_back_inactive = $("#nav_back_inactive");
	var $p_wrap = $("#progress_wrap");
	var active = false;
	var stage = "question"
	var spd = 300
	//
	
	vc.setGradient($nav_back_inactive,'cccccc','cccccc');
	vc.setGradient($nav_next_inactive,'cccccc','cccccc');
	vc.setGradient($nav_check_inactive,'cccccc','cccccc');
	vc.setGradient($nav_check,__data.config.colour_1[1],__data.config.colour_1[0]);
	vc.setGradient($nav_progress_fg,__data.config.colour_1[1],__data.config.colour_1[0]);
	vc.setGradient($nav_back,__data.config.colour_1[1],__data.config.colour_1[0]);
	vc.setGradient($nav_next,__data.config.colour_1[1],__data.config.colour_1[0]);
	vc.setGradient($nav_links,__data.config.colour_3[1],__data.config.colour_3[0]);
	vc.setGradient($nav_finish,__data.config.colour_2[1],__data.config.colour_2[0]);
	$nav.css('border-top','2px solid #'+__data.config.colour_1[0])
	
	if(self.__vc.__quiz == 1){
		$nav_check.hide()
		$p_wrap.css('visibility','hidden')
		$nav_back.css('visibility','hidden')
	    $nav_back_inactive.css('visibility','hidden')
		$check_wrap.css('visibility','visible')
	}
	if(!vc.__mobile){
		$nav_back_a.on({
			"mouseover": function() { vc.setGradient($nav_back,vc.Darken(__data.config.colour_1[1],-5),vc.Darken(__data.config.colour_1[0],-10))},
			"mouseout": function() { vc.setGradient($nav_back,__data.config.colour_1[1],__data.config.colour_1[0])},
			"focusin": function() { vc.setGradient($nav_back,vc.Darken(__data.config.colour_1[1],-5),vc.Darken(__data.config.colour_1[0],-10))},
			"focusout": function() { vc.setGradient($nav_back,__data.config.colour_1[1],__data.config.colour_1[0]) }
		});
		$nav_next_a.on({
			"mouseover": function() { vc.setGradient($nav_next,vc.Darken(__data.config.colour_1[1],-5),vc.Darken(__data.config.colour_1[0],-10))},
			"mouseout": function() { vc.setGradient($nav_next,__data.config.colour_1[1],__data.config.colour_1[0])},
			"focusin": function() {vc.setGradient($nav_next,vc.Darken(__data.config.colour_1[1],-5),vc.Darken(__data.config.colour_1[0],-10))},
			"focusout": function() { vc.setGradient($nav_next,__data.config.colour_1[1],__data.config.colour_1[0]) }
		});
		$nav_check_a.on({
			"mouseover": function() { vc.setGradient($nav_check,vc.Darken(__data.config.colour_1[1],-5),vc.Darken(__data.config.colour_1[0],-10))},
			"mouseout": function() { vc.setGradient($nav_check,__data.config.colour_1[1],__data.config.colour_1[0])},
			"focusin": function() { vc.setGradient($nav_check,vc.Darken(__data.config.colour_1[1],-5),vc.Darken(__data.config.colour_1[0],-10))},
			"focusout": function() { vc.setGradient($nav_check,__data.config.colour_1[1],__data.config.colour_1[0]) }
		});
		$nav_links_a.on({
			"mouseover": function() { vc.setGradient($nav_links,vc.Darken(__data.config.colour_3[1],-5),vc.Darken(__data.config.colour_3[0],-10))},
			"mouseout": function() { vc.setGradient($nav_links,__data.config.colour_3[1],__data.config.colour_3[0])},
			"focusin": function() { vc.setGradient($nav_links,vc.Darken(__data.config.colour_3[1],-5),vc.Darken(__data.config.colour_3[0],-10))},
			"focusout": function() { vc.setGradient($nav_links,__data.config.colour_3[1],__data.config.colour_3[0]) }
		});
		$nav_finish_a.on({
			"mouseover": function() { vc.setGradient($nav_finish,vc.Darken(__data.config.colour_2[1],-5),vc.Darken(__data.config.colour_2[0],-10))},
			"mouseout": function() { vc.setGradient($nav_finish,__data.config.colour_2[1],__data.config.colour_2[0])},
			"focusin": function() { vc.setGradient($nav_finish,vc.Darken(__data.config.colour_2[1],-5),vc.Darken(__data.config.colour_2[0],-10))},
			"focusout": function() { vc.setGradient($nav_finish,__data.config.colour_2[1],__data.config.colour_2[0]) }
		});
	}
	

	
	
	$nav_links.fadeOut(0)
	$nav_finish.fadeOut(0)
	$nav_back.fadeTo(0,0)
	$nav_back_a.click(function(){
		self.slide(-1);
	})
	$nav_next.fadeTo(0,0)
	$nav_next_a.click(function(){self.slide(1)})
	$nav_links_a.click(function(){self.slide(1)})
	$nav_finish_a.click(function(){
		self.__vc.resetSA()
	})
	$nav_check.click(function(){self.checkAnswer()})
	this.checkAnswer = function(){
		checked = true
		var id = self.__vc.__quiz_obj.getActive(self.__vc.__page)
		if(self.__vc.__quiz_obj.checkCorrect(id)==2){
			$('#q_correct_'+id).fadeIn(spd,function(){self.checkNav()})
		}else{
			$('#q_incorrect_'+id).fadeIn(spd,function(){self.checkNav()})
		}
		var q_arr = self.__vc.__quiz_obj.__q_obj_arr
		q_arr[q_arr.length-1].__q.lockAnswers()
		$nav_check_a.attr('tabindex',-1)
		if(self.__vc.__tabbing){
			$nav_next_a.focus()
		}
	}
	this.uncheckAnswer = function(){
		checked = false
	}
	this.checkNav = function(){
		var id = self.__vc.__quiz_obj.getActive(self.__vc.__page)
		$nav_back_inactive.attr('tabindex',-1)
		$nav_next_inactive.attr('tabindex',-1)
		var quiz_arr = self.__vc.__quiz_obj.__quiz_arr
		if(self.__vc.__page > 0 && active == false){
			active = true
			$nav.fadeIn().delay(300);
			$shadow_bottom.fadeIn().delay(300);
		}
		if(self.__vc.__page < quiz_arr.length){
			stage = "questions"
			$rdiv.html("");
		}else if(self.__vc.__page == quiz_arr.length){
			stage = "questions"
			$nav_links.fadeOut()	
			$nav_finish.fadeOut()
		}else if(self.__vc.__page == quiz_arr.length+1){
			stage = "results"
			$nav_links.delay(300).fadeIn()
			$nav_finish.fadeOut()
			$nav_next_a.attr('tabindex',-1)
			$nav_back_a.attr('tabindex',null)
			$nav_finish_a.attr('tabindex',-1)
			$nav_links_a.attr('tabindex',null)
			
		}else if(self.__vc.__page == quiz_arr.length+2){
			stage = "links"
			$nav_links.fadeOut()
			$nav_finish.delay(300).fadeIn()
			$nav_next_a.attr('tabindex',-1)
			$nav_back_a.attr('tabindex',null)
			$nav_finish_a.attr('tabindex',null)
			$nav_links_a.attr('tabindex',-1)
		}
		if(self.__vc.__page <= 1){
			$nav_back.fadeTo(spd,0)
			$nav_back_a.attr('tabindex',-1)
		}else{
			$nav_back.fadeTo(spd,1)
			$nav_back_a.attr('tabindex',null)
		}
		
		if(stage == "questions"){
			$nav_next.css("visibility","visible")
			$nav_next_inactive.css("visibility","visible")
			$nav_progress_bg.fadeIn()
			$nav_progress_fg.fadeIn()
			$nav_next_inactive.fadeTo(spd,1)
			if(self.__vc.__page > quiz_arr.length || self.__vc.__quiz_obj.answered() == false){
				$nav_next.fadeTo(spd,0)
				$nav_next_a.attr('tabindex',-1)
				$nav_check.fadeTo(spd,0)
				$nav_check.attr('tabindex',-1)
				next = false
			}else{
				if(self.__vc.__quiz == 0 || self.__vc.__quiz_obj.isQuiz(id) == false){
					$nav_next.fadeTo(spd,1)
					$nav_next_a.attr('tabindex',null)
					$nav_check.fadeTo(spd,0)
					$nav_check.attr('tabindex',-1)
					next = true
				}else{
					if(checked){
						$nav_next.fadeTo(spd,1)
						$nav_next_a.attr('tabindex',null)
						$nav_check.fadeTo(spd,0)
						$nav_check.attr('tabindex',-1)
						next = true
					}else{
						$nav_next.fadeTo(spd,0)
						$nav_next_a.attr('tabindex',-1)
						$nav_check.fadeTo(spd,1)
						$nav_check.attr('tabindex',null)
						next = false
					}
				}
			}
		}else{
			next = true
			$nav_progress_bg.fadeOut()
			$nav_progress_fg.fadeOut()
			$nav_next_inactive.fadeTo(spd,0)
			$nav_next.fadeTo(spd,0,null,function(){
				$nav_next.css("visibility","hidden")
				$nav_next_inactive.css("visibility","hidden")
			})
		}
		
		var p = Math.min(100,(self.__vc.__page/self.__vc.__quiz_obj.__quiz_arr.length)*100)
		if(self.__vc.__quiz == 0){
			$nav_progress_fg.animate({width: p+'%'},500)
		}else{
			
			if(self.__vc.__quiz_obj.isQuiz(id) && stage == "questions"){
				$nav_check.show()
				$nav_check_inactive.show()
				$check_wrap.show()
			}else{
				$nav_check.hide()
				$nav_check_inactive.hide()
				
			}
		}
		if((self.__vc.__preview != null && self.__vc.__preview != "")){
			$nav_next.css('visibility','hidden')
			$nav_back.css('visibility','hidden')
			$nav_links.unbind('click')
			$nav_finish.unbind('click')
		}
		self.resizeLayout()
	}
	this.slide = function(d){
		if(d == -1 && self.__vc.__page > 1){
			self.__vc.slidePrev()
		}
		if(d == 1 && next == true){
			self.__vc.slideNext()
			checked = false
			$nav_check_a.attr('tabindex',null)
		}
		
	}
	this.resizeLayout = function(){
		var nh = self.__vc.__padding+$nav_row_1.height()
		$nav.height($nav_row_1.height());
		$shadow_bottom.css("bottom",nh);
		if(__IE <= 7){
			$p_wrap.css("margin-left",$nav_next.width()*1.2)
			$p_wrap.css("margin-right",$nav_next.width()*1.2)
		}else{
			$p_wrap.css("margin-left",$nav_next.width()*1.25)
			$p_wrap.css("margin-right",$nav_next.width()*1.25)
		}
		
		$p_wrap.css("margin-top",($nav.height()-$p_wrap.height())*0.5)
		$p_wrap.css("margin-bottom",($nav.height()-$p_wrap.height())*0.5)
	}
}