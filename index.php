<?php
try {
	require_once('controller/controller.php');
	require_once('view/frontend/templateHeader.php');
	if (isset($_POST['create']) && isset($_POST['name'])) {
		controlNewCharacter();
	} else if (isset($_POST['name']) && isset($_POST['use'])) {
		controlGetCharacter($_POST['name']);
		getAllCharactersExcept($sessionCharac->name());
	} else if (isset($_GET['hit'])) {
		// GET YOURPERSO WITH SESSION
		controlHitCharacter($sessionCharac, (int) $_GET['hit']);
		controlGetCharacter($sessionCharac->id());
		getAllCharactersExcept($sessionCharac->name());
	} else { 
		require_once('view/frontend/displayHomepage.php');
	}
	require_once 'view/frontend/templateFooter.php';
} catch (Exception $e) {
	die('<h3>Erreur</h3>'.$e->getMessage());
}