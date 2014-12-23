var change_sizeDD = function(val){
	this.maxval = 7;
	this.factor = 3;
	this.val = val;
	this.num = null;
	this.sizeCSS = null;
	this.change_size = function(val){
		var elements = document.getElementsByClassName('drop-answers');
		if(elements){
			this.val = this.factor*val;
			var vall = this.sizeCSS+this.val;
			for(var i=0;i<elements.length;i++){
				elements.item(i).style.height = vall+'px';
			}
		}
	}
	this.init_var = function(){
		if(!this.num){
			this.num = document.getElementsByClassName('num').item(0);
			this.sizeCSS = document.getElementsByClassName('drop-answers').item(0).style.height;
			alert(this.sizeCSS);
		}
	}
	this.size_down = function(){
		this.init_var();
		if(this.num.innerHTML>0){
			this.num.innerHTML--;
			this.change_size(this.num.innerHTML);
		}
	}
	this.size_up = function(){
		this.init_var();
		if(this.num.innerHTML<this.maxval){
			this.num.innerHTML++;
			this.change_size(this.num.innerHTML);
		}
	}
	
}