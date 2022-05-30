<?php
include("php/dbconnect.php");
include("php/checklogin.php");


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Control Escolar</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


</head>
<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Panel de Control</h1>
                        <br><br>
                        <h2 style="text-align:center;"> Has accedido al <strong>Sistema de Control Escolar</strong> </h2>
                        <br><br>

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
				  
                    <div class="col-md-4">
                        <div class="main-box mb-prisma">
                            <a href="student.php">
                                <i class="fa fa-mortar-board fa-5x"></i>
                                <h5>Estudiantes</h5>
                            </a>
                        </div>
                    </div>
				
                   
					
                    <div class="col-md-4">
                        <div class="main-box mb-dull">
                            <a href="fees.php">
                                <i class="fa fa-usd fa-5x"></i>
                                <h5>Pagos</h5>
                            </a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4">
                        <div class="main-box mb-prisma">
                            <a href="register.php">
                                <i class="fa fa-file-text fa-5x"></i>
                                <h5>Matriculas</h5>
                            </a>
                        </div>
                    </div>
                  

                </div>

                <div class="row">
				  
                    <div class="col-md-4">
                        <div class="main-box mb-prisma">
                            <a href="parent.php">
                                <i class="fa fa-users fa-5x"></i>
                                <h5>Apoderados</h5>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="main-box mb-dull">
                            <a href="report.php">
                                <i class="fa fa-credit-card fa-5x"></i>
                                <h5>Reporte de Pagos</h5>
                            </a>
                        </div>
                    </div>
                  
					
                    <div class="col-md-4">
                        <div class="main-box mb-prisma">
                            <a href="user.php">
                                <i class="fa fa-wrench fa-5x"></i>
                                <h5>Usuarios</h5>
                            </a>
                        </div>
                    </div>
					
					
					 
                  

                </div>

                <div class="row">

                <div class="col-md-4">
                        <div class="main-box mb-prisma">
                            <a href="branch.php">
                                <i class="fa fa-bank fa-5x"></i>
                                <h5>Bancos</h5>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="main-box mb-prisma">
                            <a href="grade.php">
                                <i class="fa fa-folder fa-5x"></i>
                                <h5>Grados</h5>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="main-box mb-prisma">
                            <a href="setting.php">
                                <i class="fa fa-cogs fa-5x"></i>
                                <h5>Configuración</h5>
                            </a>
                        </div>
                    </div>
                  

                    
				

                </div>
                <!-- /. ROW  -->

            
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <div id="footer-sec">
    <i class="fa fa-support fa-1x"></i><strong>       UNIVERSIDAD PRIVADA DEL NORTE - 2022</strong>
    </div>
   
   <script src="js/jquery-1.10.2.js"></script>	
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="js/custom1.js"></script>
    


</body>
</html>
