<?php
/**
 * Created by PhpStorm.
 * User: manuel.gomez
 * Date: 24-04-2021
 * Time: 13:31
 */

//header("Content-Type: application/json; charset=UTF-8");

include_once 'config/DBClass.php';
include_once 'class/Vehiculo.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
//print_r($connection);die;


$vehiculo = new Vehiculo($connection);

//$stmt = $vehiculo->read('BZXJ51');
$stmt = $vehiculo->readAll();
$count = $stmt->rowCount();


?>
    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
        <!-- BS JavaScript -->
        <script type="text/javascript" src="js/bootstrap.js"></script>


    </head>
    <body>
    <h1>Prueba PHP!</h1>



    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <h1>Vehiculos</h1>
            <div class="da">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Agregar Vehiculo</button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div id="records_content"></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Agregar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>



                        <div class="modal-body">
                            <div class="form-group">
                                <label for="CodPatente">Patente</label>
                                <input type="text" id="codPatente" value=""   class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="CodVehiculo">Vehiculo</label>
                                <input type="text" id="codVehiculo" class="form-control" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="valorPermiso">Valor Permiso</label>
                                <input type="text"  id="valorPermiso" class="form-control" value="" />
                            </div>
                            <div class="form-group">
                                <label for="">Multa Impaga</label>
                                <input type="text"id="multa" class="form-control" value=""  max="10"/>
                            </div>
                            <div class="form-group">
                                <label for="">Intereses Reajustes</label>
                                <input type="text" id="intereses" class="form-control" value=""  max="10"/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" onclick="addRecord()">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
            <table table id="dtBasicExample" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>


                    <th>ID</th>
                    <th>PATENTE</th>
                    <th>VEHICULO</th>
                    <th>VALOR PERMISO</th>
                    <th>INTERESES</th>
                    <th>MULTAS</th>
                    <th>SUBTOTAL</th>
                    <th>EDITAR</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach($stmt as $row){

                   // print_r($row);die;
                    ?>
                <tr>


                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['patente']; ?></td>
                    <td><?php echo $row['vehiculo']; ?></td>
                    <td><?php echo $row['valor_permiso']; ?></td>
                    <td><?php echo $row['intereses_reajustes']; ?></td>
                    <td><?php echo $row['multa_impaga']; ?></td>
                    <td><?php echo ($row['valor_permiso']+$row['multa_impaga']+$row['intereses_reajustes']); ?></td>
                    <td style="text-align:center;">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalEditar"
                                contenteditable="false">Editar</button>
                    </td>
                </tr>

<?php }?>
                </tbody>
            </table>

            <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>

                            </button>
                            <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>

                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>
<?php //print_r($pageno);



  //  echo json_encode($products);


?>

<script>

    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
            "paging": "simple" // false to disable pagination (or any other option)
        });

    });


    $(".btn[data-target='#modalEditar']").click(function() {
        var columnHeadings = $("thead th").map(function() {
            return $(this).text();
        }).get();
        columnHeadings.pop();
        var columnValues = $(this).parent().siblings().map(function() {
            return $(this).text();
        }).get();
        var modalBody = $('<div id="modalContent"></div>');
        var modalForm = $('<form role="form" name="modalForm" action="update.php" method="post"></form>');
        $.each(columnHeadings, function(i, columnHeader) {
            var formGroup = $('<div class="form-group"></div>');
            formGroup.append('<label for="'+columnHeader+'">'+columnHeader+'</label>');
            formGroup.append('<input class="form-control" name="'+columnHeader+i+'" id="'+columnHeader+i+'" value="'+columnValues[i]+'" />');
            modalForm.append(formGroup);
        });
        modalBody.append(modalForm);
        $('.modal-body').html(modalBody);
    });
    $('.modal-footer .btn-primary').click(function() {
        $('form[name="modalForm"]').submit();
    });


    function addRecord() {
        // get values

        //alert(1);

        var patente = $("#codPatente").val();
        var vehiculo = $("#codVehiculo").val();
        var valorPermiso = $("#valorPermiso").val();
        var multa = $("#multa").val();
        var intereses = $("#intereses").val();

        var parametros = {
            "patente" : patente,
            "vehiculo" : vehiculo,
            "valorPermiso" : valorPermiso,
            "multa" : multa,
            "intereses" : intereses
        };
        // Add record

        $.ajax({
            type: 'POST',
            url: "ajax/addRecord.php",
            data: parametros,
            success: function(){


                // clear fields from the popup
                $("#codPatente").val("");
                $("#codVehiculo").val("");
                $("#valorPermiso").val("");
                $("#multa").val("");
                $("#intereses").val("");
                location.reload();



            }
        });


    }

</script>
