<?php   
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model('students_model');
        $this->load->model(array('students_model'));

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
		$id_student = $this->uri->segment(3);
		//memanggil function read pada provinsi model
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_students1 = $this->students_model->read1();

		//function read berfungsi mengambil 1 data dari table provinsi sesuai id yg dipilih
		$data_students_single = $this->students_model->read_single($id_student);

		$data['username'] = $this->profile_model->profile($this->session->userdata('id_login'));
		//mengirim data ke view
		$output = array(
						'judul' => 'List Students',
						//data provinsi dikirim ke view
						'container' => 'students_read',
						'data_students1' => $data_students1,
						'data_students_single' => $data_students_single,
						'data' => $data
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	//fungsi menampilkan data dalam bentuk json
	public function datatables() {
        //menunda loading (bisa dihapus, hanya untuk menampilkan pesan processing)
        sleep(1);

        //memanggil fungsi model datatables
        $list = $this->students_model->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field['nim'];
            $row[] = $field['name'];
            $row[] = $field['gender'];
            $row[] = number_format($field['semester']);
            $row[] = $field['major_name'];
            $row[] = $field['phone'];
            $row[] = $field['address'];
            $row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" data-toggle="modal" data-target="#modal_add_edit" title="Edit" onclick="edit_student('."'".$field['id_students']."'".')"><i class="fa fa-cog fa-spin"></i></a>
            		 <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_student('."'".$field['id_students']."'".')"><i class="fa fa-trash"></i></a>
            		 <a class="btn btn-sm btn-primary" href="'.base_url('students/export1/'.$field['id_students']).'"><i class="fa fa-print"></i></a>';

            $data[] = $row;
        }
    
        //mengirim data json
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->students_model->count_all(),
            "recordsFiltered" => $this->students_model->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

	public function insert_submit() {
		//menangkap data input dari view
		$id_students = $this->input->post('id_students');
		$nim = $this->input->post('nim');
		$name = $this->input->post('name');
		$gender = $this->input->post('gender');
		$semester = $this->input->post('semester');
		$id_major = $this->input->post('id_major');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');

		//mengirim data ke model
		$input = array(
						//format : nama field/kolom table => data input dari view
						'nim' => $nim,
						'name' => $name,
						'gender' => $gender,
						'semester' => $semester,
						'id_major' => $id_major,
						'phone' => $phone,
						'address' => $address,
					);

		//memanggil function insert pada kota model
		//function insert berfungsi menyimpan/create data ke table kota di database
		if (empty($this->input->post('id_students'))) {
			$this->students_model->insert($input);
			$this->session->set_flashdata('flash', 'added');
		}else{
			$this->students_model->update($input,$id_students);
			$this->session->set_flashdata('flash', 'changed');
		}
		
		//mengembalikan halaman ke function read
		redirect('students/read');
	}

	public function getEdit($id) {
		$data = $this->students_model->read_single($id);
        echo json_encode($data);
	}

	public function delete($id) {
		$this->session->set_flashdata('flash', 'delete');
		//menangkap id data yg dipilih dari view
		$this->students_model->delete($id);
        echo json_encode(array("status" => TRUE));
	}

	public function export() {
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_students = $this->students_model->read_table();
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'Nim');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Student Name');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Gender');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Semester');
		$excel->getActiveSheet()->setCellValue( 'E1', 'Major');
		$excel->getActiveSheet()->setCellValue( 'F1', 'Phone');
		$excel->getActiveSheet()->setCellValue( 'G1', 'Address');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_students as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['nim']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['name']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['gender']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['semester']);
			$excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['major_name']);
			$excel->getActiveSheet()->setCellValue( 'F'.$baris, $data['phone']);
			$excel->getActiveSheet()->setCellValue( 'G'.$baris, $data['address']);

			//increment baris untuk data selanjutnya
			$baris++;
		}

		//nama file excel
		$filename='export_data_students.xls';

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
		$data_students = $this->students_model->read_export($id);
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'Nim');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Student Name');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Gender');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Semester');
		$excel->getActiveSheet()->setCellValue( 'E1', 'Major');
		$excel->getActiveSheet()->setCellValue( 'F1', 'Phone');
		$excel->getActiveSheet()->setCellValue( 'G1', 'Address');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_students as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['nim']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['name']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['gender']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['semester']);
			$excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['major_name']);
			$excel->getActiveSheet()->setCellValue( 'F'.$baris, $data['phone']);
			$excel->getActiveSheet()->setCellValue( 'G'.$baris, $data['address']);

			//increment baris untuk data selanjutnya
			$baris++;
		}

		//nama file excel
		$filename='export_data_students_per_id.xls';

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