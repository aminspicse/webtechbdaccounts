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
        $this->load->library('Pdf');
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
                    'collection_date'       => $_POST['collection_date'],
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
        $data = array('fromdate'=>date('d-m-y'), 'todate'=>date('d-m-y'),'collection_branch_id'=>1);
        if(isset($_GET['search_delete'])){
            $data = array(
                'fromdate'   => $_GET['fromdate'],
                'todate'   => $_GET['todate'],
                'collection_branch_id' => $_GET['collection_method']
            );
        }
        if(isset($_GET['generate_report'])){
            $data = array(
                'fromdate'   => $_GET['fromdate'],
                'todate'   => $_GET['todate'],
                'collection_branch_id' => $_GET['collection_method']
            );
            $this->collection_pdf($data);
        }
        $qry['branch'] = $this->Collection_Model->fetch_branchinfo();
        $qry['collection'] = $this->Collection_Model->fetch_fordeletecollection($data);
        $this->load->view('header'); 
        $this->load->view('delete_collection',$qry);
    }
    function collection_pdf($data){
        $pdf = new Pdf('P', 'mm', 'A4', TRUE, 'UTF-8', FALSE);
        $pdf->SetCreator('MD. AL AMIN');
        $pdf->SetSubject('Collection Report');
        $pdf->SetTitle('Collection Report');
        $pdf->setPrintHeader(true);

        $image_file = K_PATH_IMAGES.base_url('assets/images/1.png');
        // set default header data
        $pdf->SetHeaderData('assets/images/1.png', 10, 'Web Tech BD', 'Starview tower 4th floor, varthokhola, Sylhet - 3100, +880 1689-015612');
        // set default footer data
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        // set header and footer fonts
        $pdf->setHeaderFont(Array('Helvetica', '', 14));
        $pdf->setFooterFont(Array('Helvetica', 'C', 10));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(15, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT,5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //$pdf->SetTopMargin(19);
        $pdf->AddPage();

        $pdf->SetFont('Helvetica','b u',13);
        $pdf->Cell(190,6,'Collection Report From '.date('d-m-y',strtotime($data['fromdate'])).' To '.date('d-m-y',strtotime($data['todate'])),0,1);
        $pdf->Ln();
        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(10,8,'S L',1,0);
        $pdf->Cell(20,8,'ID',1,0);
        $pdf->Cell(60,8,'Name',1,0);
        $pdf->Cell(15,8,'Course',1,0);
        $pdf->Cell(30,8,'Collection Date',1,0);
        $pdf->Cell(25,8,'Amount(tk)',1,0);
        $pdf->Cell(25,8,'Total(tk)',1,1);
        $qry = $this->Collection_Model->fetch_fordeletecollection($data);
        $i = 1;
        $total = 0;
        if($qry->num_rows()> 0){
            foreach ($qry->result() as $row) {
                $pdf->Cell(10,6,$i++,1,0);
                $pdf->Cell(20,6,$row->student_id,1,0);
                $pdf->Cell(60,6,$row->student_name,1,0);
                $pdf->Cell(15,6,$row->course_code,1,0);
                $pdf->Cell(30,6,date('d-m-y',strtotime($row->collection_date)),1,0);
                
                $total += $row->collection_amount;
                $pdf->Cell(25,6,$row->collection_amount,1,0);
                $pdf->SetFont('Helvetica','b',13);
                $pdf->Cell(25,6,(float)$total.'.00',1,1);
                $pdf->SetFont('Helvetica','',13);
                
            }
            $pdf->SetFont('Helvetica','b',14);
            $pdf->Cell(135,10,'Grand Total',1,0,'C');
            $pdf->Cell(25,10,$total.'.00',1,0);
            $pdf->Cell(25,10,$total.'.00',1,1);
        }else{
            $pdf->SetFont('Helvetica','b',14);
            $pdf->Cell(185,10,'No Data Found',1,1,'C');
        }
        $pdf->Output('Collection_report.pdf', 'D'); 
    }

    public function statement(){ 
        //$data['qry'] = $this->Collection_Model->collection_statement();
        $data = array('from_date'=>'', 'to_date'=>'');
        if(isset($_GET['search'])){
            $data = array(
                'from_date' => $_GET['from_date'],
                'to_date' => $_GET['to_date']
            );
        }
        if(isset($_GET['generate'])){
            $data = array(
                'from_date' => $_GET['from_date'],
                'to_date' => $_GET['to_date']
            );
            $this->statement_pdf($data);
        }
        $data['qry'] = $this->Collection_Model->course_details($data);
        $this->load->view('header');
        $this->load->view('statement',$data);
    }
    //statement pdf 
    public function statement_pdf($data){
        $pdf = new Pdf('L', 'mm', 'A4', TRUE, 'UTF-8', FALSE);
        $pdf->SetCreator('MD. AL AMIN');
        $pdf->SetSubject('Collection Report');
        $pdf->SetTitle('Collection Report');
        $pdf->setPrintHeader(true);

        $image_file = K_PATH_IMAGES.base_url('assets/images/1.png');
        // set default header data
        $pdf->SetHeaderData('assets/images/1.png', 10, 'Web Tech BD', 'Starview tower 4th floor, varthokhola, Sylhet - 3100, +880 1689-015612');
        // set default footer data
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        // set header and footer fonts
        $pdf->setHeaderFont(Array('Helvetica', '', 14));
        $pdf->setFooterFont(Array('Helvetica', 'C', 10));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(15, 20, PDF_MARGIN_RIGHT,5);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //$pdf->SetTopMargin(19);
        $pdf->AddPage('L');

        $pdf->SetFont('Helvetica','B I U',14);
        $pdf->Cell(270,8,'Registration Statement From '.$data['from_date'].' To '.$data['to_date'],0,1,'C');

        $pdf->SetFont('Helvetica','',12);
        $pdf->Cell(10,8,'S L',1,0);
        $pdf->Cell(15,8,'ID',1,0);
        $pdf->Cell(60,8,'Name',1,0);
        $pdf->Cell(10,8,'Co.',1,0);
        $pdf->Cell(23,8,'Reg.Date',1,0);
        $pdf->Cell(23,8,'Start',1,0);
        $pdf->Cell(23,8,'End',1,0);
        $pdf->Cell(21,8,'C. Fee',1,0);
        $pdf->Cell(15,8,'waiver',1,0);
        $pdf->Cell(20,8,'Payable',1,0);
        $pdf->Cell(20,8,'Credit',1,0);
        $pdf->Cell(30,8,'Due Amount',1,1);

        $qry = $this->Collection_Model->course_details($data);
        $sl = 1;
        $credit_amount = 0;
        $totalcoursefee = 0;
        $totalpayable = 0;
        $totalcredit = 0;
        $totaldue = 0;
        if($qry->num_rows() > 0){
            foreach($qry->result() as $row){
                $credit_amount = $this->Collection_Model->total_collection_amount($row->student_id,$row->course_code);
                $totalcoursefee += $row->course_fee;
                $totalpayable += $row->payable_amount;
                $pdf->SetFont('Helvetica','',11);
                $pdf->Cell(10,6,$sl++,1,0,'C');
                $pdf->Cell(15,6,$row->student_id,1,0);
                $pdf->Cell(60,6,$row->student_name,1,0);
                $pdf->Cell(10,6,$row->course_code,1,0);
                $pdf->Cell(23,6,$row->reg_date,1,0);
                $pdf->Cell(23,6,$row->course_start,1,0);
                $pdf->Cell(23,6,$row->course_end,1,0);
                $pdf->Cell(21,6,$row->course_fee,1,0);
                $pdf->Cell(15,6,$row->course_waiver.'%',1,0);
                $pdf->Cell(20,6,$row->payable_amount,1,0);
                foreach ($credit_amount as $credit) {
                    $pdf->Cell(20,6,$credit->collectionamount,1,0);
                    $totalcredit += $credit->collectionamount;
                }
                $due = $row->payable_amount - $credit->collectionamount;
                $totaldue +=$due;
                $pdf->Cell(30,6,$due,1,1);
            }
            $pdf->SetFont('Helvetica','',14);
            $pdf->Cell(164,8,'Grand Total: ',1,0,'C');
            $pdf->Cell(21,8,$totalcoursefee,1,0);
            $pdf->Cell(15,8,'',1,0);
            $pdf->Cell(20,8,$totalpayable,1,0);
            $pdf->Cell(20,8,$totalcredit,1,0);
            $pdf->Cell(30,8,$totaldue,1,1);

        }else{
            $pdf->SetFont('Helvetica','b',14);
            $pdf->Cell(270,10,'Data Not Found',1,1,'C');
        }

        $pdf->Output('registrationstatement.pdf','D');
    }
}
