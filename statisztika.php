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
<head>
<style>
table{
	margin: auto;
}
h2{
	text-align: center;
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
	<li><a  id="current"  href="kep.php">Kép feltöltése</a></li>
	<li><a class="active" href="statisztika.php">Statisztikák</a></li>
	<li><a href="fotopalyazat.php">Fotópályázat</a></li>
  <li><a href="orszag.php">Országok felvitele</a></li>
	<li><a href="fiok.php">Saját Fiók</a></li>
  <li>
  
  <form action="" method="POST">
  <input type="submit" name="kijelentkezes" value="kijelentkezes" onClick="window.location.href='index.php'"/>
  </form>

</li>
<?php
	} else{
?>
	 <li><a class="active" id="current" href="index.php">Főoldal</a></li>
  <li><a href="statisztika.php">Statisztikák</a></li>
  <li><a href="fotopalyazat.php">Fotópályázat</a></li>
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

$conn = oci_connect('SYSTEM', '', $tns,'UTF8');

echo '<h2>Az adott kategóriában hány kép van: </h2>';
echo '<table border="1">';

$stid = oci_parse($conn, 'select kategoriak_kategorianev, count (*) from kepek group by kategoriak_kategorianev');

oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    foreach ($row as $item) {
        echo '<td>' . $item . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

echo '<h2>Legtöbb képpel rendelkező felhasználó: </h2>';
echo '<table border="1">';

$stid = oci_parse($conn, 'select FELHASZNALO_FELHASZNALONEV, count (*) from kepek group by FELHASZNALO_FELHASZNALONEV ORDER BY COUNT(KEPEK_ID)DESC fetch first row only');

oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    foreach ($row as $item) {
        echo '<td>' . $item . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

echo '<h2>A kategóriák legjobb képei: </h2>';
echo '<table border="1">';

$stid = oci_parse($conn, 'SELECT KATEGORIAK_KATEGORIANEV, URL FROM KEPEK a WHERE a.ertekeles = (SELECT MAX(b.ERTEKELES) FROM KEPEK b WHERE a.KATEGORIAK_KATEGORIANEV=B.KATEGORIAK_KATEGORIANEV)');

oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    foreach ($row as $item) {
        echo '<td>' . $item . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

echo '<h2>Településenként hány fénykép készült: </h2>';
echo '<table border="1">';

$stid = oci_parse($conn, 'select hely.varos, count (*)  from kepek,hely where kepek.hely_id = hely.hely_id group by hely.varos');

oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    foreach ($row as $item) {
        echo '<td>' . $item . '</td>';
    }
    echo '</tr>';
}
echo '</table>';


oci_close($conn);
?>

<?php
	
	if(isset($_SESSION['logout'])){
		session_destroy();
		echo "<a href = 'index.php'></a>";
	}
?>
</body>
</html>