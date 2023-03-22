<?php

  session_start();

	header('Content-Type: application/json');

	if (!isset($_SESSION['user_id'])) {
    echo json_encode([
    	'ok' => false,
    	'message' => "Acción no autorizada"
    ]);

    return false;
  }

  try {

    require 'config.php';

    $project_id = intval($_GET['id']);

 	  $sqlImages = "SELECT * FROM project_images where project_id = :project_id"; 
	  $queryImages = $pdo->prepare($sqlImages); 
	  $queryImages->bindParam(':project_id', $project_id, PDO::PARAM_INT);
	  $queryImages->execute();
	  $images = $queryImages->fetchAll(PDO::FETCH_OBJ);

		foreach ($images as $image) {

			$sqlDeleteImage = "DELETE FROM `project_images` WHERE `id` = :id";
			$queryDeleteImage = $pdo->prepare($sqlDeleteImage);
			$queryDeleteImage->bindParam(':id', $image->id, PDO::PARAM_INT);
			$deletedImage = $queryDeleteImage->execute();

			if ($deletedImage) {

				$image_path = 'assets/images/projects/' . $image->filename;
				unlink($image_path);

			}

		}

		$sqlProject = "DELETE FROM `projects` WHERE `id` = :id";
		$queryProject = $pdo->prepare($sqlProject);
		$queryProject->bindParam(':id', $project_id, PDO::PARAM_INT);
		$deletedProject = $queryProject->execute();

		if ($deletedProject) {
			header('Location: lista_projects.php');
            exit(0);
		}

  } catch (Exception $e) {
  	echo json_encode([
    	'ok' => false,
    	'message' => "Ocurrio un error."
    ]);
  }