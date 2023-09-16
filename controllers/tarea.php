<?php
require_once(__DIR__."/sistema.php");

/**
 * Controller tarea
 */
class Tarea extends Sistema
{
    /**
     * Obtiene los tareas solicitado
     *
     * @return array $data los tareas solicitados
     * @param integer $id si se especifica un id solo obtiene el tarea solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from tarea";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from tarea where id_tarea = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo tarea
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo tarea
     */
    public function new($data)
    {
        $this->db();
        $sql = "INSERT INTO Tarea (descripcion, estado) VALUES (:descripcion, :estado)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":estado", $data['estado'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Editar tarea
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del tarea a editar
     *         array $data los datos modificados del tarea
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE Tarea SET descripcion = :descripcion, estado = :estado WHERE id_tarea = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":estado", $data['estado'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }


    /**
     * Borrar tarea
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del tarea a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from tarea where id_tarea = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$tarea = new Tarea;
?>