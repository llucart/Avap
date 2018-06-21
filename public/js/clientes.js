//Alicuotas
//Llama modal nuevo
function nuevoCliente(){
    $('.error').remove();
    $('#nuevoCliente').modal('toggle');
}

//Llama modal para editar
function editarCliente(index, tipo) {
    //Modal edit
    $('#editCliente').modal('toggle');

    //Nodos tabla
    var id_cliente = index.parentNode.parentNode.cells[0].textContent;
    var new_razon = index.parentNode.parentNode.cells[1].textContent;
    var new_tipo_rif = index.parentNode.parentNode.cells[2].textContent;
    var new_Nrif = index.parentNode.parentNode.cells[3].textContent;
    var new_correo = index.parentNode.parentNode.cells[4].textContent;
    var new_direccion = index.parentNode.parentNode.cells[5].textContent;
    var new_telefono = index.parentNode.parentNode.cells[6].textContent;
   
    //Pego en el formulario
    document.getElementById('id_cliente').value = id_cliente;
    document.getElementById('new_razon').value = new_razon;
    document.getElementById('new_tipo_rif').options[0].innerHTML = 'Tipo Actual | ' + new_tipo_rif;
    document.getElementById('new_tipo_rif').options[0].value = tipo;
    document.getElementById('new_Nrif').value = new_Nrif;
    document.getElementById('new_correo').value = new_correo;
    document.getElementById('new_direccion').value = new_direccion;
    document.getElementById('new_telefono').value = new_telefono;
}

//filtro buscar cliente
$("#searchCliente").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaCliente tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

//INGRESA SOLO LETRAS
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
//CAMPO TEXT INGRESA SOLO NUMEROS
function soloNumero(e) {
        key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890";
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
//INGRESA COMBINADO
function combinado(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890-/.";
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
//FUNCION LIMPIA RIF
function limpiaRif(){
    var val= document.getElementById("Nrif").value
    var tam= val.length;
        for (i = 0; i < tam; i++) {
            if (isNaN(val[i])) {
                document.getElementById("Nrif").value='';
            }
        
        }
}
//FUNCION LIMPIA TELEFONO
function limpiatelf(){
    var val= document.getElementById("telefono").value
    var tam= val.length;
        for (i = 0; i < tam; i++) {
            if (isNaN(val[i])) {
                document.getElementById("telefono").value='';
            }
        }
}
//FUNCION LIMPIA NUEVO RIF
function limpiaNRif(){
    var val= document.getElementById("new_Nrif").value
    var tam= val.length;
        for (i = 0; i < tam; i++) {
            if (isNaN(val[i])) {
                document.getElementById("new_Nrif").value='';
            }
        
        }
}
//FUNCION NUEVO TELEFONO
function limpiaNtelf(){
    var val= document.getElementById("new_telefono").value
    var tam= val.length;
        for (i = 0; i < tam; i++) {
            if (isNaN(val[i])) {
                document.getElementById("new_telefono").value='';
            }
        }
}