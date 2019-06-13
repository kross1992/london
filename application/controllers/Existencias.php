<?php
class Existencias extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('existencias_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['existencias'] = $this->existencias_model->get_existencias();
                $data['title'] = 'Inventario';
            
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('existencias/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }

        public function view($item = NULL)
        {
                $data['existencias_item'] = $this->existencias_model->get_existencias($item);

                       if (empty($data['existencias_item']))
                       {
                               show_404();
                       }

                       $data['title'] = 'Información de la Existencia en Inventario';

                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/aside', $data);
                        $this->load->view('existencias/view', $data);
                        $this->load->view('templates/footer');
                        $this->load->view('templates/side');
        }

        /*public function create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');
            
            $data['items'] = $this->existencias_model->get_items();
            $data['proveedores'] = $this->existencias_model->get_proveedores();
            $data['title'] = 'Crear un nuevo articulo';

            $this->form_validation->set_rules('item', 'Item', 'required');
            $this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
            $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('existencias/create', $data);
                $this->load->view('templates/footer');

            }
            else
            {
                $this->existencias_model->set_existencias();
                $this->load->view('existencias/success');
            }
        }*/
}