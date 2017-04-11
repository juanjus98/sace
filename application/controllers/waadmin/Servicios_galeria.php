<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Servicios_galeria extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('waadmin');
        $this->auth->logged_in();
        $this->load->library("imaupload");

        $this->load->model('waadmin/servicios_model', 'Servicios');
        $this->load->model('waadmin/servicios_galeria_model', 'Servicios_galeria');

        $this->template->set_layout('waadmin/intranet.php');
    }

    /**
     * Listar Servicios_galeria
     *
     * Muestra el listado de servicios.
     *
     * @package		Servicios_galeria
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function index($id) {
        $data['user_info'] = $this->session->userdata('s_user_info');

        //Iinformación del servicio
        $data['servicio_info'] = $this->Servicios->get_row($id);

        //Paginacion
        $base_url = base_url() . "waadmin/servicios_galeria/index/" . $id . "/";
        $per_page = 10; //registros por página
        $uri_segment = 5; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Servicios_galeria->set_post($this->input->post());
        $post['servicio_id'] = $id;
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Servicios_galeria->total_registros($post);

        //Listado
        $data['listado'] = $this->Servicios_galeria->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Galería para <b>' . $data['servicio_info']['nombre_corto'] . '</b>');
        $this->template->build('waadmin/servicios_galeria/index', $data);
    }

    /**
     * Agregar servicio
     *
     * Agregar servicio
     *
     * @package		Servicios_galeria
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function agregar($id) {
        //Iinformación del servicio
        $data['servicio_info'] = $this->Servicios->get_row($id);
        $data['post']['servicio_id'] = $id;

        if ($this->input->post()) {
            $post = $this->input->post();
            $imagen_info = $this->imaupload->do_upload("/images/upload/", "imagen");
            if (!empty($imagen_info['upload_data'])) {
                $data_insert = array(
                    "servicio_id" => $post['servicio_id'],
                    "titulo" => $post['titulo'],
                    "descripcion" => $post['descripcion'],
                    "imagen" => $imagen_info['upload_data']['file_name'],
                    "orden" => $post['orden']
                );
                $this->db->insert('servicio_galeria', $data_insert);
                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
            } else {
                $this->session->set_userdata('msj_error', "Ocurrio un error vuelve a intentarlo.");
            }
            redirect("waadmin/servicios_galeria/index/" . $post['servicio_id']);
        }
        $this->template->title('Agregar imágen para <b>' . $data['servicio_info']['nombre_corto'] . '</b>');
        $this->template->build('waadmin/servicios_galeria/agregar', $data);
    }

    /**
     * Editar servicio
     *
     * Editar servicio
     *
     * @package		Servicios_galeria
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function editar($id) {
        $data['user_info'] = $this->session->userdata('s_user_info');
        $data['post'] = $this->Servicios_galeria->get_row($id);
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
                $data_update = array(
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

        $this->template->title('Editar categoría.');
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
    public function eliminar($id) {
        if ($this->input->post()) {
            $items = $this->input->post('items');
            if (!empty($items)) {
                foreach ($items as $item) {
                    $row_info = $this->Servicios_galeria->get_row($item);
                    $file_name = dirname($_SERVER["SCRIPT_FILENAME"]) . "/images/upload/" . $row_info['imagen'];
                    unlink($file_name); //borra del directorio la imagen
                    $this->db->where('id', $item);
                    $this->db->delete('servicio_galeria');
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/servicios_galeria/index/" . $id);
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/servicios_galeria/index/" . $id);
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/servicios_galeria/index/" . $id);
        }

        $this->template->title('Listado de dispositivos.');
        $this->template->build('inicio');
    }

}

/* End of file servicios.php */
/* Location: ./application/controllers/waadmin/categorias.php */