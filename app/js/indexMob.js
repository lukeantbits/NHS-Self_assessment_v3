function indexMob() {
	var self = this
	self.postmessage = null
	self.syn_id = 'nhs'
	self.qstr = getUrlVars();
	self.stateObj = new maintain_state(this);
	self.level = 'menu_'
	self.section = null
	self.img_str = '';
	self.redirect_path = '';
	self.url_vars = getUrlVars();
	var subnode = null
	var locked = true;
	var current_id = null;
	var page = 0;
	var wt_l1 = ''
	var wt_l2 = ''
	var history = [];
	var w = $(window).width();
	var h = $(window).height();
	var $back_btn = $('#back_btn');
	var $menu_bg = $('#menu_bg');
	var $menu_btn = $('#menu_btn');
	var $menu = $('#menu');
	var $title = $('#header>span');
	var $header = $('#header');
	var $nhs_logo = $('#nhs_logo');
	var $main = $('#main');
	// hide stuff
	$nhs_logo.fadeOut(0)
	$menu_btn.fadeOut(0)
	$menu_bg.fadeOut(0)
	$menu.fadeOut(0)
	$('body').fadeOut(0)
	// get data
	$.getJSON('data.json',function(data){
		self.processData(data)
		self.init();
	})
	$(window).on('message', function(e) {
		var tmp = (eval('(' +e.originalEvent.data+')'));
		if(tmp.hasOwnProperty('postmessage')){
			self.postmessage = tmp.postmessage
		}
	}); 
	this.linkOut = function(url){
		if(self.postmessage){
			window.parent.postMessage('{"antbits_redirect": {"url":"'+url+'"}}', '*');
		}else{
			window.top.location.href = url; 
		}
	}
	this.processData = function(input){
		var output = {};
		output['text_areas'] = input['text_areas'];
		output['categories'] = input['categories'];
		output['content'] = {};
		for(var i in input.content){
			output['content'][input.content[i].area] = {};
		}
		var last = '1';
		var last_node
		for(var i in input.content){
			output['content'][input.content[i].area][input.content[i].subarea] = input.content[i];
			var node = output['content'][input.content[i].area][input.content[i].subarea]
			node.next = parseInt(node.id)+1
			if(last != node.area){
				last_node.next = null
			}
			last = node.area
			last_node = node	
		}	
		last_node.next = null
		self.data = output;
	}
	this.checkNav = function(){
		//console.log(self.level)
		if(self.level == 'menu' || self.level == 'splash'){
			$title.fadeIn(300)
			//$back_btn.fadeOut(300)
			$menu_btn.fadeOut(300)
		}else{
			$back_btn.fadeIn(300)
			$menu_btn.fadeIn(300)
			$title.fadeOut(300)
		}
	}
	this.backUp = function(){
		if(history.length > 1){
			/*if(history[history.length-1].id == 'info_btn'){
				dcsMultiTrack('DCSext.BackStructure','Close','WT.dl','121')
			}*/
			history.pop()
			tmp = history[history.length-1]
			self.navigate(tmp.level,tmp.id)
			history.pop()
			self.checkNav();
		}else{
			window.history.back();
		}
	}
	this.navigate = function(level, id){
		if(id != current_id){
			if(level != 'splash'){
				$header.css('visibility','visible')
			}
			current_id = id
			
			//console.log({'level':level,'id':id})
			self.level = level
			self.checkNav();
			$('#main>div').delay(100).fadeOut(300,function(){
				$(this).remove();
				window.scrollTo(0, 0)
			})
			var output ='<div class = "page" id = "'+level+'_'+id+'">';
			switch(level){
				case "splash":
					$main.css('margin-top',0)
					output +='<h2>Exercises for older people</h2>'
					output +='<img src = "images/splash@2x.png">'
					output +='<p>'+self.data.text_areas.splash+'</p>'
					output +='<a href = "javascript:;">View guide</a>'
					output +='</div>'
					$('#main').append(output)
					$('body').css('padding','12px')
					$('#splash_0>a').on('click',function(){
						setTimeout(function(){
							self.linkOut(window.location.href.replace('index.html','index.mob.html'))
						},100)
					})
					var interval = setInterval(function(){
						if(self.postmessage){
							window.parent.postMessage('{"antbits_resize": {"h":"'+($('#main').height()+100)+'px","w":"100%"}}', '*');
							
						}
					},100);
				break;
				case "menu":
					var a = 0
					$nhs_logo.fadeOut(300)
					history = []
					self.section = null
					self.content_node = null
					output +='<a href = "javascript:;" id = "getting_started"  class = "nav_link">Getting started</a>'
					for(var i in self.data.content){
						output += '<a class = "menu_item" href="javascript:;" style = "background-color:'+self.data.categories[i].colour1+';" id = "nav_'+a+'"><img src = "images/menu_icon_'+a+'.png"><span>'+self.data.categories[i].title+'</span><div class = "pointer"></div></a>'
						a++
					}
					output +='<a href = "javascript:;" id = "download_pdf" class = "nav_link">Download PDF</a>'
					output +='<div id = "menu_branding"><img  src = "images/nhsc_logo.png" ></div>'
					output +='</div>'
					$('#main').append(output)
					$('#'+level+'_'+id+'>a').on('click',function(evt){
						var index = parseInt(getId(evt).split('_').pop())+1
						if(!isNaN(index)){
							$(evt.target.parentNode).css('background-color',self.data.categories[index].colour2)
						}
						self.navigate('sub_menu',getId(evt))
						var str = $(evt.target).html();
						//self.wtObj.evt({'WT.dl':100,'WT.si_p':'Level 1','DCSext.BackPainL1':str})
					})
					$('#getting_started').on('click',function(){
						self.navigate('sub_menu','getting_started')
						$('#sub_menu_getting_started').addClass('info_page')
					})
					$('#download_pdf').on('click',function(){
						self.navigate('sub_menu','download_pdf')
						$('#sub_menu_download_pdf').addClass('info_page')
					})
					
				break;
				case "sub_menu":
					$nhs_logo.fadeIn(300)
					self.section = id;
					switch(id){
						case 'download_pdf':
							output += '<h3>Guide downloads</h3>'
							output+='<div><p>'+self.data.text_areas.info_txt+'</p>'
							output+='<img class = "img_center" src = "assets/pdf_preview_mob.png">'
							for(var i in self.data.categories){
								output+='<a href="'+self.data.categories[i].pdf_link+'" class = "dl_link" id = "pdf_'+i+'"><img src = "images/menu_icon_'+(i-1)+'.png" style= "background-color:'+self.data.categories[i].colour1+'"><span>'+self.data.categories[i].pdf_title+'</span></a>';
							}
							output+='</div>'
							$('#main').append(output)
							$('#sub_menu_download_pdf a').on('click',function(evt){
								self.linkOut(evt.target.parentNode.href)
								evt.preventDefault()
							})
						break;
						case 'getting_started':
							output += '<h3>Getting started</h3>'
							output+='<div>'+self.data.text_areas.getting_started+'</div>'
							$('#main').append(output)
							$('#sub_menu_getting_started a').on('click',function(evt){
								self.linkOut(evt.target.href)
								evt.preventDefault()
							})
						break;
						default:
							var a = 0
							var tmp = id.split('_')
							for(var i in self.data.content){
								
								if(a == tmp[1]){
									node = (self.data.content[i])
									break;
								}
								a++
							}
							var b = 0
							for(var i in node){
								var str = '';
								if(self.content_node != null){
									if(self.content_node.id == node[i].id){
										str = 'selected'
									}
								}
								output += '<a class = "submenu_item '+str+'" href="javascript:;" id = "subnav_'+a+'_'+b+'"><div>'+(b+1)+'</div><span>'+i+'</span><div class = "pointer"></div></a>'
								b++
							}
							output +='</div>'
							$('#main').append(output)
							$('#'+level+'_'+id+'>a').on('click',function(evt){
								$(evt.target.parentNode).css('background-image','url(images/menu_item_bg_dn.png)')
								//self.wtObj.evt({'WT.dl':100,'WT.si_p':'Level 2','DCSext.BackPainL1':wt_l1,'DCSext.BackPainL2':$(evt.target).html(),'DCSext.tool_complete':1})
								wt_l2 = $(evt.target).html();
								self.navigate('content',getId(evt))
							})
							break;
					}
					self.content_node = null
				break;
				case "content":
					$nhs_logo.fadeIn(300)
					output+='</div>'
					$('#main').append(output)
					var tmp = id.split('_')
					self.renderContentView(self.fetchNode(tmp[1],tmp[2]),$('#content_subnav_'+tmp[1]+'_'+tmp[2]))
				break;
			}
			history.push({'level':level,'id':id})
			$('#'+level+'_'+id).fadeOut(0).delay(300).fadeIn(300)
		}
	}
	this.internalNav = function(id){
		var a = 0
		var b = 0
		var output = ''
		for(var i in self.data.content){
			for(var j in self.data.content[i]){
				if(parseInt(self.data.content[i][j].id) == id){
					output = a+'_'+b
					self.section = "nav_"+a
				}
				b++;
			}
			b = 0
			a++;
		}
		
		return output
	}
	this.fetchNode = function(c,d){
		var output = null;
		var a = 0;
		var b = 0;
		for(var i in self.data.content){	
			if(a == parseInt(c)){
				output = self.data.content[i]
				if(d != null){
					for(var j in self.data.content[i]){	
						if(b == parseInt(d)){
							output = self.data.content[i][j]
							output.index = b+1
						}
						b++
					}
				}
			}
			a++
		}
		return output;
	}
	
	this.renderContentView = function(subnode,$div){
		self.content_node = subnode
		var images = subnode.asset_id.split('|')
		output = '<h2 style = "background-color:'+self.data.categories[subnode.area].colour1+';">'+subnode.index+'. '+subnode.subarea+'</h2>'
		output += '<div>'
		output += subnode.content.replace(/<a/g,'<p').replace(/p>/g,'p>')
		if(subnode.next != null){
			output += '<a class = "internal next_btn" href = "'+subnode.next+'">Next exercise</a>'
		}
		output += '</div>'
		$div.html(output)
		$($div.find('.interactive')).each(function(index, element) {
			$(element).before('<div class = "center"><img style="height:325px;" src="assets/'+images[index]+'"/></div>')
        });
		$($div.find('.next_btn')).css('background-color',self.data.categories[subnode.area].colour1)
		$($div.find('.next_btn')).on('click',function(evt){
				var nav_id = $(this).attr("href")
				$(this).css('background-color',self.data.categories[subnode.area].colour2)
				setTimeout(function(){
					self.navigate('content','subnav_'+self.internalNav(nav_id))
				},100)
				evt.preventDefault();
			})
		$div.find('.interactive>span').remove()
		
	}
	this.closeMenu = function(){
		$header.css('position','fixed')
		$('#main').css('position','relative')
		$menu.fadeOut(300,function(){
			$(this).html('')
		});
		$menu_bg.fadeOut(300);
	
	}
	this.showMenu = function(){
		$('body').addClass('noscroll')
		$menu.fadeIn(300);
		$menu_bg.fadeTo(300,0.01);
		var current_page = (history[history.length-1])
		//console.log(current_page)
		var output = '<a href="javascript:;" id = "menu_close" ></a><div><a href="javascript:;" class = "item emphasis" id = "menu-0" >Main menu</a>'
		var a = 0
		for(var i in self.data.content){
			if(current_page.id == 'nav_'+a && current_page.level == 'sub_menu'){
				output += '<a href="javascript:;" class = "item current"  style = "background-color:'+self.data.categories[i].colour1+';" id = "sub_menu-nav_'+a+'">'+self.data.categories[i].title+'</a>'
			}else{
				output += '<a href="javascript:;" class = "item" id = "sub_menu-nav_'+a+'">'+self.data.categories[i].title+'</a>'
			}
			//console.log(self.section+' == '+'nav_'+a)
			if('nav_'+a == self.section){
				var b = 0
				
				for(var j in self.data.content[i]){
					if(current_page.id == 'subnav_'+a+'_'+b && current_page.level == 'content'){
						output += '<a href="javascript:;" class = "item indent current" style = "background-color:'+self.data.categories[i].colour1+';" id = "content-subnav_'+a+'_'+b+'">'+j+'</a>'
					}else{
						output += '<a href="javascript:;" class = "item indent" id = "content-subnav_'+a+'_'+b+'">'+j+'</a>'
					}
					
					b++;
				}
			}
			a++
		}
		output+='</div>'
		$menu.html(output);
		$('#menu_close').on('click',function(){
			self.closeMenu();
		})
		$('#menu .item').on('click',function(evt){
			$(evt.target).css('background-color','#b2d0e9');
			var tmp = evt.target.id.split('-')
			var node = tmp[1].split('_')
			self.navigate(tmp[0],tmp[1]);
			switch(tmp[0]){
				case'menu':
				break;
				case'sub_menu':
					wt_l1 = $(evt.target).html();
					//self.wtObj.evt({'WT.dl':100,'WT.si_p':'Level 1','DCSext.BackPainL1':wt_l1})
				break;
				case'content':
					wt_l1 = $('#sub_menu-nav_'+node[1]).html()
					wt_l2 = $(evt.target).html();
					//self.wtObj.evt({'WT.dl':100,'WT.si_p':'Level 2','DCSext.BackPainL1':wt_l1,'DCSext.BackPainL2':wt_l2,'DCSext.tool_complete':1})
				break;
			}
			self.closeMenu();
		})
		self.resizeLayout()
	}
	this.init = function(){	
		//self.stateObj.restoreState();
		//self.wtObj = new wt(self,{'title':'NHS Back pain guide','si_n':'Tool_Back pain guide','ti':'NHS Back pain guide','DCSext.tool_name':'Back pain guide','category':'Health and safety','vtvs':self.stateObj.vtvs,'co_f':self.stateObj.co_f,'dcsuri':'/tools/documents/backpain_v2/index.html'});
		if(inIframe()){
			self.navigate('splash',0)
		}else{
			//self.wtObj.evt({'WT.dl':0,'WT.si_p':'Start'});
			self.navigate('menu',0)
		}
		$back_btn.on('click',function(){
			self.backUp();
		})
		$menu_btn.on('click',function(){
			self.showMenu();
		})
		$('body').fadeIn(500,function(){
		
		})
	}
	this.resizeLayout = function(){
		var h = 0
		$('#main .page').each(function(index, element) {
            h = Math.max($(element).height())
        });
		h+=($header.height()+100)
		//$('#menu_bg').height(Math.max($('#main').height()+$header.height(),$('#menu').height()))
		$('#menu_bg').height(h)
	}
	$(window).on('resize',function(){
		self.resizeLayout()
	})
}