<?php
class Login extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->model('usuarios_model');
            $this->load->helper('url_helper');
    }

    public function login()
    {
    	$this->load->helper('form');
        $this->load->library('form_validation');


        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header1');
            $this->load->view('pages/login');
            $this->load->view('templates/side');

        }
        else
        {
            $usuario= $this->usuarios_model->login();
            if (!empty($usuario)){

                $newdata = array(
                    'user'  => $usuario['usuario'],
                    'password' => $usuario['password'],
                    'rol'     => $usuario['rol'],
                    'logged_in' => TRUE
                );
                
                $data['title'] = 'LONDON Store';
                
                $this->session->set_userdata($newdata);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('pages/home');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
            } else {
                $this->load->view('templates/header1');
                $this->load->view('pages/login');
                $this->load->view('templates/side');
            }

        }
        
    }

    public function cerrar()
    {
        $this->session->sess_destroy();
        $this->session->unset_userdata('logged_in');
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/aside', $data);
        $this->load->view('pages/home');
        $this->load->view('templates/footer');
        $this->load->view('templates/side');

    }


}