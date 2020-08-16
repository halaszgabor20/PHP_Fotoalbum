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
<link rel="stylesheet" href="style3.css">
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
	<li><a href="kezdolap.php">Főoldal</a></li>
	<li><a  id="current" class="active" href="kep.php">Kép feltöltése</a></li>
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

<div class="user">
    <header class="user__header">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />
        <h1 class="user__title">Válaszd ki a képet:</h1><br>
    </header>

<form action="kep.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
	<br/>
    <select name="category">
        <option selected disabled>Válassz kategóriát</option>
		<?php
		
		$conn = oci_connect('SYSTEM', '', $tns,'UTF8');
		
		$stid = oci_parse($conn, 'SELECT * FROM KATEGORIAK');
		
		oci_execute($stid);

		while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
			foreach ($row as $item) {
			echo '<option>' . $item . '</option>';
		}
	}
	oci_close($conn);
		
?>
      </select> <br/>

      <select name="location">
        <option selected disabled>Válaszd ki a várost</option>
		<?php
		
		$conn = oci_connect('SYSTEM', '', $tns,'UTF8');
		
		$stid = oci_parse($conn, 'SELECT VAROS FROM HELY');
		
		oci_execute($stid);

		while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
			foreach ($row as $item) {
			echo '<option>' . $item . '</option>';
		}
	}
	oci_close($conn);
?>
      </select> <br/>

      <select name="camera">  
        <option selected disabled>Válassz kamerát</option>
		<?php

		$conn = oci_connect('SYSTEM', '', $tns,'UTF8');
		
		$stid = oci_parse($conn, 'SELECT Kamerak_nev FROM Kamerak');
		
		oci_execute($stid);

		while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
			foreach ($row as $item) {
			echo '<option>' . $item . '</option>';
		}
	}
	oci_close($conn);
?>
      </select> <br/>
	  <input type="submit" name="submit" class ="btn">
</form>

<?php


$conn = oci_connect('SYSTEM', '', $tns,'UTF8');

if(isset($_POST['submit'])) {
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png');

	if(in_array($fileActualExt, $allowed)){
		if($fileError === 0){
			if($fileSize < 1000000){
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'img/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					$varcategory = $_POST['category'];
					$varlocation = $_POST['location'];
					$varcamera = $_POST['camera'];
					$varname = $_SESSION['felhasznalo'];
											
						$compiled = oci_parse($conn, 'INSERT INTO KEPEK(KEPEK_ID,URL,ERTEKELES,KATEGORIAK_KATEGORIANEV,HELY_ID,KAMERAK_NEV,FOTOPALYAZAT_ID,FELHASZNALO_FELHASZNALONEV)
						VALUES (KEPEK_AUTO_INCR.nextval, :filenev, null, :category, (SELECT HELY_ID FROM HELY WHERE VAROS = :varlocation ), :camera, null, :name)');
 
						oci_bind_by_name($compiled, ":filenev", $fileDestination);
						oci_bind_by_name($compiled, ":category", $varcategory);
						oci_bind_by_name($compiled,":varlocation",$varlocation);
						oci_bind_by_name($compiled, ":camera", $varcamera);
						oci_bind_by_name($compiled, ":name", $varname);

						oci_execute($compiled);
				echo "Sikeres feltöltés!";						
			}else{
				echo "Túl nagy a fájl!!";
			}
		} else{
			echo "valami probléma volt feltöltés közben!";
		}
	} else{
		echo "nem tudod feltölteni a típus miatt!";
	}
}
?>

</body>
</html>