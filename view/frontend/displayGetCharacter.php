<?php $title = 'Let\'s fight !';

ob_start(); 

echo 'Now playing with ' . $charac->name() . '. Have a nice fight !';

$content = ob_get_clean();
require_once('template.php'); 