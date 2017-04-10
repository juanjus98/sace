<?php
class Crud_model extends CI_Model {

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
 * Trae registros de una fila.
 * Consulta un registro de una tabla.
 *
 * @package Crud_model
 * @license http://www.webapu.com
 * @copyright webApu.com
 * @author Juan Julio Sandoval <juanjus98@gmail.com>
 * @since 2017-01-05
 * @version 0.1
 * @param array $data
 * @return array
 */
 function getRow($data) {
   $result = $this->db->select($data['columns'])
   ->where($data['where'])
   ->get($data['table'])
   ->row_array();
   return $result;
}

 /**
 * Insertar una nuevo registro.
 * Inserta un nuevo registro en una tabla.
 *
 * @package Crud_model
 * @license http://www.webapu.com
 * @copyright webApu.com
 * @author Juan Julio Sandoval <juanjus98@gmail.com>
 * @since 2017-01-05
 * @version 0.1
 * @param array $data
 * @return bool
 */

 function insertRow($data) {
     $result = $this->db->insert($data['table'], $data['columns']);
     return $result;
 }

 /**
 * Actualizar registro.
 * Actualiza un registro en una tabla.
 *
 * @package Crud_model
 * @license http://www.webapu.com
 * @copyright webApu.com
 * @author Juan Julio Sandoval <juanjus98@gmail.com>
 * @since 2017-01-05
 * @version 0.1
 * @param array $data
 * @return bool
 */

 function updateRow($data) {
    $this->db->where($data['where']);
    $result = $this->db->update($data['table'], $data['columns']);
    return $result;
}

}