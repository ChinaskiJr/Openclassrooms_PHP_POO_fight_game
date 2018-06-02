<?php
require_once('controller/controller.php');
try {
	sendCharacterAttributesToTheView(2);
} catch (Exception $e) {
	die('Erreur : '.$e->getMessage());
}