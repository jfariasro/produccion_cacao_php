<?php
require_once 'clases/clsUsuarios.php';
if (isset($_POST['modificar'])) {

    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $pass = mysqli_real_escape_string($con, $_POST['pass'] ?? '');
    $nombre = mysqli_real_escape_string($con, $_POST['nombre'] ?? '');
    $usuario = mysqli_real_escape_string($con, $_POST['usuario'] ?? '');

    $user = new Usuario($_SESSION['idInicio'], $nombre, $usuario, $email, $pass);

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
            $_SESSION['nombre'] = $nombre;
            $_SESSION['mensaje'] = "<b>Usuario editado exitosamente</b>";
            echo '<meta http-equiv="refresh" content="0; url=panel.php" />  ';
        } else {
            MensajeError("Error al modificar usuario " . mysqli_error($con));
        }
    }
}
$id = $_SESSION['idInicio'];

$query = "SELECT id, email, pass, nombre, usuario from usuarios where id= '$id';";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);

require_once 'views/perfilUsuario.view.php';
