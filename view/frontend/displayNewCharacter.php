<?php $title = 'Let\'s fight !';

ob_start(); 

echo $charac->name() . ' has been created ! May you live long !';

$content = ob_get_clean();
require_once('template.php'); 