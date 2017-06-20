window.webtrendsAsyncInit=function(){
    var dcs=new Webtrends.dcs().init({
        dcsid: "dcss9yzisf9xjyg74mgbihg8p_8d2u",
        domain:"statse.webtrendslive.com",
        timezone:0,
        i18n:true,
        adimpressions:true,
        adsparam:"WT.ac",
        offsite:true,
        download:true,
        downloadtypes:"xls,doc,pdf,txt,csv,zip,docx,xlsx,rar,gzip",
        onsitedoms: "nhs.uk",
        fpcdom: ".www.nhs.uk",
        plugins:{
            hm:{src:"//s.webtrends.com/js/webtrends.hm.js"}
        }
        }).track({
			transform:function(dcsObject,multiTrackObject){
				dcsObject.WT.si_n="Tool_"+__data.config.title;
				dcsObject.WT.si_p="Start";
				dcsObject.DCSext.tool_name=__data.config.title;
				dcsObject.DCSext.tool_cat="Self assessments";
				dcsObject.DCSext.tool_type="iframe";
			}
		})
};
(function(){
    var s=document.createElement("script"); s.async=true; s.src="js/webtrends.min.js";    
    var s2=document.getElementsByTagName("script")[0]; s2.parentNode.insertBefore(s,s2);
}());