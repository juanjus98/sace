<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Noticias extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('waadmin');
        $this->auth->logged_in();
        $this->load->library("imaupload");
        $this->load->model('waadmin/noticias_model', 'Noticias');
        $this->template->set_layout('waadmin/intranet.php');
    }

    /**
     * Listar Noticia categoría.
     *
     * Muestra el listado de las noticia categoría.
     *
     * @package		Noticias
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function index() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Paginacion
        $base_url = base_url() . "waadmin/noticias/index";
        $per_page = 10; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Noticias->set_post($this->input->post());
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Noticias->total_registros($post);

        //Listado
        $data['listado'] = $this->Noticias->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Noticias');
        $this->template->build('waadmin/noticias/index', $data);
    }

    /**
     * Agregar noticias categoría
     *
     * Agregar noticias categoría
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function agregar() {
        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'noticia_categoria_id',
                    'label' => 'Categoría',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'titulo_corto',
                    'label' => 'Título corto',
                    'rules' => 'required'
                ), array(
                    'field' => 'titulo_largo',
                    'label' => 'Título largo',
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
                    "noticia_categoria_id" => $post['noticia_categoria_id'],
                    "titulo_corto" => $post['titulo_corto'],
                    "titulo_largo" => $post['titulo_largo'],
                    "resumen" => $post['resumen'],
                    "descripcion" => $post['descripcion'],
                    "referencia_nombre" => $post['referencia_nombre'],
                    "referencia_url" => $post['referencia_url'],
                    "keywords" => $post['keywords'],
                    "url_video" => $post['url_video']
                );
                
                //Destacado
                if (isset($post['destacada'])) {
                    $data_insert['destacada'] = $post['destacada'];
                } else {
                    $data_insert['destacada'] = 0;
                }

                //cargar imágenes
                $imagen1_info = $this->imaupload->do_upload("/images/upload/", "imagen_1");

                if (!empty($imagen1_info['upload_data'])) {
                    $data_insert['imagen_1'] = $imagen1_info['upload_data']['file_name'];
                }

                $this->db->insert('noticia', $data_insert);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/noticias/index");
            }
        }
        $this->template->title('Agregar noticia');
        $this->template->build('waadmin/noticias/agregar', $data);
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
        $data['post'] = $this->Noticias->get_row($id);
        if ($this->input->post()) {
//            echo '<pre>';
//            print_r($this->input->post());
//            echo '</pre>';
            $config = array(
                array(
                    'field' => 'noticia_categoria_id',
                    'label' => 'Categoría',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'titulo_corto',
                    'label' => 'Título corto',
                    'rules' => 'required'
                ), array(
                    'field' => 'titulo_largo',
                    'label' => 'Título largo',
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
                    "noticia_categoria_id" => $post['noticia_categoria_id'],
                    "titulo_corto" => $post['titulo_corto'],
                    "titulo_largo" => $post['titulo_largo'],
                    "resumen" => $post['resumen'],
                    "descripcion" => $post['descripcion'],
                    "referencia_nombre" => $post['referencia_nombre'],
                    "referencia_url" => $post['referencia_url'],
                    "keywords" => $post['keywords'],
                    "url_video" => $post['url_video']
                );

                //Destacado
                if (isset($post['destacada'])) {
                    $data_update['destacada'] = $post['destacada'];
                } else {
                    $data_update['destacada'] = 0;
                }

                //cargar imágenes
                $imagen1_info = $this->imaupload->do_upload("/images/upload/", "imagen_1");
                if (!empty($imagen1_info['upload_data'])) {
                    $data_update['imagen_1'] = $imagen1_info['upload_data']['file_name'];
                }

                $this->db->where('id', $post['id']);
                $this->db->update('noticia', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/noticias/index");
            }
        }

        $this->template->title('Editar noticia.');
        $this->template->build('waadmin/noticias/editar', $data);
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
                    $this->db->update('noticia', $data_eliminar);
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/noticias/index");
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/noticias/index");
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/noticias/index");
        }

        $this->template->title('Noticias.');
        $this->template->build('inicio');
    }

}

/* End of file categorias.php */
/* Location: ./application/controllers/waadmin/categorias.php */