
<?php
    $quantity_product_of_page = 10;
    $page_choosed = 0;
    if(isset($_GET['page'])){
        if($_GET['page'] == 1){
            $page_choosed = 0;
        }else {
            $page_choosed = ($_GET['page']*$quantity_product_of_page)-$quantity_product_of_page;
        }
    }

    //GET product list
    if(isset($_GET['category_id'])){
        $sql = 'SELECT category.name as categoryName, brand.name as brandName, name_prod, product.createdAt, product.updatedAt, product.id, thumbnail, price 
        FROM product, category, brand WHERE product.category_id = "'.$_GET['category_id'].'" 
        AND product.category_id = category.id AND product.brand_id = brand.id 
        ORDER BY product.category_id ASC LIMIT '.$page_choosed.','.$quantity_product_of_page.'';
        if(isset($_GET['brand_id'])){
            $sql = 'SELECT category.name as categoryName, brand.name as brandName, name_prod, product.createdAt, product.updatedAt, product.id, thumbnail, price 
            FROM product, category, brand WHERE product.category_id = "'.$_GET['category_id'].'" 
            AND product.brand_id = "'.$_GET['brand_id'].'" AND product.category_id = category.id 
            AND product.brand_id = brand.id ORDER BY product.category_id ASC LIMIT '.$page_choosed.','.$quantity_product_of_page.'';
        }
    }else {
        $sql = 'SELECT category.name as categoryName, brand.name as brandName, name_prod, product.createdAt, product.updatedAt, product.id, thumbnail, price 
        FROM product, category, brand WHERE product.category_id = category.id AND product.brand_id = brand.id 
        ORDER BY product.category_id ASC LIMIT '.$page_choosed.','.$quantity_product_of_page.'';
    }
    //Thuc hien truy van den DB
    $query = mysqli_query($mysqli, $sql);

    //category
    $sql_category = 'SELECT * FROM category';
    $query_category = mysqli_query($mysqli, $sql_category);
    //brand
    $sql_brand = 'SELECT * FROM brand ORDER BY `category_id` ASC';
    $query_brand = mysqli_query($mysqli, $sql_brand);

    //handle pagination
    if(isset($_GET['category_id'])){
        $sql_page = 'SELECT * FROM product WHERE category_id='.$_GET['category_id'].'';
        if(isset($_GET['brand_id'])){
            $sql_page = 'SELECT * FROM product WHERE brand_id='.$_GET['brand_id'].'';
        }
    }else{
        $sql_page = 'SELECT * FROM product';
    }
    $query_page = mysqli_query($mysqli, $sql_page);
    $count_product = mysqli_num_rows($query_page);

    $quantity_page = ceil($count_product/$quantity_product_of_page);

    function a($i) {
        $a = '';
        if(isset($_GET['category_id'])){
            $a = '<a pageCurrent="'.$i.'" class="pagination_link" 
            href="?management&product&category_id='.$_GET["category_id"].'&page='.$i.'">'.$i.'</a>';                                                         
            if(isset($_GET['brand_id'])){
                $a = '<a pageCurrent="'.$i.'" class="pagination_link" 
                href="?management&product&category_id='.$_GET["category_id"].'&brand_id='.$_GET["brand_id"].'&page='.$i.'">'.$i.'</a>';       
            }
        }else{
            $a = '<a pageCurrent="'.$i.'" class="pagination_link" 
            href="?management&product&page='.$i.'">'.$i.'</a>';                                 
        }
        return $a;
    }        
?>

<h3>Product list</h3>
<table>
    <tr>
        <th>No</th>
        <th>Thumbnail</th>
        <th>
            <select style="background-color: #eee;" name="" id="category_select" class="selectCSS">
                <option style="background-color: #ccc" value="#">Category</option>
                <?php
                    while ($categories = mysqli_fetch_array($query_category)) {
                ?>  
                        <option value="<?php echo $categories['id'] ?>"><?php echo $categories['name'] ?></option>
                <?php
                    }
                ?>
            </select>
        </th>
        <th>
            <select style="background-color: #eee;" name="" id="brand_select" class="selectCSS">
                <option style="background-color: #ccc" value="#">Brand</option>
                <?php
                    while ($brands = mysqli_fetch_array($query_brand)) {
                ?>
                    <option style="display: none;" categoryID="<?php echo $brands['category_id'] ?>" value="<?php echo $brands['id'] ?>"><?php echo $brands['name'] ?></option>
                <?php
                    }
                ?>
            </select>
        </th>
        <th>Name</th>
        <th>Price</th>
        <th>CreatedAt</th>
        <th>UpdatedAt</th>
        <th>Action</th>
    </tr>
    <?php
        function hadle_href($action, $productid){
            $href = '';
            if(isset($_GET['page'])){
                $href = "?management&product&page=".$_GET['page']."&".$action."&id=".$productid;
            }else{
                $href = "?management&product&".$action."&id=".$productid;
            }
            return $href;
        }
        function handle_no(){
            $no_init = 1;
            if(isset($_GET['page'])){
                $no_init = ($_GET['page'] * 10) - 9;
            }
            return $no_init;
        }
        $no = handle_no();
        while ($products = mysqli_fetch_array($query)) {
    ?>
        <tr>
            <td><?php echo $no ?></td>
            <td>
                <a class="img_productLink" href="?management&product&modify&id=<?php echo $products['id'] ?>">
                    <img class="img_product" src="../assets/imgs/admin/upload_img_product/<?php echo $products['thumbnail'] ?>" alt="img">
                    <div class="show_detail">
                        View detail
                    </div>
                </a>
            </td>
            <td><?php echo $products['categoryName'] ?></td>
            <td><?php echo $products['brandName'] ?></td>
            <td><?php echo $products['name_prod'] ?></td>
            <td style="width: 120px" ><?php echo number_format($products['price'],0,"","."); ?> đ</td>
            <td><?php echo $products['createdAt'] ?></td>
            <td><?php echo $products['updatedAt'] ?></td>
            <td style="width: 98px">
                <a class="MODIFY_BTN btn_action" href="<?php echo hadle_href('modify', $products['id']) ?>">Modify</a>
                <a style="margin-top: 10px" class="delete btn_action" href="?management&product&delete&id=<?php echo $products['id'] ?>">Delete</a>
            </td>
            
        </tr>
    <?php
        $no += 1;
        }
    ?>
</table>
<div class="add_btn_wr">
    <a  class="ADD_BTN btn_action" href="?management&product&page=<?php echo $quantity_page ?>&create">ADD</a>
</div>

<!-- pagination -->
<div class="pagination_wr">             
    <ul class="pagination_ul">
        <?php
            for ($i=1; $i <= $quantity_page; $i++) {    
        ?>
            <li class="pagination_li">
                <?php
                    echo a($i);
                ?>
            </li>
        <?php
            }
        ?>
    </ul>
</div>
