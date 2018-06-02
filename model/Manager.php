<?php 

namespace OpenClassrooms\Mini_fight_game\Model;

class Manager {
	/**
	 * Connects to the database 'mini_fight_game' with a PDO object.
	 * 
	 * @return PDO_object $db The PDO object that SQL can interacts with.
	 */
	protected function dbConnect() {
		$db = new \PDO('mysql:host=localhost;dbname=mini_fight_game;charset=utf8', 'root', 'RsdGLXBn');
		return $db;
	}
}