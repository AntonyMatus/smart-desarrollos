<?php
define('USER', 'root');
define('PASSWORD', '');
define('HOST', '127.0.0.1');
define('DATABASE', 'solin_tour');
 

$link = 'mysql:host=127.0.0.1; dbname=smart_desarrollos; charset=utf8';
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'solin_tour';

try {
    $pdo = new PDO($link, $username, $password);
    // $connection = mysqli_connect("$host","$username","$password","$database");
   
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>