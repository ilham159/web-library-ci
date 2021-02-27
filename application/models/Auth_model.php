<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Auth_model extends CI_Model
{
	
	public function insert($input)
	{
		//$id = id data yang dikirim dari controller (sebagai filter data yang diubah)
		//filter data sesuai id yang dikirim dari controller
		$this->db->insert('user', $input);
		//$input = data yang dikirim dari controller
		return $this->db->insert('user', $input);
	}
}