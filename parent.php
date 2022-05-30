<?php
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";

$id="";
$name='';
$surname='';
$dni='';
$age='';
$address='';
$parentship='';
$gender='';
$email='';
$phone='';

if(isset($_POST['save']))
{

$name=mysqli_real_escape_string($conn,$_POST['name']);
$surname=mysqli_real_escape_string($conn,$_POST['surname']);
$dni=mysqli_real_escape_string($conn,$_POST['dni']);
$age=mysqli_real_escape_string($conn,$_POST['age']);
$address=mysqli_real_escape_string($conn,$_POST['address']);
$parentship=mysqli_real_escape_string($conn,$_POST['parentship']);
$gender=mysqli_real_escape_string($conn,$_POST['gender']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$phone=mysqli_real_escape_string($conn,$_POST['phone']);

 if($_POST['action']=="add")
 {
  $q1 = $conn->query("INSERT INTO parent (name,surname,dni,age,address,parentship,gender,email,phone) VALUES ('$name','$surname','$dni','$age','$address','$parentship','$gender','$email','$phone')") ;
   echo '<script type="text/javascript">window.location="parent.php?act=1";</script>';
 }else

  if($_POST['action']=="update")
 {
   $id = mysqli_real_escape_string($conn,$_POST['id']);	
   $sql = $conn->query("UPDATE  `parent`  SET  `name`='$name',`surname`='$surname',`dni`='$dni',`age`='$age',`address`='$address',`parentship`='$parentship',`gender`='$gender',`email`='$email',`phone`='$phone'  WHERE  `id`  = '$id'");
   echo '<script type="text/javascript">window.location="parent.php?act=2";</script>';
 }
}

if(isset($_GET['action']) && $_GET['action']=="delete"){
$conn->query("UPDATE  parent set delete_status = '1'  WHERE id='".$_GET['id']."'");	
header("location: parent.php?act=3");
}

$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['id'])?mysqli_real_escape_string($conn,$_GET['id']):'';

$sqlEdit = $conn->query("SELECT * FROM parent WHERE id='".$id."'");
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
$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Excelente!</strong> Apoderado Agregado Exitósamente</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Excelente!</strong> Apoderado Editado Exitósamente</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Excelente!</strong> Apoderado Eliminado Exitósamente</div>";
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
	<link href="css/ui.css" rel="stylesheet" />
	<link href="css/datepicker.css" rel="stylesheet" />	
    <script src="js/jquery-1.10.2.js"></script>
    <script type='text/javascript' src='js/jquery/jquery-ui-1.10.1.custom.min.js'></script>
   
	
</head>
<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Apoderados  
						<?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="parent.php" class="btn btn-primary btn-sm pull-right">Volver <i class="glyphicon glyphicon-arrow-right"></i></a>':'<a href="parent.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Agregar Apoderado </a>';
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
				
                    <div class="col-sm-10 col-sm-offset-1">
               <div class="panel panel-primary">
                        <div class="panel-heading">
                           <?php echo ($action=="add")? "Agregar Apoderado": "Editar Apoderado"; ?>
                        </div>
						<form action="parent.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
						<fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Información Personal:</legend>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Nombre* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>"  />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Apellido* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="surname" name="surname" value="<?php echo $surname;?>"  />
								</div>
							</div>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">DNI* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="dni" name="dni" value="<?php echo $dni;?>" maxlength="8" />
								</div>
							</div>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Edad* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="age" name="age" value="<?php echo $dni;?>"  />
								</div>
							</div>
                            <div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Direccion* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="address" name="address" value="<?php echo $address;?>"  />
								</div>
							</div>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Parentesco* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="parentship" name="parentship" value="<?php echo $parentship;?>"  />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Genero* </label>
								<div class="col-sm-10">
									<select  class="form-control" id="gender" name="gender" >
									<option value="" >Selecciona Genero</option>
									<option value="" >Masculino</option>
									<option value="" >Femenino</option>
                                    			
									</select>
									<br>
								</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Email* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>"  />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Telefono* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone;?>" maxlength="9"  />
								</div>
							</div>
						 </fieldset>
						
						
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
					dni: "requerido",
					telefono: "requerido"
				},
				messages: {
					dni: "Porfavor ingrese su numero de dni",
					telefono: "Porfavor ingrese su numero de telefono"	
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
                            Administrar Información de los Apoderados  
                        </div>
                        <div class="panel-body">
                             <div class="table-sorting table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
											<th>Apellido</th>
                                            <th>DNI</th>
                                            <th>Direccion</th>
                                            <th>Telefono</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "select * from parent where delete_status='0'";
									$q = $conn->query($sql);
									$i=1;
									while($r = $q->fetch_assoc())
									{
									echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['name'].'</td>
                                            <td>'.$r['surname'].'</td>
                                            <td>'.$r['dni'].'</td>
											<td>'.$r['address'].'</td>
											<td>'.$r['phone'].'</td>
											<td>
											<a href="parent.php?action=edit&id='.$r['id'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
											<a onclick="return confirm(\'Realmente deseas continuar. Si confirmas el registro se eliminará de manera irreversible\');" href="parent.php?action=delete&id='.$r['id'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a> </td>
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
    <script src="js/custom1.js"></script>V
</body>
</html>
