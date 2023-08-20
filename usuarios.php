<?php

require_once 'clases/clsUsuarios.php';

if (isset($_POST['ingresar_usuario'])) {
    $add_email = mysqli_real_escape_string($con, $_POST['add_email'] ?? '');
    $add_pass = mysqli_real_escape_string($con, $_POST['add_pass'] ?? '');
    $add_nombre = mysqli_real_escape_string($con, $_POST['add_nombre'] ?? '');
    $add_usuario = mysqli_real_escape_string($con, $_POST['add_usuario'] ?? '');

    $user = new Usuario(0, $add_nombre, $add_usuario, $add_email, $add_pass);

    $mensaje = $user->ValidacionRegistro();

    if ($mensaje !== '') {
        echo "
        <script>
            alertify.set('notifier', 'position', 'top-center');
            alertify.error('$mensaje');
        </script>
    ";
    } else {
        $res = $user->RegistrarUsuario($con);
        if ($res) {
            $_SESSION['mensaje'] = "<b>Usuario registrado exitosamente</b>";
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios" />  ';
        } else {
            MensajeError("Error al eliminar usuario " . mysqli_error($con));
        }
    }
} else if (isset($_POST['modificar_usuario'])) {

    $id = $_POST['id'];
    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $pass = mysqli_real_escape_string($con, $_POST['pass'] ?? '');
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $usuario = mysqli_real_escape_string($con, $_POST['usuario'] ?? '');

    $user = new Usuario($id, $nombre, $usuario, $email, $pass);

    $mensaje = $user->ValidacionModificar();

    if ($mensaje !== '') {
        echo "
        <script>
            alertify.set('notifier', 'position', 'top-center');
            alertify.error('$mensaje');
        </script>
    ";
    } else {
        $res = $user->ModificarUsuario($con);
        if ($res) {
            $_SESSION['mensaje'] = "<b>Usuario modificado exitosamente</b>";
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios" />  ';
        } else {
            MensajeError("Error al modificar usuario " . mysqli_error($con));
        }
    }
} else if (isset($_POST['eliminar_usuario'])) {
    $delete_id = $_POST['delete_id'];

    $user = new Usuario($delete_id, '', '', '', '');

    $res = $user->ElimimarUsuario($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Usuario eliminado exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=usuarios" />  ';
    } else {
        MensajeError("Error al eliminar usuario " . mysqli_error($con));
    }
}

$id = $_SESSION['idInicio'];
$query = "SELECT id, email, nombre, usuario from usuarios WHERE id != '$id'";
$res = mysqli_query($con, $query);

require 'views/usuarios.view.php';
