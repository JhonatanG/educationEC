/*=============================================
AGREGAR PARALELO Y GRADO A MATRICULA
=============================================*/
let contador = 0;
$(document).on("click", ".btnGparalelo", function () {
  contador ++ ;
if(contador>1){
  Swal.fire({
    title: 'Solo se puede seleccionar un grado!',
    icon: 'error',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar'
  });
}else{
    var id = $(this).attr("idGparalelo");
    //alert(id);
//document.getElementById('agregar').disabled=true;
$(this).removeClass("btn-info btnGparalelo");
 $(this).addClass("btn-default");
    // DESHABILITAR TODOS LOS BOTONES CUANDO SELECCIONE UNO
 // var boton = document.getElementsByClassName("btn-info");

  /*  for (var i = 0; i<=boton.length; i++) {
      //  alert(i);
       boton[i].classList.remove("btn-info");
        boton[i].classList.remove("btnGparalelo");
       boton[i].classList.add("btn-default");
    }*/


     var idGparalelo = $(this).attr("idGparalelo");
     var datos = new FormData();
     datos.append("idGparalelo",idGparalelo);
   
     $.ajax({
         url:"../ajax/matricula.ajax.php",
         method:"POST",
         data: datos,
         cache: false,
         contentType:false,
         processData:false,
         dataType: "json",
         success: function(respuesta){
           var grado = respuesta["grado"];
           var cupo = respuesta["cupos"];
         //  var id = respuesta["id"];
        // alert(cupo);
       if(cupo == 0){
          Swal.fire({
            title: 'No hay cupos disponibles!',
            icon: 'error',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar'
          });
          contador=0;
         }else{ 


           $(".nuevoGrado").append(
             ' <!-- GRADO-->'+
             '<div class="input-group">'+

                ' <div class="input-group">'+

  '<span class="input-group-text"><button type="button" class="btn btn-danger btn-xs quitarGrado" idGparaleloM="'+id+'"><i class="fa fa-times"></i></button></span>'+

'<input type="text" class="form-control" id="" name="" value="'+grado+'" readonly>'+
'<input type="hidden" class="form-control" id="nuevoGrado" name="nuevoGrado" value="'+id+'" readonly>'+
                 '</div>'+

             '</div>')
           }
         }
   
   
     });
    }
});
/*=============================================
QUITAR PARALELO Y GRADO A MATRICULA
=============================================*/
$(document).on("click", ".quitarGrado", function () {
  contador = 0 ;
  $(this).parent().parent().remove();
  var idGparaleloM = $(this).attr("idGparaleloM");
 
  document.getElementById('agregar').enabled=true;
  $("button.recuperarBoton[idGparalelo='"+idGparaleloM+"']").removeClass('btn-default');
  $("button.recuperarBoton[idGparalelo='"+idGparaleloM+"']").addClass('btn-info btnGparalelo');
});
/*=============================================
ELIMINAR INFORMACION
=============================================*/
$(document).on("click", ".btnEliminarMatricula", function () {
  var idMatricula = $(this).attr("idMatricula");
  Swal.fire({
    title: '¿Está seguro de borrar la matrícula',
    text: "¡Si no lo está puede cancelar la acción!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar!'
  }).then(function (result) {

    if (result.value) {

      window.location = "../index.php?ruta=listaMatricula&idMatricula=" + idMatricula;

    }

  })


});

/*=============================================
EDITAR INFORMACION
=============================================*/
$(document).on("click",".btnEditarMatricula", function(){
  var idMatricula = $(this).attr("idMatricula");
  var datos = new FormData();
  datos.append("idMatricula",idMatricula);

  $.ajax({
      url:"../ajax/detalleMatricula.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType:false,
      processData:false,
      dataType: "json",
      success: function(respuesta){
       //alert(respuesta);
          $("#editarMatricula").val(respuesta["id"]);
          $("#editarObservacion").val(respuesta["observacion"]);
      }


  });
});
