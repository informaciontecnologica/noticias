/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var app = angular.module('noticias', []);
app.controller('control', function ($scope, $http, $filter) {
   $scope.a = false;
    $scope.formData = {};
    $scope.aaa = function (valor) {

        if (valor === '1') {
            $scope.b = 'Activo';
            return true;
        } else {
            $scope.b = 'Pasivo';
            return false;
        }
        ;

    };

    $scope.mediciones = [{
            id: '1',
            medicion: 'Indice verde'
        },
        {id:'2', medicion:'Fotosintesis'}
    ];

    $scope.provinciall = function () {
        $http({
            url: '../controles/provincia.php',
            method: "POST"
        }).then(function (response) {
            $scope.provincias = response.data.provincia;
            console.log(response);
        });

    };
    $scope.provinciall();

    $scope.Editar = function (idin, idp) {
        $scope.a = true;
        $scope.filtro = $filter('filter')($scope.noti, {'idnoticia': idin});
        $scope.imagen = '../controles/imagenes/mapas/' + idp + '/' + $scope.filtro[0].imagen;

        $scope.formData.persona = $scope.filtro[0].apellido + ' ' + $scope.filtro[0].nombre;
        $scope.formData.titulo = $scope.filtro[0].titulo;
        $scope.medicion = {id:$scope.filtro[0].idmedicion};
        $scope.formData.encabezado = $scope.filtro[0].encabezado;
        $scope.formData.observacion =$scope.filtro[0].observacion;
        $scope.formData.fecha = new Date($scope.filtro[0].fecha);
        $scope.provincia = {idprovincia: $scope.filtro[0].idprovincia};
        $scope.formData.file ='asasas.jpg';//$scope.filtro[0].file;

        $scope.formData.idnoticia = idin;
        $scope.formData.estado = $scope.filtro[0].estado;
        $scope.formData.idpersona = idp;

        $('#previewing').attr('width', '550px');
        $('#previewing').attr('height', '350px');


    };
    $scope.clickimagen = function (x, y) {

        $('#icon').html('<img style="height: 90%; width: 100%;" src="../controles/imagenes/mapas/' + x + '/' + y + '"/>');
        $('#do').html('<a title="Download mapa" href="../controles/imagenes/mapas/' + x + '/' + y + '" download><span class="\n\
           pull-right btn btn-primary  glyphicon glyphicon-download-alt"></span> </a>');
        
        ima.dialog("open");
    };

    $scope.vista = function (valor) {
//        REgistro NUevo 

        $scope.a = valor;
        $scope.file="";
        $scope.formData = {};
        $scope.formData.fecha = new Date();
        $scope.medicion = {id: '1'};
        $scope.provincia = {idprovincia: '1'};
        $scope.imagen = '../controles/imagenes/noimage.png';
//        $scope.previewing =
        $scope.formData.idnoticia = "Alta";
        console.log($scope.formData.provincia);
        if (valor){
            
        } else {
            $scope.noticia();
        }
            

    };
        
   
    $scope.noticia = function () {
     $http({
            url: '../controles/noticias.php',
            method: "POST"
        }).then(function (response) {
            $scope.noti = response.data.noticias;
            console.log(response);
        },
                function (response) { // optional
                    console.log(response);
                });

    };
    $scope.noticia();
    
    // paginacion de tablas 

    $scope.currentPage = 0;
    $scope.pageSize = 10; // Esta la cantidad de registros que deseamos mostrar por página
    $scope.pages = [];
// 
    $scope.configPages = function () {
        $scope.pages.length = 0;
        var ini = $scope.currentPage - 4;
        var fin = $scope.currentPage + 5;
        if (ini < 1) {
            ini = 1;
            if (Math.ceil($scope.noti.length / $scope.pageSize) > 10)
                fin = 10;
            else
                fin = Math.ceil($scope.noti.length / $scope.pageSize);
        } else {
            if (ini >= Math.ceil($scope.noti.length / $scope.pageSize) - 10) {
                ini = Math.ceil($scope.noti.length / $scope.pageSize) - 10;
                fin = Math.ceil($scope.noti.length / $scope.pageSize);
            }
        }
        if (ini < 1)
            ini = 1;
        for (var i = ini; i <= fin; i++) {
            $scope.pages.push({no: i});
        }
        if ($scope.currentPage >= $scope.pages.length)
            $scope.currentPage = $scope.pages.length - 1;
    };
 
    $scope.setPage = function (index) {
        $scope.currentPage = index - 1;
    };
//    $scope.configPages();
    
 

    

});
        app.filter('startFromGrid', function () {
        return function (input, start) {
            if (!input || !input.length) { return; }
            start = +start;
            return input.slice(start);
        };
    });

$(document).ready(function () {

//  $('#fecha').val(new Date().toDateInputValue());
    $("#p").keyup(function () {
        $.ajax({
            type: "POST",
            url: '../controles/autocompletarpersonas.php',
            data: 'keyword=' + $(this).val(),

            success: function (data) {
                $("#campo").show();
                $("#campo").html(data);
                $("#p").css("background", "#FFF");

            }
        });
    });


    //Formulario de Observaciones
    $("#usuario").on("submit", function (e) {
        //Evitamos que se envíe por defecto
        e.preventDefault();


        //Creamos un FormData con los datos del mismo formulario
        var formData = new FormData(document.getElementById("usuario"));

        //Llamamos a la función AJAX de jQuery
        $.ajax({
            //Definimos la URL del archivo al cual vamos a enviar los datos
            url: "../controles/observaciones.php",
            //Definimos el tipo de método de envío
            type: "POST",
            //Definimos el tipo de datos que vamos a enviar y recibir
            dataType: "HTML",
            //Definimos la información que vamos a enviar
            data: formData,
            //Deshabilitamos el caché
            cache: false,
            //No especificamos el contentType
            contentType: false,
            //No permitimos que los datos pasen como un objeto
            processData: false,
            success: function (data) {
                console.log(data);
                $('#loading').hide();
                $("#message").html(data);
            }

        }).done(function (data) {
            console.log(data);
            ima.dialog('option', 'title', 'Observaciones del usuario');

            ima.dialog({width: 300, height: 200});
            ima.text('Se actualizo con exito');
            ima.on("dialogbeforeclose", function (event, ui) {
                location.reload();
            });
            ima.dialog('open');

            //Cuando recibamos respuesta, la mostramos

        });
    });

    //Cuando el formulario con ID acceso se envíe...
    $("#noticias").on("submit", function (e) {
        //Evitamos que se envíe por defecto
        e.preventDefault();
        $("#message").empty();
        $('#loading').show();
        //Creamos un FormData con los datos del mismo formulario
        var formData = new FormData(document.getElementById("noticias"));

        //Llamamos a la función AJAX de jQuery
        var xhr = $.ajax({
            //Definimos la URL del archivo al cual vamos a enviar los datos
            url: "../controles/upload.php",
            //Definimos el tipo de método de envío
            type: "POST",
            //Definimos el tipo de datos que vamos a enviar y recibir
            dataType: "HTML",
            //Definimos la información que vamos a enviar
            data: formData,
            //Deshabilitamos el caché
            cache: false,
            //No especificamos el contentType
            contentType: false,
            //No permitimos que los datos pasen como un objeto
            processData: false,
            beforeSend: function (jqXHR, settings) {

 
                if (de($('#idpersona').val(), $('#fecha').val())) {
                    
                    jqXHR.abort(event);
                } else {
                    console.log("ddddddddddddddd");
                }
            },
            success: function (data) {

                console.log(data);
                $('#loading').hide();
                $("#message").html(data);
            }

        }).done(function (data) {
            //Cuando recibamos respuesta, la mostramos
            $("#imagen").html(data);
            $("#imagen").slideDown(500);
            ima.dialog('option', 'title', 'Observaciones del usuario');
            ima.dialog({width: 300, height: 200});
            ima.text('Se actualizo con exito');
            ima.on("dialogbeforeclose", function (event, ui) {
                location.reload();
            });
            ima.dialog('open');
            
            
        });

    });

    function de(idpersona, fecha) {
        $.post("../controles/igualdad.php",
                {
                    fecha: fecha,
                    idpersona: idpersona
                },
                function (data) {
                    console.log("1111111111111111111111");
                    if (data) { console.log("verdader"); }
                    return  data;
                });

    }



// Function to preview image after validation
    $(function () {
        $("#file").change(function () {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                $('#previewing').attr('src', 'noimage.png');
                $("#message").html("<p id='error'>Please Select A valid Image File</p>"
                        + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                return false;
            } else
            {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    function imageIsLoaded(e) {
//$("#file").css("color","green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '550px');
        $('#previewing').attr('height', '350px');
    }
    ;

    function imagenborrar(e) {
        $('#previewing').attr('src', '../controles/imagenes/noimage.png');
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
        $('#file').val('');


    }
    $('#cancelar').click(function () {
        imagenborrar(e);
    });


});