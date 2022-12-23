<?php
    //GET product category list
    $sql = 'SELECT * FROM category';
    //Thuc hien truy van den DB
    $query = mysqli_query($mysqli, $sql);
    
?>

<h3>Product category list</h3>
<table>
    <tr>
        <th>No</th>
        <th>Name category</th>
        <th>CreatedAt</th>
        <th>Action</th>
    </tr>
    <?php
        $no = 1;
        while ($categories = mysqli_fetch_array($query)) {
    ?>
        <tr>
            <td><?php echo $no ?></td>
            <td class="category_name"><?php echo $categories['name'] ?></td>
            <td><?php echo $categories['createdAt'] ?></td>
            <td style="width: 100px">
                <a class="delete btn_action" href="?management&category&delete&id=<?php echo $categories['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php
        $no+=1;
        }
    ?>
</table>
<form id="add_category" action="pages/contents/categoryMn/handle.php" method="POST">
    <div class="form-group">
        <label for="name">Category</label>
        <input style="padding: 7px;" name="name" type="text" class="form-control" id="input_nameCategory" placeholder="Enter Name Category">
    </div>

    <button type="submit" class="add_btn" name="add">ADD</button>  
</form>