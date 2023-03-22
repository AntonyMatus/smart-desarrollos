<?php
	session_start();

	if (!isset($_SESSION['user_id'])) {
    	header('Location: /Admin/login.php');
  	}

  	try {
    	
		require 'config.php';

		$project_id = intval($_GET['id']);
		$nombre = $_POST['nombre'];
		$full_name = $_POST['full_name'];
		$categoria = $_POST['categoria'];
		$price = $_POST['price'];
		$year = $_POST['year'];
		$metros_cuadrados = $_POST['metros_cuadrados'];
		$ubicacion = $_POST['ubicacion'];
			
		$sql = "UPDATE projects SET `nombre` = :nombre, `full_name` = :full_name, `categoria` = :categoria, `price` = :price, `year` = :year, `metros_cuadrados` = :metros_cuadrados, `ubicacion` = :ubicacion  WHERE `id` = :id";

		$query = $pdo->prepare($sql);

		$query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
		$query->bindParam(':full_name', $full_name, PDO::PARAM_STR);
		$query->bindParam(':categoria', $categoria, PDO::PARAM_STR);
		$query->bindParam(':price', $price, PDO::PARAM_STR);
		$query->bindParam(':year', $year, PDO::PARAM_STR);
		$query->bindParam(':metros_cuadrados', $metros_cuadrados, PDO::PARAM_STR);
		$query->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
		$query->bindParam(':id', $project_id, PDO::PARAM_INT);

		$updatedProject = $query->execute();

		if ($updatedProject) {
			
			$images = array_filter($_FILES['images']['name']); 

			if (!empty($images)) {

				$path = 'assets/images/projects/';
				$name_array = $_FILES['images']['name'];
				$tmp_name_array = $_FILES['images']['tmp_name'];
				
				for ($i = 0; $i < count($tmp_name_array); $i++) {
					
					$filename = uniqid() . '_' . $name_array[$i];
					$storeImage = move_uploaded_file($tmp_name_array[$i], $path . $filename);

					$sqlImage = "INSERT INTO project_images (project_id, filename) VALUES (:project_id, :filename);";

					$queryImage = $pdo->prepare($sqlImage);

					$queryImage->bindParam(':project_id', $project_id, PDO::PARAM_INT);
					$queryImage->bindParam(':filename', $filename, PDO::PARAM_STR);

					$queryImage->execute();

				}
			}
		}

		header('Location: /Admin/editar_project.php?id=' . $project_id . '&ok=success');

 	} catch (Exception $e) {
  		header('Location: /Admin/editar_project.php?id=' . $project_id . '&ok=error');
 	}
