
function init(){
    

    listar();

    $("#formulario").on("submit", function(e){
        guardaryeditar(e);
    })


    $.post("../ajax/estudiante.php?op=selectseccion", function(r){
        $("#idseccion").html(r);
        $("#idseccion").selectpicker('refresh');
    });
}


//Funcio para limpiar
function limpiar(){
    $("#idcurso").val("");
    $("#locacion").val("");
    $("#aula").val("");  
    $("#idseccion").val("");

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
            url: '../ajax/curso.php?op=listar',
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
        url: "../ajax/curso.php?op=guardaryeditar",
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
function mostrar(idcurso){
    $.post("../ajax/curso.php?op=mostrar", {idcurso : idcurso}, function(data, ){
        data = JSON.parse(data);
        
        $("#locacion").val(data.locacion);
        $("#aula").val(data.aula);
        $("#idseccion").val(data.idseccion);
        $("#idseccion").selectpicker('refresh');
        $("#idcurso").val(data.idcurso);
        
    })
}


//Funcion para desactivar un registro
function eliminar(idcurso){
    bootbox.confirm("Esta seguro de eliminar este curso", function(result){
        if(result){
            $.post("../ajax/curso.php?op=eliminar",{idcurso: idcurso}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();
