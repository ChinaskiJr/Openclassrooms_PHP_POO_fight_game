<?php
try {
	require_once('controller/controller.php');
	require_once('view/frontend/displayHomepage.php');
} catch (Exception $e) {
	die('<h3>Erreur</h3>'.$e->getMessage());
}