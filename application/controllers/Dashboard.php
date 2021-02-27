<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Dashboard extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();

        //memanggil model	
        $this->load->model('dashboard_model');
        $this->load->model(array('dashboard_model'));


        $this->load->model('profile_model');
        $this->load->model(array('profile_model'));

        $this->load->model('students_model');
        $this->load->model(array('students_model'));

        if (empty($this->session->userdata('email'))) {
        	redirect('auth');
        }
	}

	public function index()
	{
		$this->dashboard();
	}

	public function dashboard() {
		//memanggil function read pada kota model
		//function read berfungsi mengambil/read data dari table kota di database
		$data['username'] = $this->profile_model->profile($this->session->userdata('id_login'));
		//$total_books['books'] = $this->dashboard_model->total_books();
		$total_students = $this->db->count_all('student');
		$total_operators = $this->db->count_all('operator');
		$total_books = $this->db->count_all('book');
		$total_shelfs = $this->db->count_all('shelf');
		$total_borrowing = $this->db->count_all('borrowing');
		$total_majors = $this->db->count_all('major');
		$total_transactions = $this->db->count_all('transaction');
		$total_users = $this->db->count_all('user');

		//mengirim data ke view
		$output = array(
					'judul' => 'Dashboard',
					'container' => 'dashboard',
					'data' => $data,
					'total_students' => $total_students,
					'total_operators' => $total_operators,
					'total_books' => $total_books,
					'total_shelfs' => $total_shelfs,
					'total_borrowing' => $total_borrowing,
					'total_majors' => $total_majors,
					'total_transactions' => $total_transactions,
					'total_users' => $total_users,
				);

		//memanggil file view
		$this->load->view('theme/index', $output);
	}
}