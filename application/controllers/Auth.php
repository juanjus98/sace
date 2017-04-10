<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->template->set_layout('login.php');

        $this->load->library('bcrypt');
    }

    public function index() {
        $user_info = $this->session->userdata("s_user_info");

        /*if($user_info['authentication']) {
            redirect($this->config->item('url_login', 'auth'));
        }*/

        if ($this->input->post()) {
            $user_data = array(
                "usuario" => $this->input->post("username"),
                "contrasena" => trim($this->input->post("password"))
            );
            echo "<pre>";
            print_r($user_data);
            echo "</pre>";
            die();
        }

        $data['user_info'] = "";
        $this->template->title('Inicias Sesión.');
        $this->template->build('auth/login', $data);

        //echo $hashed_password = $this->bcrypt->hash("WinnerSystemsLasAguilas");
    }

    function autenticar() {
        if ($this->input->post()) {
            $user_data = array(
                "usuario" => $this->input->post("username"),
                "contrasena" => trim($this->input->post("password"))
                );

            $login = $this->auth->login($user_data);
            if ($login) {
                //$this->session->set_userdata("msj_success","Autenticado satisfactoriamente.");
                redirect($this->config->item('url_login', 'login'));
            } else {
                $this->session->set_userdata('login', $this->input->post());
                //$this->session->set_userdata('msj_error', "Usuario o contraseña incorrectos.");
                redirect('login');
            }
        }

        $this->load->view('login', $data);
    }

    function logout() {
        $this->auth->logout();
    }

}