<?php
if(isset($_FILES['excelFile']) && !empty($_FILES['excelFile']['tmp_name'])){
	var_dump($_FILES['excelFile']['tmp_name']);
}

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>xl file</title>
</head>
<body>
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="excelFile" />
		<input type="submit" name="submit" value="submit" />
	</form>
</body>
</html>