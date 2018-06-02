<?php
try {
	require_once('controller/controller.php');
} catch (Exception $e) {
	die('<h3>Erreur</h3>'.$e->getMessage());
}