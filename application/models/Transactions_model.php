<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_model extends CI_Model {

	//function read berfungsi mengambil/read data dari table provinsi di database
	public function read() {

		//sql read
		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->join('operator','operator.id_operators=transaction.id_operator');
		$this->db->join('borrowing','borrowing.id_borrowings=transaction.id_borrowing');
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	public function read1() {

		//sql read
		$this->db->select('*');
		$this->db->from('operator');
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	public function read2() {

		//sql read
		$this->db->select('*');
		$this->db->from('borrowing	');
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}
	
	public function read_table(){
		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->join('operator','operator.id_operators=transaction.id_operator');
		$this->db->join('borrowing','borrowing.id_borrowings=transaction.id_borrowing');

		$query = $this->db->get();

		return $query->result_array();
	}

	//function read berfungsi mengambil/read data dari table provinsi di database
	public function read_single($id) {

		//sql read
		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->join('operator','operator.id_operators=transaction.id_operator');
		$this->db->join('borrowing','borrowing.id_borrowings=transaction.id_borrowing');
		//$id = id data yang dikirim dari controller (sebagai filter data yang dipilih)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id_transactions', $id);

		$query = $this->db->get();

		//query->row_array = mengirim data ke controller dalam bentuk 1 data
        return $query->row_array();
	}

	//function insert berfungsi menyimpan/create data ke table provinsi di database
	public function insert($input) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id_transactions');
		//$input = data yang dikirim dari controller
		return $this->db->insert('transaction', $input);
	}

	//function update berfungsi merubah data ke table provinsi di database
	public function update($input,$id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id_transactions',$id);

		//$input = data yang dikirim dari controller
		return $this->db->update('transaction', $input);
	}

	//function delete berfungsi menghapus data dari table provinsi di database
	public function delete($id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang dihapus)
		$this->db->where('id_transactions', $id);
		return $this->db->delete('transaction');
	}

	public function read_export($id) {

		//sql read
		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->join('operator','operator.id_operators=transaction.id_operator');
		$this->db->where('transaction.id_transactions', $id);
		$this->db->join('borrowing','borrowing.id_borrowings=transaction.id_borrowing');
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}
}