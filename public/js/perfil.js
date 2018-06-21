//Llama modal para editar
function editarPerfil(index) {
    //Modal edit
    $('#editarPerfil').modal('toggle');

    //Nodos tabla
    var id_new_perfil = index.parentNode.parentNode.cells[0].textContent;
    var new_cuenta = index.parentNode.parentNode.cells[1].textContent;

    //Pego en el formulario
    document.getElementById('id_new_perfil').value = id_new_perfil;
    document.getElementById('new_cuenta').value = new_cuenta;
}

//confirma si claves coinciden
$('#formEditUsuario').submit(function(e){
	e.preventDefault();
	var id = $('#id_new_perfil').val();
	var cuenta = $('#new_cuenta').val();
	var clave1 = $('#new_clave').val();
	var clave2 = $('#new_clave_confirm').val();

	if(clave1 == clave2){
		editar(id, cuenta, clave2);
	}else{
		$('#new_clave_confirm').css("background", "yellow");
		
		setTimeout(function(){
			$('#new_clave_confirm').css("background", "white");
			$('#new_clave_confirm').val("");
			$('#new_clave_confirm').attr("placeholder", "No coinciden las claves! Vuelve a intentar");
			$('#new_clave_confirm').focus();
		}, 2000)
	}
});

function editar(id, cuenta, clave2){
    var data = {
        'id_new_perfil' : id,
        'new_cuenta' : cuenta, //Clientes
        'new_clave' : clave2,
    };
    $.ajax({
        url: "../controllers/usuario/editPerfil.php",
        type: "post",
        data: data,
        success: function (data) {
                if (data != 1){
                    swal("LISTO","SE CAMBIO LA CONTRASEÑA","success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000)
                    
                }
                else{
                    swal("ERROR!","NO SE REALIZARON CAMBIOS","error");
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
 $('#new_clave').keyup(function(){
    console.log($(this).val());
    if($(this).val().match(/^(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*?&-/.,;:_¡=])([a-z\d$@$!%*?&-/.,;:_¡=]|[^ ]){8,15}$/)){
        console.log('Correcto!');
        $(this).css("border", "1px solid green");
    }else{
        console.log('Vas mal!');
        $(this).css("border", "1px solid red");
    }
 });
 $('#new_clave_confirm').keyup(function(){
    console.log($(this).val());
     if($(this).val().match(/^(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*?&-/.,;:_¡=])([a-z\d$@$!%*?&-/.,;:_¡=]|[^ ]){8,15}$/)){

        if($(this).val() == $('#new_clave').val()){
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