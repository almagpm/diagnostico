<h1>Tareas</h1>
<a href="index.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-1">ID</th>
      <th scope="col" class="col-md-6">Descripción</th>
      <th scope="col" class="col-md-3">Estado</th>
      <th scope="col" class="col-md-2">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $tarea): ?>
      <tr>
        <th scope="row">
          <?php echo $tarea['id_tarea']; ?>
        </th>
        <td>
          <?php echo $tarea['descripcion']; ?>
        </td>
        <td>
          <?php echo $tarea['estado']; ?>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-primary"
              href="index.php?action=edit&id=<?php echo $tarea['id_tarea'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="index.php?action=delete&id=<?php echo $tarea['id_tarea'] ?>">Eliminar</a>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th scope="col" colspan="3">Se encontraron <?php echo sizeof($data); ?> registros.</th>
    </tr>
  </tfoot>
</table>
