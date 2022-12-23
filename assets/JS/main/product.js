
//!itemNav--active
var Category__links = document.querySelectorAll('.Category__link');
var product_slug = /product=([^&]+)/.exec(url)[1];

Array.from(Category__links).forEach(element => {
    if(element.getAttribute("product") != product_slug){
        if(element.classList.contains('itemCate__active')){
            element.classList.remove('itemCate__active');
        }
    }else{
        element.classList.add('itemCate__active');
    }
});

//! range slider

var slide_hoder = document.querySelector('.slide_hoder');
var slider = document.getElementById("myRange");
var output = document.getElementById("price_desc");

slide_hoder.style.width = '50%';
output.innerText = slider.value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");


slider.oninput = function() {
    var rangeVal = (slider.value * 100) / slider.getAttribute('max');
    slide_hoder.style.width = 'calc(' + rangeVal + '%';
    output.innerText = this.value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};

//! handle brand_select

//get brand_select
var fllter_brand_select = document.querySelector('#fllter_brand_select');

// handle URL
if(!url.includes("brand")){
    fllter_brand_select.options[0].selected = true;
}else{
    if (localStorage.getItem('brand')) {
        fllter_brand_select.options[localStorage.getItem('brand')].selected = true;
    }
}

// khi chon 1 brand
fllter_brand_select.onchange = () => {
    if(fllter_brand_select.value == '#'){
        window.location.href = `?product=${product_slug}`;
    }else{
        window.location.href = `?product=${product_slug}&brand=${fllter_brand_select.value}`;
        localStorage.setItem('brand', fllter_brand_select.selectedIndex);
    }
};

//! handle filter_select

//get filter_select
var filter_select = document.querySelector('#filter_select');

//select option when reload page
if (url.includes("product") && localStorage.getItem('filter')) {
    filter_select.options[localStorage.getItem('filter')].selected = true;
}

// khi chon 1 brand
filter_select.onchange = () => {
    localStorage.setItem('filter', filter_select.selectedIndex);
    document.querySelector('.oderBy__form').submit();
};

//! handle action LOC of price_ranger
var filter__btn = document.querySelector('.filter__btn');

if (url.includes("product") && localStorage.getItem('value_price_range')) {
    slider.setAttribute('value', localStorage.getItem('value_price_range'));
    slide_hoder.style.width = 'calc(' + (localStorage.getItem('value_price_range') * 100) / slider.getAttribute('max') + '%';
    output.innerText = localStorage.getItem('value_price_range').replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

filter__btn.onclick = () =>{
    localStorage.setItem('value_price_range', slider.value);
};

//! pagination - hieu ung select vao so trang
var pagination__links = document.querySelectorAll('.pagination__link ');

if(!urlParams.has('page')){
    pagination__links[0].classList.add('pagination_active');
}else{
    pagination__links.forEach(element => {
        let value_select = element.innerText;
        if(value_select == urlParams.get('page')){
            element.classList.add('pagination_active');
        }
    });
}

