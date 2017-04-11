<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Servicios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('waadmin');
        $this->auth->logged_in();
        $this->load->library("imaupload");

        $this->load->model('waadmin/servicios_model', 'Servicios');
        $this->template->set_layout('waadmin/intranet.php');
    }

    /**
     * Listar Servicios
     *
     * Muestra el listado de servicios.
     *
     * @package		Servicios
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function index() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Paginacion
        $base_url = base_url() . "waadmin/servicios/index";
        $per_page = 30; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Servicios->set_post($this->input->post());
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Servicios->total_registros($post);

        //Listado
        $data['listado'] = $this->Servicios->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Servicios');
        $this->template->build('waadmin/servicios/index', $data);
    }

    /**
     * Agregar servicio
     *
     * Agregar servicio
     *
     * @package		Servicios
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function agregar() {
        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'servicio_categoria_id',
                    'label' => 'Categoría',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Nombre corto',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'nombre_largo',
                    'label' => 'Nombre largo',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'resumen',
                    'label' => 'Resumen',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion',
                    'label' => 'Descripción',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '* Campo obligatorio.');
            $this->form_validation->set_error_delimiters('<div class="col-sm-4 msj-error">', '</div>');

            if ($this->form_validation->run() == FALSE) {
                $post = $this->input->post();
                $data['post'] = $post;
            } else {
                $post = $this->input->post();
                $data_insert = array(
                    "servicio_categoria_id" => $post['servicio_categoria_id'],
                    "nombre_corto" => $post['nombre_corto'],
                    "nombre_largo" => $post['nombre_largo'],
                    "resumen" => $post['resumen'],
                    "descripcion" => $post['descripcion']
                );

                //cargar imágenes
                $imagen1_info = $this->imaupload->do_upload("/images/upload/", "imagen_1");

                if (!empty($imagen1_info['upload_data'])) {
                    $data_insert['imagen_1'] = $imagen1_info['upload_data']['file_name'];
                }

//                $imagen2_info = $this->imaupload->do_upload("/images/upload/", "imagen_2");
//                if (!empty($imagen2_info['upload_data'])) {
//                    $data_insert['imagen_2'] = $imagen2_info['upload_data']['file_name'];
//                }
                //Fin cargar imágenes

                $this->db->insert('servicio', $data_insert);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/servicios/index");
            }
        }
        $this->template->title('Agregar servicio');
        $this->template->build('waadmin/servicios/agregar', $data);
    }

    /**
     * Editar servicio
     *
     * Editar servicio
     *
     * @package		Servicios
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function editar($id) {
        $data['user_info'] = $this->session->userdata('s_user_info');
        $data['post'] = $this->Servicios->get_row($id);
        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'servicio_categoria_id',
                    'label' => 'Categoría',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Nombre corto',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'nombre_largo',
                    'label' => 'Nombre largo',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'resumen',
                    'label' => 'Resumen',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion',
                    'label' => 'Descripción',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '* Campo obligatorio.');
            $this->form_validation->set_error_delimiters('<div class="col-sm-4 msj-error">', '</div>');

            if ($this->form_validation->run() == FALSE) {
                $post = $this->input->post();
                $data['post'] = $post;
            } else {
                $post = $this->input->post();
                $data_update = array(
                    "servicio_categoria_id" => $post['servicio_categoria_id'],
                    "nombre_corto" => $post['nombre_corto'],
                    "nombre_largo" => $post['nombre_largo'],
                    "resumen" => $post['resumen'],
                    "descripcion" => $post['descripcion']
                );

                //cargar imágenes
                $imagen1_info = $this->imaupload->do_upload("/images/upload/", "imagen_1");
                $imagen2_info = $this->imaupload->do_upload("/images/upload/", "imagen_2");

                if (!empty($imagen1_info['upload_data'])) {
                    $data_update['imagen_1'] = $imagen1_info['upload_data']['file_name'];
                }

                if (!empty($imagen2_info['upload_data'])) {
                    $data_update['imagen_2'] = $imagen2_info['upload_data']['file_name'];
                }
                //Fin cargar imágenes

                $this->db->where('id', $post['id']);
                $this->db->update('servicio', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/servicios/index");
            }
        }

        $this->template->title('Editar servicio <b>' . $data['post']['nombre_corto'] . '</b>');
        $this->template->build('waadmin/servicios/editar', $data);
    }

    /**
     * Eliminar
     *
     * Eliminar categorias
     *
     * @package		Dispositivo
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		26-02-2015
     * @version		Version 1.0
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
                    $this->db->update('categoria', $data_eliminar);
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/categorias");
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/categorias");
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/categorias");
        }

        $this->template->title('Listado de dispositivos.');
        $this->template->build('inicio');
    }

}

/* End of file servicios.php */
/* Location: ./application/controllers/waadmin/categorias.php */