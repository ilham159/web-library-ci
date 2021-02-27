<?php   
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model('books_model');
        $this->load->model(array('books_model'));

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
		$id_book = $this->uri->segment(5);
		//memanggil function read pada provinsi model
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_books = $this->books_model->read_table();
		$data_books1 = $this->books_model->read1();

		//function read berfungsi mengambil 1 data dari table provinsi sesuai id yg dipilih
		$data_books_single = $this->books_model->read_single($id_book);

		$data['username'] = $this->profile_model->profile($this->session->userdata('id_login'));


		//mengirim data ke view
		$output = array(
						'judul' => 'List Books',
						//data provinsi dikirim ke view
						'container' => 'books_read',
						'data_books' => $data_books,
						'data_books1' => $data_books1,
						'data_books_single' => $data_books_single,
						'data' => $data
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert_submit() {
		//menangkap data input dari view
		$id_books = $this->input->post('id_books');
		$title = $this->input->post('title');
		$author = $this->input->post('author');
		$quantity = $this->input->post('quantity');
		$year = $this->input->post('year');
		$id_shelf = $this->input->post('id_shelf');
		$file_name = $this->input->post('file_name');
		//setting library upload
	        $config['upload_path']          = './upload_images/';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']             = 10000;
	        $this->load->library('upload', $config);

	        //jika gagal upload
	        if ( ! $this->upload->do_upload('userfile')) {

	        	//respon alasan kenapa gagal upload
	        	$response = $this->upload->display_errors();

            //jika gagal berhasil
	        } else {
	        	
	        	//respon upload berhasil 
	        	$upload_data = $this->upload->data();
	        	$file_name = $upload_data['file_name'];

	        	$response = 'file uploaded successfully, file name : '.$file_name;
	        }

		//mengirim data ke model
		$input = array(
						//format : nama field/kolom table => data input dari view
						'title' => $title,
						'author' => $author,
						'quantity' => $quantity,
						'year' => $year,
						'id_shelf' => $id_shelf,
						'file_name' => $file_name,
					);

		//memanggil function insert pada kota model
		//function insert berfungsi menyimpan/create data ke table kota di database
		if (empty($this->input->post('id_books'))) {
			$this->books_model->insert($input);
			$this->session->set_flashdata('flash', 'added');
		}else{
			$this->books_model->update($input,$id_books);
			$this->session->set_flashdata('flash', 'changed');
		}

		//mengembalikan halaman ke function read
		redirect('books/read');
	}

	public function getEdit() {
		echo json_encode($this->books_model->read_single($_POST['id']));
	}

	public function delete() {
		$this->session->set_flashdata('flash', 'delete');
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		//memanggil function delete pada provinsi model
		$data_books = $this->books_model->delete($id);

		//mengembalikan halaman ke function read
		redirect('books/read');
	}

	public function export() {
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_books = $this->books_model->read();
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'book Name');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Author Name');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Quantity');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Year');
		$excel->getActiveSheet()->setCellValue( 'E1', 'Shelf Name');
		$excel->getActiveSheet()->setCellValue( 'F1', 'file_name');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_books as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['title']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['author']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['quantity']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['year']);
			$excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['shelf_name']);
			$excel->getActiveSheet()->setCellValue( 'F'.$baris, $data['file_name']);

			//increment baris untuk data selanjutnya
			$baris++;
		}

		//nama file excel
		$filename='export_data_books.xls';

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
		$data_books = $this->books_model->read_export($id);
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'book Name');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Author Name');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Quantity');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Year');
		$excel->getActiveSheet()->setCellValue( 'E1', 'Shelf Name');
		$excel->getActiveSheet()->setCellValue( 'F1', 'file_name');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_books as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['title']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['author']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['quantity']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['year']);
			$excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['shelf_name']);
			$excel->getActiveSheet()->setCellValue( 'F'.$baris, $data['file_name']);


			//increment baris untuk data selanjutnya
			$baris++;
		}

		//nama file excel
		$filename='export_data_books_per_id.xls';

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