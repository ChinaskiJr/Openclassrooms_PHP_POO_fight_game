<?php 
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
			trigger_error('Unable to find the class', E_USER_WARNING);
		}
}
spl_autoload_register('autoload');

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
	$characterAttributes = $characterManager->getCharacterAttributes($characterId);
	$character = new \Openclassrooms\Mini_fight_game\Classes\Character($characterAttributes);
	require_once('view/frontend/displayCharacterAttribute.php');
}

