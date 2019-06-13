<?php
class Proveedores extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('proveedores_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['proveedores'] = $this->proveedores_model->get_proveedores();
                $data['title'] = 'Proveedores';

                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('proveedores/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }

        public function view($id = NULL)
        {
                $data['proveedores_item'] = $this->proveedores_model->get_proveedores($id);

                       if (empty($data['proveedores_item']))
                       {
                               show_404();
                       }

                       $data['title'] = 'Información del Proveedor';

            
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/aside', $data);
                        $this->load->view('proveedores/view', $data);
                        $this->load->view('templates/footer');
                        $this->load->view('templates/side');
        }

        public function edit($id = NULL)
        {
            $data['proveedores_item'] = $this->proveedores_model->get_proveedores($id);
            $data['title'] = 'Editar proveedor';

            $this->load->helper('form');
            $this->load->library('form_validation');

            if (empty($data['proveedores_item']))
            {
                   show_404();
            }

            $this->form_validation->set_rules('identificacion', 'Identificacion', 'required');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('proveedores/edit');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->proveedores_model->edit_proveedor($id);
                $this->index();
            }
        }

        public function create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Crear un nuevo proveedor';

            $this->form_validation->set_rules('identificacion', 'Identificacion', 'required');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('proveedores/create');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->proveedores_model->set_proveedores();
                //$this->load->view('proveedores/success');
                $this->index();
            }
        }
}