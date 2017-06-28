function include(file, callback) {
  var head      = document.getElementsByTagName('head')[0];
  var script    = document.createElement('script');
  script.type   = 'text/javascript';
  script.src    = file;
  script.onload = script.onreadystatechange = function() {
    // execute dependent code
    if (callback) callback();
    // prevent memory leak in IE
    head.removeChild(script);
    script.onload = null;
  };
  head.appendChild(script);
}

include('vendor/jquery-3.2.1.min.js', function(){
	$.extend({
	antbitsMultiLoad: function(urls,path, callback, nocache){
		if (typeof nocache=='undefined') nocache=false;
		var queue = urls.length
		$.when(
			$.each(urls, function(i, url){
				if (nocache) url += '?_ts=' + new Date().getTime();
				var ext = url.split('.').pop();
				$.get(path+url, function(){
					switch(ext){
						case 'css':
						console.log(path+url)
							$('<link>', {rel:'stylesheet', type:'text/css', 'href':path+url}).appendTo('head');
						break;
						default:
							var proceed = true;
							$('script').each(function(index, element) {
                                if($(element).attr('src') == path+url){
									//console.log('already loaded!!! '+$(element).attr('src')+' == '+path+url)
									proceed = false;
								}
                            });
							if(proceed){
								//console.log('loading '+path+url)
								$('<script>', {type:'text/javascript', 'src':path+url}).appendTo('head');
							}
						break;
					}
					queue --
					if(queue<=0){
						if (typeof callback=='function'){
							callback();
						}
					}
				});
			})
		)
	},
});
(function ($) {
	var scripts, currentScript, tmp,obj,id;
	var self = this;
	var saObj
	var path
	var filelist = ['package.php','css/desktop.css']
	scripts = document.getElementsByTagName('script');
	self.init = function(data){
		self.data = data
		path = data.script.src.replace('js/sa_launcher.js','')
		$.antbitsMultiLoad(filelist,path,self.deploy,false);
	}
	self.deploy = function(){
		
		if(self.data.layout == 'phone'){
			$.antbitsMultiLoad(['css/phone.css'],path,null,false);
		}
		
		saObj = new saIndex(path,id,self.data.layout);
	}
	for(var sKey in scripts){
		var tmp = scripts[sKey].id
		if(typeof tmp != 'undefined'){
			if(tmp.indexOf('antbits-SA')>-1 && typeof antbits_sa_container[tmp] === 'undefined'){
				//id=tmp.replace('antbits-SA_','')
				id=tmp.split('_').pop();
				var layout = 'desktop'
				if(tmp.indexOf('antbits-SA-phone')>-1){
					layout = 'phone'
				}
				console.log(scripts[sKey])
				antbits_sa_container[tmp] = {
					"id":id,
					"layout":layout,
					"script":scripts[sKey]
				}
				self.init(antbits_sa_container[tmp])
				break;
			}
		}
	}
})(jQuery);
});
