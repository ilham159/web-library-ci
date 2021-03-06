<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model(array('books_model'));
    }

    public function index() {
		$this->pie();
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