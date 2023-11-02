<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loginstatus') != 1 || $this->session->userdata('admin_id') == "" && ($this->session->userdata('user_type') != "Admin")) {
			$message = array('message' => "Your Session has Been Expired.!!", 'class' => 'danger');
			$this->session->set_flashdata('flash_message', $message);
			redirect(base_url(), 'refresh');
		}
	}
	public function index()
	{
		$page_data['page_name'] = "setting";
		$page_data['page_title'] = "Setting";
		$page_data['row_data'] = $this->db->get_where('setting', array('user_id' => $this->session->userdata('admin_id')))->row_array();
		$this->load->view('admin/common', $page_data);
	}

	public function add()
	{
		$this->form_validation->set_rules('charges', 'Charges', 'trim|required|numeric');
		$this->form_validation->set_rules('y_credit', 'Credit', 'trim|required|numeric');


		if ($this->form_validation->run() == false) {
			$message = array('message' => validation_errors(), 'class' => 'error');
			$this->session->set_flashdata('flash_message', $message);
			redirect(base_url('admin/setting'), 'refresh');
		} else {

			$data = array();
			$post_request =  $this->security->xss_clean($this->input->post());
			$user_id = $this->session->userdata('admin_id');

			$check_records = $this->db->get_where("setting", array("user_id", $user_id))->num_rows();

			if ($check_records == 1) {
				$data['late_fee_percentage'] = $post_request['charges'];
				$data['yearly_interest_credit'] = $post_request['y_credit'];
				$data['user_id'] = $user_id;
				$this->db->where("user_id", $user_id);
				$update = $this->db->update("setting", $data);
			} else {
				$data['late_fee_percentage'] = $post_request['charges'];
				$data['yearly_interest_credit'] = $post_request['y_credit'];
				$data['user_id'] = $user_id;
				$insert = $this->db->insert("setting", $data);
			}

			if (isset($update)) {
				$message = array('message' => "Setting Updated Successfully", 'class' => 'success');
			} else if (isset($insert)) {
				$message = array('message' => 'Setting Added Successfully', 'class' => 'success');
			} else {
				$message = array('message' => 'Failed to Update Setting Data.', 'class' => 'error');
			}
			$this->session->set_flashdata('flash_message', $message);
			redirect(base_url('admin/setting'), 'refresh');
		}
	}
}
