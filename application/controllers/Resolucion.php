<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resolucion extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('resolucion_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['resolucion'] = $this->resolucion_model->get_resolucion();
                $data['title'] = 'resolucion';


                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('resolucion/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }


        public function edit($id = NULL)
        {
            $data['resolucion'] = $this->resolucion_model->get_resolucion($id);
            $data['title'] = 'Editar resolucion';

            $this->load->helper('form');
            $this->load->library('form_validation');

            if (empty($data['resolucion']))
            {
                   show_404();
            }

            $this->form_validation->set_rules('texto_resolucion', 'Texto', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('resolucion/edit', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->resolucion_model->edit_resolucion($id);
                $this->index();
            }
        }


}
