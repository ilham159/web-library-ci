<?php   
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model('books_model');
        $this->load->model(array('books_model'));
    }

	public function index() {
		//mengarahkan ke function read
		$this->read();
		$this->pie();
	}

	public function read() {
		//memanggil function read pada provinsi model
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_books = $this->books_model->read_table();

		//mengirim data ke view
		$output = array(
						'judul' => 'List Books',

						//data provinsi dikirim ke view
						'data_books' => $data_books
					);

		//memanggil file view
		$this->load->view('books_read', $output);
	}

	public function insert() {
		//mengambil daftar provinsi dari table provinsi
		$data_books = $this->books_model->read();
		$data_books1 = $this->books_model->read1();
		$data_books2 = $this->books_model->read2();

		//mengirim data ke view
		$output = array(
						'judul' => 'Insert book',

						//mengirim daftar provinsi ke view
						'data_books' => $data_books,
						'data_books1' => $data_books1,
						'data_books2' => $data_books2,
					);

		//memanggil file view
		$this->load->view('books_insert', $output);
	}

	public function insert_submit() {
		//menangkap data input dari view
		$category = $this->input->post('category');
		$publisher = $this->input->post('publisher');
		$book_name = $this->input->post('book_name');
		$stock = $this->input->post('stock');
		//setting library upload
	        $config['upload_path']          = './upload_images/';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']             = 10000;
	        $this->load->library('upload', $config);

	        //jika gagal upload
	        if ( ! $this->upload->do_upload('userfile')) {

	        	//respon alasan kenapa gagal upload
	        	$response = $this->upload->display_errors();

                $output = array(
                				'judul' => 'Upload File',
                				'response' => $response
                			);
                $this->load->view('books_insert', $output);

            //jika gagal berhasil
	        } else {
	        	
	        	//respon upload berhasil 
	        	$upload_data = $this->upload->data();
	        	$file_name = $upload_data['file_name'];

	        	$response = 'file uploaded successfully, file name : '.$file_name;

                $output = array(
                				'judul' => 'Upload File',
                				'response' => $response
                			);
                $this->load->view('books_insert', $output);
	        }

		//mengirim data ke model
		$input = array(
						//format : nama field/kolom table => data input dari view
						'id_category' => $category,
						'id_publisher' => $publisher,
						'book_name' => $book_name,
						'book_stock' => $stock,
						'file_name' => $file_name,
					);

		//memanggil function insert pada kota model
		//function insert berfungsi menyimpan/create data ke table kota di database
		$data_books = $this->books_model->insert($input);

		//mengembalikan halaman ke function read
		redirect('books/read');
	}

	public function update() {
		//menangkap id data yg dipilih dari view (parameter get)
		$id_book = $this->uri->segment(3);

		$data_books = $this->books_model->read();
		$data_books1 = $this->books_model->read1();
		$data_books2 = $this->books_model->read2();

		//function read berfungsi mengambil 1 data dari table provinsi sesuai id yg dipilih
		$data_books_single = $this->books_model->read_single($id_book);

		//mengirim data ke view
		$output = array(
						'judul' => 'Edit Book',
						'data_books' => $data_books,
						'data_books1' => $data_books1,
						'data_books2' => $data_books2,
						//mengirim data provinsi yang dipilih ke view
						'data_books_single' => $data_books_single,
					);

		//memanggil file view
		$this->load->view('books_update', $output);
	}

	public function update_submit() {
		//menangkap id data yg dipilih dari view
		$id_book = $this->uri->segment(3);

		//menangkap data input dari view
		$category = $this->input->post('category');
		$publisher = $this->input->post('publisher');
		$name = $this->input->post('name');
		$stock = $this->input->post('stock');

		//mengirim data ke model
		$input = array(
						//format : nama field/kolom table => data input dari view
						'id_category' => $category,
						'id_publisher' => $publisher,
						'book_name' => $name,
						'book_stock' => $stock,
					);

		//memanggil function insert pada provinsi model
		//function insert berfungsi menyimpan/create data ke table provinsi di database
		$data_books = $this->books_model->update($input, $id_book);

		//mengembalikan halaman ke function read
		redirect('books/read');
	}

	public function delete() {
		//menangkap id data yg dipilih dari view
		$id_book = $this->uri->segment(3);

		//memanggil function delete pada provinsi model
		$data_books = $this->books_model->delete($id_book);

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
		$excel->getActiveSheet()->setCellValue( 'B1', 'Category Name');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Publisher Name');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Books stock');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_books as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['book_name']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['category_name']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['publisher_name']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['book_stock']);

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

		$id_book = $this->uri->segment(3);
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_books = $this->books_model->read_export($id_book);
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'book Name');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Category Name');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Publisher Name');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Books stock');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_books as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['book_name']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['category_name']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['publisher_name']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['book_stock']);

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

	public function export2() {
		//memanggil function read pada provinsi model
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_books = $this->books_model->read();

		//mengirim data ke view
		$output = array(
						'judul' => 'Daftar Books',

						//data provinsi dikirim ke view
						'data_books' => $data_books,
					);

		//memanggil file view
		$this->load->view('books_export', $output);
	}

	public function export3() {

		$id_book = $this->uri->segment(3);
		//memanggil function read pada provinsi model
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_books = $this->books_model->read($id_book);

		//mengirim data ke view
		$output = array(
						'judul' => 'Daftar Books',

						//data provinsi dikirim ke view
						'data_books' => $data_books,
					);

		//memanggil file view
		$this->load->view('books_export', $output);
	}

	public function pie() {
		//memanggil function read pada kota model
		//function read berfungsi mengambil/read data dari table kota di database
		$data_books = $this->books_model->read();

		//mengirim data ke view
		$output = array(
					'judul' => 'Pie Chart',
					'data_books' => $data_books
				);

		//memanggil file view
		$this->load->view('chart_pie', $output);


	}
}