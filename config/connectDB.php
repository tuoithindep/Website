<?php

    //DEV connection
    $mysqli = new mysqli("localhost","root","","KMA_TECH");

    //DEPLOY connection
    // $mysqli = new mysqli("remotemysql.com","nnPEsp8j24","cshMa2enha","nnPEsp8j24");

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }
?>