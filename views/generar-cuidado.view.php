<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Generar Cuidados</h1>
                    <?php if ($codigo !== '') : ?>
                        <div class="col-sm-6">
                            <a href="panel.php?modulo=finalizarCuidado" title="Finalizar Cuidado" class="text-primary"> <i class="fas fa-check-circle"></i> </a>
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
                                    <th>Cuidado</th>
                                    <th>Insumo</th>
                                    <th>Cantidad</th>
                                    <th>Acciones
                                        <a data-toggle="modal" data-target="#agregar" href="javascript:void(0);" title="Aregar Nuevo Cuidado"><i class="fa fa-plus" aria-hidden="true"></i></a>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                while ($row = mysqli_fetch_assoc($resCuidado)) :
                                    $trabajador = $row['trabajador'];
                                    $cod = $row['codigo'];
                                ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['insumo'] ?></td>
                                        <td><?php echo $row['cantidad_insumo'] ?></td>
                                        <td>
                                            <a data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_id').value = '<?= $row['id'] ?>';document.getElementById('delete_idcuidado').value = <?= $row['idcuidado'] ?>;document.getElementById('delete_codigo').value = '<?= $row['codigo'] ?>';" title="Eliminar Cuidado" class="text-danger"> <i class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Trabajador</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($_SESSION['codigoCuidado'] !== '') :
                                ?>
                                    <tr>
                                        <td><?php echo $cod ?></td>
                                        <td><?php echo $trabajador ?></td>
                                    </tr>
                                <?php
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

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
                <h4 class="modal-title" id="defaultModalLabel">Generar Cuidado</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-cuidado" id="ingresar" method="POST">
                    <?php if ($codigo == '') : ?>
                        <div class="form-group">
                            <label for="idtrabajador" class="mr-sm-2">Trabajador:</label>
                            <select name="idtrabajador" id="idtrabajador" class="form-control mb-2 mr-sm-2" required>
                                <option value="">Seleccione un Trabajador</option>
                                <?php while ($rowTrabajador = mysqli_fetch_assoc($resTrabajador)) : ?>
                                    <option value="<?php echo $rowTrabajador['id']; ?>"><?php echo $rowTrabajador['nombre']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="idinsumo" class="mr-sm-2">Insumo:</label>
                        <select name="idinsumo" id="idinsumo" class="form-control mb-2 mr-sm-2" required>
                            <option value="">Seleccione un Insumo para la Producción</option>
                            <?php while ($rowInsumo = mysqli_fetch_assoc($resInsumo)) : ?>
                                <option value="<?php echo $rowInsumo['id']; ?>"><?php echo $rowInsumo['nombre']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cantidad_insumo" class="mr-sm-2">Cantidad:</label>
                        <input type="number" class="form-control mb-2 mr-sm-2" placeholder="Ingrese una Cantidad de Insumo" id="cantidad_insumo" name="cantidad_insumo" min="1" required>
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
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Cuidado</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=generar-cuidado" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id" value="">
                    <input type="hidden" name="delete_idcuidado" id="delete_idcuidado" value="">
                    <input type="hidden" name="delete_codigo" id="delete_codigo" value="">
                    <div class="form-group">
                        <label>¿Seguro que deseas eliminar este Cuidado?</label>
                    </div>

                    <input type="submit" name="delete_cuidado" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!---fin modal Eliminar --->