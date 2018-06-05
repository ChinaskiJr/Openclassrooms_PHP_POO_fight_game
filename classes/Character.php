<?php
namespace OpenClassrooms\Mini_fight_game\Classes;
/**
 * Contains attributes and methods about the characters
 */
class Character {
	
	//ATTRIBUTES
	private $_id;
	private $_name;
	private $_strenght = 0;
	private $_damages = 0;
	private $_level = 1;
	private $_experience = 0;

	//CONSTANTS
	const MYSELF = 1;
	const CHARACTER_KILLED = 2;
	const CHARACTER_HIT = 3;

	// CONSTRUCTOR
	public function __construct(array $attributes) {
		$this->hydrate($attributes);
	}
	// HYDRATOR
	public function hydrate(array $attributes) {
		foreach ($attributes as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	// METHODS

	/**
	 * Deal the hit.
	 * 
	 * Check if the character doesn't it himself.
	 * Check if the ennemy is injured or killed.
	 * 
	 * @param Character $ennemy The ennemy to kill. 
	 * 
	 * @return const MYSELF If the carachter hit himself
	 * @return method getHit() in the other case.
	 */
	public function hit(Character $ennemy) {
		if ($ennemy->id() == $this->id()) {
			return self::MYSELF;
		}
		return $ennemy->getHit();
	}
	/**
	 * Give the hit, and check if it killed the ennemy or not.
	 * 
	 * @return const CHARACTER_KILLED if damages is equal or greather than 100
	 * @return const CHARACTERçHIT if damage is lower than 100.
	 */
	public function getHit() {
		$this->_damages += 5;
		if ($this->_damages >= 100) {
			return self::CHARACTER_KILLED;
		} else 
			return self::CHARACTER_HIT;
	}
	/**
	 * Check if the name isn't empty or too long
	 * 
	 * @return bool false if it is not valid, true if it is.
	 */
	public function validName() {
		if (empty($this->_name)) {
			return false;
		} elseif (strlen($this->_name > 30)) {
			return false;
		} else {
			return true;
		}
	}
	// GETTERS
	/**
	 * Getter of the _id attribute.
	 * @return int $_id object's value.
	 */
	public function id() {
		return $this->_id;
	}
	/**
	 * Getter of the _name attribute.
	 * @return string $_name object's value.
	 */
	public function name() {
		return $this->_name;
	}
	/**
	 * Getter of the _strenght attribute.
	 * @return int $_strenght object's value.
	 */
	public function strenght() {
		return $this->_strenght;
	}
	/**
	 * Getter of the _damages attribute.
	 * @return int $_damages object's value.
	 */
	public function damages() {
		return $this->_damages;
	}
		/**
	 * Getter of the _level attribute.
	 * @return int $_level object's value.
	 */
	public function level() {
		return $this->_level;
	}
	/**
	 * Getter of the _level attribute.
	 * @return int $_experience object's value.
	 */
	public function experience() {
		return $this->_experience;
	}

	// SETTERS
	/**
	 * Setter and controller of _id.
	 * 
	 * transtype the param to an int because of PDO execute() method
	 * that returns everything to a string
	 * 
	 * @param int $id Must be an integer strictly positive.
	 * 
	 * @return void
	 */
	public function setId($id) {
		$id = (int) $id; 
		if ($id <= 0) {
			throw new Exception('The id must be strictly positive');
		}
		$this->_id = $id;
	}
	/**
	 * Setter and controller of _name.
	 * @param int $name Must be a string that lenght is lower than 30 characters. 
	 * 
	 * @return void
	 */
	public function setName($name) {
		if (!is_string($name)) {
			throw new Exception('The name must be a string');
		}
		if (strlen($name) > 30) {
			throw new Exception('The name\'s lenght must be lower than 30 characters');
		}
		$this->_name = $name;
	}
	/**
	 * Setter and controller of _strenght.
	 * 
	 * transtype the param to an int because of PDO execute() method
	 * that returns everything to a string
	 * 
	 * @param int $name Must be an integer included between 0 et 100.
	 * 
	 * @return void
	 */
	public function setStrenght($strenght) {
		$strenght = (int)$strenght; 
		if ($strenght < 0 || $strenght > 100) {
			throw new Exception('The strenght must be included between 0 and 100');
		}
		$this->_strenght = $strenght;
	}
	/**
	 * Setter and controller of _damages
	 * 
	 * transtype the param to an int because of PDO execute() method
	 * that returns everything to a string
	 * 
	 * @param int $damages Must be an integer included between 0 et 100.
	 * 
	 * @return void
	 */
	public function setDamages($damages) {
		$damages = (int) $damages; 
		if ($damages < 0 || $damages > 100) {
			throw new Exception('The damages must be included between 0 and 100');
		}
		$this->_damages = $damages;
	}
	/**
	 * Setter and controller of _level
	 * 
	 * transtype the param to an int because of PDO execute() method
	 * that returns everything to a string
	 * 
	 * @param int $level Must be an integer included between 0 et 100.
	 * 
	 * @return void
	 */
	public function setLevel($level) {
		$level = (int) $level; 
		if ($level < 0 || $level > 100) {
			throw new Exception('The level must be included between 0 and 100');
		}
		$this->_level = $level;
	}
	/**
	 * Setter and controller of _experience
	 * 
	 * transtype the param to an int because of PDO execute() method
	 * that returns everything to a string
	 * 
	 * @param int $experience Must be an integer included between 0 et 100.
	 * 
	 * @return void
	 */
	public function setExperience($experience) {
		$experience = (int) $experience; 
		if ($experience < 0 || $experience > 100) {
			throw new Exception('The experience must be included between 0 and 100');
		}
		$this->_experience = $experience;
	}
}