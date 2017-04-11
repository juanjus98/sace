<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Noticias_categoria extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('waadmin');
        $this->auth->logged_in();

        $this->load->model('waadmin/noticias_categoria_model', 'Noticias_categoria');
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
        $base_url = base_url() . "waadmin/noticias_categoria/index";
        $per_page = 10; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Noticias_categoria->set_post($this->input->post());
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Noticias_categoria->total_registros($post);

        //Listado
        $data['listado'] = $this->Noticias_categoria->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Categorías');
        $this->template->build('waadmin/noticias_categoria/index', $data);
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
                    "parent_id" => $post['parent_id'],
                    "nombre" => $post['nombre'],
                    "descripcion" => $post['descripcion'],
                    "url_key" => $post['url_key']
                );

                $this->db->insert('noticia_categoria', $data_insert);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/noticias_categoria/index");
            }
        }
        $this->template->title('Agregar Categoría');
        $this->template->build('waadmin/noticias_categoria/agregar', $data);
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
        $data['post'] = $this->Noticias_categoria->get_row($id);
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
                    "parent_id" => $post['parent_id'],
                    "descripcion" => $post['descripcion']
                );

                $this->db->where('id', $post['id']);
                $this->db->update('noticia_categoria', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/noticias_categoria/index");
            }
        }

        $this->template->title('Editar categoría.');
        $this->template->build('waadmin/noticias_categoria/editar', $data);
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
                    $this->db->update('noticia_categoria', $data_eliminar);
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/noticias_categoria/index");
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/noticias_categoria/index");
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/noticias_categoria/index");
        }

        $this->template->title('Eliminar');
        $this->template->build('inicio');
    }

}

/* End of file categorias.php */
/* Location: ./application/controllers/waadmin/categorias.php */