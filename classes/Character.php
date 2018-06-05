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
		return $ennemy->getHit($this->_strenght);
	}
	/**
	 * Give the hit, and check if it killed the ennemy or not.
	 * 
	 * @param int $strenghtHit The strenght of the objects that hit
	 * 
	 * @return const CHARACTER_KILLED if damages is equal or greather than 100
	 * @return const CHARACTERçHIT if damage is lower than 100.
	 */
	public function getHit($strenghtHit) {
		$this->_damages += (5 + $strenghtHit);
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
	/**
	 * Calculate new level and new XP.
	 * 
	 * @param int $levelKilled The level of the ennemy
	 * 
	 * @return int $xpGain The amount of XP's gain.
	 */
	public function gainXP($levelKilled) {
		for ($i = 1 ; $i <= 10 ; $i++) {
			if ($levelKilled == $i)
				$xpGain = 10 * (pow(2, $i - 1));
		}
		$experience = $this->_experience + $xpGain;
		if ($this->_level >= 10) {
			$this->_level = 10;
			$this->_experience = 0;
			return;
		}
		for ($i = 1 ; $i < 10 ; $i++) {
			if ($this->_level == $i) {
				if ($experience >= (100 * $i)) {
					$level = (int) floor($experience / (100 * $i));
					$experience = $experience - $level * (100 * $i);
				}
			}
		}
		if (isset($level)) {
			$this->setLevel($this->_level + $level);
			$this->setStrenght($this->_strenght + ($level * 2));
		}
		$this->setExperience($experience);
		return $xpGain;
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
	 * @param int $level Must be an integer included between 0 et 10.
	 * 
	 * @return void
	 */
	public function setLevel($level) {
		$level = (int) $level; 
		if ($level < 0) {
			throw new Exception('The level must be included between 0 and 10');
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
		if ($experience < 0) {
			throw new Exception('The experience must be included between 0 and 100');
		}
		$this->_experience = $experience;
	}
}
