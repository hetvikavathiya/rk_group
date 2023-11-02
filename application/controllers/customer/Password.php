<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginstatus')!= 4 || $this->session->userdata('admin_id')=="" || ($this->session->userdata('user_type') !="Customer")) {
            $message = array('message'=>"Your Session has Been Expired.!!", 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url(),'refresh');
        }
    }
	public function index() {
	    $page_data['page_name'] = "password";
        $page_data['page_title'] = "Change Password";
        $this->load->view('customer/common',$page_data);
	}
	public function change(){
	    $this->form_validation->set_rules('old_password', 'old_password', 'trim|required');
	    $this->form_validation->set_rules('new_password', 'new_password', 'trim|required');
	    $this->form_validation->set_rules('re_password', 're_password', 'trim|required');
	     if($this->form_validation->run()==false) {
            $message = array('message'=>validation_errors(), 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url("customer/password"),'refresh');
        }
        else {
            $old_password = sha1($this->security->xss_clean($this->input->post('old_password')));
            $new_password = $this->security->xss_clean($this->input->post('new_password'));
            $re_password = $this->security->xss_clean($this->input->post('re_password'));
            $admin_id = $this->session->userdata('admin_id');
            
            $this->db->select('password');
            $this->db->from('customer');
            $this->db->where(array('id'=>$admin_id));
            $db_password = implode(',',$this->db->get()->row_array());
            
            if($old_password == $db_password){
                $this->db->where(array('id'=>$admin_id,'password'=>$old_password));
                $pass_update = $this->db->update('customer',array('password'=>sha1($re_password)));
                if(isset($pass_update)){
                    $message = array('message'=>"Password Updated Successfully", 'class'=>'success');
                }else{
                    $message = array('message'=>"Failed to Password Updated", 'class'=>'danger');
                }
                $this->session->set_flashdata('flash_message',$message);
                redirect(site_url('customer/dashboard'),'refresh');
            }else{
                $message = array('message'=>"Old Password Do Not Match", 'class'=>'danger');
                $this->session->set_flashdata('flash_message',$message);
                redirect(site_url('customer/password'),'refresh');
            }
            
            
        }
	}
} 

