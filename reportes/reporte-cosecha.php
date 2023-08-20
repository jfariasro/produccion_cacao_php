<?php ob_start();

require_once "../config/conexion.php";
require_once "../clases/clsCosecha.php";

$conexion = new Conexion();
$con = $conexion->getConectar();

$codigo = $_GET['codigo'];

$cosecha = new Cosecha(0, 0, 0, 0, $codigo);
$resCosecha = $cosecha->ConsultarCodigo($con);
$rowCosecha = mysqli_fetch_assoc($resCosecha);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Reporte de Cosecha Realizada</title>
</head>

<body>

    <div class="text-center">
        <img src="../images/logo.png" style="width: 30px;">
        <br>
        <h2>Cosecha de la Finca Cacaotera</h2>
    </div>
    <br>

    <div class="text-center">
        <p class="h4">Datos de la Cosecha</p>
        <table style="width: 750px;margin-top: 20px;" class="table table-bordered">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Descripción</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $rowCosecha['tipo_cosecha'] ?>
                    </td>
                    <td>
                        <?php echo $rowCosecha['descripcion'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <div class="text-left">
        <p class="h5">Datos Adicionales</p>
        <strong>Código: </strong><?php echo $_GET['codigo']; ?>
        <br>
        <strong>Fecha: </strong><?php echo $rowCosecha['fecha']; ?>
        <br>
        <strong>Estado: </strong><?php if (!$rowCosecha['estado']) {
                                        echo 'En Proceso';
                                    } else {
                                        echo 'Vendido';
                                    } ?>
        <?php if ($rowCosecha['cantidad_tacho'] !== null) : ?>
            <br>
            <strong>Cantidad de Tachos: </strong><?php echo $rowCosecha['cantidad_tacho']; ?>
        <?php endif; ?>
        <?php if ($rowCosecha['cantidad_quintal'] !== null) : ?>
            <br>
            <strong>Cantidad de Quintal: </strong><?php echo $rowCosecha['cantidad_quintal']; ?>
        <?php endif; ?>
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

$nombre = "reporte-cosecha-" . $_GET['codigo'] . ".pdf";
$dompdf->stream($nombre, array("Attachment" => false));
