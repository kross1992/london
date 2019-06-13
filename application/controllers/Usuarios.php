<?php
class Usuarios extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('usuarios_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['usuarios'] = $this->usuarios_model->get_usuarios();
                $data['title'] = 'Usuarios';
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('usuarios/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }

        public function view($id = NULL)
        {
                $data['usuarios_item'] = $this->usuarios_model->get_usuarios($id);

                       if (empty($data['usuarios_item']))
                       {
                               show_404();
                       }

                       $data['title'] = 'Información del Usuario';

            
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/aside', $data);
                        $this->load->view('usuarios/view', $data);
                        $this->load->view('templates/footer');
                        $this->load->view('templates/side');
        }

        public function edit($id = NULL)
        {
            $data['usuarios_item'] = $this->usuarios_model->get_usuarios($id);
            $data['title'] = 'Editar usuario';

            $this->load->helper('form');
            $this->load->library('form_validation');

            if (empty($data['usuarios_item']))
            {
                   show_404();
            }

            $this->form_validation->set_rules('usuario', 'Usuario', 'required');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('rol', 'Rol', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('usuarios/edit');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->usuarios_model->edit_usuario($id);
                $this->index();
            }
        }

        public function create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Crear un nuevo usuario';

            $this->form_validation->set_rules('usuario', 'Usuario', 'required');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('rol', 'Rol', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('usuarios/create');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->usuarios_model->set_usuarios();
                //$this->load->view('usuarios/success');
                $this->index();
            }
        }
}