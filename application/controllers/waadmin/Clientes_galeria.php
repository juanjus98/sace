<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clientes_galeria extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('waadmin');
        $this->auth->logged_in();
        $this->load->library("imaupload");

        $this->load->model('waadmin/clientes_model', 'Clientes');
        $this->load->model('waadmin/clientes_galeria_model', 'Clientes_galeria');

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
        $data['cliente_info'] = $this->Clientes->get_row($id);

        //Paginacion
        $base_url = base_url() . "waadmin/clientes_galeria/index/" . $id . "/";
        $per_page = 10; //registros por página
        $uri_segment = 5; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Clientes_galeria->set_post($this->input->post());
        $post['cliente_id'] = $id;
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Clientes_galeria->total_registros($post);

        //Listado
        $data['listado'] = $this->Clientes_galeria->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Galería para <b>' . $data['cliente_info']['nombre_corto'] . '</b>');
        $this->template->build('waadmin/clientes_galeria/index', $data);
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
        $data['cliente_info'] = $this->Clientes->get_row($id);
        $data['post']['cliente_id'] = $id;

        if ($this->input->post()) {
            $post = $this->input->post();
            $imagen_info = $this->imaupload->do_upload("/images/upload/", "imagen");
            if (!empty($imagen_info['upload_data'])) {
                $data_insert = array(
                    "cliente_id" => $post['cliente_id'],
                    "titulo" => $post['titulo'],
                    "descripcion" => $post['descripcion'],
                    "imagen" => $imagen_info['upload_data']['file_name'],
                    "orden" => $post['orden']
                );
                $this->db->insert('cliente_galeria', $data_insert);
                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
            } else {
                $this->session->set_userdata('msj_error', "Ocurrio un error vuelve a intentarlo.");
            }
            redirect("waadmin/clientes_galeria/index/" . $post['cliente_id']);
        }
        $this->template->title('Agregar imágen para <b>' . $data['cliente_info']['nombre_corto'] . '</b>');
        $this->template->build('waadmin/clientes_galeria/agregar', $data);
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
                    $row_info = $this->Clientes_galeria->get_row($item);
                    $file_name = dirname($_SERVER["SCRIPT_FILENAME"]) . "/images/upload/" . $row_info['imagen'];
                    unlink($file_name); //borra del directorio la imagen
                    $this->db->where('id', $item);
                    $this->db->delete('cliente_galeria');
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/clientes_galeria/index/" . $id);
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/clientes_galeria/index/" . $id);
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/clientes_galeria/index/" . $id);
        }

        $this->template->title('Listado de dispositivos.');
        $this->template->build('inicio');
    }

}

/* End of file servicios.php */
/* Location: ./application/controllers/waadmin/categorias.php */