<?php

namespace OpenClassrooms\Mini_fight_game\Classes;

class Character {
	/*
	 * ATTRIBUTES OF THE CLASS
	 */
	private $_id;
	private $_name;
	private $_strenght;
	private $_damages;
	private $_level;
	private $_experience;

	/*
	 * CONSTRUCTOR
	 */

	public function __construct(array $attributes) {
		$this->hydrate($attributes);
	}
	/*
	 * HYDRATOR
	 */
	public function hydrate(array $attributes) {
		foreach ($attributes as $key => $value) {
			$method = 'set'.ucfirst($key);

			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}
	/*
	 * GETTERS OF THE CLASS
	 */

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

	/*
	 * SETTERS OF THE CLASS ATTRIBUTES
	 */

	/**
	 * Setter and controller of _id.
	 * 
	 * transtype the param to an int because of PDO execute() method
	 * that returns everything to a string
	 * 
	 * @param int $id Must be an integer strictly positive.
	 * @return void
	 */
	public function setId($id) {
		$id = (int) $id; 
		if ($id < 0) {
			trigger_error('The id must be strictly positive', E_USER_WARNING);
		}
		$this->_id = $id;
	}
	/**
	 * Setter and controller of _name.
	 * @param int $name Must be a string that lenght is lower than 30 characters. 
	 * @return void
	 */
	public function setName($name) {
		if (!is_string($name)) {
			trigger_error('The name must be a string', E_USER_WARNING);
		}
		if (strlen($name) > 30) {
			trigger_error('The name\'s lenght must be lower than 30 characters', E_USER_WARNING);
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
	 * @return void
	 */
	public function setStrenght($strenght) {
		$strenght = (int)$strenght; 
		if ($strenght < 0 || $strenght > 100) {
			trigger_error('The strenght must be included between 0 and 100', E_USER_WARNING);
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
	 * @return void
	 */
	public function setDamages($damages) {
		$damages = (int) $damages; 
		if ($damages < 0 || $damages > 100) {
			trigger_error('The damages must be included between 0 and 100', E_USER_WARNING);
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
	 * @return void
	 */
	public function setLevel($level) {
		$level = (int) $level; 
		if ($level < 0 || $level > 100) {
			trigger_error('The level must be included between 0 and 100', E_USER_WARNING);
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
	 * @return void
	 */
	public function setExperience($experience) {
		$experience = (int) $experience; 
		if ($experience < 0 || $experience > 100) {
			trigger_error('The experience must be included between 0 and 100', E_USER_WARNING);
		}
		$this->_experience = $experience;
	}
}