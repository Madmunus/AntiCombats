if(!window.JSFX) JSFX=new Object();

if(!JSFX.createLayer)
{/*** Include Library Code ***/

JSFX.objNo=0;

JSFX.getObjId = function(){return "JSFX_obj" + JSFX.objNo++;};

JSFX.getCurrentObjId = function(){return "JSFX_obj" + (JSFX.objNo - 1);};

JSFX.createLayer = function(theHtml) {
	var el = document.createElement("div");
	el.id = JSFX.getObjId();
	el.style.position = 'absolute';
	el.style.zIndex = '150';
	el.style.left = '0px';
	el.style.top = '0px';
	document.getElementById('ione').appendChild(el);
	el.innerHTML = theHtml;
	return el;
}

JSFX.fxLayer = function(theHtml) {
	if(theHtml == null) return;
	this.el = JSFX.createLayer(theHtml);
}

var proto = JSFX.fxLayer.prototype

proto.moveTo     = function(x,y){this.el.style.left = x;this.el.style.top=y;}
proto.setBgColor = function(color) { this.el.style.backgroundColor = color; } 
proto.clip       = function(x1,y1, x2,y2){ this.el.style.clip="rect("+y1+" "+x2+" "+y2+" "+x1+")"; }

gX=function(){return 500;};
gY=function(){return 120;};

/*** Example extend class ***/
JSFX.fxLayer2 = function(theHtml)
{
	this.superC = JSFX.fxLayer;
	this.superC(theHtml + "C");
}
JSFX.fxLayer2.prototype = new JSFX.fxLayer;
}/*** End Library Code ***/

/*************************************************/

/*** Class Firework extends FxLayer ***/
JSFX.Firework = function(fwImages, xpos, ypos) {
	window[ this.id = JSFX.getObjId() ] = this;
	this.imgId = "i" + this.id;
	this.fwImages  = fwImages;
	this.numImages = fwImages.length;
	this.superC = JSFX.fxLayer;
	//this.superC("<img src='"+fwImages[0].src+"' name='"+this.imgId+"'>");
	this.superC("<img src='http://img.combats.ru/i/sprites/blank.gif' name='"+this.imgId+"'>");
	this.img = document.images[this.imgId];
	this.step = 0;
	this.timerId = -1;
	this.x = xpos;
	this.y = ypos;
	this.dx = 0;
	this.dy = 0;
	this.ay = 0.2;
	this.state = "OFF";
}
JSFX.Firework.prototype = new JSFX.fxLayer;

JSFX.Firework.prototype.getMaxDy = function()
{
	var ydiff = gY() - 130;
	var dy    = 1;
	var dist  = 0;
	var ay    = this.ay;
	while(dist<ydiff)
	{
		dist += dy;
		dy+=ay;
	}
	return -dy;
}
JSFX.Firework.prototype.setFrame = function()
{
//	this.img.src=this.fwName+"/"+this.step+".gif";
	this.img.src=this.fwImages[ this.step ].src;
}
JSFX.Firework.prototype.animate = function()
{

	if(this.state=="OFF")
	{
		
		this.step = 0;
	//	this.x = -200;
	//	this.y = -200;
		this.moveTo(this.x, this.y);
		this.setFrame();
	//	if(Math.random() > .95)
	//	{
	//		this.x = 0+ (gX()-100)*Math.random();
	//		this.y = 0+ (gY()-100)*Math.random();
	//		this.moveTo(this.x, this.y);
			this.state = "EXPLODE";
	//	}
		this.setFrame();
	
	}
	else if(this.state == "EXPLODE")
	{
		this.step++;
		if(this.step < this.numImages) {
			this.setFrame();
		} else {
			this.state="OFFLINE";
		}
	}
}
/*** END Class Firework***/

/*** Class FireworkDisplay extends Object ***/
JSFX.FireworkDisplay = function(n, fwImages, numImages, xpos, ypos)
{
	window[ this.id = JSFX.getObjId() ] = this;
	this.timerId = -1;
	this.fireworks = new Array();
	this.imgArray = new Array();
	this.loadCount=0;
	this.loadImages(fwImages, numImages);

	for(var i=0 ; i<n ; i++)
		this.fireworks[this.fireworks.length] = new JSFX.Firework(this.imgArray, xpos, ypos);
}
JSFX.FireworkDisplay.prototype.loadImages = function(fwName, numImages)
{
	for(var i=0 ; i<numImages ; i++)
	{
		this.imgArray[i] = new Image();
		this.imgArray[i].obj = this;
		this.imgArray[i].onload = window[this.id].imageLoaded;
		this.imgArray[i].src = fwName+"/"+i+".gif";
	}
}
JSFX.FireworkDisplay.prototype.imageLoaded = function()
{
	this.obj.loadCount++;
}

JSFX.FireworkDisplay.prototype.animate = function()
{
//status = this.loadCount;
	if(this.loadCount < this.imgArray.length)
		return;

	for(var i=0 ; i<this.fireworks.length ; i++) {
		this.fireworks[i].animate();
		if (this.fireworks[i].state == 'OFFLINE') {this.stop();}
	}
}
JSFX.FireworkDisplay.prototype.start = function()
{
	if(this.timerId == -1)
	{
		this.state = "OFF";
		this.timerId = setInterval("window."+this.id+".animate()", 40);
	}

}
JSFX.FireworkDisplay.prototype.stop = function()
{
	if(this.timerId != -1)
	{
		clearInterval(this.timerId);
		this.timerId = -1;
		for(var i=0 ; i<this.fireworks.length ; i++)
		{
			this.fireworks[i].moveTo(-100, -100);
			this.fireworks[i].step = 0;;
			this.fireworks[i].state = "OFF";
		}	
	}
}
/*** END Class FireworkDisplay***/
