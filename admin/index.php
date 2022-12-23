
<?php
    session_start();
    if(!$_SESSION['login']){
        header('Location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/common/base.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="../assets/css/common/grid.css">
    <link rel="stylesheet" href="../assets/css/admin/admin.css?v=<?php echo time() ?>">

    <?php
        // ../admin/management
        if(isset($_GET['management'])){
            echo'<link rel="stylesheet" href="../assets/css/admin/common.css?v='.time().'">';
            // ../admin/management/product/create(modify)
            if(isset($_GET['product'])){
                if(isset($_GET['create']) || isset($_GET['modify'])){
                    echo'<link rel="stylesheet" href="../assets/css/admin/product.css?v='.time().'">';
                }
            } else if(isset($_GET['payment'])){
                echo'<link rel="stylesheet" href="../assets/css/admin/payment.css?v='.time().'">';
            }
        }

    ?>

    <title>ADMIN</title>
</head>
<body>
    <div class="notify_container">
        <div class="notify_wr">
            <!-- <i class="fas fa-exclamation-circle"></i> -->
            <i class="fas fa-check-circle"></i>
            <span>Thanh cong</span>
            <i class="fas fa-times"></i>
        </div>
    </div>
    <?php
        //importDB
        include('../config/connectDB.php');
        //redirect
        include('./pages/header.php');
        if(isset($_GET['management'])){
            include('./pages/content.php');
        }else{
            include('./pages/contents/home.php');
        }
        include('./pages/footer.php');

        // JS
    
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js?v='.time().'"></script>';
        echo '<script src="../assets/JS/base.js?v='.time().'"></script>';
        if(isset($_GET['management'])){
                echo'<script src="../assets/JS/admin/common.js?v='.time().'"></script>';
            if(isset($_GET['brand'])){
                // ../admin/management/brand
                echo'<script src="../assets/JS/admin/brandMn/brand.js?v='.time().'"></script>';
            }elseif (isset($_GET['category'])) {
                // ../admin/management/category
                echo'<script src="../assets/JS/admin/categoryMn/category.js?v='.time().'"></script>';
            }elseif (isset($_GET['product'])) {
                echo'<script src="../assets/JS/admin/productMn/main.js?v='.time().'"></script>';
                if(isset($_GET['create']) || isset($_GET['modify'])){
                    // ../admin/management/product/create(modify)
                    echo'<script src="../assets/JS/admin/productMn/create.js?v='.time().'"></script>';
                }
            }
        }
    ?>
</body>
</html>