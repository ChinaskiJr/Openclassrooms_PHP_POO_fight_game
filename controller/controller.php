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

session_start();
if (isset($_SESSION['charac'])) {
	$sessionCharac = $_SESSION['charac'];
}

/**
 * Control new Character and send it to the model.
 * 
 * Check if the name isn't empty and if it doesn't alreay exist.
 * 
 * @return void
 */
function controlNewCharacter () { 
	$charac = new Character ([
		'name' => $_POST['name'],
	]);
	if (!$charac->validName()) {
		unset($charac);
		throw new Exception('Not a valid name');
	} else if (isCharacterExist($charac->name())) {
		unset($charac);
		throw new Exception('Name already taken');
	} else {
		newCharacter($charac);
	}
}
/**
 * Control the chosen character and stock in a variable's session.
 * 
 * @param int or string $info Id or name of the caracter you get.
 *
 * @return void
 */
function controlGetCharacter($info) {
	if (!isCharacterExist($info)) {
		throw new Exception ('The character doesn\'t exist');
	} else {
		$character = getCharacterObject($info);
		$_SESSION['charac'] = $character;
	}
}
/**
 * Control the value of the parameters and send the result to the view
 * 
 * @param Character $yourCharac An objet Character represents the hitter
 * 
 * @param int or string $înfoEnnemy The id or the name of the hit character
 * 
 * @return void
 */
function controlHitCharacter($yourCharac, $infoEnnemy) {
	if (!isCharacterExist($infoEnnemy)) {
		throw new Exception ('The character you want to hit doesn\'t exist');
	} else {
		$characterManager = new CharacterManager();
		$characEnnemy = $characterManager->get($infoEnnemy);
		$resultOfFight = $yourCharac->hit($characEnnemy);
		switch($resultOfFight) {
			case Character::MYSELF :
				echo 'Why would you want to hit yourself ?';
				break;
			case Character::CHARACTER_HIT :
				echo '<i>You hit ' . htmlspecialchars($characEnnemy->name()) . ' and you hit him hard.</i> <br /><hr />';
				$characterManager->update($characEnnemy);
				break;
			case Character::CHARACTER_KILLED :
				$gainXp = $yourCharac->gainXP($characEnnemy->level());
				$characterManager->update($yourCharac);
				echo '<i>You killed ' . htmlspecialchars($characEnnemy->name()) . ' and he was crying. You win ' . $gainXp . ' xp !</i><br /><hr />';
				$characterManager->delete($characEnnemy);

				break;
		}
	}
}
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
	$characterManager->add($charac);
	$_SESSION['charac'] = $characterManager->get($charac->name());
	require_once('view/frontend/displayNewCharacter.php');
}
/**
 * Return a required object and send his attributes to the view.
 * 
 * Control if input $characterIs is an Integer and
 * if output $characterObject is a Character object.
 *  
 * @param int $characterId Id of the character.
 * 
 * @return object Character required
 */
function getCharacterObject($info) {
	if (!is_int($info) && !is_string($info)) {
		throw new Exception('function getCharacterObjet wait for an integer or a string as a parameter');
	}
	$characterManager = new CharacterManager();
	$charac = $characterManager->get($info);
	if (!is_a($charac, 'OpenClassrooms\Mini_fight_game\Classes\Character')) {
		throw new Exception('Issue with the database : getCharacter() method');
		}
	require_once('view/frontend/displayGetCharacter.php');
	return $charac;
	}
/**
 * Return an array that contains objects of all characters.
 * 
 * Control if the output is an array and 
 * if it is full of Character objects.
 * 
 * @return array $characterAttributes An aray of objects with all character's data.
 */
function getAllCharacters() {
	$characterManager = new CharacterManager();
	$charactersAttributes = $characterManager->getAll();
	if (!is_array($charactersAttributes)) {
		throw new Exception('Issue with the database : getAllCharacters() method. It returns no array');
	}
	foreach ($charactersAttributes as $key => $value) {
		if (!is_a($value, '\OpenClassrooms\Mini_fight_game\Classes\Character')) {
			throw new Exception('Issue with the database : getAllCharacters() method. Not all values of the array are Character objects.');
		} 
	}
	require_once('view/frontend/displayAllCharacters.php');
}
/**
 * Return an array that contains objects of all characters except one.
 * 
 * Control if the output is an array and 
 * if it is full of Character objects.
 * 
 * @param string $name The Character to ommit.
 * 
 * @return array $characterAttributes An aray of objects with all character's data.
 */
function getAllCharactersExcept($name) {
	$characterManager = new CharacterManager();
	if (!is_string($name)) {
		throw new Exception('getAllCharactersExcept : $name must be a string');
	}
	$charactersAttributes = $characterManager->getAllExcept($name);
	if (!is_array($charactersAttributes)) {
		throw new Exception('Issue with the database : getAllCharacters() method. It returns no array');
	}
	foreach ($charactersAttributes as $key => $value) {
		if (!is_a($value, '\OpenClassrooms\Mini_fight_game\Classes\Character')) {
			throw new Exception('Issue with the database : getAllCharacters() method. Not all values of the array are Character objects.');
		} 
	}
	require_once 'view/frontend/displayEnnemies.php';	
}
/**
 * Transtype $numberOfCharacters into an integer
 * 
 * @return int type
 */
function countCharacters() {
	$characterManager = new CharacterManager();
	$numberOfCharacters = $characterManager->count();
	if(!is_int($numberOfCharacters)) {
		throw new Exception('count() method from Character did not return an interger');
	}
	return $numberOfCharacters;
}
/**
 * Control that the param is a string or an integer
 * 
 * @param int or string $info The id of the character or his name (case sensitive).
 *
 * @return bool $exists TRUE if exists and FALSE if not. 
 */
function isCharacterExist($info) {
	$characterManager = new CharacterManager();
	if (!is_int($info) && !is_string($info)) {
		throw new Exception('function isCharacterExist() : $info must be a string or an integer');
	}
	$characterExist = $characterManager->exists($info);

	return $characterExist;
}