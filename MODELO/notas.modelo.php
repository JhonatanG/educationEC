<?php
require_once 'conexion.php';

class ModeloNotas{

/*=============================================
LISTA ESTUDIANTES
	=============================================*/
    static public function mdlListaEstudiantes($datos){
        if ($datos!=null){
        $stmt=Conexion::conectar()->prepare("SELECT DISTINCT
        etgd.id AS gdoc,
        ete.id,
        ete.cedula,
        CONCAT(ete.apellidos,' ', ete.nombres) AS estudiante
    FROM
        edu_tab_estudiantes ete
    INNER JOIN edu_tab_matricula etm ON
        etm.id_estudiante = ete.id
    INNER JOIN edu_tab_grado_paralelo etgp
       ON etgp.id = etm.id_grado_paralelo
    INNER JOIN edu_tab_grad_docente etgd ON
        etgd.id_grado_docente = etgp.id
    INNER JOIN edu_tab_docentes etd ON
        etd.id = etgd.id_docente
    INNER JOIN edu_tab_materias etmate ON
        etmate.id = etgd.id_materia
    WHERE
          etgd.id_docente=:id_docente and etgd.id_grado_docente=:id_grado_docente
           and etgd.id_materia=:id_materia 
        order by 
            ete.apellidos ASC");
        $stmt->bindParam(":id_grado_docente",$datos["idGParalelo"],PDO::PARAM_INT);
        $stmt->bindParam(":id_docente",$datos["idDocente"],PDO::PARAM_INT);
        $stmt->bindParam(":id_materia",$datos["idMateria"],PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt=null;
        }
    }
/*=============================================
GUARDAR INFORMACIÓN
=============================================*/
static public function mdlCrearNotas($tabla,$datos){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (parcial1q1,parcial2q1,
    parcial3q1,examenq1,quimestre1,parcial1q2,parcial2q2,parcial3q2,examenq2,quimestre2,nota_final,
    id_estudiante,id_clases_doc)
    VALUES (:P1Q1,:P2Q1,:P3Q1,:EXQ1,:Q1,:P1Q2,:P2Q2,
    :P3Q2,:EXQ2,:Q2,:NF,:id_estudiante,:id_grad_docente)");
    $stmt->bindParam(":P1Q1",$datos["P1Q1"],PDO::PARAM_STR);
    $stmt->bindParam(":P2Q1",$datos["P2Q1"],PDO::PARAM_STR);
    $stmt->bindParam(":P3Q1",$datos["P3Q1"],PDO::PARAM_STR);
    $stmt->bindParam(":EXQ1",$datos["EXQ1"],PDO::PARAM_STR);
    $stmt->bindParam(":Q1",$datos["Q1"],PDO::PARAM_STR);
    $stmt->bindParam(":P1Q2",$datos["P1Q2"],PDO::PARAM_STR);
    $stmt->bindParam(":P2Q2",$datos["P2Q2"],PDO::PARAM_STR);
    $stmt->bindParam(":P3Q2",$datos["P3Q2"],PDO::PARAM_STR);
    $stmt->bindParam(":EXQ2",$datos["EXQ2"],PDO::PARAM_STR);
    $stmt->bindParam(":Q2",$datos["Q2"],PDO::PARAM_STR);
    $stmt->bindParam(":NF",$datos["PT"],PDO::PARAM_STR);

    $stmt->bindParam(":id_estudiante",$datos["idEstudiante"],PDO::PARAM_INT);
    $stmt->bindParam(":id_grad_docente",$datos["idGdocente"],PDO::PARAM_INT);

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
Editar INFORMACIÓN
=============================================*/
static public function mdlEditarNotas($tabla,$datos){
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET parcial1q1=:P1Q1,parcial2q1=:P2Q1,
    parcial3q1=:P3Q1,examenq1=:EXQ1,quimestre1=:Q1,
    parcial1q2=:P1Q2,parcial2q2=:P2Q2,parcial3q2=:P3Q2,examenq2=:EXQ2,quimestre2=:Q2,nota_final=:NF,
    id_estudiante=:id_estudiante,id_clases_doc=:id_grad_docente
    WHERE id = :idNota 
    ");
    $stmt->bindParam(":P1Q1",$datos["P1Q1"],PDO::PARAM_STR);
    $stmt->bindParam(":P2Q1",$datos["P2Q1"],PDO::PARAM_STR);
    $stmt->bindParam(":P3Q1",$datos["P3Q1"],PDO::PARAM_STR);
    $stmt->bindParam(":EXQ1",$datos["EXQ1"],PDO::PARAM_STR);
    $stmt->bindParam(":Q1",$datos["Q1"],PDO::PARAM_STR);
    $stmt->bindParam(":P1Q2",$datos["P1Q2"],PDO::PARAM_STR);
    $stmt->bindParam(":P2Q2",$datos["P2Q2"],PDO::PARAM_STR);
    $stmt->bindParam(":P3Q2",$datos["P3Q2"],PDO::PARAM_STR);
    $stmt->bindParam(":EXQ2",$datos["EXQ2"],PDO::PARAM_STR);
    $stmt->bindParam(":Q2",$datos["Q2"],PDO::PARAM_STR);
    $stmt->bindParam(":NF",$datos["PT"],PDO::PARAM_STR);

    $stmt->bindParam(":id_estudiante",$datos["idEstudiante"],PDO::PARAM_INT);
    $stmt->bindParam(":id_grad_docente",$datos["idGdocente"],PDO::PARAM_INT);
    $stmt->bindParam(":idNota",$datos["idNota"],PDO::PARAM_INT);


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
CONSULTA DE NOTAS
	=============================================*/
    static public function mdlListaNotas($datos){
        if ($datos!=null){
        $stmt=Conexion::conectar()->prepare("SELECT DISTINCT
        etn.id as idNota,
        etgd.id AS gdoc,
        ete.id,
        ete.cedula,
        CONCAT(ete.apellidos, ' ', ete.nombres) AS estudiante,
        etn.parcial1q1 AS P1Q1,
        etn.parcial2q1 AS P2Q1,
        etn.parcial3q1 AS P3Q1,
        etn.examenq1 AS EXQ1,
        etn.quimestre1 AS Q1,
        etn.parcial1q2 AS P1Q2,
        etn.parcial2q2 AS P2Q2,
        etn.parcial3q2 AS P3Q2,
        etn.examenq2 AS EXQ2,
        etn.quimestre2 AS Q2,
        etn.nota_final AS NF
    FROM
        edu_tab_estudiantes ete
    INNER JOIN edu_tab_matricula etm ON
        etm.id_estudiante = ete.id
    INNER JOIN edu_tab_grado_paralelo etgp ON
        etgp.id = etm.id_grado_paralelo
    INNER JOIN edu_tab_grad_docente etgd ON
        etgd.id_grado_docente = etgp.id
    INNER JOIN edu_tab_docentes etd ON
        etd.id = etgd.id_docente
    INNER JOIN edu_tab_materias etmate ON
        etmate.id = etgd.id_materia
    INNER JOIN edu_tab_notas etn ON
        etn.id_estudiante = ete.id AND etn.id_clases_doc = etgd.id
    WHERE
          etgd.id_docente=:id_docente and etgd.id_grado_docente=:id_grado_docente
           and etgd.id_materia=:id_materia 
        order by 
            ete.apellidos ASC");
        $stmt->bindParam(":id_grado_docente",$datos["idGParalelo"],PDO::PARAM_INT);
        $stmt->bindParam(":id_docente",$datos["idDocente"],PDO::PARAM_INT);
        $stmt->bindParam(":id_materia",$datos["idMateria"],PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt=null;
        }
    }
        /*=============================================
REPORTE NOTAS POR CADA ESTUDIANTE
	=============================================*/
    static public function mdlReportNotasEstud($valor){
        $stmt = Conexion::conectar()->prepare("SELECT DISTINCT
        ete.id,
        ete.cedula,
        etm.nombre AS materia,
        etp.nombre AS periodo,
        etn.parcial1q1 AS P1Q1,
        etn.parcial2q1 AS P2Q1,
        etn.parcial3q1 AS P3Q1,
        etn.examenq1 AS EXQ1,
        etn.quimestre1 AS Q1,
        etn.parcial1q2 AS P1Q2,
        etn.parcial2q2 AS P2Q2,
        etn.parcial3q2 AS P3Q2,
        etn.examenq2 AS EXQ2,
        etn.quimestre2 AS Q2,
        etn.nota_final AS NF
    FROM
        edu_tab_estudiantes ete
    INNER JOIN edu_tab_notas etn ON
        etn.id_estudiante = ete.id
    INNER JOIN edu_tab_grad_docente etgd ON
        etgd.id = etn.id_clases_doc
    INNER JOIN edu_tab_materias etm ON
        etm.id = etgd.id_materia
    INNER JOIN edu_tab_grado_paralelo etgp ON
        etgp.id = etgd.id_grado_docente
    INNER JOIN edu_tab_periodo etp ON
        etp.id = etgp.id_periodo
    WHERE
        ete.id = :id_estudiante AND etp.estado = '1'
    GROUP BY
        ete.id,
        ete.cedula,
        etm.nombre,
        etp.nombre,
        etn.parcial1q1,
        etn.parcial2q1,
        etn.parcial3q1,
        etn.examenq1,
        etn.quimestre1,
        etn.parcial1q2,
        etn.parcial2q2,
        etn.parcial3q2,
        etn.examenq2,
        etn.quimestre2,
        etn.nota_final");
        $stmt->bindParam("id_estudiante",$valor,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt=null;

    }
}