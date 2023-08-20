<?php

$query = "SELECT c.id, c.codigo, t.nombre as trabajador, c.fecha
FROM cuidado c join trabajadores t on t.id = c.idtrabajador
WHERE YEAR(c.fecha) = YEAR(NOW()) ORDER BY c.fecha DESC";
$res = mysqli_query($con, $query);

require_once 'views/cuidado.view.php';
