<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include_once APPPATH."/libraries/pdf_js.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Importar extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
        // $this->load->model('categorias_model');
        // $this->load->helper('url_helper');
    }

	public function index ($file){
		$inputFileName = '../../tests/test.xlsx';

		/**  Identify the type of $inputFileName  **/
		$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
		/**  Create a new Reader of the type that has been identified  **/
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
		/**  Load $inputFileName to a Spreadsheet Object  **/
		$spreadsheet = $reader->load($inputFileName);

		$worksheet = $spreadsheet->getActiveSheet();


		$highestRow = $worksheet->getHighestRow();
		$highestColumn = $worksheet->getHighestColumn();

		for ($row = 1; $row <= $highestRow; $row++){
			for ($col = 0; $col <= 10; $col++){
				$rows[$col] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
				echo $rows
			}
		}	
	}

	public function items()
	{
		$config['upload_path'] 		= './uploads/';
		$config['allowed_types']	= 'xls|xlsx|csv';

		$this->load->library('upload', $config);
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

						if(preg_match('/Item/i', $data1[$col]))	{
							$col_item = $col;
							$flag = false;
						} else if(preg_match('/Categoria/i', $data1[$col]))	{
							$col_categoria = $col;
							$flag = false;
						} else if(preg_match('/Descripcion/i', $data1[$col]))	{
							$col_descripcion = $col;
							$flag = false;
						} else if(preg_match('/Linea/i', $data1[$col]))	{
							$col_linea = $col;
							$flag = false;
						} else if(preg_match('/Precio/i', $data1[$col]))	{
							$col_precio = $col;
							$flag = false;
						} else if(preg_match('/Cantidad/i', $data1[$col]))	{
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

					$this->items_model->set_items_archivo($item, $descripcion, $categoria, $linea, $precio);

					$this->existencias_model->set_items_archivo($item, $cantidad);
				}
				
			}

		}
	}




}

?>