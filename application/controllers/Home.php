<?php
class Home extends CI_Controller {



	public function room()
	{
		echo "welcome to mobile legend";
	}

	public function garden()
	{

		$var = array( 
			'message' => 'HELLO GUYS',
			'notif' => 'what do you think about today?'
		);

		$this->load->view('home_garden', $var);
	}
}	