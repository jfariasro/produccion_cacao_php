<?php

$query = "SELECT v.id, c.nombre as cliente, co.codigo,
v.fecha, v.total FROM
venta v JOIN clientes c ON v.idcliente = c.id
JOIN cosecha co ON v.idcosecha = co.id
ORDER BY v.fecha DESC";
$res = mysqli_query($con, $query);

require 'views/ventas.view.php';