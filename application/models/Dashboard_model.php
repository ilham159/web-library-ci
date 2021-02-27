<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Dashboard_model extends CI_Model
{
	
	public function total_books()
	{
		$this->db->select('*');
		$this->db->from('student');
		
		$query = $this->db->num_rows();

		//$query->result_array = mengirim data ke controller dalam bentuk semua data
        return $query->count_all_result();
	}
}