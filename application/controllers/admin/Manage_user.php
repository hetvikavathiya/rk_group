<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_user extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginstatus')!= 1 || $this->session->userdata('admin_id')=="" && ($this->session->userdata('user_type') !="Admin")) {
            $message = array('message'=>"Your Session has Been Expired.!!", 'class'=>'error');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url(),'refresh');
        }
    }
	public function index() {
	    $page_data['page_name'] = "manage_user";
        $page_data['page_title'] = "Manage User";
        $this->load->view('admin/common',$page_data);
	}
    public function add(){
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('user_type', 'User Type', 'trim|required');
        $this->form_validation->set_rules('permission[]', 'Permission', 'trim|required');
        if($this->form_validation->run()==false) {
            $message = array('message'=>validation_errors(), 'class'=>'error');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url('admin/manager_user'),'refresh');
        }
        else {
            $data['first_name'] = $this->security->xss_clean($this->input->post('first_name'));
            $data['middle_name'] = $this->security->xss_clean($this->input->post('middle_name'));
            $data['last_name'] = $this->security->xss_clean($this->input->post('last_name'));
            $data['status'] = $this->security->xss_clean($this->input->post('status'));
            $data['address'] = $this->security->xss_clean($this->input->post('address'));
            $data['city'] = $this->security->xss_clean($this->input->post('city'));
            $data['permission'] = implode(',',$this->security->xss_clean($this->input->post('permission')));
            $data['user_type'] = $this->security->xss_clean($this->input->post('user_type'));
            $data['mobile'] = $this->security->xss_clean($this->input->post('mobile'));
            $data['password'] = sha1($this->security->xss_clean($this->input->post('password')));
            
            $this->db->select('mobile');
            $this->db->from('admin');
            $this->db->where('mobile',$data['mobile']);
            $num_rows = ($this->db->get()->num_rows());
            if($num_rows == 0){
                $insert = $this->db->insert('admin',$data);
                if(isset($insert)){
                    $message = array('message'=>'Add Successfully', 'class'=>'success');
                }else{
                    $message = array('message'=>'Add Falied', 'class'=>'error');
                }
                $this->session->set_flashdata('flash_message',$message);
                redirect(base_url('admin/user_report'),'refresh');
            }else{
                $message = array('message'=>'Mobile No Is Unique', 'class'=>'error');
                $this->session->set_flashdata('flash_message',$message);
                redirect(base_url('admin/manage_user'),'refresh');
            }
        }
	}
	public function update($param=''){
	    $user_id = $this->security->xss_clean($param);
	    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('user_type', 'User Type', 'trim|required');
        $this->form_validation->set_rules('permission[]', 'Permission', 'trim|required');
        if($this->form_validation->run()==false) {
            $message = array('message'=>validation_errors(), 'class'=>'error');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url('admin/user_report'),'refresh');
        }
        else {
            $data['first_name'] = $this->security->xss_clean($this->input->post('first_name'));
            $data['middle_name'] = $this->security->xss_clean($this->input->post('middle_name'));
            $data['last_name'] = $this->security->xss_clean($this->input->post('last_name'));
            $data['status'] = $this->security->xss_clean($this->input->post('status'));
            $data['address'] = $this->security->xss_clean($this->input->post('address'));
            $data['city'] = $this->security->xss_clean($this->input->post('city'));
            $data['permission'] = implode(',',$this->security->xss_clean($this->input->post('permission')));
            $data['user_type'] = $this->security->xss_clean($this->input->post('user_type'));
            $data['mobile'] = $this->security->xss_clean($this->input->post('mobile'));
            $password = $this->security->xss_clean($this->input->post('password'));
            if(!empty($password)){
                $data['password'] = sha1($password);
            }
            $this->db->select('mobile');
            $this->db->from('admin');
            $this->db->where('mobile',$data['mobile']);
            $num_rows = ($this->db->get()->num_rows());
            if($num_rows == 0 || $num_rows == 1){
                $this->db->where('id',$user_id);
                $update = $this->db->update('admin',$data);
                if(isset($update)){
                    $message = array('message'=>'Update Successfully', 'class'=>'success');
                }else{
                    $message = array('message'=>'Update Falied', 'class'=>'error');
                }
                $this->session->set_flashdata('flash_message',$message);
                redirect(base_url('admin/user_report'),'refresh');
            }else{
                $message = array('message'=>'Mobile No Is Unique', 'class'=>'error');
                $this->session->set_flashdata('flash_message',$message);
                redirect(base_url('admin/user_report'),'refresh');
            }
        }
	}
} 

