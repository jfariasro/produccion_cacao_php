<?php ob_start();

require_once "../config/conexion.php";

$conexion = new Conexion();
$con = $conexion->getConectar();

$codigo = $_REQUEST['codigo'];

$query = "SELECT i.nombre as insumo, dc.cantidad_insumo FROM
detalle_cuidado dc join insumos i on dc.idinsumo = i.id
join cuidado c on c.id = dc.idcuidado
WHERE c.codigo = '$codigo'";
$resCProduccion = mysqli_query($con, $query);

$query = "SELECT t.nombre as trabajador, fecha
FROM cuidado c join trabajadores t on c.idtrabajador = t.id
WHERE codigo = '$codigo'";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);
$trabajador = $row['trabajador'] ?? '';
$fecha = $row['fecha'] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Listado de los Cuidados Realizados</title>
</head>

<body>
    <div class="text-center">
        <img src="../images/logo.png" style="width: 30px;">
        <br>
        <h2>Cuidados de la Finca Cacaotera</h2>
    </div>
    <br>

    <div class="text-center">
        <p class="h4">Datos del Cuidado</p>
        <table style="width: 750px;margin-top: 20px;" class="table table-bordered">
            <thead>
                <tr>
                    <th>Trabajador</th>
                    <th>fecha</th>
                    <th>Codigo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $trabajador ?>
                    </td>
                    <td>
                        <?php echo $fecha ?>
                    </td>
                    <td>
                        <?php echo $codigo ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <div class="text-center">
        <p class="h4">Datos de los Insumos</p>
        <table style="width: 750px;margin-top: 30px;" class="table table-bordered">
            <thead>
                <tr>
                    <th>Insumo</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resCProduccion)) : ?>
                    <tr>
                        <td><?php echo $row['insumo'] ?></td>
                        <td><?php echo $row['cantidad_insumo'] ?></td>
                    </tr>
                <?php endwhile; ?>

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

$nombre = "reporte-cuidado-" . $codigo . ".pdf";
$dompdf->stream($nombre, array("Attachment" => false));
