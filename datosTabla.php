 <?php
include 'conectBD.php';

$result = pg_query($con,"SELECT station_id , name FROM stations") or die("Error en la consulta SQL");
if(!$result) echo pg_error();
else
{
	$row = array();
	$row2 = array();
    
	while (($fila = pg_fetch_array($result)) != NULL) {	

		$id=$fila['station_id'];
		$result2 = pg_query($con,"SELECT COUNT(*) FROM events  WHERE events.station_id = '$id'") or die("Error en la consulta SQL");
		$result3 = pg_query($con,"SELECT COUNT(*) FROM bands  WHERE bands.station_id = '$id'") or die("Error en la consulta SQL");

		if(!$result2) echo pg_error();
		else{
			$fila2 = pg_fetch_array($result2);
			$fila3 = pg_fetch_array($result3);
			$row[] = $id;
			$row[] = $fila['name'];
			$row[] = $fila2['count'];
			$row[] = $fila3['count'];
			$row2[]=$row;	
			$row = array();

			} 
	}
	$output['data']= $row2;
	 echo json_encode( $output );
}

pg_free_result($result);
pg_close($con);

?>

