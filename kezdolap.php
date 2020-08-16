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
<!-- Page content -->
<form action="newsfeed1.php" method="post" enctype="multipart/form-data">
<section id="portfolio">
  <div class="project">
    <img class="project__image" src="https://i.computer-bild.de/imgs/t/tk1/7/2/0/5/6/0/1/Android-a5c303feeeabdcf6.jpeg" />

    <h3 class="grid__title"> Akt</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed1.php'" type="submit" name="Akt" value="Tovább">
  </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="https://www.teamvvv.com/wp-content/uploads/2016/10/project-cars-pagani-edition.jpg" />

    <h3 class="grid__title"> Autók</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed1.php'" type="submit" name="Autok" value="Tovább">
    </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="https://tocka.com.mk/images/gallery/gallery-images/big/1241/gal36320805.jpg" />

    <h3 class="grid__title"> Állatok</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed1.php'" type="submit" name="Allatok" value="Tovább">
    </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="https://i.pinimg.com/originals/e5/f8/73/e5f8733a8769bf5ccee24e8fdab03eea.jpg" />

    <h3 class="grid__title"> Filmek</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed1.php'" type="submit" name="Filmek" value="Tovább">
    </div>
  </div>
  <div class="project">
    <img class="project__image" src="http://durevie.paris/wp-content/uploads/sites/7/2018/05/city-tour-guide-new-york-tim-sweeney-dure-vie-hard-life.jpg" />

    <h3 class="grid__title"> Városok</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed1.php'" type="submit" name="Varosok" value="Tovább">
    </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="https://24.p3k.hu/app/uploads/2018/03/robert-downey-jr-1024x576.jpg" />

    <h3 class="grid__title"> Hírességek</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed1.php'" type="submit" name="Hiressegek" value="Tovább">
    </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="https://wallpaper21.com/wp-content/uploads/2017/08/Machine-Learning-Smart-Brain-machine-learning-smart-brain-1080p-machine-learn-wallpaper-wpt7606740.jpg" />

    <h3 class="grid__title"> Tech</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed1.php'" type="submit" name="Tech" value="Tovább">
    </div>
  </div>
  
  <div class="project">
    <img class="project__image" src="http://pavbca.com/walldb/original/9/0/0/300183.jpg" />

    <h3 class="grid__title"> Történelem</h3>
    <div class="grid__overlay">
    <input onClick="window.location.href='newsfeed1.php'" type="submit" name="Tortenelem" value="Tovább">
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
  
  <script src="js/java.js"></script>
  
  
<?php
	
	if(isset($_SESSION['logout'])){
		session_destroy();
		echo "<a href = 'index.php'></a>";
	}
?>

<!-- End page content -->

</body>
</html>