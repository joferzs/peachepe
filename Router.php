<?php

namespace ApiThemes;

defined('BASEPATH') OR exit('No direct script access allowed');

use ApiThemes\ApiThemeRuido;
//use ApiThemes\ApiThemeRuido;

/**
 * 
 */
class Router
{
	private $uri;
	private $controller;
	private $methods;
	private $params;
	private $ApiTheme;
	
	function __construct($uri)
	{
		//echo "<br>Router: "; print_r($uri);
		self::checkUri($uri);
		
		//Obtenemos el controller, al ser dinamico es necesario concatenar con el string el namcespace tambien
		$controller_class = "ApiThemes\ApiTheme" . $this->controller;
		//Obtenemos el metodo
		$methods_name = $this->methods;
		//Obtenemos los params
		$params = $this->params;

		echo "<br>controller_class:  ".$controller_class;
		echo "<br>method:  "; print_r($methods_name);
		echo "<br>param:  ".$params;
		echo "<br>end<br>";

		$this->ApiTheme = new $controller_class();

		self::evaluateMethods($methods_name);

		/*foreach ($methods_name as $key => $value) {
			echo "<br>key: " . $key;
			echo "<br>value: "; print_r($value);
			$main_method = "get" . $key;
			if (method_exists($ApiTheme, $main_method)) {
				$ApiTheme->$main_method(empty($value) ? '': $value);
			}else{
				http_response_code(405);
				echo json_encode(array('Error de methodo, line: ' . __LINE__ => $main_method . ' no existe en ' . $controller_class));
			}
		}*/
	}

	private function checkUri($uri) {
		$this->controller = isset($uri['controller']) ? self::cleanUri($uri['controller']) : self::errorRouter('controller');
		$this->methods = isset($uri['methods']) ? self::filterMethods($uri['methods']) : self::errorRouter('methods');
	}

	private function filterMethods($methods) {
		//self::showDebug(__FUNCTION__, $methods);
		if (is_array($methods)) {
			foreach ($methods as $key => $value) {
				$res["get" . self::cleanUri($key)] = self::filterMethods($value);
			}
		}else {
			$res = $methods;
		}
		return $res;
	}

	private function evaluateMethods($methods) {
		self::showDebug(__FUNCTION__, $methods);
		if (is_array($methods)) {
			foreach ($methods as $key => $value) {
				//$res[self::cleanUri($key)] = self::existMethods($value);
				self::existMethods($key);
				self::evaluateMethods($value);
			}
		}else {
			$res = $methods;
		}
	}
	private function existMethods($methods) {
		self::showDebug(__FUNCTION__, $methods);
		if (method_exists($this->ApiTheme, $methods)) {
			echo "<br>si existe";
			//$this->ApiTheme->$methods(empty($value) ? '': $value);
			$this->ApiTheme->$methods(1);
		}else{
			http_response_code(405);
			echo json_encode(array('Error de methodo, line: ' . __LINE__ => $methods . ' no existe en ' . $this->controller));
			exit;
		}
	}

	public function cleanUri($string) {
		return ucfirst(ereg_replace("[^A-Za-z0-9]", "", $string));
	}

	private function errorRouter($x) {
		echo json_encode(array($x => 'Error en uri, line: ' . __LINE__));
		exit;
	}

	private function showDebug($x, $y) {
		echo "<br><b>Init " . $x . "</b> showDebug:<br> ";
		if (is_array($y)) {
			//echo json_encode($a);
			echo "&nbsp;&nbsp; Es array: ";
			print_r($y);
		}else {
			//echo json_encode($a);
			echo "&nbsp;&nbsp; Es string: ";
			echo $y;
		}
		echo "<br>End debug<br>";
		//exit;
	}
}