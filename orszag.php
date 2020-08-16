<?php
session_start();
if(isset($_POST['kijelentkezes'])){
    session_destroy();
    echo "<script> location.href = 'index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<title>Fotózunk</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<body style="background-color: darkgray;">

<!-- Header -->
<header class="w3-display-container w3-content w3-center" style="max-width:3000px">
  <img class="w3-image" src="header.jpg" alt="Me" width=100% height=auto>
  <div class="w3-display-middle w3-padding-large w3-border w3-wide w3-text-light-grey w3-center">
    <h1 class="w3-hide-medium w3-hide-small w3-xxxlarge">Fotoalbum</h1>
    <h5 class="w3-hide-large" style="white-space:nowrap">Fotoalbum</h5>
    <h3 class="w3-hide-medium w3-hide-small">Neked</h3>
  </div>
  
  
</header>
<ul>
  <li><a class="active" id="current" href="kezdolap.php">Főoldal</a></li>
  <li><a href="kep.php">Kép feltöltése</a></li>
  <li><a href="statisztika.php">Statisztikák</a></li>
  <li><a href="fotopalyazat.php">Fotópályázat</a></li>
  <li><a href="orszag.php">Országok felvitele</a></li>
  <li><a href="fiok.php">Saját Fiók</a></li>
  <li>
  
    <form action="" method="POST">
    <input type="submit" name="kijelentkezes" value="kijelentkezes" onClick="window.location.href='index.php'"/>
    </form>
  
  </li>
</ul>


<?php
	$tns = "
			(DESCRIPTION =
			(ADDRESS_LIST =
			(ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
		)
			(CONNECT_DATA =
			(SID = xe)
		)
  )";
 
?>

<form action="orszag.php" method="post" enctype="multipart/form-data">
	<h4>Add meg az országot</h4>
    <input type="text" name="text1">
	<br>
	<h4>Add meg a megyét</h4>
    <input type="text" name="text2">
	<br>
	<h4>Add meg a várost</h4>
    <input type="text" name="text3">
	<br>
	<input type="submit" name="gomb" class ="btn">
	</form>

<?php
$conn = oci_connect('SYSTEM', '', $tns,'UTF8');

	if(isset($_POST['gomb'])) {
		$text1 = $_POST['text1'];
		$text2 = $_POST['text2'];
		$text3 = $_POST['text3'];
		
		$compiled = oci_parse($conn, 'INSERT INTO Hely(HELY_ID, ORSZAG, MEGYE, VAROS)
						VALUES (C_AUTO_INCR.nextval, :text1, :text2, :text3)');
						
		oci_bind_by_name($compiled, ":text1", $text1);
		oci_bind_by_name($compiled, ":text2", $text2);
		oci_bind_by_name($compiled,":text3",$text3);
		
		oci_execute($compiled);
		echo "Sikeres feltöltés!";	
}
?>

</body>
</html>