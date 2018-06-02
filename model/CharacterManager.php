<?php

namespace OpenClassrooms\Mini_fight_game\Model;

require_once('model/Manager.php');

class CharacterManager extends Manager {
	/**
	 * Send a SQL request to hydrate an Character object.
	 * 
	 * @param int $characterId Id of the character
	 * 
	 * @return array $characterAttributes Contains all character's data
	 */
	public function getCharacterAttributesFromDb($characterId) {
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT id, name, strenght, damages, level, experience FROM game_character WHERE id = :character_id');

		$request->execute(array(
			'character_id' => $characterId
		));

		$characterAttributes = $request->fetch();
		$request->closeCursor();

		return $characterAttributes;
	}
}