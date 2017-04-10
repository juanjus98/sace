<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('login.php');
    }

    public function index() {
        $user_info = $this->session->userdata("s_user_info");

        if($user_info['authentication']) {
            redirect($this->config->item('url_login', 'auth'));
        }

        /**
         * Form acctions
         */
        if ($this->input->post()) {
                $data['post'] = $this->input->post();

                $this->form_validation->set_rules('username', 'Usuario', 'required',
                    array('required' => 'Ingresar Usuario.')
                );
                $this->form_validation->set_rules('password', 'Contraseña', 'required',
                    array('required' => 'Ingresar Contraseña')
                );

                $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');

                if ($this->form_validation->run() == FALSE){
                    /*Error*/
                }else{
                    /*Login*/
                    $user_data = array(
                        "usuario" => $this->input->post("username"),
                        "contrasena" => trim($this->input->post("password"))
                    );

                    $login = $this->auth->login($user_data);
                    if ($login) {
                        /*$this->session->set_userdata("msj_success","Autenticado satisfactoriamente.");*/
                        redirect($this->config->item('url_login', 'login'));
                    } else {
                        $this->session->set_userdata('msj_error', "Usuario o contraseña incorrectos.");
                        /*redirect('login');*/
                    }

                }
        }

        $data['user_info'] = "";
        $this->template->title('Inicias Sesión.');
        $this->template->build('auth/login', $data);
    }


    function logout() {
        $this->auth->logout();
    }

}