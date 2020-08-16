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
        $var=str_replace("_",".",$key);
		echo "<br>";
		
        $upd=  oci_parse($conn, 'UPDATE FOTOPALYAZAT SET SZAVAZAT=SZAVAZAT+1 WHERE FOTOPALYAZAT_ID = (SELECT FOTOPALYAZAT_ID FROM KEPEK WHERE URL = :var)');
         
          oci_bind_by_name($upd, ":var", $var);
          oci_execute($upd);
		  echo "<script> location.href = 'fotopalyazat.php'</script>";
        }
      }
	  
?>