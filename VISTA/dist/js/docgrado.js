/*=============================================
=             ACTIVAR DOCGRADO               =
=============================================*/
$(document).on("click", ".btnActivarDocgrado", function () {
    var idDocgrado = $(this).attr("idDocgrado");
    var estadoDocgrado = $(this).attr("estadoDocgrado");
  
    var datos = new FormData();
    datos.append("activarId",  idDocgrado);
    datos.append("activarDocgrado", estadoDocgrado);
    $.ajax({
      url: "../ajax/docgrado.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        //  alert(respuesta)
        if (window.matchMedia("(max-width:767px)").matches) {
  
          Swal.fire({
            title: "Ha sido actualizado",
            type: "success",
            confirmButtonText: "¡Cerrar!"
          }).then(function (result) {
  
            if (result.value) {
  
              window.location = "'.SERVERURL.'madocente/";
  
            }
  
          });
  
  
        }
  
      }
  
    })
    if (estadoDocgrado == 0) {
      $(this).removeClass('btn-success');
      $(this).addClass('btn-danger');
      $(this).html('Inactivo');
      $(this).attr('estadoDocgrado', 1);
    } else {
      $(this).addClass('btn-success');
      $(this).removeClass('btn-danger');
      $(this).html('Activo');
      $(this).attr('estadoDocgrado', 0);
    }
  
  
  });
  /*=============================================
ELIMINAR INFORMACION
=============================================*/
$(document).on("click", ".btnEliminarDocgrado", function () {
    var idDocgrado = $(this).attr("idDocgrado");
    Swal.fire({
      title: '¿Está seguro de borrar la relación docente-grado?',
      text: "¡Si no lo está puede cancelar la acción!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar!'
    }).then(function (result) {
  
      if (result.value) {
  
        window.location = "../index.php?ruta=docgrado&idDocgrado=" + idDocgrado;
  
      }
  
    })
  
  
  });
  /*=============================================
EDITAR INFORMACION Docgrado 
=============================================*/
$(document).on("click",".btnEditarDocgrado", function(){
  var idDocgrado = $(this).attr("idDocgrado");
  var datos = new FormData();
  datos.append("idDocgrado",idDocgrado);

  $.ajax({
      url:"../ajax/docgrado.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType:false,
      processData:false,
      dataType: "json",
      success: function(respuesta){
       //alert(respuesta);
          $("#editarDocgrado").val(respuesta["id"]);
          $("#editarObservacion").val(respuesta["observacion"]);
      }


  });
});