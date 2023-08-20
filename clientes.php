<?php

require_once 'clases/clsClientes.php';

$cliente = new Cliente(-1, '', '', '');

if (isset($_POST['ingresar_cliente'])) {
    $add_nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
    $add_email = mysqli_real_escape_string($con, $_POST['add_email'] ?? '');
    $add_direccion = mysqli_real_escape_string($con, $_POST['add_direccion'] ?? '');

    $cliente = new Cliente(0, $add_nombre, $add_email, $add_direccion);
    $res = $cliente->Registro($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Cliente registrado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=clientes" />  ';
    } else {
        MensajeError("Error al registrar cliente");
    }
} else if (isset($_POST['modificar_cliente'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $direccion = mysqli_real_escape_string($con, $_POST['direccion'] ?? '');
    $id = $_POST['id'];

    $cliente = new Cliente($id, $nombre, $email, $direccion);

    $res = $cliente->Modificar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Cliente modificado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=clientes" />  ';
    } else {
        MensajeError("Error al modificar cliente");
    }
} else if (isset($_POST['eliminar_cliente'])) {
    $id = $_POST['delete_id'];

    $cliente = new Cliente($id, '', '', '');
    $res = $cliente->Eliminar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Cliente eliminado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=clientes" />  ';
    } else {
        MensajeError("Error al eliminar cliente");
    }
}

$res = $cliente->Consultar($con);

require 'views/clientes.view.php';
