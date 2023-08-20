<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perfil de Usuario</h1>
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
                        <form method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="password" name="pass" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" name="usuario" class="form-control" value="<?php echo $row['usuario'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <button type="submit" class="btn btn-primary" name="modificar">Guardar</button>
                                <a href="panel.php" class="btn btn-warning">Cancelar</a>
                            </div>
                        </form>
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