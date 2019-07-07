<?php
defined('BASEPATH') OR exit('No direct script access allowed');


    class Login_Model extends CI_Model{
        public function __construct(){
            parent::__construct();
        }

        public function check_login($email,$password){
            $this->db->where('email',$email);
            $this->db->where('password',$password);
            $this->db->from('users');
            $qry = $this->db->get();
            return $qry->row_array();
        }
    }