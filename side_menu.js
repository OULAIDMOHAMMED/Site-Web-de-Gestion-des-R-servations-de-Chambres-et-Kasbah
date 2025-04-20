let j=document.getElementById("dd");
let k=document.getElementById("23");
let o=document.getElementById("34");
j.onclick=function(){
    if(k.style.backgroundColor=="red"){
        k.style.backgroundColor="green";
        o.style.backgroundColor="black";
    }
    else{
        k.style.backgroundColor="red";
        o.style.backgroundColor="white";
    }
}