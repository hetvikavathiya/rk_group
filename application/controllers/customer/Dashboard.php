<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginstatus')!= 4 || $this->session->userdata('admin_id')=="" || ($this->session->userdata('user_type') !="Customer")) {
            $message = array('message'=>"Your Session has Been Expired.!!", 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url(),'refresh');
        }
    }
	public function index() {
        $this->db->select('*');
	    $this->db->from('customer');
	    $this->db->where('id',$this->session->userdata('admin_id'));
	    $page_data['row_data'] = $this->db->get()->row_array();
	    
        $page_data['balance'] = $this->db->get_where('customer',array('id'=>$this->session->userdata('admin_id')))->row_array();
        $page_data['count_loan'] = $this->db->get_where('loan',array('customer_id'=>$this->session->userdata('admin_id')))->num_rows();
	    
	    
	    $page_data['page_name'] = "dashboard";
        $page_data['page_title'] = "Dashboard";
        $this->load->view('customer/common',$page_data);
	}
} 

