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
<link rel="stylesheet" href="css/style1.css">
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
				.div2 {
 					border: 1px solid black;
  				padding: 10px;
  				width: auto;
  				height: auto;
  				text-align: justify;
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
<li><a id="current" href="kezdolap.php">Főoldal</a></li>
  <li><a href="kep.php">Kép feltöltése</a></li>
  <li><a href="statisztika.php">Statisztikák</a></li>
  <li><a href="fotopalyazat.php">Fotópályázat</a></li>
	<li><a href="orszag.php">Országok felvitele</a></li>
  <li><a href="about.html">Rólunk</a></li>
  <li><a class="active" href="fiok.php">Saját Fiók</a></li>
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

	$conn = oci_connect('SYSTEM', '', $tns,'UTF8');
	
	$name = $_SESSION['felhasznalo'];
    echo '<header class="user__header">';
	echo '<br>';
	echo '<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />';
    echo '   <h1 class="user__title1">Saját fiók</h1>';
	echo '<br>';
    echo '</header>';
	
	$s = oci_parse($conn, 'SELECT FELHASZNALOK_NEV FROM FELHASZNALOK WHERE FELHASZNALOK_NEV = :name');
	oci_bind_by_name($s, ":name", $name);
	oci_execute($s);
	while ( $row = oci_fetch_array($s, OCI_ASSOC + OCI_RETURN_NULLS)) {
      foreach ($row as $item) {
		  echo '<header class="user__header">';
		  echo '<h1 class="user__title">Felhasználónév: '.$item.'</h1>';
		  echo "<br>";
		  echo '</header>';
	  }
	}
	
	$s = oci_parse($conn, 'SELECT EMAIL FROM FELHASZNALOK WHERE FELHASZNALOK_NEV = :name');
	oci_bind_by_name($s, ":name", $name);
	oci_execute($s);
	while ( $row = oci_fetch_array($s, OCI_ASSOC + OCI_RETURN_NULLS)) {
      foreach ($row as $item) {
		echo '<header class="user__header">';
		echo '<h1 class="user__title">Email cím: '.$item.'</h1>';
		echo "<br>";
		echo '</header>';
	  }
	}
	
	$s = oci_parse($conn, 'SELECT LAKCIM FROM FELHASZNALOK WHERE FELHASZNALOK_NEV = :name');
	oci_bind_by_name($s, ":name", $name);
	oci_execute($s);
	while ( $row = oci_fetch_array($s, OCI_ASSOC + OCI_RETURN_NULLS)) {
      foreach ($row as $item) {
		echo '<header class="user__header">';
		echo '<h1 class="user__title">Lakcím: '.$item.'</h1>';
		echo "<br>";
		echo '</header>';
	  }
	}
	
    $stid = oci_parse($conn, 'SELECT URL FROM KEPEK WHERE FELHASZNALO_FELHASZNALONEV =  :name');
    oci_bind_by_name($stid, ":name", $name);
    oci_execute($stid);
    while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
      foreach ($row as $item) {
			echo '<div class="memecontainer">';
			echo '<img class="center-fit" src="'.$item.'"/>';
			echo '<br>';
			$com= oci_parse($conn, 'SELECT SZOVEG FROM HOZZASZOLAS WHERE KEPEK_ID = (SELECT KEPEK_ID FROM KEPEK WHERE URL=:item)');
			oci_bind_by_name($com, ":item", $item);
			oci_execute($com);
			while ( $row = oci_fetch_array($com, OCI_ASSOC + OCI_RETURN_NULLS)) {
      	foreach ($row as $comment) {
					echo '<div class="div2">';
					echo $comment;
					echo '</div>';
				}
			}
			echo '</div>';
    }
  }
 
?>
  
 </body>
</html>
  