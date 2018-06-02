<?php 
use \OpenClassrooms\Mini_fight_game\Classes\Character as Character;
use \OpenClassrooms\Mini_fight_game\Model\CharacterManager as CharacterManager;
//AUTOLOADER
/**
 * Auto-loader for classes.
 *
 * Check in model/*.php and classes/*.php
 *
 * @param  string $class The name of the class.
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
			throw new Exception('The autoload : Unable to find the class <strong>' . $class . '</strong>');
		}
}
spl_autoload_register('autoload');

/**
 * Insert a Character object into the database.
 * 
 * Send a confirmation to the view.
 *
 * @param Character $charac The objet to insert
 *
 * @return void
 */
function newCharacter(Character $charac) {
	$characterManager = new CharacterManager();
	$characterManager->addCharacter($charac);
	require_once('view/frontend/displayNewCharacter.php');
}
/**
 * Erase a character from the database
 * 
 * Send a confirmation to the view.
 * 
 * @param Character $charac The object to delete

 * @return type
 */
function eraseCharacter(Character $charac) {
	$characterManager = new CharacterManager();
	$characterManager->deleteCharacter($charac);
	require_once('view/frontend/displayErasedCharacter.php');
}
/**
 * Send character's attributes to the view.
 * 
 * Control if the id is an integer and
 * if $character is an array.
 * 
 * From : Model getCharacterAttributesFromDb() 
 * to : View displayCharacterAttribute.php
 * 
 * @param int $characterId Id of the character.
 * 
 * @return void
 */
function sendCharacterAttributesToTheView($characterId) {
	if (!is_int($characterId)) {
		throw new Exception('The character doesn\'t exist');
	}
	$characterManager = new CharacterManager();
	$characterAttributes = $characterManager->getCharacterAttributes($characterId);
	$character = new Character($characterAttributes);
	if (!is_a($character, '\OpenClassrooms\Mini_fight_game\Classes\Character')) {
		throw new Exception('Issue with the database : getCharacterAttributes() method');
	}
	require_once('view/frontend/displayCharacterAttribute.php');
}
/**
 * Return a required object.
 * 
 * Control if input $characterIs is an Integer and
 * if output $characterObject is a Character object.
 *  
 * @param int $characterId Id of the character.
 * 
 * @return object Character required
 */
function getCharacterObject($characterId) {
	if (!is_int($characterId)) {
		throw new Exception('The character doesn\'t exist');
	}
	$characterManager = new CharacterManager();
	$characterObject = $characterManager->getCharacter($characterId);
	if (!is_a($characterObject, '\OpenClassrooms\Mini_fight_game\Classes\Character')) {
		throw new Exception('Issue with the database : getCharacter() method');
		}
	return $characterObject;
	}
/**
 * Return an array that contains objects of all characters.
 * 
 * Control if the output is an array and 
 * if it is full of Character objects.
 * 
 * @return array $characterAttributes An aray with all character's data.
 */
function getAllCharacters() {
	$characterManager = new CharacterManager();
	$charactersAttributes = $characterManager->getAllCharacters();
	if (!is_array($charactersAttributes)) {
		throw new Exception('Issue with the database : getAllCharacters() method. It returns no array');
	}
	foreach ($charactersAttributes as $key => $value) {
		if (!is_a($value, '\OpenClassrooms\Mini_fight_game\Classes\Character')) {
			throw new Exception('Issue with the database : getAllCharacters() method. Not all values of the array are Character objects.');
		} 
	}
	return $charactersAttributes;
}