<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loan extends CI_Controller
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
		$this->db->select('id,aadhar_card,first_name,middle_name,last_name');
		$this->db->from('customer');
		$this->db->where('status','Approved');
		$page_data['customer'] = $this->db->get()->result_array();
		$page_data['page_name'] = "loan";
		$page_data['page_title'] = "Loan";
		$this->load->view('admin/common', $page_data);
	}

	public function profile($param = '')
	{
		$this->db->select('first_name,middle_name,last_name,photo,email,mobile');
		$this->db->from('customer');
		$this->db->where('id', $param);
		$page_data['row_data'] = $this->db->get()->row_array();
		$page_data['customer_id'] = $param;

		$this->db->select('id,aadhar_card,first_name,middle_name,last_name');
		$this->db->from('customer');
		$this->db->where('status','Approved');
		$page_data['customer'] = $this->db->get()->result_array();
		$page_data['page_name'] = "loan";
		$page_data['page_title'] = "Loan";
		$this->load->view('admin/common', $page_data);
	}

	public function create($customer_id)
	{
		$customer_id = $this->security->xss_clean($customer_id);
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('aadhar_card', 'Aadhar Card', 'trim|required|max_length[12]');
		$this->form_validation->set_rules('name_2', 'Person 2 Name', 'trim|required');
		$this->form_validation->set_rules('mobile_2', 'Person 2 Mobile', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('aadhar_card_2', 'Person 2 Aadhar Card', 'trim|required|max_length[12]');
		$this->form_validation->set_rules('s_date', 'Starting Date', 'trim|required');
		$this->form_validation->set_rules('e_date', 'Ending Date', 'trim|required');
		$this->form_validation->set_rules('loan_amount', 'Loan Amount', 'trim|required');
		$this->form_validation->set_rules('loan_interest', 'Loan Interest', 'trim|required');
		$this->form_validation->set_rules('fixed_charge', 'Fixed Charge', 'trim|required');
		$this->form_validation->set_rules('payable_amount', 'Payable Amount', 'trim|required');
		$this->form_validation->set_rules('installment_date[]', 'Installment Date', 'trim|required');
		$this->form_validation->set_rules('installment_amount[]', 'Installment Amount', 'trim|required');

		if ($this->form_validation->run() == false) {
			$message = array('message' => validation_errors(), 'class' => 'error');
			$this->session->set_flashdata('flash_message', $message);
			redirect(base_url('admin/loan/profile/' . $customer_id), 'refresh');
		} else {
			$post_request = $this->security->xss_clean($this->input->post());
			$loan = array();

			$loan['customer_id'] = $customer_id;
			$loan['name'] = $post_request['name'];
			$loan['mobile'] = $post_request['mobile'];
			$loan['aadhar_card'] = $post_request['aadhar_card'];
			$loan['name_2'] = $post_request['name_2'];
			$loan['mobile_2'] = $post_request['mobile_2'];
			$loan['aadhar_card_2'] = $post_request['aadhar_card_2'];
			$loan['loan_amount'] = $post_request['loan_amount'];
			$loan['loan_interest'] = $post_request['loan_interest'];
			$loan['fixed_charge'] = $post_request['fixed_charge'];
			$loan['payable_amount'] = $post_request['payable_amount'];
			$loan['s_date'] = date("Y-m-d", strtotime($post_request['s_date']));
			$loan['e_date'] = date("Y-m-d", strtotime($post_request['e_date']));
			$loan['user_id'] = $this->session->userdata('admin_id');

			$insert = $this->db->insert("loan", $loan);
			$insert_id = $this->db->insert_id();

			$update = array();
			$update['unique_id'] = "RKGROUP2244" . $insert_id;
			$this->db->where('id', $insert_id);
			$this->db->update("loan", $update);
			for ($i = 0; $i < count($post_request['installment_amount']); $i++) {
				$loan_installment = array();
				$loan_installment['loan_id'] = $insert_id;
				$loan_installment['installment_date'] = date("Y-m-d", strtotime($post_request['installment_date'][$i]));
				$loan_installment['installment_amount'] = $post_request['installment_amount'][$i];
				$loan_installment['user_id'] = $this->session->userdata('admin_id');
                $loan_installment['status'] = "Pending";
				$insert = $this->db->insert('loan_emi_details', $loan_installment);
			}
                $this->load->model('send_mail');
				$this->send_mail->loan($insert_id,$customer_id);
			    $this->load->model('send_wp');
		        $this->send_wp->loan($insert_id,$customer_id);
			if ($insert == 1) {
				$message = array('message' => "Loan Created Successfully", 'class' => 'success');
				$this->session->set_flashdata('flash_message', $message);
				redirect(base_url('admin/loan/profile/' . $customer_id), 'refresh');
			} else {
				$message = array('message' => "Loan Creation Failed", 'class' => 'error');
				$this->session->set_flashdata('flash_message', $message);
				redirect(base_url('admin/loan/profile/' . $customer_id), 'refresh');
			} 
		}
	}

	public function report()
	{

		$postData = $this->security->xss_clean($this->input->post());

		$draw = $postData['draw'];
		$start = $postData['start'];
// 		$rowperpage = $postData['length']; // Rows display per page
// 		$columnIndex = $postData['order'][0]['column']; // Column index
// 		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
// 		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
        $customer_id = $postData['customer_id'];
		$searchQuery = "";
		if ($searchValue != '') {
			$searchQuery = " (customer.first_name like '%" . $searchValue . "%' or loan.name like '%" . $searchValue . "%' or loan.mobile like '%" . $searchValue . "%' or loan.loan_interest like '%" . $searchValue . "%') ";
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


// 		$this->db->limit($rowperpage, $start);
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

		$this->db->select("loan.*,customer.first_name as customer_name");
		$this->db->from('loan');
		$this->db->join('customer', 'customer.id = loan.customer_id', 'left');
		$this->db->where("loan.id", $post_request['loan_id']);
		$loan = $this->db->get()->row_array();

		$this->db->select("loan_emi_details.*,payment_mode.mode");
		$this->db->from("loan_emi_details");
		$this->db->join('payment_mode', 'loan_emi_details.payment_mode = payment_mode.id', 'left');
		$this->db->where("loan_emi_details.loan_id", $post_request['loan_id']);
		$loan_details = $this->db->get()->result_array();
		
		$this->db->select("late_fee_percentage");
		$this->db->from("setting");
		$late_fee_percentage = $this->db->get()->row('late_fee_percentage');
		$customer_id = $post_request['customer_id'];
		$this->db->select("id,mode");
		$this->db->from("payment_mode");
		$payment_mode = $this->db->get()->result_array();

		return $this->load->view("admin/loan_details", compact("loan", "loan_details","late_fee_percentage","payment_mode","customer_id"));
	}
	public function loan_emi_details(){
        $loan_emi_details_id = $this->security->xss_clean($this->input->post('loan_emi_details_id')); 
        $data['payment_mode'] = $this->security->xss_clean($this->input->post('payment_mode'));
        $data['remark'] = $this->security->xss_clean($this->input->post('remark')); 
        $data['payable_amount'] = $this->security->xss_clean($this->input->post('p_amount'));
        $customer_id = $this->security->xss_clean($this->input->post('customer_id'));
        $data['payment_date'] = $this->security->xss_clean($this->input->post('p_date'));
        $data['late_fee_charge'] = $this->security->xss_clean($this->input->post('late_fee_charge')); 
        $data['status'] = 'Received';
    	if (!empty($_FILES['proof']['name'])) {
			$file_ext = pathinfo($_FILES['proof']['name'], PATHINFO_EXTENSION);
			$rand = substr(md5(microtime()), rand(0, 26), 3);
			$file_name = date('Ymdhis') . $rand . '.' . $file_ext;
			$config['upload_path'] = './upload';
			$config['allowed_types'] = "jpg|png|jpeg|webp";
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('proof');
			$data['payment_proof'] = $file_name;
		}
        $this->db->where('id',$loan_emi_details_id);
        $this->db->update('loan_emi_details',$data);
    	$message = array('message' => "Payment Successfully", 'class' => 'success');
		$this->session->set_flashdata('flash_message', $message);
        redirect(base_url('admin/loan/profile/'.$customer_id), 'refresh');
	}
	public function update_status($emi_id="",$customer_id=""){
	    $this->db->where('id',$emi_id);
	    $this->db->update('loan_emi_details',array('payment_date'=>'','payment_mode'=>'','remark'=>'','payable_amount'=>'','late_fee_charge'=>'','status'=>'Pending','payment_proof'=>'',));
    	$message = array('message' => "Status Change Successfully", 'class' => 'success');
		$this->session->set_flashdata('flash_message', $message);
        redirect(base_url('admin/loan/profile/'.$customer_id), 'refresh');
	}
}
