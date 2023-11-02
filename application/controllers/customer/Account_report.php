<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_report extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginstatus')!= 4 || $this->session->userdata('admin_id')=="" || ($this->session->userdata('user_type') !="Customer")) {
            $message = array('message'=>"Your Session has Been Expired.!!", 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url(),'refresh');
        }
    }
	public function index() {
	    $this->db->select('balance');
	    $this->db->from('customer');
	    $this->db->where('id',$this->session->userdata('admin_id'));
	    $page_data['balance'] = $this->db->get()->row_array();
	    $page_data['page_name'] = "account_report";
        $page_data['page_title'] = "Account Report";
        $this->load->view('customer/common',$page_data);
	}
	public function report(){

		$postData = $this->security->xss_clean($this->input->get());
		$response = array();

		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
// 		$columnIndex = $postData['order'][0]['column']; // Column index
// 		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
// 		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
        $from_date = $postData['from_date'];
        $to_date = $postData['to_date'];
        $c_id = $this->session->userdata('admin_id');
        
		$search_arr = array();
		$searchQuery = "";
		if ($searchValue != '') {
			$search_arr[] = " (id like '%" . $searchValue . "%') ";
		}
		if($from_date != ''){
            $search_arr[] = " w_date>='".$from_date."' ";
        }
        if($to_date != ''){
            $search_arr[] = " w_date<='".$to_date."' ";
        }
        // if($c_id != ''){
            $search_arr[] = " customer_id='".$c_id."' ";
        // }
		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}
		## Total number of records without filtering

		$this->db->select('*');
		$this->db->from('wallet');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		// $this->db->order_by($columnName, $columnSortOrder);
// 		$this->db->order_by('id', 'desc');
// 		$this->db->limit($rowperpage, $start);
		// $this->db->group_by("order.id");
		$totalRecords = $this->db->get()->num_rows();

		## Total number of record with filtering
		$totalRecordwithFilter = $totalRecords;

		## Fetch records
		$this->db->select('*');
		$this->db->from('wallet');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		// $this->db->order_by($columnName, $columnSortOrder);
		$this->db->order_by('id', 'desc');
		$this->db->limit($rowperpage, $start);
		// $this->db->group_by("order.id");
		$records = $this->db->get()->result_array();
		$data = array();
		$i = 1;
		foreach ($records as $record) {
                if($record['type'] == 'C'){
                    $color = 'text-success';
                }else{
                    $color = 'text-danger';
                }
                $date = date("d-m-Y H:i:s", strtotime($record['created_at']));
                $this->db->select('txn_type.name');
                $this->db->from('wallet');
                $this->db->join('txn_type', 'wallet.txn_id = txn_type.id', 'left');
                $this->db->where('wallet.txn_id',$record['txn_id']);
                $t_type = $this->db->get()->row_array();
                
                $this->db->select('payment_mode.mode');
                $this->db->from('wallet');
                $this->db->join('payment_mode', 'wallet.payment_mode = payment_mode.id', 'left');
                $this->db->where('wallet.payment_mode',$record['payment_mode']);
                $payment_mode = $this->db->get()->row_array();
                
                if(!empty($record['payment_proof'])){
    		    	$payment_proof = base_url('upload/') . $record['payment_proof'];
    			    $proof = '<a href="' . $payment_proof . '" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>';
    			}else{
    			    $proof = '';
    			}
                
			$data[] = array(
				'id' => $i,
				'date'=>$date,
				'amount' => '<span class="'.$color.'">'.$record["amount"].'</span>',
				'balance' => $record['balance'],
				'transaction_type' => $t_type['name'],
				'payment_mode' => $payment_mode['mode'],
				'payment_proof' => $proof,
				'remark' => $record['remark'],
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

