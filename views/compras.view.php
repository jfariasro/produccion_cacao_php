<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Compras</h1>
                    <?php if (isset($codigo)) : ?>
                        <div class="col-sm-6">
                            <a href="panel.php?modulo=compras" title="Ver Todo" class="text-primary"> <i class="fas fa-eye"></i> </a>
                        </div>
                    <?php endif; ?>
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
                                    <th>Proveedor</th>
                                    <th>Fecha</th>
                                    <th>total</th>
                                    <th>Detalle Compra
                                        <a href="panel.php?modulo=generar-compra" title="Generar Nueva Compra"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['codigo'] ?></td>
                                        <td><?php echo $row['proveedor'] ?></td>
                                        <td><?php echo $row['fecha'] ?></td>
                                        <td><?php echo $row['total'] ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-primary" title="Imprimir Factura" target="_blank" href="reportes/reporte-compras.php?codigo=<?php echo $row['codigo']; ?>" role="button"><i class="fas fa-file-pdf"></i> </a>
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