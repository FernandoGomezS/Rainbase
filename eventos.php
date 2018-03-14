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
                        <a class="navbar-brand" href="estaciones.html#"> Estaciones </a>
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
                                    <br>
                                    <div class="material-datatables">
                                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Fecha de Inicio</th>
                                                    <th>Fecha de Termino</th>
                                                    <th>Cantidad</th>
                                                    <th>Duración</th>                                    
                                                    <th class="disabled-sorting ">Gráfico</th>
                                                </tr>
                                            </thead>                                               
                                        </table>
                                    </div>
                                </div>
                                <!-- end content-->
                            </div>
                            <!--  end card  -->
                        </div>
                        <!-- end col-md-10 -->                       
                    </div>
                    <!-- end row -->
                </div>
            </div>

            <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                            <h5 class="modal-title" id="myModalLabel">Grafico</h5>
                        </div>
                        <div class="modal-body">
                            <div  class="col-md-12">
                                <div class="card">
                                    <div id="estacion2" class="card-header card-header-icon" data-background-color="blue">
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
                                        <br>

                                        <div class="material-datatables">
                                            <table id="datatables2" class="table table-striped table-hover" cellspacing="0" width="100%" style="width:100%">
                                                <thead class="text-primary">
                                                    <tr>
                                                        <th> Variable</th>
                                                        <th> Q1 </th>
                                                        <th> Q2 </th>
                                                        <th> Q3 </th>
                                                        <th> Q4 </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> Cantidad de lluvia  </td>
                                                        <td id="cantQ1"> </td>
                                                        <td id="cantQ2"> </td>
                                                        <td id="cantQ3"> </td>
                                                        <td id="cantQ4"> </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Porcentaje  </td>
                                                        <td id="porQ1"></td>
                                                        <td id="porQ2"> </td>
                                                        <td id="porQ3"> </td>
                                                        <td id="porQ4"> </td>
                                                    </tr>
                                                </tbody>                                            
                                            </table>
                                        </div>                                        
                                    </div>
                                    <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
                                    <!-- end content-->                                    
                                </div>
                                <!--  end card  -->
                            </div>                            
                        </div>
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <input type="button" onclick="history.back()" name="volver atrás" value="volver atrás">

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

<script type="text/javascript"> 

$(document).ready(function() {       

    var paramstr = window.location.search.substr(1);
    var paramarr = paramstr.split ("&");
    var params = {};
    var id;
    var year;

    for ( var i = 0; i < paramarr.length; i++) {
        var tmparr = paramarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    if (params['year']) {
        year=params['year'];
        id=params['id'];
    } else {
        id=-1;
        year=0;
        console.log('No se envió el parámetro variable');
    }

    $('#datatables').DataTable({ 

        "ajax": {
            url: "eventosTabla.php",
            type: "POST",  
            data: {"id":id , "year":year}
        } ,       

        "pagingType": "full_numbers",
        "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
        ],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<a class='btn btn-simple btn-warning btn-icon edit' data-toggle='modal' data-target='#noticeModal'><i class='material-icons'>insert_chart</i>"
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

        $.ajax({
            data: {"id" : id, "inicial" : data[0],"final":data[1]},
            type: "POST",
            dataType: "json",
            url: "calculoQ.php",
        })
        .done(function( datos, textStatus, jqXHR ) {

            suma=datos[0]+datos[1]+datos[2]+datos[3];

            porcet1=(datos[0]*100)/suma;
            porcet2=(datos[1]*100)/suma;
            porcet3=(datos[2]*100)/suma;
            porcet4=(datos[3]*100)/suma;           

            document.getElementById('cantQ1').innerHTML = datos[0];
            document.getElementById('cantQ2').innerHTML = datos[1];
            document.getElementById('cantQ3').innerHTML = datos[2];
            document.getElementById('cantQ4').innerHTML = datos[3];
            document.getElementById('porQ1').innerHTML =  porcet1.toFixed(2);
            document.getElementById('porQ2').innerHTML =  porcet2.toFixed(2);
            document.getElementById('porQ3').innerHTML =  porcet3.toFixed(2);
            document.getElementById('porQ4').innerHTML =  porcet4.toFixed(2);

        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            if ( console && console.log ) {
                console.log( "La solicitud a fallado: " +  textStatus);
            }
        });


        cargarGrafico(data[0], data[1], id);


    });

$('.card .material-datatables label').addClass('form-group');
});




function cargarGrafico (data1,data2, id){
    $.ajax({
        data: {"id" : id, "inicial" : data1,"final":data2},
        type: "POST",
        dataType: "json",
        url: "evento.php",
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
})
.fail(function( jqXHR, textStatus, errorThrown ) {
    if ( console && console.log ) {
        console.log( "La solicitud a fallado: " +  textStatus);
    }
});



}

// from link
$('#noticeModal').on('show.bs.modal', function() {
    $('.chart-container').css('visibility', 'hidden');
});

$('#noticeModal').on('shown.bs.modal.', function() {
    $('.chart-container').css('visibility', 'initial');
    $('#container').highcharts().reflow()
//added
ratio = $('.chart-container').width() / $('.chart-container').height();
});


</script>


</html>