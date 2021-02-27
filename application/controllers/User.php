<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class User extends CI_Controller
{
	
	public function index()
	{
		$data['username'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();

		$this->load->view('theme/container', $data);
	}
}