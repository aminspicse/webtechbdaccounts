<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Login_Model');
    }

    public function login(){
        $this->load->view('login/login');

        if(isset($_POST['login'])){
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];

            $check = $this->Login_Model->check_login($data['email'],$data['password']);

            if($check){
                $this->session->set_userdata('user_id',$check['user_id']);
                $this->session->set_userdata('email',$check['email']);
                $this->session->set_userdata('user_name',$check['user_name']);
                redirect('home');
            }else{
                redirect('login',$this->session->set_flashdata('error','Email or Password Invalide'));
            }
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login',$this->session->set_flashdata('error','Successfully Logedout'));
    }
}
