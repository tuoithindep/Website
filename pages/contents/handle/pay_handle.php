<?php
    session_start();
    include('../../../config/connectDB.php');
    $cart_products = json_decode($_COOKIE["cart_products"]) ;

    $product_carts = $cart_products->cart_products;
    $money_provisional = $cart_products->money_provisional;
    $money_discount = $cart_products->money_discount;
    $money_deliver = $cart_products->money_deliver;
    $money_lastPay = $cart_products->money_lastPay;
    $gender = $cart_products->gender;
    $name = $cart_products->name;
    $phone = $cart_products->phone;
    $address = $cart_products->address;
    $request = $cart_products->request;
    $deli_unit = $cart_products->deli_unit;
    $pay_format = $cart_products->pay_format;

    //get DATE_TIME
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $createdAt = date("d-m-Y H:i:s");
    //tao ID khach hang
    $id_customer = uniqid();

    //insert customerDB
    $sql_cus = 'INSERT INTO customer(id, name, gender, phone, address, createdAt, status) 
    VALUE ("'.$id_customer.'","'.$name.'","'.$gender.'","'.$phone.'","'.$address.'",
    "'.$createdAt.'", "0")';

    $ver_cus = mysqli_query($mysqli, $sql_cus);
    if(!$ver_cus){
        echo mysqli_error($mysqli);
        die();
    }
    else{
        foreach ($product_carts as $product_cart) {
            $sql = 'INSERT INTO payment(id_customer, product_id, product_quantity, money_provisional, money_discount, 
            money_deliver, money_lastPay, request, deli_unit, pay_format, createdAt) 
            VALUE ("'.$id_customer.'","'.$product_cart->id.'","'.$product_cart->quantity.'","'.$money_provisional.'","'.$money_discount.'","'.$money_deliver.'",
            "'.$money_lastPay.'","'.$request.'", "'.$deli_unit.'","'.$pay_format.'","'.$createdAt.'")';
        
            $ver = mysqli_query($mysqli, $sql);
            if(!$ver){
                echo mysqli_error($mysqli);
                die();
            }
            else{
                unset($_SESSION['cart']);
                setcookie("add-success", 'payment', time() + 1, "/");
                header("Location:../../../home?invoice&id=".$id_customer);
            } 
        }
    } 
?>