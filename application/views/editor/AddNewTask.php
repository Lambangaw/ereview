<!DOCTYPE html>
<html>
<head>
   <title>adding new task</title>
</head>
 
<body>

<p> 
	<?php echo $msg; ?>
</p>
<form action="addingNewTask" method="post">
	judul : <input type="text" name="judul" id="judul"><br/>
	kata kunci : <input type="text" name="keywords" id="keywords"></br/>
	<br/>
	<input type="submit" value="submit">
</form>
</body>
</html>