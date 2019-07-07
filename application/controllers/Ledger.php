<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Ledger extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Ledger_Model');
            if($this->session->userdata('user_id') == null){
                redirect('login',$this->session->set_flashdata('error','Please Try to Login First'));
            }
        }

        public function index(){
            $qry['student_info'] = $this->Ledger_Model->student_info($_GET['keyword']);
            $qry['registration_info'] = $this->Ledger_Model->course_info($_GET['keyword']);
            $qry['collection_info'] = $this->Ledger_Model->collection_bystudent($_GET['keyword']);
            $this->load->view('header');
            $this->load->view('ledger/ledger',$qry);
        
        }
    }