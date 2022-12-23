<!-- admin_content -->
<div class="main">
    <div class="content grid">
        <div class="Container wide">
            <div class="wrapper">
                <!-- LOADER -->
                <div class="loader_container">
                    <div class="loader_wr">
                        <span>LOADING</span>
                        <div class="loader"></div>      
                    </div>
                </div>

                <div class="content_loaded" style="display: none">
                    <?php
                        if(isset($_GET['category'])){
                            if(isset($_GET['delete'])){ 
                                include('contents/categoryMn/handle.php'); // ../admin/management/category/delete
                            }else {
                                include('contents/categoryMn/main.php');  // ../admin/management/category
                            }
                        }elseif(isset($_GET['brand'])){
                            if(isset($_GET['delete'])){ 
                                include('contents/brandMn/handle.php'); // ../admin/management/brand/delete
                            }else {
                                include('contents/brandMn/main.php');  // ../admin/management/brand
                            }
                        }elseif (isset($_GET['product'])) {
                            if(isset($_GET['create'])){ 
                                include('contents/productMn/create.php'); // ../admin/management/product/create
                            }elseif(isset($_GET['delete'])){ 
                                include('contents/productMn/handle.php'); // ../admin/management/product/delete
                            }elseif(isset($_GET['modify'])){ 
                                include('contents/productMn/modify.php'); // ../admin/management/product/delete
                            }else{
                                include('contents/productMn/main.php');  // ../admin/management/product
                            }
                        }elseif(isset($_GET['payment'])){
                            if(isset($_GET['detail'])){ 
                                if(isset($_GET['view-product'])){ 
                                    include('contents/paymentMn/product.php'); // ../admin/management/payment/detail/view_product
                                }else{
                                    include('contents/paymentMn/detail.php'); // ../admin/management/payment/detail
                                }
                            }else{
                                include('contents/paymentMn/main.php');  // ../admin/management/payment
                            }
                        }else {
                            include('contents/home.php'); // ../admin/home
                        }
                    ?>

                    <div class="modal">
                        <div class="modal_Wr">
                            <h3>Are you sure ?</h3>
                            <div class="btn_modal">
                                <div class="modal_close">Close</div>
                                <a class="modal_delete" href="">Delete</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>