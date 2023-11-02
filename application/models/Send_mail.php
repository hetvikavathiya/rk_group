<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Send_mail extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->library('date_time');
        $this->load->library('Phpmailer_lib');
          $this->load->library('encryption');
    }
    
    // public function email($param='',$param2=''){
    //     $customer_id = $this->security->xss_clean($param);
         
    //     $this->db->select('*');
    //     $this->db->from('customer');
    //     $this->db->where('id',$customer_id);
    //     $email = $this->db->get()->row_array();
    //     $mobile = $email['mobile'];
        
    //     $this->db->select('*');
    //     $this->db->from('customer');
    //     $this->db->where('id',$customer_id);
    //     $data['data'] = $this->db->get()->row_array();
    //     $data['password'] = $param2;
    //     if(!empty($email['email'])){
    //         $email_body = $this->load->view('email_view',$data,true);
    //         $mail = $this->phpmailer_lib->load();
    //         $mail->isSMTP();
    //         $mail->protocol = 'smtp';
    //         $mail->Host     = 'e2e-79-27.ssdcloudindia.net';
    //         $mail->SMTPAuth = true;
    //         $mail->Username = 'support@rkgroupfinance.in';
    //         $mail->Password = 'Rehan3172';
    //         $mail->SMTPSecure = 'ssl';
    //         $mail->Port     = '465';
    //         $mail->setFrom('support@rkgroupfinance.in');
    //         $mail->addReplyTo('support@rkgroupfinance.in');
    //         $mail->addAddress($email['email']);
    //         $mail->Subject = "Customer-Registration";
    //         $mail->isHTML(true);
    //         $mail->Body = $email_body;
    //         if(!$mail->send()){
    //              echo 'Mailer Error: ' . $mail->ErrorInfo;
    //             return false;
    //         }else{
    //             return true;
    //         }
    //     }
    // }
    
    public function email($param='',$param2=''){
        $customer_id = $this->security->xss_clean($param);
         
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('id',$customer_id);
        $email = $this->db->get()->row_array();
        $mobile = $email['mobile'];
        
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('id',$customer_id);
        $data['data'] = $this->db->get()->row_array();
        $data['password'] = $param2;
        if(!empty($email['email'])){
            $email_body = $this->load->view('email_view',$data,true);
            $mail = $this->phpmailer_lib->load();
            $mail->SMTPSecure = "ssl";  
			$mail->Host = "smtpout.secureserver.net";  
			$mail->Port='465';   
			 $mail->Username = "support@rkgroupfinance.in";
            $mail->Password = 'Rehankhanrenbest2244';
			$mail->SMTPKeepAlive = true;  
			$mail->Mailer = "smtp"; 
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;
			$mail->CharSet = 'utf-8';
			$mail->SMTPDebug  = 0;

			$mail->setFrom('support@rkgroupfinance.in');
			$mail->addAddress($email['email']);
			$mail->addReplyTo('support@rkgroupfinance.in');
            $mail->Subject = "Customer-Registration";
            $mail->isHTML(true);
            $mail->Body = $email_body;
            if(!$mail->send()){
                return 'Mailer Error: ' . $mail->ErrorInfo;
            }else{
                return true;
            }
        }
    }
    
    public function send(){
        // $customer_id = $this->security->xss_clean($param);
         
        // $this->db->select('*');
        // $this->db->from('customer');
        // $this->db->where('id',$customer_id);
        // $email = $this->db->get()->row_array();
        // $mobile = $email['mobile'];
        
        // $this->db->select('*');
        // $this->db->from('customer');
        // $this->db->where('id',$customer_id);
        // $data['data'] = $this->db->get()->row_array();
        $data['password'] = '1234';
        $email['email'] = 'parikshitvaghasiya343@gmail.com';
        if(!empty($email['email'])){
            // $email_body = $this->load->view('email_view',$data,true);
            $mail = $this->phpmailer_lib->load();
            $mail->SMTPSecure = "tls";  
			$mail->Host = "smtpout.secureserver.net";  
			$mail->Port='465';   
			 $mail->Username = "support@rkgroupfinance.in";
            $mail->Password = 'Rehankhanrenbest2244';
			$mail->SMTPKeepAlive = true;  
			$mail->Mailer = "smtp"; 
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;
			$mail->CharSet = 'utf-8';
			$mail->SMTPDebug  = 2;

			$mail->setFrom('support@rkgroupfinance.in');
			$mail->addAddress($email['email']);
			$mail->addReplyTo('support@rkgroupfinance.in');
            $mail->Subject = "Customer-Registration";
            $mail->isHTML(true);
            $email_body = 'hello';
            $mail->Body = $email_body;
            if(!$mail->send()){
                return  'Mailer Error: ' . $mail->ErrorInfo;
            }else{
                echo "sent";
            }
        }
    }
    
   public function credit($param='',$param2=''){
        $customer_id = $this->security->xss_clean($param);
         
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('id',$customer_id);
        $data['data'] = $this->db->get()->row_array();
        
        $this->db->select('*');
        $this->db->from('wallet');
        $this->db->where('id',$param2);
        $data['wallet'] = $this->db->get()->row_array();
        if($data['wallet']['type']=='C'){$type = 'CREDIT';}else if($data['wallet']['type']=='D'){$type =  'DEBIT';}
        if(!empty($data['data']['email'])){
            $email_body = $this->load->view('credit_view',$data,true);
            $mail = $this->phpmailer_lib->load();
            $mail->isSMTP();
            $mail->protocol    = 'smtp';
            $mail->Host     = 'smtpout.secureserver.net';
            $mail->SMTPAuth = true;
            $mail->Username = 'support@rkgroupfinance.in';
            $mail->Password = 'Rehankhanrenbest2244';
            $mail->SMTPSecure = 'ssl';
            $mail->Port     = '465';
            $mail->setFrom('support@rkgroupfinance.in');
            $mail->addReplyTo('support@rkgroupfinance.in');
            $mail->addAddress($data['data']['email']);
            $mail->Subject = "Amount-".$type;
            $mail->isHTML(true);
            $mail->Body = $email_body;
     
            // $mail->SMTPDebug  = 2;
            if(!$mail->send()){
                return 'Mailer Error: ' . $mail->ErrorInfo;
            }else{
                return true;
            }
        }
    }
    public function loan($param='',$param2=''){
        $customer_id = $this->security->xss_clean($param2);
        $loan_id = $this->security->xss_clean($param);
         
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('id',$customer_id);
        $data['data'] = $this->db->get()->row_array();

        $this->db->select('*');
        $this->db->from('loan_emi_details');
        $this->db->where('loan_id',$loan_id);
        $data['emi'] = $this->db->get()->result_array();
        
        $this->db->select('*');
        $this->db->from('loan');
        $this->db->where('id',$loan_id);
        $data['loan'] = $this->db->get()->row_array();
        // echo '<pre>';
        // print_r($data);exit;
            if(!empty($data['data']['email'])){
                $email_body = $this->load->view('loan_view',$data,true);
                $mail = $this->phpmailer_lib->load();
                $mail->isSMTP();
                 $mail->protocol    = 'smtp';
                $mail->Host     = 'smtpout.secureserver.net';
                $mail->SMTPAuth = true;
                $mail->Username = 'support@rkgroupfinance.in';
                $mail->Password = 'Rehankhanrenbest2244';
                $mail->SMTPSecure = 'ssl';
                $mail->Port     = '465';
                $mail->setFrom('support@rkgroupfinance.in');
                $mail->addReplyTo('support@rkgroupfinance.in');
                $mail->addAddress($data['data']['email']);
                $mail->Subject = "Loan-created";
                $mail->isHTML(true);
                $mail->Body = $email_body;
         
                if(!$mail->send()){
                    return 'Mailer Error: ' . $mail->ErrorInfo;
                }else{
                    return true;
                }
            
        }
        
      
    }
    public function account($param=''){
        $customer_id = $this->security->xss_clean($param);
        $data['data'] = $this->db->get_where('customer',array('id'=>$customer_id))->row_array();
        
         if(!empty($data['data']['email'])){
            $email_body = $this->load->view('account_view',$data,true);
            $mail = $this->phpmailer_lib->load();
            $mail->isSMTP();
            $mail->protocol    = 'smtp';
            $mail->Host     = 'smtpout.secureserver.net';
            $mail->SMTPAuth = true;
            $mail->Username = 'support@rkgroupfinance.in';
            $mail->Password = 'Rehankhanrenbest2244';
            $mail->SMTPSecure = 'ssl';
            $mail->Port     = '465';
            $mail->setFrom('support@rkgroupfinance.in');
            $mail->addReplyTo('support@rkgroupfinance.in');
            $mail->addAddress($data['data']['email']);
            $mail->Subject = "Account-Opened";
            $mail->isHTML(true);
            $mail->Body = $email_body;
     
            if(!$mail->send()){
                return 'Mailer Error: ' . $mail->ErrorInfo;
            }else{
                return true;
            }
        }
    }
}
?>