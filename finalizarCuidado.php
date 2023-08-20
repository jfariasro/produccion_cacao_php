<?php
require_once "config/conexion.php";
$conexion = new Conexion();
$con = $conexion->getConectar();

$codigo = $_SESSION['codigoCuidado'];

$query = "UPDATE cuidado SET fecha = NOW() WHERE codigo = '$codigo'";
$res = mysqli_query($con, $query);

$query = "SELECT idinsumo, cantidad_insumo
from detalle_cuidado dc join cuidado c on c.id = dc.idcuidado
WHERE codigo = '$codigo'";
$res = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($res)) {
    $idinsumo = $row['idinsumo'];
    $cantidad = $row['cantidad_insumo'];
    $query = "UPDATE insumos set existencia = existencia - '$cantidad' WHERE id = '$idinsumo'";
    $resP = mysqli_query($con, $query);
}

$_SESSION['mensaje'] = "Cuidado '$codigo' ha sido Registrado Correctamente";
$_SESSION['codigoCuidado'] = '';
echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=cuidado" />  ';
