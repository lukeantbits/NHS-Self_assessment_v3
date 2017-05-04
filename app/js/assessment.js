function assessment_init(){
	var __src = document.getElementById('assessment_webpart');
	var __wrapper = document.getElementById('assessment_webpart_wrapper');
	var __self = this;
	if(!__src.syndicate){
		__src.syndicate = '';
	}
	if(__src.preview == null){
		__wrapper.innerHTML = "<iframe style= \"width:"+__src.dimensions[0]+"px;height:"+ __src.dimensions[1]+"px;\" title=\"self assessments\" src=\""+__src.APPpath+"assessment.html?XMLpath="+__src.XMLpath+"&ASid="+__src.ASid+"&syndicate="+__src.syndicate+"\" frameborder=\"no\" scrolling=\"no\"></iframe>"
	}else{
		__wrapper.innerHTML = "<iframe style= \"width:"+__src.dimensions[0]+"px;height:"+ __src.dimensions[1]+"px;\" title=\"self assessments\" src=\""+__src.APPpath+"assessment.html?preview="+__src.preview+"&XMLpath="+__src.XMLpath+"&ASid="+__src.ASid+"&syndicate="+__src.syndicate+"&cachebuster="+Math.random(1000)+"\" frameborder=\"no\" scrolling=\"no\"></iframe>"
	}
	this.applyReviewDates = function(key){
		var $review_dates = $('#assessment_webpart_date')
		//$.getJSON('ToolsDateHandler.js?datekey='+key, function(data) {
		$.getJSON('/NHSChoices/Handlers/ToolsDateHandler.ashx?datekey='+key, function(data) {
			$review_dates.html('Media last reviewed: <span class="review-pad">'+data[0].LastReviewed+'</span><br>Next review due: <span>'+data[0].NextReviewDue+'</span>')
			//$('#'+id+'_reviewed p',parent.document).css('line-height','0.9em')
		});
	}
	if(__src.displaydate == true){
		__wrapper.innerHTML +='<div id="assessment_webpart_date" class="review-date" style="padding:1em;line-height:13px;"></div>'
		__self.applyReviewDates(__src.datekey)
	}
	this.asEnterMobile = function(){
		window.location.href = __src.APPpath+"assessment.html?XMLpath="+__src.XMLpath+"&ASid="+__src.ASid+"&mobile=true&syndicate="+__src.syndicate
	}
	this.asSetResponsive = function(){
		$('#assessment_webpart_wrapper').css('width','100%')
		$('#assessment_webpart_wrapper>iframe').css('width','100%')
	}
}
assessment_init();