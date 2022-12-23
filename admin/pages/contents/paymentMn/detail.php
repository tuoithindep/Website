
<?php 
    $sql_product = 'SELECT product.id, thumbnail, name_prod, price, product_quantity FROM payment, product 
    WHERE product.id = payment.product_id AND id_customer = "'.$_GET['id'].'"';
    $query_products = mysqli_query($mysqli, $sql_product);

    $sql_payment = 'SELECT * FROM payment WHERE id_customer = "'.$_GET['id'].'" LIMIT 1';
    $query_payment = mysqli_query($mysqli, $sql_payment);
    $payment = mysqli_fetch_row($query_payment);

    $sql_customer = 'SELECT customer.name, phone, address, delivery.name FROM customer, payment, delivery 
    WHERE id_customer = customer.id AND deli_unit = delivery.id AND customer.id = "'.$_GET['id'].'" LIMIT 1';
    $query_customer = mysqli_query($mysqli, $sql_customer);
    $customer = mysqli_fetch_row($query_customer);
?>

<h1 style="text-align:center;" >Cart product list</h1>
<h4 style="color: green;" >ORDER DATE: <?php echo $payment[11] ?></h4>
<table>
    <tr>
        <th>No</th>
        <th>Thumbnail</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
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
                        <a class="product_link" href="?management&payment&detail&view-product&id=<?php echo $products['id'] ?>">
                            <img class="img_product" src="../assets/imgs/admin/upload_img_product/<?php echo $products['thumbnail'] ?>" alt="img">              
                        </a>
                    </td>
                    <td>
                        <a class="product_link" href="?management&payment&detail&view-product&id=<?php echo $products['id'] ?>">
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
        <td><strong>Name: </strong> <?php echo $customer[0] ?> &emsp; <strong>Phone: </strong> <?php echo $customer[1] ?></td>
        <td rowspan="4">
            <i class="icon_cart fas fa-hand-holding-usd"></i>
        </td>
        <td><strong>Sub-total</strong></td>
        <td class="money" ><?php echo number_format($payment[4],0,"","."); ?> đ</td>
    </tr>  
    <tr class="money_wr" >
        <td><strong>Delivery to: </strong><?php echo $customer[2] ?></td>
        <td><strong>Discount</strong></td>
        <td class="money"  style="color: green;" ><?php echo number_format($payment[5],0,"","."); ?> đ</td>
    </tr>     
    <tr class="money_wr" >
        <td><strong>Delivery type: </strong><?php echo $customer[3]; ?></td>
        <td><strong>Shipping fee</strong></td>
        <td class="money" ><?php echo number_format($payment[6],0,"","."); ?> đ</td>
    </tr>         
    <tr class="money_wr" >
        <td><strong>Payment type: </strong><?php echo $payment[10]; ?></td>
        <td><strong>Last total</strong></td>
        <td class="money"  style="color: red;" ><?php echo number_format($payment[7],0,"","."); ?> đ</td>
    </tr>        
</table>