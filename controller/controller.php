<?php 
require_once('model/CharacterManager.php');
require_once('classes/Character.php');
/**
 * Send an array that contains a character's attributes
 * 
 * From Model getCharacterAttributesFromDb() 
 * to View displayCharacterAttribute.php
 * 
 * @param int $characterId Id of the character
 * 
 * @return void
 */
function sendCharacterAttributesToTheView($characterId) {
	$characterManager = new \Openclassrooms\Mini_fight_game\Model\CharacterManager();
	$characterAttributes = $characterManager->getCharacterAttributesFromDb($characterId);
	$character = new \Openclassrooms\Mini_fight_game\Classes\Character($characterAttributes);
	require_once('view/frontend/displayCharacterAttribute.php');
}