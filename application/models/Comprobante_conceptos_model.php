<?php
class Comprobante_conceptos_model extends CI_Model {

  function __construct() {
     parent::__construct();
 }

 function listado($limit, $start, $data = NULL) {

    $where_array = array('t1.estado != ' => 0);

    if (!empty($data['campo'])) {
       $like[$data['campo']] = $data['busqueda'];
   } else {
       $like['t1.concepto'] = "";
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

$resultado = $this->db->select("t1.*")
/*->join("wa_comprobante_numeraciones as t2", "t2.id = t1.comprobante_numeraciones_id")*/
->where($where_array)
->like($like)
->order_by($order_by)
->limit($limit, $start)
->get("wa_comprobante_conceptos as t1")
->result_array();

//       echo $this->db->last_query();

return $resultado;
}


function total_registros($data = NULL) {
    $where_array = array('t1.estado != ' => 0);

    if (!empty($data['campo'])) {
       $like[$data['campo']] = $data['busqueda'];
   } else {
       $like['t1.concepto'] = "";
   }

   $resultado = $this->db->select("t1.*")
   /*->join("wa_comprobante_numeraciones as t2", "t2.id = t1.comprobante_numeraciones_id")*/
   ->where($where_array)
   ->like($like)
   ->get("wa_comprobante_conceptos as t1")
   ->num_rows();

   return $resultado;
}


function get_row($data) {
    $where = array('t1.estado != ' => 0);

    if(!empty($data['id'])){
        $where['t1.id'] = $data['id'];
    }

    $resultado = $this->db->select("t1.*")
    ->where($where)
    ->get("wa_comprobante_conceptos as t1")
    ->row_array();

    return $resultado;
}

}