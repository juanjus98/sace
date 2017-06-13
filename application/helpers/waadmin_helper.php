<?php

/**
 * Helper del Sistema
 *
 * funciones helper que ayudan al desarrollo de modulos del sistema
 *
 * @package		Helper del Sistema
 * @author		Juan Julio Sandoval Layza
 * @copyright           Winner System 
 * @since		07-04-2014
 * @version		Version 1.0
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**/

if (!function_exists('wamenu')) {

    function wamenu() {
        $menu = array(
            'inicio' => 'Inicio',
            'Servicios' => array(
                'categorias_servicios/index' => 'Categorías',
                'servicios/index' => 'Servicios'
            ),
            'Productos' => array(
                'categorias/index' => 'Categorías',
                'marcas/index' => 'Marcas',
                'productos/index' => 'Productos'
            ),
//            'clientes' => 'Clientes',
            'Páginas' => array(
//                'paginas/home' => 'Home',
                'paginas/nosotros' => 'Nosotros',
//                'paginas/servicios' => 'Servicios',
//                'paginas/clientes' => 'Clientes',
//                'paginas/soporte' => 'Soporte',
//                'paginas/descargas' => 'Descargas',
//                'paginas/pagos' => 'Pagos',
//                'paginas/contactenos' => 'Contáctenos'
            ),
//            'contactos' => 'Contactos',
            'Secciones' => array(
                'slider/index' => 'Slider',
//                'carousel/index' => 'Carousel',
//                'links/index' => 'Links'
            ),
            'Noticias' => array(
                'noticias_categoria/index' => 'Categorías',
                'noticias/index' => 'Noticias'
            )
        );
        return $menu;
    }

}

if (!function_exists('crear_menu')) {

    function crear_menu($menu) {
        $nav = '';

        foreach ($menu as $key => $value) {
            if (is_array($value)) {
                $nav .= '<li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">' . $key . ' <b class="caret"></b></a>' . PHP_EOL;
                $nav .= '<ul class="dropdown-menu">' . PHP_EOL . crear_menu($value) . PHP_EOL . '</ul>';
                $nav .= '</li>' . PHP_EOL;
            } else {
                $nav .= '<li' . activar_link($key) . '><a href="' . base_url() . "waadmin/" . $key . '">' . $value . '</a></li>' . PHP_EOL;
            }
        }
        return $nav;
    }

}

if (!function_exists('activar_link')) {

    function activar_link($link) {
        $ci = & get_instance();
        $clase = $ci->router->fetch_class();
        $divide = '/';
        $metodo = $ci->router->fetch_method();

        if (isset($metodo) && $metodo != 'index') {
            $link_url = $clase . $divide . $metodo;
        } else {
            $link_url = $clase;
        }

        return ($link_url === $link) ? ' class="active"' : '';
    }

}

/**
 * Setear importe
 *
 * Setea un importe con su respectivo simbolo de moneda
 * 
 * @category    Utilitarios
 * @author      Juan Julio Sandoval Layza
 * @since       2017-06-2017
 * @version     Version 1.0
 */
if (!function_exists('setImporte')) {

    function setImporte($importe,$moneda) {
        $ci = & get_instance();
        $ci->config->load('waconfig', TRUE);
        $monedas = $ci->config->item('monedas');
        $dataMoneda = $monedas[$moneda];
        $strImporte = $dataMoneda['simbolo'] . " " .$importe;
        return $strImporte;
    }

}


/**
 * Mensajes
 *
 * Crea mensajes de exito y error
 * 
 * @category		Utilitarios
 * @author		Juan Julio Sandoval Layza
 * @since		26-02-2015
 * @version		Version 1.0
 */
if (!function_exists('msj')) {

    function msj() {
        $CI = & get_instance();
        $str = "";

        if ($CI->session->userdata("msj_success")) {
            $str = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $CI->session->userdata("msj_success") . '</div>';
            $CI->session->unset_userdata("msj_success");
        }

        if ($CI->session->userdata("msj_error")) {
            $str = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $CI->session->userdata("msj_error") . '</div>';
            $CI->session->unset_userdata("msj_error");
        }

        return $str;
    }

}

/**
 * Paginacion
 *
 * Genera paginacion de registros
 * 
 * @category		Utilitarios
 * @author		Juan Julio Sandoval Layza
 * @since		16-02-2015
 * @version		Version 1.0
 */
if (!function_exists('set_paginacion')) {

    function set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows) {
        $config = array();
        $config["base_url"] = $base_url;
        $config["per_page"] = $per_page;
        $config["uri_segment"] = $uri_segment;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $num_links;

        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config["total_rows"] = $total_rows;

        return $config;
    }

}

/**
 * Select Categorias
 *
 * Genera un campo de tipo select para  Categorias
 *
 * @category	Utilitarios
 * @author		Juan Julio Sandoval Layza
 * @since		26-02-2015
 * @version		Version 1.0
 */
if (!function_exists("select_categorias")) {

    function select_categorias($nombre = null, $tabla = null, $selected = null) {
        $CI = & get_instance();
        $html = '';
        $padres = $CI->db->query("select * from $tabla where parent_id=0 and estado!=0")->result();
        $html .='<select name="' . $nombre . '" id="' . $nombre . '" class="form-control">';
        $html .='<option value="">Seleccione</option>';
        foreach ($padres as $padre) {
            $html .='<option ';
            if ($selected == $padre->id) {
                $html .=' selected ';
            }
            $html .=' value="' . $padre->id . '">' . $padre->nombre . '</option>';
            $html .= select_subcategorias($padre->id, $tabla, null, $selected);
        }
        $html .='<select>';
        return $html;
    }

    /**
     * Subcategorias
     *
     * Selecciona las subcategorías de una categoría
     *
     * @category        Utilitarios
     * @author		Juan Julio Sandoval Layza
     * @since		26-02-2015
     * @version		Version 1.0
     */
    function select_subcategorias($padre = null, $tabla = null, $nivel = null, $selected = null) {
        $CI = & get_instance();
        $html = '';
        $hijos = $CI->db->query("select * from $tabla where parent_id=? and estado!=0", array($padre))->result();
        if (count($hijos) > 0) {
            $nivel = $nivel + 1;
        }
        foreach ($hijos as $hijo) {
            $html .='<option ';
            if ($selected == $hijo->id) {
                $html .=' selected ';
            }
            $html .=' value="' . $hijo->id . '" >';
            for ($i = 1; $i <= $nivel; $i++) {
                $html .="&mdash;";
            }
            $html .=$hijo->nombre . '</option>';
            $html .=select_subcategorias($hijo->id, $tabla, $nivel, $selected);
        }
        return $html;
    }

}

/**
 * Select Categorias Servicios
 *
 * Genera un campo de tipo select para  Categorias Servicios
 *
 * @category		Utilitarios
 * @author		Juan Julio Sandoval Layza
 * @since		18-05-2015
 * @version		Version 1.0
 */
if (!function_exists("select_categorias_servicios")) {

    function select_categorias_servicios($nombre = null, $tabla = null, $selected = null) {
        $CI = & get_instance();
        $padres = $CI->db->query("select * from $tabla where parent_id=0 and estado!=0")->result();
        $html .='<select name="' . $nombre . '" id="' . $nombre . '" class="form-control">';
        $html .='<option value="">Seleccione</option>';
        foreach ($padres as $padre) {
            $html .='<option ';
            if ($selected == $padre->id) {
                $html .=' selected ';
            }
            $html .=' value="' . $padre->id . '">' . $padre->nombre . '</option>';
            $html .= select_subcategorias_servicios($padre->id, $tabla, null, $selected);
        }
        $html .='<select>';
        return $html;
    }

    /**
     * Subcategorias
     *
     * Selecciona las subcategorías de una categoría
     *
     * @category        Utilitarios
     * @author		Juan Julio Sandoval Layza
     * @since		26-02-2015
     * @version		Version 1.0
     */
    function select_subcategorias_servicios($padre = null, $tabla = null, $nivel = null, $selected = null) {
        $CI = & get_instance();
        $hijos = $CI->db->query("select * from $tabla where parent_id=? and estado!=0", array($padre))->result();
        if (count($hijos) > 0) {
            $nivel = $nivel + 1;
        }
        foreach ($hijos as $hijo) {
            $html .='<option ';
            if ($selected == $hijo->id) {
                $html .=' selected ';
            }
            $html .=' value="' . $hijo->id . '" >';
            for ($i = 1; $i <= $nivel; $i++) {
                $html .="&mdash;";
            }
            $html .=$hijo->nombre . '</option>';
            $html .=select_subcategorias($hijo->id, $tabla, $nivel, $selected);
        }
        return $html;
    }

}

/**
 * Paises
 *
 * Devuelve un listado de paises
 * 
 * @category		Utilitarios
 * @author		Juan Julio Sandoval Layza
 * @since		18-08-2015
 * @version		Version 1.0
 */
if (!function_exists('listado_paises')) {

    function listado_paises() {
        $paises = array("Perú", "Argentina", "Bolivia", "Chile", "Colombia", "Costa Rica", "Ecuador", "España", "Estados Unidos", "Guatemala", "Honduras", "Italia", "México", "Paraguay", "Uruguay", "Venezuela");
        return $paises;
    }

}

if (!function_exists('dateMysql')) {
    /**
     * Combierte una fecha en espñol a formato Mysql
     * @param  String $date "dd/mm/yyyy"
     * @return String  "yyyy-mm-dd"
     */
    function dateMysql($date){
        $dateEs = explode("/", $date);
        $dateEn = date("Y-m-d", strtotime($dateEs[2]."-".$dateEs[1]."-".$dateEs[0]));
        return $dateEn;
    }
}

if (!function_exists('fecha_es')) {

    /**
     * Fecha en español
     *
     * Formatea una fecha MySQL (Y-m-d) a una fecha en español.
     * 
     * Uso: fecha_es(fecha_mysql, formato de retorno, opcional incluir hora)
     * 
     * @package     Fecha en español
     * @author      Juan Julio Sandoval Layza
     * @copyright       webapu.com 
     * @since       25-06-2014
     * @version     Version 1.0
     */
    function fecha_es($fecha_mysql, $formato = "d/m/a", $incluir_hora = FALSE) {
        $fecha_en = strtotime($fecha_mysql);
        $dia = date("l", $fecha_en); // Sunday
        $ndia = date("d", $fecha_en); // 01-31
        $mes = date("m", $fecha_en); // 01-12
        $ano = date("Y", $fecha_en); // 2014
        $hora = date("H:i:s", $fecha_en); // H-i-s (Hora, minutos, segundos)

        $dias = array('Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miercoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sabado', 'Sunday' => 'Domingo');
        $meses = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Setiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');

        switch ($formato) {
            case "d/m/a":
                $fecha_es = date("d/m/Y", $fecha_en);
                //Resultado: 25/06/2014
                break;
            case "d-m-a":
                $fecha_es = date("d-m-Y", $fecha_en);
                //Resultado: 25-06-2014
                break;
            case "d.m.a":
                $fecha_es = date("d.m.Y", $fecha_en);
                //Resultado: 25.06.2014
                break;
            case "d M a":
                $fecha_es = $ndia . " " . substr($meses[$mes], 0, 3) . " " . $ano;
                //Resultado: 25 Jun 2014
                break;
            case "d F a":
                $fecha_es = $ndia . " " . $meses[$mes] . " " . $ano;
                //Resultado: 25 Junio 2014
                break;
            case "D d M a":
                $fecha_es = substr($dias[$dia], 0, 3) . " " . $ndia . " " . substr($meses[$mes], 0, 3) . " " . $ano;
                //Resultado: Mar 25 Jun 2014
                break;
            case "L d F a":
                $fecha_es = $dias[$dia] . " " . $ndia . " " . $meses[$mes] . " " . $ano;
                //Resultado: Martes 25 Junio 2014
                break;
        }

        if ($incluir_hora) {
            $fecha_es .= " " . $hora;
        }

        return $fecha_es;
    }

}