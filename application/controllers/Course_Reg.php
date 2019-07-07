<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Course_Reg extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('CourseReg_Model');
            $this->load->library('form_validation');
            if($this->session->userdata('user_id') == null){
                redirect('login',$this->session->set_flashdata('error','Please Try to Login First'));
            }
        }

        public function course_reg(){
            $query['course'] = $this->CourseReg_Model->fetch_course();
            $this->form_validation->set_rules('student_id','Student Id','required');
            $this->form_validation->set_rules('course_code','Course Code','required');
            $this->form_validation->set_rules('course_fee','Course Fee','required');
            if($this->form_validation->run() == true){
                if(isset($_POST['submit'])){
                    $data = array(
                        'student_id'    => $_POST['student_id'],
                        'user_id'       => $this->session->userdata('user_id'),
                        'course_code'   => $_POST['course_code'],
                        'course_fee'    => $_POST['course_fee'],
                        'course_waiver' => $_POST['course_waiver'],
                        'payable_amount'=> $_POST['payable_amount'],
                        'course_start'  => date('d-m-y',strtotime($_POST['course_start'])),
                        'course_end'    => date('d-m-y',strtotime($_POST['course_end'])),
                        'class_day'     => $_POST['class_day'],
                        'class_time'    => $_POST['class_time'],
                        'reg_date'      => date('d-m-y',strtotime($_POST['reg_date']))
                    );
    
                    if($this->CourseReg_Model->course_reg('course_registration',$data) == true){
                        $query['success'] = "Successfully Registerd";
                        $this->load->view('header'); 
                        $this->load->view('course/course_reg',$query);
                    }
                }
            }else{
                $this->load->view('header'); 
                $this->load->view('course/course_reg',$query);
            }
            
            
        }
    }