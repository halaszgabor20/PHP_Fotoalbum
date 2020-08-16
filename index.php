<?php
session_start();
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
  <li><a class="active" id="current" href="index.php">Főoldal</a></li>
  <li><a href="statisztika.php">Statisztikák</a></li>
  <li><a href="fotopalyazat.php">Fotópályázat</a></li>
  <li><a href="about.html">Rólunk</a></li>
  <li><a href="reg.php">Regisztráció</a></li>
</ul>
<!-- Page content -->
<form action="newsfeed.php" method="post" enctype="multipart/form-data">
<section id="portfolio">
  <div class="project">
    <img class="project__image" src="https://i.computer-bild.de/imgs/t/tk1/7/2/0/5/6/0/1/Android-a5c303feeeabdcf6.jpeg" />

    <h3 class="grid__title"> Akt</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed.php'" type="submit" name="Akt" value="Tovább">
  </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="https://www.teamvvv.com/wp-content/uploads/2016/10/project-cars-pagani-edition.jpg" />

    <h3 class="grid__title"> Autók</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed.php'" type="submit" name="Autok" value="Tovább">
    </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="https://tocka.com.mk/images/gallery/gallery-images/big/1241/gal36320805.jpg" />

    <h3 class="grid__title"> Állatok</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed.php'" type="submit" name="Allatok" value="Tovább">
    </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="https://i.pinimg.com/originals/e5/f8/73/e5f8733a8769bf5ccee24e8fdab03eea.jpg" />

    <h3 class="grid__title"> Filmek</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed.php'" type="submit" name="Filmek" value="Tovább">
    </div>
  </div>
  <div class="project">
    <img class="project__image" src="http://durevie.paris/wp-content/uploads/sites/7/2018/05/city-tour-guide-new-york-tim-sweeney-dure-vie-hard-life.jpg" />

    <h3 class="grid__title"> Városok</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed.php'" type="submit" name="Varosok" value="Tovább">
    </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="https://24.p3k.hu/app/uploads/2018/03/robert-downey-jr-1024x576.jpg" />

    <h3 class="grid__title"> Hírességek</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed.php'" type="submit" name="Hiressegek" value="Tovább">
    </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="https://wallpaper21.com/wp-content/uploads/2017/08/Machine-Learning-Smart-Brain-machine-learning-smart-brain-1080p-machine-learn-wallpaper-wpt7606740.jpg" />

    <h3 class="grid__title"> Tech</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed.php'" type="submit" name="Tech" value="Tovább">
    </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="http://pavbca.com/walldb/original/9/0/0/300183.jpg" />

    <h3 class="grid__title"> Történelem</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed.php'" type="submit" name="Tortenelem" value="Tovább">
    </div>
  </div>
  <div class="overlay">
    <div class="overlay__inner">
      <button class="close">close X</button>
      <img max-width:10% max-height:>
    </div>
  </div>
</section>
 </form><br>

  <!-- Login -->
  <div class="w3-light-grey w3-padding-large w3-padding-32 w3-margin-top" id="contact">
    <h3 class="w3-center">Belépés</h3>
    <hr>

    <form action="index.php" method="post" enctype="multipart/form-data">
      <div class="w3-section">
        <label>Név</label>
        <input class="w3-input w3-border" type="text" name="name" placeholder="Felhasznalonev">
      </div>
      <div class="w3-section">
        <label>Jelszó</label>
        <input class="w3-input w3-border" type="password" name="pwd" placeholder="Jelszó">
      </div>
      <button type="submit" name="belep" class="w3-button w3-block w3-dark-grey">Belépés</button>
    </form><br>
  </div>
  
  <script src="js/java.js"></script>
  
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
 
	$query = "SELECT Felhasznalok_nev FROM Felhasznalok WHERE Felhasznalok_nev=:name and jelszo=:pwd"; 

	$stid = oci_parse($conn, $query);

	if (isset($_POST['name']) ||isset($_POST['pwd'])){
		$name=$_POST['name'];
		$pass=$_POST['pwd'];

		if(strlen($name) == 0 || strlen($pass) == 0){
			echo '<script>location.href = "index.php"</script>';
			//echo("A " . $name . " felhasználónév vagy a jelszó nem helyes . Próbáld újra!");
		} else{
			oci_bind_by_name($stid, ':name', $name);
			oci_bind_by_name($stid, ':pwd', $pass);

			oci_execute($stid);
		
		$row = oci_fetch_array($stid, OCI_ASSOC);

		if ($row) {
			$_SESSION['felhasznalo']=$_POST['name'];
			echo "<script> location.href = 'kezdolap.php'</script>";
		} else {
			echo("A " . $name . " felhasználónév vagy a jelszó nem helyes . Próbáld újra!");
		exit;
			}
		}
} 

	oci_free_statement($stid);
	oci_close($conn);
	
	?>
  
<!-- End page content -->

</body>
</html>
