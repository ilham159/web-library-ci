<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class borrowings_model extends CI_Model {

	var $table = 'borrowing';
	var $column_order = array(null, 'id_borrowings','dates','limit','quantity_b','id_status','id_book','id_student');
	var $column_search = array('id_borrowings','dates','limit','quantity_b','id_status','id_book','id_student');
	var $order = array('id_borrowings' => 'asc'); // default order 

	public function __construct()
    {
        parent::__construct();
    }

	//function read berfungsi mengambil/read data dari table provinsi di database
	private function _get_datatables_query() {

		//sql read

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('book','book.id_books=borrowing.id_book');
		$this->db->join('student','student.id_students=borrowing.id_student');
		$this->db->join('status','status.id_statuses=borrowing.id_status');
		$this->db->where('id_status=1');


		$i = 0;
		
		foreach ($this->column_search as $item) // looping awal
        {
        	$search = $this->input->post('search');
            if($search['value']) 

            // jika datatable mengirimkan pencarian dengan metode POST
            {
                // looping awal 
                if($i===0) {
                    $this->db->group_start(); 
                    $this->db->like($item, $search['value']);
                } else {
                    $this->db->or_like($item, $search['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if($this->input->post('order')) {
        	$order = $this->input->post('order');
            $this->db->order_by($this->column_order[$order['0']['column']], $order['0']['dir']);

        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
	}

	function get_datatables() {
        $this->_get_datatables_query();
        if($this->input->post('length') != -1)
        	$this->db->limit($this->input->post('length'), $this->input->post('start'));

        $query = $this->db->get();
        return $query->result_array();
    }
 
 	//menghitung tota data sesuai filter/pagination
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
 	//menghitung total data di table
    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

	//function read berfungsi mengambil/read data dari table provinsi di database
	public function read() {

		//sql read
		$this->db->select('*');
		$this->db->from('borrowing');
		$this->db->join('book','book.id_books=borrowing.id_book');
		$this->db->join('student','student.id_students=borrowing.id_student');
		$this->db->where('quantity_b=1');
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	public function read1() {

		//sql read
		$this->db->select('*');
		$this->db->from('book');
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}

	public function read2() {

		//sql read
		$this->db->select('*');
		$this->db->from('student');
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}
	
	public function read_table(){
		$this->db->select('*');
		$this->db->from('borrowing');
		$this->db->join('book','book.id_books=borrowing.id_book');
		$this->db->join('student','student.id_students=borrowing.id_student');
		$this->db->join('status','status.id_statuses=borrowing.id_status');
		$this->db->where('quantity_b=1');

		$query = $this->db->get('');

		return $query->result_array();
	}

	//function read berfungsi mengambil/read data dari table provinsi di database
	public function read_single($id) {

		//sql read
		$this->db->select('*');
		$this->db->from('borrowing');
		$this->db->join('book','book.id_books=borrowing.id_book');
		$this->db->join('student','student.id_students=borrowing.id_student');
		$this->db->join('status','status.id_statuses=borrowing.id_status');
		//$id = id data yang dikirim dari controller (sebagai filter data yang dipilih)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id_borrowings', $id);

		$query = $this->db->get();

		//query->row_array = mengirim data ke controller dalam bentuk 1 data
        return $query->row_array();
	}

	//function insert berfungsi menyimpan/create data ke table provinsi di database
	public function insert($input) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id_borrowings');
		//$input = data yang dikirim dari controller
		return $this->db->insert('borrowing', $input);
	}

	//function update berfungsi merubah data ke table provinsi di database
	public function update($input,$id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->where('id_borrowings',$id);

		//$input = data yang dikirim dari controller
		return $this->db->update('borrowing', $input);
	}

	//function delete berfungsi menghapus data dari table provinsi di database
	public function delete($id) {
		//$id = id data yang dikirim dari controller (sebagai filter data yang dihapus)
		$this->db->where('id_borrowings', $id);
		return $this->db->delete('borrowing');
	}

	public function read_export($id) {

		//sql read
		$this->db->select('*');
		$this->db->from('borrowing');
		$this->db->join('book','book.id_books=borrowing.id_book');
		$this->db->join('student','student.id_students=borrowing.id_student');
		$this->db->join('status','status.id_statuses=borrowing.id_status');
		$this->db->where('id_borrowings', $id);
		
		$query = $this->db->get();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->result_array();
	}
}