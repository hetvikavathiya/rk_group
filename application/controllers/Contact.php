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
        $id = $this->security->xss_clean($this->input->post('id'));

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('mobile_no', 'mobile_no', 'required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('inquiry', 'inquiry', 'required');

        if ($this->form_validation->run() == false) {
            $message = array('message' => validation_errors(), 'class' => 'error');
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('home '), 'refresh');
        } else {
            $data = array();
            $data['name'] = $this->security->xss_clean($this->input->post('name'));
            $data['mobile_no'] = $this->security->xss_clean($this->input->post('mobile_no'));
            $data['inquiry'] = $this->security->xss_clean($this->input->post('inquiry'));

            $this->db->insert('inquiry', $data);
            $insert_id = $this->db->insert_id();
            $this->load->model('send_mail');
            $this->send_mail->inquiry($insert_id, $id);
            redirect(base_url('home'), 'refresh');
        }
    }
}
