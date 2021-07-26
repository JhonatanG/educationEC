<?php
require_once 'conexion.php';

class ModeloDocg{
/*=============================================
LISTAR GRADO CON PARALELO
=============================================*/
    public static function mdlListarGradoParalelo(){
        $stmt=Conexion::conectar()->prepare("SELECT etgp.id,CONCAT(etg.nombre,' ',etp.nombre) as grado
        FROM edu_tab_grado_paralelo etgp
        INNER JOIN 
        edu_tab_paralelos etp
        ON
        (etp.id = etgp.id_paralelo)
        INNER JOIN
        edu_tab_grado etg
        ON
        (etg.id=etgp.id_grado)");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt=null;
    }
    /*=============================================
INFORMACIÓN DUPLICADA
=============================================*/
    static public function mdlMostrarRepetidos($tabla,$datos){
        if ($datos!=null){
            $stmt=Conexion::conectar()->prepare("SELECT id from $tabla WHERE id_grado_docente=:id_grado_docente AND
             id_docente=:id_docente AND id_materia = :id_materia");
             $stmt->bindParam(":id_grado_docente",$datos["idGrados"],PDO::PARAM_INT);
            $stmt->bindParam(":id_docente",$datos["idDocenteD"],PDO::PARAM_INT);
            $stmt->bindParam(":id_materia",$datos["idMaterias"],PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll();
            var_dump($stmt);
      
        $stmt->close();
        $stmt=null;      
        }
    }
    /*=============================================
GUARDAR INFORMACIÓN
=============================================*/
    static public function mdlCrearDocg($tabla,$datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_grado_docente,id_docente,observacion,estado,id_materia)
        VALUES (:idGrados,:idDocenteD,:observacion,:estado,:idMateria)");
        $stmt->bindParam(":idGrados",$datos["idGrados"],PDO::PARAM_INT);
        $stmt->bindParam(":idDocenteD",$datos["idDocenteD"],PDO::PARAM_INT);
        $stmt->bindParam(":observacion",$datos["observacion"],PDO::PARAM_STR);
        $stmt->bindParam(":estado",$datos["estado"],PDO::PARAM_STR);
        $stmt->bindParam(":idMateria",$datos["idMaterias"],PDO::PARAM_INT);


        if($stmt->execute())
        {
            return "ok";

        }
        else{
            return "error";
        }
        $stmt->close();
        $stmt=null; 
    }
    /*=============================================
MOSTRAR INFORMACIÓN
=============================================*/
    static public function mdlMostrarDocg($tabla,$item,$valor){
        
        if ($item!=null){
            $stmt=Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item=:$item");
            $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetch();
            $stmt->close();
            $stmt=null;        
        }else{
            $stmt=Conexion::conectar()->prepare("  SELECT etgd.id,
            CONCAT (etd.nombres, ' ', etd.apellidos) AS docente,
            CONCAT (etg.nombre, '-', etp.nombre) AS grado,
            etgd.observacion,
            etmat.nombre,
            etgd.estado
       FROM edu_tab_grad_docente etgd
            INNER JOIN edu_tab_docentes etd
               ON (etd.id = etgd.id_docente)
            INNER JOIN edu_tab_grado_paralelo etgp
               ON (etgp.id = etgd.id_grado_docente)
            INNER JOIN edu_tab_paralelos etp
               ON (etp.id = etgp.id_paralelo)
            INNER JOIN edu_tab_grado etg
               ON (etg.id = etgp.id_grado)
            INNER JOIN edu_tab_materias etmat
              ON (etgd.id_materia = etmat.id)
   ORDER BY etgd.id DESC");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->close();
            $stmt=null;
        }
    }
    /*=============================================
ACTUALIZAR INFORMACIÓN ESTADO ACTIVO-INACTIVO
=============================================*/
    public static function mdlActualizarDocgrado($tabla, $item1, $valor1, $item2, $valor2){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

    }
    /*=============================================
ELIMINAR INFORMACION
=============================================*/

static public function mdlEliminarDocgrados($tabla,$datos){
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
/*=============================================
EDITAR INFORMACION
=============================================*/
static public function mdlEditarDocgrado($tabla,$datos){
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
}