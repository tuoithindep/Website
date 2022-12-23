<?php
    $sql = 'SELECT * FROM category';
    $query = mysqli_query($mysqli, $sql);
?>

<!-- trang chu -->
<div class="content__wrapper wide" style="display: block">
    <!-- slide -->
    <div class="content__slide row">
        <div class="col l-9">
            <div class="slideshow__container">
                <!-- Full-width images with number and caption text -->
                <div class="mySlides fadeIn">                           
                    <img src="./assets/imgs/banner.jpg" style="width:100%">                           
                </div>
                
                <div class="mySlides fadeIn">
                    <img src="./assets/imgs/banner1.jpg" style="width:100%">
                </div>
                
                <div class="mySlides fadeIn">
                    <img src="./assets/imgs/baner2.jpg" style="width:100%">
                </div>
                
                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a class="next" onclick="plusSlides(1)">
                    <i class="fas fa-chevron-right"></i>
                </a>

                <!-- The dots/circles -->
                <div class="dot__component">
                    
                </div>
            </div>
        </div>
        <div class="col l-3">
            <div class="slide__news">
                <div class="slide__newsWrapper">
                    <!-- news__header -->
                    <div class="news__header">
                        <div class="news__headerWr news__product" 
                        onclick="activeNews__header(0)"
                        onmouseover="hoverNews__header()"
                        onmouseout="outNews__header()">
                            <a href="#">Sản phẩm</a> 
                        </div>
                        <div class="news__headerWr news_news" 
                        onclick="activeNews__header(1)"
                        onmouseover="hoverNews__header()"
                        onmouseout="outNews__header()">
                            <a href="#">Tin tức</a>  
                        </div>
                    </div>

                    <!-- news__contentArea -->
                    <div class="news__contentArea">
                        <div class="news__contentWr news__productArea">
                            <div class="news__contentWrap">
                                <div class="news__contentHeader">
                                    <a href="#">Cách chèn nhạc vào ảnh và video trên Facebook</a>           
                                </div>
                                <div class="news__contentDate">
                                    10 Tháng 5, 2021
                                </div>
                                <div class="news__content">
                                    Những bức ảnh và video trên Facebook của bạn sẽ thêm phần thú vị hơn ...					
                                </div>
                            </div>
                            <div class="news__contentWrap">
                                <div class="news__contentHeader">
                                    <a href="#">iPhone XI đã được bán ra ở Trung Quốc với 3 phiên bản màu</a>           
                                </div>
                                <div class="news__contentDate">
                                    10 Tháng 5, 2021
                                </div>
                                <div class="news__content">
                                    Thông tin về iPhone XI ra mắt khiến fan công nghệ chờ đợi và tò ...										
                                </div>
                            </div>
                        </div>
                        <div class="news__contentWr news__newsArea">
                            <div class="news__contentWrap">
                                <div class="news__contentHeader">
                                    <a href="#">Bạn có nên lo lắng về việc iPhone của bạn có thể phát nổ?</a>           
                                </div>
                                <div class="news__contentDate">
                                    10 Tháng 5, 2021
                                </div>
                                <div class="news__content">
                                    Có rất nhiều thông tin đề cập đến iPhone phát nổ gây ra nhiều nguy ...					
                                </div>
                            </div>
                            <div class="news__contentWrap">
                                <div class="news__contentHeader">
                                    <a href="#">Xiaomi ra mắt máy cạo râu Mi Beard Trimmer</a>           
                                </div>
                                <div class="news__contentDate">
                                    10 Tháng 5, 2021
                                </div>
                                <div class="news__content">
                                    Sau khi trở thành một công ty điện tử tiêu dùng lớn ở Ấn Độ, ...													
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <!-- hot__products -->
    <div class="content__area">
        <div class="content__areaWrapper">
            <!-- content__header -->
            <div class="content__header">
                <h3>Sản phẩm nổi bật</h3>
                <i class="fas fa-chevron-right"></i> 
                <span>Những sản phẩm đang bán chạy nhất</span> 
            </div>

            <!-- content__product -->
            <div class="content__product row">
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
                                $sql_product = 'SELECT product.id, thumbnail, name_prod, price, brand.slug as brand_slug, category.slug as cate_slug , SUM(payment.product_quantity)
                                FROM product, brand, category, payment
                                WHERE product.category_id = category.id AND product.brand_id  = brand.id AND payment.product_id = product.id 
                                GROUP BY payment.product_id
                                ORDER BY SUM(payment.product_quantity) DESC
                                LIMIT 12';
                                $query_product = mysqli_query($mysqli, $sql_product);
                                // if(!$query_product){
                                //     echo mysqli_error($mysqli);
                                //     die();
                                // }
                                while ($products = mysqli_fetch_array($query_product)) {
                            ?>
                                <li class="splide__slide">
                                    <div class="product__areaWrapper">
                                        <div class="product__img">
                                            <a href="?product-detail=<?php echo $products['cate_slug'] ?>&brand=<?php echo $products['brand_slug'] ?>&id=<?php echo $products['id'] ?>">
                                                <img src="./assets/imgs/admin/upload_img_product/<?php echo $products['thumbnail'] ?>" alt="img">
                                            </a>
                                        </div>
                                        <div class="product__textArea">
                                            <div class="product__textHeader">
                                                <a href="?product-detail=<?php echo $products['cate_slug'] ?>&brand=<?php echo $products['brand_slug'] ?>&id=<?php echo $products['id'] ?>"><?php echo $products['name_prod'] ?></a>
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
            </div>

            <!-- Xem Them -->
<!--
            <div class="content__footer">
                <a href="#">Xem thêm</a>
                <i class="fas fa-chevron-right"></i> 
            </div>
-->
        </div>
    </div>

    <!-- new__products -->
    <div class="content__area">
        <div class="content__areaWrapper">
            <!-- content__header -->
            <div class="content__header">
                <h3>Sản phẩm mới</h3> 
                <i class="fas fa-chevron-right"></i>
                <span>Những sản phẩm mới về</span> 
            </div>

            <!-- content__product -->
            <div class="content__product row">
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
                                $sql_product = 'SELECT product.createdAt,product.id, thumbnail, name_prod, price, brand.slug as brand_slug, category.slug as cate_slug 
                                FROM product, brand, category
                                WHERE product.category_id = category.id AND product.brand_id = brand.id ORDER BY product.createdAt DESC 
                                LIMIT 15';
                                $query_product = mysqli_query($mysqli, $sql_product);
                                while ($products = mysqli_fetch_array($query_product)) {
                            ?>
                                <li class="splide__slide">
                                    <div class="product__areaWrapper">
                                        <div class="product__img">
                                            <a href="?product-detail=<?php echo $products['cate_slug'] ?>&brand=<?php echo $products['brand_slug'] ?>&id=<?php echo $products['id'] ?>">
                                                <img src="./assets/imgs/admin/upload_img_product/<?php echo $products['thumbnail'] ?>" alt="img">
                                            </a>
                                        </div>
                                        <div class="product__textArea">
                                            <div class="product__textHeader">
                                                <a href="?product-detail=<?php echo $products['cate_slug'] ?>&brand=<?php echo $products['brand_slug'] ?>&id=<?php echo $products['id'] ?>"><?php echo $products['name_prod'] ?></a>
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
            </div>

            <!-- Xem Them -->
<!--
            <div class="content__footer">
                <a href="#">Xem thêm</a>
                <i class="fas fa-chevron-right"></i> 
            </div>
-->
        </div>
    </div>

    <?php
        while ($categories = mysqli_fetch_array($query)) {
    ?>
    <!-- product -->
        <div class="content__area">
            <div class="content__areaWrapper">
                <!-- content__header -->
                <div class="content__header">
                    <h3><?php echo $categories['name'] ?></h3> 
                    <i class="fas fa-chevron-right"></i>
                    <span></span> 
                </div>

                <!-- content__product -->
                <div class="content__product row">
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
                                    $sql_product = 'SELECT product.id, thumbnail, name_prod, price, brand.slug FROM product, brand 
                                    WHERE product.brand_id = brand.id AND product.category_id = '.$categories['id'].' ORDER BY RAND() LIMIT 15';
                                    $query_product = mysqli_query($mysqli, $sql_product);
                                    while ($products = mysqli_fetch_array($query_product)) {
                                ?>
                                    <li class="splide__slide">
                                        <div class="product__areaWrapper">
                                            <div class="product__img">
                                                <a href="?product-detail=<?php echo $categories['slug'] ?>&brand=<?php echo $products['slug'] ?>&id=<?php echo $products['id'] ?>">
                                                    <img src="./assets/imgs/admin/upload_img_product/<?php echo $products['thumbnail'] ?>" alt="img">
                                                </a>
                                            </div>
                                            <div class="product__textArea">
                                                <div class="product__textHeader">
                                                    <a href="?product-detail=<?php echo $categories['slug'] ?>&brand=<?php echo $products['slug'] ?>&id=<?php echo $products['id'] ?>"><?php echo $products['name_prod'] ?></a>
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
                </div>

                <!-- Xem Them -->
                <div class="content__footer">
                    <a href="?product=<?php echo $categories['slug'] ?>">Xem thêm</a>
                    <i class="fas fa-chevron-right"></i> 
                </div>
            </div>
        </div>
    <?php
        }
    ?>
</div>