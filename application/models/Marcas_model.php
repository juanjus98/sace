<?php

class Marcas_model extends CI_Model {

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
     * Total de categorías
     *
     * Muestra el total de categorías
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright       Winner System 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function total_registros($data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.nombre"] = "";
        }

        $resultado = $this->db->select("t1.*")
                ->where($where)
                ->like($like)
                ->get("marca as t1")
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
     * @copyright       Winner System 
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
            $like["t1.nombre"] = "";
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
                ->get("marca as t1")
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
     * @copyright       Winner System 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function get_row($id) {
        $result = $this->db->select("t1.*")
                ->where("t1.id =", $id)
                ->where("t1.estado !=", 0)
                ->get("marca as t1")
                ->row_array();
        return $result;
    }

}
