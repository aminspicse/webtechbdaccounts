<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class testpdf_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function fetchdata(){
        return $this->db->get('student');
    }
}