<?php

class Ordenes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    /**
     * Total de ordens
     *
     * Muestra el total de ordens
     *
     * @package		ordens
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function total_registros($data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Where
        if (!empty($data['categoria_id'])) {
            $where["t1.categoria_id"] = $data['categoria_id'];
        }

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.codigo_orden"] = "";
        }

        $resultado = $this->db->select("t1.*")
        ->where($where)
        ->like($like)
        ->get("orden as t1")
        ->num_rows();

        return $resultado;
    }

    /**
     * Listado de ordens
     *
     * Muestra un listado de todas las ordens
     *
     * @package		ordens
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function listado($limit, $start, $data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Where
        if (!empty($data['categoria_id'])) {
            $where["t1.categoria_id"] = $data['categoria_id'];
        }

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.codigo_orden"] = "";
        }


        //ORDENAR POR
        if (!empty($data['ordenar_por'])) {
            $order_by = $data['ordenar_por'] . ' ' . $data['ordentipo'];
        } else {
            $order_by = 't1.agregar DESC';
        }

        if ($start > 0) {
            $start = ($start - 1) * $limit;
        }

        $resultado = $this->db->select("t1.*")
        ->where($where)
        ->like($like)
        ->order_by($order_by)
        ->limit($limit, $start)
        ->get("orden as t1")
        ->result_array();

        return $resultado;
    }

    /**
     * Cosultar categoría
     *
     * Trae la información de una categoria
     *
     * @package		ordens
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function get_row($data) {
        $where = array('t1.estado != ' => 0);

        if(!empty($data['id'])){
            $where['t1.id'] = $data['id'];
        }

        if(!empty($data['token_orden'])){
            $where['t1.token_orden'] = $data['token_orden'];
        }

        $result = $this->db->select("t1.*")
        ->where($where)
        ->get("orden as t1")
        ->row_array();

        return $result;
    }

    /**
     * Detalles de orden
     *
     * Trae la información de una categoria
     *
     * @package     ordens
     * @author      Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since       02-03-2014
     * @version     Version 1.0
     */
    function get_detalles($data) {
        $where = array('t1.estado != ' => 0);
        
        if(!empty($data['orden_id'])){
            $where['t1.orden_id'] = $data['orden_id'];
        }

        $result = $this->db->select("t1.*, t2.codigo As codigo_producto, t2.nombre_corto, t2.nombre_largo, t2.url_key, t2.precio As precio_producto,t2.imagen, t3.nombre as nombre_categoria")
        ->join("producto as t2","t2.id = t1.producto_id")
        ->join("categoria as t3","t3.id = t2.categoria_id")
        ->where($where)
        ->get("orden_detalle as t1")
        ->result_array();

        return $result;
    }

/**
 * Crear código
 * Crea un nuevo código para una nueva orden.
 *
 * @category  Ordenes
 * @package   crearCodigo
 * @license   http://www.webapu.com
 * @copyright webApu.com
 * @author Juan Julio Sandoval <juanjus98@gmail.com>
 * @since     2017-03-30
 * @version   0.1
 */
function crearCodigo(){
    $prefijo = "ORD"; //ORD = Orden

    //Consultar orden
    $this->db->select_max('id', 'orden_id');
    $orden_id = $this->db->get('orden')->row_array();

    //Nuevo código
    $codigo = $prefijo. "-" . ($orden_id['orden_id']+1);

    return $codigo;
}

}
