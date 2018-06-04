<?php
ob_start(); 

echo '<div>You are facing :';

foreach ($charactersAttributes as $key => $value) {
	echo '<p>' . htmlspecialchars($value->name()) . "</p>";

}
echo '</div>';

$content = ob_get_clean();
require('template.php'); 