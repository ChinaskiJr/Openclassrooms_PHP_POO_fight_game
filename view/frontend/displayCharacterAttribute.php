<?php $title = 'Let\'s fight !';

ob_start(); 

echo '<h3>Character\'s attributes</h3>';

echo ($character->name() . ' has ' . $character->strenght() . ' of strenght, took ' . $character->damages() . ' damages, is level ' . $character->level() . ' and has ' . $character->experience() . ' points of experience.');


$content = ob_get_clean();
require_once('template.php'); 
?>