<?php
//Incluir inicialmente la conexion de la BD
require "../config/Conexion.php";


class Estudiante
{
    public function __construct(){

    }


    //Funcion para insertar
    public function insertar($nombre, $apellido, $fecha_nac, $curso, $seccion){
        $sql ="INSERT INTO estudiante (nombre, apellido, fecha_nac, idcurso, idseccion, activo)
        VALUES('$nombre', '$apellido', '$fecha_nac', '$curso', '$seccion','1')";
        return ejecutarConsulta($sql);
    }
    //Funcion para editar
    public function editar($idestudiante, $nombre, $apellido, $fecha_nac, $curso, $seccion){
        $sql ="UPDATE estudiante SET nombre='$nombre', apellido='$apellido', fecha_nac='$fecha_nac', idcurso='$curso',
        idseccion='$seccion' WHERE idestudiante = '$idestudiante'";
        return ejecutarConsulta($sql);
    }
    //Funcion para desactivar los estudiantes
    public function desactivar($idestudiante){
        $sql = "UPDATE estudiante SET activo='0' WHERE idestudiante = '$idestudiante'";
        return ejecutarConsulta($sql);
    }

    //Funcion para desactivar los estudiantes
    public function activar($idestudiante){
        $sql = "UPDATE estudiante SET activo='1' WHERE idestudiante = '$idestudiante'";
        return ejecutarConsulta($sql);
    }

    //Funcion para mostrar el registro a editar
    public function mostrar($idestudiante){
        $sql = "SELECT * FROM estudiante WHERE idestudiante = '$idestudiante'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //Funcion para listar los registros
    public function listar(){
        $sql = "SELECT e.idestudiante, e.idcurso, e.idseccion,e.nombre,e.apellido, e.fecha_nac, e.activo, c.aula, c.locacion, s.seccion 
        FROM estudiante e INNER JOIN curso c ON e.idcurso = c.idcurso INNER JOIN seccion s ON e.idseccion = s.idseccion ";
        return ejecutarConsulta($sql);
    }

    //Funcion para el select
    public function selectCurso(){
        $sql ="SELECT * FROM curso";
        return ejecutarConsulta($sql);
    }
    //Funcion para el select
    public function selectSeccion(){
        $sql ="SELECT * FROM seccion";
        return ejecutarConsulta($sql);
    }


    
}










?>