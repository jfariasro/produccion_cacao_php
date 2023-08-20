<?php
require_once "config/conexion.php";
$conexion = new Conexion();
$con = $conexion->getConectar();

$codigo = $_SESSION['codigoCompra'];

$query = "UPDATE compras SET fecha = NOW() WHERE codigo = '$codigo'";
$resModificar = mysqli_query($con, $query);

$query = "SELECT cantidad, idinsumo from compras WHERE codigo = '$codigo';";
$res = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($res)) {
    $idinsumo = $row['idinsumo'];
    $cantidad = $row['cantidad'];
    $query = "UPDATE insumos set existencia = existencia + '$cantidad' WHERE id = '$idinsumo'";
    $resP = mysqli_query($con, $query);
}

$_SESSION['mensaje'] = "<b>Compra '$codigo' Genera Exitosamente";
$_SESSION['codigoCompra'] = '';
echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=compras" />  ';
