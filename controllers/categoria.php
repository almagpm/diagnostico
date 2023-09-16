<?php
require_once(__DIR__."/sistema.php");

/**
 * Contcategorialer Proyecto
 */
class Categoria extends Sistema
{
    /**
     * Obtiene los proyectos solicitado
     *
     * @return array $data los proyectos solicitados
     * @param integer $id si se especifica un id solo obtiene el proyecto solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from categoria";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from categoria where id_categoria = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo proyecto
     */
    public function new($data)
    {
        $this->db();
        $sql = "insert into categoria (nombre) values (:nombre)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":categoria", $data['categoria'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Editar proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del proyecto a editar
     *         array $data los datos modificados del proyecto
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "update categoria set categoria = :categoria where id_categoria = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":categoria", $data['categoria'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del proyecto a eliminar
     */public function delete($id)
    {
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "delete from categoria_tarea where id_categoria = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $sql2 = "delete from categoria where id_categoria = :id";
            $st2 = $this->db->prepare($sql2);
            $st2->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $st2->execute();
            $rc = $st2->rowCount();
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            $this->db->rollBack();
        }
        return $rc;

    }

    public function gettarea($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select p.* from tarea p join categoria_tarea rp on p.id_tarea = rp.id_tarea";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select p.* from tarea p join categoria_tarea rp on p.id_tarea = rp.id_tarea where rp.id_categoria=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function gettareaOne($id)
    {
        $data = null;
        $this->db();
        if (is_null($id)) {
            die("Ocurrió un error");
        } else {
            $sql = "select DISTINCT p.* from tarea p join categoria_tarea rp on p.id_tarea = rp.id_tarea where rp.id_tarea=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function deletetarea($id, $id2)
    {
        $this->db();
        $sql = "delete from categoria_tarea where id_categoria = :id and id_tarea=:id2";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id2", $id2, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newtarea($id, $data)
    {
        $this->db();
        $rc=0;

        try{
            $sql = "insert into categoria_tarea (id_tarea,id_categoria) values (:id_tarea, :id_categoria)";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id_tarea",$data['id_tarea'],  PDO::PARAM_INT);
            $st->bindParam(":id_categoria",$data['id_categoria'], PDO::PARAM_INT);
            $st->execute();
            $rc = $st->rowCount();
            
        }catch(PDOException $e){
            echo "Error al insertar el tarea, ya existe ese tarea en este categoria " ;

        }
        return $rc;

       
    }

    public function edittarea($id, $id2, $data2)
    {
        $this->db();
         echo ($id);
         echo ($id2);
         print_r ($data2);

    }

    public function chartProyecto()
    {
        $this->db();
        $sql = "select month(p.fecha_inicio) as mes, count(p.id_proyecto) as cantidad from proyecto p order by mes";
        $st = $this->db->prepare($sql);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}
$categoria = new Categoria;
?>