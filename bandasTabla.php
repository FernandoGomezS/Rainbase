<?php
include 'conectBD.php';

$cadena = $_POST['id'];
$id =preg_replace("/[^0-9]/", "", $cadena);

$result = pg_query($con,"SELECT COUNT(*) as bandas,EXTRACT(YEAR FROM date)   FROM bands WHERE station_id = '$id' group by EXTRACT(YEAR FROM date) order by EXTRACT(YEAR FROM date) ") or die("Error en la consulta SQL");

if(!$result) echo pg_error();
else
{
	$row = array();
	$row2 = array();

	while (($fila = pg_fetch_array($result)) != NULL) {	

		

		$row[] = $fila['date_part'];
		$row[] = $fila['bandas'];		
		$row2[]=$row;	
		$row = array();			
	}
	$output['data']= $row2;
	echo json_encode( $output );
}

pg_free_result($result);
pg_close($con);

?>
