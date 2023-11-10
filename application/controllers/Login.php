<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $page_data['page_name'] = "login";
        $page_data['page_title'] = "Log in";
        $this->load->view('login', $page_data);
    }
    public function validateLogin()
    {
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|exact_length[10]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $message = array('message' => validation_errors(), 'class' => 'error');
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url(), 'refresh');
        } else {

            $mobile_no = $this->security->xss_clean($this->input->post('mobile_no'));
            $password = sha1($this->security->xss_clean($this->input->post('password')));
            $validate = $this->db->query("select * from admin where password = '$password' AND mobile='$mobile_no'");
            $validate2 = $this->db->query("select * from customer where password = '$password' AND mobile='$mobile_no'");

            if ($validate->num_rows() == 1) {
                $data = $validate->row_array();
                if ($data['user_type'] == 'Admin') {
                    $this->session->set_userdata('loginstatus', '1');
                    $this->session->set_userdata('admin_id', $data['id']);
                    $this->session->set_userdata('user_type', $data['user_type']);
                    $this->session->set_userdata('user_name', $data['first_name']);
                    $message = array('message' => "Login Successfully", 'class' => 'success');
                    $this->session->set_flashdata('flash_message', $message);
                    redirect(base_url("admin/dashboard"), 'refresh');
                } else if ($data['user_type'] == 'Manager' || $data['user_type'] == 'Staff') {
                    $this->session->set_userdata('loginstatus', '2');
                    $this->session->set_userdata('admin_id', $data['id']);
                    $this->session->set_userdata('user_type', 'employee');
                    $this->session->set_userdata('user_type2', $data['user_type']);
                    $this->session->set_userdata('permission', $data['permission']);
                    $this->session->set_userdata('user_name', $data['first_name'] . ' ' . $data['last_name']);
                    $message = array('message' => "Login Successfully", 'class' => 'success');
                    $this->session->set_flashdata('flash_message', $message);
                    redirect(base_url("employee/dashboard"), 'refresh');
                } else {
                    $message = array('message' => "Invalid Mobile number or Password", 'class' => 'error');
                    $this->session->set_flashdata('flash_message', $message);
                    redirect(base_url(), 'refresh');
                }
            } else if ($validate2->num_rows() == 1) {
                $data2 = $validate2->row_array();
                if ($data2['status'] == 'Pending') {
                    $message = array('message' => "Not Approved", 'class' => 'error');
                    $this->session->set_flashdata('flash_message', $message);
                    redirect(base_url(), 'refresh');
                } else {
                    $this->session->set_userdata('loginstatus', '4');
                    $this->session->set_userdata('admin_id', $data2['id']);
                    $this->session->set_userdata('user_type', 'Customer');
                    $this->session->set_userdata('status', $data2['account_status']);
                    $this->session->set_userdata('user_name', $data2['first_name'] . ' ' . $data2['middle_name'] . $data2['last_name']);
                    $message = array('message' => "Login Successfully", 'class' => 'success');
                    $this->session->set_flashdata('flash_message', $message);
                    redirect(base_url("customer/dashboard"), 'refresh');
                }
            } else {
                $message = array('message' => "Invalid Mobile number or Password", 'class' => 'error');
                $this->session->set_flashdata('flash_message', $message);
                redirect(base_url(), 'refresh');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('loginstatus');
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('mobile_no');
        $this->session->unset_userdata('user_type');
        // $this->session->unset_userdata('admin_name');
        $message = array('message' => "Logout Successfully", 'class' => 'success');
        $this->session->set_flashdata('flash_message', $message);
        redirect(base_url(), 'refresh');
    }
    public function cron_job()
    {
        $this->db->select('id,balance');
        $this->db->from('customer');
        $this->db->where('account_status', 1);
        $customer = $this->db->get()->result_array();

        $this->db->select('yearly_interest_credit');
        $this->db->from('setting');
        $this->db->where('id', 1);
        $yearly_interest_credit = $this->db->get()->row_array();
        $per_day_credit_interest = $yearly_interest_credit['yearly_interest_credit'] / 365;

        for ($i = 0; $i < count($customer); $i++) {
            $per_day_interest_balance = round($customer[$i]['balance'] * $per_day_credit_interest / 100, 2);

            $num_rows = $this->db->get_where('wallet', array('w_date' => date('Y-m-d'), 'txn_id' => '4', 'customer_id' => $customer[$i]['id']))->num_rows();

            $remark = '';
            $updated_at = date('Y-m-d H:i:s');
            $w_date = date('Y-m-d');
            if ($num_rows == 0) {
                $this->db->trans_begin();
                $this->db->query('update customer set balance=balance+' . $per_day_interest_balance . ',updated_at="' . $updated_at . '" where id=' . $customer[$i]['id']);
                $customer_balance =  $this->db->get_where('customer', array('id' => $customer[$i]['id']))->row()->balance;
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    $insert_wallet = $this->db->insert('wallet', array(
                        'customer_id' => $customer[$i]['id'], 'type' => 'C', 'amount' => $per_day_interest_balance,
                        'balance' => $customer_balance, 'txn_id' => '4', 'remark' => $remark, 'w_date' => $w_date, 'created_at' => $updated_at
                    ));
                }
            }
        }
    }
    public function register()
    {
        $page_data['page_title'] = "register";
        $this->load->view('register', $page_data);
    }
    public function register_now()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('aadhar_card', 'Aadhar Card', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $message = array('message' => validation_errors(), 'class' => 'error');
            $this->session->set_flashdata('flash_message', $message);
            redirect(base_url('login/register'), 'refresh');
        } else {
            $data['first_name'] = $this->security->xss_clean($this->input->post('first_name'));
            $data['middle_name'] = $this->security->xss_clean($this->input->post('middle_name'));
            $data['aadhar_card'] = $this->security->xss_clean($this->input->post('aadhar_card'));
            $data['last_name'] = $this->security->xss_clean($this->input->post('last_name'));
            $data['status'] = 'Pending';
            $data['address'] = $this->security->xss_clean($this->input->post('address'));
            $data['document_type'] = $this->security->xss_clean($this->input->post('document_type'));
            $data['alternate_mobile_no'] = $this->security->xss_clean($this->input->post('a_mobile'));
            $data['city'] = $this->security->xss_clean($this->input->post('city'));
            $data['email'] = $this->security->xss_clean($this->input->post('email'));
            $data['mobile'] = $this->security->xss_clean($this->input->post('mobile'));
            $data['password'] = sha1($this->security->xss_clean($this->input->post('password')));
            $password = $this->security->xss_clean($this->input->post('password'));
            if (!empty($_FILES['photo']['name'])) {
                $file_ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $rand = substr(md5(microtime()), rand(0, 26), 3);
                $file_name = date('Ymdhis') . $rand . '.' . $file_ext;
                $config['upload_path'] = './upload';
                $config['allowed_types'] = "jpg|png|jpeg|pdf|webp";
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('photo');
                $data['photo'] = $file_name;
                $newfile_name = date('Ymdhis') . $rand . 'new.' . $file_ext;
                $destination_img = './upload/' . $newfile_name;
                $fileName = './upload/' . $file_name;
                $d = $this->compress($fileName, $destination_img, 50);

                unlink($fileName);
                $data['photo'] = $newfile_name;
            }
            if (!empty($_FILES['signature']['name'])) {
                $file_ext = pathinfo($_FILES['signature']['name'], PATHINFO_EXTENSION);
                $rand = substr(md5(microtime()), rand(0, 26), 3);
                $file_name = date('Ymdhis') . $rand . '.' . $file_ext;
                $config['upload_path'] = './upload';
                $config['allowed_types'] = "jpg|png|jpeg|pdf|webp";
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('signature');
                $data['signature'] = $file_name;
                $newfile_name = date('Ymdhis') . $rand . 'new.' . $file_ext;
                $destination_img = './upload/' . $newfile_name;
                $fileName = './upload/' . $file_name;
                $d = $this->compress($fileName, $destination_img, 50);

                unlink($fileName);
                $data['signature'] = $newfile_name;
            }
            if (!empty($_FILES['frontside_document']['name'])) {
                $file_ext = pathinfo($_FILES['frontside_document']['name'], PATHINFO_EXTENSION);
                $rand = substr(md5(microtime()), rand(0, 26), 3);
                $file_name = date('Ymdhis') . $rand . '.' . $file_ext;
                $config['upload_path'] = './upload';
                $config['allowed_types'] = "jpg|png|jpeg|pdf|webp";
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('frontside_document');
                $data['frontside_document'] = $file_name;
                $newfile_name = date('Ymdhis') . $rand . 'new.' . $file_ext;
                $destination_img = './upload/' . $newfile_name;
                $fileName = './upload/' . $file_name;
                $d = $this->compress($fileName, $destination_img, 50);

                unlink($fileName);
                $data['frontside_document'] = $newfile_name;
            }
            if (!empty($_FILES['backside_document']['name'])) {
                $file_ext = pathinfo($_FILES['backside_document']['name'], PATHINFO_EXTENSION);
                $rand = substr(md5(microtime()), rand(0, 26), 3);
                $file_name = date('Ymdhis') . $rand . '.' . $file_ext;
                $config['upload_path'] = './upload';
                $config['allowed_types'] = "jpg|png|jpeg|pdf|webp";
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('backside_document');
                $data['backside_document'] = $file_name;
                $newfile_name = date('Ymdhis') . $rand . 'new.' . $file_ext;
                $destination_img = './upload/' . $newfile_name;
                $fileName = './upload/' . $file_name;
                $d = $this->compress($fileName, $destination_img, 50);

                unlink($fileName);
                $data['backside_document'] = $newfile_name;
            }
            $this->db->select('aadhar_card');
            $this->db->from('customer');
            $this->db->where('aadhar_card', $data['aadhar_card']);
            $adhar_num_rows = ($this->db->get()->num_rows());

            $this->db->select('mobile');
            $this->db->from('customer');
            $this->db->where('mobile', $data['mobile']);
            $num_rows = ($this->db->get()->num_rows());
            if ($num_rows == 0 && $adhar_num_rows == 0) {
                $insert = $this->db->insert('customer', $data);
                $insert_id = $this->db->insert_id();
                if (isset($insert)) {
                    $message = array('message' => 'Registration Successfully', 'class' => 'success');
                } else {
                    $message = array('message' => 'Registration Falied', 'class' => 'error');
                }
                $this->session->set_flashdata('flash_message', $message);
                redirect(site_url(), 'refresh');
            } else {
                $message = array('message' => 'Mobile And Adhar No Is Unique', 'class' => 'error');
                $this->session->set_flashdata('flash_message', $message);
                redirect(base_url('login/register'), 'refresh');
            }
        }
    }
    public function compress($source, $destination, $quality)
    {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);


        imagejpeg($image, $destination, $quality);

        return $destination;
    }
}
