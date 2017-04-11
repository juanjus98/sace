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

/**
 * Dividir texto en dos
 */
if (!function_exists('divideTexto')) {
    function divideTexto($str,$parts=2){
        $str = trim($str);
        $arr_str = explode(' ', $str);
        $num_text = count($arr_str);
        $str1="";
        $str2="";
        if($num_text > 1){
            $index_divide = round(($num_text / 2),0, PHP_ROUND_HALF_DOWN);
            foreach ($arr_str as $key => $value) {
                if($key < $index_divide){
                    $str1 .= " " .  $value;
                }else{
                    $str2 .= " " .  $value;
                }
            }
            $resultado = array(trim($str1),trim($str2));
        }else{
            $resultado = array(trim($str));
        }
        return $resultado;
    }
}

if (!function_exists('wamenu')) {

    function wamenu() {
        $CI = & get_instance();

        //Categorías
        $result = $CI->db->select("t1.*")
        ->where("t1.estado !=", 0)
        ->where("t1.parent_id", 0)
        ->order_by("t1.agregar","Desc")
        ->get("categoria as t1")
        ->result_array();
        foreach ($result as $item) {
            $arr_menu['c/' . $item['url_key']] = $item['nombre'];
        }

        $menu = array(
            'inicio' => 'Inicio',
            'nosotros' => 'Nosotros',
            'Productos' => $arr_menu,
            'contactenos' => 'Contáctenos'
        );

        return $menu;
    }

}

if (!function_exists('crear_menu')) {

    function crear_menu($menu, $active_link) {
        $nav = '<ul class="nav navbar-nav navbar-nav-wa">';
        foreach ($menu as $key => $value) {
            $class_active = "";
            if ($key == $active_link) {
                $class_active = "active";
            }
            if (is_array($value)) {
                $nav .= '<li class="dropdown '.$class_active.'"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $key . ' <span class="caret"></span></a>' . PHP_EOL;
                $nav .= '<ul class="dropdown-menu">' . PHP_EOL . crear_menu($value) . PHP_EOL . '</ul>';
                $nav .= '</li>' . PHP_EOL;
            } else {
                $nav .= '<li class="'.$class_active.'"><a href="' . base_url($key) .'">' . $value . '</a></li>' . PHP_EOL;
            }
        }

        $nav .= '</ul>';
        return $nav;
    }

}

if (!function_exists('productos_categorias')) {

    function productos_categorias($limit=5) {
        $CI= & get_instance();
        //Categorias de productos
        $CI->load->model('waadmin/categorias_model', 'Categorias');

        //Listado de categorias de productos
        $categorias = $CI->Categorias->listado($limit, 0);

        return $categorias;
    }

}

//Trae listado de marcas
if (!function_exists('get_marcas')) {

    function get_marcas() {
        $CI= & get_instance();
        //Categorias de productos
        $CI->load->model('waadmin/marcas_model', 'Marcas');

        //Cantidad de marcas
        $limit = $CI->Marcas->total_registros();
        //Listado de marcas
        $marcas = $CI->Marcas->listado($limit, 0);

        return $marcas;
    }

}


/**
 * Mensajes
 *
 * Crea mensajes de exito y error
 * 
 * @category	Utilitarios
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
        $config['page_query_string'] = FALSE;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';

        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Siguiente';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';

        $config['prev_link'] = 'Anterior';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';

        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';

        $config['num_tag_open'] = '';
        $config['num_tag_close'] = '';

        $config["total_rows"] = $total_rows;

        return $config;
    }

}

/**
 * Head info
 *
 * Genera iformación para el head para seo
 * 
 * @category		Utilitarios
 * @author		Juan Julio Sandoval Layza
 * @since		08-05-2015
 * @version		Version 1.0
 */
if (!function_exists('head_info')) {

    function head_info($info, $page = "home") {
        //echo "<pre>";
        //print_r($info);
        //echo "</pre>";
        if (!empty($info)) {
            /*echo "<pre>";
            print_r($info);
            echo "</pre>";*/
            switch ($page) {
                case "home":
                $head_info = array(
                    "title" => $info['title'],
                    "description" => strip_tags($info['description']),
                    "keywords" => strip_tags($info['keywords']),
                    "image" => base_url() . "images/upload/" . strip_tags($info['image'])
                    );
                break;
                case "productos":
                $head_info = array(
                    "title" => $info['nombre'],
                    "description" => strip_tags(str_replace('\n', '<br>', $info['descripcion'])),
                    "keywords" => str_replace(array('\n',' '), array('<br>', ','), $info['descripcion']),
                    "image" => base_url() . "images/uploads/" . $info['imagen']
                    );
                break;
                case "producto":
                $head_info = array(
                    "title" => $info['nombre_largo'],
                    "description" => strip_tags(str_replace("\n", "",$info['resumen'])),
                    "keywords" => $info['keywords'],
                    "image" => base_url() . "images/upload/" . $info['imagen']
                    );
                break;
                case "servicio":
                $head_info = array(
                    "title" => $info['nombre'],
                    "description" => $info['descripcion'],
                    "keywords" => $info['url_key'],
                    "image" => base_url() . "images/upload/" . $info['imagen']
                    );
                break;
                case "cliente":
                $head_info = array(
                    "title" => $info['nombre_corto'],
                    "description" => $info['descripcion'],
                    "keywords" => $info['keywords'],
                    "image" => base_url() . "images/upload/" . $info['imagen_1']
                    );
                break;
                case "noticia":
                $head_info = array(
                    "title" => $info['titulo_largo'],
                    "description" => $info['resumen'],
                    "keywords" => $info['keywords'],
                    "image" => base_url() . "images/upload/" . $info['imagen_1']
                    );
                break;
            }
        }
        return $head_info;
    }

}

if (!function_exists('wamenu_footer')) {

    function wamenu_footer() {
        $menu_footer = array(
            'inicio' => 'Inicio',
            'nosotros' => 'Quienes Somos',
            'servicio/1/Proyectos' => 'Proyectos',
            'servicio/2/Asistencia-Tcnica-control-de-calidad' => 'Asistencia Técnica, control de calidad',
            'servicio/3/Topografa' => 'Topografía',
            'servicio/4/Licitaciones' => 'Licitaciones',
            'noticias' => 'Noticias',
            'contactenos' => 'Contáctenos'
            );
        return $menu_footer;
    }

}

if (!function_exists('crear_menu_footer')) {

    function crear_menu_footer($menu, $active_link) {
        $nav = '<ol class="breadcrumb breadcrumb-wa">';
        foreach ($menu as $key => $value) {
            $class_active = "";
            if ($key == $active_link) {
                $class_active = "active";
            }
            $nav .= '<li class="' . $class_active . '"><a href="' . base_url() . $key . '">' . $value . '</a></li>' . PHP_EOL;
        }
        $nav .= '</ol>';
        return $nav;
    }

}

if (!function_exists('footer_links')) {

    function footer_links() {
        $links = array(
            array(
                "nombre" => "Nosotros", 
                "url"=> base_url() . "nosotros", 
                "target"=>"_parent"
                ),
            array(
                "nombre" => "Servicios", 
                "url"=> base_url() . "servicios", 
                "target"=>"_parent"
                ),
            array(
                "nombre" => "Blog", 
                "url"=> base_url() . "blog", 
                "target"=>"_parent"
                ),
            array(
                "nombre" => "Contáctenos", 
                "url"=> base_url() . "contactenos", 
                "target"=>"_parent"
                )
            );
        return $links;
    }

}

/**
 * Carousel
 *
 * Devuelve un listado de items para carousel
 * 
 * @category		Utilitarios
 * @author		Juan Julio Sandoval Layza
 * @since		18-08-2015
 * @version		Version 1.0
 */
if (!function_exists('carousel_footer')) {

    function carousel_footer($limit = 3) {
        $CI = & get_instance();
        $result = $CI->db->select("t1.*")
        ->where("t1.estado !=", 0)
        ->order_by("t1.orden", "Asc")
        ->limit($limit)
        ->get("carousel as t1")
        ->result_array();
        return $result;
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


/**
 * Paises
 *
 * Devuelve un listado de paises
 * 
 * @category    Utilitarios
 * @author      Juan Julio Sandoval Layza
 * @since       14-07-2016
 * @version     Version 1.0
 */
if (!function_exists('sanear_string')) {
    function sanear_string($string){

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
            );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
            );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
            );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
            );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
            );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
            );

    //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array("¨", "º", "-", "~",
             "#", "@", "|", "!",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "<code>", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":","."),'',$string);


        return $string;
    }
}