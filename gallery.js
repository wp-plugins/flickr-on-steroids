
(function(){function _$(els){this.elements=[];for(var i=0,len=els.length;i<len;++i){var element=els[i];if(typeof element=='string'){if(element[0]=='<'){var tagName=element.substr(1,element.length-2);element=document.createElement(tagName);}else
element=document.getElementById(element);}
if(element!=null)
this.elements.push(element);}}
_$.prototype={each:function(fn){for(var i=0,len=this.elements.length;i<len;++i){fn.call(this,this.elements[i]);}
return this;},setStyle:function(prop,val){this.each(function(el){el.style[prop]=val;});return this;},setStyleHeight:function(){this.each(function(el){el.style['height']=el.offsetHeight;});return this;},show:function(){var that=this;this.each(function(el){that.setStyle('display','block');});return this;},hide:function(){var that=this;this.each(function(el){that.setStyle('display','none');});return this;},addEvent:function(type,fn){var add=function(el){if(window.addEventListener){el.addEventListener(type,fn,false);}
else if(window.attachEvent){el.attachEvent('on'+type,fn);}};this.each(function(el){add(el);});return this;},appendChild:function(child){this.elements[0].appendChild(child.elements[0]);return this;},removeChild:function(child){this.elements[0].removeChild(child.elements[0]);return this;},lastChild:function(){return $(this.elements[0].lastChild);},setInnerHtml:function(text){this.each(function(el){el.innerHTML=text;});return this;},value:function(){return this.elements[0].value;},setValue:function(text){this.elements[0].value=text;return this;}};window.AIS=window.AIS||{};window.AIS.$=function(){return new _$(arguments);};window.AIS.addEvent=function(el,type,fn){if(window.addEventListener){el.addEventListener(type,fn,false);}else if(window.attachEvent){el.attachEvent('on'+type,fn);}};window.AIS.bindEventListener=function(obj,method){return function(event){method.call(obj,event||window.event)};};window.AIS.Counter=function(id,start,finish){this.count=this.start=start;this.finish=finish;this.id=id;this.isInit=false;this.expand=function(){if(!this.isInit){var el=document.getElementById(this.id);el.style.height=0;el.style.display='block';this.isInit=true;}
if(this.count>=this.finish){this.countDown=null;return;}
document.getElementById(this.id).style.height=this.count;this.count+=5;setTimeout(AIS.bindEventListener(this,this.expand),0);};this.collapse=function(){if(this.count<=0){var el=document.getElementById(this.id);el.style.display='none';el.style.height=this.start;this.countDown=null;return;}
document.getElementById(this.id).style.height=this.count;this.count-=5;setTimeout(AIS.bindEventListener(this,this.collapse),0);};};window.AIS.showSideMenu=function(id){if(AIS.sideMenu.selected!=''){var cnt=new window.AIS.Counter(AIS.sideMenu.selected,AIS.sideMenu.selectedHeight,0);cnt.collapse();}
if(id==AIS.sideMenu.selected){AIS.sideMenu.selected='';return;}
var el=document.getElementById(id);var h=el.style.height.substr(0,el.style.height.length-2);var cnt=new window.AIS.Counter(id,0,h);cnt.expand();AIS.sideMenu.selected=id;AIS.sideMenu.selectedHeight=h;};window.AIS.Observer=function(){this.fns=[];}
window.AIS.Observer.prototype={subscribe:function(fn){this.fns.push(fn);},unsubscribe:function(fn){this.fns=this.fns.filter(function(el){if(el!==fn){return el;}});},fire:function(o){this.fns.forEach(function(el){el(o);});}};window.AIS.addClass=function(id,className)
{var el=document.getElementById(id);var ind=el.className.indexOf(className);if(ind==-1)
el.className=el.className+" "+className;}
window.AIS.removeClass=function(id,className)
{var el=document.getElementById(id);var classArray=el.className.split(" ");var ind=classArray.indexOf(className);if(ind!=-1)
classArray.splice(ind,1);el.className=classArray.join(" ");}})();function extend(subClass,superClass){subClass.prototype=new superClass();subClass.prototype.constructor=subClass;subClass.superclass=superClass.prototype;if(superClass.prototype.constructor==Object.prototype.constructor){superClass.prototype.constructor=superClass;}}
window.AIS.Button=function(title,icon,onClick_action){this.el=document.createElement('span');this.el.style.cursor="pointer";this.el.innerHTML="<img src='"+icon+"'/>"+title;AIS.addEvent(this.el,'click',onClick_action);}
window.AIS.Popup=function(p_title,p_width,p_data){this.screen=document.createElement('div');this.screen.className="modal-screen";var that=this;this.toolBar=[new AIS.Button("","../wp-content/plugins/flickr-on-steroids/img/close24x24.png",function(){that.hide();})];this.title=document.createElement('div');this.title.id="dialog-title";this.title.innerHTML=p_title;this.content=document.createElement('div');this.content.className='dialog-content';this.content.innerHTML=p_data;this.content.style.overflow="hidden";function getYoffset(){var de=document.documentElement;return self.pageYOffset||(de&&de.scrollTop)||document.body.scrollTop;}
this.show=function(){document.getElementsByTagName("body")[0].style.overflow="hidden";var toolBar=document.createElement('div');toolBar.className="dialog-toolbar";for(var i=0;i<this.toolBar.length;i++){toolBar.appendChild(this.toolBar[i].el);}
this.dialog=document.createElement('div');this.dialog.id="dialog";this.dialog.style.width=p_width+'px';this.dialog.style.marginLeft=(-p_width/2)+'px';this.dialog.appendChild(this.title);this.dialog.appendChild(toolBar);this.dialog.appendChild(this.content);var yOffset=getYoffset();this.screen.style.top=yOffset+"px";this.dialog.style.top=(yOffset+50)+"px";document.getElementsByTagName("body")[0].appendChild(this.screen);document.getElementsByTagName("body")[0].appendChild(this.dialog);};this.hide=function(){document.getElementsByTagName("body")[0].removeChild(this.screen);document.getElementsByTagName("body")[0].removeChild(this.dialog);document.getElementsByTagName("body")[0].style.overflow="";};}
window.AIS.ImageGallery=function(name,ncols,width,titles,thumbs,images,bigimages,container_id){this.getCodeHide=function(popup){return function(){popup.hide();}};this.getCodeHideShow=function(popup1,popup2){return function(){popup1.hide();popup2.show();}};this.getCodeZoomin=function(url){return function(){window.open(url);}};window.popups=window.popups||new Object();window.popups[name]=new Array();var txt="<table><tr>";for(var i=0;i<titles.length;i++){var action_txt='window.popups["'+name+'"]['+i+'].show()';txt=txt+"<td width=100px align=center><div style='cursor:pointer;' onclick='"+action_txt+"'>"+"<img style='border-style:none;' src='"+thumbs[i]+"'/>"+"</div></td>";if((i+1)%ncols==0){txt=txt+"</tr><tr>";}
window.popups[name][i]=new AIS.Popup(titles[i],width,"<img src='"+images[i]+"'/>");}
for(var i=0;i<titles.length;i++){var toolBar=[];if(bigimages!=null&&bigimages.constructor==Array)
toolBar.push(new AIS.Button("","./wp-content/plugins/flickr-on-steroids/img/zoomin24x24.png",this.getCodeZoomin(bigimages[i])));toolBar.push(new AIS.Button("","./wp-content/plugins/flickr-on-steroids/img/left24x24.png",this.getCodeHideShow(window.popups[name][i],(i==0)?window.popups[name][titles.length-1]:window.popups[name][i-1])));toolBar.push(new AIS.Button("","./wp-content/plugins/flickr-on-steroids/img/right24x24.png",this.getCodeHideShow(window.popups[name][i],(i==titles.length-1)?window.popups[name][0]:window.popups[name][i+1])));toolBar.push(new AIS.Button("","./wp-content/plugins/flickr-on-steroids/img/close24x24.png",this.getCodeHide(window.popups[name][i])));window.popups[name][i].toolBar=toolBar;}
txt=txt+"</tr></table>";if(container_id!=null){var el=document.getElementById(container_id);el.innerHTML=txt;}else{document.write(txt);}}