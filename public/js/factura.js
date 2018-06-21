//LLAMA AL MODAL NUEVO
function nuevaFactura(){
    $('#nuevaFactura').modal('toggle');
}
//LLAMADA AL MODAL PAGAR
function pagarFactura(id){
    $('#pagarFactura').modal('toggle');
    $('#id_pagarfactura').val(id);
}
//GUARDAR PAGO
$('#btnpagar').click(function(e){
    e.preventDefault();
    pagar();
});
//AJAX PARA PAGAR
function pagar(){
    $.ajax({
        url: "../controllers/facturas/pagarFactura.php",
        type: "post",
        data: {
            'id_factura': $('#id_pagarfactura').val(),
            'estado': $('#estado_factura').val(),
            'fecha': $('#fechaPago').val()
        },
        success: function (data) {
           console.log(data);
           swal("LISTO","FACTURA PAGADA","success");
           $('#pagarFactura').modal('toggle');
           setTimeout(function(){
                        window.location.reload(); 
                    }, 3000)           
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });
}
//LLAMADA AL MODAL EDITAR
function editarFactura(index, cliente,estado) {
    //Modal edit
    $('#editFactura').modal('toggle');
    
    //Nodos tabla
    var id_new_factura = index.parentNode.parentNode.cells[0].textContent;
    var id_new_cliente = index.parentNode.parentNode.cells[2].textContent;
    var new_ordenCompra = index.parentNode.parentNode.cells[3].textContent;
    var new_poliza = index.parentNode.parentNode.cells[4].textContent;
    var new_siniestro = index.parentNode.parentNode.cells[5].textContent;
    var new_fecha = index.parentNode.parentNode.cells[8].textContent;
    var new_factura_estado = index.parentNode.parentNode.cells[9].textContent;
    //Pego en el formulario
    document.getElementById('id_new_factura').value = id_new_factura;
    document.getElementById('new_fecha').value = new_fecha;
    document.getElementById('new_ordenCompra').value = new_ordenCompra;
    document.getElementById('new_poliza').value = new_poliza;
    document.getElementById('new_siniestro').value = new_siniestro;
    document.getElementById('id_new_cliente').options[0].innerHTML = 'Cliente Actual |' + id_new_cliente;
    document.getElementById('id_new_cliente').options[0].value = cliente;
    document.getElementById('new_factura_estado').options[0].innerHTML = 'Estado Actual |' + new_factura_estado;
    document.getElementById('new_factura_estado').options[0].value = estado;
}
//LLAMADA AL MODAL ELIMINAR
function delFactura(index) {
    var tabla = document.getElementById('tablaFacturas');
    var tr = index.parentNode.parentNode.rowIndex;
    //Nodos tabla
    var id = index.parentNode.parentNode.cells[0].textContent;

   
    var confirmacion = confirm(`Seguro eliminar la factura ${id}`);
        if(confirmacion){
            window.location = "../controllers/facturas/delFactura?id="+id;
             tabla.deleteRow(tr);
        }
}
//CHECK PARA MOTRAR CAMPOS DE VEHICULO EN FACTURA
$("#checkbox_vehiculo").click(function(){
    $('#mostrar_vehiculo').toggleClass("mostrar_vehiculo");
});
//CHECK PARA MOTRAR CAMPOS DE NOTA DE ENTREGA EN FACTURA
$("#checkbox_nota").click(function(){
    $('#mostrar_notas').toggleClass("mostrar_notas");
});
//FILTRO PARA BUSQUEDA EN FACTURA
$("#searchFactura").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaFactura tr").filter(function() {
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
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true;
        else if (tecla==0||tecla==9)  return true;
       // patron =/[0-9\s]/;// -> solo letras
        patron =/[0-9\s]/;// -> solo numeros
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }

function LetrasyNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz123456789";
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
function placa(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz123456789-";
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