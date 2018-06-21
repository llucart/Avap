                    //--MODALES--
//LLAMADA AL MODAL NUEVO USUARIO
function nuevoUsuario(){
    $('#nuevoUsuario').modal('toggle');
}
//LLAMADA AL MODAL EDITAR PERFIL
function editUsuario(index) {
    //Modal edit
    $('#editUsuario').modal('toggle');

    //Nodos tabla
    var id_new_usuario = index.parentNode.parentNode.cells[0].textContent;
    var new_cuenta = index.parentNode.parentNode.cells[1].textContent;

    //Pego en el formulario
    document.getElementById('id_new_usuario').value = id_new_usuario;
    document.getElementById('new_cuenta').value = new_cuenta;
}
                //--METODOS--
//CONFIRMAR CONTRASEÑA
$('#formNuevoUsuario').submit(function(e){
    e.preventDefault();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var cuenta = $('#cuenta').val();
    var clave1 = $('#clave').val();
    var clave2 = $('#confirmaclave').val();
    var rol = $('#rol').val();rol

    if(clave1 == clave2){
        agregar(nombre, apellido, cuenta, clave2, rol);
    }else{
        $('#confirmaclave').css("background", "yellow");
        
        setTimeout(function(){
            $('#confirmaclave').css("background", "white");
            $('#confirmaclave').val("");
            $('#confirmaclave').attr("placeholder", "No coinciden las claves! Vuelve a intentar");
            $('#confirmaclave').focus();
        }, 2000)
    }
});
//METODO DE BUSQUEDA DE USUARIO
$("#searchUsuario").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaUsuario tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

                    //FUNCIONES
//valida si las claves son iguales
 $('#formNuevoUsuario').submit(function(e){
    e.preventDefault();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var cuenta = $('#cuenta').val();
    var clave1 = $('#clave').val();
    var clave2 = $('#confirmaclave').val();
    var rol = $('#rol').val();


    if(clave1 == clave2){
        agregar(nombre, apellido, cuenta, clave2, rol);
    }else{
        $('#confirmaclave').css("background", "yellow");
        
        setTimeout(function(){
            $('#confirmaclave').css("background", "white");
            $('#confirmaclave').val("");
            $('#confirmaclave').attr("placeholder", "No coinciden las claves! Vuelve a intentar");
            $('#confirmaclave').focus();
        }, 2000)
    }
});
//AGREGAR USUARIO
function agregar(nombre, apellido, cuenta, clave2, rol){
    var data = {
        'nombre' : nombre,
        'apellido' : apellido,
        'cuenta' : cuenta, 
        'clave' : clave2,
        'rol' : rol
    };
    //Al menos una mayuscula, minuscula, caracter especial, numericos, mainimo 8 maximo 15
    if($('#clave').val().match(/^(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*?&-/.,;:_¡=])([a-z\d$@$!%*?&-/.,;:_¡=]|[^ ]){8,15}$/)){
        $.ajax({
            url: "../controllers/usuario/addUsuario.php",
            type: "post",
            data: data,
            success: function (data) {
                if(data == 1){
                    console.log(data); 
                   $('#cuenta').val('');
                   $('#cuenta').css("background", "yellow");
                   $('#cuenta').attr("placeholder", 'Error esta cuenta ya existe!');
                   
                   setTimeout(function(){
                        $('#cuenta').focus();
                        $('#cuenta').css("background", "white");
                   }, 3000);
                }
                else if (data != 1){
                    swal("LISTO","LA CUENTA FUE AGREGADA","success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000)
                    
                }
                else{
                    swal("ERROR!","NO SE AGREGO","error");
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000)
                }              
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }

        });
    }
}
//ELIMINAR USUARIO
function delUsuario(index) {
    var tabla = document.getElementById('tablaUsuario');
    var tr = index.parentNode.parentNode.rowIndex;
    //Nodos tabla
    var id = index.parentNode.parentNode.cells[0].textContent;
    var cuenta = index.parentNode.parentNode.cells[3].textContent;

    swal({
        title: `ESTAS SEGURO EN ELIMINAR AL USUARIO ${cuenta}?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "CONFIRMAR",
        cancelButtonText: "CANCELAR",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function(){
        confirmarEliminacion(id);
        tabla.deleteRow(tr);
        setTimeout(function(){
            swal("Eliminado! " + cuenta);
        }, 500);

    });
        
}
//CONFIRMAR ELIMINACION
function confirmarEliminacion(id){
    $.ajax({
        url: "../controllers/usuario/delUsuario.php",
        type: "post",
        data: {
            'id_usuario': id
        },
        success: function (data) {          
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}
//PARA INGRESAR EN TEXTO SOLO LETRAS
function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }
        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
}
//VALIDA CLAVE EN TIEMPO REAL
 $('#clave').keyup(function(){
    console.log($(this).val());
    if($(this).val().match(/^(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*?&-/.,;:_¡=])([a-zA-Z\d$@$!%*?&-/.,;:_¡=]|[^ ]){8,15}$/)){
        console.log('Correcto!');
        $(this).css("border", "1px solid green");
    }else{
        console.log('Vas mal!');
        $(this).css("border", "1px solid red");
    }
 });
 $('#confirmaclave').keyup(function(){
    console.log($(this).val());
     if($(this).val().match(/^(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*?&-/.,;:_¡=])([a-zA-Z\d$@$!%*?&-/.,;:_¡=]|[^ ]){8,15}$/)){

        if($(this).val() == $('#clave').val()){
            console.log('Correcto!');
            $(this).css("border", "1px solid green");
        }else{
            console.log('Vas mal!');
            $(this).css("border", "1px solid red");
        }
     }
    else{
        console.log('Vas mal!');
        $(this).css("border", "1px solid red");
        }
});

function numeroyletras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " abcdefghijklmnñopqrstuvwxyz1234567890";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }