<?php

class Clientes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function set_post($searchterm) {
        if ($searchterm) {
            $this->session->set_userdata('s_post', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('s_post')) {
            $searchterm = $this->session->userdata('s_post');
            return $searchterm;
        } else {
            $searchterm = "";
            return $searchterm;
        }
    }

    /**
     * Total de registros
     *
     * Muestra el total de registros
     *
     * @package		Servicios
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    function total_registros($data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.nombre_largo"] = "";
        }

        $resultado = $this->db->select("*")
                ->where($where)
                ->like($like)
                ->get("cliente as t1")
                ->num_rows();
        return $resultado;
    }

    /**
     * Listado de categorías
     *
     * Muestra un listado de todas las categorías
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function listado($limit, $start, $data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.nombre_largo"] = "";
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

        $resultado = $this->db->select("*")
                ->where($where)
                ->like($like)
                ->order_by($order_by)
                ->limit($limit, $start)
                ->get("cliente as t1")
                ->result_array();
        return $resultado;
    }

    /**
     * Cosultar categoría
     *
     * Trae la información de una categoria
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function get_row($id) {
        $result = $this->db->select("t1.*")
                ->where("t1.id =", $id)
                ->where("t1.estado !=", 0)
                ->get("cliente as t1")
                ->row_array();
        //seleccionar servicios
        $result_servicios = $this->db->select("t1.*")
                ->where("t1.cliente_id =", $id)
                ->where("t1.estado !=", 0)
                ->get("cliente_servicio_categoria as t1")
                ->result_array();
        if (!empty($result_servicios)) {
            foreach ($result_servicios as $servicio) {
                $arr_servicios[$servicio['servicio_categoria_id']] = $servicio['servicio_categoria_id'];
            }

            $result['servicios'] = $arr_servicios;
        }

        return $result;
    }

    /**
     * Cosultar categoría
     *
     * Trae la información de una categoria
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function get_categorias_servicios() {
        $result = $this->db->select("t1.*")
                ->where("t1.estado !=", 0)
                ->get("servicio_categoria as t1")
                ->result_array();
        return $result;
    }

}
