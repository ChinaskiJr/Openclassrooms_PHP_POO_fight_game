<?php
ob_start(); 

echo htmlspecialchars($charac->name()) . ' has been created ! May you live long !';

$content = ob_get_clean();
require('template.php'); 