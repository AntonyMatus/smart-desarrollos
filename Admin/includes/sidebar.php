<!-- ========== Left Sidebar Start ========== -->
<?php session_start(); ?>
<div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Main</li>
                            
                            <?php  $permission = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
                            
                            
                            ?>
                            <?php if ($permission): ?>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-user"></i><span> Usuarios <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="lista_usuarios.php">Lista Usuarios</a></li>
                                    <li><a href="crear_usuario.php">Crear Usuario</a></li>
                                    
                                </ul>
                            </li>
                            <?php endif ?>
                            
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-suitcase"></i><span> Tours <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="lista_tour.php">Lista Tours</a></li>
                                    <li><a href="crear_tour.php">Crear Tour</a></li>
                                    
                                </ul>
                            </li>


                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->