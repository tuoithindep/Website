<?php
    //GET product category list
    $sql_category = 'SELECT * FROM category';
    //GET product brand list
    $sql_brand = 'SELECT * FROM category';
    //Thuc hien truy van den DB
    $query_category = mysqli_query($mysqli, $sql_category);
    $query_brand = mysqli_query($mysqli, $sql_brand);
?>

<!-- productDetail -->
<div class="productDetail__container row">
    <!-- product__IMG -->
    <div class="productDetail__Area col l-6">
        <form id="formasd" action="pages/contents/productMn/handle.php?page=<?php echo $_GET['page'] ?>&create" method="post" enctype="multipart/form-data">
            <div class="file-upload">
                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">CHỌN ẢNH</button>
    
                <div class="image-upload-wrap">
                    <input name="imgProduct" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                    <div class="drag-text">
                    <h3>Kéo và thả ảnh hoặc click để chọn ảnh</h3>
                    </div>
                </div>
                <div class="file-upload-content">
                    <img class="file-upload-image" src="" alt="your image" />
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
                <h1 name="nameProduct" class="product__infoTitle text_edittor" contenteditable="true" spellcheck="false">Giá đỡ điện thoại trên ô tô Remax RM-C06</h1>
            </div>
            
            <!-- price__product -->
            <div class="product__infoPrice">                       
                <span class="productPrice text_edittor" contenteditable spellcheck="false" name="priceProduct">258.000<span contenteditable="false"> đ</span></span>
            </div>

            <!-- sort-descrip__product -->
            <div name="despProduct" class="product__infoShortDescrip text_edittor" contenteditable="true" spellcheck="false">
                Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500
            </div>

            <!-- uu dai them -->
            <div class="product__infoGift">
                <div class="infoGift__header">Quà tặng</div>
                <ul class="infoGift__list ul__format">
                    <li class="infoGift__item text_edittor" contenteditable spellcheck="false">                      
                        <span class="infoGift__icon" contenteditable='false'>
                            <i class="fas fa-check-circle" ></i>
                        </span> 
                        <span class="infoGift__text"  name="giftProduct" >Tặng Balo Laptop</span>
                        <span class="x_icon" contenteditable="false" >
                            <i class="fas fa-times-circle"></i>
                        </span>
                    </li>
                    <li class="infoGift__item text_edittor" contenteditable spellcheck="false">
                        <span class="infoGift__icon" contenteditable='false'>
                            <i class="fas fa-check-circle" ></i>
                        </span> 
                        <span class="infoGift__text"  name="giftProduct" >Tặng PMH 300.000đ mua máy in HP</span>                                   
                        <span class="x_icon" contenteditable="false" >
                            <i class="fas fa-times-circle"></i>
                        </span>
                    </li>
                    <li class="infoGift__item text_edittor" contenteditable spellcheck="false">
                        <span class="infoGift__icon" contenteditable='false'>
                            <i class="fas fa-check-circle" ></i>
                        </span>
                        <span class="infoGift__text" name="giftProduct">Tặng tai nghe có dây choàng đầu có Mic I.value T-139 áp dụng đến 20/05 (Không áp dụng Trả góp 0%/0đ)</span>
                        <span class="x_icon" contenteditable="false" >
                            <i class="fas fa-times-circle"></i>
                        </span>
                    </li>
                    <li class="infoGift__item text_edittor" contenteditable spellcheck="false">
                        <span class="infoGift__icon" contenteditable='false'>
                            <i class="fas fa-check-circle" ></i>
                        </span>
                        <span class="infoGift__text" name="giftProduct">Thu cũ đổi mới - Trợ giá ngay 15%</span>
                        <span class="x_icon" contenteditable="false" >
                            <i class="fas fa-times-circle"></i>
                        </span>
                    </li>
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
                    <input class="text_edittor" name="quantityProduct" type="number" min="1" value="1">
                </div>
                <div class="selectWr selectWrcate">
                    <span>Loại SP</span>
                    <select name="category" id="category_select">
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
                        $sql_brand = 'SELECT * FROM brand ORDER BY `category_id` ASC';
                        $query_brand = mysqli_query($mysqli, $sql_brand);
                    ?>
                    <span>Hãng SP</span>
                    <select name="brand" id="brand_select">
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
                    sở hữu thiết kế từ kim loại toát lên vẻ sang trọng, sắc sảo, cấu hình lí tưởng cho học tập, trình duyệt web khi trang bị bộ vi xử lý Intel thế hệ thứ 10 mới và ổ cứng SSD cực nhanh.
                </h3>
                <div name="contentDsp" class="productDescrip__content text_edittor" contenteditable="true" spellcheck="false">
                    Thiết kế của Laptop Lenovo ThinkBook 15 IML hướng đến sự tối giản và hiện đại. Máy có nắp lưng bằng kim loại và thân máy được làm từ nhựa ABS cao cấp, vừa mang lại vẻ sang trọng, vừa bền bỉ. Máy có độ dày chỉ 18.9 mm, trọng lượng chỉ 1.8 kg, khá mỏng nhẹ đối với laptop cùng phân khúc, dễ dàng cho vào balo hay túi xách, sẵn sàng cùng bạn “lên đường”.
                </div>
            </div>
        </div>
    </div>

    <!-- productConfig -->
    <div class="productConfig__area col l-6">
        <div class="productConfig__wrap">
            <h3 class="productConfig__header">Cấu hình Laptop Lenovo ThinkBook 15IIL i3 1005G1/4GB/512GB/Win10 (20SM00D9VN)</h3>
            <ul class="productConfig__list ul__format">
                <li class="productConfig__item text_edittor" contenteditable spellcheck="false">
                    <div name="titleConfig" class="li__left">CPU:</div>
                    <div name="contentConfig" class="li__right">Intel Core i3 Ice Lake1005G11.20 GHz</div>
                    <span class="x_icon" contenteditable="false" >
                        <i class="fas fa-times-circle"></i>
                    </span>
                </li>
                <li class="productConfig__item text_edittor" contenteditable="true" spellcheck="false">
                    <div name="titleConfig" class="li__left">RAM:</div>
                    <div name="contentConfig" class="li__right">4 GBDDR4 (1 khe)2666 MHz</div>
                    <span class="x_icon" contenteditable="false" >
                        <i class="fas fa-times-circle"></i>
                    </span>
                </li>
                <li class="productConfig__item text_edittor" contenteditable="true" spellcheck="false">
                    <div name="titleConfig" class="li__left">Ổ cứng:</div>
                    <div name="contentConfig" class="li__right">SSD 512 GB NVMe PCIeHỗ trợ khe cắm HDD SATA</div>
                    <span class="x_icon" contenteditable="false" >
                        <i class="fas fa-times-circle"></i>
                    </span>
                </li>
                <li class="productConfig__item text_edittor" contenteditable="true" spellcheck="false">
                    <div name="titleConfig" class="li__left">Màn hình:</div>
                    <div name="contentConfig" class="li__right">15.6"Full HD (1920 x 1080)</div>
                    <span class="x_icon" contenteditable="false" >
                        <i class="fas fa-times-circle"></i>
                    </span>
                </li>
                <li class="productConfig__item text_edittor" contenteditable="true" spellcheck="false">
                    <div name="titleConfig" class="li__left">Card màn hình:</div>
                    <div name="contentConfig" class="li__right">Card đồ họa tích hợpIntel UHD Graphics</div>
                    <span class="x_icon" contenteditable="false" >
                        <i class="fas fa-times-circle"></i>
                    </span>
                </li>
                <li class="productConfig__item text_edittor" contenteditable="true" spellcheck="false">
                    <div name="titleConfig" class="li__left">Cổng kết nối:</div>
                    <div name="contentConfig" class="li__right">2 x USB 3.1HDMILAN (RJ45)USB 2.02 x USB Type-C</div>
                    <span class="x_icon" contenteditable="false" >
                        <i class="fas fa-times-circle"></i>
                    </span>
                </li>
                <li class="productConfig__item">
                    <div class="addConfig_wr">
                        <span>Thêm</span> 
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="btn_save">
        <button type="submit" form="formasd">TẠO</button>
    </div>
</div>