<?php
$codigo = $_SESSION['codigoCuidado'] ?? '';

if (isset($_POST['delete_cuidado'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_id'] ?? '');
    $idcuidado = mysqli_real_escape_string($con, $_POST['delete_idcuidado'] ?? '');
    $query = "DELETE from detalle_cuidado where id = '$id';";
    $res = mysqli_query($con, $query);
    if ($res) {
        $codigo = mysqli_real_escape_string($con, $_POST['delete_codigo'] ?? '');
        $query = "SELECT count(*) as total from detalle_cuidado where idcuidado = '$idcuidado';";
        $res = mysqli_query($con, $query);
        $rowCantidad = mysqli_fetch_assoc($res);

        if ($rowCantidad['total'] == 0) {
            $query = "DELETE from cuidado where codigo = '$codigo';";
            $res = mysqli_query($con, $query);
            $_SESSION['mensaje'] = '<b>Los Cuidados se Eliminaron Correctamente</b>';
            $_SESSION['codigoCuidado'] = '';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-cuidado" />  ';
        } else {
            MensajeExitoso("<b>Cuidado Eliminado Correctamente</b>");
        }
    } else {
        MensajeError("<b>Error al borrar el Cuidado</b>");
    }
} else if (isset($_POST['Guardar'])) {
    $codigo = $_SESSION['codigoCuidado'] ?? '';
    $idinsumo = $_POST['idinsumo'];
    $cantidad_insumo = $_POST['cantidad_insumo'];

    if ($codigo == '') {
        $idtrabajador = $_POST['idtrabajador'];
    } else {
        $query = "SELECT id FROM cuidado WHERE codigo = '$codigo'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        $idcuidado = $row['id'];
    }

    $query = "SELECT existencia FROM insumos WHERE id = '$idinsumo'";
    $res = mysqli_query($con, $query);
    $rowInsumo = mysqli_fetch_assoc($res);
    $existencia = $rowInsumo['existencia'];

    $total = $existencia - $cantidad_insumo;

    if ($total > 0) {
        if ($codigo !== '') {
            $query = "INSERT INTO detalle_cuidado(idcuidado, idinsumo, cantidad_insumo)
                VALUES('$idcuidado', '$idinsumo', '$cantidad_insumo')";
        } else {
            $query = "INSERT INTO cuidado(idtrabajador)
            VALUES('$idtrabajador')";
            $res = mysqli_query($con, $query);
            if ($res) {
                $obtenerid = mysqli_insert_id($con);
                $_SESSION['codigoCuidado'] =  $obtenerid . '' . $_SESSION['idInicio'];
                $codigo = $_SESSION['codigoCuidado'];

                $queryModificar = "UPDATE cuidado SET codigo = '$codigo' WHERE id = '$obtenerid'";
                $resModificar = mysqli_query($con, $queryModificar);

                $query = "INSERT INTO detalle_cuidado(idcuidado, idinsumo, cantidad_insumo)
                VALUES('$obtenerid', '$idinsumo', '$cantidad_insumo')";
            } else {
                $_SESSION['error'] = 'Error al registrar el cuidado';
                echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-cuidado" />  ';
            }
        }
        $resInsertar = mysqli_query($con, $query);
        if ($resInsertar) {
            $_SESSION['mensaje'] = '<b>Cuidado Registrado Correctamente</b>';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-cuidado" />  ';
        } else {
            $_SESSION['error'] = 'El Cuidado No Pudo ser Registrado';
            echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-cuidado" />  ';
        }
    } else {
        $_SESSION['error'] = 'Stock Insuficiente';
        echo '<meta http-equiv="refresh" content="0; url=panel.php?modulo=generar-cuidado" />  ';
    }
}

$query = "SELECT dc.id, dc.idcuidado, c.codigo, dc.idinsumo, i.nombre as insumo,
t.nombre as trabajador, dc.cantidad_insumo FROM
detalle_cuidado dc join cuidado c on dc.idcuidado = c.id
join trabajadores t on c.idtrabajador = t.id join insumos i on i.id = dc.idinsumo
where c.codigo = '$codigo';";
$resCuidado = mysqli_query($con, $query);

$query = "SELECT * FROM insumos i
WHERE i.id NOT IN (
  SELECT dc.idinsumo
  FROM detalle_cuidado dc JOIN cuidado c
  ON c.id = dc.idcuidado
  WHERE c.codigo = '$codigo'
)";
$resInsumo = mysqli_query($con, $query);

$query = "SELECT * FROM trabajadores";
$resTrabajador = mysqli_query($con, $query);

require 'views/generar-cuidado.view.php';
