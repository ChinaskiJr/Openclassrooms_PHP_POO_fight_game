<?php
try {
	require_once('controller/controller.php');

	if (isset($_POST['create']) && isset($_POST['name'])) {
		controlNewCharacter();
	} else {
		require_once('view/frontend/displayHomepage.php');
	}
} catch (Exception $e) {
	die('<h3>Erreur</h3>'.$e->getMessage());
}