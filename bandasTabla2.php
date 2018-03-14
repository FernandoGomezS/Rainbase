<?php
include 'conectBD.php';

$cadena = $_POST['id'];
$cadena2 = $_POST['year'];
$id =preg_replace("/[^0-9]/", "", $cadena);
$year =preg_replace("/[^0-9]/", "", $cadena2);
$result = pg_query($con,"SELECT  bands.date , id FROM bands WHERE station_id = '$id' AND EXTRACT(YEAR FROM bands.date)='$year'  ORDER BY bands.date") or die("Error en la consulta SQL");

if(!$result) echo pg_error();
else
{
    $row = array();
    $row2 = array();

    while (($fila = pg_fetch_array($result)) != NULL) {        
       
        $row[] = $fila['id'];
        $row[] = $fila['date'];       
        $row2[]=$row;   
        $row = array();       
    }
    $output['data']= $row2;
    echo json_encode( $output );
}

pg_free_result($result);
pg_close($con);

?>