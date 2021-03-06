<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection_Model extends CI_Model {
	public function __construct(){
		parent::__construct();
    }
    public function collection($table,$data){
        $this->db->insert($table,$data);
        return true;
    }

    /* public function personal_details($student_id){
        $this->db->select('*');
        $this->db->from('student');
        $this->db->where('student_id',$student_id);
        return $this->db->get();
    } */
    public function fetch_branchinfo(){
        $this->db->select('*');
        $this->db->from('branch_info');
        $this->db->where('user_id',$this->session->userdata('user_id'));
        $qry = $this->db->get();
        return $qry->result(); 
    }
    public function total_collection_amount($student_id,$course_code){
        $this->db->select('SUM(collection.collection_amount) as collectionamount');
        //$this->db->select('collection_amount');
        $this->db->from('collection');
        $this->db->where('student_id',$student_id);
        $this->db->where('course_code',$course_code);
        $qry = $this->db->get();
        return $qry->result();
    }
    public function course_details($data){
        $this->db->select('*');
        //$this->db->select('collection_amount');
        $this->db->from('course_registration');
        $this->db->join('student','course_registration.student_id = student.student_id');
        $this->db->where('course_registration.reg_date >=', $data['from_date']);
        $this->db->where('course_registration.reg_date <=', $data['to_date']);
        return $this->db->get();
        //return $qry->result();
    }
    public function fetch_datecollection($collection_date){
        $this->db->select('*');
        $this->db->from('collection');
        $this->db->join('student','collection.student_id = student.student_id');
        $this->db->where('collection_date',$collection_date);
        $this->db->order_by('collection_id','desc');
        return $this->db->get();
    }
    public function fetch_fordeletecollection($data){
       
        $this->db->select('*');
        $this->db->from('collection');
        $this->db->join('student','collection.student_id = student.student_id');
        $this->db->where('collection.collection_date >=',$data['fromdate']);
        $this->db->where('collection.collection_date <=',$data['todate']);
        $this->db->where('collection.collection_branch_id',$data['collection_branch_id']);
        $this->db->where('collection.delete_status',0);
        $this->db->where('collection.user_id',$this->session->userdata('user_id'));
        $this->db->order_by('collection_date','asc');
        return $this->db->get();

    }
}