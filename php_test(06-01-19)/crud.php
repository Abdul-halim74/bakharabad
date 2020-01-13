<?php
$host = "localhost";
$user = "root";
$password = "";
$datbase = "check";
$con=mysql_connect($host,$user,$password);
$db=mysql_select_db($datbase,$con);


?>

<?php
	if(isset($_POST['submit'])){
		// echo "<pre>";
		// print_r($_POST['submit']);
		$name=$_POST['name'];
		$roll=$_POST['roll'];
		$reg=$_POST['reg'];

		$sql ="INSERT INTO student (name,roll,reg) VALUES('$name','$roll','$reg') ";
		echo mysql_error();
		if (!mysql_query($sql,$con))
		  {
		  die('Error: ' . mysql_error());
		  }
		  else{
		  	echo "data INSERT successfull ";
		  }
 	}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CRUD Operations With PHP and MySql - By Cleartuts</title>
<link rel="stylesheet" href="" type="text/css" />
</head>
<body>
<center>
<div id="body">
 <div id="content">
    <form method="post">
    <table align="center">
    
    <tr>
    <td><input type="text" name="name" placeholder=" Name"  /></td>
    </tr>

    <tr>
    <td><input type="text" name="roll" placeholder="Roll"  /></td>
    </tr>

    <tr>
    <td><input type="text" name="reg" placeholder="Reg" /></td>
    </tr>

    <tr>
    <td><input type="submit" name="submit" value="submit"></td>
    </tr>

    </table>
    </form>
    </div>
</div>

</center>
</body>