function resultsObj($rnode,$lnode,quiz,root){
	var self = this
	self.root = root
	self.rs = null;
	self.quiz = quiz
	self.$rnode = $rnode
	self.$lnode = $lnode
	self.$rnode_inner = $rnode.find('div')
	self.$lnode_inner = $lnode.find('div')
	var points,quiz_points
	var rfade = new fadeObj(self.$rnode_inner)
	var lfade = new fadeObj(self.$lnode_inner)
	this.populate = function(){
		self.rs = self.quiz.generateResults()
		self.$rnode_inner.html('')
		self.$lnode_inner.html('')
		ignore = false
		for(var a in self.root.data.results){
			self.renderResult(self.root.data.results[a],self.rs,true,self.$rnode_inner);
		}
		for(var a in self.root.data.results){
			self.renderResult(self.root.data.results[a],self.rs,false,self.$rnode_inner);
		}
		for(var a in self.root.data.links){
			self.renderResult(self.root.data.links[a],self.rs,false,self.$lnode_inner);
		}
		self.$rnode.find('a').css('color','#'+self.root.data.config.colour_1[0])
		self.$lnode.find('a').css('color','#'+self.root.data.config.colour_1[0])
		self.resizeLayout();
	}
	this.renderResult = function(data,rs,p,$node){
		switch(data.type){
			case 'image':
				if(p){
					$('<div class = "antbits-SA-results_image"><img src="'+self.root.asset_path+'/'+data.text+'" alt="'+data.p1+'"></div>').appendTo($node);
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
					$(output).appendTo($node);
				}
				
			break;
			case 'text':
				if(!p){
					$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo($node);
				}
			break;
			case 'quiz results':
				if(!p){
					for(var key in rs.quiz_summary){
						$('<div class = "antbits-SA-results_text antbits-SA-quiz_summary"><div class="antbits-SA-quiz_'+rs.quiz_summary[key].sub_title+'">'+rs.quiz_summary[key].title+'<div>'+rs.quiz_summary[key].sub_title+'</div></div><p>'+rs.quiz_summary[key].body+'</p></div>').appendTo($node);
					}
					
				}
			break;
			case 'points triggered result':
				if(!p){
					if(rs.points >= Number(data.p1) &&  rs.points < Number(data.p2)){
						$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo($node);
					}
				}
			break
			case 'quiz triggered result':
				if(!p){
					if(quiz_points >= Number(data.p1) &&  quiz_points < Number(data.p2)){
						$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo($node);
					}
				}
				
			break
			case 'variable triggered result':
				if(!p){
					var pval = self.__vc.__quiz_obj.__quiz_vars[data.p3]
					if(pval >= data.p1 && pval < data.p2){
						$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo($node);
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
								if(p && self.root.data.result_items[b].priority == '1' && ignore == false){
									$('<div class = "antbits-SA-results_priority">'+self.root.data.result_items[b].text+'</div>').appendTo($node);
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
					$(tmp).appendTo($node);
				}
				
			break;
			case 'accumulated links':
				for(var a in rs.link_arr){
					if(rs.link_arr[a] != 'undefined'){
						for(var b in self.root.data.link_items){
							if(self.root.data.link_items[b].id == rs.link_arr[a]){
								$('<div class="antbits-SA-link_bullet"><a href="'+self.root.data.link_items[b].url+'"   target = "top"><img src = "images/bullet_mask.png" style="background-color:#'+self.root.data.config.colour_1[0]+';"><div>'+self.root.data.link_items[b].text+'</div></a></div>').appendTo($node);
								break;
							}
						}
					}
				}
				
			break;
			case 'accumulated videos':
				for(var a in rs.vid_arr){
					if(rs.vid_arr[a] != 'undefined'){
						for(var b in self.root.data.videos){
							if(self.root.data.videos[b].id == rs.vid_arr[a]){
								$('<div class="antbits-SA-link_bullet"><a href="'+self.root.data.videos[b].url+'"   target = "top"><img src = "images/vid_mask.png" style="background-color:#'+self.root.data.config.colour_1[0]+';"><div>'+self.root.data.videos[b].text+'</div></a></div>').appendTo($node);
								break;
							}
						}
					}
				}
			break;
			case 'obligatory link':
				for(var b in self.root.data.link_items){
					if(data.text == self.root.data.link_items[b].id){
						$('<div class="antbits-SA-link_bullet"><a href="'+self.root.data.link_items[b].link_url+'"   target = "top"><img src = "images/bullet_mask.png" style="background-color:#'+self.root.data.config.colour_1[0]+';"><div>'+self.root.data.link_items[b].text+'</div></a></div>').appendTo($node);
					}
				}
			break;
			case 'obligatory video':
				console.log(data)
				var vid = $('<div class="antbits-SA-link_bullet"><a href="#'+data.text+'"   target = "top"><img src = "images/vid_mask.png" style="background-color:#'+self.root.data.config.colour_1[0]+';"><div>'+self.root.data.bc_lookup[data.text].name+'</div></a></div>').appendTo($node);
				$(vid).on('click',function(event){
					event.preventDefault();
					self.root.launchVid(event.target.href.split('#').pop());
				})
		}
	}
	this.resizeLayout = function(area){
		rfade.setFades();
		lfade.setFades();
	}
	this.slideIn = function(d){
		if(d == 1){
			self.$rnode.css('left',self.$rnode.outerWidth()).show().animate({'left':0},300,function(){	
			});
		}else{
			self.$rnode.css('left',0-self.$rnode.outerWidth()).show().animate({'left':0},300,function(){
			});
		}	
	}
	this.slideOut = function(d){
		if(d == 1){
			self.$rnode.animate({'left':(0-self.$rnode.outerWidth())},300,function(){
				$(this).hide()
			});
		}else{
			self.$rnode.animate({'left':(self.$rnode.outerWidth())},300,function(){
				$(this).hide()
			});
		}
	}
}