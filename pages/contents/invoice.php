
<?php 
    $sql_product = 'SELECT category.slug as cate_slug, brand.slug as brand_slug, product.id, thumbnail, name_prod, price, product_quantity FROM payment, product, category, brand
    WHERE category.id = product.category_id AND brand.id = product.brand_id AND
    product.id = payment.product_id AND id_customer = "'.$_GET['id'].'"';
    $query_products = mysqli_query($mysqli, $sql_product);

    $sql_payment = 'SELECT * FROM payment WHERE id_customer = "'.$_GET['id'].'" LIMIT 1';
    $query_payment = mysqli_query($mysqli, $sql_payment);
    $payment = mysqli_fetch_row($query_payment);

    $sql_customer = 'SELECT customer.name, phone, address, delivery.name FROM customer, payment, delivery 
    WHERE id_customer = customer.id AND deli_unit = delivery.id AND customer.id = "'.$_GET['id'].'" LIMIT 1';
    $query_customer = mysqli_query($mysqli, $sql_customer);
    $customer = mysqli_fetch_row($query_customer);
?>
<div style="background-color: white; border-radius: 4px;" class="invoice_container wide">
    <div style="padding: 30px 50px;" class="invoice_Wr">
        <div style="display: flex; justify-content: space-between;" class="title_payment">
            <h2>Chi tiết đơn hàng</h2>
            <h4>Cảm ơn bạn đã đặt hàng, đơn hàng của bạn đã được ghi nhận. Shop sẽ liên hệ cho bạn sớm nhất có thể !</h4>
        </div>
        <h4 style="color: green;" >Ngày đặt hàng: <?php echo $payment[11] ?></h4>
        <table>
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>
            <?php
                $no = 1;
                if(!$query_products){
                    echo mysqli_error($mysqli);
                    die();
                }
                else{
                    while ($products = mysqli_fetch_array($query_products)) {
            ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td>
                                <a class="product_link" href="?product-detail=<?php echo $products['cate_slug'] ?>&brand=<?php echo $products['brand_slug'] ?>&id=<?php echo $products['id'] ?>">
                                    <img class="img_product" src="./assets/imgs/admin/upload_img_product/<?php echo $products['thumbnail'] ?>" alt="img">              
                                </a>
                            </td>
                            <td>
                                <a class="product_link" href="?product-detail=<?php echo $products['cate_slug'] ?>&brand=<?php echo $products['brand_slug'] ?>&id=<?php echo $products['id'] ?>">
                                    <?php echo $products['name_prod'] ?>
                                </a>
                            </td>
                            <td style="width: 120px" ><?php echo number_format($products['price'],0,"","."); ?> đ</td>
                            <td><?php echo $products['product_quantity'] ?></td>
                            <td><?php echo number_format($products['price'] * $products['product_quantity'],0,"","."); ?> đ </td> 
                        </tr>
            <?php
                $no += 1;
                    }
                }
            ?>       
            <tr class="money_wr" >
                <td rowspan="4" colspan="2">
                    <i class="icon_cart fas fa-cart-arrow-down"></i>
                </td>
                <td><strong>Tên: </strong> <?php echo $customer[0] ?> &emsp; <strong>SĐT: </strong> <?php echo $customer[1] ?></td>
                <td rowspan="4">
                    <i class="icon_cart fas fa-hand-holding-usd"></i>
                </td>
                <td><strong>Tổng phụ</strong></td>
                <td class="money" ><?php echo number_format($payment[4],0,"","."); ?> đ</td>
            </tr>  
            <tr class="money_wr" >
                <td><strong>Giao hàng tới: </strong><?php echo $customer[2] ?></td>
                <td><strong>Giảm giá</strong></td>
                <td class="money"  style="color: green;" ><?php echo number_format($payment[5],0,"","."); ?> đ</td>
            </tr>     
            <tr class="money_wr" >
                <td><strong>Đơn vị vận chuyển: </strong><?php echo $customer[3]; ?></td>
                <td><strong>Phí giao hàng</strong></td>
                <td class="money" ><?php echo number_format($payment[6],0,"","."); ?> đ</td>
            </tr>         
            <tr class="money_wr" >
                <td><strong>Hình thức thanh toán: </strong><?php echo $payment[10]; ?></td>
                <td><strong>Phải trả</strong></td>
                <td class="money"  style="color: red;" ><?php echo number_format($payment[7],0,"","."); ?> đ</td>
            </tr>        
        </table>
        <div class="cart__productBtn">
            <a href="?product=laptop">
                <i class="fas fa-arrow-left"></i>
                <span>Xem sản phẩm khác</span> 
            </a>
        </div>
    </div>
</div>