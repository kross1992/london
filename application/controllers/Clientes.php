<?php
class Clientes extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('clientes_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['clientes'] = $this->clientes_model->get_clientes();
                $data['title'] = 'Clientes';

                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('clientes/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }

        public function view($id = NULL)
        {
                $data['clientes_item'] = $this->clientes_model->get_clientes($id);

                       if (empty($data['clientes_item']))
                       {
                               show_404();
                       }

                       $data['title'] = 'Información del Cliente';

                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/aside', $data);
                        $this->load->view('clientes/view', $data);
                        $this->load->view('templates/footer');
                        $this->load->view('templates/side');
                            
            
        }

        public function edit($id = NULL)
        {
            $data['clientes_item'] = $this->clientes_model->get_clientes($id);
            $data['title'] = 'Editar cliente';

            $this->load->helper('form');
            $this->load->library('form_validation');

            if (empty($data['clientes_item']))
            {
                   show_404();
            }

            $this->form_validation->set_rules('cedula', 'Cedula', 'required');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('clientes/edit');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->clientes_model->edit_cliente($id);
                $this->index();
            }
        }

        public function create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Crear un nuevo cliente';

            $this->form_validation->set_rules('cedula', 'Cedula', 'required');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('clientes/create');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->clientes_model->set_clientes();
                //$this->load->view('clientes/success');
                $this->index();
            }
        }
}