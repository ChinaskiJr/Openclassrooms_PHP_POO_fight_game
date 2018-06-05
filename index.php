<?php
try {
	require_once('controller/controller.php');
	require_once('view/frontend/templateHeader.php');
	if (isset($_POST['create']) && isset($_POST['name'])) {
		controlNewCharacter();
	} else if (isset($_POST['name']) && isset($_POST['use'])) {
		controlGetCharacter($_POST['name']);
		getAllCharactersExcept($_POST['name']);
	} else if (!isset($_GET['hit']) && isset($sessionCharac)) {
		controlGetCharacter($sessionCharac->id());
		getAllCharactersExcept($sessionCharac->name());
	} else if (isset($_GET['hit']) && !isset($sessionCharac)) {
		header('Location: .');
	} else if (isset($_GET['hit'])) {
		controlGetCharacter($sessionCharac->id());
		controlHitCharacter($sessionCharac, (int) $_GET['hit']);
		getAllCharactersExcept($sessionCharac->name());
	} else if (isset($_GET['disconnect'])) {
		session_destroy();
		header('Location: .');
		exit();
	} else { 
		require_once('view/frontend/displayHomepage.php');
		getAllCharacters();
	}
	require_once 'view/frontend/templateFooter.php';
} catch (Exception $e) {
	die('<h3>Erreur</h3>'.$e->getMessage());
}