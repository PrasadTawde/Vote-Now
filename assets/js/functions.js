/*var div =document.createElement("div");
var div_2=document.createElement("div");
div_2.setAttribute("id","modal");
div.setAttribute("id","fade");
var img=document.createElement("img");
img.setAttribute("id","loader");
img.src="../images/loader.gif";
div_2.appendChild(img);
var body=document.querySelector("body");
body.appendChild(div);
body.appendChild(div_2);*/
var base_path="/miaco/";

function ajax(type,url,callback,data="none"){
   // openModal();
    if(window.XMLHttpRequest){
        var xmlobj=new XMLHttpRequest();
    }
    else{
        var xmlobj=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if(type=="POST"){
        xmlobj.open(type,url,true);
        if(data !="none"){
            xmlobj.send(data);
        }
        else{
            xmlobj.send();
        }
    }
    else if(type=="GET"){
        if(data=="none"){
            xmlobj.open(type,url,true);
            xmlobj.send();
        }
        else{
            xmlobj.open(type,url+"?"+data,true);
            xmlobj.send();
        }
    }
    xmlobj.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            //closeModal();
            callback(this.responseText);
            
        }
    }

}
function queryProperty(object,property,callback){
        if(object.hasOwnProperty(property)){
            callback();
        }
    }
function createElem(selector){
    var element=document.querySelector(selector);
    return element;
}
function successMsg(message){
    var element=document.createElement("div");
    element.setAttribute("id","messenger");
    element.classList.add("alert");
    element.classList.add("alert-success");
    var body=createElem("body");
    body.appendChild(element);
    $("#messenger").html(message).fadeIn().delay(3000).fadeOut();
}
/*function openModal(){
    document.querySelector("#modal").style.display="block";
    document.querySelector("#fade").style.display="block";
}
function closeModal(){
    document.querySelector("#modal").style.display="none";
    document.querySelector("#fade").style.display="none";
}*/
function ucFirst(chars){
    var text_array=chars.split("");
    text_array[0]=text_array[0].toUpperCase();
    var new_string=text_array.join("");
    return new_string;
}