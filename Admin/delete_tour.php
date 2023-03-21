<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    } else {
    }
if(!isset($_GET['id'])) exit();


$id = $_GET['id'];
include('config.php');

$query = "SELECT * FROM tours WHERE id = ?;";
$conect = $pdo->prepare($query);
$conect->execute([$id]);
$delete_img = $conect->fetch(PDO::FETCH_OBJ);


$imagen_path = 'assets/images/tours/' . $delete_img->img;
unlink($imagen_path);


$delete = $pdo->prepare("DELETE FROM tours WHERE id = ?;");
$result = $delete->execute([$id]);

if($result){
    $_SESSION['message'] = "El blog ha sido Eliminado con exito!";
    header('location: lista_tour.php');
    exit(0);
}else {
    $_SESSION['message'] = "Algo salió mal!";
    header('location: lista_tour.php');
    exit(0);
}