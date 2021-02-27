<?php   
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model('transactions_model');
        $this->load->model(array('transactions_model'));

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
		$id_transaction = $this->uri->segment(3);
		//memanggil function read pada provinsi model
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_transactions = $this->transactions_model->read_table();
		$data_transactions1 = $this->transactions_model->read1();
		$data_transactions2 = $this->transactions_model->read2();

		//function read berfungsi mengambil 1 data dari table provinsi sesuai id yg dipilih
		$data_transactions_single = $this->transactions_model->read_single($id_transaction);

		$data['username'] = $this->profile_model->profile($this->session->userdata('id_login'));
		//mengirim data ke view
		$output = array(
						'judul' => 'List transactions',
						//data provinsi dikirim ke view
						'container' => 'transactions_read',
						'data_transactions' => $data_transactions,
						'data_transactions1' => $data_transactions1,
						'data_transactions2' => $data_transactions2,
						'data_transactions_single' => $data_transactions_single,
						'data' => $data
					);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}

	public function insert_submit() {
		//menangkap data input dari view
		$id_transactions = $this->input->post('id_transactions');
		$transaction_date = $this->input->post('transaction_date');
		$transaction_total = $this->input->post('transaction_total');
		$id_operator = $this->input->post('id_operator');
		$id_borrowing = $this->input->post('id_borrowing');

		//mengirim data ke model
		$input = array(
						//format : nama field/kolom table => data input dari view
						'transaction_date' => $transaction_date,
						'transaction_total' => $transaction_total,
						'id_operator' => $id_operator,
						'id_borrowing' => $id_borrowing
					);

		//memanggil function insert pada kota model
		//function insert berfungsi menyimpan/create data ke table kota di database
		if (empty($this->input->post('id_transactions'))) {
			$this->transactions_model->insert($input);
			$this->session->set_flashdata('flash', 'added');
		}else{
			$this->transactions_model->update($input,$id_transactions);
			$this->session->set_flashdata('flash', 'changed');
		}
		
		//mengembalikan halaman ke function read
		redirect('transactions/read');
	}

	public function getEdit() {
		echo json_encode($this->transactions_model->read_single($_POST['id']));
	}

	public function delete() {
		$this->session->set_flashdata('flash', 'delete');
		//menangkap id data yg dipilih dari view
		$id = $this->uri->segment(3);

		//memanggil function delete pada provinsi model
		$data_transactions = $this->transactions_model->delete($id);

		//mengembalikan halaman ke function read
		redirect('transactions/read');
	}

	public function export() {
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_transactions = $this->transactions_model->read();
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'Transactions Date');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Transactions Total');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Operator Name');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Id Borrowing');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_transactions as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['transaction_date']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['transaction_total']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['name']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['id_operators']);

			//increment baris untuk data selanjutnya
			$baris++;
		}

		//nama file excel
		$filename='export_data_transactions.xls';

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
		$data_transactions = $this->transactions_model->read_export($id);
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'Transactions Date');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Transactions Total');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Operator Name');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Id Borrowing');


		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_transactions as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['transaction_date']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['transaction_total']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['name']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['id_operators']);

			//increment baris untuk data selanjutnya
			$baris++;
		}

		//nama file excel
		$filename='export_data_transactions_per_id.xls';

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