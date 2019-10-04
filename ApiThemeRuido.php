<?php

namespace ApiThemes;

defined('BASEPATH') OR exit('No direct script access allowed');

/*use Database\Database;
use PDO as PIDO;

require_once '../Autoload/Autoload.php';*/

/**
 * 
 */
class ApiThemeRuido extends ApiThemeMain {

	private $conn;
	private $items_arr = array();
	
	function __construct() {
		echo "<br><b>Ruido __construct</b>";
		parent::__construct();
	}

	public function getLugares($x) {
		return self::getOneTableCat($x);
	}
	public function getObjetos($x) {
		return self::getOneTableCat($x);
	}
	public function getTiposRuido($x) {
		return self::getOneTableCat($x);
	}
}












