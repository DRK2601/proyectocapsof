
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="index.php">Prisma Lima Norte</a><img class="img-thumbnail" id="imguser" src="img/log.png" width="75px">
            </div>

        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <!-- <div class="user-img-div">
                            <img src="img/user.png" class="img-thumbnail" />

                            <div class="inner-text">
                                <?php echo $_SESSION['rainbow_name'];?>
                            <br />
                               
                            </div>
                        </div> -->

                    </li>


                    <li>
                        <a class="active-menu" href="index.php"><i class="fa fa-dashboard "></i>Panel de Control</a>
                    </li>
					
					 <li>
                        <a href="student.php"><i class="fa fa-mortar-board "></i>Estudiantes</a>
                    </li>
					<!--
					 <li>
                        <a href="fees.php"><i class="fa fa-usd "></i>Pagos</a>
                    </li>
-->
					<li>
                        <a href="register.php"><i class="fa fa-file-text "></i>Matriculas</a>
                    </li>
					 <li>
                        <a href="parent.php"><i class="fa fa-users "></i>Apoderados </a>
                    </li>
                    <!--
                    <li>
                        <a href="report.php"><i class="fa fa-credit-card "></i>Reporte de Pagos</a>
                    </li>
-->
					<li>
                        <a href="user.php"><i class="fa fa-wrench "></i>Usuarios</a>
                    </li>
                    <li>
                        <a href="branch.php"><i class="fa fa-bank "></i>Bancos</a>
                    </li>
                    
                    <li>
                        <a href="grade.php"><i class="fa fa-folder "></i>Grados</a>
                    </li>
                    <li>
                        <a href="setting.php"><i class="fa fa-cogs "></i>Configuración</a>
                    </li>
					
					 <li>
                        <a href="logout.php"><i class="fa fa-power-off "></i>Cerrar Sesión</a>
                    </li>
					
			
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->