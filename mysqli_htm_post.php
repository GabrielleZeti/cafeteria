<html>
<head><meta charset="UTF-8"></head>
<body style = "background: url(images/4554.jpg) no-repeat; background-size: cover">
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<form name="test" method="post" action="mysqli_htm_post.php">
<br />
<br />
  <p class="text-center">Nombre-Name: 
    <input type="text" name="Nombre" value="">
    <br />
    <br />
Edad  -  Age :    
<input type="text" name="Edad" value="">
<br />
<br />
Ciudad - City: 
<input type="text" name="Ciudad" value="">
<br />
<br />
<p class="text-center"><INPUT TYPE="submit"name="btnInsertar"  class="btn btn-secondary btn-lg" value="Insertar - Insert"></p>
<p class="text-center"><INPUT TYPE="submit"name="btnBorrar"  class="btn btn-secondary btn-lg" value="Borrar - Delete"></p>
<p class="text-center"><INPUT TYPE="submit"name="btnActualizar" class="btn btn-secondary btn-lg" value="Actualizar-Update"></p>
<p class="text-center"><INPUT TYPE="submit"name="btnBuscarNombre" class="btn btn-secondary btn-lg" value="Buscar por Nombre - Search by Name"></p>
<p class="text-center"><INPUT TYPE="submit"name="btnVerTabla" class="btn btn-secondary btn-lg" value="Ver Tabla-Show Table"></p>
</p>
<br />
<p class="text-center">Ordenar por (Nombre, Edad, Ciudad) - Sort by (Nombre, Edad, Ciudad): <input type="text" name="Columna" value="Nombre">
<INPUT TYPE="submit" name="btnOrdenar" class="btn btn-secondary btn-lg" value="Ordenar - Sort">
</p>
<p class="text-center"><INPUT TYPE="submit"name="btnPedidos"  class="btn btn-primary btn-lg" value="Ordenar Pedidos"></p>
<br />
<p class="text-center"><INPUT TYPE="submit"name="btnDesayunos"  class="btn btn-primary btn-lg" value="Desauyno"></p>
<br />
<p class="text-center"><INPUT TYPE="submit"name="btnAlmuerzos"  class="btn btn-primary btn-lg" value="Almuerzo"></p>
<br />
<p class="text-center"><INPUT TYPE="submit"name="btnCenas"  class="btn btn-primary btn-lg" value="Cena"></p>

<br />
</p>
</form>
</body>
</html>

<?php


// 1.- IDENTIFICACION nombre de la base, del usuario, clave y servidor

//$db_host="localhost";
//$db_name="id17053160_cafeteria";
//$db_login="id17053160_cafeteriacrud";
//$db_pswd="-6&KU2Z%Xb@q8Ju{";


//$db_host="localhost";
//$db_name="inventor";
//$db_login="root";
//$db_pswd="";

$db_host="localhost";
$db_name="inventor";
$db_login="piUrquilla";
$db_pswd="Gabriel2002";


// 2.- CONEXION A LA BASE DE DATOS
$link = new mysqli($db_host, $db_login, $db_pswd, $db_name);

///////////////////////////////   INSERTAR - INSERT ////////////////////////////////////
if(isset($_POST['btnInsertar'])){
    $Nombre = $_POST['Nombre'];
    $Edad = $_POST['Edad'];
    $Ciudad = $_POST['Ciudad'];
    $query="insert into personas (Nombre, Edad, Ciudad) values ('$Nombre','$Edad','$Ciudad')";
$result = mysqli_query($link, $query);
print("Datos agregados a la base.");
mysqli_close($link);
}
///////////////////////////////   BORRAR - DELETE  ////////////////////////////////////
if(isset($_POST['btnBorrar'])){
    $Nombre = $_POST['Nombre'];
    $query="delete from personas where Nombre='$Nombre'";
$result = mysqli_query($link, $query);
print("Datos borrados.");
mysqli_close($link);
}
//////////////////////////////   ACTUALIZAR - UPDATE  ///////////////////////////////
if(isset($_POST['btnActualizar'])){
    $Nombre = $_POST['Nombre'];
    $Edad = $_POST['Edad'];
    $Ciudad = $_POST['Ciudad'];
    $query="update personas set Edad='$Edad', Ciudad='$Ciudad' WHERE Nombre='$Nombre'";
$result = mysqli_query($link, $query);
print("Datos modificados.");
mysqli_close($link);
}

///////////////////// BUSCAR POR NOMBRE - SEARCH BY NAME /////////////////////////////
if(isset($_POST['btnBuscarNombre'])){
	$Nombre=$_POST['Nombre'];
	$hacer = mysqli_query ($link, "SELECT * FROM personas WHERE Nombre='$Nombre' ");
	enviar_respuesta($hacer);
}
/////////////////////// MOSTRAR TABLA - SHOW TABLE  /////////////////////////////////////
if(isset($_POST['btnVerTabla'])){
	$hacer = mysqli_query ($link, "SELECT * FROM personas");
	enviar_respuesta($hacer);
}

/////////////////////// OBTENER ORDENADO - GET SORT  /////////////////////////////////////
if(isset($_POST['btnOrdenar'])){
    $Columna=$_POST['Columna'];
	$hacer = mysqli_query ($link, "SELECT * FROM personas ORDER BY `$Columna` ASC");
	enviar_respuesta($hacer);
}

////////////////////////////// RESPUESTA - RESPONSE ///////////////////////
// En los casos que hay btnBuscarNombre o btnVerTabla y se debe enviar una respuesta actúa este código.
function enviar_respuesta($hacer)
{
$resultado = mysqli_query($GLOBALS['link'], "SHOW COLUMNS FROM personas");
$numerodefilas = mysqli_num_rows($resultado);
	if ($numerodefilas > 0) {
	$en_csv='';
		while ($rowr = mysqli_fetch_row($hacer)) {
			for ($j=0;$j<$numerodefilas;$j++) {
			$en_csv .= $rowr[$j].", ";
			}
		$en_csv .= "<br>"."\n";
		}
	}

print $en_csv;
}
///////////////////////////////////////////////////////////////////
?>