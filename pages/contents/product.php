
<?php
    $quantity_product_of_page = 6;
    $page_choosed = 0;
    if(isset($_GET['page'])){
        if($_GET['page'] == 1){
            $page_choosed = 0;
        }else {
            $page_choosed = ($_GET['page']*$quantity_product_of_page)-$quantity_product_of_page;
        }
    }

    $sql_categories = 'SELECT * FROM category';
    $sql_category = 'SELECT name FROM category WHERE slug = "'.$_GET['product'].'"';
    $sql_brands = 'SELECT brand.name, brand.slug FROM category, brand 
    WHERE category.id = category_id AND category.slug = "'.$_GET['product'].'"';

    $sql_products = 'SELECT product.id, thumbnail, name_prod, price, brand.slug FROM product, category, brand
    WHERE product.brand_id = brand.id AND product.category_id = category.id AND category.slug = "'.$_GET['product'].'"';
    
    //loc theo brand
    if(isset($_GET['brand'])){
        $sql_products = $sql_products.' AND brand_id = brand.id AND brand.slug = "'.$_GET['brand'].'"';
    }
    

    //loc theo moi nhat, gia thap den cao, cao den thap
    if(isset($_POST['filter'])){
        if($_POST['filter'] == 'new'){
            $sql_products = $sql_products.' ORDER BY product.createdAt DESC';
        }else if($_POST['filter'] == 'price_asc'){
            $sql_products = $sql_products.' ORDER BY product.price ASC';
        }else if($_POST['filter'] == 'price_desc'){
            $sql_products = $sql_products.' ORDER BY product.price DESC';
        }else{
            unset($_POST['filter']); 
        }
    }else{
        // echo '
        //     <script>
        //         document.addEventListener("DOMContentLoaded", () => {
        //             document.querySelector("#filter_select").options[0].selected = true;
        //         });
        //     </script>
        // ';
    }

    //loc theo gia
    if(isset($_POST['price_range'])){
        $sql_products = $sql_products.' AND price < '.$_POST['price_range'];
    }else{
        // echo '
        //     <script>
        //         document.addEventListener("DOMContentLoaded", () => {
        //             slider.setAttribute("value", 25000000);
        //             slide_hoder.style.width = "50%";
        //             output.innerText = "25000000".replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        //         });
        //     </script>
        // ';
    }

    //limit for pagination
    $count_product = mysqli_num_rows(mysqli_query($mysqli, $sql_products));
    if($count_product > $quantity_product_of_page){
        $sql_products = $sql_products.' LIMIT '.$page_choosed.','.$quantity_product_of_page.'';
    }

    //query
    $query_categories = mysqli_query($mysqli, $sql_categories);
    $query_category = mysqli_query($mysqli, $sql_category);
    $category = mysqli_fetch_row($query_category);

    $query_brands = mysqli_query($mysqli, $sql_brands);
    $query_products = mysqli_query($mysqli, $sql_products);

    //handle pagination
    $quantity_page = ceil($count_product/$quantity_product_of_page);

    //remove param
    function removeParam($url, $param) {
        $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*$/', '', $url);
        $url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*&/', '$1', $url);
        return $url;
    }
?>

<!-- san pham -->
<div class="content__wrapper wide">
    <!-- heading -->
    <div class="content__heading row">
        <div class="content__headingText col l-3">
            <a href="home">TRANG CHỦ</a>
            <span>/</span>
            <h4><?php echo mb_strtoupper($category[0], 'UTF-8') ;  ?></h4>
        </div>

        <div class="headingFilter__container col l-9">
            <div class="content__headingFilter">
                <span>Lọc theo hãng sản xuất :</span>
                <select name="" id="fllter_brand_select" class="oderBy__select">
                    <option value="#" selected="selected">Chọn hãng sản xuất</option>
                    <?php
                        while ($brands = mysqli_fetch_array($query_brands)) {
                    ?>
                        <option value="<?php echo $brands['slug'] ?>" ><?php echo $brands['name'] ?></option>                       
                    <?php
                        }
                    ?>
                </select>
                
            </div>
            <div class="content__headingFilter">
                <span>Lọc sản phẩm theo :</span>
                <form method="POST" action="" class="oderBy__form">
                    <select name="filter" class="oderBy__select" id="filter_select">
                        <option value="default" selected>Thứ tự mặc định</option>
                        <option value="new">Sản phẩm mới nhất</option>
                        <option value="price_asc">Giá: thấp đến cao</option>
                        <option value="price_desc">Giá: cao xuống thấp</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <!-- content__product -->
    <div class="content__products row">
        <!-- navigation -->
        <div class="productsNav__Container col l-3">
            <!-- category -->
            <div class="products__Category">
                <h4 class="Category__header">DANH MỤC SẢN PHẨM</h4>
                <ul class="Category__list">
                    <?php
                        while ($categories = mysqli_fetch_array($query_categories)) {
                    ?>
                        <li class="Category__item">
                            <a product="<?php echo $categories['slug']; ?>" href="?product=<?php echo $categories['slug']; ?>" class="Category__link"><?php echo $categories['name'] ?></a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>

            <!-- filter__price -->
            <div class="products__FilterPrice">
                <h4 class="FilterPrice__header">LỌC THEO GIÁ</h4>
                <div class="price_slider_containner">
                    <form action="" method="post">
                        <div class="price_slider_wrapper">
                            <span class="slide_hoder"></span>
                            <input name="price_range" type="range" class="slide" min="100000" max="50000000" value="25000000" id="myRange">
                            <div class="price_slider_amount">
                                <button type="submit" class="filter__btn btn">Lọc</button>
                                <div class="price_label">
                                    <span class="gia">Giá:</span>
                                    <span class="from">100.000 đ</span> 
                                    <span class="gachngang">-</span> 
                                    <span id="price_desc"></span> 
                                    <span class="d"> đ</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- product -->
        <div class="products__Container col l-9">
            <div class="products__Area row">
                <?php
                    function handle_href_add_cart($id){
                        $href_cart = $_SERVER['REQUEST_URI'].'&add-to-cart&id='.$id;
                        if(isset($_GET['add-to-cart'])){
                            $add_to_cart = str_replace("&add-to-cart","",$_SERVER['REQUEST_URI']);
                            $href_cart = removeParam($add_to_cart, 'id').'&add-to-cart&id='.$id;
                        }
                        return $href_cart;
                    }
                    while ($products = mysqli_fetch_array($query_products)) {
                ?>
                <div class="products__Wrap col l-4">
                    <div class="product__areaWrapper">
                        <div class="product__img">
                            <a href="?product-detail=<?php echo $_GET['product'] ?>&brand=<?php echo $products['slug'] ?>&id=<?php echo $products['id'] ?>">
                                <img src="./assets/imgs/admin/upload_img_product/<?php echo $products['thumbnail'] ?>" alt="img">
                            </a>
                        </div>
                        <div class="product__textArea">
                            <div class="product__textHeader">
                                <a href="?product-detail=<?php echo $_GET['product'] ?>&brand=<?php echo $products['slug'] ?>&id=<?php echo $products['id'] ?>"><?php echo $products['name_prod'] ?></a>
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
                </div>
                <?php              
                    }
                ?>
            </div>

            <div class="pagination__area">
                <ul class="pagination__list ul__format">
                    
                    <!-- <li class="pagination__item">
                        <a href="#" class="pagination__link a_format">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li> -->

                    <?php
                        function handle_href_page($i){
                            $href_page = $_SERVER['REQUEST_URI'].'&page='.$i;
                            if(isset($_GET['page'])){
                                $href_page =  removeParam($_SERVER['REQUEST_URI'], 'page').'&page='.$i;
                            }
                            return $href_page;
                        }
                        for ($i=1; $i <= $quantity_page; $i++) {                            
                    ?>
                        <li class="pagination__item">
                            <a href="<?php echo handle_href_page($i); ?>" class="pagination__link a_format"><?php echo $i; ?></a>
                        </li>  
                    <?php
                        }
                    ?>
           
                    <!-- <li class="pagination__item">
                        <a href="#" class="pagination__link a_format">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>                              -->
                </ul>
            </div>
        </div>
    </div>

</div>

<?php
    if(!isset($_POST['filter'])){
        echo '
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    document.querySelector("#filter_select").options[0].selected = true;
                });
            </script>
        ';
    }

    if(!isset($_POST['price_range'])){
        echo '
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    slider.setAttribute("value", 25000000);
                    slide_hoder.style.width = "50%";
                    output.innerText = "25000000".replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                });
            </script>
        ';
    }
?>