<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Administrador
 */
$config['admin_name'] = "Administrador";

$config['admin_domain'] = "localhost/waapp";
$config['admin_url'] = "http://" . $config['admin_domain'];
$config['admin_logo'] = $config['admin_url'] . "/images/logo-admin.png";

//Direcotio de admin
$config['admin_path'] = 'waadmin';


/**
 * Generales para el website
 */
$config['website']['dominio'] = "www.muebleriabelen.com";

/**
 * Configuración de email
 */
$config['waemail']['dominio'] = "www.muebleriabelen.com";
$config['waemail']['logo'] = "http://webapu.com/dev/muebleria/images/logo.png";
$config['waemail']['color'] = "#B32944";