<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    } else {
    }
include('config.php');

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["name"]) || 
    !isset($_POST["status"]) ||
    !isset($_POST["body"]) || 
	!isset($_POST["price_adult"]) || 
	!isset($_POST["rest_year_Adult"]) || 
	!isset($_POST["price_child"]) || 
	!isset($_POST["rest_year_child"]) || 
	!isset($_POST["rest_year_child"]) 
	
) exit();


$id = $_POST['id'];
$name = $_POST['name'];
$status = intval($_POST['status']);
$price_adult = floatval($_POST['price_adult']);
$restriccion_adult = $_POST['rest_year_Adult'];
$price_child = floatval($_POST['price_child']);
$restriccion_child = $_POST['rest_year_child'];
$category_id = intval($_POST['category_id']);
$dollar_change = floatval($_POST['dollar_change']);
$body = $_POST['body'];

$sql = "UPDATE tours SET category_id = :category_id, name = :name, body = :body, price_adult = :price_adult, rest_year_adult = :rest_year_adult, price_child = :price_child, rest_year_child = :rest_year_child, dollar_change = :dollar_change, status = :status WHERE id = :id;";
$edit_blog = $pdo->prepare($sql);

$edit_blog->bindParam(':category_id', $category_id);
$edit_blog->bindParam(':name', $name);
$edit_blog->bindParam(':body', $body);
$edit_blog->bindParam(':price_adult', $price_adult);
$edit_blog->bindParam(':rest_year_adult', $restriccion_adult);
$edit_blog->bindParam(':price_child', $price_child);
$edit_blog->bindParam(':rest_year_child', $restriccion_child);
$edit_blog->bindParam(':dollar_change', $dollar_change);
$edit_blog->bindParam(':status', $status);
$edit_blog->bindParam(':id', $id);
$result = $edit_blog->execute();


if($result === TRUE) {

    $image = $_FILES['image']['name'];


    if(!empty($image)){


        $sql_proj = "SELECT * FROM tours WHERE id= :id";
        $sql_proj_run = $pdo->prepare($sql_proj);
        $sql_proj_run->bindParam(':id', $id, PDO::PARAM_INT);
        $sql_proj_run->execute();
        $result2 = $sql_proj_run->fetch(PDO::FETCH_OBJ);

        

        $path = 'assets/images/tours/';
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];

        $filename = uniqid() . '_' . $image_name;
        $storeImage = move_uploaded_file($image_tmp_name, $path . $filename);

        $sqlimg = "UPDATE tours SET `cover` = :cover WHERE `id` = :id";
        $queryimg = $pdo->prepare($sqlimg);
        $queryimg->bindParam(':id', $id, PDO::PARAM_INT);
        $queryimg->bindParam(':cover', $filename, PDO::PARAM_STR);

        $imgUpdate = $queryimg->execute();
        
        if($imgUpdate){
            $image_path = $path . $result2->img;
            unlink($image_path);
        }

    }

    $_SESSION['message'] = "Los cambios han sido actualizados con Exito!";
    header("location: lista_tour.php");
    exit(0);
} else {
    $_SESSION['message'] = "Los cambios No han sido actualizados con exito!";
    header("location:lista_tour.php");
    exit(0);
}



?>