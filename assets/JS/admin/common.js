
//! confirm delete

var deletes =  document.querySelectorAll('.delete');
var modal_delete = document.querySelector('.modal_delete');
var modal_close = document.querySelector('.modal_close');
if(deletes){
    Array.from(deletes).forEach(element => {
        element.onclick = (e)=>{
            e.preventDefault();
            modal_delete.setAttribute('href', element.getAttribute('href'));
            document.querySelector('.modal').style.display = 'block';
        };
    });
}

if(modal_close){
    modal_close.onclick = ()=>{
        document.querySelector('.modal').style.display = 'none';
    };
}
