<?php
class Personas_model extends CI_Model {

  function __construct() {
   parent::__construct();
}

function listado($limit, $start, $data = NULL) {

    $where_array = array('t1.estado != ' => 0);

   if (!empty($data['campo'])) {
       $like[$data['campo']] = $data['busqueda'];
   } else {
       $like['t1.nombres'] = "";
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
    /*->join("wa_condominio as t2", "t2.id = t1.id_condominio")*/
    ->where($where_array)
    ->like($like)
    ->order_by($order_by)
    ->limit($limit, $start)
    ->get("wa_persona as t1")
    ->result_array();

    return $resultado;
}


function total_registros($data = NULL) {
    $where_array = array('t1.estado != ' => 0);

    /*if (!empty($data['nombre_grupo'])) {
        $where_array["t1.nombre_grupo"] = $data['nombre_grupo'];
    }*/

    if (!empty($data['campo'])) {
       $like[$data['campo']] = $data['busqueda'];
    } else {
       $like['t1.nombres'] = "";
    }

    $resultado = $this->db->select("t1.*")
    /*->join("wa_condominio as t2", "t2.id = t1.id_condominio")*/
    ->where($where_array)
    ->like($like)
    ->get("wa_persona as t1")
    ->num_rows();

    return $resultado;
}


function get_row($data) {
    $where = array('t1.estado != ' => 0);

    if(!empty($data['id'])){
        $where['t1.id'] = $data['id'];
    }

    $resultado = $this->db->select("t1.*")
    /*->join("wa_condominio as t2", "t2.id = t1.id_condominio")*/
    ->where($where)
    ->get("wa_persona as t1")
    ->row_array();

    return $resultado;
}

}