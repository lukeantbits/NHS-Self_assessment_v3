var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i) ? true : false;
    },
	Tablet: function() {
        return navigator.userAgent.match(/iPad|(?!.*mobile).*Android*/i) ? true : false;
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i) ? true : false;
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i) ? true : false;
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Windows());
		//return true;
    }
};
function inIframe () {
    try {
        return window.self !== window.top;
    } catch (e) {
        return true;
    }
}
var loadjscssfile = function(filename, filetype){
	if (filetype=="js"){
		var fileref=document.createElement('script')
		fileref.setAttribute("type","text/javascript")
		fileref.setAttribute("src", filename)
	}
	else if (filetype=="css"){
		var fileref=document.createElement("link")
		fileref.setAttribute("rel", "stylesheet")
		fileref.setAttribute("type", "text/css")
		fileref.setAttribute("href", filename)
	}
	if (typeof fileref!="undefined"){
		document.getElementsByTagName("head")[0].appendChild(fileref)
	}
}
function daysInMonth(month,year) {
    return new Date(year, month, 0).getDate();
}
function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}
function keyEvtNumeric(e){
	if((e.keyCode >=48 && e.keyCode <=57)||(e.keyCode >=96 && e.keyCode <=105)||e.keyCode== 46 || e.keyCode== 8){
		return true;
	}else{
		return false;
	}
}
function getId(evt){
	if(evt.target.nodeName == 'A'){
		return evt.target.id
	}else{
		return evt.target.parentNode.id
	}	
}
function inObj(o,l,r){
	if(r != null && typeof r != 'undefined'){
		o[l] = r;
	}
}
function replaceAll(str,mapObj){
    var re = new RegExp(Object.keys(mapObj).join("|"),"gi");
    return str.replace(re, function(matched){
        return mapObj[matched.toLowerCase()];
    });
}
var arrayUnique = function(a) {
    return a.reduce(function(p, c) {
        if (p.indexOf(c) < 0) p.push(c);
        return p;
    }, []);
};
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
function initCaps(str){
	return str.charAt(0).toUpperCase() + str.slice(1);
}
function getParentId(e){
	var node = $(e.target)
	while(node.attr('id') == undefined){
		if(node[0].nodeName == 'BODY'){
			break;
		}
		node = node.parent();
	}
	return node.attr('id')
}
makeID = function(l){
	var output = "";
	var chars = "0123456789";
	for( var i=0; i < l; i++ )
		output += chars.charAt(Math.floor(Math.random() * chars.length));

	return output;
}
Date.prototype.yyyymmdd = function() {
  var mm = (this.getMonth() + 1).toString();
  var dd = this.getDate().toString();

  return [this.getFullYear(), mm.length===2 ? '' : '0', mm, dd.length===2 ? '' : '0', dd].join('');
};