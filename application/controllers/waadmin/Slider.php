<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slider extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('waadmin');
        $this->auth->logged_in();
        $this->load->library("imaupload");

        $this->load->model('waadmin/slider_model', 'Slider');
        $this->template->set_layout('waadmin/intranet.php');
    }

    /**
     * Listar Slider
     *
     * Muestra el listado de servicios.
     *
     * @package		Slider
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function index() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Paginacion
        $base_url = base_url() . "waadmin/slider/index";
        $per_page = 5; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Slider->set_post($this->input->post());
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Slider->total_registros($post);

        //Listado
        $data['listado'] = $this->Slider->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Slider');
        $this->template->build('waadmin/slider/index', $data);
    }

    /**
     * Agregar servicio
     *
     * Agregar servicio
     *
     * @package		Slider
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function agregar() {
        if ($this->input->post()) {
            $config = array(
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
                    "nombre_corto" => $post['nombre_corto'],
                    "nombre_largo" => $post['nombre_largo'],
                    "resumen" => $post['resumen'],
                    "descripcion" => $post['descripcion']
                );

                //cargar imágenes
                $imagen1_info = $this->imaupload->do_upload("/images/upload/", "imagen_1");
                $imagen2_info = $this->imaupload->do_upload("/images/upload/", "imagen_2");

                if (!empty($imagen1_info['upload_data'])) {
                    $data_insert['imagen_1'] = $imagen1_info['upload_data']['file_name'];
                }

                if (!empty($imagen2_info['upload_data'])) {
                    $data_insert['imagen_2'] = $imagen2_info['upload_data']['file_name'];
                }
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
     * Editar slider
     *
     * Editar slider
     *
     * @package		Slider
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function editar($id) {
        $data['user_info'] = $this->session->userdata('s_user_info');
        $data['post'] = $this->Slider->get_row($id);
        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'titulo1',
                    'label' => 'Titulo 1',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'titulo2',
                    'label' => 'Titulo 2',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'titulo3',
                    'label' => 'Nombre Url',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'url',
                    'label' => 'Url',
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
                    "titulo1" => $post['titulo1'],
                    "titulo2" => $post['titulo2'],
                    "titulo3" => $post['titulo3'],
                    "url" => $post['url'],
                    "target" => $post['target'],
                    "orden" => $post['orden']
                );

                //cargar imágenes
                $imagen1_info = $this->imaupload->do_upload("/images/upload/", "imagen1");

                if (!empty($imagen1_info['upload_data'])) {
                    $data_update['imagen1'] = $imagen1_info['upload_data']['file_name'];
                }
                //Fin cargar imágenes

                $this->db->where('id', $post['id']);
                $this->db->update('slider', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/slider/index");
            }
        }

        $this->template->title('Editar slider <b>' . $data['post']['titulo1'] .'</b>');
        $this->template->build('waadmin/slider/editar', $data);
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