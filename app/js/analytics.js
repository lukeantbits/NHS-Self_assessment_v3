function analytics(vc,d,o){
	var self = this
	var data = d
	self.vc = vc
}
function wt(vc,d,o){
	var self = this
	var data = d
	var usr_str = Array('error','New user','Returning user')
	var syn_id = vc.syn_id
	var base_obj = {'DCSext.tool_name':data.title,'DCSext.tool_cat':data.category,'WT.si_n':data.si_n,'DCSext.tool_type':'iframe','WT.vtvs':data.vtvs,'WT.co_f':data.co_f,'WT.vtid':data.co_f,'DCS.dcsuri':data.dcsuri}
	self.vc = vc
	this.evt = function(obj){
		var output = []
		for(var key in base_obj){
			output.push(key)
			output.push(base_obj[key])
		}
		for(var key in obj){
			output.push(key)
			output.push(obj[key])
		}
		eval("dcsMultiTrack('"+output.join("','")+"')")
	}
}

