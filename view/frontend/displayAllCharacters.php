<?php
ob_start(); 

echo '<div><strong>Fighters in the arena :</strong>';

foreach ($charactersAttributes as $key => $value) {
	echo '<p>' . htmlspecialchars($value->name()) . '</a> (level : ' . $value->level() . ' damages : ' . $value->damages() . ')</p>';
}
echo '</div>';

$content = ob_get_clean();
require('template.php');