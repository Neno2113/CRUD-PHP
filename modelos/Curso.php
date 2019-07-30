<?php
//Incluir inicialmente la conexion de la BD
require "../config/Conexion.php";


class Curso
{
    public function __construct(){

    }


    //Funcion para insertar
    public function insertar($locacion, $aula, $seccion){
        $sql ="INSERT INTO curso (locacion, aula , seccion)
        VALUES('$locacion', '$aula', '$seccion')";
        return ejecutarConsulta($sql);
    }
    //Funcion para editar
    public function editar($idcurso, $locacion, $aula, $seccion){
        $sql ="UPDATE curso SET locacion='$locacion', aula='$aula', seccion='$seccion'
        WHERE idcurso = '$idcurso'";
        return ejecutarConsulta($sql);
    }
    //Funcion para desactivar los cursos
    public function eliminar($idcurso){
        $sql = "DELETE FROM curso WHERE idcurso = '$idcurso'";
        return ejecutarConsulta($sql);
    }

 
    //Funcion para mostrar el registro a editar
    public function mostrar($idcurso){
        $sql = "SELECT * FROM curso WHERE idcurso = '$idcurso'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //Funcion para listar los registros
    public function listar(){
        $sql = "SELECT c.idcurso, c.aula, c.locacion, c.seccion, s.seccion 
        FROM curso c INNER JOIN seccion s ON c.seccion = s.idseccion";
        return ejecutarConsulta($sql);
    }


   

    
}










?>