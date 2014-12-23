var rb_size = function(){
	this.min_val = 1;
	this.max_val = 3;
	this.value_elem = document.getElementsByClassName('num').item(0); 
	this.getVal = function(){
		return this.value_elem.innerHTML;
	}
	this.inc = function(){
		if(parseInt(this.value_elem.innerHTML)<this.max_val){
			this.value_elem.innerHTML=parseInt(this.value_elem.innerHTML)+1;
			this.setSize(this.value_elem.innerHTML);
		}
	}
	this.dec = function(){
		if(parseInt(this.value_elem.innerHTML)>this.min_val){
			this.value_elem.innerHTML=parseInt(this.value_elem.innerHTML)-1;
			this.setSize(this.value_elem.innerHTML);
		}
	}
	this.setSize = function(val){
		if(val==0)
			val = 1;
		$html_col = document.getElementsByClassName('elm');
		$url = '../../images/check'+(val*15)+'.png';
		for(var i=0;i<$html_col.length; i++){
			$html_col.item(i).firstChild.src = $url;
		}
	}
}
var rbSize = new rb_size();
// устанавливаем начальное значение, исходя из данных в поле размера
// данные задаются при загрузке
rbSize.setSize(rbSize.getVal());
document.getElementById('sizeup').onclick = function(){
	rbSize.inc();
};
document.getElementById('sizedown').onclick = function(){
	rbSize.dec();
};