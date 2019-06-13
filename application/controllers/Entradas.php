<?php
class Entradas extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('entradas_model');
                $this->load->model('items_model');
                $this->load->model('existencias_model');
                $this->load->model('proveedores_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['entradas'] = $this->entradas_model->get_entradas();
                $data['title'] = 'Entradas de Inventario';

            
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('entradas/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }

        public function view($id = NULL)
        {
                $data['entradas_item'] = $this->entradas_model->get_entradas($id);
                $data['items'] = $this->items_model->get_items();
                $data['proveedores'] = $this->proveedores_model->get_proveedores();

                       if (empty($data['entradas_item']))
                       {
                               show_404();
                       }

                       $data['title'] = 'Información de la Entrada de Inventario';

            
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/aside', $data);
                        $this->load->view('entradas/view', $data);
                        $this->load->view('templates/footer');
                        $this->load->view('templates/side');
        }

        public function edit($id = NULL)
        {
            $data['entradas_item'] = $this->entradas_model->get_entradas($id);
            $data['title'] = 'Editar entrada';

            $this->load->helper('form');
            $this->load->library('form_validation');

            if (empty($data['entradas_item']))
            {
                   show_404();
            }

            $this->form_validation->set_rules('item', 'Item', 'required');
            $this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
            $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('entradas/edit');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->entradas_model->edit_entrada($id);
                $this->index();
            }
        }

        public function create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');
            
            $data['items'] = $this->items_model->get_items();
            $data['proveedores'] = $this->proveedores_model->get_proveedores();
            $data['title'] = 'Nueva Entrada de Inventario';

            $this->form_validation->set_rules('item', 'Item', 'required');
            $this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
            $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('entradas/create', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $result = $this->entradas_model->set_entradas();
                if ($result != 0){
                   $this->existencias_model->set_existencias();
                }
                $this->index();
                //$this->load->view('entradas/success');
            }
        }
}