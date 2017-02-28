/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function () {
    $("#frmRestablecer").submit(function (event) {
        event.preventDefault();
        //Creamos un FormData con los datos del mismo formulario
        var formData = new FormData(document.getElementById("frmRestablecer"));

        $.ajax({
            url: '../controles/validarmail.php',
            type: 'post',
            data: formData,
            //Deshabilitamos el caché
            cache: false,
            //No especificamos el contentType
            contentType: false,
            //No permitimos que los datos pasen como un objeto
            processData: false
        }).done(function (respuesta) {
            console.log(respuesta);
            $("#mensaje").html(respuesta);
            $("#email").val('');
        })
         .fail(function () {
                    alert("error");
          })

                ;
    });
});
