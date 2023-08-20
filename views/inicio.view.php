<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Panel de Control</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $rowNumVentas['num'] ?? 0; ?></h3>
                            <p>Ventas en los ultimos 7 dias</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="panel.php?modulo=ventas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-4">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $rowNumClientes['num'] ?? 0; ?></h3>
                            <p>Clientes</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="panel.php?modulo=clientes" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-4">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo '$' . $rowActual['total']; ?></h3>
                            <p>Total de Ventas en el Mes Actual</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-eye"></i>
                        </div>
                        <a href="panel.php?modulo=cosecha" class="small-box-footer">Nueva Venta <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-6">
                    <div id="chart_div" style="height: 500px;">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div id="chart_div2" style="height: 500px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header bg-light py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 text-left">
                    <h1 class="m-1 text-dark text-center">Control Predicción</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container -->
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->




<script>
    $(document).ready(function() {
        Grafica(<?php echo json_encode($datosVenta); ?>, 'Ventas por mes', 'chart_div');
        Grafica(<?php echo json_encode($datosCompra); ?>, 'Compras por mes', 'chart_div2');
        Graficar(<?php echo json_encode($datosPrediccion); ?>);
    });
</script>

<script src="js/graficos/venta.js"></script>