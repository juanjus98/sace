<?php
class Unidades_model extends CI_Model {

  function __construct() {
   parent::__construct();
}

function listado($limit, $start, $data = NULL) {

    $where_array = array('t1.estado != ' => 0);

    if (!empty($data['nombre_unidad'])) {
        $where_array["t1.nombre_unidad"] = $data['nombre_unidad'];
    }

//        if (!empty($data['periodo'])) {
//            $like['t1.periodo'] = $data['periodo'];
//        } else {
//            $like['t1.periodo'] = "";
//        }

        //ORDENAR POR
    if (!empty($data['ordenar_por'])) {
        $order_by = $data['ordenar_por'] . ' ' . $data['ordentipo'];
    } else {
        $order_by = 't1.id DESC';
    }

    if ($start > 0) {
        $start = ($start - 1) * $limit;
    }

    $resultado = $this->db->select("t1.*,t2.codigo_condominio, t2.nombre_condominio")
    ->join("wa_condominio as t2", "t2.id = t1.id_condominio")
    ->where($where_array)
//                ->like($like)
    ->order_by($order_by)
    ->limit($limit, $start)
    ->get("wa_unidad as t1")
    ->result_array();

//       echo $this->db->last_query();

    return $resultado;
}


function total_registros($data = NULL) {
    $where_array = array('t1.estado != ' => 0);

    if (!empty($data['nombre_unidad'])) {
        $where_array["t1.nombre_unidad"] = $data['nombre_unidad'];
    }

//        if (!empty($data['periodo'])) {
//            $like['t1.periodo'] = $data['periodo'];
//        } else {
//            $like['t1.periodo'] = "";
//        }

    $resultado = $this->db->select("t1.*,t2.codigo_condominio, t2.nombre_condominio")
    ->join("wa_condominio as t2", "t2.id = t1.id_condominio")
    ->where($where_array)
//                ->like($like)
    ->get("wa_unidad as t1")
    ->num_rows();

    return $resultado;
}


function get_row($data) {
    $where = array('t1.estado != ' => 0);

    if(!empty($data['id'])){
        $where['t1.id'] = $data['id'];
    }

    $resultado = $this->db->select("t1.*,t2.codigo_condominio, t2.nombre_condominio")
    ->join("wa_condominio as t2", "t2.id = t1.id_condominio")
    ->where($where)
    ->get("wa_unidad as t1")
    ->row_array();

    return $resultado;
}

//Traer información de wa_unidad_persona
function listar_personas($data) {
    $where = array('t1.estado != ' => 0);

    if(!empty($data['id_unidad'])){
        $where['t1.id_unidad'] = $data['id_unidad'];
    }

    $resultado = $this->db->select("t1.*,t2.codigo_tipo_documento, t2.nro_documento, CONCAT(t2.nombres, ' ', t2.apellidos) AS nombres_apellidos, t2.telefono1, t2.celular1")
    ->join("wa_persona as t2", "t2.id = t1.persona_id")
    ->where($where)
    ->get("wa_unidad_persona as t1")
    ->result_array();

    return $resultado;
}

}