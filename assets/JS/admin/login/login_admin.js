//! notify

var icon = document.querySelector('.notify_wr i:first-child');
var x_buton = document.querySelector('.notify_wr i:last-child');
var textNotify = document.querySelector('.notify_wr span');
var notify_container = document.querySelector('.notify_container');

x_buton.onclick = () =>{
    notify_container.style.right = "";
};

if(!checkSuccess){
    notify_container.classList.add("error");
    icon.style.color="red";
    icon.setAttribute("class", "fas fa-exclamation-circle");
    textNotify.innerText = errMess;
    $( document ).ready(function() {
        setTimeout(() => {
            notify_container.style.right = "20px";  
            setTimeout(() => {
                notify_container.style.right = "";     
            }, 1500);
        }, 200);
    });
}

