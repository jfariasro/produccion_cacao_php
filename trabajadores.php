<?php

require_once 'clases/clsTrabajadores.php';

$trabajador = new Trabajador(-1, '', '', '');

if (isset($_POST['ingresar_trabajador'])) {
    $add_nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
    $add_email = mysqli_real_escape_string($con, $_POST['add_email'] ?? '');
    $add_direccion = mysqli_real_escape_string($con, $_POST['add_direccion'] ?? '');

    $trabajador = new Trabajador(0, $add_nombre, $add_email, $add_direccion);
    $res = $trabajador->Registro($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Trabajador registrado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=trabajadores" />  ';
    } else {
        MensajeError("Error al registrar trabajador");
    }
} else if (isset($_POST['modificar_trabajador'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $direccion = mysqli_real_escape_string($con, $_POST['direccion'] ?? '');
    $id = $_POST['id'];

    $trabajador = new Trabajador($id, $nombre, $email, $direccion);

    $res = $trabajador->Modificar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Trabajador modificado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=trabajadores" />  ';
    } else {
        MensajeError("Error al modificar trabajador");
    }
} else if (isset($_POST['eliminar_trabajador'])) {
    $id = $_POST['delete_id'];

    $trabajador = new Trabajador($id, '', '', '');
    $res = $trabajador->Eliminar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Trabajador eliminado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=trabajadores" />  ';
    } else {
        MensajeError("Error al eliminar trabajador");
    }
}

$res = $trabajador->Consultar($con);

require 'views/trabajadores.view.php';
