<?php
ob_start(); 

echo '<div>You are facing :';

foreach ($charactersAttributes as $key => $value) {
	echo '<p><a href="?hit='. $value->id() . '">' . htmlspecialchars($value->name()) . '</a> (damages : ' . $value->damages() . ')</p>';
}
echo '</div>';

$content = ob_get_clean();
require('template.php');