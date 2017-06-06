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

   if (!empty($data['campo'])) {
       $like[$data['campo']] = $data['busqueda'];
   } else {
       $like['t1.nombre_unidad'] = "";
   }

        //ORDENAR POR
    if (!empty($data['ordenar_por'])) {
        $order_by = $data['ordenar_por'] . ' ' . $data['ordentipo'];
    } else {
        $order_by = 't1.id DESC';
    }

    if ($start > 0) {
        $start = ($start - 1) * $limit;
    }

    $resultado = $this->db->select("t1.*,t2.codigo_condominio, t2.nombre_condominio, t3.nombre_grupo")
    ->join("wa_condominio as t2", "t2.id = t1.condominio_id")
    ->join("wa_grupo as t3", "t3.id = t1.grupo_id")
    ->where($where_array)
    ->like($like)
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

    if (!empty($data['campo'])) {
        $like[$data['campo']] = $data['busqueda'];
    } else {
        $like['t1.nombre_unidad'] = "";
    }

    $resultado = $this->db->select("t1.*,t2.codigo_condominio, t2.nombre_condominio, t3.nombre_grupo")
    ->join("wa_condominio as t2", "t2.id = t1.condominio_id")
    ->join("wa_grupo as t3", "t3.id = t1.grupo_id")
    ->where($where_array)
    ->like($like)
    ->get("wa_unidad as t1")
    ->num_rows();

    return $resultado;
}


function get_row($data) {
    $where = array('t1.estado != ' => 0);

    if(!empty($data['id'])){
        $where['t1.id'] = $data['id'];
    }

    $resultado = $this->db->select("t1.*,t2.codigo_condominio, t2.nombre_condominio, t3.nombre_grupo")
    ->join("wa_condominio as t2", "t2.id = t1.condominio_id")
    ->join("wa_grupo as t3", "t3.id = t1.grupo_id")
    ->where($where)
    ->get("wa_unidad as t1")
    ->row_array();

    return $resultado;
}

//Traer información de wa_unidad_persona
function listar_personas($data,$query_in=false) {
    $where = array('t1.estado != ' => 0);
    if(!$query_in){
        if(!empty($data['tipo_persona'])){
            $where['t1.tipo_persona'] = $data['tipo_persona'];
        }

        if(!empty($data['unidad_id'])){
            $where['t1.unidad_id'] = $data['unidad_id'];
        }

        $resultado = $this->db->select("t2.*")
        ->join("wa_persona as t2", "t2.id = t1.persona_id")
        ->where($where)
        ->get("wa_unidad_persona as t1")
        ->result_array();

        /*echo "<pre>";
        print_r($this->db->last_query());
        echo "</pre>";*/

    }else{
        $where_in = $data;
        $resultado = $this->db->select("t1.*")
        ->where_in("t1.id",$where_in)
        ->get("wa_persona as t1")
        ->result_array();
    }
    return $resultado;
}

}