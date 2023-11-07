<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $page_data['page_name'] = "frontend/contactus";
        $page_data['page_title'] = "Contact Us";
        $page_data['data'] = $this->db->get('contact')->row_array();
        $this->load->view('frontend/comman', $page_data);
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('mobile_no', 'mobile_no', 'required');
        $this->form_validation->set_rules('feedback', 'feedback', 'required');

        if ($this->form_validation->run() == false) {
            $message = array('message' => validation_errors(), 'class' => 'error');
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('home '), 'refresh');
        } else {
            $data = array();
            $data['name'] = $this->security->xss_clean($this->input->post('name'));
            $data['mobile_no'] = $this->security->xss_clean($this->input->post('mobile_no'));
            $data['feedback'] = $this->security->xss_clean($this->input->post('feedback'));

            $this->db->insert('feedback', $data);

            redirect(base_url('home'), 'refresh');
        }
    }
}
