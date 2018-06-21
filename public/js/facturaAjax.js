var Repuesto = [];

function respuestoArray(repuesto){
    Repuesto.push(repuesto);
}

function selectRepuesto(){
    $('#selectRepuesto').modal('toggle');
}

//Calculo IVA
$('#iva').keyup(function(){
    //var precio_unitarioXcantidad = $('#precio_unitario').val() * $('#cantidad').val();
    var subtotal = $('#sub_total').val();
    var iva = subtotal * $(this).val() / 100;
    //var total = precio_unitarioXcantidad + iva;
    console.log(iva);
    var total = parseFloat(iva) + parseFloat(subtotal);
        $('#total').val(parseFloat(total).toFixed(2));
    //$('#total').val(total);
})

//ajax
function validarFactura(){
    var fecha =  $('#fecha').val();
    var cliente = $('#cliente').val();
    var estado = $('#estado').val();
    var tbody = $('#tabla > tbody > .suma').length;
    var iva = $('#iva').val();

    if(fecha == ''){
         $('#fecha').css("background", "yellow");
    }
    if(cliente == ''){
         $('#cliente').css("background", "yellow");
    }
    if(estado == '' || estado == 0){
         $('#estado').css("background", "yellow");
    }    
    if(tbody == ''){
         $('#tabla > thead').css("background", "yellow");
    }    
    if(iva == '' || iva == 0){
         $('#iva').css("background", "yellow");
    }
    if(fecha != '' && cliente != '' && estado != '' && tbody != 0 && iva != ''){
        creaFactura();
    }

}
function creaFactura(){
    //Calculo iva
        var subtotal = $('#sub_total').val();
        var iva = subtotal * $('#iva').val() / 100;
        var total = parseFloat(iva) + parseFloat(subtotal);
    var data = {
        'fecha' : $('#fecha').val(),
        'cliente' : $('#cliente').val(), //Clientes
        'ordenCompra' : $('#ordenCompra').val(),
        'n_poliza' : $('#no_poliza').val(),
        'n_siniestro' : $('#no_siniestro').val(),

        'marca' : $('#marca').val(),
        'modelo' : $('#modelo').val(),
        'anio' : $('#anio').val(),
        'placa' : $('#placa').val(), //Vehiculos

        'codigo' : $('#codigo').val(),//Nota entrega
        'empresa_envio' : $('#empresa_envio').val(),     
        'guia' : $('#guia').val(),    
        'costo_envio' : $('#costo_envio').val(),    
        'estado_nota' : $('#estado_nota').val(),    
        'fecha_envio' : $('#fecha_envio').val(),

        'repuesto': Repuesto,//Repuesto
        'iva' : parseFloat(iva).toFixed(2),
        'total' : parseFloat(total).toFixed(2),
        'estado' : $('#estado').val(),
   
    };

    console.log(data);

    $.ajax({
        url: "../controllers/facturas/addFactura.php",
        type: "post",
        data: data,
        success: function (data) {
           console.log(data); 
           swal("LISTO","FACTURA GENERADA","success");
           setTimeout(function(){
                        window.location = '../pages/facturas';
                    }, 1000)
                                    
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });
}

//Insertar repuesto en la Tabla
function addRepuesto(index){
            var idRepuesto = index.parentNode.parentNode.cells[0].textContent;
            var repuesto = index.parentNode.parentNode.cells[2].textContent;
            var precio_unitario = index.parentNode.parentNode.cells[3].textContent;
            var stock = index.parentNode.parentNode.cells[5].textContent;
            var cantidad = index.parentNode.parentNode.cells[5].lastChild.value;
            var botonAdd = index.parentNode.parentNode.cells[6].childNodes[1];
            var botonQuitar = index.parentNode.parentNode.cells[6].childNodes[2];

            console.log(botonQuitar);

        if(cantidad != ''){
            //if($('input[type=button]:checked').length >= 1){
                var tbody = $('#tabla > tbody #aqui'); //.item-row:last
                var monto = parseFloat(precio_unitario) * parseFloat(cantidad);

                tbody.before('\
                    <tr class="suma">\
                      <td><input type="hidden" id="'+idRepuesto+'" value="'+idRepuesto+'"/><input type="text" class="form-control" readonly="off" value="'+ repuesto +'"/></td>\
                      <td><input type="text" class="form-control" readonly="off" value="'+ precio_unitario +'"/></td>\
                      <td><input type="text" class="form-control" readonly="off" value="'+ cantidad +'"/></td>\
                      <td>\
                        <div class="row">\
                            <div class="col-xs-12 col-sm-12 col-md-12">\
                                <input type="number" class="form-control monto" readonly="off" value="'+ monto +'"/>\
                            </div>\
                        </div>\
                      </td>\
                      </tr>\
                  ');

                botonAdd.setAttribute('disabled', 'on');
                index.parentNode.parentNode.style.backgroundColor = "yellow";

                var subTotalCal = precio_unitario * cantidad;
                subTotal(subTotalCal, index);

                //Enviar repuesto
                var repuesto = {
                    'Id':idRepuesto,
                    'Cantidad':cantidad
                };
                respuestoArray(repuesto);
            //}
        }
}

//Quitar Repuesto
function quitar(index, id){
    index.parentNode.parentNode.style.backgroundColor = "white";
    var botonAdd = index.parentNode.parentNode.cells[6].childNodes[1];
    botonAdd.removeAttribute('disabled'); 
    $(`#${id}`).closest('tr').remove();


    var precio_unitario = index.parentNode.parentNode.cells[4].textContent;
    var cantidad = index.parentNode.parentNode.cells[6].textContent;
    var subTotalCal = parseFloat(precio_unitario)*parseFloat(cantidad);
    subTotal(subTotalCal,id);
}

//Calcular subTotal
function subTotal(calculo, index){
    var totalOk = 0;
    $('.monto').each(function(){
       if(!isNaN(this.value) && this.value.length != 0){
            totalOk += parseFloat(this.value);
       }
    });

    $('#sub_total').val(totalOk.toFixed(2));      
}

//Impedir insertar manualmente la cantidad
    $('.key').keypress(function(event){
        if(event.which){
            event.preventDefault();
        }
    })

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

function limpiaIva(){
    var val= document.getElementById("iva").value
    var tam= val.length;
        for (i = 0; i < tam; i++) {
            if (isNaN(val[i])) {
                document.getElementById("iva").value='';
            }
        
        }
}