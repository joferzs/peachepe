<?php

require_once("MiSesion.php");

MiSesion::empezarSesion('sitio1');

echo "<br><br>pag1.php";

//Nombre de la sesion
echo "<br>session_name: ".session_name();

//Id de la sesion
$session_id = session_id();
echo "<br>session_id: ".$session_id;

//Variable de sesion usuario creada en la clase
echo "<br>Variable de sesion Usuario: ".$_SESSION['usuario'];

//Variable de sesion creada fuera de la clase para que pag2 la cache ya que es el mismo nombre de sesion
$_SESSION['super_variable']  = 'espere que salga';
echo "<br>super_variable: ".$_SESSION['super_variable'];

?>