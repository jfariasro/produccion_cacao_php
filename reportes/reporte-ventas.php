<?php ob_start();

require_once "../config/conexion.php";

$conexion = new Conexion();
$con = $conexion->getConectar();

$id = $_GET['id'];

$query = "SELECT v.idcliente, tc.nombre as tipo, v.fecha, v.cantidad, v.total, v.precio
FROM venta v JOIN cosecha c ON v.idcosecha = c.id
JOIN clientes cl ON v.idcliente = cl.id
JOIN tipo_cosecha tc ON c.idtipocosecha = tc.id
WHERE v.id = '$id'";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);

$idcliente = $row['idcliente'];
$tipo = $row['tipo'];
$fecha = $row['fecha'];
$cantidad = $row['cantidad'];
$precio = $row['precio'];
$total = $row['total'];

$query = "SELECT nombre, email, direccion FROM clientes WHERE id = '$idcliente'";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);
$nombre = $row['nombre'];
$email = $row['email'];
$direccion = $row['direccion'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Reporte de Venta Realizada</title>
</head>

<body>

    <div class="text-center">
        <img src="../images/logo.png" style="width: 30px;">
        <br>
        <h2>Venta de la Finca Cacaotera</h2>
    </div>
    <br>

    <div class="text-center">
        <p class="h4">Datos del Cliente</p>
        <table style="width: 750px;margin-top: 20px;" class="table table-bordered">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Email</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <?php echo $nombre ?> </td>
                    <td> <?php echo $email ?> </td>
                    <td> <?php echo $direccion ?> </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <div class="text-center">
        <p class="h4">Datos de la Venta</p>
        <table style="width: 750px;margin-top: 20px;" class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <?php echo $fecha ?> </td>
                    <td> <?php echo $tipo ?> </td>
                    <td> <?php echo $cantidad ?> </td>
                    <td> <?php echo $precio ?> </td>
                    <td> <?php echo $total ?> </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php

$html = ob_get_clean();
//echo $html;

require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->load_html($html);

$dompdf->setPaper('letter');
//$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$nombre = "reporte-venta-" . $_GET['id'] . ".pdf";
$dompdf->stream($nombre, array("Attachment" => false));
