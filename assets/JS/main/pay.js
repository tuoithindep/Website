//! convert_money

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

//! get parentElement follow selector_name

function getParent(element, selector){
    while (element.parentElement) {
        if(element.parentElement.matches(selector)){
            return element.parentElement;
        }
        element = element.parentElement;
    }
} 

//! total_money

var cart_product_quantity = document.querySelectorAll('.cart__productItem').length;
document.querySelector('.price_provisional_label span').innerText = '( ' + cart_product_quantity + ' sản phẩm ):';
var provisional_money = document.querySelector('.price_provisional_money');
var price_total_money = document.querySelector('.price_total_money');
var last_pay_selector = document.querySelector('.last_pay span');
var money_dis = document.querySelector('.money_dis');
var money_discount_e = document.querySelector('.money_discount');
var discount_input = document.querySelector('.discount_input');
var fee_deli_money = document.querySelector('.fee_deli_money');
var last_pay_money = document.querySelector('.last_pay_money');
var asd = document.querySelectorAll('.cart__productPrice');

//check event money_dis change

money_dis.onchange = () => {
    console.log('a');
};

// tinh tong
function total_money_handle() {
    let dsa = Array.from(asd).reduce(function (value, input) {  
        let tr = getParent(input, 'tr');
        let number_field = tr.querySelector('.number_field');
        let quantity = number_field.value;
        return value + (convert_money(input.innerText) * quantity);
    }, 0);

    //! tong tien tam

    // tao attribute gan tong tam vao
    provisional_money.setAttribute("provisional_money", dsa);
    //Lay value cua attribute tong tam
    let prov_money = parseInt(provisional_money.getAttribute("provisional_money")) ;
    //in ra text tong tien tam
    provisional_money.innerText = convert_money(prov_money) + ' đ';

    //! - money discount

    //lay value cua attribute money_dis
    let money_dis_value = parseInt(money_dis.getAttribute("money_dis")) ;
    //Tinh tong tien
    let total_money = prov_money - money_dis_value;
    //Set attribute tong tien
    price_total_money.setAttribute("price_total_money", total_money);
    //In ra text tong tien
    price_total_money.innerText = convert_money(total_money) + ' đ';

    //! + fee delivery

    //lay value cua attribute fee_deli_money
    let fee_deli_money_value = parseInt(fee_deli_money.getAttribute("fee_deli")) ;
    //Tinh tong tien phai tra
    let last_total_money = total_money + fee_deli_money_value;
    //Set attribute tong tien
    last_pay_money.setAttribute("last_pay_money", last_total_money);
    //In ra text tong tien
    last_pay_money.innerText = convert_money(last_total_money) + ' đ';

}

total_money_handle();

// check event when number_field change
var quantity_btns = document.querySelectorAll('.quantity_btn');
var number_field = document.querySelectorAll('.number_field');

quantity_btns.forEach(element => {
    element.onmouseup = () => {
        setTimeout(() => {
            total_money_handle();
        }, 1);
    };
});

//! random_discountCode

var applycode__code = document.querySelector('.applycode__code i');
//random discountCODE
function makeid(length) {
var result           = [];
var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result.push(characters.charAt(Math.floor(Math.random() * charactersLength)));
    }

    document.querySelector('.applycode__text_input input').value = result.join('');
}

// xoa validate khi input
discount_input.oninput = () =>{
    if($('.discount_input').hasClass("err")){
        discount_input.classList.remove("err");
    }
};

applycode__code.onclick = () =>{
    if($('.discount_input').hasClass("err")){
        discount_input.classList.remove("err");
    }
};

// apply discount when click Ap Dung
function money_discount() {
    if(discount_input.value == ''){
        discount_input.classList.add("err");
    }
    else{
        let prov_money = parseInt(provisional_money.getAttribute("provisional_money"));
        // random money
        let money = (prov_money * random_number(5, 20))/100;

        //xoa validate
        discount_input.classList.remove("err");
        money_discount_e.style.display = "flex";

        //gan gia tri cua money_discount vao attribute
        money_dis.setAttribute("money_dis", money);
        //In money ra ngoai
        money_dis.innerText = '- ' + convert_money(money) + ' đ';

        total_money_handle();
    }
}


//! deli_unit

function fee_deli() {
    var money_deli = (30000 + Math.floor(Math.random() * 10000));
    var fee_deli_selector = document.querySelector('.fee_deli span');

    if(document.querySelector('.fee_deli').style.display == 'none'){
        fee_deli_selector.setAttribute('fee_deli', money_deli);
        fee_deli_selector.innerText = convert_money(money_deli) + ' đ';
        
        document.querySelector('.fee_deli').style.display = 'flex';
    }else{
        if(document.querySelector('#deli_unit_sl').value == 0){
            document.querySelector('.fee_deli').style.display = 'none';
            fee_deli_selector.setAttribute('fee_deli', 0);
        }else{
            fee_deli_selector.setAttribute('fee_deli', money_deli);
            fee_deli_selector.innerText = convert_money(money_deli) + ' đ';
        }
    }
    total_money_handle();
}

//! list product_cart

var cart__productItems = document.querySelectorAll('.cart__productItem');

function cart_products() {
    let i = 0;
    return Array.from(cart__productItems).reduce(function (values, input) {
        let id = input.getAttribute('id');
        let quantity = input.querySelector('.number_field').value;
        values[i] = {id:id, quantity:quantity};
        i++;
        return values;
    }, []);
}
