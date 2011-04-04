<?php

// Do some javascript checking with jslint:
// http://www.crockford.com/javascript/
/* This is the form entry page that is used by hrecipe.php */
// BOGUS!  These paths need to be redone, correctly.
require_once('../../../wp-load.php'); // Ugly directory stuff
require_once('../../../wp-admin/admin.php'); // Ugly directory stuff
@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php do_action('admin_xml_ns'); ?> <?php language_attributes(); ?>>
<head>
<?php
wp_enqueue_style( 'global' );
wp_enqueue_style( 'wp-admin' );
wp_enqueue_style( 'colors' );
?>


<html>
<head>

<style>
.tableview_cell{ padding:3px}

.tableview_cell_sel{ padding:5px;  border:3px red solid}

.qtpushbutton{ font-weight:normal;  color:#222;  border-color:#b3b3b3;  text-shadow:1px 1px 0 #fafafa;  background-image:-webkit-gradient( linear, left bottom, left top, color-stop(0.11,rgb(0,51,255)), color-stop(0.66,rgb(199,215,255)) );  background-image:-moz-linear-gradient( center bottom, rgb(0,51,255) 11%, rgb(199,215,255) 66% );  padding:.5em .5em;  border:1px solid #aaa;  text-align:center;  cursor:pointer;  font-size:1em;  width:auto;  overflow:visible;  -moz-border-radius:7px;  -webkit-border-radius:7px;  border-radius:7px}

.qtpushbutton-hover{ background-image:-webkit-gradient( linear, left bottom, left top, color-stop(0.33,rgb(199,215,255)), color-stop(0.90,rgb(0,51,255)) );  background-image:-moz-linear-gradient( center bottom, rgb(199,215,255) 33%, rgb(0,51,255) 90% );  background-position:right center;  color:#555;  border-color:#777}

.qtpushbutton .text{ display:table-cell;  vertical-align:middle}

.qtpushbutton .icon{ display:table-cell;  vertical-align:middle;  padding-right:5px}

.qtpushbutton .icon-no-text{ display:table-cell;  vertical-align:middle}

#button_add{ position:absolute;  left:460px;  top:150px;  background-color:lightgrey;  background-image:url();  border:solid black 1px}

#button_del{ position:absolute;  left:460px;  top:200px;  background-color:lightgrey;  background-image:url();  border:solid black 1px}

#submitButton{ position:absolute;  left:800px;  top:480px}

#cancelButton{ position:absolute;  left:900px;  top:480px}

#username_txt{ position:absolute;  top:0px;  left:20px}

#username{ position:absolute;  top:0px;  left:100px}

#login_button{ position:absolute;  top:0px;  left:280px}

#album_select{ position:absolute;  top:40px}

#img_library{ position:absolute;  top:80px;  width:450px;  height:350px;  overflow:auto;  border:1px black solid}

#gallery{ position:absolute;  top:80px;  left:510px;  width:450px;  height:350px;  overflow:auto;  border:1px black solid}

#img_size{ position:absolute;  top:17px;  left:600px}

#img_size_label{ position:absolute;  top:20px;  left:510px}

#descr_txt{ position:absolute;  left:500px;  top:440px}

#descr{ position:absolute;  left:600px;  top:440px}

</style>


<script>

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
var asyncRequest=(function(){function handleReadyState(o,callback){var poll=window.setInterval(function(){if(o&&o.readyState==4){window.clearInterval(poll);if(callback){callback(o);}}},50);}
var getXHR=function(){var http;try{http=new XMLHttpRequest;getXHR=function(){return new XMLHttpRequest;};}
catch(e){var msxml=['MSXML2.XMLHTTP.3.0','MSXML2.XMLHTTP','Microsoft.XMLHTTP'];for(var i=0,len=msxml.length;i<len;++i){try{http=new ActiveXObject(msxml[i]);getXHR=function(){return new ActiveXObject(msxml[i]);};break;}
catch(e){}}}
return http;};return function(method,uri,callback,postData){var http=getXHR();http.open(method,uri,true);handleReadyState(http,callback);http.send(postData||null);return http;};})();Function.prototype.method=function(name,fn){this.prototype[name]=fn;return this;};if(!Array.prototype.forEach){Array.method('forEach',function(fn,thisObj){var scope=thisObj||window;for(var i=0,len=this.length;i<len;++i){fn.call(scope,this[i],i,this);}});}
if(!Array.prototype.filter){Array.method('filter',function(fn,thisObj){var scope=thisObj||window;var a=[];for(var i=0,len=this.length;i<len;++i){if(!fn.call(scope,this[i],i,this)){continue;}
a.push(this[i]);}
return a;});}
function ajax(options){options={type:options.type||"POST",url:options.url||"",timeout:20000,onComplete:options.onComplete||function(){},onError:options.onError||function(){},onSuccess:options.onSuccess||function(){},data:options.data||"",parms:options.parms||""};var xml=new XMLHttpRequest();xml.open(options.type,options.url,true);if(options.type=="POST"){xml.setRequestHeader("Content-type","application/x-www-form-urlencoded");xml.setRequestHeader("Content-length",options.parms.length);xml.setRequestHeader("Connection","close");}
var timeoutLength=options.timeout;var requestDone=false;setTimeout(function(){requestDone=true;},timeoutLength);xml.onreadystatechange=function(){if(xml.readyState==4&&!requestDone){if(httpSuccess(xml)){options.onSuccess(httpData(xml,options.data));}else{options.onError();}
options.onComplete();xml=null;}};xml.send(options.parms);function httpSuccess(r){try{return!r.status&&location.protocol=="file:"||(r.status>=200&&r.status<300)||r.status==304||navigator.userAgent.indexOf("Safari")>=0&&typeof r.status=="undefined";}catch(e){}
return false;}
function httpData(r,type){var ct=r.getResponseHeader("content-type");var data=!type&&ct&&ct.indexOf("xml")>=0;data=type=="xml"||data?r.responseXML:r.responseText;if(type=="script")
eval.call(window,data);return data;}}
window.Qt=window.Qt||{};window.Qt.Widget=function(){this.setElement=function(id){this.m_element=id;}}
window.Qt.AbstractButton=function(){window.Qt.AbstractButton.superclass.constructor.call(this);var that=this;this.m_text="";this.m_icon="";this.clicked=new AIS.Observer();this.setText=function(text){this.m_text=text;this.update();}
this.setIcon=function(icon){this.m_icon=icon;this.update();}
this.update=function(){alert('You need to implement this function in the derived class');}}
extend(window.Qt.AbstractButton,window.Qt.Widget);window.Qt.PushButton=function(){window.Qt.PushButton.superclass.constructor.call(this);var that=this;Qt.PushButton.objId++;var objId=Qt.PushButton.objId;function rowDomId(){return"pushbutton_"+objId;}
function updateStyleMouseOver(){AIS.addClass(that.m_element,"qtpushbutton-hover");}
function updateStyleMouseOut(){AIS.removeClass(that.m_element,"qtpushbutton-hover");}
this.update=function(){var el=document.getElementById(this.m_element);var icon_code="";var text_code="";el.className="qtpushbutton";if(this.m_text!=""){text_code="<div class='text'>"+this.m_text+"</div></button>";if(this.m_icon!="")
icon_code="<div class='icon'><img src='"+this.m_icon+"' ></img></div>";}else{if(this.m_icon!="")
icon_code="<div class='icon-no-text'><img src='"+this.m_icon+"' ></img></div>";}
var txt=icon_code+text_code;AIS.addEvent(el,'mouseover',updateStyleMouseOver);AIS.addEvent(el,'mouseout',updateStyleMouseOut);AIS.addEvent(el,'click',function(){that.clicked.fire();});el.innerHTML=txt;}}
window.Qt.PushButton.objId=0;extend(window.Qt.PushButton,window.Qt.AbstractButton);window.Qt.LineEdit=function(){window.Qt.LineEdit.superclass.constructor.call(this);var that=this;var m_text;Qt.LineEdit.objId++;var objId=Qt.LineEdit.objId;function rowDomId(){return"lineedit_"+objId;}
this.update=function(){var el=document.getElementById(this.m_element);var txt="<input type='text' id='"+rowDomId()+"' value='"+m_text+"'/>";el.innerHTML=txt;}
this.text=function(){var el=document.getElementById(rowDomId());return el.value;}
this.setText=function(text){m_text=text;this.update();}}
window.Qt.LineEdit.objId=0;extend(window.Qt.LineEdit,window.Qt.Widget);window.AIS=window.AIS||{};window.Qt=window.Qt||{};window.Qt.StandardItem=function(){var m_text,m_icon,m_data,m_parent;m_data=new Array();m_parent=null;this.text=function(){return m_text;};this.setText=function(aText){m_text=aText;};this.icon=function(){return m_icon};this.setIcon=function(aIcon){m_icon=aIcon;};this.setData=function(aValue,aRole){m_data[aRole]=aValue;};this.data=function(aRole){return m_data[aRole];};}
window.Qt.StandardItemModel=function(){var items=[];this.rowsInserted=new AIS.Observer();this.rowsRemoved=new AIS.Observer();this.appendRow=function(item){items.push(item);this.rowsInserted.fire();};this.removeRows=function(index,count){items.splice(index,count);this.rowsRemoved.fire();};this.removeRow=function(index){this.removeRows(index,1);}
this.data=function(index,role){return items[index].data(role);};this.rowCount=function(){return items.length;};this.clear=function(){var oldLen=items.length;items=[];if(oldLen>0)
this.rowsRemoved.fire();};}
window.Qt.AbstractItemView=function(){var that=this;this.selectionChanged=new AIS.Observer();this.m_element=null;}
window.Qt.AbstractItemView.prototype.update=function(){}
window.Qt.AbstractItemView.prototype.setElement=function(id){this.m_element=id;this.update();}
window.Qt.AbstractItemView.prototype.setModel=function(model){var that=this;function rowsInserted(){that.update();}
function rowsRemoved(){that.update();}
this.m_model=model;this.m_model.rowsInserted.subscribe(rowsInserted);this.m_model.rowsRemoved.subscribe(rowsRemoved);}
window.Qt.ListView=function(){window.Qt.ListView.superclass.constructor.call(this);var that=this;Qt.ListView.objId++;this.objId=Qt.ListView.objId;function rowDomId(id){return"listview_"+that.objId+"_"+id;}
function onChange(parm){var myselect=document.getElementById("listview_"+that.objId);var id=myselect.selectedIndex;that.selectionChanged.fire(id);}
this.update=function(){var el=document.getElementById(this.m_element);var i;var txt="<select id='listview_"+that.objId+"'>";for(i=0;i<this.m_model.rowCount();i++){var name=this.m_model.data(i,"title");var id=rowDomId(that.m_model.data(i,"id"));txt=txt+"<option value='"+id+"' id='"+id+"'>"+name+"</option>";}
txt=txt+"</select>";el.innerHTML=txt;var myselect=document.getElementById("listview_"+that.objId);AIS.addEvent(myselect,'change',onChange);}}
window.Qt.ListView.objId=0;extend(window.Qt.ListView,window.Qt.AbstractItemView);window.Qt.TableView=function(){var m_columnCount,m_rowCount;this.selectedIndex=-1;var that=this;window.Qt.TableView.superclass.constructor.call(this);Qt.TableView.objId++;this.objId=Qt.TableView.objId;this.rowDomId=function(id){return"tableview_"+that.objId+"_"+id;}
this.setColumnCount=function(columnCount){m_columnCount=columnCount;};this.columnCount=function(){return m_columnCount;};this.selectCell=function(model_ind){var id=that.rowDomId(model_ind);var old_cell=null;if(that.selectedIndex!=-1)
old_cell=document.getElementById(that.rowDomId(that.selectedIndex));var new_cell=document.getElementById(id);if(old_cell)
old_cell.className="tableview_cell";new_cell.className="tableview_cell_sel";that.selectedIndex=model_ind;that.selectionChanged.fire(model_ind);};}
extend(window.Qt.TableView,window.Qt.AbstractItemView);window.Qt.TableView.prototype.update=function(){if(this.m_model==null||this.m_element==null)
return;Qt.TableView.superclass.update.call(this);var txt="<table  style='table-layout:fixed;'><tbody><tr height=100 valign=center>";var i;var that=this;for(i=0;i<this.m_model.rowCount();i++){var thumb=this.m_model.data(i,"thumb");var id=this.rowDomId(i);txt=txt+"<td id='"+id+"' width=100  align=center class='tableview_cell'>"+"<img style='border-style:none' src='"+thumb+"'/>"+"</td>";if((i+1)%this.columnCount()==0&&i!=this.m_model.rowCount()-1){txt=txt+"</tr><tr height=100 valign=center>";}}
txt=txt+"</tr></tbody></table>";var el=document.getElementById(this.m_element);el.innerHTML=txt;for(i=0;i<this.m_model.rowCount();i++){var id=this.rowDomId(i);var mycell=document.getElementById(id);AIS.addEvent(mycell,'click',(function(){var id=i;return function(){that.selectCell(id);}})());}};window.Qt.TableView.prototype.setElement=function(id){Qt.TableView.superclass.setElement.call(this,id);};window.Qt.TableView.prototype.setModel=function(model){Qt.TableView.superclass.setModel.call(this,model);};window.Qt.TableView.objId=0;window.Qt.AjaxTableView=function(){var that=this;var isLoading=false;var rowHeight=100;function onScroll(){if(isLoading)
return;var el=document.getElementById(that.m_element);if(el.scrollTop+el.clientHeight>el.scrollHeight-rowHeight&&that.m_model.hasMore()){isLoading=true;that.m_model.getMore();}}
this.update=function(){Qt.AjaxTableView.superclass.update.call(this);if(this.m_element==null)
return;var el=document.getElementById(this.m_element);if(this.m_model==null||this.m_model.rowCount()==0){var txt="<table  style='table-layout:fixed;'><tr height="+rowHeight+" valign=center>";txt=txt+"<td width=400  align=center class='tableview_cell'><img src='./img/ajax-loader.gif'/></td>";txt=txt+"</tr></table>";el.innerHTML=txt;return;}
if(this.m_model.hasMore()&&!isLoading){var txt=el.innerHTML;var pos=txt.indexOf("</tbody>");if(pos==-1){pos=txt.indexOf("</TBODY>");if(pos==-1){alert("error in update view");return;}}
var str=txt.substr(0,pos);str=str+"<tr><td width=400 colspan=4  align=center class='tableview_cell'><img src='./img/ajax-loader.gif'/></td></tr></tbody></table>";el.innerHTML=str;for(var i=0;i<this.m_model.rowCount();i++){var id=this.rowDomId(i);var mycell=document.getElementById(id);AIS.addEvent(mycell,'click',(function(){var id=i;return function(){that.selectCell(id);}})());}}};this.setElement=function(id){Qt.AjaxTableView.superclass.setElement.call(this,id);var el=document.getElementById(this.m_element);AIS.addEvent(el,'scroll',onScroll);}
this.setModel=function(model){Qt.AjaxTableView.superclass.setModel.call(this,model);this.m_model.loadingCompleted.subscribe(function(){isLoading=false;that.update();});};window.Qt.AjaxTableView.superclass.constructor.call(this);}
extend(window.Qt.AjaxTableView,window.Qt.TableView);window.AIS.AjaxItemModel=function(){var m_totalItems;var perPage=20;var page,id,m_pUserID;var that=this;this.loadingCompleted=new AIS.Observer();function setAlbum1(data){var received_id;function setAlbum2(data){if(received_id!=id){return;}
var sizes=data.getElementsByTagName('sizes');for(var i=0;i<sizes.length;i++){var photo=sizes[i].getElementsByTagName('size');var thumb_url="";var normal_url="";var normal640_url="";var large_url="";for(var j=0;j<photo.length;j++){if(photo[j].getAttribute("label")=="Thumbnail")
thumb_url=photo[j].getAttribute("source");else if(photo[j].getAttribute("label")=="Medium")
normal_url=photo[j].getAttribute("source");else if(photo[j].getAttribute("label")=="Medium 640")
normal640_url=photo[j].getAttribute("source");else if(photo[j].getAttribute("label")=="Large")
large_url=photo[j].getAttribute("source");}
var img1=new Qt.StandardItem();img1.setData(thumb_url,'thumb');img1.setData(normal_url,'normal');img1.setData(normal640_url,'normal640');img1.setData(large_url,'image');that.appendRow(img1);}
that.loadingCompleted.fire();}
var rsp=data.getElementsByTagName('rsp');var status=rsp[0].getAttribute("stat");if(status!="ok"){alert("Cannot get photosets: "+status);return;}
var phset=data.getElementsByTagName('photoset');var numTotal=-1;if(phset.length>0){numTotal=phset[0].getAttribute("total");received_id=phset[0].getAttribute("id");}else{var phs=data.getElementsByTagName('photos');if(phs.length>0){received_id=0;numTotal=phs[0].getAttribute("total");}}
if(received_id!=id){return;}
if(numTotal!=-1)
that.setTotalItems(numTotal);alert("total "+numTotal+" pics");var photos=data.getElementsByTagName('photo');var num=photos.length;parms="num="+num;for(var i=0;i<num;i++){var photo=photos[i];parms=parms+"&id"+i+"="+photo.getAttribute("id");}
ajax({type:"POST",data:"xml",url:"./flickr_getSizes.php",parms:parms,onSuccess:setAlbum2});}
this.setAlbum=function(album_id){id=album_id;page=1;this.getData();}
this.setUserID=function(userid){m_pUserID=userid;}
this.getData=function(){var parms="";if(id==0){ajax({type:"GET",data:"xml",url:"./flickr_getPublicPhotos.php?user_id="+m_pUserID+"&per_page="+perPage+"&page="+page,parms:parms,onSuccess:setAlbum1});}else{ajax({type:"GET",data:"xml",url:"./flickr_photosetsGetPhotos.php?photoset_id="+id+"&per_page="+perPage+"&page="+page,parms:parms,onSuccess:setAlbum1});}}
this.setTotalItems=function(num){m_totalItems=num;}
this.hasMore=function(){return this.rowCount()<m_totalItems;}
this.getMore=function(){page++;that.getData();}}
extend(window.AIS.AjaxItemModel,window.Qt.StandardItemModel);window.AIS.PhotoGallery=function(){this.photoView=new Qt.AjaxTableView();this.photoModel=new AIS.AjaxItemModel();this.photoView.setColumnCount(4);this.photoView.setModel(this.photoModel);this.albumModel=new Qt.StandardItemModel();this.albumView=new Qt.ListView();this.albumView.setModel(this.albumModel);}
window.AIS.PhotoGallery.prototype.setView=function(el1,el2){this.albumView.setElement(el1);this.photoView.setElement(el2);}
window.AIS.PhotoGallery.prototype.setAlbum=function(id){alert('You need to implement setAlbum() in the derived class');}
window.AIS.PhotoGallery.prototype.currentImage=function(){alert('You need to implement currentImage() in the derived class');}
window.AIS.CoppermineGallery=function(){window.AIS.CoppermineGallery.superclass.constructor.call(this);var that=this;var parms="";function getAlbums1(data){var albumList=data.getElementsByTagName('album');for(var i=0;i<albumList.length;i++){var album=albumList[i];var al1=new Qt.StandardItem();al1.setData(album.getAttribute('id'),'id');al1.setData(album.getAttribute('title'),'title');that.albumModel.appendRow(al1);}
that.setAlbum(0);}
this.albumModel.clear();ajax({type:"GET",data:"xml",url:"./getalbumlist.php5",parms:parms,onSuccess:getAlbums1});this.setAlbum=function(id){var parms="";function setAlbum1(data){var imageList=data.getElementsByTagName('image');for(var i=0;i<imageList.length;i++){var image=imageList[i];var img1=new Qt.StandardItem();img1.setData(image.getAttribute('thumbnail'),'thumb');img1.setData(image.getAttribute('normal'),'normal');img1.setData(image.getAttribute('image'),'image');that.photoModel.appendRow(img1);}}
that.photoModel.clear();ajax({type:"GET",data:"xml",url:"./getalbum.php5?id="+that.albumModel.data(id,"id"),parms:parms,onSuccess:setAlbum1});}
this.albumView.selectionChanged.subscribe(this.setAlbum);}
extend(window.AIS.CoppermineGallery,window.AIS.PhotoGallery);window.AIS.CoppermineGallery.prototype.currentImage=function(){var current_index=this.photoView.selectedIndex;if(current_index==-1)
return-1;var thumb=this.photoModel.data(current_index,"thumb");var normal=this.photoModel.data(current_index,"normal");var image=this.photoModel.data(current_index,"image");return{'thumb':thumb,'normal':normal,'image':image};}
window.AIS.FlickrGallery=function(){window.AIS.FlickrGallery.superclass.constructor.call(this);var that=this;var m_pUserName="alexeyismirnov";var m_pUserID;this.setAlbum=function(id){that.photoModel.clear();that.photoModel.setUserID(m_pUserID);that.photoModel.setAlbum(that.albumModel.data(id,"id"));}
this.setUserName=function(userName)
{m_pUserName=userName;function getPhotosets1(data)
{var rsp=data.getElementsByTagName('rsp');var status=rsp[0].getAttribute("stat");if(status!="ok"){alert("Cannot get photosets: "+status);return;}
var al1=new Qt.StandardItem();al1.setData(0,"id");al1.setData("Photostream","title");that.albumModel.appendRow(al1);var photosets=data.getElementsByTagName('photoset');for(var i=0;i<photosets.length;i++){var album=photosets[i];var al1=new Qt.StandardItem();var id=album.getAttribute("id");var title=album.getElementsByTagName("title")[0].firstChild.nodeValue;al1.setData(album.getAttribute('id'),"id");al1.setData(title,"title");that.albumModel.appendRow(al1);}
that.setAlbum(0);}
function getPhotosets()
{that.albumModel.clear();ajax({type:"GET",data:"xml",url:"./flickr_photosetsGetList.php?user_id="+m_pUserID,parms:"",onSuccess:getPhotosets1});}
function getUserID(data)
{var rsp=data.getElementsByTagName('rsp');var status=rsp[0].getAttribute("stat");if(status!="ok"){alert("Bad user name: "+status);return;}
m_pUserID=data.getElementsByTagName('user')[0].getAttribute("id");getPhotosets();}
ajax({type:"GET",data:"xml",url:"./flickr_findByUserName.php?username="+userName,parms:"",onSuccess:getUserID});}
this.currentImage=function(){var current_index=this.photoView.selectedIndex;if(current_index==-1)
return-1;var normal640=this.photoModel.data(current_index,"normal640");var thumb=this.photoModel.data(current_index,"thumb");var normal=this.photoModel.data(current_index,"normal");var image=this.photoModel.data(current_index,"image");return{'thumb':thumb,'normal':normal,'normal640':normal640,'image':image};}
this.albumView.selectionChanged.subscribe(this.setAlbum);this.setUserName("alexeyismirnov");}
extend(window.AIS.FlickrGallery,window.AIS.PhotoGallery);
</script>


<script>
var galleryModel;var album_id;var all_descr=[];var selectedIndex=-1;var descr;function init(){function add_image()
{var old_img=img_library.currentImage();if(old_img==-1){return;}
var img1=new Qt.StandardItem();img1.setData(old_img["thumb"],'thumb');img1.setData(old_img["normal"],'normal');img1.setData(old_img["normal640"],'normal640');img1.setData(old_img["image"],'image');galleryModel.appendRow(img1);}
function del_image(){if(gallery.selectedIndex!=-1)
galleryModel.removeRow(gallery.selectedIndex);}
function sel_changed(id){if(selectedIndex!=-1)
all_descr[selectedIndex]=descr.text();if(all_descr[id])
descr.setText(all_descr[id]);else
descr.setText("");selectedIndex=id;}
var img_library=new AIS.FlickrGallery();img_library.setView('album_select','img_library');var username=new Qt.LineEdit();username.setElement("username");username.setText("alexeyismirnov");var login_button=new Qt.PushButton();login_button.setElement("login_button");login_button.setText("Get Pics");login_button.clicked.subscribe(function(){img_library.setUserName(username.text());});var button_add=new Qt.PushButton();button_add.setElement("button_add");button_add.setIcon("./img/right24x24.png");button_add.clicked.subscribe(function(){add_image();});var button_del=new Qt.PushButton();button_del.setElement("button_del");button_del.setIcon("./img/left24x24.png");button_del.clicked.subscribe(function(){del_image();});var submit_button=new Qt.PushButton();submit_button.setElement("submitButton");submit_button.setText("Done");submit_button.setIcon("./img/accept.png");submit_button.clicked.subscribe(function(){submit();});var cancel_button=new Qt.PushButton();cancel_button.setElement("cancelButton");cancel_button.setText("Cancel");cancel_button.setIcon("./img/cancel.png");cancel_button.clicked.subscribe(function(){cancelGallery();});var gallery=new Qt.TableView();gallery.setElement("gallery");gallery.setColumnCount(4);gallery.selectionChanged.subscribe(sel_changed);galleryModel=new Qt.StandardItemModel();gallery.setModel(galleryModel);descr=new Qt.LineEdit();descr.setElement("descr");descr.setText("");}
function cancelGallery(){var ig={};ig.numimg=0;window.parent.edInsertMyImageDone(ig);}
function submit(){var ig={};if(selectedIndex!=-1)
all_descr[selectedIndex]=descr.text();ig.numimg=galleryModel.rowCount();var cur_date=new Date();ig.name="album"+cur_date.getTime();ig.titles=[];ig.thumbs=[];ig.normals=[];ig.normals640=[];ig.imgs=[];var img_size=document.getElementById("img_size");ig.img_size=img_size.value;for(var i=0;i<ig.numimg;i++){if(all_descr[i])
ig.titles[i]=all_descr[i];else
ig.titles[i]="";ig.thumbs[i]=galleryModel.data(i,'thumb');ig.normals[i]=galleryModel.data(i,'normal');ig.normals640[i]=galleryModel.data(i,'normal640');ig.imgs[i]=galleryModel.data(i,'image');}
window.parent.edInsertMyImageDone(ig);}
</script>

<?php
do_action('admin_print_styles');
do_action('admin_print_scripts');
do_action('admin_head');
?>

</head>

<body <?php if ( isset($GLOBALS['body_id']) ) echo ' id="' . $GLOBALS['body_id'] . '"'; ?>  onload="init()">


<div id="username_txt">Flickr nick: </div>
<div id="username"></div>
<div id="login_button" > </div>

<div id="album_select"></div>

<div id="img_library"></div>

<div id="img_size_label">Image size:</div>
<select id="img_size">
<option value="m500">Medium 500</option>
<option value="m640">Medium 640</option>
</select>

<div id="gallery"></div>

<div id="button_add" > </div>

<div id="button_del" > </div>

<div id="descr_txt">Description: </div>
<div id="descr"></div>

<div id="submitButton"></div>
<div id="cancelButton"></div>

</body>
</html>

