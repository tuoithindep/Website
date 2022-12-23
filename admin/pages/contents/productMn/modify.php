<?php
    //GET product list
    $sql_product = 'SELECT * FROM product WHERE id='.$_GET['id'];
    //GET product category list
    $sql_category = 'SELECT * FROM category';
    //GET product brand list
    $sql_brand = 'SELECT * FROM category';
    //Thuc hien truy van den DB
    $query_product = mysqli_query($mysqli, $sql_product);
    $query_category = mysqli_query($mysqli, $sql_category);
    $query_brand = mysqli_query($mysqli, $sql_brand);

    function handle_href_action_form($product_id){
        $action = "pages/contents/productMn/handle.php?modify&id=".$product_id."";
        if(isset($_GET['page'])){
            $action = "pages/contents/productMn/handle.php?page=".$_GET['page']."&modify&id=".$product_id."";
        }
        return $action;
    }
?>

<?php
    while ($product = mysqli_fetch_array($query_product)) {
?>
<!-- productDetail -->
<div class="productDetail__container row">
    <!-- product__IMG -->
    <div class="productDetail__Area col l-6">
        <form id="formasd" action="<?php echo handle_href_action_form($_GET['id']) ?>" method="post" enctype="multipart/form-data">
            <div class="file-upload">
                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">CHỌN ẢNH</button>
    
                <div class="image-upload-wrap">
                    <input name="imgProduct" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                    <div class="drag-text">
                    <h3>Kéo và thả ảnh hoặc click để chọn ảnh</h3>
                    </div>
                </div>
                <div class="file-upload-content">
                    <img class="file-upload-image" src="../assets/imgs/admin/upload_img_product/<?php echo $product['thumbnail'] ?>" alt="your image" />
                    <div class="image-title-wrap">
                    <button type="button" onclick="removeUpload()" class="remove-image">XOÁ <span class="image-title">Uploaded Image</span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- product__info -->
    <div class="productDetail__Area col l-6">
        <div class="product__infoWrap">
            <!-- name__product -->
            <div class="text_edittorWr">
                <h1 name="nameProduct" class="product__infoTitle text_edittor" contenteditable="true" spellcheck="false"><?php echo $product['name_prod'] ?></h1>
            </div>
            
            <!-- price__product -->
            <div class="product__infoPrice">                       
                <span class="productPrice text_edittor" contenteditable spellcheck="false" name="priceProduct"><?php echo $product['price'] ?><span contenteditable="false"> đ</span></span>
            </div>

            <!-- sort-descrip__product -->
            <div name="despProduct" class="product__infoShortDescrip text_edittor" contenteditable="true" spellcheck="false">
                <?php echo $product['description_prod'] ?>
            </div>

            <!-- uu dai them -->
            <div class="product__infoGift">
                <div class="infoGift__header">Quà tặng</div>
                <ul class="infoGift__list ul__format">
                    <?php
                        $gift = explode('$', $product['gift']);
                        for ($i=0; $i < count($gift)-1; $i++) { 
                    ?>
                            <li class="infoGift__item text_edittor" contenteditable spellcheck="false">                      
                                <span class="infoGift__icon" contenteditable='false'>
                                    <i class="fas fa-check-circle" ></i>
                                </span> 
                                <span class="infoGift__text"  name="giftProduct" ><?php echo $gift[$i] ?></span>
                                <span class="x_icon" contenteditable="false" >
                                    <i class="fas fa-times-circle"></i>
                                </span>
                            </li>
                    <?php
                        }
                    ?>
                    <li class="infoGift__item">
                        <div class="addGift_wr">
                            <span>Thêm</span> 
                        </div>
                    </li>
                </ul>
            </div>
            
            <div class="select_container">
                <div class="quantity_proWr">
                    <span>Số lượng:</span>
                    <input class="text_edittor" name="quantityProduct" type="number" min="1" value="<?php echo $product['quantity'] ?>">
                </div>
                <div class="selectWr selectWrcate">
                    <span>Loại SP</span>
                    <select name="category" id="category_select" value="<?php echo $product['category_id'] ?>">
                        <option value="">-Chọn Loại SP-</option>
                        <?php
                            while ($categories = mysqli_fetch_array($query_category)) {
                        ?>
                            <option value="<?php echo $categories['id'] ?>"><?php echo $categories['name'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="selectWr selectWrbrand">
                    <?php
                        //GET product brand list
                        // $sql_brand = 'SELECT * FROM brand WHERE category_id = '.$_COOKIE["categoryID"];
                        $sql_brand = 'SELECT category.name as categoryName, brand.name, brand.id, category_id
                        FROM brand, category WHERE brand.category_id = category.id ORDER BY `category_id` ASC';
                        //Thuc hien truy van den DB
                        $query_brand = mysqli_query($mysqli, $sql_brand);
                    ?>
                    <span>Hãng SP</span>
                    <select name="brand" id="brand_select" value="<?php echo $product['brand_id'] ?>">
                        <option value="">-Chọn Hãng SP-</option>
                        <?php
                            while ($brands = mysqli_fetch_array($query_brand)) {
                        ?>
                            <option style="display: none;" categoryID="<?php echo $brands['category_id'] ?>" value="<?php echo $brands['id'] ?>"><?php echo $brands['name'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
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
                <h3 name="titleDsp" class="productDescrip__title text_edittor" contenteditable="true" spellcheck="false">
                    <?php echo $product['news_title'] ?>
                </h3>
                <div name="contentDsp" class="productDescrip__content text_edittor" contenteditable="true" spellcheck="false">
                    <?php echo $product['news_content'] ?>                  
                </div>
            </div>
        </div>
    </div>

    <!-- productConfig -->
    <div class="productConfig__area col l-6">
        <div class="productConfig__wrap">
            <h3 class="productConfig__header">Cấu hình Laptop Lenovo ThinkBook 15IIL i3 1005G1/4GB/512GB/Win10 (20SM00D9VN)</h3>
            <ul class="productConfig__list ul__format">
                <?php
                    $config_title = explode('$', $product['config_title']);
                    $config_content = explode('$', $product['config_content']);
                    for ($i=0; $i < count($config_title)-1; $i++) { 
                ?>
                    <li class="productConfig__item text_edittor" contenteditable spellcheck="false">
                        <div name="titleConfig" class="li__left"><?php echo $config_title[$i] ?></div>
                        <div name="contentConfig" class="li__right"><?php echo $config_content[$i] ?></div>
                        <span class="x_icon" contenteditable="false" >
                            <i class="fas fa-times-circle"></i>
                        </span>
                    </li>
                <?php
                    }
                ?>
                <li class="productConfig__item">
                    <div class="addConfig_wr">
                        <span>Thêm</span> 
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="btn_save">
        <button type="submit" form="formasd">LƯU</button>
    </div>
</div>
<?php
    }
?>