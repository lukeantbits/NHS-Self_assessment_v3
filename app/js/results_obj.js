function results_obj(__vc,__quiz_obj){
	this.__vc = __vc;
	this.__quiz_obj = __quiz_obj;
	var self = this
	var $container_inner = $("#container_inner")
	var $rdiv = $("#results")
	var $rdiv_s
	var points = 0
	var quiz_points = 0
	var $ldiv = $("#links")
	var $ldiv_s
	var qlength = 0
	var progress_bars = 0
	var $nav_row_1 = $("#nav_row_1")
	var ignore
	$rdiv.css("display","none")
	$ldiv.css("display","none")
	this.clearResults = function(){
		$rdiv.html('');
		$ldiv.html('');
	}
	this.generateResults = function(){
		self.__quiz_obj.generateResults()
		qlength = self.__quiz_obj.__quiz_arr.length
		points = self.__quiz_obj.__points
		quiz_points = self.__quiz_obj.__quiz_points
		var output = "";
		output+= '<div class = "scroll_pane" id= "rscroll_pane" ><div>'
		//if(!self.__vc.__mobile){
			//output+= '<div class = "scroll_pane" id= "rscroll_pane" ><div>'
		//}else{
			//output+= '<div class = "scroll_pane" id= "rscroll_pane"><div>'
		//}
		ignore = false
		for(var a in __data.results.ri){
			output+=self.renderResult(__data.results.ri[a],true);
		}
		for(var a in __data.results.ri){
			output+=self.renderResult(__data.results.ri[a],false);
		}
		output+='</div></div>'
		$rdiv.html(output);
		$('#rscroll_pane').hide()
		$rdiv.css("left",self.__vc.__width*(qlength+1));
		var $r_progress_fg = $("#results .progress_fg")
		self.__vc.setGradient($r_progress_fg,__data.config.colour_1[1],__data.config.colour_1[0]);
		setTimeout(run,10)
		function run(){
			self.generateLinks()		
		}
	}
	this.generateLinks = function(){
		// now render links
		output= '<div class = "scroll_pane" id= "lscroll_pane" ><div><br>'
		for(var a in __data.links.li){
			output+=self.renderResult(__data.links.li[a],false);
		}
		output+='</div></div>'
		$ldiv.html(output);
		//$('#lscroll_pane').hide()
		$ldiv.css("left",self.__vc.__width*(qlength+2));
		
		
		$("#links .vid_a").click(function(e){	
			var tmp = e.target.id.split("_")
			self.__vc.launchVid(tmp[1])
		})
		$('.link_bullet a').on('click',function(evt){
			self.__vc.__analytics.linkEvt(evt.target.innerText,evt.target.href,evt)
		})
		self.resizeLayout()
	}
	this.resizeLayout = function(){
		
		$rdiv.css("left",self.__vc.__width*(qlength+1));
		$ldiv.css("left",self.__vc.__width*(qlength+2));
		$rdiv_s = $("#rscroll_pane")
		$ldiv_s = $("#lscroll_pane")
		if(self.__vc.__mobile){
			$rdiv.css("padding-top",0)
			$rdiv.css("margin-top",0)
			$rdiv.css("padding-bottom",0)
			$rdiv.css("margin-bottom",0)
			$rdiv.height((self.__vc.__inner_height)-$nav_row_1.height())
			$rdiv.css("padding-right",0)
			$rdiv_s.css("padding-right",self.__vc.__padding)
			$rdiv.width(self.__vc.__inner_width-(self.__vc.__padding*3))
			$ldiv.css("padding-top",0)
			$ldiv.css("margin-top",0)
			$ldiv.css("padding-bottom",0)
			$ldiv.css("margin-bottom",0)
			$ldiv.css("padding-right",0)
			$ldiv_s.css("padding-right",self.__vc.__padding)
			$ldiv.width(self.__vc.__inner_width-(self.__vc.__padding*3))
			$ldiv.height((self.__vc.__inner_height)-$nav_row_1.height())
			new ScrollFix(document.getElementById("rscroll_pane"));
		}else{
			$rdiv.css('padding',0).width(self.__vc.__inner_width).height((self.__vc.__inner_height)-($nav_row_1.height()+4))
			$ldiv.css('padding',0).width(self.__vc.__inner_width).height((self.__vc.__inner_height)-($nav_row_1.height()+4))
			
			//$pages.css("height",Math.floor(self.__inner_height-($nav.height()+3)))
		}		
	}
	this.focusL1  = function(){
		var tmp = $('.link_bullet>a')
		tmp[0].focus()
	}
	this.renderResult = function(data,p){
		
		var output = ''
		switch(data.type){
			case 'image':
				if(p){
					output = '<div class= "results_image"><img src="'+__img_path+data.text+'" alt="'+data.p1+'"></div>'
				}
			break;
			case 'progress bar':
				if(!p){
					points = Math.min(points,data.p2)
					quiz_points = Math.min(quiz_points,self.__vc.__quiz_obj.__quiz_arr.length)
					if(data.p3 == "Points" || data.p3 == ""){
						var percent = (points / Number(data.p2))*100
						var pval = points
					}else if(data.p3 == "Quiz"){
						data.p2 = self.__vc.__quiz_obj.__quiz_arr.length
						var percent = (quiz_points / data.p2)*100
						var pval = quiz_points
					}else{
						var pval = self.__vc.__quiz_obj.__quiz_vars[data.p3]
						var percent = (pval/ Number(data.p2))*100
					}
					output = '<div class= "progress_bar">'+data.text+' <span class="impact" style="color:#'+__data.config.colour_1[0]+';">'+pval+'</span><br><br>'
					
					output += '<div style = "text-align:left;"><div class="progress_bg"></div>'
					output += '<div class = "progress_fg" style="float:left;width:'+percent+'%;"></div>'
					output += '<div class = "progress_captions"><div style="float:left;">'+data.p1+'</div><div style="float:right;">'+data.p2+'</div></div>'
					output += '</div></div>'
				}
				
			break;
			case 'text':
				if(!p){
					output = '<div class = "results_text">'+data.text+'</div>'
				}
			break;
			case 'quiz results':
				if(!p){
					output = '<div class = "results_text">'
					output+= self.__vc.__quiz_obj.__quiz_summary
					output+= '</div>'
				}
			break;
			case 'points triggered result':
				if(!p){
					if(points >= Number(data.p1) &&  points < Number(data.p2)){
						output = '<div class = "results_text">'+data.text+'</div>'
					}
				}
				
			break
			case 'quiz triggered result':
				if(!p){
					if(quiz_points >= Number(data.p1) &&  quiz_points < Number(data.p2)){
						output = '<div class = "results_text">'+data.text+'</div>'
					}
				}
				
			break
			case 'variable triggered result':
				if(!p){
					var pval = self.__vc.__quiz_obj.__quiz_vars[data.p3]
					if(pval >= data.p1 && pval < data.p2){
						output = '<div class = "results_text">'+data.text+'</div>';
					}else{
						output = "";
					}
				}
			break;
			case 'accumulated results':
				var tmp =''
				var c = 0
				if(!p){
					tmp+= '<ul class = "results_text">'
				}
				for(var a in self.__quiz_obj.__result_arr){
					if(__quiz_obj.__result_arr[a] != undefined){
						for(var b in __data.result_items.ri){
							if(parseInt(__data.result_items.ri[b].id) == self.__quiz_obj.__result_arr[a]){
								if(p && __data.result_items.ri[b].priority == "1" && ignore == false){
									output+= '<div class="priority">'+__data.result_items.ri[b].text+'</div>'
									ignore = true
								}
								if(!p && __data.result_items.ri[b].priority != "1"){
									tmp+= '<li>'+__data.result_items.ri[b].text+'</li>'
									c++
								}
								break;
							}
						}
					}
				}
				if(!p){
					tmp+= '</ul>'
				}
				if(c>0){
					output+=tmp
				}
				
			break;
			case 'accumulated links':
				for(var a in self.__quiz_obj.__link_arr){
					if(__quiz_obj.__link_arr[a] != undefined){
						for(var b in __data.link_items.ri){
							if(__data.link_items.ri[b].id == self.__quiz_obj.__link_arr[a]){
								output+= '<div class="link_bullet"><a href="'+__data.link_items.ri[b].url+'"   target = "top"><img src = "images/bullet_mask.png" style="background-color:#'+__data.config.colour_1[0]+';">'+__data.link_items.ri[b].text+'</a></div>'
								break;
							}
						}
					}
				}
				
			break;
			case 'accumulated videos':
				if(__data.videos != ""){
					for(var a in self.__quiz_obj.__vid_arr){
						if(__data.bc_lookup[__quiz_obj.__vid_arr[a]] != undefined){
						output+= '<div class="link_bullet"><a href="javascript:void(0);" class="vid_a" id="vid_'+__quiz_obj.__vid_arr[a]+'" ><img src = "images/vid_mask.png" style="background-color:#'+__data.config.colour_1[0]+';">'+__data.bc_lookup[__quiz_obj.__vid_arr[a]].name+'</a></div>'
						}
					}
				}
			break;
			case 'obligatory link':
				if(__data.links != ""){
					var l = self.__vc.lookUpLink(data.text)
					output+= '<div class="link_bullet"><a href="'+l.url+'"    target = "top"><img src = "images/bullet_mask.png" style="background-color:#'+__data.config.colour_1[0]+';">'+l.text+'</a></div>'
				}
				
			break;
			case 'obligatory video':
				if(__data.videos != ""){
					output+= '<div class="link_bullet"><a href="javascript:void(0);" class="vid_a" id="vid_'+data.text+'" ><img src = "images/vid_mask.png" style="background-color:#'+__data.config.colour_1[0]+';">'+__data.bc_lookup[data.text].name+'</a></div>'
				}
				
			break;
			default:
				if(!p){
					output = '<div class = "results_text">'+data.type+'</div>'
				}
		}
		return output;
	}
}