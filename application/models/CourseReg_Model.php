<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class CourseReg_Model extends CI_Model{

        public function __construct(){
            parent::__construct();
        }
        public function course_reg($table, $data){
            $this->db->insert($table, $data);
            return true;
        } 
        public function fetch_course(){
            $this->db->select('*');
            $this->db->from('course_details');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->where('course_status',1);
            return $this->db->get();
        }
    }