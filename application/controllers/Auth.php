<?php
defined('BASEPATH') or exit('No dirrect script access allowed');

/**
  * 
  */
 class Auth extends CI_Controller
 {
 	public function __construct() {
        parent::__construct();

        //memanggil model
        $this->load->library('form_validation');

        $this->load->model('profile_model');
        $this->load->model(array('profile_model'));
    }
 	
 	public function index()
 	{
 		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
 		$this->form_validation->set_rules('password', 'Password', 'trim|required');
 		if ($this->form_validation->run() == false) {
 		//mengirim data ke view
		$output = array(
						'judul' => 'Login',
						//mengirim daftar provinsi ke view,
					);

		//memanggil file view
 		$this->load->view('login/login_header', $output);
 		$this->load->view('login/login');
 		$this->load->view('login/login_footer');

 		} else {
 			#validation success
 			$this->login();
 		}
 	}

 	private function login()
 	{
 		$email = $this->input->post('email');
 		$password = $this->input->post('password');

 		$user = $this->db->get_where('user', ['email' => $email])->row_array();

 		#if there's user
 		if ($user) {
 			if ($user['is_active'] == 1) {
 				#cek password
 				if (password_verify($password, $user['password'])) {
 					$input = [
 						'email' => $user['email'],
 						'role' => $user['role_id']
 					];
 					$this->session->set_userdata($input);
 					redirect('dashboard/dashboard');
 				} else {
 					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
 					Warning! The password you entered is wrong. please check again!
 					</div>');
 					redirect('auth');
 				}
 			} else {
 				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
	  			Warning! This email has not been activated. please activated now!
				</div>');
				redirect('auth');
 			}

 		} else {
 			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
  			Warning! The email you entered is not registered. please register now!
			</div>');
			redirect('auth');
 		}
 	}

 	public function register()
 	{
 		$this->form_validation->set_rules('username', 'Username', 'required|trim');
 		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
 			'is_unique' => 'This email has already registered!'

 		]);
 		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]',[
 			'matches' => 'password dont match!',
 			'min_length' => 'password too short!'
 		]);
 		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
 		if ($this->form_validation->run() == false) {
 			//mengirim data ke view
			$output = array(
							'judul' => 'Register',
							//mengirim daftar provinsi ke view,
						);

			//memanggil file view
	 		$this->load->view('login/login_header', $output);
	 		$this->load->view('login/register');
	 		$this->load->view('login/login_footer');
 		} else{
 			$username =htmlspecialchars($this->input->post('username', true));
 			$email = htmlspecialchars($this->input->post('email', true));
 			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
 			$image = 'default.jpg';
 			$role_id = '2';
 			$is_active = '1';
 			$date_created = time();
 			$input = array (
 				'username' => $username,
 				'email' => $email,
 				'image' => $image,
 				'password' => $password,
 				'role_id' => $role_id,
 				'is_active' => $is_active,
 				'date_created' => $date_created,
 			);

 			$this->db->insert('user', $input);
 			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  			Success! your account has been created. please login
			</div>');
 			redirect('auth');
 		}
 	}

 	public function logout()
 	{
 		$this->session->unset_userdata('email');
 		$this->session->unset_userdata('role_id');

 		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  		Success! you have been logout.
		</div>');
 		redirect('auth');
 	}

 	public function change_password()
 	{
 		$data['user'] = $this->profile_model->profile($this->session->userdata('id_login'));

 		$this->form_validation->set_rules('current_password','Current_password','required|trim');

 		$this->form_validation->set_rules('new_password1','New_password','required|trim|min_length[6]|matches[new_password2]');

 		$this->form_validation->set_rules('new_password2','Confirm new_password','required|trim|min_length[6]|matches[new_password1]');

 		if ($this->form_validation->run() == false) {
			$output = array(
				'judul' => 'Change Password',
				'container' => 'change_password',
				'data' => $data
			);

			$this->load->view('theme/index', $output);
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
 				Warning! The current password you entered is wrong. please check again!
				</div>');
		 		redirect('auth/change_password');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
	 				Warning! The password you entered cannot be the same as current password. please check again!
					</div>');
			 		redirect('auth/change_password');
				} else {
					//password correct
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
	 				Success! Your password success changed. try to login!
					</div>');
			 		redirect('auth/change_password');
				}
			}
		}
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
