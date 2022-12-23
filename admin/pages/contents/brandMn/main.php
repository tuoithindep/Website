<?php
    //GET product brand list
    $sql_brand = 'SELECT category.name as categoryName, brand.name, brand.createdAt, brand.id
    FROM brand, category WHERE brand.category_id = category.id ORDER BY `category_id` ASC';
    //GET product category list
    $sql_category = 'SELECT * FROM category';
    //Thuc hien truy van den DB
    $query_brand = mysqli_query($mysqli, $sql_brand);
    $query_category = mysqli_query($mysqli, $sql_category);
?>

<h3>Product brand list</h3>
<table>
    <tr>
        <th>No</th>
        <th>Name category</th>
        <th>Name brand</th>
        <th>CreatedAt</th>
        <th>Action</th>
    </tr>
    <?php
        $no = 1;
        while ($brands = mysqli_fetch_array($query_brand)) {
    ?>
        <tr>
            <td><?php echo $no ?></td>
            <td class="category_name"><?php echo $brands['categoryName'] ?></td>
            <td class="brand_name"><?php echo $brands['name'] ?></td>
            <td><?php echo $brands['createdAt'] ?></td>
            <td style="width: 100px">
                <a class="delete btn_action" href="home?management&brand&delete&id=<?php echo $brands['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php
        $no+=1;
        }
    ?>
</table>
<form id="add_brand" action="pages/contents/brandMn/handle.php" method="POST">
    <div class="form-group">
        <label for="name">Brand</label>
        <select id="select_category" name="product_type" class="form-control" style="margin-left: 6px;">
            <option value="">-Choose category-</option>
            <?php
                while ($categories = mysqli_fetch_array($query_category)) {
            ?>
                <option value="<?php echo $categories['id'] ?>"><?php echo $categories['name'] ?></option>
            <?php
                }
            ?>
        </select>
        <input style="padding: 7px;" id="input_nameBrand" name="name" type="text" class="form-control" id="" placeholder="Enter Name Brand">
    </div>

    <button type="submit" class="add_btn" name="add">ADD</button>  
</form>