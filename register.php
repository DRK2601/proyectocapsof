<?php
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";

$id="";
$number='';
$joindate = '';
$remark='';
$id_student='';
$id_grade = '';
$id_parent='';
$id_branch='';
$fees = '';
$balance=0;


if(isset($_POST['save']))
{

$number = mysqli_real_escape_string($conn,$_POST['number']);
$joindate = mysqli_real_escape_string($conn,$_POST['joindate']);
$id_student = mysqli_real_escape_string($conn,$_POST['id_student']);
$id_grade = mysqli_real_escape_string($conn,$_POST['id_grade']);
$id_parent = mysqli_real_escape_string($conn,$_POST['id_parent']);
$id_branch = mysqli_real_escape_string($conn,$_POST['id_branch']);



 if($_POST['action']=="add")
 {
 $remark = mysqli_real_escape_string($conn,$_POST['remark']);
 $fees = mysqli_real_escape_string($conn,$_POST['fees']);
 $advancefees = mysqli_real_escape_string($conn,$_POST['advancefees']);
 $balance = $fees-$advancefees;
 
  $q1 = $conn->query("INSERT INTO register (number,joindate,id_student,id_grade,id_parent,id_branch,fees,balance) VALUES ('$number','$joindate','$id_student','$id_grade','$id_parent','$id_branch','$fees','$balance')") ;
  
  $sid = $conn->insert_id;
  
 $conn->query("INSERT INTO  fees_transaction (stdid,paid,submitdate,transcation_remark) VALUES ('$sid','$advancefees','$joindate','$remark')") ;
    
   echo '<script type="text/javascript">window.location="register.php?act=1";</script>';
 
 }else
  if($_POST['action']=="update")
 {
 $id = mysqli_real_escape_string($conn,$_POST['id']);	
   $sql = $conn->query("UPDATE  `register`  SET  `number`='$number',`joindate`='$joindate',`id_student`='$id_student',`id_grade`='$id_grade',`id_parent`='$id_parent',`id_branch`='$id_branch'  WHERE  `id`  = '$id'");
   echo '<script type="text/javascript">window.location="register.php?act=2";</script>';
 }



}




if(isset($_GET['action']) && $_GET['action']=="delete"){

$conn->query("UPDATE  register set delete_status = '1'  WHERE id='".$_GET['id']."'");	
header("location: register.php?act=3");

}


$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['id'])?mysqli_real_escape_string($conn,$_GET['id']):'';

$sqlEdit = $conn->query("SELECT * FROM register WHERE id='".$id."'");
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
$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Excelente!</strong> Matricula Agregada Exitósamente</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Excelente!</strong> Matricula Editada Exitósamente</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Excelente!</strong> Matricula Eliminada Exitósamente</div>";
}

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
                        <h1 class="page-head-line">Matriculas  
						<?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="register.php" class="btn btn-primary btn-sm pull-right">Volver <i class="glyphicon glyphicon-arrow-right"></i></a>':'<a href="register.php?action=add" class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Agregar Matricula </a>';
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
                           <?php echo ($action=="add")? "Agregar Matricula": "Editar Matricula"; ?>
                        </div>
						<form action="register.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
						<fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Información Personal:</legend>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Matricula* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="number" name="number" value="<?php echo $number;?>"  />
								</div>
							</div>
                            <div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Fecha de Inicio* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="joindate" name="joindate" value="<?php echo  ($joindate!='')?date("Y-m-d", strtotime($joindate)):'';?>" style="background-color: #fff;" readonly />
								</div>
							</div>
                            
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Estudiante* </label>
								<div class="col-sm-10">
									<select  class="form-control" id="id_student" name="id_student" >
									<option value="" >Selecciona Estudiante</option>
                                    <?php
									$sql = "select * from student where delete_status='0' order by dni asc";
									$q = $conn->query($sql);
									
									while($r = $q->fetch_assoc())
									{
									echo '<option value="'.$r['id'].'"  '.(($id_student==$r['id'])?'selected="selected"':'').'>'.$r['dni'].'</option>';
									}
									?>									
									
									</select>
								</div>
						</div>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Grado* </label>
								<div class="col-sm-10">
									<select  class="form-control" id="id_grade" name="id_grade" >
									<option value="" >Seleccione Grado</option>
                                    <?php
									$sql = "select * from grade where delete_status='0' ";
									$q = $conn->query($sql);
									
									while($r = $q->fetch_assoc())
									{
									echo '<option value="'.$r['id'].'"  '.(($id_grade==$r['id'])?'selected="selected"':'').'>'.$r['description'].'</option>';
									}
									?>									
									
									</select>
								</div>
						</div>
                        <div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Apoderado* </label>
								<div class="col-sm-10">
									<select  class="form-control" id="id_parent" name="id_parent" >
									<option value="" >Selecciona Apoderado</option>
                                    <?php
									$sql = "select * from parent where delete_status='0' order by dni asc";
									$q = $conn->query($sql);
									
									while($r = $q->fetch_assoc())
									{
									echo '<option value="'.$r['id'].'"  '.(($id_student==$r['id'])?'selected="selected"':'').'>'.$r['dni'].'</option>';
									}
									?>									
									
									</select>
								</div>
						</div>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Banco* </label>
								<div class="col-sm-10">
									<select  class="form-control" id="id_branch" name="id_branch" >
									<option value="" >Selecciona Banco</option>
                                    <?php
									$sql = "select * from branch where delete_status='0'";
									$q = $conn->query($sql);
									
									while($r = $q->fetch_assoc())
									{
									echo '<option value="'.$r['id'].'"  '.(($id_student==$r['id'])?'selected="selected"':'').'>'.$r['name'].'</option>';
									}
									?>									
									
									</select>
								</div>
						</div>
						
						 </fieldset>
						
						
							<fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Información de Tarifas:</legend>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Deuda Total* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="fees" name="fees" value="<?php echo $fees;?>" <?php echo ($action=="update")?"disabled":""; ?>  />
								</div>
						</div>
						
						<?php
						if($action=="add")
						{
						?>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Pago Adelantado* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="advancefees" name="advancefees" readonly   />
								</div>
						</div>
						<?php
						}
						?>
						
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Deuda Restante </label>
								<div class="col-sm-10">
									<input type="text" class="form-control"  id="balance" name="balance" value="<?php echo $balance;?>" disabled />
								</div>
						</div>
						
						
						
							
							<?php
						if($action=="add")
						{
						?>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Password">Comentario </label>
								<div class="col-sm-10">
	                        <textarea class="form-control" id="remark" name="remark"><?php echo $remark;?></textarea >
								</div>
							</div>
						<?php
						}
						?>
							
							</fieldset>
							
						<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<input type="hidden" name="action" value="<?php echo $action;?>">
								
								<center>	<button type="submit" name="save" class="btn btn-primary">Guardar </button>
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
			
		$( "#joindate" ).datepicker({
dateFormat:"yy-mm-dd",
changeMonth: true,
changeYear: true,
yearRange: "1970:<?php echo date('Y');?>"
});	
		

		
		if($("#signupForm1").length > 0)
         {
		 
		 <?php if($action=='add')
		 {
		 ?>
		 
			$( "#signupForm1" ).validate( {
				rules: {
					number: "Requerido",
					joindate: "Requerido",
					
					
					fees: {
						required: true,
						digits: true
					},
					
					
					advancefees: {
						required: true,
						digits: true
					},
				
					
				},
			<?php
			}else
			{
			?>
			
			$( "#signupForm1" ).validate( {
				rules: {
					number: "Requerido",
					joindate: "Requerido",
					
				},
			
			
			
			<?php
			}
			?>
				
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
		
		
		
		$("#fees").keyup( function(){
		$("#advancefees").val("");
		$("#balance").val(0);
		var fee = $.trim($(this).val());
		if( fee!='' && !isNaN(fee))
		{
		$("#advancefees").removeAttr("readonly");
		$("#balance").val(fee);
		$('#advancefees').rules("add", {
            max: parseInt(fee)
        });
		
		}
		else{
		$("#advancefees").attr("readonly","readonly");
		}
		
		});
		
		
		
		
		$("#advancefees").keyup( function(){
		
		var advancefees = parseInt($.trim($(this).val()));
		var totalfee = parseInt($("#fees").val());
		if( advancefees!='' && !isNaN(advancefees) && advancefees<=totalfee)
		{
		var balance = totalfee-advancefees;
		$("#balance").val(balance);
		
		}
		else{
		$("#balance").val(totalfee);
		}
		
		});
		
		
	</script>


			   
		<?php
		}else{
		?>
		
		 <link href="css/datatable/datatable.css" rel="stylesheet" />
		 
		
		 
		 
		<div class="panel panel-default">
                        <div class="panel-heading">
                            Administrar Información de las Matriculas  
                        </div>
                        <div class="panel-body">
                            <div class="table-sorting table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Numero</th>
                                            <th>Fecha de Registro</th>
                                            <th>Deuda Total</th>
											<th>Deuda Restante</th>
											<th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "select * from register where delete_status='0'";
									$q = $conn->query($sql);
									$i=1;
									while($r = $q->fetch_assoc())
									{
									
									echo '<tr '.(($r['balance']>0)?'class="danger"':'').'>
                                            <td>'.$i.'</td>
                                            <td>'.$r['number'].'</td>
                                            <td>'.date("d M y", strtotime($r['joindate'])).'</td>
                                            <td>'.$r['fees'].'</td>
											<td>'.$r['balance'].'</td>
											<td>
											
											

											<a href="register.php?action=edit&id='.$r['id'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Deseas realmente eliminar este registro, este proceso es irreversible\');" href="register.php?action=delete&id='.$r['id'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a> </td>
											
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
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": true });
	
         });
		 
	
    </script>
		
		<?php
		}
		?>
				
				
            
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <div id="footer-sec">
    <i class="fa fa-support fa-1x"></i><strong>       UNIVERSIDAD PRIVADA DEL NORTE - 2022</strong>
    </div>
   
   
  
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="js/custom1.js"></script>V

    
</body>
</html>
