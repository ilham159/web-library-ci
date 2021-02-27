<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
 * 
 */
class Profile extends CI_Controller
{
	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->model('profile_model');
        $this->load->model(array('profile_model'));

        if (empty($this->session->userdata('email'))) {
        	redirect('auth');
        }
    }

    public function index()
    {
    	$this->profile();
    }


	public function profile()
	{
		$data['username'] = $this->profile_model->profile($this->session->userdata('id_login'));

		$output = array(
			'judul' => 'profile_user',
			'container' => 'profile_read',
			'data' => $data
		);

		$this->load->view('theme/index', $output);
	}
}