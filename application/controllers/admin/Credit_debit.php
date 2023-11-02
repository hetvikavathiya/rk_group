<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit_debit extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginstatus')!= 1 || $this->session->userdata('admin_id')=="" && ($this->session->userdata('user_type') !="Admin")) {
            $message = array('message'=>"Your Session has Been Expired.!!", 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url(),'refresh');
        }
         $this->load->library('date_time');
    }
	public function index() {
        $this->db->select('id,aadhar_card,first_name,middle_name,last_name');
		$this->db->from('customer');
		$this->db->where(array('account_status !='=>0));
		$page_data['customer'] = $this->db->get()->result_array();
	    $page_data['page_name'] = "credit_debit";
        $page_data['page_title'] = "Credit Debit";
        $this->load->view('admin/common',$page_data);
	}
	public function close($param = ''){
	    $this->db->where('id',$param);
	    $this->db->update('customer',array('account_status'=>2));
        redirect(base_url("admin/credit_debit/profile/".$customer_id),'refresh');
	}
	public function send_mail(){
	    $this->load->model('send_mail');
		$this->send_mail->send();
	}
	public function profile($param = '')
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id', $param);
		$page_data['row_data'] = $this->db->get()->row_array();
		$page_data['customer_id'] = $param;
        
        $this->db->select('open_account_charge');
        $this->db->from('setting');
        $this->db->where('id',1);
        $page_data['open_account_charge'] = $this->db->get()->row_array();
        
        $this->db->select("id,mode");
		$this->db->from("payment_mode");
		$page_data['payment_mode'] = $this->db->get()->result_array();
	    $this->db->select("id,mode");
		$this->db->from("payment_mode");
		$page_data['payment_mode2'] = $this->db->get()->result_array();
        
		$this->db->select('id,aadhar_card,first_name,middle_name,last_name');
		$this->db->from('customer');
		$this->db->where(array('account_status !='=>0));
		$page_data['customer'] = $this->db->get()->result_array();
		 $page_data['page_name'] = "credit_debit";
        $page_data['page_title'] = "Credit Debit";
		$this->load->view('admin/common', $page_data);
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
        $c_id = $postData['c_id'];
        
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
        if($c_id != ''){
            $search_arr[] = " customer_id='".$c_id."' ";
        }
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
	public function credit($customer_id=""){
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
	    $this->form_validation->set_rules('amount', 'amount', 'trim|required|numeric|greater_than[0]');
	    $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'trim|required');
	     if($this->form_validation->run()==false) {
            $message = array('message'=>'Invalid Amount', 'class'=>'error');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url("admin/credit_debit/profile/".$customer_id),'refresh');
        }
        else {
            $date = $this->security->xss_clean($this->input->post('date'));
            $amount = $this->security->xss_clean($this->input->post('amount'));
            $payment_mode = $this->security->xss_clean($this->input->post('payment_mode'));
            
            $remark = $this->security->xss_clean($this->input->post('remark')); 
            $updated_at = date('Y-m-d H:i:s');
            $w_date = date('Y-m-d');
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
    			$payment_proof = $file_name;
    		}
            $this->db->trans_begin();
            $this->db->query('update customer set balance=balance+'.$amount.',updated_at="'.$updated_at.'" where id='.$customer_id);
            $balance =  $this->db->get_where('customer',array('id'=>$customer_id))->row()->balance;
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
                $insert_wallet = $this->db->insert('wallet',array('customer_id'=>$customer_id,'type'=>'C','amount'=>$amount,'balance'=>$balance,'txn_id'=>'2','payment_mode'=>$payment_mode,'remark'=>$remark,'w_date'=>$w_date,'created_at'=>$updated_at));    
                $insert_id = $this->db->insert_id();
            	$this->load->model('send_mail');
				$this->send_mail->credit($customer_id,$insert_id);
			    $this->load->model('send_wp');
			    $this->send_wp->credit($customer_id,$insert_id);
            }
            if(!empty($payment_proof)){
                $this->db->where('id',$insert_id);
                $this->db->update('wallet',array('payment_proof'=>$payment_proof));
            }
    	   
    
           
        	$message = array('message' => "Account Depodit Successfully", 'class' => 'success');
    		$this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/credit_debit/profile/'.$customer_id), 'refresh');
        }
	}
	public function debit($customer_id=""){
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
	    $this->form_validation->set_rules('amount', 'amount', 'trim|required|numeric|greater_than[0]');
	    $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'trim|required');
        if($this->form_validation->run()==false) {
            $message = array('message'=>'Invalid Amount', 'class'=>'error');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url("admin/credit_debit/profile/".$customer_id),'refresh');
        }
        else {
            $date = $this->security->xss_clean($this->input->post('date'));
            $amount = $this->security->xss_clean($this->input->post('amount'));
            $payment_mode = $this->security->xss_clean($this->input->post('payment_mode'));
            $remark = $this->security->xss_clean($this->input->post('remark')); 
            $updated_at = date('Y-m-d H:i:s');
            $w_date = date('Y-m-d');
            $this->db->select('balance');
            $this->db->from('customer');
            $this->db->where('id',$customer_id);
            $db_balance = $this->db->get()->row_array();
            
            if($db_balance['balance'] >=  $amount){
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
    			$payment_proof = $file_name;
    		}
                $this->db->trans_begin();
                $this->db->query('update customer set balance=balance-'.$amount.',updated_at="'.$updated_at.'" where id='.$customer_id);
                $balance =  $this->db->get_where('customer',array('id'=>$customer_id))->row()->balance;
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                }else{
                    $this->db->trans_commit();
                    $insert_wallet = $this->db->insert('wallet',array('customer_id'=>$customer_id,'type'=>'D','amount'=>$amount,'balance'=>$balance,'txn_id'=>'3','payment_mode'=>$payment_mode,'remark'=>$remark,'w_date'=>$w_date,'created_at'=>$updated_at));    
                    $insert_id = $this->db->insert_id();
                	$this->load->model('send_mail');
    				$this->send_mail->credit($customer_id,$insert_id);
    			    $this->load->model('send_wp');
				    $this->send_wp->credit($customer_id,$insert_id);
                    if(isset($insert_wallet)){
                        $message = array('message' => "Withdrawal Successfully", 'class' => 'success');
                    }else{
                        $message = array('message' => "Withdrawal Failed", 'class' => 'success');
                    }
                }
                if(!empty($payment_proof)){
                    $this->db->where('id',$insert_id);
                    $this->db->update('wallet',array('payment_proof'=>$payment_proof));
                }
                }else{
                    $message = array('message' => "Invalid Account", 'class' => 'error');
                }

    		$this->session->set_flashdata('flash_message', $message);
            redirect(base_url('admin/credit_debit/profile/'.$customer_id), 'refresh');
            
        }
	}
} 

