<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Administrador
 */
$config['admin_name'] = "Administrador";

$config['admin_domain'] = "webapu.com/dev/sace/waadmin";
$config['admin_url'] = "http://" . $config['admin_domain'];
$config['admin_logo'] = $config['admin_url'] . "/images/logo-admin.png";

//Direcotio de admin
$config['admin_path'] = 'waadmin';


/**
 * Generales para el website
 */
$config['website']['dominio'] = "www.webapu.com";

/**
 * Configuración de email
 */
$config['waemail']['dominio'] = "www.webapu.com";
$config['waemail']['logo'] = "http://webapu.com/dev/muebleria/images/logo.png";
$config['waemail']['color'] = "#B32944";

/**
 * Monedas
 */
$config['monedas'] = array(
	'SOL' => array(
		'unidad_monetaria'=>'SOL',
		'denominacion' => "SOL",
		'plural' => 'ES',
		'simbolo' => "S/"
	),
	'USD' => array(
		'unidad_monetaria'=>'USD',
		'denominacion' => "DOLAR",
		'plural' => 'ES',
		'simbolo' => "$"
	)
);

/**
 * Días para fecha de vencimiento
 */
$config['dias_vencimiento'] = 15;