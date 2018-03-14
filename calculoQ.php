<?php
include 'conectBD.php';

$cadena = $_POST['id'];
$fechaini = $_POST['inicial'];
$fechafinal = $_POST['final'];
$id =preg_replace("/[^0-9]/", "", $cadena);




$result = pg_query($con,"SELECT * FROM record5ms  WHERE record5ms.station_id = '$id' AND ( record5ms.date BETWEEN '$fechaini' AND '$fechafinal')") or die("Error en la consulta SQL");

if(!$result) echo pg_error();
else
{
	$row = array();
	$row2 = array();	

	$formato = 'Y-m-d H:i:s';
	$fecha1 = DateTime::createFromFormat($formato, $fechaini);	
	$fecha2 = DateTime::createFromFormat($formato, $fechafinal);	

	$ts = $fecha1->getTimestamp();
	$ts2 = $fecha2->getTimestamp();	
	$duracion=($ts2-$ts)/4;
	$val1=0;
	$val2=0;
	$val3=0;
	$val4=0;


	while (($fila = pg_fetch_array($result)) != NULL) {	

		$formato = 'Y-m-d H:i:s';
		$fecha = DateTime::createFromFormat($formato, $fila['date']);	

		$tiempo = $fecha->getTimestamp();
		$suma=$suma+$fila['amount'];
		$tiempo=$tiempo-$ts;

		if($tiempo>=$duracion && $val1!=1){
			$val1=1;
			$row[] = $suma;		
			
			$suma=0;		
		}
		if($tiempo>=$duracion*2 && $val2!=1){
			$val2=1;
			$row[] = $suma;		
			
			$suma=0;	

		}

		if($tiempo>=$duracion*3 && $val3!=1){
			$val3=1;
			$row[] = $suma;		
			
			$suma=0;	

		}
		if($tiempo>=$duracion*4 && $val4!=1){
			$val4=1;
			$row[] = $suma;		
			
			$suma=0;		

		}	

	}
echo json_encode( $row);
}
pg_free_result($result);
pg_close($con);

?>
