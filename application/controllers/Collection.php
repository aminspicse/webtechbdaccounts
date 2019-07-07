<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('Collection_Model');
        $this->load->model('CourseReg_Model');
        date_default_timezone_set('Asia/Dhaka');
        $this->load->library('form_validation');
        if($this->session->userdata('user_id') == null){
            redirect('login',$this->session->set_flashdata('error','Please Try to Login First'));
        }
    }

    public function index(){
        $queary['branch'] = $this->Collection_Model->fetch_branchinfo();
        $queary['course_info'] = $this->CourseReg_Model->fetch_course();
        $queary['collection'] = $this->Collection_Model->fetch_datecollection($this->input->post(date('d-m-y',strtotime('collection_date'))));
        $this->form_validation->set_rules('student_id', 'Student ID', 'required');
        $this->form_validation->set_rules('collection_date', 'Collection Date','required');
        $this->form_validation->set_rules('collection_amount','Collection Amount','required');
        $this->form_validation->set_rules('collection_method','Collection Method','required');
        
        if($this->form_validation->run() == true){
            if(isset($_POST['submit'])){
                $data = array(
                    'user_id'               => $this->session->userdata('user_id'),
                    'student_id'            => $_POST['student_id'],
                    'course_code'           => $_POST['course_code'],
                    'collection_branch_id'  => $_POST['collection_method'],
                    'collection_date'       => date('d-m-y', strtotime($_POST['collection_date'])),
                    'collection_amount'     => $_POST['collection_amount'],
                    'insert_on'             => date("d-m-y h:i:s A")
                );
                // just showing this day collection
                
                if($this->Collection_Model->collection('collection', $data) == true){
                    $query['success'] = 'Successfully Collected Data';
                    $this->load->view('header');
                    $this->load->view('collection',$queary);
                }
            }
        }else{
            $this->load->view('header');
            $this->load->view('collection',$queary);
        }
        
    }

    public function delete_collection(){
        $data = 0;
        if(isset($_POST['search_delete'])){
            $data = array(
                'collection_date'   => date('d-m-y', strtotime($_POST['collection_date'])),
                'collection_branch_id' => $_POST['collection_method']
            );

            print_r($data);
            
        }
        $qry['collection'] = $this->Collection_Model->fetch_fordeletecollection($data);
        $this->load->view('header');
        $this->load->view('delete_collection',$qry);
    }

    public function statement(){
        //$data['qry'] = $this->Collection_Model->collection_statement();
        $data['qry'] = $this->Collection_Model->course_details();
        $this->load->view('header');
        $this->load->view('statement',$data);
    }
}
