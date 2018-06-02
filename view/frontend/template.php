<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <!--<link href="public/css/styles.css" rel="stylesheet" /> -->
    </head>
        
    <body>
        <?= $content ?>
        <form action="" method="post">
        	<div>
        		Nom : <input type="text" name="name" maxlength="50" />
        		<input type="submit" value="Create this character" name="create" />
        		<input type="submit" value="Use this character" name="use" /> 
        	</div>
        </form>
    </body>
</html>