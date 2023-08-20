<?php
require_once 'clases/clsCosecha.php';
require_once 'clases/clsClientes.php';
$cosecha = new Cosecha(-1, 0, 0, 0, '');
$cliente = new Cliente(0, '', '', '');

if (isset($_POST['ingresar_cosecha'])) {
    //var_dump($_POST);
    $idtipocosecha = mysqli_real_escape_string($con, $_POST['tipocosecha'] ?? '');
    if ($idtipocosecha === "1") {
        $addcantidad_tacho = mysqli_real_escape_string($con, $_POST['addcantidad_tacho'] ?? -1);
    } else if ($idtipocosecha === "2") {
        $addcantidad_quintal = mysqli_real_escape_string($con, $_POST['addcantidad_quintal'] ?? -1);
    }

    if (isset($addcantidad_quintal)) {
        $cosecha = new Cosecha(0, $idtipocosecha, $addcantidad_quintal, -1, '');
    } else if (isset($addcantidad_tacho)) {
        $cosecha = new Cosecha(0, $idtipocosecha, -1, $addcantidad_tacho, '');
    }

    $res = $cosecha->Registro($con);
    if ($res) {
        $obtenerid = mysqli_insert_id($con);
        $codigo =  $obtenerid . '' . $_SESSION['idInicio'];

        $query = "UPDATE cosecha set codigo = $codigo where id = '" . $obtenerid . "';";
        $resModificar = mysqli_query($con, $query);
        if ($resModificar) {
            $_SESSION['mensaje'] = "<b>Cosecha registrada exitosamente</b>";
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=cosecha" />  ';
        } else {
            MensajeError("<b>Error al registrar cosecha</b>");
        }
    } else {
        MensajeError("Error al registrar cosecha " . mysqli_error($con));
    }
} else if (isset($_POST['vender_cosecha'])) {
    $idcosecha = $_POST['idvender'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $idcliente = $_POST['idcliente'];
    $total = $cantidad * $precio;

    $query = "INSERT INTO venta(idcosecha, idcliente, fecha, cantidad, precio, total)
    VALUES('$idcosecha', '$idcliente', NOW(), '$cantidad', '$precio', '$total')";
    $res = mysqli_query($con, $query);
    if ($res) {
        $query = "UPDATE cosecha SET estado = true WHERE id = '$idcosecha'";
        $resModificar = mysqli_query($con, $query);
        $_SESSION['mensaje'] = "<b>Venta registrada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=cosecha" />  ';
    }
} else if (isset($_POST['modificar_cosecha'])) {
    $id = $_POST['id'];
    if(isset($_POST['cantidad_quintal']) && $_POST['cantidad_quintal'] !== ''){
        $cantidad_quintal = $_POST['cantidad_quintal'];
        $cantidad_tacho = -1;
    }else if(isset($_POST['cantidad_tacho']) && $_POST['cantidad_tacho'] !== ''){
        $cantidad_quintal = -1;
        $cantidad_tacho = $_POST['cantidad_tacho'];
    }

    $cosecha = new Cosecha($id, 0, $cantidad_quintal, $cantidad_tacho, '');
    $res = $cosecha->Modificar($con);

    if ($res) {
        $_SESSION['mensaje'] = "<b>Cosecha modificada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=cosecha" />  ';
    } else {
        MensajeError("Error al modificar cosecha " . mysqli_error($con));
    }
}else if(isset($_POST['eliminar_cosecha'])){
    $id = $_POST['delete_id'];
    $cosecha = new Cosecha($id, 0, 0, 0, '');
    $res = $cosecha->Eliminar($con);
    if ($res) {
        $_SESSION['mensaje'] = "<b>Cosecha eliminada exitosamente</b>";
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=cosecha" />  ';
    } else {
        MensajeError("Error al eliminar cosecha ". mysqli_error($con));
    }
}

$resCliente = $cliente->Consultar($con);
$res = $cosecha->Consultar($con);
$resTipo = $cosecha->ObtenerTipoCosecha($con);
require 'views/cosecha.view.php';
