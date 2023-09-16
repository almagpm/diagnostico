<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nueva ' ?>Tarea
</h1>
<form method="POST" action="index.php?action=<?php echo $action; ?>">
  <div class="mb-3">
    <label class="form-label">Descripción de la Tarea</label>
    <input type="text" name="data[descripcion]" class="form-control" placeholder="Descripción"
      value="<?php echo isset($data[0]['descripcion']) ? $data[0]['descripcion'] : ''; ?>" required minlength="3"
      maxlength="255" />
  </div>
  <div class="mb-3">
    <label class="form-label">Estado de la Tarea</label>
    <select name="data[estado]" class="form-select" required>
      <option value="pendiente"
        <?php echo (isset($data[0]['estado']) && $data[0]['estado'] == 'pendiente') ? 'selected' : ''; ?>>
        Pendiente
      </option>
      <option value="en progreso"
        <?php echo (isset($data[0]['estado']) && $data[0]['estado'] == 'en progreso') ? 'selected' : ''; ?>>
        En Progreso
      </option>
      <option value="completada"
        <?php echo (isset($data[0]['estado']) && $data[0]['estado'] == 'completada') ? 'selected' : ''; ?>>
        Completada
      </option>
    </select>
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_tarea]"
        value="<?php echo isset($data[0]['id_tarea']) ? $data[0]['id_tarea'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>
