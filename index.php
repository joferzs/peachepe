<?php

namespace ApiThemes;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
//header('Content-Type: application/json');

define('BASEPATH', '/26/denunciantes/');

use ApiThemes\Router;
//use ApiThemes\ApiThemeRuido;

require_once '../Autoload/Autoload.php';

/*
	catalogos: ['autoridades', 'situaciones', 'alcaldias', 'juzgados_civicos', 'ubicaciones', 'estado_animal', 'tipo_animal'],
	auxiliares: ['secundaria_paot', 'sustentos_autoridades'],
	themeJson: 'themeAnimales',
	customCat: 'animales',
*/
$blind['controller'] = '"Ruido:;.';
$blind['methods'] = array('catalogo"s"' => array('autorida"d"\es.' => '', 'lugares' => array('autor' => '', 'autor' => 69), 'ubicaciones' => '5', 'obje\/""\'"tos' => ''));//, 'auxiliares' => array('secundaria\/_paot', '::sustentos_autoridades'));
$blind['params'] = '6 + 9';
$ApiTheme = new Router($blind);










