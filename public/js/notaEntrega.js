
function entregarRepuesto(id){
    $('#entregarRepuesto').modal('toggle');
    $('#id_entregarRepuesto').val(id);
}

$('#btnentregar').click(function(a){
    a.preventDefault();
    Entregar();
});

function Entregar(){
    $.ajax({
        url: "../controllers/notaEntrega/entregarRepuesto.php",
        type: "post",
        data: {
            'id_nota_entrega': $('#id_entregarRepuesto').val(),
            'estado': $('#estado_nota').val(),
            'fecha': $('#fechaEntrega').val()
        },
        success: function (data) {
           console.log(data); 
           swal("LISTO","REPUESTO ENTREGADO","success"); 
           $('#entregarRepuesto').modal('toggle');
           setTimeout(function(){
                        window.location.reload(); 
                    }, 3000)                
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }

    });
}
//LAMADA AL MODAL PARA EDITAR
function editNotaEntrega(index,estado) {
    //Modal edit
    $('#editNota').modal('toggle');

    //Nodos tabla
    var id_nota_entrega = index.parentNode.parentNode.cells[0].textContent;
    var new_codigo = index.parentNode.parentNode.cells[1].textContent;
    var new_empresa = index.parentNode.parentNode.cells[2].textContent;
    var new_nro_guia = index.parentNode.parentNode.cells[3].textContent;
    var new_costo_envio = index.parentNode.parentNode.cells[4].textContent;
    var new_fecha_envio = index.parentNode.parentNode.cells[5].textContent;
    var new_fecha_entrega = index.parentNode.parentNode.cells[6].textContent;
    var new_estado = index.parentNode.parentNode.cells[7].textContent;

    //Pego en el formulario
    document.getElementById('id_nota_entrega').value = id_nota_entrega;
    document.getElementById('new_codigo').value = new_codigo;
    document.getElementById('new_empresa').value = new_empresa;
    document.getElementById('new_nro_guia').value = new_nro_guia;
    document.getElementById('new_costo_envio').value = new_costo_envio;
    document.getElementById('new_fecha_envio').value = new_fecha_envio;
    document.getElementById('new_fecha_entrega').value = new_fecha_entrega;
    document.getElementById('new_estado').options[0].innerHTML = 'Valor actual |' + new_estado;
    document.getElementById('new_estado').options[0].value = estado;
}

//Filtro
$("#searchNota").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablaNotaEntrega tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

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