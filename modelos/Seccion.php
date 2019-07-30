<?php
//Incluir inicialmente la conexion de la BD
require "../config/Conexion.php";


class Seccion
{
    public function __construct(){

    }


    //Funcion para insertar
    public function insertar ($seccion, $idcurso){
        $sql ="INSERT INTO curso (seccion, curso)
        VALUES('$seccion', '$idcurso')";
        return ejecutarConsulta($sql);
    }
    //Funcion para editar
    public function editar($idseccion, $seccion, $idcurso){
        $sql ="UPDATE seccion SET seccion='$seccion', curso='$idcurso'
        WHERE idseccion = '$idseccion'";
        return ejecutarConsulta($sql);
    }
    //Funcion para desactivar los cursos
    public function eliminar($idseccion){
        $sql = "DELETE FROM seccion WHERE idseccion = '$idseccion'";
        return ejecutarConsulta($sql);
    }

 
    //Funcion para mostrar el registro a editar
    public function mostrar($idseccion){
        $sql = "SELECT * FROM seccion WHERE idseccion = '$idseccion'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //Funcion para listar los registros
    public function listar(){
        $sql = "SELECT s.idseccion, s.seccion, c.idcurso, c.aula 
        FROM seccion s INNER JOIN curso c ON s.curso = c.idcurso";
        return ejecutarConsulta($sql);
    }


  

    
}










?>