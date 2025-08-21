<?php
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
if ($basePath === '/') { $basePath = ''; }  // <- clave para evitar //
?>      
           
           <!-- Left Sidebar Start -->
            <div class="app-sidebar-menu">
                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="logo-box">
                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="/assets/images/favicon_dark.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="/assets/images/certiperu_logo_dark.png" alt="" height="40">
                                </span>
                            </a>
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="/assets/images/favicon.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="/assets/images/certiperu_logo.png" alt="" height="40">
                                </span>
                            </a>
                        </div>

                        <ul id="sidebar-menu">

                            <li class="menu-title mt-2">Nuevo Menu</li>

                            <li>
                                <a href="#sidebarAlumnos" data-bs-toggle="collapse">
                                    <span class="nav-icon">
                                        <iconify-icon icon="tabler:lock"></iconify-icon>
                                    </span>
                                    <span class="sidebar-text"> Alumnos </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAlumnos">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/alumnos/lista" class="tp-link"><i class="ti ti-point"></i>Alumnos</a>
                                        </li>
                                        <li>
                                            <a href="/alumnos/nuevo" class="tp-link"><i class="ti ti-point"></i>Nuevo Alumno</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarEmpresas" data-bs-toggle="collapse">
                                    <span class="nav-icon">
                                        <iconify-icon icon="tabler:server"></iconify-icon>
                                    </span>
                                    <span class="sidebar-text"> Empresas </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEmpresas">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/empresas/lista" class="tp-link"><i class="ti ti-point"></i>Empresas</a>
                                        </li>
                                        <li>
                                            <a href="/empresas/nuevo " class="tp-link"><i class="ti ti-point"></i>Nueva Empresas</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarCursos" data-bs-toggle="collapse">
                                    <span class="nav-icon">
                                        <iconify-icon icon="tabler:files"></iconify-icon>
                                    </span>
                                    <span class="sidebar-text"> Cursos </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCursos">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/cursos/lista" class="tp-link"><i class="ti ti-point"></i>Cursos</a>
                                        </li>
                                        <li>
                                            <a href="/cursos/nuevo" class="tp-link"><i class="ti ti-point"></i>Nuevo Curso</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarCertificados" data-bs-toggle="collapse">
                                    <span class="nav-icon">
                                        <iconify-icon icon="tabler:files"></iconify-icon>
                                    </span>
                                    <span class="sidebar-text"> Certificados </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCertificados">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/certificados/nuevo" class="tp-link"><i class="ti ti-point"></i>Nuevo Certificado</a>
                                        </li>
                                        <li>
                                            <a href="/certificados/lista" class="tp-link"><i class="ti ti-point"></i>List de Certificados</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>                               
                        </ul>
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->