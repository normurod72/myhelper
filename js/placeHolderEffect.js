function placeHolderEffect (input, textArray)
{
	var that=this;
	this.inp=input;
	this.texts=textArray;
	this.length=0;
	this.interval=null;
	this.index=0;
	this.reverse=false;
	this.running=true;
	this.start=function()
	{
		this.inp.placeholder="";
		this.reverse=false;
		this.startInterval();
	}
	this.startInterval= function ()
	{
		// if(interval!=null)
		// 	clearInterval(interval);
		if(this.running)
		{	

			var temp=this.index;
			while((temp=this.getRandomInt(0,this.texts.length-1))==this.index && this.texts.length>1);
			this.index=temp;
			this.length=this.inp.placeholder.length;
			this.interval = setInterval(this.changeText,100);
		}

	}
	this.changeText=function()
	{
		if(!that.running)
		{
			clearInterval(this.interval);
			return;
		}

		if(!that.reverse)
		{
			
			if(that.length<=that.texts[that.index].length)
			{
				that.inp.placeholder+=that.texts[that.index].charAt(that.length-1);
				that.length++;
			}
			else
			{
				clearInterval(that.interval);
			setTimeout(function(){
				//console.log("clear");
				that.reverse=true;
				that.length=0; that.startInterval()},1000);
				
			}	

		}
		else if (that.reverse)
		{
			if(that.length>0)
			{
				that.inp.placeholder=that.inp.placeholder.substring(0,that.inp.placeholder.length-1);
				that.length--;
			}
			else
				that.reverse=false;
		}
	}
	this.stop=function()
	{
		this.running=false;
		this.inp.placeholder="";
		clearInterval(this.interval);
	}
	this.getRandomInt=function (min, max) {
    	return Math.floor(Math.random() * (max - min + 1)) + min;
	}

}
