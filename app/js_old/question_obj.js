function question_obj(vc,qdata,index){
	//console.time('added Q '+index);
	this.__vc = vc;
	this.__qdata = qdata;
	this.__id = qdata.id
	this.__index = index
	this.__selected = null
	this.__correct = null
	this.__incorrect = null
	this.__q
	this.__answers = Array();
	var self = this
	var output = "<div class=\"page\"  id = \"q_"+this.__id+"\"><div id = \"q_"+this.__id+"_head\">";
	if(self.__vc.__preview == null || self.__vc.__preview == ""){
		output+= "<div class=\"q_progress\" id = \"q_progress_"+index+"\"><div>Q " + index  + " of " + vc.__quiz_obj.__quiz_arr.length+"</div></div>"
	}else{
		output+= "<div class=\"q_progress\" id = \"q_progress_"+index+"\"><div>Q " + (self.__vc.__preview+1)  + " of " + (self.__vc.__preview+1)+"</div></div>"
	}
	//console.log(qdata)
	output+= "<div class=\"q_body\" >"+qdata.body+"</div></div>"
	output+= "<div class=\"q_answers\">";
	if(self.__vc.__quiz == 1){
		output+= "<div class=\"q_correct\" id = \"q_correct_"+this.__id+"\"><div><h2><img src=\"images/tick_sml.png\" alt=\"tick\">Correct</h2><strong>Answer : "+qdata.quiz_answer+"</strong><br><br>"+qdata.quiz_check+"</div></div>";
		output+= "<div class=\"q_incorrect\" id = \"q_incorrect_"+this.__id+"\"><div><h2><img src=\"images/cross_sml.png\" alt=\"cross\">Incorrect</h2><strong>Answer : "+qdata.quiz_answer+"</strong><br><br>"+qdata.quiz_check+"</div></div>";
	}
	if(qdata.info_box == "0"){
		qdata.info_box = ""
	}
	var str = ''
	if(__vendor == 'IE'){
		str = '_mini'
	}
	if(qdata.info_box != "" && qdata.info_box_position == "0"){
		output+='<div class="info_link"  id="info_link_'+this.__id+'"><a href="javascript:;" id="infobox_'+qdata.info_box+'" >'+this.__vc.infoBoxLookup(qdata.info_box).name+'<img id="infoimg_'+qdata.info_box+'" src = "images/q_icon'+str+'.png"></a></div><br>';
	}
	// render answer markup
	switch(qdata.type){
		case "single select":
			this.__q = new single_select_obj(vc,qdata,index,self,false);
		break;
		case "multiple select":
			this.__q = new single_select_obj(vc,qdata,index,self,true);
		break;
		case "gender":
			this.__q = new gender_select_obj(vc,qdata,index,self);
		break;
		case "yes/no":
			this.__q = new bool_select_obj(vc,qdata,index,self);
		break;
		case "true/false":
			this.__q = new tf_select_obj(vc,qdata,index,self);
		break;
	}
	
	output+=this.__q.init();
	if(qdata.info_box != "" && qdata.info_box_position == "1"){
		output+='<div class="info_link" id="info_link_'+this.__id+'"><a href="javascript:;" id="infobox_'+qdata.info_box+'" >'+this.__vc.infoBoxLookup(qdata.info_box).name+'<img id="infoimg_'+qdata.info_box+'" src = "images/q_icon'+str+'.png"></a></div>';
	}
	output+= "</div>";
	output+= "</div>";
	var $container_inner = $("#container_inner")
	$container_inner.append(output);	
	var $info_link = $("#info_link_"+self.__id)
	var $q_div = $("#q_"+self.__id)
	var $q_body = $("#q_"+self.__id+"_head>.q_body")
	this.__head = $("#q_"+self.__id+"_head")
	this.__title_div = $("#q_progress_"+index+'>div')
	this.__correct = $("#q_correct_"+this.__id)
	this.__incorrect = $("#q_incorrect_"+this.__id)
	this.resizeLayout = function(){
		$q_div.css("left",this.__vc.__width*this.__index);
		this.__q.resizeLayout()
		if(self.__qdata.info_box != "" && self.__qdata.info_box_position == "1"){
			$info_link.css("position","absolute")
			$info_link.css("bottom","0.5em")
			$info_link.css("right",self.__vc.__padding)
		}
		if(self.__vc.__quiz == 1){
			var w = this.__title_div.width()
			var h = self.__vc.__inner_height-($("#nav").height()+this.__head.height()+(self.__vc.__padding*18))
			this.__correct.width(w).height(h)
			this.__incorrect.width(w).height(h)
		}
	}
	this.__q.initAnswers()
}