<?php
ob_start(); 

echo 'Now playing with ' . htmlspecialchars($charac->name()) . '. Have a nice fight !' . "\r";
echo '<h3>Character\'s attributes</h3>';
echo (htmlspecialchars($charac->name()) . ' has ' . $charac->strenght() . ' of strenght, took ' . $charac->damages() . ' damages, is level ' . $charac->level() . ' and has ' . $charac->experience() . ' points of experience.<br />');

$content = ob_get_clean();
require('template.php'); 