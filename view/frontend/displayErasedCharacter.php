<?php $title = 'Let\'s fight !';

ob_start(); 

echo $charac->name() . ' has been deleted ! Rest in peace...';

$content = ob_get_clean();
require_once('template.php');