<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_report extends CI_Controller
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
		$this->db->select('*');
		$this->db->from('customer');
		$page_data['customer'] = $this->db->get()->result_array();
		$page_data['page_name'] = "customer_report";
		$page_data['page_title'] = "Customer Report";
		$this->load->view('admin/common', $page_data);
	}
	public function edit($param = '', $param2 = "")
	{
		$costomer_id = $this->security->xss_clean($param);
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id', $costomer_id);
		if (!empty($param2)) {
			$page_data['check'] = 'account';
		}
		$page_data['row_data'] = $this->db->get()->row_array();
		$page_data['page_name'] = "customer";
		$page_data['page_title'] = "Customer";
		$this->load->view('admin/common', $page_data);
	}
	public function report()
	{

		$postData = $this->security->xss_clean($this->input->get());
		$response = array();

		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
		$status = $postData['select'];

		$search_arr = array();
		$searchQuery = "";
		if ($searchValue != '') {
			$search_arr[] = " (aadhar_card like '%" . $searchValue . "%') ";
		}
		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}
		## Total number of records without filtering
		$this->db->select('*');
		$this->db->from('customer');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		if ($status != '') {
			$this->db->where('status', $status);
		}
		// $this->db->order_by($columnName, $columnSortOrder);
		$this->db->order_by('id', 'desc');
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->num_rows();
		$totalRecords = $records;

		## Total number of record with filtering
		$totalRecordwithFilter = $records;
		## Fetch records
		$this->db->select('*');
		$this->db->from('customer');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		if ($status != '') {
			$this->db->where('status', $status);
		}
		// $this->db->order_by($columnName, $columnSortOrder);
		$this->db->order_by('id', 'desc');
		$this->db->limit($rowperpage, $start);
		// $this->db->group_by("order.id");
		$records = $this->db->get()->result_array();
		$data = array();
		$i = 1;
		foreach ($records as $record) {
			$edit = base_url('admin/customer_report/edit/') . $record['id'];


			$backside_document = base_url('upload/') . $record['backside_document'];
			if (!empty($record['photo'])) {
				$photo = base_url('upload/') . $record['photo'];
				$r_photo = '<a href="' . $photo . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
			} else {
				$r_photo = '';
			}
			if (!empty($record['signature'])) {
				$signature = base_url('upload/') . $record['signature'];
				$r_signature = '<a href="' . $signature . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
			} else {
				$r_signature = '';
			}
			if (!empty($record['frontside_document'])) {
				$frontside_document = base_url('upload/') . $record['frontside_document'];
				$r_frontside_document = '<a href="' . $frontside_document . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
			} else {
				$r_frontside_document = '';
			}
			if (!empty($record['backside_document'])) {
				$backside_document = base_url('upload/') . $record['backside_document'];
				$r_backside_document = '<a href="' . $backside_document . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
			} else {
				$r_backside_document = '';
			}



			$data[] = array(
				'edit' => '<a href="' . $edit . '"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>',
				'id' => $i,
				'aadhar' => $record['aadhar_card'],
				'name' => $record['first_name'] . $record['middle_name'] . $record['last_name'],
				'mobile' => $record['mobile'],
				'a_mobile' => $record['alternate_mobile_no'],
				'address' => $record['address'],
				'email' => $record['email'],
				'city' => $record['city'],
				'photo' => $r_photo,
				'signature' => $r_signature,
				'frontside_document' => $r_frontside_document,
				'backside_document' => $r_backside_document,
				'document_type' => $record['document_type'],
				'status' => $record['status'],
			);
			$i++;
		}
		## Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		echo json_encode($response);
	}
}
