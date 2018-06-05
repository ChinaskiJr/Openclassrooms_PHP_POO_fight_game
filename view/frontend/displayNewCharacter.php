<?php
ob_start(); 

echo htmlspecialchars($charac->name()) . ' has been created ! May you live long !<br />';
echo 'Now, go to <a href="">fight</a> !';

$content = ob_get_clean();
require('template.php'); 