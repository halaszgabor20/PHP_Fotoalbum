<?php
session_start();
?>
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
    
foreach($_POST as $key=>$value){
	if(isset($_POST[$key])){
		//echo $key;
		$name = $_SESSION['felhasznalo'];
		$text = $_POST['message'];
		$var = str_replace("_",".",$key);
		echo $var;
		echo "<br>";
		
		if(!($var == "message")){
		$compiled = oci_parse($conn, 'INSERT INTO HOZZASZOLAS(ID, SZOVEG,KEPEK_ID, FELHASZNALOK_FELHASZNALONEV)
						VALUES (HOZZASZOLAS_AUTO_INCR.nextval, :text, (SELECT KEPEK_ID FROM KEPEK WHERE URL = :var) , :name)'); 
						
						oci_bind_by_name($compiled, ":text", $text);
						oci_bind_by_name($compiled, ":var", $var);
						oci_bind_by_name($compiled, ":name", $name);

						oci_execute($compiled);
						echo "<script> location.href = 'kezdolap.php'</script>";
		}
	}
}

?>