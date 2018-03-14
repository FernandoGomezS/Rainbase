<?php
include 'conectBD.php';

$cadena = $_POST['id'];
$fechaini = $_POST['inicial'];
$fechafinal = $_POST['final'];
$id =preg_replace("/[^0-9]/", "", $cadena);


$result = pg_query($con,"SELECT * FROM record5ms  WHERE record5ms.station_id = '$id' AND ( record5ms.date BETWEEN '$fechaini' AND '$fechafinal') ORDER BY record5ms.date ") or die("Error en la consulta SQL");

if(!$result) echo pg_error();
else
{
	$row = array();
	$row2 = array();	

	while (($fila = pg_fetch_array($result)) != NULL) {	

		$formato = 'Y-m-d H:i:s';
		$fecha = DateTime::createFromFormat($formato, $fila['date']);	
		
		$ts = $fecha->getTimestamp();
		$suma=$suma+$fila['amount'];

		$row[] =($ts*1000)-14400000;
		$row[] = $suma;		
		$row2[]=$row;	
		$row = array();			
	}
	echo json_encode( $row2);
}

pg_free_result($result);
pg_close($con);

?>
