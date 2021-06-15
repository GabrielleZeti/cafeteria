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

$boton = $_POST['boton'];

///////////////////////////////   INSERTAR - INSERT ////////////////////////////////////
if ($boton == "btnInsertar"){
    $Nombre = $_POST['Nombre'];
    $Edad = $_POST['Edad'];
    $Ciudad = $_POST['Ciudad'];
    $query="insert into personas (Nombre, Edad, Ciudad) values ('$Nombre','$Edad','$Ciudad')";
$result = mysqli_query($link, $query);
print("Datos agregados a la base.");
mysqli_close($link);
}
///////////////////////////////   BORRAR - DELETE  ////////////////////////////////////
if ($boton == "btnBorrar"){
    $Nombre = $_POST['Nombre'];
    $query="delete from personas where Nombre='$Nombre'";
$result = mysqli_query($link, $query);
print("Datos borrados.");
mysqli_close($link);
}
//////////////////////////////   ACTUALIZAR - UPDATE  ///////////////////////////////
if ($boton == "btnActualizar"){
    $Nombre = $_POST['Nombre'];
    $Edad = $_POST['Edad'];
    $Ciudad = $_POST['Ciudad'];
    $query="update personas set Edad='$Edad', Ciudad='$Ciudad' WHERE Nombre='$Nombre'";
$result = mysqli_query($link, $query);
print("Datos modificados.");
mysqli_close($link);
}

///////////////////// BUSCAR POR NOMBRE - SEARCH BY NAME /////////////////////////////
if ($boton == "btnBuscarNombre"){
	$Nombre=$_POST['Nombre'];
	$hacer = mysqli_query ($link, "SELECT * FROM personas WHERE Nombre='$Nombre' ");
	enviar_respuesta($hacer);
}
/////////////////////// MOSTRAR TABLA - SHOW TABLE  /////////////////////////////////////
if ($boton == "btnVerTabla"){
	$hacer = mysqli_query ($link, "SELECT * FROM personas");
	enviar_respuesta($hacer);
}
/////////////////////// OBTENER ORDENADO - GET SORT  /////////////////////////////////////
if ($boton == "btnOrdenar"){
	$Columna = $_POST['Columna'];
	$hacer = mysqli_query ($link, "SELECT * FROM personas ORDER BY $Columna ASC");
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
		$en_csv .= "\n";
		}
	}

print $en_csv;
}
///////////////////////////////////////////////////////////////////
?>