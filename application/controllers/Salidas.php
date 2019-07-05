<?php
class Salidas extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('salidas_model');
                $this->load->model('items_model');
                $this->load->model('proveedores_model');
                $this->load->model('existencias_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['salidas'] = $this->salidas_model->get_salidas();
                $data['title'] = 'salidas';


                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('salidas/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }

        public function view($item = NULL)
        {
                $data['salidas_item'] = $this->salidas_model->get_salidas($item);

                       if (empty($data['salidas_item']))
                       {
                               show_404();
                       }

                       $data['title'] = 'Información de la Salida de Inventario';

                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/aside', $data);
                        $this->load->view('salidas/view', $data);
                        $this->load->view('templates/footer');
                        $this->load->view('templates/side');
        }

        public function create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['items'] = $this->items_model->get_items();
            $data['proveedores'] = $this->proveedores_model->get_proveedores();
            $data['title'] = 'Crear una nueva Salida de Inventario';

            $this->form_validation->set_rules('item', 'Item', 'required');
            $this->form_validation->set_rules('proveedor', 'Proveedor', 'required');
            $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');

            if ($this->form_validation->run() === FALSE)
            {

                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('salidas/create', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $result = $this->salidas_model->set_salidas();
                if ($result != 0){
                   $this->existencias_model->rest_existencias();
                }
                $this->index();
            }
        }
}
