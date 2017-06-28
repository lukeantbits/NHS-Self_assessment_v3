function resultsObj($node,quiz,root){
	var self = this
	self.root = root
	self.rs = null;
	self.quiz = quiz
	self.$node = $node
	
	this.populate = function(){
		//console.log('generating results...')
		self.rs = self.quiz.generateResults()
		//console.log(self.rs)
		//console.log(self.root.data.results)
		$node.html('');
		ignore = false
		for(var a in self.root.data.results){
			self.renderResult(self.root.data.results[a],self.rs,true);
		}
		for(var a in self.root.data.results){
			self.renderResult(self.root.data.results[a],self.rs,false);
		}
		self.$node.find('a').css('color','#'+self.root.data.config.colour_1[0])
	}
	this.renderResult = function(data,rs,p){
		console.log('rendering '+data.type)
		console.log(data)
		console.log(rs)
		switch(data.type){
			case 'image':
				if(p){
					$('<div class = "antbits-SA-results_image"><img src="'+self.root.asset_path+'/'+data.text+'" alt="'+data.p1+'"></div>').appendTo(self.$node);
				}
			break;
			case 'progress bar':
				if(!p){
					points = Math.min(rs.points,data.p2)
					quiz_points = Math.min(rs.quiz_points,rs.quiz_arr.length)
					if(data.p3 == "Points" || data.p3 == ""){
						var percent = (points / Number(data.p2))*100
						var pval = points
					}else if(data.p3 == "Quiz"){
						data.p2 = rs.quiz_arr.length
						var percent = (quiz_points / data.p2)*100
						var pval = quiz_points
					}else{
						var pval = rs.quiz_vars[data.p3]
						var percent = (pval/ Number(data.p2))*100
					}
					var output = '<div class= "antbits-SA-results_progress_bar"><div>'+data.text+' <span class="antbits-SA-impact" style="color:#'+self.root.data.config.colour_1[0]+';">'+pval+'</span></div>'
					output += '<div><div class="antbits-SA-results_progress_bg"></div>'
					output += '<div class = "antbits-SA-results_progress_fg" style="width:'+percent+'%;background-color:#'+self.root.data.config.colour_1[0]+';"></div>'
					output += '</div><div class = "antbits-SA-results_progress_captions"><div>'+data.p1+'</div><div>'+data.p2+'</div></div>'
					output += '</div>'
					$(output).appendTo(self.$node);
				}
				
			break;
			case 'text':
				if(!p){
					$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo(self.$node);
				}
			break;
			case 'quiz results':
				if(!p){
					$('<div class = "antbits-SA-results_text">'+rs.quiz_summary+'</div>').appendTo(self.$node);
				}
			break;
			case 'points triggered result':
				if(!p){
					if(rs.points >= Number(data.p1) &&  rs.points < Number(data.p2)){
						$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo(self.$node);
					}
				}
			break
			case 'quiz triggered result':
				if(!p){
					if(quiz_points >= Number(data.p1) &&  quiz_points < Number(data.p2)){
						$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo(self.$node);
					}
				}
				
			break
			case 'variable triggered result':
				if(!p){
					var pval = self.__vc.__quiz_obj.__quiz_vars[data.p3]
					if(pval >= data.p1 && pval < data.p2){
						$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo(self.$node);
					}
				}
			break;
			case 'accumulated results':
				var tmp =''
				var c = 0
				if(!p){
					tmp+= '<ul class = "antbits-SA-results_text">'
				}
				for(var a in rs.result_arr){
					if(rs.result_arr[a] != 'undefined'){
						for(var b in self.root.data.result_items){
							if(parseInt(self.root.data.result_items[b].id) == rs.result_arr[a]){
								if(p && self.root.data.result_items[b].priority == "1" && ignore == false){
									$('<div class = "antbits-SA-results_priority">'+self.root.data.result_items[b].text+'</div>').appendTo(self.$node);
									ignore = true
								}
								if(!p && self.root.data.result_items[b].priority != '1'){
									tmp+= '<li>'+self.root.data.result_items[b].text+'</li>';
									c++;
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
					$(tmp).appendTo(self.$node);
				}
				
			break;
			case 'accumulated links':
				/*
				for(var a in self.__quiz_obj.__link_arr){
					if(__quiz_obj.__link_arr[a] != undefined){
						for(var b in __data.link_items.ri){
							if(__data.link_items.ri[b].id == self.__quiz_obj.__link_arr[a]){
								//output+= '<div class="link_bullet"><a href="'+__data.link_items.ri[b].url+'"   target = "top"><img src = "images/bullet_mask.png" style="background-color:#'+__data.config.colour_1[0]+';">'+__data.link_items.ri[b].text+'</a></div>'
								break;
							}
						}
					}
				}*/
				
			break;
			case 'accumulated videos':
				/*if(__data.videos != ""){
					for(var a in self.__quiz_obj.__vid_arr){
						if(__data.bc_lookup[__quiz_obj.__vid_arr[a]] != undefined){
						//output+= '<div class="link_bullet"><a href="javascript:void(0);" class="vid_a" id="vid_'+__quiz_obj.__vid_arr[a]+'" ><img src = "images/vid_mask.png" style="background-color:#'+__data.config.colour_1[0]+';">'+__data.bc_lookup[__quiz_obj.__vid_arr[a]].name+'</a></div>'
						}
					}
				}*/
			break;
			case 'obligatory link':
			/*
				if(__data.links != ""){
					var l = self.__vc.lookUpLink(data.text)
					//output+= '<div class="link_bullet"><a href="'+l.url+'"    target = "top"><img src = "images/bullet_mask.png" style="background-color:#'+__data.config.colour_1[0]+';">'+l.text+'</a></div>'
				}
				*/
			break;
			case 'obligatory video':
				if(__data.videos != ""){
					//output+= '<div class="link_bullet"><a href="javascript:void(0);" class="vid_a" id="vid_'+data.text+'" ><img src = "images/vid_mask.png" style="background-color:#'+__data.config.colour_1[0]+';">'+__data.bc_lookup[data.text].name+'</a></div>'
				}
				
			break;
			default:
				if(!p){
					$('<div class = "antbits-SA-results_text">'+data.type+'</div>').appendTo(self.$node);
				}
		}
		//return output;
	}
	this.slideIn = function(d){
		if(d == 1){
			self.$node.css('left',self.$node.outerWidth()).show().animate({'left':0},300,function(){	
			});
		}else{
			self.$node.css('left',0-self.$node.outerWidth()).show().animate({'left':0},300,function(){
			});
		}	
	}
	this.slideOut = function(d){
		if(d == 1){
			self.$node.animate({'left':(0-self.$node.outerWidth())},300,function(){
				$(this).hide()
			});
		}else{
			self.$node.animate({'left':(self.$node.outerWidth())},300,function(){
				$(this).hide()
			});
		}
	}
}