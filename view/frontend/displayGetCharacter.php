<?php
ob_start(); 

echo 'Playing with ' . htmlspecialchars($charac->name()) . ' - <a href="?disconnect=1">Disconnect</a><hr />';
echo '<h3>Character\'s attributes</h3>';
echo (htmlspecialchars($charac->name()) . ' has ' . $charac->strenght() . ' of strenght, took ' . $charac->damages() . ' damages, is level ' . $charac->level() . ' and has ' . $charac->experience() . ' points of experience.<br /><hr />');

$content = ob_get_clean();
require('template.php'); 