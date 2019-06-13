<?php
class Notas extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('ventas_model');
                $this->load->model('notas_model');
                $this->load->model('abonos_model');
                $this->load->model('existencias_model');
                $this->load->model('clientes_model');
                $this->load->model('motivos_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['notas'] = $this->notas_model->get_notas();
                $data['title'] = 'Notas';
            
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('notas/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }
        
  public function create() {
    
    $this->load->helper('form');
    $this->load->library('form_validation');
    $data['items'] = $this->existencias_model->get_existencias();
    $data['clientes'] = $this->clientes_model->get_clientes();
    $data['max_factura'] = $this->ventas_model->get_max_factura();
    $data['tipos_venta'] = $this->ventas_model->get_tipos_venta();
    $data['tipos_pago'] = $this->ventas_model->get_tipos_pago();
    $data['tipos_nota'] = $this->motivos_model->get_motivos();
    $data['title'] = 'Nueva Nota';

    $this->load->view('templates/header', $data);
    $this->load->view('templates/aside', $data);
    $this->load->view('notas/create', $data);
    $this->load->view('templates/footer');
    $this->load->view('templates/side');
  }
  
  public function get_tipo_motivo_fact(){
    $motivo_id = $this->input->post("id");
    $exige_fact = $this->motivos_model->get_motivos($motivo_id);
//    $valor = get_object_vars($exige_fact);
    echo $exige_fact['exige_fact'];
  }
  
  public function buscar_facturas(){
    $cliente_id = $this->input->post("id");
    $facturas = $this->ventas_model->get_ventas_cliente($cliente_id);
    echo json_encode($facturas);
  }
  
  public function buscar_items_fact(){
    $venta_id = $this->input->post("id");
    $facturas = $this->ventas_model->get_detalles_venta($venta_id);
    echo json_encode($facturas);
  }
  
  
  
  

//        public function view($codigo_venta = NULL)
//        {
//                $data['ventas_item'] = $this->ventas_model->get_ventas($codigo_venta);
//
//                       if (empty($data['ventas_item']))
//                       {
//                               show_404();
//                       }
//
//                       $data['title'] = 'Información de la Venta';
//
//                       $this->load->view('templates/header', $data);
//                       $this->load->view('ventas/view', $data);
//                       $this->load->view('templates/footer');
//        }
//
//        public function create()
//        {
//            $this->load->helper('form');
//            $this->load->library('form_validation');
//            
//            $data['items'] = $this->existencias_model->get_existencias();
//            $data['clientes'] = $this->clientes_model->get_clientes();
//            $data['max_factura'] = $this->ventas_model->get_max_factura();
//            $data['tipos_venta'] = $this->ventas_model->get_tipos_venta();
//            $data['tipos_pago'] = $this->ventas_model->get_tipos_pago();
//            $data['title'] = 'Crear Nueva Venta';
//
//            $this->form_validation->set_rules('codigo_venta', 'Codigo', 'required');
//            //$this->form_validation->set_rules('cliente', 'Cliente', 'required');
//            
//            if (!($this->input->post(NULL,TRUE)) )
//            {
//                $this->load->view('templates/header', $data);
//                $this->load->view('templates/aside', $data);
//                $this->load->view('ventas/create', $data);
//                $this->load->view('templates/footer');
//                $this->load->view('templates/side');
//            }
//            elseif ($this->input->post(NULL,TRUE) AND  $this->form_validation->run() === FALSE)
//            {   
//                $form_ret['error'] = 'Y' ; // Setting error indicator to 'Y' 
//                $form_ret['message'] = validation_errors() ; // Return validation error messages back to form
//                die(json_encode($form_ret)); 
//             //   echo validation_errors();
//            }
//            else
//            {
//                
//                $this->ventas_model->set_ventas();
//                $this->ventas_model->set_detalles_venta();
//                $this->abonos_model->set_abonos();
//                $this->abonos_model->set_detalles_abonos();
//                
//                //$this->index();
//                $form_ret['error'] = 'N' ; // Set error indicator to 'N'
//                // setting some success message and passing back the submitted values to be displayed.
//                // In a real application, you may want to store the submitted values in database or process
//                // them as per your application logic.
//                $form_ret['message'] = "Successfully submitted." ;
//                die(json_encode($form_ret));
//                //die(json_encode($data));
//            }
//        }
//        
//
//        public function create1()
//        {
//            $this->load->helper('form');
//            $this->load->library('form_validation');
//            
//            $data['items'] = $this->existencias_model->get_existencias();
//            $data['clientes'] = $this->clientes_model->get_clientes();
//            $data['max_factura'] = $this->ventas_model->get_max_factura();
//            $data['tipos_venta'] = $this->ventas_model->get_tipos_venta();
//            $data['tipos_pago'] = $this->ventas_model->get_tipos_pago();
//            $data['title'] = 'Crear Nueva Venta';
//
//            $this->form_validation->set_rules('codigo_venta', 'Codigo', 'required');
//            //$this->form_validation->set_rules('cliente', 'Cliente', 'required');
//            
//            if (!($this->input->post(NULL,TRUE)) )
//            {
//                $this->load->view('templates/header', $data);
//                $this->load->view('templates/aside', $data);
//                $this->load->view('ventas/create1', $data);
//                $this->load->view('templates/footer');
//                $this->load->view('templates/side');
//            }
//            elseif ($this->input->post(NULL,TRUE) AND  $this->form_validation->run() === FALSE)
//            {   
//                $form_ret['error'] = 'Y' ; // Setting error indicator to 'Y' 
//                $form_ret['message'] = validation_errors() ; // Return validation error messages back to form
//                die(json_encode($form_ret)); 
//             //   echo validation_errors();
//            }
//            else
//            {
//                
//                $this->ventas_model->set_ventas();
//                $this->ventas_model->set_detalles_venta();
//                $this->ventas_model->set_detalles_pagos();
//                $this->abonos_model->set_abonos();
//                $this->abonos_model->set_detalles_abonos();
//                
//                
//                $form_ret['error'] = 'N' ; 
//                $form_ret['message'] = "Venta Realizada." ;
//                die(json_encode($form_ret));
//            }
//        }
//
//        
//        public function create_cliente()
//        {
//            $this->load->helper('form');
//            $this->load->library('form_validation');
//
//            //$data['title'] = 'Crear un nuevo cliente';
//
//            $this->form_validation->set_rules('cedula', 'Cedula', 'required');
//            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
//
//            if (!($this->input->post(NULL,TRUE)) )
//            {
//                die("-1");
//            }
//            elseif ($this->input->post(NULL,TRUE) AND  $this->form_validation->run() === FALSE)
//            {   
//                // $form_ret['error'] = 'Y' ; // Setting error indicator to 'Y' 
//                // $form_ret['message'] = validation_errors() ; // Return validation error messages back to form
//                die("0"); 
//             //   echo validation_errors();
//            }
//            else
//            {
//                $id = $this->ventas_model->set_cliente();
//                die($id);
//            }
//            
//        }
//
//        function get_ventas_anuladas()
//        {
////            echo "<pre>hols";echo "</pre>";exit; 
//                $data['ventas'] = $this->ventas_model->get_ventas_anuladas();
//                $data['title'] = 'Ventas Anuladas';
//            
//                $this->load->view('templates/header', $data);
//                $this->load->view('templates/aside', $data);
//                $this->load->view('ventas/ventas_anuladas', $data);
//                $this->load->view('templates/footer');
//                $this->load->view('templates/side');
//        }
//        
//        public function get_detalles_venta()
//        {
//            $venta_id = $this->uri->segment(3);
//                $data['detalles_venta'] = $this->ventas_model->get_detalles_venta($venta_id);
//                $data['title'] = 'Detalles Venta';
//                $data['direccion_volver'] = 'get_ventas_anuladas';
////            echo "<pre>";var_dump($data['ventas']);echo "</pre>";exit; 
//                $this->load->view('templates/header', $data);
//                $this->load->view('templates/aside', $data);
//                $this->load->view('ventas/detalles_venta', $data);
//                $this->load->view('templates/footer');
//                $this->load->view('templates/side');
//        }
//        public function anular(){
//            $id = $this->input->post('id');
//            $this->ventas_model->anular_venta($id);
//        }
//        
}