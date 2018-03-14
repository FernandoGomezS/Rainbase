<?php
include 'conectBD.php';

$cadena = $_POST['id'];
$cadena2 = $_POST['year'];
$id =preg_replace("/[^0-9]/", "", $cadena);
$year =preg_replace("/[^0-9]/", "", $cadena2);



$result = pg_query($con,"SELECT  * FROM events WHERE station_id = '$id' AND EXTRACT(YEAR FROM start_date)='$year'  ORDER BY start_date") or die("Error en la consulta SQL");

if(!$result) echo pg_error();
else
{
	$row = array();
	$row2 = array();

	while (($fila = pg_fetch_array($result)) != NULL) {	

		$date1 = new DateTime($fila['start_date']);		
		$duracion = $date1->diff(new DateTime($fila['end_date']));
		

		$row[] = $fila['start_date'];
		$row[] = $fila['end_date'];		
		$row[] = number_format($fila['amount'], 2, ",", "."); 
		$row[] = $duracion->format('%dd%hh%im');
		$row2[]=$row;	
		$row = array();			
	}
	$output['data']= $row2;
	echo json_encode( $output );
}

pg_free_result($result);
pg_close($con);

?>
