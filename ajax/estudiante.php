<?php 
require_once "../modelos/Estudiante.php";



$estudiante = new Estudiante();
$idestudiante =isset($_POST["idestudiante"])? limpiarCadena($_POST["idestudiante"]):"";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido = isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$fecha_nac = isset($_POST["fecha_nac"])? limpiarCadena($_POST["fecha_nac"]):"";
$curso = isset($_POST["idcurso"])? limpiarCadena($_POST["idcurso"]):"";
$seccion = isset($_POST["idseccion"])? limpiarCadena($_POST["idseccion"]):"";


switch($_GET['op']){
    case 'guardaryeditar':
    if(empty($idestudiante)){
        $rspta = $estudiante->insertar($nombre, $apellido, $fecha_nac, $curso, $seccion);
        echo $rspta ? "Estudiante registrado" : "Estudiante no se pudo registrar";
    }else{
        $rspta = $estudiante->editar($idestudiante, $nombre, $apellido, $fecha_nac, $curso, $seccion);
        echo $rspta ? "Estudiante actualizado" : "Estudiante no se pudo actualizar";
    }

    break;
    
    case 'desactivar':
    $rspta = $estudiante->desactivar($idestudiante);
    echo $rspta ? "Estudiante no activo" : "Estudiante no se pudo desactivar";
    break;

    case 'activar':
    $rspta = $estudiante->activar($idestudiante);
    echo $rspta ? "Estudiante activo" : "Estudiante no se pudo activar";
    break;


    case 'mostrar':
    $rspta = $estudiante->mostrar($idestudiante);
    //Codificar el resultado a JSON
    echo json_encode($rspta);
    break;

    case 'listar':
    $rspta = $estudiante->listar();
    //Se declara un arreglo
    $data = array();

    while($reg = $rspta->fetch_object()){
        $data[] = array(
            "0"=>($reg->activo)?'<button data-toggle="modal" href="#myModal" class="btn btn-warning" onclick="mostrar('.$reg->idestudiante.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-danger" onclick="desactivar('.$reg->idestudiante.')"><i class="fa fa-close"></i></button>':
            '<button data-toggle="modal" href="#myModal" class="btn btn-warning" onclick="mostrar('.$reg->idestudiante.')"><i class="fa fa-pencil"></i></button>'.
            ' <button class="btn btn-primary" onclick="activar('.$reg->idestudiante.')"><i class="fa fa-check"></i></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->apellido,
            "3"=>$reg->fecha_nac,
            "4"=>$reg->aula.'-'.$reg->locacion,
            "5"=>$reg->seccion,
            "6"=>($reg->activo)?'<span class="alert alert-success">Activo</span>': '<span class="alert alert-danger">No activo</span>'    
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


    case "selectcurso": 
        $rspta = $estudiante->selectCurso();

        while($reg = $rspta->fetch_object()){
            echo '<option value='.$reg->idcurso.'>'.$reg->locacion.'-'.$reg->aula.'</option>';
        }

    break;

    case "selectseccion": 
        $rspta = $estudiante->selectSeccion();

        while($reg = $rspta->fetch_object()){
            echo '<option value='.$reg->idseccion.'>'.$reg->seccion.'</option>';
        }

    break;
}





?>