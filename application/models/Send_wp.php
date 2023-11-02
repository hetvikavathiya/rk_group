<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Send_wp extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('date_time');
        $this->load->library('phpmailer_lib');
    }
    
    public function send($mobile,$message) {
        $message = urlencode($message);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://whatsbot.tech/api/send_sms?api_token=96c3eb9f-5f55-4bf8-ab72-7fa1eb864ffc&mobile=91'.$mobile.'&message='.$message,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        // echo $response;
    }
    public function register($param='',$param2=''){
        $customer_id = $this->security->xss_clean($param);
        $record = $this->db->get_where('customer',array('id'=>$customer_id))->row_array();
        $mobile = $record['mobile'];
        $password = $param2;
        $message = "CUSTOMER REGISTRATION\nUser Name : ".$record['first_name'].' '.$record['last_name']." \nMobile No : ".$record['mobile']."\nPassword : ".$password."\nEmail : ".$record['email']."\nMessage : Your Account has been activated successfully Thank you for joining with R.K group Finace do Enjoy collabarating with us.";
        $this->send($mobile,$message);
    }
    public function credit($param='',$param2=''){
        $customer_id = $this->security->xss_clean($param);
        $record = $this->db->get_where('customer',array('id'=>$customer_id))->row_array();
        $record2 = $this->db->get_where('wallet',array('id'=>$param2))->row_array();
        $mobile = $record['mobile'];
        $password = $param2;
        if($record2['type']=='C'){$type = 'CREDIT';}else if($record2['type']=='D'){$type = 'DEBIT';}
        $message = "AMOUNT - ".$type."\nDate : ".$record2['created_at']." \nTransaction Type : ".$type."\nAmount : ".$record2['amount']."\nBalance :".$record2['balance'];
        $this->send($mobile,$message);
    }
    public function loan($param='',$param2=''){
        $customer_id = $this->security->xss_clean($param2);
        $loan_id = $this->security->xss_clean($param);
        
        $customer_record = $this->db->get_where('customer',array('id'=>$customer_id))->row_array();
        $loan_record = $this->db->get_where('loan',array('id'=>$loan_id))->row_array();
        
        $mobile = $customer_record['mobile'];
        $message = "LOAN CREATED\nLoan Amount : ".$loan_record['loan_amount']." \nLoan Interest : ".$loan_record['loan_interest']."\nPayable Amount	: ".$loan_record['payable_amount']."\nStarting Date:".$loan_record['s_date']."\nEnding Date :".$loan_record['e_date'];
        $this->send($mobile,$message);
    }
    public function account($param=''){
        $customer_id = $this->security->xss_clean($param);
        $record = $this->db->get_where('customer',array('id'=>$customer_id))->row_array();
        
        $mobile = $record['mobile'];
        $message = "ACCOUNT OPENING\nDate : ".$record['account_open_date']." \nBalance : ".$record['balance']."\nMessage : Your Account has been Open successfully.";
        $this->send($mobile,$message);
    }
}

?>