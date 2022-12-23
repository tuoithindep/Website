<?php
    session_start();
    include('../../../config/connectDB.php');
    // session_destroy();
    if(isset($_GET['add-to-cart']) || isset($_POST['add_cart'])){
        if(isset($_POST['add_cart'])){
            $id = $_POST['add_cart'];
        }else{
            $id = $_GET['id'];
        }
        if(isset($_POST['quantity'])){
            $quantity = $_POST['quantity'];
        }else{
            $quantity = 1;
        }
        $sql_product = 'SELECT quantity as quantity_max, product.id, thumbnail, name_prod, price, category.slug as cate_slug, brand.slug as brand_slug
        FROM product, category, brand WHERE product.id ='.$id.' AND product.category_id = category.id AND product.brand_id = brand.id' ;
        $query_product = mysqli_query($mysqli, $sql_product);
        $product = mysqli_fetch_array($query_product);

        if($product){
            $new_product = array(array('id'=>$product['id'], 'cate_slug'=>$product['cate_slug'], 'brand_slug'=>$product['brand_slug'], 
            'name'=>$product['name_prod'], 'thumbnail'=>$product['thumbnail'], 'price'=>$product['price'], 'quantity'=>$quantity, 'quantity_max'=>$product['quantity_max']));

            if(isset($_SESSION['cart'])){
                $found = false;
                foreach ($_SESSION['cart'] as $cart_item) {
                    if($cart_item['id'] == $id){
                        if($cart_item['quantity'] < $product['quantity_max']){
                            setcookie("add-success", 'Thêm thành công', time() + 1, "/");
                            $cart_product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'cate_slug'=>$cart_item['cate_slug'], 'brand_slug'=>$cart_item['brand_slug'], 
                            'thumbnail'=>$cart_item['thumbnail'], 'price'=>$cart_item['price'], 'quantity'=>$cart_item['quantity']+1, 'quantity_max'=>$cart_item['quantity_max']);
                            $found = true;
                        }else{
                            setcookie("out-quan-range", 'Sản phẩm đã hết', time() + 1, "/");
                            $cart_product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'cate_slug'=>$cart_item['cate_slug'], 'brand_slug'=>$cart_item['brand_slug'], 
                            'thumbnail'=>$cart_item['thumbnail'], 'price'=>$cart_item['price'], 'quantity'=>$cart_item['quantity'], 'quantity_max'=>$cart_item['quantity_max']);
                            $found = true;
                        }
                    }else{
                        $cart_product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'cate_slug'=>$cart_item['cate_slug'], 'brand_slug'=>$cart_item['brand_slug'], 
                        'thumbnail'=>$cart_item['thumbnail'], 'price'=>$cart_item['price'], 'quantity'=>$cart_item['quantity'], 'quantity_max'=>$cart_item['quantity_max']);
                    }
                }
                if($found == false){      
                    setcookie("add-success", 'Thêm thành công', time() + 1, "/");
                    $_SESSION['cart'] = array_merge($cart_product, $new_product);
                }else{
                    $_SESSION['cart'] = $cart_product;
                }
            }else{
                setcookie("add-success", 'Thêm thành công', time() + 1, "/");
                $_SESSION['cart'] = $new_product;
            }
        }
        // echo '<pre>';
        // print_r($_SESSION['cart']);
        // echo '</pre>';
    }

    if(isset($_GET['delete-to-cart'])){
        $id = $_GET['id'];
        
        if(count($_SESSION['cart']) > 1){
            foreach ($_SESSION['cart'] as $cart_item) {
                if($cart_item['id'] != $id){
                    $cart_product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'cate_slug'=>$cart_item['cate_slug'], 'brand_slug'=>$cart_item['brand_slug'], 
                    'thumbnail'=>$cart_item['thumbnail'], 'price'=>$cart_item['price'], 'quantity'=>$cart_item['quantity'], 'quantity_max'=>$cart_item['quantity_max']);
                }
                $_SESSION['cart'] = $cart_product;
            }
        }else{
            unset($_SESSION['cart']);
        }
    }
    
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
?>