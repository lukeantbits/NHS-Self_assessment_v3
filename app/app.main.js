function analytics(vc,d,o){var self=this
var data=d
self.vc=vc}
function wt(vc,d,o){var self=this
var data=d
var usr_str=Array('error','New user','Returning user')
var syn_id=vc.syn_id
var base_obj={'DCSext.tool_name':data.title,'DCSext.tool_cat':data.category,'WT.si_n':data.si_n,'DCSext.tool_type':'iframe','WT.vtvs':data.vtvs,'WT.co_f':data.co_f,'WT.vtid':data.co_f,'DCS.dcsuri':data.dcsuri}
self.vc=vc
this.evt=function(obj){var output=[]
for(var key in base_obj){output.push(key)
output.push(base_obj[key])}
for(var key in obj){output.push(key)
output.push(obj[key])}
eval("dcsMultiTrack('"+output.join("','")+"')")}}
function boolSelectObj(qobj,padding){var self=this;var parent_obj=qobj;var $btn_shadows,$btn_images,$btn_captions,$btns;parent_obj.data.selected=[];parent_obj.$pane.append('<a href = "#0" class = "antbits-SA-answer_bool"><div class = "antbits-SA-answer_bool_image tick"><div></div></div><div class = "antbits-SA-answer_bool_shadow"></div><div class = "antbits-SA-answer_bool_caption">'+initCaps(parent_obj.data.answers[0]['body'])+'</div></a>')
parent_obj.$pane.append('<a href = "#1" class = "antbits-SA-answer_bool"><div class = "antbits-SA-answer_bool_image cross"><div></div></div><div class = "antbits-SA-answer_bool_shadow"></div><div class = "antbits-SA-answer_bool_caption">'+initCaps(parent_obj.data.answers[1]['body'])+'</div></a>')
$btn_shadows=$(parent_obj.$pane.find('a>.antbits-SA-answer_bool_shadow'))
$btn_images=$(parent_obj.$pane.find('a>.antbits-SA-answer_bool_image'))
$btn_captions=$(parent_obj.$pane.find('a>.antbits-SA-answer_bool_caption'))
$btns=parent_obj.$pane.find('.antbits-SA-answer_bool')
parent_obj.$pane.css('text-align','center')
$btns.on('click',function(e){self.toggle(parseInt(this.href.split('#').pop()))
parent_obj.root.nav.unlock();parent_obj.root.quiz.build();parent_obj.root.stateObj.storeState();e.preventDefault();}).on('focus',function(e){if(parent_obj.root.keynav){$($(e.target)[0].lastChild).css('text-decoration','underline')}}).on('focusout',function(e){$($(e.target).find('.antbits-SA-answer_bool_caption')[0]).css('text-decoration','none')}).on('mouseout',function(e){$(e.target).blur();})
this.toggle=function(id){$(parent_obj.$pane.find('.antbits-SA-answer_bool_image>div')).each(function(index,element){parent_obj.data.selected=[id];if(index==id){$(element).animate({'opacity':1},300);}else{$(element).animate({'opacity':0.4},300);}});$(parent_obj.$pane.find('.antbits-SA-answer_bool_shadow')).each(function(index,element){parent_obj.data.selected=[id];if(index==id){$(element).animate({'opacity':0},300);}else{$(element).animate({'opacity':0.4},300);}});}
this.focusFirst=function(){$($btns[0].lastChild).css('text-decoration','underline')}
this.resetState=function(){self.toggle(null);parent_obj.data.selected=[];}
this.resizeLayout=function(d_h){d_h-=(padding.top+padding.bottom)
var btn_size=Math.min(d_h*0.42,parent_obj.$pane.innerWidth()*0.4);$btn_images.width(btn_size).height(btn_size);$btn_shadows.width(btn_size+4).height(btn_size+4).css('margin-top',(0-(btn_size+4)));$btn_captions.width(btn_size);var h=d_h-(parent_obj.$q_header.height()-16)
var pad=(h-$($btns[0]).height())*0.5;$btns.css('margin-top',pad)}
this.restore=function(){if(parent_obj.data.selected.length>0){self.toggle(parent_obj.data.selected[0])}}
this.setState=function(){}
this.getState=function(){}}
function dialogObj(root,$wrap){var self=this;this.root=root
this.data=null
this.$wrap=$wrap;var $close
var $bg=$('<a href = "javascript:;" class = "antbits-SA-dialog_bg"></a>').appendTo($wrap).hide();var $inner=$('<div class = "antbits-SA-dialog_inner"><a href = "javascript:;" class = "antbits-SA-dialog_close"></a><h2></h2><div></div></div>').appendTo($wrap).hide();var $pane=$inner.find('div');$close=$inner.find('.antbits-SA-dialog_close')
$close.on('click',function(){self.die();})
$bg.on('click',function(){self.die();})
this.launch=function(data){this.data=data;$bg.fadeTo(0,0).fadeTo(300,0.7);$inner.fadeTo(0,0).fadeTo(300,1);$inner.find('h2').html(data.title);$inner.find('div').html(data.body+data.body+data.body+data.body);if($inner.height()>$wrap.height()-40){$inner.height($wrap.height()-40);$pane.height($wrap.height()-(80+$inner.find('h2').outerHeight()));}
$inner.css('margin-top',(this.$wrap.outerHeight()-($inner.outerHeight()+10))/2);self.$wrap.find('a').attr('tabindex',-1);$close.attr('tabindex',null);$bg.attr('tabindex',null);if(self.root.keynav){$close.focus();}
self.resizeLayout();}
this.die=function(){self.$wrap.find('a').attr('tabindex',null)
$bg.fadeTo(300,0);$inner.fadeTo(300,0,function(){$bg.hide();$inner.hide();$inner.find('h2').html('');$inner.find('div').html('');if(self.root.keynav){self.root.focusActiveQ();}})}
this.resizeLayout=function(){if($inner.find('video').length>0){$($inner.find('.antbits-SA-vid')[0]).height($inner.width()*0.51);}}}
function fadeObj($pane){var self=this
self.$pane=$pane
var $fade_top=$('<div class ="antbits-SA-fade antbits-SA-fade_top" ></div>').appendTo(self.$pane.parent())
var $fade_bottom=$('<div class ="antbits-SA-fade antbits-SA-fade_bottom" ></div>').appendTo(self.$pane.parent())
this.setFades=function(){var pos=self.$pane.offset();if(self.$pane.height()<(self.$pane[0].scrollHeight-32)){$fade_top.width(self.$pane.innerWidth()-50).css('top',0).show();$fade_bottom.width(self.$pane.innerWidth()-50).css('top',self.$pane.height()).show();}else{$fade_top.hide();$fade_bottom.hide();}}}
function genderSelectObj(qobj,padding){var self=this;var parent_obj=qobj;var $btns,$masks,$bg_tints;parent_obj.data.selected=[];parent_obj.$pane.append('<a href = "#0" class = "antbits-SA-answer_gender"><div style="background-color:#'+parent_obj.root.data.config.colour_1[0]+'"></div><image src="'+parent_obj.root.path+'images/male_mask.png"></a>')
parent_obj.$pane.append('<a href = "#1" class = "antbits-SA-answer_gender"><div style="background-color:#'+parent_obj.root.data.config.colour_1[0]+'"></div><image src="'+parent_obj.root.path+'images/female_mask.png"></a>')
$btns=parent_obj.$pane.find('.antbits-SA-answer_gender')
$masks=parent_obj.$pane.find('.antbits-SA-answer_gender>img')
$bg_tints=parent_obj.$pane.find('.antbits-SA-answer_gender>div')
$bg_tints.fadeOut(0);parent_obj.$pane.css('text-align','center')
$btns.on('click',function(e){self.toggle(parseInt(this.href.split('#').pop()))
parent_obj.root.nav.unlock();parent_obj.root.quiz.build();parent_obj.root.stateObj.storeState();e.preventDefault();}).on('mouseout',function(e){$(e.target).blur();})
this.toggle=function(id){parent_obj.data.selected=[id];$bg_tints.each(function(index,element){if(index==id){$(element).fadeIn(300);}else{$(element).fadeOut(300);}})}
this.focusFirst=function(){}
this.resetState=function(){self.toggle(null);parent_obj.data.selected=[];}
this.resizeLayout=function(d_h){d_h-=(padding.top+padding.bottom)
var h=d_h-(parent_obj.$q_header.height()-16)
var btn_size=Math.min(h*0.9,parent_obj.$pane.width());$btns.width(btn_size*0.5).height(btn_size);$masks.width(btn_size*0.5).height(btn_size);$bg_tints.width(btn_size*0.5).height(btn_size);var pad=h*0.05
$btns.css('margin-top',pad)}
this.restore=function(){if(parent_obj.data.selected.length>0){self.toggle(parent_obj.data.selected[0])}}
this.setState=function(){}
this.getState=function(){}}
function saIndex(path,id,layout){var mode='production'
var self=this
self.area='splash'
self.display='desktop'
self.layout=layout
self.asset_path='';self.postmessage=null
self.syn_id='nhs'
self.id=id
self.dialogObj=null;self.qstr=getUrlVars();self.keynav=false;self.stateObj=new maintainState(this,id);self.questions=[];self.nav_h=66;self.header_h=48;var locked=false;var BCtoken="kW3Z5VuyO6u1bG7j5Yy0PjaOyjHF6ALA80MONlg8ydJGTZ3b0K2COA.."
this.path=path;this.pages=null;this.redirect_path=''
this.url_vars=getUrlVars();var $nav,$answers,$qpanes,$header,$splash,$results,$links,$results_inner,$links_inner,$bg_fill,$wrap,$preload,$preload_message,$container,$questions,$results,$links,outer_h,inner_h,$start_btn,$finish_btn;switch(mode){case'cms':self.asset_path=path+'../cms/archive/as_'+id
$.getJSON(path+'../cms/json_output.php?as_id='+id,function(data){self.data=data
$('#antbits-SA_'+id).load(path+'templates/sa.html',function(){$('#antbits-SA_'+self.id).find('img').each(function(index,element){$(element).attr('src',path+$(element).attr('src'))});self.getVidData();})})
break;case'production':self.asset_path=path+'packages/as_'+id+'/images/'
$.getJSON(path+'packages/as_'+id+'/data.json',function(data){self.data=data
$('#antbits-SA_'+id).load(path+'templates/sa.html',function(){$('#antbits-SA_'+self.id).find('img').each(function(index,element){$(element).attr('src',path+$(element).attr('src'))});self.getVidData();})})
break;}
if(isMobile.any()){if(isMobile.Tablet()){self.display='tablet'}else{self.display='phone'}}
this.linkOut=function(url){if(self.postmessage){window.parent.postMessage('{"antbits_redirect": {"url":"'+url+'"}}','*');}else{window.top.location.href=url;}}
this.getVidData=function(){self.data.bc_lookup={}
var vids_indexed=0;if(self.data.videos.length>0){for(var i=0;i<self.data.videos.length;i++){$.ajax({url:"//api.brightcove.com/services/library?command=find_video_by_id&video_id="+self.data.videos[i]+"&video_fields=name,id&token="+BCtoken,dataType:'jsonp'}).done(function(data){if(data!=null){self.data.bc_lookup[data.id]=data
vids_indexed++;if(vids_indexed==self.data.videos.length){self.init();}}});}}else{self.init();}}
this.launchVid=function(id){var output='<video class = "antbits-SA-vid" onmousedown="dcsMultiTrack(\'DCSext.BCVid\',\'Play\',\'WT.dl\',\'121\')" data-video-id="'+id+'" data-account="79227729001" data-player="default" data-embed="default" data-application-id class="video-js" controls></video><script src="//players.brightcove.net/79227729001/default_default/index.min.js"></script>'
self.dialog.launch({'body':output,'title':self.data.bc_lookup[id].name})}
this.restoreState=function(rdata){if(rdata.area!='splash'){self.area=rdata.area
self.pages.each(function(index,element){$(element).hide();})
for(var a=0;a<self.data.questions.length;a++){if(rdata.questions[a].length>0){self.data.questions[a].selected=rdata.questions[a]
self.data.questions[a].obj.restore()}}
self.quiz.current_index=rdata.current_index
self.quiz.current_question=rdata.current_question
self.quiz.build();$splash.hide();switch(self.area){case'questions':self.quiz.getCurrent().obj.slideIn(1);self.nav.checkState()
self.nav.updateProgress(self.quiz)
break;case'results':self.results.populate();self.results.slideIn(0);self.nav.checkState()
self.nav.setState(2)
break;case'links':self.results.populate();$links.show();self.nav.checkState()
self.nav.setState(3)
break;}
self.resizeLayout()}
setTimeout(function(){self.stateObj.clearState();},500)}
this.getCurrentQ=function(){return self.data.questions[Math.max(0,self.quiz.current_index-1)];}
this.resizeLayout=function(){self.nav_h=$nav.outerHeight();self.header_h=$header.outerHeight();self.dialog.resizeLayout();outer_h=0;inner_h=0;var p_max=0;if(self.data.config.h_max==0){self.data.config.h_max=10000;}
$answers.each(function(index,element){$(element).css('margin','10px 0px 10px 0px')})
$qpanes.each(function(index,element){$(element).height('auto').css('overflow-y',null);})
$results_inner.css('height',null)
$links_inner.css('height',null)
$results.css('height',null)
$links.css('height',null)
for(var i=0;i<self.pages.length;i++){$(self.pages[i]).width($container.outerWidth()-32).css('height',null).css('overflow-y',null);var tmp_h=$(self.pages[i]).outerHeight();switch($(self.pages[i]).attr('id')){case'antbits-SA-splash':$(self.pages[i]).outerHeight(Math.max(tmp_h,(self.data.config.h_min-(self.header_h+10))))
break;case'antbits-SA-results':$(self.pages[i]).width($container.outerWidth())
break;case'antbits-SA-links':$(self.pages[i]).width($container.outerWidth())
break;default:tmp_h-=32;if(self.questions[i-1].data.type=='single select'||self.questions[i-1].data.type=='multiple select'){p_max=Math.max(p_max,tmp_h);}
break;}}
if(self.display=='phone'&&self.layout=='phone'){switch(self.area){case'splash':inner_h=$(window).height()-$header.height()
break;case'questions':inner_h=$(window).height()-($header.height()+$nav.height())
for(var q in self.questions){self.questions[q].resizeLayout($container.outerWidth()-32,inner_h-62)}
break;case'results':inner_h=$(window).height()-$header.height()
$results_inner.css('height',inner_h-(self.nav_h+28)).css('overflow-y','auto')
break;case'links':inner_h=$(window).height()-$header.height()
$links_inner.css('height',inner_h-(self.nav_h+28)).css('overflow-y','auto')
break;}
$container.css('top',self.header_h).height(inner_h);}else{switch(self.area){case'splash':outer_h=Math.max(outer_h,$splash.outerHeight())+56
inner_h=Math.max(inner_h,$splash.outerHeight())
break;case'questions':outer_h=Math.min(self.data.config.h_max,Math.max(self.data.config.h_min,p_max+42+self.header_h+self.nav_h))
inner_h=Math.min((self.data.config.h_max-(self.header_h+self.nav_h)),Math.max(self.data.config.h_min-(self.header_h+self.nav_h),p_max+32))
for(var q in self.questions){self.questions[q].resizeLayout($container.outerWidth()-32,inner_h-32)}
break;case'results':var h=Math.max($results.height()-14,$links.height()-14);outer_h=Math.min(self.data.config.h_max,Math.max(outer_h,h+80)+56);inner_h=Math.min(self.data.config.h_max-56,Math.max(inner_h,h+80));$results_inner.css('height',inner_h-self.nav_h).css('overflow-y','auto');self.results.resizeLayout('results');break;case'links':var h=Math.max($results.height()-14,$links.height()-14);outer_h=Math.min(self.data.config.h_max,Math.max(outer_h,h+80)+56);inner_h=Math.min(self.data.config.h_max-56,Math.max(inner_h,h+80));$links_inner.css('height',inner_h-self.nav_h).css('overflow-y','auto');break;}
$wrap.stop().animate({height:outer_h},500);$container.css('top',self.header_h).stop().animate({height:inner_h},500);}}
this.retinafy=function(str){output=str;if(window.devicePixelRatio>1){var tmp=str.split('.');tmp[tmp.length-2]+='@2x'
output=tmp.join('.')+'" style="zoom:0.5';}
return output;}
this.browserCheck=function(){var str=navigator.userAgent
if(str.search(' Edge/')>=0||str.search('MSIE')>=0){$('head').append('<link href="css/styles_ie.css" rel="stylesheet" type="text/css" />')}}
this.restart=function(){self.stateObj.clearState();$links.animate({'left':(0-$container.outerWidth())},300)
$splash.show().css('left',($container.outerWidth())).animate({'left':0},300)
self.area='splash'
self.quiz.reset()
self.resizeLayout()
self.nav.setState(4);}
this.slideNext=function(){if(!locked){locked=true
if(self.quiz.isComplete()&&self.area=='results'){self.area='links'}
if(self.quiz.isComplete()&&self.area=='questions'){self.area='results'}
switch(self.area){case'splash':$splash.animate({'left':0-($container.outerWidth())},300,function(){$splash.hide();})
self.questions[0].slideIn(1);self.nav.setState(0)
self.area='questions'
self.resizeLayout()
self.nav.updateProgress(self.quiz)
if(self.keynav){self.focusActiveQ()}
break;case'questions':self.quiz.getCurrent().obj.slideOut(1);self.quiz.getNext().obj.slideIn(1);self.quiz.current_index++
self.nav.setState(1)
self.nav.updateProgress(self.quiz)
if(self.keynav){self.focusActiveQ()}
break;case'results':$preload_message.html('Generating results');$preload.css('top',$header.outerHeight()).fadeIn(300,function(){self.quiz.getCurrent().obj.slideOut(1);self.nav.setState(2)
self.results.populate();self.results.slideIn(1);self.resizeLayout()
$preload.delay(1000).fadeOut(300)});break;case'links':self.nav.setState(3)
self.results.slideOut(1);$links.show().css('left',$container.outerWidth()).animate({'left':0},300)
self.resizeLayout();break;}
self.nav.checkState();self.stateObj.storeState();setTimeout(function(){locked=false},300)}}
this.slideBack=function(){if(!locked){locked=true
if(self.quiz.getCurrent().id==0){self.area='splash'}
switch(self.area){case'splash':if(self.display=='phone'){window.history.back();}else{self.quiz.getCurrent().obj.slideOut(-1);$splash.stop().show().css('left',(0-$container.outerWidth())).animate({'left':0},300,function(){self.resizeLayout()})}
break;case'questions':self.quiz.getCurrent().obj.slideOut(-1);self.quiz.getPrevious().obj.slideIn(-1);self.quiz.current_index--
self.nav.updateProgress(self.quiz);if(self.keynav){self.focusActiveQ()}
break;case'results':self.area='questions'
self.nav.setState(1)
self.quiz.getCurrent().obj.slideIn(-1);self.results.slideOut(-1);self.nav.updateProgress(self.quiz);if(self.keynav){self.focusActiveQ()}
self.resizeLayout();break;case'links':self.area='results'
self.nav.setState(2)
self.results.slideIn(-1);$links.animate({'left':$container.outerWidth()},300,function(){$links.hide();})
self.resizeLayout();break;}
self.nav.checkState();self.stateObj.storeState();setTimeout(function(){locked=false},300)}}
this.initQuestions=function(){for(var i=0;i<self.data.questions.length;i++){self.data.questions[i].id=i;self.questions.push(new questionObj(self,self.data.questions[i],$container,$results,i))}}
this.setPreview=function(){switch(self.qstr.pg){case'3':self.nav.preview=true;$nav.show();var q=parseInt(self.qstr.q)+1;self.quiz.current_index=q-1;self.quiz.current_question=q-1;self.area='questions';self.nav.setState(1);$(self.pages[0]).hide();$(self.pages[q]).show();self.questions[q-1].updateHeader(q,self.questions.length);break;case'4':self.nav.preview=true;self.area='results';$nav.show();self.nav.setState(2);$(self.pages[0]).hide();$results.show();self.quiz.setPreview();self.results.populate();break;case'5':self.nav.preview=true;self.area='results';$nav.show();self.nav.setState(2);$(self.pages[0]).hide();$links.show();self.quiz.setPreview();self.results.populate();break;}}
this.focusActiveQ=function(){self.questions[Math.max(0,self.quiz.current_index-1)].focusFirst();}
this.getInfoBox=function(id){var output=null
for(var i=0;i<self.data.info_boxes.length;i++){if(self.data.info_boxes[i].id==id){output=self.data.info_boxes[i];break;}}
return output;}
this.sortUnique=function(arr){arr=arr.sort(function(a,b){return a*1-b*1;});var ret=[arr[0]];for(var i=1;i<arr.length;i++){if(arr[i-1]!==arr[i]){ret.push(arr[i]);}}
return ret;}
this.init=function(){self.nav=new navObj(this);self.quiz=new quizObj(this);$wrap=$('#antbits-SA_'+self.id)
$header=$('#antbits-SA_'+self.id+' #antbits-SA-header')
$nav=$('#antbits-SA_'+self.id+' #antbits-SA-nav')
$bg_fill=$('#antbits-SA_'+self.id+' #antbits-SA-bg_fill')
$splash=$('#antbits-SA_'+self.id+' #antbits-SA-splash')
$results=$('#antbits-SA_'+self.id+' #antbits-SA-results').hide()
$links=$('#antbits-SA_'+self.id+' #antbits-SA-links').hide()
$results_inner=$('#antbits-SA_'+self.id+' #antbits-SA-results>div')
$links_inner=$('#antbits-SA_'+self.id+' #antbits-SA-links>div')
$preload=$('#antbits-SA_'+self.id+' .antbits-SA-preloader')
$preload_message=$('#antbits-SA_'+self.id+' .antbits-SA-preloader>div')
$container=$('#antbits-SA_'+self.id+' #antbits-SA-container')
$start_btn=$('#antbits-SA_'+self.id+' #antbits-SA-start_btn')
$links_btn=$('#antbits-SA_'+self.id+' #antbits-SA-nav_links')
$finish_btn=$('#antbits-SA_'+self.id+' #antbits-SA-nav_finish')
$header.css('background-color','#'+self.data.config.colour_1[0]).html(self.data.config.title)
$bg_fill.css('background-color','#'+self.data.config.colour_1[0])
$splash.append('<h2>'+self.data.config.intro_title+'</h2>');$splash.append('<div>'+self.data.config.intro_copy+'</div>');self.results=new resultsObj($results,$links,this.quiz,this)
if(self.data.config.intro_graphic!=''){$splash.css('background-image','url('+self.asset_path+'/'+self.data.config.intro_graphic+')')}
if(self.data.config.intro_foot!=''){var $info_btn=$('<a href = "javascript:;" class = "antbits-SA-info_btn"></a>').appendTo($splash);$info_btn.on('click',function(){self.dialog.launch({'body':self.data.config.intro_foot,'title':''})})}
$start_btn.css('background-color','#'+self.data.config.colour_2[0])
$start_btn.bind("mouseenter focus focusout mouseleave",function(event){if(event.type=='mouseenter'||event.type=='focus'){$(this).css('background-color','#'+self.data.config.colour_2[1])}else{$(this).css('background-color','#'+self.data.config.colour_2[0])}});$start_btn.on('click',function(){if(self.display=='phone'){window.location=self.path+'index.mob.html?asid='+self.id}else{self.slideNext()}})
$links_btn.css('background-color','#'+self.data.config.colour_3[0])
$links_btn.bind("mouseenter focus focusout mouseleave",function(event){if(event.type=='mouseenter'||event.type=='focus'){$(this).css('background-color','#'+self.data.config.colour_3[1])}else{$(this).css('background-color','#'+self.data.config.colour_3[0])}});$links_btn.on('click',function(){if(!self.nav.preview){self.slideNext()}})
$finish_btn.css('background-color','#'+self.data.config.colour_2[0])
$finish_btn.bind("mouseenter focus focusout mouseleave",function(event){if(event.type=='mouseenter'||event.type=='focus'){$(this).css('background-color','#'+self.data.config.colour_2[1])}else{$(this).css('background-color','#'+self.data.config.colour_2[0])}});$finish_btn.on('click',function(){self.restart();})
self.dialog=new dialogObj(this,$wrap)
self.initQuestions();$qpanes=$('#antbits-SA_'+self.id+' .antbits-SA-qpane')
$answers=$('#antbits-SA_'+self.id+' .antbits-SA-answer')
$preload_message.html('');$preload.delay(800).fadeOut(500);self.pages=$('#antbits-SA_'+self.id+' #antbits-SA-container>.antbits-SA-page')
switch(self.display){case'phone':if(self.layout=='phone'){$splash.hide();self.slideNext();self.stateObj.restoreState();}
break;default:if(self.qstr.pg!=undefined){self.setPreview();}else{self.stateObj.restoreState();}
break;}
$wrap.on('keydown',function(evt){if(evt.keyCode==9||(evt.keyCode==13&&$(':focus').length>0)){self.keynav=true}else if(self.keynav==true&&(evt.keyCode==13||evt.keyCode==16)){self.keynav=true}else{self.keynav=false}})
$wrap.on('click',function(evt){self.keynav=false})
$(window).on('resize',function(e){self.resizeLayout()})
self.resizeLayout();}}
function indexMob(){var self=this
self.postmessage=null
self.syn_id='nhs'
self.qstr=getUrlVars();self.stateObj=new maintain_state(this);self.level='menu_'
self.section=null
self.img_str='';self.redirect_path='';self.url_vars=getUrlVars();var subnode=null
var locked=true;var current_id=null;var page=0;var wt_l1=''
var wt_l2=''
var history=[];var w=$(window).width();var h=$(window).height();var $back_btn=$('#back_btn');var $menu_bg=$('#menu_bg');var $menu_btn=$('#menu_btn');var $menu=$('#menu');var $title=$('#header>span');var $header=$('#header');var $nhs_logo=$('#nhs_logo');var $main=$('#main');$nhs_logo.fadeOut(0)
$menu_btn.fadeOut(0)
$menu_bg.fadeOut(0)
$menu.fadeOut(0)
$('body').fadeOut(0)
$.getJSON('data.json',function(data){self.processData(data)
self.init();})
$(window).on('message',function(e){var tmp=(eval('('+e.originalEvent.data+')'));if(tmp.hasOwnProperty('postmessage')){self.postmessage=tmp.postmessage}});this.linkOut=function(url){if(self.postmessage){window.parent.postMessage('{"antbits_redirect": {"url":"'+url+'"}}','*');}else{window.top.location.href=url;}}
this.processData=function(input){var output={};output['text_areas']=input['text_areas'];output['categories']=input['categories'];output['content']={};for(var i in input.content){output['content'][input.content[i].area]={};}
var last='1';var last_node
for(var i in input.content){output['content'][input.content[i].area][input.content[i].subarea]=input.content[i];var node=output['content'][input.content[i].area][input.content[i].subarea]
node.next=parseInt(node.id)+1
if(last!=node.area){last_node.next=null}
last=node.area
last_node=node}
last_node.next=null
self.data=output;}
this.checkNav=function(){if(self.level=='menu'||self.level=='splash'){$title.fadeIn(300)
$menu_btn.fadeOut(300)}else{$back_btn.fadeIn(300)
$menu_btn.fadeIn(300)
$title.fadeOut(300)}}
this.backUp=function(){if(history.length>1){history.pop()
tmp=history[history.length-1]
self.navigate(tmp.level,tmp.id)
history.pop()
self.checkNav();}else{window.history.back();}}
this.navigate=function(level,id){if(id!=current_id){if(level!='splash'){$header.css('visibility','visible')}
current_id=id
self.level=level
self.checkNav();$('#main>div').delay(100).fadeOut(300,function(){$(this).remove();window.scrollTo(0,0)})
var output='<div class = "page" id = "'+level+'_'+id+'">';switch(level){case"splash":$main.css('margin-top',0)
output+='<h2>Exercises for older people</h2>'
output+='<img src = "images/splash@2x.png">'
output+='<p>'+self.data.text_areas.splash+'</p>'
output+='<a href = "javascript:;">View guide</a>'
output+='</div>'
$('#main').append(output)
$('body').css('padding','12px')
$('#splash_0>a').on('click',function(){setTimeout(function(){self.linkOut(window.location.href.replace('index.html','index.mob.html'))},100)})
var interval=setInterval(function(){if(self.postmessage){window.parent.postMessage('{"antbits_resize": {"h":"'+($('#main').height()+100)+'px","w":"100%"}}','*');}},100);break;case"menu":var a=0
$nhs_logo.fadeOut(300)
history=[]
self.section=null
self.content_node=null
output+='<a href = "javascript:;" id = "getting_started"  class = "nav_link">Getting started</a>'
for(var i in self.data.content){output+='<a class = "menu_item" href="javascript:;" style = "background-color:'+self.data.categories[i].colour1+';" id = "nav_'+a+'"><img src = "images/menu_icon_'+a+'.png"><span>'+self.data.categories[i].title+'</span><div class = "pointer"></div></a>'
a++}
output+='<a href = "javascript:;" id = "download_pdf" class = "nav_link">Download PDF</a>'
output+='<div id = "menu_branding"><img  src = "images/nhsc_logo.png" ></div>'
output+='</div>'
$('#main').append(output)
$('#'+level+'_'+id+'>a').on('click',function(evt){var index=parseInt(getId(evt).split('_').pop())+1
if(!isNaN(index)){$(evt.target.parentNode).css('background-color',self.data.categories[index].colour2)}
self.navigate('sub_menu',getId(evt))
var str=$(evt.target).html();})
$('#getting_started').on('click',function(){self.navigate('sub_menu','getting_started')
$('#sub_menu_getting_started').addClass('info_page')})
$('#download_pdf').on('click',function(){self.navigate('sub_menu','download_pdf')
$('#sub_menu_download_pdf').addClass('info_page')})
break;case"sub_menu":$nhs_logo.fadeIn(300)
self.section=id;switch(id){case'download_pdf':output+='<h3>Guide downloads</h3>'
output+='<div><p>'+self.data.text_areas.info_txt+'</p>'
output+='<img class = "img_center" src = "assets/pdf_preview_mob.png">'
for(var i in self.data.categories){output+='<a href="'+self.data.categories[i].pdf_link+'" class = "dl_link" id = "pdf_'+i+'"><img src = "images/menu_icon_'+(i-1)+'.png" style= "background-color:'+self.data.categories[i].colour1+'"><span>'+self.data.categories[i].pdf_title+'</span></a>';}
output+='</div>'
$('#main').append(output)
$('#sub_menu_download_pdf a').on('click',function(evt){self.linkOut(evt.target.parentNode.href)
evt.preventDefault()})
break;case'getting_started':output+='<h3>Getting started</h3>'
output+='<div>'+self.data.text_areas.getting_started+'</div>'
$('#main').append(output)
$('#sub_menu_getting_started a').on('click',function(evt){self.linkOut(evt.target.href)
evt.preventDefault()})
break;default:var a=0
var tmp=id.split('_')
for(var i in self.data.content){if(a==tmp[1]){node=(self.data.content[i])
break;}
a++}
var b=0
for(var i in node){var str='';if(self.content_node!=null){if(self.content_node.id==node[i].id){str='selected'}}
output+='<a class = "submenu_item '+str+'" href="javascript:;" id = "subnav_'+a+'_'+b+'"><div>'+(b+1)+'</div><span>'+i+'</span><div class = "pointer"></div></a>'
b++}
output+='</div>'
$('#main').append(output)
$('#'+level+'_'+id+'>a').on('click',function(evt){$(evt.target.parentNode).css('background-image','url(images/menu_item_bg_dn.png)')
wt_l2=$(evt.target).html();self.navigate('content',getId(evt))})
break;}
self.content_node=null
break;case"content":$nhs_logo.fadeIn(300)
output+='</div>'
$('#main').append(output)
var tmp=id.split('_')
self.renderContentView(self.fetchNode(tmp[1],tmp[2]),$('#content_subnav_'+tmp[1]+'_'+tmp[2]))
break;}
history.push({'level':level,'id':id})
$('#'+level+'_'+id).fadeOut(0).delay(300).fadeIn(300)}}
this.internalNav=function(id){var a=0
var b=0
var output=''
for(var i in self.data.content){for(var j in self.data.content[i]){if(parseInt(self.data.content[i][j].id)==id){output=a+'_'+b
self.section="nav_"+a}
b++;}
b=0
a++;}
return output}
this.fetchNode=function(c,d){var output=null;var a=0;var b=0;for(var i in self.data.content){if(a==parseInt(c)){output=self.data.content[i]
if(d!=null){for(var j in self.data.content[i]){if(b==parseInt(d)){output=self.data.content[i][j]
output.index=b+1}
b++}}}
a++}
return output;}
this.renderContentView=function(subnode,$div){self.content_node=subnode
var images=subnode.asset_id.split('|')
output='<h2 style = "background-color:'+self.data.categories[subnode.area].colour1+';">'+subnode.index+'. '+subnode.subarea+'</h2>'
output+='<div>'
output+=subnode.content.replace(/<a/g,'<p').replace(/p>/g,'p>')
if(subnode.next!=null){output+='<a class = "internal next_btn" href = "'+subnode.next+'">Next exercise</a>'}
output+='</div>'
$div.html(output)
$($div.find('.interactive')).each(function(index,element){$(element).before('<div class = "center"><img style="height:325px;" src="assets/'+images[index]+'"/></div>')});$($div.find('.next_btn')).css('background-color',self.data.categories[subnode.area].colour1)
$($div.find('.next_btn')).on('click',function(evt){var nav_id=$(this).attr("href")
$(this).css('background-color',self.data.categories[subnode.area].colour2)
setTimeout(function(){self.navigate('content','subnav_'+self.internalNav(nav_id))},100)
evt.preventDefault();})
$div.find('.interactive>span').remove()}
this.closeMenu=function(){$header.css('position','fixed')
$('#main').css('position','relative')
$menu.fadeOut(300,function(){$(this).html('')});$menu_bg.fadeOut(300);}
this.showMenu=function(){$('body').addClass('noscroll')
$menu.fadeIn(300);$menu_bg.fadeTo(300,0.01);var current_page=(history[history.length-1])
var output='<a href="javascript:;" id = "menu_close" ></a><div><a href="javascript:;" class = "item emphasis" id = "menu-0" >Main menu</a>'
var a=0
for(var i in self.data.content){if(current_page.id=='nav_'+a&&current_page.level=='sub_menu'){output+='<a href="javascript:;" class = "item current"  style = "background-color:'+self.data.categories[i].colour1+';" id = "sub_menu-nav_'+a+'">'+self.data.categories[i].title+'</a>'}else{output+='<a href="javascript:;" class = "item" id = "sub_menu-nav_'+a+'">'+self.data.categories[i].title+'</a>'}
if('nav_'+a==self.section){var b=0
for(var j in self.data.content[i]){if(current_page.id=='subnav_'+a+'_'+b&&current_page.level=='content'){output+='<a href="javascript:;" class = "item indent current" style = "background-color:'+self.data.categories[i].colour1+';" id = "content-subnav_'+a+'_'+b+'">'+j+'</a>'}else{output+='<a href="javascript:;" class = "item indent" id = "content-subnav_'+a+'_'+b+'">'+j+'</a>'}
b++;}}
a++}
output+='</div>'
$menu.html(output);$('#menu_close').on('click',function(){self.closeMenu();})
$('#menu .item').on('click',function(evt){$(evt.target).css('background-color','#b2d0e9');var tmp=evt.target.id.split('-')
var node=tmp[1].split('_')
self.navigate(tmp[0],tmp[1]);switch(tmp[0]){case'menu':break;case'sub_menu':wt_l1=$(evt.target).html();break;case'content':wt_l1=$('#sub_menu-nav_'+node[1]).html()
wt_l2=$(evt.target).html();break;}
self.closeMenu();})
self.resizeLayout()}
this.init=function(){if(inIframe()){self.navigate('splash',0)}else{self.navigate('menu',0)}
$back_btn.on('click',function(){self.backUp();})
$menu_btn.on('click',function(){self.showMenu();})
$('body').fadeIn(500,function(){})}
this.resizeLayout=function(){var h=0
$('#main .page').each(function(index,element){h=Math.max($(element).height())});h+=($header.height()+100)
$('#menu_bg').height(h)}
$(window).on('resize',function(){self.resizeLayout()})}
function maintainState(r,i){var self=this;var init=false;var id=i
var root=r;self.visits=0;self.co_f=makeID(32);self.data={}
this.storeState=function(){if(init){self.data={};self.data['questions']=[];for(var q in root.data.questions){self.data['questions'].push(root.data.questions[q].selected)}
self.data.area=root.area
self.data.current_index=root.quiz.current_index
self.data.current_question=root.quiz.current_question
self.data.co_f=self.co_f;self.data.visits=self.visits;$.cookie("nhs_SA-"+id,JSON.stringify(self.data));}}
this.clearState=function(){init=true}
this.restoreState=function(){if($.cookie("nhs_SA-"+id)!=null){self.data=jQuery.parseJSON($.cookie("nhs_SA-"+id));if(!isNaN(parseInt(self.data.visits))){self.visits=parseInt(self.data.visits)+1;}
if(self.data.hasOwnProperty('co_f')){self.co_f=self.data.co_f}
root.restoreState(self.data)}
self.clearState();}}
function navObj(root){var self=this;self.root=root
self.qObj=null;self.preview=false;var $header=$('#antbits-SA_'+root.id+' #antbits-SA-header')
var $nav=$('#antbits-SA_'+root.id+' #antbits-SA-nav')
var $nav_q=$('#antbits-SA_'+root.id+' #antbits-SA-nav_q')
var $nav_r=$('#antbits-SA_'+root.id+' #antbits-SA-nav_r')
var $nav_l=$('#antbits-SA_'+root.id+' #antbits-SA-nav_l')
var $progress=$('#antbits-SA_'+root.id+' #antbits-SA-progress')
var $progress_bar=$('#antbits-SA_'+root.id+' #antbits-SA-progress>div')
var $check=$('#antbits-SA_'+root.id+' #antbits-SA-nav_check')
var $next=$('#antbits-SA_'+root.id+' #antbits-SA-nav_next')
var $back=$('#antbits-SA_'+root.id+' .antbits-SA-nav_back')
var $links=$('#antbits-SA_'+root.id+' .antbits-SA-nav_links')
var $finish=$('#antbits-SA_'+root.id+' .antbits-SA-nav_finish')
if(root.data.config.progress_bar=='1'){$progress_bar.css('background-color','#'+self.root.data.config.colour_1[0])}else{$progress_bar.remove();$progress.remove();}
$next.css('background-color','#'+self.root.data.config.colour_1[0]).on('click',function(){if(!self.preview){if(!$next.hasClass('antbits-SA_inactive')){self.root.slideNext()}
setTimeout(function(){$next.css('background-color','#'+self.root.data.config.colour_1[0]);},100)}})
$back.css('background-color','#'+self.root.data.config.colour_1[0]).on('click',function(){if(!self.preview){self.root.slideBack();setTimeout(function(){$back.css('background-color','#'+self.root.data.config.colour_1[0]);},100);}})
$check.css('background-color','#'+self.root.data.config.colour_1[0]).on('click',function(){if(!$check.hasClass('antbits-SA_inactive')){$next.removeClass('antbits-SA_inactive');$check.addClass('antbits-SA_inactive');self.qObj.obj.showAnswer();}})
$nav.find('.antbits-SA-nav_button').bind("mouseenter focus focusout mouseleave click",function(event){if(event.type=='mouseenter'||event.type=='focus'||event.type=='click'){$(this).css('background-color','#'+self.root.data.config.colour_1[1]);}else{$(this).css('background-color','#'+self.root.data.config.colour_1[0]);}});self.checkState=function(){switch(root.area){case'splash':$nav.stop().fadeOut(500);break;case'questions':$nav.stop().fadeIn(500)
if(self.qObj.quiz_active&&self.qObj.selected.length>0){$check.removeClass('antbits-SA_inactive');}
break;case'results':$nav.stop().fadeIn(500);break;case'links':$nav.stop().fadeIn(500);break;}}
self.unlock=function(){if(self.qObj.quiz_active){self.showQuizAnswer();}else{$next.removeClass('antbits-SA_inactive');}}
self.showQuizAnswer=function(){$check.removeClass('antbits-SA_inactive');}
self.updateProgress=function(quiz){if(root.data.config.progress_bar=='1'){self.qObj=root.getCurrentQ();$progress_bar.stop().animate({width:(Math.min(1,quiz.getIndex()/quiz.getTotal())*100)+'%'},300);}}
self.setState=function(val){self.qObj=root.getCurrentQ();switch(val){case 0:$nav_q.show();$nav_r.hide();$nav_l.hide();$progress.show()
$next.addClass('antbits-SA_inactive');$back.removeClass('antbits-SA_inactive');$check.hide();break;case 1:$nav_q.show()
$nav_r.hide()
$nav_l.hide()
$progress.show()
if(self.qObj.selected.length>0){$next.removeClass('antbits-SA_inactive')}else{$next.addClass('antbits-SA_inactive')}
$back.removeClass('antbits-SA_inactive')
$check.hide()
break;case 2:$nav_q.hide()
$nav_r.show()
$nav_l.hide()
$progress.hide()
break;case 3:$nav_q.hide()
$nav_r.hide()
$nav_l.show()
$progress.hide()
break;case 4:$nav.stop().fadeOut(500)
break;}
if(self.qObj.quiz_active){if(val>=3||(val==0&&self.qObj.id==0)){$back.show();}else{$back.hide();}
$next.addClass('antbits-SA_inactive')
$progress.hide();$check.show();$check.addClass('antbits-SA_inactive')}}}
function qSelectObj(qobj,padding){var self=this;var parent_obj=qobj;self.padding=padding
var $fade_top,$fade_bottom;parent_obj.data.selected=[];for(var a in parent_obj.data.answers){parent_obj.$pane.append('<a href = "#'+a+'" class = "antbits-SA-answer"><div class = "antbits-SA-bullet"></div><div class = "antbits-SA-bullet_inner"></div><div class = "antbits-SA-bullet_selected" style = "background-color:#'+parent_obj.root.data.config.colour_1[0]+'"></div><div>'+parent_obj.data.answers[a]['body']+'</div></a><br>')}
$(parent_obj.$pane.find('.antbits-SA-bullet_selected')).hide();parent_obj.$pane.find('a').on('click',function(e){self.toggle(parseInt(this.href.split('#').pop()))
parent_obj.root.nav.unlock();parent_obj.root.quiz.build();parent_obj.root.stateObj.storeState();e.preventDefault();}).on('mouseout',function(e){$(e.target).blur();});$fade_top=$('<div class ="antbits-SA-fade antbits-SA-fade_top" ></div>').appendTo(parent_obj.$node)
$fade_bottom=$('<div class ="antbits-SA-fade antbits-SA-fade_bottom" ></div>').appendTo(parent_obj.$node)
this.toggle=function(id){$(parent_obj.$pane.find('.antbits-SA-bullet_selected')).each(function(index,element){if(parent_obj.data.type=='single select'){parent_obj.data.selected=[id];if(index==id){$(element).show();}else{$(element).hide();}}else{if(id==index){if(parent_obj.data.selected.indexOf(id)==-1){$(element).show();parent_obj.data.selected.push(id)}else if(parent_obj.data.selected.length>1){$(element).hide();parent_obj.data.selected.splice(parent_obj.data.selected.indexOf(id),1);}else{$(element).hide();}}}});}
this.resetState=function(){self.toggle(null);parent_obj.data.selected=[];}
this.focusFirst=function(){}
this.resizeLayout=function(d_h){var pad=0;d_h-=(padding.top+padding.bottom)
var h=d_h-(parent_obj.$q_header.height()-16)
var a=parent_obj.data.answers.length
var a_h=0;$(parent_obj.$pane.find('.antbits-SA-answer')).each(function(index,element){a_h+=$(element).outerHeight();});if(a_h+((a+1)*10)>h){pad=10;parent_obj.$pane.css('overflow-y','auto');var pos=parent_obj.$pane.position();$fade_top.show().css('top',pos.top+parseInt(parent_obj.$pane.css('margin-top')));$fade_bottom.show().css('bottom',pos.bottom);}else{pad=(h-a_h)/(a+1);$fade_top.hide();$fade_bottom.hide();}
$(parent_obj.$pane.find('.antbits-SA-answer')).css('margin',pad+'px 0px 0px 0px');}
this.restore=function(){$(parent_obj.$pane.find('.antbits-SA-bullet_selected')).each(function(index,element){if(parent_obj.data.selected.indexOf(index)>-1){$(element).show()}else{$(element).hide()}});}
this.setState=function(){}
this.getState=function(){}}
function questionObj(root,qdata,$c,$r,index){var self=this;self.$container=$c
var $results=$r
var padding={top:0,bottom:0}
var $answer_pane,$answer_pane_correct,$answer_pane_incorrect;self.root=root
self.data=qdata;self.input_obj=null;self.answer_obj=null;self.active=true;self.h=0;var output='<div class = "antbits-SA-page" id="antbits-SA-Q'+index+'">'
output+='<div class = "antbits-SA-q_header"><h2>Q 1 of 1</h2><div class = "antbits-SA-qhead">'+self.data.body+'</div><hr></div>'
output+='<div class = "antbits-SA-qpane">'
if(self.data.quiz_active){output+='<div class = "antbits-SA-quiz_answer">'
output+='<div class = "antbits-SA-quiz_correct"><h3>Correct</h3><strong>Answer : '+self.data.quiz_answer+'</strong><p>'+self.data.quiz_check+'</p></div>'
output+='<div class = "antbits-SA-quiz_incorrect"><h3>Incorrect</h3><strong>Answer : '+self.data.quiz_answer+'</strong><p>'+self.data.quiz_check+'</p></div>'
output+='</div>';}
output+='</div></div>'
self.$node=$(output).insertBefore($results)
self.$node.hide();self.$pane=self.$node.find('.antbits-SA-qpane');if(self.data.quiz_active){$answer_pane=self.$node.find('.antbits-SA-quiz_answer');$answer_pane_correct=self.$node.find('.antbits-SA-quiz_answer .antbits-SA-quiz_correct');$answer_pane_incorrect=self.$node.find('.antbits-SA-quiz_answer .antbits-SA-quiz_incorrect');$answer_pane.fadeOut(0)}
self.$q_header=self.$node.find('.antbits-SA-q_header');var q_header_h=0;if(self.data.info_box>0){self.infoBoxObj=self.root.getInfoBox(self.data.info_box)
if(self.infoBoxObj!=null){self.$pane.before('<a href="javascript:;" class = "antbits-SA-info_box" style = "color:#'+self.root.data.config.colour_1[0]+' !important;">'+self.infoBoxObj.title+'</a>');var $info_link=self.$node.find('.antbits-SA-info_box');if(self.data.info_box_position==0){padding.top=20;self.$pane.css('margin-top',padding.top+'px')}else{$info_link.css('bottom',0);padding.bottom=12;}
$info_link.on('click',function(){self.root.dialog.launch(self.infoBoxObj);})}}
switch(self.data.type){case"single select":self.input_obj=new qSelectObj(this,padding);break;case"multiple select":self.input_obj=new qSelectObj(this,padding);break;case"gender":self.input_obj=new genderSelectObj(this,padding);break;case"yes/no":self.input_obj=new boolSelectObj(this,padding);break;case"true/false":this.input_obj=new tfSelectObj(this,padding);break;}
self.data.obj=this
this.updateHeader=function(a,b){if(self.root.data.config.progress_bar=='1'){$(self.$node.find('h2')).html('Q '+a+' of '+b)}else{$(self.$node.find('h2')).html('Q '+a)}}
this.focusFirst=function(){setTimeout(function(){self.$pane.find('a')[0].focus();self.input_obj.focusFirst()},301)}
this.restore=function(){if(self.input_obj!=null){self.input_obj.restore();}}
this.resetObj=function(){self.active=false;self.data.selected=[];if(self.input_obj!=null){self.input_obj.resetState();}}
this.slideIn=function(d){if(d==1){if(self.data.id==0){self.$pane.stop().fadeOut(0)
setTimeout(function(){self.root.quiz.build()},300)}
self.$node.css('left',self.$container.outerWidth()).show().animate({'left':0},300,function(){self.$pane.stop().fadeIn(300)});}else{self.$node.css('left',0-self.$container.outerWidth()).show().animate({'left':0},300,function(){self.$pane.stop().fadeIn(300)});}
if(self.data.selected.length==0){self.root.nav.setState(0)}else{self.root.nav.setState(1)}
self.input_obj.resizeLayout(self.h);}
this.slideOut=function(d){if(d==1){self.$node.animate({'left':(0-self.$container.outerWidth())},300,function(){$(this).hide()});}else{self.$node.animate({'left':(self.$container.outerWidth())},300,function(){$(this).hide()});}}
this.showAnswer=function(){$answer_pane.stop().fadeIn(300,function(){console.log($answer_pane)
self.$pane.find('a').hide();});if(self.root.quiz.checkCorrect(self.data.id)==1){$answer_pane_correct.show();$answer_pane_incorrect.hide();}else{$answer_pane_correct.hide();$answer_pane_incorrect.show();}}
this.resizeLayout=function(w,h){self.h=h
self.$node.width(w).height(h);if(self.input_obj!=null){self.input_obj.resizeLayout(self.h);}
if(!self.$node.is(':visible')){self.$node.show();q_header_h=self.$q_header.height()
self.$node.hide();}else{q_header_h=self.$q_header.height()}
self.$pane.height((h+16)-(q_header_h+padding.top+padding.bottom));}}
function quizObj(root){var self=this
self.root=root
self.points=0;self.quiz_points=0;self.vid_arr=[];self.link_arr=[];self.result_arr=[];self.quiz_arr=[];self.answer_arr=[];self.quiz_vars={};self.debug
self.q_obj_arr=[];self.active_total=self.root.data.questions.length
self.current_index=0
self.current_question=0
this.getCurrent=function(){return self.root.data.questions[self.current_question];}
this.getNext=function(){for(var a=0;a<self.root.data.questions.length;a++){if(self.root.data.questions[a].id>self.current_question&&self.root.data.questions[a].obj.active==true){self.current_question=self.root.data.questions[a].id
break;}}
return self.root.data.questions[self.current_question];}
this.getPrevious=function(){for(var a=self.root.data.questions.length-1;a>=0;a--){if(self.root.data.questions[a].id<self.current_question&&self.root.data.questions[a].obj.active==true){self.current_question=self.root.data.questions[a].id
break;}}
return self.root.data.questions[self.current_question];}
this.getIndex=function(){return self.current_index;}
this.isComplete=function(){if(self.active_total==self.current_index){return true;}else{return false;}}
this.reset=function(){for(var a=0;a<self.root.data.questions.length;a++){self.root.data.questions[a].obj.resetObj();}

self.current_index=0
self.current_question=0}
this.getTotal=function(){return self.active_total;}
this.cancelAnswers=function(){console.log('cancelActions')
for(var a=0;a<self.root.data.questions.length;a++){var q_obj=self.root.data.questions[a];if(self.current_question<q_obj.id){q_obj.obj.resetObj();}}}
this.setPreview=function(){self.current_question=self.root.data.questions.length
for(var a=0;a<self.root.data.questions.length;a++){self.root.data.questions[a].obj.active=true
self.root.data.questions[a].selected=[1];}
self.build();}
this.build=function(){console.log('build')
for(var i in self.root.data.qvars)
{if(i!='undefined'){if(i.indexOf(":number")>0){self.quiz_vars[i]=0;}else{self.quiz_vars[i]=null;}}}
self.cancelAnswers();self.quiz_arr=[];self.points=0;self.quiz_points=0;self.vid_arr=[];self.link_arr=[];self.result_arr=[];self.current_index=0;i=0;self.active_total=0;for(var a=0;a<self.root.data.questions.length;a++){var answer_rec=self.root.data.questions[a].selected
if(typeof answer_rec!=undefined&&answer_rec!=null){for(var b=0;b<answer_rec.length;b++)
{if(answer_rec[b]<self.root.data.questions[a].answers.length&&self.root.data.questions[a].answers[answer_rec[b]]!=undefined)
{if(self.root.data.questions[a].answers[answer_rec[b]].actions.length==undefined){self.root.data.questions[a].answers[answer_rec[b]].actions=Array(self.root.data.questions[a].answers[answer_rec[b]].actions)}
for(var c=0;c<self.root.data.questions[a].answers[answer_rec[b]].actions.length;c++)
{var ac=self.root.data.questions[a].answers[answer_rec[b]].actions[c]
switch(ac.type){case"points":if(Number(ac.value)>0){eval('self.points '+ac.operator+'='+ac.value)}
break;case"quiz":break;case"result":self.result_arr.push(Number(ac.value))
break;case"video":self.vid_arr.push(ac.value)
break;case"link":self.link_arr.push(Number(ac.value))
break;case"set variable":if(ac.sub_type.indexOf(":number")>0){if(isNaN(self.quiz_vars[ac.sub_type])){self.quiz_vars[ac.sub_type]=0;}
switch(ac.operator){case'+':self.quiz_vars[ac.sub_type]+=Number(ac.value);break;case'-':self.quiz_vars[ac.sub_type]-=Number(ac.value);break;case'=':self.quiz_vars[ac.sub_type]=Number(ac.value);break;}}else{self.quiz_vars[ac.sub_type]=ac.value;}
break;}}}}}
self.root.data.questions[a].obj.active=self.checkQ(self.root.data.questions[a])
if(self.root.data.questions[a].obj.active){self.active_total++
if(self.root.data.questions[a].id<=self.current_question){self.current_index++}else{self.root.data.questions[a].obj.data.selected=[];self.root.data.questions[a].obj.restore()}}
self.root.nav.updateProgress(self)
if(self.checkQ(self.root.data.questions[a]))
{i++;self.quiz_arr.push(self.root.data.questions[a]);}
self.result_arr=self.root.sortUnique(self.result_arr)}
var i=0
for(var a=0;a<self.root.data.questions.length;a++){if(self.root.data.questions[a].obj.active){i++;self.root.data.questions[a].obj.updateHeader(i,self.active_total);}}
console.log('build complete')
console.log(self)}
this.checkQ=function(q){var output=true
var net=0
if(q.action!=undefined){var condition=true
if(q.action.condition=="show if"){condition=false}
for(var a in self.quiz_vars){switch(q.action.property)
{case"points":if(eval(self.points+" "+q.action.operator+" "+q.action.value)&&condition){output=false}
if(!eval(self.points+" "+q.action.operator+" "+q.action.value)&&!condition){output=false}
break;case"gender":if(q.action.operator=="="&&q.action.value==self.quiz_vars["gender"]&&q.action.condition=="hide if")
{output=false;}
if(q.action.operator=="="&&q.action.value!=self.quiz_vars["gender"]&&q.action.condition=="show if")
{output=false;}
if(q.action.operator!="="&&q.action.value!=self.quiz_vars["gender"]&&q.action.condition=="hide if")
{output=false;}
if(q.action.operator!="="&&q.action.value==self.quiz_vars["gender"]&&q.action.condition=="show if")
{output=false;}
break;default:var answer_index=0;var action_index=0;var c=0
if((self.quiz_vars[a]==null||self.quiz_vars[a]==undefined)&&q.action.condition=="show if"&&q.action.property==a){output=false;}else{var allowed=false
for(var b in self.root.data.qvars[q.action.property])
{if(self.root.data.qvars[q.action.property]!=undefined){allowed=true}
if(self.root.data.qvars[q.action.property][b]==q.action.value)
{action_index=c;}
if(self.root.data.qvars[q.action.property][b]==self.quiz_vars[q.action.property])
{answer_index=c;}
c++;}
if(allowed==false&&q.action.condition=="show if"){output=false;}
net=answer_index-action_index;if(q.action.condition=="show if")
{net=0-net;}
if(net!=0&&q.action.condition=="show if"&&q.action.operator=="="){output=false;}
if(net==0&&q.action.condition=="hide if"&&q.action.operator=="="&&self.quiz_vars[a]!=null){output=false;}
if(net>-1&&q.action.operator==">"){output=false;}
if(net<1&&q.action.operator=="<"){output=false;}}}}}
return output;}
this.checkCorrect=function(id){var output=1;for(var a in self.root.data.questions[id].answers){var anode=self.root.data.questions[id].answers[a]
for(var b in anode.actions){if(anode.actions[b].type=='quiz'){if(self.root.data.questions[id].selected.indexOf(parseInt(a))==-1&&anode.actions[b].value==1){output=0}
if(self.root.data.questions[id].selected.indexOf(parseInt(a))>-1&&anode.actions[b].value==0){output=0}}}}
return output;}
this.quizScore=function(){self.quiz_points=0
self.quiz_summary=[]
var q=0;for(var a=0;a<self.root.data.questions.length;a++){var correct=self.checkCorrect(self.root.data.questions[a].id)
if(correct==1){q++
self.quiz_points+=1
self.quiz_summary.push({"title":"Q "+q,"sub_title":"Correct","body":self.root.data.questions[a].quiz_summary})}else{q++
self.quiz_summary.push({"title":"Q "+q,"sub_title":"Incorrect","body":self.root.data.questions[a].quiz_summary})}}}
this.generateResults=function(){var output={};if(self.root.quiz){self.quizScore();output['quiz_data']={"points":self.quiz_points,"summary":self.quiz_summary}}
output['vid_arr']=self.root.sortUnique(self.vid_arr);output['link_arr']=self.root.sortUnique(self.link_arr);output['result_arr']=self.root.sortUnique(self.result_arr);output['points']=self.points
output['quiz_points']=self.quiz_points
output['quiz_summary']=self.quiz_summary
output['quiz_arr']=self.quiz_arr
output['quiz_vars']=self.quiz_vars
console.log(output)
return output;}}
function resultsObj($rnode,$lnode,quiz,root){var self=this
self.root=root
self.rs=null;self.quiz=quiz
self.$rnode=$rnode
self.$lnode=$lnode
self.$rnode_inner=$rnode.find('div')
self.$lnode_inner=$lnode.find('div')
var points,quiz_points
var rfade=new fadeObj(self.$rnode_inner)
var lfade=new fadeObj(self.$lnode_inner)
this.populate=function(){self.rs=self.quiz.generateResults()
self.$rnode_inner.html('')
self.$lnode_inner.html('')
ignore=false
for(var a in self.root.data.results){self.renderResult(self.root.data.results[a],self.rs,true,self.$rnode_inner);}
for(var a in self.root.data.results){self.renderResult(self.root.data.results[a],self.rs,false,self.$rnode_inner);}
for(var a in self.root.data.links){self.renderResult(self.root.data.links[a],self.rs,false,self.$lnode_inner);}
self.$rnode.find('a').css('color','#'+self.root.data.config.colour_1[0])
self.$lnode.find('a').css('color','#'+self.root.data.config.colour_1[0])
self.resizeLayout();}
this.renderResult=function(data,rs,p,$node){switch(data.type){case'image':if(p){$('<div class = "antbits-SA-results_image"><img src="'+self.root.asset_path+'/'+data.text+'" alt="'+data.p1+'"></div>').appendTo($node);}
break;case'progress bar':if(!p){points=Math.min(rs.points,data.p2)
quiz_points=Math.min(rs.quiz_points,rs.quiz_arr.length)
if(data.p3=="Points"||data.p3==""){var percent=(points/Number(data.p2))*100
var pval=points}else if(data.p3=="Quiz"){data.p2=rs.quiz_arr.length
var percent=(quiz_points/data.p2)*100
var pval=quiz_points}else{var pval=rs.quiz_vars[data.p3]
var percent=(pval/Number(data.p2))*100}
var output='<div class= "antbits-SA-results_progress_bar"><div>'+data.text+' <span class="antbits-SA-impact" style="color:#'+self.root.data.config.colour_1[0]+';">'+pval+'</span></div>'
output+='<div><div class="antbits-SA-results_progress_bg"></div>'
output+='<div class = "antbits-SA-results_progress_fg" style="width:'+percent+'%;background-color:#'+self.root.data.config.colour_1[0]+';"></div>'
output+='</div><div class = "antbits-SA-results_progress_captions"><div>'+data.p1+'</div><div>'+data.p2+'</div></div>'
output+='</div>'
$(output).appendTo($node);}
break;case'text':if(!p){$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo($node);}
break;case'quiz results':if(!p){for(var key in rs.quiz_summary){$('<div class = "antbits-SA-results_text antbits-SA-quiz_summary"><div class="antbits-SA-quiz_'+rs.quiz_summary[key].sub_title+'">'+rs.quiz_summary[key].title+'<div>'+rs.quiz_summary[key].sub_title+'</div></div><p>'+rs.quiz_summary[key].body+'</p></div>').appendTo($node);}}
break;case'points triggered result':if(!p){if(rs.points>=Number(data.p1)&&rs.points<Number(data.p2)){$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo($node);}}
break
case'quiz triggered result':if(!p){if(quiz_points>=Number(data.p1)&&quiz_points<Number(data.p2)){$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo($node);}}
break
case'variable triggered result':if(!p){var pval=self.__vc.__quiz_obj.__quiz_vars[data.p3]
if(pval>=data.p1&&pval<data.p2){$('<div class = "antbits-SA-results_text">'+data.text+'</div>').appendTo($node);}}
break;case'accumulated results':var tmp=''
var c=0
if(!p){tmp+='<ul class = "antbits-SA-results_text">'}
for(var a in rs.result_arr){if(rs.result_arr[a]!='undefined'){for(var b in self.root.data.result_items){if(parseInt(self.root.data.result_items[b].id)==rs.result_arr[a]){if(p&&self.root.data.result_items[b].priority=='1'&&ignore==false){$('<div class = "antbits-SA-results_priority">'+self.root.data.result_items[b].text+'</div>').appendTo($node);ignore=true}
if(!p&&self.root.data.result_items[b].priority!='1'){tmp+='<li>'+self.root.data.result_items[b].text+'</li>';c++;}
break;}}}}
if(!p){tmp+='</ul>'}
if(c>0){$(tmp).appendTo($node);}
break;case'accumulated links':for(var a in rs.link_arr){if(rs.link_arr[a]!='undefined'){for(var b in self.root.data.link_items){if(self.root.data.link_items[b].id==rs.link_arr[a]){$('<div class="antbits-SA-link_bullet"><a href="'+self.root.data.link_items[b].url+'"   target = "top"><img src = "images/bullet_mask.png" style="background-color:#'+self.root.data.config.colour_1[0]+';"><div>'+self.root.data.link_items[b].text+'</div></a></div>').appendTo($node);break;}}}}
break;case'accumulated videos':for(var a in rs.vid_arr){if(rs.vid_arr[a]!='undefined'){for(var b in self.root.data.videos){if(self.root.data.videos[b].id==rs.vid_arr[a]){$('<div class="antbits-SA-link_bullet"><a href="'+self.root.data.videos[b].url+'"   target = "top"><img src = "images/vid_mask.png" style="background-color:#'+self.root.data.config.colour_1[0]+';"><div>'+self.root.data.videos[b].text+'</div></a></div>').appendTo($node);break;}}}}
break;case'obligatory link':for(var b in self.root.data.link_items){if(data.text==self.root.data.link_items[b].id){$('<div class="antbits-SA-link_bullet"><a href="'+self.root.data.link_items[b].link_url+'"   target = "top"><img src = "images/bullet_mask.png" style="background-color:#'+self.root.data.config.colour_1[0]+';"><div>'+self.root.data.link_items[b].text+'</div></a></div>').appendTo($node);}}
break;case'obligatory video':console.log(data)
var vid=$('<div class="antbits-SA-link_bullet"><a href="#'+data.text+'"   target = "top"><img src = "images/vid_mask.png" style="background-color:#'+self.root.data.config.colour_1[0]+';"><div>'+self.root.data.bc_lookup[data.text].name+'</div></a></div>').appendTo($node);$(vid).on('click',function(event){event.preventDefault();self.root.launchVid(event.target.href.split('#').pop());})}}
this.resizeLayout=function(area){rfade.setFades();lfade.setFades();}
this.slideIn=function(d){if(d==1){self.$rnode.css('left',self.$rnode.outerWidth()).show().animate({'left':0},300,function(){});}else{self.$rnode.css('left',0-self.$rnode.outerWidth()).show().animate({'left':0},300,function(){});}}
this.slideOut=function(d){if(d==1){self.$rnode.animate({'left':(0-self.$rnode.outerWidth())},300,function(){$(this).hide()});}else{self.$rnode.animate({'left':(self.$rnode.outerWidth())},300,function(){$(this).hide()});}}}
function tfSelectObj(qobj,padding){var self=this;var parent_obj=qobj;var $btns_bg,$btns_fg,$btns;parent_obj.data.selected=[];parent_obj.$pane.append('<div class = "antbits-SA-answer_tf"><div>'+initCaps(parent_obj.data.answers[0]['body'])+'</div><a href = "#0">'+initCaps(parent_obj.data.answers[0]['body'])+'</a></div>')
parent_obj.$pane.append('<div class = "antbits-SA-answer_tf"><div>'+initCaps(parent_obj.data.answers[1]['body'])+'</div><a href = "#1">'+initCaps(parent_obj.data.answers[1]['body'])+'</a></div>')
$btns=parent_obj.$pane.find('.antbits-SA-answer_tf')
$btns_bg=parent_obj.$pane.find('.antbits-SA-answer_tf>div')
$btns_fg=parent_obj.$pane.find('.antbits-SA-answer_tf>a')
$btns_fg.css('border','2px solid #'+parent_obj.root.data.config.colour_1[0]).css('color','#'+parent_obj.root.data.config.colour_1[0])
$btns_bg.css('border','2px solid #'+parent_obj.root.data.config.colour_1[0]).css('background-color','#'+parent_obj.root.data.config.colour_1[0])
parent_obj.$pane.css('text-align','center')
$btns_fg.on('click',function(e){self.toggle(parseInt(e.target.href.split('#').pop()))
parent_obj.root.nav.unlock();parent_obj.root.quiz.build();parent_obj.root.stateObj.storeState();e.preventDefault();}).on('mouseout',function(e){$(e.target).blur();});$btns_fg.bind("mouseenter focus focusout mouseleave",function(event){var index=parseInt(event.target.href.split('#').pop())
if(event.type=='mouseenter'||event.type=='focus'){if(index==parent_obj.data.selected[0]){$($btns_bg[index]).css('background-color','#'+parent_obj.root.data.config.colour_1[1]);}else{$(this).css('background-color','#e4e4e4');}}else{if(index==parent_obj.data.selected[0]){$($btns_bg[index]).css('background-color','#'+parent_obj.root.data.config.colour_1[0]);}else{$(this).css('background-color','#FFF');}}});this.toggle=function(id){$btns_fg.each(function(index,element){parent_obj.data.selected=[id];if(index==id){$(element).animate({'opacity':0.01},300);$($btns_fg[index]).css('background-color','#FFF');}else{$(element).animate({'opacity':1},300);}});}
this.resetState=function(){self.toggle(null);parent_obj.data.selected=[];}
this.focusFirst=function(){}
this.resizeLayout=function(d_h){if(parent_obj.$pane.height()>0){d_h-=(padding.top+padding.bottom)
var h=d_h-(parent_obj.$q_header.height()-16)
var btn_size=Math.min(d_h*0.42,parent_obj.$pane.innerWidth()*0.4);$btns.width(btn_size)
var pad=(h-$($btns[0]).height())*0.5;$btns.css('margin-top',pad)}}
this.restore=function(){if(parent_obj.data.selected.length>0){self.toggle(parent_obj.data.selected[0])}}
this.setState=function(){}
this.getState=function(){}}
var isMobile={Android:function(){return navigator.userAgent.match(/Android/i)?true:false;},Tablet:function(){return navigator.userAgent.match(/iPad|(?!.*mobile).*Android*/i)?true:false;},BlackBerry:function(){return navigator.userAgent.match(/BlackBerry/i)?true:false;},iOS:function(){return navigator.userAgent.match(/iPhone|iPad|iPod/i)?true:false;},Windows:function(){return navigator.userAgent.match(/IEMobile/i)?true:false;},any:function(){return(isMobile.Android()||isMobile.BlackBerry()||isMobile.iOS()||isMobile.Windows());}};function inIframe(){try{return window.self!==window.top;}catch(e){return true;}}
var loadjscssfile=function(filename,filetype){if(filetype=="js"){var fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript")
fileref.setAttribute("src",filename)}
else if(filetype=="css"){var fileref=document.createElement("link")
fileref.setAttribute("rel","stylesheet")
fileref.setAttribute("type","text/css")
fileref.setAttribute("href",filename)}
if(typeof fileref!="undefined"){document.getElementsByTagName("head")[0].appendChild(fileref)}}
function daysInMonth(month,year){return new Date(year,month,0).getDate();}
function pad(n,width,z){z=z||'0';n=n+'';return n.length>=width?n:new Array(width-n.length+1).join(z)+n;}
function keyEvtNumeric(e){if((e.keyCode>=48&&e.keyCode<=57)||(e.keyCode>=96&&e.keyCode<=105)||e.keyCode==46||e.keyCode==8){return true;}else{return false;}}
function getId(evt){if(evt.target.nodeName=='A'){return evt.target.id}else{return evt.target.parentNode.id}}
function inObj(o,l,r){if(r!=null&&typeof r!='undefined'){o[l]=r;}}
function replaceAll(str,mapObj){var re=new RegExp(Object.keys(mapObj).join("|"),"gi");return str.replace(re,function(matched){return mapObj[matched.toLowerCase()];});}
var arrayUnique=function(a){return a.reduce(function(p,c){if(p.indexOf(c)<0)p.push(c);return p;},[]);};function getUrlVars()
{var vars=[],hash;var hashes=window.location.href.slice(window.location.href.indexOf('?')+1).split('&');for(var i=0;i<hashes.length;i++)
{hash=hashes[i].split('=');vars.push(hash[0]);vars[hash[0]]=hash[1];}
return vars;}
function initCaps(str){return str.charAt(0).toUpperCase()+str.slice(1);}
function getParentId(e){var node=$(e.target)
while(node.attr('id')==undefined){if(node[0].nodeName=='BODY'){break;}
node=node.parent();}
return node.attr('id')}
makeID=function(l){var output="";var chars="0123456789";for(var i=0;i<l;i++)
output+=chars.charAt(Math.floor(Math.random()*chars.length));return output;}
Date.prototype.yyyymmdd=function(){var mm=(this.getMonth()+1).toString();var dd=this.getDate().toString();return[this.getFullYear(),mm.length===2?'':'0',mm,dd.length===2?'':'0',dd].join('');};