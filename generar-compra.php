<?php

require_once 'clases/clsCompras.php';
require_once 'clases/clsInsumos.php';
require_once 'clases/clsProveedores.php';

//$_SESSION['codigoCompra'] = '';

$compras = new Compra(-1, 0, 0, 0, 0, 0, $_SESSION['codigoCompra'] ?? '');

if (isset($_POST['delete_compra'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_id'] ?? '');
    $query = "DELETE from compras where id='$id';";
    $res = mysqli_query($con, $query);
    if ($res) {
        $codigo = mysqli_real_escape_string($con, $_POST['delete_codigo'] ?? '');
        $query = "SELECT count(*) as total from compras where codigo = '$codigo';";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);

        $idproveedor = $compras->ObtenerIdProveedor($con);

        if ($row['total'] == 0) {
            $_SESSION['mensaje'] = '<b>Compras Eliminadas</b>';
            $_SESSION['codigoCompra'] = '';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-compra" />  ';
        } else {
            MensajeExitoso("<b>Compra Borrada Exitosamente</b>");
        }
    } else {
        MensajeError("<b>Error al borrar la Compra</b>");
    }
} else if (isset($_POST['Guardar'])) {
    $idinsumo = $_POST['idinsumo'];

    if ($_SESSION['codigoCompra'] == '') {
        $idproveedor = $_POST['idproveedor'];
    } else {
        $compras = new Compra(-1, 0, 0, 0, 0, 0, $_SESSION['codigoCompra']);
        $idproveedor = $compras->ObtenerIdProveedor($con);
    }

    $insumo = new Insumo($idinsumo, '', 0, 0, '');
    $precio = $insumo->ObtenerPrecio($con);

    $cantidad = $_POST['cantidad'];
    $total = $precio * $cantidad;

    if ($_SESSION['codigoCompra'] !== '') {
        $compras = new Compra(-1, $idproveedor, $idinsumo, $precio, $cantidad, $total, $_SESSION['codigoCompra']);
    } else {
        $compras = new Compra(-1, $idproveedor, $idinsumo, $precio, $cantidad, $total, '');
    }

    $resInsertar = $compras->Registro($con);
    if ($resInsertar) {
        if ($_SESSION['codigoCompra'] == '') {
            $obtenerid = mysqli_insert_id($con);
            $_SESSION['codigoCompra'] =  $obtenerid . '' . $_SESSION['idInicio'];
            $codigo = $_SESSION['codigoCompra'];

            $query = "UPDATE compras set codigo = $codigo where id = '" . $obtenerid . "';";
            $resModificar = mysqli_query($con, $query);
        }
        $_SESSION['mensaje'] = '<b>Compra generada exitosamente</b>';
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-compra" />  ';
    } else {
        $_SESSION['error'] = '<b>Compra no pudo ser generada</b>';
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-compra" />  ';
    }
}

$codigo = $_SESSION['codigoCompra'] ?? '';
$resCompra = $compras->ConsultarCompraGenerada($con);

$insumo = new Insumo(-1, '', 0, 0, '');
$resInsumo = $insumo->Consultar($con);

$proveedor = new Proveedor(-1, '', '', '');
$resProveedor = $proveedor->Consultar($con);

require 'views/generar-compra.view.php';
