<?php   
defined('BASEPATH') OR exit('No direct script access allowed');

class returns extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model('returns_model');
        $this->load->model(array('returns_model'));

        $this->load->model('profile_model');
        $this->load->model(array('profile_model'));

        $this->load->library('pdf');

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
		$id_borrowing = $this->uri->segment(3);	
		//memanggil function read pada provinsi model
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_returns = $this->returns_model->read_table();
		$data_returns1 = $this->returns_model->read1();
		$data_returns2 = $this->returns_model->read2();

		//function read berfungsi mengambil 1 data dari table provinsi sesuai id yg dipilih
		$data_returns_single = $this->returns_model->read_single($id_borrowing);

		$data['username'] = $this->profile_model->profile($this->session->userdata('id_login'));
		//mengirim data ke view
		$output = array(
						'judul' => 'List Returns',
						//data provinsi dikirim ke view
						'container' => 'returns_read',
						'data_returns' => $data_returns,
						'data_returns1' => $data_returns1,
						'data_returns2' => $data_returns2,
						'data_returns_single' => $data_returns_single,
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
        $list = $this->returns_model->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        //mencetak data json
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field['id_borrowings'];
            $row[] = $field['dates'];
            $row[] = $field['limit'];
            $row[] = $field['status_name'];
            $row[] = $field['title'];
            $row[] = $field['file_name'] != null ? '<img src="'.base_url('/upload_images/'.$field['file_name']).'" width="70px">' : null;
            $row[] = $field['name'];
            $row[] = '<a class="btn btn-sm btn-primary" title="Print as EXCEL" href="'.base_url('returns/export1/'.$field['id_borrowings']).'"><i class="ace-icon fa fa-print faa-vertical animated"></i></a>
            		  <a class="btn btn-sm btn-success" title="Print as PDF" href="'.base_url('returns/export_pdf1/'.$field['id_borrowings']).'"><i class="ace-icon fa fa-print faa-shake animated"></i></a>';

            $data[] = $row;
        }
    
        //mengirim data json
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->returns_model->count_all(),
            "recordsFiltered" => $this->returns_model->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

	public function export() {
		//function read berfungsi mengambil/read data dari table provinsi di database
		$data_borrowings = $this->returns_model->read_table();
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'Dates');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Limits');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Quantity');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Status');
		$excel->getActiveSheet()->setCellValue( 'E1', 'Book Name');
		$excel->getActiveSheet()->setCellValue( 'F1', 'Students Name');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_borrowings as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['dates']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['limit']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['quantity_b']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['status_name']);
			$excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['title']);
			$excel->getActiveSheet()->setCellValue( 'F'.$baris, $data['name']);

			//increment baris untuk data selanjutnya
			$baris++;
		}

		//nama file excel
		$filename='export_data_borrowings.xls';

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
		$data_borrowings = $this->returns_model->read_export($id);
		
		//load library excel
		$this->load->library('excel');
		$excel = $this->excel;

		//judul sheet excel
		$excel->setActiveSheetIndex(0)->setTitle('Export Data');

		//header table
		$excel->getActiveSheet()->setCellValue( 'A1', 'Dates');
		$excel->getActiveSheet()->setCellValue( 'B1', 'Limits');
		$excel->getActiveSheet()->setCellValue( 'C1', 'Quantity');
		$excel->getActiveSheet()->setCellValue( 'D1', 'Status');
		$excel->getActiveSheet()->setCellValue( 'E1', 'Book Name');
		$excel->getActiveSheet()->setCellValue( 'F1', 'Students Name');

		//baris awal data dimulai baris 2 (baris 1 digunakan header)
		$baris = 2;

		//looping data provinsi (mengisi data ke excel)
		foreach($data_borrowings as $data) {

			//mengisi data ke excel per baris
			$excel->getActiveSheet()->setCellValue( 'A'.$baris, $data['dates']);
			$excel->getActiveSheet()->setCellValue( 'B'.$baris, $data['limit']);
			$excel->getActiveSheet()->setCellValue( 'C'.$baris, $data['quantity_b']);
			$excel->getActiveSheet()->setCellValue( 'D'.$baris, $data['status_name']);
			$excel->getActiveSheet()->setCellValue( 'E'.$baris, $data['title']);
			$excel->getActiveSheet()->setCellValue( 'F'.$baris, $data['name']);

			//increment baris untuk data selanjutnya
			$baris++;
		}

		//nama file excel
		$filename='export_data_borrowings_per_id.xls';

		//konfigurasi file excel
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function export_pdf()
    {
        $pdf = new FPDF();
        $pdf = new FPDF("L","cm","A4");
        $pdf->SetMargins(2,1,1);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','B',11);
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,'Mercu Buana',0,'L');
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,'Call : 009510003066',0,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,'JL. Meruya Selatan',0,'L');
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,' Email : mercubuana@ac.id',0,'L');
        $pdf->Line(1,3.1,28.5,3.1);
        $pdf->SetLineWidth(0.1);
        $pdf->Line(1,3.2,28.5,3.2);
        $pdf->SetLineWidth(0);
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(25.5,0.7,"Goods data report",0,10,'C');
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(5,0.7,"Printed on : ".date("D-d/m/Y"),0,0,'C');
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(1, 0.8,   'NO', 1, 0, 'C');
        $pdf->Cell(3, 0.8,   'Dates', 1, 0, 'C');
        $pdf->Cell(3, 0.8,   'Limit', 1, 0, 'C');
        $pdf->Cell(4, 0.8,   'Quantity', 1, 0, 'C');
        $pdf->Cell(4, 0.8,   'Status', 1, 0, 'C');
        $pdf->Cell(3.5, 0.8, 'Book Name', 1, 0, 'C');
        $pdf->Cell(4.5, 0.8, 'Students Name', 1, 1, 'C');
        $pdf->SetFont('Arial','',10);
    $no=1;
    $this->db->select('*');
	$this->db->from('borrowing');
	$this->db->join('book','book.id_books=borrowing.id_book');
	$this->db->join('student','student.id_students=borrowing.id_student');
	$this->db->join('status','status.id_statuses=borrowing.id_status');
	$this->db->where('id_status=2');
    $data=$this->db->get()->result();
    foreach($data as $row){

	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $row->dates,1, 0, 'C');
	$pdf->Cell(3, 0.8, $row->limit, 1, 0,'C');
	$pdf->Cell(4, 0.8, $row->quantity_b,1, 0, 'C');
	$pdf->Cell(4, 0.8, $row->status_name,1, 0, 'C');
	$pdf->Cell(3.5, 0.8, $row->title ,1, 0, 'C');
	$pdf->Cell(4.5, 0.8, $row->name, 1, 1,'C');
	$no++;
	}
    $pdf->Output("Goods_Report_Returns.pdf","I");
  	}

  	public function export_pdf1($id)
    {
        $pdf = new FPDF();
        $pdf = new FPDF("L","cm","A4");
        $pdf->SetMargins(2,1,1);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','B',11);
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,'Mercu Buana',0,'L');
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,'Call : 009510003066',0,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,'JL. Meruya Selatan',0,'L');
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,' Email : mercubuana@ac.id',0,'L');
        $pdf->Line(1,3.1,28.5,3.1);
        $pdf->SetLineWidth(0.1);
        $pdf->Line(1,3.2,28.5,3.2);
        $pdf->SetLineWidth(0);
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(25.5,0.7,"Goods data report",0,10,'C');
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(5,0.7,"Printed on : ".date("D-d/m/Y"),0,0,'C');
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(1, 0.8,   'NO', 1, 0, 'C');
        $pdf->Cell(3, 0.8,   'Dates', 1, 0, 'C');
        $pdf->Cell(3, 0.8,   'Limit', 1, 0, 'C');
        $pdf->Cell(4, 0.8,   'Quantity', 1, 0, 'C');
        $pdf->Cell(4, 0.8,   'Status', 1, 0, 'C');
        $pdf->Cell(3.5, 0.8, 'Book Name', 1, 0, 'C');
        $pdf->Cell(4.5, 0.8, 'Students Name', 1, 1, 'C');
        $pdf->SetFont('Arial','',10);
    $no=1;

    $id = $this->uri->segment(3);
	//function read berfungsi mengambil/read data dari table provinsi di database
	$data = $this->returns_model->read_export($id);
    foreach($data as $row){

	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $row['dates'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $row['limit'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $row['quantity_b'],1, 0, 'C');
	$pdf->Cell(4, 0.8, $row['status_name'],1, 0, 'C');
	$pdf->Cell(3.5, 0.8, $row['title'] ,1, 0, 'C');
	$pdf->Cell(4.5, 0.8, $row['name'], 1, 1,'C');
	$no++;
	}
    $pdf->Output("Goods_Report_Returns_per_id.pdf","I");
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