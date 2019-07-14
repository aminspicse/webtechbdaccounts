<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries\tcpdf\tcpdf.php';
    class testpdf extends CI_Controller{
        public function __construct(){
            parent::__construct();
            if($this->session->userdata('user_id') == null){
                redirect('login');
            }
        }
        public function Header(){

        }
        public function index(){
            //Header();
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
            $this->Header();
            $pdf->AddPage();

            $pdf->Output('dfdf','I');
        }
        
    }