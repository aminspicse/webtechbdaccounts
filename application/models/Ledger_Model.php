<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Ledger_Model extends CI_Model{
        public function __construct(){
            parent::__construct();
        }
        public function student_info($student_id){
            $this->db->select('*');
            $this->db->from('student');
            $this->db->where('student_id',$student_id);
            $this->db->where('user_id',$this->session->userdata('user_id'));
            $qry = $this->db->get();
            return $qry->result();
        }
        public function course_info($student_id){
            $this->db->select('*');
            $this->db->from('course_registration');
            $this->db->join('course_details','course_details.course_code = course_registration.course_code');
            $this->db->where('student_id',$student_id);
            $this->db->where('course_registration.user_id',$this->session->userdata('user_id'));
            $qry = $this->db->get();
            return $qry->result();
        }
        public function collection_bystudent($student_id){
            $this->db->select('*');
            $this->db->from('collection');
            $this->db->join('branch_info','collection.collection_branch_id = branch_info.branch_id');
            $this->db->where('student_id',$student_id);
            $this->db->where('collection.user_id',$this->session->userdata('user_id'));
            $this->db->where('collection.delete_status',0);
            $qry = $this->db->get();
            return $qry->result();
        }
    }