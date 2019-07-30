var tabla;


//Funcion que se ejecuta al inicio 
//ESTUDIANTE

function init(){
    listar();

    listarCurso();

    $("#formulario").on("submit", function(e){
        guardaryeditar(e);
    })

    $.post("../ajax/estudiante.php?op=selectcurso", function(r){
        $("#idcurso").html(r);
        $("#idcurso").selectpicker('refresh');
    });

    $.post("../ajax/estudiante.php?op=selectseccion", function(r){
        $("#idseccion").html(r);
        $("#idseccion").selectpicker('refresh');
    });
}


//Funcio para limpiar
function limpiar(){
    $("#idestudiante").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#fecha_nac").val();
    $("#idcurso").val("");
    $("#idseccion").val("");
    $("#titulo").text("Agregar Estudiantes");
}

//Funcion para listar
function listar(){
    tabla = $("#tbllistado").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax":{
            url: '../ajax/estudiante.php?op=listar',
            type: "get",
            datatype: "json",
            error: function(e){
                console.log(e.responseText);
            },
            "bDestroy": true,
            "iDisplayLength": 10,
            "order": [[0, "desc"]]
        }
    }).DataTable();
    $("#tbllistado").show();
}


//Funcion para guardar y editar

function guardaryeditar(e){
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formdata = new FormData($("#formulario")[0]);


    $.ajax({
        url: "../ajax/estudiante.php?op=guardaryeditar",
        type: "POST",
        data: formdata,
        contentType: false,
        processData: false,

        success: function(datos){
            bootbox.alert(datos);
            tabla.ajax.reload();
        }
    });

    limpiar();
}

//Funcion para Mostrar registro a editar
function mostrar(idestudiante){
    $.post("../ajax/estudiante.php?op=mostrar", {idestudiante : idestudiante}, function(data, ){
        data = JSON.parse(data);
        
        $("#nombre").val(data.nombre);
        $("#apellido").val(data.apellido);
        $("#fecha_nac").val(data.fecha_nac);
        $("#idcurso").val(data.idcurso);
        $("#idcurso").selectpicker('refresh');
        $("#idseccion").val(data.idseccion);
        $("#idseccion").selectpicker('refresh');
        $("#idestudiante").val(data.idestudiante);
        $("#titulo").text("Editar Estudiantes");
    })
}


//Funcion para desactivar un registro
function desactivar(idestudiante){
    bootbox.confirm("Esta seguro de desactivar este estudiante", function(result){
        if(result){
            $.post("../ajax/estudiante.php?op=desactivar",{idestudiante: idestudiante}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Funcion para activar un registro
function activar(idestudiante){
    bootbox.confirm("Esta seguro de activar este estudiante", function(result){
        if(result){
            $.post("../ajax/estudiante.php?op=activar",{idestudiante: idestudiante}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}


function ocultar(){
    $("#tbllistado").hide();
}



init();


//--------------------------CURSO------------------------------------//

