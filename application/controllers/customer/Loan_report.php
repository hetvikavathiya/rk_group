<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan_report extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginstatus')!= 4 || $this->session->userdata('admin_id')=="" || ($this->session->userdata('user_type') !="Customer")) {
            $message = array('message'=>"Your Session has Been Expired.!!", 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url(),'refresh');
        }
    }
	public function index() {
	    $page_data['page_name'] = "loan";
        $page_data['page_title'] = "Loan Report";
        $this->load->view('customer/common',$page_data);
	}
		public function report()
	{
        $customer_id = $this->session->userdata('admin_id');
		$postData = $this->security->xss_clean($this->input->post());

		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
		$searchQuery = "";
		if ($searchValue != '') {
			$searchQuery = " (customer.first_name like '%" . $searchValue . "%' or loan.name like '%" . $searchValue . "%' or loan.mobile like '%" . $searchValue . "%' or loan.loan_interest like '%" . $searchValue . "%') ";
		}
		 if($customer_id != ''){
            $search_arr[] = " id='".$customer_id."' ";
        }


        $this->db->select('loan.*,customer.first_name as customer_name');
		$this->db->from('loan');
		$this->db->join('loan_emi_details', 'loan_emi_details.loan_id = loan.id', 'left');
		$this->db->join('customer', 'customer.id = loan.customer_id', 'left');
		if ($searchQuery != '')
		$this->db->where($searchQuery);
		if(!empty($customer_id))
		$this->db->where('customer.id',$customer_id);
		$this->db->group_by('loan.id');
		$this->db->order_by('loan.id', 'desc');

		$records = $this->db->get()->num_rows();
		$totalRecords = $records;

		## Total number of record with filtering
	$this->db->select('loan.*,customer.first_name as customer_name');
		$this->db->from('loan');
		$this->db->join('loan_emi_details', 'loan_emi_details.loan_id = loan.id', 'left');
		$this->db->join('customer', 'customer.id = loan.customer_id', 'left');
		if ($searchQuery != '')
		$this->db->where($searchQuery);
		if(!empty($customer_id))
		$this->db->where('customer.id',$customer_id);
		$this->db->group_by('loan.id');
		$this->db->order_by('loan.id', 'desc');
		$records = $this->db->get()->num_rows();

		$totalRecordwithFilter = $records;


		$this->db->select('loan.*,customer.first_name as customer_name');
		$this->db->from('loan');
		$this->db->join('loan_emi_details', 'loan_emi_details.loan_id = loan.id', 'left');
		$this->db->join('customer', 'customer.id = loan.customer_id', 'left');
		if ($searchQuery != '')
		$this->db->where($searchQuery);
		if(!empty($customer_id))
		$this->db->where('customer.id',$customer_id);
		$this->db->group_by('loan.id');
		$this->db->order_by('loan.id', 'desc');


		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();
		$data = array();
		$i = $start + 1;
		foreach ($records as $record) {

			if ($record->updated_at != null) {
				$updated_at = date('M d, Y, g:i A ', strtotime($record->updated_at));
			} else {
				$updated_at = '---';
			}

			$loan_details = '<a href="javascript:void(0)" class="loan_details" data-loan_id="' . $record->id . '"><i class="fa fa-info-circle fa-2x"></i></a>';


			$data[] = array(
				"sno" => $i,
				"loan_details" => $loan_details,
				"unique_id" => $record->unique_id,
				"customer_name" => $record->customer_name,
				"name" => $record->name,
				"loan_amount" =>$record->loan_amount,
				"mobile" => $record->mobile,
				"created_at" => date('M d, Y, g:i A ', strtotime($record->created_at)),

			);
			$i = $i + 1;
		}

		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);
		echo json_encode($response);
	}
		public function get_loan_details()
	{
		$post_request = $this->security->xss_clean($this->input->post());
        $customer_id = $this->session->userdata('admin_id');
		$this->db->select("loan.*,customer.first_name as customer_name");
		$this->db->from('loan');
		$this->db->join('customer', 'customer.id = loan.customer_id', 'left');
		$this->db->where("customer.id",$customer_id);
		$loan = $this->db->get()->row_array();

		$this->db->select("loan_emi_details.*,payment_mode.mode");
		$this->db->from("loan_emi_details");
		$this->db->join('payment_mode', 'loan_emi_details.payment_mode = payment_mode.id', 'left');
		$this->db->where("loan_emi_details.loan_id", $post_request['loan_id']);
		$loan_details = $this->db->get()->result_array();
		
		$this->db->select("late_fee_percentage");
		$this->db->from("setting");
		$late_fee_percentage = $this->db->get()->row('late_fee_percentage');
		$this->db->select("id,mode");
		$this->db->from("payment_mode");
		$payment_mode = $this->db->get()->result_array();

		return $this->load->view("customer/loan_details", compact("loan", "loan_details","late_fee_percentage","payment_mode","customer_id"));
	}

}