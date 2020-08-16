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
<link href="https://fonts.googleapis.com/css?family=Palanquin" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<head>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .center-fit {
          width:100%;/*To occupy image full width of the container and also fit inside the container*/
            max-width:100%/*To fit inside the container alone with natural size of the image ,Use either of these width or max-width based on your need*/
            height:auto;
            margin: auto;
            
        }
        .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
}
    </style>
</head>
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
<?php
  if(isset($_SESSION['felhasznalo'])){
	 ?>
	<li><a href="kezdolap.php">Főoldal</a></li>
	<li><a   href="kep.php">Kép feltöltése</a></li>
	<li><a href="statisztika.php">Statisztikák</a></li>
	<li><a id="current" class="active"href="fotopalyazat.php">Fotópályázat</a></li>
  <li><a href="orszag.php">Országok felvitele</a></li>
	<li><a href="fiok.php">Saját Fiók</a></li>
  <li>
  
  <form action="" method="POST">
  <input type="submit" name="kijelentkezes" value="kijelentkezes" onClick="window.location.href='index.php'"/>
  </form>

</li>
	
	<?php
  } else {
  ?>
	<li><a  href="index.php">Főoldal</a></li>
  <li><a href="statisztika.php">Statisztikák</a></li>
  <li><a class="active" id="current"href="fotopalyazat.php">Fotópályázat</a></li>
  <li><a href="about.html">Rólunk</a></li>
  <li><a href="reg.php">Regisztráció</a></li>
  
  <?php 
	} 
  ?>
  
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

  $conn = oci_connect('SYSTEM', '', $tns,'UTF8'); //System utan a jelszó kell
  
  
    $stid = oci_parse($conn, 'SELECT URL FROM KEPEK WHERE FOTOPALYAZAT_ID IS NOT NULL');

    oci_execute($stid);
    while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
      foreach ($row as $item) {
      $url=$item;
		echo'<form action="szavaz.php" method="post" enctype="multipart/form-data">';
		echo '<div class="memecontainer">';
		echo '<img class="center-fit" src="'.$item.'"/>';
		echo'<button class="button" type="submit" name="'.$item.'">Szavazás';
		echo '</button>';
		echo '</div>';
		echo "</form>";
      }
    }
	
	echo '<h1>Éppen ő vezet: </h1>';
	$s = oci_parse($conn, 'SELECT KEPEK.URL FROM FOTOPALYAZAT, KEPEK WHERE SZAVAZAT = (SELECT MAX(SZAVAZAT) FROM FOTOPALYAZAT) AND KEPEK.FOTOPALYAZAT_ID = FOTOPALYAZAT.FOTOPALYAZAT_ID');
	oci_execute($s);
     while ( $row = oci_fetch_array($s, OCI_ASSOC + OCI_RETURN_NULLS)) {
      foreach ($row as $item) {
      $url=$item;
		echo'<form action="szavaz.php" method="post" enctype="multipart/form-data">';
		echo '<div class="memecontainer">';
		echo '<img class="center-fit" src="'.$item.'"/>';
		echo '</div>';
		echo "</form>";
      }
    }
	
	
oci_close($conn);
?>
</form>
</body>
</html>