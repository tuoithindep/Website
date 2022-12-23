
<?php

    //paid_handle
    include('../../../../config/connectDB.php');
    if(isset($_GET['paid'])){
        $sql_paid_handle = 'UPDATE customer SET status=1 WHERE id="'.$_GET['id'].'"';
        mysqli_query($mysqli, $sql_paid_handle);
    }

    //unpaid_handle
    if(isset($_GET['unpaid'])){
        $sql_paid_handle = 'UPDATE customer SET status=0 WHERE id="'.$_GET['id'].'"';
        mysqli_query($mysqli, $sql_paid_handle);
    }
    
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
?>