function analytics(vc){
	var self = this
	var usr_str = Array('error','New user','Returning user')
	var syn_id = 'nhs'
	self.__vc = vc
	this.linkEvt = function(title,uri,evt){
		dcsMultiTrack('DCSext.tool_name',__data.config.title,'DCSext.tool_cat','Self assessments','WT.si_p','Outbound link','DCSext.tool_type','iframe','WT.ti',title,'DCSext.tool_postresults','1','DCS.dcssip',evt.target.hostname,'DCS.dcsuri',evt.target.pathname,'DCS.dcsqry',evt.target.search,'WT.dl','101');

	}
	this.advance = function(id,complete,postresults){
		if(syn_id == 'nhs'){
			if (complete){	
				dcsMultiTrack('DCSext.tool_name',__data.config.title,'DCSext.tool_cat','Self assessments','DCSext.tool_start','','DCSext.tool_complete','','DCSext.tool_complete','1','WT.si_n','Tool_'+__data.config.title,'WT.si_p',id,'WT.dl','0','DCSext.tool_user_status','','DCSext.tool_usage','','DCSext.visit_tool_usage','','DCSext.tool_type','iframe','WT.ti',__data.config.title+' - '+id,'DCS.dcsuri','/tools/documents/self_assessments/'+__data.config.title+'/results','WT.si_cs','1');
			}else if(postresults){
				dcsMultiTrack('DCSext.tool_name',__data.config.title,'DCSext.tool_cat','Self assessments','DCSext.tool_start','','DCSext.tool_complete','','WT.si_n','Tool_'+__data.config.title,'WT.si_p',id,'WT.dl','100','DCSext.tool_user_status','','DCSext.tool_usage','','DCSext.visit_tool_usage','','DCSext.tool_type','iframe','WT.ti',__data.config.title+' - '+id,'DCS.dcsuri','/tools/documents/self_assessments/'+__data.config.title+'/links','DCSext.tool_postresults','1');
			}else if(id == 'Q1'){	
				dcsMultiTrack('DCSext.tool_name',__data.config.title,'DCSext.tool_cat','Self assessments','WT.si_n','Tool_'+__data.config.title,'WT.si_p',id,'WT.dl','100','DCSext.tool_user_status','','DCSext.tool_usage','','DCSext.visit_tool_usage','','DCSext.tool_type','iframe','WT.ti',__data.config.title+'-'+id,'DCS.dcsuri','/tools/documents/self_assessments/'+__data.config.title+'/'+id,'DCSext.tool_start','1','DCSext.tool_complete','');
			}else{	
				dcsMultiTrack('DCSext.tool_name',__data.config.title,'DCSext.tool_cat','Self assessments','WT.si_n','Tool_'+__data.config.title,'WT.si_p',id,'WT.dl','100','DCSext.tool_user_status','','DCSext.tool_usage','','DCSext.visit_tool_usage','','DCSext.tool_type','iframe','WT.ti',__data.config.title+'-'+id,'DCS.dcsuri','/tools/documents/self_assessments/'+__data.config.title+'/'+id,'DCSext.tool_start','','DCSext.tool_complete','');
			}
		}
	}
}