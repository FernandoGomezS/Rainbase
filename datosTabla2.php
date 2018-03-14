<?php
include 'conectBD.php';

$cadena = $_POST['id'];
$id =preg_replace("/[^0-9]/", "", $cadena);
$cadena2= $_POST["valor"];
$valor =preg_replace("/[^0-9]/", "", $cadena2);

if($valor==1){
	$result = pg_query($con,"SELECT  * FROM max_years WHERE station_id = '$id' ORDER BY year") or die("Error en la consulta SQL");

	if(!$result) echo pg_error();
	else
	{
		$row = array();
		$row2 = array();

		while (($fila = pg_fetch_array($result)) != NULL) {	

			$año=$fila['year'];
			$result2 = pg_query($con,"SELECT COUNT(*) FROM events WHERE EXTRACT(YEAR FROM start_date)='$año'") or die("Error en la consulta SQL");

			if(!$result2) echo pg_error();
			else{
				$fila2 = pg_fetch_array($result2);	

				$row[] = $fila['id'];
				$row[] = $fila['year'];
				$row[] = $fila2['count'];
				$row[] = $fila['m15'];
				$row[] = $fila['m30'];
				$row[] = $fila['m45'];
				$row[] = $fila['h1'];
				$row[] = $fila['h2'];
				$row[] = $fila['h4'];
				$row[] = $fila['h8'];
				$row[] = $fila['h12'];
				$row[] = $fila['h24'];
				$row2[]=$row;	
				$row = array();

			} 
		}
		$output['data']= $row2;
		echo json_encode( $output );
	}
}
else{
	$result = pg_query($con,"SELECT  name FROM stations WHERE station_id='$id'" ) or die("Error en la consulta SQL");
	if(!$result) echo pg_error();
	else{
		$fila = pg_fetch_array($result);		
		echo json_encode( $fila['name']);

	}
}
pg_free_result($result);
pg_close($con);

?>































