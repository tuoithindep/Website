<?php
    $sql_product = 'SELECT * FROM product WHERE id = "'.$_GET['id'].'"';
    $query_product = mysqli_query($mysqli, $sql_product);
    $product = mysqli_fetch_row($query_product);
?>

<!-- san pham chi tiet -->
<div class="productDetail__wrapper wide">
    <!-- productDetail -->
    <div class="productDetail__container row">
        <!-- product__IMG -->
        <div class="productDetail__Area col l-6">
            <img src="../assets/imgs/admin/upload_img_product/<?php echo $product[3] ?>" alt="">
        </div>

        <!-- product__info -->
        <div class="productDetail__Area col l-6">
            <div class="product__infoWrap">
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
</div>