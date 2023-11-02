<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('loginstatus')!= 1 || $this->session->userdata('admin_id')=="" && ($this->session->userdata('user_type') !="Admin")) {
            $message = array('message'=>"Your Session has Been Expired.!!", 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(base_url(),'refresh');
        }
    }
	public function index() {
	    $this->db->select('id,aadhar_card,first_name,middle_name,last_name');
		$this->db->from('customer');
		$this->db->where('status','Approved');
		$page_data['customer'] = $this->db->get()->result_array();
	    $page_data['page_name'] = "account";
        $page_data['page_title'] = "Open Account";
        $this->load->view('admin/common',$page_data);
	}
	public function profile($param = '')
	{
		$this->db->select('first_name,middle_name,last_name,photo,email,mobile,signature,frontside_document,backside_document,document_type,account_status');
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
        
		$this->db->select('id,aadhar_card,first_name,middle_name,last_name');
		$this->db->from('customer');
		$this->db->where('status','Approved');
		$page_data['customer'] = $this->db->get()->result_array();
		$page_data['page_name'] = "account";
		$page_data['page_title'] = "Account";
		$this->load->view('admin/common', $page_data);
	}
	public function open($param=""){
	    $payment_mode = $this->security->xss_clean($this->input->post('payment_mode'));
        $remark = $this->security->xss_clean($this->input->post('remark')); 
        $customer_id = $this->security->xss_clean($param);
        $account_open_date = $this->security->xss_clean($this->input->post('open_a_date'));
        $amount = $this->security->xss_clean($this->input->post('amount')); 
        $account_status = 1;
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
        $this->db->where('id',$customer_id);
        $this->db->update('customer',array('account_status'=>$account_status,'account_open_date'=>$account_open_date));

        $this->db->trans_begin();
        $this->db->query('update customer set balance=balance+'.$amount.',updated_at="'.$updated_at.'" where id='.$customer_id);
        $balance =  $this->db->get_where('customer',array('id'=>$customer_id))->row()->balance;
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            $insert_wallet = $this->db->insert('wallet',array('customer_id'=>$customer_id,'type'=>'C','amount'=>$amount,'balance'=>$balance,'txn_id'=>'1','payment_mode'=>$payment_mode,'remark'=>$remark,'w_date'=>$w_date,'created_at'=>$updated_at));    
            $insert_id = $this->db->insert_id();
        }
        if(!empty($payment_proof)){
            $this->db->where('id',$insert_id);
            $this->db->update('wallet',array('payment_proof'=>$payment_proof));
        }
	    $this->load->model('send_mail');
	    $this->send_mail->account($customer_id);
        
        $this->load->model('send_wp');
	    $this->send_wp->account($customer_id);
       
    	$message = array('message' => "Account Open Successfully", 'class' => 'success');
		$this->session->set_flashdata('flash_message', $message);
        redirect(base_url('admin/account/profile/'.$customer_id), 'refresh');
	}

} 

