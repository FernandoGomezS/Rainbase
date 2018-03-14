<?php
include 'conectBD.php';


$result1 = pg_query($con,"SELECT COUNT(*) FROM stations") or die("Error en la consulta SQL");
$result2 = pg_query($con,"SELECT COUNT(*) FROM record5ms") or die("Error en la consulta SQL");
$result3 = pg_query($con,"SELECT COUNT(*) FROM bands") or die("Error en la consulta SQL");
$result4 = pg_query($con,"SELECT COUNT(*) FROM events") or die("Error en la consulta SQL");


if(!$result1 && !$result2 && !$result3 &&!$result4) echo pg_error();
else
{
	$fila1 = pg_fetch_array($result1);
	$fila2 = pg_fetch_array($result2);
	$fila3 = pg_fetch_array($result3);
	$fila4 = pg_fetch_array($result4);

	$row = array();
	$row[] =$fila1['count'];
	$row[] =$fila2['count'];
	$row[] =$fila3['count'];
	$row[] =$fila4['count'];
	
	echo json_encode( $row);
}

pg_free_result($result1);
pg_free_result($result2);
pg_free_result($result3);
pg_free_result($result4);
pg_close($con);

?>
