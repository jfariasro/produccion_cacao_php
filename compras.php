<?php
require_once 'clases/clsCompras.php';

$compras = new Compra(-1, 0, 0, 0, 0, 0, '');

$res = $compras->Consultar($con);

require 'views/compras.view.php';