<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Home_Model');
		if($this->session->userdata('user_id') == null){
			redirect('login',$this->session->set_flashdata('error','Please Try to Login First'));
		}
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('dashboard');
		
	}

	public function add(){
		$this->load->view('header');
		$this->load->view('add_student');

		if(isset($_POST['submit'])){
			$data = array(
				'user_id' 		=> $this->session->userdata('user_id'),
				'student_name' 	=> $_POST['student_name'],
				'fathername' 	=> $_POST['fathername'],
				'mothername' 	=> $_POST['mothername'],
				'email' 		=> $_POST['email'],
				'phone' 		=> $_POST['phone'],
				'dateofbirth' 	=> $_POST['dateofbirth'],
				'course_name' 	=> $_POST['course_name'],
				'std_inst_id' 	=> $_POST['std_inst_id'],
				'present_address' => $_POST['present_address'],
				'permanent_address' => $_POST['permanent_address']
			);

			$this->Home_Model->insert('student',$data);
		}

	}
}
