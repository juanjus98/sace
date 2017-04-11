<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Paginas extends CI_Controller {
  public $website_info;

  function __construct() {
    parent::__construct();
    $this->template->set_layout('website.php');

    $this->load->model('inicio_model', 'Inicio');
    $this->load->model('paginas_model', 'Paginas');

    $this->load->model('categorias_model', 'Categorias');
    $this->load->model('productos_model', 'Productos');
    $this->load->model("crud_model","Crud");

    /**
     * Información del website
     */
    $this->website_info = $this->Inicio->get_website();
  }

  public function index() {
    $this->template->title('Inicio');
    $data['active_link'] = "inicio";

    $data['website'] = $this->Inicio->get_website();
        $data['head_info'] = head_info($data['website'],'home'); //siempre

        //Categorías para carousel parent_id != 0, destacar=1
        $data_crud['table'] = "categoria as t1";
        $data_crud['columns'] = "t1.*";
        $data_crud['where'] = array("t1.parent_id !=" => 0, "t1.destacar" => 1, "t1.estado !=" => 0);
        $data['categorias_carousel'] = $this->Crud->getRows($data_crud);


        $this->template->build('paginas/index', $data);
      }

    //Productos
      public function productos($url_key = NULL,$page=0) {
        $data['active_link'] = "Productos";

        //Información de una categoría
        $data_crud['table'] = "categoria as t1";
        $data_crud['columns'] = "t1.*";
        $data_crud['where'] = array("t1.url_key" => $url_key, "t1.estado !=" => 0);
        $categoria = $this->Crud->getRow($data_crud);
        $data['categoria'] = $this->Crud->getRow($data_crud);
       
        //Para los metadatos
        $data['head_info'] = head_info($categoria,'productos'); //siempre       

        //Paginacion
        $base_url = base_url("c/" . $url_key) ;
        $uri_segment = 3; //segmento de la url
        $num_links = 4; //número de links

        
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

        $sessionName = 's_catalog_products'; //Session name

        if (isset($_GET['refresh'])) {
          $this->session->unset_userdata($sessionName);
          redirect(base_url("c/" . $url_key));
        }
        
        if($categoria['parent_id'] != 0){
            $per_page = 8; //registros por página
            $pre_post = array(
              "categoria_id" => $categoria['id']
              );

            //Setear post
            $post = $this->Crud->set_post($pre_post,$sessionName);

            //Total de registros por post
            $total_rows = $this->Productos->total_registros($post);
            $data['total_registros'] = $total_rows;

            //Listado
            $data['listado'] = $this->Productos->listado($per_page, $page, $post);
          }else{
            $per_page = 6; //registros por página
            $pre_post = array(
              "parent_id" => $categoria['id']
              );

            //Setear post
            $post = $this->Crud->set_post($pre_post,$sessionName);

            //Total de registros por post
            $total_rows = $this->Categorias->total_registros($post);
            $data['total_registros'] = $total_rows;

            //Listado
            $data['listado'] = $this->Categorias->listado($per_page, $page, $post);
          }

        //Paginacion
          $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

          $this->pagination->initialize($set_paginacion);
          $data["links"] = $this->pagination->create_links();

        //Banner images/banner.png
          /*$data['banner'] = $this->Paginas->get_banner(2);*/

          $this->template->title($categoria['nombre']);
        $this->template->build('paginas/productos', $data); // vista
      }

    //Producto
      public function detalle_producto($url_key = NULL) {
        $this->load->model('productos_descargables_model', 'Productos_descargables');

        //consultamos producto
        $data_row = array('url_key' => $url_key );
        $producto = $this->Productos->get_row($data_row);
        $data['producto'] = $producto;

        //Consultar Galería
        $data_crud_gal['table'] = "producto_imagen as t1";
        $data_crud_gal['columns'] = "t1.*";
        $data_crud_gal['where'] = array("t1.producto_id" => $producto['id'], "t1.estado !=" => 0);
        $galeria = $this->Crud->getRows($data_crud_gal);
        $data['galeria'] = $galeria;


        $data['active_link'] = "Productos";
        $data['website'] = $this->Inicio->get_website(); //siempre
        $data['head_info'] = head_info($data['producto'],'producto'); //siempre

        //Descargables de productos
        $post_descargables['producto_id'] = $producto_id;
        $total_descargables = $this->Productos_descargables->total_registros($post_descargables);
        $data['descargables'] = $this->Productos_descargables->listado($total_descargables, 0, $post_descargables);

        //Productos relacionados.
        $data['relacionados'] = $this->Productos->get_relacionados($producto['id'], $producto['categoria_id'], 3);

        //Banner
        $data['banner'] = $this->Paginas->get_banner(2);

        $this->template->title('Producto');
        $this->template->build('paginas/detalle_producto', $data);
      }


    //Consultar iterms del carrito Ajax
      public function get_cart(){
        $this->load->library('cart');
        $cart_contents = $this->cart->contents();
        if(!empty($cart_contents)){
          $data["post"]['items'] = (array)$cart_contents;
          $data["post"]["total_items"] = count($cart_contents);
          $data["post"]['status'] = "ack";
        }else{
          $data["post"]["total_items"] = 0;
          $data["post"]['status'] = "error";
        }
        $this->load->view('paginas/ajax_set_cart.php',$data);
      }

    //Agregar y editra item de carrito Ajax
      public function set_cart() {
        $this->load->library('cart');
        if ($this->input->post()) {
          $post = (array)$this->input->post();

          if($this->cart->insert($post)){
            $cart_contents = $this->cart->contents();
            $data["post"] = end($cart_contents);
            $data["post"]["total_items"] = count($cart_contents);
            $data["post"]['status'] = "ack";
          }else{
            $data["post"]['status'] = "error";
          }
        }
        $this->load->view('paginas/ajax_set_cart.php',$data);
      }

    //Quitar item de carrito Ajax
      public function del_cart($args=null) {
        $this->load->library('cart');
        if ($this->input->post()) {
          $post = $this->input->post();
          $rowid = $post['rowid'];
          $data["post"]['rowid'] = $rowid;
          $data["post"]['estado'] = $this->cart->remove($rowid);
          $data["post"]["total_items"] = count($this->cart->contents());
        }
        $this->load->view('paginas/ajax_set_cart.php',$data);
      }

    //Actualizar y eliminar items del carrito Ajax
      public function update_cart() {
        $this->load->library('cart');
        if ($this->input->post()) {
          $post = (array)$this->input->post();

          if($this->cart->update($post)){
            $cart_contents = $this->cart->contents();
            $data["post"] = end($cart_contents);
            $data["post"]["total_items"] = count($cart_contents);
            $data["post"]['status'] = "ack";
          }else{
            $data["post"]['status'] = "error";
          }
        }

        $this->load->view('paginas/ajax_set_cart.php',$data);
      }

    //Cotizar
      public function cotizador() {
        $this->load->library('cart');
        $this->load->helper('string');
        $this->load->model('ordenes_model', 'Ordenes');

        $data['active_link'] = "cotizador";
        $website_info = $this->Inicio->get_website();
        $data['head_info'] = head_info($website_info,'home');

        //Carrito
        $carrito = $this->cart->contents();
        $data['carrito'] = $carrito;


        //Enviar formulario
        if($this->input->post()){
          $post = $this->input->post();

          $this->form_validation->set_rules('nombres', 'Nombres', 'required',array('required' => 'Ingrese Nombres y Apellidos.'));
          $this->form_validation->set_rules('email', 'Correo', 'required|valid_email',array('required' => 'Ingrse su correo.', 'valid_email' => 'Ingrese un correo válido.'));
          $this->form_validation->set_rules('telefono', 'Teléfono', 'required',array('required' => 'Ingrese un teléfono.'));

          $this->form_validation->set_error_delimiters('<div class="error_cotizar">', '</div>');

          if ($this->form_validation->run() == FALSE)
          {
            $data['post'] = $post;
          }else{

            //GUARDAR EN LA BASE DE DATOS LA NUEVA SOLICITUD DE COTIZACIÓN.
            $codigo_orden = $this->Ordenes->crearCodigo();
            $token_orden = md5($codigo_orden);

            $data_insert = array(
              "token_orden" => $token_orden,
              "codigo_orden" => $codigo_orden,
              "subtotal" => 0,
              "igv" => 0,
              "total" => 0,
              "envio" => 0,
              "empresa" => strip_tags($post['empresa']),
              "nombres" => strip_tags($post['nombres']),
              "email" => strip_tags($post['email']),
              "telefono" => strip_tags($post['telefono']),
              "mensaje" => strip_tags($post['mensaje']),
              "fecha_orden" => date("Y-m-d H:i:s")
              );

            $this->db->insert('orden', $data_insert);
            $orden_id = $this->db->insert_id();

            //Insertar items del Carrito
            foreach ($carrito as $key => $value) {
              $data_insert_detalles = array(
                "orden_id" => $orden_id,
                "producto_id" => $value['id'],
                "precio" => $value['price'],
                "cantidad" => $value['qty'],
                "unidad_medida" => $value['unidad'],
                "producto_nombre" => $value['name'],
                "producto_url" => $value['url_producto']
                );

              $this->db->insert('orden_detalle', $data_insert_detalles);
            }

            //Templates Email
            $data_email['orden'] = $data_insert;
            $data_email['carrito'] = $carrito;

            //Otros datos para el email
            $data_email['website'] = $this->Inicio->get_website();
            $data_email['cabeceras'] = $this->config->item('waemail');
            
            //Template user email
            $email_user = $this->load->view('paginas/email/tp_orden_user', $data_email, TRUE);

            //Template admin admin
            $email_admin = $this->load->view('paginas/email/tp_orden', $data_email, TRUE);

            //Enviar email
            $this->load->library('email');

            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;

            $config['mailtype'] = 'html';

            $this->email->initialize($config);

            $this->email->from('info@webapu.com', utf8_decode('Ventas Web FyB Mueblería Belén'));
            $this->email->reply_to($post['email'], utf8_decode($post['nombres']));
            $this->email->to('juanjus98@gmail.com');
            /*$this->email->cc('epropesco@hotmail.com');*/
                //$this->email->bcc('them@their-example.com');

            $this->email->subject(utf8_decode('Solicitud de cotización ('.$codigo_orden.').'));
            $this->email->message($email_admin);
            $this->email->send(); //Envia email al administrador

            //ENVIAMOS EMAIL DE CONFIRMACIÓN
            $this->email->clear();
            $this->email->initialize($config);

            $this->email->from('info@webapu.com', utf8_decode('Ventas Web FyB Mueblería Belén'));
            $this->email->to($post['email'], utf8_decode($post['nombres']));
            $this->email->subject(utf8_decode('Solicitud de cotización ('.$codigo_orden.').'));
            $this->email->message($email_user);
            $this->email->send();

            //Destruir carrito
            $this->cart->destroy();
            redirect("confirmacion/" . $token_orden);
          }
        }

        $this->template->title('Cotizar');
        $this->template->build('paginas/cotizador', $data);
      }

      //Mensaje de confirmación
      public function confirmacion($token='') {
        $this->load->model('ordenes_model', 'Ordenes');
        $data['active_link'] = "inicio";

        //Orden
        $where_ifo = array('token_orden' => $token);
        $data['orden'] = $this->Ordenes->get_row($where_ifo);

        $this->template->title('Confirmación');
        $this->template->build('paginas/confirmacion', $data);
      }

    }

    /* End of file categorias.php */
/* Location: ./application/controllers/waadmin/categorias.php */