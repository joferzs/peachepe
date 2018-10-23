<?php

Class MiSesion {
	public static function empezarSesion($name, $limit = 0, $path = '/', $domain = null, $secure = null) {
		//Establecemos el nombre de la cookie antes de empezar
		session_name($name . '_Session');
		echo "<br>-Init Class-";
		echo "<br>session_name: ".session_name();

		//Establecemos el dominio por defecto al dominio actual
		$domain = isset($domain) ? $domain :isset($_SERVER['SERVER_NAME']);

		//Establecemos el valor seguro por defecto asi tenga acceso SSL
		$https = isset($secure) ? $secure : isset($_SERVER['HTTPS']);

		//Establecemos configuracion de cookie y empezamos la sesión
		session_set_cookie_params($limit, $path, $domain, $secure, true);
		session_start();

		echo "<br>session_id: ".session_id();

		$_SESSION = array();

		//Unimos el nombre del sitio con palabra _user para crear variable de sesión usuario
		$_SESSION['usuario'] = $name.'_user';
		echo "<br>variable de sesión usuario: ".$_SESSION['usuario'];

		echo "<br>-End Class-";
	}
}

?>