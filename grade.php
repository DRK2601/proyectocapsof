<?php
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";

$description='';
$id= '';
if(isset($_POST['save']))
{

$description = mysqli_real_escape_string($conn,$_POST['description']);

 if($_POST['action']=="add")
 {
 
  $sql = $conn->query("INSERT INTO grade (description) VALUES ('$description')") ;  
    echo '<script type="text/javascript">window.location="grade.php?act=1";</script>';
 
 }else
  if($_POST['action']=="update")
 {
 $id = mysqli_real_escape_string($conn,$_POST['id']);	
   $sql = $conn->query("UPDATE  `grade`  SET   `description`  = '$description'  WHERE `id`  = '$id'");
   echo '<script type="text/javascript">window.location="description.php?act=2";</script>';
 }
}

if(isset($_GET['action']) && $_GET['action']=="delete"){
$conn->query("UPDATE  grade set delete_status = '1'  WHERE id='".$_GET['id']."'");
header("location: grade.php?act=3");
}

$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['id'])?mysqli_real_escape_string($conn,$_GET['id']):'';

$sqlEdit = $conn->query("SELECT * FROM grade WHERE id='".$id."'");
if($sqlEdit->num_rows)
{
$rowsEdit = $sqlEdit->fetch_assoc();
extract($rowsEdit);
$action = "update";
}else
{
$_GET['action']="";
}

}

if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'><strong>Súper!!!</strong> Grado agregado exitósamente</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'><strong>Súper!!!</strong> Grado editado exitósamente</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'><strong>Súper!!!</strong> Grado eliminado exitósamente</div>";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Control Escolar</title>

    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <link href="css/basic.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />	
	 <script src="js/jquery-1.10.2.js"></script>
	
</head>
<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Grados
						<?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="grade.php" class="btn btn-primary btn-sm pull-right">Volver <i class="glyphicon glyphicon-arrow-right"></i></a>':'<a href="grade.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Agregar Grado </a>';
						?>
						</h1>
                     
<?php

echo $errormsg;
?>
                    </div>
                </div>
				
        <?php 
		 if(isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")
		 {
		?>
		
			<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
                <div class="row">
				
                    <div class="col-sm-8 col-sm-offset-2">
               <div class="panel panel-primary">
                        <div class="panel-heading">
                           <?php echo ($action=="add")? "Agregar Grado": "Editar Grado"; ?>
                        </div>
						<form action="grade.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
						
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Confirm"> Descripcion</label>
								<div class="col-sm-10">
                                <input type="text" class="form-control" id="description" name="description" value="<?php echo $description;?>"  />
								</div>
							</div>
					
						<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<input type="hidden" name="action" value="<?php echo $action;?>">
								<center>
									<button type="submit" name="save" class="btn btn-primary">Guardar </button>
		                        </center>
								</div>
							</div>
                         </div>
							</form>
                        </div>
                            </div>
                </div>
            
		<script type="text/javascript">

		$( document ).ready( function () {			
			
			 if($("#signupForm1").length > 0)
         {
			$( "#signupForm1" ).validate( {
				rules: {
					description: "requerido"
				},
				messages: {
					description: "Porfavor ingrese un grado"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-10" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );
			}			
		} );
	</script>
			   
		<?php
		}else{
		?>
		 <link href="css/datatable/datatable.css" rel="stylesheet" />
		 
		<div class="panel panel-default">
                        <div class="panel-heading">
                            Administrar Información de los Grados  
                        </div>
                        <div class="panel-body">
                             <div class="table-sorting table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Grado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "select * from grade where delete_status='0'";
									$q = $conn->query($sql);
									$i=1;
									while($r = $q->fetch_assoc())
									{
									echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['description'].'</td>
											<td>
											<a href="grade.php?action=edit&id='.$r['id'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>					
											<a onclick="return confirm(\'Realmente deseas continuar. Si confirmas el registro se eliminará de manera irreversible\');" href="grade.php?action=delete&id='.$r['id'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a> </td>
                                        </tr>';
										$i++;
									}
									?>
						              
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     
	<script src="js/dataTable/jquery.dataTables.min.js"></script>
     <script>
         $(document).ready(function () {
             $('#tSortable22').dataTable({
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": true });
         });
	
    </script>
		
		<?php
		}
		?>
				
            </div>
        </div>
    </div>

    <div id="footer-sec">
    <i class="fa fa-support fa-1x"></i><strong>       UNIVERSIDAD PRIVADA DEL NORTE - 2022</strong>
    </div>

    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.metisMenu.js"></script>
    <script src="js/custom1.js"></script>
</body>
</html>
