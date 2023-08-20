<?php

require_once 'clases/clsProveedores.php';

$proveedor = new Proveedor(-1, '', '', '');

if (isset($_POST['ingresar_proveedor'])) {
    $add_nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
    $add_email = mysqli_real_escape_string($con, $_POST['add_email'] ?? '');
    $add_direccion = mysqli_real_escape_string($con, $_POST['add_direccion'] ?? '');

    $proveedor = new Proveedor(0, $add_nombre, $add_email, $add_direccion);
    $res = $proveedor->Registro($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Proveedor registrado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=proveedores" />  ';
    } else {
        MensajeError("Error al registrar proveedor " . mysqli_error($con));
    }
} else if (isset($_POST['modificar_proveedor'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $direccion = mysqli_real_escape_string($con, $_POST['direccion'] ?? '');
    $id = $_POST['id'];

    $proveedor = new Proveedor($id, $nombre, $email, $direccion);

    $res = $proveedor->Modificar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Proveedor modificado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=proveedores" />  ';
    } else {
        MensajeError("Error al modificar proveedor " . mysqli_error($con));
    }
} else if (isset($_POST['eliminar_proveedor'])) {
    $id = $_POST['delete_id'];

    $proveedor = new Proveedor($id, '', '', '');
    $res = $proveedor->Eliminar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Proveedor eliminado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=proveedores" />  ';
    } else {
        MensajeError("Error al eliminar proveedor " . mysqli_error($con));
    }
}

$res = $proveedor->Consultar($con);

require 'views/proveedores.view.php';
