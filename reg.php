<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<title>Fotózunk</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="w3.css">
<link rel="stylesheet" href="css/style.css">
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
  <li><a href="index.php">Főoldal</a></li>
  <li><a href="statisztika.php">Statisztikák</a></li>
  <li><a href="fotopalyazat.php">Fotópályázat</a></li>
  <li><a href="about.html">Rólunk</a></li>
  <li><a id="current" class="active" href="reg.php">Regisztráció</a></li>
</ul>

<div class="user">
    <header class="user__header">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />
        <h1 class="user__title">Regisztráció</h1>
    </header>
	

<form name="register" action="reg.php" method="post" enctype="multipart/form-data" class="form">
				<div class="form__group">
                <!--<label class="contact"><strong>Felhasználónév:</strong></label><br>-->
                <input type="text" name="user" class="form__input" placeholder="Felhasználónév"/>
                </div>  

                <div class="form__group">
                <!--<label class="contact"><strong>Jelszó:</strong></label><br>-->
                <input type="password" name="pass" class="form__input" placeholder="Jelszó"/>
                </div>   

				<div class="form__group">
                <!--<label class="contact"><strong>Email:</strong></label><br>-->
                <input type="email" name="email" class="form__input" placeholder="Email"/>
                </div> 
				
				<div class="form__group">
                <!--<label class="contact"><strong>Lakcím:</strong></label><br>-->
                <input type="text" name="address" class="form__input" placeholder="Lakcím"/>
                </div> 
          
                <div class="w3-section">
                <input type="submit" class="btn" name="submit" />
                </div>   
</form>
</div>

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

	if(isset($_POST['submit'])) {
					
				$varuser = $_POST['user'];
				$varpass = $_POST['pass'];
				$varemail = $_POST['email'];
				$varaddress = $_POST['address'];
				$errors = [];
								
				$stid = oci_parse($conn, 'SELECT FELHASZNALOK_NEV FROM FELHASZNALOK');

				oci_execute($stid);
				
				while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					foreach ($row as $item) {
						if($item == $varuser)
						$errors[] = "Foglalt felhasználónév.";
						break;
			}
	}
								
				if(strlen($varuser) == 0){
					$errors[] = "Felhasználónév megadása kötelező!";
				} else if (strlen($varpass) == 0) {
					$errors[] = "Jelszó megadás kötelező!";
				} else if(strlen($varpass) < 5){
					$errors[] = "Legalább 5 karakter hosszúnak kell lennie a jelszónak.";
				} elseif (!(preg_match( '~[A-Za-z]~', $varpass) && preg_match( '~\d~', $varpass))) {
					$errors[] = "Legalább 1 karaktert és 1 számot tartalmaznia kell a jelszónak.";
				} else if(strlen($varemail) == 0){
					$errors[] = "Email megadása kötelező!";
				} else if(strlen($varaddress) == 0){
					$errors[] = "Lakcím megadása kötelező!";
				}
				
				if (sizeof($errors) == 0) {
					echo "Sikeres regisztráció";
					
					$compiled = oci_parse($conn, 'INSERT INTO FELHASZNALOK(FELHASZNALOK_NEV,JELSZO,EMAIL,LAKCIM)
					VALUES (:usernev, :passnev, :emailcim, :addresscim)');
 
					oci_bind_by_name($compiled, ":usernev", $varuser);
					oci_bind_by_name($compiled, ":passnev", $varpass);
					oci_bind_by_name($compiled,":emailcim",$varemail);
					oci_bind_by_name($compiled, ":addresscim", $varaddress);

					oci_execute($compiled);
				

				} else {
					foreach ($errors as $error) {
					echo $error."<br>";
				}
		}												
	}
	oci_close($conn);
?>

    <script  src="js/index.js"></script>

</body>
</html>