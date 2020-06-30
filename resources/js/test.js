
function selectedChanged(value){
    let ao=null;
    let cities=document.getElementById('cities');
    cities.innerHTML="";
    if (value=='-1') {
        cities.innerHTML="";

    }
    if (window.XMLHttpRequest) {
        ao=new XMLHttpRequest();
    }
    else
        ao=new ActiveXObject("Microsoft.XMLHTTP");

    ao.onreadystatechange=function(){
        if(ao.readyState==4&&ao.status==200){
            let resp=ao.responseText;
            cities.innerHTML=resp;

        }}
    ao.open("GET","/home/cities/"+value,true);
    ao.send(null);
}
