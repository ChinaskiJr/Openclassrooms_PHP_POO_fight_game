<?php
ob_start(); 
?>
<p>
	Welcome into this marvellous fight game !
</p>
<p>
	Please chose or create your character.
</p>
<br />
<form action="" method="post">
    <div>
        Name : <input type="text" name="name" maxlength="30" />
        <input type="submit" value="Create this character" name="create" />
        <input type="submit" value="Use this character" name="use" /> 
    </div>
    <br />
    <br />
</form>
<?php
$content = ob_get_clean();
require('template.php'); 