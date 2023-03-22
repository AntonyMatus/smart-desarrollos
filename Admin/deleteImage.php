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

    $image_id = intval($_GET['id']);

		$sqlImage = "SELECT * FROM project_images where id = :id";
		$queryImage = $pdo->prepare($sqlImage);
		$queryImage->bindParam(':id', $image_id, PDO::PARAM_INT);
		$queryImage->execute();
		$image = $queryImage->fetch(PDO::FETCH_OBJ);

		$sqlDeleteImage = "DELETE FROM `project_images` WHERE `id` = :id";
		$queryDeleteImage = $pdo->prepare($sqlDeleteImage);
		$queryDeleteImage->bindParam(':id', $image->id, PDO::PARAM_INT);
		$deletedImage = $queryDeleteImage->execute();

		if ($deletedImage) {

			$image_path = 'assets/images/projects/' . $image->filename;
			unlink($image_path);

			echo json_encode([
				'ok' => true
			]);
		}
		
  } catch (Exception $e) {
    echo json_encode([
			'ok' => false
		]);
  }