<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>


        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->

            <a class="nav-link" title="Editar Perfil de Usuario" href="panel.php?modulo=perfilUsuario">
                <i class="far fa-user"></i>
            </a>
            <a class="nav-link text-danger" href="panel.php?modulo=cerrar" title="Cerrar sesion">
                <i class="fas fa-door-closed    "></i>
            </a>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="panel.php" class="brand-link">
            <img src="images/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Panel de Control</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/usuario.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="panel.php?modulo=perfilUsuario" class="d-block"><?php echo $_SESSION['nombre']; ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="fa fa-shopping-cart nav-icon" aria-hidden="true"></i>
                            <p>
                                Menú
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="panel.php?modulo=inicio" class="nav-link <?php echo ($modulo == "inicio" || $modulo == "") ? " active " : " "; ?>">
                                    <i class="fa fa-shopping-bag nav-icon" aria-hidden="true"></i>
                                    <p>Inicio</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=usuarios" class="nav-link <?php echo ($modulo == "usuarios") ? " active " : " "; ?>">
                                    <i class="fas fa-user nav-icon" aria-hidden="true"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=proveedores" class="nav-link <?php echo ($modulo == "proveedores") ? " active " : " "; ?>">
                                    <i class="fas fa-user-check nav-icon" aria-hidden="true"></i>
                                    <p>Proveedores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=clientes" class="nav-link <?php echo ($modulo == "clientes") ? " active " : " "; ?>">
                                    <i class="fas fa-user-circle nav-icon" aria-hidden="true"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=trabajadores" class="nav-link <?php echo ($modulo == "trabajadores") ? " active " : " "; ?>">
                                    <i class="fas fa-users nav-icon" aria-hidden="true"></i>
                                    <p>Trabajadores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=insumos" class="nav-link <?php echo ($modulo == "insumos") ? " active " : " "; ?>">
                                    <i class="fas fa-seedling nav-icon" aria-hidden="true"></i>
                                    <p>Insumos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=cuidado" class="nav-link <?php echo ($modulo == "cuidado" || $modulo == "generar-cuidado") ? " active " : " "; ?>">
                                    <i class="fas fa-hand-holding nav-icon" aria-hidden="true"></i>
                                    <p>Cuidados</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=compras" class="nav-link <?php echo ($modulo == "compras" || $modulo == "generar-compra") ? " active " : " "; ?>">
                                    <i class="fas fa-shopping-cart nav-icon" aria-hidden="true"></i>
                                    <p>Compras</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=ventas" class="nav-link <?php echo ($modulo == "ventas") ? " active " : " "; ?>">
                                    <i class="fas fa-shopping-basket nav-icon" aria-hidden="true"></i>
                                    <p>Ventas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="panel.php?modulo=cosecha" class="nav-link <?php echo ($modulo == "cosecha") ? " active " : " "; ?>">
                                    <i class="fas fa-tractor nav-icon" aria-hidden="true"></i>
                                    <p>Cosecha</p>
                                </a>
                            </li>

                        </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>