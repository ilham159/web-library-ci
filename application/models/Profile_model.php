<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Profile_model extends CI_Model
{
	
	public function profile()
	{
		$this->db->select('*');
		$this->db->join('user_role','user_role.id=user.role_id');

		return $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
	}
}