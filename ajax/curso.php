<?php 
require_once "../modelos/Curso.php";



$curso = new Curso();

$idcurso =isset($_POST["idcurso"])? limpiarCadena($_POST["idcurso"]):"";
$locacion = isset($_POST["locacion"])? limpiarCadena($_POST["locacion"]):"";
$aula = isset($_POST["aula"])? limpiarCadena($_POST["aula"]):"";
$idseccion = isset($_POST["idseccion"])? limpiarCadena($_POST["idseccion"]):"";


switch($_GET['op']){
    case 'guardaryeditar':
    if(empty($idcurso)){
        $rspta = $curso->insertar($locacion, $aula, $idseccion);
        echo $rspta ? "curso registrado" : "curso no se pudo registrar";
    }else{
        $rspta = $curso->editar($idcurso, $locacion, $aula, $idseccion);
        echo $rspta ? "curso actualizado" : "curso no se pudo actualizar";
    }

    break;
    
    case 'eliminar':
    $rspta = $curso->eliminar($idcurso);
    echo $rspta ? "curso eliminado" : "curso no se pudo eliminar";
    break;


    case 'mostrar':
    $rspta = $curso->mostrar($idcurso);
    //Codificar el resultado a JSON
    echo json_encode($rspta);
    break;

    case 'listar':
    $rspta = $curso->listar();
    //Se declara un arreglo
    $data = array();

    while($reg = $rspta->fetch_object()){
        $data[] = array(
            "0"=>'<button data-toggle="modal" href="#cModal" class="btn btn-warning" onclick="mostrar('.$reg->idcurso.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="eliminar('.$reg->idcurso.')"><i class="fa fa-close"></i></button>',
            "1"=>$reg->locacion,
            "2"=>$reg->aula,
            "3"=>$reg->seccion
              
         );
    }

        $results = array(
            "sEcho"=>1, //Informacion para el datatables(paginacion)
            "iTotalRecords"=>count($data),//Se envia el total de registros al datatable
            "iTotalDisplayRecords"=>count($data), //Se envia el total registros a visualizar
            "aaData"=>$data
        );
        echo json_encode($results);
    break;


   
}





?>