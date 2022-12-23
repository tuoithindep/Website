
//! validate product brand
var select_category = document.querySelector('#select_category');
var input_nameBrand = document.querySelector('#input_nameBrand');
var form_add_brand = document.querySelector('#add_brand');
var category_name = document.querySelectorAll('.category_name');
var brand_name = document.querySelectorAll('.brand_name');

function isExist() {
    var result = select_category.options[select_category.selectedIndex].text;
    for (let index = 0; index < category_name.length; index++) {
        if(category_name[index].innerText == result){
            for (let i = 0; i < brand_name.length; i++) {
                if(category_name[i].innerText == result&&brand_name[i].innerText.toLowerCase() == input_nameBrand.value.toLowerCase()){
                    return true;
                }
            }
        }   
    }
    return false;
}

form_add_brand.onsubmit = (e) => {
    validatePr(select_category, e);
    validatePr(input_nameBrand, e);
    if(isExist()){
        e.preventDefault();
        input_nameBrand.classList.add('validate');
    }
};

select_category.oninput = () =>{
    if(select_category.value == ''){
        select_category.classList.add('validate');
    }else{
        select_category.classList.remove('validate');
    }
};

input_nameBrand.oninput = () =>{
    if(input_nameBrand.value == ''){
        input_nameBrand.classList.add('validate');
    }else{
        input_nameBrand.classList.remove('validate');
    }
};

function validatePr(input, e) {
    if(input.value == ''){
        e.preventDefault();
        input.classList.add('validate');
    }else{
        input.classList.remove('validate');
    }
}