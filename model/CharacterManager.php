<?php
namespace OpenClassrooms\Mini_fight_game\Model;
use \OpenClassrooms\Mini_fight_game\Classes\Character as Character;
/*
 * Contains methods to process SQL requests relatives to Character's objects.
 * Inherits from Manager class.
 */
class CharacterManager extends \OpenClassrooms\Mini_fight_game\Model\Manager {
	/**
	 * Send a SQL request to insert a new Character's data into the database.
	 * 
	 * @param Character $charac The object to send to the database. 
	 * 
	 * @return void;
	 */
	public function add(Character $charac) {
		$db = $this->dbConnect();
		$request = $db->prepare('INSERT INTO game_characters (name, strenght, damages, level, experience) VALUES (:name, :strenght, :damages, :level, :experience)');
		$request->bindValue(':name', $charac->name(), \PDO::PARAM_STR);
		$request->bindValue(':strenght', $charac->strenght(), \PDO::PARAM_INT);
		$request->bindValue(':damages', $charac->damages(), \PDO::PARAM_INT);
		$request->bindValue(':level', $charac->level(), \PDO::PARAM_INT);
		$request->bindValue(':experience', $charac->experience(), \PDO::PARAM_INT);
		$request->execute();
		$request->closeCursor();
	}
	/**
	 * Send a SQL request to delete all data of a Character from the database.
	 * 
	 * @param Character $charac The object to delete.
	 * 
	 * @return void
	 */
	public function delete(Character $charac) {
		$db = $this->dbConnect();
		$request = $db->prepare('DELETE FROM game_characters WHERE id = :id');
		$request->bindValue(':id', $charac->id(), \PDO::PARAM_INT);
		$request->execute();
		$request->closeCursor();
	}
	/**
	 * Send a SQL request to get all data about a Character's object.
	 * 
	 * @param int $characterId Id of the character.
	 * 
	 * @return array $characterAttributes Contains all character's data.
	 */
	public function getAttributes($characterId) {
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT id, name, strenght, damages, level, experience FROM game_characters WHERE id = :character_id');
		$request->bindValue(':character_id', $characterId, \PDO::PARAM_INT);
		$request->execute();
		$data = $request->fetch();
		$request->closeCursor();

		return $data;
	}
	/**
	 * Send a SQL request to get all data about a Character's object.
	 * 
	 * @param int $characterId Id of the character.
	 *  
	 * @return object Character An objet filled with data got by the request.
	 */
	public function get($characterId) {
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT id, name, strenght, damages, level, experience FROM game_characters WHERE id = :character_id');
		$request->bindValue(':character_id', $characterId, \PDO::PARAM_INT);
		$request->execute();
		$data = $request->fetch();
		$request->closeCursor();

		return new Character($data);
	}
	/**
	 * Send a SQL request to get all data about all Character's objects.
	 * 
	 * @return array $characters Contains all Character's objects.
	 */
	public function getAll() {
		$db = $this->dbConnect();
		$request = $db->query('SELECT id, name, strenght, damages, level, experience FROM game_characters ORDER BY name');
		while ($data = $request->fetch()) {
			$characters[] = new Character($data);
		}
		$request->closeCursor();

		return $characters;
	}
	/**
	 * Send a SQL request to get all data about all Character's objects except one.
	 * @param string $name The Character to ommit.
	 * 
	 * @return array $characters Contains all Character's objects except the one specified.
	 */
	public function getAllExcept($name) {
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT id, name, strenght, damages, level, experience FROM game_characters WHERE name != :name ORDER BY name');
		$request->bindValue(':name', $name, \PDO::PARAM_STR);
		$request->execute();
		while ($data = $request->fetch()) {
			$characters[] = new Character($data);
		}
		$request->closeCursor();

		return $characters;
	}
	/**
	 * Update data of a Character's object
	 * 
	 * @param Character $charc The object to update. 
	 * 
	 * @return void
	 */
	public function update(Character $charac) {
		$db = $this->dbConnect();
		$request = $db->prepare('UPDATE game_characters SET strenght = :strenght, damages = :damages, level = :level, experience = :experience WHERE id = :id');
		$request->bindValue(':id', $charac->id(), \PDO::PARAM_INT);
		$request->bindValue(':strenght', $charac->strenght(), \PDO::PARAM_INT);
		$request->bindValue(':damages', $charac->damages(), \PDO::PARAM_INT);
		$request->bindValue(':level', $charac->level(), \PDO::PARAM_INT);
		$request->bindValue(':experience', $charac->experience(), \PDO::PARAM_INT);
		$request->execute();
		$request->closeCursor();
	}
	/**
	 * Count the character's number with a SQL request.
	 * 
	 * @return string $count number of characters.
	 */
	public function count() {
		$db = $this->dbConnect();
		$request = $db->query('SELECT COUNT(*) FROM game_characters');
		$count = (int) $request->fetchColumn();
		$request->closeCursor();

		return $count;
	}
	/**
	 * Send a SQL request to check if the character exists
	 * 
	 * @param int or string $info The id of the character or his name (case sensitive).
	 * 
	 * @return bool $exists TRUE if exists and FALSE if not. 
	 */
	public function exists($info) {
		$db = $this->dbConnect();
		if (is_int($info)) {
			$request = $db->prepare('SELECT COUNT(*) FROM game_characters WHERE id = :id');
			$request->bindValue(':id', $info, \PDO::PARAM_INT);
			$request->execute();
			$exists = (bool) $request->fetchColumn();

		} elseif (is_string($info)) {
			$request = $db->prepare('SELECT COUNT(*) FROM game_characters WHERE name = :name');
			$request->bindValue(':name', $info, \PDO::PARAM_STR);
			$request->execute();
			$exists = (bool) $request->fetchColumn();
		}
		return $exists;
	}
}