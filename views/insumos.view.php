<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Insumos</h1>
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
                                    <th>Insumo</th>
                                    <th>Precio</th>
                                    <th>Existencia</th>
                                    <th>Imagen</th>
                                    <th>Acciones
                                        <a data-toggle="modal" data-target="#AddModal" href="javascript:void(0);" title="Aregar Nuevo Insumo"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['nombre'] ?></td>
                                        <td><?php echo $row['precio'] ?></td>
                                        <td><?php echo $row['existencia'] ?></td>
                                        <td>
                                            <img src="upload/<?php echo $row['imagen']; ?>" alt="<?php echo $row['nombre'] ?>" title="<?php echo $row['nombre'] ?>" width="25px" height="25px">
                                        </td>
                                        <td>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a title="Modificar Insumo" data-toggle="modal" data-target="#EditModal" href="javascript:void(0);" onclick="document.getElementById('id').value = <?= $row['id'] ?>;document.getElementById('nombre').value = '<?= $row['nombre'] ?>';document.getElementById('precio').value = '<?= $row['precio'] ?>';document.getElementById('existencia').value = '<?= $row['existencia'] ?>';" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a title="Eliminar Insumo" data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_id').value = <?= $row['id'] ?>;document.getElementById('delete_nombre').innerHTML = '<?= $row['nombre'] ?>';" class="text-danger borrar"> <i class="fas fa-trash"></i> </a>
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
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nuevo Insumo</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=insumos" id="ingresar" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="add_nombre" id="add_nombre" class="form-control" placeholder="Nombres del Insumo" required>
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" name="add_precio" step="0.01" min="0.1" class="form-control" placeholder="Precio del Insumo" required="required">
                    </div>
                    <div class="form-group">
                        <label>Existencia</label>
                        <input type="number" name="add_existencia" min="1" class="form-control" placeholder="Existencias del Insumo" required="required">
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="file" name="add_imagen" min="1" class="form-control" required="required" accept=".jpg, .jpeg, .png">
                    </div>

                    <input type="submit" name="ingresar_insumo" Value="Registrar" class="btn btn-primary">

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
                <h4 class="modal-title" id="defaultModalLabel">Editar Insumos</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=insumos" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" name="precio" id="precio" step="0.01" min="0.1" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label>Existencia</label>
                        <input type="number" name="existencia" id="existencia" min="1" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="file" name="imagen" min="1" class="form-control" accept=".jpg, .jpeg, .png">
                    </div>

                    <input type="submit" name="modificar_insumo" id="modificar_insumo" Value="Actualizar" class="btn btn-primary">

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
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Insumo</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=insumos" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id" value="">

                    <strong>
                        <p id="delete_nombre"></p>
                    </strong></label>


                    <div class="form-group">
                        <label class="mr-sm-2">¿Deseas Eliminar este Insumo?</label>
                    </div>

                    <input type="submit" name="eliminar_insumo" id="eliminar_insumo" Value="Eliminar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>