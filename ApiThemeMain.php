<?php

namespace ApiThemes;

defined('BASEPATH') OR exit('No direct script access allowed');

use Database\Database;
use PDO;

/**
 * 
 */
class ApiThemeMain {

	private $conn;
	private $items_arr = array();

	function __construct() {
		//parent::__construct();
		echo "<br><b>Main __construct</b>";
		$db = new Database();
		$this->conn = $db->pdo;
	}

	public function getListCatalogos($q) {//getListAuxUno 		$q['page'] => 'AuxUno' id_auxuno
		if ($q['themeJson'] == 'themeAnimales') {
			self::getListJoin('themeAnimales');
			//exit;
		}
		if (isset($q['customCat'])) {
			$method = self::cleanMethodName('getCustom' . $q['customCat']);
			self::$method();
			//exit;
		}
		foreach ($q['auxiliares'] as $key => $value) {
			$method = self::cleanMethodName('get' . $value);
			if (method_exists($this, $method)) {
				$sth = $this->conn->prepare(self::$method($value), array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute();
				if ($sth->rowCount() > 0) {
					$this->items_arr[$value]=array();
					while ($row = $sth->fetch(PDO::FETCH_BOTH)){
						//array_push($this->items_arr[$value], $row);
						$this->items_arr[$value][$row[0]] = $row;
				    }
				}else{
					$this->items_arr[$value] = array("mensaje" => "Sin coincidencias encontradas.");
				}
				$sth = null;
			}else{
				http_response_code(405);
				echo json_encode(array("msg" => 'Método ' . $value . ' no existe, ATD:' . __LINE__));
				exit;
			}
		}
		foreach ($q['catalogos'] as $key => $value) {
			$method = self::cleanMethodName('getList' . $value);
			if (method_exists($this, $method)) {
				$sth = $this->conn->prepare(self::$method($value), array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute();
				if ($sth->rowCount() > 0) {
					$this->items_arr[$value]=array();
					while ($row = $sth->fetch(PDO::FETCH_BOTH)){
						//array_push($this->items_arr[$value], $row);
						$this->items_arr[$value][$row[0]] = $row;
				    }
				}else{
					$this->items_arr[$value] = array("mensaje" => "Sin coincidencias encontradas.");
				}
				$sth = null;
			}else{
				http_response_code(405);
				echo json_encode(array("msg" => 'Método ' . $value . ' no existe, ATD:' . __LINE__));
				exit;
			}
		}
		http_response_code(200);
		echo json_encode($this->items_arr);
	}

	public function getCatalogos($cat) {
		echo "<br>Main catal";
		/*print_r($cat);
		//self::readMethodsLoop($cat);
		array_filter($cat, array($this, 'readMethodsLoop'));*/
	}

	private function readMethodsLoop($method) {
		self::showDebug(__FUNCTION__, $method);
		$sth = $this->conn->prepare(self::$method($value), array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute();
		if ($sth->rowCount() > 0) {
			$this->items_arr[$value]=array();
			while ($row = $sth->fetch(PDO::FETCH_BOTH)){
				//array_push($this->items_arr[$value], $row);
				$this->items_arr[$value][$row[0]] = $row;
		    }
		}else{
			$this->items_arr[$value] = array("mensaje" => "Sin coincidencias encontradas.");
		}
		$sth = null;
	}

	protected function getAutoridades($x) {
		return self::getOneTableCat($x);
	}

	private function getOneTableCat($tab) {
		return 'SELECT * FROM cat_' . strtolower($tab) . ' WHERE activo = "S"';
	}

	private function getOneTableAux($tab) {
		return 'SELECT * FROM aux_' . strtolower($tab);
	}

	private function getTwoTable($tab, $tab2) {
		$column = $tab2;
		//$column = substr(strtolower($tab2), 0, -1);
		return 'SELECT a.*, b.' . $column . ' FROM cat_' . strtolower($tab) . ' a INNER JOIN cat_' . $tab2 . ' b ON a.id_' . $column . ' = b.id_' . $column . ' WHERE a.activo = "S"';
	}

	public function showDebug($x, $y) {
		echo "<br><b>" . $x . "</b> showDebug:<br> ";
		if (is_array($y)) {
			//echo json_encode($a);
			echo "&nbsp;&nbsp; Es array: ";
			print_r($y);
		}else {
			//echo json_encode($a);
			echo "&nbsp;&nbsp; Es string: ";
			echo $y;
		}
		exit;
	}
}







