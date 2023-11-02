<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginstatus')!= 2 || $this->session->userdata('admin_id')=="" || ($this->session->userdata('user_type') !="employee" )) {
            $message = array('message'=>"Your Session has Been Expired.!!", 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url(),'refresh');
        }
    }
	public function index() {
	    $page_data['count_customer'] = $this->db->get_where('customer')->num_rows();
	    $page_data['count_loan'] = $this->db->get_where('loan')->num_rows();
        $page_data['staff'] = $this->db->get_where('admin',array('user_type'=>'Staff'))->num_rows();
        $page_data['account'] = $this->db->get_where('customer',array('account_status'=>1))->num_rows();
        $page_data['manager'] = $this->db->get_where('admin',array('user_type'=>'Manager'))->num_rows();
	    $page_data['page_name'] = "dashboard";
        $page_data['page_title'] = "Dashboard";
        $this->load->view('employee/common',$page_data);
	}
} 

