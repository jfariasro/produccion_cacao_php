<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cosechas</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Tipo</th>
                                    <th>Descripción</th>
                                    <th>Acciones
                                        <a data-toggle="modal" data-target="#AddModal" href="javascript:void(0);" title="Aregar Nueva Cosecha"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['codigo'] ?></td>
                                        <td><?php echo $row['tipo_cosecha'] ?></td>
                                        <td><?php echo $row['descripcion'] ?></td>
                                        <td>
                                            <div class="row">
                                                <?php if (!$row['estado']) : ?>
                                                    <div class="col-sm-3">
                                                        <a title="Vender Cosecha" data-toggle="modal" data-target="#VenderCosecha" href="javascript:void(0);" onclick="document.getElementById('idvender').value = <?= $row['id'] ?>;document.getElementById('ventapor').innerHTML = '<?= $row['tipo_cosecha'] ?>';document.getElementById('cantidad').value = '<?= $row['cantidad_tacho'] ?? $row['cantidad_quintal'] ?>';" style="margin-right: 5px;" class="text-success"> <i class="fas fa-check-circle"></i> </a>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <a title="Modificar Cantidad" data-toggle="modal" data-target="#EditModal" href="javascript:void(0);" onclick="Establecer(<?php echo $row['id']; ?>, <?php echo $row['cantidad_tacho'] ?? -1; ?>, <?php echo $row['cantidad_quintal'] ?? -1; ?>)" style="margin-right: 5px;"> <i class="fas fa-plus-circle"></i> </a>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <a title="Eliminar Cosecha" data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_id').value = <?= $row['id'] ?>;document.getElementById('delete_codigo').innerHTML = '<?= $row['codigo'] ?>';" class="text-danger borrar"> <i class="fas fa-trash"></i> </a>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="<?php if (!$row['estado']) {
                                                                echo 'col-sm-3';
                                                            } else {
                                                                echo 'col-sm-12 text-center';
                                                            } ?>">
                                                    <a class="txt-primary" title="<?php if (!$row['estado']) {
                                                                                        echo 'Ver Reporte';
                                                                                    } else {
                                                                                        echo 'Imprimir Reporte';
                                                                                    } ?>" target="_blank" href="reportes/reporte-cosecha.php?codigo=<?php echo $row['codigo']; ?>" role="button"><i class="fas fa-file-pdf"></i> </a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nueva Cosecha</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=cosecha" id="ingresar" method="POST">
                    <div class="form-group">
                        <label for="tipocosecha" class="mr-sm-2">Tipo Cosecha:</label>
                        <select name="tipocosecha" id="tipocosecha" onchange="Cosecha()" class="form-control mb-2 mr-sm-2" required>
                            <option value="">Seleccione Tipo de Cosecha</option>
                            <?php while ($rowTipo = mysqli_fetch_assoc($resTipo)) : ?>
                                <option value="<?php echo $rowTipo['id']; ?>"><?php echo $rowTipo['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group" id="tacho" style="display: none;">
                        <label for="aadcantidad_tacho" class="mr-sm-2">Cantidad de Tacho</label>
                        <input type="number" class="form-control mb-2 mr-sm-2" placeholder="Ingrese Cantidad de Tacho" id="addcantidad_tacho" name="addcantidad_tacho" min="1">
                    </div>
                    <div class="form-group" id="quintal" style="display: none;">
                        <label for="aadcantidad_quintal" class="mr-sm-2">Cantidad de Quintal</label>
                        <input type="number" class="form-control mb-2 mr-sm-2" placeholder="Ingrese Cantidad de Quintal" id="addcantidad_quintal" name="addcantidad_quintal" min="1">
                    </div>

                    <input type="submit" name="ingresar_cosecha" Value="Registrar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Editar Cantidad Cosecha</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=cosecha" method="POST">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="form-group" id="modquintal">
                        <label>Cantidad Quintal</label>
                        <input type="number" name="cantidad_quintal" id="cantidad_quintal" class="form-control" min="1">
                    </div>

                    <div class="form-group" id="modtacho">
                        <label>Cantidad Tacho</label>
                        <input type="number" name="cantidad_tacho" id="cantidad_tacho" class="form-control" min="1">
                    </div>

                    <input type="submit" name="modificar_cosecha" id="modificar_cosecha" Value="Actualizar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="VenderCosecha" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Vender Cosecha</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=cosecha" method="POST">
                    <input type="hidden" name="idvender" id="idvender" value="">
                    <input type="hidden" name="idcosecha" id="id" value="">

                    <div class="form-group">
                        <label class="mr-sm-2">Venta Por:</label>
                        <p id="ventapor"></p>
                    </div>

                    <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad de Venta" min="1">
                    </div>

                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" name="precio" step="0.01" min="0.1" class="form-control" placeholder="Precio de la Venta" required="required">
                    </div>

                    <div class="form-group">
                        <label for="idcliente" class="mr-sm-2">Cliente:</label>
                        <select name="idcliente" id="idcliente" class="form-control mb-2 mr-sm-2" required>
                            <option value="">Seleccione un Cliente para la Venta</option>
                            <?php while ($rowCliente = mysqli_fetch_assoc($resCliente)) : ?>
                                <option value="<?php echo $rowCliente['id']; ?>"><?php echo $rowCliente['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <input type="submit" name="vender_cosecha" id="vender_cosecha" Value="Vender" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Cosecha</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=cosecha" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id" value="">

                    <strong>
                        <p id="delete_codigo"></p>
                    </strong></label>


                    <div class="form-group">
                        <label class="mr-sm-2">¿Deseas Eliminar esta Cosecha?</label>
                    </div>

                    <input type="submit" name="eliminar_cosecha" id="eliminar_cosecha" Value="Eliminar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    //Toda variable de JavaScript se declara con var
    var tipo_cosecha = document.getElementById("tipocosecha"); //Hace referencia al primer select

    var cantidad_tacho = document.getElementById("tacho");
    var cantidad_quintal = document.getElementById("quintal");

    document.getElementById("addcantidad_tacho").value = '';
    document.getElementById("addcantidad_quintal").value = '';

    function Cosecha() {
        cantidad_tacho.style.display = "none";
        cantidad_quintal.style.display = "none";

        if (tipo_cosecha.value === "1") {
            cantidad_tacho.style.display = "block";
            document.getElementById("addcantidad_tacho").value = '0';
            document.getElementById("addcantidad_quintal").value = '';
        } else if (tipo_cosecha.value === "2") {
            cantidad_quintal.style.display = "block";
            document.getElementById("addcantidad_quintal").value = '0';
            document.getElementById("addcantidad_tacho").value = '';
        }
    }

    function Establecer(id, cantidad_tacho, cantidad_quintal) {
        document.getElementById('id').value = id;
        if (cantidad_tacho !== -1) {
            document.getElementById('modtacho').style.display = "block";
            document.getElementById('modquintal').style.display = "none";
            document.getElementById('cantidad_tacho').value = cantidad_tacho;
            document.getElementById("cantidad_quintal").value = '';
            document.getElementById("cantidad_tacho").required = true;
            document.getElementById('cantidad_quintal').required = false;
        } else if (cantidad_quintal !== -1) {
            document.getElementById('modquintal').style.display = "block";
            document.getElementById('modtacho').style.display = "none";
            document.getElementById('cantidad_quintal').value = cantidad_quintal;
            document.getElementById("cantidad_tacho").value = '';
            document.getElementById('cantidad_quintal').required = true;
            document.getElementById("cantidad_tacho").required = false;
        }

    }
</script>