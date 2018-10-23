<?php

//Llamo a la misma sesion
session_name("sitio1_Session");

echo "<br><br>pag2.php";

echo "<br>session_name: ".session_name();

session_start();

//Tendría que pintar el mismo id que de la pag1.php (No lo hace :( )
echo "<br>session_id: ".session_id();

//Pintamos la variable de sesion creada en la clase
echo "<br>variable sesion usuario: ".$_SESSION['usuario'];

//Pintamos la variable de sesion creada en la pag1.php fuera de la clase
echo "<br>super_variable: ".$_SESSION['super_variable'];

?>