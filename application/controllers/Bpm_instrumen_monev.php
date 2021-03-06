<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
class Bpm_instrumen_monev extends CI_Controller {    
public function __construct()          
	{                                     
parent::__construct();                 
$this->load->model("model_bpm_instrumen_monev");     
}

public function index()                
    {                                  
        $data=[                                       
            'title' => 'BPM Instrumen Monev', 
            'bpm_instrumen_monev' => $this->model_bpm_instrumen_monev->get_all_data_bpm_instrumen_monev(),     
			'isi' => 'bpm_instrumen_monev/v_list_bpm_instrumen_monev',               
		];                                                              
		$this->load->view('layout/v_wrapper', $data, FALSE);            
    }                                  
    public function bpm_instrumen_monev()          
    {                                                 
        $data=[                                       
            'title' => 'BPM Instrumen Monev', 
            'bpm_instrumen_monev' => $this->model_bpm_instrumen_monev->get_all_data_bpm_instrumen_monev(),     
			'isi' => 'bpm_instrumen_monev/v_list_bpm_instrumen_monev',               
		];                                                              
		$this->load->view('layout/v_wrapper', $data, FALSE);            
    }                                                              
	public function bpm_instrumen_monev_add()                               
	{                                                                 
		   
		$this->form_validation->set_rules('tahun_instrumen', 'tahun_instrumen', 'required', array(               
			'required' => '%s Harus Diisi !!!'                                                             
		));   
		$this->form_validation->set_rules('kode_instrumen', 'kode_instrumen', 'required', array(               
			'required' => '%s Harus Diisi !!!'                                                             
		));   
		$this->form_validation->set_rules('instrumen_monev', 'instrumen_monev', 'required', array(               
			'required' => '%s Harus Diisi !!!'                                                             
		));   
		$this->form_validation->set_rules('deskripsi_instrumen', 'deskripsi_instrumen', 'required', array(               
			'required' => '%s Harus Diisi !!!'                                                             
		));   
		   
		if ($this->form_validation->run() == TRUE) {                                                     
			$config['upload_path'] = './assets/file/';                                                     
			$config['allowed_types'] = 'pdf|doc|docx';                                                     
			$config['max_size']     = '20000';                                                             
			$this->upload->initialize($config);                                                            
			$field_name = "file";                                                                          
			if (!$this->upload->do_upload($field_name)) {                                                  
				$data = array(                                                                               
					'title' => 'Add BPM Instrumen Monev',                                                            
					'error_upload' => $this->upload->display_errors(),                                         
					'isi' => 'bpm_instrumen_monev/bpm_instrumen_monev',                                                        
				);                                                                                           
				$this->load->view('layout/v_wrapper', $data, FALSE);                                         
			} else {                                                                                       
				$upload_data	= array('uploads' => $this->upload->data());                                   
				$config['image_library'] = 'gd2';                                                            
				$config['source_image'] = './assets/file/' . $upload_data['uploads']['file_name'];           
				$this->load->library('image_lib', $config);                                                  
				$data = array(                                                                                       
					'id' => $this->input->post('id'),                                 
					'tahun_instrumen' => $this->input->post('tahun_instrumen'),                                 
					'kode_instrumen' => $this->input->post('kode_instrumen'),                                 
					'instrumen_monev' => $this->input->post('instrumen_monev'),                                 
					'deskripsi_instrumen' => $this->input->post('deskripsi_instrumen'),                                 
					'file'	=> $upload_data['uploads']['file_name'],                                           
				);                                                                                           
				$this->model_bpm_instrumen_monev->add_bpm_instrumen_monev($data);                                                
				$this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');                     
				redirect('bpm_instrumen_monev');                                                             
			}                                                                                              
		}                                                                                                
		$data = array(                                                                                   
			'title' => 'Add BPM Instrumen Monev',                                                                
			'data' => $this->model_bpm_instrumen_monev->get_all_data_bpm_instrumen_monev(),                                
			'isi' => 'bpm_instrumen_monev/v_add_bpm_instrumen_monev',                                                            
		);                                                                                               
		$this->load->view('layout/v_wrapper', $data, FALSE);                                             
	}                                                                                                  
	public function bpm_instrumen_monev_edit($id = NULL)                                              
	{                                                                                                           
		  
		$this->form_validation->set_rules('tahun_instrumen', 'tahun_instrumen', 'required', array(               
			'required' => '%s Harus Diisi !!!'                                                             
		));   
		$this->form_validation->set_rules('kode_instrumen', 'kode_instrumen', 'required', array(               
			'required' => '%s Harus Diisi !!!'                                                             
		));   
		$this->form_validation->set_rules('instrumen_monev', 'instrumen_monev', 'required', array(               
			'required' => '%s Harus Diisi !!!'                                                             
		));   
		$this->form_validation->set_rules('deskripsi_instrumen', 'deskripsi_instrumen', 'required', array(               
			'required' => '%s Harus Diisi !!!'                                                             
		));   
		   
		if ($this->form_validation->run() == TRUE) {                                                     
			$config['upload_path'] = './assets/file/';                                                     
			$config['allowed_types'] = 'pdf|doc|docx';                                                     
			$config['max_size']     = '20000';                                                             
			$this->upload->initialize($config);                                                            
			$field_name = "file";                                                                          
			if (!$this->upload->do_upload($field_name)) {                                                  
				$data = array(                                                                               
					'title' => 'Edit BPM Instrumen Monev',                                                                  
					'bpm_instrumen_monev'  => $this->model_bpm_instrumen_monev->get_data_bpm_instrumen_monev($id),                                        
					'error_upload' => $this->upload->display_errors(),                                         
					'isi' => 'bpm_instrumen_monev/v_edit_bpm_instrumen_monev',                                                                  
				);                                                                                           
				$this->load->view('layout/v_wrapper', $data, FALSE);                                 
			} else {                                                                                       
				$bpm_instrumen_monev = $this->model_bpm_instrumen_monev->get_data_bpm_instrumen_monev($id);                                             
				if ($bpm_instrumen_monev->file != "") {                                                                 
					unlink('./assets/file/' . $bpm_instrumen_monev->file);                                              
				}                                                                                            
				$upload_data	= array('uploads' => $this->upload->data());                                   
				$config['image_library'] = 'gd2';                                                            
				$config['source_image'] = './assets/file/' . $upload_data['uploads']['file_name'];         
				$this->load->library('image_lib', $config);                                                  
				$data = array(                                                                               
					'id'	  => $id,                                                               
					'tahun_instrumen' => $this->input->post('tahun_instrumen'),                                 
					'kode_instrumen' => $this->input->post('kode_instrumen'),                                 
					'instrumen_monev' => $this->input->post('instrumen_monev'),                                 
					'deskripsi_instrumen' => $this->input->post('deskripsi_instrumen'),                                 
					'file'	=> $upload_data['uploads']['file_name'],                                           
				);                                                                                           
				$this->model_bpm_instrumen_monev->edit_bpm_instrumen_monev($data);                                                                
				$this->session->set_flashdata('pesan', 'Data Berhasil Diganti !!!');                         
				redirect('bpm_instrumen_monev');                                                                          
			}                                                                                              
			$data = array(                                                                                 
				'id'	  => $id,                                                                 
					'tahun_instrumen' => $this->input->post('tahun_instrumen'),                                 
					'kode_instrumen' => $this->input->post('kode_instrumen'),                                 
					'instrumen_monev' => $this->input->post('instrumen_monev'),                                 
					'deskripsi_instrumen' => $this->input->post('deskripsi_instrumen'),                                 
			);                                                                                             
			$this->model_bpm_instrumen_monev->edit_bpm_instrumen_monev($data);                                                                  
			$this->session->set_flashdata('pesan', 'Data Berhasil Diganti !!!');                           
			redirect('bpm_instrumen_monev');                                                                            
		}                                                                                                
		$data = array(                                                                                   
			'title' => 'Edit BPM Instrumen Monev',                                                                      
			'bpm_instrumen_monev'  => $this->model_bpm_instrumen_monev->get_data_bpm_instrumen_monev($id),                                            
			'isi' => 'bpm_instrumen_monev/v_edit_bpm_instrumen_monev',                                                                       
		);                                                                                               
		$this->load->view('layout/v_wrapper', $data, FALSE);                                     
	}                                                                                                  
	public function bpm_instrumen_monev_delete($id = NULL)                                            
	{                                                                                                  
		$bpm_instrumen_monev = $this->model_bpm_instrumen_monev->get_data_bpm_instrumen_monev($id);                                                 
		if ($bpm_instrumen_monev->file != "") {                                                                     
			unlink('./assets/file/' . $bpm_instrumen_monev->file);                                                  
		}                                                                                                
		$data = array('id' => $id);                                                        
		$this->model_bpm_instrumen_monev->delete_bpm_instrumen_monev($data);                                                                  
		$this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');                             
		redirect('bpm_instrumen_monev');                                                                              
	}                                                                                                  
	public function import_bpm_instrumen_monev()                                                             
    {                                                                                               
		$data=[                                                                                          
			'title' => 'Import BPM Instrumen Monev',                                                             
			'isi' => 'bpm_instrumen_monev/v_import_bpm_instrumen_monev',                                                         
		];                                                                                               
		$this->load->view('layout/v_wrapper', $data);                                                    
    }                                                                                               
	public function bpm_instrumen_monev_import(){                                                            
			$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');              
			if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {         
				$arr_file = explode('.', $_FILES['file']['name']); //get file                                
				$extension = end($arr_file); //get file extension                                            
				if('csv' == $extension) {                                                                    
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();                                      
				} else if ('xlsx'){                                                                          
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();                                     
				} else {                                                                                     
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();                                      
				}                                                                                            
				$dataList = array();                                                                         
				$dataListArray = array();                                                                    
				$reader->setReadDataOnly(true);                                                              
				$objPHPExcel = $reader->load($_FILES['file']['tmp_name']);                                   
				$worksheet = $objPHPExcel->getSheetByName('bpm_instrumen_monev');                                  
				$highestRow = $worksheet->getHighestRow(); // e.g. 12                                        
				$highestColumn = $worksheet->getHighestColumn(); // e.g M                                    
				$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 7             
				for ($row = 2; $row <= $highestRow; ++$row) {                                                
					for ($col = 1; $col <= $highestColumnIndex; ++$col) {                                      
						$dataList[$col] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();             
						}                                                                                        
						array_push ($dataListArray, $dataList);                                                  
				}                                                                                            
				if($this->model_bpm_instrumen_monev->import_bpm_instrumen_monev($dataListArray) == TRUE){                        
					redirect('bpm_instrumen_monev');                                                           
				} else {                                                                                     
					redirect('index.php/admin');                                                               
				}                                                                                            
			}                                                                                              
		}                                                                                                
		}                                                                                                
