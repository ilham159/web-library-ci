<?php   
defined('BASEPATH') OR exit('No direct script access allowed');

class Operators extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model('operators_model');
        $this->load->model(array('operators_model'));

        $this->load->model('profile_model');
        $this->load->model(array('profile_model'));

        $this->load->library('form_validation');

        if (empty($this->session->userdata('email'))) {
        	redirect('auth');
        }
    }

	public function index() {
		//mengarahkan ke function read
		$this->read();
		$this->pie();
	}

	public function read() {
		$id_operator = $this->uri->segment(3);
		//memanggil function read pada provinsi model
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_operators = $this->operators_model->read_table();
		$data_operators1 = $this->operators_model->read1();

		//function read berfungsi mengambil 1 data dari table provinsi sesuai id yg dipilih
		$data_operators_single = $this->operators_model->read_single($id_operator);

		$data['username'] = $this->profile_model->profile($this->session->userdata('id_login'));
		//mengirim data ke view
		$output = array(
						'judul' => 'List Operators',
						//data provinsi dikirim ke view
						'container' => 'operators_read',
						'data_operators' => $data_operators,
						'data_operators1' => $data_operators1,
						'data_operators_single' => $data_operators_single,
						'data' => $data
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert_submit() {
		//menangkap data input dari view
		$id_operators = $this->input->post('id_operators');
		$nim = $this->input->post('nim');
		$name = $this->input->post('name');
		$gender = $this->input->post('gender');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');

		//mengirim data ke model
		$input = array(
						//format : nama field/kolom table => data input dari view
						'nim' => $nim,
						'name' => $name,
						'gender' => $gender,
						'phone' => $phone,
						'address' => $address,
					);

		//memanggil function insert pada kota model
		//function insert berfungsi menyimpan/create data ke table kota di database
		if (empty($this->input->post('id_operators'))) {
			$this->operators_model->insert($input);
			$this->session->set_flashdata('flash', 'added');
		}else{
			$this->operators_model->update($input,$id_operators);
			$this->session->set_flashdata('flash', 'changed');
		}
		
		//mengembalikan halaman ke function read
		redirect('operators/read');
	}

	public function getEdit() {
		echo json_encode($this->operators_model->read_single($_POST['id']));
	}

	public function delete() {
		$this->session->set_flashdata('flash', 'delete');
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		//memanggil function delete pada provinsi model
		$data_operators = $this->operators_model->delete($id);

		//mengembalikan halaman ke function read
		redirect('operators/read');
	}

	public function export() {
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_operators = $this->operators_model->read();
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'Nim');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Student Name');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Gender');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Phone');
		$excel->getActiveSheet()->setCellValue( 'E1', 'Address');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_operators as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['nim']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['name']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['gender']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['phone']);
			$excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['address']);

			//increment baris untuk data selanjutnya
			$baris++;
		}

		//nama file excel
		$filename='export_data_operators.xls';

		//konfigurasi file excel
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function export1() {

		$id = $this->uri->segment(3);
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_operators = $this->operators_model->read_export($id);
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'Nim');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Student Name');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Gender');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Phone');
		$excel->getActiveSheet()->setCellValue( 'E1', 'Address');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_operators as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['nim']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['name']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['gender']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['phone']);
			$excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['address']);

			//increment baris untuk data selanjutnya
			$baris++;
		}

		//nama file excel
		$filename='export_data_operators_per_id.xls';

		//konfigurasi file excel
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function profile()
	{
		$data['username'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();

		$output = array(
			'container' => 'profile',
			'data' => $data
		);

		$this->load->view('theme/index', $output);
	}
}