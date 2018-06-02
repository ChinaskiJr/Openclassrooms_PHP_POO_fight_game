<?php $title = 'Let\'s fight !';

ob_start(); 

echo 'Welcome into this marvellous fight game !<br />Please chose or create your character<br /><br />';

$content = ob_get_clean();
require_once('template.php'); 