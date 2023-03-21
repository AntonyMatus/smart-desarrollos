<?php
session_start();
include('config.php');

if(isset($_POST['register-btn'])){

    $path = 'assets/images/tours/';
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $filename = uniqid() . '_' . $image_name;
    $storeImage = move_uploaded_file($image_tmp_name, $path . $filename);

    if($storeImage){
        $name = $_POST['name'];
        $status = intval($_POST['status']);
        $price_adult = floatval($_POST['price_adult']);
        $restriccion_adult = $_POST['rest_year_Adult'];
        $price_child = floatval($_POST['price_child']);
        $restriccion_child = $_POST['rest_year_child'];
        $category_id = intval($_POST['category_id']);
        $dollar_change = floatval($_POST['dollar_change']);
        $body = $_POST['body'];
        
        
        $tour_query = "INSERT INTO tours (category_id, name, body, price_adult, rest_year_adult, price_child, rest_year_child, dollar_change, status, cover) VALUE (:category_id, :name,  :body, :price_adult, :rest_year_adult, :price_child, :rest_year_child, :dollar_change, :status, :cover);";
        $tour_query_run = $pdo->prepare($tour_query);

        
        $tour_query_run->bindParam(':category_id', $category_id);
        $tour_query_run->bindParam(':name', $name);
        $tour_query_run->bindParam(':body', $body);
        $tour_query_run->bindParam(':price_adult', $price_adult);
        $tour_query_run->bindParam(':rest_year_adult', $restriccion_adult);
        $tour_query_run->bindParam(':price_child', $price_child);
        $tour_query_run->bindParam(':rest_year_child', $restriccion_child);
        $tour_query_run->bindParam(':dollar_change', $dollar_change);
        $tour_query_run->bindParam(':status', $status);
        $tour_query_run->bindParam(':cover', $filename);

        $blog_execute = $tour_query_run->execute();

        var_dump($blog_execute);

        if($blog_execute){
            $_SESSION['message'] = "Tour Agregado Correctamente!";
            header('location: lista_tour.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Algo salio mal!";
            header('location: lista_tour.php');
            exit(0);
        }
    }
    header('location: crear_tour.php');
    $_SESSION['message'] = "No se pudo guardar la imagen";
    exit(0);
}  else {
    header('location: crear_tour.php');
    exit(0);
}

?>