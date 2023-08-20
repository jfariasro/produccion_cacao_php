<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
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
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Acciones
                                        <a data-toggle="modal" data-target="#AddModal" href="javascript:void(0);" title="Aregar Nuevo Usuario"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['nombre'] ?></td>
                                        <td><?php echo $row['usuario'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" data-target="#EditModal" href="javascript:void(0);" onclick="document.getElementById('id').value = <?= $row['id'] ?>;document.getElementById('email').value = '<?= $row['email'] ?>';document.getElementById('nombre').value = '<?= $row['nombre'] ?>';document.getElementById('usuario').value = '<?= $row['usuario'] ?>';" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_id').value = <?= $row['id'] ?>;document.getElementById('delete_nombre').innerHTML = '<?= $row['nombre'] ?>';" class="text-danger borrar"> <i class="fas fa-trash"></i> </a>
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

<!-- Modal para Ingresar -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nuevo Usuario</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=usuarios" id="ingresar" method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="add_email" id="add_email" class="form-control" placeholder="Email del Usuario" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="add_nombre" id="add_nombre" class="form-control" placeholder="Nombres del Usuario" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre de Usuario</label>
                        <input type="text" name="add_usuario" id="add_usuario" class="form-control" placeholder="Nombre de Usuario" required onkeypress="evitarEspacios(event)">
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="add_pass" class="form-control" placeholder="Clave del Usuario" required>
                    </div>

                    <input type="submit" name="ingresar_usuario" Value="Registrar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Modificar -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Editar Usuario</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=usuarios" method="POST">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" required onkeypress="evitarEspacios(event)">
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="pass" class="form-control">
                    </div>

                    <input type="submit" name="modificar_usuario" id="modificar_usuario" Value="Actualizar" class="btn btn-primary">

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
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Usuario</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=usuarios" method="POST">
                    <input type="hidden" name="delete_id" id="delete_id" value="">

                    <strong>
                        <p id="delete_nombre"></p>
                    </strong></label>


                    <div class="form-group">
                        <label class="mr-sm-2">¿Deseas Eliminar este Usuario?</label>
                    </div>

                    <input type="submit" name="eliminar_usuario" id="eliminar_usuario" Value="Eliminar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>