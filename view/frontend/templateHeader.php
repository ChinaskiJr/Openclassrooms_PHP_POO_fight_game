<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Let's fight !</title>
        <!--<link href="public/css/styles.css" rel="stylesheet" /> -->
    </head>
        
    <body>
    	<?php
    	if (isset($_SESSION['charac'])) {
    		echo 'Playing with ' . htmlspecialchars($_SESSION['charac']->name()) . ' - <a href="?disconnect=1">Disconnect</a><hr />';
    	} 
    	// Display the header even if you just created the character 
    	elseif (isset($_POST['name']) && isset($_POST['use'])) {
    		echo 'Playing with ' . htmlspecialchars($_POST['name']) . ' - <a href="?disconnect=1">Disconnect</a><hr />';
    	}