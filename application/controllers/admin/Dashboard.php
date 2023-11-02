<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginstatus')!= 1 || $this->session->userdata('admin_id')=="" && ($this->session->userdata('user_type') !="Admin")) {
            $message = array('message'=>"Your Session has Been Expired.!!", 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url(),'refresh');
        }
    }
	public function index() {
        $page_data['count_customer'] = $this->db->get_where('customer')->num_rows();
        $page_data['count_loan'] = $this->db->get_where('loan')->num_rows();
	    $page_data['account'] = $this->db->get_where('customer',array('account_status'=>1))->num_rows();
	    
        $page_data['account'] = $this->db->get_where('customer',array('account_status'=>1))->num_rows();
	    $this->db->select_sum('balance');   
        $this->db->from('customer'); 
        $page_data['total_balance'] = $this->db->get()->row_array();
        
        $this->db->select_sum('loan_amount');   
        $this->db->from('loan'); 
        $page_data['total_loan_amount'] = $this->db->get()->row_array();
        
        $this->db->select_sum('installment_amount');   
        $this->db->from('loan_emi_details');
        $this->db->where('status','Received');
        $page_data['total_recovery'] = $this->db->get()->row_array();
        
        $this->db->select_sum('installment_amount');   
        $this->db->from('loan_emi_details');
        $this->db->where('status','Pending');
        $page_data['total_recovery_pending'] = $this->db->get()->row_array();
        
        $page_data['total_approved_customer'] = $this->db->get_where('customer',array('status'=>'Approved'))->num_rows();
        $page_data['total_Rejected_customer'] = $this->db->get_where('customer',array('status'=>'Rejected'))->num_rows();
        $page_data['total_Pending_customer'] = $this->db->get_where('customer',array('status'=>'Pending'))->num_rows();
        
	    $page_data['page_name'] = "dashboard";
        $page_data['page_title'] = "Dashboard";
        $this->load->view('admin/common',$page_data);
	}
} 

