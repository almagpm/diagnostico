<?php
header('Content-Type: application/json');

include_once(__DIR__."/../controllers/sistema.php");
include_once(__DIR__."/../controllers/tarea.php"); // Cambiar "departamento.php" a "tarea.php"

$accion = $_SERVER["REQUEST_METHOD"];

$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($accion):
    case 'DELETE':
        $data['mensaje'] = "No existe la tarea";
        if (!is_null($id)) {
            $contador = $tarea->delete($id); // Cambiar "$departamento" a "$tarea"
            if ($contador == 1)
                $data['mensaje'] = "Se eliminó la tarea";
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];

        if (is_null($id)) {
            $cantidad = $tarea->new($data); // Cambiar "$departamento" a "$tarea"
            if ($cantidad != 0)
                $data['mensaje'] = "Se insertó la tarea";
            else
                $data['mensaje'] = "Ocurrió un error";
        } else {
            $cantidad = $tarea->edit($id, $data); // Cambiar "$departamento" a "$tarea"
            if ($cantidad != 0)
                $data['mensaje'] = "Modificó la tarea";
            else
                $data['mensaje'] = "Ocurrió un error";
        }
        break;

    case 'GET':
    default:
        if (is_null($id))
            $data = $tarea->get(); // Cambiar "$departamento" a "$tarea"
        else
            $data = $tarea->get($id); // Cambiar "$departamento" a "$tarea"
        break;
endswitch;
$data = json_encode($data);
echo ($data);
?>
