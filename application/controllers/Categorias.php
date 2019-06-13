<?php
class Categorias extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('categorias_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['categorias'] = $this->categorias_model->get_categorias();
                $data['title'] = 'Categorias';

            
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('categorias/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }

        public function view($id = NULL)
        {
                $data['categorias_item'] = $this->categorias_model->get_categorias($id);

                       if (empty($data['categorias_item']))
                       {
                               show_404();
                       }

                       $data['title'] = 'Información de la Categoria';
                        
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/aside', $data);
                        $this->load->view('categorias/view', $data);
                        $this->load->view('templates/footer');
                        $this->load->view('templates/side');
        }

        public function edit($id = NULL)
        {
            $data['categorias_item'] = $this->categorias_model->get_categorias($id);
            $data['title'] = 'Editar categoria';

            $this->load->helper('form');
            $this->load->library('form_validation');

            if (empty($data['categorias_item']))
            {
                   show_404();
            }

            $this->form_validation->set_rules('codigo', 'Codigo', 'required');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('categorias/edit');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->categorias_model->edit_categoria($id);
                $this->index();
            }
        }


        public function create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Crear una nueva categoria';

            $this->form_validation->set_rules('codigo', 'Codigo', 'required');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('categorias/create');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->categorias_model->set_categorias();
                $this->index();
            }
        }
}