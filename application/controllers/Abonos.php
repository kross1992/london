<?php
class Abonos extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('abonos_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['abonos'] = $this->abonos_model->get_abonos();
//                $data['tipo_pago'] = $this->abonos_model->get_tipos_pago();
                $data['title'] = 'Abonos';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('abonos/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }

        public function edit($id = NULL)
        {
            $data['abonos_item'] = $this->abonos_model->get_abonos($id);
            $data['tipo_pago'] = $this->abonos_model->get_tipos_pago();
            $data['title'] = 'Abonar';

            $this->load->helper('form');
            $this->load->library('form_validation');

            if (empty($data['abonos_item']))
            {
                   show_404();
            }

            $this->form_validation->set_rules('abono', 'Abono', 'required');
            $this->form_validation->set_rules('saldo', 'Saldo', 'required');
            $this->form_validation->set_rules('fecha', 'Fecha', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('abonos/edit');
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
//                echo $data['abonos_item']['codigo_venta'];exit()
                $this->abonos_model->edit_abono($id);
                $this->abonos_model->insert_detalle_abono($data['abonos_item']['codigo_venta']);
                $this->index();
            }
        }

        public function detalles_abonos($id)
        {
                $data['detalles_abonos'] = $this->abonos_model->get_detalles_abonos($id);
                $data['title'] = 'Detalles Abonos';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('abonos/detalles_abonos', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }

        public function create()
        {
                $data['abonos'] = $this->abonos_model->get_abonos();
//                $data['tipo_pago'] = $this->abonos_model->get_tipos_pago();

                $data['title'] = 'Abonos';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('abonos/create', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }


        public function get_saldo()
        {

            $id = $this->input->post(); # add this

            $data = $this->abonos_model->info_abono($id["id"]);

            echo json_encode($data);
        }

}
