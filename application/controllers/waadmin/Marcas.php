<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marcas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('waadmin');
        $this->auth->logged_in();
        $this->load->library("imaupload");
        $this->load->model('waadmin/marcas_model', 'Marcas');
        $this->template->set_layout('waadmin/intranet.php');
    }

    /**
     * Listar categorías.
     *
     * Muestra el listado de las categorías.
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		26-02-2015
     * @version		Version 1.0
     */
    public function index() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Paginacion
        $base_url = base_url() . "waadmin/marcas/index";
        $per_page = 30; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Marcas->set_post($this->input->post());
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Marcas->total_registros($post);

        //Listado
        $data['listado'] = $this->Marcas->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Marcas');
        $this->template->build('waadmin/marcas/index', $data);
    }

    /**
     * Agregar categorías
     *
     * Agregar categorías
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		26-02-2015
     * @version		Version 1.0
     */
    public function agregar() {
        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'nombre',
                    'label' => 'Nombre',
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
                    "nombre" => $post['nombre'],
                    "descripcion" => $post['descripcion'],
                    "url_key" => $post['url_key'],
                    "orden" => $post['orden']
                );

                //cargar imágenes
                $imagen_info = $this->imaupload->do_upload("/images/upload/", "imagen");

                if (!empty($imagen_info['upload_data'])) {
                    $data_insert['imagen'] = $imagen_info['upload_data']['file_name'];
                }

                $this->db->insert('marca', $data_insert);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/marcas/index");
            }
        }
        $this->template->title('Agregar Marca');
        $this->template->build('waadmin/marcas/agregar', $data);
    }

    /**
     * Editar categorías
     *
     * Editar categorías
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		26-02-2015
     * @version		Version 1.0
     */
    public function editar($id) {
        $data['user_info'] = $this->session->userdata('s_user_info');
        $data['post'] = $this->Marcas->get_row($id);
        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'nombre',
                    'label' => 'Nombre',
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
                    "nombre" => $post['nombre'],
                    "url_key" => $post['url_key'],
                    "descripcion" => $post['descripcion'],
                    "orden" => $post['orden']
                );

                //cargar imágenes
                $imagen_info = $this->imaupload->do_upload("/images/upload/", "imagen");

                if (!empty($imagen_info['upload_data'])) {
                    $data_update['imagen'] = $imagen_info['upload_data']['file_name'];
                }

                $this->db->where('id', $post['id']);
                $this->db->update('marca', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/marcas/index");
            }
        }

        $this->template->title('Editar Marca.');
        $this->template->build('waadmin/marcas/editar', $data);
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
                    $this->db->update('marca', $data_eliminar);
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/marcas/index");
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/marcas/index");
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/marcas/index");
        }

        $this->template->title('Eliminar.');
        $this->template->build('inicio');
    }

}

/* End of file categorias.php */
/* Location: ./application/controllers/waadmin/categorias.php */