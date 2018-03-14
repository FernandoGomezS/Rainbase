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
                        <a class="navbar-brand" > Banda </a>
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
                                <div class="card-content"> 
                                    <br>
                                    <?php $cadena = $_GET['bands'];
                                    $id =preg_replace("/[^0-9]/", "", $cadena);  
                                    echo "<img id='zoom_05' src='imagen.php?bands=$id' data-zoom-image='imagen.php?bands=$id' >";
                                    ?>                                
                                    <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
                                </div>
                                <!-- end content-->
                            </div>
                            <button class="btn"  onclick="history.back()">
                                <span class="btn-label">
                                    <i class="material-icons">keyboard_arrow_left</i>
                                </span>
                                volver atrás
                                <div class="ripple-container"></div></button>
                                <!--  end card  -->
                            </div>

                            <!-- end col-md-10 -->                       
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
    <!--highchart-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- Zoom-->
    <script src="assets/js/jquery.elevatezoom.js"></script>

    

    <script type="text/javascript"> 
    $("#zoom_05").elevateZoom({
      zoomType              : "inner",
      cursor: "crosshair"
  });
     var paramstr = window.location.search.substr(1);
    var paramarr = paramstr.split ("&");
    var params = {};
    var id,bands;
    

    for ( var i = 0; i < paramarr.length; i++) {
        var tmparr = paramarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    if (params['id']) {
        id=params['id'];
        bands=params['bands'];


    } else {
        id=-1;
        console.log('No se envió el parámetro variable');
    }

$.ajax({
        data: {"id" : id,"bands":bands},       
        dataType: "json",
        url: "bandaGrafico.php",
    })
    .done(function( datos, textStatus, jqXHR ) {
        $('#container').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Cantidad de lluvia caida en el evento'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'datetime',

                labels: {
                    overflow: 'justify'
                }
            },
            yAxis: {
                title: {
                    text: 'Milimetros '
                },
                plotLines: [{
                    value: 5,
                    width: 1,
                    color: '#808080'
                }]

                ,min: 0
            },
            tooltip: {
                valueSuffix: ' mm'
            },
            plotOptions: {
                spline: {
                    lineWidth: 4,
                    states: {
                        hover: {
                            lineWidth: 5
                        }
                    },
                    marker: {
                        enabled: false
                    }
                }
            },
            series: [{
                name: 'Lluvia acumulada',
                data:datos

            }],
            navigation: {
                menuItemStyle: {
                    fontSize: '10px'
                }
            }
        });
$('#container').highcharts().reflow();
})
.fail(function( jqXHR, textStatus, errorThrown ) {
    if ( console && console.log ) {
        console.log( "La solicitud a fallado: " +  textStatus);
    }
});

    </script>


    </html>