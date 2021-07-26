$("#idGrado").change(function(){
    var idDocente = document.getElementById("idDocenteG").value;

    var idGradoD = $(this).val();

    var datos = new FormData();

    datos.append("idDocente", idDocente);
    datos.append("idGradoD", idGradoD);
 // alert(idGradoD);
 //alert(idDocente);

    $.ajax({
      url: "../ajax/asistencia.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
    
          $("#idMateria").html('');
          for(x of respuesta){
            $(".datos").append(
            '<option value="'+x.id+'">'+x.materia+'</option>'
            );
        }
        
      }
    });

});
/*=============================================
EDITAR INFORMACION ANIO LECTIVO
=============================================*/
$(document).on("click",".btnEditarAsistencia", function(){
  var idAsistencia = $(this).attr("idAsist");
  var datos = new FormData();
  datos.append("idAsistencia",idAsistencia);
 // alert(idAsistencia);
  $.ajax({
      url:"../ajax/asistencia.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType:false,
      processData:false,
      dataType: "json",
      success: function(respuesta){
         asistencia = respuesta["asistencia"];
          $("#idAsistencia").val(respuesta["id"]);
          if(asistencia==="P"){
            $("#editarAsistencia").html("Presente");
            $("#editarAsistencia").val(respuesta["asistencia"]);
          }else if(asistencia==="FG"){
            $("#editarAsistencia").html("Fuga");
            $("#editarAsistencia").val(respuesta["asistencia"]);
          }else if(asistencia==="FJ"){
            $("#editarAsistencia").html("Falta Justificada");
            $("#editarAsistencia").val(respuesta["asistencia"]);
          }else if(asistencia==="FI"){
            $("#editarAsistencia").html("Falta Injustificada");
            $("#editarAsistencia").val(respuesta["asistencia"]);
          }
     

      }


  });
});