<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carousel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('intranet.php');

        /**
         * Verficamos si existe una session activa
         */
        $this->auth->logged_in();

        $this->load->helper('waadmin');
        $this->load->library("imaupload");
        $this->load->model('carousel_model', 'Carousel');

        //Información del usuario que ha iniciado session
        $this->user_info = $this->auth->user_profile();
        
    }

    /**
     * Listar Carousel
     *
     * Muestra el listado de servicios.
     *
     * @package		Carousel
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function index() {
        $data['wa_modulo'] = 'Website';
        $data['wa_menu'] = 'Carousel';

        //Paginacion
        $base_url = base_url() . "waadmin/carousel/index";
        $per_page = 5; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Carousel->set_post($this->input->post());
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Carousel->total_registros($post);

        //Listado
        $data['listado'] = $this->Carousel->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Carousel');
        $this->template->build('admin/carousel/index', $data);


    }

    /**
     * Agregar servicio
     *
     * Agregar servicio
     *
     * @package		Carousel
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function agregar() {
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
                    'label' => 'Titulo 3',
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
                $data_insert = array(
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
                    $data_insert['imagen1'] = $imagen1_info['upload_data']['file_name'];
                }
                //Fin cargar imágenes

                $this->db->insert('carousel', $data_insert);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/carousel/index");
            }
        }
        $this->template->title('Agregar carousel');
        $this->template->build('waadmin/carousel/agregar', $data);
    }

    /**
     * Editar slider
     *
     * Editar slider
     *
     * @package		Carousel
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function editar($id) {
        $data['user_info'] = $this->session->userdata('s_user_info');
        $data['post'] = $this->Carousel->get_row($id);
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
                    'label' => 'Titulo 3',
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
                $this->db->update('carousel', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/carousel/index");
            }
        }

        $this->template->title('Editar slider <b>' . $data['post']['titulo1'] . '</b>');
        $this->template->build('waadmin/carousel/editar', $data);
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