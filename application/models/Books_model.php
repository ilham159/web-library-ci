<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class books_model extends CI_Model {

	//function read berfungsi mengambil/read data dari table provinsi di database
	public function read() {

		//sql read
		$this->db->select('*');
		$this->db->from('book');
		$this->db->join('shelf','shelf.id_shelfs=book.id_shelf');
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	public function read1() {

		//sql read
		$this->db->select('*');
		$this->db->from('shelf');
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}
	
	public function read_table(){
		$this->db->select('*');
		$this->db->from('book');
		$this->db->join('shelf','shelf.id_shelfs=book.id_shelf');

		$query = $this->db->get();

		return $query->result_array();
	}

	//function read berfungsi mengambil/read data dari table provinsi di database
	public function read_single($id) {

		//sql read
		$this->db->select('*');
		$this->db->from('book');
		$this->db->join('shelf','shelf.id_shelfs=book.id_shelf');
		//$id = id data yang dikirim dari controller (sebagai filter data yang dipilih)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id_books', $id);

		$query = $this->db->get();

		//query->row_array = mengirim data ke controller dalam bentuk 1 data
        return $query->row_array();
	}

	//function insert berfungsi menyimpan/create data ke table provinsi di database
	public function insert($input) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id_books');
		//$input = data yang dikirim dari controller
		return $this->db->insert('book', $input);
	}

	//function update berfungsi merubah data ke table provinsi di database
	public function update($input, $id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id_books', $id);

		//$input = data yang dikirim dari controller
		return $this->db->update('book', $input);
	}

	//function delete berfungsi menghapus data dari table provinsi di database
	public function delete($id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang dihapus)
		$this->db->where('id_books', $id);
		return $this->db->delete('book');
	}

	public function read_export($id) {

		//sql read
		$this->db->select('*');
		$this->db->from('book');
		$this->db->join('shelf','shelf.id_shelfs=book.id_shelf');
		$this->db->where('id_books', $id);
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	//function read berfungsi mengambil/read data dari table provinsi di database
	public function dashboard($dashboard) {

		//sql read
		$this->db->select('*');
		$this->db->from('book');
		$this->db->join('shelf','shelf.id_shelfs=book.id_shelf');
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}
}