<?php 
use \OpenClassrooms\Mini_fight_game\Classes\Character as Character;
use \OpenClassrooms\Mini_fight_game\Model\CharacterManager as CharacterManager;
//AUTOLOADER
/**
 * Auto-loader for classes
 * 
 * @param  string $class The name of the class 
 * 
 * @return void
 */
function autoload($class) {
	$class = explode('\\', $class);
	$class = end($class);
	if (file_exists($class . '.php')) {
		require_once $class . '.php';
	} else
		if (file_exists('model/' . $class . '.php')) {
			require_once('model/' . $class . '.php');
		} elseif (file_exists('classes/' . $class . '.php')) {
			require_once('classes/' . $class . '.php');
		} else  {
			throw new Exception('Unable to find the class');
		}
}
spl_autoload_register('autoload');

/**
 * Insert a Character object into the database // ADD THE CONTROL
 *
 * @param Character $charac The object to insert to the database
 *
 * @return void
 */
function newCharacter(Character $charac) {
	$characterManager = new CharacterManager();
	$newCharacter = $characterManager->addCharacter($charac);
}
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
	$characterManager = new CharacterManager();
	$characterAttributes = $characterManager->getCharacterAttributes($characterId);
	$character = new Character($characterAttributes);
	require_once('view/frontend/displayCharacterAttribute.php');
}