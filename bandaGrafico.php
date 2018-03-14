<?php
include 'conectBD.php';

$cadena = $_GET['bands'];
$bands =preg_replace("/[^0-9]/", "", $cadena);
$cadena2 = $_GET['id'];
$id =preg_replace("/[^0-9]/", "", $cadena2);


$result = pg_query($con,"SELECT bands.date FROM bands WHERE id = '$bands'") or die("Error en la consulta SQL1");
if(!$result) echo pg_error();
else
{
    $fila = pg_fetch_array($result);
    $fechaini=$fila['date'];
    $formato = 'Y-m-d H:i:s';
    $fechafinal = DateTime::createFromFormat($formato, $fila['date']); 
    $fechafinal->modify('+7 day'); 
    $fechafinal = $fechafinal->format('Y-m-d H:i:s');

    $result2 = pg_query($con,"SELECT * FROM record5ms  WHERE record5ms.station_id = '$id' AND ( record5ms.date BETWEEN '$fechaini' AND '$fechafinal') ORDER BY record5ms.date ") or die("Error en la consulta SQL2");

    if(!$result2) echo pg_error();
    else
    {
        $row = array();
        $row2 = array();    

        while (($fila = pg_fetch_array($result2)) != NULL) { 

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
}
pg_free_result($result);
pg_close($con);

?>