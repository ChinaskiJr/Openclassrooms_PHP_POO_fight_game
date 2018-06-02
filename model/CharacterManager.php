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
	public function addCharacter(Character $charac) {
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
	public function deleteCharacter(Character $charac) {
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
	public function getCharacterAttributes($characterId) {
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
	public function getCharacter($characterId) {
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT id, name, strenght, damages, level, experience FROM game_characters WHERE id = :character_id');
		$request->bindValue(':character_id', $characterId, \PDO::PARAM_INT);
		$request->execute();
		$data = $request->fetch();
		$request->closeCursor();

		return new Character($data);
	}
	/**
	 * Send a SQL requet to get all data about all Character's objects.
	 * 
	 * @return array $characters Contains all Character's objects.
	 */
	public function getAllCharacters() {
		$db = $this->dbConnect();
		$request = $db->query('SELECT id, name, strenght, damages, level, experience FROM game_characters ORDER BY name');
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
	public function updateCharacter(Character $charac) {
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
}