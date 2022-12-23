<?php
    $sql_product = 'SELECT * FROM product WHERE id = "'.$_GET['id'].'"';
    $query_product = mysqli_query($mysqli, $sql_product);
    $product = mysqli_fetch_row($query_product);

    //category
    $sql_category = 'SELECT name FROM category WHERE slug = "'.$_GET['product-detail'].'"';
    $query_category = mysqli_query($mysqli, $sql_category);
    $category = mysqli_fetch_row($query_category);

    //product same
    $sql_products = 'SELECT product.id, thumbnail, name_prod, price, brand.slug FROM product, brand, category
    WHERE category.id = product.category_id AND category.slug="'.$_GET['product-detail'].'" AND product.brand_id = brand.id AND brand.slug = "'.$_GET['brand'].'" AND product.id != "'.$_GET['id'].'"';
    $query_products = mysqli_query($mysqli, $sql_products);
?>

<!-- san pham chi tiet -->
<div class="productDetail__wrapper wide">
    <!-- productDetail -->
    <div class="productDetail__container row">
        <!-- product__IMG -->
        <div class="productDetail__Area col l-6">
            <img src="./assets/imgs/admin/upload_img_product/<?php echo $product[3] ?>" alt="">
        </div>

        <!-- product__info -->
        <div class="productDetail__Area col l-6">
            <div class="product__infoWrap">
                <!-- navigation -->
                <div class="product__infoNav">
                    <a href="?home" class="infoNav__Home">TRANG CHỦ</a>
                    <span>/</span>
                    <a href="?product=<?php echo $_GET['product-detail'] ?>" class="infoNav__Cate"><?php echo mb_strtoupper($category[0], 'UTF-8') ;  ?></a>
                </div>

                <!-- name__product -->
                <h1 class="product__infoTitle"><?php echo $product[4] ?></h1>
                
                <!-- price__product -->
                <div class="product__infoPrice"><?php echo number_format($product[5],0,"","."); ?> đ</div>

                <!-- sort-descrip__product -->
                <div class="product__infoShortDescrip">
                    <?php echo $product[6] ?>
                </div>

                <!-- uu dai them -->
                <div class="product__infoGift">
                    <div class="infoGift__header">Quà tặng</div>
                    <ul class="infoGift__list ul__format">
                        <?php
                            $gift = explode('$', $product[7]);
                            for ($i=0; $i < count($gift)-1; $i++) { 
                        ?>
                                <li class="infoGift__item text_edittor">                      
                                    <span class="infoGift__icon">
                                        <i class="fas fa-check-circle" ></i>
                                    </span> 
                                    <span class="infoGift__text"><?php echo $gift[$i] ?></span>
                                </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>

                <!-- form__quantity -->
                <form class="form__quantity" action="pages/contents/handle/product_handle.php" method="POST">
                    <input type="button" value="-" class="minus_btn">
                    <input name="quantity" readonly="readonly" type="number" min="1" max="<?php echo $product[8] ?>" step="1" value="1" class="number_field">
                    <input type="button" value="+" class="plus_btn">
                
                    <!-- <a href="pages/contents/handle/product_handle.php?add-to-cart&id=<?php echo $product[0] ?>" class="addCart_btn btn">THÊM VÀO GIỎ</a> -->
                    <button type="submit" value="<?php echo $product[0] ?>" name="add_cart" class="addCart_btn btn">THÊM VÀO GIỎ</button>
<!--                    <a href="?pay" class="buy_btn btn">MUA NGAY</a>-->
                </form>
            </div>
        </div>
    </div>

    <!-- description & config -->
    <div class="productDescrip__container row">
        <!-- productDescrip -->
        <div class="productDescrip__area col l-6">
            <div class="productDescrip__wrap">
                <h3 class="productDescrip__header">Bài viết đánh giá</h3>
                <div class="productDescrip__contentWr">
                    <h3 class="productDescrip__title">
                        <?php echo $product[9] ?>
                    </h3>
                    <div class="productDescrip__content">
                        <?php echo $product[10] ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- productConfig -->
        <div class="productConfig__area col l-6">
            <div class="productConfig__wrap">
                <h3 class="productConfig__header">Cấu hình <?php echo $product[4] ?></h3>
                <ul class="productConfig__list ul__format">
                    <?php
                        $config_title = explode('$', $product[11]);
                        $config_content = explode('$', $product[12]);
                        for ($i=0; $i < count($config_title)-1; $i++) { 
                    ?>
                        <li class="productConfig__item">
                            <div class="li__left"><?php echo $config_title[$i] ?></div>
                            <div class="li__right"><?php echo $config_content[$i] ?></div>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- san pham tuong tu -->
    <div class="productSame__container row">
        <h3 class="productSame__Header col l-12">SẢN PHẨM TƯƠNG TỰ</h3>
        <div class="splide slideshow__container col l-12">
            <div class="splide__arrows">
                <button class="splide__arrow splide__arrow--prev prev pro_prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="splide__arrow splide__arrow--next next pro_next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div class="splide__track">
                <ul class="splide__list">
                    <?php
                        while ($products = mysqli_fetch_array($query_products)) {
                    ?>
                        <li class="splide__slide">
                            <div class="product__areaWrapper">
                                <div class="product__img">
                                    <a href="?product-detail=<?php echo $_GET['product-detail'] ?>&brand=<?php echo $products['slug'] ?>&id=<?php echo $products['id'] ?>">
                                        <img src="./assets/imgs/admin/upload_img_product/<?php echo $products['thumbnail'] ?>" alt="">
                                    </a>
                                </div>
                                <div class="product__textArea">
                                    <div class="product__textHeader">
                                        <a href="?product-detail=<?php echo $_GET['product-detail'] ?>&brand=<?php echo $products['slug'] ?>&id=<?php echo $products['id'] ?>"><?php echo $products['name_prod'] ?></a>
                                    </div>
                                    <div class="product__textPrice">
                                        <?php echo number_format($products['price'],0,"","."); ?>
                                        <span>đ</span>
                                    </div>
                                    
                                    <div class="product__textButton">
                                        <a href="pages/contents/handle/product_handle.php?add-to-cart&id=<?php echo $products['id'] ?>">Thêm vào giỏ</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- Next and previous buttons -->
        <!-- <a class="prev pro_prev" onclick="product__slider(-1, 244.8, '.productSame__item:first-child', '.productSame__item:last-child')">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="next pro_next" onclick="product__slider(1, 244.8, '.productSame__item:first-child')">
            <i class="fas fa-chevron-right"></i>
        </a> -->
    </div>
</div>