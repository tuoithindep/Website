
<?php

    function handleLocation(){
        $location = '';
        if(isset($_GET['page'])){
            $location = "Location:../../../index.php?management&product&page=".$_GET['page'];
        }else{
            $location = "Location:../../../index.php?management&product";
        }
        return $location;
    }

    //! CREATE product
    if(isset($_GET['create']) || isset($_GET['modify'])){
        include('../../../../config/connectDB.php');
        $object = json_decode($_COOKIE["a"]) ;
        
        if($_FILES['imgProduct']['name']!=''){
            $thumbnail = time().'_'.$_FILES['imgProduct']['name'];
            $thumbnail_tmp = $_FILES['imgProduct']['tmp_name'];
        }
        
        $category = $object->category;
        $brand = $object->brand;
        $name = $mysqli -> real_escape_string($object->nameProduct);
        $price = $object->priceProduct;
        $short_desc = $mysqli -> real_escape_string($object->despProduct);
        $gift = $mysqli -> real_escape_string($object->giftProduct);
        $quantity = $object->quantityProduct;
        $titleNews = $mysqli -> real_escape_string($object->titleDsp);
        $contentNews = $mysqli -> real_escape_string($object->contentDsp);
        $titleConfig = $mysqli -> real_escape_string($object->titleConfig);
        $contentConfig = $mysqli -> real_escape_string($object->contentConfig);

        //get DATE_TIME
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $createdAt = date("d-m-Y H:i:s");
        $updatedAt = date("d-m-Y H:i:s");

        if(isset($_GET['create'])){
            $sql_create = 'INSERT INTO product(category_id,brand_id,thumbnail,name_prod,price,
            description_prod,gift,quantity,news_title,news_content,config_title,config_content,
            createdAt,updatedAt,status_prod) 
            VALUE ("'.$category.'","'.$brand.'","'.$thumbnail.'","'.$name.'","'.$price.'",
            "'.$short_desc.'","'.$gift.'","'.$quantity.'","'.$titleNews.'","'.$contentNews.'",
            "'.$titleConfig.'","'.$contentConfig.'","'.$createdAt.'","'.$updatedAt.'","1")';
            $ver = mysqli_query($mysqli, $sql_create);
            if(!$ver){
                echo mysqli_error($mysqli);
                die();
            }
            else{
                move_uploaded_file($thumbnail_tmp, '../../../../assets/imgs/admin/upload_img_product/'.$thumbnail);
                header(handleLocation());
            } 
        }
        if(isset($_GET['modify'])){
            if($_FILES['imgProduct']['name']!=''){

                $sql = 'SELECT thumbnail FROM product WHERE id ='.$_GET["id"];
                //delete file
                $query = mysqli_query($mysqli, $sql);
                while ($row = mysqli_fetch_array($query)) {
                    unlink('../../../../assets/imgs/admin/upload_img_product/'.$row['thumbnail']);
                }

                $sql_update = 'UPDATE product SET category_id="'.$category.'",
                brand_id="'.$brand.'" ,thumbnail="'.$thumbnail.'" ,name_prod="'.$name.'" ,
                price="'.$price.'" ,description_prod="'.$short_desc.'" ,gift="'.$gift.'" ,
                quantity="'.$quantity.'" ,news_title="'.$titleNews.'" ,news_content="'.$contentNews.'" ,
                config_title="'.$titleConfig.'" ,config_content="'.$contentConfig.'",updatedAt="'.$updatedAt.'"
                ,status_prod="1"
                WHERE id='.$_GET['id'];
                $ver = mysqli_query($mysqli, $sql_update);

                if(!$ver){
                    echo mysqli_error($mysqli);
                    die();
                }
                else{
                    move_uploaded_file($thumbnail_tmp, '../../../../assets/imgs/admin/upload_img_product/'.$thumbnail);
                    header(handleLocation());
                } 
    
            }else{
                $sql_update = 'UPDATE product SET category_id="'.$category.'",
                brand_id="'.$brand.'",name_prod="'.$name.'",status_prod="1",
                price="'.$price.'" ,description_prod="'.$short_desc.'" ,gift="'.$gift.'" ,
                quantity="'.$quantity.'" ,news_title="'.$titleNews.'" ,news_content="'.$contentNews.'" ,
                config_title="'.$titleConfig.'" ,config_content="'.$contentConfig.'",updatedAt="'.$updatedAt.'"    
                WHERE id='.$_GET['id'];

                mysqli_query($mysqli, $sql_update);
                header(handleLocation());
            }
        }
    }

    //! DELETE product

    if(isset($_GET['delete'])){ 
        //import DB
        include('../config/connectDB.php');

        $sql = 'SELECT thumbnail FROM product WHERE id ='.$_GET["id"];
        //delete file
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('../assets/imgs/admin/upload_img_product/'.$row['thumbnail']);
        }

        $sql_delete = 'DELETE FROM product WHERE id='.$_GET["id"];
        //delete in DB
        mysqli_query($mysqli, $sql_delete);
        //quay ve trang main
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
?>
