<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Compra Generada</h1>
                    <?php if ($_SESSION['codigoCompra'] !== '') : ?>
                        <div class="col-sm-6">
                            <a href="panel.php?modulo=finalizarCompra" title="Finalizar Compra" class="text-primary"> <i class="fas fa-check-circle"></i> </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Insumo</th>
                                    <th>Proveedor</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acciones
                                        <a data-toggle="modal" data-target="#agregar" href="javascript:void(0);" title="Aregar Nueva Compra"><i class="fa fa-plus" aria-hidden="true"></i></a>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($codigo)) :
                                    while ($row = mysqli_fetch_assoc($resCompra)) :
                                ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['codigo'] ?></td>
                                            <td><?php echo $row['insumo'] ?></td>
                                            <td><?php echo $row['proveedor'] ?></td>
                                            <td><?php echo $row['cantidad'] ?></td>
                                            <td><?php echo $row['precio'] ?></td>
                                            <td><?php echo $row['total'] ?></td>
                                            <td>
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_id').value = <?= $row['id'] ?>;document.getElementById('delete_codigo').value = <?= $row['codigo'] ?>;" title="Eliminar Compra" class="text-danger"> <i class="fas fa-trash"></i> </a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    endwhile;
                                endif; ?>
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
</div>


<div class="modal fade" id="agregar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nueva Compra</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-compra" id="ingresar" method="POST">
                    <div class="form-group">
                        <label for="idinsumo" class="mr-sm-2">Insumo:</label>
                        <select name="idinsumo" id="idinsumo" class="form-control mb-2 mr-sm-2" required>
                            <option value="">Seleccione un Insumo para la Compra</option>
                            <?php while ($rowInsumo = mysqli_fetch_assoc($resInsumo)) : ?>
                                <option value="<?php echo $rowInsumo['id']; ?>"><?php echo $rowInsumo['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <?php if ($_SESSION['codigoCompra'] == '') : ?>
                        <div class="form-group">
                            <label for="idproveedor" class="mr-sm-2">Proveedor:</label>
                            <select name="idproveedor" id="idproveedor" class="form-control mb-2 mr-sm-2" required>
                                <option value="">Seleccione un Proveedor para la Compra</option>
                                <?php while ($rowProveedor = mysqli_fetch_assoc($resProveedor)) : ?>
                                    <option value="<?php echo $rowProveedor['id']; ?>"><?php echo $rowProveedor['nombre']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="cantidad" class="mr-sm-2">Cantidad:</label>
                        <input type="number" class="form-control mb-2 mr-sm-2" placeholder="Ingrese una Cantidad" id="cantidad" name="cantidad" min="1" required>
                    </div>

                    <input type="submit" name="Guardar" Value="Registrar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Compra</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-compra" id="borrar" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id" value="">
                    <input type="hidden" name="delete_codigo" id="delete_codigo" value="">
                    <div class="form-group">
                        <label>¿Seguro que deseas eliminar esta compra?</label>
                    </div>

                    <input type="submit" name="delete_compra" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!---fin modal Eliminar --->