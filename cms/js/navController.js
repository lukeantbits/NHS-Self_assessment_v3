function navController(page,rootObj){
	this.rootObj = rootObj
	this.switchPage = function(data){
		this.rootObj.pageObj.saveAll(data,"window.location= '"+rootObj.page_labels[data[0]-1]+".php'")
	}
}