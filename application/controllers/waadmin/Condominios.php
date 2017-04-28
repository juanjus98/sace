<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Condominios extends CI_Controller{

	public  $user_info;

	function __construct(){
		parent::__construct();
		$this->template->set_layout('waadmin/intranet.php');

		/**
		 * Verficamos si existe una session activa
		 */
		$this->auth->logged_in();

		//Información del usuario que ha iniciado session
		$this->user_info = $this->auth->user_profile();

		$this->load->model("crud_model","Crud");
		$this->load->model("condominios_model","Condominios");
		

	}

	function index($tipo='V',$id=1){
		$this->editar();
	}

	function editar($tipo='V',$id=1){
		$data['wa_tipo'] = $tipo;
		$data['wa_modulo'] = 'Ajustes';
		$data['wa_menu'] = 'Condominio';

		$data_condominio = array("id" => $id);
		$data['condominio'] = $this->Condominios->get_row($data_condominio);

		//Consultar Administrador
		$id_condominio = $data['condominio']['id'];
		$data_crud['table'] = "wa_personal as t1";
		$data_crud['columns'] = "t1.*";
		$data_crud['where'] = array("t1.id_condominio" => $id_condominio, "t1.estado !=" => 0, "t1.id_cargo" => 1);
		$data['administrador'] = $this->Crud->getRow($data_crud);

		if ($this->input->post()) {
			$data['post'] = $this->input->post();

			$config = array(
				array(
					'field' => 'condominio[codigo_condominio]',
					'label' => 'Código',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'condominio[nombre_condominio]',
					'label' => 'Nombre',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'condominio[direccion]',
					'label' => 'Dirección',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'condominio[telefono]',
					'label' => 'telefono',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'administrador[nombre]',
					'label' => 'Nombres',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'administrador[apellido]',
					'label' => 'Apellidos',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'administrador[telefono]',
					'label' => 'telefono',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'administrador[email]',
					'label' => 'E-mail',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					)
				);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

			$condominio = $this->input->post('condominio');
			$administrador = $this->input->post('administrador');

			if ($this->form_validation->run() == FALSE){
				/*Error*/
				$data['condominio'] = $condominio;
				$data['administrador'] = $administrador;
			}else{
				//Actualizar condominio.
				$id_condominio = $condominio['id'];
				unset($condominio['id']);
				$data_update = array(
					'table' => 'wa_condominio',
					'where' => array('id' => $id_condominio),
					'columns' => $condominio
					);
				
				$this->Crud->updateRow($data_update);
				
				//Actualizar administrador.
				$id_personal = $administrador['id_personal'];
				unset($condominio['id_personal']);
				$data_update_admin = array(
					'table' => 'wa_personal',
					'where' => array('id_personal' => $id_personal),
					'columns' => $administrador
					);
				$this->Crud->updateRow($data_update_admin);
				
				$this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
				redirect('waadmin/condominio/V/' . $id_condominio);

			}

		}


		$this->template->title('Gestionar condominio.');
		$this->template->build('waadmin/condominios/editar', $data);
	}

}