
//! format price_product

var price_slt = document.querySelector('.productPrice');
if(url.includes("modify")){
    changeTextPrice();
}
price_slt.onblur = function () {  
    changeTextPrice();
};

function convert_money(n) {
    let money;
    switch (typeof(n)) {
        case 'string':
            money = parseInt(n.split('.').join(''));
            break;
        case 'number':
            money = n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            break;
        default:
            break;
    }
    return money;
}

function changeTextPrice(){
    let mn = convert_money(price_slt.innerHTML);
    price_slt.innerHTML = convert_money(mn) + '<span contenteditable="false"> đ</span>' ;
}

//! Get value text_editor

document.querySelector('.btn_save button').onclick = function () { 
    let text_selc = document.querySelectorAll('[name]:not(meta)');
    let vl = '';
    let vl1 = '';
    let vl2 = '';

    let form1Values = Array.from(text_selc).reduce(function (values, input) {
        if(input.type == 'number'){
            values.quantityProduct = input.value;
        }else if(input.getAttribute("name") == 'giftProduct'){
            vl += input.innerText + '$';
            values.giftProduct = vl;
        }else if(input.getAttribute("name") == 'titleConfig'){
            vl1 += input.innerText + '$';
            values.titleConfig = vl1;
        }else if(input.getAttribute("name") == 'contentConfig'){
            vl2 += input.innerText + '$';
            values.contentConfig = vl2;
        }else if(input.getAttribute("name") == 'priceProduct'){
            let x = input.innerText.split(' đ').join('');
            values.priceProduct = x.split('.').join('');
        }else if(input.getAttribute("name") == 'brand'){
            values.brand = input.value;
        }else if(input.getAttribute("name") == 'category'){
            values.category = input.value;
        }else{
            values[input.getAttribute("name")] = input.innerText;
        }
        return values;
    }, {});
    // console.log(form1Values);
    //! send cookie
    document.cookie = "a="+ JSON.stringify(form1Values) + "; ; path=http://localhost/BTL_WEB/admin/pages/contents/productMn/handle.php" ;
};

//! add li
    
document.querySelector('.addGift_wr').onclick = function () {  
    document.querySelector('.infoGift__item:last-child').insertAdjacentHTML('beforebegin','<li class="infoGift__item text_edittor" contenteditable spellcheck="false"><span class="infoGift__icon" contenteditable="false"><i class="fas fa-check-circle" ></i></span><span class="infoGift__text" name="giftProduct">Nội dung quà tặng</span><span class="x_icon" contenteditable="false" ><i class="fas fa-times-circle"></i></span></li>');
    let li = document.querySelectorAll('li[contenteditable]');
    let x_icon = document.querySelectorAll('.x_icon');
    qwe(li, x_icon);
};

document.querySelector('.addConfig_wr').onclick = function () {  
    document.querySelector('.productConfig__item:last-child').insertAdjacentHTML('beforebegin','<li class="productConfig__item text_edittor" contenteditable="true" spellcheck="false"><div name="titleConfig" class="li__left">Tên cấu hình</div><div name="contentConfig" class="li__right">Nội dung cấu hình</div><span class="x_icon" contenteditable="false" ><i class="fas fa-times-circle"></i></span></li>');
    let li = document.querySelectorAll('li[contenteditable]');
    let x_icon = document.querySelectorAll('.x_icon');
    qwe(li, x_icon);
};


//! text focus_blur

let li = document.querySelectorAll('li[contenteditable]');
let x_icon = document.querySelectorAll('.x_icon');

function qwe(li, x_icon) {
    for (let index = 0; index < li.length; index++) {
        li[index].onfocus = function () {  
            if(li[index] === document.activeElement){          
                x_icon[index].style.display = 'block';
                x_icon[index].onclick = function (){
                    li[index].remove();
                };
            }
        };
    
        li[index].onblur = function () {  
            for (let index1 = 0; index1 < li.length; index1++) {
                x_icon[index1].style.display = 'none';
            }
        };
    }
}

qwe(li, x_icon);

//! upload IMG
if(url.includes("modify")){
    $('.image-upload-wrap').hide();
    $('.file-upload-content').show();
}

function readURL(input) {
    if (input.files && input.files[0]) {
  
      var reader = new FileReader();
  
      reader.onload = function(e) {
        $('.image-upload-wrap').hide();
  
        $('.file-upload-image').attr('src', e.target.result);
        $('.file-upload-content').show();
  
        $('.image-title').html(input.files[0].name);
      };
  
      reader.readAsDataURL(input.files[0]);
  
    } else {
      removeUpload();
    }
}
  
function removeUpload() {
    $('.file-upload-image').attr("src", "");
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
});

$('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

//!auto get brands when selected category

category_select.onchange = () =>{
    if(category_select.getAttribute("src")==""){
        category_select.classList.add("validatePro");
    }else{
        category_select.classList.remove("validatePro");
    }
    array.forEach(element => {
        if(element.getAttribute('categoryid') == category_select.value){
            element.style.display = 'block';
        }else{
            element.style.display = 'none';
        }
    });
};

//! set selected attribute for option brand, category product from DB
var value_categorySelect = category_select.getAttribute("value");
var value_brandSelect = brand_select.getAttribute("value");
var options_category = Array.from(category_select.querySelectorAll('option'));
var options_brand = Array.from(brand_select.querySelectorAll('option'));

options_category.forEach(element => {
    if(element.getAttribute("value") == value_categorySelect){
        element.setAttribute("selected", "selected");
    }
});

options_brand.forEach(element => {
    if(element.getAttribute("value") == value_brandSelect){
        element.setAttribute("selected", "selected");
    }
});


//! get cookie
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

//! VALIDATION
var file_upload_image = document.querySelector('.file-upload-image');
var image_upload_wrap = document.querySelector('.image-upload-wrap');
var formasd = document.querySelector('#formasd');

formasd.onsubmit = (e) => {
    if(file_upload_image.getAttribute("src")==""){
        e.preventDefault();
        image_upload_wrap.classList.add("validatePro");
        $("html, body").animate({ scrollTop: 100 }, 200); 
    }else{
        image_upload_wrap.classList.remove("validatePro");
    }
    if(category_select.value == ""){
        e.preventDefault();
        category_select.classList.add("validatePro");
        $("html, body").animate({ scrollTop: 100 }, 200); 
    }else{
        category_select.classList.remove("validatePro");
    }
    if(brand_select.value == ""){
        e.preventDefault();
        brand_select.classList.add("validatePro");
        $("html, body").animate({ scrollTop: 100 }, 200); 
    }else{
        brand_select.classList.remove("validatePro");
    }
};

file_upload_image.onchange = () =>{
    if(file_upload_image.getAttribute("src")==""){
        image_upload_wrap.classList.add("validatePro");
    }else{
        image_upload_wrap.classList.remove("validatePro");
    }
};

brand_select.onchange = () =>{
    if(brand_select.getAttribute("src")==""){
        brand_select.classList.add("validatePro");
    }else{
        brand_select.classList.remove("validatePro");
    }
};