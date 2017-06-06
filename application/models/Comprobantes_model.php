<?php
class Comprobantes_model extends CI_Model {

  function __construct() {
   parent::__construct();
}

function listado($limit, $start, $data = NULL) {

    $where_array = array('t1.estado != ' => 0);

    if (!empty($data['nombre_grupo'])) {
        $where_array["t1.nombre_grupo"] = $data['nombre_grupo'];
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

    $resultado = $this->db->select("t1.*,t2.codigo_condominio, t2.nombre_condominio,t3.nombre_unidad, t4.nombre_grupo")
    ->join("wa_condominio as t2", "t2.id = t1.condominio_id")
    ->join("wa_unidad as t3", "t3.id = t1.unidad_id")
    ->join("wa_grupo as t4", "t4.id = t3.grupo_id")
    ->where($where_array)
//                ->like($like)
    ->order_by($order_by)
    ->limit($limit, $start)
    ->get("wa_comprobante as t1")
    ->result_array();

//       echo $this->db->last_query();

    return $resultado;
}


function total_registros($data = NULL) {
    $where_array = array('t1.estado != ' => 0);

    if (!empty($data['nombre_grupo'])) {
        $where_array["t1.nombre_grupo"] = $data['nombre_grupo'];
    }

//        if (!empty($data['periodo'])) {
//            $like['t1.periodo'] = $data['periodo'];
//        } else {
//            $like['t1.periodo'] = "";
//        }

    $resultado = $this->db->select("t1.*,t2.codigo_condominio, t2.nombre_condominio,t3.nombre_unidad, t4.nombre_grupo")
    ->join("wa_condominio as t2", "t2.id = t1.condominio_id")
    ->join("wa_unidad as t3", "t3.id = t1.unidad_id")
    ->join("wa_grupo as t4", "t4.id = t3.grupo_id")
    ->where($where_array)
//                ->like($like)
    ->get("wa_comprobante as t1")
    ->num_rows();

    return $resultado;
}


function get_row($data) {
    $where = array('t1.estado != ' => 0);

    if(!empty($data['id'])){
        $where['t1.id'] = $data['id'];
    }

    $resultado = $this->db->select("t1.*,t2.codigo_condominio, t2.nombre_condominio,t3.nombre_unidad, t4.nombre_grupo")
    ->join("wa_condominio as t2", "t2.id = t1.condominio_id")
    ->join("wa_unidad as t3", "t3.id = t1.unidad_id")
    ->join("wa_grupo as t4", "t4.id = t3.grupo_id")
    ->where($where)
    ->get("wa_comprobante as t1")
    ->row_array();

    return $resultado;
}

}