function getXmlHttp(){
var xmlhttp;
try{
	xmhttp = new ActiveXObject("Msxml2.XMLHTTP");
}catch(e){
	try{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}catch (E){
		xmlhttp = false;
	}
}
if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
	xmlhttp = new XMLHttpRequest();
}else{
	return NULL;
}
return xmlhttp;
}
function send_mydata(url,data,func){
		var params='',datal = data.length;
		if(typeof(data)=='object'){
			for(var i=0;i<datal;i++){
				if(params==''){
					params=data[i]['name']+"="+encodeURIComponent(data[i]['value']);
				}else{
					params+="&"+data[i]['name']+"="+encodeURIComponent(data[i]['value']);
				}
			}
		}else{
			alert('no have data to send!'); return null;
		}
		var xmlhttp = getXmlHttp();
		if(xmlhttp!=null && xmlhttp!=false){
			xmlhttp.open('POST', url, true);
			xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					if(xmlhttp.status == 200) {
						if(xmlhttp.responseText!=false){
							func(xmlhttp.responseText);
						}else{
							alert('Ошибка отправки данных на сервер!');
						}
					}
				}
			};
			xmlhttp.send(params);
		}else{
			alert('Ошибка, данные не отправлены!');
		}
} 