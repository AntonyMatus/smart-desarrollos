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
                                <a href="#" class="waves-effect"><i class="fas fa-user"></i><span> Usuarios <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="lista_usuarios.php">Lista Usuarios</a></li>
                                    <li><a href="crear_usuario.php">Crear Usuario</a></li>
                                    
                                </ul>
                            </li>
                            <?php endif ?>
                            
                            <li>
                                <a href="#" class="waves-effect"><i class="fab fa-blogger-b"></i><span> Blogs <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="lista_blog.php">Lista Blog</a></li>
                                    <li><a href="crear_blog.php">Crear Blog</a></li>
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="waves-effect"><i class="fas fa-building"></i><span> Proyectos <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="lista_projects.php">Lista Proyectos</a></li>
                                    <li><a href="crear_project.php">Crear Proyecto</a></li>
                                    
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