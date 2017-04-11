<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos_galeria extends CI_Controller {
    public $user_info;
    public $productos_galeria_id;

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
        $this->load->model('productos_galeria_model', 'Productos_galeria');

        $this->load->library("imaupload");

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
        $this->productos_galeria_id = $id;
        $data['user_info'] = $this->session->userdata('s_user_info');

        //Iinformación del servicio
        $data['producto_info'] = $this->Productos->get_row($id);
        /*echo "<pre>";
        print_r($data['producto_info']['nombre_corto']);
        echo "</pre>";*/

        //$data['wa_tipo'] = $tipo;
        $data['wa_modulo'] = $data['producto_info']['nombre_corto'];
        $data['wa_menu'] = 'Galería';

        $sessionName = 's_productos_galeria'; //Session name

        //Paginacion
        $base_url = base_url() . "waadmin/productos_galeria/index/" . $id . "/";
        $per_page = 30; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links

        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        

        if (isset($_GET['refresh'])) {
            $this->session->unset_userdata($sessionName);
            redirect("waadmin/productos_galeria/index/" . $id);
        }

        //Setear post
        $post = $this->Crud->set_post($this->input->post(),$sessionName);
        $post['producto_id'] = $id;
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Productos_galeria->total_registros($post);

        //Listado
        $data['listado'] = $this->Productos_galeria->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Listado');
        $this->template->build('waadmin/productos_galeria/index', $data);
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
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Iinformación del producto
        $data['producto_info'] = $this->Productos->get_row($id);
        $data['post']['producto_id'] = $id;

        if ($this->input->post()) {
            $post = $this->input->post();
            $imagen_info = $this->imaupload->do_upload("/images/upload/", "imagen");
            if (!empty($imagen_info['upload_data'])) {
                $data_insert = array(
                    "producto_id" => $post['producto_id'],
                    "imagen_titulo" => $post['imagen_titulo'],
                    "descripcion" => $post['descripcion'],
                    "imagen_nombre" => $imagen_info['upload_data']['file_name'],
                    "orden" => $post['orden']
                );
                $this->db->insert('producto_imagen', $data_insert);
                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
            } else {
                $this->session->set_userdata('msj_error', "Ocurrio un error vuelve a intentarlo.");
            }
            redirect("waadmin/productos_galeria/index/" . $post['producto_id']);
        }
        $this->template->title('Agregar imágen para <b>' . $data['cliente_info']['nombre_corto'] . '</b>');
        $this->template->build('waadmin/productos_galeria/agregar', $data);
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
                    $row_info = $this->Productos_galeria->get_row($item);
                    $file_name = dirname($_SERVER["SCRIPT_FILENAME"]) . "/images/upload/" . $row_info['imagen'];
                    unlink($file_name); //borra del directorio la imagen
                    $this->db->where('id', $item);
                    $this->db->delete('producto_imagen');
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/productos_galeria/index/" . $id);
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/productos_galeria/index/" . $id);
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/productos_galeria/index/" . $id);
        }

        $this->template->title('Listado de dispositivos.');
        $this->template->build('inicio');
    }

}

/* End of file servicios.php */
/* Location: ./application/controllers/waadmin/categorias.php */