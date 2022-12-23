<?php
    session_start();
    include('../config/connectDB.php');

    if(isset($_POST['login'])){
        $username = $_POST['user_name'];
        $password = md5($_POST['password']);
        $sql = 'SELECT * FROM admin WHERE username = "'.$username.'" AND password = "'.$password.'"';
        $query = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($query);

        if($count == 1){
            $_SESSION['login'] = $username;
            header("Location:index.php");
        }else{
            echo 
            "<script>
                var checkSuccess = false;
                var errMess = 'Username or password uncorrect';
            </script>";
        }
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
    <link rel="stylesheet" href="../assets/css/common/base.css">
    <link rel="stylesheet" href="../assets/css/admin/admin_login.css?v=<?php echo time() ?>">

    <title>ADMINSTRATOR_LOGIN</title>
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
    <!-- admin_login -->
    <form action="" method="POST" id="form_admin" >
        <div class="form_groupWrap">
            <div class="form_group">
                <input id="user_name" class="form_control" name="user_name" type="text" placeholder="UserName">
                <span class="form_message"></span>
            </div>
            <div class="form_group">
                <input autocomplete="new-password" id="password" class="form_control" name="password" type="password" placeholder="PassWord">
                <span class="form_message"></span>
            </div>
            <button class="btn_submit" type="submit" name="login">ĐĂNG NHẬP</button>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/JS/admin/login/login_admin.js?v=<?php echo time() ?>"></script>
</body>
</html>