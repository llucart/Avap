//Alicuotas
//LLAMADA AL MODAL NUEVO
function nuevoRepuesto(){
    $('#nuevoRepuesto').modal('toggle');
}
//LLAMADA AL MODAL EDITAR
function editarRepuesto(index, repuesto) {
    //MODAL EDITAR
    $('#editRepuesto').modal('toggle');
    //NODOS DE TABLAS
    var id_repuesto = index.parentNode.parentNode.cells[0].textContent;
    var new_tipo = index.parentNode.parentNode.cells[1].textContent;
    var new_descripcion = index.parentNode.parentNode.cells[2].textContent;
    var new_detalle = index.parentNode.parentNode.cells[3].textContent;
    var new_precio_unitario = index.parentNode.parentNode.cells[4].textContent;
    var new_stock = index.parentNode.parentNode.cells[5].textContent;
    //PARA EL FORMULARIO
    document.getElementById('id_repuesto').value = id_repuesto;
    document.getElementById('new_descripcion').value = new_descripcion;
    document.getElementById('new_detalle').value = new_detalle;
    document.getElementById('new_tipo').options[0].innerHTML = 'Tipo Actual |' + new_tipo;
    document.getElementById('new_tipo').options[0].value = repuesto;
    document.getElementById('new_precio_unitario').value = new_precio_unitario;
    document.getElementById('new_stock').value = new_stock;
}

//Elimina el registro
function delRepuesto(index) {
    var tabla = document.getElementById('tablaRepuesto');
    var tr = index.parentNode.parentNode.rowIndex;
    //Nodos tabla
    var id = index.parentNode.parentNode.cells[0].textContent;
    var confirmacion = confirm(`Seguro eliminar el repuesto ${id}`);
        if(confirmacion){
            window.location = "../controllers/almacen/delAlmacen?id="+id;
             tabla.deleteRow(tr);
        }
}

//FILTRO PARA BUSCAR
$("#searchRepuesto").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaRepuesto tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

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