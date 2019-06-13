<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include_once APPPATH."/libraries/pdf_js.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Items extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('items_model');
                $this->load->model('categorias_model');
                $this->load->model('existencias_model');
                $this->load->helper('url_helper');
                $this->load->helper(array('form', 'url'));
                
        }

        public function index()
        {
                $data['items'] = $this->items_model->get_items();
                $data['title'] = 'Items';


                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('items/index', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');
        }

        public function view($id = NULL)
        {
                $data['items_item'] = $this->items_model->get_items($id);

                       if (empty($data['items_item']))
                       {
                               show_404();
                       }

                       $data['title'] = 'Información del Articulo';

                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/aside', $data);
                        $this->load->view('items/view', $data);
                        $this->load->view('templates/footer');
                        $this->load->view('templates/side');
        }

        public function import()
        {
            $config['upload_path']      = './uploads/';
            $config['allowed_types']    = 'xls|xlsx|csv';

            $this->load->library('upload', $config);
            $this->load->library('form_validation');

            if(!$this->upload->do_upload('archivo'))
            {
                $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('items/view', $error);
            }
            else
            {
                $data = $this->upload->data();
                $inputFileName = $data['full_path'];
                $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $spreadsheet = $reader->load($inputFileName);
                $worksheet = $spreadsheet->getActiveSheet();

                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();

                $col_item = 1;
                $col_categoria = 2;
                $col_linea = 3;
                $col_precio = 4;
                $col_cantidad = 5;
                $flag = true;
                
                $data1 = array();
                for ($row=0; $row <= $highestRow ; $row++) { 
                    if($flag){
                        for ($col=0; $col <= 10 ; $col++) { 
                            $data1[$col] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();

                            if(preg_match('/Item/i', $data1[$col])) {
                                $col_item = $col;
                                $flag = false;
                            } else if(preg_match('/Categoria/i', $data1[$col])) {
                                $col_categoria = $col;
                                $flag = false;
                            } else if(preg_match('/Descripcion/i', $data1[$col])) {
                                $col_descripcion = $col;
                                $flag = false;
                            } else if(preg_match('/Linea/i', $data1[$col])) {
                                $col_linea = $col;
                                $flag = false;
                            } else if(preg_match('/Precio/i', $data1[$col])) {
                                $col_precio = $col;
                                $flag = false;
                            } else if(preg_match('/Cantidad/i', $data1[$col])) {
                                $col_cantidad = $col;
                                $flag = false;
                            }
                        }   
                    } else {
                        $item = $worksheet->getCellByColumnAndRow($col_item, $row)->getValue();
                        $categoria = $worksheet->getCellByColumnAndRow($col_categoria, $row)->getValue();
                        $descripcion = $worksheet->getCellByColumnAndRow($col_descripcion, $row)->getValue();
                        $linea = $worksheet->getCellByColumnAndRow($col_linea, $row)->getValue();
                        $precio = $worksheet->getCellByColumnAndRow($col_precio, $row)->getValue();
                        $cantidad = $worksheet->getCellByColumnAndRow($col_cantidad, $row)->getValue();


                        $flag1 = $this->items_model->get_item($item);
                        //$data2[$row] = $flag1;
                        if (!empty($item)){
                            if ($flag1 == 0){
                                if (!preg_match('/[0-9]+/', $categoria)) {
                                    $categoria=0;
                                }
                                if (!preg_match('/[0-9]+/', $linea)) {
                                    $linea=0;
                                }
                                if (!preg_match('/[0-9]+/', $precio)) {
                                    $precio=0;
                                }
                                if (!preg_match('/[0-9]+/', $cantidad)) {
                                    $cantidad=0;
                                }
                                if (empty($descripcion)){
                                    $descripcion = ' ';
                                }
                                $this->items_model->set_items_archivo($item, $descripcion, $categoria, $linea, $precio);
                                $this->existencias_model->set_existencias_archivo($item, $cantidad);    
                            } else {
                                if (!preg_match('/[0-9]+/', $cantidad)) {
                                    $cantidad=0;
                                }
                                $this->existencias_model->set_existencias_archivo($item, $cantidad);    
                            }
                        }
                        
                    }
                    
                }
                unlink($inputFileName);
                $this->index();
/*                        $data['title'] = json_encode($data2);

                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/aside', $data);
                        $this->load->view('items/view', $data);*/
            }
        }

        public function edit($id = NULL, $codigo = NULL)
        {
            $data['categorias'] = $this->categorias_model->get_categorias();
            $data['items_item'] = $this->items_model->get_items($id, false);
            $data['title'] = 'Editar item';

            $this->load->helper('form');
            $this->load->library('form_validation');

            if (empty($data['items_item']))
            {
                   show_404();
            }

            $this->form_validation->set_rules('codigo', 'Codigo', 'required');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
            $this->form_validation->set_rules('linea', 'Linea', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('items/edit',$data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $this->items_model->edit_item($id);
                $this->index();
            }
        }

        public function create($id = NULL, $codigo = NULL)
        {
            $this->load->helper('form');
            $this->load->library('form_validation');
            
            $data['categorias'] = $this->categorias_model->get_categorias();
            $data['title'] = 'Crear un nuevo articulo';

            $this->form_validation->set_rules('codigo', 'Codigo', 'required');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
            $this->form_validation->set_rules('linea', 'Linea', 'required');
            $codigo=$this->input->post('codigo');

            if ($this->form_validation->run() === FALSE)
            {
                
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $data);
                $this->load->view('items/create', $data);
                $this->load->view('templates/footer');
                $this->load->view('templates/side');

            }
            else
            {
                $existe= $this->items_model->get_items(false, $codigo);
                if(empty($existe)){
                    $this->items_model->set_items();
                    $this->index();
                }else{
                    echo "<script type='text/javascript'>alert('El codigo ingresado ya se encuentra asociado a un item, por favor intente de nuevo');</script>";
                    $this->index();
                }
            }
        }
}