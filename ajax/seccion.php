<?php 
require_once "../modelos/Seccion.php";



$seccion = new Seccion();

$idseccion =isset($_POST["idseccion"])? limpiarCadena($_POST["idseccion"]):"";
$seccion = isset($_POST["seccion"])? limpiarCadena($_POST["seccion"]):"";
$idcurso = isset($_POST["idcurso"])? limpiarCadena($_POST["idcurso"]):"";


switch($_GET['op']){
    case 'guardaryeditar':
    if(empty($idseccion)){
        $rspta = $seccion->insertar($seccion, $idcurso);
        echo $rspta ? "Seccion registrada" : "Seccion no se pudo registrar";
    }else{
        $rspta = $seccion->editar($idseccion, $seccion, $idcurso);
        echo $rspta ? "Seccion actualizada" : "Seccion no se pudo actualizar";
    }

    break;
    
    case 'eliminar':
    $rspta = $seccion->eliminar($idseccion);
    echo $rspta ? "Seccion eliminada" : "Seccion no se pudo eliminar";
    break;


    case 'mostrar':
    $rspta = $seccion->mostrar($idseccion);
    //Codificar el resultado a JSON
    echo json_encode($rspta);
    break;

    case 'listar':
    $rspta = $seccion->listar();
    //Se declara un arreglo
    $data = array();

    while($reg = $rspta->fetch_object()){
        $data[] = array(
            "0"=>'<button data-toggle="modal" href="#sModal" class="btn btn-warning" onclick="mostrar('.$reg->idseccion.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="eliminar('.$reg->idseccion.')"><i class="fa fa-close"></i></button>',
            "1"=>$reg->seccion,
            "2"=>$reg->aula
              
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