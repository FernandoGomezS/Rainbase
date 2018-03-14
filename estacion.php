<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Sistema Pluviografico</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />    
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="assets/css/material-dashboard.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-active-color="blue" data-background-color="black">           
           <div class="logo">
                <a href="index.html" class="simple-text"><img src="assets/img/apple-icon.png" width="35" height="35">
                    Pluviográfico
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="index.html" class="simple-text">
                    <img src="assets/img/apple-icon.png" width="20" height="20">
                </a>
            </div>
            <div class="sidebar-wrapper">                
                <ul class="nav">
                    <li >
                        <a href="index.html">
                            <i class="material-icons">home</i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li class="active" >
                        <a href="estaciones.html">
                            <i class="material-icons">place</i>
                            <p>Estaciones</p>
                        </a>
                    </li>
                    <li >
                        <a href="upload.html">
                            <i class="material-icons">backup</i>
                            <p>Subir Archivo</p>
                        </a>
                    </li>
                    <li >
                        <a href="eventos.html">
                            <i class="material-icons">note_add</i>
                            <p>Crear Eventos</p>
                        </a>
                    </li>                    
                </ul>  
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" > Estación </a>
                    </div>               
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="card">
                                <div id="estacion" class="card-header card-header-icon" data-background-color="blue"> 
                                    <?php
                                    include 'conectBD.php';

                                    $cadena = $_GET['id'];
                                    $id =preg_replace("/[^0-9]/", "", $cadena);

                                    $result = pg_query($con,"SELECT  name FROM stations WHERE station_id='$id'" ) or die("Error en la consulta SQL");
                                    if(!$result) echo pg_error();
                                    else{
                                        $fila = pg_fetch_array($result);        

                                        echo $fila['name'];
                                    }
                                    pg_free_result($result);
                                    pg_close($con);
                                    ?>                                   
                                </div>
                                <br>
                                <div class="card-content">
                                    <ul class="nav nav-pills nav-pills-success">
                                        <li class="active">
                                            <a href="#pill1" data-toggle="tab" aria-expanded="true">Eventos</a>
                                        </li>
                                        <li class="">
                                            <a href="#pill2" data-toggle="tab" aria-expanded="false">Bandas</a>
                                        </li>
                                        <li class="">
                                            <a href="#pill3" data-toggle="tab" aria-expanded="false">Estadisticas</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="pill1">
                                            <div class="material-datatables">
                                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Año</th>
                                                            <th>N° Eventos</th>
                                                            <th>15m</th>
                                                            <th>30m</th>
                                                            <th>45m</th>
                                                            <th>1h</th>
                                                            <th>2h</th>
                                                            <th>4h</th>
                                                            <th>8h</th>
                                                            <th>12h</th>
                                                            <th>24h</th>
                                                            <th class="disabled-sorting ">Ver</th>
                                                        </tr>
                                                    </thead>                                               
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pill2"> 
                                            <div class="material-datatables">
                                                <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                                    <thead>
                                                        <tr>                                                            
                                                            <th>Año</th>
                                                            <th>N° Bandas</th>                                                            
                                                            <th class="disabled-sorting ">Ver</th>
                                                        </tr>
                                                    </thead>                                               
                                                </table>
                                            </div>                                    

                                        </div>
                                        <div class="tab-pane" id="pill3">

                                        </div>
                                    </div>
                                </div>
                                <!-- end content-->
                            </div>
                            <!--  end card  -->
                        </div>
                        <!-- end col-md-12 -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <footer class="footer">

            </footer>
        </div>
    </div>    
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js" type="text/javascript"></script>
<script src="assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="assets/js/jquery.validate.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="assets/js/moment.min.js"></script>

<!--  Plugin for the Wizard -->
<script src="assets/js/jquery.bootstrap-wizard.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--   Sharrre Library    -->
<script src="assets/js/jquery.sharrre.js"></script>
<!-- DateTimePicker Plugin -->
<script src="assets/js/bootstrap-datetimepicker.js"></script>
<!-- Vector Map plugin -->
<script src="assets/js/jquery-jvectormap.js"></script>
<!-- Sliders Plugin -->
<script src="assets/js/nouislider.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<!-- Select Plugin -->
<script src="assets/js/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin    -->
<script src="assets/js/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin -->
<script src="assets/js/sweetalert2.js"></script>
<!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin    -->
<script src="assets/js/fullcalendar.min.js"></script>
<!-- TagsInput Plugin -->
<script src="assets/js/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="assets/js/material-dashboard.js"></script>

<script type="text/javascript"> 

$(document).ready(function() {       

    var paramstr = window.location.search.substr(1);
    var paramarr = paramstr.split ("&");
    var params = {};
    var id;

    for ( var i = 0; i < paramarr.length; i++) {
        var tmparr = paramarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    if (params['id']) {
        id=params['id'];

    } else {
        id=-1;
        console.log('No se envió el parámetro variable');
    }
    

    $('#datatables').DataTable({ 

        "ajax": {
            url: "datosTabla2.php",
            type: "POST",  
            data: {"id":id,"valor":1}
        } ,       

        "pagingType": "full_numbers",
        "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
        ],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<a class='btn btn-simple btn-warning btn-icon edit'><i class='material-icons'>remove_red_eye</i>"
        } ]
        ,
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Buscar..",
        }

    });
    var table = $('#datatables').DataTable();


    table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');

        var data = table.row($tr).data();
        location.href = "eventos.php?id="+id+"&year="+data[1]; 
    });

    $('.card .material-datatables label').addClass('form-group');


    $('#datatables2').DataTable({ 

        "ajax": {
            url: "bandasTabla.php",
            type: "POST",  
            data: {"id":id}
        } ,       

        "pagingType": "full_numbers",
        "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
        ],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<a class='btn btn-simple btn-warning btn-icon edit'><i class='material-icons'>remove_red_eye</i>"
        } ]
        ,
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Buscar..",
        }

    });

    var table2 = $('#datatables2').DataTable();

    table2.on('click', '.edit', function() {
        $tr2 = $(this).closest('tr');

        var data = table2.row($tr2).data();
        location.href = "bandas.php?id="+id+"&year="+data[0]; 
    });

});



</script>


</html>