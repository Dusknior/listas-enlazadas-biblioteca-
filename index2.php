<?php
error_reporting(0);
	include("Metodos.php");

	session_start();
	if (!isset($_SESSION['lista'])) {
	  $_SESSION['lista'] = new Metodos;
	} 

?>

<html>
<head>
	<title>Biblioteca</title>
	<style>
		body{
		    background: white;
		    font-family: Times New Roman;
		}
		select{
			appearance: none;
			-webkit-appearance: none
		}
		 h3{
		    font-size: 20px;
		     color: #000;
		}
		 .intro{
		    background: #fd974f;
		     padding: 13px;
		     margin-left: 0px;
		     color: white;
		     font-family: Times New Roman;
		}
		 .run {
		    display: inline-block;
		     background: #fd974f;
		     padding: 10px 35px;
		     border-radius: 50px;
		     color: white;
		     border: 10px;
		     text-decoration: none;
		     font-family: cursive;
		     letter-spacing: 1px;
		     font-size: 15px;
		     cursor: pointer;
		     position: absolute;
		     top: 140px;
		     right:68pc;
		}
		 .busca{
		    position: absolute;
		     top: 141px;
		     right: 705px;
		}
		 .can{
		    position: absolute;
		     top: 141px;
		     right:48pc;
		}
		 .edit{
		    position: absolute;
		     top: 140px;
		     right: 31px;
		}
		 .registro{
		     font-size: 15px;
		     padding: 7px 2px;
		     font-family: normal;
		     background: white;
		     border-radius: 10px;
		     outline: 0px;
		     border: 1px solid #fd974f;
		     padding: 10px;
		     border-radius: 0;
		}
		 .estilo:hover{
		    background: #fd974f;
		     color: white;
		}
		 .estilo {
		    display: inline-block;
		     background: #ffffff;
		     padding: 10px 15px;
		     border-radius: 50px;
		     color: #fd974f;
		     border: 10px;
		     text-decoration: none;
		     font-family: cursive;
		     letter-spacing: 1px;
		     font-size: 15px;
		     cursor: pointer;
		}
		 .enviar {
		    display: inline-block;
		    background: #fd974f;
		    padding: 10px 40px;
		    border-radius: 0;
		    color: white;
		    border: 10px;
		    text-decoration: none;
		    font-family: Times New Roman;
		    letter-spacing: 1px;
		    font-size: 15px;
		    cursor: pointer;
		    text-align: center;
		    text-transform: uppercase;
		     box-sizing: border-box;
		 }
		     
	</style>
</head>

<body>
	<h1 class="intro"> <center>BIBLIOTECA MANGUS</center></h1>

<div >
	
</div>
	<?php

	if ($_POST['indicador'] == "editorial") {
		$editorial = new Nodo_editorial($_POST["idE"], $_POST["name"]);

		$_SESSION['lista']->AgregarEditorial($editorial);
		
	}
	
		if ($_POST['libro'] == "libr" ) {
		$N_libro = new Nodo_libro(
			$_POST["idL"], 
			$_POST["titulo"], 
			$_POST["autor"], 
			$_POST["pais"], 
			$_POST["ano"],
			$_POST["cantidad"]
		);
		$nodoEditorial = $_SESSION['lista']->BuscarEditorial($_POST["id"]);
		$_SESSION['lista']->AgregarLibro($N_libro, $nodoEditorial);
		}
		
?>
	<style type="text/css">
		.met1{
			width: 500px;
			    margin: 70px auto;
			    background: #fff;
			    padding: 40px;
			    box-shadow: 0px 0px 19px 0px #a9a4a4;

		}
		.met1 fieldset{
			border:0;
			padding:0;
			margin-bottom: 10px !important
		}
		.met1 input,
		.met1 select{
			width: 100%;
		    margin: 0 !important;
		    position: relative;
		    top: 0;
		    left: 0;
		    border-radius: 0 !important;
		    font-family: Times New Roman;
		    font-size: 14px;
		    text-transform: uppercase;
		}
		h3{text-transform: uppercase;}
	</style>
	<form  action="index2.php" method="get" class="met1">
			<h3>FUNCIONES BIBLIOTECARIAS</h3>
			<input type="hidden" name="buscar" value="consult" class="registro">
			<fieldset id="hh" style="display: none">
				<input class="registro" type="text" name="CANT" placeholder="segunda editorial o cantidades" ">
			</fieldset>

			<fieldset>
				<input class="registro" type="text" name="IDL" placeholder="ingrese el id " style="margin-left:80%">
			</fieldset>

			<fieldset>
				<input class="registro" type="text" name="IA" placeholder="ingrese el año " style="margin-left:80%">
			</fieldset>

			<fieldset>
				<select class="registro" name="IDE" id="">
					<option value="">Seleccione editorial</option>
					<?php 
					$E = $_SESSION['lista']->getEditoriales();
						foreach ($E as $editorial) {
						echo '<option value="'.$editorial['id'].'">'.$editorial["name"].'</option>' ;
						}
					?>
				</select>
			</fieldset>

			<fieldset>
				<select class="registro" name="funcion" id="funciones">
					<option value="">Seleccione funcion</option>
					<option value="be">Buscar editorial</option>
					<option value="bl">Buscar libro</option>
					<option value="ee">eliminar editorial</option>
					<option value="el">eliminar libro</option>
					<option value="ael">actualizar EJEMPLARES de un libro</option>
					<option value="vee">vaciar ejemplares de un editorial</option>
					<option value="clb">numero de libros en la biblioteca</option>
					<option value="cle">numero de libros en la biblioteca por editorial</option>
					<option value="cla">numero de libros en la biblioteca por año</option>
				</select>
			</fieldset>

			<input type="submit" name="envie" class="run">
	</form>


<div>
	<form action="index2.php" method="post" class="met1" >
		<h3>Agregar Editorial</h3>

		<input  class="registro" type="hidden" name="indicador" value="editorial">

		<input type="text" name="name" placeholder="name" class="registro">
		<br><br>
		<input type="text" name="idE" placeholder="Id" class="registro">
		<br><br >
		<input type="submit" value="añadir" class="enviar">
		<br><br>
	</form>

</div>

<div >

	<form action="index2.php" method="post" class="met1">
		<h3>Agregar libro</h3>
		<input type="hidden" name="libro" value="libr">
		
		 <select class="registro" name="id" id="">
			<option value="">Seleccione editorial</option>
			<?php 
				$E = $_SESSION['lista']->getEditoriales();
				foreach ($E as $editorial) {
					echo '<option value="'.$editorial['id'].'">'.$editorial["name"].'</option>' ;
				}
			?>
		</select>
		 
		<br><br>

		<input type="text" name="idL" placeholder="Id" class="registro">
		<br><br>

		<input type="text" name="titulo" placeholder="Titulo" class="registro">
		<br><br>

		<input type="text" name="autor" placeholder="Autor" class="registro">
		<br><br>

		<input type="text" name="pais" placeholder="Pais" class="registro">
		<br><br>

		<input type="text" name="ano" placeholder="Año" class="registro">
		<br><br>
		
		<input type="text" name="cantidad" placeholder="Cantidad" class="registro">
		<br><br>

		<input type="submit" value="añadir" class="enviar" >
		<br>
	</form>	
</div>

 <?php  

 		$mostrar = $_SESSION['lista']->getLibros();
		for ($i=0; $i < count($mostrar) ; $i++) { 
			echo $mostrar[$i];
		}
	 

	 if (isset($_GET['buscar'] )) {
	 	if ($_GET['funcion'] == "be") {
	 		
	 		echo $_SESSION['lista']->DetalleEditorial($_GET["IDE"]);

	 	}

	 	if ($_GET['funcion']== "bl") {
	 		
	 		echo $_SESSION['lista']->Detallelibro($_GET["IDE"],$_GET["IDL"]);
	   	
	 	}

	 	if ($_GET['funcion']== "ee") {
	 		 
	   	$resul= $_SESSION['lista']->EliminarEditarial($_GET["IDE"]);
	   		if ($resul==true) {
	   			echo "<br><hr>Editorial eliminada con exito!" ;
	   		}else{
	   			echo "<br><hr>La editorial no se pudo eliminar" ;
	   		}
	 	}

	 	if ($_GET['funcion']=="el") {
	 		 
	   		$result=$_SESSION['lista']->Eliminarlibro($_GET["IDE"],$_GET["IDL"]);
	   		if ($result) {
	   			echo "<br><hr>El libro fue eliminado con exito!";
	   		}else{
	   			echo "<br><hr>No se pudo eliminar el libro";
	   		}

	 	}

	 	if ($_GET['funcion']=="ael") {
	 		 
	 		$result = $_SESSION['lista']->ActualizarInventarioL($_GET["IDL"],$_GET["IDE"], $_GET["CANT"]);
	 		
	   		if ($result) {
	   			echo "<br><hr>Se ha actualizado el numero de ejemplares del libro buscado";

	   		}
	   	
	 	}

	 	if ($_GET['funcion'] == "vee") {
	 		
	   	$result = $_SESSION['lista']->VaciarEjemplares($_GET["IDE"]);
	   		if ($result) {
	   			echo "<br><hr>Se han borrado todos los ejemplares";
	   		}
	   		else{
	   			echo "<br><hr>La editorial no existe";
	   		}

	 	}

	 	if ($_GET['funcion']== "clb") {
	 		 
	   	$result = $_SESSION['lista']->cantidadLibros();
	   	echo "<br><hr>El numero de libros en la biblioteca es: ".$result." libros";
	 	}

	 	if ($_GET['funcion']== "cle") {
	 		 
	   	$result = $_SESSION['lista']->cantidadLibrosEditorial($_GET["IDE"]);
	   	echo "<br><hr>El numero de libros en la biblioteca por editorial es: ".$result." libros";
	 	}

	 	if ($_GET['funcion']== "cla") {
	 		 
	   	$result = $_SESSION['lista']->cantidadLibrosAno($_GET["IA"]);
	   	echo "<br><hr>El numero de libros en la biblioteca por año es: ".$result." libros";
	 	}
	
	   	
	}	
	


 ?>

		<script src="jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$("#funciones").change(function(){
					var value = $(this).val();
					if (value == "ael" || value == "mle") {
						$("#hh").fadeIn(500)
					}else{
						$("#hh").fadeOut(500)
					}
				})
			})
		</script>
</body>
</html>