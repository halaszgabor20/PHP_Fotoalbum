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
        //echo $key;
		echo "<br>";
        echo $var;
          $upd=  oci_parse($conn, 'UPDATE KEPEK SET ERTEKELES=ERTEKELES+1 WHERE URL= :var');
         
          oci_bind_by_name($upd, ":var", $var);
          oci_execute($upd);
		  echo "<script> location.href = 'kezdolap.php'</script>";
        }
      }
	  
?>