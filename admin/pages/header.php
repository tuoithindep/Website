<?php
    if(isset($_GET['logout'])){
        unset($_SESSION['login']);
        header('Location:login.php');
    }
?>
<!-- admin_header -->
<header>
    <div class="header__container grid">
        <div class="header__wrap wide">
            <div class="header_name">
                <a href="home">Adminstrator</a>              
            </div>
            <div class="header__user">
                <i class="fas fa-user-circle"></i>
                <a href="#" class="header__userLink"><?php echo $_SESSION['login'] ?></a>             
                
                <!-- userMenu -->
                <ul class="header__userMenu">
                    <li class="header__userItem">
                        <a href="?management&category" class="userItem__Link">
                            Product category management
                        </a>
                    </li>
                    <li class="header__userItem">
                        <a href="?management&brand" class="userItem__Link">
                            Product brand management
                        </a>
                    </li>
                    <li class="header__userItem">
                        <a href="?management&product" class="userItem__Link">
                            Product management
                        </a>
                    </li>
                    <li class="header__userItem">
                        <a href="?management&payment" class="userItem__Link">
                            Payment management
                        </a>
                    </li>
                    <li class="header__userItem">
                        <a href="?logout" class="userItem__Link">
                            Log out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>