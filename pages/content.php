<!-- content -->
<div id="content" class="grid">
    <!-- LOADER -->
    <div class="loader_container">
        <div class="loader_wr">
            <span>LOADING</span>
            <div class="loader"></div>      
        </div>
    </div>

    <!-- CONTENT_LOADED -->
    <div class="content_loaded" style="display: none">
        <?php
            if(isset($_GET['product'])){
                include('contents/product.php');
            }elseif (isset($_GET['product-detail'])) {
                include('contents/product_detail.php');
            }elseif (isset($_GET['pay'])) {
                include('contents/pay.php');
            }elseif (isset($_GET['invoice'])) {
                include('contents/invoice.php');
            }else {
                include('contents/home.php');
            }
        ?>
    </div>
</div>