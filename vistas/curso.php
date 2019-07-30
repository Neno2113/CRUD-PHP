<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mantenimiento de Estudiantes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/fonts/font-awesome.min.css">
    
    
    <!-- DATATABLES -->

    <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">

    
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap-select.min.css">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Mantenimiento Cursos</h3><hr>
                <a href="#cModal" data-toggle="modal"><button class="btn btn-primary">Agregar Curso <i class="fa fa-university"></i></button></a>
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="estudiante.php">Estudiante</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="curso.php">Curso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="seccion.php">Seccion</a>
                    </li>
                </ul>
                
            </div>
        </div>
        <br>

        <div class="row">
            <table id="tbllistado" clas="table table-bordered table-hover table-responsive-lg">
                <thead>
                    <th>Opciones</th>
                    <th>Locacion</th>
                    <th>Aula</th>
                    <th>Seccion</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <th>Opciones</th>
                    <th>Locacion</th>
                    <th>Aula</th>
                    <th>Seccion</th>
                </tfoot>

            </table>
        </div>
       






        <!-- Modal Curso -->
            <div class="modal fade" id="cModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="titulo">Agregar Curso</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" id="formulario" name="formulario" method="POST">
                                <div class="form-group row">
                                <div class="col-lg-6 col-md-6">
                                    <label>Locacion(*):</label>
                                    <input type="hidden" name="idcurso" id="idcurso">
                                    <input type="text" name="locacion" id="locacion" class="form-control" required>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label>Aula(*):</label>
                                    <input type="text" name="aula" id="aula" class="form-control" required>
                                </div>
                            
                            
                                </div>
                               
                                <div class="form-group row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label>Seccion(*):</label>
                                    <select name="idseccion" id="idseccion" class="form-control selectpicker" data-live-search="true" required>

                                    </select>
                                </div>
                                </div>
                               
                             
                                <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            <button type="button" class="btn btn-default" onclick="limpiar()" data-dismiss="modal">Cerrar</button>
                            </div>
                            </form>
                        </div>
                        
                    </div>
                </div>

            </div>
        

        
    </div>



    <script src="../public/js/jquery-3.1.1.min.js"></script>
    <script src="../public/js/popper.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>


    <!-- Datatables -->
    <script src="../public/datatables/jquery.dataTables.min.js"></script>
    <script src="../public/datatables/dataTables.buttons.min.js"></script>
    <script src="../public/datatables/buttons.html5.min.js"></script>
    <script src="../public/datatables/buttons.colVis.min.js"></script>
    <script src="../public/datatables/jszip.min.js"></script>
    <script src="../public/datatables/pdfmake.min.js"></script>
    <script src="../public/datatables/vfs_fonts.js"></script>
    <script src="../public/js/bootbox.min.js"></script>
    <script src="../public/js/bootstrap-select.min.js"></script>


    <script src="scripts/curso.js"></script>




</body>
</html>

