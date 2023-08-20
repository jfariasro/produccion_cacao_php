<?php
require_once 'clases/regresionLineal.php';
// Definimos los datos de Ventas
mysqli_query($con, "SET lc_time_names = 'es_ES'");

$query = "SELECT DATE_FORMAT(fecha, '%M') AS mes, sum(total) as total FROM venta
WHERE MONTH(fecha) != MONTH(NOW()) AND MONTH(fecha) >= MONTH(NOW()) - 6
GROUP BY MONTH(fecha)";
$resVenta = mysqli_query($con, $query);
$datosVenta = array(
    array('Mes', 'Ven')
);

$mes = 1;
$x = array();
$y = array();
while ($row = mysqli_fetch_assoc($resVenta)) {
    array_push($datosVenta, array($row['mes'], (float) $row['total']));
    array_push($x, $mes);
    array_push($y, $row['total']);
    $mes++;
}

//Definimos los datos de Compras
$query = "SELECT DATE_FORMAT(fecha, '%M') AS mes, sum(total) as total FROM compras
WHERE MONTH(fecha) != MONTH(NOW()) AND MONTH(fecha) >= MONTH(NOW()) - 6
GROUP BY MONTH(fecha)";
$resCompra = mysqli_query($con, $query);
$datosCompra = array(
    array('Mes', 'Com')
);

while ($row = mysqli_fetch_assoc($resCompra)) {
    array_push($datosCompra, array($row['mes'], (float) $row['total']));
}

//Definimos los datos para el Control de Predicción
$ia = new IAphp();
$prediccionVentas = $ia->regresionLineal($x, $y);
$w = $prediccionVentas['w'];
$b = $prediccionVentas['b'];
$datosPrediccion = array_merge([], $datosVenta);
$datosPrediccion[0] = array('Mes', 'Ven', 'Prediccion');
$mes = 1;
for ($i = 1; $i < count($x) + 11; $i++) {
    $venta = $w * ($i + 1) + $b;

    if ($mes > count($x)) {
        setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain');

        $nombre_mes = strftime('%B', mktime(0, 0, 0, $mes, 1));
        array_push($datosPrediccion, array($nombre_mes, null, $venta));
    } else {
        $datosPrediccion[$i] = array($datosPrediccion[$i][0], $datosPrediccion[$i][1], $venta);
    }

    $mes++;
}

$query = "SELECT COUNT(id) AS num from venta
where fecha BETWEEN DATE( DATE_SUB(NOW(),INTERVAL 7 DAY) ) AND NOW(); ";
$resNumVentas = mysqli_query($con, $query);
$rowNumVentas = mysqli_fetch_assoc($resNumVentas);

$query = "SELECT COUNT(id) AS num from clientes; ";
$resNumClientes = mysqli_query($con, $query);
$rowNumClientes = mysqli_fetch_assoc($resNumClientes);

$query = "SELECT sum(total) AS total FROM venta
WHERE MONTH(fecha) = MONTH(NOW())";
$resActual = mysqli_query($con, $query);
$rowActual = mysqli_fetch_assoc($resActual);

require 'views/inicio.view.php';
