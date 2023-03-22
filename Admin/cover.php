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

		$sqlImage = "SELECT * FROM project_images WHERE id = :id";
		$queryImage = $pdo->prepare($sqlImage);
		$queryImage->bindParam(':id', $image_id, PDO::PARAM_INT);
		$queryImage->execute();
		$image = $queryImage->fetch(PDO::FETCH_OBJ);

		$sqlProject = "UPDATE projects SET `cover` = :cover WHERE `id` = :id";
		$queryProject = $pdo->prepare($sqlProject);
		$queryProject->bindParam(':cover', $image->filename, PDO::PARAM_STR);
		$queryProject->bindParam(':id', $image->project_id, PDO::PARAM_INT);

		$updatedCover = $queryProject->execute();

		if ($updatedCover) {
			echo json_encode([
				'ok' => true
			]);
		}
		
  } catch (Exception $e) {
    echo json_encode([
			'ok' => false
		]);
  }