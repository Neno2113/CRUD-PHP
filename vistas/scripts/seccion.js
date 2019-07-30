var tabla;

function init(){
    

    listar();

    $("#formulario").on("submit", function(e){
        guardaryeditar(e);
    })


    $.post("../ajax/estudiante.php?op=selectcurso", function(r){
        $("#idcurso").html(r);
        $("#idcurso").selectpicker('refresh');
    });
}


//Funcio para limpiar
function limpiar(){
    $("#idseccion").val("");
    $("#seccion").val("");
    $("#idcurso").val("");  

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
            url: '../ajax/seccion.php?op=listar',
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
    // $("#btnGuardar").prop("disabled", true);
    var formdata = new FormData($("#formulario")[0]);


    $.ajax({
        url: "../ajax/seccion.php?op=guardaryeditar",
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
function mostrar(idseccion){
    $.post("../ajax/seccion.php?op=mostrar", {idseccion : idseccion}, function(data, ){
        data = JSON.parse(data);
        
        $("#seccion").val(data.seccion);
        $("#idcurso").val(data.idcurso);
        $("#idcurso").selectpicker('refresh');
        $("#idseccion").val(data.idseccion);
        
    })
}


//Funcion para desactivar un registro
function eliminar(idseccion){
    bootbox.confirm("Esta seguro de eliminar esta seccion?", function(result){
        if(result){
            $.post("../ajax/seccion.php?op=eliminar",{idseccion: idseccion}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();
