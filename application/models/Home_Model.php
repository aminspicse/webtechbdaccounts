<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model {

	public function __construct(){
        parent::__construct();
        //$this->load->model('Login_Model');
    }
    public function insert($table,$data){
        $this->db->insert($table,$data);
        return true;
    }
}