<?php

$conn = pg_connect("user = rainbase password = rainbase host = localhost dbname = rainbase");

$res = pg_query($conn, "SELECT imagedata FROM public.bands   WHERE id =" . $_GET['bands'] . ";");

if (!$res) {
    echo "An error occured at result.\n";
    exit;
}

if($res) {
    $Row = pg_fetch_row($res, '0');
    header("Content-Type: image/jpg");
    print(pg_unescape_bytea($Row[0]));

}
else 
{
   echo "The query failed!?! There is no row with id=1!";
}
?>
