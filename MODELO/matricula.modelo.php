<?php

require_once "conexion.php";
class ModeloMatricula{
     /*=============================================
MOSTRAR INFORMACION MATRICULA
=============================================*/
   static public function mdlMostrarMatricula($tabla,$item,$valor){
      $id="codigo";
      if ($item!=null){
          $stmt=Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item=:$item ");
          $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
          $stmt->execute();
          return $stmt -> fetch();
          $stmt->close();
          $stmt=null;        
      }else{
          $stmt=Conexion::conectar()->prepare("SELECT * FROM $tabla");
          $stmt->execute();
          return $stmt->fetchAll();
          $stmt->close();
          $stmt=null;
      }
  }
       /*=============================================
MOSTRAR INFORMACION DETALLADA MATRICULA
=============================================*/
static public function mdlMostrarMatriculaDet($tabla,$item,$valor){
   $id="codigo";
   if ($item!=null){
       $stmt=Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item=:$item ");
       $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
       $stmt->execute();
       return $stmt -> fetch();
       $stmt->close();
       $stmt=null;        
   }else{
       $stmt=Conexion::conectar()->prepare("SELECT etm.id,
       etm.codigo,
       ete.cedula,
       CONCAT (ete.nombres, ' ', ete.apellidos) AS nombre,
       CONCAT (etg.nombre, ' ', etp.nombre) AS grado,
       etpe.nombre AS periodo,
       etm.observacion
  FROM edu_tab_matricula etm
       INNER JOIN edu_tab_estudiantes ete
          ON (ete.id = etm.id_estudiante)
       INNER JOIN edu_tab_grado_paralelo etgp
          ON (etgp.id = etm.id_grado_paralelo)
       INNER JOIN edu_tab_grado etg
          ON (etg.id = etgp.id_grado)
       INNER JOIN edu_tab_paralelos etp
          ON (etp.id = etgp.id_paralelo)
       INNER JOIN edu_tab_periodo etpe
          ON (etpe.id = etm.id_periodo)
 WHERE etpe.estado = '1'");
       $stmt->execute();
       return $stmt->fetchAll();
       $stmt->close();
       $stmt=null;
   }
}
  /*=============================================
LISTA INFORMACION GRADO PARALELO
=============================================*/
    static public function mdlMostrarGparalelos(){
      $stmt = Conexion::conectar()->prepare("SELECT gp.id AS id, CONCAT (g.nombre, ' ', p.nombre) AS grado, gp.cupos
      FROM edu_tab_grado_paralelo gp
           INNER JOIN edu_tab_grado g
              ON gp.id_grado = g.id
           INNER JOIN edu_tab_paralelos p
              ON gp.id_paralelo = p.id
           INNER JOIN edu_tab_periodo etp
              ON etp.id = gp.id_periodo
     WHERE gp.estado = '1' AND etp.estado = '1'
  ORDER BY p.nombre ASC
      ");
      $stmt->execute();
      return $stmt->fetchAll();
      $stmt->close();
      $stmt=null;

    }
      /*=============================================
LISTA INFORMACION GRADO PARALELO POR ID
=============================================*/
static public function mdlMostrarGparalelosporId($item,$valor){
  $stmt = Conexion::conectar()->prepare("SELECT gp.id AS id, CONCAT (g.nombre, ' ', p.nombre) AS grado, gp.cupos
  FROM edu_tab_grado_paralelo gp
       INNER JOIN edu_tab_grado g
          ON gp.id_grado = g.id
       INNER JOIN edu_tab_paralelos p
          ON gp.id_paralelo = p.id
          WHERE gp.$item=:$item
  ");
 $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
 $stmt->execute();
 return $stmt -> fetch();
 $stmt->close();
 $stmt=null;     

}    
/*=============================================
REGISTROS REPETIDOS
=============================================*/
    static public function mdlMostrarRepetidosM($tabla,$datos){
        if ($datos!=null){
            $stmt=Conexion::conectar()->prepare("SELECT id from
            $tabla
            WHERE id_periodo = :id_periodo
            AND id_estudiante = :id_estudiante");

            $stmt->bindParam(":id_periodo",$datos["idPeriodo"],PDO::PARAM_INT);
            $stmt->bindParam(":id_estudiante",$datos["idEstudiante"],PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
           
        $stmt->close();
        $stmt=null;      
        }
    }

   /*=============================================
	LISTAR ESTUDIANTE
	=============================================*/
  static public function mdlListarEstudiante($tabla){
    $stmt=Conexion::conectar()->prepare("SELECT id, CONCAT(Nombres, ' ', Apellidos) AS nombre,cedula from $tabla");
    $stmt->execute();
    return $stmt->fetchALL();
    $stmt->close();
    $stmt=null;
}

 /*=============================================
GUARDAR INFORMACION
=============================================*/
static public function mdlCrearMatricula($tabla,$datos){
   $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo,observacion,id_estudiante,id_grado_paralelo,id_periodo,id_usuario)
   VALUES (:codigo,:observacion,:id_estudiante,:id_grado_paralelo,:id_periodo,:id_usuario)");
   $stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
   $stmt->bindParam(":observacion",$datos["observacion"],PDO::PARAM_STR);
   $stmt->bindParam(":id_estudiante",$datos["idEstudiante"],PDO::PARAM_INT);
   $stmt->bindParam(":id_grado_paralelo",$datos["idGparalelo"],PDO::PARAM_INT);
   $stmt->bindParam(":id_periodo",$datos["idPeriodo"],PDO::PARAM_INT);
   $stmt->bindParam(":id_usuario",$datos["idUsuario"],PDO::PARAM_INT);

   if($stmt->execute())
   {
       return "ok";

   }else{
       return "error";
   }
   $stmt->close();
   $stmt=null; 
}
 /*=============================================
ACTUALIZAR NUMERO DE CUPOS DISMINUIR
=============================================*/
static public function mdlActualizaNum($tabla,$datos){
   $stmt = Conexion::conectar()->prepare("UPDATE edu_tab_grado_paralelo etgp
    Inner JOIN edu_tab_matricula etm ON (etm.id_grado_paralelo=etgp.id) set etgp.cupos = etgp.cupos -1 
    WHERE etm.codigo = :codigo");
   $stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);

   if($stmt->execute())
   {
       return "ok";

   }else{
       return "error";
   }
   $stmt->close();
   $stmt=null; 
}
/*=============================================
EDITAR INFORMACION
=============================================*/
static public function mdlEditarMatricula($tabla,$datos){
   $stmt=Conexion::conectar()->prepare("UPDATE $tabla SET observacion = :observacion WHERE id =:id ");
   $stmt->bindParam(":id",$datos["id"],PDO::PARAM_INT);
   $stmt->bindParam(":observacion",$datos["observacion"],PDO::PARAM_STR);
   if($stmt->execute()){
       return "ok";
   }else{
       return "eror";
   }
   $stmt->close();
   $stmt=null;

}
 /*=============================================
ACTUALIZAR NUMERO DE CUPOS AUMENTAR
=============================================*/
static public function mdlActualizarNumAum($tabla,$datos){
   $stmt = Conexion::conectar()->prepare("UPDATE edu_tab_grado_paralelo etgp
    Inner JOIN edu_tab_matricula etm ON (etm.id_grado_paralelo=etgp.id) set etgp.cupos = etgp.cupos +1
    WHERE etm.id = :id");
   $stmt->bindParam(":id",$datos,PDO::PARAM_INT);

   if($stmt->execute())
   {
       return "ok";

   }else{
       return "error";
   }
   $stmt->close();
   $stmt=null; 
}
 /*=============================================
ELIMINAR
=============================================*/
static public function mdlEliminarMatricula($tabla,$datos){
   $stmt=Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id=:id ");
   $stmt->bindParam(":id",$datos,PDO::PARAM_INT);
   if($stmt->execute()){
       return "ok";
   }else{
       return "error";
   }
   $stmt->close();
   $stmt=null;

}
}