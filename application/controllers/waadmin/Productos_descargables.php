<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos_descargables extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('waadmin/popup.php');

        /**
         * Verficamos si existe una session activa
         */
        $this->auth->logged_in();

        //Información del usuario que ha iniciado session
        $this->user_info = $this->auth->user_profile();

        $this->load->helper('waadmin');
        $this->load->model("crud_model","Crud");       
        $this->load->model('productos_model', 'Productos');
        $this->load->model('productos_descargables_model', 'Productos_descargables');

    }

    /**
     * Listar galeria
     *
     * Lista la galieria de un producto.
     *
     * @package		galeria
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function index($id) {
        //Iinformación del servicio
        $data['producto_info'] = $this->Productos->get_row($id);

         //$data['wa_tipo'] = $tipo;
       $data['wa_modulo'] = $data['producto_info']['nombre_corto'];
       $data['wa_menu'] = 'Descargables';

        //Paginacion
        $base_url = base_url() . "waadmin/productos_descargables/index/" . $id . "/";
        $per_page = 10; //registros por página
        $uri_segment = 5; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Productos_descargables->set_post($this->input->post());
        $post['producto_id'] = $id;
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Productos_descargables->total_registros($post);

        //Listado
        $data['listado'] = $this->Productos_descargables->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Listado');
        $this->template->build('waadmin/productos_descargables/index', $data);
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
        $this->load->library("fileupload");

        $data['user_info'] = $this->session->userdata('s_user_info');
        
        //Iinformación del producto
        $data['producto_info'] = $this->Productos->get_row($id);
        $data['post']['producto_id'] = $id;

        if ($this->input->post()) {
            $post = $this->input->post();
            $file_info = $this->fileupload->do_upload("/descargables/", "archivo");
            if (!empty($file_info['upload_data'])) {
                $data_insert = array(
                    "producto_id" => $post['producto_id'],
                    "titulo" => $post['titulo'],
                    "descripcion" => $post['descripcion'],
                    "nombre_archivo" => $file_info['upload_data']['file_name'],
                    "orden" => $post['orden'],
                    "usuario_id" => $data['user_info']['id']
                );

                $this->db->insert('producto_descargables', $data_insert);
                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");

            } else {
                $this->session->set_userdata('msj_error', "Ocurrio un error vuelve a intentarlo.");
            }
            redirect("waadmin/productos_descargables/index/" . $post['producto_id']);
        }
        $this->template->title('Agregar imágen para <b>' . $data['producto_info']['nombre_corto'] . '</b>');
        $this->template->build('waadmin/productos_descargables/agregar', $data);
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
                    $row_info = $this->Productos_descargables->get_row($item);
                    $file_name = dirname($_SERVER["SCRIPT_FILENAME"]) . "/images/upload/" . $row_info['imagen'];
                    unlink($file_name); //borra del directorio la imagen
                    $this->db->where('id', $item);
                    $this->db->delete('producto_imagen');
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/Productos_descargables/index/" . $id);
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/Productos_descargables/index/" . $id);
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/Productos_descargables/index/" . $id);
        }

        $this->template->title('Listado de dispositivos.');
        $this->template->build('inicio');
    }

}

/* End of file servicios.php */
/* Location: ./application/controllers/waadmin/categorias.php */