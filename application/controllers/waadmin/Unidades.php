<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidades extends CI_Controller{
  private $ctr_name;
	private $base_ctr; //Url base del controlodor
	private $primary_table = "wa_unidad"; //Tabla principal
	public $base_title = "Unidades";

	public  $user_info;

	function __construct(){
		parent::__construct();
		$this->template->set_layout('waadmin/intranet.php');

		/**
		 * Verficamos si existe una session activa
		 */
		$this->auth->logged_in();

		$this->load->model("crud_model","Crud");
		$this->load->model("unidades_model","Unidades");

		$this->ctr_name = $this->router->fetch_class();
    //Base del controlador
		$this->base_ctr = $this->config->item('admin_path') . '/' . $this->ctr_name;
		
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
			't1.nombre_unidad' => 'Nombre únidad',
      't3.nombre_grupo' => 'Tipo únidad'
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
        $data['total_registros'] = $this->Unidades->total_registros($post);

        //Listado
        $data['listado'] = $this->Unidades->listado($per_page, $page, $post);

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
    	//Tipos de documento
      $data_crud_td['table'] = "wa_tipo_documento as t1";
      $data_crud_td['columns'] = "t1.*";
      $data_crud_td['where'] = array("t1.estado !=" => 0);
      $data['tipos_documentos'] = $this->Crud->getRows($data_crud_td);

    	$data['current_url'] = base_url(uri_string());
    	$data['back_url'] = base_url($this->base_ctr . '/index');

      //Url agregar personas waadmin/personas/index?popup
      $data['propietario_url'] = base_url($this->config->item('admin_path') . '/personas/index?popup=propietario');
      $data['morador_url'] = base_url($this->config->item('admin_path') . '/personas/index?popup=morador');
      
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
    	$data['wa_menu'] = 'Unidad';


    	if($tipo == 'E' || $tipo == 'V'){
    		$data_row = array('id' => $id);
        $unidad = $this->Unidades->get_row($data_row);
        $unidad_id = $unidad['id'];
    		$data['post'] = $unidad;

        //Propietarios
        $data_propietarios = array(
          "tipo_persona" => "P",
          "unidad_id" => $unidad_id
        );

        $data['propietarios'] = $this->Unidades->listar_personas($data_propietarios);

        //Moradores
        $data_moradores = array(
          "tipo_persona" => "M",
          "unidad_id" => $unidad_id
        );
        $data['moradores'] = $this->Unidades->listar_personas($data_moradores);

    	}

    	//Consultar grupos (tipos de unidades)
      $data_crud['table'] = "wa_grupo as t1";
      $data_crud['columns'] = "t1.*";
      $data_crud['where'] = array("t1.condominio_id"=>1, "t1.estado !=" => 0);
      $data['grupos'] = $this->Crud->getRows($data_crud);

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
    				'field' => 'id_grupo',
    				'label' => 'Tipo de Unidad',
    				'rules' => 'required',
    				'errors' => array(
    					'required' => 'Campo requerido.',
    					)
    				),
          array(
            'field' => 'nombre_unidad',
            'label' => 'Nombre unidad',
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
    			$data['post'] = $post;
          if(!empty($post['propietario'])){
            $data['propietarios'] = $this->Unidades->listar_personas($post['propietario'],true);
          }

          if(!empty($post['morador'])){
            $data['moradores'] = $this->Unidades->listar_personas($post['morador'],true);
          }

    		}else{

          $aporta_ingresos = (isset($post['aporta_ingresos'])) ? $post['aporta_ingresos'] : 0 ;

    			$data_form = array(
    				"condominio_id" => $post['id_condominio'],
    				"nombre_unidad" => $post['nombre_unidad'],
            "id_grupo" => $post['id_grupo'],
            "descripcion" => $post['descripcion'],
            "aporta_ingresos" => $aporta_ingresos
    				);

          		//Agregar
    			if($tipo == 'C'){
    				$this->db->insert($this->primary_table, $data_form);
    				$unidad_id = $this->db->insert_id();
    				$this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
    			}

          		//Editar
    			if ($tipo == 'E') {
    				$this->db->where('id', $post['id']);
    				$this->db->update($this->primary_table, $data_form);
    				$unidad_id = $post['id'];
    				$this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
    			}

          //Insertar Propietarios
          $data_up = array('estado' => 0);
          $where_up = array('tipo_persona' => 'P','unidad_id' => $unidad_id);
          $this->db->where($where_up);
          $this->db->update('wa_unidad_persona', $data_up);
          $propietario = $post['propietario'];
          if(!empty($propietario)){
            foreach ($propietario as $key => $value) {
              if(!empty($value)){
                  $data_insert = array(
                    'tipo_persona' => 'P', //P:Propietario
                    'unidad_id' => $unidad_id,
                    'persona_id' => $value
                  );
                  $this->db->insert('wa_unidad_persona', $data_insert);
              }
            }
          }

          //Insertar Moradores
          $data_up = array('estado' => 0);
          $where_up = array('tipo_persona' => 'M','unidad_id' => $unidad_id);
          $this->db->where($where_up);
          $this->db->update('wa_unidad_persona', $data_up);
          $morador = $post['propietario'];
          if(!empty($morador)){
            foreach ($morador as $key => $value) {
              if(!empty($value)){
                  $data_insert = array(
                    'tipo_persona' => 'M', //P:Propietario
                    'unidad_id' => $unidad_id,
                    'persona_id' => $value
                  );
                  $this->db->insert('wa_unidad_persona', $data_insert);
              }
            }
          }

    			redirect($this->base_ctr . '/index');
    		}

    	}

    	$this->template->title($data['tipo'] . ' Unidad');
    	$this->template->build($this->base_ctr.'/editar', $data);
    }

/**
 * Eliminar
 *
 *
 * @package     Unidades
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