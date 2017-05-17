<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprobante_conceptos extends CI_Controller{
	private $base_ctr; //Url base del controlodor
	private $primary_table = "wa_comprobante_conceptos"; //Tabla principal
	public $base_title = "Conceptos";

	public  $user_info;

	function __construct(){
		parent::__construct();
		$this->template->set_layout('waadmin/intranet.php');

		/**
		 * Verficamos si existe una session activa
		 */
		$this->auth->logged_in();

		$this->load->model("crud_model","Crud");
		$this->load->model("comprobante_conceptos_model","Comprobante_conceptos");

		//Base del controlador
		$this->base_ctr = $this->config->item('admin_path') . '/comprobante_conceptos';
		
		//Información del usuario que ha iniciado session
		$this->user_info = $this->auth->user_profile();
	}

	function index(){
		/*$data['wa_tipo'] = $tipo;*/
		$data['wa_modulo'] = 'Listado';
		$data['wa_menu'] = $this->base_title;

		//URLS
		$controlador = $this->base_ctr;
		$data['agregar_url'] = base_url($controlador . '/editar/C');
		$data['ver_url'] = base_url($controlador . '/editar/V/'); //Adicionar ID
		$data['editar_url'] = base_url($controlador . '/editar/E/'); //Adicionar ID
		$data['eliminar_url'] = base_url($controlador . '/eliminar');
		$data['refresh_url'] = base_url($controlador . '/index?refresh');

		//BUSQUEDA
		$data['campos_busqueda'] = array(
			't1.serie' => 'Serie',
      't1.numeracion' => 'Numeración'
      );

		$sessionName = 's_' . $this->primary_table; //Session name

		//Paginacion
		$base_url = base_url($this->base_ctr . '/index');
        $per_page = 10; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

        if (isset($_GET['refresh'])) {
        	$this->session->unset_userdata($sessionName);
        }

        //Setear post
        $post = $this->Crud->set_post($this->input->post(),$sessionName);
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Comprobante_conceptos->total_registros($post);

        //Listado
        $data['listado'] = $this->Comprobante_conceptos->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];

        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();


        if ($this->session->userdata("mensaje")) {
        	$data["mensaje"] = $this->session->userdata("mensaje");
        	$this->session->unset_userdata("mensaje");
        }

        $this->template->title('Listado ' . $this->base_title);
        $this->template->build($this->base_ctr . '/index', $data);
      }

      function editar($tipo='C',$id=NULL){
       /*echo $this->base_ctr;*/
       $data['current_url'] = base_url(uri_string());
       $data['back_url'] = base_url($this->base_ctr . '/index');
       if(isset($id)){
        $data['editar_url'] = base_url($this->base_ctr . '/editar/E/' . $id);
      }

      switch ($tipo) {
        case 'C':
        $data['tipo'] = 'Agregar';
        break;
        case 'E':
        $data['tipo'] = 'Editar';
        break;
        case 'V':
        $data['tipo'] = 'Visualizar';
        break;
      }

      $data['wa_tipo'] = $tipo;
      $data['wa_modulo'] = $data['tipo'];
      $data['wa_menu'] = 'Comprobante conceptos';


      if($tipo == 'E' || $tipo == 'V'){
        $data_row = array('id' => $id);
        $data['post'] = $this->Comprobante_conceptos->get_row($data_row);
      }

    	//Consultar condominios
      $data_crud['table'] = "wa_condominio as t1";
      $data_crud['columns'] = "t1.*";
      $data_crud['where'] = array("t1.estado !=" => 0);
      $data['condominios'] = $this->Crud->getRows($data_crud);

      if ($this->input->post()) {
        $post= $this->input->post();
        $data['post'] = $post; 

        $config = array(
         array(
          'field' => 'serie',
          'label' => 'Serie',
          'rules' => 'required',
          'errors' => array(
           'required' => 'Campo requerido.',
           )
          ),
         array(
          'field' => 'numeracion',
          'label' => 'Numeración',
          'rules' => 'required',
          'errors' => array(
           'required' => 'Campo requerido.',
           )
          )
         );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

        if ($this->form_validation->run() == FALSE){
         /*Error*/
         $data['post'] = $this->input->post();
       }else{

         $data_form = array(
          "condominio_id" => $post['condominio_id'],
          "serie" => $post['serie'],
          "numeracion" => $post['numeracion'],
          "descripcion" => $post['descripcion'],
          );

          		//Agregar
         if($tipo == 'C'){
          $this->db->insert($this->primary_table, $data_form);
          $producto_id = $this->db->insert_id();
          $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
        }

          		//Editar
        if ($tipo == 'E') {
          $this->db->where('id', $post['id']);
          $this->db->update($this->primary_table, $data_form);
          $producto_id = $post['id'];
          $this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
        }

        redirect($this->base_ctr . '/index');

      }

    }

    $this->template->title($data['tipo'] . ' Numeración');
    $this->template->build($this->base_ctr.'/editar', $data);
  }

/**
 * Eliminar
 *
 *
 * @package     Grupos
 * @author      Juan Julio Sandoval Layza
 * @copyright webApu.com 
 * @since       26-02-2015
 * @version     Version 1.0
 */
public function eliminar() {
 if ($this->input->post()) {
   $items = $this->input->post('items');
   if (!empty($items)) {
     foreach ($items as $item) {
       $eliminar = date("Y-m-d H:i:s");
       $data_eliminar = array(
         "eliminar" => $eliminar,
         "estado" => 0
         );
       $this->db->where('id', $item);
       $this->db->update($this->primary_table, $data_eliminar);
     }
     $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
     redirect($this->base_ctr . "/index");
   } else {
     $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
     redirect($this->base_ctr . "/index");
   }
 } else {
   $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
   redirect($this->base_ctr . "/index");
 }

 $this->template->title('Eliminar.');
 $this->template->build('inicio');
}

}